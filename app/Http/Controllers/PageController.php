<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Mail;
use Session;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

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

    public function postContact(Request $request)
    {
        $this->validate($request,[
          'email'=>'required|email',
          'message' => 'min:10',
          'subject' => 'min:10'
          ]);

        $data = array(
          'email' => $request->email,
          'bodyMessage' => $request->message,
          'subject' => $request->subject
        );
        Mail::send('emails.contact', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('badmustaofeeq@gmail.com');
            $message->subject($data['subject']);
        });
        Session::flash('success',' Email was sent successfully!');
        return redirect()->route('contact.get');
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

    public function getRegister(){
        return view('auth.register');
    }


    public function postRegister(Request $request)
    {
        //
        $this->validate($request,[
          'name' => 'required|max:255',
          'email' => 'required|email|max:255|unique:users',
          'password' => 'required|min:6|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $user->roles()->attach('User');

        Session::flash('success',' New user added!');
        return redirect('/');
    }

    public function getSliderImages(){
        return view('pages.uploadSliderImg');
    }


    public function postSliderImages(Request $request)
    {
          //
          $this->validate($request,[
              'images' => 'required',
              'images.*' => 'image|mimes:jpg,jpeg'
          ]);

          $images = $request->file('images');
          $imageEmpty = array_filter($images);

          if(!(empty($imageEmpty))){
              //$images = $request->file('images');
              $filePath = 'img/home_slider/';
              File::cleanDirectory(public_path($filePath));

              //recreate directory if deleted
              if(!File::exists(public_path($filePath))) {
                  // path does not exist
                  File::makeDirectory(public_path($filePath));
              }
              $i = 1;
              foreach ($images as $image){
                  $filename = 'iq_'.$i.'.jpeg';//.$image->getClientOriginalExtension();
                  //Image::make($image)->resize(500,500)->save(public_path($filePath.$filename));

                  Image::make($image)->save(public_path($filePath.$filename));
                  $i++;
              }
          }

          Session::flash('success',' Homepage slide images successfully changed!');
          return redirect()->route('home');
    }
}
