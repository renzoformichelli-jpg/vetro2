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

{{-- CAJA PRINCIPAL --}}
<div class="columnas centrar-div">
    <div style="width:100%; padding-bottom:15px; margin-top:40px;">

        <h2 style="text-align:center; margin-bottom:20px;">Ventas por Cliente</h2>

        <div style="width:100%; overflow-x:auto;">
            <div style="min-width:900px;">

                {{-- ROW: GRÁFICO + TOTAL --}}
                <div style="display:flex; width:100%; gap:20px;">

                    {{-- GRAFICO --}}
                    <div style="flex:3; position:relative; height:320px;">
                        <canvas id="graficoVentasRango"></canvas>
                    </div>

                    {{-- TOTAL DEL RANGO --}}
                    <div style="
                        flex:1;
                        background:#e8e8e8;
                        border-radius:10px;
                        padding:20px;
                        font-size:20px;
                        font-weight:bold;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        text-align:center;
                    ">
                        Total del rango<br><br>

                        {{-- NUEVO: TOTAL GANADO --}}
                        Ganancia total: ${{ number_format($totalGanadoRango, 0, ',', '.') }} <br><br>

                        {{-- TOTAL DE VENTAS DEL RANGO --}}
                        Cantidad: {{ $totalVentas }}
                    </div>

                </div>

                {{-- BOTÓN DETALLE --}}
                <div style="margin-top:25px;">
                    <button id="toggleListaBtn" class="boton" style="width:230px;">
                        Mostrar detalle ▼
                    </button>
                </div>

                {{-- LISTA DETALLE --}}
                <div id="listaContainer" style="display:none; margin-top: 30px; padding: 20px;">
                    <ul style="list-style:none; padding:0;">
                        @foreach($metricas as $m)
                        <li style="background:#f5f5f5; padding:15px; border-radius:10px; margin-bottom:15px;">
                            <strong style="font-size:18px;">{{ $m->nombre }}</strong>
                            <br><br>
                            • Cantidad de ventas: {{ $m->cantidad_ventas }} <br>
                            • Porcentaje: {{ $m->porcentaje }}% <br>
                            • Total vendido: ${{ number_format($m->valor_total, 2, ',', '.') }} <br>
                            • Proveedores involucrados: {{ $m->proveedores ?: 'Sin datos' }}
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>

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
            scales: {
                x: { ticks: { autoSkip: false, maxRotation: 60, minRotation: 45 }},
                y: { beginAtZero: true }
            },
            plugins: { legend: { display: false } }
        }
    });

    let btn = document.getElementById("toggleListaBtn");
    let cont = document.getElementById("listaContainer");

    btn.addEventListener("click", function () {
        if (cont.style.display === "none") {
            cont.style.display = "block";
            btn.textContent = "Ocultar detalle ▲";
        } else {
            cont.style.display = "none";
            btn.textContent = "Mostrar detalle ▼";
        }
    });

});
</script>

@include('includes.footer')
