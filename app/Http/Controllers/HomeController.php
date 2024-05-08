<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\IncubationData; // Importar el modelo IncubationData

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userCount = User::count();
        $clientCount = Client::count();
        $ongoingIncubationsCount = IncubationData::where('estado', 'en_proceso')->count();
        $completedIncubationsCount = IncubationData::where('estado', 'completada')->count();

        return view('home', compact('userCount', 'clientCount', 'ongoingIncubationsCount', 'completedIncubationsCount'));
    }
}
