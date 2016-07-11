<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Image as Img;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Session;

use App\Http\Requests;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::orderBy('id','desc')->paginate(10);
        return view('blog.admin.posts.index')->withPosts($posts)->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('blog.admin.posts.create')->withCategories($categories);
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
        $this->validate($request,[
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;

        $post->save();

        if(isset($request->categories)) {
            $post->categories()->sync($request->categories, false);
        } else{
            $post->categories()->sync(array());
        }

        $images = $request->file('images');
        if(isset($images)){
            $filePath = 'img/posts/'.$post->id.'/';
            File::makeDirectory(public_path($filePath));
            foreach ($images as $image){
                $filename = $image->getClientOriginalName();
                //Image::make($image)->resize(500,500)->save(public_path($filePath.$filename));
                Image::make($image)->save(public_path($filePath.$filename));

                $img = new Img;
                $img->name = $filename;
                $post->images()->save($img);
            }
        }

        Session::flash('success','blog post successfully saved!');
        //or
        //session()->flash('success','blog post successfully saved!');
        return redirect()->route('posts.show',$post->id);
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
        $post = Post::find($id);
        return view('blog.admin.posts.show')->withPost($post);
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
        $post = Post::find($id);

        $categories = Category::all();
        $cats = [];
        foreach ($categories as $category){
            $cats[$category->id] = $category->name;
        }

        return view('blog.admin.posts.edit')->withPost($post)->withCategories($cats);
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
        $post =  Post::find($id);
        $this->validate($request,[
            'title' => 'required|max:255',
            'body' => 'required'
        ]);


        $post->title = $request->title;
        $post->body = $request->body;

        $post->save();

        if(isset($request->categories)) {
            $post->categories()->sync($request->categories, true);
        } else{
            $post->categories()->sync(array());
        }

        $images = $request->file('images');
        if(isset($images)){
            //empty folder before updating
            $filePath = 'img/posts/'.$post->id.'/';
            File::cleanDirectory(public_path($filePath));

            //delete file names from database
            $post->images()->delete();

            //recreate directory if deleted
            if(!File::exists(public_path($filePath))) {
                // path does not exist
                File::makeDirectory(public_path($filePath));
            }

            foreach ($images as $image){
                $filename = $image->getClientOriginalName();
                //Image::make($image)->resize(600,300)->save(public_path($filePath.$filename));
                Image::make($image)->save(public_path($filePath.$filename));

                $img = new Img;
                $img->name = $filename;
                $post->images()->save($img);
            }
        }

        Session::flash('success','blog post successfully edited!');
        //or
        //session()->flash('success','blog post successfully saved!');
        return redirect()->route('posts.show',$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post =  Post::find($id);
        $post->delete();

        Session::flash('success','Post deleted!');
        return redirect()->route('posts.index');
    }
}