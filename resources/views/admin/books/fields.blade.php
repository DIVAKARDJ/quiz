<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Seller Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('seller_name', 'Seller Name:') !!}
    {!! Form::text('seller_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Book Pdf Field -->
<div class="form-group col-sm-6">
    {!! Form::label('book_pdf', 'Book Pdf:') !!}
    {!! Form::file('book_pdf') !!}
</div>
<div class="clearfix"></div>

<!-- Language Field -->
<div class="form-group col-sm-6">
    {!! Form::label('language', 'Language:') !!}
    {!! Form::select('language', ['Hindi' => 'Hindi', 'English' => 'English'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.books.index') }}" class="btn btn-default">Cancel</a>
</div>
