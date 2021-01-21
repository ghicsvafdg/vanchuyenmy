<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->role == 0) {
            $categories = ProductCategory::where('parent_id', '=', 0)->orderBy('order', 'desc')->get();
            $allCategories = ProductCategory::all();
            return view('backend.productCategory', compact('categories', 'allCategories'));
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
        return view('backend.productCategory');
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

        $request->validate([
            'title' => 'required|unique:product_categories|regex:/^[A-Za-z0-9 ]+$/',
        ]);
        $title = $request->get('title');

        $slug = ProductCategoryController::convert_vi_to_en($title);

        if ($request->hasfile('filename')) {
            $name = $request->file('filename')->getClientOriginalName();
            $request->file('filename')->move(public_path() . '/images/', $name);
        } else {
            $name = null;
        }
        $category = new ProductCategory([
            'icon' => $request->get('icon'),
            'title' => $title,
            'filename' => $name,
            'parent_id' => $parent,
            'order' => $request->get('order'),
            'slug'  => $slug,
        ]);
        $category->save();
        return redirect('manage-product-category')->with('success', 'Thêm mới danh mục sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $category = ProductCategory::find($id);
        $categories = ProductCategory::all();
        if ($category->parent_id != 0) {
            $cate = ProductCategory::where('id', $category->parent_id)->first();
            return view('backend.editProductCate', compact('category', 'categories', 'cate'));
        }
        return view('backend.editProductCate', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $category = ProductCategory::find($id);
        $parent = $request->get('parent_id');
        $cate = ProductCategory::where('id', '=', $parent)->first();

        $slug = ProductCategoryController::convert_vi_to_en($request->get('title'));
        if ($request->hasfile('filename')) {
            $name = $request->file('filename')->getClientOriginalName();
            $request->file('filename')->move(public_path() . '/images/', $name);
            $category->filename = $name;
        }
        if (!($cate === null) && $cate->parent_id != 0) {
            return back()->with('error', 'Danh mục sản phẩm tồn tại tối đa 2 cấp!');
        }
        $category->title = $request->input('title');
        $category->parent_id = $request->get('id');
        $category->icon = $request->get('icon');
        $category->order = $request->get('order');
        $category->status = $request->get('status');
        $category->slug = $slug;
        $category->save();
        return redirect()->route('manage-product-category.index')->with('success', 'Thay đổi thông tin danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $parent = ProductCategory::findOrFail($id);
        $child =  ProductCategory::where('parent_id', $id)->count();
        if ($child>0) {
            ProductCategory::where('parent_id', $parent->id)->delete();
            return redirect('manage-product-category')->with('success', 'Xóa danh mục thành công!');
        } else {
            $parent->delete();
            return redirect('manage-product-category')->with('success', 'Xóa danh mục thành công!');
        }
    }
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
