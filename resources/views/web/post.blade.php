@extends('layouts.app')
@section('content')
    <div class="container d-flex justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <h1> {{ $post->name }} </h1>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mt-2">
                            Categoría: 
                            <a href="{{ route('category', $post->category->slug) }}">
                                {{ $post->category->name }}
                            </a>
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($post->file)
                        <img src="{{$post->file}}" 
                            class="img-responsive card-img-top"
                            alt="{{ $post->name }}">
                        @endif
                        <p class="card-text mt-2">
                            {{ $post->excerpt }}
                        </p>
                        <hr>
                        {!! $post->body !!}
                        <hr>
                        Etiquetas
                        @foreach ($post->tags as $tag)
                            <a href=" {{ route('tag', $tag->slug) }} ">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
        </div>
    </div>
@endsection