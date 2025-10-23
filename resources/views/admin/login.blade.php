<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.5.3/dist/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold text-center text-gray-800">Login</h1>
            @if($error = Session::get('admin_error'))
                <div class="flex justify-center">
                    <div class="w-full md:w-1/2">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            {{ $error }}
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <button class="text-red-500" onclick="this.parentElement.parentElement.remove();">
                                    ×
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            @endif
            @if ($errors->any())
                <div class="flex justify-center">
                    <div class="w-full md:w-1/2">
                        @foreach ($errors->all() as $error)
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                                {{ $error }}
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                    <button class="text-red-500" onclick="this.parentElement.parentElement.remove();">
                                        ×
                                    </button>
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        <form class="mt-4" method="POST" action="{{ url('admin/login') }}/" accept-charset="UTF-8">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    name
                </label>
                <input id="name" type="text" placeholder="Enter your name" name="name"
                    class="shadow appearance-none border span12 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input id="password" type="password" placeholder="Enter your password" name="pass"
                    class="shadow appearance-none border span12 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
          
            <div>
                <input type="submit" name="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" >
            </div>
        </form>
    </div>
</body>
</html>






