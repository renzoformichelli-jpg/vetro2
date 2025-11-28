@include('includes.header')

<div class="centrar-div">
    <div class="centrar-div"><span class="icono chart-pie 120"></span></div>
    <div class="separador 10"></div>

    <h1>Métricas de Ventas</h1>

    <div class="centrar-div">
        <a href="{{ route('ventas.index') }}" class="boton centrar-boton">
            <span class="icono arrow-big-left 24"></span> Volver a ventas
        </a>
    </div>
</div>

{{-- CAJITA DEL GRÁFICO + LISTA + TOTAL HISTÓRICO A LA DERECHA --}}
<div class="columnas centrar-div">
    <div style="width: 100%; padding-bottom: 15px; margin-top: 40px;">

        <h2 style="text-align:center; margin-bottom: 20px;">Ventas por Cliente</h2>

        <div style="width: 100%; overflow-x: auto;">
            <div style="min-width: 900px;">

                {{-- ROW: GRÁFICO A LA IZQUIERDA + TOTAL HISTÓRICO --}}
                <div style="display:flex; width:100%; gap:20px;">

                    {{-- GRÁFICO --}}
                    <div style="flex:3; position: relative; height: 320px;">
                        <canvas id="graficoVentas"></canvas>
                    </div>

                    {{-- TOTAL HISTÓRICO --}}
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
                        Total histórico<br><br>

                        {{-- TOTAL GANADO --}}
                        Ganancia total: ${{ number_format($totalGanado, 0, ',', '.') }} <br><br>

                        {{-- TOTAL DE VENTAS --}}
                        Cantidad total: {{ $totalVentas }}
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

                {{-- LISTA PLEGADA --}}
                <div id="listaContainer" style="display:none; margin-top: 30px; padding: 20px;">
                    <ul style="list-style:none; padding:0;">
                        @foreach($metricas as $m)
                            <li style="background:#f5f5f5; padding:15px; border-radius:10px; margin-bottom:15px;">
                                <strong style="font-size:18px;">{{ $m->nombre }}</strong>
                                <br><br>
                                • Cantidad de ventas: {{ $m->cantidad_ventas }} <br>
                                • Porcentaje: {{ $m->porcentaje }}%
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>

    </div>
</div>

{{-- FORMULARIO ABAJO --}}
<div style="margin-top:50px; padding:20px;">
    <form method="POST" action="{{ route('ventas.metricas.rango') }}" class="formulario-base">
        @csrf
        <h1 class="centrar-texto">Filtrar por fechas</h1>

        <div class="form-grupo">
            <label for="fecha_inicio" class="form-label">Fecha inicio</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-input"
                value="{{ old('fecha_inicio') }}">
        </div>

        <div class="form-grupo">
            <label for="fecha_fin" class="form-label">Fecha fin</label>
            <input type="date" id="fecha_fin" name="fecha_fin" class="form-input"
                value="{{ old('fecha_fin') }}">
        </div>

        <div class="centrar-div">
            <button type="submit" class="boton centrar-elemento">
                <span class="icono send 24"></span> filtrar
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    new Chart(document.getElementById('graficoVentas'), {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Cantidad de Ventas',
                data: @json($cantidades),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
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
