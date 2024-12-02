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
              Creat a Work Order
            </h3>

              <form>

                <?php 
                  $logger_provider_id = Session::get('logger_provider_id') ;
                ?>

                <input type="hidden" id="logger_id" value="{{$logger_provider_id}}">

                <div class="form-group row">
                  <label for="worktypeid"
                      class="col-sm-3 text-end control-label col-form-label">Work Type &nbsp;<span id="eworktypeid" class="emsg"></span></label>
                  <div class="col-sm-6">
                      <select name="worktypeid" id="worktypeid" onchange="getworklist(this.value)" class="form-control">
                        <option value="0" selected>Select Work Type</option>
                        @foreach($worktypelist as $worktype)
                           <option value="{{$worktype->id}}">{{ $worktype->title }}</option>
                        @endforeach
                      </select>
                      
                  </div>
              </div>

              <div class="form-group row">
                <label for="workid"
                    class="col-sm-3 text-end control-label col-form-label">Work &nbsp;<span id="eworkid" class="emsg"></span></label>
                <div class="col-sm-6">
                    <select name="workid" id="workid" class="form-control">
                      
                    </select>
                    @error('workid')
                        <span class="text-danger"> {{$message}}  </span>
                    @enderror
                </div>
            </div>

              <div class="form-group row">
                <label for="workplace"
                    class="col-sm-3 text-end control-label col-form-label">Work Place &nbsp;<span id="eworkplace" class="emsg"></span></label>
                <div class="col-sm-6">
                    <input type="text"  name="workplace" id="workplace" class="form-control">
                </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 text-end control-label col-form-label">Work Start &nbsp;<span id="eworkstart" class="emsg"></span></label>
              <div id="workstart" class="col-sm-6">
                  <input type="text"  name="workstart" id='datepicker'   class="form-control">
                  
              </div>
          </div>

                
            </form>

            <div class="form-group row mb-0" style="padding-bottom: 25px;">
              <label class="col-md-3 col-form-label text-md-right"></label>
              <div class="col-md-6">
                  <button type="submit" id="createbtn" onclick="CreateNewWorkOrder()" class="btn btn-primary" style="min-width: 100px;float: left;">
                      Create
                  </button>

                  <input type="hidden" id="updateid"> 
                  <button type="submit" id="updatebtn" onclick="UpdateWorkOrder()" class="btn btn-primary" style="min-width: 100px;float: left;">
                    Update
                </button>
                <button type="submit" id="cancelbtn" onclick="newWorkOrder()" class="btn btn-danger" style="min-width: 100px;float: left;margin-left:50px;">
                  Cancel
              </button>
              </div>
          </div>

          
          <div id="workorderlist" style="padding: 5px;"></div>
          <div id="interestedfreemanlist" style="margin-bottom: 50px;padding: 5px;"></div>
          <input type="hidden" id="payfreemanid">
          <input type="hidden" id="payworkorderid">

          <!--====== Use for payment ===-->
          <input type="hidden" id="worktype_p">   
          <input type="hidden" id="work_p">
          <input type="hidden" id="chargeperhour_p">
          <!--====== Use for payment ===-->

          {{-- payment form --}}
          <div id="paymentform" class="w3-modal" style="display: none;">
            <div class="w3-modal-content">
              <div class="w3-container" style="border: 2px solid #fbe002;">
                <span onclick="close_paymentform()" class="w3-button w3-display-topright" style="float: right;cursor: pointer;">&times;</span>
                <br>
                
                <div id="div1" style="display: none;">
                <h5 style="color: #000;">Please select your payment method:</h5>
                <p style="height: 25px;">
                <input type="hidden" id="selecte_paymethod">  
                <input type="radio" id="paymethod1" name="fav_language" value="3">
                <label for="Card" style="padding-right: 50px;color: #000;">Card</label> 
                <input type="radio" id="paymethod2" name="fav_language" value="2">
                <label for="Cash" style="color: #000;">Cash</label>

                <a href="javascript:" onclick="check_paymethod()" style="position: absolute;bottom: 0;right: 5px;" class="btnedit">>></a>
                </p>
                
                <br>
                </div>

                <div id="div2" style="display: none;">
                  <h5 style="color: #000;">Payment In Cash</h5>
                  <p style="height: 25px;">
                  <table>
                    <tr>
                      <td>
                        <label for="Card" style="padding-right: 50px;color: #000;">Total Work hour</label>
                        <input type="number" id="totalworkhour_of_cashpayment" name="totalworkhour" value="0">

                      </td>
                    </tr>
                  </table>
                  <a href="javascript:" onclick="calculate_workhour_of_cashpayment()" style="position: absolute;bottom: 0;right: 5px;" class="btnedit">>></a>
                  <a href="javascript:" onclick="show(1)" style="position: absolute;bottom: 0;left: 5px;" class="btnedit"><<</a>
                  </p>
                  <br>
                  </div>

                  <div id="div4" style="display: none;">
                    <h5 style="color: #000;">Payment In Cash</h5>
                    <p style="height: 25px;">
                    <table>
                      <tr>
                        <td style="font-size: 120%;">
                          <span style="padding-right: 5px;color: #000;">Total Work Charge = </span> 
                          <span id="totalworkchargeincashneedtopay" style="color: #000;"></span>
                          <input type="hidden" id="totalworkchargeincashneedtopayamount">
                          (<span id="chargeperhour_of_cashpayment_show"></span> X <span id="totalworkhour_of_cashpayment_show"></span>)
  
                        </td>
                      </tr>
                    </table>
                    <a href="javascript:" onclick="cash_payment_money_request_form()" style="position: absolute;bottom: 0;right: 5px;" class="btnedit">>></a>
                    <a href="javascript:" onclick="show(2)" style="position: absolute;bottom: 0;left: 5px;" class="btnedit"><<</a>
                    </p>
                    <br>
                    </div>

                    <div id="div5" style="display: none;">
                      <h5 style="color: #000;">Payment In Cash</h5>
                      <p style="height: 25px;">
                      <table>
                        <tr>
                          <td style="font-size: 120%;">
                            <span style="padding-right: 5px;color: #000;">Total Work Charge = </span> <span id="totalworkchargeincashneedtopay2" style="color: #000;"></span>
                            <br>
                            <br>
                            Please send money to the person who done the job and click below "I have given Money" button.
                            <br><br>
                            <a href="javascript:" onclick="jAlertconfirm('Are you sure you paid money?','cash_money_send()')" class="btnedit" style="font-size: 16px;font-weight: bold;">I have given Money</a>
                            <br><br>
                          </td>
                        </tr>
                      </table>
                      <a href="javascript:" onclick="calculate_workhour_of_cashpayment()" style="position: absolute;bottom: 0;right: 5px;" class="btnedit">>></a>
                      <a href="javascript:" onclick="show(4)" style="position: absolute;bottom: 0;left: 5px;" class="btnedit"><<</a>
                      </p>
                      <br>
                      </div>

                  

                    <div id="div3" style="display: none;">
                      <h5 style="color: #000;">Payment In Card</h5>
                      <p style="height: 25px;">
                      <table>
                        <tr>
                          <td>
    
                          </td>
                        </tr>
                      </table>
      
                      <a href="javascript:" onclick="show(1)" style="position: absolute;bottom: 0;left: 5px;" class="btnedit"><<</a>
                      </p>
                      <br>
                      </div>
    
                      


              </div>
            </div>
          </div>

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
  function getworklist(worktypeid)
  {
    $.ajax({
            type:'GET',
            url: base_url+'/get-worklist/'+worktypeid,
            dataType:'json',
            success:function(data){    
               //worklist
               $('select[name="workid"]').empty(); 
               $('select[name="workid"]').append('<option value=""></option>');
               $.each(data.worklist,function(key,value){    
                    $('select[name="workid"]').append('<option value="'+value['id']+'">'+value['work_title']+'</option>')
               })
            }
        })
  }

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

  /////update workorder/////////////////////////////////
  function UpdateWorkOrder()
  {
    var logger_id = '';
    var worktypeid = '';
    var workid = '';
    var workplace = '';
    var workstart = '';

    logger_id = document.getElementById("logger_id").value; 
    updateid = document.getElementById("updateid").value;  
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
                        "updateid":updateid,
                    },
                url: base_url+'/job_provider/update_Work_order',
                dataType:'json',
                success:function(data){  
                  //alert(data);
                  
                  jAlert(data, "<b>Ok</b>");
                  document.getElementById('jAlRem').style.display="block";
                  //call after insert
                  getworkorder();
                  newWorkOrder();

                }
            });
    }
  }
  
  //call when page load/////////////////////////
  window.onload = function() {
    getworkorder()
};
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
            url: base_url+'/job_provider/getworkorder/'+logger_id,
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
                                    var todayDate = new Date().toISOString().slice(0, 10);
                                    
                                      res += `<a href="javascript:" onclick="jAlertconfirm('Are you sure want to edit this workorder?','edit_workorder(${workorder.id})')" class="btnedit">Edit</a><br>`
                                    if(workorder.startdate >= todayDate)
                                    {
                                      res += `<a href="javascript:" onclick="jAlertconfirm('Are you sure want to offer this work to freeman?','offer_workorder(${workorder.id})')" class="btnoffer mr5">Offer</a>`
                                    }
                                      res += `<a href="javascript:" onclick="jAlertconfirm('Are you sure want to delete this workorder?','delete_workorder(${workorder.id})')" class="btndelete">Delete</a>`
                                    
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
                                      res +=`<a href="javascript:" onclick="jAlertconfirm('Are you sure want to cancel this offer?', 'offer_cancel(${workorder.id})')" class="btncancel">Cancel Offer?</a>`
                                    }
                                  }
                        res +=`</td>
                          </tr>`
                })
              }
              else
              {
                res +=`<tr><td colspan="8" style="text-align:center">No WorkOrder Found</td></tr>`
              }

                res += `</tbody>
                        </table>`;

                $('#workorderlist').html(res);
            }
        })

  }

