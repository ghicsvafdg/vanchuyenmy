<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\FooterPost;
use App\Models\Tag;
use App\Models\ProductCategory;
class UserController extends Controller
{
    public function show($id)
    {
        if(Auth::check())
        {
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

            $user = User::findOrFail($id);
            return view('frontend.userProfile',compact('tags','tgs','categories','user','cartlist','cart','footerPost'));
        }
        
        return redirect()->route('login');
    }
    public function update(Request $request,$id)
    {
        if(Auth::check())
        {
            
            $request->validate([
                'phone' => ['regex:/(01[2|6|8|9]|03[2|3|4|5|6|7|8|9]|05[6|8|9]|08[1|2|3|4|5|6|9|8]|09[0|1|2|3|4|2|6|7|8|9])+([0-9]{7})\b/'],
                'email' => ['string', 'email', 'max:255','regex:/^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/i'],
            ]);

            $user = User::findOrFail($id);
            
            //check exist email
            if($request->get('email') != null)
            {
                $checkEmail = User::where('email',$request->get('email'))->first();
                if($checkEmail == null)
                {
                    $user->email = $request->get('email');
                }
                else
                {
                    return back()->with('error','Email đã tồn tại');
                }

            }

            $dob = $request->get('dob');
            $user->name = $request->get('name');
            $user->phone = $request->get('phone');
            $user->dob = $dob;
            $user->gender = $request->get('gender');
            $user->save();
    
            return back()->with('success','Cập nhật thông tin của bạn thành công');
        }
        return redirect()->route('login');
    }

    public function edit($id)
    {
        if(Auth::check())
        {
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
            $user = User::findOrFail($id);
            return view('frontend.userChangePassword',compact('tags','tgs','categories','user','cartlist','cart','footerPost'));
        }
        return redirect()->route('login');
    }
    public function updatePassword(Request $request){
        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            return back()->with('error','Nhập mật khẩu hiện tại không đúng');
        }
        //uncomment this if you need to validate that the new password is same as old one

        if(strcmp($request->get('old_password'), $request->get('password')) == 0){
            //Current password and new password are same
            return back()->with("error","Mật khẩu mới không được giống mật khẩu cũ");
        }
        
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,12}$/|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request->get('password'));
        $user->save();
        return back()->with('success', 'Đổi mật khẩu thành công');
    }
}
