
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_des')">
    <link rel="canonical" href="{{ url()->current() }}/" />
    <link href="{{ url('assets/images/logo.png') }}" rel="icon" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}" />
    <link href="{{ url('css/flowbite.min.css')}}?v=0.0.3" rel="stylesheet" />
    <link href="{{ url('css/style1.css')}}?v=0.0.2" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @if (isset($noindex))
    {!! $noindex !!}
    @endif
    @include('layouts/metas')
    <style>
        .active-tags{
            color: #2845F5 !important;
        }
    </style>
    @livewireStyles
</head>
    <body>
        <button id="scrollToTopmove" class="scroll-to-tops hidden  fixed right-6 bottom-[12px]" style="z-index: 999999;">
            <img src="{{ url('assets/images/svgs/top_btn.svg') }}" alt=""></button>

    {{-- header --}}
    @include('includes.modals')
    @include('layouts/header')
    {{-- header --}}
    @section('content')
    @show
    {{-- footer --}}
    @include('layouts/footer')
    {{-- footer --}}

    {{-- excel js --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    {{-- excel js --}}
    {{-- flowbite.min.js tailwing js --}}
    <script src="{{ url('js/flowbite.min.js')}}"></script>
    {{-- <script src="{{ mix('js/app.js') }}"></script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @vite('resources/js/app.js')   --}}
      <!-- Link to Vite-compiled JS -->

    {{-- flowbite.min.js tailwing js --}}
    {{-- Scroll position  --}}
    <script>
        const button = document.getElementById('scrollToTopBtn');
        const SCROLL_THRESHOLD = 300; // Scroll position in pixels
        const FIXED_TOP = 'top-[15px]'; // Top position when fixed
        const FIXED_RIGHT = 'right-[15px]'; // Right position when fixed
        const MOBILE_BREAKPOINT = 768; // Mobile screen max width in pixels
    
        window.addEventListener('scroll', () => {
            // Only apply fixed positioning on larger screens
            if (window.innerWidth > MOBILE_BREAKPOINT) {
                if (window.scrollY > SCROLL_THRESHOLD) {
                    button.classList.add('fixed', FIXED_TOP, FIXED_RIGHT, 'bottom-auto');
                    button.classList.remove('relative');
                } else {
                    button.classList.remove('fixed', FIXED_TOP, FIXED_RIGHT, 'bottom-auto');
                    button.classList.add('relative');
                }
            } else {
                // Ensure mobile screens always have default styles
                button.classList.remove('fixed', FIXED_TOP, FIXED_RIGHT, 'bottom-auto');
                button.classList.add('relative');
            }
        });


            // Scroll top to bottom
            document.addEventListener('DOMContentLoaded', () => {
            const scrollToTopmove = document.getElementById('scrollToTopmove');
            window.addEventListener('scroll', () => {

                if (window.scrollY > 600) {
                    scrollToTopmove.style.display = 'block';
                } else {
                    scrollToTopmove.style.display = 'none';
                }
            });
            scrollToTopmove.addEventListener('click', () => {

                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

        })
        
    </script>
     {{-- Scroll position  --}}
    {{-- for Generate Pdf --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    {{-- for Generate Pdf --}}
    @php
        $autoCommmera = file_get_contents('autoCommmera-all.txt');
        $autoCommmera = json_decode($autoCommmera, true);
        $autoCommmera = json_encode($autoCommmera[app()->getLocale()]);
    @endphp
   <script src="{{ url('js/javascriptCode.js') }}"></script>
   <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    @if (isset($detail))
        {{-- Show Scroll Result  --}}
        <script>
            let scrollTo = document.querySelector('.result');
            if (scrollTo) {
                let scrollAmount = scrollTo.getBoundingClientRect().top + window.pageYOffset - 30;
                window.scrollTo({
                    top: scrollAmount,
                    behavior: 'smooth'
                });
            }
        </script>
        {{-- Show Scroll Result  --}}
        {{-- PDf --}}
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
        <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
        <script src="{{ url('js/html2pdf.bundle.js') }}"></script>
        <script>
            function generatePDF(){
                var resultElementDiv = document.querySelector('.result');
                var HTMLWidthDiv = resultElementDiv.clientWidth;
                var HTMLHeightDiv = resultElementDiv.clientHeight;
                var TopLefMarginDiv = 5;
                var PDFWidthDiv = HTMLWidthDiv+(TopLefMarginDiv*2);
                var PDFHeightDiv = (PDFWidthDiv*1.5)+(TopLefMarginDiv*2);
                var canvasimageWidthDiv = HTMLWidthDiv;
                var canvasimageheight = HTMLHeightDiv;

                var totalPDFPages = Math.ceil(HTMLHeightDiv/PDFHeightDiv)-1;
                html2canvas(resultElementDiv,{allowTaint:true}).then(function(canvas) {
                    canvas.getContext('2d');


                    var imgDatadiv = canvas.toDataURL("image/jpeg", 1.0);
                    var pdfdiv = new jsPDF('p', 'pt',  [PDFWidthDiv, PDFHeightDiv]);
                    pdfdiv.addImage(imgDatadiv, 'JPG', TopLefMarginDiv, TopLefMarginDiv,canvasimageWidthDiv,canvasimageheight);


                    for (var i = 1; i <= totalPDFPages; i++) { 
                        pdfdiv.addPage(PDFWidthDiv, PDFHeightDiv);
                        pdfdiv.addImage(imgDatadiv, 'JPG', TopLefMarginDiv, -(PDFHeightDiv*i)+(TopLefMarginDiv*4),canvasimageWidthDiv,canvasimageheight);
                    }

                    pdfdiv.save("{{ $cal_name }} Result by Technical-calculator.com.pdf");
                });
            };
        </script>
        {{-- PDf --}}
        {{-- share calculator --}}
        <script>
            var shareURL = "{{ $shareURL }}";
            document.getElementById('facebookShare').onclick = function() {
                var url = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(shareURL);
                openShareWindow(url);
            };

            document.getElementById('twitterShare').onclick = function() {
                var url = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(shareURL) + '&text=' + encodeURIComponent('Check this out!');
                openShareWindow(url);
            };

            document.getElementById('linkedinShare').onclick = function() {
                var url = 'https://www.linkedin.com/sharing/share-offsite/?url=' + encodeURIComponent(shareURL);
                openShareWindow(url);
            };
            function openShareWindow(url) {
                var width = 600;
                var height = 400;
                var left = (screen.width / 2) - (width / 2);
                var top = (screen.height / 2) - (height / 2);
                window.open(url, 'Share', 'width=' + width + ', height=' + height + ', top=' + top + ', left=' + left);
            }
        </script> 
        {{-- share calculator --}}
    @endif
        {{-- share widget --}}
        @if (isset($mathjax) && $mathjax==1)
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
            <script defer src="{{ url('katex/katex.min.js') }}"></script>
            <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
        @endif
        <script>
            let currentPage = '{{isset($page) ? $page : request()->getRequestUri()}}';
            let is_calculator = '{{isset($is_calculator) ? $is_calculator : "Calculator"}}';
            @if(isset($mathjax) && $mathjax==1)
                function loadMathJax() {
                    var mathJaxScript = document.createElement('script');
                    mathJaxScript.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML";
                    document.querySelector('head').appendChild(mathJaxScript);
                
                    var mathJaxConfigScript = document.createElement('script');
                    mathJaxConfigScript.type = "text/x-mathjax-config";
                    mathJaxConfigScript.textContent = 'MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}}); function MJrerender() { MathJax.Hub.Queue(["Rerender", MathJax.Hub]); }';
                    document.querySelector('head').appendChild(mathJaxConfigScript);
                }
                
            @endif

            let modal = document.getElementById("myModal");
            if(modal){
                let btn = document.getElementById("myBtn");
                let preview = document.getElementById("widget-preview");
                let span = document.getElementsByClassName("close")[0];
                btn.onclick = function() {
                    modal.style.display = "block";
                    if (preview.innerHTML=='') {
                        let currentPageURI = currentPage;
                        let height = 500;
                        if (is_calculator!='calculator') {
                            height = 300
                        }
                        preview.innerHTML = '<iframe id="calculator-online-iframe" src="{{ url('preview') }}/'+currentPageURI+'/" style="visibility:visible; opacity:1; display:block; border:none;outline:none; margin:0px; padding:0px; width: 100%;height:'+height+'px"></iframe>';
                    }
                }
                span.onclick = function() {
                    modal.style.display = "none";
                }
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            }
        </script>
     {{-- share widget --}}
     @if (isset($detail))
        <script>
        // feedback
        document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('submitFeedback').addEventListener('click', function(event) {
                    event.preventDefault(); 

                    var email = document.getElementById('email').value;
                    var message = document.getElementById('message').value;
                    var name = document.getElementById('name').value;
                    var submitButton = document.getElementById('submitFeedback');
                    var csrfToken = document.querySelector('input[name="_token"]').value;
                    var responseMessage = document.getElementById('response_message');

                    if (!email || !message || !name) {
                        responseMessage.textContent = 'All fields are required.';
                        responseMessage.classList.add('text-danger');
                        responseMessage.classList.remove('green-color');
                        return;
                    }
                    var calc_name_massage = " {{$cal_name}} ";
                    var fullMessage = message + '. This feedback is from, " {{$cal_name}} "';

                    submitButton.disabled = true;
                    submitButton.textContent = 'Sending...';

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '/contact/submit/', true);
                    xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            submitButton.disabled = false;
                            submitButton.textContent = 'Submit';
                            var responseMessage = document.getElementById('response_message');
                            if (xhr.status = 200) {
                                // var response = JSON.parse(xhr.responseText);
                                document.getElementById('email').value = '';
                                document.getElementById('message').value = '';
                                document.getElementById('name').value = '';

                                var feedbackHtml = document.querySelector('.feedbackhtml');
                                feedbackHtml.innerHTML = `
                                    <div id="loadingGif" class="text-center">
                                        <p class="mt-3">
                                            <strong class="text-green-500">Thank You for Your Feedback.</strong>
                                        </p>
                                    </div>`;
                                    // Set a 2-second delay to close the modal
                                    setTimeout(function() {
                                        document.querySelector('[data-modal-hide="default-modalfeed"]').click();
                                    }, 3000);
                                } else {
                                    responseMessage.textContent = 'An error occurred. Please try again later.';
                                    responseMessage.classList.add('text-red-600');
                                    responseMessage.classList.remove('text-green-500');
                                }

                        }
                    };

                    var data = JSON.stringify({
                        email: email,
                        message: fullMessage,
                        calc_name: calc_name_massage,
                        name: name,
                        _token: csrfToken
                    });

                    xhr.send(data);
                });
                });

        </script>
        {{-- excel Generate --}}
        <script>
            document.getElementById('downloadBtn').addEventListener('click', function() {
                // Initialize an empty array to store the data
                let excelData = [];

                // Fetch the main result section
                const resultSection = document.querySelector('.result');

                // Extract header information (if any)
                const headers = resultSection.querySelectorAll('p, th');
                headers.forEach(header => {
                    excelData.push([header.innerText.trim()]);
                });

                // Extract table content (if any)
                const tableRows = resultSection.querySelectorAll('tbody tr');
                tableRows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    let rowData = [];
                    cells.forEach(cell => {
                        rowData.push(cell.innerText.trim());
                    });
                    excelData.push(rowData);
                });

                // Convert the data to a worksheet
                let worksheet = XLSX.utils.aoa_to_sheet(excelData);

                // Create a new workbook and append the worksheet
                let workbook = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(workbook, worksheet, "Result");

                // Generate and download the Excel file
                XLSX.writeFile(workbook, 'result_data.xlsx');
            });
        </script>
       
        {{-- Word File generate --}}
        <script>
            document.getElementById("download").addEventListener("click", function() {
                // Function to download the Word file
                function downloadWordFile(content) {
                    let header = `
                        <html xmlns:o='urn:schemas-microsoft-com:office:office'
                        xmlns:w='urn:schemas-microsoft-com:office:word'
                        xmlns='http://www.w3.org/TR/REC-html40'>
                        <head><meta charset='utf-8'><title>Export HTML to Word</title></head><body>`;
                    let footer = `</body></html>`;

                    // Combine the header, content from the .result section, and footer
                    let fullContent = header + content + footer;

                    // Create a Blob from the content
                    let blob = new Blob(['\ufeff', fullContent], {
                        type: 'application/msword'
                    });

                    // Create a download link and trigger the download
                    let link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = 'result_with_image.doc';
                    link.click();
                }

                // Convert images to base64 and replace them in the HTML content
                function convertImagesToBase64(content, callback) {
                    let imgElements = content.querySelectorAll('img');
                    let totalImages = imgElements.length;
                    let imagesConverted = 0;

                    imgElements.forEach((img) => {
                        let imgSrc = img.src;
                        fetchImageAsBase64(imgSrc, (base64) => {
                            img.src = base64;
                            imagesConverted++;
                            if (imagesConverted === totalImages) {
                                callback(content.innerHTML); // Proceed once all images are converted
                            }
                        });
                    });

                    if (totalImages === 0) {
                        callback(content.innerHTML); // No images, proceed with the content as-is
                    }
                }

                // Helper function to fetch image as base64 data
                function fetchImageAsBase64(url, callback) {
                    let xhr = new XMLHttpRequest();
                    xhr.onload = function () {
                        let reader = new FileReader();
                        reader.onloadend = function () {
                            callback(reader.result); // Base64 string of the image
                        };
                        reader.readAsDataURL(xhr.response);
                    };
                    xhr.open('GET', url);
                    xhr.responseType = 'blob';
                    xhr.send();
                }

                // Get the content of the .result div
                let resultContent = document.querySelector('.result');

                // Convert images to base64 before downloading the Word file
                convertImagesToBase64(resultContent, function(contentWithImages) {
                    // Call the function to download the Word file with the updated content
                    downloadWordFile(contentWithImages);
                });
            });
        </script>
        {{-- text file generate --}}
        <script>
                document.getElementById("textfile").addEventListener("click", function() {
            // Function to download the Text file
            function downloadTextFile(content) {
                    // Create a Blob from the content (text file)
                    let blob = new Blob([content], { type: 'text/plain' });

                    // Create a download link and trigger the download
                    let link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = 'result_content.txt';
                    link.click();
                }

                // Get the content of the .result div and extract only text
                let resultContent = document.querySelector('.result');
                let textContent = resultContent.innerText || resultContent.textContent; // Get plain text

                // Download the plain text content as a text file
                downloadTextFile(textContent);
            });
        </script>
    @endif

    <script>
   function shareBlog(platform) {
            const blogUrl = `https://technical-calculator.com/blog`;
            const blogTitle = "Check out this blog!"; // Add a title for email and WhatsApp sharing
            let shareUrl = '';

            switch (platform) {
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(blogUrl)}`;
                    break;
                case 'linkedin':
                    shareUrl = `https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(blogUrl)}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(blogUrl)}`;
                    break;
                case 'email':
                    shareUrl = `mailto:?subject=${encodeURIComponent(blogTitle)}&body=${encodeURIComponent(blogUrl)}`;
                    break;
                default:
                    console.error("Platform not supported.");
                    return;
            }

            // Open the share URL in a new tab
            window.open(shareUrl, '_blank');
        }


</script>


<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        dropdown.classList.toggle('hidden');
    }
    
    function setUnit(inputId, value) {
        document.getElementById(inputId).value = value;
        document.querySelector(`label[for="${inputId}"]`).textContent = value + ' ▾';
        toggleDropdown(inputId + '_dropdown');
    }
    
    // Close all open dropdowns when clicking outside
    document.addEventListener('click', function (event) {
        // Get all dropdowns
        const dropdowns = document.querySelectorAll('.dropdown');
    
        dropdowns.forEach(dropdown => {
            // If the click is outside the dropdown and the input, close the dropdown
            if (!dropdown.contains(event.target) && !dropdown.previousElementSibling.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
</script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/js/calculator.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
   <script src="{{ url('assets/js/website.js') }}"></script>
    <script src="{{ url('assets/js/add-calculator.js') }}"></script>
@livewireScripts
   @stack('calculatorJS')
</body>
</html>




