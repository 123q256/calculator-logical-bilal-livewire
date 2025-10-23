@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)

@section('content')
<div class="bg-gray py-4">
    <div class="container">
        <div class="row">
            <h1 class="px-2 mb-2 font-s-25 text-center text-blue">Our Team</h1>
            <div class="content">
                <p class="px-2 my-2 text-center font-s-14">
                    At calculator-online.net, our dedicated team makes calculations easy for you by bringing advanced tools and solutions to your problems.
                </p>
            </div>
        </div>
    </div>
</div>
<div class="bg-white py-3">
    <div class="container">
        <div class="row px-2">
            <div class="col-12 mt-3 d-flex {{ $device=='mobile'?'flex-wrap':'' }}" id="haseeb-ahmad">
                <img src="<?=url('assets/img/author_img/haseebbhai.png')?>" width="250" class="authors_img" height="250" alt="Haseeb Ahmad" style="border-radius: 150px;">
                <div class="ms-lg-4 mx-0">
                    <p class="font-s-25"><strong>Haseeb Ahmad</strong></p>
                    <p class="font-s-18 mt-2"><strong>Math</strong></p>
                    <p>M.Sc. Computer Science</p>
                    <p class="font-s-18 mt-2"><strong>Expertise</strong></p>
                    <p>Mathematics, Signals & Systems, Machine Learning, Computer Engineering</p>
                    <p class="font-s-18 mt-3"><strong>Experience</strong></p>
                    <p>
                        Haseeb Ahmad is a highly skilled individual with a strong academic background and expertise in the field of Computer Science. He holds a Master's degree (M.Sc.) in Computer Science from McGill University in Montreal, showcasing his commitment to excellence in Math. His academic journey has equipped him with a strong understanding of Mathematics, Signals and systems, Machine Learning, and Computer Engineering.
                    </p>
                    <p class="mt-3">
                        <a href="https://www.linkedin.com/in/haseeb-ahmad-964473179/">
                            <img src="<?= url('assets/img/linkedin_.webp') ?>" width="30" height="auto" alt="LinkedIn">
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-12 mt-3 d-flex {{ $device=='mobile'?'flex-wrap':'' }}" id="zain-tariq">
                <img src="<?=url('assets/img/author_img/zainpic.png')?>" width="250" class="authors_img" height="250" alt="Zain Tariq" style="border-radius: 150px;">
                <div class="ms-lg-4 mx-0">
                    <p class="font-s-25"><strong>Zain Tariq</strong></p>
                    <p class="font-s-18 mt-2"><strong>Math</strong></p>
                    <p>Master's Degree In Business Administration</p>
                    <p class="font-s-18 mt-2"><strong>Expertise</strong></p>
                    <p>Systems analysis, Mathematical and deductive reasoning, Critical thinking, Accounting & Finance</p>
                    <p class="font-s-18 mt-3"><strong>Experience</strong></p>
                    <p>
                        Zain Tariq has a Master's Degree in Business Administration from WHU - Otto Beisheim School of Management, Germany. He's really good at figuring out how systems work by using math and logical thinking. Zain is also great at solving problems and has a good grasp of finance and accounting. His skills make him well-rounded in handling different business situations.
                    </p>
                    <p class="mt-3">
                        <a href="https://www.linkedin.com/in/zain-web-developer/">
                            <img src="<?= url('assets/img/linkedin_.webp') ?>" width="30" height="auto" alt="LinkedIn">
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-12 mt-3 d-flex {{ $device=='mobile'?'flex-wrap':'' }}">
                <img src="<?=url('assets/img/author_img/reshaeelpic.png')?>" width="250" class="authors_img" height="250" alt="Reshaeel Sarwar" style="border-radius: 150px;">
                <div class="ms-lg-4 mx-0">
                    <p class="font-s-25"><strong>Reshaeel Sarwar</strong></p>
                    <p class="font-s-18 mt-2"><strong>Math</strong></p>
                    <p>M.Sc. Cybersecurity and Network Engineering</p>
                    <p class="font-s-18 mt-2"><strong>Expertise</strong></p>
                    <p>Mathematical Model, Circuit Analysis, Networking Architecture, Mathematics, Numerical Analysis, Calculus, Probability, Technical Writing</p>
                    <p class="font-s-18 mt-3"><strong>Experience</strong></p>
                    <p>
                        A writing detective who conducts proper research to arrive at the best solution always. Curious about learning, he is passionate about investigating every problem keenly.  Holding a Master's Degree in Engineering and years of experience, he has a keen vision and the power to narrate technical writings engagingly. He loves to play Guitar in his spare time and is adaptive to learning.
                    </p>
                    <p class="mt-3">
                        <a href="https://www.linkedin.com/in/reshaeel-sarwar-%F0%9F%87%B5%F0%9F%87%B0-31a95017a/">
                            <img src="<?= url('assets/img/linkedin_.webp') ?>" width="30" height="auto" alt="LinkedIn">
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-12 mt-3 d-flex {{ $device=='mobile'?'flex-wrap':'' }}" id="mamoor-rasheed">
                <img src="<?=url('assets/img/author_img/mamoorpicnew.png')?>" width="250" class="authors_img" height="250" alt="Mamoor Rasheed" style="border-radius: 150px;">
                <div class="ms-lg-4 mx-0">
                    <p class="font-s-25"><strong>Mamoor Rasheed</strong></p>
                    <p class="font-s-18 mt-2"><strong>Math</strong></p>
                    <p>Ph.D Business Management</p>
                    <p class="font-s-18 mt-2"><strong>Expertise</strong></p>
                    <p>Statistical Languages, Problem Solving, Business Maths, Financial Case Handling</p>
                    <p class="font-s-18 mt-3"><strong>Experience</strong></p>
                    <p>
                        Mamoor Rasheed started his career in Business & Finance Industry about a decade ago. We call him our valuable business doctor due to his unbeatable skills in the finance field. He has a keen eye for analyzing business infrastructure and accounting calculations. He provides the best-ever strategies to design calculators that help accountants reduce their time for financial record maintenance, working in reputable firms globally.
                    </p>
                    <p class="mt-3">
                        <a href="https://www.linkedin.com/in/mamoor-rasheed-8b000282/">
                            <img src="<?= url('assets/img/linkedin_.webp') ?>" width="30" height="auto" alt="LinkedIn">
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-12 mt-3 d-flex {{ $device=='mobile'?'flex-wrap':'' }}" id="katherine-paul">
                <img src="<?=url('assets/img/author_img/katherine.png')?>" width="250" class="authors_img" height="250" alt="Katherine Paul" style="border-radius: 150px;">
                <div class="ms-lg-4 mx-0">
                    <p class="font-s-25"><strong>Katherine Paul</strong></p>
                    <p class="font-s-18 mt-2"><strong>Math</strong></p>
                    <p>PhD Nutrition Science</p>
                    <p class="font-s-18 mt-2"><strong>Expertise</strong></p>
                    <p>Nutrition Planning, Diet Expert</p>
                    <p class="font-s-18 mt-3"><strong>Experience</strong></p>
                    <p>
                        Katherine Paula is a recognized nutritionist and certified dietician who is willing to promote a healthy lifestyle via her nutritional guides. Holding immense expertise and a degree in nutrition from the University of San Sabastian, where she graduated in the class of 2016. Katherine has always shown a dedication to empowering individuals to achieve their wellness goals. She has focused on creating effective nutritional plans for people to the best of her know-how.
                    </p>
                    <p class="mt-3">
                        <a href="https://www.linkedin.com/in/katherine-paul-b8467a2b8/">
                            <img src="<?= url('assets/img/linkedin_.webp') ?>" width="30" height="auto" alt="LinkedIn">
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-12 mt-3 d-flex {{ $device=='mobile'?'flex-wrap':'' }}">
                <img src="<?=url('assets/img/author_img/talhapicnew.png')?>" width="250" class="authors_img" height="250" alt="Talha Munir" style="border-radius: 150px;">
                <div class="ms-lg-4 mx-0">
                    <p class="font-s-25"><strong>Talha Munir</strong></p>
                    <p class="font-s-18 mt-2"><strong>Math</strong></p>
                    <p>Bachelor In Computer Science (BSCS)</p>
                    <p class="font-s-18 mt-2"><strong>Expertise</strong></p>
                    <p>Computer Architecture, Mathematics, Technical Writing</p>
                    <p class="font-s-18 mt-3"><strong>Experience</strong></p>
                    <p>
                        Talha holds a Bachelor's degree in Computer Science and is currently a Master's student at the University of Edinburgh, United Kingdom. He has a strong passion for understanding technical concepts related to computer language and writing content that engages with the targeted audience. Enjoys cycling and traveling to stay active. His comedic nature always adds spicy fun to productivity.
                    </p>
                    <p class="mt-3">
                        <a href="https://www.linkedin.com/in/talha-munir-b42a191a6/?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app">
                            <img src="<?= url('assets/img/linkedin_.webp') ?>" width="30" height="auto" alt="LinkedIn">
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-12 mt-3 d-flex {{ $device=='mobile'?'flex-wrap':'' }}">
                <img src="<?=url('assets/img/author_img/haiderpic.png')?>" width="250" class="authors_img" height="250" alt="Haider Ali" style="border-radius: 150px;">
                <div class="ms-lg-4 mx-0">
                    <p class="font-s-25"><strong>Haider Ali</strong></p>
                    <p class="font-s-18 mt-2"><strong>Math</strong></p>
                    <p>Mphil Business Management</p>
                    <p class="font-s-18 mt-2"><strong>Expertise</strong></p>
                    <p>Data Analysis, Finance Modeling, Project Management, Market Research</p>
                    <p class="font-s-18 mt-3"><strong>Experience</strong></p>
                    <p>
                        Meet Haider, a passionate individual whose mind is loaded with an unbeatable research galaxy. He is very brilliant at optimizing clusters of problems related to work. Armed with a Masters degree in Business Administration, he has a solid foundation in key technical skills. He always brings a unique blend of creativity and analytical thinking to his work. We never refuse any idea or strategy proposed by him.
                    </p>
                    <p class="mt-3">
                        <a href="https://www.linkedin.com/in/talha-munir-b42a191a6/?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app">
                            <img src="<?= url('assets/img/linkedin_.webp') ?>" width="30" height="auto" alt="LinkedIn">
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-12 mt-3 d-flex {{ $device=='mobile'?'flex-wrap':'' }}" id="muhammad-uzair">
                <img src="<?=url('assets/img/author_img/uzairpic.png')?>" width="250" class="authors_img" height="250" alt="Muhammad Uzair" style="border-radius: 150px;">
                <div class="ms-lg-4 mx-0">
                    <p class="font-s-25"><strong>Dr. Muhammad Uzair</strong></p>
                    <p class="font-s-18 mt-2"><strong>Math</strong></p>
                    <p>Ph.D. In Health Sciences, USA</p>
                    <p class="font-s-18 mt-2"><strong>Expertise</strong></p>
                    <p>Clinical Knowledge, Diet Planning, Nutritional Science</p>
                    <p class="font-s-18 mt-3"><strong>Experience</strong></p>
                    <p>
                        Dr. Muhammad Uzair is a highly accomplished professional in the field of Health Sciences, holding a Ph.D. Degree. He is a Registered Dietician-Nutritionist (RDN) and Registered Personal Trainer (CPT). With a passion for enhancing individual well-being, he specializes in clinical knowledge, diet planning, and nutritional science.Dr. Uzair has been a Chairperson of a Sports NGO for more than 6 years. He has taught sports nutrition to medical students at King Edward Medical University and conducted different examinations accordingly.
                    </p>
                    <p class="mt-3">
                        <a href="#">
                            <img src="<?= url('assets/img/linkedin_.webp') ?>" width="30" height="auto" alt="LinkedIn">
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-12 mt-3 d-flex {{ $device=='mobile'?'flex-wrap':'' }}" id="john-stiff">
                <img src="<?=url('assets/img/author_img/johnpic.png')?>" width="250" class="authors_img" height="250" alt="John Stiff" style="border-radius: 150px;">
                <div class="ms-lg-4 mx-0">
                    <p class="font-s-25"><strong>John Stiff</strong></p>
                    <p class="font-s-18 mt-2"><strong>Math</strong></p>
                    <p>Ph.D. Mathematics</p>
                    <p class="font-s-18 mt-2"><strong>Expertise</strong></p>
                    <p>Graph Theory, Differential Equations, and Transforms, Probability & Statistics</p>
                    <p class="font-s-18 mt-3"><strong>Experience</strong></p>
                    <p>
                        John holds a strong mathematical background. He has secured a Ph.D. degree in Mathematics and possesses strong thinking capabilities. He has built up a strong career in the field of mathematics, especially Graph Theory. His nature of analyzing sketches of different problems is worth considering. His academic journey reflects a deep commitment to the best research and scholarly pursuits.
                    </p>
                    <p class="mt-3">
                        <a href="https://www.linkedin.com/in/john-stiff-20b6802b8/">
                            <img src="<?= url('assets/img/linkedin_.webp') ?>" width="30" height="auto" alt="LinkedIn">
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-12 mt-3 d-flex {{ $device=='mobile'?'flex-wrap':'' }}" id="anna-steve">
                <img src="<?=url('assets/img/author_img/johnpic.png')?>" width="250" class="authors_img" height="250" alt="Anna Steve" style="border-radius: 150px;">
                <div class="ms-lg-4 mx-0">
                    <p class="font-s-25"><strong>Anna Steve</strong></p>
                    <p class="font-s-18 mt-2"><strong>Math</strong></p>
                    <p>Ph.D. Mechanical Engineering</p>
                    <p class="font-s-18 mt-2"><strong>Expertise</strong></p>
                    <p>Test Method Development, Troubleshooting, AutoCAD, Attention to detail, Analysis, Mathematics</p>
                    <p class="font-s-18 mt-3"><strong>Experience</strong></p>
                    <p>
                        Anna Steve is a highly accomplished professional with a Ph.D. in Mechanical Engineering from the prestigious University College London in the United Kingdom. Her academic background guarantees a deep commitment to his Mathal field. With a specialization in Test Method Development, Dr. Steve has established herself as an expert in troubleshooting and possesses a keen attention to detail. Her proficiency extends to AutoCAD, where she applies her skills to create precise and efficient designs.
                    </p>
                    <p class="mt-3">
                        <a href="https://www.linkedin.com/in/anna-steve-b2a4a6193/">
                            <img src="<?= url('assets/img/linkedin_.webp') ?>" width="30" height="auto" alt="LinkedIn">
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-12 mt-3 d-flex {{ $device=='mobile'?'flex-wrap':'' }}" id="tim-paul">
                <img src="<?=url('assets/img/author_img/newTimImage.jpg')?>" width="250" class="authors_img" height="250" alt="Tim Paul" style="border-radius: 150px;">
                <div class="ms-lg-4 mx-0">
                    <p class="font-s-25"><strong>Tim Paul</strong></p>
                    <p class="font-s-18 mt-2"><strong>Math</strong></p>
                    <p>Master of Science in Nutrition (MSc)</p>
                    <p class="font-s-18 mt-2"><strong>Expertise</strong></p>
                    <p>Nutrition Planning, Diet Expert</p>
                    <p class="font-s-18 mt-3"><strong>Experience</strong></p>
                    <p>
                        Tim is a certified sports medicine and fitness expert, with extensive experience in nutrition, fitness, and workout methodologies. As an expert, he understands the importance of diverse body types and the impact of body shape on the appearance and overall well-being of humans.
                    </p>
                    <p class="mt-3">
                        <a href="https://www.linkedin.com/in/tim-paul-9956812b8/">
                            <img src="<?= url('assets/img/linkedin_.webp') ?>" width="30" height="auto" alt="LinkedIn">
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection