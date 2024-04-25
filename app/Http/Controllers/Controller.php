<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    // use AuthorizesRequests, ValidatesRequests;

    public function index() {
        $active = 'dashboard';
        return view('dashboard', compact('active'));
    }

    public function product() {
        $active = 'product';
        return view('create_product', compact('active'));
    }
}
