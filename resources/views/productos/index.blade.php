@include('includes.header')

<div class="centrar-div">
    <div class="centrar-div"><span class="icono box 120"></span></div>

    <div class="separador 10"></div>

    <h1>Productos</h1>

    <a href="{{ route('productos.create') }}" class="boton centrar-elemento">
      <span class="icono circle-plus 24"></span> Agregar producto
    </a>
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
          <th>Nombre</th>
          <th>Costo</th>
          <th>Valor Venta</th>
          <th>Proveedor</th>
          <th>Acciones</th>
        </tr>
        <tr class="filtros">
          <th><select class="filtro-columna"></select></th>
          <th><select class="filtro-columna"></select></th>
          <th><select class="filtro-columna"></select></th>
          <th><select class="filtro-columna"></select></th>
          <th><select class="filtro-columna"></select></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($productos as $producto)
        <tr>
          <td>{{ $producto->id }}</td>
          <td>{{ $producto->nombre }}</td>
          <td>${{ $producto->costo }}</td>
          <td>${{ $producto->valor_venta }}</td>
          <td>{{ $producto->proveedor }}</td>
          <td>
            <div class="acciones-inline">
              <form action="{{ route('productos.edit', $producto->id) }}" method="GET" style="display:inline;">
                  <button type="submit" class="icono-editar" title="Editar">
                      <span class="icono square-pen 24 icono-editar"></span>
                  </button>
              </form>

              &nbsp;

              <form class="form-eliminar" action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;" onsubmit="return confirmarEliminacion(this)">
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