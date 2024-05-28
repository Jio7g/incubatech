<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\IncubationShareMail;

class IncubationClientController extends Controller
{
    public function index()
    {
        // Verificar si el usuario tiene el rol de Usuario, Administrador o SuperUsuario
        if (auth()->user()->rol === 'Usuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'SuperUsuario') {
            // Obtener solo los clientes que tienen al menos una incubación no finalizada
            $clientsWithIncubation = Client::whereHas('datosIncubacion', function ($query) {
                $query->where('estado', '!=', 'finalizado')
                ->with('catalogoTipo');
            })->with(['datosIncubacion' => function ($query) {
                $query->where('estado', '!=', 'finalizado');
            }])->get();

            // Generar el token para cada cliente
            $clientsWithIncubation->each(function ($client) {
                $client->token = sha1($client->id . $client->correo);
            });

            return view('incubation_clients.index', compact('clientsWithIncubation'));
        }

        abort(403, 'Acción no autorizada.');
    }

    public function show($clientId)
    {
        $client = Client::with(['datosIncubacion' => function ($query) {
            $query->where('estado', '!=', 'finalizado')->with('catalogoTipo');
        }])->findOrFail($clientId);
    
        //dd($client->datosIncubacion->toArray()); // Solo para debugging, remover después de verificar
    
        $incubations = $client->datosIncubacion;
    
        return view('incubation_clients.show', compact('client', 'incubations'));
    }
    
    

    public function showSharedIncubation($clientId, $token)
    {
        // Esta acción es accesible para todos los usuarios, no se requiere verificación de roles
        $client = Client::with('datosIncubacion')->findOrFail($clientId);

        // Verificar el token
        if ($token !== sha1($client->id . $client->correo)) {
            abort(403, 'Token inválido');
        }

        $incubations = $client->datosIncubacion;
        if ($incubations === null) {
            $incubations = collect();
        }

        // Generar el token único
        $token = sha1($client->id . $client->correo);
        // Generar el enlace único
        $shareUrl = route('incubations.shared', ['clientId' => $client->id, 'token' => $token]);

        Log::info('Antes de enviar el correo electrónico');
        // Envía el correo electrónico al cliente con el enlace generado
        Mail::to($client->correo)->send(new IncubationShareMail($client, $shareUrl));
        Log::info('Después de enviar el correo electrónico');

        return view('incubation_clients.shared', compact('client', 'incubations'));
    }

    public function generateShareLink($clientId)
    {
        // Verificar si el usuario tiene el rol de Usuario, Administrador o SuperUsuario
        if (auth()->user()->rol === 'Usuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'SuperUsuario') {
            $client = Client::findOrFail($clientId);

            // Generar el token único
            $token = sha1($client->id . $client->correo);
            // Generar el enlace único
            $shareUrl = route('incubations.shared', ['clientId' => $client->id, 'token' => $token]);

            // Envía el correo electrónico al cliente con el enlace generado
            Mail::to($client->correo)->send(new IncubationShareMail($client, $shareUrl));

            return response()->json(['shareUrl' => $shareUrl]);
        }

        abort(403, 'Acción no autorizada.');
    }
}
