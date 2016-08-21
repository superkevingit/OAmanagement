@extends('app')
@section('title')
    - {{ $user->name }}
    @endsection
@include('nav')

@section('content')
    {{ $user->name }}
    {{ $user->phone }}
    {{ $user->created_at }}
@endsection