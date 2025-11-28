@include('includes.header')

<div class="centrar-div">
    <div class="centrar-div"><span class="icono dollar-sign 120"></span></div>

    <div class="separador 10"></div>

      <div class="centrar-div transparente">
      <h1>Ventas</h1>
      </div>

    <div class="button-grid">

        <a href="{{ route('ventas.create') }}" class="boton centrar-elemento">
          <span class="icono circle-plus 24"></span> Agregar venta
        </a>

        <a href="{{ route('ventas.metricas') }}" class="boton centrar-elemento">
          <span class="icono chart-pie 24"></span> Ver métricas 
        </a>
        
    </div>
</div>

@if(session('success'))
  <div class="alerta exito">
    <span class="alerta-texto">{{ session('success') }}</span>
  </div>
@endif

<div class="columnas">
  <div class="tabla-responsive padding">
    <table id="miTabla" class="display dataTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>Productos</th>
          <th>Observaciones</th>
          <th>Total</th>
          <th>Fecha</th>
          <th>Acciones</th>
        </tr>
        <tr class="filtros">
          <th><select class="filtro-columna"></select></th>
          <th><select class="filtro-columna"></select></th>
          <th><select class="filtro-columna"></select></th>
          <th><select class="filtro-columna"></select></th>
          <th><select class="filtro-columna"></select></th>
          <th><select class="filtro-columna"></select></th>
          <th></th>
        </tr>
      </thead>

      <tbody>
        @foreach($ventas as $venta)
        <tr>
          <td>{{ $venta->id }}</td>

          <!-- Cliente: nombre + apellido -->
          <td>
            {{ $venta->cliente_nombre ?? '' }}
            {{ $venta->cliente_apellido ?? '' }}
          </td>

          <!-- Productos concatenados con cantidades -->
          <td>
            {{ $venta->productos_listado ?? '—' }}
          </td>

          <!-- Observaciones (vienen de ventas.observaciones) -->
          <td>{{ $venta->observaciones ?? '—' }}</td>

          <!-- Total calculado -->
          <td>${{ number_format($venta->total ?? 0, 2, ',', '.') }}</td>

          <!-- Fecha formato dd/mm/yyyy -->
          <td>{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}</td>

          <td>
            <div class="acciones-inline">

              <form action="{{ route('ventas.show', $venta->id) }}" method="GET" style="display:inline;">
                  <button type="submit" class="icono-ver" title="Ver">
                      <span class="icono eye 24 icono-ver"></span>
                  </button>
              </form>

               &nbsp;

              <form action="{{ route('ventas.edit', $venta->id) }}" method="GET" style="display:inline;">
                  <button type="submit" class="icono-editar" title="Editar">
                      <span class="icono square-pen 24 icono-editar"></span>
                  </button>
              </form>

              &nbsp;

              <form class="form-eliminar" action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline;" onsubmit="return confirmarEliminacion(this)">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="icono-eliminar" title="Eliminar">
                      <span class="icono trash 24"></span>
                  </button>
              </form>
            </div> 
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@include('includes.footer')
