function toggleCatDropdown() {
    const dd = document.getElementById('cat-dropdown');
    const chevron = document.getElementById('cat-chevron');
    if (dd && chevron) {
        dd.classList.toggle('hidden');
        chevron.classList.toggle('rotate-180');
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    const wrap = document.getElementById('cat-dropdown-wrap');
    if (wrap && !wrap.contains(e.target)) {
        document.getElementById('cat-dropdown').classList.add('hidden');
        document.getElementById('cat-chevron').classList.remove('rotate-180');
    }
});

// Blog Share Modal Logic
document.addEventListener('DOMContentLoaded', function() {
    const openShareBtn = document.getElementById('openShareBtn');
    const closeShareBtn = document.getElementById('closeShareBtn');
    const shareModalOverlay = document.getElementById('shareModalOverlay');
    const copyShareLinkBtn = document.getElementById('copyShareLinkBtn');
    const shareUrlInput = document.getElementById('shareUrlInput');
    const copyToast = document.getElementById('copyToast');

    if (openShareBtn && shareModalOverlay) {
        openShareBtn.addEventListener('click', function() {
            shareModalOverlay.classList.remove('hidden');
        });
    }

    if (closeShareBtn && shareModalOverlay) {
        closeShareBtn.addEventListener('click', function() {
            shareModalOverlay.classList.add('hidden');
        });
    }

    if (shareModalOverlay) {
        shareModalOverlay.addEventListener('click', function(e) {
            if (e.target === shareModalOverlay) {
                shareModalOverlay.classList.add('hidden');
            }
        });
    }

    if (copyShareLinkBtn && shareUrlInput && copyToast) {
        copyShareLinkBtn.addEventListener('click', function() {
            navigator.clipboard.writeText(shareUrlInput.value).then(function() {
                copyToast.classList.remove('hidden');
                setTimeout(function() {
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
