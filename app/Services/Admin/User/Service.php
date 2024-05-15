<?php
namespace App\Services\Admin\User;
use App\Models\User;



class Service{
    public function edit($data, $user){
        $user = User::find($user->id);
        $user->roles()->sync($data);
        $upd = array();
        $upd['editor_id'] = auth()->user()->id;
        $user->update($upd);
        $user->touch();
    }
}