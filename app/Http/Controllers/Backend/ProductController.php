<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPostTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->role == 0) {
            $product = Product::all();
            $i = 0;
            $categories = ProductCategory::where('parent_id', '=', 0)->orderBy('order', 'asc')->get();
            return view('backend.product', compact('product', 'i', 'categories'));
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
            return route('login');
        }
        $categories = ProductCategory::where('parent_id', '=', 0)->orderBy('order', 'asc')->get();
        $tag = Tag::all();
        return view('backend.createProduct', compact('categories', 'tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect('index');
        }
        $request->validate([
            'category' => 'required:products', 'not_in:0',
            'name' => 'required|unique:products',
        ]);

        $slugs = ProductController::convert_vi_to_en($request->get('name'));

        if ($request->hasfile('filename')) {
            foreach ($request->file('filename') as $image) {
                $name = $image->getClientOriginalName();
                $image->move(public_path() . '/images/', $name);
                $data[] = $name;
            }

            $form = new Product();
            $form->filename = json_encode($data);
            $form->name = $request->get('name');
            $form->category_id = $request->get('category');
            $form->quantity = $request->get('quantity');
            $form->size = $request->get('size');
            $form->color =  $request->get('color');
            $form->price = $request->get('price');
            $form->promotion = $request->get('promotion');
            $form->description = $request->get('description');
            $form->content = $request->get('content');
            $form->status = $request->get('status');
            $form->video = $request->get('video');
            $form->slug = $slugs;
            $form->save();

            //store product_code
            $get = Product::latest('id')->first();
            $get->product_code = "VCM" . date('ymd') . $get->id;
            $get->save();
            $slug = $get->slug;

            //store tags
            if ($request->input('tag')) {
                ProductPostTag::where('products_id', $form->id)->delete();
                foreach ($request->input('tag') as $tag) {
                    $add_tag = new ProductPostTag();
                    $add_tag->tags_id = $tag;
                    $add_tag->products_id = $form->id;
                    $add_tag->save();
                }
            }

            return redirect()->route('manage-product.index', $slug)->with('success', 'Thêm sản phẩm thành công!');
        }
        return back()->with('error', 'Sản phẩm cần có ít nhất một ảnh mô tả hoặc mỗi ảnh dung lượng không quá 2MB ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('login');
        }
        $product = Product::where('id', $id)->first();
        $image = json_decode($product->filename);
        $categories = ProductCategory::where('parent_id', '=', 0)->orderBy('order', 'asc')->get();
        $allTag = Tag::all();
        return view('backend.editProduct', compact('product', 'categories', 'allTag', 'image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect('index');
        }
        $rules = ([
            'category' => ['required:products', 'not_in:0'],
        ]);
        $this->validate($request, $rules);

        $product = Product::find($id);
        $slugs = ProductController::convert_vi_to_en($request->get('name'));

        if ($request->hasfile('filename')) {
            foreach ($request->file('filename') as $image) {
                $name = $image->getClientOriginalName();
                $image->move(public_path() . '/images/', $name);
                $data[] = $name;
            }
            $product->filename=json_encode($data);
        }

        $product->name = $request->get('name');
        $product->category_id = $request->get('category');
        $product->quantity = $request->get('quantity');
        $product->size = $request->get('size');
        $product->color =  $request->get('color');
        $product->price = $request->get('price');
        $product->promotion = $request->get('promotion');
        $product->description = $request->get('description');
        $product->content = $request->get('content');
        $product->video = $request->get('video');
        $product->slug = $slugs;
        $product->status = $request->get('status');
        $product->save();

        //store tags
        if ($request->input('tag') == null) {
            ProductPostTag::where('products_id', $product->id)->delete();
        } else {
            ProductPostTag::where('products_id', $product->id)->delete();
            foreach ($request->input('tag') as $tag) {
                $add_tag = new ProductPostTag();
                $add_tag->tags_id = $tag;
                $add_tag->products_id = $product->id;
                $add_tag->save();
            }
        }
        return redirect()->route('manage-product.index')->with('success', 'Sửa thông tin sản phẩm thành công!');
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
        $product = Product::find($id);
        $product->delete();
        return redirect('manage-product')->with('success', 'Xóa sản phẩm thành công!');
    }

    public function view($id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $product = Product::find($id);
        return view('backend.viewProduct', compact('product'));
    }

    //filter product data
    public function filter(Request $request)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $name = $request->get('name');
        $category = $request->get('category');
        $quan_from = $request->get('quan_from');
        $quan_to = $request->get('quan_to');
        $price_from = $request->get('price_from');
        $price_to = $request->get('price_to');

        $i = 0;
        $pro = Product::limit(999999999);
        if (!empty($name)) {
            $pro->where('name', 'like', "%$name%");
        }

        if (!empty($category)) {
            $pro->where('category_id', '=', $category);
        }

        if (!empty($quan_to) || !empty($quan_from)) {
            if (empty($quan_from)) {
                $pro->whereBetween('quantity', [0,$quan_to]);
            } elseif (empty($quan_to)) {
                $pro->whereBetween('quantity', [$quan_from,999999]);
            } else {
                $pro->whereBetween('quantity', [$quan_from,$quan_to]);
            }
        }

        if (!empty($price_to) || !empty($price_from)) {
            if (empty($price_from)) {
                $pro->whereBetween('price', [0,$price_to]);
            } elseif (empty($price_to)) {
                $pro->whereBetween('price', [$price_from,999999]);
            } else {
                $pro->whereBetween('price', [$price_from,$price_to]);
            }
        }
        $product = $pro->get();
        $categories = ProductCategory::where('parent_id', '=', 0)->orderBy('order', 'asc')->get();
        return view('backend.searchResult', compact('product', 'i', 'categories'));
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
