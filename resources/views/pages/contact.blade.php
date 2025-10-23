@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)

@section('content')
    <div x-data @scroll-to-top.window="window.scrollTo({ top: 1, behavior: 'smooth' })" class="max-w-[90%] mx-auto lg:px-0 px-5 my-10">
        <div class="max-w-[1660px]">
            <div class="absolute z-10 top-[120px] left-[0px] sm:w-[60%] sm:left-[20px] sm:top-[200px] md:w-[70%] md:left-[0px] md:top-[500px] lg:w-[80%] lg:left-[100px]"
                style="max-width: 351px;height: 351px;flex-shrink: 0;border-radius: 351px;opacity: 0.12;background: #2845f5;filter: blur(75px);z-index:-1;">
            </div>
        </div>
        <div class="flex lg:flex-row flex-col w-full z-50">
            <div class="lg:w-[50%] w-full pr-4">
                <h1
                    class="lg:text-[35px] md:text-[24px] text-[24px] text-[#1A1A1A] lg:mt-[130px]  mt-1 leading-[45.57px] font-[700] tracking-wider">
                    Get in Touch with Us!
                </h1>
                <p class="text-[16px] lg:my-8 my-4 leading-[25.71px] font-[500] text-[#A3A3A3]">
                    If you have any questions about our content or calculators, our team is here to help. Don’t hesitate to
                    reach out with any queries!
                </p>
                <div class="flex gap-x-6 items-center mt-4">
                    <div class="w-[30px] h-[30px] flex justify-center items-center">
                        <svg width="30" class="text-[#000] hover:text-[#F7BB0D] cursor-pointer duration-300"
                            height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor"
                                d="M15 0C12.0333 0 9.13317 0.879733 6.66644 2.52795C4.19971 4.17617 2.27712 6.51884 1.14181 9.25973C0.00649921 12.0006 -0.29055 15.0166 0.288227 17.9263C0.867004 20.836 2.29561 23.5088 4.39339 25.6065C6.49118 27.7043 9.16392 29.1329 12.0736 29.7117C14.9833 30.2905 17.9993 29.9934 20.7402 28.8581C23.4811 27.7228 25.8238 25.8002 27.472 23.3335C29.1202 20.8668 29.9999 17.9667 29.9999 15C29.9999 11.0217 28.4196 7.20643 25.6065 4.39339C22.7935 1.58035 18.9782 0 15 0ZM10.6381 22.8947H7.36578V12.3533H10.6381V22.8947ZM8.99999 10.9144C8.62338 10.916 8.25477 10.8059 7.94074 10.598C7.62671 10.3901 7.38137 10.0938 7.23572 9.74645C7.09007 9.39915 7.05065 9.01646 7.12245 8.64676C7.19425 8.27706 7.37404 7.93694 7.6391 7.6694C7.90416 7.40186 8.24258 7.2189 8.6116 7.14366C8.98061 7.06842 9.36365 7.10427 9.7123 7.24667C10.0609 7.38908 10.3595 7.63165 10.5704 7.94373C10.7812 8.25581 10.8947 8.62337 10.8967 8.99998C10.8977 9.50498 10.6988 9.98986 10.3434 10.3486C9.98798 10.7074 9.50497 10.9108 8.99999 10.9144ZM22.8947 22.8947H19.6243V17.7631C19.6243 16.5394 19.6006 14.9704 17.923 14.9704C16.2454 14.9704 15.9493 16.3006 15.9493 17.6743V22.8947H12.6908V12.3533H15.8309V13.7901H15.8763C16.3125 12.9612 17.3802 12.0868 18.973 12.0868C22.2848 12.0868 22.8947 14.2697 22.8947 17.1039V22.8947Z" />
                        </svg>
                    </div>
                    <div class="w-[30px] h-[30px] flex justify-center items-center">
                        <svg width="31" height="30"
                            class="text-[#000] hover:text-[#F7BB0D] cursor-pointer duration-300" viewBox="0 0 31 30"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.5383 0C6.96543 0 0 6.69113 0 15.0002C0 23.3089 6.96543 30 15.5383 30C24.1111 30 31 23.3089 31 15.0002C31 6.69113 24.1111 0 15.5383 0ZM16.763 19.0442C15.6148 18.9706 15.1556 18.3826 14.237 17.8678C13.7778 20.3676 13.1654 22.7204 11.4049 23.9705C10.8692 20.2207 12.1704 17.4267 12.7827 14.4118C11.7111 12.7206 12.9358 9.1913 15.1556 10.0735C17.9111 11.103 12.7827 16.5441 16.2272 17.2057C19.9012 17.9411 21.3556 11.103 19.1358 8.89708C15.8444 5.73525 9.64445 8.82343 10.4099 13.3822C10.6395 14.4854 11.7877 14.8529 10.9457 16.3972C8.80247 15.9561 8.19013 14.3381 8.26665 12.2795C8.41973 8.82343 11.4815 6.39689 14.6197 6.02945C18.5234 5.58835 22.1975 7.42644 22.6568 10.9557C23.2691 15.0002 20.8963 19.3384 16.763 19.0442Z"
                                fill="currentColor" />
                        </svg>
                    </div>
                    <div class="w-[30px] h-[30px] flex justify-center items-center">
                        <svg width="30" class="text-[#000] hover:text-[#F7BB0D] cursor-pointer duration-300"
                            height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0 15C0 6.71531 6.71531 0 15 0C23.2847 0 30 6.71531 30 15C30 23.2838 23.2847 30 15 30C6.71531 30 0 23.2838 0 15ZM16.2835 23.3455H12.8344V14.9989H11.1113V12.1217H12.8344V10.3948C12.8344 8.04828 13.8066 6.65234 16.5713 6.65234H18.8728V9.52953H17.4347C16.3585 9.52953 16.2872 9.93172 16.2872 10.6817L16.2835 12.1217H18.8888L18.5841 14.998H16.2835V23.3455Z"
                                fill="currentColor" />
                        </svg>
                    </div>
                </div>
            </div>


           <div class="lg:w-[50%] w-full lg:mt-10 mt-8">
                @if (isset($error))
                    <p class="text-sm text-center"><strong class="text-red-500">{{ $error }}</strong></p>
                @endif
                @if (isset($done))
                    <p class="text-sm text-center"><strong class="text-blue-500">{{ $done }}</strong></p>
                @endif
                <livewire:contact.contact-us />
            </div>

        </div>

    </div>



@endsection
