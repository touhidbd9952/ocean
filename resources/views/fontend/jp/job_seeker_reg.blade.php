@extends('layouts.fontend_master')

@section('content')

 <!-- Swiper -->
 <!-- Breadcrumbs-->
<style>
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
.text_l{text-align: right;}
.is-invalid{border: 1px solid #e74c3c;}
</style>    
<!--=============================  ======================================-->


<div class="header">
	<div class="container">
    	 <div class="row">
        	<div class="col-md-12">
            	<h1 style="color: #fff">job Seeker Registration</h1>
              @include('inc.fontend_master_language');
              <br>
            </div>			
        </div>
    </div>
</div>


<div class="container-fluid" style="margin-bottom: 50px;">
	<div style="max-width: 600px;text-align:center;margin:0 auto;">
    <a href="{{route('/')}}"  style="position: absolute;right:10px;color:#f5a63f;">
      <img src="{{ asset('fontend') }}/images/yellow_back_button.png" title="Back">
    </a>
    To Create A Job Seeker Account, Please Fill-Up Below Registration Form 
    <br><br>
  </div>
		<div style="padding: 0; margin: 0;" class="row">		
		
			<div style="padding: 0; margin: 0;" class="col-md-12">				
			
        <!--------------------==================== JOB PROVIDER ===========================---------------------------->
        <div class="col-md-2">&nbsp;</div>
				<div class="col-md-8">
          <div class="box row">
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-10" style="text-align: center;">
              
                <form  action="{{route('job_seeker.registration_store')}}" method="POST" enctype="multipart/form-data">

                  @csrf

                  <div class="form-group row">
                    <label for="image"
                        class="col-sm-3 text-end control-label col-form-label text_l">&nbsp;</label>
                    <div class="col-sm-9">
                        <img src="{{ asset('fontend') }}/images/man.png" id="output" style="width: 150px;height:175px;float: right;border: 1px solid #ccc;">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="image"
                        class="col-sm-3 text-end control-label col-form-label text_l">My Photo</label>
                    <div class="col-sm-9">
                        <input type="file"  name="image" onchange="showimage()"  class="form-control @error('image') is-invalid @enderror"
                            placeholder="Select Your Photo" tabindex="1">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fname"
                        class="col-sm-3 text-end control-label col-form-label text_l">Full Name</label>
                    <div class="col-sm-9">
                        <input type="text"  name="title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror"
                            placeholder="Full Name Here" tabindex="2">
                        @error('title')
                            <span class="text-danger"> {{$message}}  </span>
                        @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="postcode"
                        class="col-sm-3 text-end control-label col-form-label text_l">Post Code</label>
                    <div class="col-sm-9">
                        <input type="text"  name="postcode" value="{{old('postcode')}}" class="form-control @error('postcode') is-invalid @enderror"
                            placeholder="post code Here" tabindex="3">
                        @error('postcode')
                            <span class="text-danger"> {{$message}}  </span>
                        @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="address"
                        class="col-sm-3 text-end control-label col-form-label text_l">Address</label>
                    <div class="col-sm-9">
                        <textarea  name="address" class="form-control @error('address') is-invalid @enderror" tabindex="4">{{old('address')}}</textarea>
                        @error('address')
                            <span class="text-danger"> {{$message}}  </span>
                        @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="email"
                        class="col-sm-3 text-end control-label col-form-label text_l">Email</label>
                    <div class="col-sm-9">
                        <input type="email"  name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Email Here" tabindex="5">
                        @error('email')
                            <span class="text-danger"> {{$message}}  </span>
                        @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="password"
                        class="col-sm-3 text-end control-label col-form-label text_l">Password</label>
                    <div class="col-sm-9">
                        <input type="password"  name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Password Here" tabindex="6">
                        @error('password')
                            <span class="text-danger"> {{$message}}  </span>
                        @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="password"
                        class="col-sm-3 text-end control-label col-form-label text_l">Confirm Password</label>
                    <div class="col-sm-9">
                        <input type="password"  name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror"
                            placeholder="Confirm Password Here" tabindex="7">
                        @error('confirm_password')
                            <span class="text-danger"> {{$message}}  </span>
                        @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="phone"
                        class="col-sm-3 text-end control-label col-form-label text_l">Phone</label>
                    <div class="col-sm-9">
                        <input type="text"  name="phone" value="{{old('phone')}}" class="form-control @error('phone') is-invalid @enderror"
                            placeholder="Phone Here" tabindex="8">
                        @error('phone')
                            <span class="text-danger"> {{$message}}  </span>
                        @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fax"
                        class="col-sm-3 text-end control-label col-form-label text_l">Fax</label>
                    <div class="col-sm-9">
                        <input type="text"  name="fax" value="{{old('fax')}}" class="form-control @error('fax') is-invalid @enderror"
                            placeholder="Fax Here" tabindex="9">
                        @error('fax')
                            <span class="text-danger"> {{$message}}  </span>
                        @enderror
                    </div>
                  </div>

                  

                  <div class="form-group row mb-0" style="padding-bottom: 25px;">
                      <label class="col-md-3 col-form-label text-md-right"></label>
                      <div class="col-md-8">
                          <button type="submit" class="btn btn-primary" style="width: 251px;float: left;" tabindex="10">
                              Save
                          </button>
                      </div>
                  </div>
                  
              </form>

              
              
            </div>
        </div>

</div>


        
				
				<div class="clearfix"></div>
		
			</div>		
			
		</div>
			
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
  function showimage()
  {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  }
</script>


  @endsection