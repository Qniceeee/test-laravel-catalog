<title>Create Article page</title>
@extends('templates.default')

@section('content')
    <p>Create new article!</p>

    <form method="post" action="{{ route('articles.store') }}">
        @csrf
        <div class="form-group">
            <label for="article_name">Article name</label>
            <input type="text"
                   class="form-control {{ $errors->has('article_name') ? ' is-invalid' : "" }}"
                   id="article_name"
                   name="article_name"
                   placeholder="Enter article name"
                   value="{{Request::old('article_name')}}"
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
            >{{Request::old('article_text')}}</textarea>
            @if($errors->has('article_text'))
                <span class="help-block text-danger">
                    {{$errors->first('article_text')}}
                </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary mt-1">Send</button>
    </form>
@endsection
