<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Worktype;
use App\Models\Work;
use App\Models\Workorder;
use App\Models\CustomerReg;
use App\Models\FreemanResponse;
use App\Models\FreeManReg;
use App\Models\Freeman_book;
use App\Models\Payment;


use Illuminate\Support\Facades\File;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    public function __construct()
    {
        //base url
        $base_url = URL::to('/'); 
        Session::put('base_url',$base_url) ;
        
        //default value
        Session::put('registration_success',0) ; 
        

        //language
        if (Session::has('language')) 
        {
            $language = "";
            $language = Session::get('language');
            if($language =="")
            {
                $language = "en";
                Session::put('language',$language) ;
            }
        }
        ///////////////////////////////////////////
        

    }
    //language
    public function get_pagelanguage()
    {
        $language = "";
        $language = Session::get('language'); 
        if($language =="" || $language =="en")
        {
            $pagelanguage = array();
            $pagelanguage['LG_Login_ID'] = "Login ID";
            $pagelanguage['LG_Password'] = "Password";
            $pagelanguage['LG_Login'] = "Login";
            
            

            return $pagelanguage;
        }
        else
        {
            $pagelanguage = array();
            $pagelanguage['LG_Login_ID'] = "ログインID";
            $pagelanguage['LG_Password'] = "パスワード";
            $pagelanguage['LG_Login'] = "ログイン";
            


            return $pagelanguage;
        }
    }
    public function change_language($lan)
    {
        $pageurl ="";
        if($lan =="en")
        {
            Session::put('language','en') ; 
        }
        else if($lan =="jp"){
            Session::put('language','jp') ;
        }
        //return response()->json('changed');
        return response()->json($lan);
    }
    
    public function get_pageurl($en_url,$jp_url)
    {
        $pageurl ="";
        $language = "";
        $language = Session::get('language'); 
        if($language =="" || $language =="en")
        {
            $language = "en";
            Session::put('language',$language) ; 
            $pageurl  = $en_url;
        }
        else if($language =="jp"){
            $language = "jp";
            Session::put('language',$language) ;
            $pageurl  = $jp_url;
        }

        return $pageurl ;
    }

    //job_provider_panel////////////////////////////////////////////////
    public function job_provider_panel()
    {
        $logger_provider_id = ""; $logger_provider_code = ""; $logger_provider_title = "";

        $logger_provider_id = Session::get('logger_provider_id') ;
        $logger_provider_code = Session::get('logger_provider_code') ;
        $logger_provider_title = Session::get('logger_provider_title') ;
        if($logger_provider_id != "")
        {
            $page =$this->get_pageurl('fontend.en.job_provider_panel','fontend.jp.job_provider_panel');
            $pagelanguage = $this->get_pagelanguage();
            $worktypelist = Worktype::all(); 
            $worklist = Work::where('work_type_id',$worktypelist[0]->id)->get();
            return view($page,compact('pagelanguage','worktypelist','worklist'));
        }
        else
        {
            //go to index()
            return Redirect()->route('/');
        }
    }
    //job_provider_home
    public function job_provider_home()
    {
        $logger_provider_id = ""; $logger_provider_code = ""; $logger_provider_title = "";

        $logger_provider_id = Session::get('logger_provider_id') ;
        $logger_provider_code = Session::get('logger_provider_code') ;
        $logger_provider_title = Session::get('logger_provider_title') ;
        if($logger_provider_id != "")
        {
            $page =$this->get_pageurl('fontend.en.job_provider_panel','fontend.jp.job_provider_panel');
            $pagelanguage = $this->get_pagelanguage();
            $worktypelist = Worktype::all(); 
            $worklist = Work::where('work_type_id',$worktypelist[0]->id)->get();
            return view($page,compact('pagelanguage','worktypelist','worklist'));
        }
        else
        {
            //go to index()
            return Redirect()->route('/');
        }
    }
    //logout from panel
    public function job_provider_logout()
    {  
        Session::forget('logger_provider_id');
        Session::forget('logger_provider_code');
        Session::forget('logger_provider_title');

        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: text/html');
        
        //dd('aaf');
        return Redirect()->route('/');
    }
    //get_worklist
    public function get_worklist($worktypeid)
    {
        $worklist = Work::where('work_type_id',$worktypeid)->get();
        return response()->json(array(
            'worklist' => $worklist,
        ));
    }
    //create_new_Work_order
    public function create_new_Work_order(Request $request)
    {
        $time = strtotime($request->workstart);
        $newdateformate = date('Y-m-d',$time);  
        $currentdate = date('Y-m-d');  
        if($newdateformate >= $currentdate)
        { 
            $id = Workorder::insertGetId([
                'cusid'=>$request->logger_id,
                'worktypeid'=>$request->worktypeid,
                'workid'=>$request->workid,
                'work_place'=>$request->workplace,
                'workstart'=>$request->workstart,
                'startdate'=>$newdateformate,
                'created_at'=>Carbon::now(),
            ]);
            
            return response()->json('saved');  
        }
        else
        {
            return response()->json('Date selection problem');
        }
    }
    //getworkorder
    public function getworkorderlist($logger_id)
    {
        //getworkorder of job provider
        $datebefore = date('Y-m-d', strtotime('-3 days'));
        $workorderlist = Workorder::with('customer','worktype','work')->where('cusid',$logger_id)->where('startdate', '>=', $datebefore)->orderBy('startdate', 'DESC')->get();
        $ids =0;
        $array = array();
        for($i=0;$i<count($workorderlist);$i++)
        {
            if($ids == 0){$ids = $workorderlist[$i]['id'];}
            else{$ids .= ",".$workorderlist[$i]['id'];}
            $array = explode(",", $ids);
        }
        
        $freeman_responselist = FreemanResponse::with('workorder','freeman')->whereIn('workorderid', $array)->get();
        $freeman_booklist = Freeman_book::whereIn('workorderid', $array)->get();
        
        return response()->json(array(
                'workorderlist' => $workorderlist,
                'freeman_responselist' => $freeman_responselist,
                'freeman_booklist' => $freeman_booklist,
            ));
    }
    //get_workorderinfo for edit
    public function get_workorderinfo($workorderid)
    {
        //getworkorder of job provider
        $workorderinfo = Workorder::with('customer','worktype','work')->where('id',$workorderid)->orderBy('startdate', 'ASC')->get();
        return response()->json(array(
                'workorderinfo' => $workorderinfo,
            ));
    }
    //update_Work_order////////////////////
    public function update_Work_order(Request $request)
    {
        $time = strtotime($request->workstart);
        $newdateformate = date('Y-m-d',$time);
        //return response()->json('paisi'); 
        $currentdate = date('Y-m-d');
        if($newdateformate >= $currentdate)
        {
            $id = Workorder::find($request->updateid)->update([
                'worktypeid'=>$request->worktypeid,
                'workid'=>$request->workid,
                'work_place'=>$request->workplace,
                'workstart'=>$request->workstart,
                'startdate'=>$newdateformate,
                'created_at'=>Carbon::now(),
            ]);
            return response()->json('Updated');  
        }
        else
        {
            return response()->json('No data change for update');
        }
    }
    //delete_workorderinfo
    function delete_workorderinfo($workorderid)
    {
        Workorder::where('id',$workorderid)->where('work_status','!=',1)->delete();
        FreemanResponse::where('workorderid',$workorderid)->delete();
        Freeman_book::where('workorderid',$workorderid)->delete();

        return response()->json('Deleted'); 
    }
    //offer_workorder
    function offer_workorder($workorderid)
    { 
        $id = 0; 
        $id = Workorder::find($workorderid)->update([
            'work_status'=>1,
            'updated_at'=>Carbon::now(),
        ]);
        if($id != 0)
        {
            FreemanResponse::where('workorderid',$workorderid)->delete();
            Freeman_book::where('workorderid',$workorderid)->delete();
        }
        return response()->json('offered');
    }
    //offer_cancel
    function offer_cancel($workorderid)
    {  
        $id =0;
        $id = Workorder::find($workorderid)->update([
            'work_status'=>0,
            'updated_at'=>Carbon::now(),
        ]);
        if($id !=0)
        {
            FreemanResponse::where('workorderid',$workorderid)->delete();
            Freeman_book::where('workorderid',$workorderid)->delete();
        }
        return response()->json('offer deleted');
    }
    //show_interested_freemanlist
    function show_interested_freemanlist($logger_id,$workorderid)
    {  
        //getworkorder of job provider
        $freemanResponselist = FreemanResponse::with('workorder','freeman')->where('workorderid',$workorderid)->get();
        $ids =0;
        $array = array();
        for($i=0;$i<count($freemanResponselist);$i++)
        {
            if($ids == 0){$ids = $freemanResponselist[$i]['freemanid'];}
            else{$ids .= ",".$freemanResponselist[$i]['freemanid'];}
            $array = explode(",", $ids);
        }
        
        $freemanlist = FreeManReg::where('status','active')->whereIn('id', $array)->get();
        $freeman_booklist = Freeman_book::where('workorderid',$workorderid)->get();  
        $paymentinfolistoffreeman = Payment::where('workorderid',$workorderid)->get();
        
        return response()->json(array(
                'freemanlist' => $freemanlist,
                'freeman_booklist' => $freeman_booklist,
                'paymentinfolistoffreeman' => $paymentinfolistoffreeman,
        ));
    }
    //book_this_freeman
    function book_this_freeman($freemanid,$workorderid)
    {
        $freeman_booklist = Freeman_book::where('workorderid',$workorderid)->where('freemanid',$freemanid)->get();
        if(count($freeman_booklist)==0)
        {
            Freeman_book::insertGetId([
                'workorderid'=>$workorderid,
                'freemanid'=>$freemanid,
                'book_status'=>0, //0 booked by jobprovider, 1 cancel by freeman
                'created_at'=>Carbon::now(),
            ]);
        }
        else{
            Freeman_book::where('workorderid',$workorderid)->where('freemanid',$freemanid)->update([
                'book_status'=>0,  //0 booked, 1 booking cancel
                'updated_at'=>Carbon::now(),
            ]);
        }

        //get updated information
        $freemanResponselist = FreemanResponse::with('workorder','freeman')->where('workorderid',$workorderid)->get();
        $ids =0;
        $array = array();
        for($i=0;$i<count($freemanResponselist);$i++)
        {
            if($ids == 0){$ids = $freemanResponselist[$i]['freemanid'];}
            else{$ids .= ",".$freemanResponselist[$i]['freemanid'];}
            $array = explode(",", $ids);
        }
        $freemanlist = FreeManReg::where('status','active')->whereIn('id', $array)->get();
        $freeman_booklist = Freeman_book::where('workorderid',$workorderid)->get();  
        return response()->json(array(
                'freemanlist' => $freemanlist,
                'freeman_booklist' => $freeman_booklist,
        ));
    }
    //cancel_this_booking
    function cancel_this_booking($freemanid,$workorderid)
    {
        //delete information
        FreemanResponse::with('workorder','freeman')->where('workorderid',$workorderid)->where('workorderid',$workorderid)->get();
        Freeman_book::where('workorderid',$workorderid)->where('freemanid',$freemanid)->update([
            'book_status'=>1,  //0 booked, 1 booking cancel
            'updated_at'=>Carbon::now(),
        ]);
        //get updated information
        $freemanResponselist = FreemanResponse::with('workorder','freeman')->where('workorderid',$workorderid)->get();
        $ids =0;
        $array = array();
        for($i=0;$i<count($freemanResponselist);$i++)
        {
            if($ids == 0){$ids = $freemanResponselist[$i]['freemanid'];}
            else{$ids .= ",".$freemanResponselist[$i]['freemanid'];}
            $array = explode(",", $ids);
        }    
        $freemanlist = FreeManReg::where('status','active')->whereIn('id', $array)->get();
        $freeman_booklist = Freeman_book::where('workorderid',$workorderid)->get();  
        return response()->json(array(
                'freemanlist' => $freemanlist,
                'freeman_booklist' => $freeman_booklist,
        ));
    }
    //job_provider_profile
    public function job_provider_profile()
    {
        $logger_provider_id = "";
        $logger_provider_id = Session::get('logger_provider_id');
        $logger_provider_title = Session::get('logger_provider_title');
        if($logger_provider_id != "")
        {
            $cusinfo = CustomerReg::find($logger_provider_id); 
            $page =$this->get_pageurl('fontend.en.profile_jobprovider','fontend.jp.profile_jobprovider');
            return view($page, compact('cusinfo'));
        }
        else{
            return Redirect()->route('job_provider_logout');
        }
    }
    //set_workstatus
    public function set_workstatus($workstatus,$workorderid,$freemanid)
    {
        $logger_provider_id = "";
        $logger_provider_id = Session::get('logger_provider_id');
        $logger_provider_title = Session::get('logger_provider_title');  
        if($logger_provider_id != "")
        {
            $paymentrecords = Payment::where('workorderid',$workorderid)->where('freemanid',$freemanid)->get();
            if(count($paymentrecords) == 0)
            {
                Freeman_book::where('workorderid',$workorderid)->where('freemanid',$freemanid)->update([
                    'workstatus'=>$workstatus,
                    'created_at'=>Carbon::now(),
                ]);
                return response()->json('Updated');
            }
        }
    }
    //get_workinfo
    public function get_workinfo($workid)
    {
        //getworkinfo of job provider
        $workinfo = Work::with('worktype')->where('id',$workid)->get();
        return response()->json(array(
                'workinfo' => $workinfo,
            ));
    }
    //cash_money_send
    public function cash_money_send(Request $request)
    {
        $paymentinfo = Payment::where('freemanid',$request->freemanid)->where('workorderid',$request->workorderid)->get();
        
        if(count($paymentinfo)==0)
        {
            Payment::insertGetId([
                'workorderid'=>$request->workorderid,
                'freemanid'=>$request->freemanid,
                'paymethod'=>1, //cash 1, card 0, def 0
                'paystatus'=>0, //0 due, 1 paid
                'created_at'=>Carbon::now(),
            ]);
        }
        
        return response()->json('Request sent to freeman. Please wait for confirmation by freeman.');
    }
    //job_and_payments_info
    public function job_and_payments_info()
    {
        //getworkinfo of job provider
        $workinfo = Work::with('worktype')->get();
        $page =$this->get_pageurl('fontend.en.job_and_payments_info','fontend.jp.job_and_payments_info');
            return view($page, compact('workinfo'));
    }
    //job_provider_workorder_history
    public function job_provider_workorder_history()
    {
        $logger_id = Session::get('logger_provider_id') ;
        //getworkorder of job provider
        $todaydate = date('Y-m-d');
        $workorderlist = Workorder::with('customer','worktype','work')->where('cusid',$logger_id)->where('startdate', '<', $todaydate)->orderBy('startdate', 'DESC')->get();
        //$workorderlist = Workorder::with('customer','worktype','work')->where('cusid',$logger_id)->orderBy('startdate', 'DESC')->get();
        $ids =0;
        $array = array();
        for($i=0;$i<count($workorderlist);$i++)
        {
            if($ids == 0){$ids = $workorderlist[$i]['id'];}
            else{$ids .= ",".$workorderlist[$i]['id'];}
            $array = explode(",", $ids);
        }
        
        $freeman_responselist = FreemanResponse::with('workorder','freeman')->whereIn('workorderid', $array)->get();
        $freeman_booklist = Freeman_book::whereIn('workorderid', $array)->get();
        
        $page =$this->get_pageurl('fontend.en.job_provider_workorder_history','fontend.jp.job_provider_workorder_history');
        return view($page, compact('workorderlist','freeman_responselist','freeman_booklist'));
    }
    //job_provider_workorder_for_history
    public function job_provider_workorder_for_history()
    {
        $logger_id = Session::get('logger_provider_id') ;
        //getworkorder of job provider
        $todaydate = date('Y-m-d');
        $workorderlist = Workorder::with('customer','worktype','work')->where('cusid',$logger_id)->where('startdate', '<', $todaydate)->orderBy('startdate', 'DESC')->get();
        //$workorderlist = Workorder::with('customer','worktype','work')->where('cusid',$logger_id)->orderBy('startdate', 'DESC')->get();
        $ids =0;
        $array = array();
        for($i=0;$i<count($workorderlist);$i++)
        {
            if($ids == 0){$ids = $workorderlist[$i]['id'];}
            else{$ids .= ",".$workorderlist[$i]['id'];}
            $array = explode(",", $ids);
        }
        
        $freeman_responselist = FreemanResponse::with('workorder','freeman')->whereIn('workorderid', $array)->get();
        $freeman_booklist = Freeman_book::whereIn('workorderid', $array)->get();
        
        return response()->json(array(
            'workorderlist' => $workorderlist,
            'freeman_responselist' => $freeman_responselist,
            'freeman_booklist' => $freeman_booklist,
        ));
    }





}