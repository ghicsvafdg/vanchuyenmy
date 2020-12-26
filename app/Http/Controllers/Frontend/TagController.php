<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductPostTag;
use App\Models\FooterPost;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use App\Models\ProductCategory;
class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //hotTags in index
        $tags = Tag::all()->sortByDesc('views')->take(6);
        //hot tags in footer
        $tgs = Tag::all()->sortByDesc('views')->take(12);

        //get all active categogies
        $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
                                        ->OrderBy('order','desc')->get();
            
        //all tags
        $tag = Tag::where('slug',$slug)->first();
        $tag->views = $tag->views +1;
        $tag->save();
        //get products and posts by tag
        $product = ProductPostTag::where([['tags_id',$tag->id],['posts_id',null]])->paginate(12);
        
        $posts = ProductPostTag::where([['tags_id',$tag->id],['products_id',null]])->paginate(12);

        $footerPost = FooterPost::where('status',1)->get();
        if(Auth::check()){
            
            $cartlist = Cart::where('user_id',Auth::user()->id)->count();
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            return view('frontend.tag',compact('tags','tgs','categories','product','posts','tag','cartlist','cart','footerPost'));
        }
        return view ('frontend.tag',compact('tags','tgs','categories','product','posts','tag','footerPost'));
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
