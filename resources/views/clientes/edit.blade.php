@include('includes.header')

<div class="centrar-div"><h2>Editar Cliente</h2></div>

<div>
    <form class="formulario-base" method="POST" action="{{ route('clientes.update', $cliente->id) }}">
        @csrf
        @method('PUT')

        <div class="form-grupo">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-input" value="{{ old('nombre', $cliente->nombre) }}" placeholder="Nombre">
        </div>

        <div class="form-grupo">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" id="apellido" name="apellido" class="form-input" value="{{ old('apellido', $cliente->apellido) }}" placeholder="Apellido">
        </div>

        <div class="form-grupo">
            <label for="dni" class="form-label">DNI</label>
            <input type="text" id="dni" name="dni" class="form-input" value="{{ old('dni', $cliente->dni) }}" placeholder="DNI">
        </div>

        <div class="form-grupo">
            <label for="celular" class="form-label">Celular</label>
            <input type="text" id="celular" name="celular" class="form-input" value="{{ old('celular', $cliente->celular) }}" placeholder="Celular">
        </div>

        <div class="form-grupo">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-input" value="{{ old('email', $cliente->email) }}" placeholder="Email">
        </div>

        <div class="form-grupo">
            <label for="nacimiento" class="form-label">Fecha de nacimiento</label>
            <input type="date" id="nacimiento" name="nacimiento" class="form-input" value="{{ old('nacimiento', $cliente->nacimiento) }}">
        </div>

        <div class="form-grupo">
            <label class="form-label">Edad (calculada)</label>
            <input type="text" class="form-input" value="{{ $cliente->edad }}" disabled>
        </div>

        <div class="centrar-div">
            <button type="submit" class="boton centrar-elemento">
                <span class="icono send"></span> Guardar cambios
            </button>
        </div>

    </form>
</div>

@include('includes.footer')
