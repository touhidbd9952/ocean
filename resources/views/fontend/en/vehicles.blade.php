@extends('layouts.fontend_master')

@section('content')

<style>
  .div-1 p{text-align: justify !important;}
  .container {text-align: justify;}
  .visaimg{width: 200px;float: left;margin: 10px 10px 1px 0;}
</style>

<div class="div-1">
<h2>Vehicle Import from Japan:</h2>
<p>
Importing a vehicle from Japan can be a complex process, as it involves adhering to specific 
regulations and procedures in both Japan and the destination country. While we can provide a 
general overview, please note that the specific requirements and procedures may vary depending 
  <img src="{{ asset('fontend') }}/images/Car-10-for-aboutUs.png" width="274" height="184" style="float: left;"/>
  <img src="{{ asset('fontend') }}/images/Car-11.png" width="274" height="184" style="float: left;"/>
  
on the country you wish to import the vehicle into. It's important to consult with the customs 
authorities and relevant agencies in your country for the most accurate and up-to-date information. 
Here are some general steps to consider when importing a vehicle from Japan:
</p>
<p>
  <h3>Research Import Regulations:</h3> Familiarize yourself with the import regulations and requirements of 
  <img src="{{ asset('fontend') }}/images/Car-17.jpg" width="274" height="184" style="float: left;"/>
  <img src="{{ asset('fontend') }}/images/Car-13.png" width="274" height="184" style="float: left;"/>
your country. Check if your country allows the import of vehicles from Japan and if any specific 
restrictions or eligibility criteria apply. This information can usually be obtained from the 
customs authority or transportation department in your country.
</p>
<p>
  <h3>Find a Vehicle:</h3> <img src="{{ asset('fontend') }}/images/excavators.jpeg" width="274" height="184" style="float: left;"/>
  Search for a vehicle in Japan through online marketplaces, auctions, or dealerships. 
Ensure that the vehicle meets your preferences, requirements, and budget.<br><br>
</p>
<p>
  <h3>Choose a Shipping Method:</h3> Decide on the shipping method for transporting the vehicle from Japan to your 
destination country. Common methods include Ro-Ro (Roll-on/Roll-off) shipping, where the vehicle is driven 
onto and off the ship, or container shipping, where the vehicle is loaded into a shipping container. 
The choice depends on factors like cost, convenience, and the condition of the vehicle.
</p>
<p>
  <h3>Engage an Exporter or Agent:</h3> Consider using the services of an experienced exporter or an import agent who 
specializes in vehicle imports. They can assist you in locating a suitable vehicle, handling the necessary 
paperwork, and coordinating the shipping process.
</p>
<p>
  <h3>Vehicle Inspection and Compliance:</h3> Some countries require imported vehicles to undergo inspection and compliance 
testing to ensure they meet the local safety and emissions standards. Check the specific requirements of your 
country and arrange for any necessary inspections or modifications before shipping the vehicle.
</p>
<p>
  <h3>Export and Import Documentation:</h3> Ensure that you have all the required documentation for both the export from 
Japan and the import into your country. This typically includes the vehicle's title, bill of sale, export certificate, 
customs forms, and any additional paperwork specific to your country's import regulations.
</p>
<p>
<h3> Clearance and Duties:</h3> Prepare to clear customs upon the arrival of the vehicle in your country. Pay any 
applicable customs duties, taxes, and fees. Follow the customs procedures and submit the required documentation to 
facilitate the clearance process.
</p>
<p>
Vehicle Registration and Compliance: Once the vehicle clears customs, you will need to register it in your country 
and comply with any local regulations regarding emissions, safety, and vehicle modifications.
</p>
<p>
Importing a vehicle involves complex legal and logistical considerations, so it is crucial to consult with professionals 
who specialize in vehicle imports or contact the customs authorities in your country for detailed guidance. They can 
provide you with the most accurate and up-to-date information regarding the specific requirements and processes 
involved in importing a vehicle from Japan.
</p>

</div>


<div> 
    <a href="javascript:gotoshow()">
      <img src="{{ asset('fontend') }}/images/Car-BMWX6.PNG" name="slide" border=0 width=550 height=300>
    </a>
  <script>
//configure the paths of the images, plus corresponding target links
slideshowimages("fontend/images/Car-2.PNG","fontend/images/Car-3.PNG","fontend/images/Car-4.PNG","fontend/images/Car-5.PNG")
slideshowlinks("#","#","#","#")

//configure the speed of the slideshow, in miliseconds
var slideshowspeed=2000

var whichlink=0
var whichimage=0
function slideit(){
                  if (!document.images)
                      return
                      document.images.slide.src=slideimages[whichimage].src
                      whichlink=whichimage
                  if (whichimage<slideimages.length-1)
                      whichimage++
                  else
                      whichimage=0
                      setTimeout("slideit()",slideshowspeed)
                      }
      slideit()

</script>

</div>


</div>
<!--<div class="right-side-container">
<right-side> </right-side>
</div>-->
<br class="clear">


@endsection

