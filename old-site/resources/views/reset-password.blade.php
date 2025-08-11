@extends('layouts.master')
@section('meta_keywords', '')
@section('meta_description', '')
@section('meta_title', '')

@section('content')

<div class="container reset_password_container">
<div class="row justify-content-center bravo-login-form-page bravo-login-page">
<div class="col-md-8">
<div class="card">
<div class="card-header change_pass_card_head">Reset Password</div>
<div class="card-body" style="padding:3%;">

@if(session('message'))

<div class="text-success text-center" role="alert">
 {{ session('message') }}
</div>
@else



@endif
<form method="POST" action="{{ url('/reset-password')}}">
    @csrf
<div class="col-md-12">
<input id="email" type="email" class="form-control @error('email') is-invalid @enderror"  name="email" id="email" value="{{ old('email') }}" required="" placeholder="Email">
@error('email')

        <span class="invalid-feedback" role="alert">

        <strong>{{ $message }}</strong>

        </span>

@enderror
</div>
</div>

<div class="form-group mb-0" style="padding-bottom:3%;">
<div class="col-md-6 offset-md-4">
<button type="submit" class="btn reset_password_btn">
Send Password Reset Link
</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>

@endsection
