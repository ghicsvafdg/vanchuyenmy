<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Jobs\Promotion;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->role == 0) {
            $user = User::all();
            return view('backend.userPromotion', compact('user'));
        } else {
            return redirect('index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $getUserEmail = $request->get('getEmail');
        foreach ($getUserEmail as $mail) {
            if ($mail === null) {
                return redirect()->route('manage-promotion.index')->with('error', "<b>Không thể gửi mail!</b><br>Trong danh sách lựa chọn có tài khoản không có mail<br>Vui lòng kiểm tra lại");
            }
        }
        return view('backend.createMail', compact('getUserEmail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        
        $email = $request->get('email');
        $title = $request->get('title');
        $content = $request->get('content');
        Promotion::dispatch($email, $title, $content);

        return redirect()->route('manage-promotion.index')->with('success', 'Gửi mail tới khách hàng thành công');
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

    public function filter(Request $request)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        
        $user_temp = Order::select('user_id');
        $customer = $request->get('username');
        if ($request->get('option') == 1) {
            if ($customer != null) {
                $user = DB::table('users')->select('users.*')
                    ->where('username', 'like', "%$customer%")
                    ->orWhere('email', 'like', "%$customer%")
                    ->whereIn('id', $user_temp)
                    ->get();
            } else {
                $user = DB::table('users')->select('users.*')
                    ->whereIn('id', $user_temp)
                    ->get();
            }
        } elseif ($request->get('option') == 2) {
            if ($customer != null) {
                $user = DB::table('users')->select('users.*')
                    ->where('username', 'like', "%$customer%")
                    ->orWhere('email', 'like', "%$customer%")
                    ->whereNotIn('id', $user_temp)
                    ->get();
            } else {
                $user = DB::table('users')->select('users.*')
                    ->whereNotIn('id', $user_temp)
                    ->get();
            }
        } elseif ($request->get('option') == 3) {
            if ($customer != null) {
                $user = DB::table('users')->select('users.*')
                    ->where('username', 'like', "%$customer%")
                    ->orWhere('email', 'like', "%$customer%")
                    ->get();
            } else {
                $user = DB::table('users')->select('users.*')
                    ->get();
            }
        }

        return view('backend.searchPromotion', compact('user'));
    }
}
