<table id="category-table" class="table category-table table-bordered  text-center mb-0">
    <thead>
    <tr>
        <th class="all" style="width: 20%;">{{__('SL.')}}</th>
        <th class="desktop">Image</th>

        <th class="all" style="width: 15%;">{{__('Action')}}</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($homeSliders[0]))
        @php ($sl = 1)
        @foreach($homeSliders as $homeSlider)
            <tr>
                <td>{{ $sl++ }}</td>
                <td>@if($homeSlider->image)
                        <a href="{{ asset(path_common_image().$homeSlider->image)}}"
                           target="_blank"><img class="datatable-img"
                                                src="{{ asset(path_common_image().$homeSlider->image) }}"
                                                alt="no image"/></a>
                    @else
                        N/A
                    @endif</td>
                <td>
                    {!! Form::open(['route' => ['homeSliders.destroy', $homeSlider->id], 'method' => 'delete']) !!}

                    <a href="{{ route('homeSliders.show', [$homeSlider->id]) }}" class="datatabel-links text-info"
                       data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <a href="{{ route('homeSliders.edit', [$homeSlider->id]) }}" class="datatabel-links text-warning"
                       data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'datatabel-links text-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}

                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
