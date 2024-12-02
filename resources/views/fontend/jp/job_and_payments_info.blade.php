@extends('layouts.fontend_master2')

@section('content')

 <style>
  form label{text-align: right;}
 </style>

<?php 
$base_url = Session::get('base_url');
?>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>

  <!-- Get in Touch-->
  <section class="section section-lg bg-white">
    <div class="shell">
      <div class="container-fluid">
        <div class="row">
          {{-- <div class="col-md-2">&nbsp;</div> --}}
          <div class="col-md-12" style="text-align: center;">
            <span style="float: right;color: #9f9797;">
              <?php 
              $logger_provider_name = Session::get('logger_provider_title') ;
              echo 'Job Provider: '.$logger_provider_name;
              ?>
            </span>
            <br>
            <h3  style="font-size: 20px;text-align: left;color:black;font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">
              Work Type: Normal
            </h3>

          <div style="padding: 5px;">
            <div class="table-responsive" style="background: #fff;">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                          <th style="width: 10%;">SL</th>
                          <th style="width: 60%;">Work</th>
                          <th style="width: 30%;">Charge (per hour)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sl=1;
                        ?>
                    @foreach($workinfo as $b)
                    <?php 
                    if($b->work_type_id == 2)
                    {
                    ?>    

                        <tr>
                            <td><?php echo $sl++;?></td>
                            <td>{{ $b->work_title  }}</td>
                            <td>{{ $b->charge }}&nbsp;¥</td>
                            
                        </tr>
                    <?php 
                    }
                    ?>    
                    @endforeach
                        
                    </tbody>
                    
                </table>

            </div>
          </div>


          <!---===================--->
          
          <h3  style="font-size: 20px;text-align: left;color:black;font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">
            Work Type: Heavy
          </h3>

        <div style="padding: 5px; margin-bottom: 30px;">
          <div class="table-responsive" style="background: #fff;">
              <table id="zero_config" class="table table-striped table-bordered">
                  <thead>
                      <tr>
                          <th style="width: 10%;">SL</th>
                          <th style="width: 60%;">Work</th>
                          <th style="width: 30%;">Charge (per hour)</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php 
                      $sl=1;
                      ?>
                  @foreach($workinfo as $b)
                  <?php 
                  if($b->work_type_id == 1)
                  {
                  ?>    

                      <tr>
                          <td><?php echo $sl++;?></td>
                          <td>{{ $b->work_title  }}</td>
                          <td>{{ $b->charge }}&nbsp;¥</td>
                          
                      </tr>
                  <?php 
                  }
                  ?>    
                  @endforeach
                      
                  </tbody>
                  
              </table>

          </div>
        </div>

            
          </div>
      </div>

     </div>
    </div>
  </section>








  @endsection