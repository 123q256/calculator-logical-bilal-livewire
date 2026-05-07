<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-center font-s-18"><strong class="text-danger">{{ $error }}</strong></p>
            @endif

            <div class="lg:w-[80%] md:w-[90%] w-full mx-auto">
                <div class="col-lg-12 mx-auto mb-4">
                    <div class="row align-items-center">
                        <strong class="col-lg-12 mb-2 font-s-14">{{ $lang['to_cal'] ?? "To Calculate" }} :</strong>
                        <div class="col-lg-12">
                            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 py-1">
                                <div class="lg:w-1/4 md:w-1/2 w-full px-1 py-1">
                                    <div wire:click="switchTab(1)"
                                        class="bg-white px-2 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $main == 1 ? 'tagsUnit' : '' }}">
                                        {{ $lang['1'] ?? "Document" }}
                                    </div>
                                </div>
                                <div class="lg:w-1/4 md:w-1/2 w-full px-1 py-1">
                                    <div wire:click="switchTab(2)"
                                        class="bg-white px-2 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $main == 2 ? 'tagsUnit' : '' }}">
                                        {{ $lang['2'] ?? "Book" }}
                                    </div>
                                </div>
                                <div class="lg:w-1/4 md:w-1/2 w-full px-1 py-1">
                                    <div wire:click="switchTab(3)"
                                        class="bg-white px-2 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $main == 3 ? 'tagsUnit' : '' }}">
                                        {{ $lang['3'] ?? "Speech" }}
                                    </div>
                                </div>
                                <div class="lg:w-1/4 md:w-1/2 w-full px-1 py-1">
                                    <div wire:click="switchTab(4)"
                                        class="bg-white px-2 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $main == 4 ? 'tagsUnit' : '' }}">
                                        {{ $lang['4'] ?? "Language" }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Document Section --}}
                @if ($main == 1)
                    <div class="grid grid-cols-2 gap-4 document" wire:key="document-section">
                        <div class="col-span-2 md:col-span-1">
                            <label for="page" class="font-s-14 text-blue">{{ $lang['5'] ?? "Pages" }}</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" wire:model.live="page" id="page" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label for="size" class="font-s-14 text-blue">{{ $lang['6'] ?? "Size" }}</label>
                            <div class="w-100 py-2 position-relative">
                                <select wire:model.live="size" id="size" class="input text-blue font-s-16">
                                    @foreach (["10", "11", "12", "13", "14"] as $val)
                                        <option value="{{ $val }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label for="font" class="font-s-14 text-blue">{{ $lang['7'] ?? "Font" }}</label>
                            <div class="w-100 py-2 position-relative">
                                <select wire:model.live="font" id="font" class="input text-blue font-s-16">
                                    @php
                                        $fonts = [
                                            "Times" => "Times New Roman", "Calibri" => "Calibri", "Courier" => "Courier",
                                            "Garamond" => "Garamond", "Verdana" => "Verdana", "Arial" => "Arial",
                                            "Helvetica" => "Helvetica", "Century Gothic" => "Century Gothic",
                                            "Candara" => "Candara", "Cambria" => "Cambria", "custom" => "Other"
                                        ];
                                    @endphp
                                    @foreach ($fonts as $val => $name)
                                        <option value="{{ $val }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label for="space" class="font-s-14 text-blue">{{ $lang['8'] ?? "Spacing" }}</label>
                            <div class="w-100 py-2 position-relative">
                                <select wire:model.live="space" id="space" class="input text-blue font-s-16">
                                    <option value="single">Single</option>
                                    <option value="1.5">1.5</option>
                                    <option value="double">Double</option>
                                </select>
                            </div>
                        </div>
                        @if ($font == 'custom')
                            <div class="col-span-2">
                                <label for="custom_font" class="font-s-14 text-blue">{{ $lang['cus'] ?? "Add Your Own Font" }}</label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="text" wire:model.live="custom_font" id="custom_font" class="input" aria-label="input" placeholder="Times New Roman" />
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                {{-- Book & Speech Section --}}
                @if ($main == 2 || $main == 3)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 books" wire:key="book-speech-section">
                        <div class="col-span-2">
                            <label for="title" class="font-s-14 text-blue">{{ $lang['11'] ?? "Title" }}</label>
                            <div class="w-100 py-2 position-relative">
                                @if ($main == 2)
                                    <select wire:model.live="title" id="title" class="input text-blue font-s-16">
                                        @php
                                            $books = [
                                                "Empty" => "Enter Page Count manually", "Quran" => "Quran", "Bible" => "The Bible (KJV)",
                                                "Gatsby" => "The Great Gatsby", "Harry" => "Harry Potter (Series)", "Av_noval" => "Average Novel",
                                                "Hobbit" => "The Hobbit", "Rings" => "The Lord of the Rings", "Peace" => "War and Peace",
                                                "Pride" => "Pride and Prejudice", "Rich" => "Rich Dad Poor Dad", "Great_Ex" => "Great Expectations",
                                                "Shakespearean" => "Shakespearean Tragedy Play", "custom" => "Other Title"
                                            ];
                                        @endphp
                                        @foreach ($books as $val => $name)
                                            <option value="{{ $val }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select wire:model.live="sp_title" id="sp_title" class="input text-blue font-s-16">
                                        @php
                                            $speeches = [
                                                "Empty" => "Enter Duration manually", "Perfect" => "A More Perfect Union",
                                                "Gettysburg" => "Gettysburg Address", "Dream" => "I Have A Dream",
                                                "Beaches" => "We Shall Fight on the Beaches", "custom" => "Other Speech"
                                            ];
                                        @endphp
                                        @foreach ($speeches as $val => $name)
                                            <option value="{{ $val }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>

                        @if (($main == 2 && $title == 'custom') || ($main == 3 && $sp_title == 'custom'))
                            <div class="col-span-2">
                                <label for="title2" class="font-s-14 text-blue">{{ $lang['11'] ?? "Add Your Own Title" }}</label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="text" wire:model.live="title2" id="title2" class="input" aria-label="input" placeholder="Title" />
                                </div>
                            </div>
                        @endif

                        @if (($main == 2 && $title == 'Empty') || ($main == 3 && $sp_title == 'Empty'))
                            <div class="col-span-2 text-center my-1 text-gray">----------- OR -----------</div>
                            <div class="col-span-2">
                                <label for="page2" class="font-s-14 text-blue">
                                    {{ $main == 2 ? ($lang['5'] ?? "Pages") : ($lang['12'] ?? "Minutes") }}
                                </label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="number" wire:model.live="page2" id="page2" class="input" aria-label="input" placeholder="00" />
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                {{-- Language Section --}}
                @if ($main == 4)
                    <div class="grid grid-cols-1 gap-4 langu" wire:key="language-section">
                        <div class="col-span-1">
                            <label for="lang_select" class="font-s-14 text-blue">{{ $lang['13'] ?? "Language" }}</label>
                            <div class="py-2">
                                <select wire:model.live="lang_select" id="lang_select" class="input text-blue font-s-16">
                                    @php
                                        $langs = ["English", "French", "German", "Russian", "Spanish", "Japanese", "Korean", "Portuguese", "Swedish", "Italian", "Hindi", "Urdu", "Arabic", "Turkish", "Chinese"];
                                    @endphp
                                    @foreach ($langs as $l)
                                        <option value="{{ $l }}">{{ $l }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>
    </form>

    @isset($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" wire:key="result-{{ $result_key }}" class="col-12 bg-light-blue result p-4 radius-10 mt-5 overflow-auto">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            </div>
            <div class="row mt-4">
                <div class="text-center">
                    <p class="font-s-18"><strong>{{ $lang['ans_key'] ?? "Word Count" }}</strong></p>
                    <p class="font-s-25 bg-white px-4 py-3 radius-10 d-inline-block my-2">
                        <strong class="text-blue">{{ $detail['counter'] }}</strong>
                    </p>
                </div>
            </div>
        </div>
    @endisset
</div>
