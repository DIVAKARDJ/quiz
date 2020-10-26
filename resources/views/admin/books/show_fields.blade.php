<!-- Id Field -->
<div class="form-group col-md-6">
    {!! Form::label('id', 'Id:',['class' => 'font-weight-bold']) !!}
    <p>{{ $book->id }}</p>
</div>


<!-- Name Field -->
<div class="form-group col-md-6">
    {!! Form::label('name', 'Name:',['class' => 'font-weight-bold']) !!}
    <p>{{ $book->name }}</p>
</div>


<!-- Seller Name Field -->
<div class="form-group col-md-6">
    {!! Form::label('seller_name', 'Seller Name:',['class' => 'font-weight-bold']) !!}
    <p>{{ $book->seller_name }}</p>
</div>


<!-- Book Pdf Field -->
<div class="form-group col-md-6">
    {!! Form::label('book_pdf', 'Book Pdf:',['class' => 'font-weight-bold']) !!}
    <p><a href="{{ asset(path_book_pdf().$book->book_pdf)
 }}" target="_blank">View</a></p>
</div>


<!-- Language Field -->
<div class="form-group col-md-6">
    {!! Form::label('language', 'Language:',['class' => 'font-weight-bold']) !!}
    <p>{{ $book->language }}</p>
</div>


<!-- Book Category Id Field -->
<div class="form-group col-md-6">
    {!! Form::label('book_category_id', 'Book Category Id:',['class' => 'font-weight-bold']) !!}
    <p>{{ $book->book_category_id }}</p>
</div>


