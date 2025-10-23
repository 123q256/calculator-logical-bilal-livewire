@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)

@section('content')
<div class="bg-gray py-4">
    <div class="container">
        <div class="row">
            <h1 class="px-2 mb-2 font-s-25 text-center text-blue">Testimonials</h1>
            <div class="content">
                <p class="px-2 my-2 text-center font-s-14">
                    At calculator-online.net, our dedicated team makes calculations easy for you by bringing advanced tools and solutions to your problems.
                </p>
            </div>
        </div>
    </div>
</div>
<div class="bg-white py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 p-2">
                <div class="row radius-10 border">
                    <div class="col-12 d-flex flex-wrap justify-content-between p-2 bg-gray radius-t-10">
                        <div class="d-flex align-items-center">
                            <img src="<?=url('assets/img/author_img/brian.jpg')?>" width="80" class="radius-10" height="80" alt="Brian Hannah">
                            <div class="ms-lg-3 ms-1">
                                <p class="font-s-21"><strong>Brian Hannah</strong></p>
                                <p><strong>Teacher</strong></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <strong class="ms-1">5/5</strong>
                        </div>
                    </div>
                    <p class="col-12 p-2 font-s-15">Incredible website! A wealth of information presented in a user-friendly format. The content is insightful and practical, providing valuable guidance. Navigating this site has been a game-changer for me!</p>
                </div>
            </div>
            <div class="col-lg-6 p-2">
                <div class="row radius-10 border">
                    <div class="col-12 d-flex flex-wrap justify-content-between p-2 bg-gray radius-t-10">
                        <div class="d-flex align-items-center">
                            <img src="<?=url('assets/img/author_img/john_athan.png')?>" width="80" class="radius-10" height="80" alt="John Athan" style="object-fit: cover;">
                            <div class="ms-lg-3 ms-1">
                                <p class="font-s-21"><strong>John Athan</strong></p>
                                <p><strong>Professor</strong></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="<?= url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?= url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?= url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?= url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?= url('assets/img/grey-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <strong class="ms-1">4/5</strong>
                        </div>
                    </div>
                    <p class="col-12 p-2 font-s-15">The calculator website exceeded my expectations! User-friendly interface, accurate results, and a variety of useful tools. It has become my go-to for quick calculations. Highly recommend for its efficiency</p>
                </div>
            </div>
            <div class="col-lg-6 p-2">
                <div class="row radius-10 border">
                    <div class="col-12 d-flex flex-wrap justify-content-between p-2 bg-gray radius-t-10">
                        <div class="d-flex align-items-center">
                            <img src="<?=url('assets/img/author_img/sharon.jpg')?>" width="80" class="radius-10" height="80" alt="Sharon Cross">
                            <div class="ms-lg-3 ms-1">
                                <p class="font-s-21"><strong>Sharon Cross</strong></p>
                                <p><strong>Student</strong></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <strong class="ms-1">5/5</strong>
                        </div>
                    </div>
                    <p class="col-12 p-2 font-s-15">Fantastic experience! This product exceeded my expectations. It's user-friendly, reliable, and truly versatile. I appreciate the attention to detail and the overall quality. Highly recommend for anyone seeking a top-notch solution.</p>
                </div>
            </div>
            <div class="col-lg-6 p-2">
                <div class="row radius-10 border">
                    <div class="col-12 d-flex flex-wrap justify-content-between p-2 bg-gray radius-t-10">
                        <div class="d-flex align-items-center">
                            <img src="<?=url('assets/img/author_img/jenna_louise.jpg')?>" width="80" class="radius-10" height="80" alt="Jenna Louise">
                            <div class="ms-lg-3 ms-1">
                                <p class="font-s-21"><strong>Jenna Louise</strong></p>
                                <p><strong>Student</strong></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <strong class="ms-1">5/5</strong>
                        </div>
                    </div>
                    <p class="col-12 p-2 font-s-15">I'm impressed with this calculator site. Simple interface, accurate results, and a range of functions. It's my go-to for quick calculations. Efficient and reliable—I highly recommend it for its convenience and ease of use.</p>
                </div>
            </div>
            <div class="col-lg-6 p-2">
                <div class="row radius-10 border">
                    <div class="col-12 d-flex flex-wrap justify-content-between p-2 bg-gray radius-t-10">
                        <div class="d-flex align-items-center">
                            <img src="<?=url('assets/img/author_img/david_henry.jpg')?>" width="80" class="radius-10" height="80" alt="David Henry">
                            <div class="ms-lg-3 ms-1">
                                <p class="font-s-21"><strong>David Henry</strong></p>
                                <p><strong>Professor</strong></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <strong class="ms-1">5/5</strong>
                        </div>
                    </div>
                    <p class="col-12 p-2 font-s-15">This health calculator is a game-changer! Easy-to-use, comprehensive, and offers valuable insights. From BMI to calorie counting, it covers it all. A must-try for anyone serious about their well-being. Highly recommended for accuracy and convenience!</p>
                </div>
            </div>
            <div class="col-lg-6 p-2">
                <div class="row radius-10 border">
                    <div class="col-12 d-flex flex-wrap justify-content-between p-2 bg-gray radius-t-10">
                        <div class="d-flex align-items-center">
                            <img src="<?=url('assets/img/author_img/ayyan.jpg')?>" width="80" class="radius-10" height="80" alt="Ayyan bin Musa">
                            <div class="ms-lg-3 ms-1">
                                <p class="font-s-21"><strong>عيان بن موسى</strong></p>
                                <p><strong>طالب</strong></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <strong class="ms-1">5/5</strong>
                        </div>
                    </div>
                    <p class="col-12 p-2 font-s-15">لقد كان اكتشاف موقع الآلة الحاسبة هذا بمثابة تغيير جذري في قواعد اللعبة! يوفر تجربة سلسة مع نتائج دقيقة. مجموعة متنوعة من الآلات الحاسبة، من المالية إلى الصحية، تناسب احتياجاتي المتنوعة. إنه رفيقي الموثوق لإجراء العمليات الحسابية السريعة والدقيقة</p>
                </div>
            </div>
            <div class="col-lg-6 p-2">
                <div class="row radius-10 border">
                    <div class="col-12 d-flex flex-wrap justify-content-between p-2 bg-gray radius-t-10">
                        <div class="d-flex align-items-center">
                            <img src="<?=url('assets/img/author_img/aaditeya.jpg')?>" width="80" class="radius-10" height="80" alt="Aaditeya">
                            <div class="ms-lg-3 ms-1">
                                <p class="font-s-21"><strong>Aaditeya</strong></p>
                                <p><strong>Student</strong></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <strong class="ms-1">5/5</strong>
                        </div>
                    </div>
                    <p class="col-12 p-2 font-s-15">इस ऑनलाइन वेबसाइट पर गणित कैलकुलेटर गेम-चेंजर है! इसका उपयोगकर्ता-अनुकूल इंटरफ़ेस और त्वरित गणना इसे मेरा पसंदीदा उपकरण बनाती है। बुनियादी अंकगणित से लेकर जटिल समीकरणों तक, यह एक बहुमुखी और विश्वसनीय साथी है। गणित के कार्यों को सुव्यवस्थित करना कभी भी इतना कुशल</p>
                </div>
            </div>
            <div class="col-lg-6 p-2">
                <div class="row radius-10 border">
                    <div class="col-12 d-flex flex-wrap justify-content-between p-2 bg-gray radius-t-10">
                        <div class="d-flex align-items-center">
                            <img src="<?=url('assets/img/author_img/john_moore.jpg')?>" width="80" class="radius-10" height="80" alt="John Moore">
                            <div class="ms-lg-3 ms-1">
                                <p class="font-s-21"><strong>John Moore</strong></p>
                                <p><strong>Professor</strong></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <img src="<?=url('assets/img/yellow-star.svg') ?>" width="18" height="18" alt="Rate Star">
                            <strong class="ms-1">5/5</strong>
                        </div>
                    </div>
                    <p class="col-12 p-2 font-s-15">Exceptional online calculator website! With a user-friendly interface and a wide range of calculators, it's my go-to resource for quick and accurate computations. The platform's versatility caters to diverse needs, making it an invaluable tool for both personal and professional use.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection