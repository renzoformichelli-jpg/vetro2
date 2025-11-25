@include('includes.header')

<div class="centrar-div"><h2>Agregar Producto</h2></div>

<div>
    <form class="formulario-base form-enviar" method="POST" action="{{ route('productos.store') }}">
        @csrf

        <div class="form-grupo">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-input" value="{{ old('nombre') }}" placeholder="Nombre del producto" required>
        </div>

        <div class="form-grupo">
            <label for="costo" class="form-label">Costo</label>
            <input type="number" step="0.01" id="costo" name="costo" class="form-input" value="{{ old('costo') }}" placeholder="Costo del producto" required>
        </div>

        <div class="form-grupo">
            <label for="valor_venta" class="form-label">Valor de venta</label>
            <input type="number" step="0.01" id="valor_venta" name="valor_venta" class="form-input" value="{{ old('valor_venta') }}" placeholder="Valor de venta" required>
        </div>

        <div class="form-grupo">
            <label for="id_proveedores" class="form-label">Proveedor</label>
            <select name="id_proveedores" id="id_proveedores" class="form-input" required>
                <option value="">Selecciona un proveedor</option>
                @foreach($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="centrar-div">
            <button type="submit" class="boton centrar-elemento">
                <span class="icono send"></span> Guardar producto
            </button>
        </div>
    </form>
</div>

@include('includes.footer')
