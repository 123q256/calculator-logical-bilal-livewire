<div>
    <style>
        @media (max-width: 380px) {
            .calculator-box {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }
        }
        .velocitytab .v_active {
            border-bottom: 3px solid var(--light-blue);
        }
        .velocitytab .v_active strong {
            color: var(--light-blue);
        }
        .velocitytab p {
            position: relative;
            top: 2px;
        }
        .active {
            background-color: var(--light-blue);
            color: white;
        }
        .select2 {
            width: 100% !important;
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="row mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-center font-s-18"><strong class="text-danger">{{ $error }}</strong></p>
            @endif
             <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
            <div class="col-lg-7 mx-auto">
                <div class="row align-items-center">
                    <strong class="col-lg-12 mb-2 font-s-14">{{ $lang['to_cal'] ?? "To Calculate" }} :</strong>
                    <div class="col-lg-12">
                        <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 py-1">
                            <div class="lg:w-1/2 w-full px-2 py-1">
                                <div wire:click="switchTab(1)"
                                    class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $main == 1 ? 'tagsUnit' : '' }}">
                                    {{ $lang['1'] ?? "Document" }}
                                </div>
                            </div>
                            <div class="lg:w-1/2 w-full px-2 py-1">
                                <div wire:click="switchTab(2)"
                                    class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $main == 2 ? 'tagsUnit' : '' }}">
                                    {{ $lang['2'] ?? "Book" }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 mx-auto">
                {{-- Document Section --}}
                @if ($main == 1)
                    <div class="grid grid-cols-2 gap-4 document" wire:key="document-section">
                        <div class="col-span-2 md:col-span-1">
                            <label for="page" class="font-s-14 text-blue">{{ $lang['5'] ?? "Words" }}</label>
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

                {{-- Book Section --}}
                @if ($main == 2)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 books" wire:key="book-section">
                        <div class="col-span-2">
                            <label for="title" class="font-s-14 text-blue">{{ $lang['11'] ?? "Title" }}</label>
                            <div class="w-100 py-2 position-relative">
                                <select wire:model.live="title" id="title" class="input text-blue font-s-16">
                                    @php
                                        $books = [
                                            "Empty" => "Enter Word Count manually", "Quran" => "Quran", "Bible" => "The Bible (KJV)",
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
                            </div>
                        </div>
                        @if ($title == 'custom')
                            <div class="col-span-2">
                                <label for="title2" class="font-s-14 text-blue">{{ $lang['11'] ?? "Add Your Own Title" }}</label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="text" wire:model.live="title2" id="title2" class="input" aria-label="input" placeholder="Title" />
                                </div>
                            </div>
                        @endif

                        @if ($title == 'Empty')
                            <div class="col-span-2 text-center my-1 text-gray">----------- OR -----------</div>
                            <div class="col-span-2">
                                <label for="page2" class="font-s-14 text-blue" id="p_m">{{ $lang['5'] ?? "Words" }}</label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="number" wire:model.live="page2" id="page2" class="input" aria-label="input" placeholder="00" />
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
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
                    <p class="font-s-18"><strong>{{ $lang['ans_key'] ?? "Pages Count" }}</strong></p>
                    <p class="font-s-25 bg-white px-4 py-3 radius-10 d-inline-block my-2">
                        <strong class="text-blue">{{ $detail['counter'] }}</strong>
                    </p>
                </div>
            </div>
        </div>
    @endisset
</div>
