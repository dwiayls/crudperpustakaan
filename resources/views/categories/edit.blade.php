@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-3">Edit Kategori</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="name"
                class="form-control"
                value="{{ old('name', $category->name) }}"
                required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </form>

</div>
@endsection