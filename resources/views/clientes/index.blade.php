@include('includes.header')

<div>
    <h1 class="centrar-div">Clientes</h1>
</div>

<div class="separador 10"></div>

<div class="transparente">
  <div class="centrar-div">
    <a href="{{ route('clientes.create') }}" class="boton centrar-elemento">
      Agregar cliente
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
              <a href="{{ route('clientes.edit', $cliente->id) }}" class="icono-editar" title="Editar">
                  <span class="icono pencil"></span>
              </a>

              <form class="form-eliminar" action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline;" onsubmit="return confirmarEliminacion(this)">
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
    return confirm("¿Estás seguro de eliminar este cliente?");
}
</script>
@endpush
