<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->role == 0) {
            $categories = PostCategory::where('parent_id', '=', 0)->orderBy('order', 'asc')->get();
            return view('backend.postCategory', compact('categories'));
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
        return view('backend.PostCategory');
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
        $parent = $request->get('parent_id');
        $category = PostCategory::where('id', '=', $parent)->first();
        $order = $request->get('order');
        $getOrder = PostCategory::where('order', '=', $order)->first();
        if (!($getOrder === null)) {
        }
        if (!($category === null) && $category->parent_id != 0) {
            return back()->with('error', 'Danh mục bài viết tồn tại tối đa 2 cấp!');
        }

        $request->validate([
            'title' => 'required',
        ]);
        $title = $request->get('title');
        $category = new PostCategory([
            'title' => $title,
            'parent_id' => $parent,
            'order' => $request->get('order'),
            'slug'  => $title,
        ]);
        $category->save();
        return redirect('manage-post-category')->with('success', 'Thêm mới danh mục bài viết thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function show(PostCategory $postCategory)
    {
//        return $postCategory;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $category = PostCategory::find($id);
        $categories = PostCategory::all();
        if ($category->parent_id != 0) {
            $cate = PostCategory::where('id', $category->parent_id)->first();
            return view('backend.editPostCate', compact('category', 'categories', 'cate'));
        }
        return view('backend.editPostCate', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $category = PostCategory::find($id);
        $parent = $request->get('parent_id');
        $cate = PostCategory::where('id', '=', $parent)->first();

        if (!($cate === null) && $cate->parent_id != 0) {
            return back()->with('error', 'Danh mục sản phẩm tồn tại tối đa 2 cấp!');
        }
        $category->title = $request->input('title');
        $category->parent_id = $request->get('id');
        $category->order = $request->get('order');
        $category->save();
        return redirect()->route('manage-post-category.index')->with('success', 'Thay đổi thông tin danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $parent = PostCategory::findOrFail($id);
        $child =  PostCategory::where('parent_id', $id)->count();
        $findPost = Post::where('category', $id)->first();

        if (!($findPost === null)) {
            return back()->with('error', 'Cần xóa hết bài viết thuộc danh mục mới có thể xóa danh mục');
        }
        if ($child > 0) {
            PostCategory::where('parent_id', $parent->id)->delete();
            return redirect('manage-post-category')->with('success', 'Xóa danh mục thành công!');
        } else {
            $parent->delete();
            return redirect('manage-post-category')->with('success', 'Xóa danh mục thành công!');
        }
    }
}
