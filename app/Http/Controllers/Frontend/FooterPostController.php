<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FooterPost;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Tag;
use App\Models\ProductCategory;
class FooterPostController extends Controller
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
        $post = FooterPost::where('slug',$slug)->first();
        $footerPost = FooterPost::where('status',1)->get();

        //hotTags in index
        $tags = Tag::all()->sortByDesc('views')->take(6);
        //hot tags in footer
        $tgs = Tag::all()->sortByDesc('views')->take(12);

        //get all active categogies
        $categories = ProductCategory::where([['parent_id', '=', 0],['status','=',1],])
                                        ->OrderBy('order','desc')->get();
        
        if(Auth::check())
        {
            $cartlist = Cart::where('user_id',Auth::user()->id)->count();
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            return view ('frontend.footerPost',compact('tags','tgs','categories','post','cartlist','cart','footerPost'));
        }
        return view ('frontend.footerPost',compact('tags','tgs','categories','post','footerPost'));
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
