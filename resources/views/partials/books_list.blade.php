@if ($book->count() > 0)
    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-3 px-8 border-b text-left">Title</th>
                <th class="py-3 px-8 border-b text-left">Code</th>
                <th class="py-3 px-8 border-b text-left">Author</th>
            </tr>
        </thead>
        <tbody>
            @foreach($book as $book)
                <tr>
                    <td class="py-2 px-8 border-b">{{ $book->title }}</td>
                    <td class="py-2 px-8 border-b">{{ $book->code }}</td>
                    <td class="py-2 px-8 border-b">{{ $book->penulis->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No books found.</p>
@endif