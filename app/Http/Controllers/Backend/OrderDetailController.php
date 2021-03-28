<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\FooterPost;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductCategory;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        foreach ($request->carts as $cart_id) {
            $cart = Cart::findOrFail($cart_id); // validations the product id

            // must be create new table
            $orderProducts = new OrderDetail(); // create new table ordersProducts

            $orderProducts->product_id = $cart->product_id;
            $orderProducts->color = $cart->color;
            $orderProducts->size = $cart->size;
            $orderProducts->quantity = $cart->quantity;
            $orderProducts->user_id = Auth::user()->id;
            $orderProducts->save();
        }
        return back()->with('success', 'Đặt hàng thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = null;
        $date_from = null;
        $date_to = null;

        if (Auth::check() && Auth::user()->id == $id) {
            //hotTags in index
            $tags = Tag::all()->sortByDesc('views')->take(6);
            //hot tags in footer
            $tgs = Tag::all()->sortByDesc('views')->take(12);

            //get all active categogies
            $categories = ProductCategory::where([['parent_id', '=', 0], ['status','=',1]])->OrderBy('order', 'desc')->get();

            $footerPost = FooterPost::where('status', 1)->get();
            $order = Order::where('user_id', $id)->orderBy('created_at', 'desc')->get();
            $user = User::findOrFail($id);
            $cartlist = Cart::where('user_id', Auth::user()->id)->count();
            $cart = Cart::where('user_id', Auth::user()->id)->get();
            return view('frontend.orderList', compact('tags', 'tgs', 'categories', 'order', 'user', 'cart', 'cartlist', 'footerPost', 'status', 'date_from', 'date_to  '));
        }
        return redirect()->route('login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDetail $orderDetail)
    {
        //
    }
}
