@extends('layouts.app')

@section('content')
    <view-my-session-component :session="{{ $session }}"></view-my-session-component>
@endsection
