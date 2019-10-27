@extends('layouts.app')

@section('title', $user->dName())

@php
    $isMine = auth()->user()->login === $user->login
@endphp

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 pb-4">
            <img src="{{ $user->profile->getImageURL() }}" class="w-100 rounded-circle">
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-baseline">
                    <h1>{{ $user->dName() }}</h3>
                    <small class="ml-4">
                        {{ __('Posts: ') . $posts->count() }}
                        |
                        {{ __('Comments: ') . $user->comments->count() }}
                    </small>
                </div>
                @if ($isMine)
                    <small>
                        <a href="{{ route('pCreate') }}" data-toggle="modal" data-target="#settingPopUp">
                            {{ __('Edit profile') }}
                        </a>
                    </small>
                @endif
            </div>
            {!! $user->profile->bio !!}
        </div>
        @if ($isMine)
            <div class="col-12 pb-4">
                <a href="{{ route('pCreate') }}" class="btn btn-dark">{{ __('Add New') }}</a>
            </div>
        @endif

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

@if ($isMine)
    <div class="modal fade" id="settingPopUp" tabindex="-1" role="dialog" aria-labelledby="settingPopUpLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="settingPopUpLabel">{{ __('Edit your profile') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="user_settings_form" method="POST" action="{{ route('profileUpdate', $user->login) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="user_name"class="col-form-label">{{ __('Name') }}</label>
                            <input
                                id="user_name"
                                type="text"
                                class="form-control @error('user_name') is-invalid @enderror"
                                name="user_name"
                                value="{{ $user->profile->name }}"
                                autocomplete="user_name"
                                autofocus>

                            @error('user_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="user_bio" class="col-form-label">{{ __('Bio') }}</label>

                            <textarea
                                id="ckeditor"
                                class="form-control @error('user_bio') is-invalid @enderror"
                                name="user_bio"
                                rows="5"
                                autocomplete="user_bio"
                                autofocus
                            >
                                {{ $user->profile->bio }}
                            </textarea>

                            @error('user_bio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="user_avatar" class="col-form-label">{{ __('Avatar') }}</label>

                            <div class="custom-file">
                                <input
                                    id="user_avatar"
                                    type="file"
                                    name="user_avatar"
                                    class="custom-file-input @error('user_avatar') is-invalid @enderror"
                                    autocomplete="user_avatar"
                                    autofocus>
                                <label class="custom-file-label" for="user_avatar">{{ __('Choose file...') }}</label>
                            </div>

                            @error('user_avatar')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" form="user_settings_form" class="btn btn-primary">{{ __('Save changes') }}</button>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
