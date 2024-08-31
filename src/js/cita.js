let paso = 1;

const pasoInicial = 1;
const pasoFinal = 4;

const cita = {
  Id: "",
  Nombre: "",
  Fecha: "",
  Hora: "",
  Servicios: [],
};

document.addEventListener("DOMContentLoaded", function () {
  inciarCita();
});

function inciarCita() {
  tabs();
  mostrarSeccion();
  btnPaginador();
  pagSiguiente();
  pagAnterior();
  IDUsuario();
  NombreUsuario();
  SeleccionarFecha();
  seleccionarHora();
  //Mostrar Resumen
  resumen();
}

function tabs() {
  const botones = document.querySelectorAll(".tabs button");
  botones.forEach((boton) => {
    boton.addEventListener("click", function (e) {
      paso = parseInt(e.target.dataset.paso);
      //console.log(e);
      mostrarSeccion();
      btnPaginador();
    });
  });
}

function mostrarSeccion() {
  const seccionMostrar = document.querySelector(".mostrar");
  if (seccionMostrar) {
    seccionMostrar.classList.remove("mostrar");
  }
  const seccion = document.querySelector(`#paso-${paso}`);
  seccion.classList.add("mostrar");

  const tabAnterior = document.querySelector(".actual");
  if (tabAnterior) {
    tabAnterior.classList.remove("actual");
  }
  const tab = document.querySelector(`[data-paso="${paso}"]`);
  tab.classList.add("actual");
}

function btnPaginador() {
  const btnAnterior = document.querySelector("#boton-anterior");
  const btnSiguiente = document.querySelector("#boton-siguiente");

  if (paso === 1) {
    btnAnterior.classList.add("ocultar");
    btnSiguiente.classList.remove("ocultar");
  } else if (paso === 4) {
    btnAnterior.classList.remove("ocultar");
    btnSiguiente.classList.add("ocultar");
  } else {
    btnAnterior.classList.remove("ocultar");
    btnSiguiente.classList.remove("ocultar");
  }
  mostrarSeccion();
  resumen();
}
function pagAnterior() {
  const btnAnterior = document.querySelector("#boton-anterior");
  btnAnterior.addEventListener("click", function () {
    //verificar si el valor de la variable "paso" es menor o igual al valor de "pasoInicial"
    if (paso <= pasoInicial) return;

    paso--;
    btnPaginador();
  });
}

function pagSiguiente() {
  const btnSiguiente = document.querySelector("#boton-siguiente");
  btnSiguiente.addEventListener("click", function () {
    //verificar si el valor de la variable "paso" es menor o igual al valor de "pasoInicial"
    if (paso >= pasoFinal) return;

    paso++;
    btnPaginador();
  });
}

function seleccionarServicio(servicio) {
  const { Id } = servicio;
  const { Servicios } = cita;

  if (Servicios.some((agregado) => agregado.Id === Id)) {
    //verificar si al menos un objeto dentro del array tiene la propiedad Id igual al valor de la variable Id
    cita.Servicios = Servicios.filter((agregado) => agregado.Id !== Id);
    //Se filtran los objetos en el array Servicios y se crea un nuevo array que excluye el objeto cuya propiedad Id coincide con el valor de la variable Id.
  } else {
    cita.Servicios = [...Servicios, servicio];
    //e actualiza la propiedad Servicios del objeto cita agregando un nuevo objeto servicio al array existente Servicios. Se utiliza el operador spread (...) para crear una nueva copia del array Servicios y agregar el nuevo objeto servicio.
  }

  const divServicio = document.querySelector(`[data-id-servicio="${Id}"]`);
  divServicio.classList.toggle("seleccionado");
}

function IDUsuario() {
  const InputId = document.querySelector("#Id").value;
  cita.Id = InputId;
}

function NombreUsuario() {
  const InputNombre = document.querySelector("#Nombre").value;
  cita.Nombre = InputNombre;
}

function SeleccionarFecha() {
  const inputFecha = document.querySelector("#Fecha");
  inputFecha.addEventListener("input", function (e) {
    const diaNoLaborable = new Date(e.target.value).getUTCDay();
    if ([6, 0].includes(diaNoLaborable)) {
      //console.log('no hay atencion');
      e.target.value = "";
      mostrarAlerta("Dia no laborable", "error", ".alertas");
    } else {
      cita.Fecha = e.target.value;
    }
  });
}

