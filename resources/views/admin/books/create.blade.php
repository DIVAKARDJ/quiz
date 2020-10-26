@extends('layout.master')

@section('main-body')
    <section class="content-header">
        <h1>
            Book
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'books.store', 'files' => true]) !!}

                        @include('admin.books.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
