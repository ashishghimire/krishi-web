<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if(empty($questionSet))

                        <a href="{{route('question-set.create', ['form' => true])}}"><span
                                class="glyphicon glyphicon-plus"></span>
                            Add questions using Form</a>

                    @else
                        <a href="{{route('question-set.question.create', [$questionSet, 'form' => true])}}"><span
                                class="glyphicon glyphicon-plus"></span>
                            Add Questions to this set using Form</a>

                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<h1><p class="text-center">... or upload an excel file</p></h1>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if(!empty($questionSet))
                        {!! Form::open(['route' => ['question-set.question.store', $questionSet], 'class'=>'form-horizontal', 'files' => true]) !!}
                    @else
                        {!! Form::open(['route' => 'question-set.store', 'class'=>'form-horizontal', 'files' => true]) !!}
                    @endif
                    {!! Form::file('import') !!}
                    {!! Form::submit('Add question set', ['class'=>'btn btn-default']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
