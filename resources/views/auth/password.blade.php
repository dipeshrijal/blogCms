@extends('layouts.auth')


@section('title' , 'Forgot Password')

@section('heading', 'Please provide your email for password link')		

@section('content')

{!! Form::open() !!}

<div class="form-group">
	{!! Form::label('email') !!}
	{!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit("Send Reset Password Link", ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@endsection