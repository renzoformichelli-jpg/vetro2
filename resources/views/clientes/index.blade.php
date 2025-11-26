@include('includes.header')

<div class="centrar-div">
    <div class="centrar-div"><span class="icono users 120"></span></div>

    <div class="separador 10"></div>

    <h1>Clientes</h1>
    <div class="centrar-div transparente">
    <a href="{{ route('clientes.create') }}" class="boton">
      <span class="icono circle-plus 24"></span> Agregar cliente
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
          <th>Apellido</th>
          <th>DNI</th>
          <th>Celular</th>
          <th>Email</th>
          <th>Edad</th>
          <th>Acciones</th>
        </tr>
      </thead>

      <tbody>
        @foreach($clientes as $cliente)
        <tr>
          <td style="display:none;">{{ $cliente->id }}</td>
          <td>{{ $cliente->nombre }}</td>
          <td>{{ $cliente->apellido }}</td>
          <td>{{ $cliente->dni }}</td>
          <td>{{ $cliente->celular }}</td>
          <td>{{ $cliente->email }}</td>
          <td>{{ $cliente->edad }}</td>

          <td>
            <div class="acciones-inline">
              <form action="{{ route('clientes.edit', $cliente->id) }}" method="GET" style="display:inline;">
                  <button type="submit" class="icono-editar" title="Editar">
                      <span class="icono square-pen 24 icono-editar"></span>
                  </button>
              </form>

              &nbsp;

              <form class="form-eliminar" action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline;" onsubmit="return confirmarEliminacion(this)">
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
            { "targets": 0, "visible": false }
        ]
    });
});

function confirmarEliminacion(form) {
    return confirm("¿Estás seguro de eliminar este cliente?");
}
</script>
@endpush
