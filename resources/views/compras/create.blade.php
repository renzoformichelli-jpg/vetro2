@include('includes.header')

<div class="separador 25"></div>

<div class="centrar-div"><h2>Agregar Compra</h2></div>

<div>
    <form class="formulario-base" method="POST" action="{{ route('compras.store') }}">
    @csrf
    <h3 class="centrar-texto">Datos generales</h3>

    <div class="separador 25"></div>

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
        <textarea id="observaciones" name="observaciones" class="form-input" placeholder="Observaciones (opcional)">{{ old('observaciones') }}</textarea>
    </div>

    <hr>

    <div id="productos-container">

        <div class="producto-item">
            <div class="form-grupo">
                <label class="form-label">Producto 1</label>
                <select name="id_producto[]" class="form-input">
                    <option value="">Seleccione</option>
                    @foreach($productos as $prod)
                        <option value="{{ $prod->id }}">{{ $prod->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-grupo">
                <label class="form-label">Cantidad 1</label>
                <input type="number" name="cantidad[]" class="form-input" min="1">
            </div>

            <div class="form-grupo">
                <label class="form-label">Costo 1</label>
                <input type="number" step="0.01" name="costo[]" class="form-input">
            </div>

            <div class="separador 60"></div>
        </div>

    </div>

    <div class="centrar-div" style="margin-top: 20px; display:flex; gap:10px; justify-content:center;">
        <button type="button" id="agregarProducto" class="boton" style="background: #005E00"><span class="icono circle-plus 20"></span> Agregar producto</button>
        <button type="button" id="eliminarProducto" class="boton" style="background:#c62828;"> <span class="icono trash 20"></span> Eliminar último</button>
    </div>

    <hr>

    <div class="centrar-div">
        <button type="submit" class="boton centrar-elemento">
            <span class="icono send 24"></span> Guardar compra
        </button>
    </div>

</form>

</div>

@include('includes.footer')

<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('productos-container');
    const btnAdd = document.getElementById('agregarProducto');
    const btnRemove = document.getElementById('eliminarProducto');

    btnAdd.addEventListener('click', function () {
        const count = container.querySelectorAll('.producto-item').length + 1;

        // Crear nuevo bloque
        const newItem = document.createElement('div');
        newItem.classList.add('producto-item');

        newItem.innerHTML = `
            <div class="form-grupo">
                <label class="form-label">Producto ${count}</label>
                <select name="id_producto[]" class="form-input">
                    <option value="">Seleccione</option>
                    @foreach($productos as $prod)
                        <option value="{{ $prod->id }}">{{ $prod->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-grupo">
                <label class="form-label">Cantidad ${count}</label>
                <input type="number" name="cantidad[]" class="form-input" min="1">
            </div>

            <div class="form-grupo">
                <label class="form-label">Costo ${count}</label>
                <input type="number" step="0.01" name="costo[]" class="form-input">
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

