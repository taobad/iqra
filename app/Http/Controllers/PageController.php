<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{
    //
    public function getIndex(){
        /*$news = Category::orderBy('categories.id','desc')->join('posts', 'categories.id', '=', 'posts.category_id')
            ->where('name','=','News')->take(5)->get();
        $awards = Category::orderBy('categories.id','desc')->join('posts', 'categories.id', '=', 'posts.category_id')
            ->where('name','=','Awards')->take(5)->get();
        $events = Category::orderBy('categories.id','desc')->join('posts', 'categories.id', '=', 'posts.category_id')
            ->where('name','=','Events')->take(5)->get();*/

        $newss = Category::where('name','News')->first();
        $news = Category::find($newss->id)->posts()->orderBy('created_at','desc')->take(5)->get();

        $awardss = Category::where('name','Awards')->first();
        $awards = Category::find($awardss->id)->posts()->orderBy('created_at','desc')->take(5)->get();

        $eventss = Category::where('name','Events')->first();
        $events = Category::find($eventss->id)->posts()->orderBy('created_at','desc')->take(5)->get();

        return view('pages.home')->withNewss($news)->withAwards($awards)->withEvents($events);
    }

    public function getCalendar()
    {
        return view('pages.calendar');
    }

    public function getNews()
    {
        $postss = Category::where('name','News')->first();
        $posts = Category::find($postss->id)->posts()->paginate(5);
        return view('blog.index')->withPosts($posts);
    }
    public function getAbout()
    {
        return view('pages.about');
    }

    public function getContact()
    {
        return view('pages.contact');
    }

    public function getEvents()
    {
        $postss = Category::where('name','Events')->first();
        $posts = Category::find($postss->id)->posts()->orderBy('created_at','desc')->paginate(5);
        return view('blog.index')->withPosts($posts);
    }

    public function getAwards()
    {
        $postss = Category::where('name','Awards')->first();
        $posts = Category::find($postss->id)->posts()->orderBy('created_at','desc')->paginate(5);
        return view('blog.index')->withPosts($posts);
    }

    public function getSingle($id){
        //$post = Post::where('slug','=',$slug)->first();
        $post = Post::find($id);
        return view('blog.single')->withPost($post);
    }

    public function getCategories($id){
        $category = Category::find($id);
        $posts = $category->posts()->orderBy('created_at','desc')->paginate(5);
        return view('blog.category')->withCategory($category)->withPosts($posts);
    }
}
