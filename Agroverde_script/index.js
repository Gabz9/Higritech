// transição do botão //

const openBtn = document.getElementById('open_btn');
const menuLateral = document.querySelector('.MenuLateral');

openBtn.addEventListener('click',show);

function show(){
    menuLateral.classList.toggle('menu-fechado');
}

// Sub Menus no menu lateral //

function toggleSubMenu() {
    var subMenu = document.getElementById("SubMenuIrrigacao");
    if (subMenu.style.display === "none") {
        subMenu.style.display = "block";
    } else {
        subMenu.style.display = "none";
    }
}

// Adaptar tamanho do conteudo principal/formularios //

function toggleSubMenu() {
    var subMenu = document.getElementById("SubMenuIrrigacao");
    subMenu.style.display = subMenu.style.display === "none" ? "block" : "none"; // Alterna a exibição do submenu
    ajustarEspaco(); // Chama a função para ajustar o espaço quando o submenu é aberto ou fechado
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

// Modelo de estrutura para exibir dados cadastrados na caixa superior //

// Suponha que você tenha armazenado os dados do produto em variáveis como nomeProduto, unidadeMedida, producaoMinima e producaoMaxima

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