@include('includes.header')

<div class="centrar-div"><h2>Editar Compra</h2></div>

<div>
    <form class="formulario-base" method="POST" action="{{ route('compras.update', $compra->id) }}">
        @csrf
        @method('PUT')

        <div class="form-grupo">
            <label for="id_proveedor" class="form-label">Proveedor</label>
            <select id="id_proveedor" name="id_proveedor" class="form-input">
                @foreach($proveedores as $prov)
                    <option value="{{ $prov->id }}"
                        {{ $compra->id_proveedor == $prov->id ? 'selected' : '' }}>
                        {{ $prov->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-grupo">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" id="fecha" name="fecha" class="form-input"
                   value="{{ old('fecha', $compra->fecha) }}">
        </div>

        <div class="form-grupo">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea id="observaciones" name="observaciones" class="form-input">
                {{ old('observaciones', $compra->observaciones) }}
            </textarea>
        </div>

        <div class="centrar-div">
            <button type="submit" class="boton centrar-elemento">
                <span class="icono send"></span> Guardar cambios
            </button>
        </div>

    </form>
</div>

@include('includes.footer')
