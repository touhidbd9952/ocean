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
.thank-you-pop {
  width: 100%;
  padding: 20px;
  text-align: center;
}
.thank-you-pop img {
  width: 76px;
  height: auto;
  margin: 0 auto;
    margin-bottom: 0px;
  display: block;
  margin-bottom: 25px;
}
.thank-you-pop h1 {
  font-size: 42px;
  margin-bottom: 25px;
  color: #5C5C5C;
}
.thank-you-pop p {
  font-size: 20px;
  margin-bottom: 27px;
  color: #5C5C5C;
}
.thank-you-pop h3.cupon-pop {
  font-size: 25px;
  margin-bottom: 40px;
  color: #222;
  display: inline-block;
  text-align: center;
  padding: 10px 20px;
  border: 2px dashed #222;
  clear: both;
  font-weight: normal;
}

</style>    
<!--=============================  ======================================-->

<?php 
//session check 
$registration_success = 0;
$registration_success = Session::get('registration_success');
if($registration_success == 0){return Redirect()->route('/');}
?>
<div class="header">
	<div class="container">
    	 <div class="row">
        	<div class="col-md-12">
            	<h1 style="color: #fff">Job Provider Registration</h1>
                @include('inc.fontend_master_language');
              <br>
            </div>			
        </div>
    </div>
</div>


<div class="container-fluid" style="margin-bottom: 50px;">
	<div style="max-width: 600px;text-align:center;margin:0 auto;">
    
    <div class="thank-you-pop">
      <a href="{{route('/')}}"  style="position: absolute;right:10px;color:#f5a63f;">
        << Back
      </a>

      <img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
      <h1>Thank You!</h1>
      <p>Your submission is received. A mail is send to you, <br>Please check your mail</p>
      
   </div>
    <br><br>
  </div>
		
			
</div>




  @endsection