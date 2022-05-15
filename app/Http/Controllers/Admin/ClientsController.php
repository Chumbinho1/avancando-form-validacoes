<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();

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
    public function store(ClientRequest $request)
    {
        $datas = $request->only(array_keys($request->rules()));
        $datas['defaulter'] = $request->has('defaulter');
        $datas['client_type'] = Client::getClientType($request->client_type);
        Client::create($datas);

        return redirect()->route('clients.index')->with('message', 'Cliente cadastrado com sucesso!');
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
    public function update(ClientRequest $request, Client $client)
    {
        $datas = $request->only(array_keys($request->rules()));
        $datas['defaulter'] = $request->has('defaulter');

        $client->fill($datas);
        $client->save();

        return redirect()->route('clients.index')->with('message', 'Cliente alterado com sucesso!');
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
        return redirect()->route('clients.index')->with('message', 'Cliente cadastrado com sucesso!');;
    }
}
