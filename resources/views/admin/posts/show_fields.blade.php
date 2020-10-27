<!-- Name Field -->
<div class="form-group col-md-6">
    {!! Form::label('name', 'Name:',['class' => 'font-weight-bold']) !!}
    <p>{{ $post->name }}</p>
</div>


<!-- Created At Field -->
<div class="form-group col-md-6">
    {!! Form::label('created_at', 'Created At:',['class' => 'font-weight-bold']) !!}
    <p>{{ $post->created_at }}</p>
</div>


<!-- Updated At Field -->
<div class="form-group col-md-6">
    {!! Form::label('updated_at', 'Updated At:',['class' => 'font-weight-bold']) !!}
    <p>{{ $post->updated_at }}</p>
</div>


<!-- Id Field -->
<div class="form-group col-md-6">
    {!! Form::label('id', 'Id:',['class' => 'font-weight-bold']) !!}
    <p>{{ $post->id }}</p>
</div>


