<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class EditController extends BaseController{
    public function index(User $user){
        $roles = Role::all();
        return view("admin.user.changeRole", ["user"=> $user, "roles"=> $roles]);
    }

    public function edit(Request $request, User $user){
        $data = $request->roles;
        $this->service->edit($data, $user);
        return redirect()->route('admin.user.index');
    }
}