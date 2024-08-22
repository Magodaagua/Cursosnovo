-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: intranet.copimaq.local:3306:3309
-- Tempo de geração: 22/08/2024 às 15:36
-- Versão do servidor: 10.6.18-MariaDB-0ubuntu0.22.04.1
-- Versão do PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `DevPortalCop`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administrador`
--

CREATE TABLE `administrador` (
  `ID_admin` int(200) NOT NULL,
  `email` varchar(500) NOT NULL,
  `senha` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `administrador`
--

INSERT INTO `administrador` (`ID_admin`, `email`, `senha`) VALUES
(1, 'joao@joao', '1234');

-- --------------------------------------------------------

--
-- Estrutura para tabela `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Tipo` varchar(50) NOT NULL,
  `Telefone` int(12) NOT NULL,
  `WhatsApp` int(12) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `anexos`
--

CREATE TABLE `anexos` (
  `ID` int(11) NOT NULL,
  `ID_curso` int(11) NOT NULL,
  `caminho_arquivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `anexos`
--

INSERT INTO `anexos` (`ID`, `ID_curso`, `caminho_arquivo`) VALUES
(1, 39, 'anexos/39/HPPaginadeuso.pdf'),
(2, 39, 'anexos/39/2503ricohcor.mp4');

-- --------------------------------------------------------

--
-- Estrutura para tabela `assunto`
--

