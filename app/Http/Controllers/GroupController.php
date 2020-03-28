<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Session;
use Purifier;

use App\Http\Requests;

class GroupController extends Controller
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
        $groups = Role::all();
        return view('group.index')->withGroups($groups);
    }

    public function search(Request $request)
    {
        //$users = User::whereRaw("display_name like '%?%'", [$request->name])->paginate(10);
        $groups = Role::where(DB::raw("display_name") , 'like' , '%'.$request->name.'%')
                        ->orWhere(DB::raw("name") , 'like' , '%'.$request->name.'%')
                        ->orderBy('name')->paginate(10);
        return view('group.index')->withGroups($groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('group.create');
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
          'name' => 'required|max:255|unique:roles',
          'display_name' => 'required|max:255',
          'description' => 'required|max:255',
        ]);

        $group = new Role();
        $group->name = $request->name;
        $group->display_name = $request->display_name;
        $group->description = $request->description;
        $group->save();

        Session::flash('success',' New Group Added!');
        return redirect()->route('group.show',$group->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Role::find($id);
        return view('group.show')->withGroup($group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Role::find($id);
        return view('group.edit')->withGroup($group);
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
        $group =  Role::find($id);
        $this->validate($request,[
            'display_name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        $group->display_name = $request->display_name;
        $group->description = $request->description;
        $group->save();

        Session::flash('success',' Group Details Updated!');
        return redirect()->route('group.show',$group->id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =  Role::find($id);
        // TODO check is group is not used anywhere before deleting
        $user->roles()->delete();

        $user->delete();

        Session::flash('success',' User deleted!');
        return redirect()->route('group.index');
    }
}
