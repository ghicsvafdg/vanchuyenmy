<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\FooterPost;
use App\Models\Tag;

class ProductCategoryController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($slug)
    {
        $category = ProductCategory::where('slug','like', $slug)->first();

        if (!$category) {
            abort(404);
        }

        $banner = Banner::all();
        $product = Product::where('category_id', '=', $category->id)->paginate(12);
        
        //hotTags in index
        $tags = Tag::all()->sortByDesc('views')->take(6);
        //hot tags in footer
        $tgs = Tag::all()->sortByDesc('views')->take(12);
        
        //get all active categogies
        $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
                                        ->OrderBy('order','desc')->get();
            
        $newest = Product::where('category_id', '=', $category->id)->orderBy('created_at', 'DESC')->paginate(12);
        $footerPost = FooterPost::where('status',1)->get();
        if (Auth::check()) {
            
            $cartlist = Cart::where('user_id',Auth::user()->id)->count();
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            return view('frontend.productCategory', compact('banner','tags','tgs','categories','product','category','cartlist','cart','footerPost','newest'));
        }
        return view ('frontend.productCategory',compact('banner','tags','tgs','categories','product','category','footerPost', 'newest'));
    }

    public function filter(Request $request, $id){
        $price = $request->get('price');
        $range = $request->get('range');
        // dd($range);
        $slug = ProductCategory::where('id',$id)->first();
        
        $category = ProductCategory::where('slug','like',"$slug->slug%")->first();
        // dd($category);
        $banner = Banner::all();
        $pro = Product::limit(999999);
        $pro1 = Product::limit(99999)->orderBy('created_at', 'DESC');
        $newest = Product::where('category_id', '=', $category->id)->orderBy('created_at', 'DESC')->paginate(12);
        if(!empty($price)){
            if($price==1){
                $pro = Product::where('category_id', $id)->orderBy('price', 'ASC');
            }elseif($price==2){
                $pro = Product::where('category_id', $id)->orderBy('price', 'DESC');
            }
        }

        if(!empty($range)){
            if($range==1){
                $pro = Product::where('category_id', $id)->whereBetween('price',[0,200.00]);
            }elseif($range==2){
                $pro = Product::where('category_id', $id)->whereBetween('price',[200.00,500.00]);
            }elseif($range==3){
                $pro = Product::where('category_id', $id)->whereBetween('price',[500.00,1000.00]);
            }elseif($range==4){
                $pro = Product::where('category_id', $id)->where('price','>=',1000.00);
            }
        }

        if (!empty($price)&&!empty($range)) {
            if ($price == 1) {
                if ($range == 1) {
                    $pro = Product::where('category_id', $id)->whereBetween('price',[0,200.00])->orderBy('price', 'ASC');
                } elseif ($range == 2) {
                    $pro = Product::where('category_id', $id)->whereBetween('price',[200.00,500.00])->orderBy('price', 'ASC');
                } elseif ($range == 3) {
                    $pro = Product::where('category_id', $id)->whereBetween('price',[500.00,1000.00])->orderBy('price', 'ASC');
                } elseif ($range == 4) {
                    $pro = Product::where([['category_id', $id],['price','>=',1000.00]])->orderBy('price', 'ASC');
                }
            } elseif ($price == 2) {
                if ($range == 1) {
                    $pro = Product::where('category_id', $id)->whereBetween('price',[0,200.00])->orderBy('price', 'DESC');
                } elseif ($range == 2) {
                    $pro = Product::where('category_id', $id)->whereBetween('price',[200.00,500.00])->orderBy('price', 'DESC');
                } elseif ($range == 3) {
                    $pro = Product::where('category_id', $id)->whereBetween('price',[500.00,1000.00])->orderBy('price', 'DESC');
                } elseif ($range == 4) {
                    $pro = Product::where('category_id', $id)->where('price','>=',1000.00)->orderBy('price', 'DESC');
                }
            }
        }

        $product = $pro->paginate(12);

        $footerPost = FooterPost::where('status',1)->get();

        //hotTags in index
        $tags = Tag::all()->sortByDesc('views')->take(6);
        //hot tags in footer
        $tgs = Tag::all()->sortByDesc('views')->take(12);

        //get all active categogies
        $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
                                        ->OrderBy('order','desc')->get();

        if (Auth::check()) {
            $cartlist = Cart::where('user_id',Auth::user()->id)->count();
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            return view('frontend.productCategory', compact('tags','tgs','categories','banner','product','category','cartlist','cart','footerPost', 'newest'));
        }
        return view ('frontend.productCategory',compact('tags','tgs','categories','banner','product','category','footerPost',  'newest'));
    }
}
