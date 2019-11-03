@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <img src="{{ $post->getImageURL() }}" class="card-img-top">

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">{{ $post->title }}</h3>
                        @if (auth()->user() && auth()->user()->login === $post->user->login)
                            <form action="{{ route('p.destroy', $post->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                
                                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                            </form>
                        @endif
                    </div>
                    <div class="card-text">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{ __('by') }}
                    <a href="{{ route('profile', $post->user->login) }}">{{ $post->user->dName() }}</a>
                </div>

                <div class="card-body">
                    @if ($post->comments->isEmpty())
                        <p>{{ __('Be the first to comment') }}</p>
                    @else
                        @foreach ($post->comments as $comment)
                            <div class="py-2">
                                <div class="d-flex justify-content-between align-items-baseline pb-1">
                                    <a href="{{ route('profile', $comment->user->login) }}">
                                        <small class="card-title">{{ $comment->user->dName() }}</small>
                                    </a>
                                    <small class="card-text text-muted">{{ $comment->created_at }}</small>
                                </div>
                                <div class="card-text">
                                    {{ $comment->content }}
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @guest
                        <div>
                            <strong><a href="{{ route('login') }}">{{ __('Login') }}</a></strong>
                            {{ __('to leave the comment') }}
                        </div>
                    @else
                        <form action="{{ route('comment', $post->id) }}" method="POST">
                            @csrf

                            <div class="input-group">
                                <input
                                    id="post_comment"
                                    type="text"
                                    class="form-control @error('post_comment') is-invalid @enderror"
                                    name="post_comment"
                                    value="{{ old('post_comment') }}"
                                    placeholder="{{ __('Comment..') }}"
                                    aria-label="{{ __('Comment..') }}"
                                    aria-describedby="sent-button">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text" id="sent-button">{{ __('Sent') }}</button>
                                </div>
                                @error('post_comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
