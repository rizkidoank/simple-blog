@extends(Auth::user() ? 'layouts.author' : 'layouts.guest')
@section('content')
    <ul class="list-group">
        <li class="list-group-item list-group-item-info">
            <h2>{{ $post->title }}
                @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
                    <a href="{{ url('edit/'.$post->slug)}}" class="btn btn-primary" style="float: right">Edit Artikel</a>
                @endif
            </h2>
        </li>
    	<li class="list-group-item">
            @if($post)
                <article>
                    {!! $post->body !!}
                </article>
                <div class="panel panel-default">
                	  <div class="panel-body">
                          @if(Auth::guest())
                              <p>Login to Comment</p>
                          @else
                              <form action="/comment/add" method="post" role="form" id="comment" name="comment">
                              	<legend>Tinggalkan Komentar :</legend>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="on_post" value="{{ $post->id }}">
                                <input type="hidden" name="slug" value="{{ $post->slug }}">
                                <div class="form-group">
                                  <textarea required="required" placeholder="Silakan komentar disini..." id="body" name="body" class="form-control"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                              </form>
                          @endif
                	  </div>
                </div>
                <div>
                    @if($comments)
                        <ul style="list-style: none; padding: 0">
                            @foreach($comments as $comment)
                                <li class="panel-body">
                                    <div class="list-group">
                                        <div class="list-group-item">
                                            <h3>{{ $comment->author->name }}</h3>
                                            <p>{{ $comment->created_at->format('d M Y \p\u\k\u\l H:i') }}</p>
                                        </div>
                                        <div class="list-group-item">
                                            <p>{{ $comment->body }}</p>
                                        </div>
                                        @if(Auth::check() and $comment->from_user == Auth::user()->id)
                                            <div class="list-group-item">
                                                <a href="{{  url('/comment/delete/'.$comment->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Hapus Komentar</a>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @else
                404 error
            @endif
        </li>
    	<li class="list-group-item list-group-item-info">
            <p>{{ $post->created_at->format('d M Y \p\u\k\u\l H:i') }} oleh {{ $post->author->name }}</p>
        </li>
    </ul>
@endsection