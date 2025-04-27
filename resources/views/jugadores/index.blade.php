<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight">
            Jugadores de {{ $equipo->nombre }}
        </h2>
    </x-slot>

    <div class="py-6 text-white mx-36">
        <div class="flex items-start mb-4">
            <div class="mr-6">
                @if($equipo->logo)
                    <img src="{{ asset('storage/'.$equipo->logo) }}" alt="{{ $equipo->nombre }}" class="w-32 h-32 object-cover rounded-full mb-4">
                    <h3 class="text-xl font-bold text-white">
                        {{ $equipo->nombre }}
                    </h3>
                    <p class="text-base text-white">
                        {{ $equipo->pais }} 🌍
                    </p>
                    <p class="text-sm text-gray-400 mt-1">
                        Creado el {{ $equipo->created_at->format('d/m/Y') }}
                    </p>
                @else
                    <span class="text-gray-400">No hay logo disponible</span>
                @endif
            </div>

            <div class="flex flex-col gap-4">
                <a href="{{ route('dashboard') }}"
                   class="bg-gray-500 px-4 py-2 rounded hover:bg-gray-600 transition flex items-center">
                    🡄 Volver
                </a>

                <a href="{{ route('jugadores.create', $equipo) }}"
                   class="bg-pink-400 px-4 py-2 rounded hover:bg-pink-600 transition">
                    Añadir Jugador
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="text-green-400 mt-4">{{ session('success') }}</div>
        @endif

        <form method="GET" action="{{ route('jugadores.index', $equipo) }}" class="mb-6 flex gap-2">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="w-full max-w-lg px-4 py-2 rounded-lg text-gray-200 bg-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-400 placeholder-gray-300"
                placeholder="Buscar jugador por nombre"
                autocomplete="off"
            />

            <button
                type="submit"
                class="px-6 py-2 bg-pink-400 text-white rounded-lg shadow hover:bg-pink-700 transition">
                Buscar
            </button>

            <a href="{{ route('jugadores.index', $equipo) }}"
               class="px-6 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-700 transition">
                <i class="fas fa-times"></i> Limpiar
            </a>
        </form>

        <div class="overflow-x-auto mt-6 bg-gray-800 p-4 rounded-xl shadow-md">
            <table class="min-w-full table-auto text-left text-lg">
                <thead>
                <tr class="border-b border-white-600">
                    <th class="px-4 py-2 text-white">Nombre</th>
                    <th class="px-4 py-2 text-white">Posición</th>
                    <th class="px-4 py-2 text-white">Edad</th>
                    <th class="px-4 py-2 text-white text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($jugadores as $jugador)
                    <tr class="border-b border-gray-600">
                        <td class="px-4 py-2">{{ $jugador->nombre }}</td>
                        <td class="px-4 py-2">{{ $jugador->posicion }}</td>
                        <td class="px-4 py-2">{{ $jugador->edad }} años</td>
                        <td class="px-4 py-2">
                            <div class="flex gap-2 justify-center">
                                <a href="{{ route('jugadores.edit', [$equipo, $jugador]) }}"
                                   class="text-blue-300 hover:no-underline">Editar</a>

                                <form action="{{ route('jugadores.destroy', [$equipo, $jugador]) }}" method="POST"
                                      onsubmit="return confirm('¿Eliminar jugador?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-400 hover:no-underline" type="submit">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-6 text-center">
                {{ $jugadores->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
