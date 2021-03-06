<?php

namespace App\Http\Controllers;

use App\Models\Districts;
use App\Models\Position;
use App\Models\Provinces;
use App\Models\SubDistricts;
use App\Models\Villages;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',[
            'positions' => Position::all()
        ]);
    }


}
