<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{
    //
    protected $news = 'News';
    protected $awards = 'Awards';
    protected $events = 'Events';

    public function getIndex(){
        /*$news = Category::orderBy('categories.id','desc')->join('posts', 'categories.id', '=', 'posts.category_id')
            ->where('name','=','News')->take(5)->get();
        $awards = Category::orderBy('categories.id','desc')->join('posts', 'categories.id', '=', 'posts.category_id')
            ->where('name','=','Awards')->take(5)->get();
        $events = Category::orderBy('categories.id','desc')->join('posts', 'categories.id', '=', 'posts.category_id')
            ->where('name','=','Events')->take(5)->get();*/

        //$newss = Category::where('name','News')->first();
        //$news = Category::find($newss->id)->posts()->orderBy('created_at','desc')->take(5)->get();

        $news = Post::whereHas('categories', function ($query){
            $query->where('name',$this->news);
        })->orderBy('created_at','desc')->take(5)->get();

        $awards = Post::whereHas('categories', function ($query){
            $query->where('name',$this->awards);
        })->orderBy('created_at','desc')->take(5)->get();

        $events = Post::whereHas('categories', function ($query){
            $query->where('name',$this->events);
        })->orderBy('created_at','desc')->take(5)->get();

        return view('pages.home')->withNewss($news)->withAwards($awards)->withEvents($events);
    }

    public function getCalendar()
    {
        return view('pages.calendar');
    }

    public function getNews()
    {
        $posts = Post::whereHas('categories', function ($query){
            $query->where('name',$this->news);
        })->orderBy('created_at','desc')->paginate(10);
        return view('blog.public.index')->withPosts($posts);
    }

    public function getEvents()
    {
        $posts  = Post::whereHas('categories', function ($query){
            $query->where('name',$this->events);
        })->orderBy('created_at','desc')->paginate(10);
        return view('blog.public.index')->withPosts($posts);
    }

    public function getAwards()
    {
        $posts = Post::whereHas('categories', function ($query){
            $query->where('name',$this->awards);
        })->orderBy('created_at','desc')->paginate(10);
        return view('blog.public.index')->withPosts($posts);
    }

    public function getAbout()
    {
        return view('pages.about');
    }

    public function getContact()
    {
        return view('pages.contact');
    }

    public function getSingle($id){
        $post = Post::find($id);
        return view('blog.public.single')->withPost($post);
    }

    public function getCategories($id){
        $category = Category::find($id);
        $posts = $category->posts()->orderBy('created_at','desc')->paginate(10);
        return view('blog.public.category')->withCategory($category)->withPosts($posts);
    }
}
