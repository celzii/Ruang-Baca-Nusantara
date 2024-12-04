<!DOCTYPE html>
<html lang="id">
    {{-- @livewireStyles --}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RuangBacaNusantara</title>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('Images_Library/logo ruangbacanusantara.png') }}" type="image/png">

    {{-- CSS Link --}}
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    {{-- Bootstrap Icons --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">

    {{-- Boostrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- Font google --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto+Slab:wght@100..900&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg1">
        <a class="navbar-brand text-white ms-4 merriweather-regular" href="{{ url('/') }}">
            <img src="{{ asset('Images_Library/logo ruangbacanusantara.png') }}" alt="Logo" style="width: 40px; height: auto;">
            Ruang Baca Nusantara
        </a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link  text-white" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ URL('/') }}">Katalog Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/tentang') }}">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/layanan') }}">Layanan</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link text-white btn btn-link" style="border: none; background: none;">Logout</button>
                        </form>
                    </li>
                    
                @else
                <div class="position-absolute end-0">
                    <button class="button-login my-1 mx-2" onclick="window.location.href='{{ route('login') }}'">Login</button>
                    <button class="button-register my-1 mx-2 me-4" onclick="window.location.href='{{ route('register') }}'">Register</button>
                </div>
                @endauth
            </ul>
        </div>
    </nav>

    {{-- Banner --}}
    <div class="guesthouse banner ">
        <h1>KOLEKSI DIGITAL PERPUSTAKAAN <br> RUANG BACA NUSANTARA</h1>
    
        <!-- Form Pencarian -->
        <form class="d-flex mt-3" style="justify-content: center" wire:submit.prevent>
            <!-- Input Pencarian -->
            <input wire:model="search" class="form-control border border-light"
                type="text" style="width: 50%; height: 50px;"
                placeholder="Masukkan kata kunci pencarian" aria-label="Search">
            
            <!-- Dropdown Pilihan Kategori -->
            <select wire:model="searchBy" class="form-select ms-2" style="width: 20%; height: 50px;">
                <option value="title">Judul</option>
                <option value="isbn">ISBN</option>
                <option value="author">Penulis</option>
                <option value="publisher">Penerbit</option>
            </select>
            
            <!-- Tombol Pencarian -->
            <button class="btn btn-light ms-2" type="button" style="height: 50px; background: transparent;">
                <i class="bi bi-search" style="font-size: 25px; color:white;" 
                onmouseover="this.style.color='#45a049';" 
                onmouseout="this.style.color='white';">
                </i>
            </button>
        </form>
    </div>

    {{-- <div class="container">
        <h1 class="text-center mb-4" style="font-family: 'Arial', sans-serif; font-weight: bold;">Koleksi Buku Terbaru</h1>
        <div class="row justify-content-center">
            @foreach ($books as $book)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <!-- Check if the book has an image, otherwise use a placeholder -->
                    <img src="{{ $book->image ? asset('storage/' . $book->image) : 'default_image_path.jpg' }}" class="card-img-top" alt="{{ $book->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">{{ Str::limit($book->description, 100) }}</p>
                        <a href="#" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div> --}}
        
            <div class="container category-container"">
                <h1 class="text-center mb-4" style="font-family: 'Arial', sans-serif; font-weight: bold;">Buku Berdasarkan Kategori</h1>
                
                <div class="row">
                    <!-- Academic Category -->
                    <div class="col-md-3 mb-4">
                        <div class="category-box">
                            <i class="bi bi-book"></i>
                            <div class="category-title">Academic</div>
                        </div>
                    </div>
        
                    <!-- Bisnis Category -->
                    <div class="col-md-3 mb-4">
                        <div class="category-box">
                            <i class="bi bi-building"></i>
                            <div class="category-title">Bisnis</div>
                        </div>
                    </div>
        
                    <!-- Literatur Category -->
                    <div class="col-md-3 mb-4">
                        <div class="category-box">
                            <i class="bi bi-journal-bookmark"></i>
                            <div class="category-title">Literatur</div>
                        </div>
                    </div>
        
                    <!-- Environment Category -->
                    <div class="col-md-3 mb-4">
                        <div class="category-box">
                            <i class="bi bi-leaf"></i>
                            <div class="category-title">Environment</div>
                        </div>
                    </div>
                </div>
        
                <div class="row">
                    <!-- Kesehatan Category -->
                    <div class="col-md-3 mb-4">
                        <div class="category-box">
                            <i class="bi bi-heart"></i>
                            <div class="category-title">Kesehatan</div>
                        </div>
                    </div>
        
                    <!-- Politik Category -->
                    <div class="col-md-3 mb-4">
                        <div class="category-box">
                            <i class="bi bi-person-fill"></i>
                            <div class="category-title">Politik</div>
                        </div>
                    </div>
        
                    <!-- Matematika Category -->
                    <div class="col-md-3 mb-4">
                        <div class="category-box">
                            <i class="bi bi-bar-chart-line"></i>
                            <div class="category-title">Matematika</div>
                        </div>
                    </div>
        
                    <!-- Teknologi Category -->
                    <div class="col-md-3 mb-4">
                        <div class="category-box">
                            <i class="bi bi-laptop"></i>
                            <div class="category-title">Teknologi</div>
                        </div>
                    </div>
                </div>
        
                <div class="row">
                    <!-- Kesenian Category -->
                    <div class="col-md-3 mb-4">
                        <div class="category-box">
                            <i class="bi bi-palette"></i>
                            <div class="category-title">Kesenian</div>
                        </div>
                    </div>
        
                    <!-- Penelitian Category -->
                    <div class="col-md-3 mb-4">
                        <div class="category-box">
                            <i class="bi bi-flask"></i>
                            <div class="category-title">Penelitian</div>
                        </div>
                    </div>
        
                    <!-- Geologi Category -->
                    <div class="col-md-3 mb-4">
                        <div class="category-box">
                            <i class="bi bi-globe"></i>
                            <div class="category-title">Geologi</div>
                        </div>
                    </div>
        
                    <!-- Agrikultur Category -->
                    <div class="col-md-3 mb-4">
                        <div class="category-box">
                            <i class="bi bi-plant"></i>
                            <div class="category-title">Agrikultur</div>
                        </div>
                    </div>
                </div>
            </div>
    
    

    <!-- Tempat Konten Dinamis -->
    <div class="container mt-5">
        @yield('content') <!-- Konten dinamis yang akan ditambahkan dari view lain -->
    </div>

    {{-- @livewireScripts --}}
    {{-- Script boostrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</body>
</html>
