<div>

    <div x-data="{ show: false, message: '' }"
        x-on:toast.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 3000);"
        x-show="show" x-transition
        class="fixed top-6 right-6 bg-green-600 text-white font-medium px-6 py-3 rounded-xl shadow-lg z-50"
        style="display: none;">
        <span x-text="message"></span>
    </div>

    <form wire:submit.prevent="send" class="text-left">
        <div>
              <label  for="name" class="block text-xs font-semibold text-gray-700 mb-1.5 ml-3">Name</label>
            <input type="name" id="name" wire:model.defer="name"
                class="input_border w-full px-4 py-3.5 rounded-xl border border-gray-200 text-sm text-gray-800 placeholder-gray-400 focus:outline-none transition "
                placeholder="Enter your Name" required />
            @error('name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

        </div>
        <div class="my-4">
              <label for="email" class="block text-xs font-semibold text-gray-700 mb-1.5 ml-3">Email Address</label>
          
            <input type="email" id="email" wire:model.defer="email"
                class="input_border w-full px-4 py-3.5 rounded-xl border border-gray-200 text-sm text-gray-800 placeholder-gray-400 focus:outline-none transition "
                placeholder="Enter your Email" required />
            @error('email')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

        </div>
        <div class="my-4">
               <label for="subject" class="block text-xs font-semibold text-gray-700 mb-1.5 ml-3">Subject</label>
            <input type="text" id="subject" wire:model.defer="subject"
                class="input_border w-full px-4 py-3.5 rounded-xl border border-gray-200 text-sm text-gray-800 placeholder-gray-400 focus:outline-none transition "
                placeholder="Let us know how we can help you" required />
            @error('subject')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

       <div class="my-4">
           <label for="msg" class="block text-xs font-semibold text-gray-700 mb-1.5 ml-3">Message</label>
            <textarea type="text" rows="5" id="msg" wire:model.defer="msg"
                class="input_border w-full px-4 py-3.5 rounded-xl border border-gray-200 text-sm text-gray-800 placeholder-gray-400 focus:outline-none transition focus:outline-none focus:ring-0"
                placeholder="Enter your Description" required></textarea>
            @error('msg')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
            <div class="flex justify-end mt-4">
                <button type="submit"
                    class="bg-gradient-to-r from-blue-700 to-blue-500 text-white hover:from-blue-800 hover:to-blue-600 shadow-md hover:shadow-lg  font-semibold text-sm rounded-xl px-12 py-3.5 flex items-center justify-end gap-2 disabled:opacity-60"
                    wire:loading.attr="disabled">Submit
                    <!-- Loader -->
                    <svg wire:loading wire:target="send" class="animate-spin h-5 w-5 text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                    </svg>
                </button>
            </div>

        </div>
    </form>


</div>
