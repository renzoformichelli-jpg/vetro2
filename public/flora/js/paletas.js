/* ==========================================
            FLORA CSS Library
      Autor: Santiago Elías Formichelli
    Framework Frontend para proyectos web
=========================================== */

// ==================== Definición de paletas ====================
const paletas = {
  rojo: {
    nombre: "rojo",
    colores: ["#BC0000", "#680003", "#F5704A", "#828D00", "#E67E7E"],
    variables: {
      "--color-primario": "#BC0000",
      "--color-secundario": "#680003",
      "--color-terciario": "#F5704A",
      "--color-contraste": "#828D00",
      "--color-extra": "#E67E7E",

      "--color-fondo": "#FFDEDE",
      "--color-superficie": "#FFEBEB",
      "--color-borde": "#E8E8E8",
      "--color-texto": "#0F0F0F"
    }
  },
  naranja: {
    nombre: "naranja",
    colores: ["#DA6A00", "#14471E", "#68904D", "#D47113", "#EE9B01"],
    variables: {
      "--color-primario": "#DA6A00",
      "--color-secundario": "#14471E",
      "--color-terciario": "#68904D",
      "--color-contraste": "#D47113",
      "--color-extra": "#EE9B01",

      "--color-fondo": "#FFEEDE",
      "--color-superficie": "#FFF5ED",
      "--color-borde": "#E8E8E8",
      "--color-texto": "#0F0F0F"
    }
  },
  amarillo: {
    nombre: "amarillo",
    colores: ["#45662D", "#002B17", "#839C9E", "#876F0E", "#CCA400"],
    variables: {
      "--color-primario": "#45662D",
      "--color-secundario": "#002B17",
      "--color-terciario": "#839C9E",
      "--color-contraste": "#876F0E",
      "--color-extra": "#CCA400",

      "--color-fondo": "#FFF7E0",
      "--color-superficie": "#FFFDF5",
      "--color-borde": "#E8E8E8",
      "--color-texto": "#0F0F0F"
    }
  },
  celeste: {
    nombre: "celeste",
    colores: ["#3B9EA1", "#4B5750", "#EB8571", "#027683", "#51BFE8"],
    variables: {
      "--color-primario": "#3B9EA1",
      "--color-secundario": "#4B5750",
      "--color-terciario": "#EB8571",
      "--color-contraste": "#027683",
      "--color-extra": "#51BFE8",

      "--color-fondo": "#D6F7FF",
      "--color-superficie": "#EDFBFF",
      "--color-borde": "#E8E8E8",
      "--color-texto": "#0F0F0F"
    }
  },
  azul: {
    nombre: "azul",
    colores: ["#114161", "#001C36", "#4D4D4D", "#7D7D7D", "#70A7D4"],
    variables: {
      "--color-primario": "#114161",
      "--color-secundario": "#001C36",
      "--color-terciario": "#4D4D4D",
      "--color-contraste": "#7D7D7D",
      "--color-extra": "#70A7D4",

      "--color-fondo": "#D9E9FF",
      "--color-superficie": "#E3F2FF",
      "--color-borde": "#E8E8E8",
      "--color-texto": "#0F0F0F"
    }
  },
  rosa: {
    nombre: "rosa",
    colores: ["#9C3432", "#FF5D57", "#FA9796", "#853131", "#FF8985"],
    variables: {
      "--color-primario": "#9C3432",
      "--color-secundario": "#FF5D57",
      "--color-terciario": "#FA9796",
      "--color-contraste": "#853131",
      "--color-extra": "#FF8985",

      "--color-fondo": "#FFE5E5",
      "--color-superficie": "#FFF2F2",
      "--color-borde": "#E8E8E8",
      "--color-texto": "#0F0F0F"
    }
  },
  violeta: {
    nombre: "violeta",
    colores: ["#5C3D80", "#250E61", "#CE6EE6", "#9B45BA", "#B384E3"],
    variables: {
      "--color-primario": "#5C3D80",
      "--color-secundario": "#250E61",
      "--color-terciario": "#CE6EE6",
      "--color-contraste": "#9B45BA",
      "--color-extra": "#B384E3",

      "--color-fondo": "#EFE5FF",
      "--color-superficie": "#F6F0FF",
      "--color-borde": "#E8E8E8",
      "--color-texto": "#0F0F0F"
    }
  },
  negro: {
    nombre: "negro",
    colores: ["#F7F7F7", "#E3E3E3", "#ADADAD", "#8A8A8A", "#707070"],
    variables: {
      "--color-primario": "#F7F7F7",
      "--color-secundario": "#E3E3E3",
      "--color-terciario": "#ADADAD",
      "--color-contraste": "#8A8A8A",
      "--color-extra": "#707070",

      "--color-fondo": "#292929",
      "--color-superficie": "#1F1F1F",
      "--color-borde": "#D1D1D1",
      "--color-texto": "#FAFAFA"
    }
  }
};

