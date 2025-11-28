@include('includes.header')

<div class="centrar-div">
    <div class="centrar-div"><span class="icono chart-pie 120"></span></div>

    <div class="separador 10"></div>

    <h1>Métricas de Compras</h1>

    <div class="centrar-div">
        <a href="{{ route('compras.index') }}" class="boton centrar-boton">
            <span class="icono arrow-big-left 24"></span> Volver a compras
        </a>
    </div>
</div>

{{-- GRAFICO --}}
<div class="columnas centrar-div">
    <div style="width: 100%; padding-bottom: 15px; margin-top: 40px;">
        <h2 style="text-align:center; margin-bottom: 20px;">Compras por Proveedor</h2>
        <div style="width: 100%; overflow-x: auto;">
            <div style="min-width: 900px;">
                <div style="position: relative; width: 100%; height: 320px;">
                    <canvas id="graficoCompras"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contenedor">

    <form class="formulario-base" method="POST" action="{{ route('compras.metricas.rango') }}">
        @csrf

          <h1 class="centrar-texto">Filtrar por rango de fechas</h1>

            <div class="separador 20"></div>

            <div class="form-grupo">
                <label for="fecha_inicio" class="form-label">Fecha inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-input" value="{{ old('fecha_inicio', $fechaInicio ?? '') }}">
            </div>

            <div class="form-grupo">
                <label for="fecha_fin" class="form-label">Fecha fin</label>
                <input type="date" id="fecha_fin" name="fecha_fin" class="form-input" value="{{ old('fecha_fin', $fechaFin ?? '') }}">
            </div

            <div class="centrar-div">
                <button type="submit" class="boton centrar-elemento">
                    <span class="icono send 24"></span> filtrar
                </button>
            </div>
            
    </form>
</div>

{{-- TABLA --}}
<div class="columnas">
    <div class="tabla-responsive padding">
        <table id="miTabla" class="display dataTable">
            <thead>
                <tr>
                    <th>Proveedor</th>
                    <th>Cantidad de Compras</th>
                    <th>Porcentaje</th>
                </tr>
                <tr class="filtros">
                    <th><select class="filtro-columna"></select></th>
                    <th><select class="filtro-columna"></select></th>
                    <th><select class="filtro-columna"></select></th>
                </tr>
            </thead>
            <tbody>
                @if($metricas->isEmpty())
                <tr>
                    <td colspan="3" style="text-align:center;">No hay datos disponibles</td>
                </tr>
                @else
                @foreach($metricas as $m)
                <tr>
                    <td>{{ $m->nombre }}</td>
                    <td>{{ $m->cantidad_compras }}</td>
                    <td>{{ $m->porcentaje }}%</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    new Chart(document.getElementById('graficoCompras'), {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Cantidad de Compras',
                data: @json($cantidades),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
            }]
        },

        options: {
            responsive: true,            // SE ADAPTA AL ANCHO DE LA PÁGINA
            maintainAspectRatio: false,  // PERMITE ALTURA FIJA EN VEZ DE DEFORMARLO

            scales: {
                x: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 60,
                        minRotation: 45
                    }
                },
                y: {
                    beginAtZero: true
                }
            },

            plugins: {
                legend: { display: false },
                tooltip: { enabled: true }
            }
        }
    });

});
</script>

@include('includes.footer')
