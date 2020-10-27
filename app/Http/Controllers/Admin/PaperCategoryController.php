<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\CreatePaperCategoryRequest;
use App\Http\Requests\Admin\UpdatePaperCategoryRequest;
use App\Model\PaperCategory;
use App\Repositories\PaperCategoryRepository;
use Flash;
use Illuminate\Http\Request;
use Response;

class PaperCategoryController extends AppBaseController
{
    /** @var  PaperCategoryRepository */
    private $paperCategoryRepository;

    public function __construct(PaperCategoryRepository $paperCategoryRepo)
    {
        $this->paperCategoryRepository = $paperCategoryRepo;
    }

    /**
     * Display a listing of the PaperCategory.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $data['pageTitle'] = 'Paper Category';
        $data['menu'] = 'paperCategories';
        $data['paperCategories'] = $this->paperCategoryRepository->all();

        return view('admin.paper_categories.index')
            ->with($data);
    }

    /**
     * Show the form for creating a new PaperCategory.
     *
     * @return Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Add '.'Paper Category';
        $data['menu'] = 'paperCategories';

        return view('admin.paper_categories.create')->with($data);
    }

    /**
     * Store a newly created PaperCategory in storage.
     *
     * @param  CreatePaperCategoryRequest  $request
     *
     * @return Response
     */
    public function store(CreatePaperCategoryRequest $request)
    {
        $input = $request->all();

        $paperCategory = $this->paperCategoryRepository->store($input);

        Flash::success('Paper Category saved successfully.');

        return redirect(route('paperCategories.index'));
    }

    /**
     * Display the specified PaperCategory.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $data['pageTitle'] = 'Paper Category';
        $data['menu'] = 'paperCategories';
        $data['paperCategory'] = $this->paperCategoryRepository->find($id);

        if (empty($data['paperCategory'])) {
            Flash::error('Paper Category not found');

            return redirect(route('paperCategories.index'));
        }

        return view('admin.paper_categories.show')->with($data);
    }

    /**
     * Show the form for editing the specified PaperCategory.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $data['pageTitle'] = 'Edit '.'Paper Category';
        $data['menu'] = 'paperCategories';
        $data['paperCategory'] = $this->paperCategoryRepository->find($id);

        if (empty($data['paperCategory'])) {
            Flash::error('Paper Category not found');

            return redirect(route('paperCategories.index'));
        }

        return view('admin.paper_categories.edit')->with($data);
    }

    /**
     * Update the specified PaperCategory in storage.
     *
     * @param  int  $id
     * @param  UpdatePaperCategoryRequest  $request
     *
     * @return Response
     */
    public function update($id, UpdatePaperCategoryRequest $request)
    {
        $paperCategory = $this->paperCategoryRepository->find($id);

        if (empty($paperCategory)) {
            Flash::error('Paper Category not found');

            return redirect(route('paperCategories.index'));
        }

        $paperCategory = $this->paperCategoryRepository->updatePaperCategory($request->all(), $id);

        Flash::success('Paper Category updated successfully.');

        return redirect(route('paperCategories.index'));
    }

    /**
     * Remove the specified PaperCategory from storage.
     *
     * @param  int  $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $paperCategory = $this->paperCategoryRepository->find($id);

        if (empty($paperCategory)) {
            Flash::error('Paper Category not found');

            return redirect(route('paperCategories.index'));
        }

        $this->paperCategoryRepository->delete($id);

        Flash::success('Paper Category deleted successfully.');

        return redirect(route('paperCategories.index'));
    }

    public function paperCategoryChangeStatus($id)
    {
        $paperCategory = PaperCategory::findOrFail($id);

        if ($paperCategory->status == 1) {
            $paperCategory->status = false;
            $paperCategory->update();
        } else {
            $paperCategory->status = true;
            $paperCategory->update();
        }
        Flash::success('Paper Category Status Updated');

        return redirect(route('paperCategories.index'));
    }
}
