<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worktype;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class WorkTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function checkvaliduser()
    {
        $validuser = "";
        $validuser = Session::get('validuser');  
        if($validuser =="" || $validuser ==0)
        { 
            echo '<div style="width:300px;padding:20px;min-height:100px;margin:0 auto;border:1px solid #ccc;text-align:center;margin-top:15%;"><br>Token Missing or Invalid';
            echo '<br><br>Go to &nbsp;<a href="'.route('home').'">Dashboard</a>&nbsp; and set user token number</div>';exit;
        }
        //$this->checkvaliduser();
    }
    
    

    //All Category View
    public function view()
    { 
        //$this->checkvaliduser();
        //get all data from categories table
        $worktypes = Worktype::orderby('id','asc')->latest()->get();  
        return view('backend.admin.worktype.view_worktype', compact('worktypes'));
    }

    

    

    


}
