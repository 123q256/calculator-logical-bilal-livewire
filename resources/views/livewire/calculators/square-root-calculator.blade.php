 <div>
<style>
    .inp-set1{
    width:120px;
    float:left;
    position:absolute;
    left:-140px;
    bottom:14px
	}
	.sqr{
    font-size:3em;
    position:absolute;
    left:-22px;
    bottom:0px
  }
	.inp-set2{
    width:58%;
    border-top:2px solid #000;
    padding:5px 0px 0px 5px;
    margin-top:18px;
		float:right;
    position:relative
  }
  .inp-set{
  	width:100% !important
  }
  .t-set{
  	margin-top:15px
  } 

</style>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">

           <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[80%] w-full">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  @if($selection === '1') tagsUnit @endif pacetab" wire:click="$set('selection', '1'); $wire.set('detail', null)">
                            {{ $lang['1'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white pacetab @if($selection === '2') tagsUnit @endif" wire:click="$set('selection', '2'); $wire.set('detail', null)">
                            {{ $lang['2'] }}
                    </div>
                </div>
            </div>
        </div>

            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 inp_wrap mt-2 @if($selection !== '1') hidden @endif" id="sr">
                    <div class="col-12">
                        <div class="inp-set2 inp-set ">
                            <span class="sqr">√</span>
                            <input type="text" wire:model.live="n" name="n" class="input" @click="$wire.set('detail', null)">
                        </div>
                    </div>
                </div>
                <div class="col-span-12 inp_wrap1 @if($selection !== '2') hidden @endif mt-2" id="gr">
                    <div class="col-12">
                        <div class="inp-set2">
                            <div class="inp-set1 pt-3 pe-2">
                                <input type="text" wire:model.live="rt" name="rt" class="input" @click="$wire.set('detail', null)">
                            </div>
                            <span class="sqr">√</span>
                            <input type="text" wire:model.live="n1" name="n1" class="input inp-2" @click="$wire.set('detail', null)">
                        </div>
                    </div>
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
    {{-- result --}}
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full text-center text-[18px]">
                        <div class="text-center">
                            <p class="text-[20px]"><strong> @if($detail['check']=='sr') {{$lang['1']}} of {{ $n }} @else {{$lang['2']}} of {{ $n1 }} @endif</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"  id="res">
                                    <strong class="text-white">{{round($detail['result'], 4)}}{{isset($detail['iota']) ? 'i' : ''}}</strong>
                                </p>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <p class="text-[20px] ">{{$lang['3']}}</p>
                            @if($detail['check']=='sr')
                                @if(isset($detail['factor']))
                                    <p class="mt-2">
                                        √{{ $n }} = {{$detail['sqr_show']}}√{{$detail['product']}}{{isset($detail['iota']) ? 'i' : ''}}
                                    </p>
                                @else
                                    <p class="mt-2">
                                        √{{ $n }} = √{{round($detail['result'], 4)}}<sup>2</sup> {{isset($detail['iota']) ? 'i' : ''}}
                                    </p>
                                @endif
                            @elseif($detail['check']=='gr') 
                                <p class="mt-2">
                                    <sup>{{$detail['root']}}</sup>√{{ $n1 }} = ({{round($detail['result'], 4)}})<sup>{{$detail['root']}}</sup> {{isset($detail['iota']) ? 'i' : ''}}
                                </p>
                            @endif
                            <p class="mt-2">
                                <strong> = <span class="res">{{round($detail['result'], 4)}}{{isset($detail['iota']) ? 'i' : ''}}</span></strong>
                            </p>
                            @if($detail['check']=='sr')
                                <p class="mt-2">
                                    <strong>{{ (isset($detail['result']) && ($detail['result'] - floor($detail['result'])) == 0) ? abs($n).' is a perfect square' : abs($n).' is not a perfect square' }}</strong>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
</div>
