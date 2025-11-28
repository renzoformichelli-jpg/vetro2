@include('includes.header')



    <h1 style="text-align:center;">Editar Compra #{{ $compra->compra_id }}</h1>

    <form class="formulario-base" method="POST" action="{{ route('compras.update', $compra->id) }}">
        @csrf
        @method('PUT')

        <!-- Proveedor -->
        <div class="form-grupo">
            <label for="id_proveedor" class="form-label">Proveedor</label>
            <select id="id_proveedor" name="id_proveedor" class="form-input">
                @foreach ($proveedores as $prov)
                    <option value="{{ $prov->id }}" {{ $compra->id_proveedor == $prov->id ? 'selected' : '' }}>
                        {{ $prov->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Fecha -->
        <div class="form-grupo">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" id="fecha" name="fecha" class="form-input" value="{{ $compra->fecha }}">
        </div>

        <!-- Observaciones -->
        <div class="form-grupo">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea id="observaciones" name="observaciones" class="form-input">{{ $compra->observaciones }}</textarea>
        </div>

        <hr>

        <!-- Contenedor de productos -->
        <div id="productos-container">
            @foreach ($detalles as $index => $det)
                <div class="producto-item">
                    <div class="form-grupo">
                        <label class="form-label">Producto {{ $index + 1 }}</label>
                        <select name="productos[{{ $index }}][id]" class="form-input" required>
                            @foreach ($productos as $prod)
                                <option value="{{ $prod->id }}" {{ $det->id_producto == $prod->id ? 'selected' : '' }}>
                                    {{ $prod->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-grupo">
                        <label class="form-label">Cantidad {{ $index + 1 }}</label>
                        <input type="number" name="productos[{{ $index }}][cantidad]" class="form-input" value="{{ $det->cantidad }}" min="1" required>
                    </div>

                    <div class="form-grupo">
                        <label class="form-label">Precio Unitario {{ $index + 1 }}</label>
                        <input type="number" step="0.01" name="productos[{{ $index }}][precio]" class="form-input" value="{{ $det->precio_unitario }}" min="0" required>
                    </div>

                    <div style="height:40px;"></div>
                </div>
            @endforeach
        </div>

        
        <div class="button-grid centrar-div">
            <div class="centrar-div">
                <button type="button" id="agregarProducto" class="boton">
                    <span class="icono circle-plus 20"></span> Agregar producto
                </button>

                <button type="button" id="eliminarProducto" class="boton">
                    <span class="icono trash 20"></span> Eliminar último
                </button>

                <button type="submit" class="boton centrar-elemento">
                    <span class="icono send 24"></span> Guardar cambios
                </button>

                <a href="{{ route('compras.index') }}" class="boton centrar-elemento">
                    <span class="icono arrow 24"></span> Volver al inicio
                </a>
            </div>
        </div>

    


@include('includes.footer')

<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('productos-container');
    const btnAdd = document.getElementById('agregarProducto');
    const btnRemove = document.getElementById('eliminarProducto');

    btnAdd.addEventListener('click', function () {
        const count = container.querySelectorAll('.producto-item').length + 1;

        const newItem = document.createElement('div');
        newItem.classList.add('producto-item');

        newItem.innerHTML = `
            <div class="form-grupo">
                <label class="form-label">Producto ${count}</label>
                <select name="productos[${count - 1}][id]" class="form-input" required>
                    <option value="">Seleccione</option>
                    @foreach($productos as $prod)
                        <option value="{{ $prod->id }}">{{ $prod->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-grupo">
                <label class="form-label">Cantidad ${count}</label>
                <input type="number" name="productos[${count - 1}][cantidad]" class="form-input" value="1" min="1" required>
            </div>

            <div class="form-grupo">
                <label class="form-label">Precio unitario ${count}</label>
                <input type="number" step="0.01" name="productos[${count - 1}][precio]" class="form-input" value="0" min="0" required>
            </div>

            <div style="height: 60px"></div>
        `;

        container.appendChild(newItem);
    });

    btnRemove.addEventListener('click', function () {
        const items = container.querySelectorAll('.producto-item');
        if (items.length > 1) {
            items[items.length - 1].remove();
        }
    });
});
</script>
