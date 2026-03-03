<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');

        if ($request->search) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $books = $query->paginate(5)->withQueryString();
        $categories = Category::all();
        $totalBooks = Book::count();
        $totalPerCategory = Category::withCount('books')->get();

        return view('books.index', compact(
            'books',
            'categories',
            'totalBooks',
            'totalPerCategory'
        ));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'   => 'required',
            'judul'         => 'required',
            'penulis'       => 'required',
            'tahun_terbit'  => 'required|numeric',
            'stok'          => 'required|numeric',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();

        return view('books.edit', compact('book', 'categories'));
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id'   => 'required',
            'judul'         => 'required',
            'penulis'       => 'required',
            'tahun_terbit'  => 'required|numeric',
            'stok'          => 'required|numeric',
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->all());

        return redirect()->route('books.index')
            ->with('success', 'Data berhasil diupdate');
    }

    // =========================
    // DELETE
    // =========================
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Data berhasil dihapus');
    }
}