<div class="container1">
  <div style="width:100%;"><div class="logo"> 
  <img src="{{ asset('fontend') }}/images/logo1.png" style="position:absolute;top:-20px;" width="120" height="110"> 
  </div>
  <!---<img src="img/logoimg.jpg" width="692" height="56" style="    margin-left: 120px;" />---> 
  <div class="logostyle" style="fontPreview.fontFamilyName ">Ocean Network Japan &amp; Bangladesh</div> 
  <a href="https://www.instagram.com/p/Btbjxp5lsw5"><img src="{{ asset('fontend') }}/images/instagram.jpg" style="position:absolute;top:15px;right:250px" width="40"></a>
  <a href="https://twitter.com/@zuaize1"><img src="{{ asset('fontend') }}/images/twitter.png" style="position:absolute;top:15px;right:200px" width="40"></a>
  <a href="http://linkedin.com/in/m-s-bhuiyan-55967439"><img src="{{ asset('fontend') }}/images/linkedin.png" style="position:absolute;top:15px;right:150px" width="40"></a>
  <a href="https://www.facebook.com/profile.php?id=100094512916325"><img src="{{ asset('fontend') }}/images/facebook.png" style="position:absolute;top:15px;right:100px" width="40"></a>
  <a href="http://www.pinterest.com/bhuiyaninfo"><img src="{{ asset('fontend') }}/images/pinters.png" style="position:absolute;top:15px;right:50px" width="40"></a>
  <a href="http://www.ocean.com.bd/webmail"><img src="{{ asset('fontend') }}/images/email-envelope.jpg" style="position:absolute;top:15px;right:0px" width="40"></a>
  </div> 
</div>

<style>
  .dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 9px 16px 8px 16px;
  background-color: #333;
  font-family:Georgia, "Times New Roman", Times, serif;
  margin: 0;
}

.dropdown:hover .dropbtn {
  background-color: #FF4210;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
  width: 90% !important;
  text-align: left !important;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}
/* .submenusub1{display: none;} */
.submenu:hover .submenusub1 {
  display: block;
}
</style>
 
<nav style="">
  <div id="navigation">
    
    <div class="menu" style="float:right;">
      <ul>
        <li> <a href="{{route("home")}}" {{$menu =='home'? 'class="visited"':''}}>Home</a></li>
        <li> <a href="{{route("about_us")}}" {{$menu =='aboutus'? 'class="visited"':''}}>AboutUS</a></li>
        
        <li> 
          <div class="dropdown">
            <button class="dropbtn">Our Services 
              <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
              <a href="{{route("consultency")}}">Consultancy</a>
              <a href="{{route("softwaredevelopment")}}">Software Development</a>
              <a href="{{route("languagetraining")}}">Language Training</a>
              <a href="javascript:" class="submenu1">Import</a>
                <!------------------------>
                <ul>
                  <li>
                <div class="dropdown submenusub1">
                  <div class="dropdown-content" style="width: 100%;">
                    <a href="{{route("vehicles")}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vehicles</a>
                    <a href="{{route("ro_machine")}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RO Machine</a>
                  </div>
                </div>
              </li>
              </ul>
                <!------------------------>
            </div>
          </div> 
        </li>

        <li> <a href="{{route("contact_us")}}" {{$menu =='contactus'? 'class="visited"':''}}>ContractUs</a></li>
      </ul>
    </div>
  </div>
</nav>