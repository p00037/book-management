<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BooksController extends Controller
{
    public function index(Request $request)
    {
        $category_id = $request->category_id;
        $query = Book::query();
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }

        // $books = $query->orderBy('created_at', 'desc')->paginate(5);
        $books = $query->orderByRaw('borrower desc, id asc')->paginate(5);
        $categories = Category::orderBy('id', 'desc')->get();
        $array = array('books' => $books,
                       'categories' => $categories, 
                       'category_id' => $category_id);
        return view('books.index', $array);
    }
}
