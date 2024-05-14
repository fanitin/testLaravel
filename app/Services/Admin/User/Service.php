<?php
namespace App\Services\Admin\User;
use App\Models\User;



class Service{
    public function edit($data, $user){
        $user = User::find($user->id);
        $user->roles()->sync($data);
    }
}