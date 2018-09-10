CREATE DATABASE IF NOT EXISTS `buscador` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `buscador`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo`
--

DROP TABLE IF EXISTS `archivo`;
CREATE TABLE `archivo` (
  `id` int(11) NOT NULL,
  `filename` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `archivo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultado`
--

DROP TABLE IF EXISTS `resultado`;
CREATE TABLE `resultado` (
  `id` int(11) NOT NULL,
  `terminoId` int(11) NOT NULL,
  `archivoId` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultado_detalle`
--

DROP TABLE IF EXISTS `resultado_detalle`;
CREATE TABLE `resultado_detalle` (
  `id` int(11) NOT NULL,
  `resultadoId` int(11) NOT NULL,
  `coincidencia` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `termino`
--

DROP TABLE IF EXISTS `termino`;
CREATE TABLE `termino` (
  `id` int(11) NOT NULL,
  `termino` varchar(50) NOT NULL,
  `fechaCreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL UNIQUE,
  `username` varchar(50) DEFAULT NULL UNIQUE,
  `password` varchar(200) DEFAULT NULL,
  `rol` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `reset_password_token` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `username`, `password`, `rol`, `activo`) VALUES
(1, 'hola@programacionymas.com', 'Juan Ramos', 'MTIzNDU2', 2, 1), -- 123456 Admin
(2, 'joryes1894@gmail.com', 'Jorge Gonzales', 'MTIzNDU2', 1, 1); -- 123456 User

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_archivos`
--

DROP TABLE IF EXISTS `usuarios_archivos`;
CREATE TABLE `usuarios_archivos` (
  `id` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  `archivoId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resultado`
--
ALTER TABLE `resultado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `terminoId` (`terminoId`);

--
-- Indices de la tabla `resultado_detalle`
--
ALTER TABLE `resultado_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resultadoId` (`resultadoId`);

--
-- Indices de la tabla `termino`
--
ALTER TABLE `termino`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_archivos`
--
ALTER TABLE `usuarios_archivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarioId` (`usuarioId`),
  ADD KEY `archivoId` (`archivoId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivo`
--
ALTER TABLE `archivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `resultado`
--
ALTER TABLE `resultado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT de la tabla `resultado_detalle`
--
ALTER TABLE `resultado_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `termino`
--
ALTER TABLE `termino`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `usuarios_archivos`
--
ALTER TABLE `usuarios_archivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
