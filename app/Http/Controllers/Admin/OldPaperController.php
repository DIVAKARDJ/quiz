<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\CreateOldPaperRequest;
use App\Http\Requests\Admin\UpdateOldPaperRequest;
use App\Model\PaperCategory;
use App\Repositories\OldPaperRepository;
use Flash;
use Illuminate\Http\Request;
use Response;

class OldPaperController extends AppBaseController
{
    /** @var  OldPaperRepository */
    private $oldPaperRepository;

    public function __construct(OldPaperRepository $oldPaperRepo)
    {
        $this->oldPaperRepository = $oldPaperRepo;
    }

    /**
     * Display a listing of the OldPaper.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $data['pageTitle'] = 'Old Paper';
        $data['menu'] = 'oldPapers';
        $data['oldPapers'] = $this->oldPaperRepository->all();

        return view('admin.old_papers.index')
            ->with($data);
    }

    /**
     * Show the form for creating a new OldPaper.
     *
     * @return Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Add '.'Old Paper';
        $data['menu'] = 'oldPapers';
        $data['paperCategory'] = PaperCategory::pluck('name', 'id');

        return view('admin.old_papers.create')->with($data);
    }

    /**
     * Store a newly created OldPaper in storage.
     *
     * @param  CreateOldPaperRequest  $request
     *
     * @return Response
     */
    public function store(CreateOldPaperRequest $request)
    {
        $input = $request->all();

        $oldPaper = $this->oldPaperRepository->store($input);

        Flash::success('Old Paper saved successfully.');

        return redirect(route('oldPapers.index'));
    }

    /**
     * Display the specified OldPaper.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $data['pageTitle'] = 'Old Paper';
        $data['menu'] = 'oldPapers';
        $data['oldPaper'] = $this->oldPaperRepository->find($id);

        if (empty($data['oldPaper'])) {
            Flash::error('Old Paper not found');

            return redirect(route('oldPapers.index'));
        }

        return view('admin.old_papers.show')->with($data);
    }

    /**
     * Show the form for editing the specified OldPaper.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $data['pageTitle'] = 'Edit '.'Old Paper';
        $data['menu'] = 'oldPapers';
        $data['oldPaper'] = $this->oldPaperRepository->find($id);
        $data['paperCategory'] = PaperCategory::pluck('name', 'id');

        if (empty($data['oldPaper'])) {
            Flash::error('Old Paper not found');

            return redirect(route('oldPapers.index'));
        }

        return view('admin.old_papers.edit')->with($data);
    }

    /**
     * Update the specified OldPaper in storage.
     *
     * @param  int  $id
     * @param  UpdateOldPaperRequest  $request
     *
     * @return Response
     */
    public function update($id, UpdateOldPaperRequest $request)
    {
        $oldPaper = $this->oldPaperRepository->find($id);

        if (empty($oldPaper)) {
            Flash::error('Old Paper not found');

            return redirect(route('oldPapers.index'));
        }

        $oldPaper = $this->oldPaperRepository->updateOldPaper($request->all(), $id);

        Flash::success('Old Paper updated successfully.');

        return redirect(route('oldPapers.index'));
    }

    /**
     * Remove the specified OldPaper from storage.
     *
     * @param  int  $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $oldPaper = $this->oldPaperRepository->find($id);

        if (empty($oldPaper)) {
            Flash::error('Old Paper not found');

            return redirect(route('oldPapers.index'));
        }

        $this->oldPaperRepository->delete($id);

        Flash::success('Old Paper deleted successfully.');

        return redirect(route('oldPapers.index'));
    }
}
