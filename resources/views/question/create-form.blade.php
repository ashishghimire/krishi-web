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
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    {{--<div class="panel-heading">Edit Question</div>--}}
                    <div class="panel-body">
                        {!!Form::open(['route' => ['question-set.question.store', $questionSet->id], 'class'=>'form-horizontal', 'method'=>'post'])!!}
                        @include('partials.question-form')
                        {!!Form::submit(trans('form.save-next'),['class' => 'btn btn-default', 'name' => 'submit'])!!}
                        {!! Form::submit(trans('form.save-close'), ['class' => 'btn btn-default', 'name' => 'submit']) !!}
                        {!!Form::close()!!}
                        <input type="button" class = "btn btn-default" onclick="location.href='{{route('question-set.show', $questionSet)}}';" value="{{trans('cancel')}}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
