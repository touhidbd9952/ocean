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
            

              

                <?php 
                  $logger_provider_id = Session::get('logger_provider_id') ;
                ?>

                <input type="hidden" id="logger_id" value="{{$logger_provider_id}}">

                
          <div id="workorderlist" style="padding: 5px;"></div>

          <div id="interestedfreemanlist" style="margin-bottom: 50px;padding: 5px;"></div>
          <input type="hidden" id="payfreemanid">
          <input type="hidden" id="payworkorderid">

          <!--====== Use for payment ===-->
          <input type="hidden" id="worktype_p">   
          <input type="hidden" id="work_p">
          <input type="hidden" id="chargeperhour_p">
          <!--====== Use for payment ===-->

          

          <style>
              @media (max-width: 768px)
              {
                .w3-modal {
                  padding-top: 50px;
                }
                .w3-modal-content {
                  width: 500px;
                }
              }
              .w3-modal {
                z-index: 3;
                display: none;
                padding-top: 100px;
                position: fixed;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0,0,0);
                background-color: rgba(0,0,0,0.4);
              }
             
              
              .w3-modal-content {
                margin: auto;
                background-color: #fff;
                position: relative;
                padding: 0;
                outline: 0;
                width: 600px;
              }
              .w3-container, .w3-panel {
                padding: 0.01em 16px;
              }
          </style>

            
          </div>
      </div>

     </div>
    </div>
  </section>

<script>
    $( document ).ready(function() {
        getworkorder();
    });
  //document.getElementById('paymentmethiddiv').style.display = "none";
  //document.getElementById('paymentincashdiv').style.display = "none";
  //document.getElementById('paymentmethiddiv').style.display = "none";
  //document.getElementById('paymentcashconfirmdiv').style.display = "none";
  function show_payment_form(freemanid,workorderid)
  {  
    document.getElementById('paymentform').style.display = "block";
    document.getElementById('div1').style.display = "block";
    document.getElementById('payfreemanid').value = freemanid;
    document.getElementById('payworkorderid').value = workorderid;  
  }
  function close_paymentform()
  {
    hideallprementdiv();
    document.getElementById('paymentform').style.display = "none";
  }
  function show(id)
  {  
    for(var i=1;i<=5;i++)
    {
      if(i == id)
      { 
        document.getElementById('div'+id).style.display = "block";
      }
      else{
        document.getElementById('div'+i).style.display = "none";
      }
    }
  }
  function hideallprementdiv()
  {
    for(var i=1;i<=3;i++)
    {
      document.getElementById('div'+i).style.display = "none";
    }
  }
  function check_paymethod()
  { 
    var selected = false;
    var paymethod = "";
    if(document.getElementById('paymethod1').checked)
    {
      paymethod = document.getElementById('paymethod1').value;
      document.getElementById('selecte_paymethod').value = paymethod;
    } 
    else if(document.getElementById('paymethod2').checked)
    {
      paymethod = document.getElementById('paymethod2').value;
      document.getElementById('selecte_paymethod').value = paymethod;
    } 
    if(paymethod == 2)
    {
      show(paymethod);
    }
    if(paymethod == 3)
    {
      show(paymethod);
    }
  }
  function calculate_workhour_of_cashpayment()
  {
    var chargeperhour_of_cashpayment = 0;
    document.getElementById('chargeperhour_of_cashpayment_show').innerHTML = chargeperhour_of_cashpayment +' ¥';

    var totalworkhour_of_cashpayment = document.getElementById('totalworkhour_of_cashpayment').value;
    document.getElementById('totalworkhour_of_cashpayment_show').innerHTML = totalworkhour_of_cashpayment +' hours';

    var workorderid = document.getElementById('payworkorderid').value
    $.ajax({
            type:'GET',
            url: base_url+'/job_provider/get-workorderinfo/'+workorderid,
            dataType:'json',
            success:function(data){    
              $.each(data.workorderinfo,function(key,value){   

                  var workid = value['workid'];
                  $.ajax({
                      type:'GET',
                      url: base_url+'/job_provider/get-workinfo/'+workid,
                      dataType:'json',
                      success:function(data){    
                        $.each(data.workinfo,function(key,value){   
                          
                          var work_p = value['work_title'];
                          var worktype_p = value['work_type_id'];
                          var chargeperhour_p = value['charge'];
                          document.getElementById("work_p").value = work_p;
                          document.getElementById("worktype_p").value = worktype_p;
                          document.getElementById("chargeperhour_p").value = chargeperhour_p;

                          document.getElementById("chargeperhour_of_cashpayment_show").innerHTML = chargeperhour_p+' ¥';
                          var totalchargeneedtopay = totalworkhour_of_cashpayment * chargeperhour_p;
                          document.getElementById("totalworkchargeincashneedtopayamount").value = 0;
                          document.getElementById("totalworkchargeincashneedtopayamount").value = totalchargeneedtopay;
                          document.getElementById("totalworkchargeincashneedtopay").innerHTML = totalchargeneedtopay+' ¥';

                          })
                      }
                  })

                })
            }
        })
//document.getElementById('totalworkhour_show').value

    if(totalworkhour_of_cashpayment > 0)
    {
      show(4);
    }
  }
