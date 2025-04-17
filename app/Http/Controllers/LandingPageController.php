<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $todayAgendas = Agenda::published()
            ->today()
            ->with('bidang')
            ->orderBy('start_date')
            ->get();

        $upcomingAgendas = Agenda::published()
            ->upcoming()
            ->with('bidang')
            ->orderBy('start_date')
            ->limit(15)
            ->get();

        return view('landing', compact('todayAgendas', 'upcomingAgendas'));
    }
}
