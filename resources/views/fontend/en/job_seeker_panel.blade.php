@extends('layouts.fontend_master3')

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
          
          <div class="col-md-12" style="text-align: center;">
            <span style="float: right;color: #9f9797;">
              <?php 
              $logger_seeker_title = Session::get('logger_seeker_title') ;
              echo 'Job Seeker: '.$logger_seeker_title;
              ?>
            </span>
            <br>
            <!---============ Work Order List ==================================---->
            <div id="workorderlist" style="margin-bottom: 50px;padding: 10px;border-radius: 10px;margin-top: 30px;"></div>

          </div>

      </div>







      </div>
    </div>
  </section>

  
<script>
  //call when page load/////////////////////////
  window.onload = function() {
    getworkorder()
};
var intervalId = window.setInterval(function(){
  getworkorder();
  var logger_seeker_id = 0;
  logger_seeker_id = "<?php echo Session::get('logger_seeker_id') ?>"; 
  if(logger_seeker_id == 0){location.reload(); }
}, 5000);

function getworkorder()
  {  
    //get workorder list for job seeker
    $.ajax({
            type:'GET',
            url: base_url+'/job-seeker/getworkorder',
            dataType:'json',
            success:function(data){  
              document.getElementById('workorderlist').style.background = "#fff";
              $('#workorderlist').empty();
              //alert(data.workorderlist[0].worktype.title);
               let res = '';

               res += `<h4 style="text-align: left;">Work Offer List</h4>
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>Work Type</th>
                            <th>Work</th>
                            <th>Work Place</th>
                            <th>Work Date</th>
                            <th>Customer Phone</th>
                            <th>Your Response</th>
                            <th>Customer Response</th>
                            <th>Work Status</th>
                            <th>Payment Status</th>
                          </tr>
                        </thead>
                        <tbody>`;

              var sl=0;
              if(data.workorderlist.length > 0)
              {
               data.workorderlist.forEach(workorder => {

                sl++;
                  res += `<tr><td>${sl}</td>
                              <td>${workorder.worktype.title}</td>
                              <td>${workorder.work.work_title}</td>
                              <td>${workorder.work_place}</td>
                              <td>${workorder.workstart}</td>
                              <td title="Customer: ${workorder.customer.title}, Address: ${workorder.customer.address}">${workorder.customer.phone}</td>
                              <td>`
                                 var activityresult = 0;
                                for(var i=0;i< data.activitylist.length;i++)
                                {
                                  if(data.activitylist[i].workorderid == workorder.id)
                                  {
                                    activityresult = 1;
                                    res += `<span  class="textinterested">Interesed</span>`
                                  }
                               }
                              if(workorder.work_status == 1 && activityresult == 0)
                                {
                                  res += `<a href="javascript:" onclick="jAlertconfirm('Are you shure want to do this work?','set_myinterest(${workorder.id})')" class="btnedit">I am Interesed</a>`
                                }
                        res +=`</td>`
                        res +=`<td>`
                          if(data.freemanbookinglist.length>0)
                                {
                                  for(var i=0;i<data.freemanbookinglist.length;i++)
                                  {
                                    if(data.freemanbookinglist[i].workorderid == workorder.id )
                                    {
                                      if(data.freemanbookinglist[i].book_status == 0)
                                      {
                                        res += `<span  class="txtbook">Booked</span>`
                                      }
                                      else if(data.freemanbookinglist[i].book_status == 1)
                                      {
                                        res += `<a href="javascript:"  class="txtcancel">Canceled by customer</a>`
                                      }
                                    }
                                  }
                                  
                                }
                        res +=`</td>`

                                var workcurrentcompletestatus = "";
                                for(var i=0;i<data.freemanbookinglist.length;i++)
                                {
                                  if(data.freemanbookinglist[i].workorderid == workorder.id)
                                  {
                                    if(data.freemanbookinglist[i].freemanid == "<?php echo Session::get('logger_seeker_id');?>" && data.freemanbookinglist[i].book_status == 0)
                                    {
                                      if(data.freemanbookinglist[i].workstatus == 0){workcurrentcompletestatus = "Work Completed";}
                                      else{workcurrentcompletestatus = "Work Not Completed";}
                                    }
                                  }
                                }

                        res +=`<td>${workcurrentcompletestatus}</td>`

                        res +=`<td>`

                          var logger_seeker_id = "<?php echo Session::get('logger_seeker_id') ?>"; 

                            for(var i=0;i<data.paymentinfolist.length;i++)
                            {
                              if(data.paymentinfolist[i].workorderid == workorder.id)
                              {
                                if(data.paymentinfolist[i].freemanid == "<?php echo Session::get('logger_seeker_id');?>")
                                {
                                  if(data.paymentinfolist[i].paymethod == 1 && data.paymentinfolist[i].paystatus == 0)
                                  {
                                    res += `<a href="javascript:" onclick="jAlertconfirm('Are you receipt your total work payment? Count money again. if everything is ok, click Yes button', 'payment_conplete(${workorder.id},${logger_seeker_id})')"  class="btnedit">Confirm Payment</a>`
                                  }
                                  else if(data.paymentinfolist[i].paymethod == 1 && data.paymentinfolist[i].paystatus == 1)
                                  {
                                    res +='Cash Paymented'
                                  }
                                }
                              }
                            }

                        res +=`</td>
                          </tr>`
                })
              }
              else{
                res +=`<tr><td colspan="10" style="text-align:center">No Offer Found</td></tr>`
              }

                res += `</tbody>
                        </table>`;

                $('#workorderlist').html(res);
            }
        })

  }

  function payment_conplete(workorderid,loggerid)
  {
    $.ajax({
                type:'POST',
                data: {
                        "_token": "{{ csrf_token() }}",
                        "workorderid":workorderid,
                        "loggerid":loggerid,
                    },
                url: base_url+'/job_seeker/payment_conplete',
                dataType:'json',
                success:function(data){  
                  alert(data);
                  //call after insert
                  getworkorder();
                }
            });
  }
</script>

<script>
  function set_myinterest(workorderid)
  {  
    $.ajax({
            type:'POST',
            data: {
                    "_token": "{{ csrf_token() }}",
                    "workorderid":workorderid,
                },
            url: base_url+'/job_seeker/set_myinterest',
            dataType:'json',
            success:function(data){    
              getworkorder();
            }
        });
  }
  
</script>



  @endsection