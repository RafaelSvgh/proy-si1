<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistema de Reclutamiento | Manpower</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        /* Reset y estilos base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: #f8fafc;
            color: #1e293b;
            line-height: 1.5;
        }

        /* Variables */
        :root {
            --manpower-red: #e6001f;
            --manpower-dark: #c5001a;
            --accent-blue: #3b82f6;
            --text-dark: #1e293b;
            --text-light: #64748b;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-20px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Clases de utilidad */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--manpower-red), var(--accent-blue));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Layout principal */
        .min-h-screen {
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Header y navegación */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--manpower-red);
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-link {
            color: var(--text-dark);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(230, 0, 31, 0.1);
            color: var(--manpower-red);
        }

        /* Hero section */
        .hero {
            position: relative;
            padding: 8rem 0 4rem;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover;
            clip-path: polygon(15% 0, 100% 0, 100% 100%, 0% 100%);
            opacity: 0.1;
        }

        .hero-content {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--text-dark);
            animation: fadeIn 0.8s ease-out;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--text-light);
            margin-bottom: 2rem;
            animation: fadeIn 0.8s ease-out 0.2s forwards;
            opacity: 0;
        }

        /* Botones */
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: var(--manpower-red);
            color: white;
            box-shadow: 0 4px 15px rgba(230, 0, 31, 0.2);
        }

        .btn-primary:hover {
            background: var(--manpower-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(230, 0, 31, 0.3);
        }

        /* Features section */
        .features {
            padding: 4rem 0;
            background: white;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem;
        }

        .feature-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            animation: slideIn 0.6s ease-out;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: var(--manpower-red);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .feature-icon svg {
            width: 30px;
            height: 30px;
            color: white;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .feature-description {
            color: var(--text-light);
            line-height: 1.6;
        }

        .feature-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .feature-card:hover .feature-image {
            transform: scale(1.05);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Nuevos estilos para imágenes */
        .stats-section {
            padding: 4rem 0;
            background: linear-gradient(135deg, var(--manpower-red) 0%, var(--manpower-dark) 100%);
            color: white;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            text-align: center;
        }

        .stat-item {
            padding: 2rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Estilos para ofertas laborales */
        .ofertas-section {
            padding: 20px;
            background-color: #f3f4f6;
        }

        .ofertas-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .ofertas-titulo {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .ofertas-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 15px;
            padding: 10px;
        }

        @media (min-width: 640px) {
            .ofertas-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .ofertas-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .oferta-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .oferta-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .oferta-titulo {
            font-size: 16px;
            font-weight: 500;
            color: #1f2937;
            margin: 0;
        }

        .oferta-estado {
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 12px;
        }

        .estado-activo {
            background-color: #dcfce7;
            color: #166534;
        }

        .estado-inactivo {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .oferta-descripcion {
            font-size: 14px;
            color: #4b5563;
            margin: 10px 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .oferta-detalles {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .oferta-detalles span {
            margin-right: 10px;
        }

        .oferta-salario {
            font-size: 12px;
            background-color: #f3f4f6;
            padding: 8px;
            border-radius: 6px;
            text-align: center;
        }

        .oferta-botones {
            display: flex;
            gap: 10px;
            margin-top: 12px;
        }

        .oferta-postular,
        .oferta-registro {
            flex: 1;
            padding: 8px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .oferta-postular {
            background-color: #2563eb;
            color: white;
            width: 100%;
        }

        .oferta-postular:hover {
            background-color: #1d4ed8;
        }

        .oferta-registro {
            background-color: #f3f4f6;
            color: #1f2937;
            border: 1px solid #e5e7eb;
        }

        .oferta-registro:hover {
            background-color: #e5e7eb;
        }

        .job-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .job-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .job-description {
            color: var(--text-light);
            margin-bottom: 1.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .job-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .job-detail {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .job-salary {
            background: #f1f5f9;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            color: var(--text-dark);
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .job-status {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-activo {
            background: #dcfce7;
            color: #166534;
        }

        .status-inactivo {
            background: #fee2e2;
            color: #991b1b;
        }

        .testimonial-section {
            padding: 4rem 0;
            background: #f8fafc;
        }

        .testimonial-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .testimonial-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }

        .testimonial-content {
            flex: 1;
        }

        .testimonial-text {
            font-style: italic;
            margin-bottom: 1rem;
            color: var(--text-light);
        }

        .testimonial-author {
            font-weight: 600;
            color: var(--text-dark);
        }

        .testimonial-role {
            color: var(--text-light);
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <header class="header">
        <nav class="nav container">
            <div class="logo">Manpower</div>
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <strong class="font-bold">¡Éxito!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (Route::has('login'))
                <div class="nav-links">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Iniciar Sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link">Registrarse</a>
                        @endif
                    @endauth
                </div>
            @endif
        </nav>
    </header>

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Sistema de Reclutamiento</h1>
                <p class="hero-subtitle">Gestión eficiente de candidatos y procesos de selección</p>
                <a href="{{ route('login') }}" class="btn btn-primary">
                    Comenzar Ahora
                    <svg class="ml-2" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <div class="features-grid">
                <div class="feature-card">
                    <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Gestión de candidatos" class="feature-image">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="feature-title">Gestión de Candidatos</h3>
                    <p class="feature-description">
                        Administra eficientemente tu base de datos de candidatos. Registra, busca y filtra perfiles
                        según tus necesidades específicas.
                    </p>
                </div>

                                <svg class="size-6 shrink-0 self-center stroke-manpower" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
                            </a>

                            <a
                                href="{{ route('login') }}"
                                class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-manpower lg:pb-10"
                            >
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-manpower/10 sm:size-16">
                                    <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>

                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black">Programación de Entrevistas</h2>

                                    <p class="mt-4 text-sm/relaxed">
                                        Organice y programe entrevistas con los candidatos. Gestione el calendario de entrevistas, envíe notificaciones automáticas y registre los resultados de cada entrevista para una evaluación completa.
                                    </p>
                                </div>

                                <svg class="size-6 shrink-0 self-center stroke-manpower" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
                            </a>

                            <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-manpower lg:pb-10">
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-manpower/10 sm:size-16">
                                    <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>

                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black">Reportes y Estadísticas</h2>

                                    <p class="mt-4 text-sm/relaxed">
                                        Obtenga información valiosa sobre sus procesos de reclutamiento con reportes detallados. Analice tiempos de contratación, fuentes de reclutamiento efectivas, y métricas clave para optimizar sus estrategias.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-12 text-center">
                            <a
                                href="{{ route('login') }}"
                                class="inline-flex items-center justify-center rounded-md bg-manpower px-6 py-3 text-white shadow-sm transition hover:bg-manpower-dark focus:outline-none focus-visible:ring-2 focus-visible:ring-manpower"
                            >
                                Comenzar ahora
                                <svg class="ml-2 size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </main>

                    <footer class="py-16 text-center text-sm text-black">
                        <p>Sistema de Reclutamiento Manpower &copy; 2025. Todos los derechos reservados.</p>
                    </footer>
                </div>
            </div>
        </div>
    </section>

    <section class="ofertas-section">
        <div class="ofertas-container">
            <h2 class="ofertas-titulo">Ofertas Laborales Disponibles</h2>
            <div class="ofertas-grid">
                @foreach ($ofertas as $oferta)
                    <div class="oferta-card">
                        <div class="oferta-header">
                            <h3 class="oferta-titulo">{{ $oferta->cargo }}</h3>
                            <span class="oferta-estado {{ $oferta->estado == 'A' ? 'estado-activo' : 'estado-inactivo' }}">
                                {{ $oferta->estado == 'A' ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>
                        <p class="oferta-descripcion">{{ $oferta->descripcion }}</p>
                        <div class="oferta-detalles">
                            <span>Modalidad: {{ $oferta->modalidad == 'P' ? 'Presencial' : ($oferta->modalidad == 'R' ? 'Remoto' : 'Híbrido') }}</span>
                            <span>Inicio: {{ $oferta->fecha_inicio }}</span>
                            <span>Fin: {{ $oferta->fecha_fin }}</span>
                        </div>
                        <div class="oferta-salario">
                            Salario: ${{ number_format($oferta->salario_minimo, 0) }} - ${{ number_format($oferta->salario_maximo, 0) }}
                        </div>
                        <div class="oferta-botones">
                            <form action="{{ route('candidato.postular', $oferta->id) }}" method="POST" style="flex: 1;">
                                @csrf
                                <button type="submit" class="oferta-postular">
                                    Postular
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>Sistema de Reclutamiento Manpower &copy; 2025. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>

</html>
