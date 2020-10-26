<div class="row">

    <div class="form-group col-sm-6">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control','required']) !!}
    </div>

    <!-- Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('name', 'Book Caetgory:') !!}
        {!! Form::select('book_category_id', $bookCategory,null, ['id'=>'bookCatId','class' => 'form-control','placeholder' => 'Select Book Category','required']) !!}
    </div>


    <!-- Seller Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('seller_name', 'Seller Name:') !!}
        {!! Form::text('seller_name', null, ['class' => 'form-control','required']) !!}
    </div>

    <!-- Book Pdf Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('book_pdf', 'Book Pdf:') !!}
        <input name="book_pdf" type="file" id="input-file-now" class="dropify"
               value="{{ isset($book) && !empty($book->book_pdf) ? $book->book_pdf : ''}}"
               data-default-file="{{isset($book) && !empty($book->book_pdf) ? asset(path_book_category_image().$book->book_pdf) : ''}}"/>
    </div>
    <div class="clearfix"></div>

    <!-- Language Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('language', 'Language:') !!}
        {!! Form::select('language', ['Hindi' => 'Hindi', 'English' => 'English'], null, ['class' => 'form-control','required']) !!}
    </div>
</div>

<!-- Submit Field -->
<div class="row">
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary btn-block btn-add">Save</button>
    </div>
    <div class="col-md-2">
        <a href="{{ route('books.index') }}" class="btn btn-block btn-cancel">Cancel</a>
    </div>
</div>
