<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Code;
use App\Models\Province;
use App\Models\District;
use App\Models\Order;
use App\Models\Ward;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use App\Models\FooterPost;
use App\Models\Tag;
use App\Models\ProductCategory;


class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if(!Auth::check())
        {
            return redirect()->route('login');
        }
        //hotTags in index
        $tags = Tag::all()->sortByDesc('views')->take(6);
        //hot tags in footer
        $tgs = Tag::all()->sortByDesc('views')->take(12);

        //get all active categogies
        $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
                                    ->OrderBy('order','desc')->get();

        $cartlist = Cart::where('user_id',Auth::user()->id)->count();

        $cart = Cart::where('user_id',Auth::user()->id)->get();
        if(!($cart->count() > 0))
        {
            return back()->with('error','Không có sản phẩm nào trong giỏ hàng');
        }
        foreach($cart as $ct)
        {
            if($ct->proInCart->quantity < $ct->quantity)
            {
                return back()->with('error',"<b>{$ct->proInCart->name}</b> <br> không đủ trong kho, vui lòng thay đổi số lượng hoặc xóa sản phẩm");
            }
        }

        $user = User::where('id',Auth::user()->id)->first();

        $code = Code::where('code',$request->get('voucher'))->first();

        $footerPost = FooterPost::where('status',1)->get();

        $provinces = Province::pluck("name","id");

        $sum = 0;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        
        return view('frontend.payment',compact('tags','tgs','categories','provinces','user','cartlist','cart','sum','footerPost'));
    }

    public function getDistrictList(Request $request)
    {
        $districts = District::where("province_id",$request->province_id)->pluck("name","id");
        return response()->json($districts);
    }

    public function getWardList(Request $request)
    {
        $wards = Ward::where("district_id",$request->district_id)->pluck("name","id");
        return response()->json($wards);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        if(Auth::check())
        {   
            $footerPost = FooterPost::where('status',1)->get();
            $address = Address::where('user_id',Auth::user()->id)->get();

            //hotTags in index
            $tags = Tag::all()->sortByDesc('views')->take(6);
            //hot tags in footer
            $tgs = Tag::all()->sortByDesc('views')->take(12);

            //get all active categogies
            $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
                                        ->OrderBy('order','desc')->get();
                                    
            $cartlist = Cart::where('user_id',Auth::user()->id)->count();
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            return view ('frontend.address',compact('tags','tgs','categories','cart','cartlist','address','footerPost'));
        }
        return redirect()->route('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */

    //store order when users haven't had address yet
    public function store(Request $request)
    {
        //hotTags in index
        $tags = Tag::all()->sortByDesc('views')->take(6);
        //hot tags in footer
        $tgs = Tag::all()->sortByDesc('views')->take(12);

        //get all active categogies
        $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
                                    ->OrderBy('order','desc')->get();
                                    
        $cartlist = Cart::where('user_id',Auth::user()->id)->count();
        $cart = Cart::where('user_id',Auth::user()->id)->get();

        $user = User::where('id',Auth::user()->id)->first();

        $code = Code::where('code',$request->get('voucher'))->first();

        $footerPost = FooterPost::where('status',1)->get();

        $provinces = Province::pluck("name","id");

        $sum = 0;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        switch($request->input('action'))
        {
            case 'voucher':
                {
                    
                    $name = $request->get('name');
                    $note = $request->get('note');
                    
                    $phone = $request->get('phone');
                    $code = Code::where('code',$request->get('voucher'))->first();

                    //get address
                    $province = Province::where('id',$request->get('province'))->first();
                    $district = District::where('id',$request->get('district'))->first();
                    $ward = Ward::where('id',$request->get('ward'))->first();

                    //get payment method
                    $method = $request->get('method');

                    if (!empty($code)) {
                        $checkCode = Order::where([['user_id',Auth::user()->id],
                                                ['voucher','like',"$code->code%"]])->first();
                        //validate voucher
                        if ($checkCode) {
                            return view('frontend.payment',compact('code','method','province','district','ward','name',
                                                            'note','tags','tgs','phone','sum','cartlist','cart','user',
                                                            'footerPost','provinces','categories'),
                                    ['error'=>'Bạn đã sử dụng mã giảm giá']);
                        } elseif ($code->use_time == 0) {
                            return view('frontend.payment',compact('code','method','province','district','ward','name',
                                                            'note','tags','tgs','phone','sum','cartlist','cart','user',
                                                            'footerPost','provinces','categories'),
                                    ['error'=>'Mã giảm giá đã hết lượt dùng']);
                        } elseif (date('Y-m-d',strtotime(str_replace('/','-',$code->end_time))) < date("Y-m-d")) {
                            return view('frontend.payment',compact('code','method','province','district','ward','name',
                                                            'note','tags','tgs','phone','sum','cartlist','cart','user',
                                                            'footerPost','provinces','categories'),
                                    ['error'=>'Mã giảm giá đã hết hạn sử dụng']);
                        } elseif ($code->limited > $request->get('price')) {
                            return view('frontend.payment',compact('code','method','province','district','ward','name',
                                                            'note','tags','tgs','phone','sum','cartlist','cart','user',
                                                            'footerPost','provinces','categories'),
                                    ['error'=>'Giá trị đơn hàng chưa đủ để sử dụng mã giảm giá này']);
                        }
                        return view('frontend.payment',compact('categories','code','method','province','district','ward','name','note','tags','tgs','phone','sum','cartlist','cart','user','footerPost','provinces'));
                    } else {
                        return view('frontend.payment',compact('code','method','province','district','ward','name',
                                                        'note','tags','tgs','phone','sum','cartlist','cart','user',
                                                        'footerPost','provinces','categories'),
                                                        ['error'=>'Mã giảm giá không tồn tại']);
                    }
                }
            case 'paymoney':
                {
                    //validate
                    $request->validate([
                        'phone' => ['regex:/(01[2|6|8|9]|03[2|3|4|5|6|7|8|9]|05[6|8|9]|08[1|2|3|4|5|6|9|8]|09[0|1|2|3|4|2|6|7|8|9])+([0-9]{7})\b/']
                    ]);
                    
                    //create address
                    if ($request->get('provincess') != null && $request->get('districtt') != null && $request->get('wardd') != null) {
                        $province = Province::where('id',(int)$request->get('provincess'))->first()->name;
                        $district = District::where('id',(int)$request->get('districtt'))->first()->name;
                        $ward = Ward::where('id',(int)$request->wardd)->first()->name;
                        $add = $ward.", ".$district.", ".$province;
                    }
                    else if($request->get('province') != null && $request->get('district') != null && $request->get('ward') != null) {
                        $province = Province::where('id',(int)$request->get('province'))->first()->name;
                        $district = District::where('id',(int)$request->get('district'))->first()->name;
                        $ward = Ward::where('id',(int)$request->ward)->first()->name;
                        $add = $ward.", ".$district.", ".$province;
                    } else {
                        return back()->with('error','Vui lòng điền toàn bộ ô trống');
                    }
                    
                    //user info
                    $user = User::where('id', Auth::user()->id)->first();
                    $user->name = $request->get('name');
                    $user->phone = $request->get('phone');
                    $user->save();
        
                    //user address detail save
                    $address = new Address();
                    $address->user_id = Auth::user()->id;
                    $address->name = $request->get('name');
                    $address->phone = $request->get('phone');
                    $address->address = $add;
                    $address->note = $request->get('note');
                    $address->save();
        
                    //get the address id
                    $ad = Address::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->first();

                    //create order
                    $code = date('ymdHis');
                    $order = new Order();
                    $order->order_code = $code;
                    $order->user_id = Auth::user()->id;
                    $order->name = $request->get('name');
                    $order->phone = $request->get('phone');
                    $order->address = $ad->note.', '.$ad->address;
                    $order->form = $request->get('method');              //get payment method
                    $order->voucher = $request->get('code');
                    $order->price = $request->get('price');
                    $order->save();
        
                    //reduce 1 using time of voucher
                    $voucher = Code::where('code',$request->get('code'))->first();
                    if(isset($voucher))
                    {
                        $voucher->use_time = $voucher->use_time - 1;
                        $voucher->save();
                    }
        
                    //order product detail
                    $orderCode = Order::where('order_code',$code)->first()->id;
                    
                    //check cart is empty
                    if(empty($request->carts))
                    {
                        return back()->with('error','Không có sản phẩm nào trong giỏ <br> không thể đặt hàng');
                    }
                    //store product from cart into order
                    foreach($request->carts as $cart_id)
                    {
                        $cart = Cart::findOrFail($cart_id); 
                        $orderProducts = new OrderDetail;
        
                        $orderProducts->orders_id = $orderCode;
                        $orderProducts->products_id = $cart->product_id;
                        $orderProducts->color = $cart->color;
                        $orderProducts->size = $cart->size;
                        $orderProducts->quantity = $cart->quantity;
                        $orderProducts->save();
                    }
                    Cart::where('user_id',Auth::user()->id)->delete();

                    //for sending mail
                    $user = $request->get('gmail');
                    $getOrder = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->first();
                    $getOrderDetail = OrderDetail::where('orders_id',$getOrder->id)->get();
                    Mail::to($user)->send(new MailNotify($getOrder,$getOrderDetail));

                    return redirect()->route('don-hang.index')->with('success','Đặt hàng thành công!');
                }  
        }
           
        return redirect()->route('login');
    }

    //store order when user already have address
    public function save(Request $request)
    {
        //hotTags in index
        $tags = Tag::all()->sortByDesc('views')->take(6);
        //hot tags in footer
        $tgs = Tag::all()->sortByDesc('views')->take(12);

        //get all active categogies
        $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
                                    ->OrderBy('order','desc')->get();
                                    
        $cartlist = Cart::where('user_id',Auth::user()->id)->count();
        $cart = Cart::where('user_id',Auth::user()->id)->get();

        $user = User::where('id',Auth::user()->id)->first();
       
        $footerPost = FooterPost::where('status',1)->get();
        
        $sum = 0;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        switch($request->input('action'))
        {
            case 'voucher':
                {
                    $code = Code::where('code',$request->get('voucher'))->first();

                    //get payment method
                    $method = $request->get('method');

                    $add = Address::where('id',$request->get('address'))->first();

                    if(isset($code))
                    {
                        $checkCode = Order::where([['user_id',Auth::user()->id],
                                                ['voucher','like',"$code->code%"]])->first();

                        //validate voucher
                        if($checkCode)
                        {
                            return view('frontend.payment',compact('categories','code','add','tgs','method','sum','cartlist','cart','user','footerPost'),
                                    ['error'=>'Bạn đã sử dụng mã giảm giá']);
                            
                        }elseif($code->use_time == 0)
                        {
                            return view('frontend.payment',compact('categories','code','add','tgs','method','sum','cartlist','cart','user','footerPost'),
                                    ['error'=>'Mã giảm giá đã hết lượt dùng']);

                        }elseif(date('Y-m-d',strtotime(str_replace('/','-',$code->end_time))) < date("Y-m-d"))
                        {
                            
                            return view('frontend.payment',compact('categories','code','add','tgs','method','sum','cartlist','cart','user','footerPost'),
                                    ['error'=>'Mã giảm giá đã hết hạn sử dụng']);

                        }elseif($code->limited > $request->get('price'))
                        {
                            return view('frontend.payment',compact('categories','code','add','tgs','method','sum','cartlist','cart','user','footerPost'),
                                    ['error'=>'Giá trị đơn hàng chưa đủ để sử dụng mã giảm giá này']);
                        }

                        return view('frontend.payment',compact('categories','code','add','tgs','method','sum','cartlist','cart','user','footerPost'));
                    }else
                    {
                        return view('frontend.payment',compact('categories','code','add','tgs','method','sum','cartlist','cart','user','footerPost'),
                                                        ['error'=>'Mã giảm giá không tồn tại']);
                    }
                }
            case 'paymoney':
                {
                    if(Auth::check())
                    {
                        $add = Address::where('id',$request->get('address'))->first();
                        
                        //order
                        date_default_timezone_set("Asia/Ho_Chi_Minh");
                        $code = date('ymdHis');
                        $order = new Order();
                        $order->order_code = $code;
                        $order->user_id = Auth::user()->id;
                        $order->name = $add->name;
                        $order->phone = $add->phone;
                        $order->address = $add->note.', '.$add->address;
                        $order->price = $request->get('price');
                        $order->form = $request->get('method');
                        $order->save();
            
                        //reduce 1 using time of voucher
                        $voucher = Code::where('code',$request->get('code'))->first();
                        if(isset($voucher))
                        {
                            $voucher->use_time = $voucher->use_time - 1;
                            $voucher->save();
                        }
            
                        //get order id
                        $orderCode = Order::where('order_code',$code)->first()->id;
                        
                        //check cart is empty
                        if(empty($request->carts))
                        {
                            return back()->with('error','Không có sản phẩm nào trong giỏ <br> không thể đặt hàng');
                        }
                        //store product from cart into order
                        foreach($request->carts as $cart_id)
                        {
                            $cart = Cart::findOrFail($cart_id); 
                            $orderProducts = new OrderDetail;
            
                            $orderProducts->orders_id = $orderCode;
                            $orderProducts->products_id = $cart->product_id;
                            $orderProducts->color = $cart->color;
                            $orderProducts->size = $cart->size;
                            $orderProducts->quantity = $cart->quantity;
                            $orderProducts->save();
                        }
                        Cart::where('user_id',Auth::user()->id)->delete();

                        //for sending mail
                        $user = Auth::user()->email;
                        $getOrder = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->first();
                        $getOrderDetail = OrderDetail::where('orders_id',$getOrder->id)->get();
                        Mail::to($user)->send(new MailNotify($getOrder,$getOrderDetail));
             
                        return redirect()->route('don-hang.index')->with('success','Đặt hàng thành công!');
                    }
                break;
                }
        }
        
        return redirect()->route('login');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): \Illuminate\Http\Response
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::check())
        {
            $address = Address::findOrFail($id);
            $address->delete();
            return back()->with('success','Xóa địa chỉ thành công');
        }
    }

    public function createAddress()
    {
        if(Auth::check())
        {
            $provinces = Province::pluck("name","id");
            $footerPost = FooterPost::where('status',1)->get();

            //hotTags in index
            $tags = Tag::all()->sortByDesc('views')->take(6);
            //hot tags in footer
            $tgs = Tag::all()->sortByDesc('views')->take(12);

            //get all active categogies
            $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
                                    ->OrderBy('order','desc')->get();
                                    
            $cartlist = Cart::where('user_id',Auth::user()->id)->count();
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            return view ('frontend.createAddress',compact('tags','tgs','categories','cartlist','cart','provinces','footerPost'));
        }
        return redirect()->route('login');
    }

    public function storeAddressOnly(Request $request)
    {
        if(Auth::check())
        {
            $request->validate([
                'phone' => ['regex:/(01[2|6|8|9]|03[2|3|4|5|6|7|8|9]|05[6|8|9]|08[1|2|3|4|5|6|9|8]|09[0|1|2|3|4|2|6|7|8|9])+([0-9]{7})\b/']
            ]);
            //create address
            $province = Province::where('id',$request->get('province'))->first()->name;
            $district = District::where('id',$request->get('district'))->first()->name;
            $ward = Ward::where('id',$request->get('ward'))->first()->name;
            $add = $ward.", ".$district.", ".$province;

            $address = new Address;
            $address->user_id = Auth::user()->id;
            $address->name = $request->get('name');
            $address->phone = $request->get('phone');
            $address->address = $add;
            $address->note = $request->get('note');
            $address->save();
            return redirect('dia-chi')->with('success','Tạo địa chỉ giao hàng thành công');
        }
        return redirect()->route('login');
    }
}
