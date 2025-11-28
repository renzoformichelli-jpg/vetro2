@include('includes.header')

<div class="centrar-div">
    <div class="centrar-div"><span class="icono truck 120"></span></div>

    <div class="separador 10"></div>

    <h1 class="centrar-texto">Proveedores</h1>

    <div class="button-grid">

        <a href="{{ route('proveedores.create') }}" class="boton centrar-elemento">
          <span class="icono circle-plus 24"></span> Agregar proveedor
        </a>

        <a href="{{ route('proveedores.metricas') }}" class="boton centrar-elemento">
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
          <th style="display:none;">ID</th>
          <th>Nombre</th>
          <th>Persona Contacto</th>
          <th>Sitio Web</th>
          <th>Celular</th>
          <th>Email</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($proveedores as $proveedor)
        <tr>
          <td style="display:none;">{{ $proveedor->id }}</td>
          <td>{{ $proveedor->nombre }}</td>
          <td>{{ $proveedor->persona_contacto }}</td>
          <td>{{ $proveedor->sitio_web }}</td>
          <td>{{ $proveedor->celular }}</td>
          <td>{{ $proveedor->email }}</td>
          <td>
            <div class="acciones-inline">
              <form action="{{ route('proveedores.edit', $proveedor->id) }}" method="GET" style="display:inline;">
                  <button type="submit" class="icono-editar" title="Editar">
                      <span class="icono square-pen 24 icono-editar"></span>
                  </button>
              </form>

              &nbsp;

              <form class="form-eliminar" action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" style="display:inline;" onsubmit="return confirmarEliminacion(this)">
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

@push('scripts')
<script>
$(document).ready(function() {
    $('#miTabla').DataTable({
        "pageLength": 10,
        "lengthMenu": [10, 20],
        "columnDefs": [
            { "targets": 0, "visible": false } // ID oculto
        ]
    });
});

// Función de confirmación para eliminar
function confirmarEliminacion(form) {
    return confirm("¿Estás seguro de eliminar este proveedor?");
}
</script>
@endpush
