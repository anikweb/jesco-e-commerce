<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\{
    Role,
    Permission,
};
use App\Http\Requests\{
    RoleForm,
    AssignUserForm,
    createUserForm,
};
use App\Mail\newAccountCreationMail;
use App\Models\User;
use Illuminate\Support\Facades\{
    Hash,
    Auth,
    Mail,
};
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->can('role management')){
            return view('backend.pages.role.index',[
                "roles" => Role::orderBy('name','asc')->paginate(5),
            ]);
        }else{
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->can('role management')){
            // Permission::create(['name' => 'voucher trash view']);
            // Permission::create(['name' => 'voucher trash restore']);
            // Permission::create(['name' => 'voucher add']);
            // Permission::create(['name' => 'voucher deactivate']);
            // Permission::create(['name' => 'voucher actives view']);
            // Permission::create(['name' => 'voucher deactivates view']);
            // return 'added';
            return view('backend.pages.role.create',[
                'permissions' => Permission::orderBy('name','asc')->get(),
            ]);
        }else{
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleForm $request)
    {
        if(auth()->user()->can('role management')){
            if($request->permissions == ''){
                return back()->with('permissionBlank','Please Choose Permission to create role!');
            }
            $role = Role::create(['name' => $request->name]);
            foreach($request->permissions as $permission){
                $role->givePermissionTo($permission);
            }
            return redirect()->route('role.show',$role->name)->with('success','Role Created!');
        }else{
            return abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        if(auth()->user()->can('role management')){
            // return $id;
            return view('backend.pages.role.show',[
                'role' => Role::where('name',$name)->first(),
            ]);
        }else{
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($name)
    {
        if(auth()->user()->can('role management')){
            return view('backend.pages.role.edit',[
                "permissions" =>Permission::orderBy('name','asc')->get(),
                "role" =>Role::where('name',$name)->first(),
            ]);
        }else{
            return abort(404);
        }
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
        if(auth()->user()->can('role management')){
            // return $request;
            // return $id;
            $role = Role::find($id);
            if($role->syncPermissions($request->permissions)){
                return redirect()->route('role.show',$role->name)->with('success','Role Updated!');
            }else{
                return back()->with('error','Failed!');

            }
        }else{
            return abort(404);
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
        if(auth()->user()->can('role management')){

            $role = Role::find($id);
            session()->put('deleted_role',$role->name);
            foreach($role->permissions as $permissions){
                $role->revokePermissionTo($permissions);
            }
            if($role->delete()){
                return back()->with('success',session()->get('deleted_role').' Role Permanently Deleted');
            }else{
                return back()->with('success',session()->get('deleted_role').' Role Permanently Deleted');
            }
        }else{
            return abort(404);
        }
    }
    public function assignUser(){
        if(auth()->user()->can('role management')){
            return view('backend.pages.role.assign_user',[
                'users' => User::orderBy('name','asc')->get(),
                'usersV' => User::orderBy('name','asc')->paginate(5),
                'roles' =>Role::orderBy('name','asc')->get(),
            ]);
        }else{
            return abort(404);
        }
    }
    public function assignUserPost(AssignUserForm $request){
        if(auth()->user()->can('role management')){
            // return $request;
            $user = User::find($request->user);
            $user->syncRoles($request->role);
            return back();
        }else{
            return abort(404);
        }
    }
    public function createUser(){
        if(auth()->user()->can('role management')){
            return view('backend.pages.role.create_user',[
                "roles" => Role::orderBy('name','asc')->get(),
            ]);
        }else{
            return abort(404);
        }
    }
    public function createUserPost(createUserForm $request){
        if(auth()->user()->can('role management')){
            $password = Str::random(5);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($password),
            ]);
            $user->assignRole($request->role);
            $emailInfo = [
                "name" => $request->name,
                "email" => $request->email,
                "password" => $password,

            ];
            Mail::to($request->email)->send(new newAccountCreationMail($emailInfo));

            return redirect()->route('assign.user')->with('success','User Create Success');

        }else{
            return abort(404);
        }
    }
}
