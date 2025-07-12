<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        protected CategoryService $service
    ) {}

    public function index() 
    {
        $category = $this->service->getAll();
        return view('web.home')->with([
            'categories' => $category
        ]);
    }

    // 1: 8 + center
    // 2: 6. 6
    // 3: 4, 4, 4
    // 4: 4, 4, 4, 8
}