function cash_payment_money_request_form()
{
    document.getElementById('totalworkchargeincashneedtopay2').innerHTML = document.getElementById("totalworkchargeincashneedtopayamount").value +' ¥';
    show(5);
    
}
function cash_money_send()
{
    var logger_id = document.getElementById('logger_id').value;
    var freemanid = document.getElementById('payfreemanid').value;
    var workorderid = document.getElementById('payworkorderid').value;  
    
        $.ajax({
                type:'POST',
                data: {
                        "_token": "{{ csrf_token() }}",
                        "logger_id":logger_id,
                        "freemanid":freemanid,
                        "workorderid":workorderid,
                    },
                url: base_url+'/job_provider/cash_money_send',
                dataType:'json',
                success:function(data){  
                  
                  //alert(data);
                  
                  jAlert(data, "<b>Ok</b>");
                  document.getElementById('jAlRem').style.display="block";
                  //call after insert
                  getworkorder();
                  document.getElementById("worktypeid").selectedIndex = "0";
                  
                  for(var i=1;i<=5;i++)
                  {
                    var openeddiv = document.getElementById('div'+i);
                    if(openeddiv)
                    {
                      //close all payment div
                      openeddiv.style.display = "none";
                    }
                  }
                  //close payment modal div
                  close_paymentform();

                }
            });
  }
  
</script>  

<script>
  

  function CreateNewWorkOrder()
  {
    var logger_id = '';
    var worktypeid = '';
    var workid = '';
    var workplace = '';
    var workstart = '';

    logger_id = document.getElementById("logger_id").value;  
    worktypeid = document.getElementById("worktypeid").value;
    workid = document.getElementById("workid").value;           
    workplace = document.getElementById("workplace").value;
    workstart = document.getElementById("datepicker").value;  

    document.getElementById("eworktypeid").innerHTML = ""; 
    document.getElementById("eworkid").innerHTML = "";
    document.getElementById("eworkplace").innerHTML = "";
    document.getElementById("eworkstart").innerHTML = "";
    var err=0;
    if(logger_id == '' || worktypeid ==0)
    {
      err++;
    }
    if(worktypeid == ''){ err++;document.getElementById("eworktypeid").innerHTML = "Required"; }
    if(workid == ''){ err++;document.getElementById("eworkid").innerHTML = "Required"; }
    if(workplace == ''){ err++;document.getElementById("eworkplace").innerHTML = "Required"; }
    if(workstart == ''){ err++;document.getElementById("eworkstart").innerHTML = "Required"; }  

    if(err == 0)
    {   
        $.ajax({
                type:'POST',
                data: {
                        "_token": "{{ csrf_token() }}",
                        "worktypeid":worktypeid,
                        "workid":workid,
                        "workplace":workplace,
                        "workstart":workstart,
                        "logger_id":logger_id,
                    },
                url: base_url+'/job_provider/create_new_Work_order',
                dataType:'json',
                success:function(data){  
                  //alert(data);
                  
                  jAlert(data, "<b>Ok</b>");
                  document.getElementById('jAlRem').style.display="block";
                  //call after insert
                  getworkorder();
                  //document.getElementById("worktypeid").selectedIndex = "0";

                }
            });
    }
  }

  
var intervalId = window.setInterval(function(){
  getworkorder();
  var logger_provider_id = 0;
  logger_provider_id = "<?php echo Session::get('logger_provider_id') ?>";    
  if(logger_provider_id == 0){location.reload(); }

}, 5000);

