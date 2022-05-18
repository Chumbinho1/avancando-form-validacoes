<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(1);

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $clientType = Client::getClientType($request->client_type);
        return view('admin.clients.create', ['client' => new Client(), 'clientType' => $clientType]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datas = $this->_validate($request);
        $datas['defaulter'] = $request->has('defaulter');
        $datas['client_type'] = Client::getClientType($request->client_type);
        Client::create($datas);

        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $clientType = $client->client_type;
        return view('admin.clients.edit', compact('client', 'clientType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $datas = $this->_validate($request);

        $datas['defaulter'] = $request->has('defaulter');

        $client->fill($datas);
        $client->save();

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index');
    }

    protected function _validate(Request $request)
    {
        $clientType = Client::getClientType($request->client_type);
        $client = $request->route('client');
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

        return $this->validate($request, $clientType == Client::TYPE_INDIVIDUAL ? $rules + $rulesIndividual : $rules + $rulesLegal);
    }
}
