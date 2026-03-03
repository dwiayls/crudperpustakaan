@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h3>Data Book</h3>
        <div>
            <a href="{{ route('categories.index') }}" class="btn btn-success">
                Kelola Kategori
            </a>
            <a href="{{ route('books.create') }}" class="btn btn-primary">
                + Tambah
            </a>
        </div>
    </div>

    <div class="alert alert-info">
        Total Data Book: <strong>{{ $totalBooks }}</strong>
    </div>

    <div class="card mb-3 border-0 shadow-sm">
        <div class="card-header bg-white fw-bold border-0">
            Total Book per Category
        </div>
        <div class="card-body pt-2">
            @foreach($totalPerCategory as $cat)
                <p class="mb-1">
                    {{ $cat->name }} :
                    <strong>{{ $cat->books_count }}</strong>
                </p>
            @endforeach
        </div>
    </div>

    <form method="GET" action="{{ route('books.index') }}" class="row mb-3">

        <div class="col-md-4">
            <input type="text" name="search"
                class="form-control"
                placeholder="Cari Judul..."
                value="{{ request('search') }}">
        </div>

        <div class="col-md-4">
            <select name="category_id" class="form-select">
                <option value="">-- Semua Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">
                Filter
            </button>

            <a href="{{ route('books.index') }}" class="btn btn-secondary">
                Reset
            </a>
        </div>

    </form>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $key => $book)
            <tr>
                <td>{{ $books->firstItem() + $key }}</td>
                <td>{{ $book->judul }}</td>
                <td>{{ $book->penulis }}</td>
                <td>{{ $book->tahun_terbit }}</td>
                <td>{{ $book->stok }}</td>
                <td>{{ $book->category->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('books.edit', $book->id) }}" 
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('books.destroy', $book->id) }}" 
                          method="POST" 
                          class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin mau hapus data ini?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">
                    Data tidak ditemukan
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $books->links() }}

</div>
@endsection