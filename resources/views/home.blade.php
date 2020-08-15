@extends('layouts.app')

@section('content')
    <dashboard-component :dashboarddata="{{ $dashboardData }}"></dashboard-component>
@endsection
