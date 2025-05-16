-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-05-2025 a las 04:42:10
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `producto` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `producto`, `categoria`, `descripcion`, `precio`, `cantidad`, `imagen`) VALUES
(5, 'Mochila Ataud Gotica Aterciopelada', 'mochila', 'MOCHILA ATAUD GOTICA, MATERIAL TELA TIPO TERCIOPELO Y ESTOPEROLES, 1 CIERRE Y 2 BOLSAS LATERALES DE MALLA, MEDIDAS 45CMS DE ALTURA, 30 CMS ANCHO, 15CMS PROFUNDIDAD', 502.55, 2, 'https://i.postimg.cc/zB5KkjmJ/moc1.png'),
(6, 'Mochila Ataud Pentagrama', 'mochila', 'MOCHILA ATAUD PENTAGRAMA GOTICA, MATERIAL PIEL SINTETICA, LONA Y ESTOPEROLES, 1 CIERRE Y 2 BOLSAS LATERALES DE MALLA, MEDIDAS 45CMS DE ALTURA, 30 CMS ANCHO, 15CMS LARGO', 521.55, 10, 'https://i.postimg.cc/mgvQP481/moc2.png'),
(7, 'Playera Camiseta Banda Rock Metallica Don\'t Tread On Me', 'camisa', 'Nuestras Playeras Son 100% Algodon y Nuestras Sudaderas termicas Son 50/Algodon y 50/Poliester', 269.00, 15, 'https://i.postimg.cc/ZYpXnYHp/cam7.png'),
(8, 'Mochila gótica con diseño de calavera', 'mochila', 'Mochila gótica multifuncional: mochila de calavera con esqueleto no solo es una mochila casual, sino que también es adecuada para viajes, fiestas de Halloween, cosplay, ciclismo y compras', 1.00, 5, 'https://i.postimg.cc/MG0jXQng/moc3.png'),
(9, 'Mochila de ataúd de vampiro de Fancybag con alas de murciélago desmontables, estilo punk', 'mochila', 'Material: esta mochila con forma de ataúd está hecha de piel sintética y gran PVC. Muy fácil de limpiar, ya que es impermeable, puedes limpiarla con un paño húmedo y se verá como nueva de nuevo. La correa de piel es fresca y cómoda', 1.00, 2, 'https://i.postimg.cc/MHHcs398/moc4.png'),
(10, 'Star Mochila Y2K para la escuela, estilo gótico elegante, mochila vaquera', 'mochila', 'Material duradero: hecho de material de mezclilla de alta calidad, suave y cómodo, resistente y duradero. La bolsa de mezclilla está diseñada con patrón de estrella, encantador estilo estampado ombré y estilo bordado de estrella. Correa de hombro ajustabl', 509.99, 10, 'https://i.postimg.cc/vHp1zz9p/moc5.png'),
(11, 'Mini bolso de murciélago gótico', 'mochila', 'Estilo gótico: diseño de estilo único, hecho de material de piel artificial texturizado, forro de poliéster de alta calidad, con metal de alta calidad. Es una bonita mochila pequeña.', 521.55, 15, 'https://i.postimg.cc/Y9bGzBf3/moc6.png'),
(12, 'NIRVANA in Utero Playera Camiseta para Unisex Adulto', 'camisas', 'Corte de playera: Caballero, Playera de algodón, Corte de Vinil de Alta Calidad, No se despinta, Tallas Disponibles: Chica, Mediana, Grande, XL, XXL, XXL, Tipo de manga: Manga corta', 584.00, 13, 'https://i.postimg.cc/zfQ4bV4S/cam8.png'),
(13, 'Playera Para Hombre | Bandas de Rock - Nirvana Grunge | Perfecta para Regalo, Tallas Disponibles', 'camisas', 'Corte de playera: Caballero, Playera de algodón, Corte de Vinil de Alta Calidad, No se despinta, Tallas Disponibles: Chica, Mediana, Grande, XL, XXL, XXL, Tipo de manga: Manga corta', 369.00, 18, 'https://i.postimg.cc/Rh58d2SW/cam9.png'),
(14, 'AC/DC - Playera Oficial de Espalda en Color Negro', 'camisas', 'Jersey de alta gama, Producto oficial de AC/DC, Colección Back In Black\' 40th Anniversar', 393.44, 5, 'https://i.postimg.cc/gjV7T4jN/cam10.png'),
(15, 'Playeras Linkin Park Para Hombre Y Mujer', 'camisas', 'Playera 100% algodón, impresión en serigrafía, la mejor técnica de impresión, NUNCA se deslava, NUNCA se cuartea.', 369.00, 26, 'https://i.postimg.cc/fTvF7H6b/cam11.png'),
(16, 'Camiseta de Judas Priest Screaming For Vengeance, Negro', 'camisas', 'Productos oficiales de Judas Priest, Judas Priest Camisetas para hombres, mujeres, niñas y niños; camiseta Judas Priest para adultos; camisetas de Judas Priest para niños; sudadera con capucha Judas Priest ; camiseta Judas Priest Screaming For Vengeance; ', 468.09, 12, 'https://i.postimg.cc/3wkcT3Wy/cam12.png'),
(17, 'Dark Department Kulomi', 'peluches', 'El juguete de peluche Kulomi negro oscuro está hecho de tela de felpa corta de alta calidad y acolchado de algodón de plumón, que es suave y cómodo, elástico, inodoro, no se pela, no se decolora y fácil de limpiar.', 759.00, 2, 'https://i.postimg.cc/GpzhZJ83/pel13.png'),
(18, 'Hollow Knight, Peluche Modelos en Blanco y Negro 27 cm', 'peluches', 'Con textura cómoda, será un buen regalo para el día del niño, cumpleaños y Navidad de tu hijo. Ideal para teatro de escenario y marionetas, narración de historias, enseñanza, guardería, preescolar, juegos de simulación, juegos de rol, presentaciones, jueg', 211.99, 21, 'https://i.postimg.cc/YSxhtBVH/pel14.png'),
(19, 'Murcielago De Peluche Suave Tierno Kawaii Gotico Dark', 'peluches', 'Con textura cómoda, será un buen regalo para el día del niño, cumpleaños y Navidad de tu hijo. Ideal para teatro de escenario y marionetas, narración de historias, enseñanza, guardería, preescolar, juegos de simulación, juegos de rol, presentaciones, jueg', 424.15, 12, 'https://i.postimg.cc/pXnrpF7k/pel15.png'),
(20, 'Scary Goth Bunny Peluche de conejo emo espeluznante', 'peluches', 'Este es el conejo de felpa más suave de la historia! Son aterradoras debido a los detalles realistas de puntadas y parches, pero las puntadas en su corazón te hacen sentir valiente y adorable. Sin miedo al viento y la lluvia, avanza valientemente. ¡Carga!', 704.89, 23, 'https://i.postimg.cc/ZYWpx02v/pel16.png'),
(21, 'Muñeco De Peluche Gótico Oscuro Kuromi Melody', 'peluches', 'El juguete de peluche Melody negro oscuro está hecho de tela de felpa corta de alta calidad y acolchado de algodón de plumón, que es suave y cómodo, elástico, inodoro, no se pela, no se decolora y fácil de limpiar.', 585.32, 7, 'https://i.postimg.cc/dtdCgpqq/pel17.png'),
(22, 'Peluche Baphomet (baphy) Negro Grande ¡cabra Gotica!', 'peluches', 'El peluche baphomet no solo es juguete, es una extensión de tu personalidad mística, extrovertida, imponente y misteriosa, es para todos aquellos que le encanta atreverse a las aventuras. Es simplemente el regalo perfecto para ti o para consentir a tus se', 499.00, 10, 'https://i.postimg.cc/Z0kTrwgH/pel18.png'),
(23, 'Slayer - Llavero Medalla Rock Gotico Metal Emo Aesthetic 01 Plateado', 'llaveros', 'Este Llavero con dije Slayer Rock Metálico es el accesorio perfecto para los amantes del rock y el metal. Con un diseño único de la reconocida marca Slayer, este Llavero destaca por su estilo punk gótico y estético.', 250.00, 22, 'https://i.postimg.cc/Y9cbBgJV/llav19.png'),
(24, 'Ac Dc - Llavero Medalla Rock Pua Gotico Metal Emo 02', 'llaveros', 'Este Llavero con dije AC-DC Rock Metálico es el accesorio perfecto para los amantes del rock y el metal. Con un diseño único de la reconocida marca AC-DC, este Llavero destaca por su estilo punk gótico y estético.', 299.00, 34, 'https://i.postimg.cc/htfrJpn6/llav20.png'),
(25, 'V Nirvana - Llavero Rock Estética Gotico Metal Emo Punk', 'llaveros', 'Lleva tu pasión por el rock a todas partes con este llavero inspirado en Nirvana. Con un diseño oscuro y potente de estética gótica, metal, emo y punk, este accesorio es perfecto para quienes viven la música intensamente. Hecho con materiales duraderos, s', 290.00, 23, 'https://i.postimg.cc/YSFzR0hx/llav21.png'),
(26, 'Judas Priest Llavero Navaja De Afeitar, Dark Dimebag Darrel Dorado', 'llaveros', 'El llavero navaja de afeitar Dark Dimebag Darrel de la marca Gótico es el accesorio perfecto para los amantes del rock y la estética gótica. Fabricado en acero inoxidable de alta calidad, este llavero navaja es resistente y duradero. Con un diseño inspira', 199.00, 20, 'https://i.postimg.cc/5y45fmpP/llav22.png'),
(27, 'Llavero Corazón Sangre Gótico Punk Dije Letra Inicial Regalo', 'llaveros', 'Este llavero estilo gótico punk presenta un hermoso dije de corazón en color rojo sangre, acompañado de una letra inicial personalizada. Ideal como regalo único y especial, su diseño combina fuerza y elegancia, perfecto para quienes buscan un accesorio co', 135.00, 12, 'https://i.postimg.cc/T20qCZYB/llav23.png'),
(28, 'Llavero Mariposa Cráneo Muerte Dije Calavera Gótico Punk Plateado', 'llaveros', 'Este llamativo llavero combina la delicadeza de una mariposa con la fuerza de un cráneo, creando un poderoso símbolo de transformación y rebeldía. Con un acabado plateado de estilo gótico punk, es el accesorio perfecto para quienes aman la estética oscura', 150.00, 21, 'https://i.postimg.cc/g2XVcjqP/llav24.png'),
(29, 'DC Comics V para Vendetta (película): Figura de coleccionista', 'figuras', 'Basado en la exitosa película v for vendetta de 2006, Figura de coleccionista reproduce el traje visto en la película, Viene con sombrero extraíble, manos adicionales y accesorios, Mide 12 pulgadas de alto sobre la base de la pantalla', 2000.00, 1, 'https://i.postimg.cc/rp7Yy7tf/fig25.png'),
(30, 'Figura De Acción De Jason Voorhees De Neca Part Vii 7 The Ne', 'figuras', 'Figura de acción de Jason Voorhees de NECA Part VII 7 The New Blood, Material básico: PVC, Estado: 100% NUEVA, Tamaño: aproximadamente 19 cm', 557.34, 3, 'https://i.postimg.cc/Hx5vr3wd/fig26.png'),
(31, 'Neca Freddy Krueger -18 Pulgadas -figura Sonido', 'figuras', 'Neca Freddy Krueger -18 Pulgadas -figura Sonido', 2000.00, 1, 'https://i.postimg.cc/Dy7pzr83/fig27.png'),
(32, 'Figma Sp-055 Silent Hill Pyramid Head Action Figure Toys', 'figuras', 'Revive el terror clásico con esta figura Figma SP-055 de Pyramid Head, el icónico monstruo de Silent Hill. Altamente detallada y completamente articulada, esta figura de acción permite recrear escenas espeluznantes o exhibirla en poses imponentes. Incluye', 989.34, 7, 'https://i.postimg.cc/VsW42J4G/fig28.png'),
(33, 'Figura La Monja The Nun Conjuring Universe', 'figuras', 'Aprovecha esta pieza de colección de: THE NUN THE CONJURING UNIVERSE Figura del Famoso Personaje de la monja clásica película de terror. esta figura no puede faltar en tu colección!, Artículo 100% nuevo, mas de 10 articulaciones, 19cm de alto aprox., Exce', 805.54, 3, 'https://i.postimg.cc/q76jFQZy/fig29.png'),
(34, 'NECA - IT - Figura de acción a Escala de 7 Pulgadas - Ultimate Pennywise (2017)', 'figuras', 'Basado en la película de terror 2017 IT, Mide aproximadamente 7 pulgadas de alto alrededor totalmente articulado, Accesorios incluidos: 3 cabezales intercambiables, manos intercambiables, globo rojo y barco de papel, Basado en el retrato de Bill Skarsgard', 1.00, 8, 'https://i.postimg.cc/2SMxnh86/fig30.png'),
(35, 'Taza de Café GRUPO IFACO | Regalo Original para Rockeros, Negro, 11 Onzas', 'tazas', 'Regalo original para rockeros, Asa e interior de color negro, Tamaño perfecto de 11 Onzas, Divertido y original regalo, Dale un toque diferente a tus mañanas', 245.44, 5, 'https://i.postimg.cc/gJQwTqQX/taz31.png'),
(36, 'Taza de Colección Bandas de Rock Legendarias', 'tazas', 'Tamaño Ideal: Capacidad de 11 oz, perfecta para disfrutar tu bebida favorita, Regalo Perfecto: Ideal para cualquier ocasión, ya sea un detalle especial o un capricho personal, Diseño Espectacular: Presenta un diseño de tus artisas o grupos musicales favor', 299.00, 2, 'https://i.postimg.cc/wThtwNVM/taz32.png'),
(37, 'Taza Metallica Kill, Ride, Master, Justice, Black', 'tazas', 'Tamaño Ideal: Capacidad de 11 oz, perfecta para disfrutar tu bebida favorita, Regalo Perfecto: Ideal para cualquier ocasión, ya sea un detalle especial o un capricho personal, Diseño Espectacular: Presenta un diseño de tus artisas o grupos musicales favor', 153.00, 20, 'https://i.postimg.cc/qBWnb4Hb/taz33.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
