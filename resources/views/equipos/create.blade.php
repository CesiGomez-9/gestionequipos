<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight">
            {{ __('Crear Equipo') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('equipos.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded shadow">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Nombre</label>
                <input type="text" name="nombre" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-700 dark:text-white" required>
                @error('nombre') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">País</label>
                <input type="text" name="pais" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-700 dark:text-white" required>
                @error('pais') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Logo (opcional)</label>
                <input type="file" name="logo"
                       class="block w-full text-white file:mr-4 file:py-2 file:px-4
                           file:rounded file:border-0
                           file:text-sm file:font-semibold
                           file:bg-blue-600 file:text-white
                           hover:file:bg-pink-700
                           dark:text-white dark:file:bg-pink-400 dark:file:text-white mt-1">
                @error('logo') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</a>
                <button type="submit" class="bg-pink-400 text-white px-4 py-2 rounded hover:bg-pink-700">Guardar</button>
            </div>
        </form>
    </div>
</x-app-layout>
