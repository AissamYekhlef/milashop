<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth',[
            'except' => [
                'profile',
                'show',
                'userProfile'
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->q;
        if(isset($search)){
            $users = User::where('name', 'like', '%' . $request->q . '%')->paginate(8);
            $users->appends(['q' => $search]);
        }else{
            $users = User::paginate(8);
        }

        return view('admin.users', ['users'=> $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('register');
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
    public function show($id)
    {
        $user = User::find($id);
        if($user){
            
            return view('profile', ['user' => $user]);

        }
        // TODO User detalis page

        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', ['user'=> $user]);
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
        $user = User::findOrFail($id);

        // TODO update user here
        // dd($request->old_password);
        $user->name = $request->name;
        if ($request->old_password) {
            if (Hash::check($request->old_password, $user->password)) {
                if($request->new_password == $request->confirm_password){
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                }else{
                    return back()->with('error', 'Please, confirm your new password');
                }
                
            }else{
                return back()->with('error', 'incorrect password');
            }
        }
        if ($request->address != null ) {
            $user->address = $request->address;
        }
        if (auth()->user()->is_admin === 1 ) {    
            $user->is_admin = $request->is_admin;
            $user->is_valid = $request->is_valid;
            $user->is_blocked = $request->is_blocked;
        }

        $user->save();

        return view('profile', ['user'=> $user]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        // dd('deleted user');
        $user = User::findOrFail($user);
        if($user->id == 1 || $user->id == 2 || $user->is_admin){
            return back()->with('error', 'Can not delete this User may be he is an admin');
        }else{
            
            $user->delete();
        }
        
        return back();
    }

    public function profile()
    {
        if(auth()->check()){
            $user = auth()->user();
            // dd(
            //     $user->with('files', 'level')
            // );
        }
    }

    public function userProfile(User $user)
    {  
        return view('profile', ['user' => $user]);
    }

}