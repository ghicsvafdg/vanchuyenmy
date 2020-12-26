<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\FooterPost;
use App\Models\Cart;
use App\Models\Tag;
use App\Models\ProductCategory;

class PostController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //get latest post
        $latestPost = Post::where('status',1)->OrderBy('created_at','desc')->limit(5)->get();

        $post = Post::where('slug',$slug)->first();
        $footerPost = FooterPost::where('status',1)->get();
        $comment = Comment::where('post_id', $post->id)->orderBy('created_at','desc')->get();

        //get posts in cate
        $postInCategory = Post::where([['status',1],['category',$post->category]])->get();

        //hotTags in index
        $tags = Tag::all()->sortByDesc('views')->take(6);
        //hot tags in footer
        $tgs = Tag::all()->sortByDesc('views')->take(12);

        //get all active categogies
        $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
                                        ->OrderBy('order','desc')->get();
        
        if(Auth::check()){
            
            $user_id = Auth::user()->id;
            $user_name =User::find($user_id)->username;

            //get all comment of a post
           
            $cartlist = Cart::where('user_id',Auth::user()->id)->count();
            $cart = Cart::where('user_id',Auth::user()->id)->get();

            // return dd($user_id);
            return view('frontend.detailPost', compact('post','categories','latestPost','postInCategory','tags','tgs','cartlist','cart', 'user_id', 'user_name', 'comment','footerPost'));
        }
        return view ('frontend.detailPost',compact('post','categories','latestPost','postInCategory','tags','tgs','comment','footerPost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