//////edit_workorder///////////////////////////
  function edit_workorder(workorderid){
    
    document.getElementById("updateid").value = workorderid;;
    $.ajax({
            type:'GET',
            url: base_url+'/job_provider/get-workorderinfo/'+workorderid,
            dataType:'json',
            success:function(data){    
               //worklist
               $('select[name="workid"]').empty(); 
               $.each(data.workorderinfo,function(key,value){   

                    var worktypeid = document.getElementById("worktypeid");
                    for(var i=0; i < worktypeid.options.length; i++)
                    {
                      if(worktypeid.options[i].value == value['worktypeid']) 
                      {
                        worktypeid.options[i].selected = 'selected';
                        getworklist(worktypeid.options[i].value);
                          var delayInMilliseconds = 500; //1 second
                          setTimeout(function() {
                            //code to be executed after 1 second
                            var workid = document.getElementById("workid"); 
                            if(workid.options.length >0)
                            {
                              for(var j=0; j < workid.options.length; j++)
                              {
                                if(workid.options[j].value == value['workid']) 
                                {
                                  document.getElementById("workid").options[j].selected = 'selected';
                                }
                              }
                            }
                          }, delayInMilliseconds);
                      }
                    }
                    
                    
                    document.getElementById("workplace").value = value['work_place'];
                    document.getElementById("datepicker").value = value['workstart'];
                    document.getElementById("eworkid").innerHTML = "";
                    document.getElementById("eworkplace").innerHTML = "";
                    document.getElementById("eworkstart").innerHTML = "";
                    eworkid

                    //button 
                    document.getElementById("createbtn").style.display = "none";
                    document.getElementById("updatebtn").style.display = "block";
                    document.getElementById("cancelbtn").style.display = "block";

               })
            }
        });
  }