function seleccionarHora() {
  const inputHora = document.querySelector("#Hora");
  inputHora.addEventListener("input", function (e) {
    const horaCita = e.target.value;
    const hora = horaCita.split(":")[0]; //los separa en un array en el [0] se encuentra la hora y en el [1] el minuto

    if (hora < 10 || hora > 18) {
      //console.log('hora no disponible');
      mostrarAlerta("Hora no valida", "error", ".alertas");
      e.target.value = "";
    } else {
      //console.log('hora disponible');
      cita.Hora = e.target.value;
    }
  });
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {
  // Previene que se generen más de 1 alerta
  const alertaPrevia = document.querySelector(".alerta");
  if (alertaPrevia) {
    alertaPrevia.remove();
  }
  // Scripting para crear la alerta
  const alerta = document.createElement("DIV");
  alerta.textContent = mensaje;
  alerta.classList.add("alerta");
  alerta.classList.add(tipo);
  //console.log(alerta);
  //agregar la alerta
  const referencia = document.querySelector(elemento);
  referencia.appendChild(alerta);
  //quitar la alerta despues de cierto tiempo
  if (desaparece) {
    setTimeout(() => {
      alerta.remove();
    }, 3000);
  }
}

function resumen() {
  const divResumenContenido = document.querySelector(".contenido-resumen");
  const divResumenServicio = document.querySelector(".servicio-resumen");
  const divTotal = document.querySelector(".total-resumen");
  //console.log(divResumen.firstChild);
  //Eliminar contenido de resumen
  while (divResumenContenido.firstChild) {
    divResumenContenido.removeChild(divResumenContenido.firstChild);
  }
  while (divResumenServicio.firstChild) {
    divResumenServicio.removeChild(divResumenServicio.firstChild);
  }
  while (divTotal.firstChild) {
    divTotal.removeChild(divTotal.firstChild);
  }
  //console.log(Object.values(cita));
  if (Object.values(cita).includes("") || cita.Servicios.length === 0) {
    //console.log('error');
    mostrarAlerta(
      "Falta completar campos",
      "error",
      ".contenido-resumen",
      false
    );
    return;
  }

  //console.log('mejor');
  const { Nombre, Fecha, Hora, Servicios } = cita;
  //heading
  const heading = document.createElement("H3");
  heading.textContent = "Resumen de la Cita";
  divResumenContenido.appendChild(heading);
  //Datos de la Cita
  const nombreCliente = document.createElement("P");
  nombreCliente.innerHTML = `<span>Nombre:</span> ${Nombre}`;

  //Formatear la fecha en español
  const fechaObj = new Date(Fecha);
  const mes = fechaObj.getMonth();
  const dia = fechaObj.getDate() + 2; //cada vez que usamos la clase date hay un desface de 1 dia y como lo usamos 2 veces se restara 2 dias
  const year = fechaObj.getFullYear();

  const fechaUTC = new Date(Date.UTC(year, mes, dia));
  //console.log(fechaUTC);
  const opciones = {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  };
  const fechaFormateada = fechaUTC.toLocaleDateString("es-PE", opciones); //ya que es un objeto de fecha y no un String
  //console.log(fechaFormateada);

  const FechaCita = document.createElement("P");
  FechaCita.innerHTML = `<span>Fecha: </span> ${fechaFormateada}`;
  //console.log(FechaCita);

  const HoraCita = document.createElement("P");
  HoraCita.innerHTML = `<span>Hora:</span> ${Hora}`;
  //console.log(HoraCita);

  //boton para Crear una Cita
  const botonReservar = document.createElement("BUTTON");
  botonReservar.classList.add("boton-web");
  botonReservar.textContent = "Reservar Cita";
  botonReservar.onclick = reservarCita; //dejamos asi no mas , pero si queremos pasarle un parametro tenemos que usar un function tipo callback

  //mostrando fecha y hora
  divResumenContenido.appendChild(nombreCliente);
  divResumenContenido.appendChild(FechaCita);
  divResumenContenido.appendChild(HoraCita);
  divResumenContenido.appendChild(botonReservar);

  //heading servicios
  const ServiciosHeading = document.createElement("H3");
  ServiciosHeading.textContent = "Resumen de los Servicios";
  divResumenContenido.appendChild(ServiciosHeading);

  //Iterando los Servicios
  Servicios.forEach((Servicio) => {
    const { Nombre, Precio } = Servicio;

    const contenedorServicio = document.createElement("DIV");
    contenedorServicio.classList.add("contenedor-servicio");

    const textoServicio = document.createElement("P");
    textoServicio.textContent = Nombre;

    const precioServicio = document.createElement("P");
    precioServicio.innerHTML = `<span>Precio: </span> S/.${Precio}`;

    contenedorServicio.appendChild(textoServicio);
    contenedorServicio.appendChild(precioServicio);
    divResumenServicio.appendChild(contenedorServicio);
  });

  //Total Usuario
  const Totalheading = document.createElement("H3");
  Totalheading.textContent = "Total a Pagar";
  divTotal.appendChild(Totalheading);

  let PrecioTotal = 0;

  Servicios.forEach((servicio) => {
    const { Precio } = servicio;
    PrecioTotal = PrecioTotal + parseFloat(Precio);
  });

  const Resultado = document.createElement("P");
  Resultado.textContent = `Total a Pagar : S/.${PrecioTotal}`;
  divTotal.appendChild(Resultado);
}

async function reservarCita() {
  const { Hora, Fecha, Servicios, Id } = cita;
  const idServicios = Servicios.map((servicio) => servicio.Id);
  //console.log(idServicios);  //muestra los id en un arreglo
  const datos = new FormData();
  datos.append("UsuarioId", Id);
  datos.append("Hora", Hora);
  datos.append("Fecha", Fecha);
  datos.append("Servicios", idServicios);
  //console.log([...datos]);
  try {
    const url = `${location.origin}/api/citas`;
    const respuesta = await fetch(url, {
      method: "POST",
      body: datos,
    });

    const resultado = await respuesta.json();
    //console.log(resultado);//array
    if (resultado.resultado) {
      Swal.fire({
        icon: "success",
        title: "Cita Creada",
        text: "Tu cita fue creada correctamente! Se te mando un comprobante a tu correo",
        iconColor: "#BD9254",
      }).then(() => {
        comprobante();
      });
    }
  } catch (error) {
    console.log(error);
  }
}

async function comprobante() {
  const { Fecha, Hora, Nombre, Servicios } = cita;
  let total = 0;
  let mensaje = `Estimado/a ${Nombre}, su cita fue reservada para ${Fecha},a las horas ${Hora}\n`;
  mensaje += "Con los siguientes servicios:\n";
  Servicios.forEach((servicio) => {
    total += parseFloat(servicio.Precio);
    mensaje += `${servicio.Nombre}, S/.${servicio.Precio} \n`;
  });
  mensaje += `Con un Total de : S/.${total}`;

  const datos = new FormData();
  datos.append("Mensaje", mensaje);

  try {
    const url = `${location.origin}/api/msj`;
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
