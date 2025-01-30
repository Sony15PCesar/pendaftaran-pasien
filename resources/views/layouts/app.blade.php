<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Sakit Sakina Idaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e6f2e6; /* Warna hijau pastel */
        }

        .navbar {
            background-color: #4CAF50 !important; /* Warna hijau utama */
        }

        .navbar-brand {
            font-weight: bold;
            color: white !important;
        }

        .card {
            border: 2px solid #4CAF50;
            border-radius: 10px;
            background-color: #f0fff0; /* Warna hijau terang */
        }

        .card-header {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        .form-control, .btn {
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        .table th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">🏥 Rumah Sakit Sakina Idaman</a>
        </div>
    </nav>

    <div class="container mt-3">
        @yield('content')
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @yield('scripts')
</body>
</html>
