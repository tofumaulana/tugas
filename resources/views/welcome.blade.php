<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="antialiased bg-gray-400">
        <div class="relative sm:flex sm:justify-center sm:items-center  bg-dots-darker bg-center selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Books List</h1>
        <p class="text-xl font-semibold py-3">Total Books: {{ $totalBooks }}</p>

        <!-- Search Form -->
        <form method="GET" action="{{ url('/') }}" class="mb-6">
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Search By:</label>
                <div class="flex items-center space-x-4">
                    <label class="inline-flex items-center">
                        <input class="form-radio text-blue-500" type="radio" name="search_by" value="title" {{ request('search_by') === 'title' ? 'checked' : '' }}>
                        <span class="ml-2">Title</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input class="form-radio text-blue-500" type="radio" name="search_by" value="code" {{ request('search_by') === 'code' ? 'checked' : '' }}>
                        <span class="ml-2">Code</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input class="form-radio text-blue-500" type="radio" name="search_by" value="penulis" {{ request('search_by') === 'penulis' ? 'checked' : '' }}>
                        <span class="ml-2">Author</span>
                    </label>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <input type="text" name="search" class="form-input w-full border border-gray-300 rounded-lg py-2 px-4" placeholder="Search..." value="{{ request('search') }}">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Search</button>
            </div>
        </form>

        <!-- Books Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-8 border-b text-left">Title</th>
                        <th class="py-3 px-8 border-b text-left">Code</th>
                        <th class="py-3 px-8 border-b text-left">Author</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($book as $bok)
                        <tr>
                            <td class="py-2 px-8 border-b">{{ $bok->title }}</td>
                            <td class="py-2 px-8 border-b">{{ $bok->code }}</td>
                            <td class="py-2 px-8 border-b">{{ $bok->penulis->name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-2 px-4 border-b text-center">No books found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
