<!DOCTYPE >
<html>
<head>
<!-- base href="https://localhost/ocean/" -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="{{ asset('fontend') }}/css/style.css">
<link rel="stylesheet" type="text/css" href="{{ asset('fontend') }}/css/css.css">
<title>Ocean.com.bd</title>

<meta name="description" content="Are you looking for student visa, employee visa, job visa and travel visa for Japan, Canada, USA and other country, we are here to help you">

<meta name="keywords" content="student visa, employee visa, job visa, travel visa, visa help, visa help center, japan visa, canada visa, usa visa, import car, import vehicle, excavator, folklift, buldozer, crane">

<meta property="og:locale" content="en">
<meta property="og:type" content="website">
<meta property="og:title" content="ocean.com.bd">
<meta property="og:description" content="Are you looking for student visa, employee visa, job visa and travel visa for Japan, Canada, USA and other country, we are here to help you">
<meta property="og:url" content="https://ocean.com.bd/">
<meta property="og:site_name" content="ocean.com.bd">
<meta property="og:updated_time" content="2023-07-11">
<meta property="og:image" content="http://ocean.com.bd/fontend/images/logo1.png">
<meta property="og:image:secure_url" content="http://ocean.com.bd/fontend/images/logo1.png">
<meta property="og:image:width" content="250">
<meta property="og:image:height" content="146">
<meta property="og:image:alt" content="ocean.com.bd">
<meta property="og:image:type" content="image/png">

<meta name="twitter:card" content="ocean.com.bd">
<meta name="twitter:title" content="ocean.com.bd">
<meta name="twitter:description" content="Are you looking for student visa, employee visa, job visa and travel visa for Japan, Canada, USA and other country, we are here to help you">
<meta name="twitter:site" content="@ocean.com.bd">
<meta name="twitter:creator" content="@ocean.com.bd">
<meta name="twitter:image" content="http://ocean.com.bd/fontend/images/logo1.png">



<script language="JavaScript1.1">

  

var slideimages=new Array()
var slidelinks=new Array()
function slideshowimages(){
for (i=0;i<slideshowimages.arguments.length;i++){
slideimages[i]=new Image()
slideimages[i].src=slideshowimages.arguments[i]
}
}

function slideshowlinks(){
for (i=0;i<slideshowlinks.arguments.length;i++)
slidelinks[i]=slideshowlinks.arguments[i]
}

function gotoshow(){
if (!window.winslide||winslide.closed)
winslide=window.open(slidelinks[whichlink])
else
winslide.location=slidelinks[whichlink]
winslide.focus()
}

</script>
<style type="text/css">
left-side {
	width:180px;
	min-height:1500px;
	margin:0;
	padding-left:48px;
	border:1px solid #FFF;
	/*background:#666;*/
	float:left;
}
.container1 {
    margin: 30px auto 0;
    position: relative;
    text-align: left;
    width: 990px;
    min-height: 56px;
    /* background: #FF0; */
}
.logostyle{width: 100%;
    color: #1629b1;
    font-weight: bold;
    font-size: 36;
    font-family: University Roman;
    margin-left:120px;
}
@font-face {
font-family: "University Roman";
src: url("fonts/univers6.ttf");
}
.banner {
  float: left;
  width: 100%;
  height: 120px;
  background: url(./fontend/images/sea-dolpin.png) top left no-repeat;
  margin-bottom: 10px;
}
</style>
</head>

<body>
<div class="wrapper">
<div class="header">

  @include('inc/fontend_master_top_navbar')
  
  
  <!---------------------------------------->


  <div class="container">
    
    <!------------------------------>
    <div class="left-side-container">
      <div class="left_menu">
        <ul>
          <li> <a href="{{route("home")}}">Home</a></li>
          <li> <a href="{{route("vehicles")}}">Vehicle Import</a></li>
          <li> <a href="{{route("ro_machine")}}">RO Machine Import</a></li>
          <li> <a href="javascript:">International Relation</a></li>
          <li> <a href="{{route("consultency")}}">Consultancy</a></li>
          <li> <a href="{{route("softwaredevelopment")}}">Software Development</a></li>
          <li> <a href="{{route("languagetraining")}}">Japanese Professional Language Course</a></li>
          <li> <a href="{{route("contact_us")}}">ContractUs</a></li>
        </ul>
      </div>
      
      <left-side> 
        <marquee align="top" behavior="scroll" direction="down" width="228" height="1500"> 
        <img src="{{ asset('fontend') }}/images/Car-8-for-AboutUS.png" class="img-responsive" style="width:100px;height:218px;"> 
      </marquee> 
    </left-side>
      
    </div>
    <!---------------------------------------------------------->
    <div class="center-container">
          <div class="banner"> </div>
            
            <!------------------------------------->


            @yield('content')
            
            
    
    
    </div>
     <!--- Close center-container-------->
     
     
     
    <!--<div class="right-side-container">
      <right-side> </right-side>
    </div>-->
    
  </div>  
  <!---------------------------------->

  <!---------------------------------------->
  
  <style type="text/css">
.left-side-container {
	width: 228px;
	float: left;
	margin-top:10px;
	padding-right: 16px;
	min-height:700px;
}
	
</style>





  
@include('inc/fontend_master_footer')

</div>


</div></body></html>