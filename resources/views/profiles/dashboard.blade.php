@extends('layouts.app')

@section('title', __('Admin Dashboard'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <ul class="nav nav-tabs" id="profileTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">{{ __( 'Posts' ) }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">{{ __( 'Settings' ) }}</a>
                </li>
            </ul>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="tab-content border-left border-right border-bottom bg-light p-3" id="profileTabContent">
                <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                    @foreach ($posts as $post)
                        <div class="row pb-4 align-items-center view">
                            <div class="col-md-3">
                                <a class="d-block" href="{{ route('profile', $post->user->login) }}">
                                    <small>{{ $post->user->dName() }}</small>
                                </a>
                                <strong>{{ $post->title }}</strong>

                                <div class="hover">
                                    <a href="{{ route('pShow', $post->id) }}">
                                        {{ __('View') }}
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <img src="{{ $post->getImageURL() }}" class="w-100">
                            </div>
                            <div class="col-md-6">
                                <p>{{ mb_strimwidth(strip_tags($post->content), 0, 200, '...') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                    <form method="POST" action="">
                        @csrf
                        @method('PATCH')

                        <div class="alert alert-danger" role="alert">
                            This functionality does not work yet
                        </div>

                        <div class="form-group">
                            <label for="site_language"class="col-form-label">{{ __('Website Language') }}</label>
                            <select class="form-control" id="site_language" name="site_language">
                                <option value="en">{{ __('English') }}</option>
                                <option value="ru">{{ __('Russian') }}</option>
                            </select>
                        </div>

                        <button disabled type="submit" class="btn btn-dark">{{ __('Save Changes') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
