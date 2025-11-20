  </div> <!-- Cierre del div contenedor -->

  <div class="alerta-emergente-fondo alerta-cerrar-sesion">
    <div class="alerta-emergente">
      <div class="alerta-emergente-icono">
        <i class="icono power 110"></i>
      </div>
      <div class="alerta-emergente-texto">
        ¿Desea cerrar sesión?
      </div>
      <div class="alerta-emergente-botones">
        <button class="alerta-emergente-boton si">Sí, cerrar</button>
        <button class="alerta-emergente-boton no" type="button">Cancelar</button>
      </div>
    </div>
  </div>

  <div class="alerta-emergente-fondo alerta-eliminar">
    <div class="alerta-emergente">
      <div class="alerta-emergente-icono">
        <i class="icono trash-2 110"></i>
      </div>
      <div class="alerta-emergente-texto">
        ¿Desea eliminar esta información?
      </div>
      <div class="alerta-emergente-botones">
        <button class="alerta-emergente-boton si">Sí, eliminar</button>
        <button class="alerta-emergente-boton no" type="button">Cancelar</button>
      </div>
    </div>
  </div>

  <div class="alerta-emergente-fondo alerta-enviar">
    <div class="alerta-emergente">
      <div class="alerta-emergente-icono">
        <i class="icono send 110"></i>
      </div>
      <div class="alerta-emergente-texto">
        ¿Desea enviar esta información?
      </div>
      <div class="alerta-emergente-botones">
        <button class="alerta-emergente-boton si">Sí, enviar</button>
        <button class="alerta-emergente-boton no" type="button">Cancelar</button>
      </div>
    </div>
  </div>

  <div class="alerta-emergente-fondo alerta-editar">
    <div class="alerta-emergente">
      <div class="alerta-emergente-icono">
        <i class="icono save 110"></i>
      </div>
      <div class="alerta-emergente-texto">
        ¿Desea editar esta información?
      </div>
      <div class="alerta-emergente-botones">
        <button class="alerta-emergente-boton si">Sí, editar</button>
        <button class="alerta-emergente-boton no" type="button">Cancelar</button>
      </div>
    </div>
  </div>

  <script>
      window.iconBaseUrl = "{{ asset('flora/iconos/data') }}";
  </script>

  <script src="{{ asset('flora/iconos/visor-iconos.js') }}"></script>

  <!-- DataTables JS y jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <!-- Select 2 -->  
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Seleccionamos todos los formularios por clase
      const forms = {
        enviar: document.querySelectorAll(".form-enviar"),
        editar: document.querySelectorAll(".form-editar"),
        eliminar: document.querySelectorAll(".form-eliminar"),
        cerrarSesion: document.querySelectorAll(".form-cerrar-sesion"),
      };

      // Seleccionamos las alertas
      const alertas = {
        enviar: document.querySelector(".alerta-enviar"),
        editar: document.querySelector(".alerta-editar"),
        eliminar: document.querySelector(".alerta-eliminar"),
        cerrarSesion: document.querySelector(".alerta-cerrar-sesion"),
      };

      let formularioActual = null;

      // Mostrar la alerta correspondiente y guardar el formulario que disparó la acción
      function mostrarAlerta(tipo, form) {
        ocultarTodasLasAlertas();
        if (alertas[tipo]) {
          alertas[tipo].style.display = "flex";
          formularioActual = form;
        }
      }

      // Ocultar todas las alertas y limpiar formularioActual
      function ocultarTodasLasAlertas() {
        Object.values(alertas).forEach(alerta => {
          if (alerta) alerta.style.display = "none";
        });
        formularioActual = null;
      }

      // Al iniciar, ocultamos todas las alertas
      ocultarTodasLasAlertas();

      // Agregar listener a cada formulario de cada tipo
      Object.entries(forms).forEach(([tipo, formList]) => {
        formList.forEach(form => {
          form.addEventListener("submit", function (e) {
            e.preventDefault();
            mostrarAlerta(tipo, form);
          });
        });
      });

      // Botones "No" para cerrar la alerta
      document.querySelectorAll(".alerta-emergente-boton.no").forEach(btn => {
        btn.addEventListener("click", () => {
          ocultarTodasLasAlertas();
        });
      });

      // Botones "Si" para enviar el formulario actual
      document.querySelectorAll(".alerta-emergente-boton.si").forEach(btn => {
        btn.addEventListener("click", () => {
          if (formularioActual) {
            formularioActual.submit();
          }
        });
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      const tabla = $('#miTabla').DataTable({
        language: {
          search: "Buscar:",
          lengthMenu: "Mostrar _MENU_ registros por página",
          zeroRecords: "No se encontraron resultados",
          info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
          infoEmpty: "Mostrando 0 a 0 de 0 registros",
          infoFiltered: "(filtrado de _MAX_ registros en total)",
          paginate: {
            first: "Primero",
            last: "Último",
            next: "Siguiente",
            previous: "Anterior"
          }
        },
        lengthMenu: [
          [15, 50, 100, 200, 400, 1000],
          ['15', '50', '100', '200', '400', '1000']
        ],
        orderCellsTop: true,

        /* 🔹 agregado: evitar scroll horizontal y ajustar ancho */
        scrollX: false,
        autoWidth: false,
        responsive: false,

        initComplete: function () {
          const api = this.api();

          // Recorremos las columnas
          api.columns().every(function (colIdx) {
            const column = this;
            const select = $('.filtros th').eq(colIdx).find('select');

            if (!select.length) return;

            // Limpiar y agregar el placeholder
            select.empty().append('<option value="">Filtrar...</option>');

            // Obtener valores únicos y ordenarlos
            const uniqueValues = new Set();
            column.data().each(function (d) {
              if (d) uniqueValues.add(d);
            });

            Array.from(uniqueValues).sort().forEach(function (val) {
              select.append($('<option>').val(val).text(val));
            });

            // Iniciar Select2
            select.select2({
              placeholder: "Filtrar...",
              allowClear: true,
              width: 'resolve',
              language: {
                noResults: function() {
                  return "No se encontraron resultados";
                },
                searching: function() {
                  return "Buscando...";
                },
                inputTooShort: function(args) {
                  return `Escribí al menos ${args.minimum - args.input.length} carácter(es)`;
                },
                errorLoading: function() {
                  return "No se pudieron cargar los resultados";
                },
                loadingMore: function() {
                  return "Cargando más resultados…";
                }
              }
            });

            // Filtrar al seleccionar
            select.on('change', function () {
              const val = $.fn.dataTable.util.escapeRegex($(this).val());
              column.search(val ? '^' + val + '$' : '', true, false).draw();
            });
          });
        }
      });
    });
  </script>

  <script>
    document.querySelectorAll('.separador').forEach(el => {
      const classList = [...el.classList];
      const heightClass = classList.find(cls => /^\d+$/.test(cls));
      if (heightClass) {
        el.style.height = `${heightClass}px`;
      }
    });
  </script>

  <script>
    // Oculta el spinner cuando todo el contenido haya cargado
    window.addEventListener("load", function () {
      const spinner = document.getElementById("spinner-carga");
      if (spinner) {
        spinner.style.display = "none";
      }
    });
  </script>

</body>
</html>