//////edit_workorder///////////////////////////
  function getworkorder()
  {
    //get workorder list of this job provider
    var logger_id ='';
    logger_id = document.getElementById("logger_id").value;  
    $.ajax({
            type:'GET',
            url: base_url+'/job_provider/job_provider_workorder_for_history',
            dataType:'json',
            success:function(data){
              $('#workorderlist').empty();
              document.getElementById('workorderlist').style.background = "#fff";
              
               let res = '';

               res += `<h4 style="text-align: left;">Work Order List</h4>
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>Work Type</th>
                            <th style="min-width:150px;">Work</th>
                            <th style="min-width:150px;">Work Place</th>
                            <th>Work Start</th>
                            <th>Freeman Response</th>
                            <th style="min-width:150px;">Work Offer Status</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>`;

              var sl=0;
              var totalfreemanresponse = data.freeman_responselist.length;  

              if(data.workorderlist.length > 0)
              {
               data.workorderlist.forEach(workorder => {
                var datetime = workorder.created_at;
                
                datetime = new Date(datetime).toLocaleString();
                sl++;
                  res += `<tr><td>${sl}</td>
                              <td>${workorder.worktype.title}</td>
                              <td>${workorder.work.work_title}</td>
                              <td>${workorder.work_place}</td>
                              <td>${workorder.workstart}</td>
                              <td>`
                                  if(totalfreemanresponse > 0)
                                  {
                                    var findfreemaninlist = 0;
                                    for(var i =0;i<totalfreemanresponse;i++)
                                    {
                                      if(workorder.id == data.freeman_responselist[i].workorderid && data.freeman_responselist[i].status == 0)
                                      {
                                        findfreemaninlist++;
                                      }
                                    }
                                    if(findfreemaninlist > 0)
                                    {
                                      res += `<a href="javascript:" onclick="show_interested_freemanlist(${workorder.id})" class="textoffered" title="To see freeman list, click here">Interested: ${findfreemaninlist}</a>`
                                    }
                                  }
                                  else
                                  {
                                    res += `<span  class="textcancel">${totalfreemanresponse}</span>`
                                  }
                      res += `</td>
                              <td>`
                                if(workorder.work_status == 0)
                                {
                                  
                                }
                                else
                                {
                                    res += `<span class="textoffered">Offered</span>`
                                }
                        res +=`</td>
                                <td>`
                                  if(workorder.work_status == 1)
                                  {
                                    var cancel = 1; //can be cancel
                                    if(data.freeman_booklist.length>0)
                                    {
                                      for(var i=0;i<data.freeman_booklist.length;i++)
                                      {
                                        if(data.freeman_booklist[i].workorderid == workorder.id)
                                        {
                                          if(data.freeman_booklist[i].book_status == 0)
                                          {
                                            cancel = 0; //offer can not be cancel if any freeman is booked
                                          }
                                        }
                                      }
                                    }
                                    if(cancel == 1)
                                    {
                                      
                                    }
                                  }
                        res +=`</td>
                          </tr>`
                })
              }
              else
              {
                res +=`<tr><td colspan="9" style="text-align:center">No WorkOrder Found</td></tr>`
              }

                res += `</tbody>
                        </table>`;

                $('#workorderlist').html(res);
            }
        })

  }


</script>

