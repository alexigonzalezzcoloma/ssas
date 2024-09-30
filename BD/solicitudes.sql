-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 21-04-2022 a las 17:06:52
-- Versión del servidor: 5.7.37-0ubuntu0.18.04.1
-- Versión de PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `solicitudes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones_pme`
--

CREATE TABLE `acciones_pme` (
  `id` int(11) NOT NULL,
  `rbd_colegio` varchar(20) DEFAULT NULL,
  `id_subdimension` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `acciones_pme`
--

INSERT INTO `acciones_pme` (`id`, `rbd_colegio`, `id_subdimension`, `nombre`, `descripcion`, `fecha_inicio`, `fecha_fin`) VALUES
(20, '5651', 12, 'CoordinaciÃ³n e implementaciÃ³n de bases curriculares', 'El director y el equipo tÃ©cnico-pedagÃ³gico promueven que los docentes se apropien, conozcan y manejen las Bases Curriculares y los programas de estudio, para ello, generan espacios para su anÃ¡lisis, articulaciÃ³n y discusiÃ³n, revisan el alineamiento de las mismas y promueven la transversalidad e interdisciplinariedad', '2022-01-01', '2022-12-31'),
(21, '5265', 12, 'CoordinaciÃ³n e implementaciÃ³n de bases curriculares', 'El director y el equipo tÃ©cnico-pedagÃ³gico promueven que los docentes se apropien, conozcan y manejen las Bases Curriculares y los programas de estudio, para ello, generan espacios para su anÃ¡lisis, articulaciÃ³n y discusiÃ³n, revisan el alineamiento de las mismas y promueven la transversalidad e interdisciplinariedad', '2022-01-01', '2022-12-31'),
(22, '6122', 12, 'CoordinaciÃ³n e implementaciÃ³n de bases curriculares', 'El director y el equipo tÃ©cnico-pedagÃ³gico promueven que los docentes se apropien, conozcan y manejen las Bases Curriculares y los programas de estudio, para ello, generan espacios para su anÃ¡lisis, articulaciÃ³n y discusiÃ³n, revisan el alineamiento de las mismas y promueven la transversalidad e interdisciplinariedad', '2022-01-01', '2022-12-31'),
(23, '6835', 12, 'CoordinaciÃ³n e implementaciÃ³n de bases curriculares', 'El director y el equipo tÃ©cnico-pedagÃ³gico promueven que los docentes se apropien, conozcan y manejen las Bases Curriculares y los programas de estudio, para ello, generan espacios para su anÃ¡lisis, articulaciÃ³n y discusiÃ³n, revisan el alineamiento de las mismas y promueven la transversalidad e interdisciplinariedad', '2022-01-01', '2022-12-31'),
(24, '7405', 12, 'CoordinaciÃ³n e implementaciÃ³n de bases curriculares', 'El director y el equipo tÃ©cnico-pedagÃ³gico promueven que los docentes se apropien, conozcan y manejen las Bases Curriculares y los programas de estudio, para ello, generan espacios para su anÃ¡lisis, articulaciÃ³n y discusiÃ³n, revisan el alineamiento de las mismas y promueven la transversalidad e interdisciplinariedad', '2022-01-01', '2022-12-31'),
(25, '11678', 12, 'CoordinaciÃ³n e implementaciÃ³n de bases curriculares', 'El director y el equipo tÃ©cnico-pedagÃ³gico promueven que los docentes se apropien, conozcan y manejen las Bases Curriculares y los programas de estudio, para ello, generan espacios para su anÃ¡lisis, articulaciÃ³n y discusiÃ³n, revisan el alineamiento de las mismas y promueven la transversalidad e interdisciplinariedad', '2022-01-01', '2022-12-31'),
(26, '19968', 12, 'CoordinaciÃ³n e implementaciÃ³n de bases curriculares', 'El director y el equipo tÃ©cnico-pedagÃ³gico promueven que los docentes se apropien, conozcan y manejen las Bases Curriculares y los programas de estudio, para ello, generan espacios para su anÃ¡lisis, articulaciÃ³n y discusiÃ³n, revisan el alineamiento de las mismas y promueven la transversalidad e interdisciplinariedad', '2022-01-01', '2022-12-31'),
(27, '22019', 12, 'CoordinaciÃ³n e implementaciÃ³n de bases curriculares', 'El director y el equipo tÃ©cnico-pedagÃ³gico promueven que los docentes se apropien, conozcan y manejen las Bases Curriculares y los programas de estudio, para ello, generan espacios para su anÃ¡lisis, articulaciÃ³n y discusiÃ³n, revisan el alineamiento de las mismas y promueven la transversalidad e interdisciplinariedad', '2022-01-01', '2022-12-31'),
(28, '22173', 12, 'CoordinaciÃ³n e implementaciÃ³n de bases curriculares', 'El director y el equipo tÃ©cnico-pedagÃ³gico promueven que los docentes se apropien, conozcan y manejen las Bases Curriculares y los programas de estudio, para ello, generan espacios para su anÃ¡lisis, articulaciÃ³n y discusiÃ³n, revisan el alineamiento de las mismas y promueven la transversalidad e interdisciplinariedad', '2022-01-01', '2022-12-31'),
(29, '6542', 12, 'CoordinaciÃ³n e implementaciÃ³n de bases curriculares', 'El director y el equipo tÃ©cnico-pedagÃ³gico promueven que los docentes se apropien, conozcan y manejen las Bases Curriculares y los programas de estudio, para ello, generan espacios para su anÃ¡lisis, articulaciÃ³n y discusiÃ³n, revisan el alineamiento de las mismas y promueven la transversalidad e interdisciplinariedad', '2022-01-01', '2022-12-31'),
(30, '5651', 12, 'Lineamientos comunes', 'El director y el equipo tÃ©cnico-pedagÃ³gico acuerdan con los docentes lineamientos metodolÃ³gicos comunes que deben ser implementadas en mÃ¡s de una asignatura o nivel, (mÃ©todo de lectoescritura, enseÃ±anza de las matemÃ¡ticas, asignaciÃ³n de tareas, uso de tics en el aula, aprendizajes por proyectos entre otros)', '2022-01-01', '2022-12-31'),
(31, '1', 12, 'Lineamientos comunes', 'El director y el equipo tÃ©cnico-pedagÃ³gico acuerdan con los docentes lineamientos metodolÃ³gicos comunes que deben ser implementadas en mÃ¡s de una asignatura o nivel, (mÃ©todo de lectoescritura, enseÃ±anza de las matemÃ¡ticas, asignaciÃ³n de tareas, uso de tics en el aula, aprendizajes por proyectos entre otros)', '2022-01-01', '2022-12-31'),
(32, '5265', 12, 'Lineamientos comunes', 'El director y el equipo tÃ©cnico-pedagÃ³gico acuerdan con los docentes lineamientos metodolÃ³gicos comunes que deben ser implementadas en mÃ¡s de una asignatura o nivel, (mÃ©todo de lectoescritura, enseÃ±anza de las matemÃ¡ticas, asignaciÃ³n de tareas, uso de tics en el aula, aprendizajes por proyectos entre otros)', '2022-01-01', '2022-12-31'),
(33, '1', 12, 'Fortaleciendo el  acompaÃ±amiento al aula (ADECO)', 'El director y el equipo tÃ©cnico pedagÃ³gico, usan estrategias diversas para mejorar el acompaÃ±amiento al aula  (a los docentes â€¦tales y cualesâ€¦) y su correspondiente retroalimentaciÃ³n, como por ejemplo, grabaciÃ³n voluntaria de una clase, y su correspondiente anÃ¡lisis e GPT, y el acompaÃ±amiento entre pares. ', '2022-01-01', '2022-12-31'),
(34, '5265', 12, 'Fortaleciendo el  acompaÃ±amiento al aula (ADECO)', 'El director y el equipo tÃ©cnico pedagÃ³gico, usan estrategias diversas para mejorar el acompaÃ±amiento al aula  (a los docentes â€¦tales y cualesâ€¦) y su correspondiente retroalimentaciÃ³n, como por ejemplo, grabaciÃ³n voluntaria de una clase, y su correspondiente anÃ¡lisis e GPT, y el acompaÃ±amiento entre pares. ', '2022-01-01', '2022-12-31'),
(35, '5651', 12, 'Fortaleciendo el  acompaÃ±amiento al aula (ADECO)', 'El director y el equipo tÃ©cnico pedagÃ³gico, usan estrategias diversas para mejorar el acompaÃ±amiento al aula  (a los docentes â€¦tales y cualesâ€¦) y su correspondiente retroalimentaciÃ³n, como por ejemplo, grabaciÃ³n voluntaria de una clase, y su correspondiente anÃ¡lisis e GPT, y el acompaÃ±amiento entre pares. ', '2022-01-01', '2022-12-31'),
(36, '6122', 12, 'Fortaleciendo el  acompaÃ±amiento al aula (ADECO)', 'El director y el equipo tÃ©cnico pedagÃ³gico, usan estrategias diversas para mejorar el acompaÃ±amiento al aula  (a los docentes â€¦tales y cualesâ€¦) y su correspondiente retroalimentaciÃ³n, como por ejemplo, grabaciÃ³n voluntaria de una clase, y su correspondiente anÃ¡lisis e GPT, y el acompaÃ±amiento entre pares. ', '2022-01-01', '2022-12-31'),
(37, '6542', 12, 'Fortaleciendo el  acompaÃ±amiento al aula (ADECO)', 'El director y el equipo tÃ©cnico pedagÃ³gico, usan estrategias diversas para mejorar el acompaÃ±amiento al aula  (a los docentes â€¦tales y cualesâ€¦) y su correspondiente retroalimentaciÃ³n, como por ejemplo, grabaciÃ³n voluntaria de una clase, y su correspondiente anÃ¡lisis e GPT, y el acompaÃ±amiento entre pares. ', '2022-01-01', '2022-12-31'),
(38, '6835', 12, 'Fortaleciendo el  acompaÃ±amiento al aula (ADECO)', 'El director y el equipo tÃ©cnico pedagÃ³gico, usan estrategias diversas para mejorar el acompaÃ±amiento al aula  (a los docentes â€¦tales y cualesâ€¦) y su correspondiente retroalimentaciÃ³n, como por ejemplo, grabaciÃ³n voluntaria de una clase, y su correspondiente anÃ¡lisis e GPT, y el acompaÃ±amiento entre pares. ', '2022-01-01', '2022-12-31'),
(39, '7405', 12, 'Fortaleciendo el  acompaÃ±amiento al aula (ADECO)', 'El director y el equipo tÃ©cnico pedagÃ³gico, usan estrategias diversas para mejorar el acompaÃ±amiento al aula  (a los docentes â€¦tales y cualesâ€¦) y su correspondiente retroalimentaciÃ³n, como por ejemplo, grabaciÃ³n voluntaria de una clase, y su correspondiente anÃ¡lisis e GPT, y el acompaÃ±amiento entre pares. ', '2022-01-01', '2022-12-31'),
(40, '11678', 12, 'Fortaleciendo el  acompaÃ±amiento al aula (ADECO)', 'El director y el equipo tÃ©cnico pedagÃ³gico, usan estrategias diversas para mejorar el acompaÃ±amiento al aula  (a los docentes â€¦tales y cualesâ€¦) y su correspondiente retroalimentaciÃ³n, como por ejemplo, grabaciÃ³n voluntaria de una clase, y su correspondiente anÃ¡lisis e GPT, y el acompaÃ±amiento entre pares. ', '2022-01-01', '2022-12-31'),
(42, '19968', 12, 'Fortaleciendo el  acompaÃ±amiento al aula (ADECO)', 'El director y el equipo tÃ©cnico pedagÃ³gico, usan estrategias diversas para mejorar el acompaÃ±amiento al aula  (a los docentes â€¦tales y cualesâ€¦) y su correspondiente retroalimentaciÃ³n, como por ejemplo, grabaciÃ³n voluntaria de una clase, y su correspondiente anÃ¡lisis e GPT, y el acompaÃ±amiento entre pares. ', '2022-01-01', '2022-12-31'),
(43, '22019', 12, 'Fortaleciendo el  acompaÃ±amiento al aula (ADECO)', 'El director y el equipo tÃ©cnico pedagÃ³gico, usan estrategias diversas para mejorar el acompaÃ±amiento al aula  (a los docentes â€¦tales y cualesâ€¦) y su correspondiente retroalimentaciÃ³n, como por ejemplo, grabaciÃ³n voluntaria de una clase, y su correspondiente anÃ¡lisis e GPT, y el acompaÃ±amiento entre pares. ', '2022-01-01', '2022-12-31'),
(44, '22173', 12, 'Fortaleciendo el  acompaÃ±amiento al aula (ADECO)', 'El director y el equipo tÃ©cnico pedagÃ³gico, usan estrategias diversas para mejorar el acompaÃ±amiento al aula  (a los docentes â€¦tales y cualesâ€¦) y su correspondiente retroalimentaciÃ³n, como por ejemplo, grabaciÃ³n voluntaria de una clase, y su correspondiente anÃ¡lisis e GPT, y el acompaÃ±amiento entre pares. ', '2022-01-01', '2022-12-31'),
(45, '1', 12, 'Proceso efectivo de evaluaciÃ³n y monitoreo de los aprendizajes', 'El director y el equipo tÃ©cnico pedagÃ³gico, analizan periÃ³dicamente los procesos de evaluaciÃ³n que implementan los docentes, revisando el aprendizaje de los objetivos priorizados, identifican cursos, asignaturas o estudiantes con rendimiento deficiente y acuerdan medidas de evaluaciÃ³n formativa,  retroalimentaciÃ³n y reforzamiento. ', '2022-01-01', '2022-12-31'),
(46, '5265', 12, 'Proceso efectivo de evaluaciÃ³n y monitoreo de los aprendizajes', 'El director y el equipo tÃ©cnico pedagÃ³gico, analizan periÃ³dicamente los procesos de evaluaciÃ³n que implementan los docentes, revisando el aprendizaje de los objetivos priorizados, identifican cursos, asignaturas o estudiantes con rendimiento deficiente y acuerdan medidas de evaluaciÃ³n formativa,  retroalimentaciÃ³n y reforzamiento. ', '2022-01-01', '2022-12-31'),
(47, '5651', 12, 'Proceso efectivo de evaluaciÃ³n y monitoreo de los aprendizajes', 'El director y el equipo tÃ©cnico pedagÃ³gico, analizan periÃ³dicamente los procesos de evaluaciÃ³n que implementan los docentes, revisando el aprendizaje de los objetivos priorizados, identifican cursos, asignaturas o estudiantes con rendimiento deficiente y acuerdan medidas de evaluaciÃ³n formativa,  retroalimentaciÃ³n y reforzamiento. ', '2022-01-01', '2022-12-31'),
(48, '6122', 12, 'Proceso efectivo de evaluaciÃ³n y monitoreo de los aprendizajes', 'El director y el equipo tÃ©cnico pedagÃ³gico, analizan periÃ³dicamente los procesos de evaluaciÃ³n que implementan los docentes, revisando el aprendizaje de los objetivos priorizados, identifican cursos, asignaturas o estudiantes con rendimiento deficiente y acuerdan medidas de evaluaciÃ³n formativa,  retroalimentaciÃ³n y reforzamiento. ', '2022-01-01', '2022-12-31'),
(49, '6542', 12, 'Proceso efectivo de evaluaciÃ³n y monitoreo de los aprendizajes', 'El director y el equipo tÃ©cnico pedagÃ³gico, analizan periÃ³dicamente los procesos de evaluaciÃ³n que implementan los docentes, revisando el aprendizaje de los objetivos priorizados, identifican cursos, asignaturas o estudiantes con rendimiento deficiente y acuerdan medidas de evaluaciÃ³n formativa,  retroalimentaciÃ³n y reforzamiento. ', '2022-01-01', '2022-12-31'),
(50, '6835', 12, 'Proceso efectivo de evaluaciÃ³n y monitoreo de los aprendizajes', 'El director y el equipo tÃ©cnico pedagÃ³gico, analizan periÃ³dicamente los procesos de evaluaciÃ³n que implementan los docentes, revisando el aprendizaje de los objetivos priorizados, identifican cursos, asignaturas o estudiantes con rendimiento deficiente y acuerdan medidas de evaluaciÃ³n formativa,  retroalimentaciÃ³n y reforzamiento. ', '2022-01-01', '2022-12-31'),
(51, '7405', 12, 'Proceso efectivo de evaluaciÃ³n y monitoreo de los aprendizajes', 'El director y el equipo tÃ©cnico pedagÃ³gico, analizan periÃ³dicamente los procesos de evaluaciÃ³n que implementan los docentes, revisando el aprendizaje de los objetivos priorizados, identifican cursos, asignaturas o estudiantes con rendimiento deficiente y acuerdan medidas de evaluaciÃ³n formativa,  retroalimentaciÃ³n y reforzamiento. ', '2022-01-01', '2022-12-31'),
(52, '11678', 12, 'Proceso efectivo de evaluaciÃ³n y monitoreo de los aprendizajes', 'El director y el equipo tÃ©cnico pedagÃ³gico, analizan periÃ³dicamente los procesos de evaluaciÃ³n que implementan los docentes, revisando el aprendizaje de los objetivos priorizados, identifican cursos, asignaturas o estudiantes con rendimiento deficiente y acuerdan medidas de evaluaciÃ³n formativa,  retroalimentaciÃ³n y reforzamiento. ', '2022-01-01', '2022-12-31'),
(54, '19968', 12, 'Proceso efectivo de evaluaciÃ³n y monitoreo de los aprendizajes', 'El director y el equipo tÃ©cnico pedagÃ³gico, analizan periÃ³dicamente los procesos de evaluaciÃ³n que implementan los docentes, revisando el aprendizaje de los objetivos priorizados, identifican cursos, asignaturas o estudiantes con rendimiento deficiente y acuerdan medidas de evaluaciÃ³n formativa,  retroalimentaciÃ³n y reforzamiento. ', '2022-01-01', '2022-12-31'),
(55, '22019', 12, 'Proceso efectivo de evaluaciÃ³n y monitoreo de los aprendizajes', 'El director y el equipo tÃ©cnico pedagÃ³gico, analizan periÃ³dicamente los procesos de evaluaciÃ³n que implementan los docentes, revisando el aprendizaje de los objetivos priorizados, identifican cursos, asignaturas o estudiantes con rendimiento deficiente y acuerdan medidas de evaluaciÃ³n formativa,  retroalimentaciÃ³n y reforzamiento. ', '2022-01-01', '2022-12-31'),
(56, '22173', 12, 'Proceso efectivo de evaluaciÃ³n y monitoreo de los aprendizajes', 'El director y el equipo tÃ©cnico pedagÃ³gico, analizan periÃ³dicamente los procesos de evaluaciÃ³n que implementan los docentes, revisando el aprendizaje de los objetivos priorizados, identifican cursos, asignaturas o estudiantes con rendimiento deficiente y acuerdan medidas de evaluaciÃ³n formativa,  retroalimentaciÃ³n y reforzamiento. ', '2022-01-01', '2022-12-31'),
(57, '1', 13, 'Desarrollo de habilidades en el aula', 'Los docentes realizan sus clases promoviendo que cada uno de sus estudiantes establezcan relaciones entre las habilidades, conocimientos y actitudes trabajadas en clases, para ello modelan, explican y dan ejemplos.', '2022-01-01', '2022-12-31'),
(58, '5651', 13, 'Estrategias efectivas de enseÃ±anza aprendizaje', 'Los docentes entregan lecturas, videos o tutoriales para que sus estudiantes revisen antes de las clases y estas se centren en discutir, profundizar o aclarar dudas sobre el material visto, van mÃ¡s allÃ¡ de solo dictar en clases priorizan el anÃ¡lisis y la reflexiÃ³n.', '2022-01-01', '2022-12-31'),
(59, '5651', 13, 'Docentes generadores de motivaciÃ³n', 'Los docentes usan estrategias innovadoras para lograr que sus estudiantes se involucren y participen con interÃ©s en clases. Por ejemplo, construyen con los estudiantes estrategias de aprendizaje efectivas, les piden que investiguen respuestas a problemas del mundo real, planteen nuevas preguntas y propongan soluciones concretas, les enseÃ±an a realizar anÃ¡lisis de casos, juego de roles y simulaciones, entre otras. ', '2022-01-01', '2022-12-31'),
(60, '5651', 13, 'EvaluaciÃ³n formativa constante y retroalimentaciÃ³n', 'Los docentes retroalimentan constantemente a sus estudiantes sobre su desempeÃ±o, de manera individual y grupal. Por ejemplo, destacan los aspectos logrados, promueven la metacogniciÃ³n sobre sus procesos de aprendizaje, los ayudan a detectar y analizar sus errores para aprender de ellos y les explican nuevamente si es necesario.', '2022-01-01', '2022-12-31'),
(61, '5651', 13, 'Uso eficiente del tiempo lectivo', 'Los docentes establecen rutinas y procedimientos que reducen la pÃ©rdida de tiempo lectivo al mÃ­nimo. Para esto: Inician y finalizan sus clases en los horarios correspondientes, establecen procedimientos para pasar lista, repartir materiales, reÃºnen y preparan con anticipaciÃ³n todos los elementos necesarios para desarrollar las clases y evitan las interrupciones externas. ', '2022-01-01', '2022-12-31'),
(62, '5651', 14, 'Apoyo a las NEE', 'El equipo tÃ©cnico-pedagÃ³gico y los docentes diagnostican, entregan apoyo sistemÃ¡tico y oportuno a los estudiantes que presentan vacÃ­os de aprendizaje y requieren reforzamiento adicional, mediante reforzamientos programados, guÃ­as de apoyo, asignaciÃ³n de tutores, docentes especialistas, co docentes, entrevista con las familias y los apoderados, entre otros. ', '2022-01-01', '2022-12-31'),
(63, '5651', 14, 'Potenciando habilidades destacadas', 'El equipo directivo, en conjunto con los docentes, organizan y fomentan actividades extracurriculares para estimular y desarrollar la diversidad de intereses y habilidades de todos los estudiantes, como talleres literarios, coro, diario escolar, talleres de medioambiente, grupos de debate, exposiciones artÃ­sticas, talleres deportivos y eventos culturales. ', '2022-01-01', '2022-12-31'),
(64, '5651', 14, 'Apoyo social, afectivo y conductual', 'El equipo directivo junto al sostenedor se aseguran de contar orientador, encargado de convivencia, para apoyar social, afectiva y conductualmente a los estudiantes en riesgo inclusive de deserciÃ³n escolar.', '2022-01-01', '2022-12-31'),
(65, '5651', 5, 'EvaluaciÃ³n y retroalimentaciÃ³n al personal', 'El equipo directivo utiliza un sistema de evaluaciÃ³n con soporte en una plataforma tecnolÃ³gica, el que permite llevar un seguimiento en lÃ­nea del rol docente, que considera, entre otros, como los docentes se apropiaciÃ³n de los sellos y valores del Proyecto Educativo Institucional. ', '2022-01-01', '2022-12-31'),
(66, '5651', 5, 'Desarrollo profesional y tÃ©cnico', 'El sostenedor o el equipo directivo implementa procedimientos avanzados de inducciÃ³n del personal, como participaciÃ³n en sesiones en lÃ­nea, capacitaciones, entrega de protocolos de procedimientos, acompaÃ±amiento de clases, retroalimentaciÃ³n constante durante el primer aÃ±o, por medio de un plan anual de desarrollo profesional que considera las necesidades levantadas tanto por el equipo directivo como por el Consejo de Profesores. ', '2022-01-01', '2022-12-31'),
(67, '5651', 8, 'Presupuesto, solicitudes y rendiciÃ³n de gastos', 'El director y su equipo directivo elaboran y ejecutan un presupuesto anual por Ã¡reas, detallando los ingresos proyectados y gastos, en las respectivas acciones y considera formalmente los requerimientos, prioridades y solicitudes de su unidad educativa.', '2022-01-01', '2022-12-31'),
(68, '5651', 8, 'Retorno Seguro', 'El director y su equipo directivo elabora y ejecuta un plan de retorno seguro para todos los miembros de la comunidad educativa, para ello se asegura de contar con stock de implementos de seguridad personal y de insumos y servicios de SanitizaciÃ³n.', '2022-01-01', '2022-12-31'),
(69, '5651', 6, 'Infraestructura y equipamiento en Ã³ptimo estado', 'El director y el equipo directivo buscan la mejora constante de la infraestructura y el equipamiento del establecimiento. Por ejemplo, se preocupan de mejorar los accesos, la disponibilidad de salas, el estado del patio o canchas, el instrumental del laboratorio y CRA entre otros. ', '2022-01-01', '2022-12-31'),
(70, '5651', 6, 'AdquisiciÃ³n y uso de recursos didÃ¡cticos', 'El sostenedor y el equipo directivo gestionan un sistema de inventario en lÃ­nea, almacenaje y prÃ©stamo de los recursos didÃ¡cticos que permite su uso expedito, evita su deterioro y pÃ©rdida, y cuentan con mecanismos para incentivar el uso didÃ¡ctico permanente de estos  uso semestrales.\n', '2022-01-01', '2022-12-31'),
(71, '5651', 6, 'Potenciando el hÃ¡bito lector', 'El sostenedor y el equipo directivo implementan la biblioteca CRA con una colecciÃ³n amplia y diversa de libros y materiales de apoyo que supera los estÃ¡ndares exigidos y fortalece su Proyecto educativo, estableciendo lineamientos comunes de uso.\n', '2022-01-01', '2022-12-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adjuntos`
--

CREATE TABLE `adjuntos` (
  `id` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `id_movimiento` int(11) DEFAULT NULL,
  `nombre` varchar(60) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `fecha_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colegios`
--

CREATE TABLE `colegios` (
  `rbd` varchar(20) NOT NULL,
  `rut_fundacion` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `colegios`
--

INSERT INTO `colegios` (`rbd`, `rut_fundacion`, `nombre`, `direccion`) VALUES
('1', '65.002.737-k', 'FundaciÃ³n', 'Claro Solar 1170, Temuco Chile'),
('11678', '65.002.737-k', 'Colegio Adventista de Punta Arenas', 'Jose Gonzalez 229 - Punta Arenas'),
('19968', '65.002.737-k', 'Colegio Adventista de Pitrufquen', 'Barros Arana 959 - Pitrufquen\r\n'),
('22019', '65.002.737-k', 'Colegio Adventista de Puerto Montt', 'Las Margaritas 1991, Sector Mirasol - Puerto Montt\r\n'),
('22173', '65.002.737-k', 'Jardin de Castro', 'Marquez de la Plata 394, Castro'),
('5265', '65.002.737-k', 'Colegio Adventista de Angol', 'Ursula Suarez 2671, Angol, Araucania'),
('5651', '65.002.737-k', 'Colegio Adventista de Temuco', 'Claro Solar 1170, Temuco Chile'),
('6122', '65.002.737-k', 'Colegio Adventista de Villarrica', 'Pedro Montt 775, Villarrica'),
('6542', '65.002.737-k', 'Colegio Adventista de Trovolhue', 'Los Tilos 161 - Trovolhue\r\n'),
('6835', '65.002.737-k', 'Colegio Adventista de Valdivia', 'Jose Gonzalez'),
('7405', '65.002.737-k', 'Colegio Adventista de Osorno', 'Francisco Bilbao 1697 - Osorno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comisiones`
--

CREATE TABLE `comisiones` (
  `id` int(11) NOT NULL,
  `fecha_realizacion` date NOT NULL,
  `acta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comisiones`
--

INSERT INTO `comisiones` (`id`, `fecha_realizacion`, `acta`) VALUES
(17, '2022-03-08', '18cf39002fecceaca0297f63fafc9235.pdf'),
(18, '2022-03-09', '130c1f0702a9aa9cccf01db74cd0abe7.pdf'),
(19, '2022-03-25', '50c39937f407a9faef66647ab62645b5.pdf'),
(20, '2022-03-25', '62dae44549515ec5937b9d1692baa98a.pdf'),
(21, '2022-04-21', '4356743a41bb963c28256f6b2289686a.pdf'),
(22, '2022-04-21', 'a1e7da041baef4d099da7e2499f3df4f.pdf'),
(23, '2022-04-21', '8529e34c2d8aac9def2484c82595af7e.pdf'),
(24, '2022-04-21', '2216c8a3ca770427876cd38f71967c13.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desiciones_comisiones`
--

CREATE TABLE `desiciones_comisiones` (
  `id` int(11) NOT NULL,
  `id_comision` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `rbd_colegio` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `desiciones_comisiones`
--

INSERT INTO `desiciones_comisiones` (`id`, `id_comision`, `id_solicitud`, `id_estado`, `rbd_colegio`) VALUES
(50, 21, 63, 16, '5651'),
(51, 22, 63, 16, '5651'),
(52, 23, 63, 16, '5651'),
(53, 24, 63, 16, '5651');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimesiones_gestion`
--

CREATE TABLE `dimesiones_gestion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dimesiones_gestion`
--

INSERT INTO `dimesiones_gestion` (`id`, `nombre`) VALUES
(0, 'Seleccione DimensiÃ³n'),
(1, 'Area Gestion PedagÃ³gica'),
(2, 'Area Convivencia Escolar'),
(3, 'Area Liderazgo'),
(4, 'Area GestiÃ³n de Recursos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`) VALUES
(1, 'Creada'),
(2, 'Enviada por Editor/a'),
(3, 'En revisiÃ³n por Director/a'),
(4, 'Enviada por Director/a'),
(5, 'En revisiÃ³n por Encargado/a TI'),
(6, 'Enviada por Encargado/a TI'),
(7, 'En revisiÃ³n por Encargado/a GTH'),
(8, 'Enviada por Encargado/a GTH'),
(9, 'En revisiÃ³n por Tesorero/a Educacion'),
(10, 'Enviada por Tesorero/a Educacion'),
(11, 'En revisiÃ³n por Departamental'),
(12, 'Enviada por Departamental'),
(13, 'En revisiÃ³n por Comision Interna'),
(14, 'En ediciÃ³n'),
(15, 'Aprobada'),
(16, 'Rechazada'),
(17, 'Anulada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fundaciones`
--

CREATE TABLE `fundaciones` (
  `rut` varchar(20) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fundaciones`
--

INSERT INTO `fundaciones` (`rut`, `direccion`, `nombre`) VALUES
('65.002.737-k', 'Claro Solar 1170', 'FEJO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `rut_usuario` varchar(20) DEFAULT NULL,
  `id_rol_usuario` int(11) DEFAULT NULL,
  `id_estado` int(11) NOT NULL,
  `recomienda` varchar(30) DEFAULT NULL,
  `comentario` varchar(350) DEFAULT NULL,
  `fecha_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `id_solicitud`, `rut_usuario`, `id_rol_usuario`, `id_estado`, `recomienda`, `comentario`, `fecha_hora`) VALUES
(296, 63, '13053992-5', 4, 1, NULL, NULL, '2022-04-21 11:00:42'),
(297, 63, '13053992-5', 4, 2, NULL, NULL, '2022-04-21 11:12:03'),
(298, 63, NULL, NULL, 3, NULL, NULL, '2022-04-21 11:12:03'),
(299, 63, '9800914-0', 5, 4, 'No', 'corregir valores de muebles ', '2022-04-21 11:28:04'),
(300, 63, NULL, NULL, 14, NULL, NULL, '2022-04-21 11:28:04'),
(301, 63, '13053992-5', 4, 2, NULL, NULL, '2022-04-21 11:28:52'),
(302, 63, NULL, NULL, 3, NULL, NULL, '2022-04-21 11:28:52'),
(303, 63, '9800914-0', 5, 4, 'SÃ­', '', '2022-04-21 11:30:19'),
(304, 63, NULL, NULL, 5, NULL, NULL, '2022-04-21 11:30:19'),
(305, 63, '14543631-1', 2, 12, '', '', '2022-04-21 11:33:42'),
(306, 63, NULL, NULL, 14, NULL, NULL, '2022-04-21 11:33:42'),
(307, 63, '14543631-1', 2, 12, 'SÃ­', 'gfdtyffr54d4dfr', '2022-04-21 11:34:30'),
(308, 63, NULL, NULL, 13, NULL, NULL, '2022-04-21 11:34:30'),
(309, 63, '14543631-1', 2, 16, NULL, NULL, '2022-04-21 11:41:45'),
(310, 63, '14543631-1', 2, 16, NULL, NULL, '2022-04-21 11:41:52'),
(311, 63, '14543631-1', 2, 16, NULL, NULL, '2022-04-21 11:42:08'),
(312, 63, '14543631-1', 2, 16, NULL, NULL, '2022-04-21 11:42:08'),
(313, 64, '13053992-5', 4, 1, NULL, NULL, '2022-04-21 11:54:16'),
(314, 65, '13053992-5', 4, 1, NULL, NULL, '2022-04-21 11:57:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `id_destinatario` int(11) NOT NULL,
  `rbd_colegio` varchar(20) NOT NULL,
  `mensaje` varchar(535) NOT NULL,
  `fecha_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id`, `id_solicitud`, `id_destinatario`, `rbd_colegio`, `mensaje`, `fecha_hora`) VALUES
(303, 63, 4, '5651', 'La solicitud no avanzÃ³ por disposiciÃ³n del director, modifique de ser necesario', '2022-04-21 11:28:04'),
(304, 63, 4, '5651', 'La solicitud avanzÃ³ por disposiciÃ³n del director', '2022-04-21 11:30:19'),
(305, 63, 5, '5651', 'Su solicitud con nÂ°63 no ha pasado a la Comision Interna, favor revisar y corregir', '2022-04-21 11:33:42'),
(306, 63, 4, '5651', 'Su solicitud con nÂ°63 no ha pasado a la Comision Interna, favor revisar y corregir', '2022-04-21 11:33:42'),
(307, 63, 5, '5651', 'Su solicitud con nÂ° 63 ha pasado a la Comision Interna', '2022-04-21 11:34:30'),
(308, 63, 4, '5651', 'Su solicitud con nÂ° 63 ha pasado a la Comision Interna', '2022-04-21 11:34:30'),
(309, 63, 3, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:41:45'),
(310, 63, 4, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:41:45'),
(311, 63, 5, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:41:45'),
(312, 63, 6, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:41:45'),
(313, 63, 7, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:41:45'),
(314, 63, 8, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:41:45'),
(315, 63, 9, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:41:45'),
(316, 63, 3, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:41:52'),
(317, 63, 4, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:41:52'),
(318, 63, 5, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:41:52'),
(319, 63, 6, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:41:52'),
(320, 63, 7, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:41:52'),
(321, 63, 8, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:41:52'),
(322, 63, 9, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:41:52'),
(323, 63, 3, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:42:08'),
(324, 63, 4, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:42:08'),
(325, 63, 5, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:42:08'),
(326, 63, 6, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:42:08'),
(327, 63, 7, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:42:08'),
(328, 63, 8, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:42:08'),
(329, 63, 9, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:42:08'),
(330, 63, 3, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:42:08'),
(331, 63, 4, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:42:08'),
(332, 63, 5, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:42:08'),
(333, 63, 6, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:42:08'),
(334, 63, 7, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:42:08'),
(335, 63, 8, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:42:08'),
(336, 63, 9, '5651', 'La solicitud nÂ° 63 ha sido Rechazada', '2022-04-21 11:42:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pme_solicitudes`
--

CREATE TABLE `pme_solicitudes` (
  `id` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `id_subvencion` int(11) NOT NULL,
  `id_dimension` int(11) NOT NULL,
  `id_subdimension` int(11) NOT NULL,
  `id_accion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pme_solicitudes`
--

INSERT INTO `pme_solicitudes` (`id`, `id_solicitud`, `id_subvencion`, `id_dimension`, `id_subdimension`, `id_accion`) VALUES
(47, 63, 2, 1, 12, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestos_colegios`
--

CREATE TABLE `presupuestos_colegios` (
  `id` int(11) NOT NULL,
  `rbd_colegio` varchar(20) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `monto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `presupuestos_colegios`
--

INSERT INTO `presupuestos_colegios` (`id`, `rbd_colegio`, `fecha_inicio`, `fecha_fin`, `monto`) VALUES
(1, '5651', '2022-01-01', '2022-12-31', 354591357),
(6, '11678', '2022-01-01', '2022-12-31', 70000000),
(10, '1', '2021-01-01', '2021-12-31', 100000000),
(11, '19968', '2022-01-01', '2022-12-31', 329697623),
(12, '1', '2022-01-01', '2022-12-31', 120000000),
(13, '5265', '2022-01-01', '2022-12-31', 266881241),
(14, '7405', '2022-01-01', '2022-12-31', 182870068),
(15, '6835', '2022-01-01', '2022-12-31', 309198258),
(16, '22019', '2022-01-01', '2022-12-31', 244667948),
(17, '6122', '2022-01-01', '2022-12-31', 234935877);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestos_subvenciones`
--

CREATE TABLE `presupuestos_subvenciones` (
  `id` int(11) NOT NULL,
  `rbd_colegio` int(11) NOT NULL,
  `id_subvencion` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `presupuestos_subvenciones`
--

INSERT INTO `presupuestos_subvenciones` (`id`, `rbd_colegio`, `id_subvencion`, `fecha_inicio`, `fecha_fin`, `monto`) VALUES
(1, 11678, 3, '2022-01-01', '2022-12-31', 50000000),
(2, 5651, 2, '2022-01-01', '2022-12-31', 52000000),
(3, 5651, 3, '2022-01-01', '2022-12-31', 21000000),
(4, 5651, 4, '2022-01-01', '2022-12-31', 12500000),
(5, 5651, 5, '2022-01-01', '2022-12-31', 1200000),
(6, 19968, 2, '2022-01-01', '2022-12-31', 70000000),
(7, 1, 2, '2022-01-01', '2022-12-31', 80000000),
(8, 5265, 2, '2022-01-01', '2022-12-31', 50000000),
(9, 5265, 3, '2022-01-01', '2022-12-31', 19200000),
(10, 22019, 2, '2022-03-01', '2022-12-31', 50000000),
(12, 22019, 3, '2022-03-01', '2022-12-31', 50000000),
(13, 22019, 4, '2022-03-01', '2022-12-31', 50000000),
(14, 6835, 2, '2022-01-01', '2022-12-31', 50000000),
(15, 5651, 6, '2022-01-01', '2022-12-31', 10000000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesionales_contratables`
--

CREATE TABLE `profesionales_contratables` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio_hora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesionales_contratables`
--

INSERT INTO `profesionales_contratables` (`id`, `nombre`, `precio_hora`) VALUES
(1, 'Docente Hora BÃ¡sica', 15694),
(3, 'Docente Hora Media', 16513),
(4, 'FonoaudiÃ³logo', 21220),
(5, 'Monitor taller (Sin estudios superiores', 11671),
(6, 'Monitor con estudio en conservatorio', 15915),
(7, 'PsicÃ³logos', 21220),
(8, 'Psicopedagogo', 14854),
(9, 'Terapeuta Ocupacional', 18568),
(10, 'Profesionales', 14866);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requerimientos`
--

CREATE TABLE `requerimientos` (
  `id` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `id_subvencion` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cantidad` float NOT NULL,
  `precio` int(11) DEFAULT NULL,
  `id_profesional_contratado` int(11) DEFAULT NULL,
  `nombre_profesional` varchar(70) DEFAULT NULL,
  `tiempo_contrato` varchar(15) DEFAULT NULL,
  `inicio_contrato` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `requerimientos`
--

INSERT INTO `requerimientos` (`id`, `id_solicitud`, `id_subvencion`, `nombre`, `cantidad`, `precio`, `id_profesional_contratado`, `nombre_profesional`, `tiempo_contrato`, `inicio_contrato`) VALUES
(70, 63, 2, 'muebles hexagonos', 5, 80000, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Administrador/a'),
(2, 'Departamental'),
(3, 'Tesorero/a Fundacion'),
(4, 'Editor/a'),
(5, 'Director/a'),
(6, 'Encargado/a TI'),
(7, 'Encargado/a GTH'),
(8, 'Revisor/a'),
(9, 'Secretario/a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL,
  `rut_creador` varchar(20) NOT NULL,
  `rbd_colegio` varchar(20) NOT NULL,
  `tipo` varchar(12) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `justificacion` varchar(500) NOT NULL,
  `precio_total` int(11) DEFAULT NULL,
  `id_estado_actual` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `voto_interno` varchar(20) DEFAULT NULL,
  `fecha_voto_interno` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `rut_creador`, `rbd_colegio`, `tipo`, `titulo`, `justificacion`, `precio_total`, `id_estado_actual`, `fecha_hora`, `voto_interno`, `fecha_voto_interno`) VALUES
(63, '13053992-5', '5651', 'Bienes', 'SEDE PORTALES - MUEBLES PARA SALA DE RECURSO PIE', 'Solicitar autorizar recursos SEP del colegio Temuco, por un monto de $1.666.000.- (un millÃ³n seisientos sesenta y seis mil pesos)para compra de muebles que se utilizaran en la sala de recursos PIE de la sede Portales', 400000, 14, '2022-04-21 11:00:42', '68', '2022-04-11'),
(64, '13053992-5', '5651', '', '', '', NULL, 1, '2022-04-21 11:54:16', NULL, NULL),
(65, '13053992-5', '5651', '', '', '', NULL, 1, '2022-04-21 11:57:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subdimensiones_gestion`
--

CREATE TABLE `subdimensiones_gestion` (
  `id` int(11) NOT NULL,
  `id_dimension` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `subdimensiones_gestion`
--

INSERT INTO `subdimensiones_gestion` (`id`, `id_dimension`, `nombre`) VALUES
(1, 2, 'Seleccione SubdimensiÃ³n'),
(2, 3, 'Seleccione SubdimensiÃ³n'),
(3, 4, 'Seleccione SubdimensiÃ³n'),
(4, 1, 'Seleccione SubdimensiÃ³n'),
(5, 4, 'GestiÃ³n de Personal'),
(6, 4, 'GestiÃ³n de Recursos Educativos'),
(8, 4, 'GestiÃ³n de recursos financieros'),
(9, 3, 'Liderazgo del Sostenedor'),
(10, 3, 'Liderazgo del Director'),
(11, 3, 'PlanificaciÃ³n y gestiÃ³n de resultados'),
(12, 1, 'GestiÃ³n curricular'),
(13, 1, 'EnseÃ±anza y aprendizaje en el aula '),
(14, 1, 'Apoyo al desarrollo de los estudiantes'),
(15, 2, 'FormaciÃ³n'),
(16, 2, 'Convivencia'),
(17, 2, 'ParticipaciÃ³n y vida democrÃ¡tica ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subvenciones`
--

CREATE TABLE `subvenciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `subvenciones`
--

INSERT INTO `subvenciones` (`id`, `nombre`) VALUES
(2, 'SEP'),
(3, 'PIE'),
(4, 'GENERAL'),
(5, 'Pro RetenciÃ³n'),
(6, 'Mantenimiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `rut` varchar(20) NOT NULL,
  `ruta_firma` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `rut_fundacion` varchar(20) NOT NULL,
  `rbd_colegio` varchar(20) DEFAULT NULL,
  `habilitado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`rut`, `ruta_firma`, `nombre`, `email`, `clave`, `id_rol`, `rut_fundacion`, `rbd_colegio`, `habilitado`) VALUES
('10043306-0', NULL, 'Claudio Jaque', 'claudio.jaque@adventistas.org', '$2y$10$cxpcta5OtVbfs47wKg149uzgpqJfaoyE1ibY6T62R1YnbDjX0oE/e', 6, '65.002.737-k', '5651', 1),
('10631075-0', NULL, 'Solange Rodriguez', 'gth.asach@educacionadventista.cl', '$2y$10$1z7mVHNZ4oze0etv/jUXk.OKpkY.R2sq4uRiyp5OPaHm6b4XyKDt2', 7, '65.002.737-k', '1', 1),
('10968054-0', NULL, 'Elena Irene Soto Alvarado', 'elena.soto.a@gmail.com ', '$2y$10$1z7mVHNZ4oze0etv/jUXk.OKpkY.R2sq4uRiyp5OPaHm6b4XyKDt2', 4, '65.002.737-k', '6835', 1),
('11155269-K', NULL, 'Pedro Richard Cofre Cruces', 'DIRECTOR.COADPI@EDUCACIONADVENTISTA.CL', '$2y$10$1z7mVHNZ4oze0etv/jUXk.OKpkY.R2sq4uRiyp5OPaHm6b4XyKDt2', 5, '65.002.737-k', '19968', 1),
('12329508-0', NULL, 'Ivan Silva', 'ivan.silva@educacionadventista.cl', '$2y$10$1z7mVHNZ4oze0etv/jUXk.OKpkY.R2sq4uRiyp5OPaHm6b4XyKDt2', 5, '65.002.737-k', '1', 1),
('12345678-9', NULL, 'Administrador/a', 'misionero.digital@asach.cl', '$2y$10$ZOPeaYfkKltTvOegVDPOKOryVfV/DZwnknDWZlGKvwjnqkyAG.YSy', 1, '65.002.737-k', '1', 1),
('13053992-5', NULL, 'Paola Valencia Yanez', 'paola.valencia@coadte.com', '$2y$10$1z7mVHNZ4oze0etv/jUXk.OKpkY.R2sq4uRiyp5OPaHm6b4XyKDt2', 4, '65.002.737-k', '5651', 1),
('13508692-4', NULL, 'Marion Elizabeth Orellana Rivera', 'marvioleta02@hotmail.com', '$2y$10$1z7mVHNZ4oze0etv/jUXk.OKpkY.R2sq4uRiyp5OPaHm6b4XyKDt2', 4, '65.002.737-k', '5265', 1),
('14342187-2', NULL, 'Carolina Vergara Inostroza', 'sep_cadpu@asach.cl', '$2y$10$1z7mVHNZ4oze0etv/jUXk.OKpkY.R2sq4uRiyp5OPaHm6b4XyKDt2', 4, '65.002.737-k', '22019', 1),
('14543631-1', NULL, 'Mauricio Rojas', 'maurcio.rojas2@educacionadventista.cl', '$2y$10$d8ifqPf2UqWS99BJWCswfOwJ5Ud0zqW/QOMXs2jhtFSu3OdGs.tN2', 2, '65.002.737-k', '1', 1),
('15216080-1', NULL, 'AnÃ­bal Albornoz Carrasco', 'director.coadpa@educacionadventista.cl', '$2y$10$1z7mVHNZ4oze0etv/jUXk.OKpkY.R2sq4uRiyp5OPaHm6b4XyKDt2', 5, '65.002.737-k', '11678', 1),
('15254772-2', NULL, 'FabiÃ¡n Eduardo Burgos Fuentes', 'coordinadorsep.cadvi@educacionadventista.cl', '$2y$10$1z7mVHNZ4oze0etv/jUXk.OKpkY.R2sq4uRiyp5OPaHm6b4XyKDt2', 4, '65.002.737-k', '6122', 1),
('15502744-4', NULL, 'Ã‘anco Bodaleo Huenulaf', 'director.coadpu@educacionadventista.cl', '$2y$10$1z7mVHNZ4oze0etv/jUXk.OKpkY.R2sq4uRiyp5OPaHm6b4XyKDt2', 5, '65.002.737-k', '22019', 1),
('17230087-k', NULL, 'Revisor', 'revisor.asach@educacionadventista.cl', '$2y$10$1z7mVHNZ4oze0etv/jUXk.OKpkY.R2sq4uRiyp5OPaHm6b4XyKDt2', 8, '65.002.737-k', '1', 1),
('17252876-7', NULL, 'Jonathan LoncÃ³n', 'jonathan.loncon@adventistas.org', '$2y$10$1z7mVHNZ4oze0etv/jUXk.OKpkY.R2sq4uRiyp5OPaHm6b4XyKDt2', 3, '65.002.737-k', '1', 1),
('19762285-7', NULL, 'Alexi Gonzalez Coloma', 'alexi.gonzalez@adventistas.org', '$2y$10$0FlXAAn/jmYNTxhb4OkI5OBkK.tRxZ3WP.GJQZgQdjEtE.6Dpr5y6', 4, '65.002.737-k', '1', 1),
('8063882-5', NULL, 'Jeanete Baier', 'secretaria.asach@educacionadventista.cl', '$2y$10$VbF4byzGZNDklZST241f6OlnchAR1VOHVVcpd4TFBhp/peRfV5zp6', 9, '65.002.737-k', '1', 1),
('8235576-6', NULL, 'Patricio Alfredo Valencia Toro', 'pavalto17@hotmail.com', '$2y$10$1z7mVHNZ4oze0etv/jUXk.OKpkY.R2sq4uRiyp5OPaHm6b4XyKDt2', 5, '65.002.737-k', '5265', 1),
('8922461-6', NULL, 'CÃ©sar Beroiza Beroiza', 'director.cadvi@educacionadventista.cl', '$2y$10$1z7mVHNZ4oze0etv/jUXk.OKpkY.R2sq4uRiyp5OPaHm6b4XyKDt2', 5, '65.002.737-k', '6122', 1),
('9052546-8', NULL, 'Jorge Suarez', 'jsuarez_b@yahoo.com', '$2y$10$1z7mVHNZ4oze0etv/jUXk.OKpkY.R2sq4uRiyp5OPaHm6b4XyKDt2', 5, '65.002.737-k', '6835', 1),
('9800914-0', NULL, 'Hugo Wilfred Cameron GarcÃ­a', 'director.coadte@educacionadventista.cl', '$2y$10$1z7mVHNZ4oze0etv/jUXk.OKpkY.R2sq4uRiyp5OPaHm6b4XyKDt2', 5, '65.002.737-k', '5651', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votos_aprobacion`
--

CREATE TABLE `votos_aprobacion` (
  `id` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `id_comision` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones_pme`
--
ALTER TABLE `acciones_pme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_subdimension` (`id_subdimension`),
  ADD KEY `rbd_colegio` (`rbd_colegio`);

--
-- Indices de la tabla `adjuntos`
--
ALTER TABLE `adjuntos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_movimiento` (`id_movimiento`),
  ADD KEY `id_solicitud` (`id_solicitud`);

--
-- Indices de la tabla `colegios`
--
ALTER TABLE `colegios`
  ADD PRIMARY KEY (`rbd`),
  ADD KEY `rut_fundacion` (`rut_fundacion`);

--
-- Indices de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `desiciones_comisiones`
--
ALTER TABLE `desiciones_comisiones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitud` (`id_solicitud`),
  ADD KEY `id_comision` (`id_comision`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `rbd_colegio` (`rbd_colegio`);

--
-- Indices de la tabla `dimesiones_gestion`
--
ALTER TABLE `dimesiones_gestion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fundaciones`
--
ALTER TABLE `fundaciones`
  ADD PRIMARY KEY (`rut`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitud` (`id_solicitud`),
  ADD KEY `id_rol_usuario` (`id_rol_usuario`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitud` (`id_solicitud`),
  ADD KEY `id_destinatario` (`id_destinatario`),
  ADD KEY `rbd_colegio` (`rbd_colegio`);

--
-- Indices de la tabla `pme_solicitudes`
--
ALTER TABLE `pme_solicitudes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_subvencion` (`id_subvencion`),
  ADD KEY `id_dimension` (`id_dimension`),
  ADD KEY `id_subdimension` (`id_subdimension`),
  ADD KEY `id_accion` (`id_accion`);

--
-- Indices de la tabla `presupuestos_colegios`
--
ALTER TABLE `presupuestos_colegios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rbd_colegio` (`rbd_colegio`);

--
-- Indices de la tabla `presupuestos_subvenciones`
--
ALTER TABLE `presupuestos_subvenciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_subvencion` (`id_subvencion`);

--
-- Indices de la tabla `profesionales_contratables`
--
ALTER TABLE `profesionales_contratables`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `requerimientos`
--
ALTER TABLE `requerimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitud` (`id_solicitud`),
  ADD KEY `id_subvencion` (`id_subvencion`),
  ADD KEY `id_profesional_contratado` (`id_profesional_contratado`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rut_creador` (`rut_creador`),
  ADD KEY `rbd_colegio` (`rbd_colegio`),
  ADD KEY `id_estado_actual` (`id_estado_actual`);

--
-- Indices de la tabla `subdimensiones_gestion`
--
ALTER TABLE `subdimensiones_gestion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dimension` (`id_dimension`);

--
-- Indices de la tabla `subvenciones`
--
ALTER TABLE `subvenciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`rut`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `rut_fundacion` (`rut_fundacion`),
  ADD KEY `rbd_colegio` (`rbd_colegio`);

--
-- Indices de la tabla `votos_aprobacion`
--
ALTER TABLE `votos_aprobacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitud` (`id_solicitud`),
  ADD KEY `id_comision` (`id_comision`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acciones_pme`
--
ALTER TABLE `acciones_pme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `adjuntos`
--
ALTER TABLE `adjuntos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `desiciones_comisiones`
--
ALTER TABLE `desiciones_comisiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=337;

--
-- AUTO_INCREMENT de la tabla `pme_solicitudes`
--
ALTER TABLE `pme_solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `presupuestos_colegios`
--
ALTER TABLE `presupuestos_colegios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `presupuestos_subvenciones`
--
ALTER TABLE `presupuestos_subvenciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `profesionales_contratables`
--
ALTER TABLE `profesionales_contratables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `requerimientos`
--
ALTER TABLE `requerimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `subdimensiones_gestion`
--
ALTER TABLE `subdimensiones_gestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `subvenciones`
--
ALTER TABLE `subvenciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `votos_aprobacion`
--
ALTER TABLE `votos_aprobacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acciones_pme`
--
ALTER TABLE `acciones_pme`
  ADD CONSTRAINT `acciones_pme_ibfk_1` FOREIGN KEY (`id_subdimension`) REFERENCES `subdimensiones_gestion` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `acciones_pme_ibfk_2` FOREIGN KEY (`rbd_colegio`) REFERENCES `colegios` (`rbd`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `adjuntos`
--
ALTER TABLE `adjuntos`
  ADD CONSTRAINT `adjuntos_ibfk_2` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitudes` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `colegios`
--
ALTER TABLE `colegios`
  ADD CONSTRAINT `colegios_ibfk_1` FOREIGN KEY (`rut_fundacion`) REFERENCES `fundaciones` (`rut`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `desiciones_comisiones`
--
ALTER TABLE `desiciones_comisiones`
  ADD CONSTRAINT `desiciones_comisiones_ibfk_1` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitudes` (`id`),
  ADD CONSTRAINT `desiciones_comisiones_ibfk_2` FOREIGN KEY (`id_comision`) REFERENCES `comisiones` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `desiciones_comisiones_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `desiciones_comisiones_ibfk_4` FOREIGN KEY (`rbd_colegio`) REFERENCES `colegios` (`rbd`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitudes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `movimientos_ibfk_2` FOREIGN KEY (`id_rol_usuario`) REFERENCES `roles` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `movimientos_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitudes` (`id`),
  ADD CONSTRAINT `notificaciones_ibfk_2` FOREIGN KEY (`id_destinatario`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `notificaciones_ibfk_3` FOREIGN KEY (`rbd_colegio`) REFERENCES `colegios` (`rbd`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pme_solicitudes`
--
ALTER TABLE `pme_solicitudes`
  ADD CONSTRAINT `pme_solicitudes_ibfk_1` FOREIGN KEY (`id_subvencion`) REFERENCES `subvenciones` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pme_solicitudes_ibfk_2` FOREIGN KEY (`id_dimension`) REFERENCES `dimesiones_gestion` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pme_solicitudes_ibfk_3` FOREIGN KEY (`id_subdimension`) REFERENCES `subdimensiones_gestion` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pme_solicitudes_ibfk_4` FOREIGN KEY (`id_accion`) REFERENCES `acciones_pme` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `presupuestos_colegios`
--
ALTER TABLE `presupuestos_colegios`
  ADD CONSTRAINT `presupuestos_colegios_ibfk_1` FOREIGN KEY (`rbd_colegio`) REFERENCES `colegios` (`rbd`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `presupuestos_subvenciones`
--
ALTER TABLE `presupuestos_subvenciones`
  ADD CONSTRAINT `presupuestos_subvenciones_ibfk_1` FOREIGN KEY (`id_subvencion`) REFERENCES `subvenciones` (`id`);

--
-- Filtros para la tabla `requerimientos`
--
ALTER TABLE `requerimientos`
  ADD CONSTRAINT `requerimientos_ibfk_1` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitudes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `requerimientos_ibfk_2` FOREIGN KEY (`id_subvencion`) REFERENCES `subvenciones` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `requerimientos_ibfk_3` FOREIGN KEY (`id_profesional_contratado`) REFERENCES `profesionales_contratables` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_2` FOREIGN KEY (`rut_creador`) REFERENCES `usuarios` (`rut`) ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitudes_ibfk_3` FOREIGN KEY (`rbd_colegio`) REFERENCES `colegios` (`rbd`) ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitudes_ibfk_4` FOREIGN KEY (`id_estado_actual`) REFERENCES `estados` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `subdimensiones_gestion`
--
ALTER TABLE `subdimensiones_gestion`
  ADD CONSTRAINT `subdimensiones_gestion_ibfk_1` FOREIGN KEY (`id_dimension`) REFERENCES `dimesiones_gestion` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`rut_fundacion`) REFERENCES `fundaciones` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_4` FOREIGN KEY (`rbd_colegio`) REFERENCES `colegios` (`rbd`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `votos_aprobacion`
--
ALTER TABLE `votos_aprobacion`
  ADD CONSTRAINT `votos_aprobacion_ibfk_1` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitudes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `votos_aprobacion_ibfk_2` FOREIGN KEY (`id_comision`) REFERENCES `comisiones` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
