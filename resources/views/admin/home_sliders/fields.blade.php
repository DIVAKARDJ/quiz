<div class="row">
    <!-- Image Field -->
    <div class="form-group">
        <label>{{__('Image')}}</label>
        <div id="file-upload" class="section">
            <!--Default version-->
            <div class="row section">
                <div class="col-12">
                    <input name="image" type="file" id="input-file-now" class="dropify"
                           data-default-file="{{isset($homeSlider) && !empty($homeSlider->image) ? asset(path_common_image().$homeSlider->image) : ''}}"/>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Submit Field -->
<div class="row">
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary btn-block btn-add">Save</button>
    </div>
    <div class="col-md-2">
        <a href="{{ route('homeSliders.index') }}" class="btn btn-block btn-cancel">Cancel</a>
    </div>
</div>
