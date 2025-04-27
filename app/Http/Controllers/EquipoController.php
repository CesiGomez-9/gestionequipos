<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipoController extends Controller
{

    public function index(Request $request)
    {
        $query = Auth::user()->equipos()->withCount('jugadores')->latest();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                    ->orWhere('pais', 'like', "%{$search}%");
            });
        }

        $equipos = $query->paginate(9);

        return view('dashboard', compact('equipos'));
    }


    public function create()
    {
        return view('equipos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'pais' => 'required',
            'logo' => 'nullable|image|max:2048',
        ]);

        $path = $request->file('logo')?->store('logos', 'public');

        Auth::user()->equipos()->create([
            'nombre' => $request->nombre,
            'pais' => $request->pais,
            'logo' => $path,
        ]);

        return redirect()->route('dashboard')->with('success', 'Equipo creado.');
    }

    public function edit(Equipo $equipo)
    {
        if (Auth::id() !== $equipo->user_id) {
            return redirect()->route('dashboard')->with('error', 'No tienes permiso para editar este equipo.');
        }

        return view('equipos.edit', compact('equipo'));
    }

    public function update(Request $request, Equipo $equipo)
    {
        if (Auth::id() !== $equipo->user_id) {
            return redirect()->route('dashboard')->with('error', 'No tienes permiso para actualizar este equipo.');
        }

        $data = $request->validate([
            'nombre' => 'required',
            'pais' => 'required',
            'logo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $equipo->update($data);

        return redirect()->route('dashboard')->with('success', 'Equipo actualizado.');
    }

    public function destroy(Equipo $equipo)
    {
        if (Auth::id() !== $equipo->user_id) {
            return redirect()->route('dashboard')->with('error', 'No tienes permiso para eliminar este equipo.');
        }

        $equipo->delete();

        return redirect()->route('dashboard')->with('success', 'Equipo eliminado.');
    }
}
