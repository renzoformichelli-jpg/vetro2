@include('includes.header')

<div class="centrar-div">
    <div class="centrar-div"><span class="icono chart-pie 120"></span></div>

    <div class="separador 10"></div>

    <h1>Métricas de Compras por Rango</h1>
    <p style="text-align:center; font-weight: bold; margin-bottom: 20px;">
        Desde: {{ \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y') }} 
        hasta: {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y') }}
    </p>

    <div class="centrar-div">
        <a href="{{ route('compras.metricas') }}" class="boton centrar-boton">
            <span class="icono arrow-big-left 24"></span> Volver a métricas
        </a>
    </div>
</div>

{{-- CAJITA DEL GRÁFICO + LISTA + TOTAL A LA DERECHA --}}
<div class="columnas centrar-div">
    <div style="width: 100%; padding-bottom: 15px; margin-top: 40px;">

        <h2 style="text-align:center; margin-bottom: 20px;">Compras por Proveedor</h2>

        <div style="width: 100%; overflow-x: auto;">
            <div style="min-width: 900px;">

                {{-- ROW: GRÁFICO A LA IZQUIERDA + TOTAL A LA DERECHA --}}
                <div style="display:flex; width:100%; gap:20px;">

                    {{-- GRÁFICO --}}
                    <div style="flex:3; position: relative; height: 320px;">
                        <canvas id="graficoComprasRango"></canvas>
                    </div>

                    {{-- TOTAL (NO HISTÓRICO) --}}
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
                        Total<br>
                        ${{ number_format($metricas->sum('costo_total'), 2, ',', '.') }}
                    </div>

                </div>

                {{-- BOTÓN PARA MOSTRAR/OCULTAR LISTA --}}
                <div style="margin-top:25px;">
                    <button 
                        id="toggleListaBtn" 
                        class="boton" 
                        style="width:230px;"
                    >
                        Mostrar detalle ▼
                    </button>
                </div>

                {{-- LISTA (PLEGADA POR DEFECTO) --}}
                <div id="listaContainer" style="display:none; margin-top: 30px; padding: 20px;">

                    @if($metricas->isEmpty())
                        <p style="text-align:center; font-weight:bold;">No hay datos disponibles para este rango</p>
                    @else
                        <ul style="list-style:none; padding:0;">
                            @foreach($metricas as $m)
                                <li style="background:#f5f5f5; padding:15px; border-radius:10px; margin-bottom:15px;">
                                    <strong style="font-size:18px;">{{ $m->nombre }}</strong>
                                    <br><br>
                                    • Cantidad de compras: {{ $m->cantidad_compras }} <br>
                                    • Costo total: ${{ number_format($m->costo_total, 2, ',', '.') }} <br>
                                    • Porcentaje: {{ $m->porcentaje }}%
                                </li>
                            @endforeach
                        </ul>
                    @endif

                </div>

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    new Chart(document.getElementById('graficoComprasRango'), {
        type: 'bar',
        data: {
            labels: @json($labels->isEmpty() ? ['Sin Datos'] : $labels),
            datasets: [{
                label: 'Cantidad de Compras',
                data: @json($cantidades->isEmpty() ? [0] : $cantidades),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

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

    // === BOTÓN DESPLEGABLE ===
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
