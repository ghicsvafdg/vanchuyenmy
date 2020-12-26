<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\FooterPost;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    
    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index()
    {
        $banner = Banner::all();
        $search=null;
        
        //hotTags in index
        $tags = Tag::all()->sortByDesc('views')->take(6);
        //hot tags in footer
        $tgs = Tag::all()->sortByDesc('views')->take(12);
        
        //get all active categogies
        $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
        ->OrderBy('order','desc')->get();
        
        $product = Product::where('status',1)->get();
        
        $posts = Post::where('status',1)->OrderBy('created_at','desc')->limit(5)->get();
        
        $footerPost = FooterPost::where('status',1)->get();
        
        $hotProducts = DB::table('order_details')
        ->select('products_id', DB::raw('count(products_id) as count'))
        ->groupBy('products_id')
        ->get();
        
        $i = 1;
        if(Auth::check()){
            $cartlist = Cart::where('user_id',Auth::user()->id)->count();
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            return view('frontend.index', compact('search','tags','tgs','i','categories','product','banner','posts','tags','cartlist','cart','footerPost','hotProducts'));
        }
        return view('frontend.index', compact('search','tags','tgs','i','categories','product','banner','posts','tags','footerPost','hotProducts'));
    }
    
    public function show($slug)
    {
        
    }
    
    public function search(Request $request){
        $price=null;
        $range=null;
        $search = $request->get('search');
        if(empty($search)){
            return redirect()->route('index');
        }
        $slugs = HomeController::convert_vi_to_en($request->get('search'));
        
        $banner = Banner::all();
        
        //hotTags in index
        $tags = Tag::all()->sortByDesc('views')->take(6);
        //hot tags in footer
        $tgs = Tag::all()->sortByDesc('views')->take(12);
        
        $categories = ProductCategory::where('status','=',1)
        ->OrderBy('order','desc')
        ->where('title', 'like', "%$search%")
        ->orWhere('slug', 'like', "%$slugs%")
        ->get();
        
        $product = Product::where('status',1)->where('name', 'like', "%$search%")
        ->orWhere('product_code', 'like', "%$slugs%")
        ->orWhere('slug', 'like', "%$slugs%")
        ->orWhere('description', 'like', "%$search%")
        ->orWhere('content', 'like', "%$search%")->get();
        
        $posts = Post::where('status',1)->where('title', 'like', "%$search%")
        ->orWhere('slug', 'like', "%$slugs%")
        ->orWhere('description', 'like', "%$search%")
        ->orWhere('content', 'like', "%$search%")
        ->OrderBy('created_at','desc')
        ->where('status',1)
        ->where('slug', 'like', "%$search%")
        ->limit(5)
        ->get();
        
        $footerPost = FooterPost::where('status',1)->get();
        
        $hotProducts = DB::table('order_details')
        ->select('products_id', DB::raw('count(products_id) as count'))
        ->groupBy('products_id')
        ->get();
        
        if(Auth::check()){
            $cartlist = Cart::where('user_id',Auth::user()->id)->count();
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            return view('frontend.search', compact('price','range','search','tags','tgs','categories','product','banner','posts','cartlist','cart','footerPost','hotProducts'));
        }
        return view('frontend.search', compact('price','range','search','tags','tgs','categories','product','banner','posts','footerPost','hotProducts'));
    }
    
    
    public function filterSearch(Request $request){
        $search = $request->get('search');
        $slugs = HomeController::convert_vi_to_en($request->get('search'));
        $price=null;
        $range=null;
        $price = $request->get('price');
        $range = $request->get('range');
        $product = Product::where('status',1)->where('name', 'like', "%$search%")
        ->orWhere('slug', 'like', "%$slugs%")
        ->orWhere('description', 'like', "%$search%")
        ->orWhere('content', 'like', "%$search%");
        
        
        if(!empty($price)){
            if(empty($range)){
                if($price==1){
                    $product = $product->orderBy('price')->get();
                }elseif($price==2){
                    $product = $product->orderBy('price', 'DESC')->get();
                }
            }else{
                
            }
        }
        
        if(!empty($range)){
            if(empty($price)){
                if($range==1){
                    $product= Product::
                    where('status',1)->where('name', 'like', "%$search%")->whereBetween('price',[0,200.00])->get();
                }elseif($range==2){
                    $product= Product::
                    where('status',1)->where('name', 'like', "%$search%")->whereBetween('price',[200.00, 500.00])->get();
                }elseif($range==3){
                    $product= Product::
                    where('status',1)->where('name', 'like', "%$search%")->whereBetween('price',[500.00,1000.00])->get();
                }elseif($range==4){
                    $product= Product::
                    where('status',1)->where('name', 'like', "%$search%")->where('price','>=', 1000.00)->get();
                }
            }
        }
        if(!empty($price)&&!empty($range)){
            $product=$product->orderBy('price')->get();
            
            $price=null;
            $range=null;
        }elseif(empty($range)&& empty($price)){
            $product=$product->get();
        }
        // dd($product);
        
        $banner = Banner::all();
        
        //hotTags in index
        $tags = Tag::all()->sortByDesc('views')->take(6);
        //hot tags in footer
        $tgs = Tag::all()->sortByDesc('views')->take(12);
        
        $categories = ProductCategory::where('status','=',1)
        ->OrderBy('order','desc')
        ->where('title', 'like', "%$search%")
        ->orWhere('slug', 'like', "%$slugs%")
        ->get();
        
        $posts = Post::where('status',1)->where('title', 'like', "%$search%")
        ->orWhere('slug', 'like', "%$slugs%")
        ->orWhere('description', 'like', "%$search%")
        ->orWhere('content', 'like', "%$search%")
        ->OrderBy('created_at','desc')
        ->where('status',1)
        ->where('slug', 'like', "%$search%")
        ->limit(5)
        ->get();
        
        $footerPost = FooterPost::where('status',1)->get();
        
        $hotProducts = DB::table('order_details')
        ->select('products_id', DB::raw('count(products_id) as count'))
        ->groupBy('products_id')
        ->get();
        
        if(Auth::check()){
            $cartlist = Cart::where('user_id',Auth::user()->id)->count();
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            return view('frontend.search', compact('range', 'price','search','tags','tgs','categories','product','banner','posts','cartlist','cart','footerPost','hotProducts', 'search'));
        }
        return view('frontend.search', compact('range', 'price','search','tags','tgs','categories','product','banner','posts','footerPost','hotProducts', 'search'));
    }
    
    
    function convert_vi_to_en($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = preg_replace('/[^A-Za-z0-9 ]/', '', $str);
        $str = preg_split('/\s+/', $str);
        $str = implode('-',$str);
        return $str;
    }
}   