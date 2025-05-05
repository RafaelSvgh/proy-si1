@php
    $links = [
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-house',
            'route' => 'admin.dashboard',
            'active' => request()->routeIs('admin.dashboard.*'),
        ],
        [
            'header' => 'Usuarios',
        ],
        [
            'name' => 'Usuarios',
            'icon' => 'fa-solid fa-user',
            'route' => 'admin.users.index',
            'active' => request()->routeIs('admin.users.*'),
        ],
        [
            'name' => 'Bitácora',
            'icon' => 'fa-solid fa-book',
            'route' => 'admin.bitacora.index',
            'active' => request()->routeIs('admin.bitacora.*'),
        ],
        // [
        //     'header' => 'Management',
        // ],
    ];
@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                <li>
                    @isset($link['header'])
                        <div class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white group">
                            <span class="ms-3">{{ $link['header'] }}</span>
                        </div>
                    @else
                        <a href="{{ route($link['route']) }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'bg-gray-100 dark:bg-gray-700' : '' }}">

                            <span class="w-5 h-5 inline-flex justify-center items-center">
                                <i
                                    class="{{ $link['icon'] }} text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                            </span>
                            <span class="ms-3">{{ $link['name'] }}</span>
                        </a>
                    @endisset
                </li>
            @endforeach


        </ul>
    </div>
</aside>
