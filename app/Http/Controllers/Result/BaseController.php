<?php

namespace App\Http\Controllers\Result;
use App\Http\Controllers\Controller;
use App\Services\Result\Service;

class BaseController extends Controller{
    public $service;
    public function __construct(Service $service){
        $this->service = $service;
    }
}