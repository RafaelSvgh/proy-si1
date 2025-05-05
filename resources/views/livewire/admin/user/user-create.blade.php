<form wire:submit="save" class="max-w-4xl mx-auto">

    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
            <input type="text" id="nombre" wire:model.live="nombre"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                placeholder="Nombre completo" />
            @error('nombre')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teléfono</label>
            <input type="number" id="telefono" wire:model="telefono"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" />
            @error('telefono')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-6">
            <label for="correo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo
                electrónico</label>
            <input type="email" id="correo" wire:model="correo"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                placeholder="user@company.com" />
            @error('correo')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <label class="inline-flex items-center cursor-pointer">
            <input type="checkbox" 
                   wire:model.live="toggleEstado" 
                   class="sr-only peer">
            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
            </div>
            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                {{ $toggleEstado ? 'Usuario activo' : 'Usuario inactivo' }}
            </span>
        </label>

    </div>



    <div class="grid gap-6 md:grid-cols-2">
        <div class="mb-6">
            <label for="password"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
            <input type="password" id="password" wire:model="password"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                placeholder="•••••••••" />
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password_confirmation"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar contraseña</label>
            <input type="password" id="password_confirmation" wire:model="password_confirmation"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                placeholder="•••••••••" />
            @error('password_confirmation')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <h3 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rol</h3>
    <ul
        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
            <div class="flex items-center ps-3">
                <input id="admin" type="radio" value="admin" wire:model.live="rol"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="admin" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Administrador</label>
            </div>
        </li>
        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
            <div class="flex items-center ps-3">
                <input id="reclutador" type="radio" value="reclutador" wire:model.live="rol"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="reclutador"
                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Reclutador</label>
            </div>
        </li>
        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
            <div class="flex items-center ps-3">
                <input id="candidato" type="radio" value="candidato" wire:model.live="rol"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="candidato"
                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Candidato</label>
            </div>
        </li>
    </ul>
    @if ($rol === 'candidato')
        <div class="mt-6">
            <label for="direccion"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección</label>
            <input type="text" id="direccion" wire:model.live="direccion"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                placeholder="Dirección del candidato" />
        </div>
    @endif

    @if ($rol === 'reclutador')
        <div class="mt-6">
            <label for="departamento"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departamento</label>
            <input type="text" id="departamento" wire:model.live="departamento"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                placeholder="Departamento del reclutador" />
        </div>
    @endif

    @error('rol')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    
    <button type="submit"
        class="mt-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Agregar
    </button>
</form>
