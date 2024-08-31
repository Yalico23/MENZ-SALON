document.addEventListener("DOMContentLoaded", function () {
  iniciarApis();
});

function iniciarApis() {
  ConsumirApi();
  ApiCitas();
}

async function ConsumirApi() {
  try {
    const url = `${location.origin}/api/servicios`;
    const resultado = await fetch(url);
    const servicios = await resultado.json();

    mostrarServicios(servicios);
  } catch (error) {
    console.log(error);
  }
}
function mostrarServicios(servicios) {
  
  servicios.forEach((servicio) => {
    const { Id, Nombre, Precio , Activo} = servicio;

    const nombreServicio = document.createElement("P");
    nombreServicio.classList.add("nombre-servicio");
    nombreServicio.textContent = Nombre;

    const precioServicio = document.createElement("P");
    precioServicio.classList.add("precio-servicio");
    precioServicio.textContent = `S/. ${Precio}`;

    const servicioDiv = document.createElement("DIV");
    servicioDiv.classList.add("div-servicio");
    servicioDiv.dataset.idServicio = Id;

    servicioDiv.onclick = function () {
      seleccionarServicio(servicio);
    };
    if (Activo === '1') {//
      servicioDiv.appendChild(nombreServicio);
      servicioDiv.appendChild(precioServicio);
      document.querySelector("#servicios").appendChild(servicioDiv);
    }
  });
}

async function ApiCitas() {
  try {
    const url = `${location.origin}/api/citas`;
    const resultado = await fetch(url);
    const citas = await resultado.json();

    mostrarCitas(citas);
  } catch (error) {
    console.log(error);
  }
}

function mostrarCitas(citas) {
  const citasObj = {};
  const div = document.querySelector(".contenido-usuario-cita");

  citas.forEach((cita) => {
    const { Id, Fecha, Hora, cliente, servicio } = cita;

    if (!citasObj[Id]) {
      const divUsuario = document.createElement("DIV");
      divUsuario.classList.add(`divId-${Id}`);

      const FechaCliente = document.createElement("P");
      FechaCliente.textContent = Fecha;

      const HoraCliente = document.createElement("P");
      HoraCliente.textContent = Hora;

      const clienteCliente = document.createElement("P");
      clienteCliente.textContent = cliente.trim();

      divUsuario.appendChild(clienteCliente);
      divUsuario.appendChild(FechaCliente);
      divUsuario.appendChild(HoraCliente);

      citasObj[Id] = { servicios: [servicio] };

      div.appendChild(divUsuario);
    } else {
      // Si el Id ya existe en el objeto, agregar el servicio a la lista de servicios
      citasObj[Id].servicios.push(servicio);
    }
  });

  for (const Id in citasObj) {
    const divUsuario = document.querySelector(`.divId-${Id}`);

    citasObj[Id].servicios.forEach((servicio) => {
      const servicioCliente = document.createElement("P");
      servicioCliente.innerHTML = `&rfisht;${servicio}`;
      divUsuario.appendChild(servicioCliente);
    });

    const boton = document.createElement("button");
    boton.classList.add('boton-eliminar');
    boton.textContent = "Eliminar Cita";
    boton.addEventListener("click", () => {
      enviarFormulario(Id)
    });
    divUsuario.appendChild(boton); 
  }
}

function enviarFormulario(CitaId) {
  Swal.fire({
    title: "Confirmación",
    text: "¿Estás seguro de que deseas eliminar esta cita?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
    iconColor: "#BD9254",
  }).then(async (result) => {
    // Captura el resultado devuelto por la confirmación
    if (result.isConfirmed) {
      // Verifica si el usuario hizo clic en "Sí"
      const datos = new FormData();
      datos.append("Id", CitaId);
      try {
        const url = `${location.origin}/api/citas-eliminar`;
        const respuesta = await fetch(url, {
          method: "POST",
          body: datos,
        });
        const resultado = await respuesta.json();

        if (resultado.resultado) {
          setTimeout(() => {
            window.location.reload();
            window.location.href = `${location.origin}/cita`;
          }, 1500);
        }
      } catch (error) {
        console.log(error);
      }
    }
  });
}
