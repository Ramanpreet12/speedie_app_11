<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function dashboard(){
        return 'delivery';
    }
    public function profile(){
        return 'profile';
    }
}
