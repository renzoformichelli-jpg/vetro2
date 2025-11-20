document.addEventListener("DOMContentLoaded", () => {
  // 1. Reemplazar íconos individuales con clase `.icono [nombre-icono]`
  document.querySelectorAll('.icono').forEach(async el => {
    const allClasses = Array.from(el.classList);
    
    const iconName = allClasses.find(cls => cls !== 'icono' && isNaN(Number(cls)) === true);
    const sizeClass = allClasses.find(cls => !isNaN(Number(cls)));

    const size = sizeClass ? `${sizeClass}px` : '1em';

    if (!iconName) return;

    try {
      const res = await fetch(`${window.iconBaseUrl}/${iconName}.svg`);          // ->esta es la ruta para server real
      /*const res = await fetch(`http://localhost/flora/iconos/data/${iconName}.svg`);     */      // ->esta es la ruta para server XAMPP local
      if (!res.ok) throw new Error(`No se encontró: ${iconName}`);
      const svgText = await res.text();

      const temp = document.createElement('div');
      temp.innerHTML = svgText;
      const svg = temp.querySelector('svg');

      if (svg) {
        // Copiar todas las clases menos el nombre del ícono y el tamaño
        const inheritedClasses = allClasses.filter(cls => cls !== 'icono' && cls !== iconName && cls !== sizeClass);
        svg.classList.add('icono', ...inheritedClasses);

        // Aplicar tamaño dinámicamente
        svg.setAttribute('width', size);
        svg.setAttribute('height', size);
        svg.style.verticalAlign = 'middle';

        el.replaceWith(svg);
      }
    } catch (err) {
      console.warn(`Error al cargar icono ${iconName}:`, err);
    }
  });

  // 2. Mostrar todos los íconos (tu sistema actual con script.php)
  const grid = document.getElementById("icon-grid");
  const search = document.getElementById("search");

  fetch("script.php")
    .then(res => res.json())
    .then(icons => {
      renderIcons(icons);

      search.addEventListener("input", () => {
        const term = search.value.toLowerCase();
        const filtered = icons.filter(icon => icon.name.toLowerCase().includes(term));
        renderIcons(filtered);
      });
    });

  function renderIcons(icons) {
    grid.innerHTML = "";
    icons.forEach(icon => {
      const div = document.createElement("div");
      div.className = "icon";
      div.innerHTML = icon.svg + `<div class="icon-name">${icon.name}</div>`;
      div.addEventListener("click", async (e) => {
        const nombre = icon.name;
        const html = `<i class="icono ${nombre} 80"></i>`;

        try {
          await navigator.clipboard.writeText(html);

          // Crear y mostrar el toast
          const toast = document.createElement("div");
          toast.className = "toast";
          toast.textContent = "¡Copiado al portapeles!";
          document.body.appendChild(toast);

          // Posicionar el toast fijo arriba, centrado
          toast.style.position = "fixed";
          toast.style.top = "20px";
          toast.style.left = "50%";
          toast.style.transform = "translateX(-50%)";
          toast.style.zIndex = "9999";

          requestAnimationFrame(() => toast.classList.add("show"));

          setTimeout(() => {
            toast.classList.remove("show");
            setTimeout(() => toast.remove(), 600);
          }, 3000);

        } catch (error) {
          console.error("No se pudo copiar:", error);
          alert("Error al copiar el HTML.");
        }
      });

      grid.appendChild(div);
    });
  }
});

