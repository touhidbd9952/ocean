@extends('layouts.fontend_master')

@section('content')


<div class="div-1">
      
  <img class="right-side-image" src="{{ asset('fontend') }}/images/car2.jpg" width="400" height="160"/><br>
  <img class="right-side-image" src="{{ asset('fontend') }}/images/car1.jpg" width="400" height="160"/>
    <h2>Contact Details: </h2>
    <p><b> Mailing Address:</b><br>
      56-57, Motijheel commercial Area, Sharif Mansion (3rd Floor), Dhaka -1000, Bangladesh.<br>
      <br>
      <b>Registered Address:</b><br>
      Road#3 (Vasha Sainik Sultan Sarak), House#3, Shop #4 (1st Floor), Happy Arched Plaza, Dhanmondi, Dhaka -1205, Bangladesh. <br>
      <br>
      <b>E-mail:</b> 
      info@ocean.com.bd<br>
      <br>
      <!---<b>Phone Contact: </b>+88088123456789<br>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; +88123456789<br>--> 
      
    </p>
    <br>
    <br>
    {{-- <p>Office Address in Japan:................... </p> --}}
    <br>
    <br>
    {{-- <p><b>Office Address in USA:</b>.................. --}}
</p>
 
    
  </div>
</div>
<!--<div class="right-side-container">
  <right-side> </right-side>
</div>-->
<br class="clear">



  @endsection
