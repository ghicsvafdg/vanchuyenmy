<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\ProductPostTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
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
        if (Auth::check() && Auth::user()->role == 0) {
            $post = Post::all();
            $categories = PostCategory::all();
            $i = 1;
            return view('backend.post', compact('post', 'i', 'categories', 'date_from', 'date_to'));
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
            return redirect('index');
        }
        $tag = Tag::all();
        $categories = PostCategory::where('parent_id', '=', 0)->orderBy('order', 'asc')->get();
        return view('backend.createPost', compact('categories', 'tag'));
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
            return redirect('index');
        }
        $rules = ([
            'category' => ['required:posts', 'not_in:0'],
            'title' => ['unique:posts'],
        ]);
        $this->validate($request, $rules);

        $slugs = PostController::convert_vi_to_en($request->get('title'));
        $author = Auth::user()->username;
        if ($request->hasfile('filename')) {
            $name = $request->file('filename')->getClientOriginalName();
            $request->file('filename')->move(public_path() . '/images/', $name);
            $form = new Post([
                'category' =>$request->get('category'),
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'content' => $request->get('content'),
                'author' => $author,
                'slug' => $slugs,
                'filename' => $name
            ]);
            $form->save();

            //insert tags for post
            $post = Post::latest('created_at', 'desc')->first();
            if ($request->input('tag')) {
                foreach ($request->input('tag') as $tag) {
                    $add_tag = new ProductPostTag();
                    $add_tag->tags_id = $tag;
                    $add_tag->posts_id = $post->id;
                    $add_tag->save();
                }
            }
            return back()->with('success', 'Thêm mới bài viết thành công!');
        } else {
            return back()->with('error', 'Bài viết cần có ảnh đại diện');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }

        $post = Post::where('id', $id)->first();
        $allTag = Tag::all();
        $categories = PostCategory::where('parent_id', '=', 0)->orderBy('order', 'asc')->get();
        return view('backend.editPost', compact('post', 'allTag', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect('index');
        }
        $rules = ([
            'category' => ['required:posts', 'not_in:0'],
        ]);
        $this->validate($request, $rules);
        $slugs = PostController::convert_vi_to_en($request->get('title'));
        $author = Auth::user()->username;
        $post = Post::find($id);

        if ($request->hasfile('filename')) {
            $name = $request->file('filename')->getClientOriginalName();
            $request->file('filename')->move(public_path() . '/images/', $name);
            $post->filename = $name;
        }

        $post->category = $request->input('category');
        $post->title =  $request->input('title');
        $post->description = $request->input('description');
        $post->content = $request->get('content');
        $post->author = $author;
        $post->slug = $slugs;
        $post->save();

        //store tags
        if ($request->input('tag') == null) {
            ProductPostTag::where('posts_id', $post->id)->delete();
        } else {
            ProductPostTag::where('posts_id', $post->id)->delete();
            foreach ($request->input('tag') as $tag) {
                $add_tag = new ProductPostTag();
                $add_tag->tags_id = $tag;
                $add_tag->posts_id = $post->id;
                $add_tag->save();
            }
        }
        return redirect()->route('manage-post.index')->with('success', 'Sửa thông tin bài viết thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $post = Post::find($id);
        $post->delete();
        return redirect('manage-post')->with('success', 'Xóa bài viết thành công!');
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

    public function filter(Request $request)
    {
        $categories = PostCategory::all();
        $filter_post = Post::limit(9999999);
        $date_from = null;
        $date_to = null;
        if (Auth::check() && Auth::user()->role == 0) {
            $category = $request->get('category');

            if (!empty($request->get('date_from'))) {
                $date_from = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_from'))));
                $date_from1 = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('date_from'))));
            }

            if (!empty($request->get('date_to'))) {
                $date_to = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_to'))));
                $date_to1 = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('date_to'))));
            }

            if (!empty($category)) {
                $filter_post = Post::where('category', $category)->get();
            }

            if (!empty($date_to1) || !empty($date_from1)) {
                if (empty($date_from1)) {
                    $filter_post = Post::where('created_at', '<=', $date_to1)->get();
                    $date_to = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_to'))));
                } elseif (empty($date_to1)) {
                    $filter_post = Post::where('created_at', '>=', $date_from1)->get();
                    $date_from= date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_from'))));
                } else {
                    $filter_post = Post::whereBetween('created_at', [$date_from1,$date_to1])->get();
                    $date_to = date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_to'))));
                    $date_from= date('d/m/Y', strtotime(str_replace('/', '-', $request->get('date_from'))));
                }
            } elseif (empty($date_from)&&empty($date_to)&&empty($category)) {
                $filter_post = Post::all();
            }
            $post = $filter_post;
            $i = 1;
            return view('backend.post', compact('post', 'categories', 'i', 'date_from', 'date_to'));
        } else {
            return redirect('index');
        }
    }
}
