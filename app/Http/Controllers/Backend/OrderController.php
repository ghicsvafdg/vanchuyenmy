<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        
        $date_from = null;
        $date_to = null;
        $status = null;
        $order = Order::all()->sortByDesc('created_at');
        $i = 0;

        return view('backend.order', compact('order', 'i', 'date_from', 'date_to', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $order = Order::findOrFail($id);
        return view('backend.showOrder', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $order = Order::findOrFail($id);
        return view('backend.editOrder', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $order = Order::findOrFail($id);
        $order->status = $request->get('status');
        if ($request->get('status') == 4) {
            foreach ($order->orderDetail as $product) {
                $product->productOrder->quantity = $product->productOrder->quantity - $product->quantity;
                $pro = Product::findOrFail($product->productOrder->id);
                $pro->quantity = $product->productOrder->quantity;
                $pro->save();
            }
        }
        $order->save();
        return redirect()->route('manage-order.index')->with('success', 'Thay đổi thông tin đơn hàng thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $order = Order::findOrFail($id);
        if ($order->status == 5) {
            $order->delete();
            return back()->with('success', 'Xóa đơn hàng thành công');
        }
        return back()->with('error', 'Chỉ xóa được đơn hàng có trạng thái: Đã hủy');
    }

    public function filter(Request $request)
    {
        $date_from = null;
        $date_to = null;
        $status = null;
        if (Auth::check() && Auth::user()->role == 0) {
            $status = $request->get('status');

            if (!empty($request->get('date_from'))) {
                $date_from = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_from'))));
                $date_from1 = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('date_from'))));
            }

            if (!empty($request->get('date_to'))) {
                $date_to = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_to'))));
                $date_to1 = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('date_to'))));
            }

            if (!empty($status)) {
                $list_status = Order::all()->where('status', $status);
            }

            if (!empty($date_to1) || !empty($date_from1)) {
                if (empty($date_from1)) {
                    $list_status = Order::where('created_at', '<=', $date_to1)->get();
                    $date_to = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_to'))));
                } elseif (empty($date_to1)) {
                    $list_status = Order::where('created_at', '>=', $date_from1)->get();
                    $date_from = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_from'))));
                } else {
                    $list_status = Order::whereBetween('created_at', [$date_from1,$date_to1])->get();
                    $date_to = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_to'))));
                    $date_from = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_from'))));
                }
            } elseif (empty($date_from)&&empty($date_to)&&empty($status)) {
                $list_status = Order::all();
            }

            $order = $list_status;
            $i = 0;

            return view('backend.order', compact('order', 'i', 'date_from', 'date_to', 'status'));
        } else {
            return redirect('index');
        }
    }
}
