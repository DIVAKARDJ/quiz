<div class="row">
    <!-- Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Image Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('image', 'Image:') !!}
        <div id="file-upload" class="section">
            <!--Default version-->
            <div class="row section">
                <div class="col-12">
                    <input name="image" type="file" id="input-file-now" class="dropify"
                           data-default-file="{{isset($paperCategory) && !empty($paperCategory->image) ? asset(path_book_category_image().$paperCategory->image) : ''}}"/>
                </div>
            </div>
            <!--Default value-->
        </div>
    </div>

    <!-- Status Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('status', 'Status:') !!}
        {!! Form::select('status', active_statuses(), null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Submit Field -->
<div class="row">
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary btn-block btn-add">Save</button>
    </div>
    <div class="col-md-2">
        <a href="{{ route('paperCategories.index') }}" class="btn btn-block btn-cancel">Cancel</a>
    </div>
</div>
