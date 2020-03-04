@extends('layouts.app')

@section('content')
<div id="app">
    @csrf()
    <app :todos="{{ json_encode($todos) }}"></app>
</div>
@endsection