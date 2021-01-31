<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->role == 0) {
            $banner = Banner::all();
            return view('backend.banner', compact('banner'));
        }
        return redirect()->route('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->role == 0) {
            return view('backend.createBanner');
        }
        return redirect()->route('index');
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

        $section = $request->get('section');
        $checkNumberBanners = Banner::where('section', $section)->count();

        if ($checkNumberBanners >= 5 && $request->get('section') == 1) {
            return back()->with('error', 'Khu vực 1 chỉ tối đa 5 banner');
        } elseif ($checkNumberBanners >= 4 && $request->get('section') == 2) {
            return back()->with('error', 'Khu vực 2 chỉ tối đa 4 banner');
        } elseif ($checkNumberBanners >= 1 && $request->get('section') == 3) {
            return back()->with('error', 'Khu vực 3 chỉ tối đa 1 banner');
        } elseif ($checkNumberBanners >= 1 && $request->get('section') == 4) {
            return back()->with('error', 'Khu vực 4 chỉ tối đa 1 banner');
        } elseif ($checkNumberBanners >= 2 && $request->get('section') == 5) {
            return back()->with('error', 'Khu vực 5 chỉ tối đa 2 banner');
        } elseif ($checkNumberBanners >= 5 && $request->get('section') == 6) {
            return back()->with('error', 'Khu vực 6 chỉ tối đa 5 banner');
        }

        if ($request->hasfile('filename')) {
            $image = $request->file('filename');
            $name = $image->getClientOriginalName();
            $image->move(public_path() . '/banner/', $name);

            $form = new Banner();
            $form->filename = $name;
            $form->name = $request->get('name');
            $form->section = $request->get('section');
            $form->web_link = $request->get('link');
            $form->save();

            return back()->with('success', 'Thêm banner thành công!');
        }
        return back()->with('error', 'Banner cần có ít nhất một ảnh mô tả hoặc mỗi ảnh dung lượng không quá 2MB');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->role == 0) {
            $banner = Banner::find($id);
            return view('backend.editBanner', compact('banner'));
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
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }

        $section = $request->get('section');
        $checkNumberBanners = Banner::where('section', $section)->count();

        if ($checkNumberBanners >= 5 && $request->get('section') == 1) {
            return back()->with('error', 'Khu vực 1 chỉ tối đa 5 banner');
        } elseif ($checkNumberBanners >= 4 && $request->get('section') == 2) {
            return back()->with('error', 'Khu vực 2 chỉ tối đa 4 banner');
        } elseif ($checkNumberBanners >= 1 && $request->get('section') == 3) {
            return back()->with('error', 'Khu vực 3 chỉ tối đa 1 banner');
        } elseif ($checkNumberBanners >= 1 && $request->get('section') == 4) {
            return back()->with('error', 'Khu vực 4 chỉ tối đa 1 banner');
        } elseif ($checkNumberBanners >= 2 && $request->get('section') == 5) {
            return back()->with('error', 'Khu vực 5 chỉ tối đa 2 banner');
        } elseif ($checkNumberBanners >= 5 && $request->get('section') == 6) {
            return back()->with('error', 'Khu vực 6 chỉ tối đa 5 banner');
        }

        $form = Banner::find($id);
        if ($request->hasfile('filename')) {
            $image = $request->file('filename');
            $name = $image->getClientOriginalName();
            $image->move(public_path() . '/banner/', $name);

            $form->filename = $name;
            $form->name = $request->get('name');
            $form->web_link = $request->get('link');
            $form->save();

            return redirect()->route('manage-banner.index')->with('success', 'Sửa thông tin banner thành công!');
        }
        return back()->with('error', 'Banner cần có ít nhất một ảnh mô tả hoặc mỗi ảnh dung lượng không quá 2MB ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $product = Banner::find($id);
        $product->delete();
        return redirect('manage-banner')->with('success', 'Xóa Banner thành công!');
    }
}
