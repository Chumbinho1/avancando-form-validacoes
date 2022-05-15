<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $clientType = Client::getClientType($this->client_type);
        $client = $this->route('client');
        $clientId = $client instanceof Client ? $client->id : null;
        $rules = [
            'name' => 'required|max:255',
            'document_number' => "required|unique:clients,document_number,$clientId|cpf_cnpj",
            'email' => 'required|email',
            'phone' => 'required',
        ];

        $maritalStatus = implode(',', array_keys(Client::MARITAL_STATUS));
        $sex = implode(',', Client::SEX);
        $rulesIndividual = [
            'date_birth' => 'required|date',
            'marital_status' => "required|in:$maritalStatus",
            'sex' => "required|in:$sex",
            'physical_disability' => 'max:255'
        ];

        $rulesLegal = [
            'company_name' => 'required|max:255'
        ];

        return $clientType == Client::TYPE_INDIVIDUAL ? $rules + $rulesIndividual : $rules + $rulesLegal;
    }
}
