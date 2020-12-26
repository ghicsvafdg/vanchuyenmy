<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\QuotationPrice;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->role == 0) {
            $quotation = Quotation::all()->sortByDesc('created_at');
            $i = 0;
            return view('backend.quotation', compact('quotation', 'i'));
        }
        return redirect()->route('login');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->role == 0) {
            $quotation = Quotation::findOrFail($id);
            return view('backend.request', compact('quotation'));
        }
        return redirect()->route('login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $quotation = Quotation::findOrFail($id);
        $quotation->reply = $request->get('content');
        $quotation->save();
        $user = $quotation->email;

        Mail::to($user)->send(new QuotationPrice($quotation));
        return redirect()->route('manage-quotation.index')->with('success', 'Gửi thư báo giá thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $quotation = Quotation::findOrFail($id);
        $quotation->delete();
        return back()->with('success', 'xóa đơn báo giá thành công!');
    }

    public function filter(Request $request)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        if (!empty($request->get('date_from'))) {
            $date_from = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('date_from'))));
        }

        if (!empty($request->get('date_to'))) {
            $date_to = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('date_to'))));
        }

        $i = 0;
        $pro = Quotation::limit(999999999);

        if (!empty($date_to) || !empty($date_from)) {
            if (empty($date_from)) {
                $pro->where('created_at', '<=', $date_to);
            } elseif (empty($date_to)) {
                $pro->where('created_at', '>=', $date_from);
            } else {
                $pro->whereBetween('created_at', [$date_from,$date_to]);
            }
        }

        $quotation = $pro->get();
        return view('backend.searchResultquotation', compact('quotation', 'i'));
    }
}
