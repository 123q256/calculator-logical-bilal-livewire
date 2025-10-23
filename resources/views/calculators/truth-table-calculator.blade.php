<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">

        <div class="col-12  mx-auto mt-2 lg:w-[50%] w-full">
            <div class="flex flex-wrap items-center bg-blue-100 border  border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/1 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2  cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  tagsUnit wed" id="load_example">
                            {{ $lang['2'] }}
                    </div>
                </div>
            </div>
        </div>
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                
                    <div class="col-span-12">
                        <div class="w-full py-1">
                            <label for="eq" class="font-s-14 text-white" id="txt"><?=$lang[1]?>:</label>
                            <input type="text" step="any" name="eq" id="eq" class="input" aria-label="input" value="{{ isset($_POST['eq'])?$_POST['eq']:'(p & q) -> ~r' }}" />
                        </div>
                    </div>
                    <div class="col-span-12">
                        <table class="w-full inp_table border radius-5">
                            <tbody>
                            <tr>
                                <td colspan="2" class="border-b text-white py-2 text-center {{isset($detail) ? 'bg-light-blue' : 'tagsUnit'}}"><strong class="text-blue"><?=$lang['3']?></strong></td>
                            </tr>
                            <tr>
                                <td class="border-b p-2"><?=$lang['4']?></td>
                                <td class="border-b p-2">~</td>
                            </tr>
                            <tr>
                                <td class="border-b p-2"><?=$lang['5']?></td>
                                <td class="border-b p-2">&amp;</td>
                            </tr>
                            <tr>
                                <td class="border-b p-2"><?=$lang['6']?></td>
                                <td class="border-b p-2">v</td>
                            </tr>
                            <tr>
                                <td class="border-b p-2"><?=$lang['7']?></td>
                                <td class="border-b p-2">-&gt;</td>
                            </tr>
                            <tr>
                                <td class="border-b p-2"><?=$lang['8']?></td>
                                <td class="border-b p-2">&lt;-&gt;</td>
                            </tr>
                            <tr>
                                <td class="border-b p-2"><?=$lang['9']?></td>
                                <td class="border-b p-2">|</td>
                            </tr>
                            <tr>
                                <td class="border-b p-2"><?=$lang['10']?></td>
                                <td class="border-b p-2">#</td>
                            </tr>
                            </tbody>
                        </table>
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
                <div class="rounded-lg  flex items-center justify-center ">
                    <div class="w-full  my-[25px]">
                        <div class="row my-2 text-[18px]">
                            <p class="text-center font-s-20"><strong><?=$lang['11']?></strong></p>
                            <div class="text-[18px] text-center" id="t_table"></div>
                        </div>
                        <div class="w-full text-center mt-[50px]">
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

        
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        @if(isset($detail))
        make_table();
        $('#t_table table').addClass('striped');
        function char_set(c){
            switch(c){
            case true : return 'T';
            case false : return 'F';
            case '~' : return '~';
            case '&' : return '&amp;';
            case 'v' : return '&or;';
            case '->' : return '&rarr;';
            case '<->' : return '&harr;';
            case '|' : return '|';
            case '#' : return '&perp;'
            default : return c;
            } 
        }
        function make_table(){
            var eq = "<?=$detail['eq']?>".replace(/ /g,'');
            if(eq=='') {$('#error_show').text("You have to enter an Expression.");};
            var r = badchar(eq);
            if(r>=0) {$('#error_show').text("This "+eq[r]+" symbol is unrecognized!");};
            eq = eq.split(',');
            var trees = eq.map(parse_val);
            for(var i=0;i<trees.length;i++){
            if(trees[i].length==0){
                eq[i] = '('+eq[i]+')';
                trees[i] = parse_val(eq[i]);
            }
            }
            if(trees.filter(function(a) {return a.length==0;}).length>0){
            $('#error_show').text("The string is not well formed");
            }
            if($('#error_show').text()!=''){
            $('.res_head').hide();
            }
            var table = make_tab(eq,trees);
            var truth_table = truthtable(table,trees);
            document.getElementById('t_table').innerHTML = truth_table;
        }
        function truthtable(table,trees,flag){
            var rownum = table[0].length;
            var res_ = [];
            for(var i=0;i<trees.length;i++){
            res_.push(res_index(trees[i]))
            }
            var out = '<table class="w-full truth">';
            out += th(table);
            for(var i=1;i<table[0].length;i++){
            out += td(table,i);
            }
            return out+'</table>';
            function th(tbl){
            var rw = '<tr>';
            for(var i=0;i<tbl.length;i++){
                for(var j=0;j<tbl[i][0].length;j++){
                if(j==tbl[i][0].length-1 && i!=tbl.length-1){
                    rw += '<th  class="border-b py-2 div">'+char_set(tbl[i][0][j])+'</th>'+'<th class="border-b py-2 div"></th><th></th>';
                }else{
                    rw += '<th  class="border-b py-2 div">'+char_set(tbl[i][0][j])+'</th>';
                }
                }
            }
            return rw+'</tr>';
            }
            function td(tbl,r) {
            var rw = '<tr>';
            for(var i=0;i<tbl.length;i++){
                for(var j=0;j<tbl[i][r].length;j++){
                if(res_[i-1]==j){
                    rw += '<td class="border-b py-2 res">'+char_set(tbl[i][r][j])+'</td>';
                }else if(flag && i>0){
                    rw += '<td class="border-b py-2"></td>'
                }else{
                    rw += '<td class="border-b py-2">'+char_set(tbl[i][r][j])+'</td>';
                }
                if(j==tbl[i][r].length-1 && i!=tbl.length-1){
                    rw += '<td class="border-b py-2 div"></td><td></td>'
                }
                }
            }
            return rw+'</tr>';
            }
        }
        function res_index(t){
            if(t.length == 2 || t.length==1){
            return 0;
            } else {
            return nl(t[1])+1;
            }
        }
        function nl(t){
            var out = 0;
            for(var i=0;i<t.length;i++){
            if(t[i] instanceof Array){
                out += nl(t[i]);
            } else {out += 1;}
            }
            return out;
        }
        function make_tab(fs,ts){
            var lhs = mk_lhs(fs);
            var rhs = [];
            for(var i=0;i<fs.length;i++){
            rhs.push(t_seg(fs[i],ts[i],lhs));
            }
            return [lhs].concat(rhs);
        }
        function mk_lhs(fs){
            var atm = [];
            var tvrows = [];
            for(var i=0;i<fs.length;i++){
            atm = atm.concat(get_atm(fs[i]))
            }
            atm = asorted(rem_dup(atm));
            if(atm.indexOf('#')>=0){
            tvrows = tv_comb(atm.length-1);
            tvrows = tvrows.map(function(x) {return [false].concat(x);});
            } else {tvrows = tv_comb(atm.length);}
            return [atm].concat(tvrows);
        }
        function t_seg(f,t,mk_lhs){
            var tbl_rows=[];
            for(var i=1;i<mk_lhs.length;i++){
            var a = assign(mk_lhs[0],mk_lhs[i]);
            var row = eval_tree(t,a);
            row = d1(row);
            tbl_rows.push(row);
            }
            tbl_rows = [d1(t)].concat(tbl_rows);
            return tbl_rows;
        }
        function get_atm(s){
            var out = [];
            for(var i=0;i<s.length;i++){
            if(is_atm(s[i])) {out.push(s[i]);}
            }
            return out;
        }
        function tv_comb(n){
            if(n==0) {return [[]];}
            var prev = tv_comb(n-1);
            var mt = function(x) {return [true].concat(x);};
            var mf = function(x) {return [false].concat(x);};
            return prev.map(mt).concat(prev.map(mf));
        }
        function assign(s,b){
            var a = new Object();
            for(var i=0;i<s.length;i++){
            a[s[i]] = b[i];
            }
            return a;
        }
        function d1(t){
            if(t.length==5){
            return [].concat(t[0]).concat(d1(t[1])).concat(t[2]).concat(d1(t[3])).concat(t[4]);
            }else if(t.length==2){
            return [].concat(t[0]).concat(d1(t[1]));
            }else if(t.length==1){
            return [].concat(t[0]);
            }
        }
        function eval_tree(t,a){
            if(t.length==5) {
            var t1 = eval_tree(t[1],a);
            var t3 = eval_tree(t[3],a);
            return ['',t1,get_tvs([t[2],t1,t3]),t3,'']
            } else if(t.length==2) {
            var t1 = eval_tree(t[1],a);
            return [get_tvs([t[0],t1]),t1];
            } else if(t.length==1) {
            return [a[t[0]]];
            }
        }
        function get_tvs(arr){
            switch(arr[0]){
            case '~' : return !tvs(arr[1]);
            case '&' : return tvs(arr[1])&&tvs(arr[2]);
            case 'v' : return tvs(arr[1])||tvs(arr[2]);
            case '->' : return (!tvs(arr[1])||tvs(arr[2]));
            case '<->' : return (tvs(arr[1])==tvs(arr[2]));
            case '|' : return (!(tvs(arr[1])&&tvs(arr[2])));
            }
            function tvs(x){
            switch(x.length){
                case 5 : return x[2];
                case 2 : return x[0];
                case 1 : return x[0];
            }
            }
        }
        function rem_dup(a){
            return a.filter(function(el,pos){return a.indexOf(el)==pos;});
        }
        function asorted(a){
            var b = a.map(function(x){return x.charCodeAt(0);});
            b = b.sort(function(b,c){return b-c;});
            return b.map(function(x){return String.fromCharCode(x);});
        }
        function parse_val(s){
            if(s.length==0){return [];}
            var s1 = [];
            var s2 = [];
            if(is_unary(s[0])){
            s1 = parse_val(s.substring(1));
            return s1.length ? [s[0],s1] : [];
            }
            if(s[0] =='(' && s[s.length-1]==')'){
            var a = g_sub(s);
            if(a.indexOf(undefined)>=0 || a.indexOf('')>=0){
                return [];
            } else {
                s1 = parse_val(a[0]);
                s2 = parse_val(a[2]);
                if(s1.length && s2.length){
                return ['(',s1,a[1],s2,')'];
                } else {return [];}
            }
            }
            else {return is_atm(s) ? [s] : []}
        }
        function is_atm(s){
            if(s.length!=1){return false;}
            var pr = '#ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuwxyz';
            return pr.indexOf(s)>=0;
        }
        function is_unary(s){
            return s.indexOf('~')==0;
        }
        function g_sub(s){
            var stk = [];
            var l = 0;
            for(var i=0;i<s.length;i++){
            if(s[i]=='(') {
                stk.push('(');
            }else if(s[i]==')' && stk.length>0){
                stk.pop();
            }else if(stk.length==1 && (l = isB(s.substring(i)))>0) {
                return [s.substring(1,i),s.substring(i,i+l),s.substring(i+l,s.length-1)];
            } 
            }
            return [undefined,undefined,undefined];
        }
        function isB(s){
            var bc = ['&','v','->','<->','|'];
            for(var i=0;i<bc.length;i++){
            if(s.indexOf(bc[i]) == 0){
                return bc[i].length;
            }
            }
            return 0;
        }
        function badchar(s){
            var x = ',()~v&<>-|#ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuwxyz';
            for(var i=0;i<s.length;i++){
            if(x.indexOf(s[i])<0){
                return i;
            }
            }
            return -1;
        }
        @endif
    </script>
    @endif
</form>

<script>
   document.getElementById('load_example').addEventListener('click' , function(){
    var eq = ["~A",
        "(A & B)",
        "(# -> (B v ~A))",
        "A<->(BvC), A, (~B->C)",
        "(p & q) -> ~r",
        "(p | q) -> ~r",
        "(p & q) -> (~r | s)"
    ],
    t = eq[Math.floor(Math.random() * eq.length)];
        document.getElementById("eq").value = t;
    });
</script>