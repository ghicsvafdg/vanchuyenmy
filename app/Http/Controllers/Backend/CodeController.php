<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date_from = null;
        $date_to = null;
        $role = null;
        $date = null;
        if (Auth::check() && Auth::user()->role == 0) {
            $i = 1;
            $code= Code::all()->sortByDesc('created_at');
            return view('backend.code', compact('code', 'i', 'date_from', 'date_to', 'role', 'date'));
        } else {
            return redirect('index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        return view('backend.createCode');
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

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date("Y/m/d");

        if (date('Y/m/d', strtotime(str_replace('/', '-', $request->date))) < $date) {
            return back()->with('error', 'Ngày hết hạn giảm giá không phù hợp');
        }

        $request->validate([
            'code' => 'unique:codes|regex:/^[a-z0-9]{0,12}$/i',
            'amount' => 'regex:/^[0-9]*$/',
            'limited' => 'regex:/^[0-9]*$/',
            'use_time' => 'regex:/^[0-9]*$/'
        ]);

        Code::create([
            'code'=> $request->code,
            'role'=> $request->role,
            'amount'=> $request->amount,
            'limited' => $request->limited,
            'use_time'=> $request->use_time,
            'end_time' => $request->date,
            'created_user' => Auth::user()->username
        ]);
        return redirect()->route('manage-code.create')->with('success', 'Thêm mã giảm giá thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function show(Code $code)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $code = Code::find($id);
        return view('backend.editCode', compact('code'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $code = Code::find($id);
        $code->code = $request->input('code');
        $code->role = $request->input('role');
        $code->amount = $request->input('amount');
        $code->limited = $request->input('limited');
        $code->use_time = $request->input('use_time');
        $code->save();
        return redirect()->route('manage-code.index')->with('success', 'Thay đổi thông tin mã giảm giá thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $code = Code::find($id);
        $code->delete();
        return redirect('manage-code')->with('success', 'Xóa mã thành công!');
    }

    public function filter(Request $request)
    {
        $filter_code = Code::limit(9999999);
        $date_from = null;
        $date_to = null;
        $role = null;
        $date = null;

        if (Auth::check() && Auth::user()->role == 0) {
            $role = $request->get('role');
            $date = $request->get('date_type');

            if (!empty($request->get('date_from'))) {
                $date_from = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_from'))));
                $date_from1 = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('date_from'))));
            }

            if (!empty($request->get('date_to'))) {
                $date_to = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_to'))));
                $date_to1 = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('date_to'))));
            }

            if (!empty($role)) {
                $date = null;
                if ($role == 1) {
                    $filter_code = Code::where('role', 0)->get();
                } elseif ($role == 2) {
                    $filter_code = Code::where('role', 1)->get();
                }
            }

            if (!empty($date)) {
                $role = null;
                //lọc theo ngày hết hạn
                if ($date == 1 &&(!empty($date_to) || !empty($date_from))) {
                    if (empty($date_from)) {
                        $date_to = date('m/d/Y', strtotime(str_replace('/', '-', $request->get('date_to'))));
                        $filter_code = Code::where('end_time', '<=', $date_to)->get();
                    } elseif (empty($date_to)) {
                        $filter_code = Code::where('end_time', '>=', $date_from)->get();
                    } else {
                        $filter_code = Code::whereBetween('end_time', [$date_from,$date_to])->get();
                    }
                }
                //lọc theo ngày tạo
                elseif ($date == 2 &&(!empty($date_to1) || !empty($date_from1))) {
                    if (empty($date_from1)) {
                        $filter_code = Code::where('created_at', '<=', $date_to1)->get();
                        $date_to = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_to'))));
                    // dd($filter_code);
                    } elseif (empty($date_to1)) {
                        // dd($date_from);
                        $filter_code = Code::where('created_at', '>=', $date_from1)->get();
                        $date_from = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_from'))));
                    } else {
                        $filter_code = Code::whereBetween('created_at', [$date_from1,$date_to1])->get();
                        $date_to = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_to'))));
                        $date_from = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_from'))));
                    }
                }
            }

            if (empty($role) && empty($date)) {
                $filter_code = Code::all();
            }

            if ($role == 3 || $date == 3) {
                $filter_code = Code::all();
            }

            $i = 1;
            $code = $filter_code;
            return view('backend.code', compact('code', 'i', 'date_from', 'date_to', 'role', 'date'));
        } else {
            return redirect('home');
        }
    }
}
