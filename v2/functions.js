document.addEventListener("DOMContentLoaded", () => {
  const totalNumbers = 99999;
  const rangosContainer = document.getElementById("rangosContainer");
  const loadingIndicator = document.getElementById("loadingIndicator");
  const selectedNumbersList = document.getElementById("selectedNumbersList");
  const totalAmount = document.getElementById("totalAmount"); // Elemento donde se mostrará el total
  const searchInput = document.getElementById("searchInput");
  const numberStatus = document.getElementById("numberStatus");

  let selectedNumbers = []; // Array para almacenar los números seleccionados
  let ocupados = new Set(); // Usar un Set para los números ocupados

// Función para manejar la selección de números
const handleNumberSelection = (numero, numeroButton) => {
    const isSelected = numeroButton.classList.contains("bg-yellow-500");

    if (isSelected) {
        numeroButton.classList.remove("bg-yellow-500");
        numeroButton.classList.add("bg-green-700");
        const index = selectedNumbers.indexOf(numero);
        if (index > -1) {
            selectedNumbers.splice(index, 1);
        }
    } else {
        numeroButton.classList.remove("bg-green-700");
        numeroButton.classList.add("bg-yellow-500");
        
        selectedNumbers.push(numero);
    }

    updateSelectedNumbersList();
    updateTotalAmount();  // Actualizar el total después de cada selección
};

// Función para manejar la selección de números
const handleNumberSelection1 = (numero, numeroButton) => {
    const isSelected = numeroButton.classList.contains("bg-yellow-500");

    if (isSelected) {
        numeroButton.classList.remove("bg-yellow-500");
        numeroButton.classList.add("bg-green-700");
        const index = selectedNumbers.indexOf(numero);
        if (index > -1) {

        }
    } else {
        numeroButton.classList.remove("bg-green-700");
        numeroButton.classList.add("bg-yellow-500");
        
    }

    updateSelectedNumbersList();
    updateTotalAmount();  // Actualizar el total después de cada selección
};

const loadNumbers = async () => {
  try {
      const response = await fetch("./v2/numeros.php");
      const data = await response.json();

      // Si no hay datos, inicializar 'ocupados' como un conjunto vacío.
      ocupados = new Set(data.length ? data.map(Number) : []);
      
      loadingIndicator.style.display = "none";
      
      let start = 1;
      const batchSize = 100; // Cargar 100 números a la vez
      
      // Función para cargar un lote de números
      const loadBatch = () => {
          const fragment = document.createDocumentFragment();
          for (let i = start; i < start + batchSize && i < totalNumbers; i++) {
              const numeroButton = createNumberButton(i, ocupados, selectedNumbers);
              fragment.appendChild(numeroButton);
          }
          rangosContainer.appendChild(fragment);
          start += batchSize;
          
          if (start < totalNumbers) {
              // Cargar más cuando el usuario haya llegado al final
              window.requestAnimationFrame(loadBatch); // Usar `requestAnimationFrame` para evitar bloquear el hilo principal
          }
      };

      loadBatch();
  } catch (error) {
      console.error("Error al cargar los números ocupados:", error);
      loadingIndicator.innerHTML = "Error al cargar los números. Intenta nuevamente.";
  }
};




// Función para crear un botón para cada número
const createNumberButton = (numero, ocupados, selectedNumbers) => {
    const numeroButton = document.createElement("button");
    const numeroFormateado = String(numero).padStart(5, "0");
    const isOcupado = ocupados.has(numero);  // Verificar si el número está ocupado
    const isSelected = selectedNumbers.includes(numero);  // Verificar si el número está seleccionado

    numeroButton.textContent = numeroFormateado;
    numeroButton.classList.add("pw-1", "py-1", "rounded", "w-20", "mb-1", "m-0.5");

    if (isOcupado) {
        numeroButton.classList.add("bg-black", "cursor-not-allowed");
        numeroButton.disabled = true; // Deshabilitar el botón si está ocupado
    } else if (isSelected) {
        numeroButton.classList.add("bg-blue-500"); // Resaltar el botón si está seleccionado

    } else {
        numeroButton.classList.add("bg-green-700",  "text-white");
    }

    // Agregar la lógica de selección al hacer clic
    numeroButton.addEventListener("click", () => handleNumberSelection(numero, numeroButton));

    return numeroButton;
};

  // Llamar a la función principal
  loadNumbers();

  

  // Primero define la función updateSelectedNumbersList
  function updateSelectedNumbersList() {
    selectedNumbersList.innerHTML = "";

    if (selectedNumbers.length === 0) {
      document.getElementById("selectedNumbersBar").classList.add("hidden");
    } else {
      selectedNumbers.forEach((num) => {
        const listItem = document.createElement("li");
        listItem.textContent = num;
        listItem.classList.add("bg-blue-100", "px-4", "py-2", "rounded");
        selectedNumbersList.appendChild(listItem);
      });
      document.getElementById("selectedNumbersBar").classList.remove("hidden");
    }
  }

  // Actualizar el total de la selección
  function updateTotalAmount() {
    const total = selectedNumbers.length * 2; // Cada boleto cuesta 2 pesos
    // Formatear el total con comas en los miles y mostrarlo con el símbolo de MXN
    const formattedTotal = total.toLocaleString("es-MX", {
      style: "currency",
      currency: "MXN",
    });

    // Actualizar el texto en el modal para mostrar el total
    totalAmount.textContent = `Total: ${formattedTotal}`;

    return formattedTotal;
  }

  // Función para enviar el mensaje a WhatsApp
  function enviarMensajeWhatsApp() {
    const nombre = document.getElementById("name").value;
    const celular = document.getElementById("phone").value;
    const estado = document.getElementById("estado").value;


    if (!nombre || !celular) {
      alert("Por favor, completa el nombre y el celular.");
      return;
    }

    const numerosApartados = selectedNumbers.join(", ");

    if (!numerosApartados) {
      alert("Por favor, selecciona al menos un número.");
      return;
    }

    // Obtener el total actualizado
    const total = updateTotalAmount();

    // Crear el mensaje con el total
    const mensaje = `
    **Hola, soy ${nombre}**  
    **Celular:** ${celular}  
    **Estado:** ${estado}
    -----------------------------------
    
    **Aparto los siguientes números:**  
    ${numerosApartados}
    
    -----------------------------------
    
    **Total a pagar:** ${total}
    
    -----------------------------------
    
    **Tarjetas de transferencia:**  
    1. **SPIN:** 4217 4701 4173 4786  - Jonathan Garcia
    2. **NU:** 5101 2561 9735 0866    - Hector Uribe
    3. **BanCoppel** 4169 1608 8566 6207 - Barbara Garcia
    
    -----------------------------------
    
    **Instrucciones:**  
    Envía el comprobante de pago aquí mismo.
    
    -----------------------------------
    `;

    const mensajeCodificado = encodeURIComponent(mensaje);
    const numeroTelefono = "526571991935";

    const urlWhatsApp = `https://wa.me/${numeroTelefono}?text=${mensajeCodificado}`;

    // Abrir el enlace en una nueva pestaña
    window.open(urlWhatsApp, "_blank");
  }

  document
    .getElementById("enviarMensajeWhatsApp")
    .addEventListener("click", (e) => {
      e.preventDefault(); // Evitar que el formulario se envíe, si es un formulario
      enviarMensajeWhatsApp(); // Llamar a la función para enviar el mensaje
    });

// Evento para generar números aleatorios
document
  .getElementById("generateRandomNumbers")
  .addEventListener("click", () => {
    const boletosCount = parseInt(
      document.getElementById("boletosCount").value,
      10
    );

    // Si el número de boletos es mayor que el total disponible, mostrar un mensaje
    if (boletosCount > totalNumbers) {
      alert("No puedes seleccionar más de " + totalNumbers + " boletos.");
      return;
    }

    // Obtener números disponibles
    const availableNumbers = [...Array(totalNumbers).keys()]
      .map((i) => i + 1)
      .filter((num) => !ocupados.has(num) && !selectedNumbers.includes(num));

    if (availableNumbers.length < boletosCount) {
      alert("No hay suficientes boletos disponibles.");
      return;
    }

    // Seleccionar aleatoriamente los números
    while (selectedNumbers.length < boletosCount) {
      const randomIndex = Math.floor(Math.random() * availableNumbers.length);
      const randomNumber = availableNumbers[randomIndex];

      // Usar handleNumberSelection para manejar la selección
      const button = document.querySelector(
        `#rangosContainer button:nth-child(${randomNumber})`
      );
      if (button) {
        handleNumberSelection(randomNumber, button);
        availableNumbers.splice(randomIndex, 1);
      }
    }
  });


  function updateSelectedNumbersList() {
    const selectedNumbersList = document.getElementById("selectedNumbersList");
    selectedNumbersList.innerHTML = ""; // Limpiar la lista actual
  
    if (selectedNumbers.length === 0) {
      // Ocultar la barra si no hay números seleccionados
      document.getElementById("selectedNumbersBar").classList.add("hidden");
    } else {
      // Mostrar cada número seleccionado
      selectedNumbers.forEach((num) => {
        const listItem = document.createElement("div");
        listItem.classList.add(
          "bg-yellow-300", // Fondo amarillo para distinguir
          "text-black", // Texto negro
          "px-4", // Espaciado horizontal
          "py-2", // Espaciado vertical
          "rounded", // Bordes redondeados
          "cursor-pointer", // Indicar que es clicable
          "shadow-md" // Sombra para resaltar
        );
  
        listItem.textContent = num;
  
        // Agregar evento de clic para eliminar el número
        listItem.addEventListener("click", () => {
          const index = selectedNumbers.indexOf(num);
          if (index > -1) {
            selectedNumbers.splice(index, 1); // Eliminar de la lista
  
            // Actualizar el botón correspondiente en el contenedor principal
            const button = Array.from(document.querySelectorAll("#rangosContainer button")).find(
              (btn) => btn.textContent.trim() === String(num).padStart(5, "0")
            );
  
            if (button) {
              button.classList.remove("bg-yellow-500"); // Quitar estado seleccionado
              button.classList.add("bg-green-700"); // Cambiar a estado disponible
            }
  
            // Actualizar la lista y el total
            updateSelectedNumbersList();
            updateTotalAmount();
          }
        });
  
        selectedNumbersList.appendChild(listItem);
      });
  
      // Asegurarse de que la barra sea visible
      document.getElementById("selectedNumbersBar").classList.remove("hidden");
    }
  }
  
  
  
  // Cerrar el modal
  document.getElementById("closeModalButton").addEventListener("click", () => {
    document.getElementById("reserveModal").classList.add("hidden");
  });


// Luego usa la función en el código de tu evento
document.getElementById("reserveButton").addEventListener("click", (e) => {
    document.getElementById("reserveModal").classList.remove("hidden");
});

// Evento para la búsqueda con debounce
let debounceTimer;
searchInput.addEventListener("input", () => {
  clearTimeout(debounceTimer);
  debounceTimer = setTimeout(() => {
    const searchTerm = searchInput.value.trim(); // Obtén el valor del input y limpia espacios
    const numeroBuscado = Number(searchTerm); // Convierte el valor a número

    // Verifica si el valor es vacío
    if (searchTerm === "") {
      numberStatus.textContent = ""; // Si está vacío, limpia el estado
      return; // Sale de la función sin hacer más verificaciones
    }

    // Verifica si el valor ingresado es un número válido
    if (isNaN(numeroBuscado)) {
        numberStatus.textContent = "Número no válido."; // Muestra mensaje si no es un número
        numberStatus.classList.remove("text-green-800");
        numberStatus.classList.add("text-red-500");
        return;
    }
    
    // Verifica que el número esté dentro del rango válido
    if (numeroBuscado < 1 || numeroBuscado > totalNumbers) {
        numberStatus.textContent = `Número fuera de rango. Ingrese un número entre 1 y ${totalNumbers}`;
        numberStatus.classList.remove("text-green-800");
        numberStatus.classList.add("text-red-500");
        return;
    }
    
    // Si el número es ocupado
    if (ocupados.has(numeroBuscado)) {
        numberStatus.textContent = `El número ${numeroBuscado} está ocupado.`;
        numberStatus.classList.remove("text-green-800");
        numberStatus.classList.add("text-red-500");
    } else {
        // Si el número no está ocupado
        numberStatus.textContent = `El número ${numeroBuscado} está disponible.`;
        numberStatus.classList.remove("text-red-500");
        numberStatus.classList.add("text-green-800");
    }
    
  }, 300); // 300 ms de retraso antes de ejecutar la búsqueda
});

// Evento para cuando se presiona Enter en el input
searchInput.addEventListener("keydown", (event) => {
    // Verificar si la tecla presionada es Enter
    if (event.key === "Enter") {
      const searchTerm = searchInput.value.trim(); // Obtén el valor del input y limpia espacios
      const numeroBuscado = Number(searchTerm); // Convierte el valor a número
  
      // Verifica si el valor ingresado es un número válido
      if (isNaN(numeroBuscado)) {
        numberStatus.textContent = "Número no válido."; // Muestra mensaje si no es un número
        numberStatus.classList.replace("text-green-500", "text-red-500");
        return;
      }
  
      // Verifica que el número esté dentro del rango válido
      if (numeroBuscado < 1 || numeroBuscado > totalNumbers) {
        numberStatus.textContent = `Número fuera de rango. Ingrese un número entre 1 y ${totalNumbers}`;
        numberStatus.classList.replace("text-green-500", "text-red-500");
        return;
      }
  
      // Si el número es ocupado
      if (ocupados.has(numeroBuscado)) {
        numberStatus.textContent = `El número ${numeroBuscado} está ocupado.`;
        numberStatus.classList.replace("text-green-500", "text-red-500");
      } else {
        // Verificar si el número ya está seleccionado
        if (selectedNumbers.includes(numeroBuscado)) {
          numberStatus.textContent = `El número ${numeroBuscado} ya está seleccionado.`;
          numberStatus.classList.replace("text-green-500", "text-red-500");
        } else {
          // Si no está seleccionado, agregarlo
          selectedNumbers.push(numeroBuscado);
  
          // Actualizar la interfaz de números seleccionados
          updateSelectedNumbersList();
  
          // Buscar el botón del número y actualizar su estado
          const button = Array.from(document.querySelectorAll("#rangosContainer button")).find(
            (btn) => btn.textContent.trim() === String(numeroBuscado).padStart(5, "0")
          );
  
          if (button) {
            handleNumberSelection1(numeroBuscado, button); // Cambiar el estado del botón (de verde a amarillo)
          }
  
          // Actualizar el total
          updateTotalAmount();
  
          // Limpiar el campo de búsqueda
          searchInput.value = "";
          numberStatus.textContent = ""; // Limpiar mensajes de estado
        }
      }
    }
  });
  

});
