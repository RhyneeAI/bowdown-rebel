<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index() 
    {
        return view('web.home');
    }
    public function shop()
    {
        return view('web.shop');
    }
    public function detail()
    {
        return view('web.shop_detail');
    }
    public function about()
    {
        return view('web.about');
    }

}