<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\FooterPost;
use App\Models\Tag;
use App\Models\ProductCategory;
class OrderController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        if (Auth::check()) {
            $status = null;
            $date_from = null;
            $date_to = null;
            $footerPost = FooterPost::where('status',1)->get();
            
            //hotTags in index
            $tags = Tag::all()->sortByDesc('views')->take(6);
            //hot tags in footer
            $tgs = Tag::all()->sortByDesc('views')->take(12);

            //get all active categogies
            $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
                                            ->OrderBy('order','desc')->get();
            
            $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->first();
            $cartlist = Cart::where('user_id',Auth::user()->id)->count();
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            
            return view ('frontend.checkout',compact('tags','tgs','categories','cart','cartlist','order','footerPost', 'status', 'date_from', 'date_to'));
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
        if (Auth::check()) {
            //hotTags in index
            $tags = Tag::all()->sortByDesc('views')->take(6);

            //hot tags in footer
            $tgs = Tag::all()->sortByDesc('views')->take(12);

            //get all active categogies
            $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
                                            ->OrderBy('order','desc')->get();
            
            $footerPost = FooterPost::where('status',1)->get();
            $cartlist = Cart::where('user_id',Auth::user()->id)->count();
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            $bill = Order::findOrFail($id);
            return view ('frontend.bill',compact('tags','tgs','categories','bill','cartlist','cart','footerPost'));
        }
        return redirect()->route('login');
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
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
        if(Auth::check()){
            $order = Order::find($id);
            $status= $order->status;
            if($status !=5){
                $order->status=5;
                $order->save();
                return back()->with('success', 'Đã hủy đơn hàng thành công');
            }else{
                return back()->with('error', 'Trạng thái hiện tại của đơn hàng: Đã hủy');
            }
            
        }
        return redirect()->route('login');
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        
        if(Auth::check()){
            $status = Order::where('id', $id)->first();
            $status= $status->status;
            // return dd($status);
            if($status==5){
                $footerPost = FooterPost::where('status',1)->get();
                $cartlist = Cart::where('user_id',Auth::user()->id)->count();
                $cart = Cart::where('user_id',Auth::user()->id)->get();
                $bill = Order::findOrFail($id);
                $order=Order::find($id);
                $order->delete();
                return back()->with('success','Xóa đơn hàng thành công');
            }else{
                return back()->with('error', 'Chỉ có thể xóa được đơn hàng đã hủy');
            }
        }
        return redirect()->route('login');
    }
    
    public function filter(Request $request)
    {
        $status=null;
        $date_from=null;
        $date_to =null;
        if(Auth::check()){
            
            $status = $request->get('status');
            
            if(!empty($request->get('date_from')))
            {
                $date_from1 = date('Y-m-d',strtotime(str_replace('/','-',$request->get('date_from'))));
                $date_from = date('d/m/Y',strtotime(str_replace('/','-',$request->get('date_from'))));
            }
            
            if(!empty($request->get('date_to')))
            {
                $date_to1 = date('Y-m-d',strtotime(str_replace('/','-',$request->get('date_to'))));
                $date_to = date('d/m/Y',strtotime(str_replace('/','-',$request->get('date_to'))));
            }
            
            
            if(!empty($status)){
                $list_status=Order::all()->where('user_id', Auth::user()->id)->where('status', $status);
            }
            else{
                $list_status = Order::where('user_id', Auth::user()->id);
            }
            
            
            
            if(!empty($date_to1) || !empty($date_from1))
            {
                if(empty($date_from1))
                {
                    // dd($date_to);
                    $list_status = Order::where('user_id', Auth::user()->id)->where('created_at','<=' ,$date_to1)->get();
                    $date_to = date('d/m/Y',strtotime(str_replace('/','-',$request->get('date_to'))));
                    // dd($list_status);
                }elseif(empty($date_to1))
                {
                    // dd($date_from);
                    $list_status = Order::where('user_id', Auth::user()->id)->where('created_at','>=',$date_from1)->get();
                    $date_from= date('d/m/Y',strtotime(str_replace('/','-',$request->get('date_from'))));
                }else
                {
                    $list_status = Order::where('user_id', Auth::user()->id)->whereBetween('created_at',[$date_from1,$date_to1])->get();
                    $date_to = date('d/m/Y',strtotime(str_replace('/','-',$request->get('date_to'))));
                    $date_from= date('d/m/Y',strtotime(str_replace('/','-',$request->get('date_from'))));
                }
            }
            elseif(empty($date_from)&&empty($date_to)&&empty($status))
            {
                $list_status = Order::where('user_id', Auth::user()->id)->get();
                // $date_from=null;
                // $date_to =null;
            }
            
            $footerPost = FooterPost::where('status',1)->get();
            
            $order = $list_status;
            
            //hotTags in index
            $tags = Tag::all()->sortByDesc('views')->take(6);
            //hot tags in footer
            $tgs = Tag::all()->sortByDesc('views')->take(12);

            //get all active categogies
            $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
                                            ->OrderBy('order','desc')->get();
            
            $cartlist = Cart::where('user_id',Auth::user()->id)->count();
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            
            return view ('frontend.orderList',compact('tags','tgs','categories','cart','cartlist','order','footerPost', 'date_from', 'date_to',  'status'));
            
        }
        return redirect()->route('login');
    }
}
