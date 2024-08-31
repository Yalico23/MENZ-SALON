 function eliminar(event, Id) {
  event.preventDefault(); // Previne el envío del formulario inmediatamente

  Swal.fire({
    title: "Confirmación",
    text: "¿Estás seguro de que deseas eliminar este elemento? Verifique que no haya citas con este servicio",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
    iconColor: "#BD9254",
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById(Id).submit();
    }
  });
  
}

function servicioCreado(e) {
  e.preventDefault(); // Previne el envío del formulario inmediatamente
  Swal.fire({
    icon: "question",
    title: "¿Desea guardar el servicio?",
    showCancelButton: true,
    confirmButtonText: "Sí, guardar",
    cancelButtonText: "No, cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      // Si el usuario confirma, envía el formulario.
      e.target.form.submit();
    }
  });
}

function servicioActualizado(e) {
  e.preventDefault(); // Previne el envío del formulario inmediatamente
  Swal.fire({
    icon: "question",
    title: "¿Desea actualizar el servicio?",
    showCancelButton: true,
    confirmButtonText: "Sí, actualizar",
    cancelButtonText: "No, cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      // Si el usuario confirma, envía el formulario.
      e.target.form.submit();
    }
  });
}
function desabilitar(event, Id) {
  event.preventDefault(); // Previne el envío del formulario inmediatamente

  Swal.fire({
    title: "Confirmación",
    text: "¿Estás seguro de que deseas desabilitar este elemento?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
    iconColor: "#BD9254",
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById(Id).submit();
    }
  });
}
function habilitar(event, Id) {
  event.preventDefault(); // Previne el envío del formulario inmediatamente

  Swal.fire({
    title: "Confirmación",
    text: "¿Estás seguro de que deseas Habilitar este elemento?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
    iconColor: "#BD9254",
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById(Id).submit();
    }
  });
}
