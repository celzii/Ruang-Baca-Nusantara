<form action="{{ route('admin.books.index') }}" method="GET">
    <input type="text" name="search" placeholder="Search books..." value="{{ request()->search }}">
    <button type="submit">Search</button>
</form>

<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->category }}</td>
                <td>{{ $book->quantity }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
