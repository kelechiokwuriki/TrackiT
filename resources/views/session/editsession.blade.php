@extends('layouts.app')

@section('content')
    <edit-session-component :sessiontoedit="{{ $session }}"></edit-session-component>
@endsection
