@csrf
<input type="hidden" name="client_type" value="{{ $clientType }}">
<div class="form-group mb-3">
    <label class="form-label" for="name"></label>
    <input type="text" name="name" placeholder="Nome" value="{{ old('name', $client->name) }}" class="form-control" id="name">
</div>

<div class="form-group mb-3">
    <label class="form-label" for="document_number">Documento</label>
    <input type="text" name="document_number" placeholder="Documento" value="{{ old('document_number', $client->document_number) }}" class="form-control" id="document_number">
</div>

<div class="form-group mb-3">
    <label class="form-label" for="email">E-mail</label>
    <input type="email" name="email" placeholder="E-mail" value="{{ old('email', $client->email) }}" class="form-control" id="email">
</div>

<div class="form-group mb-3">
    <label class="form-label" for="phone">Telefone</label>
    <input type="text" name="phone" placeholder="Telefone" value="{{ old('phone', $client->phone) }}" class="form-control" id="phone">
</div>

@if($clientType == \App\Models\Client::TYPE_INDIVIDUAL)
<div class="form-group mb-3">
    <label class="form-label" for="marital_status">Estado Civil</label>
    <select name="marital_status" class="form-control" id="marital_status">
        <option value="">Selecione o estado civil</option>
        <option value="1" {{ old('marital_status', $client->marital_status) === '1' ? 'selected' : '' }}>Solteiro</option>
        <option value="2" {{ old('marital_status', $client->marital_status) === '2' ? 'selected' : '' }}>Casado</option>
        <option value="3" {{ old('marital_status', $client->marital_status) === '3' ? 'selected' : '' }}>Divorciado</option>
    </select>
</div>

<div class="form-group mb-3">
    <label class="form-label" for="date_birth">Data de Nascimento</label>
    <input type="date" name="date_birth" value="{{ old('date_birth', $client->date_birth) }}" class="form-control" id="date_birth">
</div>

<div class="radio mb-3">
    <label class="form-label">
        <input type="radio" name="sex" value="m" {{ old('sex', $client->sex) === 'm' ? 'checked' : '' }}> Masculino
    </label>
</div>
<div class="radio mb-3">
    <label class="form-label">
        <input type="radio" name="sex" value="f" {{ old('sex', $client->sex) === 'f' ? 'checked' : '' }}> Feminino
    </label>
</div>

<div class="form-group mb-3">
    <label class="form-label" for="physical_disability">Deficiência Física</label>
    <input type="text" name="physical_disability" placeholder="Deficiência Física" value="{{ old('physical_disability', $client->physical_disability) }}" class="form-control" id="physical_disability">
</div>
@else
<div class="form-group mb-3">
    <label class="form-label" for="company_name">Nome Fantasia</label>
    <input type="text" name="company_name" placeholder="Nome Fantasia" value="{{ old('company_name', $client->company_name) }}" class="form-control" id="company_name">
</div>
@endif

<div class="checkbox mb-3">
    <label class="form-label">
        <input type="checkbox" name="defaulter" id="defaulter" {{ old('defaulter', $client->defaulter) ? 'checked' : '' }}> Inadimplente?
    </label>
</div>