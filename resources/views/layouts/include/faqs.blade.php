
  <!-- FAQ SECTION -->
  <section class="py-12 sm:py-20 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
      <div class="text-center mb-12">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">FAQs</h2>
        <p class="text-gray-500 text-sm">Have Any Question? You Got Answer Here.</p>
      </div>

      <div class="space-y-0" x-data="{ active: 1 }">

        <!-- FAQ 1 -->
        <div class="border-b border-gray-200">
          <button @click="active = active === 1 ? null : 1" class="w-full flex items-center justify-between py-5 text-left gap-4 focus:outline-none">
            <span class="text-sm font-medium text-gray-800">Are all the calculators on Calculator Online free to use?</span>
            <div class="w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0 transition-colors" :style="active === 1 ? 'background:#EEF0FB;' : 'background:#EEF0FB;'">
              <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="active === 1 ? 'rotate-45' : ''" fill="none" stroke="#3B4FE8" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/>
              </svg>
            </div>
          </button>
          <div x-show="active === 1" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="pb-5">
            <p class="text-gray-500 text-sm leading-relaxed">Yes! Every calculator on Calculator Online is completely free. There are no hidden fees, no subscriptions, and no registration required. Just open any tool and start calculating instantly.</p>
          </div>
        </div>

        <!-- FAQ 2 -->
        <div class="border-b border-gray-200">
          <button @click="active = active === 2 ? null : 2" class="w-full flex items-center justify-between py-5 text-left gap-4 focus:outline-none">
            <span class="text-sm font-medium text-gray-800">Do I need to create an account to use the calculators?</span>
            <div class="w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0" style="background:#EEF0FB;">
              <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="active === 2 ? 'rotate-45' : ''" fill="none" stroke="#3B4FE8" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/>
              </svg>
            </div>
          </button>
          <div x-show="active === 2" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="pb-5">
            <p class="text-gray-500 text-sm leading-relaxed">No account is needed. All calculators are accessible without any sign-up or login. Simply visit the page and use any tool right away.</p>
          </div>
        </div>

        <!-- FAQ 3 -->
        <div class="border-b border-gray-200">
          <button @click="active = active === 3 ? null : 3" class="w-full flex items-center justify-between py-5 text-left gap-4 focus:outline-none">
            <span class="text-sm font-medium text-gray-800">How accurate are the results from these calculators?</span>
            <div class="w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0" style="background:#EEF0FB;">
              <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="active === 3 ? 'rotate-45' : ''" fill="none" stroke="#3B4FE8" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/>
              </svg>
            </div>
          </button>
          <div x-show="active === 3" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="pb-5">
            <p class="text-gray-500 text-sm leading-relaxed">Our calculators maintain a 99% accuracy rate using precision-engineered algorithms. Each tool is regularly tested and updated to ensure reliable and correct results.</p>
          </div>
        </div>

        <!-- FAQ 4 -->
        <div class="border-b border-gray-200">
          <button @click="active = active === 4 ? null : 4" class="w-full flex items-center justify-between py-5 text-left gap-4 focus:outline-none">
            <span class="text-sm font-medium text-gray-800">Can I use these calculators on my mobile phone or tablet?</span>
            <div class="w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0" style="background:#EEF0FB;">
              <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="active === 4 ? 'rotate-45' : ''" fill="none" stroke="#3B4FE8" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/>
              </svg>
            </div>
          </button>
          <div x-show="active === 4" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="pb-5">
            <p class="text-gray-500 text-sm leading-relaxed">Absolutely! Calculator Online is fully responsive and works seamlessly on all devices including smartphones, tablets, laptops, and desktops.</p>
          </div>
        </div>

        <!-- FAQ 5 -->
        <div class="border-b border-gray-200">
          <button @click="active = active === 5 ? null : 5" class="w-full flex items-center justify-between py-5 text-left gap-4 focus:outline-none">
            <span class="text-sm font-medium text-gray-800">How many calculators are available on this website?</span>
            <div class="w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0" style="background:#EEF0FB;">
              <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="active === 5 ? 'rotate-45' : ''" fill="none" stroke="#3B4FE8" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/>
              </svg>
            </div>
          </button>
          <div x-show="active === 5" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="pb-5">
            <p class="text-gray-500 text-sm leading-relaxed">We currently offer 500+ specialized calculators across categories including Finance, Math, Health, Construction, Chemistry, Physics, Statistics, and more. New tools are added regularly.</p>
          </div>
        </div>

        <!-- FAQ 6 -->
        <div class="border-b border-gray-200">
          <button @click="active = active === 6 ? null : 6" class="w-full flex items-center justify-between py-5 text-left gap-4 focus:outline-none">
            <span class="text-sm font-medium text-gray-800">Can I suggest a new calculator to be added to the site?</span>
            <div class="w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0" style="background:#EEF0FB;">
              <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="active === 6 ? 'rotate-45' : ''" fill="none" stroke="#3B4FE8" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/>
              </svg>
            </div>
          </button>
          <div x-show="active === 6" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="pb-5">
            <p class="text-gray-500 text-sm leading-relaxed">Yes! We welcome suggestions from our users. You can reach out to us via the Contact Us page and we'll do our best to add your requested calculator as soon as possible.</p>
          </div>
        </div>

      </div>
    </div>
  </section>
  