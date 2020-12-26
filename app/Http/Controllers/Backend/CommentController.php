<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->role == 0) {
            $comment = Comment::where('post_id')->get();
            $product = Product::all();

            return view('backend.comment', compact('comment', 'product'));
        } else {
            return redirect('home');
        }
    }

    public function post_comment()
    {
        if (Auth::check() && Auth::user()->role == 0) {
            $comment = Comment::where('product_id')->get();
            return view('backend.post_comment', compact('comment'));
        } else {
            return redirect('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->role == 0) {
            $post_id = $request->post_id;
            $product_id =$request->product_id;
            $user = Comment::create([
                'post_id'=>$post_id,
                'product_id'=>$product_id,
                'user_id'=> Auth::user()->id,
                'content'=> $request->content,
            ]);
            return back();
        }
        return back()->with('error', 'Bạn cần đăng nhập để comment');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!(Auth::check() && Auth::user()->role == 0)) {
            return redirect()->route('index');
        }
        $comment = Comment::find($id);
        $comment->delete();
        // return redirect('manage-tag')->with('success', 'Xóa thẻ tag thành công!');
        return back()->with('success', 'Xóa comment thành công!');
    }
}
