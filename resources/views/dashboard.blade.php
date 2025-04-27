<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight">
            {{ __('Mis Equipos') }}
        </h2>
    </x-slot>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 text-white">
        <a href="{{ route('equipos.create') }}"
           class="mb-6 inline-block bg-pink-400 text-white px-6 py-3 rounded-lg text-lg font-semibold shadow hover:bg-pink-700 transition">
            ⚽ Nuevo Equipo
        </a>
        <form method="GET" action="{{ route('dashboard') }}" class="mb-6 flex gap-2">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="w-full max-w-lg px-4 py-2 rounded-lg text-gray-200 bg-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-400 placeholder-gray-300"
                placeholder="Buscar equipo por nombre o país"
                autocomplete="off"
            >
            <button
                type="submit"
                class="px-6 py-2 bg-pink-400 text-white rounded-lg shadow hover:bg-pink-700 transition">
                Buscar
            </button>

            <a href="{{ route('dashboard') }}"
               class="px-6 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-700 transition">
                <i class="fas fa-times"></i> Limpiar
            </a>
        </form>

        @if(session('success'))
            <div class="mb-4 text-green-400 text-lg font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($equipos as $equipo)
                <div class="bg-gray-800 p-6 rounded-xl shadow hover:shadow-xl transition">
                    <div class="flex items-center gap-4">
                        @if ($equipo->logo)
                            <img src="{{ asset('storage/' . $equipo->logo) }}"
                                 class="w-20 h-20 object-cover rounded-full shadow-md"
                                 alt="Logo {{ $equipo->nombre }}">
                        @endif
                        <div>
                            <h3 class="text-xl font-bold text-white">
                                {{ $equipo->nombre }}
                            </h3>
                            <p class="text-base text-white">
                                País: {{ $equipo->pais }} 🌍
                            </p>
                            <p class="text-sm text-white mt-2">
                                Jugadores: {{ $equipo->jugadores_count }}
                            </p>
                            <p class="text-sm text-gray-400 mt-1">
                                Creado el {{ $equipo->created_at->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-5 flex justify-between items-center text-base space-x-2">
                        <a href="{{ route('equipos.edit', $equipo) }}"
                           class="bg-gray-500 text-white px-5 py-2 rounded hover:bg-pink-700 transition">
                            Editar
                        </a>

                        <a href="{{ route('jugadores.index', $equipo) }}"
                           class="bg-gray-500 text-white px-5 py-2 rounded hover:bg-pink-700 transition">
                            Ver Jugadores
                        </a>

                        <form action="{{ route('equipos.destroy', $equipo) }}" method="POST"
                              onsubmit="return confirm('¿Estás seguro de eliminar este equipo?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-gray-500 text-white px-5 py-2 rounded hover:bg-pink-700 transition">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-white text-center col-span-full text-xl">
                    No tienes equipos creados.
                </p>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $equipos->links() }}
        </div>
    </div>
</x-app-layout>
