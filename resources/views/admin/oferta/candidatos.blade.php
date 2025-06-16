<x-admin-layout>
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
                    <a href="{{ route('admin.oferta.index') }}"
                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Ofertas</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="#"
                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Candidatos</a>
                </div>
            </li>
        </ol>
    </nav>

    <div class="py-4 flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Candidatos - {{ $oferta->cargo }}</h1>
        <a href="{{ route('admin.oferta.index') }}"
            class="flex items-center gap-2 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
            <i class="fas fa-arrow-left"></i>
            Atrás
        </a>
    </div>

    <!-- Detalles de la oferta -->
    <div class="mb-6 p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
        <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Detalles de la Oferta</h2>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Cargo</p>
                <p class="font-medium text-gray-900 dark:text-white">{{ $oferta->cargo }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Área</p>
                <p class="font-medium text-gray-900 dark:text-white">{{ $oferta->area->nombre }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Modalidad</p>
                <p class="font-medium text-gray-900 dark:text-white">
                    {{ $oferta->modalidad === 'P' ? 'Presencial' : ($oferta->modalidad === 'R' ? 'Remoto' : 'Híbrido') }}
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Estado</p>
                <p class="font-medium">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $oferta->estado === 'A' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $oferta->estado === 'A' ? 'Activa' : 'Inactiva' }}
                    </span>
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Rango Salarial</p>
                <p class="font-medium text-gray-900 dark:text-white">
                    {{ number_format($oferta->salario_minimo, 2) }} - {{ number_format($oferta->salario_maximo, 2) }}
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Período</p>
                <p class="font-medium text-gray-900 dark:text-white">
                    {{ \Carbon\Carbon::parse($oferta->fecha_inicio)->format('d/m/Y') }} -
                    {{ \Carbon\Carbon::parse($oferta->fecha_fin)->format('d/m/Y') }}
                </p>
            </div>
        </div>
        <div class="mt-4">
            <p class="text-sm text-gray-600 dark:text-gray-400">Descripción</p>
            <p class="font-medium text-gray-900 dark:text-white">{{ $oferta->descripcion }}</p>
        </div>
    </div>

    <!-- Lista de candidatos -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Dirección
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($candidatos as $cand)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $cand->candidato->user->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $cand->candidato->user->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $cand->candidato->user->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $cand->candidato->direccion ?? 'No especificada' }}
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white dark:bg-gray-900 border-b dark:border-gray-700 border-gray-200">
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            No hay candidatos postulados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
