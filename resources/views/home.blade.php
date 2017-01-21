@extends(Auth::user() ? 'layouts.author' : 'layouts.guest')

@section('content')
    <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{ $title }}</h3>
    </div>
    <div class="panel-body">
        @if(!$posts->count())
            Belum ada tulisan, silakan {{ HTML::link('/login','masuk') }}.
        @else
            @foreach($posts as $post)
                <div class="list-group">
                    <div class="list-group-item list-group-item-info">
                        <h3><a href="{{ url('/show/'.$post->slug) }}">{{ $post->title }}</a>
                            @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
                                @if($post->active == '1')
                                    <a href="{{ url('edit/'.$post->slug)}}" class="btn btn-primary" style="float: right">Edit Artikel</a>
                                @else
                                    <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit Draft</a></button>
                                @endif
                            @endif
                        </h3>
                        {{--<a href="{{ url('/user/'.$post->author_id)}}"></a>--}}
                        <p>{{ $post->created_at->format('d M Y \p\u\k\u\l H:i') }} oleh {{ $post->author->name }}</p>
                    </div>
                    <div class="list-group-item">
                        <article>
                            {!! str_limit($post->body, $limit = 1500, $end = '....... <a href='.url("/".$post->slug).'>Read More</a>') !!}
                        </article>
                    </div>
                </div>
            @endforeach
            {!! $posts->render() !!}
        @endif
    </div>
</div>
@endsection
