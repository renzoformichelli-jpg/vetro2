@include('includes.header')

<div class="centrar-div">
    <div class="centrar-div"><span class="icono shopping-cart 120"></span></div>

    <div class="separador 10"></div>

    <h1 class="centrar-texto">Compras</h1>

    <div class="button-grid">

        <a href="{{ route('compras.create') }}" class="boton centrar-elemento">
          <span class="icono circle-plus 24"></span> Agregar compra
        </a>

        <a href="{{ route('compras.metricas') }}" class="boton centrar-elemento">
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
          <th>Proveedor</th>
          <th>Productos</th>
          <th>Observaciones</th>
          <th>Costo</th>
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
        @foreach($compras as $compra)
        <tr>
          <td>{{ $compra->id }}</td>
          <td>{{ $compra->proveedor }}</td>
          <td>{{ $compra->productos }}</td>
          <td>{{ $compra->observaciones }}</td>
          <td>${{ $compra->total_precios }}</td>
          <td>{{ \Carbon\Carbon::parse($compra->fecha)->format('d/m/Y') }}</td>

          <td>
            <div class="acciones-inline">

              <form action="{{ route('compras.show', $compra->id) }}" method="GET" style="display:inline;">
                  <button type="submit" class="icono-ver" title="Ver">
                      <span class="icono eye 24 icono-ver"></span>
                  </button>
              </form>

               &nbsp;

              <form action="{{ route('compras.edit', $compra->id) }}" method="GET" style="display:inline;">
                  <button type="submit" class="icono-editar" title="Editar">
                      <span class="icono square-pen 24 icono-editar"></span>
                  </button>
              </form>

              &nbsp;

              <form class="form-eliminar" action="{{ route('compras.destroy', $compra->id) }}" method="POST" style="display:inline;" onsubmit="return confirmarEliminacion(this)">
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

