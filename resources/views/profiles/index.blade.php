@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if ($users->isEmpty())
            <div class="col-12">
                <span>{{ __('There is no users yet..') }}</span>
            </div>
        @else
            @foreach ($users as $user)
                <div class="row py-4">
                    <div class="col-md-3 text-center">
                        <img src="{{ $user->profile->getImageURL() }}" alt="avatar" class="w-100 rounded-circle">
                        <h3 class="pt-3"><a href="{{ route('profile', $user->login) }}">{{ $user->dName() }}</a></h3>
                        <small>
                            {{ __('Posts: ') . $user->posts->count() }}
                            |
                            {{ __('Comments: ') . $user->comments->count() }}
                        </small>
                    </div>
                    <div class="col-md-9">
                        {!! $user->profile->bio ?? __('No bio') !!}
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
