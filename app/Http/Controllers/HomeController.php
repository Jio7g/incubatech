<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\IncubationData;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Verificar si el usuario tiene el rol de Usuario, Administrador o SuperUsuario
        if (auth()->user()->rol === 'Usuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'SuperUsuario') {
            $userCount = User::count();
            $clientCount = Client::count();
            $ongoingIncubationsCount = IncubationData::where('estado', 'en_proceso')->count();
            $completedIncubationsCount = IncubationData::where('estado', 'completada')->count();

            return view('home', compact('userCount', 'clientCount', 'ongoingIncubationsCount', 'completedIncubationsCount'));
        }

        abort(403, 'Acción no autorizada.');
    }
}
