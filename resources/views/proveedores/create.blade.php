@include('includes.header')

<div class="centrar-div"><h2>Agregar Proveedor</h2></div>

<div>
    <form class="formulario-base" method="POST" action="{{ route('proveedores.store') }}">
        @csrf

        <div class="form-grupo">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-input" value="{{ old('nombre') }}" placeholder="Nombre del proveedor">
        </div>

        <div class="form-grupo">
            <label for="persona_contacto" class="form-label">Persona de contacto</label>
            <input type="text" id="persona_contacto" name="persona_contacto" class="form-input" value="{{ old('persona_contacto') }}" placeholder="Nombre de la persona de contacto">
        </div>

        <div class="form-grupo">
            <label for="sitio_web" class="form-label">Sitio web</label>
            <input type="text" id="sitio_web" name="sitio_web" class="form-input" value="{{ old('sitio_web') }}" placeholder="www.ejemplo.com">
        </div>

        <div class="form-grupo">
            <label for="celular" class="form-label">Celular</label>
            <input type="text" id="celular" name="celular" class="form-input" value="{{ old('celular') }}" placeholder="Número de celular">
        </div>

        <div class="form-grupo">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="correo@ejemplo.com">
        </div>

        <div class="centrar-div">
            <button type="submit" class="boton centrar-elemento">
                <span class="icono send"></span> Guardar proveedor
            </button>
        </div>
    </form>
</div>

@include('includes.footer')
