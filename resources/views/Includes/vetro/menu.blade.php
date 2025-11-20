
<style>
    .texto-boton {
        font-size: 23px;
        
    }
    .margen {
      margin-bottom: 0.5rem;
      margin-top: -2.8rem;
    }
</style>

<div class="columnas margen">
  <div>
    <div class="centrar-div">
      <a href="{{ route('productos.index') }}"> <i class="icono box 100"></i> <br> <div class="centrar-div texto-boton">Productos</div></a>
    </div>
  </div>
  <div>
    <div class="centrar-div">
      <a href="{{ route('proveedores.index') }}"> <i class="icono truck 100"></i> <br> <div class="centrar-div texto-boton">Proveedores</div></a>
    </div>
  </div>
  <div>
    <div class="centrar-div">
      <a href="{{ route('clientes.index') }}"> <i class="icono users 100"></i> <br> <div class="centrar-div texto-boton">Clientes</div></a>
    </div>
  </div>
  <div>
    <div class="centrar-div">
      <a href="{{ route('compras.index') }}"> <i class="icono shopping-cart 100"></i> <br> <div class="centrar-div texto-boton">Compras</div></a>
    </div>
  </div>
  <div>
    <div class="centrar-div">
      <a href="{{ route('ventas.index') }}"> <i class="icono dollar-sign 100"></i> <br> <div class="centrar-div texto-boton">Ventas</div></a>
    </div>
  </div>
</div>