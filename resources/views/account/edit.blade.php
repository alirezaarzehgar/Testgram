@extends('layouts.profile')

@section('method')
    @method('put')
@endsection

@section('route')
    {{ route('account.update', ['account' => $user->id]) }}
@endsection

@section('profile-attrs')
@endsection

@section('username-attrs')
@endsection
