<section>
    <article>
      <header class="flex flex-col items-start p-4 bg-gray-50" data-testid="calculator-header">
        <span class="text-sm text-gray-600">Last updated: <time datetime="2024-04-08T10:38:29.794Z">Apr 08, 2024</time></span>
        <div class="mt-2">
          <h1 class="text-2xl font-bold">Protein Concentration Calculator</h1>
        </div>
        <aside class="flex items-center mt-4 space-x-4">
          <svg class="w-6 h-6 text-gray-500" focusable="false" aria-hidden="true" viewBox="0 0 24 24">
            <path d="M9 13.75C6.66 13.75 2 14.92 2 17.25V19H16V17.25C16 14.92 11.34 13.75 9 13.75ZM4.34 17C5.18 16.42 7.21 15.75 9 15.75C10.79 15.75 12.82 16.42 13.66 17H4.34ZM9 12C10.93 12 12.5 10.43 12.5 8.5C12.5 6.57 10.93 5 9 5C7.07 5 5.5 6.57 5.5 8.5C5.5 10.43 7.07 12 9 12ZM9 7C9.83 7 10.5 7.67 10.5 8.5C10.5 9.33 9.83 10 9 10C8.17 10 7.5 9.33 7.5 8.5C7.5 7.67 8.17 7 9 7ZM16.04 13.81C17.2 14.65 18 15.77 18 17.25V19H22V17.25C22 15.23 18.5 14.08 16.04 13.81ZM15 12C16.93 12 18.5 10.43 18.5 8.5C18.5 6.57 16.93 5 15 5C14.46 5 13.96 5.13 13.5 5.35C14.13 6.24 14.5 7.33 14.5 8.5C14.5 9.67 14.13 10.76 13.5 11.65C13.96 11.87 14.46 12 15 12Z"></path>
          </svg>
          <div>
            <div class="text-sm text-gray-600">Created by <span class="font-medium">Luise Schwenke</span></div>
            <div class="text-sm text-gray-600">Reviewed by <span class="font-medium">Mariamy Chrdileli</span> and <span class="font-medium">Steven Wooding</span></div>
          </div>
          <img alt="Portrait of the calculator author" class="w-16 h-16 rounded-full" draggable="false" loading="lazy" src="https://uploads-cdn.omnicalculator.com/people/LuiseSchwenke.jpg?height=200&width=200&format=jpeg">
        </aside>
        <aside class="flex items-center mt-4 space-x-2">
          <svg class="w-6 h-6 text-gray-500" focusable="false" aria-hidden="true" viewBox="0 0 24 24">
            <path d="M9 21h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-2c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 1 7.58 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2zM9 9l4.34-4.34L12 10h9v2l-3 7H9V9zM1 9h4v12H1z"></path>
          </svg>
          <span class="text-sm text-gray-600">Be the first person to rate this calculator</span>
        </aside>
      </header>
      <div class="flex space-x-2 p-4 bg-gray-50" data-testid="calculator-page-interaction-bar">
        <button class="flex items-center justify-center px-4 py-2 font-medium text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300" aria-label="I find this calculator helpful" aria-pressed="false">
          <svg class="w-5 h-5 mr-2" focusable="false" aria-hidden="true" viewBox="0 0 24 24">
            <path d="M9 21h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-2c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 1 7.58 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2zM9 9l4.34-4.34L12 10h9v2l-3 7H9V9zM1 9h4v12H1z"></path>
          </svg>
          Like
        </button>
        <button class="flex items-center justify-center px-4 py-2 font-medium text-white bg-red-600 rounded hover:bg-red-700 focus:outline-none focus:ring focus:ring-red-300" aria-label="I find this calculator unhelpful" aria-pressed="false">
          <svg class="w-5 h-5 mr-2" focusable="false" aria-hidden="true" viewBox="0 0 24 24">
            <path d="M15 3H6c-.83 0-1.54.5-1.84 1.22l-3.02 7.05c-.09.23-.14.47-.14.73v2c0 1.1.9 2 2 2h6.31l-.95 4.57-.03.32c0 .41.17.79.44 1.06L9.83 23l6.59-6.59c.36-.36.58-.86.58-1.41V5c0-1.1-.9-2-2-2zm0 12-4.34 4.34L12 14H3v-2l3-7h9v10zm4-12h4v12h-4z"></path>
          </svg>
          Dislike
        </button>
        <button class="flex items-center justify-center px-4 py-2 font-medium text-white bg-gray-600 rounded hover:bg-gray-700 focus:outline-none focus:ring focus:ring-gray-300" data-testid="calculator-page-interaction-bar-share-button">
          <svg class="w-5 h-5 mr-2" focusable="false" aria-hidden="true" viewBox="0 0 24 24">
            <path d="M20.14 11.94C20.6 11.54 20.6 10.83 20.14 10.43L13.83 4.91C13.51 4.63 13 4.86 13 5.29V8.73C7.08 9.58 4.74 12.9 3.55 16.92C3.4 17.44 4.08 17.76 4.44 17.36C6.54 14.99 8.95 13.67 13 13.67V17.09C13 17.52 13.51 17.74 13.83 17.46L20.14 11.94Z" stroke="black" stroke-width="1.8"></path>
          </svg>
          Share
        </button>
        {{-- <button class="flex items-center justify-center px-4 py-2 font-medium text-white bg-gray-600 rounded hover:bg-gray-700 focus:outline-none focus:ring focus:ring-gray-300" data-testid="calculator-page-interaction-bar-comment-button">
          <svg class="w-5 h-5 mr-2" focusable="false" aria-hidden="true" viewBox="0 0 24 24">
            <path d="M20 2H4C2.89 2 2.01 2.89 2.01 4L2 18L6 14H20C21.1 14 22 13.1 22 12V4C22 2.9 21.1 2 20 2ZM20 12H6L4 14V4H20V12ZM7 9H17V11H7V9ZM7 6H17V8H7V6Z"></path>
          </svg>
          Comment
        </button> --}}
      </div>
    </article>
  </section>
  