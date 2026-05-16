 <div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1    gap-4">
                <div class="space-y-2">
                    <label for="to_calculate" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <select class="input" aria-label="select" wire:model.live="to_calculate" name="to_calculate" id="to_calculate" @click="$wire.set('detail', null)">
                        <option value="f">{{$lang['2']}}</option>
                        <option value="af">{{$lang['3']}}</option>
                        <option value="sf">{{$lang['4']}}</option>
                        <option value="mf">{{$lang['5']}}</option>
                        <option value="df">{{$lang['6']}}</option>
                    </select>
                </div>
                <p class="w-full  mt-3 text-center">
                    <strong id="textChanged">
                        @if($to_calculate === 'af')
                            {{ $lang['7'] }} (n! + m!)
                        @elseif($to_calculate === 'sf')
                            {{ $lang['7'] }} (n! - m!)
                        @elseif($to_calculate === 'mf')
                            {{ $lang['7'] }} (n! x m!)
                        @elseif($to_calculate === 'df')
                            {{ $lang['7'] }} (n! / m!)
                        @else
                            {{ $lang['7'] }} n!
                        @endif
                    </strong>
                </p>
                <div class="space-y-2">
                    <label for="nvalue" class="font-s-14 text-blue">n</label>
                    <input type="number" step="any" wire:model.live="nvalue" name="nvalue" id="nvalue" min="0" class="input" aria-label="input" @click="$wire.set('detail', null)"/>
                </div>
                <div class="space-y-2 @if($to_calculate === 'f') hidden @endif" id="mInput">
                    <label for="mvalue" class="font-s-14 text-blue">m</label>
                    <input type="number" step="any" wire:model.live="mvalue" name="mvalue" id="mvalue" min="0" class="input" aria-label="input" @click="$wire.set('detail', null)"/>
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
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                
                <div class="w-full radius-10 mt-3">
                    <div class="w-full">
                        @if($to_calculate =='f' && $detail['fa']!='INF')
                            <div class="w-full mt-2">
                                <table class="w-full md:w-[30%] lg:w-[30%] font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['8']}} {{ $nvalue }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['fa']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 font-s-16 mt-2">
                                <p><strong>{{$lang['9']}}</strong></p>
                                <p class="mt-2">{{$lang['10']}}:</p>
                                <p class="mt-2">n = {{ $nvalue }}</p>
                                <p class="mt-2">n ! = {{$detail['a']}}</p>
                                <p class="mt-2">n ! = {{$detail['fa']}}</p>
                            </div>
                        @elseif($to_calculate =='af' && $detail['add']!='INF')
                            <div class="w-full mt-2">
                                <table class="w-full md:w-[30%] lg:w-[30%] font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>n!</strong></td>
                                        <td class="py-2 border-b">{{$detail['fa']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>m!</strong></td>
                                        <td class="py-2 border-b">{{$detail['fam']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>n! + m!</strong></td>
                                        <td class="py-2 border-b">{{$detail['add']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 font-s-16 mt-2">
                                <p><strong>{{$lang['9']}}:</strong></p>
                                <p class="mt-2">{{$lang['10']}}:</p>
                                <p class="mt-2">n = {{ $nvalue }}</p>
                                <p class="mt-2">m = {{ $mvalue }}</p>
                                <p class="mt-2">n ! = {{$detail['a']}}</p>
                                <p class="mt-2">n ! = {{$detail['fa']}}</p>
                                <p class="mt-2">m ! = {{$detail['b']}}</p>
                                <p class="mt-2">m ! = {{$detail['fam']}}</p>
                                <p class="mt-2">n ! + m ! = {{$detail['fa']}} + {{$detail['fam']}}</p>
                                <p class="mt-2">n ! + m ! = {{$detail['add']}}</p>
                            </div>
                        @elseif($to_calculate =='sf' && $detail['sub']!='INF')
                            <div class="w-full mt-2">
                                <table class="w-full md:w-[30%] lg:w-[30%] font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>n!</strong></td>
                                        <td class="py-2 border-b">{{$detail['fa']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>m!</strong></td>
                                        <td class="py-2 border-b">{{$detail['fam']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>n! - m!</strong></td>
                                        <td class="py-2 border-b">{{$detail['sub']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 font-s-16 mt-2">
                                <p><strong>{{$lang['9']}}:</strong></p>
                                <p class="mt-2">{{$lang['10']}}:</p>
                                <p class="mt-2">n = {{ $nvalue }}</p>
                                <p class="mt-2">m = {{ $mvalue }}</p>
                                <p class="mt-2">n ! = {{$detail['a']}}</p>
                                <p class="mt-2">n ! = {{$detail['fa']}}</p>
                                <p class="mt-2">m ! = {{$detail['b']}}</p>
                                <p class="mt-2">m ! = {{$detail['fam']}}</p>
                                <p class="mt-2">n !- m ! = {{$detail['fa']}}- {{$detail['fam']}}</p>
                                <p class="mt-2">n ! - m ! = {{$detail['sub']}}</p>
                            </div>
                        @elseif($to_calculate =='mf' && $detail['mul']!='INF')
                            <div class="w-full mt-2">
                                <table class="w-full md:w-[30%] lg:w-[30%] font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>n!</strong></td>
                                        <td class="py-2 border-b">{{$detail['fa']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>m!</strong></td>
                                        <td class="py-2 border-b">{{$detail['fam']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>n! x m!</strong></td>
                                        <td class="py-2 border-b">{{$detail['mul']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 font-s-16 mt-2">
                                <p><strong>{{$lang['9']}}:</strong></p>
                                <p class="mt-2">{{$lang['10']}}:</p>
                                <p class="mt-2">n = {{ $nvalue }}</p>
                                <p class="mt-2">m = {{ $mvalue }}</p>
                                <p class="mt-2">n ! = {{$detail['a']}}</p>
                                <p class="mt-2">n ! = {{$detail['fa']}}</p>
                                <p class="mt-2">m ! = {{$detail['b']}}</p>
                                <p class="mt-2">m ! = {{$detail['fam']}}</p>
                                <p class="mt-2">n ! x m ! = {{$detail['fa']}} x {{$detail['fam']}}</p>
                                <p class="mt-2">n ! x m ! = {{$detail['mul']}}</p>
                            </div>
                        @else
                            <div class="w-full mt-2">
                                <table class="w-full md:w-[30%] lg:w-[30%] font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>n!</strong></td>
                                        <td class="py-2 border-b">{{$detail['fa']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>m!</strong></td>
                                        <td class="py-2 border-b">{{$detail['fam']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>n! / m!</strong></td>
                                        <td class="py-2 border-b">{{$detail['div']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 font-s-16 mt-2">
                                <p><strong>{{$lang['9']}}:</strong></p>
                                <p class="mt-2">{{$lang['10']}}:</p>
                                <p class="mt-2"> n = {{ $nvalue }}</p>
                                <p class="mt-2"> m = {{ $mvalue }}</p>
                                <p class="mt-2"> n ! = {{$detail['a']}}</p>
                                <p class="mt-2"> n ! = {{$detail['fa']}}</p>
                                <p class="mt-2"> m ! = {{$detail['b']}}</p>
                                <p class="mt-2"> m ! = {{$detail['fam']}}</p>
                                <p class="mt-2">n ! / m ! = {{$detail['fa']}} / {{$detail['fam']}}</p>
                                <p class="mt-2">n ! / m ! = {{$detail['div']}}</p>
                            </div>
                        @endif
                    </div>
                </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
</div>
