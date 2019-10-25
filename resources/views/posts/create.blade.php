@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Post') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ URL::to('/p') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="post_title" class="col-form-label">{{ __('Post Title') }}</label>

                            <input id="post_title" type="text" class="form-control @error('post_title') is-invalid @enderror" name="post_title" value="{{ old('post_title') }}" autocomplete="post_title" autofocus>

                            @error('post_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="post_content" class="col-form-label">{{ __('Post Title') }}</label>

                            <textarea
                                id="post_content"
                                class="form-control @error('post_content') is-invalid @enderror"
                                name="post_content"
                                value="{{ old('post_content') }}"
                                rows="5"
                                autocomplete="post_content"
                                autofocus>
                            </textarea>

                            @error('post_content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="post_image" class="col-form-label">{{ __('Post Image') }}</label>

                            <div class="custom-file">
                                <input id="post_image" type="file" name="post_image" class="custom-file-input @error('post_image') is-invalid @enderror" value="{{ old('post_image') }}" autocomplete="post_image" autofocus>
                                <label class="custom-file-label" for="post_image">{{ __('Choose file...') }}</label>
                            </div>

                            @error('post_image')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-dark">
                                {{ __('Post It') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
