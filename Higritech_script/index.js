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