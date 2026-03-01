<?php

namespace App\Http\Controllers\DeputyHeadOfFaculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('deputy_head_of_faculty.home');
    }
}
