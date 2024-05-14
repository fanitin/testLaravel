<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\User;

class IndexController extends Controller{
    public function __invoke(){
        try {
            $users = User::paginate(20);
            return view('admin.user.index', ['users' => $users]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Wystąpił błąd: ' . $e->getMessage());
        }
    }
}