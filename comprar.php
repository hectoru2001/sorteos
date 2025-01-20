<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RyS Juárez</title>
  <link rel="stylesheet" href="_astro/index.D0LijpIM.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="icon" href="img/logo.png" type="image/x-icon" />
  <script type="module">
      const e = document.getElementById("menu-toggle"),
        n = document.getElementById("mobile-menu");
      e.addEventListener("click", () => {
        n.classList.toggle("hidden");
      });
    </script>
</head>

<body>
    <!-- Header -->
    <header class="bg-gray-900 text-white shadow-lg">
      <div
        class="container mx-auto flex justify-between items-center py-4 px-6"
      >
        <!-- Logo -->
        <div class="flex items-center space-x-3">
          <img src="img/logo1.png" alt="Logo Sorteos RyS" class="h-10" />
          <span class="text-2xl font-bold">RyS Juárez</span>
        </div>
        <!-- Navegación (visible solo en pantallas grandes) -->
        <nav class="hidden md:flex space-x-6">
          <a
            href="https://www.rysjuarez.com.mx/"
            class="text-gray-300 hover:text-white transition"
            >Inicio</a
          >
          <a
            href="https://www.rysjuarez.com.mx/#reglas"
            class="text-gray-300 hover:text-white transition"
            >Reglas</a
          >
          <a
            href="https://www.rysjuarez.com.mx/#faq"
            class="text-gray-300 hover:text-white transition"
            >Preguntas Frecuentes</a
          >
        </nav>

        <!-- Botón del menú móvil (solo en pantallas pequeñas) -->
        <button
          class="md:hidden text-gray-300 focus:outline-none"
          id="menu-toggle"
        >
          <i class="fas fa-bars"></i>
        </button>
      </div>
      <!-- Menú móvil (visible solo en pantallas pequeñas) -->
      <div id="mobile-menu" class="hidden bg-gray-800 md:hidden">
        <nav class="flex flex-col space-y-3 p-4">
          <a
            href="https://www.rysjuarez.com.mx/"
            class="text-gray-300 hover:text-white transition"
            >Inicio</a
          >
          <a
            href="https://www.rysjuarez.com.mx/#reglas"
            class="text-gray-300 hover:text-white transition"
            >Reglas</a
          >
          <a href="#faq" class="text-gray-300 hover:text-white transition"
            >Preguntas Frecuentes</a
          >
        </nav>
      </div>
    </header>

  <!-- Contenedor principal -->
  <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
    <!-- Título -->
    <h1 class="text-3xl font-bold text-center text-gray-900 mb-6">
      ¡Gran Premio!
    </h1>

    <!-- Imagen del premio -->
    <div class="flex justify-center mb-6">
      <img src="img/fondo.jpg" alt="Premio: Viaje a Colombia" class="rounded-lg shadow-md">
    </div>

    <!-- Descripción del premio -->
    <p class="text-lg text-center text-gray-700 mb-6">
      Participa para ganar un increíble <span class="font-semibold">viaje a Colombia</span>, donde podrás explorar sus paisajes únicos, su rica cultura y su deliciosa gastronomía. 
      Si prefieres, también puedes elegir <span class="font-semibold">$35,000 pesos mexicanos</span> en efectivo. ¡La decisión es tuya!
    </p>

    <!-- Opciones del premio -->
    <div class="text-center">
      <h2 class="text-xl font-bold text-gray-800 mb-4">Elige tu recompensa:</h2>
      <ul class="list-none">
        <li class="mb-4">
          <span class="text-lg font-medium">🌍 Viaje a Colombia</span>
          
        </li>
        <li> O </li>
        <li>
          <span class="text-lg font-medium">💵 $35,000 pesos mexicanos</span>
          
        </li>
      </ul>
    </div>
  </div>

  <!-- Contenidooooo -->

  <div class="container mx-auto px-6 py-8">
    <!-- Input de búsqueda -->
    <div class="mb-6">
      <label for="searchInput" class="block text-lg font-medium text-gray-700 mb-3">Buscar número:</label>
      <input type="text" id="searchInput" placeholder="Busca un número..." class="p-3 border-2 border-gray-300 rounded-lg w-full text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      <div id="numberStatus" class="mt-3 text-lg"></div>
    </div>

    <!-- Sección para seleccionar el número de boletos -->
    <div class="mb-6">
      <label for="boletosCount" class="block text-lg font-medium text-gray-700 mb-3">Selecciona la cantidad de boletos:</label>
      <select id="boletosCount" class="p-3 border-2 border-gray-300 rounded-lg w-full text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <!-- Opciones del combobox -->
        <option value="1">1</option>
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
        <option value="50">50</option>
      </select>
    </div>


    <!-- Botón para generar los números al azar -->
    <div class="flex justify-center">
      <button id="generateRandomNumbers" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Generar números al azar</button>
    </div>


  <!-- Barra superior fija con números seleccionados -->
  <div id="selectedNumbersBar" class="fixed top-0 left-0 w-full bg-gray-800 p-4 md:p-6 rounded-b-lg border-b border-gray-700 shadow-xl z-50 hidden">
    <div class="flex flex-col items-center max-w-7xl mx-auto gap-4">
      <!-- Título -->
      <h4 class="font-semibold text-lg md:text-2xl text-white text-center">
        Números seleccionados:
      </h4>
      <!-- Contenedor de la lista con barra de desplazamiento -->
      <div id="selectedNumbersList" 
          class="flex flex-wrap gap-3 list-none justify-center p-3 border-2 border-gray-300 rounded-lg max-h-40 mx-auto overflow-y-auto">
        <!-- Opciones dinámicas -->
      </div>
      <!-- Total y botón debajo de los números -->
      <div class="w-full flex flex-col md:flex-row justify-between items-center mt-4 gap-4">
        <!-- Total -->
        <div id="totalAmount" class="text-lg md:text-2xl font-semibold text-gray-300">
          Total: $0
        </div>
        <!-- Botón -->
        <button id="reserveButton" class="px-4 py-2 md:px-6 md:py-3 bg-gray-700 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 text-sm md:text-lg">
          Apartar Números
        </button>
      </div>
    </div>
  </div>






    <!-- Indicador de carga -->
    <div id="loadingIndicator" class="flex justify-center items-center mb-6 mt-6">
      <div class="loader border-4 border-t-transparent border-blue-500 border-solid w-20 h-20 rounded-full animate-spin"></div>
    </div>

    <!-- Contenedor de rangos -->
    <div id="rangosContainer" class="mt-6"></div>
  </div>

  <!-- Modal -->
  <div id="reserveModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-gradient-to-br from-white to-gray-100 rounded-2xl shadow-2xl p-6 w-11/12 sm:w-4/5 md:w-96 lg:w-1/3">
      <!-- Encabezado -->
      <h3 class="text-center text-2xl font-bold text-indigo-700 mb-6">
        <i class="fas fa-ticket-alt text-indigo-500"></i> Confirmar boletos
      </h3>

      <div id="rangosContainer" class=""></div>




    <!-- Formulario -->
    <form id="reservationForm" class="space-y-5">
      <!-- Campo Nombre -->
      <div class="flex flex-col">
        <label for="name" class="block text-lg font-medium text-gray-700">Nombre</label>
        <input type="text" id="name" name="name" class="mt-1 p-3 border border-indigo-300 rounded-lg text-gray-700 focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-400" placeholder="Tu nombre" required>
      </div>

      <!-- Campo Celular -->
      <div class="flex flex-col">
        <label for="phone" class="block text-lg font-medium text-gray-700">Celular</label>
        <input type="tel" id="phone" name="phone" class="mt-1 p-3 border border-indigo-300 rounded-lg text-gray-700 focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-400" placeholder="Tu celular" required>
      </div>

      <!-- Campo Estado -->
      <div class="flex flex-col">
        <label for="estado" class="block text-lg font-medium text-gray-700">Estado</label>
        <select id="estado" name="estado" class="mt-1 p-3 border border-indigo-300 rounded-lg text-gray-700 focus:ring-indigo-500 focus:border-indigo-500">
          <option value="">Selecciona un estado</option>
          <option value="Aguascalientes">Aguascalientes</option>
          <option value="Baja California">Baja California</option>
          <option value="Baja California Sur">Baja California Sur</option>
          <option value="Campeche">Campeche</option>
          <option value="Chihuahua">Chihuahua</option>
          <option value="Coahuila">Coahuila</option>
          <option value="Colima">Colima</option>
          <option value="Durango">Durango</option>
          <option value="Guanajuato">Guanajuato</option>
          <option value="Guerrero">Guerrero</option>
          <option value="Hidalgo">Hidalgo</option>
          <option value="Jalisco">Jalisco</option>
          <option value="Estado de México">Estado de México</option>
          <option value="Michoacán">Michoacán</option>
          <option value="Morelos">Morelos</option>
          <option value="Nayarit">Nayarit</option>
          <option value="Nuevo León">Nuevo León</option>
          <option value="Oaxaca">Oaxaca</option>
          <option value="Puebla">Puebla</option>
          <option value="Querétaro">Querétaro</option>
          <option value="Quintana Roo">Quintana Roo</option>
          <option value="San Luis Potosí">San Luis Potosí</option>
          <option value="Sinaloa">Sinaloa</option>
          <option value="Sonora">Sonora</option>
          <option value="Tabasco">Tabasco</option>
          <option value="Tamaulipas">Tamaulipas</option>
          <option value="Tlaxcala">Tlaxcala</option>
          <option value="Veracruz">Veracruz</option>
          <option value="Yucatán">Yucatán</option>
          <option value="Zacatecas">Zacatecas</option>
        </select>
      </div>

      <!-- Botones -->
      <div class="flex flex-col sm:flex-row gap-4">
        <button type="button" id="closeModalButton" class="flex-1 bg-gray-600 text-white font-medium py-3 px-5 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-all">
          Cerrar
        </button>
        <button id="enviarMensajeWhatsApp" class="flex-1 bg-indigo-600 text-white font-medium py-3 px-5 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
          Confirmar
        </button>
      </div>
    </form>

    </div>
  </div>



  <script type="text/javascript" src="./v2/functions.js"></script>











  <footer class="bg-gray-900 text-gray-300 py-8">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Sección 1: Información -->
      <div>
        <h3 class="text-lg font-semibold text-white mb-4">Sorteos RyS</h3>
        <p>Organizamos sorteos con premios increíbles para la republica mexicana.</p>
      </div>

      <!-- Sección 2: Enlaces rápidos -->
      <div>
        <h3 class="text-lg font-semibold text-white mb-4">Enlaces Rápidos</h3>
        <ul class="space-y-2">
          <li><a href="#descripcion" class="hover:text-white transition">Inicio</a></li>
          <li><a href="#reglas" class="hover:text-white transition">Reglas</a></li>
          <li><a href="#faqSection" class="hover:text-white transition">FAQ</a></li>
          <li><a href="#como-participar" class="hover:text-white transition">Cómo Participar</a></li>
        </ul>
      </div>

      <!-- Sección 3: Contacto -->
      <div>
        <h3 class="text-lg font-semibold text-white mb-4">Contacto</h3>
        <p>Facebook: <a href="https://www.facebook.com/SorteosRys" class="text-blue-400 hover:text-blue-300">SorteosRys</a></p>
        <p>WhatsApp: <a href="https://wa.me/526566789012" class="text-blue-400 hover:text-blue-300">+52 656 678 9012</a></p>
      </div>

    </div>

    <!-- Línea divisoria -->
    <div class="border-t border-gray-700 mt-8 pt-6 text-center">
      <p class="text-sm">&copy; 2024 Sorteos RyS. Todos los derechos reservados.</p>
    </div>
  </footer>

</body>

</html>