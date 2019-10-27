@extends('layouts.app')

@section('title', __('Welcome'))

@section('content')
<div class="container">
    <div class="row justify-content-center text-center">
        <div class="col-md-6">
            <h1>{{ __('Welcome to the ') . config('app.name') }}</h1>
            <p>{{ __('This is Laravel training blog project. That was made only for purpose of learning the basics of Laravel framework.') }}</p>
        </div>
        <div class="col-12 mb-4">
            <nav class="justify-content-center navbar">
                <a href="{{ route('profiles') }}">{{ __('All Users') }}</a>
            </nav>
        </div>

        @if ($posts->isEmpty())
            <div class="col-12">
                <span>{{ __('There is no posts yet..') }}</span>
            </div>
        @else
            @foreach ($posts as $post)
                <div class="col-md-4 pb-4">
                    <div class="view view-img h-100">
                        <a href="{{ route('pShow', $post->id) }}">
                            <img src="{{ $post->getImageURL() }}" class="obj-cover">
                        </a>

                        <div class="hover d-flex justify-content-center align-items-center">
                            <div class="text-white">
                                {{ $post->title }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
