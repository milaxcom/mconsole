@extends('mconsole::app')

@section('content')

@include('mconsole::partials.table', [
    'add' => $add,
])

@endsection