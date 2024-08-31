document.addEventListener("DOMContentLoaded", function () {
  admin();
});

function admin() {
  buscarFecha();
}

function buscarFecha() {
  const btn = document.querySelector(".btn-buscar");
  btn.addEventListener("click", function () {
    actualizar();
  });

}

function actualizar(){
  const fechaInput = document.querySelector("#Fecha");
  const fechaSeleccionada = fechaInput.value;
  window.location = `?fecha=${fechaSeleccionada}`;
}