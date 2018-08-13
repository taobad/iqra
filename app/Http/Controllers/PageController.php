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
    protected $facilities = 'Facilities';
    protected $admissions = 'Admissions';

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
        })->orderBy('eventdate','desc')->take(5)->get();

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

    public function getFacilities()
    {
        $posts = Post::whereHas('categories', function ($query){
            $query->where('name',$this->facilities);
        })->orderBy('created_at','desc')->paginate(10);
        return view('pages.facilities')->withPosts($posts);
    }

    public function getAdmissions()
    {
        $posts = Post::whereHas('categories', function ($query){
            $query->where('name',$this->admissions);
        })->orderBy('created_at','desc')->paginate(10);
        return view('pages.admissions')->withPosts($posts);
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
            $message->to('info@iqracollege.net');
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

    public function getSliderImages(){
        return view('pages.uploadSliderImg');
    }
    
    public function zohoMail(){
        header("Location: https://mail.zoho.eu");
        die();
    }


    public function postSliderImages(Request $request)
    {
          //
          $this->validate($request,[
              'images' => 'required',
              'images.*' => 'image|mimes:jpg,jpeg,png'
          ]);

          $position = $request->position;
          $images = $request->file('images');
          $imageEmpty = array_filter($images);

          if(!(empty($imageEmpty))){
              //$images = $request->file('images');
              $filePath = 'img/home_slider/';
//              File::cleanDirectory(public_path($filePath));

              //recreate directory if deleted
              if(!File::exists(public_path($filePath))) {
                  // path does not exist
                  File::makeDirectory(public_path($filePath));
              }
              $i = 1;
              foreach ($images as $image){
                  $filename = ($position != 'ALL') ? 'iq_'.$position.'.jpeg' : 'iq_'.$i.'.jpeg';

                  if($image->getClientOriginalExtension() == 'jpeg' ){
                    Image::make($image)->resize(1200,400)->save(public_path($filePath.$filename));
                  } else {
                    $jpg = (string) Image::make($image)->encode('jpeg',100)->resize(1200,400)->save(public_path($filePath.$filename));
                  }
                  $i++;
              }
          }

          $message = ($position != 'ALL') ? "Homepage slide image $position changed successfully!": "Homepage slide images changed successfully!";
          Session::flash('success',"$message");
          return redirect()->route('home');
    }
}
