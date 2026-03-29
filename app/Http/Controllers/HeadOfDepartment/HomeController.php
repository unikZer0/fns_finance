<?php

namespace App\Http\Controllers\HeadOfDepartment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('head_of_department.home');
    }
}
