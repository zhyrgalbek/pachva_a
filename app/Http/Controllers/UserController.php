<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
    //     $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
    //     $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    //     $this->middleware('permission:profile', ['only' => ['profile']]);
    //     $this->middleware('permission:profile-edit', ['only' => ['profile_edit', 'profile_update']]);
    //     $this->middleware('permission:profile-password', ['only' => ['profile_password', 'profile_update_password']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::orderBy('id', 'desc')->paginate(10);

        Session::put('page', isset($_GET['page']) ? $_GET['page'] : 1);

        return view('users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->get('user_type') == 1) {
            $this->validate($request, [
                'last_name' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'phone' => 'required|string|max:50',
                'identifier' => 'required|string|max:50|unique:users,identifier',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'roles' => 'required'
            ]);
        } else {
            $this->validate($request, [
                'last_name' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'phone' => 'required|string|max:50',
                'phone2' => 'required|string|max:50',
                'identifier' => 'required|string|max:50|unique:users,identifier',
                'organization_name' => 'required|string|max:255|unique:users,organization_name',
                'address' => 'required|string|max:500',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'roles' => 'required'
            ]);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.show', compact('user', 'roles', 'userRole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->get('user_type') == 1) {
            $this->validate($request, [
                'last_name' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'phone' => 'required|string|max:50',
                'identifier' => 'required|string|max:50|unique:users,identifier,' . $id,
                'organization_name' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:500',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8|confirmed',
                'roles' => 'required'
            ]);
        } else {
            $this->validate($request, [
                'last_name' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'phone' => 'required|string|max:50',
                'phone2' => 'required|string|max:50',
                'identifier' => 'required|string|max:50|unique:users,identifier,' . $id,
                'organization_name' => 'required|string|max:255|unique:users,organization_name,' . $id,
                'address' => 'required|string|max:500',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8|confirmed',
                'roles' => 'required'
            ]);
        }

        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        DB::table('model_has_roles')
            ->where('model_id', $id)
            ->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index', ['page' => Session::get('page', 1)])
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect()->route('users.index', ['page' => Session::get('page', 1)])
            ->with('success', 'User deleted successfully.');
    }

    public function profile()
    {

        $user = auth()->user();
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.profile', compact('user', 'roles', 'userRole'));
    }

    public function profile_edit()
    {
        $user = auth()->user();

        return view('users.profileEdit', compact('user'));
    }

    public function profile_password()
    {

        $user = auth()->user();

        return view('users.profilePassword', compact('user'));
    }

    public function profile_update(Request $request)
    {
        $user = auth()->user();
        if ($user->user_type == 1) {
            $this->validate($request, [
                'last_name' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'middle_name' => 'max:255',
                'phone' => 'required|string|max:50',
                'identifier' => 'required|string|max:50|unique:users,identifier,' . $user->id,
                'email' => 'required|email|unique:users,email,' . $user->id,
            ]);
        } else {
            $this->validate($request, [
                'last_name' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'middle_name' => 'max:255',
                'phone' => 'required|string|max:50',
                'phone2' => 'required|string|max:50',
                'identifier' => 'required|string|max:50|unique:users,identifier,' . $user->id,
                'organization_name' => 'required|string|max:255|unique:users,organization_name,' . $user->id,
                'address' => 'required|string|max:500',
                'email' => 'required|email|unique:users,email,' . $user->id,
            ]);
        }

        $input = $request->all();

        $user->update($input);

        return redirect()->route('profile')
            ->with('success', 'Profile updated successfully.');
    }

    public function profile_update_password(Request $request)
    {
        $user = auth()->user();

        $this->validate($request, [
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('profile.password')
            ->with('success', 'Password updated successfully.');
    }
}
