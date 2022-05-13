@extends('Layouts.layout')

@section('content')
<h3 class=" text-dark text-opacity-50">Listagem de clientes</h3>
<hr>
<a href="{{ route('clients.create') }}" class="btn btn-sm btn-primary mb-3"> Novo Cliente</a>
<table class="table">
    <thead>
        <tr class="table-dark">
            <th>ID</th>
            <th>Nome</th>
            <th>CPF/CNPJ</th>
            <th>Data Nascimento</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Sexo</th>
            <th>Ação</th>
        </tr>
    <tbody>
        @foreach($clients as $client)
        <tr>
            <td>{{ $client->id }}</td>
            <td>{{ $client->name }}</td>
            <td>{{ $client->document_number }}</td>
            <td>{{ $client->date_birth }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->phone }}</td>
            <td>{{ $client->sex }}</td>
            <td>
                <a class="btn btn-sm btn-warning" href="{{ route('clients.edit', ['client' => $client->id]) }}">Editar</a>
                <a class="btn btn-sm btn-info" href="{{ route('clients.show', ['client' => $client->id]) }}">Ver</a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </thead>
</table>
@endsection