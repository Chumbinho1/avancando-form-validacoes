@extends('Layouts.layout')

@section('content')
<h3 class=" text-dark text-opacity-50">Ver cliente</h3>
<hr>
<a href="{{ route('clients.edit', ['client' => $client->id]) }}" class="btn btn-sm btn-primary mb-3">Editar</a>
<a href="{{ route('clients.destroy', ['client' => $client->id]) }}" class="btn btn-sm btn-danger mb-3" onclick="event.preventDefault();if(confirm('Deseja mesmo excluir esse cliente')){document.getElementById('form-delete').submit();}">Excluir</a>
<form action="{{ route('clients.destroy', ['client' => $client->id]) }}" method="post" style="display: none;" id="form-delete">
    @csrf
    @method('DELETE')
</form>
<table class="table table-bordered">
    <tbody>
        <tr>
            <th scope="row">ID</th>
            <td>{{ $client->id }}</td>
        </tr>
        <tr>
            <th scope="row">Nome</th>
            <td>{{ $client->name }}</td>
        </tr>
        <tr>
            <th scope="row">CPF/CNPJ</th>
            <td>{{ $client->document_number }}</td>
        <tr>
            <th scope="row">Data Nascimento</th>
            <td>{{ $client->date_birth }}</td>
        </tr>
        <tr>
            <th scope="row">E-mail</th>
            <td>{{ $client->email }}</td>
        </tr>
        <tr>
            <th scope="row">Telefone</th>
            <td>{{ $client->phone }}</td>
        </tr>
        <tr>
            <th scope="row">Estado Civil</th>
            <td>
                @switch($client->marital_status)
                    @case(1)
                        Solteiro
                        @break
                    @case(2)
                        Casado
                        @break
                    @case(3)
                        Divorciado
                        @break
                @endswitch
            </td>
        </tr>
        <tr>
            <th scope="row">Sexo</th>
            <td>{{ $client->sex }}</td>
        </tr>
        <tr>
            <th scope="row">Deficiência Física</th>
            <td>{{ $client->physical_disability ? $client->physical_disability : 'Nenhuma' }}</td>
        </tr>
        <tr>
            <th scope="row">Inadimplente</th>
            <td>{{ $client->defaulter ? 'Sim' : 'Não' }}</td>
        </tr>
    </tbody>
</table>
@endsection