// Obtener referencia al botón y al modal
var openModalButton = document.getElementById("openModalButton");
var modal = document.getElementById("myModal");

// Manejar el evento de clic en el botón para abrir el modal
openModalButton.addEventListener("click", function() {
    modal.style.display = "block";
    fetchData();
});

// Manejar el evento de clic en el botón de cerrar el modal
var closeButton = document.getElementsByClassName("close")[0];
closeButton.addEventListener("click", function() {
    modal.style.display = "none";
});

