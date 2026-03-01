  <!-- CATEGORIES — 10 total: 5 per row (2 rows desktop), 2 per row mobile -->
  <section id="categories" class="py-12 sm:py-12 bg-white">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
          <div class="text-center mb-12">
              <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">Browse by Category</h2>
              <p class="text-gray-500">Find the perfect calculator for your specific needs</p>
          </div>

          <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-4">

              <!-- 1. Health -->
              <a href="{{ url('health') }}"
                  class="border border-gray-200 rounded-2xl p-5 hover:shadow-md hover:border-indigo-200 transition-all cursor-pointer group text-center block">
                  <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-3 mx-auto transition-colors"
                      style="background:#EEF0FB;">
                      <svg class="w-6 h-6" fill="none" stroke="#3B4FE8" stroke-width="2" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4.318 6.318a4.5 4.5 0 0 1 6.364 0L12 7.636l1.318-1.318a4.5 4.5 0 1 1 6.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 0 1 0-6.364z" />
                      </svg>
                  </div>
                  <h3 class="font-semibold text-gray-800 text-sm">Health</h3>
              </a>

              <!-- 2. Math -->
              <a href="{{ url('math') }}"
                  class="border border-gray-200 rounded-2xl p-5 hover:shadow-md hover:border-indigo-200 transition-all cursor-pointer group text-center block">
                  <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-3 mx-auto transition-colors"
                      style="background:#EEF0FB;">
                      <svg class="w-6 h-6" fill="none" stroke="#3B4FE8" stroke-width="2" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2z" />
                      </svg>
                  </div>
                  <h3 class="font-semibold text-gray-800 text-sm">Math</h3>
              </a>

              <!-- 3. Everyday Life -->
              <a href="{{ url('everyday-life') }}"
                  class="border border-gray-200 rounded-2xl p-5 hover:shadow-md hover:border-indigo-200 transition-all cursor-pointer group text-center block">
                  <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-3 mx-auto transition-colors"
                      style="background:#EEF0FB;">
                      <svg class="w-6 h-6" fill="none" stroke="#3B4FE8" stroke-width="2" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 0 0 1 1h3m10-11l2 2m-2-2v10a1 1 0 0 1-1 1h-3m-6 0h6" />
                      </svg>
                  </div>
                  <h3 class="font-semibold text-gray-800 text-sm">Everyday Life</h3>
              </a>

              <!-- 4. Finance -->
              <a href="{{ url('finance') }}"
                  class="border border-gray-200 rounded-2xl p-5 hover:shadow-md hover:border-indigo-200 transition-all cursor-pointer group text-center block">
                  <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-3 mx-auto transition-colors"
                      style="background:#EEF0FB;">
                      <svg class="w-8 h-8" fill="none" stroke="#3B4FE8" stroke-width="2" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                      </svg>
                  </div>
                  <h3 class="font-semibold text-gray-800 text-sm">Finance</h3>
              </a>

              <!-- 5. Physics -->
              <a href="{{ url('physics') }}"
                  class="border border-gray-200 rounded-2xl p-5 hover:shadow-md hover:border-indigo-200 transition-all cursor-pointer group text-center block">
                  <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-3 mx-auto transition-colors"
                      style="background:#EEF0FB;">
                      <svg class="w-6 h-6" fill="none" stroke="#3B4FE8" stroke-width="2" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                      </svg>
                  </div>
                  <h3 class="font-semibold text-gray-800 text-sm">Physics</h3>
              </a>

              <!-- 6. Chemistry -->
              <a href="{{ url('chemistry') }}"
                  class="border border-gray-200 rounded-2xl p-5 hover:shadow-md hover:border-indigo-200 transition-all cursor-pointer group text-center block">
                  <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-3 mx-auto transition-colors"
                      style="background:#EEF0FB;">
                      <svg class="w-6 h-6" fill="none" stroke="#3B4FE8" stroke-width="2" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.428 15.428a2 2 0 0 0-1.022-.547l-2.387-.477a6 6 0 0 0-3.86.517l-.318.158a6 6 0 0 1-3.86.517L6.05 15.21a2 2 0 0 0-1.806.547M8 4h8l-1 1v5.172a2 2 0 0 0 .586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 0 0 9 10.172V5L8 4z" />
                      </svg>
                  </div>
                  <h3 class="font-semibold text-gray-800 text-sm">Chemistry</h3>
              </a>

              <!-- 7. Statistics -->
              <a href="{{ url('statistics') }}"
                  class="border border-gray-200 rounded-2xl p-5 hover:shadow-md hover:border-indigo-200 transition-all cursor-pointer group text-center block">
                  <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-3 mx-auto transition-colors"
                      style="background:#EEF0FB;">
                      <svg class="w-6 h-6" fill="none" stroke="#3B4FE8" stroke-width="2" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 19v-6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v6m6 0V9a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v10m6 0V5a2 2 0 0 0 2-2h2a2 2 0 0 0 2 2v14m0 0h2" />
                      </svg>
                  </div>
                  <h3 class="font-semibold text-gray-800 text-sm">Statistics</h3>
              </a>

              <!-- 8. Construction -->
              <a href="{{ url('construction') }}"
                  class="border border-gray-200 rounded-2xl p-5 hover:shadow-md hover:border-indigo-200 transition-all cursor-pointer group text-center block">
                  <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-3 mx-auto transition-colors"
                      style="background:#EEF0FB;">
                      <svg class="w-6 h-6" fill="none" stroke="#3B4FE8" stroke-width="2" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 21V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5m-4 0h4" />
                      </svg>
                  </div>
                  <h3 class="font-semibold text-gray-800 text-sm">Construction</h3>
              </a>

              <!-- 9. Pets -->
              <a href="{{ url('pets') }}"
                  class="border border-gray-200 rounded-2xl p-5 hover:shadow-md hover:border-indigo-200 transition-all cursor-pointer group text-center block">
                  <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-3 mx-auto transition-colors"
                      style="background:#EEF0FB;">
                      <svg class="w-6 h-6" fill="none" stroke="#3B4FE8" stroke-width="2" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round"
                              d="M14 10h.01M10 10h.01M7 14c0 2.21 2.239 4 5 4s5-1.79 5-4M9 7c0 1.105-.448 2-1 2S7 8.105 7 7s.448-2 1-2 1 .895 1 2zm6 0c0 1.105-.448 2-1 2s-1-.895-1-2 .448-2 1-2 1 .895 1 2z" />
                      </svg>
                  </div>
                  <h3 class="font-semibold text-gray-800 text-sm">Pets</h3>
              </a>

              <!-- 10. Time & Date -->
              <a href="{{ url('timedate') }}"
                  class="border border-gray-200 rounded-2xl p-5 hover:shadow-md hover:border-indigo-200 transition-all cursor-pointer group text-center block">
                  <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-3 mx-auto transition-colors"
                      style="background:#EEF0FB;">
                      <svg class="w-6 h-6" fill="none" stroke="#3B4FE8" stroke-width="2" viewBox="0 0 24 24">
                          <circle cx="12" cy="12" r="9" stroke-width="2" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 3" />
                      </svg>
                  </div>
                  <h3 class="font-semibold text-gray-800 text-sm">Time & Date</h3>
              </a>
              <!-- 10. Unit Converter -->
            <a href="{{ url('unit-converter') }}"
                class="border border-gray-200 rounded-2xl p-5 hover:shadow-md hover:border-indigo-200 transition-all cursor-pointer group text-center block">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-3 mx-auto transition-colors"
                    style="background:#EEF0FB;">
                    <svg class="w-6 h-6" fill="none" stroke="#3B4FE8" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4M4 17h12m0 0l-4-4m4 4l-4 4"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800 text-sm">Unit Converter</h3>
            </a>

          </div>
      </div>
  </section>