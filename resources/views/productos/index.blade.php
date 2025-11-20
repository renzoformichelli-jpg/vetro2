@include('includes.header')

<div>
    <h1 class="centrar-div">Productos</h1>
</div>

<div class="separador 10"></div>

<div class="transparente">
  <div class="centrar-div">
    <a href="{{ route('productos.create') }}" class="boton centrar-elemento">
      Agregar producto
    </a>
  </div>
</div>

<div class="columnas">
  <div class="tabla-responsive padding">
    <table id="miTabla" class="display dataTable">
      <thead>
        <tr>
          <th style="display:none;">ID</th>
          <th>Nombre</th>
          <th>Costo</th>
          <th>Valor Venta</th>
          <th>Proveedor</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($productos as $producto)
        <tr>
          <td style="display:none;">{{ $producto->id }}</td>
          <td>{{ $producto->nombre }}</td>
          <td>{{ $producto->costo }}</td>
          <td>{{ $producto->valor_venta }}</td>
          <td>{{ $producto->proveedor }}</td>
          <td>
            <div class="acciones-inline">
              <a href="{{ route('productos.edit', $producto->id) }}" class="icono-editar" title="Editar">
                  <span class="icono pencil"></span>
              </a>

              <form class="form-eliminar" action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;" onsubmit="return confirmarEliminacion(this)">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="icono-eliminar" title="Eliminar" style="border:none;background:none;cursor:pointer;">
                      <span class="icono trash"></span>
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

@push('scripts')
<script>
$(document).ready(function() {
    $('#miTabla').DataTable({
        "pageLength": 10,
        "lengthMenu": [10, 20],
        "columnDefs": [
            { "targets": 0, "visible": false }
        ]
    });
});

function confirmarEliminacion(form) {
    return confirm("¿Estás seguro de eliminar este producto?");
}
</script>
@endpush
