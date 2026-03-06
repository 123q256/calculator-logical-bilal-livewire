<div>
    @if ($calData->is_calculator == 'Converter' && app()->getLocale() == 'en')
        <!-- Converter -->
        <div class="text-xs sm:text-sm text-gray-500 mb-3 px-2">
            Unit Converter › <span class="text-gray-800">{{ $brudcumParent }}</span>
        </div>
    @endif

    @if ($calData->is_calculator == 'Calculator' && app()->getLocale() == 'en')
        <!-- Calculator -->
        <div class="text-xs sm:text-sm text-gray-500 mb-3 px-2">
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-gray-800">Home</a> › 
            <a href="{{ url(lcfirst($calCat)) }}" class="text-gray-500 hover:text-gray-800">{{ $calCat }}</a> › 
            <span class="text-gray-800 font-weight-bold">{{ $brudcumParent }}</span>
        </div>
    @endif
</div>
