<style>
    
    /* //venn Diagram 2 set */
    div.venn {
      /* width: 32em; */
      /* margin: 20px 0px 0px 120px; */
      /* margin: auto; */
      position: relative;
      height: 18em;
      /* background: whitesmoke; */
    }
  
    div.venn .circle {
      border: .2em solid #333;
      border-radius: 50%;
      width: 20em;
      height: 20em;
      text-align: center;
      position: absolute;
    }
  
    div.venn .circle p {
      height: 15em;
      width: 10em;
      display: table-cell;
      vertical-align: middle;
      /* margin-top: 10%; */
    }
  
    div.venn .circle:nth-child(1) {
      top: 0;
      left: 0;
      background-color: rgba(4248, 158, 79, 0.25);
      height: 78%;
      width: 45%;
      text-align: -webkit-center;
    }
  
    div.venn .circle:nth-child(2) {
      top: 0;
      left: 11em;
      background-color: rgba(98, 192, 203, 0.25);
      height: 78%;
      width: 45%;
  
    }
  
    div.venn .circle:nth-child(2) p {
      position: relative;
      right: -3em;
    }
  
    div.venn .joined {
      position: absolute;
      top: 6em;
      left: 10em;
      width: 8em;
    }
  
    div.venn .joined p {
      height: 10em;
      text-align: center;
      vertical-align: middle;
      display: table-cell;
      width: 4em;
    }
  
    div#res2 {
    position: absolute;
    bottom: 25px;
    right:73px
    }
    div.a10 {
    position: relative;
    top:25px;
    right: 0px;
    }
    div.aonly {
    position: absolute;
    bottom:55px;
    left: 45%;
    }
    div.b20 {
    position: relative;
    top:25px;
    right: 0px;
    }
    div.bonly {
    position: absolute;
    bottom:55px;
    left: 45%;
    }
    #Infographic {
      position: relative;
      width: 25em;
      margin: .5em auto;
      font-family: Arial, Helvetica, sans-serif;
      font-weight: bold;
      /* background-color: #fff; */
      height: 20em;
      margin: auto;
      margin-top:90px;
    }
    div.a_only {
    position: absolute;
    top: 55px;
    right: 80px;
    }
    div.b_only {
    position: absolute;
    top: 55px;
    right: 80px;
    }
    div.c_only {
    position: absolute;
    top: 90px;
    right: 80px;
    }
    div#j12 {
    position: absolute;
    top: -5px;
    left: 60px;
    }
    div#j70 {
    position: absolute;
    top: 85px;
    left: -37px
    }
    div#j60 {
    position: absolute;
    top: 85px;
    right:-30px
    }
    div#j80 {
    position: absolute;
    top: 10px;
    right:73px
    }
    div#j13 {
    position: absolute;
    top: -6px;
    left:-20px
    }
    div#j23 {
    position: absolute;
    top: -7px;
    left:70px
    }
    div.a21 {
    position: absolute;
    top: -55px;
    /* left:70px */
    left:160px
    }
    div.o2 {
    position: absolute;
    top: -10px;
    /* left:20px */
    left:235px
    }
    div.b22 {
    position: absolute;
    top: -55px;
    /* left:70px */
    right:140px
    }
    div.c13 {
    position: absolute;
    bottom: -60px;
    right: 75px;
    }
    div.d10 {
    position: absolute;
    bottom: -60px;
    right: -30px;
    }
  
  
    #Infographic span {
      display: none;
    }
  
    .circle {
      border: .2em solid #000;
      border-radius: 50%;
      width: 10em;
      height: 10em;
      text-align: center;
      vertical-align: center;
      position: absolute;
    }
    .circle p {
      height: 25em;
      width: 15em;
      display: table-cell;
      vertical-align: middle;
    }
  
    #c1 {
      top: 0;
      left: 90px;
      background-color: rgba(255, 0, 0, .25);
    }
  
    #c2 {
      top: 0;
      left: 12em;
      background-color: rgba(0, 255, 0, .25);
    }
  
    #c2 p {
      padding-left: 10em;
    }
  
    #c3 {
      top: 5em;
      left: 8.5em;
      background-color: rgba(0, 0, 255, .25);
    }
  
    #c3 p {
      width: 25em;
      height: 15em;
      padding-top: 10em;
    }
  
    .joined {
      position: absolute;
      display: table-cell;
      vertical-align: middle;
      text-align: center;
    }
  
    #j12 {
      top: 5em;
      left: 15em;
      width: 10em;
      height: 7em;
      padding-top: 3em;
    }
  
    #j13 {
      top: 17em;
      left: 10em;
      width: 7em;
      height: 5em;
      padding-top: 2.5em;
    }
  
    #j23 {
      top: 17em;
      left: 23em;
      width: 7em;
      height: 5em;
      padding-top: 2.5em;
    }
  
    #all {
      top: 15em;
      left: 15em;
      width: 10em;
      height: 5em;
      padding-top: 1em;
    }
    @media (max-width: 375px) {
      div.venn{
          height: 65%;
          margin: 10px 0px;
      }
      #Infographic {
      width: 15em;
      margin: 90px 0px 0px -70px;
      }
      /* .circle {
        width: 9em;
        height: 9em;
      } */
    }
    @media (max-width: 320px) {
      div.venn{
          margin: 10px 0px;
      }
      #Infographic {
      width: 15em;
      margin: 90px 0px 0px -105px;
      }
      /* .circle {
        width: 9em;
        height: 9em;
      } */
    }
    @media (max-width: 375px) {
      .uclass{
          margin: 0px !important;
      }
      div.venn{
          margin: 10px 0px;
      }
      div.venn .joined {
          position: absolute;
          top: 2.5em;
          left: 4em;
          width: 20vw;
      }
      div#res2 {
      position: absolute;
      bottom: 90px;
      right: 130px;
      }
      div.b20 {
      position: relative;
      top: 5px;
      left: 11px;
      }
        div.aonly {
        position: absolute;
        bottom: 10px;
        left: 27%;
      }
      div.bonly {
        position: absolute;
        bottom: 10px;
        left: 45%;
      }
      div.venn .circle:nth-child(2) {
        top: 0;
        left: 25vw;
        height: 7em;
        width: 30vw;
      }
  
      div.venn .circle:nth-child(1) {
        position: relative;
        height: 7em;
        width: 30vw;
        left: 5vw;
      }
      div#res2 {
        position: absolute;
        bottom: -10px;
        right: 15px;
      }
     
  }
   
  @media (max-width: 330px) {
      div.venn{
          margin: 10px 0px;
      }
      div.venn .joined {
        position: absolute;
        top: 2.5em;
        left: 4em;
        width: 20vw;
      }
      div.b20 {
      position: relative;
      top: 5px;
      left: 11px;
    }
      div.aonly {
      position: absolute;
      bottom: 10px;
      left: 27%;
    }
    div.bonly {
      position: absolute;
      bottom: 10px;
      left: 45%;
    }
    div.venn .circle:nth-child(2) {
      top: 0;
      left: 25vw;
      height: 7em;
      width: 35vw;
    }
  
    div.venn .circle:nth-child(1) {
      position: relative;
      height: 7em;
      width: 35vw;
      left: 5vw;
    }
    @media (max-width: 480px) {
      div.venn{
          margin: 10px 0px;
      }
      #Infographic {
      width: 15em;
      margin: 90px 0px 0px -30px;
      }
      div.b22 {
      position: absolute;
        top: -55px;
        /* left:70px */
        right:-40px
      }
    }
     
  }
