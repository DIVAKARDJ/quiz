<!-- Id Field -->
<div class="form-group col-md-6">
    {!! Form::label('id', 'Id:',['class' => 'font-weight-bold']) !!}
    <p>{{ $oldPaper->id }}</p>
</div>


<!-- Paper Category Id Field -->
<div class="form-group col-md-6">
    {!! Form::label('paper_category_id', 'Paper Category Id:',['class' => 'font-weight-bold']) !!}
    <p>{{ $oldPaper->paper_category_id }}</p>
</div>

<!-- Book Pdf Field -->
<div class="form-group col-md-6">
    {!! Form::label('oldPaper_pdf', 'Book Pdf:',['class' => 'font-weight-bold']) !!}
    <p><a href="{{ asset(path_paper_pdf().$oldPaper->paper_pdf)
 }}" target="_blank">View</a></p>
</div>


<!-- Creator Name Field -->
<div class="form-group col-md-6">
    {!! Form::label('creator_name', 'Creator Name:',['class' => 'font-weight-bold']) !!}
    <p>{{ $oldPaper->creator_name }}</p>
</div>

<!-- Language Field -->
<div class="form-group col-md-6">
    {!! Form::label('language', 'Language:',['class' => 'font-weight-bold']) !!}
    <p>{{ $oldPaper->language }}</p>
</div>


<!-- Created At Field -->
<div class="form-group col-md-6">
    {!! Form::label('created_at', 'Created At:',['class' => 'font-weight-bold']) !!}
    <p>{{ $oldPaper->created_at }}</p>
</div>


<!-- Updated At Field -->
<div class="form-group col-md-6">
    {!! Form::label('updated_at', 'Updated At:',['class' => 'font-weight-bold']) !!}
    <p>{{ $oldPaper->updated_at }}</p>
</div>


