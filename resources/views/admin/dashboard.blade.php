<x-admin-layout>
    <div>
        <h2 class="text-lg font-semibold">
            Bienvenido, {{ auth()->user()->name }}. Estás en el panel de Administrador.
        </h2>
    </div>
</x-admin-layout>