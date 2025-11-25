@include('includes.header')

<div>
    <div class="centrar-div"><span class="icono shopping-cart 120"></span>
    </div>
    <div class="separador 10"></div>
    <h1 class="centrar-div">Compras</h1>
</div>

<div class="separador 10"></div>

<div class="transparente">
  <div class="centrar-div">
    <a href="{{ route('compras.create') }}" class="boton centrar-elemento">
      <span class="icono circle-plus 24"></span> Agregar compra
    </a>
  </div>
</div>

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
