// Transição do botão
const openBtn = document.getElementById('open_btn');
const menuLateral = document.querySelector('.MenuLateral');

openBtn.addEventListener('click', show);

function show() {
    menuLateral.classList.toggle('menu-fechado');
}

// Sub Menus no menu lateral
function toggleSubMenu() {
    var subMenu = document.getElementById("SubMenuIrrigacao");
    subMenu.style.display = subMenu.style.display === "none" ? "block" : "none";
    ajustarEspaco();
}

// Adaptar tamanho do conteúdo principal/formulários
function ajustarEspaco() {
    var conteudoPrincipal = document.querySelector('.conteudo-principal');
    if (conteudoPrincipal) {
        conteudoPrincipal.style.marginLeft = document.getElementById("SubMenuIrrigacao").style.display === "block" ? "250px" : "0";
    }
}

// Modelo de transição CSS para menu lateral aberto - fechado
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

// Modelo de estrutura para exibir dados cadastrados na caixa superior
const planoInformacoesDiv = document.getElementById('planoInformacoes');

// Suponha que você tenha armazenado os dados do plano em variáveis como nomePlano, duracaoPlano, precoPlano e descricaoPlano
const nomePlano = "Exemplo de Plano";
const duracaoPlano = "6 meses";
const precoPlano = "R$ 200,00";
const descricaoPlano = "Descrição do plano de irrigação";

const nomePlanoSpan = document.createElement('span');
nomePlanoSpan.textContent = `Nome do Plano: ${nomePlano}`;

const duracaoPlanoSpan = document.createElement('span');
duracaoPlanoSpan.textContent = `Duração do Plano: ${duracaoPlano}`;

const precoPlanoSpan = document.createElement('span');
precoPlanoSpan.textContent = `Preço do Plano: ${precoPlano}`;

const descricaoPlanoSpan = document.createElement('span');
descricaoPlanoSpan.textContent = `Descrição do Plano: ${descricaoPlano}`;

const linhaInformacoes = document.createElement('p');
linhaInformacoes.appendChild(nomePlanoSpan);
linhaInformacoes.appendChild(duracaoPlanoSpan);
linhaInformacoes.appendChild(precoPlanoSpan);
linhaInformacoes.appendChild(descricaoPlanoSpan);

planoInformacoesDiv.appendChild(linhaInformacoes);
