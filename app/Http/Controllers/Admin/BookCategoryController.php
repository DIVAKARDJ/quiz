<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\BookCategorySaveRequest;
use App\Model\BookCategory;
use App\Model\Category;
use App\Model\Question;
use App\Services\CommonService;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use function GuzzleHttp\Promise\all;

class BookCategoryController extends Controller
{

    public function bookCategoryList()
    {
        $data['pageTitle'] = 'Book Category';
        $data['menu'] = 'bookCategory';
        $data['bookCategory'] = BookCategory::orderBy('id', 'desc')->get();

        return view('admin.book_category.list', $data);
    }

    public function addBookCategory()
    {
        $data['pageTitle'] = 'Add Book Category';
        $data['menu'] = 'bookCategory';

        return view('admin.book_category.add-edit', $data);
    }

    /*
     *
     * edit user
     */
    public function editBookCategory($id)
    {
        $data['pageTitle'] = 'Edit Book Category';
        $data['menu'] = 'bookCategory';
        $id = app(CommonService::class)->checkValidId($id);
        if (is_array($id)) {
            return redirect()->back()->with(['dismiss' => __('Book Category not found.')]);
        }
        $data['bookCategory'] = BookCategory::where('id', $id)->first();

        return view('admin.book_category.add-edit', $data);
    }

    public function saveBookCategory(BookCategorySaveRequest $request)
    {
        $data = $request->all();
        try {
            if (!empty($request['image'])) {
                $old_img = '';
                if (!empty($data->image)) {
                    $old_img = $data->image;
                }
                $data['image'] = fileUpload($request['image'], path_book_category_image(), $old_img);
            }
            if (!empty($request->edit_id)) {
                $bookcategory = new BookCategory;
                $bookcategory->findOrFail($request->edit_id);
                $bookcategory->fill($data);
                $update = $bookcategory->save();
//                dd($update);
                if ($update) {
                    return redirect()->back()->with('success', __('Book Category Updated Successfully'));
                }
                return redirect()->back()->withInput()->with('dismiss', __('Update Failed'));
            }

            $insert = BookCategory::create($data);
            if ($insert) {
                return redirect()->back()->with('success', __('Book Category Added Successfully'));
            }

            return redirect()->back()->withInput()->with('dismiss', __('Update Failed'));

        } catch (\Exception $e) {
            return redirect()->back()->with('dismiss', $e->getMessage());
        }

    }

    public function deleteBookCategegory(BookCategory $bookCategory)
    {
        $bookCategory->delete();
        
        return redirect(route('bookCategoryList'))->with('success', 'Book Category Deleted Successfully');
    }
}
