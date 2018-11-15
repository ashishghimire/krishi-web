@extends('layouts.app')
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{route('home')}}">Home</a></li>
        <li><a href="{{route('question-set.index')}}">Question Sets</a></li>
        <li class="active">Add Question Set</li>
    </ul>
@stop
@section('content')
    @include('partials.create-questions')
@stop
