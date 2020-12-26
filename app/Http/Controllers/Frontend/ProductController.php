<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Banner;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\User;
use App\Models\viewedProducts;
use App\Models\FooterPost;
use App\Models\ProductPostTag;
use App\Models\Tag;

class ProductController extends Controller
{
    public function show($slug)
    {
        $i = 2;
        $z = 1;
        
        $product = Product::where('slug',$slug)->first();
        $relateProduct = Product::where([['id','!=',$product->id],['category_id',$product->category_id]])->get();

        $comment = Comment::where('product_id', $product->id)->orderBy('created_at','desc')->get();
        $reply = Reply::all();

        $banner = Banner::all();

        $images = json_decode($product->filename);

        $allCate = ProductCategory::all();

        $footerPost = FooterPost::where('status',1)->get();

        $tag = ProductPostTag::where('products_id',$product->id)->get();

        //hotTags in index
        $tags = Tag::all()->sortByDesc('views')->take(6);
        //hot tags in footer
        $tgs = Tag::all()->sortByDesc('views')->take(12);

        //get all active categogies
        $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
                                        ->OrderBy('order','desc')->get();

        if(Auth::check()){
            $check_viewed_products = viewedProducts::where([['user_id',Auth::user()->id],
                                                            ['products_id',$product->id]])->first();    
                                    
            // create viewed list products
            if($check_viewed_products === null)
            {
                $viewed = new viewedProducts;
                $viewed->user_id = Auth::user()->id;
                $viewed->products_id = $product->id;
                $viewed->save();
            }
            $user_id = Auth::user()->id;
            $user_name = User::find($user_id)->username;
            $viewedList = viewedProducts::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->limit(10)->get();
            $cartlist = Cart::where('user_id',Auth::user()->id)->count();
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            return view('frontend.detail',compact('product','tags','tgs','categories','images','banner','allCate',
                                                    'i','z','cartlist','cart','viewedList','relateProduct', 'user_name', 
                                                    'comment', 'reply','tag','footerPost'));
        }
        return view('frontend.detail',compact('product','tags','tgs','categories','images','banner','allCate',
                                                'i','z','relateProduct', 'comment', 'reply','tag','footerPost'));
    }

    public function search(Request $request)
    {
        $name= $request->get('name');

        // dd($name);
        // where('name', 'LIKE', '%' . $term . '%');
        // $product1 = Product::where('name', $name)->get();
        // $product_id = $product1->id;

        // $comment = Comment::where('product_id', $product_id)->orderBy('created_at','desc')->get();

        // $reply = Reply::all();

        // $i = 2;
        // $z = 1;
        // $product = Product::where('slug',$name)->first();
        // $banner = Banner::all();
        // $images = json_decode($product->filename);
        // $allCate = ProductCategory::all();
        // $relateProduct = Product::where([['id','!=',$product->id],['category_id',$product->category_id]])->get();
        // $footerPost = FooterPost::where('status',1)->get();
        // if(Auth::check()){
        //     $check_viewed_products = viewedProducts::where([['user_id',Auth::user()->id],
        //                                                     ['products_id',$product->id]])->first();    
                                    
        //     // create viewed list products
        //     if($check_viewed_products === null)
        //     {
        //         $viewed = new viewedProducts;
        //         $viewed->user_id = Auth::user()->id;
        //         $viewed->products_id = $product->id;
        //         $viewed->save();
        //     }
        //     $user_id = Auth::user()->id;
        //     $user_name = User::find($user_id)->username;
        //     $viewedList = viewedProducts::where('user_id',Auth::user()->id)->get();
        //     $cartlist = Cart::where('user_id',Auth::user()->id)->count();
        //     $cart = Cart::where('user_id',Auth::user()->id)->get();
        //     return view('frontend.detail',compact('product','images','banner','allCate','i','z','cartlist','cart','viewedList','relateProduct', 'product_id', 'user_name', 'comment', 'reply','footerPost'));
        // }
        // return view('frontend.detail',compact('product','images','banner','allCate','i','z','relateProduct', 'product_id', 'comment', 'reply','footerPost'));
    }
}
