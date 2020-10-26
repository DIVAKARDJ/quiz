<table id="category-table" class="table category-table table-bordered  text-center mb-0">
    <thead>
    <tr>
        <th class="all">{{__('SL.')}}</th>
        <th class="desktop">Name</th>

        <th class="desktop">Seller Name</th>

        <th class="desktop">Book Pdf</th>

        <th class="desktop">Language</th>

        <th class="desktop">Book Category</th>

        <th class="all">{{__('Action')}}</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($books[0]))
        @php ($sl = 1)
        @foreach($books as $book)
            <tr>
                <td>{{ $sl++ }}</td>
                <td>{{ $book->name }}</td>
                <td>{{ $book->seller_name }}</td>
                <td><a href="{{ asset(path_book_pdf().$book->book_pdf)
 }}" target="_blank">View</a></td>
                <td>{{ $book->language }}</td>
                <td>{{ $book->category->name }}</td>
                <td>
                    {!! Form::open(['route' => ['books.destroy', $book->id], 'method' => 'delete']) !!}

                    <a href="{{ route('books.show', [$book->id]) }}" class="datatabel-links text-info"
                       data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <a href="{{ route('books.edit', [$book->id]) }}" class="datatabel-links text-warning"
                       data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'datatabel-links text-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}

                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
