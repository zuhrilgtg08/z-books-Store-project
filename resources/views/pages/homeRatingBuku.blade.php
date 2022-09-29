@extends('layouts.main', ["title" => "Rating Book"])
@section('main-content')
    {{-- <h1>{{ auth()->user()->name }}</h1> --}}
    <h1>{{ auth()->user()->email }}</h1>
    <h1>{{ auth()->user()->number_phone }}</h1>
    <input type="text" value="{{ old('name', auth()->user()->name) }}" name="name">
@endsection