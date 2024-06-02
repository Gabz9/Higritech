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

// Modelo de estrutura para exibir dados cadastrados na caixa superior //

const produtoInformacoesDiv = document.getElementById('produtoInformacoes');

// Crie elementos HTML para cada informação do produto
const nomeProdutoSpan = document.createElement('span');
nomeProdutoSpan.textContent = `Nome do Produto: ${nomeProduto}`;

const unidadeMedidaSpan = document.createElement('span');
unidadeMedidaSpan.textContent = `Unidade de Medida: ${unidadeMedida}`;

const producaoMinimaSpan = document.createElement('span');
producaoMinimaSpan.textContent = `Produção Mínima: ${producaoMinima}`;

const producaoMaximaSpan = document.createElement('span');
producaoMaximaSpan.textContent = `Produção Máxima: ${producaoMaxima}`;

// Combine os elementos em uma linha
const linhaInformacoes = document.createElement('p');
linhaInformacoes.appendChild(nomeProdutoSpan);
linhaInformacoes.appendChild(unidadeMedidaSpan);
linhaInformacoes.appendChild(producaoMinimaSpan);
linhaInformacoes.appendChild(producaoMaximaSpan);

// Adicione a linha de informações ao div
produtoInformacoesDiv.appendChild(linhaInformacoes);
