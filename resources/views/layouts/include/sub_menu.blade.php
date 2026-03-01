@php
    $databaseData = getDatabaseData();

    $categoryIcons = [
        'Health' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 0 1 6.364 0L12 7.636l1.318-1.318a4.5 4.5 0 1 1 6.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 0 1 0-6.364z"/>',
        'Math' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2z"/>',
        'Everyday-Life' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 0 0 1 1h3m10-11l2 2m-2-2v10a1 1 0 0 1-1 1h-3m-6 0h6"/>',
        'Finance' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>',
        'Physics' => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
        'Chemistry' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 0 0-1.022-.547l-2.387-.477a6 6 0 0 0-3.86.517l-.318.158a6 6 0 0 1-3.86.517L6.05 15.21a2 2 0 0 0-1.806.547M8 4h8l-1 1v5.172a2 2 0 0 0 .586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 0 0 9 10.172V5L8 4z"/>',
        'Statistics' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v6m6 0V9a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v10m6 0V5a2 2 0 0 0 2-2h2a2 2 0 0 0 2 2v14m0 0h2"/>',
        'Construction' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5m-4 0h4"/>',
        'Pets' => '<path stroke-linecap="round" stroke-linejoin="round" d="M14 10h.01M10 10h.01M7 14c0 2.21 2.239 4 5 4s5-1.79 5-4M9 7c0 1.105-.448 2-1 2S7 8.105 7 7s.448-2 1-2 1 .895 1 2zm6 0c0 1.105-.448 2-1 2s-1-.895-1-2 .448-2 1-2 1 .895 1 2z"/>',
        'Time & Date' => '<circle cx="12" cy="12" r="9" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 3"/>',
    ];

    $defaultIcon = '<path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2z"/>';

    $currentPath = Request::path();
@endphp

@foreach ($databaseData as $item)
    @php
        $icon = $categoryIcons[$item->cat_name] ?? $defaultIcon;
        $slug = Str::lower(str_replace(' ', '-', $item->cat_name));
        $isActive = $currentPath === $slug || str_starts_with($currentPath, $slug . '/');
    @endphp

    <a href="{{ url($slug) }}"
        class="flex items-center gap-2 px-3 py-1.5 transition-colors group rounded-md
        {{ $isActive ? 'bg-indigo-50 border-l-2 border-indigo-500' : 'hover:bg-gray-50 border-l-2 border-transparent' }}">

        <div class="w-6 h-6 rounded-md flex items-center justify-center flex-shrink-0"
            style="background: {{ $isActive ? '#DDE1FB' : '#EEF0FB' }};">
            <svg class="w-3 h-3" fill="none" stroke="#3B4FE8" stroke-width="2" viewBox="0 0 24 24">
                {!! $icon !!}
            </svg>
        </div>

        <span class="text-xs transition-colors
            {{ $isActive ? 'text-indigo-700 font-semibold' : 'text-gray-600 group-hover:text-gray-900' }}">
            {{ $item->cat_name }}
        </span>

        @if ($isActive)
            <span class="ml-auto w-1 h-1 rounded-full bg-indigo-500"></span>
        @endif
    </a>
@endforeach

{{-- Unit Converter --}}
@php $isUnitActive = $currentPath === 'unit-converter'; @endphp
<a href="{{ url('unit-converter') }}"
    class="flex items-center gap-2 px-3 py-1.5 transition-colors group rounded-md
    {{ $isUnitActive ? 'bg-indigo-50 border-l-2 border-indigo-500' : 'hover:bg-gray-50 border-l-2 border-transparent' }}">

    <div class="w-6 h-6 rounded-md flex items-center justify-center flex-shrink-0"
        style="background: {{ $isUnitActive ? '#DDE1FB' : '#EEF0FB' }};">
        <svg class="w-3 h-3" fill="none" stroke="#3B4FE8" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4M4 17h12m0 0l-4-4m4 4l-4 4"/>
        </svg>
    </div>

    <span class="text-xs transition-colors
        {{ $isUnitActive ? 'text-indigo-700 font-semibold' : 'text-gray-600 group-hover:text-gray-900' }}">
        Unit Converter
    </span>

    @if ($isUnitActive)
        <span class="ml-auto w-1 h-1 rounded-full bg-indigo-500"></span>
    @endif
</a>