<x-admin-layout>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="{{ route('admin.bitacora.index') }}"
                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Bitácora</a>
                </div>
            </li>
        </ol>
    </nav>

    <div class="py-4 flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Bitácora</h1>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Responsable
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acción
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tabla
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Registro
                    </th>
                    <th scope="col" class="px-6 py-3">
                        IP
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Método
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ruta
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Navegador
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha y Hora
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bitacoras as $bitacora)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $bitacora->usuario }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $bitacora->descripcion }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $bitacora->tabla }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $bitacora->registro_id }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $bitacora->direccion_ip }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $bitacora->metodo }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $bitacora->ruta }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $bitacora->navegador }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $bitacora->fecha_hora }}
                        </td>
                    </tr>
                @empty

                    <tr class="bg-white dark:bg-gray-900 border-b dark:border-gray-700 border-gray-200">
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            No hay movimientos registrados.
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    {{ $bitacoras->links() }}

</x-admin-layout>
