<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
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
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if(Auth::check()){
            $user = Comment::create([
                'post_id'=> $request->post_id,
                'product_id'=> $request->product_id,
                'user_id'=> Auth::user()->id,
                'rating_star' => $request->rate,
                'content'=> $request->content,
            ]);

            $comment = Comment::where('product_id', $request->product_id)->get();
            $sumStar = 0;
            foreach($comment as $cmt)
            {
                $sumStar = $sumStar + $cmt->rating_star;
            }
            $product = Product::findOrFail($request->product_id);
            $product->star = round($sumStar/$comment->count(),1);
            $product->save();

            return back()->with('success','Bình luận thành công!');
        }
        
        return back()->with('error','Bạn cần đăng nhập để comment');
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
    public function destroy(Comment $comment)
    {
        //
    }
}
