@if($errors->any())

    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <span class="help-block"><p>{{$error}}</p></span>
        @endforeach
    </div>
@endif
{{ Form::hidden('form', 'true') }}

<div class="form-group">
    {!! Form::label('question', 'Question') !!}
    {!! Form::text('question', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('a', 'Option 1') !!}
    <div class="pull-right"><span>Answer</span>{{Form::radio('answer', 'a')}}</div>
    {!! Form::text('a', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('b', 'Option 2') !!}
    <div class="pull-right"><span>Answer</span>{{Form::radio('answer', 'b')}}</div>
    {!! Form::text('b', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('c', 'Option 3') !!}
    <div class="pull-right"><span>Answer</span>{{Form::radio('answer', 'c')}}</div>
    {!! Form::text('c', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('d', 'Option 4') !!}
    <div class="pull-right"><span>Answer</span>{{Form::radio('answer', 'd')}}</div>
    {!! Form::text('d', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('hint', 'Hint') !!}
    {!! Form::text('hint', null, ['class'=>'form-control']) !!}
</div>
