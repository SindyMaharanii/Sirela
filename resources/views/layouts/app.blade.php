<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
    /* Warna background biru gradien */
    body {
        background: linear-gradient(135deg, #e0f2fe 0%, #bfdbfe 100%);
        min-height: 100vh;
    }
    
    /* Semua tulisan hitam */
    body, p, h1, h2, h3, h4, h5, h6, span, div, a, li, td, th, label, input, select, textarea, button {
        color: #000000 !important;
    }

    /* Icon button styling */
    .action-btn {
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px 12px;
        border-radius: 6px;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .action-btn:hover {
        background-color: #f3f4f6;
        transform: scale(1.05);
    }
    .action-btn i {
        font-size: 18px;
    }
    .btn-edit i {
        color: #3b82f6;
    }
    .btn-delete i {
        color: #ef4444;
    }
    .btn-view i {
        color: #10b981;
    }

    /* Style tabel konsisten */
.table-custom {
    width: 100%;
    border-collapse: collapse;
    border-radius: 12px;
    overflow: hidden;
}

.table-custom th,
.table-custom td {
    border: 1px solid #d1d5db;
    padding: 12px;
    text-align: left;
}

.table-custom th {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    font-weight: 600;
}

.table-custom tbody tr:hover {
    background-color: #f3f4f6;
}

.table-custom tbody td {
    color: #1f2937;
}
</style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>