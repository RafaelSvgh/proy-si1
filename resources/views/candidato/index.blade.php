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
                    <a href="{{ route('admin.candidato.index') }}"
                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Usuarios</a>
                </div>
            </li>
        </ol>
    </nav>

    <div class="py-4 flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Candidatos</h1>
        <a href="{{ route('admin.candidato.create') }}"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <i class="fas fa-plus"></i>
            Nuevo
        </a>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="example">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Dirección
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Correo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Teléfono
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($candidatos as $candidato)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $candidato->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $candidato->direccion }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $candidato->user->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $candidato->user->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $candidato->user->telefono }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($candidato->user->estado == 'A')
                                <span class="text-green-600 font-semibold">Activo</span>
                            @else
                                <span class="text-red-600 font-semibold">Inactivo</span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <a href="{{ route('admin.candidato.edit', $candidato->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline me-3">
                                <i class="fas fa-edit fa-lg"></i>
                            </a>
                            {{-- <a href="#"
                                class="font-medium text-green-600 dark:text-green-500 hover:underline me-3">
                                <i class="fas fa-eye fa-lg"></i>
                            </a> --}}
                            <a data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                data-id="{{ $candidato->id }}"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                <i class="fas fa-trash-alt fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                @empty

                    <tr class="bg-white dark:bg-gray-900 border-b dark:border-gray-700 border-gray-200">
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            No hay candidatos registrados.
                        </td>
                    </tr>
                @endforelse



            </tbody>
        </table>
    </div>

    <div id="popup-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Deseas eliminar este
                        usuario?
                    </h3>

                    <a id="confirmarEliminar" data-modal-hide="popup-modal" href="#"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Sí, Estoy seguro
                    </a>
                    <button data-modal-hide="popup-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                        cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
    </form>
    {{ $candidatos->links() }}
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let idEliminar = null;

            document.querySelectorAll("[data-modal-target='popup-modal']").forEach(button => {
                button.addEventListener("click", function() {
                    idEliminar = this.getAttribute("data-id");
                });
            });

            document.getElementById("confirmarEliminar").addEventListener("click", function(e) {
                e.preventDefault(); 

                if (idEliminar) {
                    let form = document.getElementById("deleteForm");
                    form.action = `{{ route('admin.candidato.destroy', '') }}/${idEliminar}`;
                    form.submit();
                }
            });
        });
    </script>

</x-admin-layout>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.bootstrap5.js"></script>
    
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        new DataTable('#example', {
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.0.0/i18n/es-ES.json'
            }
        });
    });
</script>

