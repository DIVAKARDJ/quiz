<!-- Id Field -->
<div class="form-group col-md-6">
    {!! Form::label('id', 'Id:',['class' => 'font-weight-bold']) !!}
    <p>{{ $homeSlider->id }}</p>
</div>


<!-- Image Field -->
<div class="form-group col-md-6">
    {!! Form::label('image', 'Image:',['class' => 'font-weight-bold']) !!}
    @if($homeSlider->image)
        <a href="{{ asset(path_common_image().$homeSlider->image)}}"
           target="_blank">
            <img class="img-fluid" src="{{ asset(path_common_image().$homeSlider->image) }}"
                 alt="no image"/>
        </a>
    @else
        N/A
    @endif
</div>


<!-- Created At Field -->
<div class="form-group col-md-6">
    {!! Form::label('created_at', 'Created At:',['class' => 'font-weight-bold']) !!}
    <p>{{ $homeSlider->created_at }}</p>
</div>


<!-- Updated At Field -->
<div class="form-group col-md-6">
    {!! Form::label('updated_at', 'Updated At:',['class' => 'font-weight-bold']) !!}
    <p>{{ $homeSlider->updated_at }}</p>
</div>


