<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(Request $request): View
    {
        return view('book.index', [
            'books' => Book::all(),
            'user' => $request->user(),
        ]);
    }
    /**
     * Display the user's profile form.
     */
    public function create(Request $request): View
    {
        return view('book.create', [
            'categories' => Category::all(),
            'user' => $request->user(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => ['required','string', 'min:3'],
            'description' => ['string'],
            'category_id' => ['required','integer', 'exists:App\Models\Category,id'],
            'price' => ['required','decimal:0,2'],
            'quantity'=> ['required','integer'],
            'image' => ['required','image']
        ]);
        $book = Book::create(
            [
                'name'=>$request->name,
                'description'=>$request->description,
                'category_id'=>$request->category_id,
                'price'=>$request->price,
                'quantity'=>$request->quantity
            ]
        );
        $file = $request->file('image');
        $file_name = 'file'.$book->id.'.'.$file->clientExtension();
        Storage::disk('public')->append('book_images/'.$file_name, $file->getContent());
        $book->image_file=$file_name;
        $book->save();
        return redirect()->route('book.index');
    }

    public function edit(Request $request, Book $book): View
    {
        return view('book.edit', [
            'book' => $book,
            'categories' => Category::all(),
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $this->validate($request, [
            'name' => ['required','string', 'min:3'],
            'description' => ['string'],
            'category_id' => ['required','integer', 'exists:App\Models\Category,id'],
            'price' => ['required','decimal:0,2'],
            'quantity'=> ['required','integer'],
            'image' => ['image']
        ]);
        $book->update(
            [
                'name'=>$request->name,
                'description'=>$request->description,
                'category_id'=>$request->category_id,
                'price'=>$request->price,
                'quantity'=>$request->quantity
            ]
        );
        if($request->hasFile('image')){
            Storage::disk('public')->delete('book_images/'.$book->image_file);
            $file = $request->file('image');
            $file_name = 'file'.$book->id.'.'.$file->clientExtension();
            Storage::disk('public')->append('book_images/'.$file_name, $file->getContent());
            $book->image_file=$file_name;
            $book->save();
        }
        return redirect()->route('book.index');
    }

    /**
     * Update the user's profile information.
     */


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, Book $book): RedirectResponse
    {
        Storage::disk('public')->delete('book_images/'.$book->image_file);
        $book->delete();
        return redirect()->route('book.index');
    }
}
