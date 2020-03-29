<?php

namespace App\Http\Controllers;

use App\Resource;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Session;
use Purifier;

use App\Http\Requests;

class ResourceController extends Controller
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
        // get currently logged in user groups
        $groups = Auth::user()->groups;

        if(isset($groups['items']) && count($groups['items']) > 3) {
            $group_ids = [];
            foreach ($groups['items'] as $item) {
                $group_ids[] = $item['attributes']['id'];
            }

            // Load all resources belonging to all groups user belongs to
            $resources = Resource::whereIn('id', $group_ids)
                ->where('parent_id', NULL)
                ->get();

        }

        // sort resources based on group and get the top most heirarchy for heirarchy

        //pass sorted resource to selected loaded view

        $roles = Role::all();
        $users = User::orderBy('id','desc')->paginate(10);
        return view('users.admin.index')->withUsers($users)->withRoles($roles)->withCategories($roles);
    }

    public function search(Request $request)
    {
        //$users = User::whereRaw("concat(firstname, ' ', lastname) like '%?%'", [$request->name])->paginate(10);
        $users = User::where(DB::raw("concat(firstname, ' ', lastname)") , 'like' , '%'.$request->name.'%')
                        ->orWhere(DB::raw("concat(lastname, ' ', firstname)") , 'like' , '%'.$request->name.'%')
                        ->orWhere(DB::raw("concat(lastname, firstname)") , 'like' , '%'.$request->name.'%')
                        ->orWhere(DB::raw("concat(firstname, lastname)") , 'like' , '%'.$request->name.'%')
                        ->orderBy('lastname')->paginate(10);
        $roles = Role::all();
        return view('users.admin.index')->withUsers($users)->withRoles($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::all();
        return view('users.admin.create')->withRoles($roles);
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
          'roles' => 'required',
          'firstname' => 'required|max:255',
          'lastname' => 'required|max:255',
          'email' => 'required|email|max:255|unique:users',
          'password' => 'required|min:6|confirmed',
        ]);

        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        foreach ($request->roles as $role) {
            # code...
            $user->attachRole($role);
        }

        Session::flash('success',' New user added!');
        return redirect()->route('users.show',$user->id);
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
        $user = User::find($id);
        return view('users.admin.show')->withUser($user);
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
        $user = User::find($id);

        $roles = Role::all();
        $rols = [];
        foreach ($roles as $role){
            $rols[$role->id] = $role->name;
        }

        return view('users.admin.edit')->withUser($user)->withRoles($rols);
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
        $user =  User::find($id);
        $this->validate($request,[
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'roles' => 'required',
        ]);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->save();

        if(isset($request->roles)) {
            $user->roles()->sync($request->roles, true);
        } else{
            $user->roles()->sync(array());
        }

        Session::flash('success',' User Details Updated!');
        return redirect()->route('users.show',$user->id);
    }

    public function userUpdate(Request $request, $id)
    {
        $user =  User::find($id);
        $this->validate($request,[
          'firstname' => 'required|max:255',
          'lastname' => 'required|max:255',
        ]);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->save();

        foreach ($request->roles as $role) {
          # code...
          $user->attachRole($role);
        }

        Session::flash('success',' Profile updated!');
        return redirect()->route('users.show',$user->id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =  User::find($id);
        $user->roles()->delete();

        $user->delete();

        Session::flash('success',' User deleted!');
        return redirect()->route('users.index');
    }
}
