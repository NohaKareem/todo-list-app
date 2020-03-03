@extends('layouts.app')

@section('content')
<div id="app">
    <app :todos="{{ json_encode($todos) }}"></app>
</div>
@endsection