<?php

namespace App\Http\Controllers;

use App\Category;
use App\Classes;
use App\Document;
use App\DocumentType;
use App\Image as Img;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Session;
use Purifier;

use App\Http\Requests;

class DocumentController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('role:admin')
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::orderBy('id')->paginate(10);
        return view('documents.index')->withDocuments($documents);
    }

    public function search(Request $request)
    {
        $documents = Document::where('name','LIKE','%'.$request->name.'%')->paginate(10);
        return view('documents.index')->withDocuments($documents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'classes' => Classes::all(),
            'documentTypes' => DocumentType::all()
        ];
        return view('documents.create')->with($data);
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
            'name' => 'required|max:255',
            'link' => 'required',
            'document_type_id' => 'required',
            'class_id' => 'sometimes'
        ]);

        $document = new Document();
        $document->name = $request->name;
        $document->link = $request->link;
        $document->document_type_id = $request->document_type_id;
        $document->class_id = $request->class_id;

        $document->save();


        Session::flash('success',' Document successfully saved!');
        return redirect()->route('documents.index',$document->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'document' => Document::find($id),
            'classes' => Classes::all(),
            'documentTypes' => DocumentType::all()
        ];
        return view('documents.edit')->with($data);
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
        $document =  Document::find($id);
        $this->validate($request,[
            'name' => 'required|max:255',
            'link' => 'required',
            'document_type_id' => 'required',
            'class_id' => 'sometimes'
        ]);

        $document->name = $request->name;
        $document->link = $request->link;
        $document->document_type_id = $request->document_type_id;
        $document->class_id = $request->class_id;

        $document->save();


        Session::flash('success',' Document successfully updated!');
        return redirect()->route('documents.index');
    }

    protected function saveImages(array $images, $post, $filePath) {
        foreach ($images as $image){

            $filename = $image->getClientOriginalName();
            $filenamethumb = 'thumbnail'.$filename;

            $image = Image::make($image);
            Storage::put(public_path($filePath.$filename), $image->encode());

            $image_thumb = Image::make($image)->resize(60,40);
            Storage::put(public_path($filePath.$filenamethumb), $image_thumb->encode(), 'public');

            $img = new Img;
            $img->name = $filename;
            $post->images()->save($img);
        }
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
        $post->images()->delete();
        //empty folder before deleting
        $filePath = 'img/posts/'.$post->id.'/';
        File::cleanDirectory(public_path($filePath));
        File::deleteDirectory(public_path($filePath));

        $post->comments()->delete();

        $post->delete();

        Session::flash('success',' Post deleted!');
        return redirect()->route('posts.index');
    }
}
