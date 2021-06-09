<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $course->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $course->description }}</p>
</div>

<!-- Amount Field -->
<div class="col-sm-12">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $course->amount }}</p>
</div>

<!-- Hours Field -->
<div class="col-sm-12">
    {!! Form::label('hours', 'Hours:') !!}
    <p>{{ $course->hours }}</p>
</div>

