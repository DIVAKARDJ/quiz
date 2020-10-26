<div class="row">
    <!-- Paper Category Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('paper_category_id', 'Paper Category Id:') !!}
        {!! Form::select('paper_category_id', $paperCategory, null, ['class' => 'form-control']) !!}
    </div>

    <!-- Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Creator Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('creator_name', 'Creator Name:') !!}
        {!! Form::text('creator_name', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Paper Pdf Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('paper_pdf', 'Paper Pdf:') !!}
        <input name="paper_pdf" type="file" id="input-file-now" class="dropify"
               value="{{ isset($oldPaper) && !empty($oldPaper->paper_pdf) ? $oldPaper->paper_pdf : ''}}"
               data-default-file="{{isset($oldPaper) && !empty($oldPaper->paper_pdf) ? asset(path_paper_pdf().$oldPaper->paper_pdf) : ''}}"/>
        <div class="clearfix"></div>
    </div>

    <!-- Language Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('language', 'Language:') !!}
        {!! Form::select('language', ['Hindi' => 'Hindi', 'English' => 'English'], null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Submit Field -->
<div class="row">
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary btn-block btn-add">Save</button>
    </div>
    <div class="col-md-2">
        <a href="{{ route('oldPapers.index') }}" class="btn btn-block btn-cancel">Cancel</a>
    </div>
</div>
