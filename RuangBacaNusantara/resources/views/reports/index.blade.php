<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Loan Reports</h1>
    <div>
        {!! $chart->container() !!}
    </div>

    {!! $chart->script() !!}
</body>
</html>
