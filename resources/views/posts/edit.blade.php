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
                <form action="/post/update" method="post" role="form">
                    {{ Form::token() }}
                    <input type="hidden" name="post_id" value="{{ $post->id }}{{ old('post_id') }}">
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input required="required" placeholder="Isi judul tulisan.." type="text" name = "title" class="form-control" value = "@if(!old('title')){{$post->title}}@endif{{ old('title') }}" />
                    </div>
                    <div class="form-group">
                        <label for="body">Konten</label>
                        <textarea name='body'class="form-control" style="resize: vertical">
                            @if(!old('body'))
                                {!! $post->body !!}
                            @endif
                            {!! old('body') !!}
                        </textarea>
                    </div>
                    @if($post->active == '1')
                        <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
                    @else
                        <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
                    @endif
                    <input type="submit" name='save' class="btn btn-default" value = "Save As Draft" />
                    <a href="{{  url('delete/'.$post->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Delete</a>
                </form>
            </div>
        </div>
    </div>
    @endsection