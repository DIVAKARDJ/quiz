<table id="category-table" class="table category-table table-bordered  text-center mb-0">
    <thead>
    <tr>
        <th class="all" style="width: 20%;">{{__('SL.')}}</th>
        <th class="desktop">Name</th>

        <th class="all" style="width: 15%;">{{__('Action')}}</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($posts[0]))
        @php ($sl = 1)
        @foreach($posts as $post)
            <tr>
                <td>{{ $sl++ }}</td>
                <td>{{ $post->name }}</td>
                <td>
                    {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}

                    <a href="{{ route('posts.show', [$post->id]) }}" class="datatabel-links text-info"
                       data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <a href="{{ route('posts.edit', [$post->id]) }}" class="datatabel-links text-warning"
                       data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'datatabel-links text-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}

                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
