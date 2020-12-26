<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FooterPost;
use Illuminate\Http\Request;

class FooterPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $post = FooterPost::all();
        $i = 1;
        return view('backend.footerPost', compact('i', 'post'));
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
        return view('backend.createFooterPost');
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

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $rules = ([
            'title' => ['unique:footer_posts']
        ]);
        $this->validate($request, $rules);
        $slugs = FooterPostController::convert_vi_to_en($request->get('title'));
        $post = new FooterPost();
        if ($request->hasfile('filename')) {
            $name = $request->file('filename')->getClientOriginalName();
            $request->file('filename')->move(public_path() . '/images/', $name);
            $post->filename = $name;
        }
        $post->category = $request->get('category');
        $post->title = $request->get('title');
        $post->content = utf8_encode($request->get('content'));
        $post->slug = $slugs;
        $post->status = $request->get('status');
        $post->save();
        return redirect()->route('manage-footer-post.index')->with('success', 'thêm bài viết thành công!');
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
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $post = FooterPost::findOrFail($id);
        return view('backend.editFooterPost', compact('post'));
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
        
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $post = FooterPost::findOrFail($id);

        $slugs = FooterPostController::convert_vi_to_en($request->get('title'));
        if ($request->hasfile('filename')) {
            $name = $request->file('filename')->getClientOriginalName();
            $request->file('filename')->move(public_path() . '/images/', $name);
            $post->filename = $name;
        }
        $post->category = $request->get('category');
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->slug = $slugs;
        $post->status = $request->get('status');
        $post->save();
        return redirect()->route('manage-footer-post.index')->with('success', 'sửa bài viết thành công!');
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
        $post = FooterPost::findOrFail($id)->delete();
        return back()->with('success', 'xóa bài viết thành công');
    }

    //create slug
    public function convert_vi_to_en($str)
    {
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
        $str = implode('-', $str);
        return $str;
    }
}
