{{-- resources/views/mahasiswa/dashboard.blade.php --}}
<h1>Payment History</h1>
<table>
    <thead>
        <tr>
            <th>Loan ID</th>
            <th>Amount Paid</th>
            <th>Date Paid</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($fines as $fine)
            <tr>
                <td>{{ $fine->loan_id }}</td>
                <td>{{ $fine->amount }}</td>
                <td>{{ $fine->updated_at->format('Y-m-d') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
