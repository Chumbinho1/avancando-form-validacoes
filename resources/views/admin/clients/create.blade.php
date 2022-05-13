@extends('Layouts.layout')

@section('content')
<h3 class=" text-dark text-opacity-50">Novo cliente</h3>
<h5 class=" text-dark text-opacity-25">{{ $clientType == \App\Models\Client::TYPE_INDIVIDUAL ? 'Pessoa Física' : 'Pessoa Jurídica' }}</h5>
<div class="d-flex justify-content-end">
    <a class="btn btn-sm btn-primary me-3" href="{{ route('clients.create', ['client_type' => \App\Models\Client::TYPE_INDIVIDUAL]) }}">Pessoa Física</a>
    <a class="btn btn-sm btn-secondary" href="{{ route('clients.create', ['client_type' => \App\Models\Client::TYPE_LEGAL]) }}">Pessoa Jurídica</a>
</div>
<hr>

@include('admin.form._form_errors')

<form action="{{route('clients.store')}}" method="post">
    @include('admin.form._form')

    <input type="submit" value="Criar" class="btn btn-primary mb-3">
</form>
@endsection