//////offer_workorder/////////////////////////////
function offer_workorder(workorderid)
{
  //var logger_id = document.getElementById("logger_id").value;  
  $.ajax({
            type:'GET',
            url: base_url+'/job_provider/offer_workorder/'+workorderid,
            dataType:'json',
            success:function(data)
            {     
              getworkorder();
              newWorkOrder();
            }
        });

}
//offer_cancel
function offer_cancel(workorderid)
{
  //var logger_id = document.getElementById("logger_id").value;  
  $.ajax({
            type:'GET',
            url: base_url+'/job_provider/offer_cancel/'+workorderid,
            dataType:'json',
            success:function(data)
            { 
              $('#interestedfreemanlist').empty();
              document.getElementById('interestedfreemanlist').style.padding=0;  
              document.getElementById('interestedfreemanlist').style.marginBottom=0;  
              getworkorder();
              newWorkOrder();
            }
        });

}

//////delete_workorder////////////////////////////
function delete_workorder(workorderid){
    
    $.ajax({
            type:'GET',
            url: base_url+'/job_provider/delete-workorderinfo/'+workorderid,
            dataType:'json',
            success:function(data){    
              jAlert('Work order deleted', "<b>Ok</b>");
              document.getElementById('jAlRem').style.display="block";
              getworkorder();
              newWorkOrder();
            }
        });
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
                                  res += `<a href="javascript:" onclick="jAlertconfirm('Are you sure want to book this freeman?', 'book_this_freeman(${freeman.id}, ${workorderid})')" class="btnedit">Book this freeman</a>`
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
                                  res += `<a href="javascript:" onclick="jAlertconfirm('Are you sure want to cancel this booking?' ,cancel_this_booking(${freeman.id}, ${workorderid})')'" class="btncancel">Cancel This Booking?</a>`
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
                              res +=`<br>
                                    <a href="javascript:" onclick="jAlertconfirm('Are you sure want to change?', 'change_this_work_complete_status(${freeman.id}, ${workorderid})')" class="btncancel">Change to uncomplete</a>
                                    `
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
                                      res += `<a href="javascript:" onclick="jAlertconfirm('Are you sure want to payment for this work?', 'show_payment_form(${freeman.id}, ${workorderid})')" class="btnedit">Payment Form</a>`
                                    }
                                    res +=`<a href="javascript:" onclick="show_interested_freemanlist(${workorderid})" title="click here to see payment update status" style="float: right;text-decoration: underline;">refresh</a>`
                                  }
                                  else if(needtopay == 0 )
                                  {
                                      res += `Work Status: <select id="workstatus" style="height: 27px !important;">
                                      <option value="">--select--</option>
                                      <option value="0">Work Done</option>
                                      <option value="1">Work Not Done</option>
                                    </select>
                                    <button id="btn_workstatus" onclick="jAlertconfirm('Are you sure want to change work complete status?', 'set_workstatus(${freeman.id},${workorderid})')" style="height: 27px !important;border-radius: 5px !important;font-size: 12px;background: #ccc;">Update Status</button>
                                    `
                                  }
                                }
                
                      res +=  `</td>
                          </tr>`
                })

                     
                res += `</tbody>
                        </table>`;

                $('#interestedfreemanlist').html(res);

                //getworkorder();
                //newWorkOrder();
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

  //change_this_work_complete_status
  function change_this_work_complete_status(freemanid,workorderid)
  {
    var workstatus = 1; 
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

  function book_this_freeman(freemanid,workorderid)
  { 
    $.ajax({
            type:'GET',
            url: base_url+'/job_provider/book_this_freeman/'+freemanid+'/'+workorderid,
            dataType:'json',
            success:function(data){     
              getworkorder();
              newWorkOrder();
              show_interested_freemanlist(workorderid)
            }
        });
  }

  //cancel_this_freeman
  function cancel_this_booking(freemanid,workorderid)
  { 
    $.ajax({
            type:'GET',
            url: base_url+'/job_provider/cancel_this_booking/'+freemanid+'/'+workorderid,
            dataType:'json',
            success:function(data){     
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