<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pulsar Nexum</title>
  <link rel="stylesheet" href="{{ asset('flora/css/reset.css') }}" />
  <link rel="stylesheet" href="{{ asset('flora/css/base.css') }}" />
  <link rel="stylesheet" href="{{ asset('flora/css/header.css') }}" />
  <link rel="stylesheet" href="{{ asset('flora/css/layout.css') }}" />
  <link rel="stylesheet" href="{{ asset('flora/css/components.css') }}" />
  <link rel="stylesheet" href="{{ asset('flora/css/datatables.css') }}" />
  <link rel="stylesheet" href="{{ asset('flora/css/alertas.css') }}" />
  <link rel="stylesheet" href="{{ asset('flora/css/responsive.css') }}" />  
  <link rel="stylesheet" href="{{ asset('flora/iconos/visor-iconos.css') }}" />
  <!-- <link rel="stylesheet" href="{{ asset('flora/iconos/paleta-personalizada.css') }}" />  Descomentar para usar una SOLA paleta-->

  <link rel="icon" href="{{ asset('flora/img/logo.png') }}" type="image/png">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
  <!-- Select CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>

  <div id="spinner-carga" class="spinner-fondo">
    <div class="spinner-contenido">
      <div class="spinner"></div>
      <p class="spinner-texto">Pulsar Nexum</p>
    </div>
  </div>

  <header>
    <!-- Fila 1: Información del sistema -->
    <div class="system-info">
      <div class="logo">
        <img src="{{ asset('flora/img/logo.png') }}" alt="Logo del sistema">
      </div>
      <div class="system-name">
          Pulsar Nexum
          <div class="system-version">Versión: 1.0.0</div>
      </div>
      

      <!-- Menú de usuario -->
        @auth
        <div class="menu-usuario">
            <div class="nombre-usuario">
                Bienvenido/a, <span class="name" >{{ auth()->user()->name }}</span>
            </div>
            <form class="form-cerrar-sesion" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="boton-cerrar-sesion"><i class="icono arrow-big-right-dash 15"></i> Cerrar sesión</button>
            </form>
        </div>
        @endauth
    </div>

    <!-- Fila 2: Botones de funciones -->
    <div class="button-grid">
      <a class="transparente" style="cursor: auto;"></a>

      <a href="{{ route('index') }}">
          <button><span class="icono">🏠</span><span>Inicio</span></button>
      </a>
      <a href="{{ route('tareas') }}">
          <button><span class="icono">📋</span><span>Tareas</span></button>
      </a>
      <a href="{{ route('redes') }}">
          <button><span class="icono">📱</span><span>Redes</span></button>
      </a>
      <a href="{{ route('agenda.index') }}">
          <button><span class="icono">📅</span><span>Agenda</span></button>
      </a>
      <a href="{{ route('plan.contenidos') }}">
          <button><span class="icono">📝</span><span>Plan de contenidos</span></button>
      </a>
      <a href="{{ route('repositorios') }}">
          <button><span class="icono">🧑‍💻</span><span>Repositorios</span></button>
      </a>
      <a href="{{ route('googleDrive') }}">
          <button><span class="icono">🗂️</span><span>Google Drive</span></button>
      </a>
      <a href="{{ route('documentacion') }}">
          <button><span class="icono">📚</span><span>Documentación</span></button>
      </a>
      <a class="transparente" style="cursor: auto;"></a>
    </div>

     <!-- Fila 3: Paleta de colores COMENTAR EN CASO DE USAR UNA SOLA PALETA -->
    <div class="columnas">
      <div id="paletas">
        <div class="centrar-div">
          <div id="selectorPaletas"></div>
          <script src="{{ asset('flora/js/paletas.js') }}"></script>
        </div>  
      </div>
    </div> 

  </header>

  <div class="contenedor">

   

  