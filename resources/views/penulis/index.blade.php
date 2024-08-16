<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Penulis') }}
        </h2>
    </x-slot>

    <div class="py-12">
<div class=" overflow-x-auto shadow-md sm:rounded-lg">
            <div class="p-10">
                <a href="{{ route('penulis.create') }}"
                   class="px-4 py-2 font-bold text-white bg-red-500 rounded shadow-lg hover:bg-green-700">
                   + Buat Data
                </a>
            </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-10">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        NAME
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        BIOGRAFI
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        FOTO
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        SLUG
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">ACTION</span>
                </th>
            </tr>
        </thead>
        <tbody>
        @if($penulis->count() > 0)
            @foreach($penulis as $lis)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $lis->id }}
                </th>
                <td class="px-6 py-3">
                    {{ $lis->name }}
                </td>
                <td class="px-6 py-3">
                    {{ $lis->biografi }}
                </td>           
                <td class="px-6 py-3 ">
                    <a href="{{ asset('photo/'. $lis->photo) }}" target="_blank"><img src="{{ asset('photo/'. $lis->photo) }}" alt="" class="w-30 h-20"></a>
                </td>
                <td class="px-6 py-3">
                    {{ $lis->slug }}
                </td>
                <td class="py-8 space-x-8 flex">
                    <a href="{{ route('penulis.edit', $lis->id) }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm text-center py-2 w-16">Edit</a>
                    <form action="{{ route('penulis.destroy', $lis->id) }}" method="post" onsubmit="return confirm('Delete?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 w-16">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td class="text-lg font-normal text-center">Penulis not found</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
</div>

</x-app-layout>
