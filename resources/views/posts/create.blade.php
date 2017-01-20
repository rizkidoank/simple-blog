@extends('layouts.author')
@section('header')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector:'textarea',
            plugins: "fullscreen",
        });</script>
    <style>
        div.mce-fullscreen {
            z-index: 1050;
        }
    </style>
@endsection
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $title }}</h3>
        </div>
        <div class="panel-body">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form action="/post/new" method="post" role="form">
                    {{ Form::token() }}
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input required="required" value="{{ old('title') }}" placeholder="Isi judul tulisan.." type="text" name = "title" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="body">Konten</label>
                        <textarea name='body'class="form-control" style="resize: vertical">{{ old('body') }}</textarea>
                    </div>
                    <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
                    <input type="submit" name='save' class="btn btn-default" value = "Save Draft" />
                </form>
            </div>
        </div>
    </div>
@endsection