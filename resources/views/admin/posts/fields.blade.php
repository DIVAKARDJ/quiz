<div class="row">
    <!-- Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Submit Field -->
<div class="row">
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary btn-block btn-add">Save</button>
    </div>
    <div class="col-md-2">
        <a href="{{ route('posts.index') }}" class="btn btn-block btn-cancel">Cancel</a>
    </div>
</div>
