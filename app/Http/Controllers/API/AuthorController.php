<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Author;

class AuthorController extends Controller
{

	public function index()
	{
		return Author::withCount('books')->orderBy('rating', 'desc')->get();
	}

	public function store(Request $request)
	{
		return Author::create($request->all());
	}

	public function show($id)
	{
		$author = Author::findOrFail($id);
		$author->count_books = $author->books->count();
		return $author;
	}

	public function update(Request $request, $id)
	{
		$author = Author::findOrFail($id);
		$author->fill($request->except(['id']));
		$author->save();
		return response()->json($author);
	}

	public function destroy($id)
	{
		$author = Author::findOrFail($id);
		if($author->delete()) return response(null, 204);
	}
}
