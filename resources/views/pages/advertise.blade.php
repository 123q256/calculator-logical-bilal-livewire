@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)

@section('content')
<div class="bg-white py-4">
    <div class="container px-2">
        <div class="row">
            <h1 class="px-2 mb-2 font-s-32 text-center">HOW CAN WE HELP YOU?</h1>
            <p class="text-center font-s-15">
                We offer you different opportunities that help for business advertisements according to your budget & the dealing of your objectives. Remember that, we never compromise on the accuracy and user-satisfaction. The company would be very happy to help you to make the right decisions to maximize your Return on Investment (ROI).
            </p>
        </div>
    </div>
</div>
<div class="bg-theme py-4">
    <div class="container px-2">
        <div class="row">
            <p class="px-2 mb-2 font-s-20 text-center"><strong class="text-white">Our Audience</strong></p>
            <div class="col-lg-6 text-center px-lg-5 px-2 d-flex align-items-center">
                <p class="text-center font-s-16 mt-2 text-white">
                    We have around 400k+ monthly users around the Globe, as well as the 100k+ followers on the social media. The 60% users of calculator-online are students & professionals; they stick with tools to solve the different educational problems. While the others include health experts and different medical field members for the different health measurements.
                </p>
            </div>
            <div class="col-lg-6 text-center px-lg-5 px-2">
                <img src="<?=url('/img/larkiorlarka.svg')?>" width="90%" alt="bandy">
            </div>
        </div>
    </div>
</div>
<div class="bg-white py-4">
    <div class="container px-2">
        <div class="row">
            <p class="px-2 mb-2 font-s-20 text-center"><strong>Why should you advertise with us?</strong></p>
            <div class="col-lg-6 text-center">
                <img src="<?=url('img/back-mas.png')?>" width="80%" alt="moshoriyan">
            </div>
            <div class="col-lg-6 text-center d-flex align-items-center">
                <div>
                    <p class="text-center font-s-16 mt-2">
                        The calculator-online have a wide range of advertising packages to suit all the budgets & marketing goals. Our accomplished team is here to help you to make the right decisions to maximize your ROI (Return on Investment).
                    </p>
                    <p class="text-center font-s-16 mt-2 mb-4">
                        If it is required, we can even assist you to make your advertisements. The company would be very happy to help you to work for the advertisement of your business requirements. Simply, the aim of our company is to provide a shop for all the related information for our customers so that we can send them straight to a business to save the time in finding the solution of their needs.
                    </p>
                    <a href="{{ url('contact-us') }}/" class="text-decoration-none font-s-16 bg-theme py-2 px-3 radius-5 text-white">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-theme py-4 mb-5">
    <div class="container px-2">
        <div class="row">
            <p class="px-2 mb-2 font-s-20 text-center"><strong class="text-white">Statistics</strong></p>
            <p class="font-s-16 mt-2 text-white col-12 mb-3">
                Since alone Ad is not enough to convince the users, so you should have to consider the three C’s including:<br>
                •	Clean Ad<br>
                •	Compelling Content<br>
                •	Correct Platform<br>
                So, you have to make sure that your ad is seen multiple time & user don't forget about you. The calculator-online have multiple educational & health professionals users to get the accurate outcomes according to their needs.
            </p>
            <div class="col-lg-4 col-12 p-3">
                <div class="row">
                    <div class="col-12 bg-white shadow radius-5 text-center py-3">
                        <img src="<?=url('img/user.png')?>" width='45' height="45" alt="Site Users">
						<p class="font-s-21"><strong style="color: #000000a3">Users</strong></p>
						<p class="font-s-25"><strong style="color: #ff6d00">1M +</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12 p-3">
                <div class="row">
                    <div class="col-12 bg-white shadow radius-5 text-center py-3">
                        <img src="<?=url('img/time.png')?>" width='45' height="45" alt="Sessions">
						<p class="font-s-21"><strong style="color: #000000a3">Sessions</strong></p>
						<p class="font-s-25"><strong style="color: #ff6d00">1.5M +</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12 p-3">
                <div class="row">
                    <div class="col-12 bg-white shadow radius-5 text-center py-3">
                        <img src="<?=url('img/eye.png')?>" width='45' height="45" alt="Page Views">
						<p class="font-s-21"><strong style="color: #000000a3">Page Views</strong></p>
						<p class="font-s-25"><strong style="color: #ff6d00">5M +</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection