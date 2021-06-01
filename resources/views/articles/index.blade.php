<title>Articles page</title>
@extends('templates.default')

@section('content')
    @if($articles->total() == 0)
        <div class="col-lg-5">
            <p>No articles found!</p>
        </div>
    @else
        @foreach($articles as $article)

            <div class="card mb-2" style="width: 35rem;">
                <img class="card-img-top" src="{{asset('images/1.jpeg')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><a
                            href="{{ route('articles.show', $article) }}">{{ $article->article_name }}</a></h5>
                    <p class="card-text">{{mb_substr($article->article_text, 0, 120) }}...</p>
                    <div class="data">Created: {{$article->created_at->diffForHumans()  }}</div>
                    <form method="POST" action="{{ route('articles.destroy', $article) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">del</button>
                        <a href="{{ route('articles.edit', $article) }}" class="btn btn-primary">upd</a>
                    </form>
                </div>
            </div>
            <style>
                th {
                    text-align: center;
                }

                .data {
                    text-align: right;
                }
            </style>
        @endforeach
    @endif
    {{ $articles->links() }}
@endsection
