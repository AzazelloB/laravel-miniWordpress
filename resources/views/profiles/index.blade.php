@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <ul class="nav nav-tabs" id="profileTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="settings-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">{{ __( 'Posts' ) }}</a>
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
                        <a href="{{ URL::to('/p/create') }}" class="btn btn-dark">{{ __('Add New') }}</a>

                        <div class="row pt-4">
                            @foreach ($user->posts as $post)
                                <div class="col-4">
                                    <img src="/storage/uploads/{{ $post->image }}" class="w-100">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">Nope</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
