<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <label for="selection" class="label">{{ $lang['1'] }}</label>
                    <div class="w-100 py-2 relative">
                        <select name="selection" id="selection" class="input">
                            <option value="1"
                                {{ isset($_POST['selection']) && $_POST['selection'] == '1' ? 'selected' : '' }}>
                                {{ $lang['2'] }}</option>
                            <option value="2"
                                {{ isset($_POST['selection']) && $_POST['selection'] == '2' ? 'selected' : '' }}>
                                {{ $lang['3'] }}</option>
                            <option value="3"
                                {{ isset($_POST['selection']) && $_POST['selection'] == '3' ? 'selected' : '' }}>
                                {{ $lang['4'] }}</option>
                            <option value="4"
                                {{ isset($_POST['selection']) && $_POST['selection'] == '4' ? 'selected' : '' }}>
                                {{ $lang['5'] }}</option>
                            <option value="7"
                                {{ isset($_POST['selection']) && $_POST['selection'] == '7' ? 'selected' : '' }}>
                                {{ $lang['6'] }}</option>
                            <option value="8"
                                {{ isset($_POST['selection']) && $_POST['selection'] == '8' ? 'selected' : '' }}>
                                I-{{ $lang['7'] }}</option>
                            <option value="9"
                                {{ isset($_POST['selection']) && $_POST['selection'] == '9' ? 'selected' : '' }}>
                                L-{{ $lang['7'] }}</option>
                            <option value="10"
                                {{ isset($_POST['selection']) && $_POST['selection'] == '10' ? 'selected' : '' }}>
                                T-{{ $lang['7'] }}</option>
                            <option value="11"
                                {{ isset($_POST['selection']) && $_POST['selection'] == '11' ? 'selected' : '' }}>
                                {{ $lang['8'] }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 flex justify-center my-3">
                            <img src="{{ asset('images/p9.png') }}" alt="moment of inertia calculator" width="180"
                                height="180" class="change_img coloring">
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 base">
                    <label for="b_width" class="label">{{ $lang['9'] }} (b):</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="b_width" id="b_width" class="input" aria-label="input"
                            placeholder="00" value="{{ isset($_POST['b_width']) ? $_POST['b_width'] : '1' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden radius">
                    <label for="radius" class="label">D({{ $lang['10'] }})</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="radius" id="radius" class="input" aria-label="input"
                            placeholder="00" value="{{ isset($_POST['radius']) ? $_POST['radius'] : '1' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden radius2">
                    <label for="radius2" class="label">d({{ $lang['11'] }})</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="radius2" id="radius2" class="input" aria-label="input"
                            placeholder="00" value="{{ isset($_POST['radius2']) ? $_POST['radius2'] : '1' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 height">
                    <label for="height" class="label h">{{ $lang['12'] }} (h)</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="height" id="height" class="input" aria-label="input"
                            placeholder="00" value="{{ isset($_POST['height']) ? $_POST['height'] : '1' }}" />
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6 distance">
                    <label for="dis_to_height" class="label d">{{ $lang['13'] }} (a)</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="dis_to_height" id="dis_to_height" class="input"
                            aria-label="input" placeholder="00"
                            value="{{ isset($_POST['dis_to_height']) ? $_POST['dis_to_height'] : '1' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden tfw">
                    <label for="tfw" class="label d">TFw</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="tfw" id="tfw" class="input" aria-label="input"
                            placeholder="00" value="{{ isset($_POST['tfw']) ? $_POST['tfw'] : '1' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden dis tft">
                    <label for="tft" class="label d">TFt</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="tft" id="tft" class="input"
                            aria-label="input" placeholder="00"
                            value="{{ isset($_POST['tft']) ? $_POST['tft'] : '1' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden dis bfw">
                    <label for="bfw" class="label d">BFw</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="bfw" id="bfw" class="input"
                            aria-label="input" placeholder="00"
                            value="{{ isset($_POST['bfw']) ? $_POST['bfw'] : '1' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden dis bft">
                    <label for="bft" class="label d">BFt</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="bft" id="bft" class="input"
                            aria-label="input" placeholder="00"
                            value="{{ isset($_POST['bft']) ? $_POST['bft'] : '1' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden dis lft">
                    <label for="lft" class="label d">LFt</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="lft" id="lft" class="input"
                            aria-label="input" placeholder="00"
                            value="{{ isset($_POST['lft']) ? $_POST['lft'] : '1' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden dis lfh">
                    <label for="lfh" class="label d">LFh</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="lfh" id="lfh" class="input"
                            aria-label="input" placeholder="00"
                            value="{{ isset($_POST['lfh']) ? $_POST['lfh'] : '1' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden dis wh">
                    <label for="wh" class="label d">Wh</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="wh" id="wh" class="input"
                            aria-label="input" placeholder="00"
                            value="{{ isset($_POST['wh']) ? $_POST['wh'] : '1' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden dis wt">
                    <label for="wt" class="label d">Wt</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="wt" id="wt" class="input"
                            aria-label="input" placeholder="00"
                            value="{{ isset($_POST['wt']) ? $_POST['wt'] : '1' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden dis r">
                    <label for="r" class="label d">r</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="r" id="r" class="input"
                            aria-label="input" placeholder="00" value="{{ isset($_POST['r']) ? $_POST['r'] : '1' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden dis b1">
                    <label for="b1" class="label d">b1</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="b1" id="b1" class="input"
                            aria-label="input" placeholder="00"
                            value="{{ isset($_POST['b1']) ? $_POST['b1'] : '1' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden dis h1">
                    <label for="h1" class="label d">h</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="h1" id="h1" class="input"
                            aria-label="input" placeholder="00"
                            value="{{ isset($_POST['h1']) ? $_POST['b1'] : '1' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="unit" class="label">{{ $lang['14'] }}</label>
                    <div class="w-100 py-2 relative">
                        <select name="unit" id="unit" class="input">
                            <option value="mm"
                                {{ isset($_POST['unit']) && $_POST['unit'] == 'mm' ? 'selected' : '' }}> mm</option>
                            <option value="m" {{ isset($_POST['unit']) && $_POST['unit'] == 'm' ? 'selected' : '' }}>
                                m</option>
                            <option value="cm"
                                {{ isset($_POST['unit']) && $_POST['unit'] == 'cm' ? 'selected' : '' }}>cm</option>
                            <option value="in"
                                {{ isset($_POST['unit']) && $_POST['unit'] == 'in' ? 'selected' : '' }}>in</option>
                            <option value="ft"
                                {{ isset($_POST['unit']) && $_POST['unit'] == 'ft' ? 'selected' : '' }}>ft</option>
                        </select>
                    </div>
                </div>

            </div>
        @if ($type == 'calculator')
        @include('inc.button')
        @endif
        @if ($type=='widget')
        @include('inc.widget-button')
        @endif
 </div>

            
    @isset($detail)
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="40%"><strong>Ix</strong></td>
                                <td class="py-2 border-b"> {{ $detail['answer1'] }} {!! $detail['m4'] !!}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="40%"><strong>Iy</strong></td>
                                <td class="py-2 border-b"> {{ $detail['answer2'] }} {!! $detail['m4'] !!}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="40%"><strong>Cy</strong></td>
                                <td class="py-2 border-b"> {{ $detail['answer3'] }} {!! $detail['m'] !!}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="40%"><strong>Cx</strong></td>
                                <td class="py-2 border-b"> {{ $detail['answer4'] }} {!! $detail['m'] !!}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="40%"><strong>Area</strong></td>
                                <td class="py-2 border-b"> {{ $detail['answer5'] }} {!! $detail['m2'] !!}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="40%"><strong>Sz</strong></td>
                                <td class="py-2 border-b"> {{ $detail['answer6'] }} {!! $detail['m3'] !!}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="40%"><strong>Sx</strong></td>
                                <td class="py-2 border-b"> {{ $detail['answer7'] }} {!! $detail['m3'] !!}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
    @if (isset($detail))
        var value = "{{ $_POST['selection'] }}";


        // Helper function to show elements
        function showElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelector(selector).classList.remove('hidden');
            });
        }

        // Helper function to hide elements
        function hideElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelector(selector).classList.add('hidden');
            });
        }

        // Helper function to update inner HTML
        function updateHTML(selector, html) {
            document.querySelector(selector).innerHTML = html;
        }

        // Helper function to update image source
        function updateImageSource(selector, src) {
            document.querySelector(selector).setAttribute('src', src);
        }

        switch (value) {
            case '1':
                showElements(['.distance', '.base', '.height']);
                updateHTML('.b', "{{ $lang[15] }}(b)");
                updateHTML('.h', "{{ $lang[12] }}(a)");
                hideElements(['.tfw', '.tft', '.bfw', '.bft', '.lft', '.lfh', '.wh', '.wt', '.b1', '.h1', '.r',
                    '.radius', '.radius2'
                ]);
                updateImageSource('.change_img', "{{ asset('images/p9.png') }}");
                break;
            case '2':
                updateImageSource('.change_img', "{{ asset('images/p1.png') }}");
                showElements(['.base', '.height']);
                updateHTML('.b', "{{ $lang[15] }}(b)");
                updateHTML('.h', "{{ $lang[12] }}(a)");
                hideElements(['.tfw', '.tft', '.bfw', '.bft', '.lft', '.lfh', '.wh', '.wt', '.b1', '.h1', '.distance',
                    '.radius', '.radius2'
                ]);
                break;
            case '3':
                updateImageSource('.change_img', "{{ asset('images/p4.png') }}");
                showElements(['.radius', '.radius2']);
                hideElements(['.tfw', '.tft', '.bfw', '.bft', '.lft', '.lfh', '.wh', '.wt', '.b1', '.h1', '.r', '.base',
                    '.height', '.distance'
                ]);
                break;
            case '4':
                updateImageSource('.change_img', "{{ asset('images/p3.png') }}");
                showElements(['.radius']);
                hideElements(['.tfw', '.tft', '.bfw', '.bft', '.lft', '.lfh', '.wh', '.wt', '.b1', '.h1', '.r', '.base',
                    '.height', '.distance', '.radius2'
                ]);
                break;
            case '5':
                showElements(['.height', '.base']);
                updateHTML('.b', "{{ $lang[16] }} x-axis(b)");
                updateHTML('.h', "{{ $lang[16] }} y-axis(a)");
                hideElements(['.tfw', '.tft', '.bfw', '.bft', '.lft', '.lfh', '.wh', '.wt', '.b1', '.h1', '.distance',
                    '.radius', '.radius2'
                ]);
                updateImageSource('.change_img', "{{ asset('images/ellipse.svg') }}");
                break;
            case '6':
                hideElements(['.distance', '.height', '.radius']);
                showElements(['.base']);
                updateHTML('.b', "{{ $lang[17] }}(a)");
                updateImageSource('.change_img', "{{ asset('images/hexagon.svg') }}");
                break;
            case '7':
                showElements(['.base', '.height', '.b1', '.h1']);
                hideElements(['.tfw', '.tft', '.bfw', '.bft', '.lft', '.lfh', '.wh', '.wt', '.distance', '.radius',
                    '.radius2'
                ]);
                updateImageSource('.change_img', "{{ asset('images/p2.png') }}");
                break;
            case '8':
                showElements(['.tfw', '.tft', '.bfw', '.bft', '.wh', '.wt']);
                hideElements(['.lft', '.lfh', '.distance', '.radius', '.base', '.b1', '.h1', '.height', '.lft', '.lfh',
                    '.radius2'
                ]);
                updateImageSource('.change_img', "{{ asset('images/p5.png') }}");
                break;
            case '9':
                showElements(['.bfw', '.bft', '.lfh', '.lft']);
                hideElements(['.tfw', '.tft', '.distance', '.radius', '.base', '.b1', '.h1', '.height', '.radius2',
                    '.wh', '.wt'
                ]);
                updateImageSource('.change_img', "{{ asset('images/p7.png') }}");
                break;
            case '10':
                showElements(['.tfw', '.tft', '.wh', '.wt']);
                hideElements(['.lfh', '.lft', '.distance', '.radius', '.base', '.b1', '.h1', '.height', '.radius2',
                    '.bfw', '.bft'
                ]);
                updateImageSource('.change_img', "{{ asset('images/p6.png') }}");
                break;
            case '11':
                showElements(['.tfw', '.tft', '.bfw', '.bft', '.h1', '.wt']);
                hideElements(['.lfh', '.lft', '.distance', '.radius', '.base', '.wh', '.height', '.radius2']);
                updateImageSource('.change_img', "{{ asset('images/p8.png') }}");
                break;
        }
    @endif

    @if (isset($error))
        var value = "{{ $_POST['selection'] }}";


        // Helper function to show elements
        function showElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelector(selector).classList.remove('hidden');
            });
        }

        // Helper function to hide elements
        function hideElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelector(selector).classList.add('hidden');
            });
        }

        // Helper function to update inner HTML
        function updateHTML(selector, html) {
            document.querySelector(selector).innerHTML = html;
        }

        // Helper function to update image source
        function updateImageSource(selector, src) {
            document.querySelector(selector).setAttribute('src', src);
        }

        switch (value) {
            case '1':
                showElements(['.distance', '.base', '.height']);
                updateHTML('.b', "{{ $lang[15] }}(b)");
                updateHTML('.h', "{{ $lang[12] }}(a)");
                hideElements(['.tfw', '.tft', '.bfw', '.bft', '.lft', '.lfh', '.wh', '.wt', '.b1', '.h1', '.r',
                    '.radius', '.radius2'
                ]);
                updateImageSource('.change_img', "{{ asset('images/p9.png') }}");
                break;
            case '2':
                updateImageSource('.change_img', "{{ asset('images/p1.png') }}");
                showElements(['.base', '.height']);
                updateHTML('.b', "{{ $lang[15] }}(b)");
                updateHTML('.h', "{{ $lang[12] }}(a)");
                hideElements(['.tfw', '.tft', '.bfw', '.bft', '.lft', '.lfh', '.wh', '.wt', '.b1', '.h1', '.distance',
                    '.radius', '.radius2'
                ]);
                break;
            case '3':
                updateImageSource('.change_img', "{{ asset('images/p4.png') }}");
                showElements(['.radius', '.radius2']);
                hideElements(['.tfw', '.tft', '.bfw', '.bft', '.lft', '.lfh', '.wh', '.wt', '.b1', '.h1', '.r', '.base',
                    '.height', '.distance'
                ]);
                break;
            case '4':
                updateImageSource('.change_img', "{{ asset('images/p3.png') }}");
                showElements(['.radius']);
                hideElements(['.tfw', '.tft', '.bfw', '.bft', '.lft', '.lfh', '.wh', '.wt', '.b1', '.h1', '.r', '.base',
                    '.height', '.distance', '.radius2'
                ]);
                break;
            case '5':
                showElements(['.height', '.base']);
                updateHTML('.b', "{{ $lang[16] }} x-axis(b)");
                updateHTML('.h', "{{ $lang[16] }} y-axis(a)");
                hideElements(['.tfw', '.tft', '.bfw', '.bft', '.lft', '.lfh', '.wh', '.wt', '.b1', '.h1', '.distance',
                    '.radius', '.radius2'
                ]);
                updateImageSource('.change_img', "{{ asset('images/ellipse.svg') }}");
                break;
            case '6':
                hideElements(['.distance', '.height', '.radius']);
                showElements(['.base']);
                updateHTML('.b', "{{ $lang[17] }}(a)");
                updateImageSource('.change_img', "{{ asset('images/hexagon.svg') }}");
                break;
            case '7':
                showElements(['.base', '.height', '.b1', '.h1']);
                hideElements(['.tfw', '.tft', '.bfw', '.bft', '.lft', '.lfh', '.wh', '.wt', '.distance', '.radius',
                    '.radius2'
                ]);
                updateImageSource('.change_img', "{{ asset('images/p2.png') }}");
                break;
            case '8':
                showElements(['.tfw', '.tft', '.bfw', '.bft', '.wh', '.wt']);
                hideElements(['.lft', '.lfh', '.distance', '.radius', '.base', '.b1', '.h1', '.height', '.lft', '.lfh',
                    '.radius2'
                ]);
                updateImageSource('.change_img', "{{ asset('images/p5.png') }}");
                break;
            case '9':
                showElements(['.bfw', '.bft', '.lfh', '.lft']);
                hideElements(['.tfw', '.tft', '.distance', '.radius', '.base', '.b1', '.h1', '.height', '.radius2',
                    '.wh', '.wt'
                ]);
                updateImageSource('.change_img', "{{ asset('images/p7.png') }}");
                break;
            case '10':
                showElements(['.tfw', '.tft', '.wh', '.wt']);
                hideElements(['.lfh', '.lft', '.distance', '.radius', '.base', '.b1', '.h1', '.height', '.radius2',
                    '.bfw', '.bft'
                ]);
                updateImageSource('.change_img', "{{ asset('images/p6.png') }}");
                break;
            case '11':
                showElements(['.tfw', '.tft', '.bfw', '.bft', '.h1', '.wt']);
                hideElements(['.lfh', '.lft', '.distance', '.radius', '.base', '.wh', '.height', '.radius2']);
                updateImageSource('.change_img', "{{ asset('images/p8.png') }}");
                break;
        }
    @endif


    document.getElementById('selection').addEventListener('change', function() {
        var value = this.value;

        // Helper function to show elements
        function showElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelector(selector).classList.remove('hidden');
            });
        }

        // Helper function to hide elements
        function hideElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelector(selector).classList.add('hidden');
            });
        }

        // Helper function to update inner HTML
        function updateHTML(selector, html) {
            document.querySelector(selector).innerHTML = html;
        }

        // Helper function to update image source
        function updateImageSource(selector, src) {
            document.querySelector(selector).setAttribute('src', src);
        }

        switch (value) {
            case '1':
                showElements(['.distance', '.base', '.height']);
                updateHTML('.b', "{{ $lang[15] }}(b)");
                updateHTML('.h', "{{ $lang[12] }}(a)");
                hideElements(['.tfw', '.tft', '.bfw', '.bft', '.lft', '.lfh', '.wh', '.wt', '.b1', '.h1', '.r',
                    '.radius', '.radius2'
                ]);
                updateImageSource('.change_img', "{{ asset('images/p9.png') }}");
                break;
            case '2':
                updateImageSource('.change_img', "{{ asset('images/p1.png') }}");
                showElements(['.base', '.height']);
                updateHTML('.b', "{{ $lang[15] }}(b)");
                updateHTML('.h', "{{ $lang[12] }}(a)");
                hideElements(['.tfw', '.tft', '.bfw', '.bft', '.lft', '.lfh', '.wh', '.wt', '.b1', '.h1',
                    '.distance', '.radius', '.radius2'
                ]);
                break;
            case '3':
                updateImageSource('.change_img', "{{ asset('images/p4.png') }}");
                showElements(['.radius', '.radius2']);
                hideElements(['.tfw', '.tft', '.bfw', '.bft', '.lft', '.lfh', '.wh', '.wt', '.b1', '.h1', '.r',
                    '.base', '.height', '.distance'
                ]);
                break;
            case '4':
                updateImageSource('.change_img', "{{ asset('images/p3.png') }}");
                showElements(['.radius']);
                hideElements(['.tfw', '.tft', '.bfw', '.bft', '.lft', '.lfh', '.wh', '.wt', '.b1', '.h1', '.r',
                    '.base', '.height', '.distance', '.radius2'
                ]);
                break;
            case '5':
                showElements(['.height', '.base']);
                updateHTML('.b', "{{ $lang[16] }} x-axis(b)");
                updateHTML('.h', "{{ $lang[16] }} y-axis(a)");
                hideElements(['.tfw', '.tft', '.bfw', '.bft', '.lft', '.lfh', '.wh', '.wt', '.b1', '.h1',
                    '.distance', '.radius', '.radius2'
                ]);
                updateImageSource('.change_img', "{{ asset('images/ellipse.svg') }}");
                break;
            case '6':
                hideElements(['.distance', '.height', '.radius']);
                showElements(['.base']);
                updateHTML('.b', "{{ $lang[17] }}(a)");
                updateImageSource('.change_img', "{{ asset('images/hexagon.svg') }}");
                break;
            case '7':
                showElements(['.base', '.height', '.b1', '.h1']);
                hideElements(['.tfw', '.tft', '.bfw', '.bft', '.lft', '.lfh', '.wh', '.wt', '.distance',
                    '.radius', '.radius2'
                ]);
                updateImageSource('.change_img', "{{ asset('images/p2.png') }}");
                break;
            case '8':
                showElements(['.tfw', '.tft', '.bfw', '.bft', '.wh', '.wt']);
                hideElements(['.lft', '.lfh', '.distance', '.radius', '.base', '.b1', '.h1', '.height', '.lft',
                    '.lfh', '.radius2'
                ]);
                updateImageSource('.change_img', "{{ asset('images/p5.png') }}");
                break;
            case '9':
                showElements(['.bfw', '.bft', '.lfh', '.lft']);
                hideElements(['.tfw', '.tft', '.distance', '.radius', '.base', '.b1', '.h1', '.height',
                    '.radius2', '.wh', '.wt'
                ]);
                updateImageSource('.change_img', "{{ asset('images/p7.png') }}");
                break;
            case '10':
                showElements(['.tfw', '.tft', '.wh', '.wt']);
                hideElements(['.lfh', '.lft', '.distance', '.radius', '.base', '.b1', '.h1', '.height',
                    '.radius2', '.bfw', '.bft'
                ]);
                updateImageSource('.change_img', "{{ asset('images/p6.png') }}");
                break;
            case '11':
                showElements(['.tfw', '.tft', '.bfw', '.bft', '.h1', '.wt']);
                hideElements(['.lfh', '.lft', '.distance', '.radius', '.base', '.wh', '.height', '.radius2']);
                updateImageSource('.change_img', "{{ asset('images/p8.png') }}");
                break;
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>