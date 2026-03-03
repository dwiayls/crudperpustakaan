@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h3>Data Kategori</h3>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            + Tambah
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th width="150px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $key => $category)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category->id) }}"
                        class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('categories.destroy', $category->id) }}"
                        method="POST"
                        style="display:inline-block;"
                        onsubmit="return confirm('Yakin mau hapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">
                    Belum ada data kategori
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection