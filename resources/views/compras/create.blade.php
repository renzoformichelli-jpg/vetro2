@include('includes.header')

<div class="centrar-div"><h2>Agregar Compra</h2></div>

<div>
    <form class="formulario-base" method="POST" action="{{ route('compras.store') }}">
        @csrf

        <div class="form-grupo">
            <label for="id_proveedor" class="form-label">Proveedor</label>
            <select id="id_proveedor" name="id_proveedor" class="form-input">
                <option value="">Seleccione</option>
                @foreach($proveedores as $prov)
                    <option value="{{ $prov->id }}">{{ $prov->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-grupo">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" id="fecha" name="fecha" class="form-input" value="{{ old('fecha') }}">
        </div>

        <div class="form-grupo">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea id="observaciones" name="observaciones"
                      class="form-input"
                      placeholder="Observaciones (opcional)">{{ old('observaciones') }}</textarea>
        </div>

        <div class="centrar-div">
            <button type="submit" class="boton centrar-elemento">
                <span class="icono send"></span> Guardar compra
            </button>
        </div>

    </form>
</div>

@include('includes.footer')
