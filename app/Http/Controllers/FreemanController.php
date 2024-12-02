<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Workorder;
use App\Models\FreemanResponse;
use App\Models\Freeman_book;
use App\Models\FreeManReg;
use App\Models\Payment;
use App\Models\Work;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class FreemanController extends Controller
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
    
    //job_seeker_panel////////////////////////////////////////////////
    public function job_seeker_panel()
    {
        $logger_seeker_id = ""; $logger_seeker_code = ""; $logger_seeker_title = "";

        $logger_seeker_id = Session::get('logger_seeker_id') ;
        $logger_seeker_code = Session::get('logger_seeker_code') ;
        $logger_seeker_title = Session::get('logger_seeker_title') ;
        if($logger_seeker_id != "")
        {
            $page =$this->get_pageurl('fontend.en.job_seeker_panel','fontend.jp.job_seeker_panel');
            $pagelanguage = $this->get_pagelanguage();
            return view($page,compact('pagelanguage'));
        }
        else
        {
            //go to index()
            return Redirect()->route('/');
        }
    }
    //job_seeker_home
    public function job_seeker_home()
    {
        $logger_seeker_id = ""; $logger_seeker_code = ""; $logger_seeker_title = "";

        $logger_seeker_id = Session::get('logger_seeker_id') ;
        $logger_seeker_code = Session::get('logger_seeker_code') ;
        $logger_seeker_title = Session::get('logger_seeker_title') ;
        if($logger_seeker_id != "")
        {
            $page =$this->get_pageurl('fontend.en.job_seeker_panel','fontend.jp.job_seeker_panel');
            $pagelanguage = $this->get_pagelanguage();
            return view($page,compact('pagelanguage'));
        }
        else
        {
            //go to index()
            return Redirect()->route('/');
        }
    }
    //getworkorderlist
    public function getworkorderlist()
    {
        $logger_seeker_id = 0;
        $logger_seeker_id = Session::get('logger_seeker_id') ;  

        $datebefore = date('Y-m-d', strtotime('-3 days'));
        
        if($logger_seeker_id != 0)
        {
            //getworkorder of job provider
            
            $workorderlist = Workorder::with('customer','worktype','work')->where('work_status',1)->where('startdate', '>=', $datebefore)->orderBy('id', 'DESC')->get();  
            $activitylist = FreemanResponse::with('workorder','freeman')->where('freemanid',$logger_seeker_id)->get();
            
            $freemanbookinglist = Freeman_book::with('workorder','freeman')->where('freemanid',$logger_seeker_id)->get();
            $paymentinfolist = Payment::with('workorder')->where('freemanid',$logger_seeker_id)->get();

            return response()->json(array(
                    'workorderlist' => $workorderlist,
                    'activitylist' => $activitylist,
                    'freemanbookinglist' => $freemanbookinglist,
                    'paymentinfolist' => $paymentinfolist,
            ));
        }
        else{
            return Redirect()->route('job_seeker_logout');
        }
    }
    //set_myinterest
    public function set_myinterest(Request $request)
    {
        $logger_seeker_id = 0;
        $logger_seeker_id = Session::get('logger_seeker_id') ;  
        
        if($logger_seeker_id != 0)
        {
            $preresponse = 0;
            $preresponse = FreemanResponse::where('workorderid',$request->workorderid)->where('freemanid',$logger_seeker_id)->get();
            if(count($preresponse)==0)
            {
                FreemanResponse::insertGetId([
                    'workorderid'=>$request->workorderid,
                    'freemanid'=>$logger_seeker_id,
                    'status'=>0,
                    'created_at'=>Carbon::now(),
                ]);
    
                return response()->json(array(
                    'success' => "set interested",
                ));
            }
        }
        else{
            return Redirect()->route('job_seeker_logout');
        }
    }
    
    //logout from panel
    public function job_seeker_logout()
    {  
        Session::forget('logger_seeker_id');
        Session::forget('logger_seeker_code');
        Session::forget('logger_seeker_title');

        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: text/html');
        
        //dd('aaf');
        return Redirect()->route('/');
    }
    //job_seeker_profile
    public function job_seeker_profile()
    {
        $logger_seeker_id = "";
        $logger_seeker_id = Session::get('logger_seeker_id');
        $logger_seeker_title = Session::get('logger_seeker_title');
        if($logger_seeker_id != "")
        {
            $freemaninfo = FreeManReg::find($logger_seeker_id); 
            $page =$this->get_pageurl('fontend.en.profile_jobseeker','fontend.jp.profile_jobseeker');
            return view($page, compact('freemaninfo'));
        }
        else{
            return Redirect()->route('job_seeker_logout');
        }
    }
    //payment_conplete
    public function payment_conplete(Request $request)
    {
        $logger_seeker_id = 0;
        $logger_seeker_id = Session::get('logger_seeker_id') ;  
        
        if($logger_seeker_id != 0)
        {
            Payment::where('workorderid',$request->workorderid)->where('freemanid',$request->loggerid)->where('paymethod',1)->update([
                'paystatus'=>1, //1 paid, 0 due
                'updated_at'=>Carbon::now(),
            ]);
            return Redirect()->route('Payment confirmed');
        }
        
    }

    //job_and_payments_detais
    public function job_and_payments_detais()
    {
        //getworkinfo of job provider
        $workinfo = Work::with('worktype')->get();
        $page =$this->get_pageurl('fontend.en.job_and_payments_detais','fontend.jp.job_and_payments_detais');
            return view($page, compact('workinfo'));
    }
    //job_seeker_job_history_show()
    public function job_seeker_job_history()
    {
        $page =$this->get_pageurl('fontend.en.job_seeker_job_history','fontend.jp.job_seeker_job_history');
        return view($page);
    }
    //job_seeker_job_history
    public function job_seeker_job_history_show()
    {
        $logger_seeker_id = 0;
        $logger_seeker_id = Session::get('logger_seeker_id') ;  

        $todaydate = date('Y-m-d');
        
        if($logger_seeker_id != 0)
        {
            //getworkorder of job provider
            
            $workorderlist = Workorder::with('customer','worktype','work')->where('work_status',1)->where('startdate', '<', $todaydate)->orderBy('id', 'DESC')->get();  
            $activitylist = FreemanResponse::with('workorder','freeman')->where('freemanid',$logger_seeker_id)->get();
            
            $freemanbookinglist = Freeman_book::with('workorder','freeman')->where('freemanid',$logger_seeker_id)->get();
            $paymentinfolist = Payment::with('workorder')->where('freemanid',$logger_seeker_id)->get();

            return response()->json(array(
                    'workorderlist' => $workorderlist,
                    'activitylist' => $activitylist,
                    'freemanbookinglist' => $freemanbookinglist,
                    'paymentinfolist' => $paymentinfolist,
            ));
        }
        else{
            return Redirect()->route('job_seeker_logout');
        }
    }
    
}