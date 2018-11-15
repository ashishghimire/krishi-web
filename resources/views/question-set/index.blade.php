@extends('layouts.app')
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{route('home')}}">Home</a></li>
        <li class="active">Question Sets</li>
    </ul>
@stop
@section('actions')
    <div class="pull-right">
        <a href="{{route('question-set.create')}}"><span class="glyphicon glyphicon-plus"></span> Add Question Set</a>
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
                            @forelse($questionSets as $questionSet)
                                <li class="list-group-item"><a
                                        href="{{route('question-set.show', $questionSet->id)}}"> {{$questionSet->created_at->format('d-m-Y H:i')}}</a>
                                    <div class="pull-right">
                                        {{Form::open([ 'method'  => 'delete', 'route' => [ 'question-set.destroy', $questionSet ], 'onsubmit' => 'return confirm("Are you sure? All question in this set will be destroyed")' ])}}
                                        {{ Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit']) }}
                                        {{ Form::close() }}
                                    </div>
                                </li>
                            @empty
                                <div>No question sets</div>
                            @endforelse
                        </ul>
                        {{ $questionSets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
