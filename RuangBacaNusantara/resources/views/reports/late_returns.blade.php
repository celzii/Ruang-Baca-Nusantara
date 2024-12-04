{{-- resources/views/admin/reports/late_returns.blade.php --}}
<h1>Late Returns</h1>
<table>
    <thead>
        <tr>
            <th>User Name</th>
            <th>Late Returns</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lateReturns as $lateReturn)
            <tr>
                <td>{{ $users->where('id', $lateReturn->user_id)->first()->name }}</td>
                <td>{{ $lateReturn->late_count }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
