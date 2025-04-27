<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JugadorController extends Controller
{
    public function index(Equipo $equipo)
    {
        $this->authorizeEquipo($equipo);

        $search = request('search');

        $jugadores = $equipo->jugadores()
            ->where('nombre', 'like', '%' . $search . '%')
            ->paginate(11);

        return view('jugadores.index', compact('equipo', 'jugadores'));
    }



    public function create(Equipo $equipo)
    {
        $this->authorizeEquipo($equipo);
        return view('jugadores.create', compact('equipo'));
    }

    public function store(Request $request, Equipo $equipo)
    {
        $this->authorizeEquipo($equipo);

        $request->validate([
            'nombre' => 'required',
            'edad' => 'required|integer',
            'posicion' => 'required',
        ]);

        $equipo->jugadores()->create($request->only(['nombre', 'edad', 'posicion']));

        return redirect()->route('jugadores.index', $equipo)->with('success', 'Jugador creado.');
    }

    public function edit(Equipo $equipo, Jugador $jugador)
    {
        $this->authorizeEquipo($equipo);
        return view('jugadores.edit', compact('equipo', 'jugador'));
    }

    public function update(Request $request, Equipo $equipo, Jugador $jugador)
    {
        $this->authorizeEquipo($equipo);

        $data = $request->validate([
            'nombre' => 'required',
            'edad' => 'required|integer',
            'posicion' => 'required',
        ]);

        $jugador->update($data);
        return redirect()->route('jugadores.index', $equipo)->with('success', 'Jugador actualizado.');
    }

    public function destroy(Equipo $equipo, Jugador $jugador)
    {
        $this->authorizeEquipo($equipo);
        $jugador->delete();
        return redirect()->route('jugadores.index', $equipo)->with('success', 'Jugador eliminado.');
    }

    protected function authorizeEquipo(Equipo $equipo)
    {
        if (Auth::id() !== $equipo->user_id) {
            abort(403, 'No tienes acceso a este equipo.');
        }
    }
}
