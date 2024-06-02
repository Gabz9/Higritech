// transição do botão //

const openBtn = document.getElementById('open_btn');
const menuLateral = document.querySelector('.MenuLateral');
const conteudo = document.getElementById('Conteudo');
const body = document.body;

openBtn.addEventListener('click', show);

function show() {
    menuLateral.classList.toggle('menu-fechado');
    ajustarEspaco();
}

// Sub Menus no menu lateral //

function toggleSubMenu() {
    var subMenu = document.getElementById("SubMenuIrrigacao");
    subMenu.style.display = subMenu.style.display === "none" ? "block" : "none";
    ajustarEspaco();
}

// Ajustar tamanho do conteudo principal/formularios //

function ajustarEspaco() {
    if (menuLateral.classList.contains('menu-fechado')) {
        conteudo.style.marginLeft = "20px";
    } else {
        conteudo.style.marginLeft = "320px";
}
}

// MOdelo de transição CSS para menu lateral aberto - fechado //

function toggleMenu() {
  var menuLateral = document.getElementById("MenuLateral_fun");
  var container = document.querySelector(".container");

  if (menuLateral.classList.contains("oculto")) {
    menuLateral.classList.remove("oculto");
    container.style.marginLeft = "250px";
  } else {
    menuLateral.classList.add("oculto");
    container.style.marginLeft = "0";
  }
}