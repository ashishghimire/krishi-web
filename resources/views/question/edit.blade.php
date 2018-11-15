@extends('layouts.app')
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{route('home')}}">Home</a></li>
        <li><a href="{{route('question-set.index')}}">Question Sets</a></li>
        <li><a href="{{route('question-set.show', $question->questionSet)}}">Question Set
                - {{$question->questionSet->created_at->format('d.m.Y')}}</a></li>
        <li class="active">Edit Question</li>
    </ul>
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    {{--<div class="panel-heading">Edit Question</div>--}}
                    <div class="panel-body">
                        {!!Form::model($question, ['route' => ['question.update', $question], 'method'=>'PATCH', 'class'=>'form-horizontal'])!!}
                        @include('partials.question-form')
                        {!!Form::submit('Update')!!}
                        {!!Form::close()!!}
                        <input type="button" class = "btn btn-default" onclick="location.href='{{route('question-set.show', $question->questionSet)}}';" value="{{trans('cancel')}}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
