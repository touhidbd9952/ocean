@extends('layouts.fontend_master')

@section('content')

 <!-- Swiper -->
 <!-- Breadcrumbs-->
<style>
  @font-face {
  font-family: 'password';
  font-style: normal;
  font-weight: 400;
  src: url(https://jsbin-user-assets.s3.amazonaws.com/rafaelcastrocouto/password.ttf);
}
  input.myclass {
  font-family: 'password';
}
.header {
  text-align: center;
  background-color: #f5a63f;
  width: 100%;
  margin: 0px auto;
    margin-bottom: 0px;
  margin-bottom: 40px;
  z-index: 999;
  padding: 40px 20px 20px;
  color: #ffffff;
}
.container-fluid {
  width: 100%;
  margin: 0px;
  padding: 0px;
}
.box {
  background-color: rgba(0,0,0,0);
  margin: 2px;
  padding: 0px 0;
}
i {
  color: #fff;
  font-size: 36px;
  padding-right: 10px;
}
h1 {
  font-family: 'Roboto';
  font-size: 36px;
  font-style: normal;
  font-weight: 100;
  text-transform: uppercase;
}
h2 {
  margin-top: 0px;
  color: #333333;
  display: block;
  font-size: 15px;
  font-weight: 400;
  text-align: center;
  text-transform: uppercase;
  padding: 10px 0;
}
h5 {
  color: #e74c3c;
  text-transform: uppercase;
}
h4 {
  font-size: 25px;
  font-weight: 100;
  padding: 20px;
  text-align: center;
  color: #333333;
  text-transform: uppercase;
  border-bottom: 1px dotted rgba(0,0,0,.2);
  border-top: 1px dotted rgba(0,0,0,.2);
}
.email1,.password1,.email2,.password2 {
            min-height: 30px;
            line-height: 30px;
            width: 250px;
            float: left;
            border: 1px solid #f5a63f;
            padding-left: 5px;
            color: #000;
        }
@media (max-width: 992px)
{
    .divsize{width: 50% !important;float: left !important;}
    .loginbox{width: 250px !important;margin: 0 auto !important;}
    .labelleft{float: left;}
}

</style>    
<!--=============================  ======================================-->


<div class="header">
	<div class="container">
    	 <div class="row">
        	<div class="col-md-12">
            	<h1 style="color: #fff">Free-Man Service</h1>
                <h2 class="white" style="color: #fff">Find A Best Worker As You Need For Your Work</h2>
                <div class="lan" style="position: absolute;top:-30px;right:0px;">
                  <ul>
                    <li id="jp"><a href="javascript:" onclick="change_language('jp')">Japanese</a></li>
                    <li id="en"><a href="javascript:" onclick="change_language('en')">English</a></li>
                  </ul>
                </div>
    
            </div>			
        </div>
    </div>
</div>


<center><h5>WORK FOR MONEY</h5></center>
<div class="container-fluid" style="margin-bottom: 50px;">
	<div style="max-width: 600px;text-align:center;margin:0 auto;">Some People have work but can’t find a suitable person in required time. 
    Some people have time to work but can’t communicate with job provider due 
    to proper communication. We are here to solve this problem. </div>
		<div style="padding: 0; margin: 0;" class="row">		
		
			<div style="padding: 0; margin: 0;" class="col-md-12">				
			
        <!--------------------==================== JOB PROVIDER ===========================---------------------------->

				<div class="col-md-6 divsize">
                    <div class="box row">
                        <div class="col-md-2">&nbsp;</div>
                        <div class="col-md-10" style="text-align: center;">

                          <img src="{{ asset('fontend') }}/images/job_provider.jpg" style="width: 80px;">

                          <h2 class="text-center">JOB PROVIDER</h2>
                          Find a perfect helpful person
                          <br>
                          who can help you in your business activities 
                        </div>
                    </div>
                    <div class="box row">
                      <div class="col-md-2">&nbsp;</div>
                      <div class="col-md-10 loginbox" style="text-align: center;">
                        <h2  style="text-align: left;color:black;font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">
                          JOB PROVIDER LOGIN</h2>

                          <form  action="{{route('job_provider.login')}}" method="POST">

                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right labelleft">E-Mail</label>
    
                                <div class="col-md-6">
                                    <input type="email" name="provider_email"  class="form-control email1 @error('provider_email') is-invalid @enderror" autocomplete="off" style="width: 251px;"  required>
                                    @error('provider_email')
                                      <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-3 col-form-label text-md-right labelleft" >Password</label>
    
                                <div class="col-md-6">
                                    <input type="text" name="provider_password"  class="form-control myclass password1 @error('provider_password') is-invalid @enderror"  autocomplete="current-password" style="width: 251px;" required>
                                    @error('provider_password')
                                      <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
    
                            
    
                            <div class="form-group row mb-0" style="padding-bottom: 25px;">
                                <label class="col-md-3 col-form-label text-md-right"></label>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary" style="width: 251px;float: left;">
                                        Login
                                    </button>
                                </div>
                            </div>
                            
                        </form>

                        @if(session('error_provider'))
                            <span style="color: red !important;font-size:16px;text-align:center;"> {{session('error_provider')}}  </span>
                            <br><br>
                        @endif

                        If you are new job provider, please <a href="{{route('job_provider.registration_form')}}" style="color: #e74c3c">Register</a>
                        
                      </div>
                  </div>
				
				</div>


        <!--------------------==================== JOB SEEKER ===========================---------------------------->
				
				<div class="col-md-6 divsize">
                	<div class="box row">
                        <div class="col-md-2">&nbsp;</div>
                        <div class="col-md-10" style="text-align: center;">
                          <img src="{{ asset('fontend') }}/images/job.png" style="width: 100px;margin-top: -4px;">

                          <h2 class="text-center" style="margin-top:-3px;">JOB SEEKER</h2>
                          
                          Find a part-time job right away.
                          <br>
                          that matches your Japanese level and status of residence! <br>
                          
                        </div>
                    </div>

                    <div class="box row">
                      <div class="col-md-2">&nbsp;</div>
                      <div class="col-md-10 loginbox" style="text-align: center;">
                        <h2  style="text-align: left;color:black;font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">
                          JOB SEEKER LOGIN</h2>

                          <form  action="{{route('job_seeker.login')}}" method="POST">

                            @csrf

                            <div class="form-group row">
                              <label for="email" class="col-md-3 col-form-label text-md-right labelleft">E-Mail</label>
  
                              <div class="col-md-6">
                                  <input type="email" name="seeker_email"  class="form-control email1 @error('seeker_email') is-invalid @enderror" autocomplete="off" style="width: 251px;"  required>
                                  @error('seeker_email')
                                    <span class="text-danger"> {{$message}}  </span>
                                  @enderror
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password" class="col-md-3 col-form-label text-md-right labelleft" >Password</label>
  
                              <div class="col-md-6">
                                  <input type="search" name="seeker_password"  class="form-control myclass password1 @error('seeker_password') is-invalid @enderror"  autocomplete="current-password" style="width: 251px;" required>
                                  @error('seeker_password')
                                    <span class="text-danger"> {{$message}}  </span>
                                  @enderror
                              </div>
                          </div>
    
                            
    
                            <div class="form-group row mb-0" style="padding-bottom: 25px;">
                                <label class="col-md-3 col-form-label text-md-right"></label>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary" style="width: 251px;float: left;">
                                        Login
                                    </button>
                                </div>
                            </div>
                            
                        </form>

                        @if(session('error_seeker'))
                            <span style="color: red !important;font-size:16px;text-align:center;"> {{session('error_seeker')}}  </span>
                            <br><br>
                        @endif

                        If you are new job seeker, please <a href="{{route('job_seeker.registration_form')}}" style="color: #e74c3c">Register</a>
                        
                      </div>
                  </div>
				
				</div>
				
				<div class="clearfix"></div>
		
			</div>		
			
		</div>
			
</div>




  @endsection