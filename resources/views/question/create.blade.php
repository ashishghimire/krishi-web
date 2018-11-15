@extends('layouts.app')
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{route('home')}}">Home</a></li>
        <li><a href="{{route('question-set.index')}}">Question Sets</a></li>
        <li><a href="{{route('question-set.show', $questionSet->id)}}">Question Set
                - {{$questionSet->created_at->format('d-m-Y H:i')}}</a></li>
        <li class="active">Add Question To The Question Set - {{$questionSet->created_at->format('d-m-Y H:i')}}</li>
    </ul>
@stop
@section('content')
    @include('partials.create-questions', ['questionSet' => $questionSet])
@stop
