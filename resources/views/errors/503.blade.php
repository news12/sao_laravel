@extends('errors::illustrated-layout')

@section('code', '503')
@section('title', __('Service Unavailable'))

@section('message', __($exception->getMessage() ?: __('Desculpe, estamos fazendo manutenção. Por favor, volte mais tarde.')))
