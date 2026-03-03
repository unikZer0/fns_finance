<?php

namespace App\Http\Controllers\HeadOfFinance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlansCtrl extends Controller
{
    public function plans()
    {
        return view('head_of_finance.plans');
    }
}
