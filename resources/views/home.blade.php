@extends('layouts.app')

@section('content')
    <status-component></status-component>
    <dashboard-component :dashboarddata="{{ $dashboardData }}"></dashboard-component>
    {{-- <add-session-component></add-session-component> --}}
@endsection
