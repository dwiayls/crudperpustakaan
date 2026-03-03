@extends('layouts.app')

@section('content')

<div class="container">

    <h3 class="mb-3">Edit Book</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <form action="{{ route('books.update', $book->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" 
                           name="judul" 
                           class="form-control" 
                           value="{{ $book->judul }}" 
                           required>
                </div>

                <div class="mb-3">
                    <label>Penulis</label>
                    <input type="text" 
                           name="penulis" 
                           class="form-control" 
                           value="{{ $book->penulis }}" 
                           required>
                </div>

                <div class="mb-3">
                    <label>Tahun Terbit</label>
                    <input type="number" 
                           name="tahun_terbit" 
                           class="form-control" 
                           value="{{ $book->tahun_terbit }}" 
                           required>
                </div>

                <div class="mb-3">
                    <label>Stok</label>
                    <input type="number" 
                           name="stok" 
                           class="form-control" 
                           value="{{ $book->stok }}" 
                           required>
                </div>

                <button class="btn btn-success">Update</button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>

@endsection