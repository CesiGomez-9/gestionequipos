<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight">
            Editar Jugador de {{ $equipo->nombre }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('jugadores.update', [$equipo, $jugador]) }}" class="bg-white dark:bg-gray-800 p-6 rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $jugador->nombre) }}" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-700 dark:text-white" required>
                @error('nombre') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Edad</label>
                <input type="number" name="edad" value="{{ old('edad', $jugador->edad) }}" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-700 dark:text-white" required>
                @error('edad') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Posición</label>
                <select name="posicion" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-700 dark:text-white" required>
                    <option value="">Selecciona una opción</option>
                    <option value="Portero" {{ old('posicion', $jugador->posicion) == 'Portero' ? 'selected' : '' }}>Portero</option>
                    <option value="Defensa" {{ old('posicion', $jugador->posicion) == 'Defensa' ? 'selected' : '' }}>Defensa</option>
                    <option value="Centrocampista" {{ old('posicion', $jugador->posicion) == 'Centrocampista' ? 'selected' : '' }}>Centrocampista</option>
                    <option value="Delantero" {{ old('posicion', $jugador->posicion) == 'Delantero' ? 'selected' : '' }}>Delantero</option>
                </select>
                @error('posicion') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>


            <div class="flex justify-end space-x-2">
                <a href="{{ route('jugadores.index', $equipo) }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</a>
                <button type="submit" class="bg-pink-400 text-white px-4 py-2 rounded hover:bg-pink-700">Actualizar</button>
            </div>
        </form>
    </div>
</x-app-layout>
