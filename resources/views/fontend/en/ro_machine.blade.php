@extends('layouts.fontend_master')

@section('content')

<style>
  .div-1 p{text-align: justify !important;}
  .container {text-align: justify;}
  .visaimg{width: 200px;float: left;margin: 10px 10px 1px 0;}
</style>

<div class="div-1">
<h2>RO Machine:</h2>

<p>
An RO machine, also known as a Reverse Osmosis machine, is a water purification system that uses the 
process of reverse osmosis to remove impurities from water. Reverse osmosis is a filtration process 
in which water is forced through a semi-permeable membrane to separate contaminants, particles, and 
dissolved solids from the water.

<img src="{{ asset('fontend') }}/images/ro.png" />

</p>
<p>
Here's a brief overview of how an RO machine works:
</p>

<p>
Pre-filtration: The water passes through a pre-filter to remove larger particles such as sediment, 
dirt, and debris. This step helps protect the RO membrane from clogging and improves the overall 
efficiency of the system.
</p>

<p>
<b>Reverse Osmosis:</b> The pre-filtered water is then pressurized and forced through a semipermeable membrane. 
This membrane has extremely small pores that allow water molecules to pass through while trapping 
contaminants, including minerals, dissolved solids, chemicals, bacteria, and viruses. The purified water 
is collected, while the rejected impurities are flushed away.
</p>

<p>
    <b>Post-filtration:</b> After the reverse osmosis process, the purified water goes through a post-filter to 
further improve its taste and remove any residual odors or remaining impurities.
</p>

<p>
    <b>Storage and Delivery:</b> The purified water is stored in a dedicated storage tank connected to the RO 
machine. When you turn on the faucet or dispenser, the stored purified water is delivered for use.
</p>

<p>
RO machines are commonly used for residential, commercial, and industrial applications. They are effective 
at removing a wide range of impurities, including chlorine, heavy metals, fluoride, nitrates, pesticides, 
and more. The resulting purified water is generally considered safe for drinking and other applications.
</p>

<p>
It's important to note that RO machines require periodic maintenance, such as replacing filters and sanitizing 
the system, to ensure optimal performance and longevity. Additionally, the efficiency and capacity of an RO 
machine can vary depending on factors such as the quality of the feed water, the membrane's quality, and the 
specific design and specifications of the machine.
</p>

<p>
If you are considering installing an RO machine, it is recommended to consult with a water treatment professional 
or supplier who can assess your specific needs and provide guidance on the appropriate system for your requirements.
</p>


</div>





</div>
<!--<div class="right-side-container">
<right-side> </right-side>
</div>-->
<br class="clear">


@endsection

