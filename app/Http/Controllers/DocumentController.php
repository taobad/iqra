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

        $data = [
            'classes' => Classes::all(),
            'documentTypes' => DocumentType::all()
        ];

        return view('documents.index')->withDocuments($documents)->with($data);
    }

    public function search(Request $request)
    {
        $query = [];
        if($request->name && $request->name != '') {
            $query[] = ['name','LIKE','%'.$request->name.'%'];
        }
        if($request->class_id && $request->class_id != '') {
            $query[] = ['class_id','=',$request->class_id];
        }
        if($request->document_type_id && $request->document_type_id != '') {
            $query[] = ['document_type_id','LIKE',$request->document_type_id];
        }

        if(empty($query))
            $documents = Document::orderBy('id')->paginate(10);
        else
            $documents = Document::where($query)->paginate(10);

        $data = [
            'classes' => Classes::all(),
            'documentTypes' => DocumentType::all()
        ];
        return view('documents.index')->withDocuments($documents)->with($data);
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
        $document =  Document::find($id);
        $document->delete();

        Session::flash('success',' Document successfully deleted!');
        return redirect()->route('documents.index');
    }
}
