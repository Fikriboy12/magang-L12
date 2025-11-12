@extends('admin.auth.layout')

@section('content')
<div class="container mt-5">
    <h1>Selamat datang, {{ auth()->user()->name }}</h1>
    <p>Email: {{ auth()->user()->email }}</p>
    <a href="{{ url('/logout') }}" class="btn btn-danger">Logout</a>
</div>
@endsection
