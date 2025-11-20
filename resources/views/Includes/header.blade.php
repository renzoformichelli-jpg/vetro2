<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Vetro</title>
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

  <link rel="icon" href="{{ asset('flora/img/logo.jpeg') }}" type="image/jpeg">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
  <!-- Select CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>

  <div id="spinner-carga" class="spinner-fondo">
    <div class="spinner-contenido">
      <div class="spinner"></div>
      <p class="spinner-texto">Vetro</p>
    </div>
  </div>

  <header>
    <!-- Fila 1: Información del sistema -->
    <div class="system-info">
      <div class="logo">
        <img src="{{ asset('flora/img/logo.jpeg') }}" alt="Logo del sistema">
      </div>
      <div class="system-name">
          Vetro
          <div class="system-version">Versión: 1.0.0</div>
      </div>
      
    </div>

    <!-- Fila 2: Botones de funciones -->
  <div class="button-grid">
      
      <a href="{{ route('productos.index') }}">
          <button><span class="icono box"></span><span>Productos</span></button>
      </a>

      <a href="{{ route('proveedores.index') }}">
          <button><span class="icono truck"></span><span>Proveedores</span></button>
      </a>

      <a href="{{ route('clientes.index') }}">
          <button><span class="icono users"></span><span>Clientes</span></button>
      </a>

      <a href="{{ route('compras.index') }}">
          <button><span class="icono shopping-cart"></span><span>Compras</span></button>
      </a>

      <a href="{{ route('ventas.index') }}">
          <button><span class="icono dollar-sign"></span><span>Ventas</span></button>
      </a>
    
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

   

  