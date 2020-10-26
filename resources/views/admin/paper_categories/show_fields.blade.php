<!-- Id Field -->
<div class="form-group col-md-6">
    {!! Form::label('id', 'Id:',['class' => 'font-weight-bold']) !!}
    <p>{{ $paperCategory->id }}</p>
</div>


<!-- Name Field -->
<div class="form-group col-md-6">
    {!! Form::label('name', 'Name:',['class' => 'font-weight-bold']) !!}
    <p>{{ $paperCategory->name }}</p>
</div>


<!-- Image Field -->
<div class="form-group col-md-6">
    {!! Form::label('image', 'Image:',['class' => 'font-weight-bold']) !!}
    @if($paperCategory->image)
        <img class="datatable-img"
             src="{{ asset(path_category_image().$paperCategory->image) }}"
             alt="no image"/>
    @else
        N/A
    @endif
</div>


<!-- Status Field -->
<div class="form-group col-md-6">
    {!! Form::label('status', 'Status:',['class' => 'font-weight-bold']) !!}
    <p><span @if($paperCategory->status == 1) class="text-success"
             @else class="text-danger" @endif>{{ statusType($paperCategory->status) }}</span></p>
</div>


<!-- Created At Field -->
<div class="form-group col-md-6">
    {!! Form::label('created_at', 'Created At:',['class' => 'font-weight-bold']) !!}
    <p>{{ $paperCategory->created_at }}</p>
</div>


<!-- Updated At Field -->
<div class="form-group col-md-6">
    {!! Form::label('updated_at', 'Updated At:',['class' => 'font-weight-bold']) !!}
    <p>{{ $paperCategory->updated_at }}</p>
</div>


