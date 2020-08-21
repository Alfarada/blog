@extends('layouts.app')
@section('content')
    <div class="container d-flex justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <h1> {{ $post->name }} </h1>
                <div class="card mb-3">
                    @if($post->file)
                        <img src="{{$post->file}}" 
                            class="img-responsive card-img-top"
                            alt="{{ $post->name }}">
                    @endif
                    <div class="card-body">
                        <h4 class="card-title"> Categoría
                            <a href="{{ $post->category->name }}"></a>
                        </h4>
                        <p class="card-text">
                            {{ $post->excerpt }}
                        </p>
                        <hr>
                        {!! $post->body !!}
                        <hr>
                        Etiquetas
                        @foreach ($post->tags as $tag)
                            <a href="">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>
        </div>
    </div>
@endsection