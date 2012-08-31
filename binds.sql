-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 31-08-2012 a las 12:24:35
-- Versión del servidor: 5.1.63
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `business_binds`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE IF NOT EXISTS `articulo` (
  `id_articulo` int(10) NOT NULL AUTO_INCREMENT,
  `texto_articulo` text COLLATE utf8_spanish_ci,
  `post_idpost` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_articulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`id_articulo`, `texto_articulo`, `post_idpost`) VALUES
(1, '<p style="text-align: center;"><strong><span style="font-size: xx-large; color: #000000;">Efectividad del tratamiento de fisioterapia en</span></strong></p>\n<p style="text-align: center;"><br /><strong><span style="font-size: xx-large; color: #000000;">la paralisis facial periferica. Revision sistematica</span></strong></p>\n<p><span style="font-size: xx-large; color: #000000;"><br /></span></p>\n<p><span style="font-size: xx-large; color: #000000;"><br /></span></p>\n<p><span style="font-size: xx-large; color: #000000;"><img style="display: block; margin-left: auto; margin-right: auto;" src="userpic/b49ea7f9646bc351116e16cec4dcc8fc.jpg" alt="" width="388" height="316" /></span></p>\n<p><span style="font-size: xx-large; color: #000000;"><br /></span></p>\n<p style="text-align: justify;"><span style="font-size: small; color: #000000;">Las posibles secuelas de la enfermedad y los trastornos&nbsp; psicol&oacute;gicos asociados han fomentado la realizaci&oacute;n de investigaciones&nbsp; que permitan proponer diversas alternativas de tratamiento, como pueden ser las intervenciones fisioterap&eacute;uticas. Desde el a&ntilde;o 1927 se describe la fisioterapia como una parte del tratamiento de la PFB. De las primeras intervenciones utilizadas&nbsp; est&aacute;n los protocolos de ejercicios faciales [11]. En 1994, Beurskens et al [12] publicaron una revisi&oacute;n en la que se describen una serie de tratamientos fisioterap&eacute;uticos aplicados a la par&aacute;lisis facial que siguen utiliz&aacute;ndose hoy en d&iacute;a. No obstante, y dado que en la actualidad los tratamientos se&nbsp; apoyan en la medicina basada en la evidencia, es preciso revisar&nbsp; todos los ensayos cl&iacute;nicos aleatorizados controlados (ECAC) referentes a esta tem&aacute;tica para poder realizar protocolos adecuados</span></p>\n<p>&nbsp;</p>', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `id_comment` int(10) NOT NULL AUTO_INCREMENT,
  `comment` text COLLATE utf8_spanish_ci,
  `post_idpost` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_comment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido_lista`
--

CREATE TABLE IF NOT EXISTS `contenido_lista` (
  `id_contenido_lista` int(10) NOT NULL AUTO_INCREMENT,
  `id_lista` int(10) NOT NULL,
  `id_post` int(10) NOT NULL,
  PRIMARY KEY (`id_contenido_lista`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `contenido_lista`
--

INSERT INTO `contenido_lista` (`id_contenido_lista`, `id_lista`, `id_post`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 7),
(4, 4, 8),
(5, 5, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_topic`
--

CREATE TABLE IF NOT EXISTS `data_topic` (
  `id_data_topic` int(10) NOT NULL AUTO_INCREMENT,
  `idTopico` int(11) NOT NULL,
  `nombre_topico` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_id_user` int(10) NOT NULL,
  PRIMARY KEY (`id_data_topic`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `data_topic`
--

INSERT INTO `data_topic` (`id_data_topic`, `idTopico`, `nombre_topico`, `user_id_user`) VALUES
(1, 1, 'Cine', 0),
(2, 2, 'Exteriores', 0),
(3, 3, 'Fotografia', 0),
(4, 4, 'Arte', 0),
(5, 5, 'Literatura', 0),
(6, 6, 'Musica', 0),
(7, 7, 'Viajes &amp; Lugares', 0),
(8, 8, 'Ciencias de la Computacion', 0),
(9, 9, 'Ciencias de la Salud', 0),
(10, 10, 'Moda Mujeres', 0),
(11, 11, 'Fisioterapia', 1),
(12, 12, 'Metal', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_user`
--

CREATE TABLE IF NOT EXISTS `data_user` (
  `id_data_user` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(1024) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_data_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `data_user`
--

INSERT INTO `data_user` (`id_data_user`, `name`, `lastname`, `email`, `password`) VALUES
(1, '', '', 'elemail', '73a00e10b9223edc807c3a96cc6a2077'),
(2, '', '', 'l', '73a00e10b9223edc807c3a96cc6a2077'),
(3, '', '', '', '827ccb0eea8a706c4c34a16891f84e7b'),
(4, '', '', 'as', '827ccb0eea8a706c4c34a16891f84e7b'),
(5, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e'),
(6, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destacado`
--

CREATE TABLE IF NOT EXISTS `destacado` (
  `idDestacados` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `fecha` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `post_idpost` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDestacados`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `destacado`
--

INSERT INTO `destacado` (`idDestacados`, `idUser`, `fecha`, `post_idpost`) VALUES
(1, 1, '1339653047', 2),
(2, 2, '1339655591', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista`
--

CREATE TABLE IF NOT EXISTS `lista` (
  `id_Lista` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) DEFAULT NULL,
  `nombre_lista` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_Lista`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `lista`
--

INSERT INTO `lista` (`id_Lista`, `id_user`, `nombre_lista`) VALUES
(1, 1, 'demo'),
(2, 1, 'Paisajes Perfectos'),
(3, 13, 'Concerts'),
(4, 15, 'iphones'),
(5, 15, 'concerts');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `node_topic`
--

CREATE TABLE IF NOT EXISTS `node_topic` (
  `idnode_topic` int(10) NOT NULL AUTO_INCREMENT,
  `Topico_idTopico` int(10) NOT NULL,
  `id_topico_parent` int(10) DEFAULT NULL,
  PRIMARY KEY (`idnode_topic`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `node_topic`
--

INSERT INTO `node_topic` (`idnode_topic`, `Topico_idTopico`, `id_topico_parent`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 3, 0),
(4, 4, 0),
(5, 5, 0),
(6, 6, 0),
(7, 7, 0),
(8, 8, 0),
(9, 9, 0),
(10, 10, 0),
(11, 11, 9),
(12, 12, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id_Photo` int(10) NOT NULL AUTO_INCREMENT,
  `image_photo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `post_idpost` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_Photo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `photo`
--

INSERT INTO `photo` (`id_Photo`, `image_photo`, `descripcion`, `post_idpost`) VALUES
(1, '4d11492dec1eb189dac2181f045fd5bc.jpg', '<p  >All</p>', 1),
(2, '1d064c2f9a314379c8f6bbfe1f9c549f.jpg', '<p>Encontrando un increible y  paisaje.</p>', 2),
(3, 'c55d003c781306e6f62da48b502d0ee5.jpg', '<p>Chamaleon</p>', 4),
(4, 'de6d6e04d87c1a1d21e97ee465cce6b6.jpg', '<p>Cocina sorprendente</p>', 5),
(5, '5f593d2a3e00d63365c6a55bc2e0b29d.jpg', '<p>concert</p>', 7),
(6, '3a970cb83045cecd7a06b0ef77001485.png', '<p>Iphone</p>', 8),
(7, '4684d1a90d9a9c0da3e05438cfe6afca.jpg', '<p>jsdkjhsadk</p>', 9),
(8, '74b6de2620cd40699ea2a4dd5c89d396.jpg', '<p>Travel</p>', 10),
(9, '368a9c0b50cee1c0ba3fe2b75c07b625.jpg', '<p>j,dna,sdkjasdlksajdlkasd</p>', 13),
(10, 'ae870c2c9a657a86530f6e068798f787.jpg', '<p>Barco</p>', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `idpost` int(10) NOT NULL AUTO_INCREMENT,
  `type_post` int(2) DEFAULT NULL,
  `fecha` int(10) DEFAULT NULL,
  PRIMARY KEY (`idpost`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`idpost`, `type_post`, `fecha`) VALUES
(1, 5, 1339613661),
(2, 5, 1339649189),
(3, 2, 1339655574),
(4, 5, 1339661010),
(5, 5, 1339661966),
(6, 4, 1339662037),
(7, 5, 1339771329),
(8, 5, 1340150925),
(9, 5, 1341532909),
(10, 5, 1342585974),
(11, 4, 1342587225),
(12, 4, 1342590090),
(13, 5, 1344983802),
(14, 5, 1346297249);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE IF NOT EXISTS `pregunta` (
  `id_preguntas` int(10) NOT NULL AUTO_INCREMENT,
  `contenido` text COLLATE utf8_spanish_ci,
  `titulo` varchar(70) COLLATE utf8_spanish_ci DEFAULT NULL,
  `post_idpost` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_preguntas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relationship`
--

CREATE TABLE IF NOT EXISTS `relationship` (
  `idRelationship` int(10) NOT NULL AUTO_INCREMENT,
  `id_user_topic` int(10) DEFAULT NULL,
  `type_user` int(10) DEFAULT NULL,
  PRIMARY KEY (`idRelationship`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `relationship`
--

INSERT INTO `relationship` (`idRelationship`, `id_user_topic`, `type_user`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 3, 2),
(5, 4, 2),
(6, 5, 2),
(7, 6, 2),
(8, 7, 2),
(9, 8, 2),
(10, 9, 2),
(11, 10, 2),
(12, 11, 2),
(13, 2, 1),
(14, 3, 1),
(15, 4, 1),
(16, 12, 2),
(17, 5, 1),
(18, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE IF NOT EXISTS `respuesta` (
  `id_comment_reply` int(10) NOT NULL AUTO_INCREMENT,
  `comment` text COLLATE utf8_spanish_ci,
  `fecha` int(10) DEFAULT NULL,
  `user_set` int(10) DEFAULT NULL,
  `parent_comment` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_comment_reply`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`id_comment_reply`, `comment`, `fecha`, `user_set`, `parent_comment`) VALUES
(1, 'jksadhkjashdkjashdk', 1341532926, 3, 6),
(2, 'fsdaadsf', 1342130016, 3, 6),
(3, 'torax', 1343775940, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shared_info`
--

CREATE TABLE IF NOT EXISTS `shared_info` (
  `idshared_info` int(10) NOT NULL AUTO_INCREMENT,
  `relationship_storyboard` int(10) DEFAULT NULL,
  `post_idpost` int(10) DEFAULT NULL,
  `Relationship_idRelationship` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idshared_info`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `shared_info`
--

INSERT INTO `shared_info` (`idshared_info`, `relationship_storyboard`, `post_idpost`, `Relationship_idRelationship`) VALUES
(1, 1, 1, 1),
(2, 3, 2, 1),
(3, 12, 3, 13),
(4, 14, 4, 14),
(5, 14, 5, 14),
(6, 14, 6, 14),
(7, 13, 7, 2),
(8, 1, 8, 1),
(9, 14, 9, 3),
(10, 14, 10, 3),
(11, 14, 11, 3),
(12, 14, 12, 3),
(13, 14, 13, 3),
(14, 14, 14, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subscribe`
--

CREATE TABLE IF NOT EXISTS `subscribe` (
  `idsubscribe` int(10) NOT NULL AUTO_INCREMENT,
  `subscribers` int(10) DEFAULT NULL,
  `subscriber` int(10) NOT NULL,
  `fecha` int(11) NOT NULL,
  PRIMARY KEY (`idsubscribe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `subscribe`
--

INSERT INTO `subscribe` (`idsubscribe`, `subscribers`, `subscriber`, `fecha`) VALUES
(1, 13, 1, 1339649094),
(2, 4, 1, 1339650781),
(3, 12, 1, 1339652248),
(4, 2, 14, 1339660593),
(5, 3, 14, 1339660600),
(7, 6, 14, 1339660618),
(8, 7, 14, 1339660624),
(9, 8, 14, 1339660629),
(11, 15, 14, 1339660765),
(12, 14, 13, 1339771607),
(13, 3, 1, 1339772068),
(14, 14, 1, 1339772247),
(15, 1, 15, 1343775837),
(16, 13, 15, 1343775844);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topico`
--

CREATE TABLE IF NOT EXISTS `topico` (
  `idTopico` int(10) NOT NULL AUTO_INCREMENT,
  `visitas` int(10) DEFAULT NULL,
  `quote` varchar(400) COLLATE utf8_spanish_ci DEFAULT NULL,
  `current_image` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `mayor` int(10) DEFAULT NULL,
  PRIMARY KEY (`idTopico`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `topico`
--

INSERT INTO `topico` (`idTopico`, `visitas`, `quote`, `current_image`, `mayor`) VALUES
(1, 1, 'No disponible " Categoria "', 'binds_default.png', NULL),
(2, 2, 'No disponible " Categoria "', 'binds_default.png', NULL),
(3, 0, '0', 'binds_default.png', 0),
(4, 0, '0', 'binds_default.png', 0),
(5, 0, '0', 'binds_default.png', 0),
(6, 0, '0', 'binds_default.png', 0),
(7, 0, '0', 'binds_default.png', 0),
(8, 0, '0', 'binds_default.png', 0),
(9, 0, '0', 'binds_default.png', 0),
(10, 0, '0', 'binds_default.png', 0),
(11, 0, 'La fisioterapia ha sido una ciencia que ultimamente se ha visto envuelta en ..', 'binds_default.png', 0),
(12, 0, 'The music Metal has been tra..', 'binds_default.png', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `current_image_user` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `quote` varchar(400) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idData_user` int(11) NOT NULL,
  `bg` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `user_name`, `current_image_user`, `url`, `quote`, `idData_user`, `bg`) VALUES
(1, 'demo', '360b6ab255bf31fddaaf91231ee90cc8.jpg', 'omarhernandez', 'Mi nombre es Omar Hernandez , Est , Ing. Ciencias de la Computacion', 1, '0a38591586da4d4645928d9d0e9633d2.jpg'),
(2, 'As Blood Runs Black', '43d34ae9140c12534311f4a44e638bee.jpg', 'abrb', 'Esta es la informacion que los demas veran sobre ti. Al llenarla correctamente le permites a mas gente encontrarte', 2, '0920012aebd80d004957835845b89527.jpg'),
(3, 'daniel', 'binds_default.png', 'monky', 'Estudiante de computacion', 3, 'ec2f78936961d586e41e674dda0e8da9.jpg'),
(4, 'marile', 'binds_default.png', '', '', 4, 'main.gif'),
(5, '', 'binds_default.png', '', '', 5, 'main.gif'),
(6, '', 'binds_default.png', '', '', 6, 'main.gif');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id_video` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url_video` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `post_idpost` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_video`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `video`
--

INSERT INTO `video` (`id_video`, `descripcion`, `url_video`, `post_idpost`) VALUES
(1, '<iframe class="video" src="http://player.vimeo.com/video/43325734" width="465" height="262"frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>', '<p>sueÃ±o dentro de un sueÃ±o</p>', 6),
(2, '<iframe width="465" height="262" src="http://www.youtube.com/embed/0b-zoPa0UO4?wmode=transparent"frameborder="0" allowfullscreen></iframe>', '<p>Spiderman</p>', 11),
(3, '<iframe width="465" height="262" src="http://www.youtube.com/embed/fnXv_FZ1HDU?wmode=transparent"frameborder="0" allowfullscreen></iframe>', '<p>video</p>', 12);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
