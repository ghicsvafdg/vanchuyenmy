<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Province;
use App\Models\FooterPost;
use App\Models\District;
use App\Models\Ward;
use App\Models\Tag;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
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
        if(Auth::check())
        {
            $footerPost = FooterPost::where('status',1)->get();
            $address = Address::findOrFail($id);
            $provinces = Province::pluck("name","id");
            $cartlist = Cart::where('user_id',Auth::user()->id)->count();
            $cart = Cart::where('user_id',Auth::user()->id)->get();

            //hotTags in index
            $tags = Tag::all()->sortByDesc('views')->take(6);
            //hot tags in footer
            $tgs = Tag::all()->sortByDesc('views')->take(12);
            
            //get all active categogies
            $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
                                            ->OrderBy('order','desc')->get();
            
            return view('frontend.editAddress',compact('tags','tgs','categories','cart','cartlist','address','provinces','footerPost'));
        }
        return redirect()->route('index');
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
        if(Auth::check())
        {
            //validate
            $request->validate([
                'phone' => ['regex:/(01[2|6|8|9]|03[2|3|4|5|6|7|8|9]|05[6|8|9]|08[1|2|3|4|5|6|9|8]|09[0|1|2|3|4|2|6|7|8|9])+([0-9]{7})\b/']
            ]);
            
            //create address
            $province = Province::where('id',$request->get('province'))->first()->name;
            $district = District::where('id',$request->get('district'))->first()->name;
            $ward = Ward::where('id',$request->get('ward'))->first()->name;
            $add = $ward.", ".$district.", ".$province;

            $address = Address::findOrFail($id);
            $address->user_id = Auth::user()->id;
            $address->name = $request->get('name');
            $address->phone = $request->get('phone');
            $address->address = $add;
            $address->note = $request->get('note');
            $address->save();
            return back()->with('success','Thay đổi địa chỉ thành công');
        }
        return redirect()->route('index');
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
