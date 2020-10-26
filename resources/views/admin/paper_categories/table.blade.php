<table id="category-table" class="table category-table table-bordered  text-center mb-0">
    <thead>
    <tr>
        <th class="all">{{__('SL.')}}</th>
        <th class="desktop">Name</th>

        <th class="desktop">Image</th>

        <th class="desktop">Status</th>

        <th class="all">{{__('Action')}}</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($paperCategories[0]))
        @php ($sl = 1)
        @foreach($paperCategories as $paperCategory)
            <tr>
                <td>{{ $sl++ }}</td>
                <td>{{ $paperCategory->name }}</td>
                <td>
                    @if($paperCategory->image)
                        <img class="datatable-img"
                             src="{{ asset(path_category_image().$paperCategory->image) }}"
                             alt="no image"/>
                    @else
                        N/A
                    @endif
                </td>

                <td><span @if($paperCategory->status == 1) class="text-success"
                          @else class="text-danger" @endif>{{ statusType($paperCategory->status) }}</span>
                <td>
                    {!! Form::open(['route' => ['paperCategories.destroy', $paperCategory->id], 'method' => 'delete']) !!}

                    <a href="{{ route('paperCategories.show', [$paperCategory->id]) }}"
                       class="datatabel-links text-info" data-toggle="tooltip" title="View"><i class="fa fa-eye"
                                                                                               aria-hidden="true"></i></a>
                    <a href="{{ route('paperCategories.edit', [$paperCategory->id]) }}"
                       class="datatabel-links text-warning" data-toggle="tooltip" title="Edit"><i
                                class="fa fa-pencil-square-o"></i></a>
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'datatabel-links text-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    @if($paperCategory->status == STATUS_INACTIVE)
                        <a class="datatabel-links text-danger"
                           href="{{ route('paperCategoryChangeStatus', $paperCategory->id) }}" data-toggle="tooltip"
                           title="Activate">
                            <i class="fa fa-times-circle-o fa-lg"></i>
                        </a>
                    @else
                        <a class="datatabel-links text-success"
                           href="{{ route('paperCategoryChangeStatus', $paperCategory->id) }}" data-toggle="tooltip"
                           title="Dectivate">
                            <span class="flaticon-check-mark"></span>
                        </a>
                    @endif

                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
