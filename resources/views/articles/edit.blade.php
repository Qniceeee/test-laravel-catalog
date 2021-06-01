<title>Update Article page</title>
@extends('templates.default')

@section('content')
    <p>Edit article </p>

    <form method="post" action="{{ route('articles.update', $article) }}">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="article_name">Article name</label>
            <input type="text"
                   class="form-control {{ $errors->has('article_name') ? ' is-invalid' : "" }}"
                   id="article_name"
                   name="article_name"
                   placeholder="Enter article name"
                   value="{{ $article->article_name }}"
            >
            @if($errors->has('article_name'))
                <span class="help-block text-danger">
                    {{$errors->first('article_name')}}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="article_text">Article Text</label>
            <textarea
                class="form-control{{ $errors->has('article_text') ? ' is-invalid' : "" }}"
                id="article_text"
                name="article_text"
                rows="3"
                placeholder="Enter article text"
            >{{ $article->article_text }}</textarea>
            @if($errors->has('article_text'))
                <span class="help-block text-danger">
                    {{$errors->first('article_text')}}
                </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary mt-1">Update</button>
    </form>
@endsection
