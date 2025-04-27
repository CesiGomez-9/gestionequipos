<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight">
            {{ __('Editar Equipo') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('equipos.update', $equipo) }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $equipo->nombre) }}" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-700 dark:text-white" required>
                @error('nombre') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">País</label>
                <input type="text" name="pais" value="{{ old('pais', $equipo->pais) }}" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-700 dark:text-white" required>
                @error('pais') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Imagen actual</label>
                @if ($equipo->logo)
                    <div class="mb-2">
                        <img id="current-logo" src="{{ asset('storage/' . $equipo->logo) }}" alt="Logo actual" class="w-20 h-20 object-cover rounded" id="current-logo">
                    </div>
                @endif

                <div id="preview-container" class="mt-4">
                    <img id="logo-preview" class="hidden w-20 h-20 object-cover rounded" />
                </div>

                <input type="file" name="logo" id="logo" class="block w-full text-white file:mr-4 file:py-2 file:px-4
           file:rounded file:border-0
           file:text-sm file:font-semibold
           file:bg-blue-600 file:text-white
           hover:file:bg-pink-700
           dark:text-white dark:file:bg-pink-400 dark:file:text-white">

                @error('logo') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</a>
                <button type="submit" class="bg-pink-400 text-white px-4 py-2 rounded hover:bg-pink-700">Actualizar</button>
            </div>

        </form>
    </div>

    <script>
        document.getElementById('logo').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const currentLogo = document.getElementById('current-logo');
            const logoPreview = document.getElementById('logo-preview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {

                    currentLogo.classList.add('hidden');
                    logoPreview.src = e.target.result;
                    logoPreview.classList.remove('hidden');
                };

                reader.readAsDataURL(file);
            } else {
                currentLogo.classList.remove('hidden');
                logoPreview.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>
