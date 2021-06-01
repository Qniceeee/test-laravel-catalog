<title>Home Page</title>
@extends('templates.default')

@section('content')
    @if($articles->total() == 0)
        <div class="col-lg-5">
            <p>No articles found!</p>
        </div>
    @else
        @foreach($articles as $article)
            <div class="container">

                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">

                            <a href="{{ route('articles.show', $article) }}">{{ $article->article_name }}</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">{{mb_substr($article->article_text, 0, 500)  }}</th>
                    </tr>
                    </tbody>
                    <tbody>
                    <tr>
                        <th scope="row"><div class="data">Created:  {{$article->created_at->diffForHumans()  }}</div></th>
                    </tr>
                    </tbody>
                </table>
            </div>
            <style>
                th {
                    text-align: center;
                }
                .data {
                    text-align: right;
                }
                .instruments{
                    font-size: small;
                    text-align: right;
                }
            </style>
        @endforeach
    @endif
    {{ $articles->links() }}
@endsection
