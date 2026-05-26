/**
 * modal-search.js - jQuery-based modal calculator search
 * Replaces the Livewire search.search-two component
 */

$(function () {
    var $input       = $('#modal-search-input');
    var $dropdown    = $('#modal-search-dropdown');
    var $list        = $('#modal-search-list');
    var currentFocus = -1;
    var filteredData = [];

    function highlightMatch(text, query) {
        if (!query) return $('<span>').text(text).html();
        var escaped = query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        var re      = new RegExp('(' + escaped + ')', 'gi');
        return $('<span>').text(text).html().replace(re, '<strong class="text-blue-600">$1</strong>');
    }

    function renderSuggestions(query) {
        currentFocus = -1;
        $list.empty();

        if (!query || query.trim() === '') {
            hideDrop();
            return;
        }

        var q = query.toLowerCase().trim();

        if (typeof searchCalculators === 'undefined') {
            return; // Safety check if data is not loaded
        }

        filteredData = searchCalculators.filter(function (calc) {
            var name = calc[0].toLowerCase();
            return name.indexOf(q) === 0 || name.indexOf(' ' + q) !== -1;
        });

        // Sort: starts-with first, then word-boundary matches
        filteredData.sort(function (a, b) {
            var an = a[0].toLowerCase();
            var bn = b[0].toLowerCase();
            var as = an.indexOf(q) === 0 ? 2 : (an.indexOf(' ' + q) !== -1 ? 1 : 0);
            var bs = bn.indexOf(q) === 0 ? 2 : (bn.indexOf(' ' + q) !== -1 ? 1 : 0);
            return bs - as;
        });

        if (filteredData.length === 0) {
            $list.append(
                $('<li>').addClass('py-3 px-4 text-gray-500 italic text-sm')
                         .text('No results found for "' + query + '"')
            );
            showDrop();
            return;
        }

        $.each(filteredData, function (index, calc) {
            var $li = $('<li>')
                .addClass('flex justify-between items-center hover:bg-gray-50 cursor-pointer')
                .attr('data-index', index);

            var $a = $('<a>')
                .attr('href', '/' + calc[1])
                .addClass('block py-2.5 px-4 flex-grow text-sm text-gray-700')
                .html(highlightMatch(calc[0], query));

            var $cat = $('<span>')
                .addClass('text-xs text-gray-400 pr-4 whitespace-nowrap')
                .text(calc[2] || '');

            $li.append($a).append($cat);

            // Mouse hover highlight
            $li.on('mouseenter', function () {
                currentFocus = index;
                setActive();
            });

            $list.append($li);
        });

        showDrop();
    }

    function setActive() {
        var $items = $list.find('li');
        $items.removeClass('bg-indigo-50');
        if (currentFocus >= 0 && currentFocus < $items.length) {
            $items.eq(currentFocus).addClass('bg-indigo-50');
        }
    }

    function navigateTo(index) {
        if (filteredData[index]) {
            window.location.href = '/' + filteredData[index][1];
        }
    }

    function showDrop() { $dropdown.removeClass('hidden'); }
    function hideDrop() { $dropdown.addClass('hidden'); currentFocus = -1; }

    $input.on('input', function () {
        renderSuggestions($(this).val());
    });

    $input.on('focus', function () {
        if ($(this).val().trim() !== '') {
            renderSuggestions($(this).val());
        }
    });

    $input.on('keydown', function (e) {
        var $items = $list.find('li');
        var total  = $items.length;

        if (e.key === 'ArrowDown') {
            e.preventDefault();
            currentFocus = (currentFocus + 1) % total;
            setActive();

        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            currentFocus = (currentFocus - 1 + total) % total;
            setActive();

        } else if (e.key === 'Enter') {
            e.preventDefault();
            if (currentFocus >= 0) {
                navigateTo(currentFocus);
            } else if (filteredData.length > 0) {
                navigateTo(0);
            }

        } else if (e.key === 'Escape') {
            hideDrop();
        }
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('#modal-search-wrapper').length) {
            hideDrop();
        }
    });

    $('#modal-search-icon, .open-modal').on('click', function (e) {
        e.preventDefault();
        setTimeout(function() {
            $input[0].focus();
        }, 100);
    });

});