</style>
  <form class="row position-relative" action="{{ url()->current() }}/" method="POST">
      @csrf
      @if(!isset($detail))


      <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="col-12 col-lg-9 mx-auto mt-2  w-full">
          <input type="hidden" name="selection" id="calculator_time" value="{{ isset(request()->selection) ? request()->selection : 'twoset' }}">
          <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 pacetabs">
              <div class="lg:w-1/2 w-full px-2 py-1">
                  <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  pacetab {{ isset(request()->selection) && request()->selection !== 'twoset'  ? '' :'tagsUnit' }}" id="two_set" onclick="change_tab(tab_val='f_tab')">
                          {{ $lang['1'] }}
                  </div>
              </div>
              <div class="lg:w-1/2 w-full px-2 py-1">
                  <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white pacetab {{ isset(request()->selection) && request()->selection === 'threeset'  ? 'tagsUnit' :'' }}" id="three_set" onclick="change_tab(tab_val='s_tab')">
                          {{ $lang['2'] }}
                  </div>
              </div>
          </div>
      </div>
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">

            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                  <div class="col-span-12 mt-3 toset {{ isset(request()->selection) && request()->selection === 'threeset'  ? 'hidden' :'row' }}">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                      <div class="col-span-12">
                          <label for="venn_name" class="font-s-14 text-blue"><?= $lang[3] ?>:</label>
                          <div class="w-100 py-2">
                              <input type="text" step="any" name="venn_name" id="venn_name" class="input" aria-label="input" value="{{ isset($_POST['venn_name'])?$_POST['venn_name']:'Venn diagram 2 Set' }}" />
                          </div>
                      </div>
                      <div class="col-span-12 md:col-span-6 lg:col-span-6">
                          <label for="A" class="font-s-14 text-blue"><?= $lang[4] ?>:</label>
                          <div class="w-100 py-2">
                              <input type="text" step="any" name="ta" id="A" class="input" aria-label="input" value="{{ isset($_POST['ta'])?$_POST['ta']:'A' }}" />
                          </div>
                      </div>
                      <div class="col-span-12 md:col-span-6 lg:col-span-6">
                          <label for="B" class="font-s-14 text-blue" >{{ $lang['5'] }}:</label>
                          <div class="w-100 py-2">
                              <input type="text" step="any" name="tb" id="B" class="input" aria-label="input"  value="{{ isset($_POST['tb'])?$_POST['tb']: 'B' }}" />
                          </div>
                      </div>
                      <div class="col-span-12 md:col-span-6 lg:col-span-6">
                          <label for="a" class="font-s-14 text-blue" >{{ $lang['6'] }}:</label>
                          <div class="w-100 py-2">
                              <input type="number" step="any" name="a" id="a" class="input" aria-label="input"  value="{{ isset($_POST['a'])?$_POST['a']: '10' }}" />
                          </div>
                      </div>
                      <div class="col-span-12 md:col-span-6 lg:col-span-6">
                          <label for="b" class="font-s-14 text-blue" >{{ $lang['7'] }}:</label>
                          <div class="w-100 py-2">
                              <input type="number" step="any" name="b" id="b" class="input" aria-label="input"  value="{{ isset($_POST['b'])?$_POST['b']: '20' }}" />
                          </div>
                      </div>
                      <div class="col-span-12 md:col-span-6 lg:col-span-6">
                          <label for="u" class="font-s-14 text-blue" >{{ $lang['8'] }}:</label>
                          <div class="w-100 py-2">
                              <input type="number" step="any" name="u" id="u" class="input" aria-label="input"  value="{{ isset($_POST['u'])?$_POST['u']: '30' }}" />
                          </div>
                      </div>
                      <div class="col-span-12 md:col-span-6 lg:col-span-6">
                          <label for="c" class="font-s-14 text-blue" >{{ $lang['9'] }}:</label>
                          <div class="w-100 py-2">
                              <input type="number" step="any" name="c" id="c" class="input" aria-label="input"  value="{{ isset($_POST['c'])?$_POST['c']: '40' }}" />
                          </div>
                      </div>
                    </div>
                  </div>
  
                  <div class="col-span-12 threeset mt-3 {{ isset(request()->selection) && request()->selection === 'threeset'  ? 'row' :'hidden' }}">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                      <div class="col-span-12">
                          <label for="venn_name3" class="font-s-14 text-blue"><?= $lang[3] ?>:</label>
                          <div class="w-100 py-2">
                              <input type="text" step="any" name="venn_name3" id="venn_name3" class="input" aria-label="input" value="{{ isset($_POST['venn_name3'])?$_POST['venn_name3']:'Venn diagram 3 Set' }}" />
                          </div>
                      </div>
                      <div class="col-span-12 md:col-span-4 lg:col-span-4">
                          <label for="ta3" class="font-s-14 text-blue"><?= $lang[4] ?>:</label>
                          <div class="w-100 py-2">
                              <input type="text" step="any" name="ta3" id="ta3" class="input" aria-label="input" value="{{ isset($_POST['ta3'])?$_POST['ta3']:'A' }}" />
                          </div>
                      </div>
                      <div class="col-span-12 md:col-span-4 lg:col-span-4">
                          <label for="tb3" class="font-s-14 text-blue" >{{ $lang['5'] }}:</label>
                          <div class="w-100 py-2">
                              <input type="text" step="any" name="tb3" id="tb3" class="input" aria-label="input"  value="{{ isset($_POST['tb3'])?$_POST['tb3']: 'B' }}" />
                          </div>
                      </div>
                      <div class="col-span-12 md:col-span-4 lg:col-span-4">
                          <label for="tc3" class="font-s-14 text-blue" >{{ $lang['6'] }}:</label>
                          <div class="w-100 py-2">
                              <input type="text" name="tc3" id="tc3" class="input" aria-label="input"  value="{{ isset($_POST['tc3'])?$_POST['tc3']: 'C' }}" />
                          </div>
                      </div>
                      <div class="col-span-12 md:col-span-4 lg:col-span-4">
                          <label for="a3" class="font-s-14 text-blue" >{{ $lang['6'] }}:</label>
                          <div class="w-100 py-2">
                              <input type="number" step="any" name="a3" id="a3" class="input" aria-label="input"  value="{{ isset($_POST['a3'])?$_POST['a3']: '10' }}" />
                          </div>
                      </div>
                      <div class="col-span-12 md:col-span-4 lg:col-span-4">
                          <label for="b3" class="font-s-14 text-blue" >{{ $lang['7'] }}:</label>
                          <div class="w-100 py-2">
                              <input type="number" step="any" name="b3" id="b3" class="input" aria-label="input"  value="{{ isset($_POST['b3'])?$_POST['b3']: '20' }}" />
                          </div>
                      </div>
                      <div class="col-span-12 md:col-span-4 lg:col-span-4">
                          <label for="cc3" class="font-s-14 text-blue" >{{ $lang['9'] }}:</label>
                          <div class="w-100 py-2">
                              <input type="number" step="any" name="c3" id="cc3" class="input" aria-label="input"  value="{{ isset($_POST['c3'])?$_POST['c3']: '30' }}" />
                          </div>
                      </div>
                      <div class="col-span-12">
                          <label for="u3" class="font-s-14 text-blue" >{{ $lang['8'] }}:</label>
                          <div class="w-100 py-2">
                              <input type="number" step="any" name="u3" id="u3" class="input" aria-label="input"  value="{{ isset($_POST['u3'])?$_POST['u3']: '40' }}" />
                          </div>
                      </div>
  
                      <div class="col-span-12 md:col-span-4 lg:col-span-4">
                          <label for="anb3" class="font-s-14 text-blue"><?= $lang[9] ?>:</label>
                          <div class="w-100 py-2">
                              <input type="number" step="any" name="anb3" id="anb3" class="input" aria-label="input" value="{{ isset($_POST['anb3'])?$_POST['anb3']:'50' }}" />
                          </div>
                      </div>
                      <div class="col-span-12 md:col-span-4 lg:col-span-4">
                          <label for="bnc3" class="font-s-14 text-blue" >{{ $lang['12'] }}:</label>
                          <div class="w-100 py-2">
                              <input type="number" step="any" name="bnc3" id="bnc3" class="input" aria-label="input"  value="{{ isset($_POST['bnc3'])?$_POST['bnc3']: '60' }}" />
                          </div>
                      </div>
                      <div class="col-span-12 md:col-span-4 lg:col-span-4">
                          <label for="cna3" class="font-s-14 text-blue" >{{ $lang['13'] }}:</label>
                          <div class="w-100 py-2">
                              <input type="number" name="cna3" id="cna3" class="input" aria-label="input"  value="{{ isset($_POST['cna3'])?$_POST['cna3']: '70' }}" />
                          </div>
                      </div>
  
                      <div class="col-span-12">
                          <label for="anbnc" class="font-s-14 text-blue" >{{ $lang['14'] }}:</label>
                          <div class="w-100 py-2">
                              <input type="number" step="any" name="anbnc" id="anbnc" class="input" aria-label="input"  value="{{ isset($_POST['anbnc'])?$_POST['anbnc']: '80' }}" />
                          </div>
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
   
      @else
      
      <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                  <div class="w-full mt-3 overflow-auto">
                      <div class="w-full">
                          <?php if (isset($detail['venn_name'])) { ?>
                              <p class="text-accent-4 text-center"><?= $lang[15] ?></p>
                              <span class="uclass" style="margin-left:120px">U = <?= $detail['u'] ?></span>
                              <div class="venn text-center overflow-auto">
                                <div class="circle">
                                    <div class="a10"><?= $detail['ta']; ?><br /><?= $detail['a']; ?></div>
                                    <div class="aonly"><?= $detail['a'] - $detail['c']; ?></div>
                                </div>
                                <div class="circle">
                                  <div class="b20"><?= $detail['tb']; ?><br /><?= $detail['b']; ?></div>
                                  <div class="bonly"><?= $detail['b'] - $detail['c']; ?></div>
                                </div>
                                <div id="res2">D = <?= $detail['res2set'] ?></div>
                                <div class="joined">
                                  <?= $detail['c']; ?>
                                </div>
                              </div>
                              <p class="text-accent-4  font_s25 " style="margin-bottom:10px"><?= $lang[17] ?>:</p>
                              <p class="text-accent-4  font_size18" style="margin-bottom:10px"><strong> <?= $detail['ta']; ?> <?= $lang[18] ?>:</strong></p>
                              <p class=" text-accent-4 "><?= $detail['ta']; ?> <?= $lang[18] ?> = <?= $detail['ta']; ?> - <?= $detail['ta']; ?>∩<?= $detail['tb']; ?> </p>
                              <p class=" text-accent-4 "><?= $detail['ta']; ?> <?= $lang[18] ?> = <?= $detail['a'] ?> - <?= $detail['c'] ?> </p>
                              <p class=" text-accent-4 " style="margin-bottom:10px"><?= $detail['ta']; ?> <?= $lang[18] ?> = <?= $detail['a'] - $detail['c']; ?></p>
                              <p class="text-accent-4  font_size18" style="margin-bottom:10px"><strong > <?= $detail['tb']; ?> <?= $lang[18] ?>:</strong></p>
                              <p class=" text-accent-4 "><?= $detail['tb']; ?> <?= $lang[18] ?>  = <?= $detail['tb']; ?> - <?= $detail['ta']; ?>∩<?= $detail['tb']; ?> </p>
                              <p class=" text-accent-4 "><?= $detail['tb']; ?> <?= $lang[18] ?>  = <?= $detail['b'] ?> - <?= $detail['c'] ?> </p>
                              <p class=" text-accent-4 " style="margin-bottom:10px"><?= $detail['tb']; ?> <?= $lang[18] ?>  = <?= $detail['b'] - $detail['c']; ?></p>
                              <p class="text-accent-4  font_size18" style="margin-bottom:10px"><strong> D (<?= $lang[19] ?>):</strong></p>
                              <p class=" text-accent-4 ">D = U - <?= $detail['ta']; ?> <?= $lang[18] ?> + <?= $detail['tb']; ?> <?= $lang[18] ?> + (<?= $detail['ta']; ?>∩<?= $detail['tb']; ?>)</p>
                              <p class=" text-accent-4 ">D = <?= $detail['u'] ?> -  {(<?= $detail['a'] - $detail['c']; ?>) + (<?= $detail['b'] - $detail['c']; ?>) + <?= $detail['c'] ?> }</p>
                              <p class=" text-accent-4 ">D = <?= $detail['u'] ?> -  (<?= $detail['res'] ?> )</p>
                              <p class=" text-accent-4 ">D = <?= $detail['res2set'] ?></p>                  
                          <?php } ?>
                          <?php if (isset($detail['venn_name3'])) { ?>
                              <p class="text-center"><?= $lang[15] ?></p><br>
                              <div id="Infographic">
                                <div class="a21"><?= $detail['ta3'] ?> <br><?= $detail['a3'] ?></div>
                                <div class="o2"><?= $detail['anb3'] ?></div>
                                <div class="b22"><?= $detail['tb3'] ?> <br><?= $detail['b3'] ?></div>
                                <div id="c1" class="circle">
                                  <div class="a_only"><?= $detail['a_only'] ?></div>
                                  <div id="j12"><?= $detail['ab'] ?></div>
                                </div>
                                <div id="c2" class="circle">
                                  <div class="b_only"><?= $detail['b_only'] ?></div>
                                </div>
                                <div id="c3" class="circle">
                                  <div id="j13" class="joined"><?= $detail['ca'] ?></div>
                                  <div class="c_only"><?= $detail['c_only'] ?></div>
                                  <div id="j23" class="joined"><?= $detail['bc'] ?></div>
                                  <div id="j70"><?= $detail['cna3'] ?></div>
                                  <div id="j60"><?= $detail['bnc3'] ?></div>
                                  <div class="c13"><?= $detail['tc3'] ?><br><?= $detail['c3'] ?></div>
                                  <div class="d10">D=<?= $detail['d'] ?></div>
                                  <div id="j80"><?= $detail['anbnc'] ?></div>
                                </div>
                            </div>
                           
                            <p class="color_blue text-accent-4  font_s25 " style="margin-bottom:10px"><?= $lang[17] ?>:</p>
                            <p class=" text-accent-4 " style="margin-bottom:10px"><strong>x = <?= $detail['ta3']; ?>∩<?= $detail['tb3'] ?>∩<?= $detail['tc3'] ?></strong></p>
                            <p class="text-accent-4  font_size18" style="margin-bottom:10px"><strong > <?= $detail['ta3'] ?> <?= $lang[18] ?>:</strong></p>
                            <p class=" text-accent-4 "><?= $detail['ta3'] ?> <?= $lang[18] ?> = <?= $detail['ta3'] ?> - ( ab + x + ca ) </p>
                            <p class=" text-accent-4 "><?= $detail['ta3'] ?> <?= $lang[18] ?> = <?= $detail['a3'] ?> - (<?= $detail['ab'] ?> +  <?= $detail['anbnc'] ?> +  (<?= $detail['ca'] ?>))</p>
                            <p class=" text-accent-4 "style="margin-bottom:10px"><?= $detail['ta3'] ?> <?= $lang[18] ?> =  <?= $detail['a_only'] ?></p>
                            <p class="text-accent-4  font_size18" style="margin-bottom:10px"><strong> <?= $detail['tb3'] ?> <?= $lang[18] ?>:</strong></p>
                            <p class=" text-accent-4 "><?= $detail['tb3'] ?> <?= $lang[18] ?> = <?= $detail['tb3'] ?> - ( bc + x + ab ) </p>
                            <p class=" text-accent-4 "><?= $detail['tb3'] ?> <?= $lang[18] ?> = <?= $detail['b3'] ?> - (<?= $detail['bc'] ?> + <?= $detail['anbnc'] ?> + (<?= $detail['ab'] ?>)) </p>
                            <p class=" text-accent-4 "style="margin-bottom:10px"><?= $detail['tb3'] ?> <?= $lang[18] ?> = <?= $detail['b_only'] ?></p>
                            <p class="text-accent-4  font_size18" style="margin-bottom:10px"><strong> <?= $detail['tc3'] ?> <?= $lang[18] ?>:</strong></p>
                            <p class=" text-accent-4 "><?= $detail['tc3'] ?> <?= $lang[18] ?> = <?= $detail['tc3'] ?> - ( bc + x + ca ) </p>
                            <p class=" text-accent-4 "><?= $detail['tc3'] ?> <?= $lang[18] ?> = <?= $detail['c3'] ?> -  (<?= $detail['bc'] ?> +  <?=$detail['anbnc']?> + (<?=$detail['ca']?>)) </p>
                            <p class=" text-accent-4 "style="margin-bottom:10px"><?= $detail['tc3'] ?> <?= $lang[18] ?> = <?= $detail['c_only'] ?></p>
                            <p class="text-accent-4  font_size18" style="margin-bottom:10px"><strong> <?= $detail['ta3'] ?><?= $detail['tb3'] ?>:</strong></p>
                            <p class=" text-accent-4 "><?= $detail['ta3'] ?><?= $detail['tb3'] ?> = (<?= $detail['ta3'] ?>∩<?= $detail['tb3'] ?>) - x </p>
                            <p class=" text-accent-4 "><?= $detail['ta3'] ?><?= $detail['tb3'] ?> =  <?= $detail['anb3'] ?> -  <?= $detail['anbnc'] ?></p>
                            <p class=" text-accent-4 "style="margin-bottom:10px"><?= $detail['ta3'] ?><?= $detail['tb3'] ?> =   <?= $detail['ab'] ?></p>
                            <p class="text-accent-4  font_size18" style="margin-bottom:10px"><strong> <?= $detail['tb3'] ?><?= $detail['tc3'] ?>:</strong></p>
                            <p class=" text-accent-4 "><?= $detail['tb3'] ?><?= $detail['tc3'] ?> = (<?= $detail['tb3'] ?>∩<?= $detail['tc3'] ?>) - x </p>
                            <p class=" text-accent-4 "><?= $detail['tb3'] ?><?= $detail['tc3'] ?> = <?= $detail['bnc3'] ?> -  <?= $detail['anbnc'] ?> </p>
                            <p class=" text-accent-4 "style="margin-bottom:10px"><?= $detail['tb3'] ?><?= $detail['tc3'] ?> = <?= $detail['bc'] ?></p>
                            <p class="text-accent-4  font_size18" style="margin-bottom:10px"><strong> <?= $detail['tc3'] ?><?= $detail['ta3'] ?>:</strong></p>
                            <p class=" text-accent-4 "><?= $detail['tc3'] ?><?= $detail['ta3'] ?> = (<?= $detail['tc3'] ?>∩<?= $detail['ta3'] ?>) - x </p>
                            <p class=" text-accent-4 "><?= $detail['tc3'] ?><?= $detail['ta3'] ?> = <?= $detail['cna3'] ?> -  <?= $detail['anbnc'] ?> </p>
                            <p class=" text-accent-4 "style="margin-bottom:10px"><?= $detail['tc3'] ?><?= $detail['ta3'] ?> = <?= $detail['ca'] ?></p>
                            <p class="text-accent-4  font_size18" style="margin-bottom:10px"><strong> D (<?= $lang[19] ?>):</strong></p>
                            <p class=" text-accent-4 ">D = U - (<?= $detail['ta3'] ?> <?= $lang[18] ?> + <?= $detail['tb3'] ?> <?= $lang[18] ?> + <?= $detail['tc3'] ?> <?= $lang[18] ?> + <?= $detail['ta3'] ?><?= $detail['tb3'] ?> + <?= $detail['tb3'] ?><?= $detail['tc3'] ?> + <?= $detail['tc3'] ?><?= $detail['ta3'] ?> + x) </p>
                            <p class=" text-accent-4 ">D = <?= $detail['u3'] ?> -  {(<?= $detail['a_only']?>) + (<?=$detail['b_only'] ?>) + (<?=$detail['c_only'] ?>) + (<?=$detail['ab'] ?>) + (<?=$detail['bc'] ?>) + (<?=$detail['ca'] ?>) + (<?=$detail['anbnc'] ?>)} </p>
                            <p class=" text-accent-4 ">D = <?= $detail['u3'] ?> -  (<?= $detail['res']?>) </p>
                            <p class=" text-accent-4 ">D = <?=$detail['d'] ?></p>  
                          <?php } ?>
                      </div>
                      <div class="col-12 text-center my-[25px]">
                        <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                          @if (app()->getLocale() == 'en')
                              RESET
                          @else
                              {{ $lang['reset'] ?? 'RESET' }}
                          @endif
                      </a>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    
      @endif
  </form>
  @push('calculatorJS')
     <script>
      function change_tab(element) {
          if (element === "f_tab") {
              document.getElementById("two_set").classList.add('tagsUnit');
              document.getElementById("three_set").classList.remove('tagsUnit');
              document.querySelectorAll('.toset').forEach(function(el) {
                  el.classList.add('row');
                  el.classList.remove('hidden');
              });
              document.querySelectorAll('.threeset').forEach(function(el) {
                  el.classList.remove('row');
                  el.classList.add('hidden');
              });
              document.querySelector('[name="selection"]').value = "twoset";
          } else if (element === "s_tab") {
              document.getElementById("three_set").classList.add('tagsUnit');
              document.getElementById("two_set").classList.remove('tagsUnit');
              document.querySelectorAll('.threeset').forEach(function(el) {
                  
                  el.classList.add('row');
                  el.classList.remove('hidden');
              });
              document.querySelectorAll('.toset').forEach(function(el) {
                  el.classList.remove('row');
                  el.classList.add('hidden');
              });
              document.querySelector('[name="selection"]').value = "threeset";
          }
      }
     </script>
  @endpush