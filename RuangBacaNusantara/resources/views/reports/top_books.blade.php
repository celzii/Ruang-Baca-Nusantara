{{-- resources/views/admin/reports/top_books.blade.php --}}
<h1>Top 10 Books</h1>
<table>
    <thead>
        <tr>
            <th>Book Title</th>
            <th>Times Borrowed</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($topBooks as $topBook)
            <tr>
                <td>{{ $books->where('id', $topBook->book_id)->first()->title }}</td>
                <td>{{ $topBook->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
