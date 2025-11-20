@include('includes.header')

<div>
    <h1 class="centrar-div">Compras</h1>
</div>

<div class="separador 10"></div>

<div class="transparente">
  <div class="centrar-div">
    <a href="{{ route('compras.create') }}" class="boton centrar-elemento">
      Agregar compra
    </a>
  </div>
</div>

<div class="columnas">
  <div class="tabla-responsive padding">
    <table id="miTabla" class="display dataTable">
      <thead>
        <tr>
          <th style="display:none;">ID</th>
          <th>Proveedor</th>
          <th>Fecha</th>
          <th>Observaciones</th>
          <th>Acciones</th>
        </tr>
      </thead>

      <tbody>
        @foreach($compras as $compra)
        <tr>
          <td style="display:none;">{{ $compra->id }}</td>
          <td>{{ $compra->proveedor }}</td>
          <td>{{ $compra->fecha }}</td>
          <td>{{ $compra->observaciones }}</td>

          <td>
            <div class="acciones-inline">

              <!-- Ver (nuevo tercer botón) -->
              <a href="{{ route('compras.show', $compra->id) }}" class="icono-ver" title="Ver">
                <span class="icono eye"></span>
              </a>

              <!-- Editar -->
              <a href="{{ route('compras.edit', $compra->id) }}" class="icono-editar" title="Editar">
                  <span class="icono pencil"></span>
              </a>

              <!-- Eliminar -->
              <form class="form-eliminar"
                    action="{{ route('compras.destroy', $compra->id) }}"
                    method="POST"
                    style="display:inline;"
                    onsubmit="return confirmarEliminacion(this)">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                          class="icono-eliminar"
                          title="Eliminar"
                          style="border:none;background:none;cursor:pointer;">
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

function confirmarEliminacion() {
    return confirm("¿Estás seguro de eliminar esta compra?");
}
</script>
@endpush
