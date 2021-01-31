<?php

namespace App\Http\Controllers\Backend;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\FooterPost;
use App\Models\Tag;
use App\Models\ProductCategory;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $i =1;
            $sum = 0;

            //hotTags in index
            $tags = Tag::all()->sortByDesc('views')->take(6);
            //hot tags in footer
            $tgs = Tag::all()->sortByDesc('views')->take(12);

            //get all active categogies
            $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
                                    ->OrderBy('order','desc')->get();
                                    
            $cartlist = Cart::where('user_id',Auth::user()->id)->count();
            $cart = Cart::where('user_id',Auth::user()->id)->get();

            $user = Cart::where('user_id',Auth::user()->id)->first();
            $footerPost = FooterPost::where('status',1)->get();
            return view('frontend.detailCart', compact('tags','tgs','categories','cartlist','cart','i','user','sum','footerPost'));
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
        //get present product quantity
        $productQuan = Product::findOrFail($request->get('product_id'))->quantity;

        //return error when quantity smaller than 1
        $getInputQuan = $request->get('quantity');
        if($getInputQuan < 1)
        {
            return back()->with('error','Số lượng sản phẩm không hợp lệ');
        }

        //find product in cart
        $checkProduct = Cart::where([['user_id',Auth::user()->id],
                                    ['product_id',$request->get('product_id')],
                                    ['color',$request->get('color')],
                                    ['size',$request->get('size')]])->first();

        //add quantity if product is the same
        if(!($checkProduct === Null) && $checkProduct->color == $request->get('color') && $checkProduct->size == $request->get('size'))
        {
            $checkProduct->quantity = $checkProduct->quantity + $getInputQuan;
            if($checkProduct->quantity > $productQuan)
            {
                return back()->with('error','Số lượng sản phẩm trong kho không đủ yêu cầu');
            }
            $checkProduct->save();
        }else
        {
            if($getInputQuan > $productQuan)
            {
                return back()->with('error','Số lượng sản phẩm trong kho không đủ yêu cầu');
            }

            $cart = new Cart();
            $cart->product_id = $request->get('product_id');
            $cart->user_id = Auth::user()->id;
            $cart->color = $request->get('color');
            $cart->size = $request->get('size');
            $cart->quantity = $getInputQuan;
            $cart->save();
        }

        // $product = Product::where('id',$request->get('product_id'))->first();
        return back()->with('success','Thêm sản phẩm vào giỏ hàng thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cart = Cart::where([['user_id',Auth::user()->id],
                            ['id',$id]])->first();
        if($cart->proInCart->quantity < $request->get('quantity'))
        {
            return back()->with('error','Số lượng sản phẩm trong kho không đủ');
        }
        if($request->get('quantity') < 1)
        {
            return back()->with('error','Số lượng sản phẩm tối thiểu là 1');
        }
        $cart->color = $request->get('color');
        $cart->size = $request->get('size');
        $cart->quantity = $request->get('quantity');
        $cart->save();
        return back()->with('success','Thay đổi thông tin giỏ hàng thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return back();
    }
}
