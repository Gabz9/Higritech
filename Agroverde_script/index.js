// transição do botão //

const openBtn = document.getElementById('open_btn');
const menuLateral = document.querySelector('.MenuLateral');

openBtn.addEventListener('click',show);

function show(){
    menuLateral.classList.toggle('menu-fechado');
}

//Sub Menus no menu lateral//

function toggleSubMenu() {
    var subMenu = document.getElementById("SubMenuIrrigacao");
    if (subMenu.style.display === "none") {
        subMenu.style.display = "block";
    } else {
        subMenu.style.display = "none";
    }
}

// adaptar tamanho do conteudo principal/formularios //

function toggleSubMenu() {
    var subMenu = document.getElementById("SubMenuIrrigacao");
    subMenu.style.display = subMenu.style.display === "none" ? "block" : "none"; // Alterna a exibição do submenu
    ajustarEspaco(); // Chama a função para ajustar o espaço quando o submenu é aberto ou fechado
}

//////////////////////////////////////////

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
