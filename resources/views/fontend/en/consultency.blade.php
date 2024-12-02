@extends('layouts.fontend_master')

@section('content')

<style>
    .div-1 p{text-align: justify !important;float: left;}}
    .container {text-align: justify;}
    .visaimg{width: 200px;float: left;margin: 10px 10px 1px 0;}
</style>

<div class="div-1">
    <p>
    To study in Japan, the USA, or Canada as an international student, you will generally 
    need to apply for a student visa specific to each country. Here's an overview of the 
    student visa application process for each country:
    </p>

    <p>
<h2> Visa for Japan:</h2>
Apply to a Japanese educational institution: First, you need to apply and get 
accepted into a recognized educational institution in Japan.

<img class="right-side-image visaimg" src="{{ asset('fontend') }}/images/japanvisa.png" />

Obtain a Certificate of Eligibility (COE): Once accepted, the institution will 
help you apply for a COE through the Immigration Bureau of Japan or a regional 
immigration office.

Apply for a student visa: With the COE, you can then apply for a student visa 
at the Japanese embassy or consulate in your home country. You will need to submit 
the COE, your passport, a completed visa application form, and other required documents.

    </p>
    <p>
        <h2>Student Visa for the USA:</h2>
Receive acceptance from a U.S. school: After being accepted by a U.S. educational 
<img class="right-side-image visaimg" src="{{ asset('fontend') }}/images/usavisa.png" />
institution, you will receive a Form I-20, which is a Certificate of Eligibility 
for Nonimmigrant Student Status.

Pay the SEVIS fee: Before applying for a student visa, you must pay the Student 
and Exchange Visitor Information System (SEVIS) fee.
Apply for a student visa: Schedule an appointment at the U.S. embassy or consulate 
in your country and complete the online visa application (Form DS-160). Attend the 
visa interview with the necessary documents, including the Form I-20, SEVIS fee payment 
receipt, passport, financial documents, and proof of ties to your home country.

    </p>
    <p>
        <h2>Student Visa for Canada:</h2>
        <img class="right-side-image visaimg" src="{{ asset('fontend') }}/images/canadavisa.png" />
Receive acceptance from a Canadian institution: Get accepted into a designated learning 
institution (DLI) in Canada and receive an acceptance letter.
Obtain a study permit: Apply for a study permit online or through a paper application. 
You will need to provide the acceptance letter, proof of financial support, a valid passport, 
and other supporting documents. Biometrics may also be required.
    </p>
    <p>
        <h2>Visitor Visa for Canada:</h2> 
        This is the most common type of visa for tourism, visiting family or friends, 
        or attending conferences in Canada. It allows you to enter and stay in Canada for a temporary 
        period, typically up to six months. The application process involves submitting the necessary 
        documents, such as a valid passport, proof of financial support, travel itinerary, and possibly 
        a letter of invitation from a Canadian host.
    </p>
</div>



</div>
<br class="clear">


@endsection

