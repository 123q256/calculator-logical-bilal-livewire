@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)
@section('content')
    <style>
        .cursor-pointer {
            cursor: pointer !important;
        }

        .border-bb {
            border: 1px solid #D2D4D8 !important;
        }

        .autosearch-activeclass {
            background-color: #1670a712;
        }

        .search_bars_div {
            border: 1px solid #D2D4D8 !important;
        }
    </style>
    <!-- Scroll to Top Button -->

    {{-- calculator --}}
    {{-- @include('layouts.include.hero') --}}
      @livewire('search.calculator-search')
    {{-- about category --}}
    @include('layouts.include.category')
    {{-- About Calculator --}}
    @include('layouts.include.used_calculators')
    {{-- Why Choose Calculator Online --}}
    @include('layouts.include.why_choose_calculator')
    {{-- Free Tools --}}
    @include('layouts.include.free_tools')
    {{-- About Calculator Online --}}
    @include('layouts.include.about_calculator')
    {{-- Trusted by testimonials --}}
    @include('layouts.include.testimonials')
    {{-- CTA Calculation --}}
    @include('layouts.include.cta_banner')
    {{-- Featured In --}}
    @include('layouts.include.featured_in')
    {{-- FAQs --}}
    @include('layouts.include.faqs')
 

@endsection
@push('calculatorJS')
    {{-- home page search  --}}
    <script>
        function autocomplete(inp, arr) {
            arr = Object.entries(arr);
            var currentFocus;
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                a = document.createElement("div");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class",
                    "absolute autosearchcomplete-items space-y-1 max-h-80 overflow-y-auto text-start bg-white rounded-lg shadow-inner mt-[28px] w-full top-[20px]"
                );
                this.parentNode.appendChild(a);
                for (i = 0; i < arr.length; i++) {
                    if (arr[i][1][0].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        // if (arr[i][1][0].toUpperCase().indexOf(val.toUpperCase()) !== -1) {
                        b = document.createElement("div");
                        b.innerHTML = " <a href='" + window.location.origin + '/' + arr[i][1][1] +
                            "' class='block items-center py-2 rounded  border-bb   group hover:shadow-sm hover:bg-gray-50'> <strong class=' ms-3 whitespace-nowrap' >" +
                            arr[i][1][0].substr(0, val.length) + "</strong>" + arr[i][1][0].substr(val.length) +
                            ' </a>';

                        b.addEventListener("click", function(e) {
                            closeAllLists();
                            var href = this.querySelector('a').getAttribute('href');
                            window.location.href = href;
                        });
                        a.appendChild(b);
                    }
                }
                document.querySelectorAll('.suggestion').forEach(function(element) {
                    element.style.display = 'none';
                });
            });
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    // console.log('keydown');
                    currentFocus++;
                    addActive(x);
                } else if (e.keyCode == 38) {
                    currentFocus--;
                    addActive(x);
                } else if (e.keyCode == 13) {
                    // e.preventDefault();
                    if (currentFocus > -1) {
                        if (x) x[currentFocus].click();
                    }
                }
                document.querySelectorAll('.recently_calculators').forEach(function(element) {
                    element.style.display = 'none';
                });

            });

            function addActive(x) {
                if (!x) return false;
                console.log('keydown');

                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                x[currentFocus].classList.add("autosearch-activeclass");
            }

            function removeActive(x) {
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autosearch-activeclass");
                }
            }

            function closeAllLists(elmnt) {
                var x = document.getElementsByClassName("autosearchcomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        }
        autocomplete(document.getElementById("search-bars"), searchCalculators);


        let searchimg_index = document.querySelector(".searchsvg");
        let searchinput = document.querySelector(".searchinput");
        if (searchimg_index) {
            searchimg_index.addEventListener("click", function() {
                searchinput.focus();
            });
        }
        // show_calculator
        function show_calculator(button) {
            const value = button.value;
            // You can use this value to perform specific actions
            if (value === "scientific") {
                $('#scientific_calculator').hide();
                $('#simple_calculator').show();
                $('#left_calulator').show();
                // Show scientific calculator
            } else if (value === "simple") {
                $('#scientific_calculator').show();
                $('#simple_calculator').hide();
                $('#left_calulator').hide();
                // Show simple calculator
            }
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".scroll-link").addEventListener("click", function(e) {
                e.preventDefault(); // Prevent default anchor behavior
                const target = document.getElementById("targetDiv");
                if (target) {
                    target.scrollIntoView({
                        behavior: "smooth",
                        block: "start"
                    });
                }
            });
        });
    </script>
@endpush
