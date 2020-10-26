<table id="category-table" class="table category-table table-bordered  text-center mb-0">
    <thead>
    <tr>
        <th class="all">{{__('SL.')}}</th>
        <th class="desktop">Paper Category</th>

        <th class="desktop">Name</th>

        <th class="desktop">Creator Name</th>

        <th class="desktop">Paper Pdf</th>

        <th class="desktop">Language</th>

        <th class="all">{{__('Action')}}</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($oldPapers[0]))
        @php ($sl = 1)
        @foreach($oldPapers as $oldPaper)
            <tr>
                <td>{{ $sl++ }}</td>
                <td>{{ $oldPaper->category->name }}</td>
                <td>{{ $oldPaper->name }}</td>
                <td>{{ $oldPaper->creator_name }}</td>
                <td><a href="{{ asset(path_paper_pdf().$oldPaper->paper_pdf)
 }}" target="_blank">View</a></td>
                <td>{{ $oldPaper->language }}</td>
                <td>
                    {!! Form::open(['route' => ['oldPapers.destroy', $oldPaper->id], 'method' => 'delete']) !!}

                    <a href="{{ route('oldPapers.show', [$oldPaper->id]) }}" class="datatabel-links text-info"
                       data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <a href="{{ route('oldPapers.edit', [$oldPaper->id]) }}" class="datatabel-links text-warning"
                       data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'datatabel-links text-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}

                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
