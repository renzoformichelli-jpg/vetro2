@include('includes.header')

<div class="separador 20"></div>

<div style="max-width: 900px; margin: auto; padding: 20px; border: 1px solid #ccc; background: #fff;">
    
    <h1 style="text-align:center;">Factura de Compra #{{ $compra->compra_id }}</h1>
    <hr>

    <!-- Datos del proveedor y compra -->
    <div style="display:flex; justify-content:space-between; margin-bottom: 20px;">
        <div>
            <strong>Proveedor:</strong> {{ $compra->proveedor }}<br>
            <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($compra->fecha)->format('d/m/Y') }}<br>
            <strong>Observaciones:</strong> {{ $compra->observaciones ?? '-' }}
        </div>
        <div>
            <strong>ID Compra:</strong> {{ $compra->id }}<br>
        </div>
    </div>

    <!-- Productos -->
    <table style="width:100%; border-collapse: collapse; margin-bottom: 20px;">
        <thead style="background:#f2f2f2;">
            <tr>
                <th style="border:1px solid #ccc; padding:8px;">Producto</th>
                <th style="border:1px solid #ccc; padding:8px;">Cantidad</th>
                <th style="border:1px solid #ccc; padding:8px;">Precio Unitario</th>
                <th style="border:1px solid #ccc; padding:8px;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp

            @foreach($detalles as $det)
                @php
                    $subtotal = $det->precio_unitario * $det->cantidad;
                    $total += $subtotal;
                @endphp
                <tr>
                    <td style="border:1px solid #ccc; padding:8px;">{{ $det->producto }}</td>
                    <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{ $det->cantidad }}</td>
                    <td style="border:1px solid #ccc; padding:8px; text-align:right;">${{ number_format($det->precio_unitario, 2) }}</td>
                    <td style="border:1px solid #ccc; padding:8px; text-align:right;">${{ number_format($subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="font-weight:bold;">
                <td colspan="3" style="border:1px solid #ccc; padding:8px; text-align:right;">Total</td>
                <td style="border:1px solid #ccc; padding:8px; text-align:right;">${{ number_format($total, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="button-grid">

            
            <form action="{{ route('compras.edit', $compra->id) }}" method="GET">
                  <button type="submit" class="boton centrar-elemento" title="Editar">
                      <span></span>Editar compra
                  </button>
              </form>

            <form class="form-eliminar" action="{{ route('compras.destroy', $compra->id) }}" method="POST" ; onsubmit="return confirmarEliminacion(this)">
            @csrf
            @method('DELETE')
            <button type="submit" class="boton centrar-elemento" >
                <span ></span> Eliminar compra
            </button>
            </form>

            
            <a href="{{ route('compras.index') }}" class="boton centrar-elemento">
                <span ></span> Volver al inicio
            </a>
    </div>
</div>

@include('includes.footer')
