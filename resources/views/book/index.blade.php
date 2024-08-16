<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>
   
<div class="py-12">
<div class=" overflow-x-auto shadow-md sm:rounded-lg">
            <div class="p-10">
                <a href="{{ route('books.create') }}"
                   class="px-4 py-2 font-bold text-white bg-red-500 rounded shadow-lg hover:bg-green-700">
                   + Buat Data
                </a>
            </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-10">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        Code
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        DESKRIPSI
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        category_id
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        author_id
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        cover_image
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">ACTION</span>
                </th>
            </tr>
        </thead>
        <tbody>
        @if($book->count() > 0)
            @foreach($book as $bok)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-3">
                    {{ $bok->title }}
                </th>
                <td class="px-6 py-3">
                    {{ $bok->code }}
                </td>
                <td class="px-6 py-3">
                    {{ $bok->description }}
                </td>
                <td class="px-6 py-3">
                    {{ $bok->kategori->name }}
                </td>
                <td class="px-6 py-3">
                    {{ $bok->penulis->name }}
                </td>
                <td class="px-6 py-3">
                    <a href="{{ asset('book_img/'. $bok->cover_image) }}" target="_blank"><img src="{{ asset('book_img/'. $bok->cover_image) }}" alt="" class="w-30 h-20"></a>
                </td>
                <td class="py-8 space-x-8 flex">
                    <a href="{{ route('books.edit', $bok->id) }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm text-center py-2 w-16">Edit</a>
                    <form action="{{ route('books.destroy', $bok->id) }}" method="post" onsubmit="return confirm('Delete?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 w-16">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td class="text-lg font-normal text-center">Books not found</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
</div>

</x-app-layout>