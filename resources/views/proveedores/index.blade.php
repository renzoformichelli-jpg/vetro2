@include('includes.header')

        <div>
            <h1 class="centrar-div">Proveedores</h1>
        </div>

        <div class="separador 10"></div>

        <div class="transparente">
          <div class="centrar-div">
            <a href="{{ route('proveedores.create') }}" class="boton centrar-elemento">
              Agregar proveedor
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
              <!-- Editar -->
              <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="icono-editar" title="Editar">
                  <span class="icono pencil"></span>
              </a>

              <!-- Eliminar -->
              <form class="form-eliminar" action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" style="display:inline;" onsubmit="return confirmarEliminacion(this)">
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
