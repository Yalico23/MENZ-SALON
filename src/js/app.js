document.addEventListener("DOMContentLoaded", function () {
  inciarApp();
});

function inciarApp() {
  navegacionFija();
  mobile();
}

function navegacionFija() {
  const header = document.querySelector("header");
  const nav = document.querySelector("#nav");
  let lastScrollTop = 0;

  window.addEventListener("scroll", function () {
    const scrollTop = window.pageXOffset || document.documentElement.scrollTop;
    if (scrollTop > lastScrollTop) {
        header.classList.add("oculto");
        nav.classList.remove("resize");
    }else{
        header.classList.remove("oculto");
        
    }
    lastScrollTop = scrollTop;

  })
}
function mobile (){
  const mobile = document.querySelector(".mobile");
  const nav = document.querySelector("#nav");

  mobile.addEventListener("click", function(){
    nav.classList.toggle("resize");
  });
}