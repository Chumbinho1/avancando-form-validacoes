@extends('Layouts.layout')

@section('content')
<h3 class=" text-dark text-opacity-50">Editar clientes</h3>
<hr>
@include('admin.form._form_errors')

<form action="{{ route('clients.update', ['client' => $client->id]) }}" method="post">
    @method('PUT')
    @include('admin.form._form')
    <input type="submit" value="Salvar" class="btn btn-primary">
</form>
@endsection