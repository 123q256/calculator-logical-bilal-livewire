<!-- FOOTER -->
<footer class="bg-gradient-to-b from-blue-800 to-blue-900 border-t border-blue-900 pt-14 pb-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 mb-10">

            <!-- Brand - 40% (2/5 columns) -->
            <div class="lg:col-span-2">
                <div class="flex items-center gap-2 mb-3">
                    <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                        <!-- Professional Icon -->
                        <div class="relative w-10 h-10 flex items-center justify-center bg-white rounded-xl shadow-lg border-b-2 border-blue-100 group-hover:-translate-y-0.5 transition-all duration-300">
                          <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                          </svg>
                          <!-- Active Dot -->
                          <div class="absolute -top-1 -right-1 w-3 h-3 bg-green-400 border-2 border-white rounded-full"></div>
                        </div>
                        <!-- Logo Text -->
                        <div class="flex flex-col">
                          <span class="font-extrabold text-white text-[17px] leading-tight tracking-wide">Calculator</span>
                          <span class="font-semibold text-blue-300 text-[10px] leading-none uppercase tracking-[0.2em]">Online</span>
                        </div>
                    </a>
                </div>
                <p class="text-white text-sm leading-relaxed">
                    Experience effortless calculations for any need with our comprehensive Logical calculator
                    resource. Whether you're solving simple equations or complex formulas, our platform is designed
                    to make every calculation easy and accessible.
                </p>
            </div>

            <!-- Right Side - 60% (3/5 columns) -->
            <div class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-3 gap-8">

                <!-- Categories -->
                @php
                    $databaseData = getDatabaseData();
                @endphp
                <div>
                    <h4 class="font-semibold text-white text-sm mb-4">Categories</h4>
                    <ul class="space-y-2.5 text-sm text-white">
                        @foreach ($databaseData as $item)
                            @if(in_array($item->cat_name, ['Health', 'Math', 'Everyday-Life', 'Finance', 'Timedate']))
                                <li>
                                    <a href="{{ url(Str::lower($item->cat_name)) }}/"
                                       class="hover:text-white transition-colors hover:underline">
                                        {{ $item->cat_name }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                        <li>
                            <a class="hover:text-white transition-colors hover:underline"
                               href="{{ url('unit-converter') }}">Unit Converter</a>
                        </li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-semibold text-white text-sm mb-4">Quick Links</h4>
                    <ul class="space-y-2.5 text-sm text-white">
                        <li><a class="hover:text-white transition-colors hover:underline" href="{{ url('/') }}">Home</a></li>
                        <li><a class="hover:text-white transition-colors hover:underline" href="{{ url('content-disclaimer') }}/">Content Disclaimer</a></li>
                        <li><a class="hover:text-white transition-colors hover:underline" href="{{ url('terms-of-service') }}/">Terms and conditions</a></li>
                        <li><a class="hover:text-white transition-colors hover:underline" href="{{ url('privacy-policy') }}/">Privacy policy</a></li>
                        <li><a class="hover:text-white transition-colors hover:underline" href="{{ url('editorial-Policies') }}/">Editorial Policies</a></li>
                    </ul>
                </div>

                <!-- Keep in Touch -->
                <div>
                    <h4 class="font-semibold text-white text-sm mb-4">Keep in Touch</h4>
                    <ul class="space-y-2.5 text-sm text-white">
                        <li><a class="hover:text-white transition-colors hover:underline" href="{{ url('about-us') }}/">About Us</a></li>
                        <li><a class="hover:text-white transition-colors hover:underline" href="{{ url('contact-us') }}/">Contact Us</a></li>
                        <li><a class="hover:text-white transition-colors hover:underline" href="{{ url('blog') }}/">Blogs</a></li>
                        <li><a class="hover:text-white transition-colors hover:underline" href="{{ url('feedback') }}/">Feedback</a></li>
                    </ul>
                </div>

            </div>

        </div>

        <div class="border-t border-blue-700/50 pt-6 text-center text-sm text-white">
            © 2026 Calculator Online. All rights reserved.
        </div>
    </div>
</footer>