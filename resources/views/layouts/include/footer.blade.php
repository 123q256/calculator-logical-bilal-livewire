<!-- FOOTER -->
<footer class="bg-gray-50 border-t border-gray-200 pt-14 pb-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 mb-10">

            <!-- Brand - 40% (2/5 columns) -->
            <div class="lg:col-span-2">
                <div class="flex items-center gap-2 mb-3">
                    <a href="{{ url('/') }}" class="flex items-center space-x-2 rtl:space-x-reverse">
                        <div class="w-7 h-7 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <svg class="w-3.5 h-3.5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="3" y="3" width="7" height="7" rx="1" stroke-width="2" />
                                <rect x="14" y="3" width="7" height="7" rx="1" stroke-width="2" />
                                <rect x="3" y="14" width="7" height="7" rx="1" stroke-width="2" />
                                <rect x="14" y="14" width="7" height="7" rx="1" stroke-width="2" />
                            </svg>
                        </div>
                        <span class="font-semibold text-indigo-600 text-sm">Calculator Online</span>
                    </a>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed">
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
                    <h4 class="font-semibold text-gray-800 text-sm mb-4">Categories</h4>
                    <ul class="space-y-2.5 text-sm text-gray-500">
                        @foreach ($databaseData as $item)
                            <li>
                                <a href="{{ url(Str::lower($item->cat_name)) }}/"
                                   class="hover:text-gray-800 transition-colors hover:underline">
                                    {{ $item->cat_name }}
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <a class="hover:text-gray-800 transition-colors hover:underline"
                               href="{{ url('unit-converter') }}">Unit Converter</a>
                        </li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-semibold text-gray-800 text-sm mb-4">Quick Links</h4>
                    <ul class="space-y-2.5 text-sm text-gray-500">
                        <li><a class="hover:text-gray-800 transition-colors hover:underline" href="{{ url('/') }}">Home</a></li>
                        <li><a class="hover:text-gray-800 transition-colors hover:underline" href="{{ url('content-disclaimer') }}">Content Disclaimer</a></li>
                        <li><a class="hover:text-gray-800 transition-colors hover:underline" href="{{ url('terms-of-service') }}">Terms and conditions</a></li>
                        <li><a class="hover:text-gray-800 transition-colors hover:underline" href="{{ url('privacy-policy') }}">Privacy policy</a></li>
                        <li><a class="hover:text-gray-800 transition-colors hover:underline" href="{{ url('editorial-Policies') }}">Editorial Policies</a></li>
                    </ul>
                </div>

                <!-- Keep in Touch -->
                <div>
                    <h4 class="font-semibold text-gray-800 text-sm mb-4">Keep in Touch</h4>
                    <ul class="space-y-2.5 text-sm text-gray-500">
                        <li><a class="hover:text-gray-800 transition-colors hover:underline" href="{{ url('about-us') }}">About Us</a></li>
                        <li><a class="hover:text-gray-800 transition-colors hover:underline" href="{{ url('contact-us') }}">Contact Us</a></li>
                        <li><a class="hover:text-gray-800 transition-colors hover:underline" href="{{ url('blog') }}">Blogs</a></li>
                        <li><a class="hover:text-gray-800 transition-colors hover:underline" href="{{ url('feedback') }}">Feedback</a></li>
                    </ul>
                </div>

            </div>

        </div>

        <div class="border-t border-gray-200 pt-6 text-center text-sm text-gray-400">
            © 2026 Calculator Online. All rights reserved.
        </div>
    </div>
</footer>