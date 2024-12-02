@extends('layouts.fontend_master')

@section('content')


<div class="slideShow">
  <a href="javascript:gotoshow()">
   <img src="{{ asset('fontend') }}/images/Car-5.PNG" name="slide" class="img-responsive" style="width:746px;height:400px;border:none;">
 </a>
 <script>
//configure the paths of the images, plus corresponding target links
slideshowimages("fontend/images/Car-2.PNG","fontend/images/Car-3.PNG","fontend/images/Car-4.PNG","fontend/images/Car-5.PNG","fontend/images/Car-6.PNG")
slideshowlinks("#","#","#","#","#")

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
   
   

<!----------->

<div class="container-topSide">
<h2>We import different type of car's </h2><br><br>
<img src="{{ asset('fontend') }}/images/Car-2.PNG" alt="car-2" width="150" height="100">
<img src="{{ asset('fontend') }}/images/Car-3.PNG" alt="car-3" width="150" height="100">
<img src="{{ asset('fontend') }}/images/Car-4.PNG" alt="car-4" width="150" height="100">
<img src="{{ asset('fontend') }}/images/Car-2.PNG" alt="car-2" width="150" height="100">


</div>
<div class="container-topSide2">
<p>
 </p><h2>Software Development</h2><br> Mobile game and 
development of software for Japanese company. Imported trading on joint 
collaboration with Overseas Company. Provided course on Networking, 
programming software based on curriculum on joint collaborations with 
NIIT, Bangladesh. 
<p></p>
<img src="{{ asset('fontend') }}/images/notebook-cs-coding-resources-halid-altuner.jpg" width="750" height="250">

</div>

<div class="container-topSide3">
<p>
 </p><h2>Japanese Language</h2><br> Establishment of institution
to teach Japanese Language (Dhaka Nihongo School) proficiency based on 
curriculum of the course. Arrangement of course on tradition, culture, 
geography and environmental familiarity of Japan. 
<p></p>
<img src="{{ asset('fontend') }}/images/language.jpg" width="720" height="250">

</div>



@endsection