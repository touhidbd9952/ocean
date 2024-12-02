<div class="rd-navbar-wrap">
    <nav class="rd-navbar rd-navbar-creative" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-sm-device-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fullwidth" data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fullwidth" data-lg-layout="rd-navbar-fullwidth" data-stick-up-clone="false" data-md-stick-up-offset="150px" data-lg-stick-up-offset="60px" data-md-stick-up="true" data-lg-stick-up="true">
      <div class="rd-navbar-aside-outer rd-navbar-content-outer">
        <div class="rd-navbar-content__toggle rd-navbar-fullwidth--hidden" data-rd-navbar-toggle=".rd-navbar-content"><span></span></div>
        <div class="rd-navbar-aside rd-navbar-content" style="width: 100%;display: inline-block;">
          <div class="rd-navbar-aside__item">
            <ul class="rd-navbar-items-list" style="width: 100%;">
              
               <!--===== Language =======---> 
              <li style="float: right;">
                <div class="unit unit-spacing-xxs unit-horizontal">
                  
                  <div class="unit__body">
                    <p>
                      Language<?php if(session()->get('language')=='jp'){?>(言語)<?php }?>:
                      <?php  
                        if(session()->get('language')=='en')
                        {
                      ?>
                      <a href="javascript:" onclick="change_language('jp')">Japanese</a>
                      <?php     
                        }
                        else {
                       ?>
                       <a href="javascript:" onclick="change_language('en')">English</a> 
                       <?php    
                        }
                      ?> 
                    </p>
                  </div>
                </div>
              </li>


            </ul>
          </div>
          
        </div>
      </div>
      <div class="rd-navbar-main-outer" style="border-bottom: 1px solid #E6E6E6;">
        <div class="rd-navbar-main">
          <!-- RD Navbar Panel -->
          <div class="rd-navbar-panel">
            <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
            <!-- RD Navbar Brand-->
            <div class="rd-navbar-brand" style="width: 250px;">
              <a class="brand" href="{{url('/')}}">
                <div class="brand__name">
                  <img src="{{ asset('fontend') }}/images/woody-logo.png" alt="" width="123" height="47"/>
                  
                </div>
              </a>
            </div>
          </div>
          <!-- RD Navbar Nav -->
          <div class="rd-navbar-nav-wrap" >
            
            <!-- RD Navbar Nav-->
            <?php  
              if(session()->get('language')=='en')
              {
            ?>

           
            <ul class="rd-navbar-nav">
              <li><a href="{{url('/')}}">Home</a></li>
              <li><a href="">Work Order</a></li>
              <li><a href="">My Activity</a></li>
              <li><a href="">My Profile</a></li>
              {{-- <li><a href="{{route('woody.guidebook')}}">Woody Guidebook</a></li> --}}
              <li><a href="">Support</a></li>
              <li style="float: right;"><a href="{{route('job_provider_logout')}}">Logout</a></li>
      
            </ul>
            <?php     

            }
            else {
            ?>

            
            <ul class="rd-navbar-nav">
              <li><a href="{{url('/')}}">トップページ</a></li>
              <li><a href="">ウッディオークション</a></li>
              <li><a href="">ウッディ検索サイト</a></li>
              {{-- <li><a href="{{route('woody.guidebook')}}">ウッディガイドブック</a></li> --}}
              <li><a href="">サポート</a></li>
              <li style="float: right;"><a href="{{route('job_provider_logout')}}">Logout</a></li>
            </ul>
          <?php   
            }
          ?> 
          </div>
        </div>
      </div>
    </nav>
  </div>

  <script>
    function change_language(lan)
    {
      $.ajax({
            type:'GET',
            url: '/change_language/'+lan,
            dataType:'json',
            success:function(response){
              location.reload();
            }
        })
    }
  </script>

