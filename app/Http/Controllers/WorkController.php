<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worktype;
use App\Models\Work;
use App\Models\Workorder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class WorkController extends Controller
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
    public function add_form()
    {
        $worktypes = Worktype::orderby('id','asc')->latest()->get();  
        return view('backend.admin.work.add_work',compact('worktypes'));
    }
    //Category Store
    public function store(Request $request)
    {   
        //$this->checkvaliduser();
        //validation  
        $request->validate([
            'work_type_id' => 'required',
            'work_title' => 'required|max:255',
            'charge' => 'required|max:8',
        ]);   

        $id = Work::insertGetId([
            'work_type_id'=>$request->work_type_id,
            'work_title'=>$request->work_title,
            'charge'=>$request->charge,
            'charge_type'=>'0',
            'created_at'=>Carbon::now(),
        ]);
        
        return Redirect()->back()->with('success','Saved Successfully'); 
    }

    //All Category View
    public function view()
    {
        //$this->checkvaliduser();
        //get all data from categories table
        $works = Work::latest()->get();  
        return view('backend.admin.work.view_work', compact('works'));
    }

    //Category edit
    public function edit($id)
    {
        //$this->checkvaliduser();
        $work = Work::find($id);
        $worktypes = Worktype::latest()->get(); 
        return view('backend.admin.work.edit_work', compact('work','worktypes'));
    }

    //Category update
    public function update(Request $request, $id)
    {  
        //$this->checkvaliduser(); 
        //validation  
        $request->validate([
            'work_type_id' => 'required',
            'work_title' => 'required|max:255',
            'charge' => 'required|max:8',
        ]);
        

        Work::find($id)->update([
            'work_type_id'=>$request->work_type_id,
            'work_title'=>$request->work_title,
            'charge'=>$request->charge,
            'charge_type'=>'0',
            'updated_at'=>Carbon::now(),
        ]);
        return Redirect()->back()->with('success','Work updated');
    }

    //Category delete
    public function delete($id)
    {
        //$this->checkvaliduser();

        $workorders = Workorder::where('workid',$id)->get(); 
        if(count($workorders)==0)
        {
            Work::find($id)->delete();
            return Redirect()->back()->with('success','Work Deleted');
        }
        else
        {
            return Redirect()->back()->with('error-msg',"This Work has record, so can't delete");
        }
    }


}
