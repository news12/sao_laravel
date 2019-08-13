@extends('errors::illustrated-layout')

@section('code', '403')
@section('title', __('Forbidden'))

@section('message', __($exception->getMessage() ?: __('Desculpe, você está proibido de acessar esta página.')))
