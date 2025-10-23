<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: "Poppins";
        }
    </style>
        <style>
            /* home section */
          .green_color li.active {
                background-color: black;
            }

            .green_color li.active a {
                color: white; /* Change text color */
            }

            .green_color li a {
                transition: all 0.3s ease;
            }

            .green_color li:hover {
                background-color: #99EA48;
            }

            .green_color li:hover a {
                color: black !important;
            }

            /* Targeting the SVG path in the active state */
            .green_color li.active a .svg-path {
                fill: white; /* Change SVG fill color when active */
            }

            /* Targeting the SVG path on hover */
            .green_color li:hover a .svg-path {
                fill: black !important; /* Change SVG fill color on hover */
            }
            /* home section */

            /* other Menu */

            .green_color ul li.active {
                background-color: black;
            }
            .green_color ul li.active a {
                color: white; /* Change text color */
            }

            .green_color ul li.active a svg path {
                fill: black; /* Change SVG color */
            }
            .green_color ul li a {
                transition: all 0.3s ease;
            }
            .green_color ul li:hover {
                background-color: #99EA48;
                color: black !important;
            }
            .green_color ul li:hover a {
                color: black !important;
            }
            /* other Menu */

        </style>
</head>
<body>

   
    <div class="container-fluid mx-auto  container-fluid ">
        <nav class="bg-white  w-full  border-gray-200">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="#" class="flex items-center space-x-3 rtl:space-x-revers">
                    <img src="{{ asset('new_page/logo.svg') }}" alt="Flowbite Logo" />
                </a>
                <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                    <!-- Search Icon -->
                    <a href="#" class="bg-black text-white p-3 rounded-full">
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.9 7.70001C14.9 4.60721 12.3928 2.1 9.29999 2.1C6.20719 2.1 3.69998 4.60721 3.69998 7.70001C3.69998 10.7928 6.20719 13.3 9.29999 13.3C12.3928 13.3 14.9 10.7928 14.9 7.70001ZM9.29999 0.5C13.2764 0.5 16.5 3.72356 16.5 7.70001C16.5 11.6765 13.2764 14.9 9.29999 14.9C7.59999 14.9 6.03759 14.3108 4.80583 13.3255L1.86566 16.2657C1.55326 16.5781 1.0467 16.5781 0.734301 16.2657C0.4219 15.9533 0.4219 15.4467 0.734301 15.1343L3.67446 12.1942C2.68918 10.9624 2.09998 9.40001 2.09998 7.70001C2.09998 3.72356 5.32351 0.5 9.29999 0.5Z" fill="#E8FFF1"/>
                        </svg>
                    </a>
                    <!-- Language Selector -->
                    <a href="#" class="bg-[#99EA48] text-black px-4 py-2 rounded-full flex items-center space-x-2">
                        <span>EN</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </a>
                    <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-sticky" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                        </svg>
                    </button>
                </div>
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1 green_color" id="navbar-sticky">
                    <ul class="flex items-center space-x-4 relative border-2 border-black-400 px-3 py-1 rounded-full">
                        <li class="rounded-full px-6 py-3 flex items-center  active">
                            <a href="#" class="flex items-center">
                                <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                    <path class="svg-path" fill-rule="evenodd" clip-rule="evenodd" d="M9.45488 2.70134C8.59512 1.99878 7.40488 1.99878 6.5452 2.70134L2.23631 6.2225C1.8434 6.54359 1.6 7.05088 1.6 7.60358V13.0947C1.6 14.0969 2.36171 14.8256 3.2 14.8256H4.8V12.2541C4.8 10.471 6.18732 8.94176 8 8.94176C9.81272 8.94176 11.2 10.471 11.2 12.2541V14.8256H12.8C13.6383 14.8256 14.4 14.0969 14.4 13.0947V7.60358C14.4 7.05088 14.1566 6.54359 13.7637 6.22251L9.45488 2.70134Z" fill="#000000"/>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li class="rounded-full px-6 py-3">
                            <button id="dropdownNavbarLinkblogs" data-dropdown-toggle="dropdownNavbarblogs" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded md:border-0  md:p-0 md:w-auto">
                                <span class="leading-0">Blogs</span>
                                <span class="mt-[6px]">
                                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"></path>
                                    </svg>
                                </span>
                            </button>
                            <div id="dropdownNavbarblogs" class="z-10 font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 hidden" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(820px, 120px, 0px);" data-popper-placement="bottom">
                                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                                    <li >
                                        <a href="#" class=" block px-4 py-2 text-gray-800 hover:bg-[#99EA48] hover:text-black" >Category 1</a>
                                    </li>
                                    <li>
                                        <a href="#" class=" block px-4 py-2 text-gray-800 hover:bg-[#99EA48] hover:text-black" >Category 2</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="rounded-full px-6 py-3 ">
                            <a href="#">Blog</a>
                        </li>
                        <li class="rounded-full px-6 py-3">
                            <a href="#">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- TECHNICAL CALCULATOR -->
    <div class="container-fluid mx-auto  container-fluid mt-[20px]">
        <div class="max-w-screen-xl mx-auto bg-black py-8 rounded-lg text-center">
            <h2 class="text-2xl lg:text-5xl md:text-5xl font-semibold text-[#E8FFF1]">TECHNICAL CALCULATOR</h2>
            <p class="text-1xl lg:text-3xl md:text-3xl text-[#E8FFF1] mt-2">FOR STUDENTS, BUSINESS, TRADERS & ACCOUNTANTS</p>
            <div class="flex justify-center mt-4">
                <button class=" px-6 py-4 bg-transparent text-white font-medium border border-[#99EA48] rounded-full">
                    Go for all Categories
                </button>
                <button class=" px-5 py-4 bg-transparent text-white font-medium border border-[#99EA48] rounded-full hover:bg-[#99EA48] hover:text-black group">
                    <a href="target_id">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg" class="group-hover:fill-white transition duration-200">
                        <path d="M7.71875 1.28125C7.71875 1.7125 8.06875 2.0625 8.5 2.0625C12.05 2.0625 14.9375 4.95 14.9375 8.5C14.9375 12.05 12.05 14.9375 8.5 14.9375C8.06875 14.9375 7.71875 15.2875 7.71875 15.7188C7.71875 16.15 8.06875 16.5 8.5 16.5C10.6375 16.5 12.6469 15.6687 14.1562 14.1562C15.6687 12.6437 16.5 10.6375 16.5 8.5C16.5 6.3625 15.6687 4.35312 14.1562 2.84375C12.6437 1.33125 10.6375 0.5 8.5 0.5C8.06875 0.5 7.71875 0.85 7.71875 1.28125Z" class="fill-[#99EA48] group-hover:fill-black transition duration-200"/>
                        <path d="M11.2375 9.57198C11.525 9.28448 11.6812 8.90323 11.6812 8.5001C11.6812 8.09385 11.5219 7.7126 11.2375 7.42823L9.27188 5.4626C8.96563 5.15635 8.47187 5.15635 8.16562 5.4626C7.85937 5.76885 7.85937 6.2626 8.16562 6.56885L9.31875 7.71885L1.28125 7.71885C0.85 7.71885 0.5 8.06885 0.5 8.5001C0.5 8.93135 0.85 9.28135 1.28125 9.28135L9.31875 9.28135L8.16563 10.4345C7.85937 10.7407 7.85937 11.2345 8.16563 11.5407C8.47188 11.847 8.96563 11.847 9.27188 11.5407L11.2375 9.57198Z" class="fill-[#99EA48] group-hover:fill-black transition duration-200"/>
                    </svg></a>
                </button>
            </div>
        </div>
    </div>
         <!-- Search bar -->
    <div class="container-fluid mx-auto mt-6">
        <div class="w-full lg:max-w-[52%] mx-auto bg-white p-4 rounded-lg">
       
            <div class="relative mb-4">
                <input type="text" placeholder="Type your calculator name" class="w-full p-5 rounded-full border border-black focus:outline-none">
                <button class="absolute right-2 top-1/2 transform -translate-y-1/2 rounded-full bg-black p-5 flex items-center justify-center transition duration-300 hover:bg-[#99EA48]">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg" class="transition duration-200">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.9 7.70001C14.9 4.60721 12.3928 2.1 9.29999 2.1C6.20719 2.1 3.69998 4.60721 3.69998 7.70001C3.69998 10.7928 6.20719 13.3 9.29999 13.3C12.3928 13.3 14.9 10.7928 14.9 7.70001ZM9.29999 0.5C13.2764 0.5 16.5 3.72356 16.5 7.70001C16.5 11.6765 13.2764 14.9 9.29999 14.9C7.59999 14.9 6.03759 14.3108 4.80583 13.3255L1.86566 16.2657C1.55326 16.5781 1.0467 16.5781 0.734301 16.2657C0.4219 15.9533 0.4219 15.4467 0.734301 15.1343L3.67446 12.1942C2.68918 10.9624 2.09998 9.40001 2.09998 7.70001C2.09998 3.72356 5.32351 0.5 9.29999 0.5Z" class="fill-[#E8FFF1] group-hover:fill-black transition duration-200" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    {{-- calculator --}}
    <div class="container-fluid mx-auto mb-10">
        <div class="w-full lg:max-w-[50%] mx-auto bg-[#EBEBEB] p-4 rounded-lg shadow-md">
            <!-- Display -->
            <div class="text-2xl p-3 bg-gray-50 rounded-l-lg rounded-r-lg mb-3">
                <div class="text-left text-2xl p-1 bg-gray-50 rounded-l-lg rounded-r-lg">5x3/3</div>
                <div class="text-right text-2xl p-1 mb-3 bg-gray-50 ">5.00</div>
            </div>
            <div class="text-center bg-[#99EA48] text-white font-bold p-3 rounded-lg mb-3 hidden lg:block md:block">
                Check out all Calculators and Different Categories.
            </div>
            <div id="scientific-title" class="text-center bg-[#99EA48] text-white font-bold p-3 rounded-lg mb-3 block lg:hidden md:hidden">
                Simple Calculator
            </div>
            <div id="toggle-btn" class="text-center bg-[#99EA48] text-white font-bold p-3 rounded-lg mb-3 hidden">
                Scientific Calculator
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-4 md:gap-4">
                <div class="grid grid-cols-5 bg-white" id="calculator-grid">
                    <!-- First row -->
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">sin</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">cos</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">tan</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">Deg</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">Rad</button>
    
                    <!-- Second row -->
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">sin⁻¹</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">cos⁻¹</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">tan⁻¹</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">e</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">π</button>
    
                    <!-- Third row -->
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">eˣ</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">xʸ</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">x²</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">x²</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">x²</button>
    
                    <!-- Fourth row -->
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">√x</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">³√x</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">1/x</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">%</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">%</button>
    
                    <!-- Fifth row -->
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">(</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">)</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">n!</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-[#99EA48] rounded-lg">×</button>
                    <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-[#99EA48] rounded-lg">×</button>
    
                  
                </div>
    
                <!-- Right side: Last 5 buttons -->
                <div class="grid grid-cols-5  bg-white">

                      <!-- Sixth row -->
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">1</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">2</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">3</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-[#99EA48] rounded-lg">+</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-[#99EA48] rounded-lg">+</button>
      
                      <!-- Seventh row -->
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">4</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">5</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">6</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-[#99EA48] rounded-lg">-</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-[#99EA48] rounded-lg">-</button>
      
                      <!-- Eighth row -->
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">7</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">8</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">9</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-[#99EA48] rounded-lg">/</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-[#99EA48] rounded-lg">/</button>
      
                      <!-- Ninth row -->
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">0</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">.</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-[#99EA48] rounded-lg">=</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">AC</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">AC</button>
                    
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">0</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">.</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-[#99EA48] rounded-lg">=</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">AC</button>
                      <button class="py-1 px-2 m-1 lg:m-2 md:m-2 bg-gray-200 rounded-lg">AC</button>
                </div>
            </div>
        </div>
    </div>
    {{-- images of calculator --}}
    <div class="container-fluid mx-auto mb-10 lg:mt-[60px] md:mt-[60px] ">
        <div class="max-w-screen-xl mx-auto flex flex-wrap  p-4 rounded-lg justify-center   ">
            <div class="grid grid-cols-1 lg:grid-cols-[35%,80%] md:grid-cols-2 md:gap-2">
                <!-- First Column - 40% width -->
                <div class="bg-white rounded-lg flex justify-center ">
                    <img src="{{ asset('new_page/view_all.svg') }}" alt="Flowbite Logo" />
                </div>
    
                <!-- Second Column - 60% width -->
                <div class="bg-white rounded-lg  hidden lg:block md:block">
                    <img src="{{ asset('new_page/all_calculator.svg') }}" alt="Flowbite Logo" />
                </div>
            </div>
        </div>
    </div>
    {{-- View All The Categories --}}
    <div class="flex flex-col items-center lg:py-8 bg-[#F6F6F6]" id="target_id">
        <!-- Categories Heading -->
        <div class="text-center">
            <button class="px-4 py-2 bg-[#99EA48]  rounded-full mb-4 mt-8">Categories</button>
            <h1 class="text-3xl font-bold">View All The Categories</h1>
        </div>
        <!-- Categories Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-5 gap-6 mt-8 text-center mb-5 mx-2">
            <a href="#" class="w-full flex items-center space-x-3 rtl:space-x-reverse">
                <div class="w-full flex flex-col items-center bg-[#99EA48]  p-6 px-[40px] rounded-[30px] mb-3 shadow-md">
                    <img src="{{ asset('new_page/math.svg') }}" alt="Flowbite Logo" />
                    <h2 class="text-lg font-semibold">Mathematic </h2>
                    <h2 class="text-lg font-semibold"> Calculator</h2>
                </div>
            </a>
            <a href="#" class="w-full flex items-center space-x-3 rtl:space-x-reverse">
                <div class="w-full flex flex-col items-center bg-[#99EA48]  p-6 px-[40px] rounded-[30px] mb-3 shadow-md">
                    <img src="{{ asset('new_page/finance.svg') }}" alt="Flowbite Logo" />
                    <h2 class="text-lg font-semibold">Finance </h2>
                    <h2 class="text-lg font-semibold"> Calculator</h2>
                </div>
            </a>
            <a href="#" class="w-full flex items-center space-x-3 rtl:space-x-reverse">
                <div class="w-full flex flex-col items-center bg-[#99EA48]  p-6 px-[40px] rounded-[30px] mb-3 shadow-md">
                    <img src="{{ asset('new_page/stat.svg') }}" alt="Flowbite Logo" />
                    <h2 class="text-lg font-semibold">Statistics </h2>
                    <h2 class="text-lg font-semibold"> Calculator</h2>
                </div>
            </a>
            <a href="#" class="w-full flex items-center space-x-3 rtl:space-x-reverse">
                <div class="w-full flex flex-col items-center bg-[#99EA48]  p-6 px-[40px] rounded-[30px] mb-3 shadow-md">
                    <img src="{{ asset('new_page/dailylife.svg') }}" alt="Flowbite Logo" />
                    <h2 class="text-lg font-semibold">Daily Life </h2>
                    <h2 class="text-lg font-semibold">  Calculator</h2>
                </div>
            </a>
            <a href="#" class="w-full flex items-center space-x-3 rtl:space-x-reverse">
                <div class="w-full flex flex-col items-center bg-[#99EA48]  p-6 px-[40px] rounded-[30px] mb-3 shadow-md">
                    <img src="{{ asset('new_page/health.svg') }}" alt="Flowbite Logo" />
                    <h2 class="text-lg font-semibold">Health </h2>
                    <h2 class="text-lg font-semibold"> Calculator</h2>
                </div>
            </a>
            <a href="#" class="w-full flex items-center space-x-3 rtl:space-x-reverse">
                <div class="w-full flex flex-col items-center bg-[#99EA48]  p-6 px-[40px] rounded-[30px] mb-3 shadow-md">
                    <img src="{{ asset('new_page/physics.svg') }}" alt="Flowbite Logo" />
                    <h2 class="text-lg font-semibold">Physics </h2>
                    <h2 class="text-lg font-semibold"> Calculator</h2>
                </div>
            </a>
            <a href="#" class="w-full flex items-center space-x-3 rtl:space-x-reverse">
                <div class="w-full flex flex-col items-center bg-[#99EA48]  p-6 px-[40px] rounded-[30px] mb-3 shadow-md">
                    <img src="{{ asset('new_page/chemistry.svg') }}" alt="Flowbite Logo" />
                    <h2 class="text-lg font-semibold">Chemistry </h2>
                    <h2 class="text-lg font-semibold"> Calculator</h2>
                </div>
            </a>
            <a href="#" class="w-full flex items-center space-x-3 rtl:space-x-reverse">
                <div class="w-full flex flex-col items-center bg-[#99EA48]  p-6 px-[40px] rounded-[30px] mb-3 shadow-md">
                    <img src="{{ asset('new_page/construction.svg') }}" alt="Flowbite Logo" />
                    <h2 class="text-lg font-semibold">Construction </h2>
                    <h2 class="text-lg font-semibold"> Calculator</h2>
                </div>
            </a>
            <a href="#" class="w-full flex items-center space-x-3 rtl:space-x-reverse">
                <div class="w-full flex flex-col items-center bg-[#99EA48]  p-6 px-[40px] rounded-[30px] mb-3 shadow-md">
                    <img src="{{ asset('new_page/pets.svg') }}" alt="Flowbite Logo" />
                    <h2 class="text-lg font-semibold">Pets </h2>
                    <h2 class="text-lg font-semibold"> Calculator</h2>
                </div>
            </a>
            <a href="#" class="w-full flex items-center space-x-3 rtl:space-x-reverse">
                <div class="w-full flex flex-col items-center bg-[#99EA48]  p-6 px-[40px] rounded-[30px] mb-3 shadow-md">
                    <img src="{{ asset('new_page/datetime.svg') }}" alt="Flowbite Logo" />
                    <h2 class="text-lg font-semibold">Date & Time </h2>
                    <h2 class="text-lg font-semibold"> Calculator</h2>
                </div>
            </a>
        </div>
        
    </div>
    {{-- About Calculator --}}
    <div class="container-fluid mx-auto mb-10 lg:mt-[60px] md:mt-[60px] ">
        <div class="max-w-screen-xl mx-auto flex flex-wrap  p-4 rounded-lg justify-center">
            <div class="text-center flex ">
                <button class="px-4 py-2 bg-[#99EA48]  rounded-full mb-4 mt-4">About Calculator</button>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 md:gap-2 mt-8">
                <!-- First Column - 40% width -->
                <div class="bg-white rounded-lg  ">
                    <h3 class="text-3xl lg:text-6xl md:text-6xl font-bold lg:mt-[60px]">  Ultimate   </h3>
                    <h3 class="text-3xl lg:text-6xl md:text-6xl font-bold lg:mt-[10px]">   Technical  </h3>
                    <h3 class="text-3xl lg:text-6xl md:text-6xl font-bold lg:mt-[10px]">    Calculators </h3>
                    <p class=" mt-5 lg:mt-[90px] lg:pr-[60px]">Discover a wide range of technical calculators designed for engineers, students, and professionals. Whether you need to perform complex equations, conversions, or specialized calculations, our tools are tailored to handle it all with speed and accuracy.</p>
                    <p class=" lg:pr-[60px]">From basic math functions to intricate engineering formulas, Technical Calculator provides you with reliable solutions at your fingertips. Experience the power of precision and efficiency with our free calculators that are built to meet your technical needs!   </p>
                </div>
                <!-- Second Column - 60% width -->
                <div class="bg-white rounded-lg  ">
                    <img src="{{ asset('new_page/aboutimg.svg') }}" alt="Flowbite Logo" />
                </div>
            </div>
        </div>
    </div>
    {{-- All Popular Calculators --}}

    <div class="flex flex-col items-center py-1">
        <div class="text-center">
            <button class="px-4 py-2 bg-[#99EA48] rounded-full mb-4">All Popular Calculators</button>
            <h1 class="text-1xl lg:text-3xl md:text-3xl font-bold">View all the Popular Calculators in every Category</h1>
        </div>
        <div class="mt-8 w-full max-w-6xl bg-right bg-cover bg-[#F6F6F6] rounded-[30px] ">
            <div class="flex flex-col lg:flex-row">
                <div class="lg:w-[40%]  md:w-[40%] w-full p-[20px] lg:p-[60px] md:p-[60px]  rounded-lg mb-6 lg:mb-0">
                    <div class="flex items-center mb-6">
                        <div class="bg-[#99EA48] p-4 rounded-[20px]">
                            <img src="{{ asset('new_page/math1.svg') }}" alt="Calculator Icon" class="w-8 h-8"/>
                        </div>
                    </div>
                    <p class="text-2xl font-bold">Mathematical</p>
                    <p class="text-2xl font-bold">Calculators</p>
                    <p class="text-gray-600 mb-6 mt-4 ">
                        Lorem ipsum dolor sit amet consectetur. Feugiat dictum in purus arcu. Eu iaculis aenean id integer.
                    </p>
                    <div class="w-[60%]">
                        <a href="#" class="text-black font-semibold flex items-center p-3  text-[25px] hover:bg-black hover:text-[#99EA48] group">
                            <span class="mx-4"> View All </span>
                            <svg width="24" height="15" viewBox="0 0 24 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.0475 9.79207C23.6646 9.17639 24 8.35994 24 7.49665C24 6.62667 23.6579 5.81023 23.0475 5.20124L18.8284 0.991874C18.171 0.336043 17.1112 0.336043 16.4539 0.991874C15.7965 1.64771 15.7965 2.70507 16.4539 3.3609L18.929 5.82361L1.67691 5.82361C0.751258 5.82361 9.45269e-08 6.57314 8.35141e-08 7.49665C7.25012e-08 8.42017 0.751258 9.16969 1.67691 9.16969L18.929 9.16969L16.4539 11.6391C15.7965 12.2949 15.7965 13.3523 16.4539 14.0081C17.1112 14.664 18.171 14.664 18.8284 14.0081L23.0475 9.79207Z" fill="black" class="group-hover:fill-[#99EA48] transition duration-200"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="lg:w-[60%]  md:w-[60%] w-full p-[20px] lg:p-[60px] md:p-[60px]  rounded-lg inset-0  bg-center bg-no-repeat filter" style="background-image: url('{{ asset('new_page/math_bg.svg') }}');">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center py-1">
        <div class="mt-8 w-full max-w-6xl bg-right bg-cover bg-[#ebf6e0] rounded-[30px] ">
            <div class="flex flex-col lg:flex-row">
                   <div class="lg:w-[60%]  md:w-[60%] w-full  order-2 lg:order-1 p-[20px] lg:p-[60px] md:p-[60px]   rounded-lg inset-0  bg-center bg-no-repeat filter" style="background-image: url('{{ asset('new_page/finance_bg.svg') }}');">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                    </div>
                </div>
                <div class="lg:w-[40%]  md:w-[40%] w-full  order-1 lg:order-2  p-[20px] lg:p-[60px] md:p-[60px]   rounded-lg mb-6 lg:mb-0">
                    <div class="flex items-center mb-6">
                        <div class="bg-[#99EA48] p-4 rounded-[20px]">
                            <img src="{{ asset('new_page/finance1.svg') }}" alt="Calculator Icon" class="w-8 h-8"/>
                        </div>
                    </div>
                    <p class="text-2xl font-bold">Finance</p>
                    <p class="text-2xl font-bold">Calculators</p>
                    <p class="text-gray-600 mb-6 mt-4 ">
                        Lorem ipsum dolor sit amet consectetur. Feugiat dictum in purus arcu. Eu iaculis aenean id integer.
                    </p>
                    <div class="w-[60%]">
                        <a href="#" class="text-black font-semibold flex items-center p-3  text-[25px] hover:bg-black hover:text-[#99EA48] group">
                            <span class="mx-4"> View All </span>
                            <svg width="24" height="15" viewBox="0 0 24 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.0475 9.79207C23.6646 9.17639 24 8.35994 24 7.49665C24 6.62667 23.6579 5.81023 23.0475 5.20124L18.8284 0.991874C18.171 0.336043 17.1112 0.336043 16.4539 0.991874C15.7965 1.64771 15.7965 2.70507 16.4539 3.3609L18.929 5.82361L1.67691 5.82361C0.751258 5.82361 9.45269e-08 6.57314 8.35141e-08 7.49665C7.25012e-08 8.42017 0.751258 9.16969 1.67691 9.16969L18.929 9.16969L16.4539 11.6391C15.7965 12.2949 15.7965 13.3523 16.4539 14.0081C17.1112 14.664 18.171 14.664 18.8284 14.0081L23.0475 9.79207Z" fill="black" class="group-hover:fill-[#99EA48] transition duration-200"/>
                            </svg>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col items-center py-1">
        <div class="mt-8 w-full max-w-6xl bg-right bg-cover bg-[#F6F6F6] rounded-[30px] ">
            <div class="flex flex-col lg:flex-row">
                <div class="lg:w-[40%]  md:w-[40%] w-full p-[20px] lg:p-[60px] md:p-[60px]  rounded-lg mb-6 lg:mb-0">
                    <div class="flex items-center mb-6">
                        <div class="bg-[#99EA48] p-4 rounded-[20px]">
                            <img src="{{ asset('new_page/stat1.svg') }}" alt="Calculator Icon" class="w-8 h-8"/>
                        </div>
                    </div>
                    <p class="text-2xl font-bold">Statistics</p>
                    <p class="text-2xl font-bold">Calculators</p>
                    <p class="text-gray-600 mb-6 mt-4 ">
                        Lorem ipsum dolor sit amet consectetur. Feugiat dictum in purus arcu. Eu iaculis aenean id integer.
                    </p>
                    <div class="w-[60%]">
                        <a href="#" class="text-black font-semibold flex items-center p-3  text-[25px] hover:bg-black hover:text-[#99EA48] group">
                            <span class="mx-4"> View All </span>
                            <svg width="24" height="15" viewBox="0 0 24 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.0475 9.79207C23.6646 9.17639 24 8.35994 24 7.49665C24 6.62667 23.6579 5.81023 23.0475 5.20124L18.8284 0.991874C18.171 0.336043 17.1112 0.336043 16.4539 0.991874C15.7965 1.64771 15.7965 2.70507 16.4539 3.3609L18.929 5.82361L1.67691 5.82361C0.751258 5.82361 9.45269e-08 6.57314 8.35141e-08 7.49665C7.25012e-08 8.42017 0.751258 9.16969 1.67691 9.16969L18.929 9.16969L16.4539 11.6391C15.7965 12.2949 15.7965 13.3523 16.4539 14.0081C17.1112 14.664 18.171 14.664 18.8284 14.0081L23.0475 9.79207Z" fill="black" class="group-hover:fill-[#99EA48] transition duration-200"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="lg:w-[60%]  md:w-[60%] w-full p-[20px] lg:p-[60px] md:p-[60px]  rounded-lg inset-0  bg-center bg-no-repeat filter" style="background-image: url('{{ asset('new_page/math_bg.svg') }}');">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center py-1">
        <div class="mt-8 w-full max-w-6xl bg-right bg-cover bg-[#ebf6e0] rounded-[30px] ">
            <div class="flex flex-col lg:flex-row">
                   <div class="lg:w-[60%]  md:w-[60%] w-full  order-2 lg:order-1 p-[20px] lg:p-[60px] md:p-[60px]   rounded-lg inset-0  bg-center bg-no-repeat filter" style="background-image: url('{{ asset('new_page/finance_bg.svg') }}');">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                    </div>
                </div>
                <div class="lg:w-[40%]  md:w-[40%] w-full  order-1 lg:order-2  p-[20px] lg:p-[60px] md:p-[60px]   rounded-lg mb-6 lg:mb-0">
                    <div class="flex items-center mb-6">
                        <div class="bg-[#99EA48] p-4 rounded-[20px]">
                            <img src="{{ asset('new_page/dailylife1.svg') }}" alt="Calculator Icon" class="w-8 h-8"/>
                        </div>
                    </div>
                    <p class="text-2xl font-bold">Daily Life</p>
                    <p class="text-2xl font-bold">Calculators</p>
                    <p class="text-gray-600 mb-6 mt-4 ">
                        Lorem ipsum dolor sit amet consectetur. Feugiat dictum in purus arcu. Eu iaculis aenean id integer.
                    </p>
                    <div class="w-[60%]">
                        <a href="#" class="text-black font-semibold flex items-center p-3  text-[25px] hover:bg-black hover:text-[#99EA48] group">
                            <span class="mx-4"> View All </span>
                            <svg width="24" height="15" viewBox="0 0 24 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.0475 9.79207C23.6646 9.17639 24 8.35994 24 7.49665C24 6.62667 23.6579 5.81023 23.0475 5.20124L18.8284 0.991874C18.171 0.336043 17.1112 0.336043 16.4539 0.991874C15.7965 1.64771 15.7965 2.70507 16.4539 3.3609L18.929 5.82361L1.67691 5.82361C0.751258 5.82361 9.45269e-08 6.57314 8.35141e-08 7.49665C7.25012e-08 8.42017 0.751258 9.16969 1.67691 9.16969L18.929 9.16969L16.4539 11.6391C15.7965 12.2949 15.7965 13.3523 16.4539 14.0081C17.1112 14.664 18.171 14.664 18.8284 14.0081L23.0475 9.79207Z" fill="black" class="group-hover:fill-[#99EA48] transition duration-200"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col items-center py-1">
        <div class="mt-8 w-full max-w-6xl bg-right bg-cover bg-[#F6F6F6] rounded-[30px] ">
            <div class="flex flex-col lg:flex-row">
                <div class="lg:w-[40%]  md:w-[40%] w-full p-[20px] lg:p-[60px] md:p-[60px]  rounded-lg mb-6 lg:mb-0">
                    <div class="flex items-center mb-6">
                        <div class="bg-[#99EA48] p-4 rounded-[20px]">
                            <img src="{{ asset('new_page/health1.svg') }}" alt="Calculator Icon" class="w-8 h-8"/>
                        </div>
                    </div>
                    <p class="text-2xl font-bold">Health</p>
                    <p class="text-2xl font-bold">Calculators</p>
                    <p class="text-gray-600 mb-6 mt-4 ">
                        Lorem ipsum dolor sit amet consectetur. Feugiat dictum in purus arcu. Eu iaculis aenean id integer.
                    </p>
                    <div class="w-[60%]">
                        <a href="#" class="text-black font-semibold flex items-center p-3  text-[25px] hover:bg-black hover:text-[#99EA48] group">
                            <span class="mx-4"> View All </span>
                            <svg width="24" height="15" viewBox="0 0 24 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.0475 9.79207C23.6646 9.17639 24 8.35994 24 7.49665C24 6.62667 23.6579 5.81023 23.0475 5.20124L18.8284 0.991874C18.171 0.336043 17.1112 0.336043 16.4539 0.991874C15.7965 1.64771 15.7965 2.70507 16.4539 3.3609L18.929 5.82361L1.67691 5.82361C0.751258 5.82361 9.45269e-08 6.57314 8.35141e-08 7.49665C7.25012e-08 8.42017 0.751258 9.16969 1.67691 9.16969L18.929 9.16969L16.4539 11.6391C15.7965 12.2949 15.7965 13.3523 16.4539 14.0081C17.1112 14.664 18.171 14.664 18.8284 14.0081L23.0475 9.79207Z" fill="black" class="group-hover:fill-[#99EA48] transition duration-200"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="lg:w-[60%]  md:w-[60%] w-full p-[20px] lg:p-[60px] md:p-[60px]  rounded-lg inset-0  bg-center bg-no-repeat filter" style="background-image: url('{{ asset('new_page/math_bg.svg') }}');">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center py-1">
        <div class="mt-8 w-full max-w-6xl bg-right bg-cover bg-[#ebf6e0] rounded-[30px] ">
            <div class="flex flex-col lg:flex-row">
                   <div class="lg:w-[60%]  md:w-[60%] w-full  order-2 lg:order-1 p-[20px] lg:p-[60px] md:p-[60px]   rounded-lg inset-0  bg-center bg-no-repeat filter" style="background-image: url('{{ asset('new_page/finance_bg.svg') }}');">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                    </div>
                </div>
                <div class="lg:w-[40%]  md:w-[40%] w-full  order-1 lg:order-2  p-[20px] lg:p-[60px] md:p-[60px]   rounded-lg mb-6 lg:mb-0">
                    <div class="flex items-center mb-6">
                        <div class="bg-[#99EA48] p-4 rounded-[20px]">
                            <img src="{{ asset('new_page/physics1.svg') }}" alt="Calculator Icon" class="w-8 h-8"/>
                        </div>
                    </div>
                    <p class="text-2xl font-bold">Physics</p>
                    <p class="text-2xl font-bold">Calculators</p>
                    <p class="text-gray-600 mb-6 mt-4 ">
                        Lorem ipsum dolor sit amet consectetur. Feugiat dictum in purus arcu. Eu iaculis aenean id integer.
                    </p>
                    <div class="w-[60%]">
                        <a href="#" class="text-black font-semibold flex items-center p-3  text-[25px] hover:bg-black hover:text-[#99EA48] group">
                            <span class="mx-4"> View All </span>
                            <svg width="24" height="15" viewBox="0 0 24 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.0475 9.79207C23.6646 9.17639 24 8.35994 24 7.49665C24 6.62667 23.6579 5.81023 23.0475 5.20124L18.8284 0.991874C18.171 0.336043 17.1112 0.336043 16.4539 0.991874C15.7965 1.64771 15.7965 2.70507 16.4539 3.3609L18.929 5.82361L1.67691 5.82361C0.751258 5.82361 9.45269e-08 6.57314 8.35141e-08 7.49665C7.25012e-08 8.42017 0.751258 9.16969 1.67691 9.16969L18.929 9.16969L16.4539 11.6391C15.7965 12.2949 15.7965 13.3523 16.4539 14.0081C17.1112 14.664 18.171 14.664 18.8284 14.0081L23.0475 9.79207Z" fill="black" class="group-hover:fill-[#99EA48] transition duration-200"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col items-center py-1">
        <div class="mt-8 w-full max-w-6xl bg-right bg-cover bg-[#F6F6F6] rounded-[30px] ">
            <div class="flex flex-col lg:flex-row">
                <div class="lg:w-[40%]  md:w-[40%] w-full p-[20px] lg:p-[60px] md:p-[60px]  rounded-lg mb-6 lg:mb-0">
                    <div class="flex items-center mb-6">
                        <div class="bg-[#99EA48] p-4 rounded-[20px]">
                            <img src="{{ asset('new_page/chemistry1.svg') }}" alt="Calculator Icon" class="w-8 h-8"/>
                        </div>
                    </div>
                    <p class="text-2xl font-bold">Chemistry</p>
                    <p class="text-2xl font-bold">Calculators</p>
                    <p class="text-gray-600 mb-6 mt-4 ">
                        Lorem ipsum dolor sit amet consectetur. Feugiat dictum in purus arcu. Eu iaculis aenean id integer.
                    </p>
                    <div class="w-[60%]">
                        <a href="#" class="text-black font-semibold flex items-center p-3  text-[25px] hover:bg-black hover:text-[#99EA48] group">
                            <span class="mx-4"> View All </span>
                            <svg width="24" height="15" viewBox="0 0 24 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.0475 9.79207C23.6646 9.17639 24 8.35994 24 7.49665C24 6.62667 23.6579 5.81023 23.0475 5.20124L18.8284 0.991874C18.171 0.336043 17.1112 0.336043 16.4539 0.991874C15.7965 1.64771 15.7965 2.70507 16.4539 3.3609L18.929 5.82361L1.67691 5.82361C0.751258 5.82361 9.45269e-08 6.57314 8.35141e-08 7.49665C7.25012e-08 8.42017 0.751258 9.16969 1.67691 9.16969L18.929 9.16969L16.4539 11.6391C15.7965 12.2949 15.7965 13.3523 16.4539 14.0081C17.1112 14.664 18.171 14.664 18.8284 14.0081L23.0475 9.79207Z" fill="black" class="group-hover:fill-[#99EA48] transition duration-200"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="lg:w-[60%]  md:w-[60%] w-full p-[20px] lg:p-[60px] md:p-[60px]  rounded-lg inset-0  bg-center bg-no-repeat filter" style="background-image: url('{{ asset('new_page/math_bg.svg') }}');">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center py-1">
        <div class="mt-8 w-full max-w-6xl bg-right bg-cover bg-[#ebf6e0] rounded-[30px] ">
            <div class="flex flex-col lg:flex-row">
                   <div class="lg:w-[60%]  md:w-[60%] w-full  order-2 lg:order-1 p-[20px] lg:p-[60px] md:p-[60px]   rounded-lg inset-0  bg-center bg-no-repeat filter" style="background-image: url('{{ asset('new_page/finance_bg.svg') }}');">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                    </div>
                </div>
                <div class="lg:w-[40%]  md:w-[40%] w-full  order-1 lg:order-2  p-[20px] lg:p-[60px] md:p-[60px]   rounded-lg mb-6 lg:mb-0">
                    <div class="flex items-center mb-6">
                        <div class="bg-[#99EA48] p-4 rounded-[20px]">
                            <img src="{{ asset('new_page/construction1.svg') }}" alt="Calculator Icon" class="w-8 h-8"/>
                        </div>
                    </div>
                    <p class="text-2xl font-bold">Construction</p>
                    <p class="text-2xl font-bold">Calculators</p>
                    <p class="text-gray-600 mb-6 mt-4 ">
                        Lorem ipsum dolor sit amet consectetur. Feugiat dictum in purus arcu. Eu iaculis aenean id integer.
                    </p>
                    <div class="w-[60%]">
                        <a href="#" class="text-black font-semibold flex items-center p-3  text-[25px] hover:bg-black hover:text-[#99EA48] group">
                            <span class="mx-4"> View All </span>
                            <svg width="24" height="15" viewBox="0 0 24 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.0475 9.79207C23.6646 9.17639 24 8.35994 24 7.49665C24 6.62667 23.6579 5.81023 23.0475 5.20124L18.8284 0.991874C18.171 0.336043 17.1112 0.336043 16.4539 0.991874C15.7965 1.64771 15.7965 2.70507 16.4539 3.3609L18.929 5.82361L1.67691 5.82361C0.751258 5.82361 9.45269e-08 6.57314 8.35141e-08 7.49665C7.25012e-08 8.42017 0.751258 9.16969 1.67691 9.16969L18.929 9.16969L16.4539 11.6391C15.7965 12.2949 15.7965 13.3523 16.4539 14.0081C17.1112 14.664 18.171 14.664 18.8284 14.0081L23.0475 9.79207Z" fill="black" class="group-hover:fill-[#99EA48] transition duration-200"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col items-center py-1">
        <div class="mt-8 w-full max-w-6xl bg-right bg-cover bg-[#F6F6F6] rounded-[30px] ">
            <div class="flex flex-col lg:flex-row">
                <div class="lg:w-[40%]  md:w-[40%] w-full p-[20px] lg:p-[60px] md:p-[60px]  rounded-lg mb-6 lg:mb-0">
                    <div class="flex items-center mb-6">
                        <div class="bg-[#99EA48] p-4 rounded-[20px]">
                            <img src="{{ asset('new_page/pets1.svg') }}" alt="Calculator Icon" class="w-8 h-8"/>
                        </div>
                    </div>
                    <p class="text-2xl font-bold">Pets</p>
                    <p class="text-2xl font-bold">Calculators</p>
                    <p class="text-gray-600 mb-6 mt-4 ">
                        Lorem ipsum dolor sit amet consectetur. Feugiat dictum in purus arcu. Eu iaculis aenean id integer.
                    </p>
                    <div class="w-[60%]">
                        <a href="#" class="text-black font-semibold flex items-center p-3  text-[25px] hover:bg-black hover:text-[#99EA48] group">
                            <span class="mx-4"> View All </span>
                            <svg width="24" height="15" viewBox="0 0 24 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.0475 9.79207C23.6646 9.17639 24 8.35994 24 7.49665C24 6.62667 23.6579 5.81023 23.0475 5.20124L18.8284 0.991874C18.171 0.336043 17.1112 0.336043 16.4539 0.991874C15.7965 1.64771 15.7965 2.70507 16.4539 3.3609L18.929 5.82361L1.67691 5.82361C0.751258 5.82361 9.45269e-08 6.57314 8.35141e-08 7.49665C7.25012e-08 8.42017 0.751258 9.16969 1.67691 9.16969L18.929 9.16969L16.4539 11.6391C15.7965 12.2949 15.7965 13.3523 16.4539 14.0081C17.1112 14.664 18.171 14.664 18.8284 14.0081L23.0475 9.79207Z" fill="black" class="group-hover:fill-[#99EA48] transition duration-200"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="lg:w-[60%]  md:w-[60%] w-full p-[20px] lg:p-[60px] md:p-[60px]  rounded-lg inset-0  bg-center bg-no-repeat filter" style="background-image: url('{{ asset('new_page/math_bg.svg') }}');">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center py-1">
        <div class="mt-8 w-full max-w-6xl bg-right bg-cover bg-[#ebf6e0] rounded-[30px] ">
            <div class="flex flex-col lg:flex-row">
                   <div class="lg:w-[60%]  md:w-[60%] w-full  order-2 lg:order-1 p-[20px] lg:p-[60px] md:p-[60px]   rounded-lg inset-0  bg-center bg-no-repeat filter" style="background-image: url('{{ asset('new_page/finance_bg.svg') }}');">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                        <a href="#" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block">Calculator Name</a>
                    </div>
                </div>
                <div class="lg:w-[40%]  md:w-[40%] w-full  order-1 lg:order-2  p-[20px] lg:p-[60px] md:p-[60px]   rounded-lg mb-6 lg:mb-0">
                    <div class="flex items-center mb-6">
                        <div class="bg-[#99EA48] p-4 rounded-[20px]">
                            <img src="{{ asset('new_page/datetime1.svg') }}" alt="Calculator Icon" class="w-8 h-8"/>
                        </div>
                    </div>
                    <p class="text-2xl font-bold">Date & Time</p>
                    <p class="text-2xl font-bold">Calculators</p>
                    <p class="text-gray-600 mb-6 mt-4 ">
                        Lorem ipsum dolor sit amet consectetur. Feugiat dictum in purus arcu. Eu iaculis aenean id integer.
                    </p>
                    <div class="w-[60%]">
                        <a href="#" class="text-black font-semibold flex items-center p-3  text-[25px] hover:bg-black hover:text-[#99EA48] group">
                            <span class="mx-4"> View All </span>
                            <svg width="24" height="15" viewBox="0 0 24 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.0475 9.79207C23.6646 9.17639 24 8.35994 24 7.49665C24 6.62667 23.6579 5.81023 23.0475 5.20124L18.8284 0.991874C18.171 0.336043 17.1112 0.336043 16.4539 0.991874C15.7965 1.64771 15.7965 2.70507 16.4539 3.3609L18.929 5.82361L1.67691 5.82361C0.751258 5.82361 9.45269e-08 6.57314 8.35141e-08 7.49665C7.25012e-08 8.42017 0.751258 9.16969 1.67691 9.16969L18.929 9.16969L16.4539 11.6391C15.7965 12.2949 15.7965 13.3523 16.4539 14.0081C17.1112 14.664 18.171 14.664 18.8284 14.0081L23.0475 9.79207Z" fill="black" class="group-hover:fill-[#99EA48] transition duration-200"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col items-center py-8">

        <div class="text-center mb-8">
            <span class="inline-block bg-[#99EA48]  px-5 py-3 py-1 rounded-full text-sm mb-2">Blogs</span>
            <h2 class="text-2xl lg:text-3xl font-bold my-3">Read and get your concept strong</h2>
        </div>
    
        <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 max-w-5xl mx-auto">
            <!-- Blog Card 1 -->
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-4">
                <img src="{{ asset('new_page/blog.svg') }}" alt="Blog Image" class="rounded-t-lg w-full h-48 object-cover">
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2">Lorem ipsum dolor sit amet, consectetur</h3>
                    <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet consectetur adipiscing elit, et telluhabi ant ltrices sodales vestibulu sque tellus quis sed lectus...</p>
                </div>
            </div>
    
            <!-- Blog Card 2 -->
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-4">
                <img src="{{ asset('new_page/blog.svg') }}" alt="Blog Image" class="rounded-t-lg w-full h-48 object-cover">
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2">Lorem ipsum dolor sit amet, consectetur</h3>
                    <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet consectetur adipiscing elit, et telluhabi ant ltrices sodales vestibulu sque tellus quis sed lectus...</p>
                </div>
            </div>
    
            <!-- Blog Card 3 -->
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-4">
                <img src="{{ asset('new_page/blog.svg') }}" alt="Blog Image" class="rounded-t-lg w-full h-48 object-cover">
                </div>

                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2">Lorem ipsum dolor sit amet, consectetur</h3>
                    <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet consectetur adipiscing elit, et telluhabi ant ltrices sodales vestibulu sque tellus quis sed lectus...</p>
                </div>
            </div>
        </div>

    </div>

    <div class="flex flex-col items-center py-8">
        <div class="w-full max-w-5xl p-6 bg-black rounded-[30px] shadow-lg">
            <!-- FAQ Header -->
            <div class="text-center mb-6">
                <span class="inline-block bg-white text-black px-5 py-3 rounded-full text-sm mb-2">FAQ</span>
                <h2 class="text-2xl  lg:text-3xl md:text-3xl mt-5 font-bold text-white">Frequently Asked Questions</h2>
            </div>
            <div class="w-full flex justify-center">

            <!-- FAQ Items -->
            <div class="space-y-4 max-w-3xl ">
                <!-- FAQ Item 1 -->
                <div class="border border-[#99EA48] rounded-lg">
                    <button onclick="toggleFaq(event)" class="w-full text-left px-4 py-3 flex justify-between items-center focus:outline-none text-white">
                        <span>Lorem ipsum dolor sit amet consectetur. Egestas sem tempor leo cras</span>
                        <span class="toggle-icon text-[#99EA48] font-bold">-</span>
                    </button>
                    <div class="px-4 py-3 text-sm text-gray-300">
                        Lorem ipsum dolor sit amet consectetur. Egestas sem tempor leo cras id eget ac mauris lacus. In lorem tortor egestas elit venenatis quis. Sit vitae pretium tristique nunc.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="border border-[#99EA48] rounded-lg">
                    <button onclick="toggleFaq(event)" class="w-full text-left px-4 py-3 flex justify-between items-center focus:outline-none text-white">
                        <span>Lorem ipsum dolor sit amet consectetur. Egestas sem tempor leo cras</span>
                        <span class="toggle-icon text-[#99EA48] font-bold">+</span>
                    </button>
                    <div class="px-4 py-3 text-sm text-gray-300 hidden">
                        Lorem ipsum dolor sit amet consectetur. Egestas sem tempor leo cras id eget ac mauris lacus. In lorem tortor egestas elit venenatis quis. Sit vitae pretium tristique nunc.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="border border-[#99EA48] rounded-lg">
                    <button onclick="toggleFaq(event)" class="w-full text-left px-4 py-3 flex justify-between items-center focus:outline-none text-white">
                        <span>Lorem ipsum dolor sit amet consectetur. Egestas sem tempor leo cras</span>
                        <span class="toggle-icon text-[#99EA48] font-bold">+</span>
                    </button>
                    <div class="px-4 py-3 text-sm text-gray-300 hidden">
                        Lorem ipsum dolor sit amet consectetur. Egestas sem tempor leo cras id eget ac mauris lacus. In lorem tortor egestas elit venenatis quis. Sit vitae pretium tristique nunc.
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="border border-[#99EA48] rounded-lg">
                    <button onclick="toggleFaq(event)" class="w-full text-left px-4 py-3 flex justify-between items-center focus:outline-none text-white">
                        <span>Lorem ipsum dolor sit amet consectetur. Egestas sem tempor leo cras</span>
                        <span class="toggle-icon text-[#99EA48] font-bold">+</span>
                    </button>
                    <div class="px-4 py-3 text-sm text-gray-300 hidden">
                        Lorem ipsum dolor sit amet consectetur. Egestas sem tempor leo cras id eget ac mauris lacus. In lorem tortor egestas elit venenatis quis. Sit vitae pretium tristique nunc.
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="border border-[#99EA48] rounded-lg">
                    <button onclick="toggleFaq(event)" class="w-full text-left px-4 py-3 flex justify-between items-center focus:outline-none text-white">
                        <span>Lorem ipsum dolor sit amet consectetur. Egestas sem tempor leo cras</span>
                        <span class="toggle-icon text-[#99EA48] font-bold">+</span>
                    </button>
                    <div class="px-4 py-3 text-sm text-gray-300 hidden">
                        Lorem ipsum dolor sit amet consectetur. Egestas sem tempor leo cras id eget ac mauris lacus. In lorem tortor egestas elit venenatis quis. Sit vitae pretium tristique nunc.
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    {{-- <div class="flex flex-col items-center py-8"> --}}
    <div class="container-fluid mx-auto border-b container-fluid ">
            <!-- Footer Section -->
            <footer class="bg-black text-gray-300 pt-10 pb-6 inset-0  bg-center bg-no-repeat filter" style="background-image: url('{{ asset('new_page/footerbg.svg') }}');">
                <div class="max-w-screen-xl flex flex-wrap  p-4  mx-auto px-4 grid gap-8 grid-cols-2 md:grid-cols-4 lg:grid-cols-4">
                    <!-- Logo and About Section (Full Width on Mobile) -->
                    <div class="col-span-2 md:col-span-1">
                        <a href="#" class="flex items-center space-x-3 rtl:space-x-revers">
                            <img src="{{ asset('new_page/logofooter.svg') }}" alt="Flowbite Logo" />
                        </a>
                        <p class="text-sm mb-4 mt-6">
                            Lorem ipsum dolor sit amet conser. Pretium aliquet sed ati augue nam auctor massa vitae ac scelerisque lorem ipsum.
                        </p>
                        <!-- Social Media Icons -->
                        <div class="flex space-x-4">
                            <a href="#" class="text-[#99EA48] hover:text-gray-200">
                                <img src="{{ asset('new_page/facebook.svg') }}" alt="Flowbite Logo" />
                            </a>
                            <a href="#" class="text-[#99EA48] hover:text-gray-200">
                                <img src="{{ asset('new_page/pin.svg') }}" alt="Flowbite Logo" />
                            </a>
                            <a href="#" class="text-[#99EA48] hover:text-gray-200">
                                <img src="{{ asset('new_page/linkin.svg') }}" alt="Flowbite Logo" />
                            </a>
                        </div>
                        <div class="flex space-x-4">

                        <a href="http://127.0.0.1:8001" class="flex items-center mt-8">
                            <img src="{{ asset('images/ogview/hjtech.png') }}" width="150" height="auto" alt="FlowBite Logo">
                        </a>
                        </div>
                    </div>
                
                    <!-- Quick Links Column -->
                    <div>
                        <h3 class="text-[#99EA48] font-semibold mb-2">Quick Links</h3>
                        <ul class="space-y-1 text-sm">
                            <li><a href="#" class="hover:text-gray-200">Home</a></li>
                            <li><a href="#" class="hover:text-gray-200">About Us</a></li>
                            <li><a href="#" class="hover:text-gray-200">Contact Us</a></li>
                            <li><a href="#" class="hover:text-gray-200">Feedback</a></li>
                            <li><a href="#" class="hover:text-gray-200">Terms and conditions</a></li>
                            <li><a href="#" class="hover:text-gray-200">Privacy policy</a></li>
                        </ul>
                    </div>
                
                    <!-- Calculators Column -->
                    <div>
                        <h3 class="text-[#99EA48] font-semibold mb-2">Calculators</h3>
                        <ul class="space-y-1 text-sm">
                            <li><a href="#" class="hover:text-gray-200">Chemistry</a></li>
                            <li><a href="#" class="hover:text-gray-200">Health</a></li>
                            <li><a href="#" class="hover:text-gray-200">Pets</a></li>
                            <li><a href="#" class="hover:text-gray-200">Construction</a></li>
                            <li><a href="#" class="hover:text-gray-200">Informative</a></li>
                            <li><a href="#" class="hover:text-gray-200">Finance</a></li>
                            <li><a href="#" class="hover:text-gray-200">Statics</a></li>
                            <li><a href="#" class="hover:text-gray-200">Math</a></li>
                        </ul>
                    </div>
                
                    <!-- FAQs Column -->
                    <div>
                        <h3 class="text-[#99EA48] font-semibold mb-2">FAQs</h3>
                        <ul class="space-y-1 text-sm">
                            <li><a href="#" class="hover:text-gray-200">Favorite Calculators</a></li>
                            <li><a href="#" class="hover:text-gray-200">Profile</a></li>
                            <li><a href="#" class="hover:text-gray-200">Security</a></li>
                            <li><a href="#" class="hover:text-gray-200">Trending Blogs</a></li>
                            <li><a href="#" class="hover:text-gray-200">Simple Calculator</a></li>
                        </ul>
                    </div>
                </div>
                

                <!-- Footer Bottom -->
                <div class="border-t border-[#99EA48] mt-6 pt-4">
                    <p class="text-center text-sm text-[#99EA48]">&copy; 2024 Calculator online. All rights reserved.</p>
                </div>
            </footer>
    </div>
        <!-- Font Awesome for Icons (optional) -->
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    {{-- </div> --}}
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script>
        // Select the title elements and the calculator grid
        const scientificTitle = document.getElementById('scientific-title');
        const toggleBtn = document.getElementById('toggle-btn');
        const calculatorGrid = document.getElementById('calculator-grid');
    
        // Initially show Simple Calculator and hide Scientific Calculator
        toggleBtn.classList.add('hidden'); // Hide Scientific Calculator initially
    
        // Function to toggle titles and calculator grid visibility
        const toggleCalculator = () => {
            // Check which title is currently visible
            if (scientificTitle.classList.contains('hidden')) {
                // Show Scientific Calculator and hide Simple Calculator
                scientificTitle.classList.remove('hidden'); // Show Simple Calculator
                toggleBtn.classList.add('hidden'); // Hide Scientific Calculator
                calculatorGrid.classList.remove('hidden'); // Show the calculator grid
            } else {
                // Show Simple Calculator and hide Scientific Calculator
                scientificTitle.classList.add('hidden'); // Hide Simple Calculator
                toggleBtn.classList.remove('hidden'); // Show Scientific Calculator
                calculatorGrid.classList.add('hidden'); // Hide the calculator grid
            }
        };
    
        // Add click event listeners to both titles
        scientificTitle.addEventListener('click', toggleCalculator);
        toggleBtn.addEventListener('click', toggleCalculator);
    </script>

<script>
    function toggleFaq(event) {
        const content = event.currentTarget.nextElementSibling;
        content.classList.toggle('hidden');
        const icon = event.currentTarget.querySelector('.toggle-icon');
        icon.textContent = content.classList.contains('hidden') ? '+' : '-';
    }
</script>
    
</body>
</html>

