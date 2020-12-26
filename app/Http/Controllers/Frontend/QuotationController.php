<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Province;
use App\Models\District;
use App\Models\File;
use App\Models\Ward;
use App\Models\Quotation;
use App\Models\FooterPost;
use App\Models\Tag;
use App\Models\ProductCategory;
class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::pluck("name","id");
        $footerPost = FooterPost::where('status',1)->get();
        $fileSubmit = File::where('status',1)->orderBy('created_at','desc')->first();

        //hotTags in index
        $tags = Tag::all()->sortByDesc('views')->take(6);
        //hot tags in footer
        $tgs = Tag::all()->sortByDesc('views')->take(12);

        //get all active categogies
        $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
                                        ->OrderBy('order','desc')->get();
            
        if(Auth::check())
        {
            
            $cartlist = Cart::where('user_id',Auth::user()->id)->count();
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            
            return view ('frontend.quotation',compact('tags','tgs','categories','cart','cartlist','provinces','footerPost','fileSubmit'));
        }
        return view ('frontend.quotation',compact('tags','tgs','categories','provinces','footerPost','fileSubmit'));
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
        //set time zone
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        
        //validation
        $request->validate([
            'phone' => ['regex:/(01[2|6|8|9]|03[2|3|4|5|6|7|8|9]|05[6|8|9]|08[1|2|3|4|5|6|9|8]|09[0|1|2|3|4|2|6|7|8|9])+([0-9]{7})\b/'],
            'email' => ['regex:/^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/i']
        ]);

        //create address
        $province = Province::where('id',$request->get('province'))->first()->name;
        $district = District::where('id',$request->get('district'))->first()->name;
        $ward = Ward::where('id',$request->get('ward'))->first()->name;
        $add = $request->get('address').", ".$ward.", ".$district.", ".$province;

        $quotation = new Quotation;
        if ($request->hasFile('filename')) {
            $file = $request->filename;
            $file->move('file', $file->getClientOriginalName());
            $quotation->filename = $file->getClientOriginalName();
        }
        $quotation->link_product = $request->get('link');
        $quotation->product_name = $request->get('name');
        $quotation->product_info = $request->get('description');
        $quotation->address = $add;
        $quotation->username = $request->get('username');
        $quotation->phone = $request->get('phone');
        $quotation->email = $request->get('email');
        $quotation->save();
        return back()->with('success','Gửi yêu cầu thành công. Ban quản trị sẽ trả lời trong vòng 1 tiếng');
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
        //
    }
}
