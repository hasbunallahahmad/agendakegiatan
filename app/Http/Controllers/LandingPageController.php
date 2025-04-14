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
            ->orderBy('start_date')
            ->get();

        $upcomingAgendas = Agenda::published()
            ->upcoming()
            ->orderBy('start_date')
            ->limit(5)
            ->get();

        return view('landing', compact('todayAgendas', 'upcomingAgendas'));
    }
}
