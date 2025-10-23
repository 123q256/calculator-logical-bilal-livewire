<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php $request = request();@endphp
            <div class="col-span-12">
                <label for="expression" class="label"><?=$lang['1']?> :  ( <i><?=$lang['3']?> + - * / ^ r . ( ) [ ] { } )</i>:</label>
                <div class="w-100 py-2">
                    <input type="text" name="expression" id="expression" class="input" aria-label="input" value="{{ isset($request->expression) ? $request->expression : '(10+5^2)((5*-2)+9-3^3)/2' }}" />
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
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full font-s-16">
                                <style>
                                    .hitman{
                                        display:block;
                                    }
                                    .dk{
                                        margin-bottom:40px;
                                    }
                                    .pp{
                                        padding-left:18px;
                                    }
                                </style>
                                <p class="mt-2 text-[18px" d="final_ans"></strong></p>
                                <p class="mt-2"><strong>Solution</strong></p>
                                <p class="mt-2"><?=$lang['5']?>:</p>
                                <p class="mt-2"><?=$detail['expression'];?></p>
                                <p class="mt-2"><?=$lang['6']?></p>
                                <div class="col-12" id="stepsAndSolution">
                                    <p class="mt-2" id="solution"></p>
                                </div>
                                {{-- <table class="w-100 font-s-16">
                                    <tbody>
                                        <tr id="stepsAndSolution">
                                            <td><?=$lang['6']?></td></tr>
                                            <tr id="solution">
                                                <td>
                                                    <table class="table col s12 margin_zero">
                                                        <tbody>
                                                            <tr>
                                                                <td></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                    </tbody>
                                </table> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        @isset($detail)
            <script>
                  class Token {
                    constructor(str, stIndex, enIndex) {
                        this.str = str;
                        this.stIndex = stIndex;
                        this.enIndex = enIndex;
                    }
                    set value(newValue) {
                        this.str = newValue;
                    }
                    set startIndex(stIndex) {
                        this.stIndex = stIndex;
                    }
                    set endIndex(enIndex) {
                        this.enIndex = enIndex;
                    }
                    get value() {
                        return this.str;
                    }
                    get startIndex() {
                        return this.stIndex;
                    }
                    get endIndex() {
                        return this.enIndex;
                    }
                }
                var method='<?php echo $detail['method']; ?>';
                var stepNumber = 1;
                var problemInput='<?php echo $detail['expression']; ?>';
                solve(problemInput);
                function allClear(clearInput) {
                    document.getElementById("stepsAndSolution").style.display = "none";
                    document.getElementById("solution").style.display = "none";
                    if (document.getElementById("solutionField"))
                        document.getElementById("solutionField").innerHTML = '';
                    else {
                        let newTable = document.createElement('table');
                        let newBody = document.createElement('tbody');
                        newBody.id = 'solutionField';
                        newTable.insertAdjacentElement('afterbegin', newBody);
                        document.getElementById('solution').insertAdjacentElement('afterbegin', newTable);
                    }
                    stepNumber = 1;
                    if (clearInput) document.getElementById("expression").value = "";
                    this.document.querySelector('input').dispatchEvent(new Event('input'));
                }

                function backspace(input) {
                    if (input.length > 0)
                        document.getElementById('expression').value = input.substring(0, input.length - 1);
                }

                function basicButtonPress(clickedId) {
                    var input = document.getElementById("expression").value;
                    document.getElementById("expression").value = input + clickedId;
                }

                function advancedButtonPress(clickedId) {
                    var input = document.getElementById("expression").value;
                    var tokens = tokenize(input);
                    if (clickedId == 'Ê¸âˆš') {
                        var rootToken = tokens[tokens.length - 1];
                        if (rootToken && !(/^\d+$/).test(rootToken.value) && (/\d/).test(input)) {
                            document.getElementById("solutionField").innerHTML = '';
                            displayInvalidInput('The indexes of square roots can only be whole numbers for this calculator. Try (radicand)^(1/y) instead.');
                        } else if (rootToken && (/^\d+$/).test(rootToken.value)) {
                            clickedId = scriptInvert(rootToken.value) + 'âˆš';
                            input = input.substring(0, tokens[tokens.length - 1].startIndex);
                        }
                    }
                    if (clickedId == 'xÂ²')
                        clickedId = '^2';
                    if (clickedId == 'xÊ¸')
                        clickedId = '^';
                    document.getElementById("expression").value = input + clickedId;
                }
                function solve(input) {
                    allClear(false);
                    input = input.replace(/\s+/g, '');
                    if (!(/\d/).test(input) && input != '') {
                    var e= displayInvalidInput('Input must contain numbers')
                    }
                    if (input === "") {
                        allClear(true);
                        return;
                    }
                    document.getElementById("stepsAndSolution").style.display = "";
                    document.getElementById("solution").style.display = "";
                    stepNumber = 1;
                    displaySolution(calculate(input));
                }
                function calculate(input) {
                    input = parentheses(input);
                    input = exponents(input);
                    input = multiplication(input);
                    input = addition(input);
                    return input;
                }
                function parentheses(input) {
                    var tokens = tokenize(input);
                    if (isOperator(tokens[tokens.length - 1].value))
                        displayInvalidInput('<span class="red-text left-align font_size18">Operators must be followed by a number</span>', input.substring(0, tokens[tokens.length - 1].startIndex), input.substring(tokens[tokens.length - 1].startIndex))
                    while (tokens.filter(token => token.value == '(' || token.value == ')').length > 0) {
                        var insideParentheses = '';
                        var openParenthesisIndex = -1;
                        var openParenthesisTokenIndex = -1;
                        var closedParenthesisIndex = -1;
                        var closedParenthesisTokenIndex = -1;
                        for (let y = 0; y < tokens.length && closedParenthesisIndex == -1; y++)
                            if (tokens[y].value == ')') {
                                closedParenthesisIndex = tokens[y].endIndex;
                                closedParenthesisTokenIndex = y;
                            }
                        for (let x = 0; x < tokens.length && openParenthesisIndex == -1; x++)
                            if (tokens[x].value == '(' && (tokens[x].startIndex > closedParenthesisIndex && closedParenthesisIndex != -1)) break;
                            else if (tokens[x].value == '(') {
                            openParenthesisIndex = tokens[x].startIndex;
                            openParenthesisTokenIndex = x;
                        }
                        if (openParenthesisIndex === -1)
                            displayInvalidInput('<span class="red-text left-align font_size18">Unbalanced Closed Parenthesis</span>', input.substring(0, closedParenthesisIndex), input.charAt(closedParenthesisIndex), input.substring(closedParenthesisIndex + 1));
                        if (closedParenthesisIndex === -1)
                            displayInvalidInput('<span class="red-text left-align font_size18">Unbalanced Open Parenthesis</span>', input.substring(0, openParenthesisIndex), input.charAt(openParenthesisIndex), input.substring(openParenthesisIndex + 1));
                        displayValidInput(input, openParenthesisTokenIndex, closedParenthesisTokenIndex, '');
                        prefix = input.substring(0, openParenthesisIndex + 1);
                        suffix = input.substring(closedParenthesisIndex);
                        insideParentheses = input.substring(openParenthesisIndex + 1, closedParenthesisIndex);
                        insideParentheses = exponents(insideParentheses, prefix, suffix);
                        insideParentheses = multiplication(insideParentheses, prefix, suffix);
                        insideParentheses = addition(insideParentheses, prefix, suffix);
                        input = input.substring(0, openParenthesisIndex + 1) + insideParentheses + input.substring(closedParenthesisIndex);
                        tokens = tokenize(input);
                    }
                    return input;
                }
                function exponents(input, prefix = '', suffix = '') {
                    var tokens = tokenize(input);
                    for (let x = 0; x < tokens.length; x++) {
                        if (input.indexOf('Ê¸') != -1) {
                            displayInvalidInput("To use the 'Ê¸âˆš' button enter the number for the value of 'y' first, then click the 'Ê¸âˆš' button", input.substring(0, input.indexOf('Ê¸')), 'Ê¸', input.substring(input.indexOf('Ê¸') + 1))
                            return;
                        }
                        if (tokens[x].value === 'âˆš' && checkNumbers(x, tokens, input, prefix, suffix)) {
                            displayValidInput(input, x - 1, x + 1, '', prefix, suffix);
                            if (x >= 3 && (!isNaN(tokens[x - 3].value) || input.charAt(tokens[x - 2].endIndex) == ')'))
                                input = `${input.substring(0, tokens[x - 2].endIndex)}(${(Number(tokens[x + 1].value) ** (1 / Number(scriptInvert(tokens[x - 1].value))))})${input.substring(tokens[x + 1].endIndex + 1)}`;
                            else
                                input = input.substring(0, tokens[x - 1].startIndex) + (Number(tokens[x + 1].value) ** (1 / Number(scriptInvert(tokens[x - 1].value)))) + input.substring(tokens[x + 1].endIndex + 1);
                            tokens = tokenize(input);
                            x = -1;
                            continue;
                        } else if (tokens[x].value === '^' && checkNumbers(x, tokens, input, prefix, suffix)) {
                            displayValidInput(input, x - 1, x + 1, '', prefix, suffix);
                            input = input.substring(0, tokens[x - 1].startIndex) + (Number(tokens[x - 1].value) ** Number(tokens[x + 1].value)) + input.substring(tokens[x + 1].endIndex + 1);
                            tokens = tokenize(input);
                            x = -1;
                            continue;
                        }
                    }
                    return input;
                }
                function multiplication(input, prefix = '', suffix = '') {
                    var tokens = tokenize(input);
                    if (input.indexOf('%') != input.length && !isNaN(input.charAt(input.indexOf('%') + 1)))
                        for (let y = 0; y < tokens.length - 2; y++)
                            if (tokens[y].value == '/' && tokens[y].startIndex == input.indexOf('%'))
                                displayInvalidInput('<span class="red-text left-align font_size18">Not an Operator</span>', input.substring(0, tokens[y + 2].startIndex), tokens[y + 2].value, input.substring(tokens[y + 2].endIndex + 1));
                    for (let x = 0; x < tokens.length; x++) {
                        if (tokens[x].value == '*' && checkNumbers(x, tokens, input, prefix, suffix)) {
                            displayValidInput(input, x - 1, x + 1, '', prefix, suffix);
                            input = input.substring(0, tokens[x - 1].startIndex) + (Number(tokens[x - 1].value) * Number(tokens[x + 1].value)) + input.substring(tokens[x + 1].endIndex + 1);
                            tokens = tokenize(input);
                            x = -1;
                            continue;
                        } else if (tokens[x].value == '/' && checkNumbers(x, tokens, input, prefix, suffix)) {
                            displayValidInput(input, x - 1, x + 1, '', prefix, suffix);
                            input = input.substring(0, tokens[x - 1].startIndex) + (Number(tokens[x - 1].value) / Number(tokens[x + 1].value)) + input.substring(tokens[x + 1].endIndex + 1);
                            tokens = tokenize(input);
                            x = -1;
                            continue;
                        }
                    }
                    return input;
                }
                function addition(input, prefix = '', suffix = '') {
                    var tokens = tokenize(input);
                    for (let x = 0; x < tokens.length; x++) {
                        if (tokens[x].value == '+' && checkNumbers(x, tokens, input, prefix, suffix)) {
                            displayValidInput(input, x - 1, x + 1, '', prefix, suffix);
                            input = input.substring(0, tokens[x - 1].startIndex) + (Number(tokens[x - 1].value) + Number(tokens[x + 1].value)) + input.substring(tokens[x + 1].endIndex + 1);
                            tokens = tokenize(input);
                            x = -1;
                            continue;
                        } else if (tokens[x].value == '-' && checkNumbers(x, tokens, input, prefix, suffix)) {
                            displayValidInput(input, x - 1, x + 1, '', prefix, suffix);
                            input = input.substring(0, tokens[x - 1].startIndex) + (Number(tokens[x - 1].value) - Number(tokens[x + 1].value)) + input.substring(tokens[x + 1].endIndex + 1);
                            tokens = tokenize(input);
                            x = -1;
                            continue;
                        }
                    }
                    return tokens.length == 1 ? tokens[0].value : input;
                }

                function checkNumbers(opIndex, tokens, input, prefix = '', suffix = '') {
                    var num1 = tokens[opIndex - 1].value;
                    var num2 = tokens[opIndex + 1].value;
                    if (isSuperScript(num1)) num1 = scriptInvert(num1);
                    if (isSuperScript(num2)) num2 = scriptInvert(num2);
                    var number1 = Number(num1);
                    var number2 = Number(num2);
                    if (opIndex < tokens.length - 3 && isSuperScript(tokens[opIndex + 1].value))
                        displayInvalidInput('<span class="red-text left-align font_size18">To raise a number to a root wrap the root in parentheses</span>', input.substring(0, tokens[opIndex + 1].startIndex), input.substring(tokens[opIndex + 1].startIndex, tokens[opIndex + 3].endIndex + 1), input.substring(tokens[opIndex + 3].endIndex + 1));
                    if (isNaN(number1))
                        displayInvalidInput('<span class="red-text left-align font_size18">Not a Number</span>', prefix + input.substring(0, tokens[opIndex - 1].startIndex), tokens[opIndex - 1].value, input.substring(tokens[opIndex - 1].endIndex + 1) + suffix);
                    if (isNaN(number2))
                        displayInvalidInput('<span <span class="red-text left-align font_size18">>Not a Number</span>', prefix + input.substring(0, tokens[opIndex + 1].startIndex), tokens[opIndex + 1].value, input.substring(tokens[opIndex + 1].endIndex + 1) + suffix);
                    return !isNaN(number1) && !isNaN(number2);
                }

                function tokenize(input) {
                    var tokens = [];
                    for (let x = 0; x < input.length; x++) {
                        let char = input.charAt(x);
                        if ((isOperator(char) || (char == '(' || char == ')')) && !isNegativeSign(char, x === 0 ? '' : input.charAt(x - 1), x === input.length - 1 ? '' : input.charAt(x + 1))) {
                            if (char === '%') {
                                tokens.push(new Token('/', x, x));
                                tokens.push(new Token('100', x, x));
                                continue;
                            } else if (char === '(' && x !== 0 && (isNum(input.charAt(x - 1)) || !isNaN(Number(tokens[tokens.length - 1].value)) || input.charAt(x - 1) === ')')) {
                                tokens.push(new Token('*', x, x));
                                tokens.push(new Token(char, x, x));
                                continue;
                            } else if (char === ')' && x !== input.length - 1 && (input.charAt(x + 1) === 'âˆš' || isSuperScript(input.charAt(x + 1)))) {
                                tokens.push(new Token(char, x, x));
                                tokens.push(new Token('*', x + 1, x + 1));
                                continue;
                            } else if (char === 'âˆš' && ((x !== 0 && !isSuperScript(input.charAt(x - 1))) || x === 0)) {
                                if (x !== 0 && isNum(input.charAt(x - 1))) tokens.push(new Token('*', x, x));
                                tokens.push(new Token('Â²', x, x));
                            }
                            tokens.push(new Token(char, x, x));
                            continue;
                        }
                        if (isNum(char) || isNegativeSign(char, x === 0 ? '' : input.charAt(x - 1), x === input.length - 1 ? '' : input.charAt(x + 1))) {
                            let substring = char;
                            let z = x + 1;
                            for (let y = x + 1; y < input.length; z = ++y) {
                                if (isNum(input.charAt(y)) && input.charAt(y) !== '-') {
                                    substring += input.charAt(y);
                                } else {
                                    break;
                                }
                            }
                            tokens.push(new Token(substring, x, z - 1));
                            x = z - 1;
                            continue;
                        }
                        if (isSuperScript(char)) {
                            let substring = char;
                            let z = x + 1;
                            for (let y = x + 1; y < input.length; z = ++y) {
                                if (isSuperScript(input.charAt(y))) {
                                    substring += input.charAt(y);
                                } else {
                                    break;
                                }
                            }
                            if (tokens.length > 0 && isNum(tokens[tokens.length - 1].value))
                                tokens.push(new Token('*', x, z - 1));
                            tokens.push(new Token(substring, x, z - 1));
                            x = z - 1;
                            continue;
                        }
                    }
                    for (let i = 0, j = 1, k = 2; k < tokens.length; i++, j++, k++)
                        if (tokens[i].value == '(' && tokens[k].value == ')')
                            tokens.splice(i, 3, new Token(tokens[j].value, tokens[i].startIndex, tokens[k].endIndex));
                    return tokens;
                }

                function isNegativeSign(minus, charBefore, charAfter) {
                    return minus === '-' && ((isOperator(charBefore) && charBefore !== '%') || charBefore === '(') && isNum(charAfter);
                }

                function isNum(number) {
                    if (number === '-') return false;
                    for (let x = 0; x < number.length; x++) {
                        if ('1234567890.-'.indexOf(number.charAt(x)) === -1) return false;
                    }
                    return true;
                }
                function isOperator(operator) {
                    return '-+*/âˆš^%'.indexOf(operator) !== -1;
                }
                function isSuperScript(superScript) {
                    var isSuperScript = true;
                    for (let x = 0; x < superScript.length; x++) {
                        if ('â°Â¹Â²Â³â´âµâ¶â·â¸â¹'.indexOf(superScript.charAt(x)) == -1)
                            isSuperScript = false;
                    }
                    return isSuperScript && superScript.length > 0;
                }

                function round(number) {
                    if (number instanceof Number)
                        return number.toFixed(5);
                    let strNumber = String(parseFloat(number).toFixed(5));
                    for (let i = strNumber.length - 1; i >= 0; i--) {
                        if (strNumber.charAt(i) === '0') strNumber = strNumber.substring(0, i);
                        else if (strNumber.charAt(i) === '.') {
                            strNumber = strNumber.substring(0, i);
                            break;
                        } else break;
                    }
                    return Number(strNumber);
                }

                function displayValidInput(input, startTokenIndex, endTokenIndex, operation, prefix = '', suffix = '') {
                    let tokens = tokenize(input);
                    tokens.forEach((token, i) => {
                        if (!isNaN(parseFloat(token.value))) {
                            input = input.replace(tokens[i].value, String(round(token.value)));
                        }
                    });
                    tokens = tokenize(input);
                    let startIndex = tokens[startTokenIndex].startIndex;
                    let endIndex = tokens[endTokenIndex].endIndex;
                    document.getElementById("stepsAndSolution").style.display = "";
                    document.getElementById("solution").style.display = "";
                    document.getElementById("solutionField").insertAdjacentHTML("beforeend", `<span class="step mt-3"></span>`);
                    document.getElementById("solutionField").insertAdjacentHTML("beforeend", `<strong><span class="step mt-3"> Step ${stepNumber++}</strong> : </span>`);
                    document.getElementById("solutionField").insertAdjacentHTML("beforeend", `<span class="stepOp">${prefix}${input.substring(0, startIndex)}<span class="text-blue mt-3">` + `${input.substring(startIndex, endIndex + 1)}</span>${input.substring(endIndex + 1)}${suffix}</span>`);
                    document.getElementById("solutionField").insertAdjacentHTML("beforeend", `<span class="stepOp hitman mt-3">${operation}</span>`);
                }
                function displaySolution(input) {
                    document.getElementById("stepsAndSolution").style.display = "";
                    document.getElementById("solution").style.display = "";
                    document.getElementById("solutionField").insertAdjacentHTML("beforeend", `<strong>Answer : <span class="solutionNum text-blue dk">${round(parseFloat(input))}</span></strong>`);
                    document.getElementById("final_ans").innerHTML=round(parseFloat(input)); 
                }
                function displayInvalidInput(errorMessage, prefix = '', errorText = '', suffix = '') {
                    document.getElementById("solution").style.display = "";
                    document.getElementById("solutionField").insertAdjacentHTML("beforeend", `<br><span class="step">Invalid Input: ${errorMessage}</span>`);
                    redText = `<span style="color: red;">${errorText}</span>`;
                    document.getElementById("solutionField").insertAdjacentHTML("beforeend", `<br><span class="stepOp">${prefix}${redText}${suffix}</span>`);
                    document.getElementById("solutionField").insertAdjacentHTML("beforeend", '<br><br>');
                    throw 'Invalid Input';
                }
                function invert(script) {
                    switch (script) {
                        case 'â°':
                            return '0';
                        case 'Â¹':
                            return '1';
                        case 'Â²':
                            return '2';
                        case 'Â³':
                            return '3';
                        case 'â´':
                            return '4';
                        case 'âµ':
                            return '5';
                        case 'â¶':
                            return '6';
                        case 'â·':
                            return '7';
                        case 'â¸':
                            return '8';
                        case 'â¹':
                            return '9';
                        case '0':
                            return 'â°';
                        case '1':
                            return 'Â¹';
                        case '2':
                            return 'Â²';
                        case '3':
                            return 'Â³';
                        case '4':
                            return 'â´';
                        case '5':
                            return 'âµ';
                        case '6':
                            return 'â¶';
                        case '7':
                            return 'â·';
                        case '8':
                            return 'â¸';
                        case '9':
                            return 'â¹';
                    }
                }
                function scriptInvert(script) {
                    var inversion = '';
                    for (let x = 0; x < script.length; x++) {
                        inversion += invert(script.charAt(x));
                    }
                    return inversion;
                }
            </script>
        @endisset
    @endpush
</form>
