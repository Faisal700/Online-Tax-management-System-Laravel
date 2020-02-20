<?php

namespace App\Http\Controllers;

use App\Complain;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class BackendController extends Controller
{
    public $alerts;
    public $complainss;
    function __construct()
    {
        $this->alerts=Payment::where('seen',0)
            ->get();
        $this->complainss=Complain::where('seen',0)
            ->get();
        view()->share('alerts', $this->alerts);
        view()->share('complainss', $this->complainss);
    }
}
