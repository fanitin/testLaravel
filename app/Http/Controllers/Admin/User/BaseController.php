<?php

namespace App\Http\Controllers\Admin\User;
use App\Http\Controllers\Controller;
use App\Services\Admin\User\Service;

class BaseController extends Controller{
    public $service;
    public function __construct(Service $service){
        $this->service = $service;
    }
}