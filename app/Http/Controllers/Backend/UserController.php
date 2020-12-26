<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $date_from = null;
        $date_to = null;
        if (Auth::check() && Auth::user()->role == 0) {
            $user = User::all()->sortByDesc('created_at');
            return view('backend.user', compact('user', 'date_from', 'date_to'));
        } else {
            return redirect('index');
        }
    }

    public function create()
    {
        if (Auth::check() && Auth::user()->role == 0) {
            return view('backend.createUser');
        } else {
            return redirect('index');
        }
    }

    public function store(Request $request)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $rules = ([
            'username' => ['required', 'string', 'max:255','regex:/^[a-z0-9._-]{4,16}$/i', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'regex:/^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/i'],
            'password' => ['required', 'string', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,12}$/', 'confirmed']
        ]);
        $this->validate($request, $rules);

        User::create([
            'username'=> $request->username,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'status'=> $request->status,
            'role'=> $request->role,
        ]);
        return redirect()->route('manage-user.create')->with('success', 'Thêm người dùng thành công');
    }

    public function update(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->role == 0) {
            $user = User::find($id);
            $user->role = $request->input('role');
            $user->status = $request->input('status');
            $user->save();
            return redirect()->route('manage-user.index')->with('success', 'Thay đổi thông tin người dùng thành công');
        } else {
            return redirect('index');
        }
    }

    public function edit($id)
    {
        if (Auth::check() && Auth::user()->role == 0) {
            $user = User::find($id);
            return view('backend.editUser', compact('user'));
        } else {
            return redirect('index');
        }
    }

    public function destroy($id)
    {
        // delete
        if (Auth::check() && Auth::user()->role == 0) {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect('manage-user')->with('success', 'Xóa người dùng thành công!');
        } else {
            return redirect('index');
        }
    }

    public function show($id)
    {
        if (Auth::check() && Auth::user()->role == 0) {
            $user = User::find($id);
            // return $user;
            return view('backend.showUser', compact('user'));
        } else {
            return redirect('index');
        }
    }

    public function filter(Request $request)
    {
        $filter_code=User::limit(9999999);
        $date_from=null;
        $date_to =null;

        if (Auth::check() && Auth::user()->role == 0) {
            if (!empty($request->get('date_from'))) {
                $date_from = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_from'))));
                $date_from1 = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('date_from'))));
            }

            if (!empty($request->get('date_to'))) {
                $date_to = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_to'))));
                $date_to1 = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('date_to'))));
            }

            if (!empty($date_from1)||!empty($date_to1)) {
                if (empty($date_from1)) {
                    $filter_code = User::where('created_at', '<=', $date_to1)->get();
                    $date_to = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_to'))));
                } elseif (empty($date_to1)) {
                    $filter_code = User::where('created_at', '>=', $date_from1)->get();
                    $date_from = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_from'))));
                } else {
                    $filter_code = User::whereBetween('created_at', [$date_from1,$date_to1])->get();
                    $date_to = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_to'))));
                    $date_from = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_from'))));
                }
            } elseif (empty($date_from)&&empty($date_to)) {
                $filter_code = User::all();
            }

            $i = 1;
            $user = $filter_code;
            return view('backend.user', compact('user', 'i', 'date_from', 'date_to'));
        } else {
            return redirect('home');
        }
    }
}
