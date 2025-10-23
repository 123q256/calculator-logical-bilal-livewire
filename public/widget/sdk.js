var main = document.querySelector('.technical-calculator-widget');
if (main) {
    var url = main.getAttribute('calculator-url');
    var height = main.getAttribute('calculator-height');
    var cal_url = 'http://127.0.0.1:8000/preview/' + url +'/';
    var header = document.querySelector('.technical-calculator-header');
    var footer = document.querySelector('.technical-calculator-footer');
    var link = document.querySelector('.technical-calculator-link');
    if (header && footer && link) {
        main.style.width = '100%';
        header.style.width = '100%';
        footer.style.display = 'flex';
        footer.style.justifyContent = 'end';
        footer.style.padding = '10px';
        var frame = '<iframe id="technical-calculator-iframe" src="' + cal_url + '" style="visibility:visible; opacity:1; display:block; border:none;outline:none; margin:0px; padding:0px; width: 100%;height:' + height + 'px"></iframe>';
        header.innerHTML = frame;
    }
}