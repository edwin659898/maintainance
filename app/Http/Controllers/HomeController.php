<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;
use App\models\User;
use App\Models\Machines;
use Auth;

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
        $tasks = Calendar::where('user_id','=',auth()->id())->get();
        return view('checklist/dashboard',compact('tasks'));
    }

    public function Nyongoro()
    { 
        $tasks = Calendar::WhereHas('user', function ($query){
            $query->where('site', 'Nyongoro');
        })->get();
        return view('checklist/site-calendar',compact('tasks'));
    }

    public function Dokolo()
    { 
        $tasks = Calendar::where('site','Dokolo')->get();
        return view('checklist/site-calendar',compact('tasks'));
    }

    public function Kiambere()
    { 
        $tasks = Calendar::where('site','Dokolo')->get();
        return view('checklist/site-calendar',compact('tasks'));
    }

    public function Forks()
    { 
        $tasks = Calendar::where('site','7 Forks')->get();
        return view('checklist/site-calendar',compact('tasks'));
    }

    public function HeadOffice()
    { 
        $tasks = Calendar::where('site','Head Office')->get();
        return view('checklist/site-calendar',compact('tasks'));
    }
}