// ==================== Función para aplicar paleta ====================
function aplicarPaleta(nombre) {
  const paleta = paletas[nombre];
  if (!paleta) return;

  for (const variable in paleta.variables) {
    document.documentElement.style.setProperty(variable, paleta.variables[variable]);
  }

  // Actualizar fondo del selectBox si existe
  const selectBox = document.querySelector(".selector-paletas .select-box");
  if (selectBox) {
    selectBox.style.backgroundColor = paleta.variables["--color-primario"];
  }

  localStorage.setItem("paletaSeleccionada", nombre);
}

// ==================== Renderizado automático ====================
let _resizeListener, _documentClickListener;

function renderizarSelectorDePaletas(idContenedor = "selectorPaletas") {
  const contenedor = document.getElementById(idContenedor);
  if (!contenedor) return;

  contenedor.classList.add("selector-paletas");

  function renderDesktop() {
    contenedor.innerHTML = "";
    for (const clave in paletas) {
      const paleta = paletas[clave];
      const boton = document.createElement("button");
      boton.classList.add("opcion-paleta");
      boton.title = paleta.nombre;

      paleta.colores.forEach(c => {
        const muestra = document.createElement("span");
        muestra.classList.add("muestra-color");
        muestra.style.backgroundColor = c;
        boton.appendChild(muestra);
      });

      boton.addEventListener("click", () => aplicarPaleta(clave));
      contenedor.appendChild(boton);
    }

    const guardada = localStorage.getItem("paletaSeleccionada");
    if (guardada && paletas[guardada]) aplicarPaleta(guardada);
  }

  function renderMobile() {
    contenedor.innerHTML = "";

    const selectBox = document.createElement("div");
    selectBox.classList.add("select-box");
    selectBox.textContent = "Seleccionar paleta de colores";
    selectBox.style.backgroundColor = paletas[localStorage.getItem("paletaSeleccionada")]?.variables["--color-primario"] || "#E8E8E8";
    selectBox.style.cursor = "pointer";
    selectBox.style.display = "flex";
    selectBox.style.alignItems = "center";
    selectBox.style.justifyContent = "space-between";
    selectBox.style.padding = "0.5rem 0.8rem";
    selectBox.style.borderRadius = "8px";
    selectBox.style.color = "var(--color-fondo)";
    selectBox.style.fontWeight = "bold";

    const arrow = document.createElement("span");
    arrow.textContent = "▼";
    arrow.style.marginLeft = "0.5rem";
    selectBox.appendChild(arrow);

    contenedor.appendChild(selectBox);

    const optionsContainer = document.createElement("div");
    optionsContainer.classList.add("options");
    optionsContainer.style.display = "none";
    optionsContainer.style.flexDirection = "column";
    optionsContainer.style.marginTop = "0.3rem";
    contenedor.appendChild(optionsContainer);

    for (const clave in paletas) {
      const paleta = paletas[clave];
      const option = document.createElement("div");
      option.classList.add("option");
      option.style.display = "flex";
      option.style.gap = "1.2rem";
      option.style.padding = "0.6rem";
      option.style.backgroundColor = "var(--color-primario)";
      option.style.cursor = "pointer";
      option.style.alignItems = "center";

      paleta.colores.forEach(c => {
        const span = document.createElement("span");
        span.classList.add("muestra-color");
        span.style.backgroundColor = c;
        span.style.width = "35px";
        span.style.height = "35px";
        span.style.borderRadius = "4px";
        option.appendChild(span);
      });

      option.addEventListener("click", () => {
        aplicarPaleta(clave);
        optionsContainer.style.display = "none";
      });

      optionsContainer.appendChild(option);
    }

    selectBox.addEventListener("click", () => {
      optionsContainer.style.display = optionsContainer.style.display === "flex" ? "none" : "flex";
    });

    _documentClickListener = e => {
      if (!contenedor.contains(e.target)) optionsContainer.style.display = "none";
    };
    document.addEventListener("click", _documentClickListener);
  }

  function actualizarPaletas() {
    if (window.innerWidth < 900) renderMobile();
    else renderDesktop();
  }

  _resizeListener = actualizarPaletas;
  window.addEventListener("resize", _resizeListener);

  actualizarPaletas();
}

// ==================== Inicialización automática ====================
document.addEventListener("DOMContentLoaded", () => {
  const guardada = localStorage.getItem("paletaSeleccionada");
  if (guardada && paletas[guardada]) aplicarPaleta(guardada);

  renderizarSelectorDePaletas();
});