<script>
  function show_interested_freemanlist(workorderid)
  { 
    //get workorder list of this job provider
    var logger_id ='';
    logger_id = document.getElementById("logger_id").value;  
    $.ajax({
            type:'GET',
            url: base_url+'/job_provider/show_interested_freemanlist/'+logger_id+'/'+workorderid,
            dataType:'json',
            success:function(data){
              
              $('#interestedfreemanlist').empty();
              //background: #f9f788;
              document.getElementById('interestedfreemanlist').style.background = "rgba(242,246,252,var(--bs-bg-opacity))";
              
               let res = '';

               res += `<h4 style="text-align: left;">Interested Freeman List</h4>
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Phone No.</th>
                            <th>Your Response</th>
                            <th>Cancellation</th>
                            <th>Work Status</th>
                            <th>Payment Status</th>
                          </tr>
                        </thead>
                        <tbody>`;

              var sl=0; 
               data.freemanlist.forEach(freeman => {
                
                sl++;
                  res += `<tr>
                              <td>${sl}</td>
                              <td>${freeman.title}</td>
                              <td>${freeman.phone}</td>
                              <td>`
                                var c = 0;
                                var booked = 0;
                                var needtopay = 0;
                                
                                for(var i=0;i<data.freeman_booklist.length;i++)
                                {
                                  if(data.freeman_booklist[i].workorderid == workorderid)
                                  {
                                    if(data.freeman_booklist[i].freemanid == freeman.id && data.freeman_booklist[i].book_status == 0)
                                    {
                                      c = 1;
                                      booked = 1;
                                      //
                                      if(data.freeman_booklist[i].workstatus == 0){needtopay = 1;}
                                      else{needtopay = 0;}
                                    }
                                  }
                                }
                                if(c == 1)
                                {
                                  res += `<span  class="textbooked">Booked</span>` 
                                  c = 0;
                                }
                                else
                                {
                                  
                                }
                                 
                      res += `</td>
                              <td>`
                                var d = 0;
                                for(var i=0;i<data.freeman_booklist.length;i++)
                                {
                                  if(data.freeman_booklist[i].workorderid == workorderid)
                                  {
                                    if(data.freeman_booklist[i].freemanid == freeman.id && data.freeman_booklist[i].book_status == 0)
                                    {
                                      d = 1;
                                    }
                                  }
                                }
                                if(d == 1 && needtopay == 0)
                                {
                                  
                                d = 0;
                                }
                      res += `</td>`
            
                                var workcurrentcompletestatus = "";
                                for(var i=0;i<data.freeman_booklist.length;i++)
                                {
                                  if(data.freeman_booklist[i].workorderid == workorderid)
                                  {
                                    if(data.freeman_booklist[i].freemanid == freeman.id && data.freeman_booklist[i].book_status == 0)
                                    {
                                      if(data.freeman_booklist[i].workstatus == 0){workcurrentcompletestatus = "Work Completed";}
                                      else{workcurrentcompletestatus = "Work Not Completed";}
                                    }
                                  }
                                }
                                //show current work complete status
                                
                      res += `<td>
                                  ${workcurrentcompletestatus}
                              `
                              var updated_paystatus = 0;
                                  if(workcurrentcompletestatus == "Work Completed")
                                  {
                                    for(var i=0;i<data.paymentinfolistoffreeman.length;i++)
                                    {
                                      if(data.paymentinfolistoffreeman[i].workorderid == workorderid)
                                      {
                                        if(data.paymentinfolistoffreeman[i].freemanid == freeman.id)
                                        {
                                          if(data.paymentinfolistoffreeman[i].paystatus == 1){updated_paystatus = 1;}
                                        }
                                      }
                                    }
                                    if(updated_paystatus == 0)
                                    {
                              
                                    }
                                  }
                                  
                      res +=`</td>
                              <td>`
                                if(booked == 1)
                                {
                                  if(needtopay == 1)
                                  {
                                    //paymentinfolistoffreeman
                                    for(var i=0;i<data.paymentinfolistoffreeman.length;i++)
                                    {
                                      if(data.paymentinfolistoffreeman[i].workorderid == workorderid)
                                      {
                                        if(data.paymentinfolistoffreeman[i].freemanid == freeman.id)
                                        {
                                          
                                          if(data.paymentinfolistoffreeman[i].paystatus == 1)
                                          {
                                            updated_paystatus = 1;
                                            if(data.paymentinfolistoffreeman[i].paymethod == 1)
                                            {
                                              res += `Payment Completed in Cash`;
                                            }
                                            else if(data.paymentinfolistoffreeman[i].paymethod == 0)
                                            {
                                              res += `Payment Completed by Card`;
                                            }
                                            
                                          }
                                        }
                                      }
                                    }
                                    if(updated_paystatus == 0)
                                    {
                                     
                                    }
                                    
                                  }
                                  else if(needtopay == 0 )
                                  {
                                      
                                  }
                                }
                
                      res +=  `</td>
                          </tr>`
                })

                     
                res += `</tbody>
                        </table>`;

                $('#interestedfreemanlist').html(res);

                
            }
        })

  }

  

  function set_workstatus(freemanid,workorderid)
  {
    var workstatus = document.getElementById('workstatus').value; 
    $.ajax({
            type:'GET',
            url: base_url+'/job_provider/set_workstatus/'+workstatus+'/'+workorderid+'/'+freemanid,
            dataType:'json',
            success:function(data){      
              //alert(data);
              
              jAlert(data, "<b>Ok</b>");
              document.getElementById('jAlRem').style.display="block";
              getworkorder();
              newWorkOrder();
              show_interested_freemanlist(workorderid)
            }
        });
  }

  

</script>


<script type="text/javascript">
  (function () {
    document.getElementById("worktypeid").selectedIndex = "0";
    document.getElementById("workplace").value = "";
    document.getElementById("datepicker").value = "";

    document.getElementById("createbtn").style.display = "block";
    document.getElementById("updatebtn").style.display = "none";
    document.getElementById("cancelbtn").style.display = "none";
    //document.getElementById("workstart").value = '';
})();

function newWorkOrder()
{
    document.getElementById("worktypeid").selectedIndex = "0";
    $('select[name="workid"]').empty(); 
    document.getElementById("workplace").value = "";
    document.getElementById("datepicker").value = "";

    document.getElementById("createbtn").style.display = "block";
    document.getElementById("updatebtn").style.display = "none";
    document.getElementById("cancelbtn").style.display = "none";
}
</script>




  @endsection