@include('includes.header')

<div class="centrar-div">
    <div class="centrar-div"><span class="icono chart-pie 120"></span></div>

    <div class="separador 10"></div>

    <h1>Métricas de Proveedores</h1>
    
    <div class="centrar-div">
      <a href="{{ route('proveedores.index') }}" class="boton centrar-boton">
        <span class="icono arrow-big-left 24"></span> Volver a proveedores
      </a>
    </div>

</div>

<div class="columnas centrar-div">
  <div style="width: 100%; padding-bottom: 15px; margin-top: 40px;">
    <h2 style="text-align:center; margin-bottom: 20px;">Productos por Proveedor</h2>

    <div style="width: 100%; overflow-x: auto;">
        <div style="min-width: 900px;">
            {{-- Contenedor responsive, altura fija --}}
            <div style="position: relative; width: 100%; height: 320px;">
                <canvas id="graficoProveedores"></canvas>
            </div>
        </div>
    </div>
  </div>
</div>

<div class="columnas">
  <div class="tabla-responsive padding">
    <table id="miTabla" class="display dataTable">
      <thead>
        <tr>
          <th>Proveedor</th>
          <th>Cantidad de Productos</th>
          <th>Porcentaje de productos en stock</th>
        </tr>
        <tr class="filtros">
          <th><select class="filtro-columna"></select></th>
          <th><select class="filtro-columna"></select></th>
          <th><select class="filtro-columna"></select></th>
        </tr>
      </thead>

      <tbody>
        @foreach($metricas as $m)
        <tr>
          <td>{{ $m->nombre }}</td>
          <td>{{ $m->cantidad_productos }}</td>
          <td>{{ $m->porcentaje }}%</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    new Chart(document.getElementById('graficoProveedores'), {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Cantidad de Productos',
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
