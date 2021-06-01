@extends('templates.default')

@section('content')
        <p>{{ $article->article_name }}</p>
        <p>{{ $article->article_text }}</p>
@endsection
