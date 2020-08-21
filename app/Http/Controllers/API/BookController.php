<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{

	public function index()
	{
		return Book::orderBy('rating', 'desc')->get();
	}

	public function store(Request $request)
	{
		return Book::create($request->all());
	}

	public function show($id)
	{
		$book = Book::findOrFail($id);
		$book->author = $book->author->name;
		return $book;
	}

	public function update(Request $request, $id)
	{
		$book = Book::findOrFail($id);
		$book->fill($request->except(['id']));
		$book->save();
		return response()->json($book);
	}

	public function destroy($id)
	{
		$book = Book::findOrFail($id);
		if($book->delete()) return response(null, 204);
	}

}
