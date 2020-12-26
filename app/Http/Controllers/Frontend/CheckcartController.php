<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Checkcart;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FooterPost;
use App\Models\Tag;
class CheckcartController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $user=USer::all();
        $banner = Banner::all();
        $footerPost = FooterPost::where('status',1)->get();

        //hotTags in index
        $tags = Tag::all()->sortByDesc('views')->take(6);
        //hot tags in footer
        $tgs = Tag::all()->sortByDesc('views')->take(12);

        $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
                                    ->OrderBy('order','desc')
                                    ->get();

        $product = Product::where('status',1)->get();

        $posts = Post::where('status',1)->OrderBy('created_at','desc')->limit(5)->get();

        if(Auth::check()){
            $cartlist = Cart::where('user_id',Auth::user()->id)->count();
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            return view('frontend.checkCart1', compact('tags','tgs','categories','product','banner','posts','cartlist','cart', 'user','footerPost'));
        }
        return view('frontend.checkCart1', compact('tags','tgs','categories','product','banner','posts','user','footerPost'));
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
    // public function store(Request $request)
    
    
    /**
    * Display the specified resource.
    *
    * @param  \App\Checkcart  $checkcart
    * @return \Illuminate\Http\Response
    */
    public function show(Request $request)
    {
        $footerPost = FooterPost::where('status',1)->get();

        //hotTags in index
        $tags = Tag::all()->sortByDesc('views')->take(6);
        //hot tags in footer
        $tgs = Tag::all()->sortByDesc('views')->take(12);
        
        //get all active categogies
        $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
                                        ->OrderBy('order','desc')->get();
        
        //get options
        $options = $request->get('option1');
        //seach by phone
        if($options == 0){

            $option =$request->get('data');
            $user=User::where('phone', $option)->get();

            if($user->isEmpty()){
                return back()->with('error','Số điện thoại sai hoặc chưa đăng kí tài khoản');
            }

            $order = Order::where('phone', $option)->get();
            $orderid = Order::select('id')->where('phone', $option)->get();
            
            if($order->isEmpty()){
                return back()->with('error','Chưa có đơn hàng nào trong giỏ hàng');
            }
            $orderid = $order->map->only(['id']);

            $productid = OrderDetail::where('orders_id', $orderid)->get();

            if(Auth::check()){
                $cartlist = Cart::where('user_id',Auth::user()->id)->count();
                $cart = Cart::where('user_id',Auth::user()->id)->get();
                return view('frontend.checkCart', compact('tags','tgs','categories','options','option','cartlist','cart', 'user', 'order', 'productid','footerPost'));
            }
            return view('frontend.checkCart', compact('tags','tgs','categories','options','option','user', 'order', 'productid','footerPost'));   
        }
        
        //search by email
        elseif($options == 1)
        {  
            $option = $request->get('data');

            $user = User::where('email', $option)->first();

            if($user === null){
                return back()->with('error', 'Email sai hoặc chưa đăng kí tài khoản');
            }

            $order = Order::where('user_id', $user->id)->get();

            if($order->isEmpty()){
                return back()->with('error','Chưa có đơn hàng nào trong giỏ hàng');
            }
            
            $orderid = $order->map->only(['id']);

            $productid = OrderDetail::where('orders_id', $orderid)->get();
            
            if(Auth::check()){

                $cartlist = Cart::where('user_id',Auth::user()->id)->count();
                $cart = Cart::where('user_id',Auth::user()->id)->get();
                return view('frontend.checkCart', compact('tags','categories','options','option','tgs','cartlist','cart', 'user', 'order', 'productid','footerPost'));
            }
            return view('frontend.checkCart', compact('tags','categories','tgs','options','option','user', 'order' , 'productid','footerPost')); 
        }
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Checkcart  $checkcart
    * @return \Illuminate\Http\Response
    */
    public function edit(Checkcart $checkcart)
    {
        //
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Checkcart  $checkcart
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Checkcart $checkcart)
    {
        //
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Checkcart  $checkcart
    * @return \Illuminate\Http\Response
    */
    public function destroy(Checkcart $checkcart)
    {
        //
    }
}
    