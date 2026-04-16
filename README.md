# ThemeOnGo

Un tema premium, escalable y mantenible para WordPress, construido desde cero para integrarse perfectamente con Elementor. Diseñado pensando en el máximo rendimiento, animaciones fluidas y facilidad de edición en vivo.

## Características Principales

- **Integración Nativa con Elementor:** Totalmente compatible con la edición front-end. Las animaciones y estilos no interfieren ni parpadean cuando se usa el editor visual.
- **Motor de Animaciones Propio:** Animaciones ultra-suaves activadas al hacer scroll (`Intersection Observer`) con detección de visibilidad y compatibilidad total (`Mutation Observer`) para componentes cargados asíncronamente (lazy-loading).
- **Widgets de Elementor Personalizados:** Una suite exclusiva de bloques Elementor diseñados con precisión y altamente personalizables.
- **Configurador del Tema (Customizer):** Gestión global y fácil de colores, topografía, configuración del header, botones CTA y opciones del pie de página.
- **Diseño Responsive:** Layout y widgets completamente adaptables a móviles, tablets y escritorio.

## Elementor Widgets Personalizados

ThemeOnGo incluye los siguientes widgets personalizados. Todos soportan propiedades avanzadas como la inyección de clases CSS por elemento de imagen o módulo:

- `ThemeOnGo Hero Slider`: Un carrusel principal fluido con etiquetas (badges) flotantes personalizables y ajustes por altura.
- `ThemeOnGo Photo Collage`: Mosaico de 3 imágenes (1 principal, 2 secundarias) con opciones de bordes, sombras, etiquetas de texto y soporte para clases CSS (ej. parallax, revelados) de manera individual por cada foto.
- `ThemeOnGo Image Float`: Widget que destaca una imagen flotante sobre el diseño o contenedor.
- `ThemeOnGo Services Filter`: Sistema de tarjetas de servicios filtrables por categoría en pestañas. Soporta cuadrículas de columnas variables y múltiples filtros unificados (ej. "Rostro, Destacado").
- `ThemeOnGo Timeline`: Línea de tiempo responsiva paso-a-paso, ideal para secciones de procesos o de "Cómo funciona".
- `ThemeOnGo Business Hours`: Un bloque estilizado para mostrar los horarios de apertura y cierre de negocio de forma clara.
- `ThemeOnGo Pill Badge`: Tarjetas de información estilo pastilla. Ahora soporta saltos de línea y múltiples líneas de texto.

## Sistema de Animación y Clases Utilitarias (CSS)

El tema integra utilidades listas para usar mediante la pestaña **Clases CSS** dentro de la sección "Avanzado" de los widgets de Elementor.

### Animaciones de Entrada (Scroll Reveal)
Se activan automáticamente cuando el elemento entra en pantalla.
- `.reveal-up` / `.reveal-down`
- `.reveal-left` / `.reveal-right`
- `.reveal-fade` (Aparición de desvanecimiento simple)
- `.reveal-zoom` (Aparición con pequeña escala de aumento progresivo)

### Retrasos de Animación (Delay)
Añaden tiempos de retraso para crear secuencias de animaciones orgánicas al entrar a la vista.
- `.delay-100` a `.delay-1000` (Saltos de 100ms)
- *Ejemplo de uso:* Añade clase `reveal-up delay-300` al widget.

### Efectos Hover (Hover Interactions)
Para conseguir que los elementos se sientan vivos e interactivos cuando el usuario pasa el ratón:
- `.hover-lift` (Sutil elevación con aumento de sombra)
- `.hover-grow` / `.hover-shrink` (Efectos de escala al sobre-posar)
- `.hover-brighten` / `.hover-blur` (Efectos de filtro de imagen en hover)

### Animaciones Continuas
Para elementos como medallas (badges), stickers o iconos dinámicos flotantes:
- `.animate-float` / `.animate-float-slow` / `.animate-float-fast`
- `.animate-pulse-gold` / `.animate-pulse-green`
- `.animate-bounce`
- `.animate-shine` 

### Efecto Parallax
- **`.parallax-element`**: Al aplicarlo junto con el atributo custom `data-speed="0.05"` al HTML de un tag, el script `main.js` reacciona al scroll generando un ligero movimiento 3D. 

### Contadores Animados (Count-up Numbers)
Se puede utilizar Javascript para animar números de "0 a X" usando la clase `.count-up`.
- `data-target`: Para establecer el valor a llegar.
- `data-suffix`: Para incluir prefijos/sufijos tras el contador animado (ej. `+`, `%`).

## Estructura del Tema

- `assets/css/main.css`: Sistema de estilo núcleo, helpers y animaciones CSS (keyframes puros que eluden conflictos de especificidad de Elementor).
- `assets/js/main.js`: Lógica base del sitio (menu scroll, Intersection Observer, Mutation Observer que revisa el estado `elementor-editor-active`).
- `inc/elementor-widgets/`: Clases PHP individuales para registrar la lógica, UI del editor y el render del código para cada Custom Widget.
- `header.php` y `footer.php`: Componentes universales de diseño, totalmente dependientes de las Settings de WP Customizer.

## Autor
Desarrollado para la creación de Landing pages y directorios autogestionados y completamente premium. Creado por **DevOnGo**.
