<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\CreateBookRequest;
use App\Http\Requests\Admin\UpdateBookRequest;
use App\Model\BookCategory;
use App\Repositories\Admin\BookRepository;
use Flash;
use Illuminate\Http\Request;
use Response;

class BookController extends AppBaseController
{
    /** @var  BookRepository */
    private $bookRepository;

    public function __construct(BookRepository $bookRepo)
    {
        $this->bookRepository = $bookRepo;
    }

    /**
     * Display a listing of the Book.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $data['pageTitle'] = 'Book';
        $data['menu'] = 'books';
        $data['books'] = $this->bookRepository->all();

        return view('admin.books.index')
            ->with($data);
    }

    /**
     * Show the form for creating a new Book.
     *
     * @return Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Add '.'Book';
        $data['menu'] = 'books';
        $data['bookCategory'] = BookCategory::pluck('name', 'id');

        return view('admin.books.create')->with($data);
    }

    /**
     * Store a newly created Book in storage.
     *
     * @param  CreateBookRequest  $request
     *
     * @return Response
     */
    public function store(CreateBookRequest $request)
    {
        $input = $request->all();

        $book = $this->bookRepository->store($input);

        Flash::success('Book saved successfully.');

        return redirect(route('books.index'));
    }

    /**
     * Display the specified Book.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $data['pageTitle'] = 'Book';
        $data['menu'] = 'books';
        $data['book'] = $this->bookRepository->find($id);

        if (empty($data['book'])) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }

        return view('admin.books.show')->with($data);
    }

    /**
     * Show the form for editing the specified Book.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $data['pageTitle'] = 'Edit '.'Book';
        $data['menu'] = 'books';
        $data['book'] = $this->bookRepository->find($id);
        $data['bookCategory'] = BookCategory::pluck('name', 'id');

        if (empty($data['book'])) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }

        return view('admin.books.edit')->with($data);
    }

    /**
     * Update the specified Book in storage.
     *
     * @param  int  $id
     * @param  UpdateBookRequest  $request
     *
     * @return Response
     */
    public function update($id, UpdateBookRequest $request)
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }

        $book = $this->bookRepository->updateBook($request->all(), $id);

        Flash::success('Book updated successfully.');

        return redirect(route('books.index'));
    }

    /**
     * Remove the specified Book from storage.
     *
     * @param  int  $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }
        if (! empty($book->book_pdf)) {
            removeImage(asset(path_book_category_image()), $book->book_pdf);
        }

        $this->bookRepository->delete($id);

        Flash::success('Book deleted successfully.');

        return redirect(route('books.index'));
    }
}
