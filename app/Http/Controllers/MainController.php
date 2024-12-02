<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Visitor;
use App\Models\User;
use App\Models\CustomerReg;
use App\Models\FreeManReg;
use Illuminate\Support\Facades\Mail;
use App\Mail\job_provider_reg_success_Mail;
use App\Mail\job_seeker_reg_success_Mail;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class MainController extends Controller
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

    public function set_visitor()
    {
        $visitor_ip = $_SERVER['REMOTE_ADDR'];
        $visitorslist = Visitor::all();
        $previous_visitor = 0;
        if(count($visitorslist)>0)
        {
            for($i=0;$i<count($visitorslist);$i++)
            {
                if($visitor_ip == $visitorslist[$i]->visitor_ip)
                {
                    $previous_visitor = 1;
                    //if exist, time update
                    if(date("Y-m-d") != $visitorslist[$i]->updated_at)
                    {
                        Visitor::find($visitorslist[$i]->id)->update([
                            'updated_at'=> Carbon::now(),
                        ]);
                    }
                    
                }
                else{
                    $previous_visitor = 0;
                }
            }
        }
        //if not exist, new insert
        if($previous_visitor == 0)
        {
            Visitor::insert([
                'visitor_ip'=> $_SERVER['REMOTE_ADDR'],
                'visit_date'=> Carbon::now(),
                'total_visit'=> 1,
                'created_at'=> Carbon::now(),
            ]);
        }
    }

    //welcome page
    public function index()
    {
        $this->set_visitor();

        $page =$this->get_pageurl('fontend.en.welcome','fontend.jp.welcome');   
        $pagelanguage = $this->get_pagelanguage(); 
        $menu='home';
        
        return view($page,compact('pagelanguage','menu'));
    }
    //about_us
    public function about_us()
    {
        $page =$this->get_pageurl('fontend.en.aboutus','fontend.jp.aboutus');   
        $pagelanguage = $this->get_pagelanguage(); 
        $menu='aboutus';
        
        return view($page,compact('pagelanguage','menu'));
    }
    //languagetraining
    public function languagetraining()
    {
        $page =$this->get_pageurl('fontend.en.languagetraining','fontend.jp.languagetraining');   
        $pagelanguage = $this->get_pagelanguage(); 
        $menu='languagetraining';
        
        return view($page,compact('pagelanguage','menu'));
    }
    //vehicles
    public function vehicles()
    {
        $page =$this->get_pageurl('fontend.en.vehicles','fontend.jp.vehicles');   
        $pagelanguage = $this->get_pagelanguage(); 
        $menu='vehicles';

        return view($page,compact('pagelanguage','menu'));
    }
    //ro_machine
    public function ro_machine()
    {
        $page =$this->get_pageurl('fontend.en.ro_machine','fontend.jp.ro_machine');   
        $pagelanguage = $this->get_pagelanguage(); 
        $menu='ro_machine';

        return view($page,compact('pagelanguage','menu'));
    }
    //softwaredevelopment
    public function softwaredevelopment()
    {
        $page =$this->get_pageurl('fontend.en.softwaredevelopment','fontend.jp.softwaredevelopment');   
        $pagelanguage = $this->get_pagelanguage(); 
        $menu='softwaredevelopment';

        return view($page,compact('pagelanguage','menu'));
    }

    //contact_us
    public function contact_us()
    {
        $page =$this->get_pageurl('fontend.en.contactus','fontend.jp.contactus');   
        $pagelanguage = $this->get_pagelanguage(); 
        $menu='contactus';
        
        return view($page,compact('pagelanguage','menu'));
    }
    //consultency
    public function consultency()
    {
        $page =$this->get_pageurl('fontend.en.consultency','fontend.jp.consultency');   
        $pagelanguage = $this->get_pagelanguage(); 
        $menu='consultency';
        
        return view($page,compact('pagelanguage','menu'));
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

    
    



    




}
