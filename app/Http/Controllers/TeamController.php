<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    public function index(Team $team)
    {
        return view('teams.index')->with(['posts' => $team->getByTeam()]);
    }
}
