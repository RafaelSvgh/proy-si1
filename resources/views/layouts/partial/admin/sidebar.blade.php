@php
    $links = array_filter([
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-house',
            'route' => 'admin.dashboard',
            'active' => request()->routeIs('admin.dashboard.*'),
        ],
        [
            'header' => 'Usuarios',
        ],
        auth()->user()->hasRole('admin') ? [
            'name' => 'Usuarios',
            'icon' => 'fa-solid fa-user',
            'route' => 'admin.users.index',
            'active' => request()->routeIs('admin.users.*'),
        ] : null,
        auth()->user()->hasRole('admin') ? [
            'name' => 'Bitácora',
            'icon' => 'fa-solid fa-book',
            'route' => 'admin.bitacora.index',
            'active' => request()->routeIs('admin.bitacora.*'),
        ] : null,
        auth()->user()->hasRole('admin') ? [
            'name' => 'Permisos',
            'icon' => 'fa-solid fa-screwdriver-wrench',
            'route' => 'admin.permiso.index',
            'active' => request()->routeIs('admin.permiso.*')
        ] : null,
        auth()->user()->hasRole('admin') ? [
            'name' => 'Roles',
            'icon' => 'fa-solid fa-person',
            'route' => 'admin.rol.index',
            'active' => request()->routeIs('admin.rol.*')
        ] : null,
        [
            'header' => 'Evaluaciones',
        ],
        [
            'name' => 'Area Conocimiento',
            'icon' => 'fa-solid fa-brain',
            'route' => 'admin.conocimiento.index',
            'active' => request()->routeIs('admin.conocimiento.*'),
        ],
        // Aquí agregamos las dos que faltaban dentro del array:
        [
            'name' => 'Areas',
            'icon' => 'fa-solid fa-layer-group',
            'route' => 'admin.area.index',
            'active' => request()->routeIs('admin.area.*'),
        ],
        [
            'name' => 'Ofertas',
            'icon' => 'fa-solid fa-briefcase',
            'route' => 'admin.oferta.index',
            'active' => request()->routeIs('admin.oferta.*'),
        ],
    ], function ($item) {
        return $item !== null;
    });
@endphp

