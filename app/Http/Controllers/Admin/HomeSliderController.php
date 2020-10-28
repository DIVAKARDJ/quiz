<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\CreateHomeSliderRequest;
use App\Http\Requests\Admin\UpdateHomeSliderRequest;
use App\Repositories\HomeSliderRepository;
use Flash;
use Illuminate\Http\Request;
use Response;

class HomeSliderController extends AppBaseController
{
    /** @var  HomeSliderRepository */
    private $homeSliderRepository;

    public function __construct(HomeSliderRepository $homeSliderRepo)
    {
        $this->homeSliderRepository = $homeSliderRepo;
    }

    /**
     * Display a listing of the HomeSlider.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $data['pageTitle'] = 'Home Slider';
        $data['menu'] = 'homeSliders';
        $data['homeSliders'] = $this->homeSliderRepository->all();

        return view('admin.home_sliders.index')
            ->with($data);
    }

    /**
     * Show the form for creating a new HomeSlider.
     *
     * @return Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Add '.'Home Slider';
        $data['menu'] = 'homeSliders';

        return view('admin.home_sliders.create')->with($data);
    }

    /**
     * Store a newly created HomeSlider in storage.
     *
     * @param  CreateHomeSliderRequest  $request
     *
     * @return Response
     */
    public function store(CreateHomeSliderRequest $request)
    {
        $input = $request->all();
        if (isset($input['image']) && ! empty($input['image'])) {
            $old_img = '';
            if (! empty($request->image)) {
                $old_img = $request->image;
            }
            $input['image'] = fileUpload($input['image'], path_common_image(), $old_img);
        }

        $homeSlider = $this->homeSliderRepository->create($input);

        Flash::success('Home Slider saved successfully.');

        return redirect(route('homeSliders.index'));
    }

    /**
     * Display the specified HomeSlider.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $data['pageTitle'] = 'Home Slider';
        $data['menu'] = 'homeSliders';
        $data['homeSlider'] = $this->homeSliderRepository->find($id);

        if (empty($data['homeSlider'])) {
            Flash::error('Home Slider not found');

            return redirect(route('homeSliders.index'));
        }

        return view('admin.home_sliders.show')->with($data);
    }

    /**
     * Show the form for editing the specified HomeSlider.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $data['pageTitle'] = 'Edit '.'Home Slider';
        $data['menu'] = 'homeSliders';
        $data['homeSlider'] = $this->homeSliderRepository->find($id);

        if (empty($data['homeSlider'])) {
            Flash::error('Home Slider not found');

            return redirect(route('homeSliders.index'));
        }

        return view('admin.home_sliders.edit')->with($data);
    }

    /**
     * Update the specified HomeSlider in storage.
     *
     * @param  int  $id
     * @param  UpdateHomeSliderRequest  $request
     *
     * @return Response
     */
    public function update($id, UpdateHomeSliderRequest $request)
    {
        $homeSlider = $this->homeSliderRepository->find($id);

        if (empty($homeSlider)) {
            Flash::error('Home Slider not found');

            return redirect(route('homeSliders.index'));
        }
        $input = $request->all();
        if (isset($input['image']) && ! empty($input['image'])) {
            $old_img = '';
            if (! empty($request->image)) {
                $old_img = $request->image;
            }
            $input['image'] = fileUpload($input['image'], path_common_image(), $old_img);
        }

        $homeSlider = $this->homeSliderRepository->update($input, $id);

        Flash::success('Home Slider updated successfully.');

        return redirect(route('homeSliders.index'));
    }

    /**
     * Remove the specified HomeSlider from storage.
     *
     * @param  int  $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $homeSlider = $this->homeSliderRepository->find($id);

        if (empty($homeSlider)) {
            Flash::error('Home Slider not found');

            return redirect(route('homeSliders.index'));
        }

        $this->homeSliderRepository->delete($id);

        Flash::success('Home Slider deleted successfully.');

        return redirect(route('homeSliders.index'));
    }
}
