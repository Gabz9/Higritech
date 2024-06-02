CREATE DATABASE projetopa;
use projetopa;

CREATE TABLE `equipamentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tempo` int(2) NOT NULL,
  `raio` int(11) NOT NULL,
  `vazao` int(11) NOT NULL
);

CREATE TABLE `planos` (
  `id` int(11) NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFinal` date NOT NULL,
  `produto_id` int(11) NOT NULL,
  `equipamento_id` int(11) NOT NULL,
  `valorAgua` decimal(10,2) NOT NULL,
  `custoTotal` decimal(10,2) DEFAULT NULL
);

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `unidade_medida` varchar(50) NOT NULL,
  `producao_minima` int(11) NOT NULL,
  `producao_maxima` int(11) NOT NULL
);

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `data_nasc` date NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `endereco` varchar(45) NOT NULL
);

ALTER TABLE `equipamentos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `planos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id` (`produto_id`),
  ADD KEY `equipamento_id` (`equipamento_id`);

ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `equipamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `planos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `planos`
  ADD CONSTRAINT `planos_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `planos_ibfk_2` FOREIGN KEY (`equipamento_id`) REFERENCES `equipamentos` (`id`);
COMMIT;
