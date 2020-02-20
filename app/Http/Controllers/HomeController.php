<?php

namespace App\Http\Controllers;

use App\Complain;
use App\Department;
use App\Property;
use App\User;
use Illuminate\Http\Request;
use Auth;
class HomeController extends BackendController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(  );
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['breadcrumbs'] = [
            [
                'title' => 'Dashboard',
                'url' => 'home',
            ]
        ];
        $data['citizens']=User::where('role','Citizens')->count();
        $data['departments']=Department::all()->count();
        if(Auth::user()->role=="Admin"){
            $data['properties']=Property::all()->count();
        }else{
            $data['properties']=Property::where('user_id',Auth::user()->id)->count();
        }
        if(Auth::user()->role=="Admin"){
            $data['complains']=Complain::all()->count();
        }else{
            $data['complains']=Property::where('user_id',Auth::user()->id)->count();
        }

        view()->share('page_title', 'Dashboard');
        return view('dashboard',$data);
    }
}
