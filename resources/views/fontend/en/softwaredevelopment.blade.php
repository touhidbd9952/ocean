@extends('layouts.fontend_master')

@section('content')

<style>
    .div-1 p{text-align: justify !important;width: 100%;display: block;float: left;}
    .container {text-align: justify;}
    .visaimg{width: 200px;float: left;margin: 10px 10px 1px 0;}
</style>

<div class="div-1">

    <p>
Software development is the process of creating computer programs or software applications. 
It involves designing, coding, testing, and maintaining software to meet specific requirements 
and solve various problems. We develop and maintain verious type of web and web applications on 
the base of client requirement. Here are some key aspects and stages of our software development:
    </p>

    <p>
<h3>Requirements Gathering:</h3> 
The initial phase involves understanding and documenting the requirements 
of the software. This includes identifying the problem to be solved, user needs, and any functional 
or technical specifications.
<br>
<img class="" src="{{ asset('fontend') }}/images/rgp.png"  />
    </p>

    <p>
        <h3>Design:</h3> Once the requirements are defined, software design takes place. This involves creating a 
high-level architecture and detailed design of the software system, including the user interface, 
database design, and component interactions.
    </p>

    <p>
        <h3>Development/Coding:</h3> In this stage, software developers write code based on the design specifications. 
They use programming languages and frameworks to implement the software's functionality and ensure it 
meets the requirements.
    </p>

    <p>
        <h3>Testing:</h3> Software testing is critical to ensure the quality and functionality of the application. 
Various testing techniques, such as unit testing, integration testing, and system testing, are 
used to identify and fix any defects or issues.
    </p>

    <p>
        <h3>Deployment:</h3> After successful testing, the software is deployed to the target environment, which may 
involve setting up servers, databases, and other necessary infrastructure. The deployment process 
ensures that the software is accessible and usable by the intended users.
    </p>

    <p>
        <h3>Maintenance and Updates:</h3> Once the software is deployed, it may require ongoing maintenance, bug fixes, 
and updates to address any issues or introduce new features. This ensures the software remains reliable 
and up-to-date over time.
    </p>

</div>

@endsection