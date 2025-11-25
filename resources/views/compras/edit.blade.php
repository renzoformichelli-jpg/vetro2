@include('includes.header')

<form class="formulario-base" method="READ" action="{{ route('compras.show', $compra->id) }}">

    @method('PUT')

    <!-- Proveedor -->
    <div class="form-grupo">
        <label for="id_proveedor" class="form-label">Proveedor</label>
        <select id="id_proveedor" name="id_proveedor" class="form-input">
            @foreach ($proveedores as $prov)
                <option value="{{ $prov->id }}"
                    {{ $compra->id_proveedor == $prov->id ? 'selected' : '' }}>
                    {{ $prov->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Fecha -->
    <div class="form-grupo">
        <label for="fecha" class="form-label">Fecha</label>
        <input type="date" id="fecha" name="fecha" class="form-input"
               value="{{ $compra->fecha }}">
    </div>

    <!-- Observaciones -->
    <div class="form-grupo">
        <label for="observaciones" class="form-label">Observaciones</label>
        <textarea id="observaciones" name="observaciones" class="form-input">
            {{ $compra->observaciones }}
        </textarea>
    </div>

    <div class="separador 10"></div>
    <hr>
    <div class="separador 40"></div>

    <!-- Productos -->    
    @foreach ($detalles as $index => $det)
        <div class="form-grupo">
            <label for="productos[{{ $index }}][id]" class="form-label">Producto {{$index + 1}}</label>
            <select name="productos[{{ $index }}][id]" class="form-input">
                @foreach ($productos as $prod)
                    <option value="{{ $prod->id }}"
                        {{ $det->id_producto == $prod->id ? 'selected' : '' }}>
                        {{ $prod->nombre }}
                    </option>
                @endforeach
            </select>
        </div>    

        <div class="form-grupo">
            <label for="cantidad" class="form-label">Producto {{$index + 1}} cantidad</label>
            <input type="number"
                   id="cantidad" 
                   name="productos[{{ $index }}][cantidad]"
                   class="form-input"
                   value="{{ $det->cantidad }}"
                   min="1"
                   step="1"
                   placeholder="Cantidad">
        </div>           

        <div class="form-grupo">
            <label for="precio-unitario" class="form-label">Producto {{$index + 1}} precio unitario</label>
            <input type="number"
                   id="precio-unitario" 
                   name="productos[{{ $index }}][precio]"
                   class="form-input"
                   value="{{ $det->precio_unitario }}"
                   min="0"
                   step="0.01"
                   placeholder="Precio Unitario">
        </div>

        <div class="separador 60"></div>      

    @endforeach

    <!-- Botón Guardar -->
    <div class="centrar-div">
        <button type="submit" class="boton centrar-elemento">
            <span class="icono send"></span> Guardar cambios
        </button>
    </div>

@include('includes.footer')
