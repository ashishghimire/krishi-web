@extends('layouts.app')
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{route('home')}}">Home</a></li>
        <li><a href="{{route('question-set.index')}}">Question Sets</a></li>
        <li class="active">Question Set - {{$questionSet->created_at->format('d-m-Y H:i')}}</li>
    </ul>
@stop
@section('actions')
    <div class="pull-right">
        <a href="{{route('question-set.question.create', $questionSet)}}"><span class="glyphicon glyphicon-plus"></span>
            Add Questions to this set</a>
    </div>
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    {{--<div class="panel-heading">Edit Question</div>--}}
                    <div class="panel-body">
                        <ul class="list-group">
                            @forelse($questions as $question)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span>{!! $question->question !!}</span>
                                            <a href="{{route('question.edit', $question)}}"
                                               class="glyphicon glyphicon-edit"
                                               style="text-decoration: none;"></a>
                                            <div class="pull-right">
                                                {{Form::open([ 'method'  => 'delete', 'route' => [ 'question.destroy', $question ], 'onsubmit' => 'return confirm("Are you sure ?")' ])}}
                                                {{ Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit']) }}
                                                {{ Form::close() }}
                                            </div>

                                        </div>
                                    </div>
                                    @if(!empty($question->hint))<div class="col-md-12"><p class="small">Hint: {!! $question->hint !!}</p></div> @endif
                                    <div class="row">
                                        <div class="col-md-6">

                                    <span
                                        style="color:{{$question->answer=='a'? 'green' : 'red'}}">{!! $question->a!!}</span>
                                        </div>
                                        <div class="col-md-6">
                                    <span
                                        style="color:{{$question->answer=='b'? 'green' : 'red'}}">{!!  $question->b !!}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                    <span
                                        style="color:{{$question->answer=='c'? 'green' : 'red'}}">{!! $question->c !!}</span>
                                        </div>
                                        <div class="col-md-6">
                                    <span
                                        style="color:{{$question->answer=='d'? 'green' : 'red'}}">{!! $question->d !!}</span>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <p>There are no questions in this set</p>
                            @endforelse
                        </ul>
                        {{$questions->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
