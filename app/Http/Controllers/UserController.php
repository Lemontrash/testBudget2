<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getCurrentUser(){
      return Auth::id();
    }
}
