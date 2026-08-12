```markdown
# Focopus Prints 👕🐙

Focopus Prints es una plataforma de comercio electrónico desarrollada en PHP y MySQL para la venta y gestión de prendas de vestir personalizadas (camisetas). El proyecto incluye tanto la interfaz de la tienda para el cliente final como un panel de administración completo para el control de inventario y ventas.

## 🚀 Características Principales

### Tienda del Cliente
* **Página Principal de Ofertas:** Un `index` dinámico diseñado para destacar las mejores promociones.
* **Catálogo Segmentado:** Navegación optimizada con secciones dedicadas para productos de hombre y mujer.
* **Carrito de Compras:** Sistema de carrito interactivo que permite a los usuarios agregar, revisar y gestionar sus selecciones antes de la compra.
* **Pasarela de Pago:** Flujo de *checkout* estructurado con páginas de procesamiento y confirmación de éxito.

### Panel de Administración (Dashboard)
El panel administrativo está construido sobre la plantilla **SB Admin 2** y proporciona un control total sobre la lógica del negocio mediante operaciones CRUD:
* **Gestión de Inventario:** Control detallado de Camisetas, Categorías, Tallas y Colores.
* **Gestión de Ventas:** Visualización y administración de Pedidos y Detalles de Pedidos.
* **Visualización de Datos:** Integración con **DataTables** para la fácil búsqueda y paginación de registros, y **Chart.js** para la representación gráfica de métricas de ventas.

## 🛠️ Tecnologías Utilizadas

* **Backend:** PHP
* **Base de Datos:** MySQL
* **Frontend:** HTML5, CSS3, JavaScript
* **Frameworks & Librerías:** 
  * Bootstrap 4 (Plantilla SB Admin 2)
  * jQuery
  * DataTables
  * Chart.js
  * FontAwesome Free

## ⚙️ Instalación y Configuración

1. **Clonar el repositorio:**
   ```bash
   git clone [https://github.com/esdrasbasurto6-afk/focopus-prints.git](https://github.com/esdrasbasurto6-afk/focopus-prints.git)

```

2. **Configuración del Servidor Local:**
Coloca los archivos del proyecto en el directorio raíz de tu servidor local (por ejemplo, `htdocs` en XAMPP o `www` en MAMP).
3. **Base de Datos:**
* Crea una nueva base de datos en MySQL llamada `bd_focopus`.
* Importa el archivo `bd_focopus.sql` (ubicado en la carpeta `base` o `dashboardFocopus/bd`) para estructurar las tablas necesarias.


4. **Conexión a la Base de Datos:**
Verifica y ajusta las credenciales de conexión en los archivos:
* `global/conexion.php`
* `dashboardFocopus/bd/conexion.php`


5. **Ejecución:**
Abre tu navegador y accede a `http://localhost/focopus-prints/index.php`.

## 👨‍💻 Autor

**Esdras Basurto**

Estudiante de Ingeniería en Sistemas, Tecnológico de Colima.

* GitHub: [@esdrasbasurto6-afk](https://www.google.com/search?q=https://github.com/esdrasbasurto6-afk)

---



```

```
