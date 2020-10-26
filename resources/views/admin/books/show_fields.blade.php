<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $book->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $book->name }}</p>
</div>

<!-- Seller Name Field -->
<div class="form-group">
    {!! Form::label('seller_name', 'Seller Name:') !!}
    <p>{{ $book->seller_name }}</p>
</div>

<!-- Book Pdf Field -->
<div class="form-group">
    {!! Form::label('book_pdf', 'Book Pdf:') !!}
    <p>{{ $book->book_pdf }}</p>
</div>

<!-- Language Field -->
<div class="form-group">
    {!! Form::label('language', 'Language:') !!}
    <p>{{ $book->language }}</p>
</div>

<!-- Book Category Id Field -->
<div class="form-group">
    {!! Form::label('book_category_id', 'Book Category Id:') !!}
    <p>{{ $book->book_category_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $book->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $book->updated_at }}</p>
</div>