CREATE TABLE `assunto` (
  `id` int(11) NOT NULL,
  `Fabricante` varchar(50) NOT NULL,
  `Modelo` varchar(50) DEFAULT NULL,
  `Assunto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `assunto`
--

INSERT INTO `assunto` (`id`, `Fabricante`, `Modelo`, `Assunto`) VALUES
(1, 'Samsung', 'Modelos Samsung', 'SMB'),
(2, 'HP', 'Modelos HP', 'SMB'),
(3, 'Ricoh', 'Modelos Ricoh', 'SMB'),
(4, 'Brother', 'Modelos Brother', 'SMB'),
(5, 'Lexmark', 'Modelos Lexmark', 'SMB'),
(6, 'PrintWayy', 'PrintWayy Client', 'Instalação Client'),
(7, 'Ricoh', 'MP 402SPF', 'Coletar Contadores'),
(8, 'Ricoh', 'Modelos Ricoh', 'Ativando leitor dos crachás'),
(9, 'HP', 'LaserJet E42540', 'Alertas com tôner sem Chip'),
(10, 'HP', 'LaserJet E52645', 'Alertas com tôner sem Chip'),
(11, 'PrintWayy', 'PrintWayy Client', 'Manual do Usuário'),
(12, 'Zebra', 'Modelos Zebra', 'Catálogo Geral Zebra'),
(13, 'HP', 'LaserJet E42540', 'Manual do Fabricante'),
(14, 'Samsung', 'SL-M4070FR', 'Manual do Fabricante'),
(15, 'Samsung', 'SL-M4020DN', 'Manual do Fabricante'),
(16, 'Samsung', 'SL-M4580FX', 'Manual do Fabricante'),
(17, 'Brother', 'MFC-L6912DW', 'Driver'),
(18, 'Brother', 'MFC-L6912DW', 'SMB'),
(19, 'NDD Print', 'Portal NDD360', 'Cadastro de Usuário'),
(20, 'NDD Print', 'NDD Print', 'Controle de impressão por Pin sem embarcado'),
(21, 'NDD Print', 'NDD Print', 'Ativando Leitor Crachás');

-- --------------------------------------------------------

--
-- Estrutura para tabela `aulas`
--

CREATE TABLE `aulas` (
  `id` int(200) NOT NULL,
  `titulo` varchar(600) NOT NULL,
  `conteudo` text NOT NULL,
  `pdf` varchar(600) NOT NULL,
  `resumo` text NOT NULL,
  `ordem` int(5) NOT NULL,
  `modulo_id` int(200) NOT NULL,
  `prova` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aulas`
--

INSERT INTO `aulas` (`id`, `titulo`, `conteudo`, `pdf`, `resumo`, `ordem`, `modulo_id`, `prova`) VALUES
(1, 'Aula 1', '<iframe\r\n            width=\"100%\"\r\n            height=\"100%\"    src=\"https://www.youtube.com/embed/UahN4VjjAo0?si=L7a2o007F7sHczpN\"\r\n            title=\"YouTube video player\"\r\n            frameborder=\"0\"\r\n            allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\"\r\n            allowfullscreen\r\n        ></iframe>', '<img src=\'admin/pdf/arquivo.png\' width=\'150\'><br><br>LinguagemC.pdf<br><br><button class=\'btn btn-outline-info btn-sm\'><a href=\'admin/pdf/32/sites.txt\' download>Download</a></button><br>', 'A linguagem C existe desde antes da internet e foi criada pelo cientista da computação Dennis Ritchie e Ken Thompson, em 1972. O propósito inicial era que fosse uma linguagem usada no desenvolvimento de uma nova versão do sistema operacional Unix, mas hoje é aplicada para criar softwares. É também muito usada em banco de dados para todos os tipos de sistemas: financeiro, governamental, mídia, entretenimento, telecomunicações, saúde, educação, varejo, redes sociais, etc. Grandes empresas como Apple, Microsoft, Oracle usam a linguagem C.', 1, 1, 0),
(2, 'Aula 3', '<iframe width=\"100%\" height=\"100%\" src=\"https://www.youtube.com/embed/YoQHFloNPZ0?si=hWO8IIuXKXjp7RC2\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', '', '', 3, 1, 0),
(3, 'Aula 2', '<p>Aula 1 do módulo 1 e do curso 1</p>', '', '', 2, 1, 0),
(4, 'Aula 1', '', '', '', 1, 2, 0),
(5, 'Aula 1', '', '', '', 1, 3, 0),
(6, 'Prova', 'Prova do Módulo 1<br>\r\nAcesse o link para fazer a prova<br>\r\nLink: https://forms.gle/gipSnw8kAYNH1Wj48', '', '', 4, 1, 1),
(7, 'Como criar um novo design de cartão', '<iframe width=\"100%\" height=\"100%\" src=\"https://www.youtube.com/embed/uPsO-W7qjqI?si=L8QHn7gR7qH_mKHA\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '', 'Card Studio 2.0 - Como criar um novo design de cartão', 1, 4, 0),
(8, 'Usando texto dinâmico e estático', '<iframe width=\"100%\" height=\"100%\" src=\"https://www.youtube.com/embed/2JtvktTQjHQ?si=0VLVWkUITP_T9yuz\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '', 'Card Studio 2.0 - Usando texto dinâmico e estático', 2, 4, 0),
(9, 'Como usar Formas e Imagens em um projeto de cartão', '<iframe width=\"100%\" height=\"100%\" src=\"https://www.youtube.com/embed/uP5xes7Zgfw?si=122WHN_6lcIHFH14\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '', 'Card Studio 2.0 - Como usar Formas e Imagens em um projeto de cartão.', 3, 4, 0),
(10, 'Como iniciar novo projeto de cartão', '<iframe width=\"100%\" height=\"100%\" src=\"https://www.youtube.com/embed/S4L9cmVZwX4?si=i4X79-uVnGK0Wx49\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '', 'Card Studio 2.0 - Como iniciar novo projeto de cartão', 4, 4, 0),
(11, 'Como adicionar e vincular designs de cartão a um projeto', '<iframe width=\"100%\" height=\"100%\" src=\"https://www.youtube.com/embed/J4pXkAo3Gd4?si=qioYLNkz141FOU_u\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '', 'Card Studio 2.0 - Como adicionar e vincular designs de cartão a um projeto', 5, 4, 0),
(12, 'Como importar dados', '<iframe width=\"100%\" height=\"100%\" src=\"https://www.youtube.com/embed/eqEzQqhIxks?si=d18nvw6q4j0HuxcP\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '', 'Card Studio 2.0 - Como importar dados', 6, 4, 0),
(13, 'Como adicionar registro manualmente', '<iframe width=\"100%\" height=\"100%\" src=\"https://www.youtube.com/embed/wtj7pZXh8sY?si=JCGp075JBmJER5dP\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '', 'Card Studio 2.0 - Como adicionar registro manualmente', 7, 4, 0),
(14, 'Como desconectar chave de licença', '<iframe width=\"100%\" height=\"100%\" src=\"https://www.youtube.com/embed/7ELeWMIUjcE?si=1qlUZ9bFKMfnsUBj\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '', 'Card Studio 2.0 - Como desconectar chave de licença', 8, 4, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `aulas_favoritas`
--

CREATE TABLE `aulas_favoritas` (
  `id_aula` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `informacao` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aulas_favoritas`
--

INSERT INTO `aulas_favoritas` (`id_aula`, `id_cliente`, `id_curso`, `informacao`) VALUES
(3, 42, 1, 1),
(5, 42, 1, 1),
(7, 37, 39, 1),
(7, 42, 39, 0),
(14, 42, 39, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacoes`
--

CREATE TABLE `avaliacoes` (
  `id` int(11) NOT NULL,
  `qtd_estrela` int(11) NOT NULL,
  `mensagem` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `aula_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `avaliacoes`
--

INSERT INTO `avaliacoes` (`id`, `qtd_estrela`, `mensagem`, `created`, `modified`, `aula_id`, `curso_id`, `modulo_id`, `id_user`) VALUES
(2, 5, 'Muito Bom!', '2024-05-06 14:43:45', NULL, 2, 1, 1, 42);

-- --------------------------------------------------------

--
-- Estrutura para tabela `boletins`
--

CREATE TABLE `boletins` (
  `id` int(11) NOT NULL,
  `Titulo` varchar(150) NOT NULL,
  `Tipo` varchar(50) NOT NULL,
  `Fabricante` varchar(50) NOT NULL,
  `Modelo` varchar(50) NOT NULL,
  `Assunto` varchar(100) NOT NULL,
  `Nome_Arquivo` varchar(300) NOT NULL,
  `Caminho_arquivo` varchar(300) NOT NULL,
  `Postado_Em` datetime DEFAULT current_timestamp(),
  `Usuario` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `boletins`
--

INSERT INTO `boletins` (`id`, `Titulo`, `Tipo`, `Fabricante`, `Modelo`, `Assunto`, `Nome_Arquivo`, `Caminho_arquivo`, `Postado_Em`, `Usuario`) VALUES
(73, 'Instala&ccedil;&atilde;o Driver - Brother MFC-L6912DW', 'Software', 'Brother', 'MFC-L6912DW', 'Driver', 'BT_T.I_0001-BROTHER-INSTALACAO_DRIVER_MFC-L6912DW_V.1.pdf', '/var/www/dev-intranet/public/COMUM/PDF/BoletimTecnico/BT_T.I_0001-BROTHER-INSTALACAO_DRIVER_MFC-L6912DW_V.1.pdf', '2024-06-04 17:50:53', NULL),
(74, 'Configurar SMB - Brother MFC-L6912DW', 'Software', 'Brother', 'MFC-L6912DW', 'SMB', 'BT_T.I_0002-BROTHER-CONFIGURAR_SMB_MFC-L6912DW_V.1.pdf', '/var/www/dev-intranet/public/COMUM/PDF/BoletimTecnico/BT_T.I_0002-BROTHER-CONFIGURAR_SMB_MFC-L6912DW_V.1.pdf', '2024-06-04 17:54:04', NULL),
(75, 'Cadastro de Usu&aacute;rio - Portal NDD360', 'Software', 'NDD Print', 'Portal NDD360', 'Cadastro de Usu&aacute;rio', 'BT_TI_0003-NDD360_Manual_Usuario_cadastro_cotas_V1.pdf', '/var/www/dev-intranet/public/COMUM/PDF/BoletimTecnico/BT_TI_0003-NDD360_Manual_Usuario_cadastro_cotas_V1.pdf', '2024-06-04 17:57:44', NULL),
(76, 'Controle de Impress&atilde;o por Pin sem uso de embarcado - NDD Print', 'Software', 'NDD Print', 'NDD Print', 'Controle de impress&atilde;o por Pin sem embarcado', 'BT_TI_0004-NDDPRINT_CONTROLE-DE-IMPRESSAO-COM-BLOQUEIO-POR-PIN-SEM-EMBARCADO_V.2.pdf', '/var/www/dev-intranet/public/COMUM/PDF/BoletimTecnico/BT_TI_0004-NDDPRINT_CONTROLE-DE-IMPRESSAO-COM-BLOQUEIO-POR-PIN-SEM-EMBARCADO_V.2.pdf', '2024-06-04 18:00:56', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `calendarioEmpresa`
--

CREATE TABLE `calendarioEmpresa` (
  `id` int(11) NOT NULL,
  `Evento` varchar(50) NOT NULL,
  `Data_Reserva` date NOT NULL,
  `Hora_Reserva` time NOT NULL,
  `Hora_Fim` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `calendarioEmpresa`
--

INSERT INTO `calendarioEmpresa` (`id`, `Evento`, `Data_Reserva`, `Hora_Reserva`, `Hora_Fim`) VALUES
(1, 'Sexta Feira Santa - Paixão de Cristo', '2024-03-29', '08:00:00', '18:00:00'),
(2, 'Dia do Trabalhador', '2024-05-01', '08:00:00', '18:00:00'),
(3, 'Corpus Christi', '2024-05-30', '08:00:00', '18:00:00'),
(4, 'Revolução Constitucionalista', '2024-07-09', '08:00:00', '18:00:00'),
(5, 'Proclamação da República', '2024-11-15', '08:00:00', '18:00:00'),
(6, 'Véspera de Natal', '2024-12-24', '08:00:00', '18:00:00'),
(8, 'Véspera de Ano Novo', '2024-12-31', '08:00:00', '18:00:00'),
(9, 'Ano Novo', '2024-01-01', '08:00:00', '18:00:00'),
(10, 'Consciência Negra', '2024-11-20', '08:00:00', '18:00:00'),
(28, 'Treinacloud', '2024-04-17', '14:00:00', '14:30:00'),
(29, 'Reunião com a Tesla', '2024-04-19', '17:00:00', '18:00:00'),
(30, '10:00 Reunião CIA', '2024-04-17', '10:00:00', '10:30:00'),
(31, 'Reunião CIA', '2024-04-23', '15:00:00', '16:30:00'),
(32, 'Reunião PrinWayy', '2024-04-24', '15:00:00', '16:30:00'),
(33, 'Reunião PrinWayy', '2024-04-24', '11:00:00', '11:30:00'),
(34, 'Reunião PrinWayy', '2024-04-01', '08:00:00', '11:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `catalogoProdutos`
--

CREATE TABLE `catalogoProdutos` (
  `id` int(11) NOT NULL,
  `Titulo` varchar(150) NOT NULL,
  `Tipo` varchar(50) NOT NULL,
  `Fabricante` varchar(50) NOT NULL,
  `Modelo` varchar(50) NOT NULL,
  `Assunto` varchar(100) DEFAULT NULL,
  `Nome_Arquivo` varchar(100) DEFAULT NULL,
  `Caminho_arquivo` varchar(100) NOT NULL,
  `Postado_Em` datetime DEFAULT NULL,
  `Usuario` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `catalogoProdutos`
--

INSERT INTO `catalogoProdutos` (`id`, `Titulo`, `Tipo`, `Fabricante`, `Modelo`, `Assunto`, `Nome_Arquivo`, `Caminho_arquivo`, `Postado_Em`, `Usuario`) VALUES
(4, 'Cat&aacute;logo Zebra - Coletores e Leitores de dados', 'Cat&aacute;logo', 'Zebra', 'Modelos Zebra', 'Cat&aacute;logo Geral Zebra', 'Catalogo_Geral_Zebra-Coletores_leitores_dados.pdf', '/var/www/dev-intranet/public/COMUM/PDF/Catalogo/Catalogo_Geral_Zebra-Coletores_leitores_dados.pdf', NULL, NULL),
(5, 'Cat&aacute;logo Zebra - Impressoras T&eacute;rmicas RFID', 'Cat&aacute;logo', 'Zebra', 'Modelos Zebra', 'Cat&aacute;logo Geral Zebra', 'Catalogo_Geral Zebra-Impressoras_térmicas_RFID.pdf', '/var/www/dev-intranet/public/COMUM/PDF/Catalogo/Catalogo_Geral Zebra-Impressoras_térmicas_RFID.pdf', NULL, NULL),
(6, 'Cat&aacute;logo Zebra - Impressoras T&eacute;rmicas - 1', 'Cat&aacute;logo', 'Zebra', 'Modelos Zebra', 'Cat&aacute;logo Geral Zebra', 'Catalogo_Geral Zebra-Impressoras_térmicas_1 .pdf', '/var/www/dev-intranet/public/COMUM/PDF/Catalogo/Catalogo_Geral Zebra-Impressoras_térmicas_1 .pdf', NULL, NULL),
(7, 'Cat&aacute;logo Zebra - Impressoras T&eacute;rmicas - 2', 'Cat&aacute;logo', 'Zebra', 'Modelos Zebra', 'Cat&aacute;logo Geral Zebra', 'Catalogo_Geral Zebra-Impressoras_térmicas_2.pdf', '/var/www/dev-intranet/public/COMUM/PDF/Catalogo/Catalogo_Geral Zebra-Impressoras_térmicas_2.pdf', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(200) NOT NULL,
  `Nome_cat` varchar(500) NOT NULL,
  `imagem` varchar(500) NOT NULL,
  `tipo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id`, `Nome_cat`, `imagem`, `tipo`) VALUES
(1, 'Administrativo', 'Administração.png', 'Particular'),
(2, 'Recepção', 'Atendimento.png', 'Particular'),
(3, 'Financeiro', 'Contabilidade.png', 'Particular'),
(4, 'TI', 'Informática.png', 'Particular'),
(5, 'Marketing', 'Marketing.png', 'Particular'),
(6, 'Sup. Técnico', 'Mecânica.png', 'Particular'),
(7, 'Compras', 'Vendas.png', 'Particular'),
(16, 'Geral', '1250622.png', 'Pública'),
(17, 'teste', '4909732.png', 'Pública');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ClientePrev`
--

CREATE TABLE `ClientePrev` (
  `id` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Codigo` varchar(50) DEFAULT NULL,
  `Contrato` varchar(50) DEFAULT NULL,
  `TipoPrev` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ClientePrev`
--

INSERT INTO `ClientePrev` (`id`, `Nome`, `Codigo`, `Contrato`, `TipoPrev`) VALUES
(1, 'Kromberg - Mensal', '5686', '1065', 1),
(2, 'Aleris', '4862', '662', 2),
(3, 'BH Airports', '5627', '1033', 2),
(6, 'Kromberg - Trimestral', '5686', '1065', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `comunicados`
--

CREATE TABLE `comunicados` (
  `id` int(11) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `Titulo` varchar(150) NOT NULL,
  `Resumo` varchar(300) DEFAULT NULL,
  `Descricao` varchar(15000) NOT NULL,
  `DataPublicado` date NOT NULL,
  `HoraPublicado` time NOT NULL,
  `Arquivo` varchar(60) DEFAULT NULL,
  `Capa` varchar(60) DEFAULT NULL,
  `Autor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comunicados`
--

INSERT INTO `comunicados` (`id`, `Categoria`, `Titulo`, `Resumo`, `Descricao`, `DataPublicado`, `HoraPublicado`, `Arquivo`, `Capa`, `Autor`) VALUES
(1, 'Família', 'Alice nasceu!', NULL, 'Alice, filha do colaborador Leonardo nasceu em 01/04.', '2024-04-02', '08:58:00', 'nascimentoAlice.png', NULL, NULL),
(2, 'Promoção', 'Promoção', NULL, 'Andreia passa oficialmente para o Departamento de Faturamento', '2024-04-01', '17:49:00', 'AndreiaFinanceiro.png', 'promocoes.png', NULL),
(6, 'Políticas', 'Cuidados com Alimentos', NULL, 'Pedimos a colaboração de todos em manter a geladeira sempre organizada e limpa.', '2024-04-25', '15:44:00', 'cuidadosAlimentos.png', 'politicas.png', NULL),
(7, 'Benefícios', 'Ticket Log Frota', NULL, 'Tornou-se obrigatório trazer o cupom fiscal e o ticket do abastecimento que devem ser entregues junto com a planilha de quilometragem.', '2024-04-19', '09:13:00', 'TicketLogFrota.png', 'beneficios.png', NULL),
(8, 'Benefícios', 'Atualizar Dados Cartão Caju', NULL, 'Atualização necessária no cadastro do aplicativo Caju!', '2024-04-05', '08:44:00', 'atualizarDadosCaju.png', 'beneficios.png', NULL),
(9, 'Filantropia', 'MISSÃO: A Copimaq está arrecadando roupas e alimentos.', NULL, 'A Copimaq junto com um grupo de pessoas da Igreja Tabernaculo de Jesus Cristo, estamos arrecadando roupas e alimentos para enviar ajuda.\nAlimentos não perecíveis, água, produtos de higiêne, copos pláticos, lençóis, fronhas, cobertor, fraldas...\nO ponto de coleta é no Showroom da Copimaq e as doações devem ser entregues até dia 10/05.\n', '2024-05-06', '12:37:00', 'RioGrandedoSul.png', NULL, NULL),
(10, 'Promoção', 'Promoção', NULL, 'É com orgulho que informamos que o colaborador Marcelo foi oficialmente promovido para o novo cargo de Coordenador Técnico!', '2024-05-02', '14:43:00', 'MarceloeCampos.png', 'promocoes.png', NULL),
(11, 'Promoção', 'Promoção', NULL, 'É com orgulho que informamos que o colaborador Leandro foi oficialmente promovido para o novo cargo de Supervisor Técnico!', '2024-05-02', '14:43:00', 'MarceloeCampos.png', 'promocoes.png', NULL),
(12, 'Família', 'Liz nasceu!', NULL, 'Liz, filha da colaboradora Patrícia nasceu em 02/04!', '2023-04-02', '14:43:00', 'nascimentoLiz.png', NULL, NULL),
(13, 'Benefícios', 'Amil Dental', NULL, ' A Copimaq vem através deste comunicar, com total zelo, que o valor do seu convênio odontológico sofreu reajuste. \nConforme critério de reajuste anual, em 03/2024, a base de cálculo da mensalidade foi alterada em 4,68%. Os dependentes, passaram à pagar o valor de R$ 25,02 a\n partir do mês de março. Colaboradores da Copimaq permanecem isentos da mensalidade.', '2024-03-21', '13:08:00', 'amilDental.png', 'beneficio.png', NULL),
(14, 'Políticas', 'Uso de Celular', NULL, ' *Proibido uso de celular particular nas dependências da empresa;\n                                *Celular Corporativo: Uso estritamente para fins corporativos;\n                                *Celular particular: Liberado uso apenas na salade descanso no seu horário de almoço;\n                                Cientes das diretrizes da empresa, reforçamos este comunicado, pois é dever de todos\n                                cumprir as regras...', '2024-02-14', '09:00:00', 'politicas.jpg', 'checkList.png', NULL),
(15, 'Benefícios', 'Cartão Caju', NULL, ' Atualização necessária no cadastro do aplicativo Caju!\n    Em breve, o app será atualizado com lançametnos e melhorias. Se você esquecer a senha de acesso ao fazer o login, poderá recuperá-la pelo e-mail ou telefone. Atualize esses dados e evite dor de cabeça ao acessar seu aplicativo. Seu eu do futuro agradece.\n', '2024-04-05', '08:44:00', 'politicas.jpg', 'beneficio.png', NULL),
(16, 'Felicitações', 'Dia das Mulheres', NULL, 'A Copimaq parabeniza todas estas guereiras de todos os dias e que são a base de nossa sociedade!', '2024-03-08', '08:00:00', 'diaMulheres.png', 'felicitações.png', NULL),
(21, 'Cozinha', 'Talheres identificados', NULL, 'Informamos que foram disponibilizados novos talheres para uso comum. Estes talheres estão identificados com a logo da Copimaq, sendo assim, estes são de uso exclusivo na cozinha.\nATENÇÃO: Em caso de perca novamente destes itens os benefícios serão retiradas por completo, ficando apenas o ambiente da cozinha para almoço e a utilização dos equipamentos micro-ondas e geladeira.', '2024-07-01', '15:48:00', 'talheres.png', NULL, NULL),
(22, 'Benefícios', 'Pesquisa para Cotação do convênio médico', NULL, 'Sempre em busca de melhorias para todos, a Copimaq está fazendo um novo levantamento de forncededores para convênio médico e a maioria das corretas nos solicitam a quantidade de vidas e faixa etária. Para recebermos um valor mais próximo possível gostaríamos que os interessados em participar desta nova cotação espondesse a pesquisa que estamos enviando. Lembrando que para recebermos o valor precisamos passar esta relação e quanto mais vidas, mais atrativo será o valor. Pedimos a colaoração de todos para responder ate dia 21/06. Acesso o link da pesquisa: https://forms.office.com/r/ReBVxexgPO.', '2024-06-21', '11:16:00', 'pesquisaConvenioCopimaq2024.png', NULL, NULL),
(23, 'Tecnologia da Informação', 'Acesso Restabelecido - ERP', NULL, 'Informamos que os acessos foram restabelecidos com sucesso, por favor validem seus acessos e qualquer dúvida ficamos a disposição. Agradecmos a compreensão de todos..', '2024-06-19', '16:43:00', 'beneficios.jpg', NULL, NULL),
(24, 'Tecnologia da Informação', 'Manutenção Emergencial - ERP', NULL, '\nEstimados Colaboradores,\n\nInformamos que hoje, 19 de junho de 2024, realizaremos uma manutenção emergencial no ERP DataClass, o que resultará na interrupção momentânea do acesso ao sistema.\n\nPrevê-se que os acessos ao ERP DataClass sejam interrompidos das 16h30 às 16h35.\n\nSolicitamos que se desconectem com 5 minutos de antecedência para evitar o risco de perda de dados em andamento.\n\nAgradecemos a compreensão de todos..', '2024-06-19', '16:24:00', 'manutençãoEmergencial.jpg', NULL, NULL),
(25, 'Software Bilhetagem', 'Data Center Global', NULL, 'Identificamos um acúmulo no processamento de arquivos no nosso Data Center Global 1.\n\nO comportamento já foi mapeado, as correções necessárias aplicadas, e estamos ativamente monitorando para normalizar a situação.\n \nEstamos cientes da urgência na disponibilização das informações em nossos portais e todas as ações necessárias foram implementadas para acelerar a retomada do processamento das informações.', '2024-06-27', '09:42:00', 'dataCenterGlobalNDD.png', NULL, NULL),
(26, 'Tecnologia da Informação', 'Dados Confidenciais - LGPD', 'f smldkgnaefkjnsdfjvnf b', '<p>Pedimos a todos que ao descartar qualquer documento que contenha dados de clientes ou qualquer outro cont&uacute;do confidencial, n&atilde;o apenas amassem, mas sim fragmentaem as folhas para que seja cumprido a Lei de LGPD para prote&ccedil;&atilde;o de dados.</p>', '2024-08-20', '18:36:30', 'lgpd.png', NULL, 'Equipe TI'),
(27, 'Comunicado', 'Estação de Carregamento', 'RESUMO MFASNASNAS NADKJ', '<p>Informamos que houve altera&ccedil;&atilde;o do local de carregamento dos celulares.</p>', '2024-08-21', '15:05:21', 'carregarCelular.jpg', NULL, 'Equipe TI'),
(28, 'Comunicado', 'Alimentos Geladeira', 'Resumo resumo resumo', '<p>Pedimos a colabora&ccedil;&atilde;o de todos em manter a geladeira sempre organizada e limpa.</p>', '2024-08-21', '15:05:14', 'geladeira.jpg', NULL, 'Equipe TI'),
(29, 'Software Bilhetagem', 'Suporte Técnico indisponível - PrintWayy', 'km nsdjsdfb sdfbvkadfbvkfnb', '<p>Gostar&iacute;amos de informar que na pr&oacute;xima quinta-feira, 15/08, nosso suporte t&eacute;cnico n&atilde;o estar&aacute; dispon&iacute;vel devido &agrave; feriado municipal de Lages/SC. Estaremos de volta e prontos para auxili&aacute;-los no hor&aacute;rio habitual na sexta-feira, dia 16/08. Agradecemos pela compreens&atilde;o e colabora&ccedil;&atilde;o. .</p>', '2024-08-20', '18:36:17', 'printwayy.png', NULL, 'Equipe TI'),
(32, 'Software Bilhetagem', '07 curiosidades sobre o mercado de outsourcing', 'resumo resumo resumo', '<p>Recentemente completamos 07 anos de empresa e voc&ecirc; p&ocirc;de&nbsp;<a href=\"https://printwayy.com/blog/e-festa-printwayy-comemora-seu-aniversario-de-07-anos/\" target=\"_blank\" rel=\"noopener noreferrer\"><strong>acompanhar aqui no blog como foi a nossa festa</strong></a>! A frente deste projeto desde o surgimento da ideia, tive a oportunidade de interagir com milhares de empreendedores do ramo de outsourcing de impress&atilde;o.&nbsp;</p>\r\n<p>Quando entramos no mercado, em 2014, t&iacute;nhamos o prop&oacute;sito de criar as melhores tecnologias para este ramo, mas tamb&eacute;m havia a preocupa&ccedil;&atilde;o em viabilizar o acesso a esse tipo de solu&ccedil;&atilde;o para empresas de pequeno porte ou que estavam come&ccedil;ando, as quais n&atilde;o conseguiam contratar outras solu&ccedil;&otilde;es do mercado devido o alto custo e complexidade na contrata&ccedil;&atilde;o e implanta&ccedil;&atilde;o.</p>\r\n<p>Esse prop&oacute;sito nos trouxe muitos desafios, precis&aacute;vamos entregar uma solu&ccedil;&atilde;o de ponta, escal&aacute;vel, f&aacute;cil de usar e financeiramente vi&aacute;vel para todos os portes. Junto com os desafios, vieram os aprendizados.&nbsp;</p>\r\n<p>Eu, particularmente, me envolvi durante anos com o processo comercial, conversando com empreendedores que nem sequer tinham a primeira impressora para locar, enquanto outros j&aacute; tinham empresas consolidadas e suas dezenas de milhares de impressoras locadas.</p>\r\n<p>Hoje quero compartilhar com voc&ecirc; o resultado destas intera&ccedil;&otilde;es t&atilde;o diversificadas que fiz, trazendo minha vis&atilde;o sobre as diferentes fases, d&uacute;vidas, cren&ccedil;as e desafios de quem empreende neste mercado.&nbsp;</p>\r\n<p>Aproveite o conte&uacute;do e espero que se identifique com alguma das 07 curiosidades elencadas!</p>\r\n<h2><strong>De onde surge a ideia ou a necessidade de empreender no ramo de outsourcing de impress&atilde;o?</strong></h2>\r\n<p>Vejo 02 cen&aacute;rios mais comuns. O primeiro &eacute; do profissional t&eacute;cnico, com expertise em manuten&ccedil;&atilde;o de impressoras, o qual possui uma ou mais experi&ecirc;ncias no ramo, colaborando em outras empresas, e decide se aventurar abrindo o pr&oacute;prio neg&oacute;cio. O&nbsp;<em>knowhow</em>&nbsp;em manuten&ccedil;&atilde;o traz seguran&ccedil;a para este novo empreendedor, pois a atividade chave est&aacute; sob o seu dom&iacute;nio.&nbsp;</p>\r\n<p>No entanto, h&aacute; ainda um grande caminho de aprendizado para a constru&ccedil;&atilde;o de uma empresa forte. Assuntos como&nbsp;<a href=\"https://printwayy.com/blog/como-gestao-de-contratos-influencia-no-cultivo-dos-clientes/\" target=\"_blank\" rel=\"noopener noreferrer\"><strong>contratos</strong></a>,&nbsp;<a href=\"https://printwayy.com/blog/como-acontece-a-tributacao-de-contratos-de-locacao-de-impressoras/\" target=\"_blank\" rel=\"noopener noreferrer\"><strong>tributa&ccedil;&atilde;o</strong></a>, compras, vendas,&nbsp;<a href=\"https://printwayy.com/blog/planilha-precificando-contratos-aprenda-calcular-o-cpp/\" target=\"_blank\" rel=\"noopener noreferrer\"><strong>precifica&ccedil;&atilde;o</strong></a>, relacionamento com cliente e&nbsp;<a href=\"https://printwayy.com/blog/dicas-de-gestao-de-contratos-rotina-pessoas-e-tempo/\" target=\"_blank\" rel=\"noopener noreferrer\"><strong>gest&atilde;o</strong></a>&nbsp;como um todo, costumam ser deixados de lado, o que implica em dificuldades para o crescimento e at&eacute; mesmo para a sobreviv&ecirc;ncia desta empresa.&nbsp;</p>\r\n<p>O empreendedor que tem essa consci&ecirc;ncia e busca aprendizado desde o primeiro dia, consegue construir um neg&oacute;cio profissional e atingir n&iacute;veis de excel&ecirc;ncia em curto prazo.</p>\r\n<p>O segundo cen&aacute;rio vem das empresas que prestam servi&ccedil;os de inform&aacute;tica em geral, como: venda e manuten&ccedil;&atilde;o de computadores e impressoras, servi&ccedil;os de cabeamento estruturado, manuten&ccedil;&atilde;o de infraestrutura, venda e recarga de cartuchos, pontos de impress&atilde;o e c&oacute;pia, entre outros.&nbsp;</p>\r\n<p>Geralmente h&aacute; na equipe ao menos um profissional que tem dom&iacute;nio da manuten&ccedil;&atilde;o em impressoras.</p>\r\n<p>Conforme essa empresa vai interagindo com os seus clientes no dia a dia, percebendo as demandas relacionadas &agrave; impress&atilde;o como: reposi&ccedil;&atilde;o de toner, substitui&ccedil;&atilde;o de pe&ccedil;as e manuten&ccedil;&otilde;es em geral, o pr&oacute;prio cliente final acaba solicitando a terceiriza&ccedil;&atilde;o destes servi&ccedil;os, objetivando reduzir seus custos e, muitas vezes, acessando equipamentos de melhor qualidade para sua utiliza&ccedil;&atilde;o.</p>\r\n<p>Outro caminho &eacute; a empresa perceber essa oportunidade e oferecer ao seu cliente. Como a loca&ccedil;&atilde;o ainda n&atilde;o &eacute; &ndash; e talvez nunca seja &ndash; a sua atividade principal, vejo empreendedores trabalhando de maneira &ldquo;amadora&rdquo; e considerando-a apenas mais um servi&ccedil;o do seu portf&oacute;lio, perdendo a oportunidade de se destacar.&nbsp;</p>\r\n<p>Por&eacute;m, muitos estabelecimentos encontram o caminho e passam a ser, exclusivamente, provedores de outsourcing de impress&atilde;o, deixando de oferecer os demais servi&ccedil;os e tornando-se refer&ecirc;ncia.</p>\r\n<h2><strong>Comodato, aluguel, loca&ccedil;&atilde;o ou outsourcing de impress&atilde;o</strong></h2>\r\n<p>Existem discuss&otilde;es e d&uacute;vidas entre as diferentes nomenclaturas adotadas para divulgar este tipo de servi&ccedil;o. Tem pessoas que defendem que o&nbsp;<strong>outsourcing de impress&atilde;o</strong>&nbsp;seria algo &ldquo;nobre&rdquo;, o qual s&oacute; existe quando o provedor trabalha com equipamentos novos, toner original e softwares diversos. Se fechou um contrato novo com equipamento usado, esquece, a&iacute; virou loca&ccedil;&atilde;o!</p>\r\n<p>J&aacute; o comodato &eacute; visto como algo &ldquo;inferior&rdquo; por se tratar, em tese, de um empr&eacute;stimo &ldquo;gratuito&rdquo; e uma precifica&ccedil;&atilde;o simplificada que demanda menos controle por parte do provedor.&nbsp;</p>\r\n<p>Por&eacute;m, tem empresas que se vendem como comodato e abrangem todo o leque de servi&ccedil;os oferecidos nesse tipo de neg&oacute;cio, incluindo equipamentos novos, contratos com&nbsp;<a href=\"https://printwayy.com/blog/afinal-de-contas-o-que-realmente-e-sla-e-para-que-ele-serve/\" target=\"_blank\" rel=\"noopener noreferrer\"><strong>SLA</strong></a>, softwares de monitoramento e gest&atilde;o, entre outros.</p>\r\n<p>Na minha opini&atilde;o, voc&ecirc; deve se desapegar dos termos!</p>\r\n<p>Ao t&eacute;rmino do dia, o que importa &eacute; o cliente final com seu problema resolvido, com a impress&atilde;o na qualidade e velocidade que julga necess&aacute;ria para sua opera&ccedil;&atilde;o e com o n&iacute;vel de atendimento desejado.&nbsp;</p>\r\n<p>Se a impressora &eacute; nova ou usada, se o toner &eacute; original ou compat&iacute;vel, nada disso importar&aacute;, ele s&oacute; quer imprimir!</p>\r\n<h2><strong>Eu n&atilde;o preciso de software</strong></h2>\r\n<p><em>&ldquo;Eu n&atilde;o preciso de software&rdquo;</em>&nbsp;&ndash;&nbsp;ouvi essa frase muitas vezes enquanto estava &agrave; frente do processo comercial.&nbsp;</p>\r\n<p>Todos os empreendedores que me falaram isso estavam cobertos de raz&atilde;o, pois quem precisava de software n&atilde;o eram eles, mas sim os seus neg&oacute;cios. Muitos provedores n&atilde;o se enxergam como empresas de tecnologia, e a&iacute; est&aacute; um grande equ&iacute;voco.&nbsp;</p>\r\n<p>As impressoras e multifuncionais est&atilde;o cada vez mais sofisticadas, cheias de tecnologias embarcadas e aprimoramentos em geral.&nbsp;</p>\r\n<p>O pr&oacute;prio cliente final quando busca a terceiriza&ccedil;&atilde;o dos servi&ccedil;os de impress&atilde;o, na verdade, est&aacute; buscando inova&ccedil;&atilde;o para o seu neg&oacute;cio e tempo livre para a atividade chave.&nbsp;</p>\r\n<p><strong>O provedor, como fornecedor desse servi&ccedil;o, &eacute; sim uma empresa de tecnologia e precisa estar atento para isso.</strong></p>\r\n<p>Talvez voc&ecirc; esteja imaginando que somente empreendedores de empresas pequenas possuem essa vis&atilde;o, mas cansei de ouvir isso de provedores com mais de 05 mil impressoras no parque, onde todo o seu processo de coleta de contadores para faturamento era manual!</p>\r\n<p>Ao mesmo tempo, empreendedores que estavam come&ccedil;ando no ramo, com a sua meia d&uacute;zia de impressoras locadas, j&aacute; viam a necessidade de buscar a nossa solu&ccedil;&atilde;o para conseguir se destacar em rela&ccedil;&atilde;o aos concorrentes, para fortalecer a sua proposta comercial e conseguir fechar seus primeiros neg&oacute;cios com mais facilidade. Tudo &eacute; uma quest&atilde;o de ponto de vista.</p>\r\n<h2>&nbsp;<strong>Quantidade de impressoras no parque</strong></h2>\r\n<p>Outro fato curioso &eacute; que a grande maioria das empresas n&atilde;o sabe exatamente quantas impressoras possuem no parque.&nbsp;</p>\r\n<p>Quando fazemos esta pergunta sempre acontece um momento de pausa, sil&ecirc;ncio e surge ent&atilde;o um n&uacute;mero m&aacute;gico. A falta de controle, seja atrav&eacute;s de um software, uma planilha do excel ou at&eacute; mesmo um caderninho, faz com que muitas empresas percam equipamentos pelo caminho.&nbsp;</p>\r\n<p>J&aacute; ouvi v&aacute;rios relatos de provedores que se &ldquo;lembraram&rdquo; de um determinado equipamento quando o cliente final perguntou sobre a cobran&ccedil;a, a qual fazia meses que n&atilde;o recebia!&nbsp;</p>\r\n<p>Obviamente a&iacute; h&aacute; um misto de desorganiza&ccedil;&atilde;o e falta de gest&atilde;o, mas de fato &eacute; mais comum do que se imagina. Voc&ecirc; a&iacute;, sabe dizer quantas impressoras possui no seu parque? Quantas est&atilde;o em clientes? Em backup? No seu estoque?</p>\r\n<h2><strong>ERP, em busca do software perfeito!</strong></h2>\r\n<p>Nesse quesito vejo 02 extremos. De um lado a empresa que n&atilde;o v&ecirc; valor em utilizar um ERP, seja porque ela &eacute; pequena ou por encarar como uma despesa a mais. De outro lado temos as empresas que buscam &ndash; e trocam &ndash; de solu&ccedil;&otilde;es ERP constantemente, por nunca estarem satisfeitas com a solu&ccedil;&atilde;o que contrataram.</p>\r\n<p>H&aacute; poucos ERPs no mercado que se dizem especialistas na gest&atilde;o de outsourcing de impress&atilde;o. Isso facilita o trabalho de pesquisa do provedor, quando busca este tipo de solu&ccedil;&atilde;o.&nbsp;</p>\r\n<p>No entanto, se faz necess&aacute;rio uma adapta&ccedil;&atilde;o dos seus processos &agrave; forma como o ERP disponibiliza todos os controles e fluxos de processo. Querer customiza&ccedil;&atilde;o a todo custo n&atilde;o vai funcionar e s&oacute; vai gerar frustra&ccedil;&atilde;o.</p>\r\n<p>Tamb&eacute;m temos muitos clientes que conseguem ter uma opera&ccedil;&atilde;o redondinha apenas usando o PrintWayy e uma solu&ccedil;&atilde;o gen&eacute;rica para gest&atilde;o financeira e de estoques.</p>\r\n<h2><strong>N&atilde;o h&aacute; como concorrer com os grandes players do mercado</strong></h2>\r\n<p>Essas s&atilde;o cren&ccedil;as limitantes que ou&ccedil;o de v&aacute;rios provedores:</p>\r\n<ul>\r\n<li>Ahh! O grande player consegue muito desconto em grandes compras;&nbsp;</li>\r\n<li>N&atilde;o tem como concorrer com os valores praticados por ele;&nbsp;</li>\r\n<li>Ele tem uma equipe gigantesca de t&eacute;cnicos;&nbsp;</li>\r\n<li>Tem uma marca muito conhecida.</li>\r\n</ul>\r\n<p>&Eacute; importante entender que os problemas e desafios s&atilde;o proporcionais ao tamanho da empresa. Devo ter medo de um grande player? N&atilde;o necessariamente.&nbsp;</p>\r\n<p>Mais importante &eacute; estar atento a todas as movimenta&ccedil;&otilde;es do mercado. Temos v&aacute;rios clientes pequenos, provedores com suas 100 impressoras, em m&eacute;dia, que se especializaram em captar oportunidades oriundas destes &ldquo;gigantes&rdquo;.</p>\r\n<p>Quando a empresa &eacute; muito grande, com dezenas de milhares de impressoras em todo o parque, fica praticamente imposs&iacute;vel garantir a reposi&ccedil;&atilde;o de suprimentos em dia, manter um excelente n&iacute;vel de atendimento, cumprir com SLA, tudo fica mais complicado.&nbsp;</p>\r\n<p>&Eacute; a&iacute; que voc&ecirc; pode atacar e preencher todos esses gaps que o grande player est&aacute; deixando a desejar. Ele deixa de ser o vil&atilde;o da hist&oacute;ria e passa a ser um gerador de oportunidades.</p>\r\n<h2><strong>Um mercado que n&atilde;o troca informa&ccedil;&otilde;es</strong></h2>\r\n<p>Uma caracter&iacute;stica marcante do mercado de outsourcing de impress&atilde;o &eacute; a baixa troca de informa&ccedil;&otilde;es entre as empresas.&nbsp;</p>\r\n<p>Ao mesmo tempo que os empreendedores possuem centenas de d&uacute;vidas sobre os seus neg&oacute;cios, n&atilde;o h&aacute; uma abertura para este tipo de conversa. Todos se enxergam como concorrentes diretos e qualquer informa&ccedil;&atilde;o pode colocar tudo a perder!</p>\r\n<p>Compartilhar informa&ccedil;&otilde;es, d&uacute;vidas, erros e cases de sucesso &eacute; uma das melhores maneiras de crescer e aprender junto.&nbsp;</p>\r\n<p>Essa pr&aacute;tica, a qual chamamos de&nbsp;<strong>benchmarking</strong>, &eacute; muito comum entre empresas de tecnologia, como a PrintWayy. No caso de uma poss&iacute;vel troca de experi&ecirc;ncias entre empresas do mesmo ramo, como os provedores de outsourcing de impress&atilde;o, h&aacute; muita oportunidade de aprendizado em benchmarkings cooperativos.&nbsp;</p>\r\n<p>Essa foi uma das motiva&ccedil;&otilde;es para criarmos o&nbsp;<a href=\"https://materiais.printwayy.com/dossie-do-outsourcing-de-impressao-2020-2021\" target=\"_blank\" rel=\"noopener noreferrer\"><strong>Dossi&ecirc; do Outsourcing de Impress&atilde;o</strong></a>, o qual traz muitos dados e comparativos que extra&iacute;mos da nossa base de clientes, atualmente composta por mais de 350 provedores em todo o Brasil. &Eacute; um excelente documento para se ter um norte, por&eacute;m n&atilde;o substitui uma boa conversa!</p>', '2024-08-21', '15:06:25', 'Comunicados07CuriosidadesMercadoOutsourcing.png', 'Comunicados07CuriosidadesMercadoOutsourcing.png', 'Equipe TI'),
(35, 'Cuidados', 'MAIO AMARELO: NO TRÂNSITO O SENTIDO É A VIDA!', 'ygbjhg jfg vgvk yguy', '<p style=\"line-height: 2;\">O Brasil est&aacute; na lista de pa&iacute;ses com mais mortes no tr&acirc;nsito!<br>S&atilde;o 16 vidas perdidas a cada 100mil Habitantes.<br>Cabe a n&oacute;s reduzir este n&uacute;mero!<br><span style=\"font-size: 10pt;\">Respeite a sinaliza&ccedil;&atilde;o;</span><br><span style=\"font-size: 10pt;\">Use as setas;</span><br><span style=\"font-size: 10pt;\">Mantenha dist&acirc;ncia dos outros ve&iacute;culos;</span><br><span style=\"font-size: 10pt;\">N&atilde;o use o celular ao volante;</span><br><span style=\"font-size: 10pt;\">Use o cinto de seguran&ccedil;a;&nbsp;</span><br><span style=\"font-size: 10pt;\">Ultrapasse com seguran&ccedil;a;</span></p>', '2024-08-21', '15:06:12', 'maioAmarelo2024.png', 'maioAmarelo2024.png', 'Equipe TI'),
(36, 'Intranet', 'Portal Intranet', 'i nhk bb hbk kb', '<p><br>Hoje, a <strong>Copimaq </strong>celebrou a inaugura&ccedil;&atilde;o de sua nova intranet, um avan&ccedil;o significativo para a comunica&ccedil;&atilde;o e gest&atilde;o interna da empresa.<br>Com a implementa&ccedil;&atilde;o desta plataforma digital, os funcion&aacute;rios ter&atilde;o acesso a uma s&eacute;rie de ferramentas e recursos que prometem otimizar a troca de informa&ccedil;&otilde;es, facilitar o acesso a documentos importantes e promover uma colabora&ccedil;&atilde;o mais eficaz entre equipes.</p>\r\n<p>A intranet da Copimaq foi desenvolvida com o objetivo de centralizar informa&ccedil;&otilde;es vitais, melhorar a transpar&ecirc;ncia e oferecer um espa&ccedil;o virtual seguro para a comunica&ccedil;&atilde;o interna. Entre suas funcionalidades, destacam-se p&aacute;gina de not&iacute;cias, pain&eacute;is de atualiza&ccedil;&otilde;es de monitoramentos e um centro de treinamento.</p>\r\n<p>A nova ferramenta &eacute; vista como um passo crucial para aumentar a efici&ecirc;ncia operacional, reduzir o tempo gasto na busca por informa&ccedil;&otilde;es e fortalecer o engajamento dos colaboradores.&nbsp;</p>\r\n<p>A Copimaq espera que, com a intranet, os funcion&aacute;rios possam se conectar mais facilmente e trabalhar de forma mais integrada, refletindo positivamente na produtividade e satisfa&ccedil;&atilde;o geral da equipe.</p>', '2024-08-20', '18:35:59', 'intranet2.png', 'intranet2.png', 'Equipe TI'),
(41, 'Beneficios', 'Aplicativo Caju!', 'Caju é uma plataforma de soluções integradas para sua empresa. Toda facilidade na gestão de multibenefícios, do colaborador, despesas corporativas, premiações e muito mais para levar sabor para a vida profissional......', '<h1 class=\"faktum-h1 main-home-section-title\">Cabe muita solu&ccedil;&atilde;o&nbsp;<span class=\"text-span-60\"><span style=\"color: #e67e23;\">num Caju</span>!</span></h1>\r\n<p>&nbsp;</p>\r\n<table style=\"border-collapse: collapse; width: 100%; border-style: none; border-spacing: 0px; height: 154.594px;\" border=\"0\"><colgroup><col style=\"width: 64.0508%;\"><col style=\"width: 35.9492%;\"></colgroup>\r\n<tbody>\r\n<tr style=\"height: 154.594px;\">\r\n<td style=\"padding: 10px;\">Caju &eacute; uma plataforma de solu&ccedil;&otilde;es integradas para sua empresa. Toda facilidade na gest&atilde;o de&nbsp;<strong>multibenef&iacute;cios, do colaborador, despesas corporativas, premia&ccedil;&otilde;es e muito mais</strong> para levar sabor para a vida profissional.</td>\r\n<td style=\"padding: 10px;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img src=\"../../../COMUM/img/Comunicados/caju.png\" width=\"236\" height=\"128\"></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<h5 class=\"heading-41 app-list-title\"><span style=\"font-size: 14pt;\">Aplicativo f&aacute;cil de usar, deixando experi&ecirc;ncia do colaborador ainda melhor</span></h5>\r\n<div class=\"list-app_item\">\r\n<div class=\"list-item_beneficios\"><img class=\"image-160\" src=\"https://cdn.prod.website-files.com/620135165cdb9f1d60b5d1e3/63ee972fb5ae31e4ce69df48_tick.svg\" alt=\"\" loading=\"lazy\">&nbsp;Cadastro e acesso com autentica&ccedil;&atilde;o&nbsp;</div>\r\n<div class=\"list-item_beneficios\"><img class=\"image-160\" src=\"https://cdn.prod.website-files.com/620135165cdb9f1d60b5d1e3/63ee972fb5ae31e4ce69df48_tick.svg\" alt=\"\" loading=\"lazy\">&nbsp;Carteiras diferentes para benef&iacute;cios, despesas e premia&ccedil;&otilde;es. Os saldos n&atilde;o se misturam!&nbsp;</div>\r\n<div class=\"list-item_beneficios\"><img class=\"image-160\" src=\"https://cdn.prod.website-files.com/620135165cdb9f1d60b5d1e3/63ee972fb5ae31e4ce69df48_tick.svg\" alt=\"\" loading=\"lazy\">&nbsp;Cart&atilde;o virtual para compras online</div>\r\n<div class=\"list-item_beneficios\"><img class=\"image-160\" src=\"https://cdn.prod.website-files.com/620135165cdb9f1d60b5d1e3/63ee972fb5ae31e4ce69df48_tick.svg\" alt=\"\" loading=\"lazy\">&nbsp;Suporte pelo aplicativo&nbsp;</div>\r\n<div class=\"list-item_beneficios\"><img class=\"image-160\" src=\"https://cdn.prod.website-files.com/620135165cdb9f1d60b5d1e3/63ee972fb5ae31e4ce69df48_tick.svg\" alt=\"\" loading=\"lazy\">&nbsp;Pedido de segunda via ou bloqueio de cart&atilde;o pelo app</div>\r\n<div class=\"list-item_beneficios\"><img class=\"image-160\" src=\"https://cdn.prod.website-files.com/620135165cdb9f1d60b5d1e3/63ee972fb5ae31e4ce69df48_tick.svg\" alt=\"\" loading=\"lazy\"> Saldo de benef&iacute;cios e extrato de uso&nbsp;</div>\r\n<div class=\"list-item_beneficios\">&nbsp;</div>\r\n<div class=\"list-item_beneficios\">\r\n<table style=\"border-collapse: collapse; width: 100%; border-spacing: 0px; border-style: none;\" border=\"0\"><colgroup><col style=\"width: 49.9253%;\"><col style=\"width: 49.9253%;\"></colgroup>\r\n<tbody>\r\n<tr>\r\n<td style=\"padding: 10px;\">\r\n<div id=\"w-node-_525dcf0b-ecf2-b32f-496e-cde276d9cb7c-9be9283c\" class=\"estatistica-item\">\r\n<div class=\"faktum-subtitle-1\"><span class=\"text-span-58\"><strong>Liberdade para o colaborador transeferir valores entre saldos flex&iacute;veis e usar o cajuzinho como quiser</strong></span></div>\r\n<div class=\"faktum-subtitle-1\">&nbsp;</div>\r\n<div class=\"faktum-subtitle-1\"><span class=\"text-span-58\"><strong>83%</strong>&nbsp;dos brasileiros</span>acreditam que o bem-estar &eacute; t&atilde;o importante quanto o sal&aacute;rio</div>\r\n<div class=\"faktum-caption-2\">&nbsp;</div>\r\n</div>\r\n<div id=\"w-node-_6063407a-d062-8560-2cdd-8e1def042176-9be9283c\" class=\"estatistica-item\">\r\n<div class=\"faktum-subtitle-1\"><span class=\"text-span-58\"><strong>44,2%</strong>&nbsp;das empresas</span>aderiram aos benef&iacute;cios flex&iacute;veis em 2022, ap&oacute;s a pandemia</div>\r\n<div class=\"faktum-caption-2\">&nbsp;</div>\r\n</div>\r\n<div id=\"w-node-ba239d03-90a2-b286-a283-7c8bdfdf1cec-9be9283c\" class=\"estatistica-item\">\r\n<div class=\"faktum-subtitle-1\"><span class=\"text-span-58\"><strong>67%</strong>&nbsp;dos trabalhadores</span>gostariam de poder escolher os benef&iacute;cios de acordo com as suas necessidades</div>\r\n<div class=\"faktum-caption-2\">&nbsp;</div>\r\n</div>\r\n<div id=\"w-node-bccd3eab-7f34-73a7-e69c-40221a201ad2-9be9283c\" class=\"estatistica-item\">\r\n<div class=\"faktum-subtitle-1\"><span class=\"text-span-58\"><strong>41,3%</strong>&nbsp;das companhias</span>oferecem benef&iacute;cios como uma estrat&eacute;gia para a reten&ccedil;&atilde;o de funcion&aacute;rios</div>\r\n</div>\r\n</td>\r\n<td style=\"padding: 10px;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <img src=\"blob:http://dev.intranet.copimaq.local/13c804de-c9e5-4b09-a8b7-82de05a13023\" width=\"322\" height=\"253\"></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n</div>\r\n</div>', '2024-08-21', '15:06:34', 'caju.png', 'caju.png', 'Equipe TI');

-- --------------------------------------------------------

--
-- Estrutura para tabela `contatos`
--

CREATE TABLE `contatos` (
  `id` double NOT NULL,
  `id_user_dono` int(11) NOT NULL,
  `id_user_contato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contatos`
--

INSERT INTO `contatos` (`id`, `id_user_dono`, `id_user_contato`) VALUES
(1, 42, 22),
(2, 42, 37),
(8, 21, 37),
(9, 37, 21),
(10, 30, 21),
(11, 37, 30),
(12, 30, 37),
(13, 37, 22),
(14, 21, 30),
(15, 30, 22),
(16, 30, 42),
(17, 22, 37),
(18, 21, 21),
(19, 37, 37),
(20, 22, 30),
(21, 21, 22),
(25, 42, 30),
(26, 37, 42),
(27, 21, 42),
(28, 42, 21),
(29, 22, 42),
(30, 42, 42),
(36, 30, 30),
(37, 22, 21),
(38, 42, 69),
(39, 22, 22),
(40, 73, 22),
(41, 22, 73),
(42, 73, 73),
(43, 37, 73),
(44, 73, 37),
(45, 74, 42),
(46, 42, 74),
(47, 74, 74);

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso`
--

CREATE TABLE `curso` (
  `ID_curso` int(200) NOT NULL,
  `Nome` varchar(400) NOT NULL,
  `Autor` varchar(500) NOT NULL,
  `Categoria` int(200) NOT NULL,
  `Subcategoria` int(11) NOT NULL,
  `Descricao` longtext NOT NULL,
  `Datadecriacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Carga_horaria` int(11) NOT NULL,
  `inscritos` int(11) NOT NULL,
  `imagem` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `curso`
--

INSERT INTO `curso` (`ID_curso`, `Nome`, `Autor`, `Categoria`, `Subcategoria`, `Descricao`, `Datadecriacao`, `Carga_horaria`, `inscritos`, `imagem`) VALUES
(1, 'HP MFP M428 FDW', 'Vetor', 4, 1, 'Curso para ensinar a como mexer na impressora M428 da HP. Esse curso é dividido em 2. O primeiro módulo ensina a como fazer o SMB e o segundo módulo ensina a como fazer o SMTP', '2024-08-05 17:24:04', 4, 5, 'm428.jpg'),
(2, 'Redes e infraestrutura', 'Herculano', 4, 2, 'Bem-vindo ao Curso Completo de Fundamentos de Rede! Neste curso, você aprenderá as tecnologias que mantêm o mundo como você conhece hoje conectado e funcionando. Cobrimos os fundamentos da rede, bem como os tópicos do novo exame Cisco CCNA 200-301.', '2024-06-17 13:37:06', 6, 0, 'redes_de_computadores.jpg'),
(3, 'Ricoh SP3510SF', 'Guilherme', 4, 1, 'O compacto RICOH® Aficio® SP 3500SF/SP 3510SF\r\noferece um conjunto de recursos multifuncionais inovadores que atendem suas necessidades exclusivas e se encaixam em seu orçamento. Ele desempenha facilmente uma grande variedade de tarefas de gestão de documentos.', '2024-06-17 13:37:06', 5, 0, 'sp3510sf.jpg'),
(4, 'Samsung Digitalização', 'Geovane', 4, 1, 'Curso feito para quando os dados de toda a organização e seus respectivos ativos são processados por meio de tecnologias digitais avançadas, levando a mudanças fundamentais nos processos de negócios que podem resultar em novos modelos de negócios e mudanças sociais.', '2024-07-03 19:15:26', 2, 1, 'logo_samsung.jpg'),
(5, 'Administração de Empresas', '', 1, 3, 'Curso para ensinar Administração básico', '2023-02-27 03:00:00', 0, 0, '5.png'),
(6, 'HP Principais Problemas de Impressão', 'Herculano', 4, 1, 'Diagnosticar e resolver\r\nNeste hub de solução de problemas, você encontrará as principais soluções automatizadas e de autoatendimento para problemas comuns de computador e impressora. Clique nas guias para alternar entre os tópicos do computador e da impressora e selecione um problema para ver as soluções.', '2024-06-27 16:28:20', 5, 1, 'hplogo.png'),
(7, 'Contabilidade', '', 3, 3, 'Curso para ensinar Administração básico', '2023-02-27 03:00:00', 0, 0, '7.png'),
(8, 'Ricoh Principais Problemas', 'Patrícia', 4, 1, 'Um curso que vai mostrar os principais problemas da impressora Ricoh tanto na impressão quanto na digitalização', '2024-06-27 16:28:27', 2, 1, 'ricohlogo.jpg'),
(35, 'PrintWayy', 'Patricia', 4, 4, 'O PrintWayy Dragon é um software com funcionalidades desenvolvidas especificamente para atender provedores de outsourcing de impressão.\r\n\r\nPor centralizar seu propósito em atender as mais diversas situações, ajudar com dificuldades e a solucionar problemas em parques de impressão (dos mais variados tamanhos) o PrintWayy Dragon é considerado um software completo, pois engloba todas as áreas e realiza o monitoramento além de fazer a gestão de todo o parque, integrando e automatizando os processos. \r\n\r\nCom o módulo de monitoramento você faz sua cobrança muito mais rápido e fica por dentro de tudo o que acontece dentro do seu parque. Mas é claro que isto você já sabia! \r\n\r\nE, também sabe, com o módulo de suprimentos você economiza muito com os insumos e, com os chamados você pode profissionalizar sua operação.\r\n\r\nMas nem sempre nossos usuários sabem de todas as funcionalidades que o PrintWayy Dragon tem disponível. Por esse motivo vou compartilhar algumas aplicações que podem ajudar você e sua equipe e, que talvez, você não as conheça.', '2024-06-17 13:37:06', 12, 0, 'logo-dragon.png'),
(36, 'PaperCut', 'Guilherme', 4, 4, 'Software de gerenciamento de impressão que possibilita a milhões de pessoas em todo o mundo a reduzir o desperdício, com uma experiência de impressão segura e fácil.', '2024-06-17 13:37:06', 12, 0, 'papercut_small_logo.png'),
(37, 'NDD Print', 'Herculano', 4, 4, 'O NDD Print é uma solução internacional voltada para o mercado de impressão, com tecnologias para provedores de outsourcing de impressão e clientes desses provedores.', '2024-06-17 13:37:06', 12, 0, 'logondd.png'),
(38, 'SafeQ', 'Leonardo', 4, 4, 'YSoft SafeQ: Uma plataforma de soluções de fluxo de trabalho feita para reduzir os custos dos serviços de impressão, aumentar a produtividade e aperfeiçoar a segurança da informação.\r\nCom a capacidade de monitorar e registrar os responsáveis por cada impressão, cópia e digitalização, você terá os dados necessários para compreender os custos e o comportamento de impressão atuais. As ferramentas ajudam a criar e impor políticas de impressão que reduzirão esses custos.\r\n\r\nCom o YSoft SafeQ, é fácil monitorar o ambiente de impressão. Os relatórios centralizados e o painel baseado na Web simplificam o gerenciamento do sistema de fluxo de trabalho e impressão.', '2024-06-17 13:37:06', 12, 0, 'safeq.png'),
(39, 'Card Studio 2.0', 'Copimaq', 4, 4, 'Aqui você aprenderá sobre a ferramenta ', '2024-08-13 11:22:26', 20, 3, 'zebra_cardstudio_2.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `curtidas`
--

CREATE TABLE `curtidas` (
  `id_Curtir` int(11) NOT NULL,
  `comunicado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `downloadDocGestao`
--

CREATE TABLE `downloadDocGestao` (
  `ID_Doc` int(11) NOT NULL,
  `ID_Tema` int(11) DEFAULT NULL,
  `Tema` varchar(100) DEFAULT NULL,
  `NomeArquivo` varchar(100) NOT NULL,
  `DataPostagem` date NOT NULL,
  `Responsavel` int(11) NOT NULL,
  `Arquivo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `downloadDocGestao`
--

INSERT INTO `downloadDocGestao` (`ID_Doc`, `ID_Tema`, `Tema`, `NomeArquivo`, `DataPostagem`, `Responsavel`, `Arquivo`) VALUES
(1, 1, 'Amil', 'Formulário de Cadastro - Plano Dental Amil', '2024-05-02', 12, 'Amil_Formulario_Cadastro.pdf'),
(2, 1, 'Amil', 'Formulário de Exclusão - Plano Dental Amil', '2024-05-02', 12, 'Amil_Formulario_Exclusao.pdf'),
(3, 1, 'Amil', 'Formulário de Saúde - Plano Dental Amil', '2024-05-02', 12, 'Amil_Declaracao_Saude.pdf'),
(4, 2, 'Carta de Oposição', 'Carta de Oposição ao Desconto das contribuições ao sindicato', '2024-05-02', 12, 'CARTA_OPOSICAO_DESCONTO_CONTRIBUICAO_ASSIT_CONF_.pdf'),
(5, 2, 'Carta de Oposição', 'Carta de Oposição ao Desconto das contribuições sindical urbana', '2024-05-02', 12, 'CARTA_OPOSICAO_DESCONTO_CONTRIBUICAO_SINDICAL_URBANA.pdf');

-- --------------------------------------------------------

--
-- Estrutura para tabela `downloadDocs`
--

CREATE TABLE `downloadDocs` (
  `ID_Doc` int(11) NOT NULL,
  `ID_Tema` int(11) NOT NULL,
  `Tema` varchar(100) NOT NULL,
  `NomeArquivo` varchar(100) NOT NULL,
  `DataPostagem` date NOT NULL,
  `Responsavel` int(11) NOT NULL,
  `Arquivo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `downloadDocs`
--

INSERT INTO `downloadDocs` (`ID_Doc`, `ID_Tema`, `Tema`, `NomeArquivo`, `DataPostagem`, `Responsavel`, `Arquivo`) VALUES
(1, 1, 'Marketing', 'Boletim Técnico', '2024-03-25', 40, 'BT_COMP_0000-FABRICANTE-ASSUNTO_V1.docx'),
(2, 1, 'Contratos', 'Contrato Master de Locação', '2024-04-23', 40, 'NOVO-Contrato_Master_Locação_Copimaq.doc'),
(3, 1, 'Marketing', 'Laudo Técnico', '2023-01-13', 40, 'Laudo_Técnico.docx'),
(4, 1, 'Comercial', 'Ficha Cadastral - Copimaq', '2023-08-18', 40, 'Ficha_Cadastral_(Copimaq).doc'),
(5, 1, 'Comercial', 'Ficha Cadastral - Cliente', '2023-08-18', 40, 'Ficha_Cadastral_(Cliente).docx');

-- --------------------------------------------------------

--
-- Estrutura para tabela `equipamentos`
--

CREATE TABLE `equipamentos` (
  `id` int(11) NOT NULL,
  `Tipo` varchar(50) DEFAULT NULL,
  `Fabricante` varchar(50) NOT NULL,
  `Modelo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `equipamentos`
--

INSERT INTO `equipamentos` (`id`, `Tipo`, `Fabricante`, `Modelo`) VALUES
(2, 'Hardware', 'Brother', 'DCP-8080DN'),
(3, 'Hardware', 'Brother', 'MFC-J5855DW'),
(4, 'Hardware', 'Brother', 'MFC-8952DW'),
(5, 'Hardware', 'Brother', 'MFC-J6935DW'),
(6, 'Hardware', 'Brother', 'MFC-J6955DW'),
(7, 'Hardware', 'Brother', 'MFC-T4500DW'),
(8, 'Hardware', 'Canon', 'G6000 series'),
(9, 'Hardware', 'Canon', 'G7000 series'),
(10, 'Hardware', 'Canon', 'GM4000 series'),
(11, 'Hardware', 'Epson', 'L365'),
(12, 'Hardware', 'Epson', 'L6190'),
(13, 'Hardware', 'HP', 'Color LaserJet 4303'),
(14, 'Hardware', 'HP', 'Color LaserJet CP1515n'),
(15, 'Hardware', 'HP', 'Color LaserJet E55040'),
(16, 'Hardware', 'HP', 'Color LaserJet E57540'),
(17, 'Hardware', 'HP', 'Color LaserJet E77830'),
(18, 'Hardware', 'HP', 'Color LaserJet E78323'),
(19, 'Hardware', 'HP', 'Color LaserJet E78330'),
(20, 'Hardware', 'HP', 'Color LaserJet E78635'),
(21, 'Hardware', 'HP', 'Color LaserJet M454dw'),
(22, 'Hardware', 'HP', 'Color LaserJet M479fdw'),
(23, 'Hardware', 'HP', 'Color LaserJet X57945'),
(24, 'Hardware', 'HP', 'Laser 408dn'),
(25, 'Hardware', 'HP', 'Laser 432fdn'),
(26, 'Hardware', 'HP', 'LaserJet 4103fdw'),
(27, 'Hardware', 'HP', 'LaserJet E42540'),
(28, 'Hardware', 'HP', 'LaserJet E50145'),
(29, 'Hardware', 'HP', 'LaserJet E52645'),
(32, 'Hardware', 'Ricoh', 'Aficio MP 2550B'),
(33, 'Hardware', 'Ricoh', 'Aficio MP 2852'),
(34, 'Hardware', 'Ricoh', 'Aficio MP C2051'),
(35, 'Hardware', 'Ricoh', 'Aficio MP C3502'),
(36, 'Hardware', 'Ricoh', 'Aficio SP 3500N'),
(37, 'Hardware', 'Ricoh', 'Aficio SP 3510DN'),
(38, 'Hardware', 'Ricoh', 'Aficio SP 3510SF'),
(39, 'Hardware', 'Ricoh', 'MP C307'),
(40, 'Hardware', 'Ricoh', 'MP C406Z'),
(41, 'Hardware', 'Ricoh', 'MP C3504'),
(42, 'Hardware', 'Ricoh', '	SP 3710SF'),
(43, 'Software', 'PrintWayy', 'PrintWayy Client'),
(44, 'Software', 'NDD Print', 'Portal NDD360'),
(45, 'Software', 'PaperCut', 'PaperCut MF'),
(46, 'Software', 'PaperCut', 'PaperCut MG'),
(47, 'Software', 'YSoft', 'SafeQ'),
(48, 'Hardware', 'Samsung', 'SL-M4070FR'),
(49, 'Software', 'Samsung', 'Modelos Samsung'),
(50, 'Hardware', 'Samsung', 'Modelos Samsung'),
(51, 'Hardware', 'HP', 'Modelos HP'),
(52, 'Software', 'HP', 'Modelos HP'),
(53, 'Hardware', 'Ricoh', 'MP 402SPF'),
(54, 'Hardware', 'Ricoh', 'Modelos Ricoh'),
(55, 'Software', 'Ricoh', 'Modelos Ricoh'),
(56, 'Instruções', 'Geral', 'Padrão Boletim'),
(57, 'Software', 'Zebra', 'Modelos Zebra'),
(58, 'Hardware', 'Zebra', 'Modelos Zebra'),
(59, 'Catálogo', 'Zebra', 'Modelos Zebra'),
(60, 'Hardware', 'Samsung', 'M408X Series'),
(61, 'Hardware', 'Samsung', 'SL-M4020DN'),
(62, 'Hardware', 'Samsung', 'SL-M4580FX'),
(63, 'Software', 'Brother', 'MFC-L6912DW'),
(64, 'Software', 'NDD Print', 'NDD Print');

-- --------------------------------------------------------

--
-- Estrutura para tabela `escolha`
--

CREATE TABLE `escolha` (
  `id` int(5) NOT NULL,
  `tipo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `escolha`
--

INSERT INTO `escolha` (`id`, `tipo`) VALUES
(1, 'Particular'),
(2, 'Pública');

-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos`
--

CREATE TABLE `eventos` (
  `ID_evento` int(11) NOT NULL,
  `Evento` varchar(50) NOT NULL,
  `Titulo` varchar(150) DEFAULT NULL,
  `Descricao` varchar(500) NOT NULL,
  `DataEvento` date NOT NULL,
  `HoraEvento` time DEFAULT NULL,
  `Localização` varchar(50) DEFAULT NULL,
  `DataPublicado` date NOT NULL,
  `HoraPublicado` time NOT NULL,
  `Arquivo` varchar(60) DEFAULT NULL,
  `Capa` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`ID_evento`, `Evento`, `Titulo`, `Descricao`, `DataEvento`, `HoraEvento`, `Localização`, `DataPublicado`, `HoraPublicado`, `Arquivo`, `Capa`) VALUES
(1, 'Páscoa', 'Páscoa!', 'Para esta Páscoa teremos cascata de chocolate sendo oferecida para todos os colaboradores.', '2024-03-28', '14:00:00', 'Copimaq', '2024-03-27', '11:39:00', 'pascoa2024.png', 'pascoa2024.png'),
(2, 'CopiBreak', 'testeRollback', 'Em clima de carnaval teremos nosso CopiBreak com espetinhos e refrigerantes! Um momento de descontração com todo time Copimaq.', '2024-02-13', NULL, NULL, '2024-02-06', '16:53:00', 'copiBreak2024.jpg', NULL),
(3, 'Natal', NULL, 'Mais um ano se finalizando e mais uma vez vamos comemorar nossas conquistas juntos!', '2023-12-22', NULL, NULL, '2023-11-14', '10:29:00', 'natal2023.png', NULL),
(4, 'Arraiá', '08 De Julho: Arraiá da Copimaq.', 'Bóra pra festa pessoar!!! No dia da festança vamu direto sem armoçar pra poder aproveitar mais dos comis e bébi, que são muito bão.\nSe quisé pode vir a caráter e tirá um monte de sérfi,\njá que o celulá vai tá libererado durante a festa.', '2024-07-08', '14:00:00', 'Copimaq', '2024-06-05', '11:00:00', 'arraiá2024.png', 'arraia2024.png'),
(5, 'Desafio 90 dias', NULL, 'Emagreça com saúde! Aproveite essa campanha para iniciar hábitos mais saudáveis. \nEntre nesse desafio esupere seus limites e seja sua proópria motivação.', '2023-11-09', NULL, NULL, '2023-07-31', '16:04:00', 'desafio90dias.png', NULL),
(6, 'Desafio 90 dias', 'Emagreça com saúde!', 'Emagreça com saúde! Aproveite essa campanha para iniciar hábitos mais saudáveis. \nEntre nesse desafio esupere seus limites e seja sua proópria motivação.', '2023-11-09', NULL, NULL, '2023-07-31', '16:04:00', 'desafio90dias.png', NULL),
(7, 'Café da Manhã', 'Café da Manhá: Julho', 'Nosso cafè da manhã especial dos aniversáriantes de julho', '2024-07-31', '07:30:00', 'Copimaq', '2024-07-31', '08:00:00', 'cafeManha.jpg', 'cafeManha.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `experiencias`
--

CREATE TABLE `experiencias` (
  `ID_Experiencia` int(11) NOT NULL,
  `Empresa` varchar(100) NOT NULL,
  `Cargo` varchar(100) NOT NULL,
  `Inicio` date NOT NULL,
  `Fim` date DEFAULT NULL,
  `Colaborador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `experiencias`
--

INSERT INTO `experiencias` (`ID_Experiencia`, `Empresa`, `Cargo`, `Inicio`, `Fim`, `Colaborador`) VALUES
(1, 'Copimaq', 'Analista de Suporte - Trainee', '2022-07-11', '2024-03-31', 37),
(2, 'Copimaq', 'Analista de Suporte', '2024-04-01', '0000-00-00', 37),
(3, 'Copimaq', 'Analista de Suporte', '2019-12-01', '2021-07-01', 22),
(4, 'Copimaq', 'Analista de Suporte Pleno', '2021-07-01', '2022-02-01', 22),
(5, 'Copimaq', 'Analista de Suporte Sênior', '2022-02-01', '2023-03-01', 22),
(6, 'Copimaq', 'Gerente de TI', '2023-03-01', '0000-00-00', 22);

-- --------------------------------------------------------

--
-- Estrutura para tabela `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `formacaoAcademica`
--

CREATE TABLE `formacaoAcademica` (
  `ID_Formacao` int(11) NOT NULL,
  `Escola` varchar(100) NOT NULL,
  `TipoCurso` varchar(100) NOT NULL,
  `Curso` varchar(100) NOT NULL,
  `Inicio` date NOT NULL,
  `Conclusao` date NOT NULL,
  `Estudante` int(11) NOT NULL,
  `Certificado` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `formacaoAcademica`
--

INSERT INTO `formacaoAcademica` (`ID_Formacao`, `Escola`, `TipoCurso`, `Curso`, `Inicio`, `Conclusao`, `Estudante`, `Certificado`) VALUES
(1, 'Faculdade Anhanguera Educacional', 'Graduacao', 'Ciências da Computação', '2009-01-01', '2013-12-01', 22, 'nadaConsta.png'),
(2, 'Faculdade Anhanguera Educacional', 'Tecnologo', 'Tecnologia em Análise e Desenvolvimento de Sistemas - TADS', '2013-07-01', '2015-12-01', 37, 'nadaConsta.png'),
(3, 'NDD', 'Certificacao', 'Releaser Técnico', '2023-01-12', '2023-01-12', 37, '6171523211.pdf'),
(4, 'NDD', 'Certificacao', 'Contabilização com equipamentos HP', '2022-12-30', '2022-12-30', 37, '6219556298.pdf'),
(5, 'NDD', 'Certificacao', 'NDD Print - Reportes Personalizados', '2022-12-30', '2022-12-30', 37, '7034539992.pdf'),
(6, 'NDD', 'Certificacao', 'Treinamento Técnico Operacional', '2023-01-11', '2023-01-11', 37, '7363862906.pdf'),
(7, 'NDD', 'Certificacao', 'NDD Print MPS - Configurações', '2023-01-12', '2023-01-12', 37, '9160328997.pdf'),
(8, 'NDD', 'Certificacao', 'Treinamento Técnico Impressoras', '2023-01-11', '2023-01-11', 37, '9499918537.pdf'),
(9, 'Fundação Bradesco', 'Certificacao', 'Introdução a Redes de Computadores', '2022-06-30', '2022-07-10', 37, 'introducao_redes_computadores.pdf'),
(10, 'Fundação Bradesco', 'Certificacao', 'Lógica de Programação', '2017-03-02', '2017-03-02', 37, 'logica_programacao.pdf'),
(11, 'Mentorama', 'Webnar', 'Back-End: Java vs Python', '2022-03-31', '2022-03-31', 37, 'introducao_redes_computadores.pdf'),
(12, 'Mentorama', 'Webnar', 'Como dar os primeiros passos com programação?', '2022-04-12', '2022-04-12', 37, 'Webnar_Mentorama_Patricia_Canciano.pdf');

-- --------------------------------------------------------

--
-- Estrutura para tabela `forum`
--

CREATE TABLE `forum` (
  `ID_Forum` int(11) NOT NULL,
  `ID_usuario` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Data_envio` date NOT NULL,
  `Hora_envio` time NOT NULL,
  `Pergunta` varchar(50) NOT NULL,
  `Mensagem` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `galeria`
--

CREATE TABLE `galeria` (
  `id` int(11) NOT NULL,
  `Evento` varchar(100) DEFAULT NULL,
  `Descricao` varchar(200) DEFAULT NULL,
  `DataEvento` date DEFAULT NULL,
  `Pasta` varchar(100) DEFAULT NULL,
  `CaminhoPasta` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `galeria`
--

INSERT INTO `galeria` (`id`, `Evento`, `Descricao`, `DataEvento`, `Pasta`, `CaminhoPasta`) VALUES
(1, 'Confraternização - 2021', 'Confraternização de fim de ano Copimaq 2021.', '2021-12-17', 'Confraternização_2021', '/var/www/dev-intranet/public/COMUM/img/Confraternização_2021'),
(2, 'Arraiá - 2021', 'Festa Junina na Copimaq 2021.', '2021-07-30', 'Arraia_2021', '/var/www/dev-intranet/public/COMUM/img/Arraia_2021'),
(3, 'Dia das Mulheres - 2021', 'Dia das Mulheres 2021.', '2021-03-08', 'Dia_das_Mulheres_2021', '/var/www/dev-intranet/public/COMUM/img/Dia_das_Mulheres_2021'),
(4, 'Pácoa - 2021', 'Páscoa 2021.', '2021-04-01', 'Pascoa_2021', '/var/www/dev-intranet/public/COMUM/img/Pascoa_2021'),
(5, 'Dia das Mulheres - 2024', 'Dia das Mulheres 2024.', '2024-03-08', 'Dia_das_Mulheres_2024', '/var/www/dev-intranet/public/COMUM/img/Dia_das_Mulheres_2024'),
(7, 'Dia das Mulheres - 2023', 'Dia das Mulheres 2023.', '2023-03-09', 'Dia_das_mulheres_Pilates_2023', '/var/www/dev-intranet/public/COMUM/img/Dia_das_mulheres_Pilates_2023'),
(8, 'Dia das Mulheres - 2022', 'Dia das Mulheres 2022.', '2022-03-08', 'Dia_das_Mulheres_2022', '/var/www/dev-intranet/public/COMUM/img/Dia_das_Mulheres_2022'),
(9, 'Festa Junina - 2022', 'Festa Junina 2022.', '2022-06-17', 'Festa_Junina_2022', '/var/www/dev-intranet/public/COMUM/img/Festa_Junina_2022'),
(11, 'Arraiá - 2023', 'Festa Junina 2023.', '2023-06-30', 'Arraia_2023', '/var/www/dev-intranet/public/COMUM/img/Arraia_2023'),
(12, 'Confraternização - 2023', 'Confraternização de fim de ano Copimaq 2023.', '2023-12-22', 'Confraternização_2023', '/var/www/dev-intranet/public/COMUM/img/Confraternização_2023'),
(13, 'Confraternização - 2022', 'Confraternização de fim de ano Copimaq 2022.', '2022-12-16', 'Confraternização_2022', '/var/www/dev-intranet/public/COMUM/img/Confraternização_2022'),
(14, 'Confraternização - 2019', 'Confraternização de fim de ano Copimaq 2019.', '2019-11-19', 'Confraternização_2019', '/var/www/dev-intranet/public/COMUM/img/Confraternização_2019'),
(15, 'Confraternização - 2020', 'Confraternização de fim de ano Copimaq 2020.', '2020-11-27', 'Confraternização_2020', '/var/www/dev-intranet/public/COMUM/img/Confraternização_2020'),
(16, 'Desafio 90 dias - 2023', 'Desafio de emagrecimento - 90 dias.', '2023-10-11', 'Palestra_Desafio_90_Dias_2023', '/var/www/dev-intranet/public/COMUM/img/Palestra_Desafio_90_Dias_2023'),
(17, 'Chá da Manu - 2022', 'Chá de bebê surpresa para a chegada da Manu.', '2022-01-28', 'cha_da_Manu_2022', '/var/www/dev-intranet/public/COMUM/img/cha_da_Manu_2022'),
(18, 'Copimaq 30 anos - 2022', 'Aniversário 30 anos da Copimaq.', '2022-08-04', 'Copimaq_30Anos_2022', '/var/www/dev-intranet/public/COMUM/img/Copimaq_30Anos_2022'),
(19, 'Halloween - 2019', 'Halloween.', '2019-10-31', 'Halloween_2019', '/var/www/dev-intranet/public/COMUM/img/Halloween_2019'),
(20, 'Outubro Rosa/Novembro Azul - 2019', 'Outubro Rosa e Novembro Azul.', '2019-10-25', 'OutRosa_NovAzul_2019', '/var/www/dev-intranet/public/COMUM/img/OutRosa_NovAzul_2019');

-- --------------------------------------------------------

--
-- Estrutura para tabela `inscricao`
--

CREATE TABLE `inscricao` (
  `id_curso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `progresso` float NOT NULL,
  `certificado` varchar(255) NOT NULL,
  `data_de_inscricao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `data_conclusao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `inscricao`
--

INSERT INTO `inscricao` (`id_curso`, `id_usuario`, `progresso`, `certificado`, `data_de_inscricao`, `data_conclusao`) VALUES
(1, 21, 0, 'sim', '2024-08-05 17:24:04', NULL),
(1, 74, 0, 'sim', '2024-07-03 19:16:07', NULL),
(4, 74, 0, 'sim', '2024-07-03 19:15:26', NULL),
(39, 37, 12.5, 'sim', '2024-06-27 16:44:22', NULL),
(39, 42, 12.5, 'sim', '2024-08-13 11:22:26', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `inscricao_grupo`
--

CREATE TABLE `inscricao_grupo` (
  `id_cliente` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `inscricao_grupo`
--

INSERT INTO `inscricao_grupo` (`id_cliente`, `id_grupo`) VALUES
(21, 8),
(21, 9),
(37, 7),
(37, 10),
(42, 7),
(42, 8),
(42, 9),
(42, 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `lembretes`
--

CREATE TABLE `lembretes` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `data` date NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lembretes`
--

INSERT INTO `lembretes` (`id`, `id_user`, `data`, `texto`) VALUES
(5, 42, '2024-06-19', 'testado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `manuaisEquipamentos`
--

CREATE TABLE `manuaisEquipamentos` (
  `id` int(11) NOT NULL,
  `Titulo` varchar(150) DEFAULT NULL,
  `Tipo` varchar(50) DEFAULT NULL,
  `Fabricante` varchar(50) DEFAULT NULL,
  `Modelo` varchar(50) DEFAULT NULL,
  `Assunto` varchar(100) DEFAULT NULL,
  `Nome_Arquivo` varchar(100) DEFAULT NULL,
  `Caminho_arquivo` varchar(100) DEFAULT NULL,
  `Postado_Em` datetime DEFAULT NULL,
  `Usuario` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `manuaisEquipamentos`
--

INSERT INTO `manuaisEquipamentos` (`id`, `Titulo`, `Tipo`, `Fabricante`, `Modelo`, `Assunto`, `Nome_Arquivo`, `Caminho_arquivo`, `Postado_Em`, `Usuario`) VALUES
(4, 'Manual do Fabricante HP E42540', 'Hardware', 'HP', 'LaserJet E42540', 'Manual do Fabricante', 'Manual_HP_E42540.pdf', '/var/www/dev-intranet/public/COMUM/PDF/Manuais/Manual_HP_E42540.pdf', NULL, NULL),
(5, 'Manual do Operador Samsung M4080', 'Hardware', 'Samsung', 'M408X Series', '', 'Manual-de-operador-M4080.pdf', '/var/www/dev-intranet/public/COMUM/PDF/Manuais/Manual-de-operador-M4080.pdf', NULL, NULL),
(6, 'Manual do Usu&aacute;rio Samsung SL-M4070FR', 'Hardware', 'Samsung', 'SL-M4070FR', 'Manual do Fabricante', 'Manual_do_usuário_Samsung_SL-M4070FR.pdf', '/var/www/dev-intranet/public/COMUM/PDF/Manuais/Manual_do_usuário_Samsung_SL-M4070FR.pdf', NULL, NULL),
(7, 'Manual do Usu&aacute;rio Samsung SL-M4020DN', 'Hardware', 'Samsung', 'SL-M4020DN', 'Manual do Fabricante', 'Manual_do_usuário_SL-M4020DN.pdf', '/var/www/dev-intranet/public/COMUM/PDF/Manuais/Manual_do_usuário_SL-M4020DN.pdf', NULL, NULL),
(8, 'Manual do Usu&aacute;rio Samsung SL-M4580FX', 'Hardware', 'Samsung', 'SL-M4580FX', 'Manual do Fabricante', 'Manual_Samsung_SL-M4580.pdf', '/var/www/dev-intranet/public/COMUM/PDF/Manuais/Manual_Samsung_SL-M4580.pdf', NULL, NULL),
(9, 'Instala&ccedil;&atilde;o Driver - Brother MCF-L6912DW', 'Hardware', 'Canon', 'G7000 series', '', 'BT_TI_0008-NDDPRINT-COPIMAQ.pdf', '/var/www/dev-intranet/public/COMUM/PDF/Manuais/BT_TI_0008-NDDPRINT-COPIMAQ.pdf', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `nome_usuario` varchar(500) NOT NULL,
  `mensagem` varchar(600) NOT NULL,
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tipo` varchar(100) NOT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mensagens`
--

INSERT INTO `mensagens` (`id`, `usuario`, `nome_usuario`, `mensagem`, `data_envio`, `tipo`, `id_admin`) VALUES
(1, 42, 'Victor Sofiato', 'teste', '2024-01-26 12:38:21', 'cliente', 1),
(2, 42, 'Suporte', 'teste', '2024-01-26 12:41:05', 'suporte', 1),
(3, 21, 'Guilherme Patez', 'Teste', '2024-02-02 19:01:16', 'cliente', 1),
(4, 21, 'Guilherme Patez', 'teste', '2024-02-08 18:39:50', 'cliente', 1),
(5, 21, 'Guilherme Patez', 'Olá', '2024-02-13 17:31:08', 'cliente', 1),
(6, 22, 'Herculano Nascimento', 'Poderia informar quando vai sair a sengunda parte do curso da HP?', '2024-02-29 16:18:15', 'cliente', 1),
(7, 37, 'Patrícia Canciano', 'o que é DHCP?', '2024-03-01 13:43:37', 'cliente', 1),
(8, 22, 'Herculano Nascimento', '', '2024-03-07 23:31:39', 'cliente', 1),
(9, 22, 'Herculano Nascimento', 'oi', '2024-03-07 23:31:42', 'cliente', 1),
(12, 42, 'Victor Sofiato', 'teste', '2024-03-28 18:58:51', 'cliente', 1),
(13, 42, 'Victor Sofiato', 'teste2', '2024-03-28 18:58:56', 'cliente', 1),
(14, 37, 'Patrícia Canciano', 'help ', '2024-03-28 19:13:50', 'cliente', 1),
(15, 37, 'Patrícia Canciano', 'CopiZap', '2024-03-28 19:14:37', 'cliente', 1),
(16, 37, 'Suporte', 'Olá!', '2024-03-28 19:14:44', 'suporte', 1),
(17, 37, 'Patrícia Canciano', 'k', '2024-03-28 19:15:19', 'cliente', 1),
(18, 37, 'Patrícia Canciano', 'ii', '2024-03-28 19:15:23', 'cliente', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagensgrupo`
--

CREATE TABLE `mensagensgrupo` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(500) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `mensagem` varchar(500) DEFAULT NULL,
  `arquivos` varchar(255) DEFAULT NULL,
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mensagensgrupo`
--

INSERT INTO `mensagensgrupo` (`id`, `id_usuario`, `nome_usuario`, `id_grupo`, `mensagem`, `arquivos`, `data_envio`) VALUES
(15, 37, 'Patrícia Canciano', 9, 'TESTE', NULL, '2024-06-10 13:56:39'),
(16, 42, 'Victor Sofiato', 9, 'testando 1234555697654321', '', '2024-06-13 15:47:54'),
(17, 42, 'Victor Sofiato', 9, '', 'dad3cb4e1e763fe22022e1f3741d9a28.png', '2024-06-13 15:48:15'),
(18, 42, 'Victor Sofiato', 9, '', 'ab13516015b217c277d1e577fb844f4a.png', '2024-06-13 15:50:13'),
(19, 42, 'Victor Sofiato', 9, '', '1718294826_fotodosistema.jpg', '2024-06-13 16:07:06'),
(20, 42, 'Victor Sofiato', 9, '', 'mineracaojunduproblema.jpg', '2024-06-13 17:46:36'),
(21, 42, 'Victor Sofiato', 9, '😎', '', '2024-06-13 18:39:05'),
(22, 42, 'Victor Sofiato', 9, '', 'FrankSinatraYouveGotaFriendinMe.mp3', '2024-06-13 18:39:16'),
(23, 42, 'Victor Sofiato', 9, 'teste', '', '2024-06-13 18:42:13'),
(24, 42, 'Victor Sofiato', 9, '😀', '', '2024-06-13 18:47:21'),
(25, 42, 'Victor Sofiato', 9, '', 'Imagem do WhatsApp de 2024-05-08 à(s) 14.52.08_81aca19c.jpg', '2024-06-13 19:32:35'),
(26, 42, 'Victor Sofiato', 9, 'teste', '', '2024-06-13 19:43:53'),
(27, 42, 'Victor Sofiato', 9, '', 'Imagem do WhatsApp de 2024-05-08 à(s) 14.52.08_81aca19c.jpg', '2024-06-13 19:44:04'),
(28, 42, 'Victor Sofiato', 9, '', 'FrankSinatraYouveGotaFriendinMe.mp3', '2024-06-13 19:44:10'),
(29, 42, 'Victor Sofiato', 9, '', 'impressorapiscandovermelho.mp4', '2024-06-13 19:44:39'),
(30, 42, 'Victor Sofiato', 9, '', 'catalogo-HP-PRO-4103FDW.pdf', '2024-06-13 20:05:29'),
(31, 37, 'Patrícia Canciano', 9, 'Testado!', NULL, '2024-06-14 12:35:07'),
(32, 42, 'Victor Sofiato', 7, 'sfdsfsd', '', '2024-06-14 14:48:33'),
(33, 42, 'Victor Sofiato', 7, 'testando envio 123', '', '2024-06-14 14:52:10'),
(34, 42, 'Victor Sofiato', 7, '😎', '', '2024-06-14 15:05:12'),
(35, 42, 'Victor Sofiato', 7, 'Chat encerrado', '', '2024-06-14 15:14:42'),
(36, 42, 'Victor Sofiato', 7, 'Chat encerrado', '', '2024-06-14 15:15:26'),
(37, 42, 'Victor Sofiato', 7, 'Chat encerrado', '', '2024-06-14 15:15:30'),
(38, 42, 'Victor Sofiato', 7, 'Chat encerrado', '', '2024-06-14 15:15:31'),
(39, 42, 'Victor Sofiato', 7, 'Chat encerrado', '', '2024-06-14 15:15:31'),
(40, 42, 'Victor Sofiato', 7, 'Chat encerrado', '', '2024-06-14 15:15:35'),
(41, 42, 'Victor Sofiato', 7, 'Chat reaberto', '', '2024-06-14 15:28:39'),
(42, 42, 'Victor Sofiato', 7, 'agora pode enviar', '', '2024-06-14 15:28:46'),
(43, 42, 'Victor Sofiato', 7, 'Chat reaberto', '', '2024-06-14 15:28:50'),
(44, 42, 'Victor Sofiato', 7, 'Chat encerrado', '', '2024-06-14 15:29:14'),
(45, 42, 'Victor Sofiato', 7, 'Chat reaberto', '', '2024-06-14 15:29:29'),
(46, 42, 'Victor Sofiato', 7, 'teste', '', '2024-06-14 15:29:39'),
(47, 42, 'Victor Sofiato', 7, 'Chat reaberto', '', '2024-06-14 15:29:43'),
(48, 42, 'Victor Sofiato', 7, 'Chat encerrado', '', '2024-06-14 15:38:21'),
(49, 42, 'Victor Sofiato', 7, 'Chat reaberto', '', '2024-06-14 15:38:31'),
(50, 42, 'Victor Sofiato', 7, 'teste12345678', '', '2024-06-14 15:38:40'),
(51, 42, 'Victor Sofiato', 7, 'Chat encerrado', '', '2024-06-14 15:38:44'),
(52, 37, 'Patrícia Canciano', 10, 'DUVIDA', '', '2024-06-14 15:51:59'),
(53, 37, 'Patrícia Canciano', 10, 'Chat encerrado', '', '2024-06-14 15:52:03'),
(54, 37, 'Patrícia Canciano', 10, 'Chat reaberto', '', '2024-06-14 15:52:29'),
(55, 37, 'Patrícia Canciano', 10, 'HHH', '', '2024-06-14 15:52:32'),
(56, 42, 'Victor Sofiato', 10, 'sfseffw', '', '2024-06-14 15:52:43'),
(57, 42, 'Victor Sofiato', 9, 'Chat encerrado', '', '2024-06-17 12:58:38'),
(58, 42, 'Victor Sofiato', 9, 'Chat reaberto', '', '2024-06-17 12:59:01'),
(59, 42, 'Victor Sofiato', 9, 'Chat encerrado', '', '2024-06-17 12:59:05');

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagens_zap`
--

CREATE TABLE `mensagens_zap` (
  `id_mensagem` int(11) NOT NULL,
  `id_user_envio` int(11) NOT NULL,
  `id_user_recebe` int(11) NOT NULL,
  `mensagem` text NOT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `data_hora` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `mensagem_lida` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mensagens_zap`
--

INSERT INTO `mensagens_zap` (`id_mensagem`, `id_user_envio`, `id_user_recebe`, `mensagem`, `arquivo`, `data_hora`, `mensagem_lida`) VALUES
(406, 42, 37, 'Ouve isso!', NULL, '2024-06-05 19:15:16', 1),
(407, 42, 37, '', '../IMAGEM/UPLOADS/37-42/FrankSinatraYouveGotaFriendinMe.mp3', '2024-06-05 19:15:16', 1),
(408, 42, 21, 'devolvendo o seu vídeo', NULL, '2024-06-05 17:42:29', 1),
(409, 42, 21, '', '../IMAGEM/UPLOADS/21-42/Portal Treinamento Zebra.mp4', '2024-06-05 17:42:29', 1),
(410, 42, 21, 'teste', NULL, '2024-06-05 17:42:29', 1),
(411, 42, 21, 'de', NULL, '2024-06-05 17:42:29', 1),
(412, 42, 21, 'carga', NULL, '2024-06-05 17:42:29', 1),
(413, 42, 21, '', '../IMAGEM/UPLOADS/21-42/warning.png', '2024-06-05 17:42:29', 1),
(414, 42, 21, 'teste', NULL, '2024-06-05 17:42:29', 1),
(415, 42, 21, 'teste2', NULL, '2024-06-05 17:42:29', 1),
(416, 42, 21, '', '../IMAGEM/UPLOADS/21-42/FrankSinatraYouveGotaFriendinMe.mp3', '2024-06-05 17:42:29', 1),
(417, 21, 42, 'a', NULL, '2024-06-05 17:43:30', 1),
(418, 21, 42, 'a', NULL, '2024-06-05 17:43:45', 1),
(419, 21, 42, '📇📯', NULL, '2024-06-05 17:43:55', 1),
(420, 42, 21, 'teste', NULL, '2024-06-07 17:31:47', 1),
(421, 42, 21, 'teste', NULL, '2024-06-07 17:31:47', 1),
(422, 42, 21, 'parte1', NULL, '2024-06-07 17:31:47', 1),
(423, 42, 21, 'olha isso!', NULL, '2024-06-07 17:31:47', 1),
(424, 42, 21, 'olá', NULL, '2024-06-07 17:31:47', 1),
(425, 42, 21, 'teste', NULL, '2024-06-07 17:31:47', 1),
(426, 37, 42, 'Nossa vitor🤩 que da hora', NULL, '2024-06-05 19:27:42', 1),
(428, 37, 42, 'assina a OS ai please', NULL, '2024-06-05 19:27:42', 1),
(429, 37, 21, 'voce ouviu o audio que o Vetor mandou?', NULL, '2024-06-07 17:31:41', 1),
(430, 37, 42, 'lsdnçaçlf naç', NULL, '2024-06-05 19:27:42', 1),
(431, 37, 42, '', '../IMAGEM/UPLOADS/37-42/OS024248.PDF', '2024-06-05 19:27:42', 1),
(432, 37, 42, 'assina ai please', '../IMAGEM/UPLOADS/37-42/OS025970.PDF', '2024-06-05 19:27:42', 1),
(433, 37, 42, 'assina ai please', '../IMAGEM/UPLOADS/37-42/OS031913.PDF', '2024-06-05 19:27:42', 1),
(434, 37, 42, 'd', '../IMAGEM/UPLOADS/37-42/OS025748.PDF', '2024-06-05 19:27:42', 1),
(435, 37, 42, ' d', '../IMAGEM/UPLOADS/37-42/OS025970.PDF', '2024-06-05 19:27:42', 1),
(436, 42, 37, 'testado', NULL, '2024-06-06 18:45:46', 1),
(441, 21, 42, 'bom dia', NULL, '2024-06-05 21:01:45', 1),
(455, 37, 42, 'o que foi testado?', NULL, '2024-06-06 18:46:41', 1),
(456, 37, 42, 'botao do sino?', NULL, '2024-06-06 18:46:41', 1),
(457, 37, 42, 'conte mais sobre isso?', NULL, '2024-06-06 18:46:41', 1),
(458, 42, 37, 'http://dev.intranet.copimaq.local/CURSOS/UniversidadeV2/menu.php', NULL, '2024-06-06 18:46:55', 1),
(460, 37, 42, '🤩', NULL, '2024-06-06 18:47:53', 1),
(461, 42, 37, 'já esta reconhecendo que chegou uma menasgem no banco de dados', NULL, '2024-06-06 18:48:06', 1),
(462, 42, 37, 'daqui a pouco vai mostrar', NULL, '2024-06-06 18:48:11', 1),
(463, 42, 37, 'preciso de mais 20 minutos', NULL, '2024-06-06 18:48:21', 1),
(464, 42, 37, '=P ', NULL, '2024-06-06 18:49:09', 1),
(465, 42, 37, '(👉ﾟヮﾟ)👉', NULL, '2024-06-06 18:50:09', 1),
(466, 42, 37, '( ͡° ͜ʖ ͡°)', NULL, '2024-06-06 18:51:09', 1),
(467, 37, 42, 'to de ôio nu sinhoooooo', NULL, '2024-06-06 19:00:35', 1),
(468, 37, 42, '👁️', NULL, '2024-06-06 19:00:35', 1),
(469, 37, 42, '👀', NULL, '2024-06-06 19:00:35', 1),
(470, 37, 42, '👓', NULL, '2024-06-06 19:00:43', 1),
(471, 42, 37, 'Calma', NULL, '2024-06-06 19:00:40', 1),
(472, 42, 37, 'Muita hora nessa Calma', NULL, '2024-06-06 19:00:51', 1),
(474, 21, 42, 'te1234567890', NULL, '2024-06-07 17:59:54', 1),
(475, 42, 37, 'oia só!!!! Arrrrrroooooooooiiiiiiii', NULL, '2024-06-06 20:05:10', 1),
(476, 37, 42, 'manoooooo que da hora', NULL, '2024-06-06 20:05:18', 1),
(477, 42, 37, '', '../IMAGEM/UPLOADS/37-42/Imagem do WhatsApp de 2024-05-08 à(s) 14.52.08_81aca19c.jpg', '2024-06-06 20:06:32', 1),
(478, 21, 42, '⁠Meu nome é Yoshikage Kira. Tenho 33 anos. Minha casa fica na parte nordeste de Morioh, onde todas as casas estão, e eu não sou casado. Eu trabalho como funcionário das lojas de departamentos Kame Yu e chego em casa todos os dias às oito da noite, no máximo. Eu não fumo, mas ocasionalmente bebo. Estou na cama às 23 horas e me certifico de ter oito horas de sono, não importa o que aconteça. Depois de tomar um copo de leite morno e fazer cerca de vinte minutos de alongamentos antes de ir para a cama, geralmente não tenho problemas para dormir até de manhã. Assim como um bebê, eu acordo sem nenhum cansaço ou estresse pela manhã. Foi-me dito que não houve problemas no meu último check-up. Estou tentando explicar que sou uma pessoa que deseja viver uma vida muito tranquila. Eu cuido para não me incomodar com inimigos, como ganhar e perder, isso me faria perder o sono à noite. É assim que eu lido com a sociedade e sei que é isso que me traz felicidade. Embora, se eu fosse lutar, não perderia para ninguém.\r\n\r\n(Kira Yoshikage)', NULL, '2024-06-07 17:59:54', 1),
(480, 37, 42, 'isso é um teste', NULL, '2024-06-07 13:50:59', 1),
(481, 42, 37, 'Opa Bão sô!', NULL, '2024-06-07 13:51:13', 1),
(482, 42, 37, 'teste123456789', NULL, '2024-06-07 13:52:55', 1),
(483, 42, 37, 'teste alpha', NULL, '2024-06-07 19:20:47', 1),
(484, 37, 22, 'oi', NULL, '2024-06-07 14:25:40', 1),
(485, 37, 22, 'oi', NULL, '2024-06-18 14:09:21', 1),
(486, 30, 21, 'Oi', NULL, '2024-06-07 17:31:52', 1),
(487, 30, 21, 'Oi', NULL, '2024-06-07 17:31:52', 1),
(488, 42, 37, 'Pat onde fica as fotos dos eventos????', NULL, '2024-06-07 19:20:47', 1),
(489, 42, 37, 'Qual é o caminho?', NULL, '2024-06-07 19:20:47', 1),
(490, 21, 42, 'ue', NULL, '2024-06-07 17:59:54', 1),
(491, 42, 21, 'Sim', NULL, '2024-06-11 17:22:03', 1),
(492, 42, 21, '(👉ﾟヮﾟ)👉👈(ﾟヮﾟ👈)👈(⌒▽⌒)👉( ͠° ͟ʖ ͡°)( ͡° ͜ʖ ͡°)', NULL, '2024-06-11 17:22:03', 1),
(493, 42, 37, 'Veja as notificações!!!!!! 😎', NULL, '2024-06-07 19:20:47', 1),
(495, 22, 37, 'oi Paty', NULL, '2024-06-18 20:57:35', 1),
(496, 37, 22, 'oi', NULL, '2024-06-18 20:58:05', 1),
(497, 22, 37, 'oi tubo joia?', NULL, '2024-06-18 20:58:14', 1),
(498, 22, 37, 'oi tudo joia?', NULL, '2024-06-18 20:58:24', 1),
(499, 22, 37, 'oi!!!!!!!!!!', NULL, '2024-06-19 14:18:55', 1),
(502, 37, 22, 'oi', NULL, '2024-08-21 21:32:14', 1),
(503, 37, 22, '', NULL, '2024-08-21 21:32:14', 1),
(508, 73, 22, 'oi', NULL, '2024-06-20 20:46:42', 0),
(509, 37, 21, 'oi', NULL, '2024-06-21 11:32:26', 0),
(511, 37, 73, 'oi', NULL, '2024-06-21 11:33:10', 1),
(512, 73, 37, 'oi', NULL, '2024-07-10 18:02:26', 1),
(514, 42, 37, 'Teste, não veja', NULL, '2024-07-10 18:01:17', 1),
(516, 74, 42, 'Olá!', NULL, '2024-08-14 19:42:10', 1),
(519, 42, 74, 'teste', NULL, '2024-08-14 20:31:21', 1),
(520, 42, 74, 'Olá!', NULL, '2024-08-14 20:31:21', 1),
(521, 42, 74, 'oi', NULL, '2024-08-14 20:31:21', 1),
(522, 42, 74, 'oi👍', NULL, '2024-08-14 20:31:21', 1),
(523, 42, 74, 'teste', NULL, '2024-08-14 20:31:21', 1),
(524, 42, 74, 'wreqwrfqwed', NULL, '2024-08-14 20:31:21', 1),
(525, 42, 74, 'wfrfwef', NULL, '2024-08-14 20:31:21', 1),
(526, 42, 74, 'dadsa', NULL, '2024-08-14 20:31:21', 1),
(527, 74, 42, 'oi', NULL, '2024-08-14 20:34:49', 1),
(528, 74, 42, 'fala blz', NULL, '2024-08-14 20:34:49', 1),
(529, 74, 42, 'e agora', NULL, '2024-08-14 20:34:49', 1),
(530, 42, 74, 'teste123', NULL, '2024-08-14 20:35:25', 1),
(531, 42, 74, 'twrew', NULL, '2024-08-15 11:16:58', 1),
(538, 42, 42, 'teste', NULL, '2024-08-15 12:00:34', 1),
(546, 42, 74, '', NULL, '2024-08-20 19:28:38', 1),
(548, 42, 74, '', NULL, '2024-08-20 19:28:38', 1),
(550, 42, 74, '', '../../../COPIZAP/IMAGEM/UPLOADS/42-74/66be010a20b86-images.jpeg', '2024-08-20 19:28:38', 1),
(551, 42, 74, 'tetet', NULL, '2024-08-20 19:28:38', 1),
(554, 42, 74, 'terere', NULL, '2024-08-20 19:28:38', 1),
(555, 42, 74, '', NULL, '2024-08-20 19:28:38', 1),
(556, 42, 74, '', '../../../COPIZAP/IMAGEM/UPLOADS/42-74/66be0703b340c-codigodebarras.jpeg', '2024-08-20 19:28:38', 1),
(558, 42, 74, '', NULL, '2024-08-20 19:28:38', 1),
(559, 42, 74, '', '../../../COPIZAP/IMAGEM/UPLOADS/42-74/66be0c825f29e-CURSOS.txt', '2024-08-20 19:28:38', 1),
(560, 37, 42, 'olaaaaaa', NULL, '2024-08-15 14:19:54', 1),
(561, 37, 42, '😍', NULL, '2024-08-15 14:19:54', 1),
(562, 37, 42, '🏀', NULL, '2024-08-15 14:19:54', 1),
(563, 37, 42, '', '../../../COPIZAP/IMAGEM/UPLOADS/37-42/66be0d2880903-Captura de tela 2024-08-01 140234.png', '2024-08-15 14:19:54', 1),
(564, 37, 22, 'nosssaaaaaaaaaaa', NULL, '2024-08-21 21:32:14', 1),
(565, 37, 21, 'nossaaaaaaaaa', NULL, '2024-08-15 14:15:04', 0),
(566, 37, 30, 'nossaaaaaaaaaa', NULL, '2024-08-15 14:15:13', 0),
(567, 37, 42, 'nossaaaaaaaa', NULL, '2024-08-15 14:19:54', 1),
(568, 37, 73, 'nossaaaaaaaa', NULL, '2024-08-15 14:15:45', 1),
(569, 37, 73, '', '../../../COPIZAP/IMAGEM/UPLOADS/37-73/66be0d85d8f29-Captura de tela 2024-08-12 133445.png', '2024-08-15 14:15:45', 1),
(570, 37, 73, 'hahHHhahahahahahahahahaha', NULL, '2024-08-15 14:16:03', 1),
(571, 37, 73, 'bcsakdjf WJFASDKBsdf', NULL, '2024-08-15 14:16:03', 1),
(572, 37, 73, 'bsdc js dckjasdasjd', NULL, '2024-08-15 14:16:03', 1),
(573, 37, 73, 'sadkc asdjkasjk', NULL, '2024-08-15 14:16:03', 1),
(574, 37, 73, 'mn fasdb asdncbskjdcnsd', NULL, '2024-08-15 14:16:11', 1),
(575, 73, 37, 'HJA', NULL, '2024-08-20 19:54:50', 1),
(576, 37, 42, 'mossaaaaaaa', NULL, '2024-08-15 14:19:54', 1),
(577, 42, 74, 'rerse', NULL, '2024-08-20 19:28:38', 1),
(578, 42, 74, 'gdtgt', NULL, '2024-08-20 19:28:38', 1),
(579, 42, 74, '👍', NULL, '2024-08-20 19:28:38', 1),
(580, 42, 74, '', NULL, '2024-08-20 19:28:38', 1),
(581, 42, 74, '', '../../../COPIZAP/IMAGEM/UPLOADS/42-74/66be140179801-codigodebarras.jpeg', '2024-08-20 19:28:38', 1),
(582, 42, 74, '', NULL, '2024-08-20 19:28:38', 1),
(583, 42, 74, '', '../../../COPIZAP/IMAGEM/UPLOADS/42-74/66be1428e50e1-CURSOS.txt', '2024-08-20 19:28:38', 1),
(584, 42, 74, '', NULL, '2024-08-20 19:28:38', 1),
(585, 42, 74, '', '../IMAGEM/UPLOADS/42-74/66be27e62bfaa-CURSOS.txt', '2024-08-20 19:28:38', 1),
(586, 42, 74, '', NULL, '2024-08-20 19:28:38', 1),
(587, 42, 74, '', NULL, '2024-08-20 19:28:38', 1),
(588, 42, 74, '', '../IMAGEM/UPLOADS/42-74/66bf4ad36fda9-giphy.gif', '2024-08-20 19:28:38', 1),
(589, 42, 74, '', '../IMAGEM/UPLOADS/42-74/66bf4ade23247-linhaspretas.jpg', '2024-08-20 19:28:38', 1),
(590, 42, 74, '', '../../../COPIZAP/IMAGEM/UPLOADS/42-74/66bf4b1b7b24a-giphy.gif', '2024-08-20 19:28:38', 1),
(591, 42, 74, '', NULL, '2024-08-20 19:28:38', 1),
(592, 42, 74, '', NULL, '2024-08-20 19:28:38', 1),
(593, 42, 74, '', NULL, '2024-08-20 19:28:38', 1),
(594, 42, 74, '', NULL, '2024-08-20 19:28:38', 1),
(595, 42, 74, '', NULL, '2024-08-20 19:28:38', 1),
(596, 42, 74, '', NULL, '2024-08-20 19:28:38', 1),
(597, 42, 37, '', '../IMAGEM/UPLOADS/37-42/videodeconfiguracaoobscuridade.mp4', '2024-08-20 19:55:02', 1),
(598, 42, 37, '', '../IMAGEM/UPLOADS/37-42/Lil Nas X - Old Town Road (Epic Version from \'Rambo_ Last Blood\' Trailer) - [BHO Cover].mp3', '2024-08-20 19:55:02', 1),
(599, 42, 42, 'vamos ver o que acontece', NULL, '2024-08-19 14:08:05', 1),
(600, 42, 21, 'Testando uma coisa', NULL, '2024-08-20 14:39:08', 1),
(601, 21, 42, 'teste1', NULL, '2024-08-20 14:39:36', 1),
(602, 21, 42, 'teste', NULL, '2024-08-20 16:05:14', 1),
(603, 21, 42, 'batata', NULL, '2024-08-20 16:05:34', 1),
(604, 42, 21, '', '../../../COPIZAP/IMAGEM/UPLOADS/21-42/66c5e14906ad1-Lil Nas X - Old Town Road (Epic Version from \'Rambo_ Last Blood\' Trailer) - [BHO Cover].mp3', '2024-08-21 12:44:57', 0),
(605, 42, 21, '', '../../../COPIZAP/IMAGEM/UPLOADS/21-42/66c5e15129f8d-videodeconfiguracaoobscuridade.mp4', '2024-08-21 12:45:05', 0),
(606, 42, 21, '', '../../../COPIZAP/IMAGEM/UPLOADS/21-42/66c5e15a52c17-Fujitsufi8190.pdf', '2024-08-21 12:45:14', 0),
(607, 42, 74, '', '../../../COPIZAP/IMAGEM/UPLOADS/42-74/66c64f664f342-atolamentodepapel2.jpg', '2024-08-22 11:31:32', 1),
(608, 22, 37, 'oi', NULL, '2024-08-22 15:16:18', 0),
(609, 22, 37, 'diga', NULL, '2024-08-22 15:16:23', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `modulos`
--

CREATE TABLE `modulos` (
  `id` int(200) NOT NULL,
  `nome` varchar(600) NOT NULL,
  `ordem` int(200) NOT NULL,
  `curso_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `modulos`
--

INSERT INTO `modulos` (`id`, `nome`, `ordem`, `curso_id`) VALUES
(1, 'Módulo 1 do curso 1', 1, 1),
(2, 'Módulo 3 do curso 1', 3, 1),
(3, 'Módulo 2 do curso 1', 2, 1),
(4, 'Módulo 1', 1, 39);

-- --------------------------------------------------------

--
-- Estrutura para tabela `NSite`
--

CREATE TABLE `NSite` (
  `id` int(11) NOT NULL,
  `Nome_Site` varchar(50) NOT NULL,
  `Id_Clt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `NSite`
--

INSERT INTO `NSite` (`id`, `Nome_Site`, `Id_Clt`) VALUES
(1, 'Oliveira', 1),
(2, 'Mafra', 1),
(3, 'Itatiba', 1),
(4, 'Aleris', 2),
(5, 'Itatiba Mall', 6),
(6, 'Resende', 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `opcoesEnquete`
--

CREATE TABLE `opcoesEnquete` (
  `id_OpEnquete` int(11) NOT NULL,
  `id_Questão` int(11) DEFAULT NULL,
  `Opções` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `opcoesEnquete`
--

INSERT INTO `opcoesEnquete` (`id_OpEnquete`, `id_Questão`, `Opções`) VALUES
(1, 1, 'Sexta'),
(2, 1, 'Sábado'),
(3, 1, 'Domingo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pdf_aula`
--

CREATE TABLE `pdf_aula` (
  `pdfid` int(200) NOT NULL,
  `nome` varchar(500) NOT NULL,
  `aula_id` int(200) NOT NULL,
  `modulo_id` int(200) NOT NULL,
  `curso_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pdf_aula`
--

INSERT INTO `pdf_aula` (`pdfid`, `nome`, `aula_id`, `modulo_id`, `curso_id`) VALUES
(1, 'LinguagemC.pdf            ', 1, 1, 1),
(2, 'Batata.pdf', 1, 1, 1),
(3, 'teste4', 1, 2, 1),
(4, 'teste5', 1, 1, 1),
(5, 'teste6', 2, 1, 1),
(6, 'Teste10', 3, 1, 1),
(7, 'testes20', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `postForum`
--

CREATE TABLE `postForum` (
  `id_Post` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `Usuario` varchar(100) DEFAULT NULL,
  `Topico` varchar(150) NOT NULL,
  `data_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `postForum`
--

INSERT INTO `postForum` (`id_Post`, `id_usuario`, `Usuario`, `Topico`, `data_hora`) VALUES
(1, 37, 'Patrícia Canciano', 'teste', '2024-05-23 14:21:59'),
(2, 37, 'Patrícia Canciano', 'Como configurar SMB?', '2024-05-23 15:10:47'),
(3, 37, 'Patrícia Canciano', 'Como configurar digitalização?', '2024-05-23 17:34:06'),
(4, 22, 'Herculano Nascimento', 'Liberação de impressão Retida Samsung, erro na liberação?', '2024-05-27 18:05:15'),
(5, 37, 'Patrícia Canciano', 'TESTE', '2024-05-31 16:10:29');

-- --------------------------------------------------------

--
-- Estrutura para tabela `postRespostaForum`
--

CREATE TABLE `postRespostaForum` (
  `id_Resp` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `Usuario` varchar(150) NOT NULL,
  `id_Post` int(11) NOT NULL,
  `Resposta` varchar(500) NOT NULL,
  `data_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `postRespostaForum`
--

INSERT INTO `postRespostaForum` (`id_Resp`, `id_usuario`, `Usuario`, `id_Post`, `Resposta`, `data_hora`) VALUES
(5, 37, 'Patrícia Canciano', 3, 'Resposta 1', '2024-05-27 20:15:16'),
(6, 37, 'Patrícia Canciano', 3, 'Resposta 2', '2024-05-27 17:18:48'),
(7, 37, 'Patrícia Canciano', 2, 'Resposta', '2024-05-27 17:20:19'),
(8, 37, 'Patrícia Canciano', 3, 'resposta 3', '2024-05-27 17:39:05'),
(9, 37, 'Patrícia Canciano', 1, 'Resposta 1', '2024-05-27 17:44:55'),
(10, 22, 'Herculano Nascimento', 3, '4', '2024-05-27 18:03:30'),
(11, 22, 'Herculano Nascimento', 4, 'Poderia esclarecer melhor o problema?\r\n', '2024-05-27 18:05:41'),
(12, 37, 'Patrícia Canciano', 4, 'não entendi a pergunta', '2024-05-28 10:01:21'),
(13, 21, 'Guilherme Patez', 4, 'Também não sei.', '2024-05-28 14:44:16'),
(14, 37, 'Patrícia Canciano', 5, 'teste', '2024-05-31 16:11:05'),
(15, 37, 'Patrícia Canciano', 5, 'hgvjhgvjhgucf', '2024-05-31 16:11:14');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Preventivas`
--

CREATE TABLE `Preventivas` (
  `id` int(11) NOT NULL,
  `Cliente` varchar(50) NOT NULL,
  `Site` varchar(100) DEFAULT NULL,
  `UltimaPrev` date DEFAULT NULL,
  `ProxPrev` date DEFAULT NULL,
  `Obs` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `progresso_aula`
--

CREATE TABLE `progresso_aula` (
  `id_usuario` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_aula` int(11) NOT NULL,
  `concluida` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `progresso_aula`
--

INSERT INTO `progresso_aula` (`id_usuario`, `id_curso`, `id_aula`, `concluida`) VALUES
(42, 1, 1, 1),
(42, 1, 3, 0),
(42, 39, 7, 1),
(42, 39, 8, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `promocoes`
--

CREATE TABLE `promocoes` (
  `ID_Promocao` int(11) NOT NULL,
  `ID_Colaborador` int(11) NOT NULL,
  `Nome` varchar(150) NOT NULL,
  `DataPromocao` date NOT NULL,
  `NovoCargo` varchar(200) NOT NULL,
  `AntigoCargo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `promocoes`
--

INSERT INTO `promocoes` (`ID_Promocao`, `ID_Colaborador`, `Nome`, `DataPromocao`, `NovoCargo`, `AntigoCargo`) VALUES
(2, 71, 'David Neres', '2023-10-25', 'Auxiliar Técnico', NULL),
(3, 28, 'Júlio Peixoto', '2023-10-23', 'Gerente de Projetos', NULL),
(4, 27, 'Joyce Santos', '2023-10-02', 'Analista de Contratos', 'Auxiliar de Contratos'),
(6, 15, 'Carlos Nascimento', '2023-10-02', 'Auxiliar de Marketing', 'Suporte Técnico'),
(7, 11, 'Angela Kassia', '2024-07-22', 'Auxiliar Financeiro', 'Auxiliar de Estoque');

-- --------------------------------------------------------

--
-- Estrutura para tabela `provafeita`
--

CREATE TABLE `provafeita` (
  `id` int(11) NOT NULL,
  `prova_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `respostas` text NOT NULL,
  `nota` float NOT NULL,
  `acertos` int(11) NOT NULL,
  `total_questoes` int(11) NOT NULL,
  `tentativas` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `provafeita`
--

INSERT INTO `provafeita` (`id`, `prova_id`, `usuario_id`, `respostas`, `nota`, `acertos`, `total_questoes`, `tentativas`) VALUES
(49, 1, 42, '{\"1\":\"C\",\"2\":\"B\",\"3\":\"D\"}', 100, 3, 3, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `provas`
--

CREATE TABLE `provas` (
  `id` int(11) NOT NULL,
  `aula_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `provas`
--

INSERT INTO `provas` (`id`, `aula_id`, `curso_id`, `nome`) VALUES
(1, 6, 1, 'Prova do Módulo 1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `questaoEnquete`
--

CREATE TABLE `questaoEnquete` (
  `id_Enquete` int(11) NOT NULL,
  `Questão` varchar(255) NOT NULL,
  `Criado_Em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `questaoEnquete`
--

INSERT INTO `questaoEnquete` (`id_Enquete`, `Questão`, `Criado_Em`) VALUES
(1, 'Se hoje é quinta-feira, então que dia virá depois de 3 dias, a partir de hoje?', '2024-08-05 12:40:34');

-- --------------------------------------------------------

--
-- Estrutura para tabela `replies`
--

CREATE TABLE `replies` (
  `id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `respostasEnquete`
--

CREATE TABLE `respostasEnquete` (
  `id` int(11) NOT NULL,
  `id_Usuario` int(11) DEFAULT NULL,
  `id_Questão` int(11) DEFAULT NULL,
  `id_Opção` int(11) DEFAULT NULL,
  `Respondido_Em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `respostasEnquete`
--

INSERT INTO `respostasEnquete` (`id`, `id_Usuario`, `id_Questão`, `id_Opção`, `Respondido_Em`) VALUES
(8, 37, 1, 3, '2024-08-05 18:31:44'),
(9, 21, 1, 3, '2024-08-05 18:32:10'),
(10, 30, 1, 3, '2024-08-05 19:12:12'),
(11, 22, 1, 3, '2024-08-05 21:02:09'),
(12, 73, 1, 3, '2024-08-07 16:29:48');

-- --------------------------------------------------------

--
-- Estrutura para tabela `salas`
--

CREATE TABLE `salas` (
  `ID_grupo` int(200) NOT NULL,
  `id_admin_grupo` int(100) NOT NULL,
  `Nome_grupo` varchar(500) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `Categoria` int(200) NOT NULL,
  `Subcategoria` int(11) NOT NULL,
  `chat_bloqueado` tinyint(2) DEFAULT NULL,
  `Data_criacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `salas`
--

INSERT INTO `salas` (`ID_grupo`, `id_admin_grupo`, `Nome_grupo`, `descricao`, `Categoria`, `Subcategoria`, `chat_bloqueado`, `Data_criacao`) VALUES
(7, 42, 'M428', 'reforço fisica e quimica', 4, 1, 1, '2024-06-14 15:38:44'),
(8, 42, 'Matemática aplicada', 'Aulas de reforço sobre matemática aplicada', 4, 2, 0, '2024-06-14 14:42:11'),
(9, 42, 'teste', 'fdsfsd', 4, 4, 1, '2024-06-17 12:59:05'),
(10, 37, 'TESTE', 'TESTE', 4, 1, 0, '2024-06-14 15:52:29');

-- --------------------------------------------------------

--
-- Estrutura para tabela `slaReuniao`
--

CREATE TABLE `slaReuniao` (
  `ID_Reserva` int(11) NOT NULL,
  `Solicitante` varchar(100) NOT NULL,
  `Titulo` varchar(150) NOT NULL,
  `Data_Reserva` date NOT NULL,
  `Hora_Reserva` time NOT NULL,
  `Hora_Fim` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `slaReuniao`
--

INSERT INTO `slaReuniao` (`ID_Reserva`, `Solicitante`, `Titulo`, `Data_Reserva`, `Hora_Reserva`, `Hora_Fim`) VALUES
(54, 'Herculano', 'Apresentação dos Produtos Oracle', '2024-04-27', '08:00:00', '11:00:00'),
(58, 'Patrícia', 'Reunião PrinWayy', '2024-04-25', '14:30:00', '13:30:00'),
(59, 'Patrícia', 'teste', '2024-04-25', '14:30:00', '15:30:00'),
(60, 'Patrícia', 'Patricia', '2024-04-25', '15:30:00', '16:30:00'),
(61, 'Patrícia', 'Reunião PrinWayy', '2024-04-25', '16:30:00', '17:30:00'),
(133, 'Patrícia', 'teste', '2024-05-08', '08:00:00', '08:00:00'),
(135, 'Patrícia', 'Reunião PrinWayy', '2024-05-14', '08:00:00', '08:00:00'),
(136, 'Guilherme', 'Reunião', '2024-05-18', '13:30:00', '14:00:00'),
(139, 'Patrícia', 'teste', '2024-05-18', '08:00:00', '10:00:00'),
(140, 'Patrícia', 'Reunião PrinWayy', '2024-05-18', '11:00:00', '11:30:00'),
(141, 'Herculano', 'Reunião CIA', '2024-05-20', '08:00:00', '08:30:00'),
(142, 'Patrícia', 'tste', '2024-05-21', '08:00:00', '08:00:00'),
(143, 'Patrícia', 'teste', '2024-05-21', '08:30:00', '09:00:00'),
(144, 'Patrícia', 'teste', '2024-05-21', '10:00:00', '12:00:00'),
(145, 'Patrícia', 'teste', '2024-05-22', '08:00:00', '08:00:00'),
(149, 'Patrícia', 'Reunião PrinWayy', '2024-05-26', '08:00:00', '08:00:00'),
(151, 'Júlio', 'Reunião PrinWayy', '2024-05-25', '08:00:00', '08:00:00'),
(153, 'Patrícia', 'mensagem de aviso', '2024-05-28', '08:00:00', '08:00:00'),
(155, 'Guilherme', 'asdasd', '2024-05-30', '08:00:00', '08:00:00'),
(156, 'Patrícia', 'teste', '2024-05-14', '09:30:00', '10:00:00'),
(157, 'Patrícia', 'teste', '2024-05-01', '08:00:00', '08:00:00'),
(165, 'Patrícia', 'teste', '2024-06-06', '08:00:00', '09:30:00'),
(166, 'Patrícia', 'Reunião - Teste', '2024-07-04', '08:00:00', '09:30:00'),
(167, 'Patrícia', 'teste', '2024-08-03', '08:00:00', '08:30:00'),
(168, 'Patrícia', 'teste', '2024-08-05', '08:00:00', '08:30:00'),
(169, 'Herculano', 'Reunião CIA', '2024-08-08', '08:00:00', '09:30:00'),
(170, 'Herculano', 'Alinhamento N3', '2024-08-08', '10:00:00', '12:00:00'),
(171, 'Patrícia', 'teste', '2024-08-07', '08:00:00', '08:00:00'),
(172, 'Herculano', 'Reunião', '2024-08-09', '08:00:00', '08:00:00'),
(173, 'Herculano', 'Reunião CIA', '2024-08-22', '15:30:00', '16:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id` int(11) NOT NULL,
  `Nome` varchar(500) NOT NULL,
  `ID_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `subcategoria`
--

INSERT INTO `subcategoria` (`id`, `Nome`, `ID_categoria`) VALUES
(1, 'Impressora', 4),
(2, 'Noções de Informática', 4),
(3, 'Empresas', 1),
(4, 'Software', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Olha isso', 'todo', 42, '2024-06-12 14:04:42', '2024-06-12 20:42:22'),
(3, 'Caramba!!!!', 'done', 42, '2024-06-12 14:04:50', '2024-07-30 13:13:27'),
(4, 'Feito!', 'done', 42, '2024-06-12 14:05:09', '2024-06-14 12:32:24'),
(8, 'fritas do mac', 'todo', 42, '2024-06-12 19:30:00', '2024-07-29 12:24:43'),
(10, 'isso ficou legal!', 'todo', 37, '2024-06-12 21:06:42', '2024-06-12 21:06:42');

-- --------------------------------------------------------

--
-- Estrutura para tabela `temaDocDownloads`
--

CREATE TABLE `temaDocDownloads` (
  `ID_Tema` int(11) NOT NULL,
  `Tema` varchar(100) NOT NULL,
  `Resumo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `temaDocDownloads`
--

INSERT INTO `temaDocDownloads` (`ID_Tema`, `Tema`, `Resumo`) VALUES
(1, 'Marketing', 'Modelos padrão para elaboração de documentos'),
(2, 'Comercial', 'Modelos padrão para elaboração de documentos'),
(3, 'Contratos', 'Modelos padrão para elaboração de documentos');

-- --------------------------------------------------------

--
-- Estrutura para tabela `temaDocGenteGestao`
--

CREATE TABLE `temaDocGenteGestao` (
  `ID_Tema` int(11) NOT NULL,
  `Tema` varchar(100) NOT NULL,
  `Resumo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `temaDocGenteGestao`
--

INSERT INTO `temaDocGenteGestao` (`ID_Tema`, `Tema`, `Resumo`) VALUES
(1, 'Amil', 'Formulário para movimentação no Cadastro de Beneficiário pessoa Jurídica.'),
(2, 'CARTA DE OPOSIÇÃO', 'Formulário de oposição ao desconto das contribuições ao sindicato.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `Tipo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipo`
--

INSERT INTO `tipo` (`id`, `Tipo`) VALUES
(1, 'Hardware'),
(2, 'Software'),
(3, 'Catálogo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `TipoPreventiva`
--

CREATE TABLE `TipoPreventiva` (
  `id` int(11) NOT NULL,
  `Frequencia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `TipoPreventiva`
--

INSERT INTO `TipoPreventiva` (`id`, `Frequencia`) VALUES
(1, 'Mensal'),
(2, 'Bimestral'),
(3, 'Trimestral');

-- --------------------------------------------------------

--
-- Estrutura para tabela `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `Topico` varchar(50) DEFAULT NULL,
  `Menssagem` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `topics`
--

INSERT INTO `topics` (`id`, `Topico`, `Menssagem`) VALUES
(1, NULL, NULL),
(2, NULL, NULL),
(3, NULL, NULL),
(4, NULL, NULL),
(5, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tremelique`
--

CREATE TABLE `tremelique` (
  `meu_id` int(11) NOT NULL,
  `contato_id` int(11) NOT NULL,
  `validacao` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tremelique`
--

INSERT INTO `tremelique` (`meu_id`, `contato_id`, `validacao`) VALUES
(21, 21, 0),
(21, 30, 0),
(21, 42, 0),
(30, 21, 0),
(30, 30, 0),
(30, 37, 0),
(30, 42, 0),
(37, 21, 1),
(37, 30, 0),
(37, 42, 0),
(37, 73, 0),
(42, 21, 0),
(42, 30, 0),
(42, 37, 0),
(42, 42, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `ID_usuario` int(11) NOT NULL,
  `Abreviacao` varchar(5) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Aniversario` date NOT NULL,
  `Cargo` varchar(200) DEFAULT NULL,
  `Dep` varchar(20) DEFAULT NULL,
  `TS` varchar(4) DEFAULT NULL,
  `Telefone` varchar(50) DEFAULT NULL,
  `WhatsApp` varchar(14) DEFAULT NULL,
  `Ramal` int(4) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `TipoContato` varchar(50) DEFAULT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Senha` varchar(8) NOT NULL,
  `FotoPerfil` varchar(200) DEFAULT NULL,
  `Admissao` varchar(100) DEFAULT NULL,
  `AvisoFerias` varchar(200) DEFAULT NULL,
  `NivelHierarquico` varchar(5) DEFAULT NULL,
  `Responde` varchar(4) DEFAULT NULL,
  `status_online` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`ID_usuario`, `Abreviacao`, `Nome`, `Aniversario`, `Cargo`, `Dep`, `TS`, `Telefone`, `WhatsApp`, `Ramal`, `email`, `TipoContato`, `Usuario`, `Senha`, `FotoPerfil`, `Admissao`, `AvisoFerias`, `NivelHierarquico`, `Responde`, `status_online`) VALUES
(11, 'AK', 'Angela Kassia', '2023-05-29', 'Auxiliar de Estoque', 'Estoque', '', '19 3241-2920', '19 9 7407-2350', 9900, 'recepcao@copimaq.com.br', 'Contato Interno', 'angela.kassia', 'abc@123', 'angela.jpg', '2023-09-18', NULL, 'N6', 'N5E', 0),
(12, 'LB', 'Ana Lívia Brilhante', '2024-01-17', 'Supervisora Administrativo', 'Administrativo', '02', '19 3746-4116', '19 9 7407-2351', 9903, 'administrativo@copimaq.com.br', 'Contato Interno', 'livia.brilhante', 'abc@123', 'livia.png', NULL, NULL, 'N5A', 'N2A', 0),
(13, 'AR', 'Andréia Rodrigues', '2024-09-27', 'Auxiliar Faturamento', 'Faturamento', '21', '19 3746-4105', '19 9 7407-2351', 9905, 'contratos@copimaq.com.br', 'Contato Interno', 'andreia.rodrigues', 'abc@123', 'andreia.jpeg', '2022-08-01', NULL, 'N6', 'N2A', 0),
(14, 'BE', 'Bruno Estefanato', '2024-04-02', 'Gerente Geral', 'Direção', '14', '19 3746-4103', '', 9934, 'bruno@copimaq.com.br', 'Contato Interno', 'bruno.estefanato', 'abc@123', 'bruno.JPG', NULL, NULL, 'N2B', 'N1', 0),
(15, 'CN', 'Carlos Nascimento', '2024-11-21', 'Auxiliar de Marketing', 'Marketing', '23', '19 3741-3084', '', 9917, 'martech@copimaq.com.br', 'Contato Interno', 'carlos.nascimento', 'abc@123', 'carlos.png', NULL, NULL, 'N6', 'N2A', 0),
(16, 'CB', 'Claudio Baptistella', '2024-10-02', 'Diretor', 'Direção', '13', '19 3746-4101', '19 9 7409-3240', 9901, 'copimaq@copimaq.com.br', 'Contato Interno', 'claudio.baptistella', 'abc@123', 'ClaudioBaptistella.png', NULL, NULL, 'N1', 'N1', 0),
(17, 'DE', 'Danilo Egito', '2024-03-03', 'Comprador', 'Compras', '', '19 3746-4114', '19 9 9649-5282', 9931, 'compras2@copimaq.com.br', 'Contato Interno', 'danilo.egito', 'abc@123', 'Danilo.jpg', '2023-09-04', NULL, 'N6', 'N3C', 0),
(18, 'GF', 'Gabriel Ferreira', '2023-05-10', 'Assessor Comercial', 'Comercial', '08', '19 3746-4112', '19 9 8313-5810', 9912, 'corporativo@copimaq.com.br', 'Contato Interno', 'gabriel.ferreira', 'abc@123', 'gabriel.JPG', '2022-10-03', NULL, 'N6', 'N3B', 0),
(19, 'GA', 'Gabriela de Araujo', '2024-08-11', 'Auxiliar Administrativo', 'Contratos', '12', '19 3746-4106', '19 9 7407-2352', 9906, 'contratos1@copimaq.com.br', 'Contato Interno', 'gabriela.araujo', 'abc@123', 'Gabriela.JPG', '2022-07-04', NULL, 'N6', 'N2A', 0),
(21, 'GP', 'Guilherme Patez', '2001-10-01', 'Analista de Suporte', 'TI', '36', '19 3800-3823', '19 9 7135-1686', 9932, 'suporte.ti@copimaq.com.br', 'Contato Interno', 'guilherme.patez', '1234', 'patez.png', '2022-10-03', NULL, 'N6', 'N5B', 0),
(22, 'HN', 'Herculano Nascimento', '2023-05-13', 'Gerente TI', 'TI', '29', '19 3746-4119', '19 9 7135-1683', 9919, 'ti@copimaq.com.br', 'Contato Interno', 'herculano.nascimento', '123', 'herculano.png', '2019-12-23', NULL, 'N3A', 'N2B', 0),
(23, 'HS', 'Humberto Souza', '2024-01-12', 'Vendedor', 'Comercial', '05', '19 3746-4109', '19 9 8313-5568', 9909, 'humberto@copimaq.com.br', 'Contato Interno', 'humberto.souza', 'abc@123', 'humberto.png', NULL, NULL, 'N6', 'N3B', 0),
(24, 'JA', 'Jean Almeida', '2024-01-17', 'Vendedor', 'Comercial', '06', '19 3746-4110', '19 9 8313-5808', 9910, 'jean@copimaq.com.br', 'Contato Interno', 'jean.almeida', 'abc@123', 'jean.png', NULL, NULL, 'N6', 'N3B', 0),
(26, 'JA', 'Joyce Amorim', '2024-08-07', 'Auxiliar Administrativo', 'SAC', '17', '19 3741-3081', '19 9 7407-1101', 9916, 'revenda@copimaq.com.br', 'Contato Interno', 'joyce.amorim', 'abc@123', 'jAmorim.jpg', '2023-02-06', NULL, 'N6', 'N5B', 0),
(27, 'JS', 'Joyce Santos', '0000-00-00', 'Analista de Contratos', 'Contratos', '10', '19 3746-4104', '19 9 7407-2350', 9904, 'contratos@copimaq.com.br', 'Contato Interno', 'joyce.santos', 'abc@123', 'jSimoneti.png', NULL, NULL, 'N6', 'N2A', 0),
(28, 'JP', 'Júlio Peixoto', '2023-04-24', 'Gerente de Projetos', 'Projetos', '01', '19 3746-4121', '19 9 7407-2368', 9921, 'peixoto@copimaq.com.br', 'Contato Interno', 'julio.peixoto', 'abc@123', 'peixoto.jpeg', NULL, NULL, 'N3C', 'N2B', 0),
(29, 'KS', 'Kedna Silva', '2024-06-01', 'Faturista', 'Faturamento', '18', '19 3746-4107', '19 9 7407-2350', 9907, 'atendimento@copimaq.com.br', 'Contato Interno', 'kedna.silva', 'abc@123', 'kedna.png', NULL, NULL, 'N6', 'N2A', 0),
(30, 'LO', 'Leonardo Oliveira', '2023-05-13', 'Supervisor TI', 'TI', '30', '19 3746-4120', '19 9 7135-1684', 9920, 'suporte.solucoes@copimaq.com.br', 'Contato Interno', 'leonardo.oliveira', 'abc@123', 'leonardo.png', NULL, NULL, 'N5B', 'N3A', 0),
(31, 'LT', 'Lucas Teixeira', '0000-00-00', 'Assessor Comercial', 'Licitação', '', '19 3746-4117', '', 9929, 'licitacao@copimaq.com.br', 'Contato Interno', 'lucas.teixeira', 'abc@123', 'lucas.jpg', '2023-07-06', NULL, 'N6', 'N2B', 0),
(33, 'LR', 'Lucilaine Rodrigues', '0000-00-00', 'Compradora', 'Compras', '', '19 3746-4113', '19 9 9649-5281', 9930, 'compras@copimaq.com.br', 'Contato Interno', 'lucilaine.rodrigues', 'abc@123', 'Lucilaine.jpg', '2023-09-04', NULL, 'N6', 'N3C', 0),
(34, 'MC', 'Marcelo Correia', '2024-01-29', 'Coordenador Técnico', 'Sup. Técnica', '25', '', '19 9 7404-8547', 9922, 'apoio@copimaq.com.br', 'Contato Interno', 'marcelo.correa', 'abc@123', 'marceloCorrea.png', NULL, NULL, 'N4', 'N2B', 0),
(35, 'ME', 'Mariana Estefanato', '2024-03-16', 'Gerente Administrativo', 'Administrativo', '03', '19 3746-4102', '19 9 7407-2350', 9902, 'mariana@copimaq.com.br', 'Contato Interno', 'mariana.estefanato', 'abc@123', 'mariana.png', NULL, NULL, 'N2A', 'N1', 0),
(36, 'MS', 'Mauricio Soares', '0000-00-00', 'Estoquista', 'Estoque', '16', '19 3746-4125', '', 9925, 'estoque@copimaq.com.br', 'Contato Interno', 'mauricio.soares', 'abc@123', 'mauricio.jpg', NULL, NULL, 'N6', 'N5E', 0),
(37, 'PC', 'Patrícia Canciano', '2024-08-12', 'Analista de Suporte', 'TI', '04', '19 3741-3086', '19 9 7135-1685', 9928, 'suporte.atendimento@copimaq.com.br', 'Contato Interno', 'patricia.canciano', '1234', 'PatriciaCanciano.jpg', '2022-07-11', NULL, 'N6', 'N5B', 0),
(38, 'PL', 'Paulo Linhares', '2024-06-12', 'Auxiliar Administrativo', 'SAC', '40', '19 3741-3083', '19 9 7407-1100', 9914, 'tecnica@copimaq.com.br', 'Contato Interno', 'paulo.linhares', 'abc@123', 'paulo.png', '2023-03-27', NULL, 'N6', 'N5B', 0),
(39, 'RC', 'Rodrigo Caetano', '0000-00-00', 'Supervisor Técnico', 'Laboratório', '20', '19 3746-4124', '', 9924, 'supervisao.lab@copimaq.com.br', 'Contato Interno', 'rodrigo.caetano', 'abc@123', 'caetano.png', NULL, NULL, 'N5C', 'N2B', 0),
(40, 'AM', 'Rodrigo Silva', '2024-06-13', 'Analista de Marketing', 'Marketing', '', '19 3746-4115', '', 9915, 'marketing@copimaq.com.br', 'Contato Interno', 'rodrigo.silva', 'abc@123', 'rodrigo.png', NULL, NULL, 'N6', 'N2A', 0),
(41, 'RR', 'Ryan Rocha', '2024-03-12', 'Assessor Comercial', 'Comercial', '', '19 3746-4111', '19 9 8313-5809', 9911, 'vendas@copimaq.com.br', 'Contato Interno', 'ryan.rocha', 'abc@123', 'ryan.JPG', '2022-10-03', NULL, 'N6', 'N3B', 0),
(42, 'VS', 'Victor Sofiato', '2001-03-21', 'Suporte Técnico', 'TI', '33', '19 3741-3082', '19 9 9896-9603', 9918, 'suporte@copimaq.com.br', 'Contato Interno', 'victor.sofiato', 'abc@123', 'victor.jpg', '2023-06-05', NULL, 'N6', 'N5B', 0),
(48, 'ED', 'Elton Dias', '0000-00-00', 'Motorista entregador', 'Técnico', '00', '', '19 9 7409-3236', 0, 'elton.luis@copimaq.net', 'Contato Interno', 'elton.dias', 'abc@123', 'Elton.jpg', '', '', 'N6', 'N5D', 0),
(49, 'WB', 'Wellington Boer', '2023-05-02', 'Técnico Pleno', 'Técnico', '00', '', '19 9 7407-2349', 0, 'wellington.boer@copimaq.net', 'Contato Interno', 'wellington.boer', 'abc@123', 'wellington.png', '', '', 'N6', 'N5D', 0),
(50, 'MB', 'Marcelo Braga', '0000-00-00', 'Técnico Sênior', 'Técnico', '00', '', '19 9 7407-1094', 0, 'marcelo.braga@copimaq.net', 'Contato Interno', 'marcelo.braga', 'abc@123', 'marcelobraga.jpg', '', '', 'N6', 'N5D', 0),
(51, 'LC', 'Leandro Campos', '2024-07-22', 'Supervisor Técnico', 'Técnico', '00', '', '19 9 7407-1096', 0, 'leandro.campos@copimaq.net', 'Contato Interno', 'leandro.campos', 'abc@123', 'leandro.png', '', '', 'N5D', 'N4', 0),
(52, 'WM', 'William Martins', '2024-03-30', 'Técnico Pleno', 'Técnico', '00', '', '', 0, 'william.martins@copimaq.net', 'Contato Interno', 'william.martins', 'abc@123', 'williamMartins.jpeg', '2024-01-15', '', 'N6', 'N5D', 0),
(53, 'VS', 'Vanderlei Santos', '0000-00-00', 'Técnico Sênior', 'Técnico', '00', '', '19 9 7409-5837', 0, 'vanderlei.santos@copimaq.net', 'Contato Interno', 'vanderlei.santos', 'abc@123', 'vanderlei.png', '', '', 'N6', 'N5D', 0),
(54, 'WJ', 'William Julião', '0000-00-00', 'Técnico Sênior', 'Técnico', '00', '', '19 9 7407-2369', 0, 'william.juliao@copimaq.net', 'Contato Interno', 'william.juliao', 'abc@123', 'William.jpeg', '', '', 'N6', 'N5D', 0),
(55, 'DG', 'Douglas Gargantini', '2024-07-30', 'Estoquista', 'Estoque', '', '', '', 9924, '', 'Contato Interno', 'douglas.gargantini', 'abc@123', 'Douglas.png', '2024-02-19', '', 'N5E', 'N2B', 0),
(56, 'FB', 'Felipe Brunace', '0000-00-00', 'Técnico Sênior', 'Laboratório', '00', '', '', 9924, '', 'Contato Interno', 'felipe.brunace', 'abc@123', 'brunace.jpg', '2023-02-20', '', 'N6', 'N5C', 0),
(58, 'GB', 'Guilherme Bueno', '2024-02-07', 'Estoquista', 'Estoque', '', '', '', 9924, '', 'Contato Interno', 'guilherme.bueno', 'abc@123', 'guilherme.jpeg', '2023-11-09', '', 'N6', 'N5C', 0),
(59, 'GR', 'Guilherme Rodrigues', '2024-01-26', 'Técnico Trainee', 'Técnico', '00', '', '', 0, '', 'Contato Interno', 'guilherme.rodrigues', 'abc@123', 'guilherme.png', '', '', 'N6', 'N5D', 0),
(60, 'GH', 'Gabriel Henrique', '2024-03-01', 'Auxiliar Técnico', 'Laboratório', '00', '', '', 9924, '', 'Contato Interno', 'gabriel.henrique', 'abc@123', 'GabrielHenrique.jpg', '2023-05-22', '', 'N6', 'N5C', 0),
(61, 'CS', 'Carlos Silvestre', '2024-07-22', 'Auxiliar Técnico', 'Laboratório', '00', '', '', 9924, '', 'Contato Interno', 'carlos.silvestre', 'abc@123', 'cEduardo.jpg', '2023-02-27', '', 'N6', 'N5C', 0),
(62, 'GG', 'Giovana Galvão', '2024-07-11', 'Auxiliar Técnico', 'Laboratório', '00', '', '', 9924, '', 'Contato Interno', 'giovana.galvao', 'abc@123', 'Giovanna.jpg', '2023-09-04', '', 'N6', 'N5C', 0),
(64, 'VS', 'Vilson Silva', '2024-01-21', 'Técnico Pleno', 'Laboratório', '00', '', '', 9924, '', 'Contato Interno', 'vilson.silva', 'abc@123', 'vilson.png', '', '', 'N6', 'N5C', 0),
(65, 'YC', 'Ygor Camargo', '0000-00-00', 'Auxiliar Técnico', 'Laboratório', '00', '', '', 9924, '', 'Contato Interno', 'ygor.camargo', 'abc@123', 'Ygor.png', '2024-02-19', '', 'N6', 'N5C', 0),
(67, 'LA', 'Lohan Evangelista Alves', '2024-02-12', 'Auxiliar Técnico', 'Laboratório', '00', '', '', 9924, '', 'Contato Interno', 'lohan.alves', 'abc@123', 'LohanAlves.jpg', '2024-04-08', '', 'N6', 'N5C', 0),
(68, 'KM', 'Kawane Jesus de Moraes', '2024-06-04', 'Auxiliar E-commerce', 'E-Commerce', '00', '', '', 9915, '', 'Contato Interno', 'kawane.moraes', 'abc@123', 'KawaneMoraes.png', '2024-03-18', '', 'N6', 'N2A', 0),
(69, 'AM', 'Adriano Morales', '0000-00-00', 'Técnico Sênior', 'Técnico', '00', '19 9 7407-1101', '', 0, '', 'Contato Interno', 'adriano.morales', 'abc@123', 'AdrianoMorales.png', '0000-00-00', '', 'N6', 'N5D', 0),
(70, 'AF', 'Alberto Jose Furlan', '2024-08-11', 'Técnico Sênior', 'Laboratório', '00', '', '', 9924, '', 'Contato Interno', 'alberto.furlan', 'abc@123', 'AlbertoFurlan.png', '2024-05-06', '', 'N6', 'N5D', 0),
(71, 'DN', 'David Neres', '2024-08-28', 'Auxiliar Técnico', 'Laboratório', '00', '', '', 0, '', 'Contato Interno', 'david.neres', 'abc@123', 'DavidNeres.jpg', '2023-04-26', '', 'N6', 'N5D', 0),
(73, 'IS', 'Ievillins Sena', '2024-06-27', 'Analista de Suporte Trainee', 'TI', '', '', '', 0, '', 'Contato Interno', 'ievillins.sena', '231417', 'IevillinsSena.png', '2024-06-03', '', 'N6', 'N2B', 0),
(74, 'BP', 'Bruno Patrocinio', '0000-00-00', 'Analista de Suporte Trainee', 'TI', '00', '', '', 0, '', 'Contato Interno', 'bruno.patrocinio', 'abc@123', 'BrunoPatrocinio.png', '2024-06-03', '', 'N6', 'N2B', 0),
(75, 'CR', 'Claudemir Rodrigues', '2024-10-05', 'Técnico Sênior', 'Técnico', '00', '', '19 9 7407-1093', 0, 'claudemir.andre@copimaq.net', 'Contato Interno', 'claudemir.rodrigues', 'abc@123', 'Claudemir.png', '2022-05-02', '', 'N6', 'N5D', 0),
(80, 'MJ', 'Milton Junior', '2024-06-10', 'Auxiliar Técnico', 'Técnico', '00', NULL, ' ', 0, ' ', 'Contato Interno', 'milton.junior', 'abc@123', 'MiltonJunior.png', '2024-06-10', NULL, 'N6', 'N5D', 0),
(82, 'AC', 'Alexandre Câmara', '2024-06-03', 'Auxiliar Licitação', 'Licitação', '00', NULL, ' ', 0, ' ', 'Contato Interno', 'alexandre.camara', 'abc@123', 'AlexandreCamara.png', '2024-06-10', NULL, 'N6', 'N2B', 0),
(83, 'MN', 'Mateus Nascimento', '2024-05-24', 'Auxiliar Técnico', 'Laboratório', '00', NULL, ' ', 0, ' ', 'Contato Interno', 'mateus.nascimento', 'abc@123', 'MateusNascimento.png', '2024-06-10', NULL, 'N6', 'N5C', 0),
(84, 'AB', 'Antônia Baptistella', '2024-06-08', 'Diretora', 'Direção', '00', '', '', 0, 'antonia.baptistella@copimaq.com.br', 'Contato Interno', 'antonia.baptistella', 'abc@123', 'AntoniaBaptistella.png', NULL, NULL, 'N1', 'N1', 0),
(86, 'SS', 'Cristiane Basan', '2024-05-04', 'Auxiliar Administrativo', 'Comercial', '00', '00', '00', 9905, 'contratos1@copimaq.com.br', 'Contato Interno', 'ssilva', 'abc@123', 'CristianeBasan.png', '2024-07-10', NULL, 'N6', 'N2A', 0),
(87, 'SS', 'Shirli Silva', '2024-04-30', 'Auxiliar Administrativo', 'Comercial', '00', '00', '00', 9905, 'contratos1@copimaq.com.br', 'Contato Interno', 'ssilva', 'ABC@123', 'ShirliSilva.png', '2024-06-25', NULL, 'N6', 'N2A', 0),
(88, 'GL', 'Gisele Lacerda', '2024-01-14', 'Auxiliar Administrativo', 'Comercial', '00', '00', '00', 9900, 'recepcao@famema.sp.gov.br', 'Contato Interno', 'glacerda', 'abc@123', 'GiseleLacerda.png.png', '2024-06-25', NULL, 'N6', 'N2A', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vagas`
--

CREATE TABLE `vagas` (
  `ID_Vagas` int(11) NOT NULL,
  `NomeVaga` varchar(50) NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`ID_admin`);

--
-- Índices de tabela `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `anexos`
--
ALTER TABLE `anexos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_curso` (`ID_curso`);

--
-- Índices de tabela `assunto`
--
ALTER TABLE `assunto`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modulo_id` (`modulo_id`);

--
-- Índices de tabela `aulas_favoritas`
--
ALTER TABLE `aulas_favoritas`
  ADD PRIMARY KEY (`id_aula`,`id_cliente`,`id_curso`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Índices de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `boletins`
--
ALTER TABLE `boletins`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `calendarioEmpresa`
--
ALTER TABLE `calendarioEmpresa`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `catalogoProdutos`
--
ALTER TABLE `catalogoProdutos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ClientePrev`
--
ALTER TABLE `ClientePrev`
  ADD PRIMARY KEY (`id`),
  ADD KEY `TipoPrev` (`TipoPrev`);

--
-- Índices de tabela `comunicados`
--
ALTER TABLE `comunicados`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_dono` (`id_user_dono`),
  ADD KEY `id_user_contato` (`id_user_contato`);

--
-- Índices de tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`ID_curso`),
  ADD KEY `Subcategoria` (`Subcategoria`),
  ADD KEY `Categoria` (`Categoria`);

--
-- Índices de tabela `curtidas`
--
ALTER TABLE `curtidas`
  ADD PRIMARY KEY (`id_Curtir`),
  ADD KEY `comunicado_id` (`comunicado_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `downloadDocGestao`
--
ALTER TABLE `downloadDocGestao`
  ADD PRIMARY KEY (`ID_Doc`),
  ADD KEY `Responsavel` (`Responsavel`);

--
-- Índices de tabela `downloadDocs`
--
ALTER TABLE `downloadDocs`
  ADD PRIMARY KEY (`ID_Doc`),
  ADD KEY `Responsavel` (`Responsavel`);

--
-- Índices de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `escolha`
--
ALTER TABLE `escolha`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`ID_evento`);

--
-- Índices de tabela `experiencias`
--
ALTER TABLE `experiencias`
  ADD PRIMARY KEY (`ID_Experiencia`),
  ADD KEY `Colaborador` (`Colaborador`);

--
-- Índices de tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `formacaoAcademica`
--
ALTER TABLE `formacaoAcademica`
  ADD PRIMARY KEY (`ID_Formacao`),
  ADD KEY `Estudante` (`Estudante`);

--
-- Índices de tabela `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`ID_Forum`),
  ADD KEY `forum_ibfk_1` (`ID_usuario`);

--
-- Índices de tabela `galeria`
--
ALTER TABLE `galeria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `inscricao`
--
ALTER TABLE `inscricao`
  ADD PRIMARY KEY (`id_curso`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `inscricao_grupo`
--
ALTER TABLE `inscricao_grupo`
  ADD PRIMARY KEY (`id_cliente`,`id_grupo`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Índices de tabela `lembretes`
--
ALTER TABLE `lembretes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices de tabela `manuaisEquipamentos`
--
ALTER TABLE `manuaisEquipamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Índices de tabela `mensagensgrupo`
--
ALTER TABLE `mensagensgrupo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Índices de tabela `mensagens_zap`
--
ALTER TABLE `mensagens_zap`
  ADD PRIMARY KEY (`id_mensagem`),
  ADD KEY `id_user_envio` (`id_user_envio`),
  ADD KEY `id_user_recebe` (`id_user_recebe`);

--
-- Índices de tabela `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Índices de tabela `NSite`
--
ALTER TABLE `NSite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Id_Clt` (`Id_Clt`);

--
-- Índices de tabela `opcoesEnquete`
--
ALTER TABLE `opcoesEnquete`
  ADD PRIMARY KEY (`id_OpEnquete`),
  ADD KEY `id_Questão` (`id_Questão`);

--
-- Índices de tabela `pdf_aula`
--
ALTER TABLE `pdf_aula`
  ADD PRIMARY KEY (`pdfid`);

--
-- Índices de tabela `postForum`
--
ALTER TABLE `postForum`
  ADD PRIMARY KEY (`id_Post`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `postRespostaForum`
--
ALTER TABLE `postRespostaForum`
  ADD PRIMARY KEY (`id_Resp`);

--
-- Índices de tabela `Preventivas`
--
ALTER TABLE `Preventivas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `progresso_aula`
--
ALTER TABLE `progresso_aula`
  ADD PRIMARY KEY (`id_usuario`,`id_curso`,`id_aula`),
  ADD KEY `id_aula` (`id_aula`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Índices de tabela `promocoes`
--
ALTER TABLE `promocoes`
  ADD PRIMARY KEY (`ID_Promocao`),
  ADD KEY `ID_Colaborador` (`ID_Colaborador`);

--
-- Índices de tabela `provafeita`
--
ALTER TABLE `provafeita`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `provas`
--
ALTER TABLE `provas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aula_id` (`aula_id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Índices de tabela `questaoEnquete`
--
ALTER TABLE `questaoEnquete`
  ADD PRIMARY KEY (`id_Enquete`);

--
-- Índices de tabela `replies`
--
ALTER TABLE `replies`
  ADD KEY `replies_ibfk_1` (`topic_id`);

--
-- Índices de tabela `respostasEnquete`
--
ALTER TABLE `respostasEnquete`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_Questão` (`id_Questão`),
  ADD KEY `id_Opção` (`id_Opção`);

--
-- Índices de tabela `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`ID_grupo`),
  ADD KEY `id_admin_grupo` (`id_admin_grupo`),
  ADD KEY `Categoria` (`Categoria`),
  ADD KEY `Subcategoria` (`Subcategoria`);

--
-- Índices de tabela `slaReuniao`
--
ALTER TABLE `slaReuniao`
  ADD PRIMARY KEY (`ID_Reserva`);

--
-- Índices de tabela `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_catergoria` (`ID_categoria`);

--
-- Índices de tabela `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `temaDocDownloads`
--
ALTER TABLE `temaDocDownloads`
  ADD PRIMARY KEY (`ID_Tema`);

--
-- Índices de tabela `temaDocGenteGestao`
--
ALTER TABLE `temaDocGenteGestao`
  ADD PRIMARY KEY (`ID_Tema`);

--
-- Índices de tabela `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `TipoPreventiva`
--
ALTER TABLE `TipoPreventiva`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tremelique`
--
ALTER TABLE `tremelique`
  ADD UNIQUE KEY `uc_meu_id_contato_id` (`meu_id`,`contato_id`),
  ADD KEY `contato_id` (`contato_id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_usuario`);

--
-- Índices de tabela `vagas`
--
ALTER TABLE `vagas`
  ADD PRIMARY KEY (`ID_Vagas`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `ID_admin` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `anexos`
--
ALTER TABLE `anexos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `assunto`
--
ALTER TABLE `assunto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `boletins`
--
ALTER TABLE `boletins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de tabela `calendarioEmpresa`
--
ALTER TABLE `calendarioEmpresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `catalogoProdutos`
--
ALTER TABLE `catalogoProdutos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `ClientePrev`
--
ALTER TABLE `ClientePrev`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `comunicados`
--
ALTER TABLE `comunicados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `contatos`
--
ALTER TABLE `contatos`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `ID_curso` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `curtidas`
--
ALTER TABLE `curtidas`
  MODIFY `id_Curtir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `downloadDocGestao`
--
ALTER TABLE `downloadDocGestao`
  MODIFY `ID_Doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `downloadDocs`
--
ALTER TABLE `downloadDocs`
  MODIFY `ID_Doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de tabela `escolha`
--
ALTER TABLE `escolha`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `ID_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `experiencias`
--
ALTER TABLE `experiencias`
  MODIFY `ID_Experiencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `formacaoAcademica`
--
ALTER TABLE `formacaoAcademica`
  MODIFY `ID_Formacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `forum`
--
ALTER TABLE `forum`
  MODIFY `ID_Forum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `galeria`
--
ALTER TABLE `galeria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `lembretes`
--
ALTER TABLE `lembretes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `manuaisEquipamentos`
--
ALTER TABLE `manuaisEquipamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `mensagensgrupo`
--
ALTER TABLE `mensagensgrupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de tabela `mensagens_zap`
--
ALTER TABLE `mensagens_zap`
  MODIFY `id_mensagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=610;

--
-- AUTO_INCREMENT de tabela `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `NSite`
--
ALTER TABLE `NSite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `opcoesEnquete`
--
ALTER TABLE `opcoesEnquete`
  MODIFY `id_OpEnquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `pdf_aula`
--
ALTER TABLE `pdf_aula`
  MODIFY `pdfid` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `postForum`
--
ALTER TABLE `postForum`
  MODIFY `id_Post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `postRespostaForum`
--
ALTER TABLE `postRespostaForum`
  MODIFY `id_Resp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `Preventivas`
--
ALTER TABLE `Preventivas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `promocoes`
--
ALTER TABLE `promocoes`
  MODIFY `ID_Promocao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `provafeita`
--
ALTER TABLE `provafeita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de tabela `provas`
--
ALTER TABLE `provas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `questaoEnquete`
--
ALTER TABLE `questaoEnquete`
  MODIFY `id_Enquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `respostasEnquete`
--
ALTER TABLE `respostasEnquete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `salas`
--
ALTER TABLE `salas`
  MODIFY `ID_grupo` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `slaReuniao`
--
ALTER TABLE `slaReuniao`
  MODIFY `ID_Reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT de tabela `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `temaDocDownloads`
--
ALTER TABLE `temaDocDownloads`
  MODIFY `ID_Tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `temaDocGenteGestao`
--
ALTER TABLE `temaDocGenteGestao`
  MODIFY `ID_Tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `TipoPreventiva`
--
ALTER TABLE `TipoPreventiva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de tabela `vagas`
--
ALTER TABLE `vagas`
  MODIFY `ID_Vagas` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `anexos`
--
ALTER TABLE `anexos`
  ADD CONSTRAINT `anexos_ibfk_1` FOREIGN KEY (`ID_curso`) REFERENCES `curso` (`ID_curso`);

--
-- Restrições para tabelas `aulas`
--
ALTER TABLE `aulas`
  ADD CONSTRAINT `aulas_ibfk_1` FOREIGN KEY (`modulo_id`) REFERENCES `modulos` (`id`);

--
-- Restrições para tabelas `aulas_favoritas`
--
ALTER TABLE `aulas_favoritas`
  ADD CONSTRAINT `aulas_favoritas_ibfk_1` FOREIGN KEY (`id_aula`) REFERENCES `aulas` (`id`),
  ADD CONSTRAINT `aulas_favoritas_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`ID_usuario`),
  ADD CONSTRAINT `aulas_favoritas_ibfk_3` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`ID_curso`);

--
-- Restrições para tabelas `ClientePrev`
--
ALTER TABLE `ClientePrev`
  ADD CONSTRAINT `ClientePrev_ibfk_1` FOREIGN KEY (`TipoPrev`) REFERENCES `TipoPreventiva` (`id`);

--
-- Restrições para tabelas `contatos`
--
ALTER TABLE `contatos`
  ADD CONSTRAINT `contatos_ibfk_1` FOREIGN KEY (`id_user_dono`) REFERENCES `usuario` (`ID_usuario`),
  ADD CONSTRAINT `contatos_ibfk_2` FOREIGN KEY (`id_user_contato`) REFERENCES `usuario` (`ID_usuario`);

--
-- Restrições para tabelas `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`Subcategoria`) REFERENCES `subcategoria` (`id`),
  ADD CONSTRAINT `curso_ibfk_2` FOREIGN KEY (`Categoria`) REFERENCES `categoria` (`id`);

--
-- Restrições para tabelas `curtidas`
--
ALTER TABLE `curtidas`
  ADD CONSTRAINT `curtidas_ibfk_1` FOREIGN KEY (`comunicado_id`) REFERENCES `eventos` (`ID_evento`),
  ADD CONSTRAINT `curtidas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`ID_usuario`);

--
-- Restrições para tabelas `downloadDocGestao`
--
ALTER TABLE `downloadDocGestao`
  ADD CONSTRAINT `downloadDocGestao_ibfk_1` FOREIGN KEY (`Responsavel`) REFERENCES `usuario` (`ID_usuario`);

--
-- Restrições para tabelas `downloadDocs`
--
ALTER TABLE `downloadDocs`
  ADD CONSTRAINT `downloadDocs_ibfk_1` FOREIGN KEY (`Responsavel`) REFERENCES `usuario` (`ID_usuario`);

--
-- Restrições para tabelas `experiencias`
--
ALTER TABLE `experiencias`
  ADD CONSTRAINT `experiencias_ibfk_1` FOREIGN KEY (`Colaborador`) REFERENCES `usuario` (`ID_usuario`);

--
-- Restrições para tabelas `formacaoAcademica`
--
ALTER TABLE `formacaoAcademica`
  ADD CONSTRAINT `formacaoAcademica_ibfk_1` FOREIGN KEY (`Estudante`) REFERENCES `usuario` (`ID_usuario`);

--
-- Restrições para tabelas `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`);

--
-- Restrições para tabelas `inscricao`
--
ALTER TABLE `inscricao`
  ADD CONSTRAINT `inscricao_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`ID_curso`),
  ADD CONSTRAINT `inscricao_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`ID_usuario`);

--
-- Restrições para tabelas `inscricao_grupo`
--
ALTER TABLE `inscricao_grupo`
  ADD CONSTRAINT `inscricao_grupo_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`ID_usuario`),
  ADD CONSTRAINT `inscricao_grupo_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `salas` (`ID_grupo`);

--
-- Restrições para tabelas `lembretes`
--
ALTER TABLE `lembretes`
  ADD CONSTRAINT `lembretes_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`ID_usuario`);

--
-- Restrições para tabelas `mensagens`
--
ALTER TABLE `mensagens`
  ADD CONSTRAINT `mensagens_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`ID_usuario`),
  ADD CONSTRAINT `mensagens_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `administrador` (`ID_admin`);

--
-- Restrições para tabelas `mensagensgrupo`
--
ALTER TABLE `mensagensgrupo`
  ADD CONSTRAINT `mensagensgrupo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`ID_usuario`),
  ADD CONSTRAINT `mensagensgrupo_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `salas` (`ID_grupo`);

--
-- Restrições para tabelas `mensagens_zap`
--
ALTER TABLE `mensagens_zap`
  ADD CONSTRAINT `mensagens_zap_ibfk_1` FOREIGN KEY (`id_user_envio`) REFERENCES `usuario` (`ID_usuario`),
  ADD CONSTRAINT `mensagens_zap_ibfk_2` FOREIGN KEY (`id_user_recebe`) REFERENCES `usuario` (`ID_usuario`);

--
-- Restrições para tabelas `modulos`
--
ALTER TABLE `modulos`
  ADD CONSTRAINT `modulos_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`ID_curso`);

--
-- Restrições para tabelas `NSite`
--
ALTER TABLE `NSite`
  ADD CONSTRAINT `NSite_ibfk_1` FOREIGN KEY (`Id_Clt`) REFERENCES `ClientePrev` (`id`);

--
-- Restrições para tabelas `opcoesEnquete`
--
ALTER TABLE `opcoesEnquete`
  ADD CONSTRAINT `opcoesEnquete_ibfk_1` FOREIGN KEY (`id_Questão`) REFERENCES `questaoEnquete` (`id_Enquete`);

--
-- Restrições para tabelas `postForum`
--
ALTER TABLE `postForum`
  ADD CONSTRAINT `postForum_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`ID_usuario`);

--
-- Restrições para tabelas `progresso_aula`
--
ALTER TABLE `progresso_aula`
  ADD CONSTRAINT `progresso_aula_ibfk_1` FOREIGN KEY (`id_aula`) REFERENCES `aulas` (`id`),
  ADD CONSTRAINT `progresso_aula_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`ID_curso`),
  ADD CONSTRAINT `progresso_aula_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`ID_usuario`);

--
-- Restrições para tabelas `promocoes`
--
ALTER TABLE `promocoes`
  ADD CONSTRAINT `promocoes_ibfk_1` FOREIGN KEY (`ID_Colaborador`) REFERENCES `usuario` (`ID_usuario`);

--
-- Restrições para tabelas `provas`
--
ALTER TABLE `provas`
  ADD CONSTRAINT `provas_ibfk_1` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`id`),
  ADD CONSTRAINT `provas_ibfk_2` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`ID_curso`);

--
-- Restrições para tabelas `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`);

--
-- Restrições para tabelas `respostasEnquete`
--
ALTER TABLE `respostasEnquete`
  ADD CONSTRAINT `respostasEnquete_ibfk_1` FOREIGN KEY (`id_Questão`) REFERENCES `questaoEnquete` (`id_Enquete`),
  ADD CONSTRAINT `respostasEnquete_ibfk_2` FOREIGN KEY (`id_Opção`) REFERENCES `opcoesEnquete` (`id_OpEnquete`);

--
-- Restrições para tabelas `salas`
--
ALTER TABLE `salas`
  ADD CONSTRAINT `salas_ibfk_1` FOREIGN KEY (`id_admin_grupo`) REFERENCES `usuario` (`ID_usuario`),
  ADD CONSTRAINT `salas_ibfk_2` FOREIGN KEY (`Categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `salas_ibfk_3` FOREIGN KEY (`Subcategoria`) REFERENCES `subcategoria` (`id`);

--
-- Restrições para tabelas `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `subcategoria_ibfk_1` FOREIGN KEY (`ID_categoria`) REFERENCES `categoria` (`id`);

--
-- Restrições para tabelas `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`ID_usuario`);

--
-- Restrições para tabelas `tremelique`
--
ALTER TABLE `tremelique`
  ADD CONSTRAINT `tremelique_ibfk_1` FOREIGN KEY (`contato_id`) REFERENCES `usuario` (`ID_usuario`),
  ADD CONSTRAINT `tremelique_ibfk_2` FOREIGN KEY (`meu_id`) REFERENCES `usuario` (`ID_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
