const correo = {
  Nombre: "",
  Apellidos: "",
  Telefono: "",
  Correo: "",
  Mensaje: "",
};

document.addEventListener("DOMContentLoaded", function () {
  correoM();
});

function correoM() {
  datos();
  mandar();
}

function datos() {
  const Nombre = document.querySelector("#Nombre");
  Nombre.addEventListener("input", function () {
    correo.Nombre = Nombre.value;
  });
  const Apellidos = document.querySelector("#Apellidos");
  Apellidos.addEventListener("input", function () {
    correo.Apellidos = Apellidos.value;
  });
  const Telefono = document.querySelector("#Telefono");
  Telefono.addEventListener("input", function () {
    correo.Telefono = Telefono.value;
  });
  const Correo = document.querySelector("#Correo");
  Correo.addEventListener("input", function () {
    correo.Correo = Correo.value;
  });
  const Mensaje = document.querySelector("#Mensaje");
  Mensaje.addEventListener("input", function () {
    correo.Mensaje = Mensaje.value;
  });
}

function mandar() {
  const btnMandar = document.querySelector("#btn-mandar");
  btnMandar.addEventListener("click", async function () {
    const { Nombre, Apellidos, Telefono, Correo, Mensaje } = correo;

    const datos = new FormData();
    datos.append("Nombre", Nombre);
    datos.append("Apellidos", Apellidos);
    datos.append("Telefono", Telefono);
    datos.append("Correo", Correo);
    datos.append("Mensaje", Mensaje);

    try {
      const url = `${location.origin}/api/contacto`;
      const respuesta = await fetch(url, {
        method: "POST",
        body: datos,
      });
      const resultado = await respuesta.json();

      if (resultado.resultado === "1") {
        Swal.fire({
          icon: "success",
          title: "Correo Mandado",
          text: "Se Comunicaran contigo a la brevedad",
          iconColor: "#BD9254",
        }).then(() => {
          setTimeout(() => {
            window.location.reload();
            window.location.href = `${location.origin}/contacto`;
          }, 1500);
        });
      } else {
        const errores = resultado.errores;
        let mensajeErrores = "Por favor, corrija los siguientes errores:";

        errores.error.forEach((error, index) => {
          mensajeErrores += `\n${index + 1}. ${error}`;
        });

        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: mensajeErrores,
          iconColor: "#BD9254",
        });
      }
    } catch (error) {
      console.log(error);
    }
  });
}
