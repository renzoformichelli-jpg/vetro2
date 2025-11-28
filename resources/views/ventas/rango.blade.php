@include('includes.header')

<div class="centrar-div">
    <div class="centrar-div"><span class="icono chart-pie 120"></span></div>
    <div class="separador 10"></div>
    <h1>Métricas de Ventas por Rango</h1>
    <p style="text-align:center; font-weight:bold; margin-bottom:20px;">
        Desde: {{ \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y') }} 
        hasta: {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y') }}
    </p>
    <div class="centrar-div">
        <a href="{{ route('ventas.metricas') }}" class="boton centrar-boton">
            <span class="icono arrow-big-left 24"></span> Volver a métricas
        </a>
    </div>
</div>

{{-- GRAFICO --}}
<div class="columnas centrar-div">
    <div style="width: 100%; padding-bottom:15px; margin-top:40px;">
        <h2 style="text-align:center; margin-bottom:20px;">Ventas por Cliente</h2>
        <div style="width:100%; overflow-x:auto;">
            <div style="min-width:900px;">
                <div style="position:relative; width:100%; height:320px;">
                    <canvas id="graficoVentasRango"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- TABLA --}}
<div class="columnas">
    <div class="tabla-responsive padding">
        <table id="miTabla" class="display dataTable">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Cantidad de Ventas</th>
                    <th>Porcentaje</th>
                    <th>Valor Total</th>
                </tr>
                <tr class="filtros">
                    <th><select class="filtro-columna"></select></th>
                    <th><select class="filtro-columna"></select></th>
                    <th><select class="filtro-columna"></select></th>
                    <th><select class="filtro-columna"></select></th>
                </tr>
            </thead>
            <tbody>
                @if($metricas->isEmpty())
                <tr>
                    <td colspan="4" style="text-align:center;">No hay datos disponibles para este rango</td>
                </tr>
                @else
                @foreach($metricas as $m)
                <tr>
                    <td>{{ $m->nombre }}</td>
                    <td>{{ $m->cantidad_ventas }}</td>
                    <td>{{ $m->porcentaje }}%</td>
                    <td>${{ number_format($m->valor_total, 2, ',', '.') }}</td>
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
    new Chart(document.getElementById('graficoVentasRango'), {
        type: 'bar',
        data: {
            labels: @json($labels->isEmpty() ? ['Sin Datos'] : $labels),
            datasets: [{
                label: 'Cantidad de Ventas',
                data: @json($cantidades->isEmpty() ? [0] : $cantidades),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { x: { ticks: { autoSkip: false, maxRotation: 60, minRotation: 45 } }, y: { beginAtZero: true } },
            plugins: { legend: { display: false }, tooltip: { enabled: true } }
        }
    });
});
</script>

@include('includes.footer')
