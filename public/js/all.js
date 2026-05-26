function toggleCatDropdown() {
    const dd = document.getElementById('cat-dropdown');
    const chevron = document.getElementById('cat-chevron');
    if (dd && chevron) {
        dd.classList.toggle('hidden');
        chevron.classList.toggle('rotate-180');
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function (e) {
    const wrap = document.getElementById('cat-dropdown-wrap');
    if (wrap && !wrap.contains(e.target)) {
        document.getElementById('cat-dropdown').classList.add('hidden');
        document.getElementById('cat-chevron').classList.remove('rotate-180');
    }
});

// Blog Share Modal Logic
document.addEventListener('DOMContentLoaded', function () {
    const openShareBtn = document.getElementById('openShareBtn');
    const closeShareBtn = document.getElementById('closeShareBtn');
    const shareModalOverlay = document.getElementById('shareModalOverlay');
    const copyShareLinkBtn = document.getElementById('copyShareLinkBtn');
    const shareUrlInput = document.getElementById('shareUrlInput');
    const copyToast = document.getElementById('copyToast');

    if (openShareBtn && shareModalOverlay) {
        openShareBtn.addEventListener('click', function () {
            shareModalOverlay.classList.remove('hidden');
        });
    }

    if (closeShareBtn && shareModalOverlay) {
        closeShareBtn.addEventListener('click', function () {
            shareModalOverlay.classList.add('hidden');
        });
    }

    if (shareModalOverlay) {
        shareModalOverlay.addEventListener('click', function (e) {
            if (e.target === shareModalOverlay) {
                shareModalOverlay.classList.add('hidden');
            }
        });
    }

    if (copyShareLinkBtn && shareUrlInput && copyToast) {
        copyShareLinkBtn.addEventListener('click', function () {
            navigator.clipboard.writeText(shareUrlInput.value).then(function () {
                copyToast.classList.remove('hidden');
                setTimeout(function () {
                    copyToast.classList.add('hidden');
                }, 2500);
            });
        });
    }
});

function shareSocial(platform) {
    const url = encodeURIComponent(window.location.href);
    let shareUrl = '';

    if (platform === 'facebook') {
        shareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + url;
    } else if (platform === 'twitter') {
        shareUrl = 'https://twitter.com/intent/tweet?url=' + url;
    } else if (platform === 'linkedin') {
        shareUrl = 'https://www.linkedin.com/sharing/share-offsite/?url=' + url;
    } else if (platform === 'email') {
        shareUrl = 'mailto:?subject=Check this blog&body=' + url;
    }

    if (shareUrl !== '') {
        window.open(shareUrl, '_blank', 'noopener,noreferrer');
    }
}

// Calculator Result Actions Logic
$(document).ready(function () {
    // CSRF setup for AJAX
    if ($('meta[name="csrf-token"]').length > 0) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    // Feedback Submission like and unlike
    $(document).on('click', '.feedback-btn', function (e) {
        e.preventDefault();
        var type = $(this).attr('data-type');
        var calculatorName = $(this).attr('data-calculator-name');
        var calculatorLink = $(this).attr('data-calculator-link');

        // If the link is empty or points to a livewire update, grab it from the browser URL directly
        if (!calculatorLink || calculatorLink === '' || calculatorLink === 'livewire/update') {
            calculatorLink = window.location.pathname.replace(/^\/|\/$/g, '');
        }

        $('#feedback-initial-state').addClass('hidden');
        $('#feedback-loading-state').removeClass('hidden');

        $.ajax({
            url: '/save-calculator-feedback',
            type: 'POST',
            data: {
                type: type,
                calculator_name: calculatorName,
                calculator_link: calculatorLink
            },
            success: function (response) {
                $('#feedback-loading-state').addClass('hidden');
                $('#feedback-success-state').removeClass('hidden');
            },
            error: function () {
                $('#feedback-loading-state').addClass('hidden');
                $('#feedback-initial-state').removeClass('hidden');
                alert('Something went wrong. Please try again.');
            }
        });
    });

    // Result Share Modal
    $(document).on('click', '#openResultShareBtn', function (e) {
        e.preventDefault();

        // Dynamically get the current browser URL (avoids livewire/update issue)
        var currentUrl = window.location.href;
        var encodedUrl = encodeURIComponent(currentUrl);
        var calculatorName = $('.feedback-btn').first().attr('data-calculator-name') || document.title;
        var encodedTitle = encodeURIComponent('Check out the ' + calculatorName);

        // Update the copy input field
        $('#resultShareUrlInput').val(currentUrl);

        // Update social media links
        $('#resultShareModalContent a.bg-blue-600').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + encodedUrl);
        $('#resultShareModalContent a.bg-blue-400').attr('href', 'https://twitter.com/intent/tweet?url=' + encodedUrl + '&text=' + encodedTitle);
        $('#resultShareModalContent a.bg-blue-500').attr('href', 'https://www.linkedin.com/sharing/share-offsite/?url=' + encodedUrl);
        $('#resultShareModalContent a.bg-green-500').attr('href', 'mailto:?subject=' + encodedTitle + '&body=' + encodedUrl);

        $('#resultShareModalOverlay').removeClass('hidden');
    });

    $(document).on('click', '#closeResultShareBtn', function (e) {
        e.preventDefault();
        $('#resultShareModalOverlay').addClass('hidden');
    });

    $(document).on('click', '#resultShareModalOverlay', function (e) {
        if (e.target.id === 'resultShareModalOverlay') {
            $(this).addClass('hidden');
        }
    });

    $(document).on('click', '#copyResultShareLinkBtn', function (e) {
        e.preventDefault();
        var copyText = document.getElementById("resultShareUrlInput");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);

        $('#resultCopyToast').removeClass('hidden');
        setTimeout(function () {
            $('#resultCopyToast').addClass('hidden');
        }, 2500);
    });

    // Feedback Modal (Report/Comment Button)
    $(document).on('click', '.open-feedback-btn', function (e) {
        e.preventDefault();
        $('#default-modalfeed').removeClass('hidden');
    });

    $(document).on('click', '[data-modal-hide="default-modalfeed"]', function (e) {
        e.preventDefault();
        $('#default-modalfeed').addClass('hidden');
    });

    $(document).on('click', '#default-modalfeed', function (e) {
        if (e.target.id === 'default-modalfeed') {
            $(this).addClass('hidden');
        }
    });

    // Automatically show/hide feedback actions based on result visibility
    function toggleFeedbackActions() {
        if ($('.result').length > 0 && $('.result').is(':visible')) {
            $('#global-feedback-actions').show();
        } else {
            $('#global-feedback-actions').hide();
        }
    }

    // Run on page load
    setTimeout(toggleFeedbackActions, 100);

    // Watch for Livewire DOM updates
    var formBorder = document.querySelector('.form-border');
    if (formBorder) {
        var observer = new MutationObserver(function() {
            toggleFeedbackActions();
        });
        observer.observe(formBorder, { childList: true, subtree: true, attributes: true, attributeFilter: ['class', 'style'] });
    }
});
