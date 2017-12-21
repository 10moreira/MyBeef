CREATE TABLE IF NOT EXISTS `propriedade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('Real','Virtual') NOT NULL,
  `data` datetime NOT NULL,
  `nome` varchar(60) DEFAULT NULL,
  `nro_caambiental` varchar(60) DEFAULT NULL,
  `localidade` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58;


CREATE TABLE IF NOT EXISTS `categoria_animal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58;


CREATE TABLE IF NOT EXISTS `rebanho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ano` int(4) NOT NULL,
  `propriedade_id` int(11) NOT NULL,
  `categoria_animal_id` int(4) NOT NULL,
  `qtd_estocada` int(5),
  `peso_estocado` int(5),
  `qtd_vendida` int(5),
  `peso_vendido` int(5),
  PRIMARY KEY (`id`),
  KEY `fk_rebanho_propriedade1_idx` (`propriedade_id`),
  KEY `fk_categoria_animal1_idx` (`categoria_animal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58;


CREATE TABLE IF NOT EXISTS `indicador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `unidade` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58;



CREATE TABLE IF NOT EXISTS `medida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` float(8,2) NOT NULL,
  `ano` int(4) NOT NULL,
  `propriedade_id` int(11) NOT NULL,
  `indicador_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_medida_propriedade1_idx` (`propriedade_id`),
  KEY `fk_medida_indicador1_idx` (`indicador_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58;

