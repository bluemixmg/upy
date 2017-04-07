--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.2
-- Dumped by pg_dump version 9.6.2

-- Started on 2017-03-30 00:28:38

--
-- TOC entry 186 (class 1259 OID 16509)
-- Name: bloque; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE bloque (
    id integer NOT NULL,
    descripcion character varying(30),
    hora_inicio time without time zone,
    hora_fin time without time zone
);

--
-- TOC entry 185 (class 1259 OID 16507)
-- Name: bloque_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE bloque_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2359 (class 0 OID 0)
-- Dependencies: 185
-- Name: bloque_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE bloque_id_seq OWNED BY bloque.id;


--
-- TOC entry 187 (class 1259 OID 16513)
-- Name: chofer; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE chofer (
    id_cedula integer NOT NULL,
    nombre character varying(20) NOT NULL,
    apellido character varying(20) NOT NULL,
    sexo character(1) NOT NULL,
    correo character varying(40),
    id_estado integer,
    direccion character varying(200) NOT NULL,
    telefono character varying(14) NOT NULL,
    id_usuario character varying(20),
    latitud character varying(30),
    longitud character varying(30),
    estatus integer DEFAULT 1 NOT NULL
);


--
-- TOC entry 188 (class 1259 OID 16517)
-- Name: cliente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE cliente (
    cedula character varying(10) NOT NULL,
    rif_empresa character varying(20),
    nombre character varying(40),
    apellido character varying(20),
    sexo character(1),
    direccion character varying(200),
    latitud character varying(30),
    longitud character varying(30),
    correo character varying(30),
    telefono character varying(16),
    estatus integer DEFAULT 1
);


--
-- TOC entry 190 (class 1259 OID 16523)
-- Name: condicion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE condicion (
    id integer NOT NULL,
    descripcion character varying(20)
);


--
-- TOC entry 189 (class 1259 OID 16521)
-- Name: condicion_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE condicion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2360 (class 0 OID 0)
-- Dependencies: 189
-- Name: condicion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE condicion_id_seq OWNED BY condicion.id;


--
-- TOC entry 192 (class 1259 OID 16529)
-- Name: disponibilidad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE disponibilidad (
    id integer NOT NULL,
    id_usuario character varying(20),
    id_bloque integer,
    fecha date
);


--
-- TOC entry 191 (class 1259 OID 16527)
-- Name: disponibilidad_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE disponibilidad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2361 (class 0 OID 0)
-- Dependencies: 191
-- Name: disponibilidad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE disponibilidad_id_seq OWNED BY disponibilidad.id;


--
-- TOC entry 193 (class 1259 OID 16533)
-- Name: empresa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE empresa (
    rif character varying(15) NOT NULL,
    nombre character varying(40),
    id_estado integer DEFAULT 13,
    direccion character varying(200),
    latitud character varying(50),
    longitud character varying(50),
    correo character varying(40),
    telefono character varying(14),
    estatus integer DEFAULT 1
);


--
-- TOC entry 195 (class 1259 OID 16540)
-- Name: estado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE estado (
    id integer NOT NULL,
    id_pais bigint NOT NULL,
    nombre_estado character varying(20) NOT NULL
);


--
-- TOC entry 194 (class 1259 OID 16538)
-- Name: estado_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE estado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2362 (class 0 OID 0)
-- Dependencies: 194
-- Name: estado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE estado_id_seq OWNED BY estado.id;


--
-- TOC entry 197 (class 1259 OID 16546)
-- Name: incidencia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE incidencia (
    id integer NOT NULL,
    id_tipo_incidencia integer,
    id_usuario character varying(20),
    id_cliente integer,
    fecha date,
    hora time without time zone DEFAULT '00:00:00'::time without time zone,
    revisado integer DEFAULT 0
);


--
-- TOC entry 196 (class 1259 OID 16544)
-- Name: incidencia_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE incidencia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2363 (class 0 OID 0)
-- Dependencies: 196
-- Name: incidencia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE incidencia_id_seq OWNED BY incidencia.id;


--
-- TOC entry 199 (class 1259 OID 16554)
-- Name: noticia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE noticia (
    id integer NOT NULL,
    titulo character varying(140),
    texto text,
    ruta_imagen character varying(150) NOT NULL,
    fecha date
);


--
-- TOC entry 198 (class 1259 OID 16552)
-- Name: noticia_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE noticia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2364 (class 0 OID 0)
-- Dependencies: 198
-- Name: noticia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE noticia_id_seq OWNED BY noticia.id;


--
-- TOC entry 201 (class 1259 OID 16563)
-- Name: pais; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pais (
    id bigint NOT NULL,
    nombre character varying(20) NOT NULL
);


--
-- TOC entry 200 (class 1259 OID 16561)
-- Name: pais_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pais_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2365 (class 0 OID 0)
-- Dependencies: 200
-- Name: pais_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pais_id_seq OWNED BY pais.id;


--
-- TOC entry 203 (class 1259 OID 16569)
-- Name: parada; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE parada (
    id integer NOT NULL,
    lat_o character varying(30),
    lng_o character varying(30),
    lat_d character varying(30),
    lng_d character varying(30),
    id_cliente character varying(20),
    hora time without time zone
);


--
-- TOC entry 202 (class 1259 OID 16567)
-- Name: parada_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE parada_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2366 (class 0 OID 0)
-- Dependencies: 202
-- Name: parada_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE parada_id_seq OWNED BY parada.id;


--
-- TOC entry 205 (class 1259 OID 16575)
-- Name: parada_ruta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE parada_ruta (
    id integer NOT NULL,
    id_ruta integer,
    id_parada integer,
    estatus integer DEFAULT 1
);


--
-- TOC entry 204 (class 1259 OID 16573)
-- Name: parada_ruta_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE parada_ruta_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2367 (class 0 OID 0)
-- Dependencies: 204
-- Name: parada_ruta_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE parada_ruta_id_seq OWNED BY parada_ruta.id;


--
-- TOC entry 207 (class 1259 OID 16582)
-- Name: permiso; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE permiso (
    id integer NOT NULL,
    nombre character varying(50)
);


--
-- TOC entry 206 (class 1259 OID 16580)
-- Name: permiso_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE permiso_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2368 (class 0 OID 0)
-- Dependencies: 206
-- Name: permiso_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE permiso_id_seq OWNED BY permiso.id;


--
-- TOC entry 209 (class 1259 OID 16588)
-- Name: permiso_rol; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE permiso_rol (
    id integer NOT NULL,
    id_rol integer,
    id_permiso integer
);


--
-- TOC entry 208 (class 1259 OID 16586)
-- Name: permiso_rol_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE permiso_rol_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2369 (class 0 OID 0)
-- Dependencies: 208
-- Name: permiso_rol_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE permiso_rol_id_seq OWNED BY permiso_rol.id;


--
-- TOC entry 211 (class 1259 OID 16594)
-- Name: rol; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE rol (
    id integer NOT NULL,
    nombre character varying(40)
);


--
-- TOC entry 210 (class 1259 OID 16592)
-- Name: rol_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE rol_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2370 (class 0 OID 0)
-- Dependencies: 210
-- Name: rol_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE rol_id_seq OWNED BY rol.id;


--
-- TOC entry 213 (class 1259 OID 16600)
-- Name: ruta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE ruta (
    id integer NOT NULL,
    id_vehiculo character varying(10),
    fecha date,
    estatus integer DEFAULT 0,
    id_tipo_ruta integer DEFAULT 1,
    costo integer DEFAULT 0,
    precio integer DEFAULT 0,
    aceptacion integer DEFAULT 0 NOT NULL
);


--
-- TOC entry 212 (class 1259 OID 16598)
-- Name: ruta_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ruta_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2371 (class 0 OID 0)
-- Dependencies: 212
-- Name: ruta_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ruta_id_seq OWNED BY ruta.id;


--
-- TOC entry 215 (class 1259 OID 16611)
-- Name: ruta_rechazada; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE ruta_rechazada (
    id integer NOT NULL,
    id_ruta integer NOT NULL,
    id_placa character varying(10) NOT NULL,
    fecha date NOT NULL,
    hora time without time zone NOT NULL
);


--
-- TOC entry 214 (class 1259 OID 16609)
-- Name: ruta_rechazada_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ruta_rechazada_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2372 (class 0 OID 0)
-- Dependencies: 214
-- Name: ruta_rechazada_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ruta_rechazada_id_seq OWNED BY ruta_rechazada.id;


--
-- TOC entry 217 (class 1259 OID 16617)
-- Name: tipo_incidencia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tipo_incidencia (
    id integer NOT NULL,
    nombre character varying(20)
);


--
-- TOC entry 216 (class 1259 OID 16615)
-- Name: tipo_incidencia_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tipo_incidencia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2373 (class 0 OID 0)
-- Dependencies: 216
-- Name: tipo_incidencia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tipo_incidencia_id_seq OWNED BY tipo_incidencia.id;


--
-- TOC entry 219 (class 1259 OID 16623)
-- Name: tipo_ruta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tipo_ruta (
    id integer NOT NULL,
    descripcion character varying(40),
    costo integer,
    precio integer,
    estatus integer DEFAULT 1 NOT NULL
);


--
-- TOC entry 218 (class 1259 OID 16621)
-- Name: tipo_ruta_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tipo_ruta_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2374 (class 0 OID 0)
-- Dependencies: 218
-- Name: tipo_ruta_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tipo_ruta_id_seq OWNED BY tipo_ruta.id;


--
-- TOC entry 221 (class 1259 OID 16630)
-- Name: tipo_vehiculo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tipo_vehiculo (
    id integer NOT NULL,
    nombre character varying(20),
    nro_puestos integer DEFAULT 1,
    costo integer DEFAULT 0,
    precio integer,
    estatus integer DEFAULT 1 NOT NULL
);


--
-- TOC entry 220 (class 1259 OID 16628)
-- Name: tipo_vehiculo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tipo_vehiculo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2375 (class 0 OID 0)
-- Dependencies: 220
-- Name: tipo_vehiculo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tipo_vehiculo_id_seq OWNED BY tipo_vehiculo.id;


--
-- TOC entry 222 (class 1259 OID 16637)
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE usuario (
    usuario character varying(30) NOT NULL,
    contrasena character varying(40) NOT NULL,
    id_rol integer NOT NULL,
    rif_empresa character varying(20)
);


--
-- TOC entry 223 (class 1259 OID 16640)
-- Name: vehiculo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE vehiculo (
    placa character varying(10) NOT NULL,
    marca character varying(20),
    modelo character varying(20),
    id_tipo_vehiculo integer,
    id_condicion integer,
    id_chofer integer
);


--
-- TOC entry 2118 (class 2604 OID 16512)
-- Name: bloque id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY bloque ALTER COLUMN id SET DEFAULT nextval('bloque_id_seq'::regclass);


--
-- TOC entry 2121 (class 2604 OID 16526)
-- Name: condicion id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY condicion ALTER COLUMN id SET DEFAULT nextval('condicion_id_seq'::regclass);


--
-- TOC entry 2122 (class 2604 OID 16532)
-- Name: disponibilidad id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY disponibilidad ALTER COLUMN id SET DEFAULT nextval('disponibilidad_id_seq'::regclass);


--
-- TOC entry 2125 (class 2604 OID 16543)
-- Name: estado id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estado ALTER COLUMN id SET DEFAULT nextval('estado_id_seq'::regclass);


--
-- TOC entry 2126 (class 2604 OID 16549)
-- Name: incidencia id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY incidencia ALTER COLUMN id SET DEFAULT nextval('incidencia_id_seq'::regclass);


--
-- TOC entry 2129 (class 2604 OID 16557)
-- Name: noticia id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY noticia ALTER COLUMN id SET DEFAULT nextval('noticia_id_seq'::regclass);


--
-- TOC entry 2130 (class 2604 OID 16566)
-- Name: pais id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pais ALTER COLUMN id SET DEFAULT nextval('pais_id_seq'::regclass);


--
-- TOC entry 2131 (class 2604 OID 16572)
-- Name: parada id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY parada ALTER COLUMN id SET DEFAULT nextval('parada_id_seq'::regclass);


--
-- TOC entry 2132 (class 2604 OID 16578)
-- Name: parada_ruta id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY parada_ruta ALTER COLUMN id SET DEFAULT nextval('parada_ruta_id_seq'::regclass);


--
-- TOC entry 2134 (class 2604 OID 16585)
-- Name: permiso id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY permiso ALTER COLUMN id SET DEFAULT nextval('permiso_id_seq'::regclass);


--
-- TOC entry 2135 (class 2604 OID 16591)
-- Name: permiso_rol id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY permiso_rol ALTER COLUMN id SET DEFAULT nextval('permiso_rol_id_seq'::regclass);


--
-- TOC entry 2136 (class 2604 OID 16597)
-- Name: rol id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rol ALTER COLUMN id SET DEFAULT nextval('rol_id_seq'::regclass);


--
-- TOC entry 2137 (class 2604 OID 16603)
-- Name: ruta id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ruta ALTER COLUMN id SET DEFAULT nextval('ruta_id_seq'::regclass);


--
-- TOC entry 2143 (class 2604 OID 16614)
-- Name: ruta_rechazada id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ruta_rechazada ALTER COLUMN id SET DEFAULT nextval('ruta_rechazada_id_seq'::regclass);


--
-- TOC entry 2144 (class 2604 OID 16620)
-- Name: tipo_incidencia id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_incidencia ALTER COLUMN id SET DEFAULT nextval('tipo_incidencia_id_seq'::regclass);


--
-- TOC entry 2145 (class 2604 OID 16626)
-- Name: tipo_ruta id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_ruta ALTER COLUMN id SET DEFAULT nextval('tipo_ruta_id_seq'::regclass);


--
-- TOC entry 2147 (class 2604 OID 16633)
-- Name: tipo_vehiculo id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_vehiculo ALTER COLUMN id SET DEFAULT nextval('tipo_vehiculo_id_seq'::regclass);


--
-- TOC entry 2314 (class 0 OID 16509)
-- Dependencies: 186
-- Data for Name: bloque; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO bloque VALUES (0, 'Ninguna', NULL, NULL);
INSERT INTO bloque VALUES (1, 'Bloque A  12am - 6am', '00:00:00', '05:59:59');
INSERT INTO bloque VALUES (2, 'Bloque B   6am - 12pm', '06:00:00', '11:59:59');
INSERT INTO bloque VALUES (3, 'Bloque C  12pm - 6pm', '12:00:00', '17:59:59');
INSERT INTO bloque VALUES (4, 'Bloque D  6pm - 12am', '18:00:00', '23:59:59');


--
-- TOC entry 2376 (class 0 OID 0)
-- Dependencies: 185
-- Name: bloque_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('bloque_id_seq', 5, false);


--
-- TOC entry 2315 (class 0 OID 16513)
-- Dependencies: 187
-- Data for Name: chofer; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO chofer VALUES (8, 'adrian', 'ochoa', 'M', 'adriochoa02@gmail.com', NULL, 'patarataI bloque 8 entrada B apto B-14', '* TRIAL * T', 'adrianochoa123', NULL, NULL, 1);
INSERT INTO chofer VALUES (35, 'wilder', 'yepez', 'M', 'wilder.yepez1981@gmail.com', NULL, '* TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * T', '04245825653', 'wyepez123', NULL, NULL, 1);
INSERT INTO chofer VALUES (38, 'jonathan', 'campos', 'M', 'jonathancampos351@gmail.com', NULL, '* TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRI', '* TRIAL * T', NULL, NULL, NULL, 0);
INSERT INTO chofer VALUES (56, 'Ramon', 'Prueba', 'M', 'rp@gmail.com', 13, 'Barquisimeto', '* TRIAL * T', 'n80', '10.0337967', '* TRIAL * T', 1);
INSERT INTO chofer VALUES (8080, 'Louis', 'Perdomo', 'M', 'louis.perdomo89@gmail.com', 13, 'Barquisimeto', '* TRIAL * T', 'rx23', '* TRIAL * ', '* TRIAL * T', 1);
INSERT INTO chofer VALUES (7312051, 'Nelson ', 'Vieti', 'M', 'ngvv555@hotmail.com', 13, '* TRIAL * TRIAL * TRIAL * TRIAL * TRIAL ', '* TRIAL * T', 'LA006', '10.0717669', '-69.3189959', 1);
INSERT INTO chofer VALUES (7381920, 'REMI', 'GIMENEZ', 'M', 'REMIGIMENEZ1965@gmail.com', NULL, 'SAN JOSE CARRERA 12 ENTRE 7 Y 8', '0414-5261480', 'LA021', NULL, NULL, 1);
INSERT INTO chofer VALUES (7414004, 'Gustavo ', 'Giménez ', 'M', 'gustavogimenez1509@hotmail.com', 13, '* TRIAL * TR', '04145208681', 'LA005', '* TRIAL * ', '* TRIAL * T', 1);
INSERT INTO chofer VALUES (7424311, 'Giovanny Pastor', 'Alfin Carmona', 'M', 'alfinyiova@@hotmail.com', 13, 'Calle 7 av. La mata', '* TRIAL * T', 'LA004', '* TRIAL * ', '* TRIAL * T', 1);
INSERT INTO chofer VALUES (8519071, 'NORAYDA CRISTINA', 'GARCIA DE NEUMANN', 'F', '* TRIAL * TRIAL ', NULL, 'URB LA ROSALEDA. CALLE 2. CONJ RESD FLAMINGO SUITE. N 58. BARQUISIMETO.', '04166545094', 'LA047', NULL, NULL, 1);
INSERT INTO chofer VALUES (9613687, '* TRIAL * TRI', 'BASTIDAS ALEJO', 'F', 'brayan.ucla@gmail.com', NULL, 'VILLA CREPUSCULAR. CALLE 3. CASA N B-18.', '04245473660', 'LA032', NULL, NULL, 1);
INSERT INTO chofer VALUES (9628219, '* TRIAL * ', 'Yustiz Rodriguez', 'M', 'jorgeyustiz@gmail.com', NULL, 'Carrera 33 entre calles 29 y 30 ', '04268388953', 'LA030', NULL, NULL, 1);
INSERT INTO chofer VALUES (10774782, 'Heyner', 'Sánchez', 'M', 'heynersan@hotmail.com', NULL, '* TRIAL * ', '04145282198', 'LA098', '10.0717164', '-69.3188562', 2);
INSERT INTO chofer VALUES (11269901, 'Helyver', 'Sanchez', 'M', 'operacione@serviciologico.com.ve', 13, 'Ruezga Sur Sector 6 Av 1 casa n 16', '04245512903', 'LA099', '10.0620114', '-69.3527123', 1);
INSERT INTO chofer VALUES (12250521, 'Manuel', 'García', 'M', '* TRIAL * TRIAL * TRIAL ', NULL, 'urb RÃ³mulo Betancourt Av. RÃ­o Claro entre calles 2 y 4 NÂ° 25 El CujÃ­', '04265521075', 'LA045', NULL, NULL, 1);
INSERT INTO chofer VALUES (13990402, 'Angel R', 'Crespo', 'M', 'angel_crespo1@hotmail.com', 13, 'Los Crepusculos', '04164513612', 'LA007', '10.0888888', '-69.3603644', 1);
INSERT INTO chofer VALUES (15777094, 'Helyver', 'Sanchez', 'M', 'helyver19@gmail.com', 13, '* TRIAL * TRIAL * TRIAL * TRIAL * TRIAL *', '04245512903', 'helyver19', '10.0717669', '-69.3189959', 2);
INSERT INTO chofer VALUES (17378444, 'Gianina', 'Méndez', 'F', 'gimendezp@gmail.com', 13, 'Barquisimeto', '04126799979', 'LA002', '10.0870294', '-69.3632251', 1);
INSERT INTO chofer VALUES (18493162, 'Josyvel', 'Azuaje', 'F', 'josyvelazuaje@hotmail.com', 13, 'Urb. Piedras blancas calle 3 entre 3 y 4 casa #07 Barquisimeto Estado Lara', '04145695271', 'LA003', '* TRIAL * ', '-69.2809089', 1);
INSERT INTO chofer VALUES (18863751, 'Leonardo', 'Vieti', 'M', 'leo_vietinavarro@hotmail.com', NULL, 'Calle Vicente Amengual entre Alvizu y Juarez 29-85 Cabudare', '04145131269', 'LA016', NULL, NULL, 1);
INSERT INTO chofer VALUES (19263411, 'luis', 'valor', 'M', 'luism_v89@hotmail.com', NULL, 'Barquisimeto', '04145113211', 'LA048', NULL, NULL, 1);
INSERT INTO chofer VALUES (19780290, 'arquimedez', 'gonzalez corrales', 'M', 'arquimedez.gon@gmail.com', 13, '* TRIAL * TR', '04245947073', 'LA001', '10.0635787', '-69.3332401', 1);
INSERT INTO chofer VALUES (19828251, 'John', 'Bravo', 'M', 'Johander_86@hotmail.com', NULL, '* TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIAL', '0426-7577100', '19828251', NULL, NULL, 1);
INSERT INTO chofer VALUES (20928223, 'Oscar', '* TRIAL *', 'M', 'oscargutierrez1980@gmail.com', NULL, 'Barquisimeto', '04145536740', 'oscargutierrez1980', NULL, NULL, 1);
INSERT INTO chofer VALUES (21299783, '* TRIAL * TRI', '* TRIAL * TR', 'M', '* TRIAL * TRIAL * TRIAL ', NULL, 'ruezga norte sector 2 vereda 26 # 03', '04245011095', 'LA009', NULL, NULL, 1);


--
-- TOC entry 2316 (class 0 OID 16517)
-- Dependencies: 188
-- Data for Name: cliente; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO cliente VALUES ('1233', 'V-20', 'Alexa', 'Campos', 'F', '* TRIAL * TR', '10.0677719', '-69.34735089999998', '* TRIAL * TR', '04168536974', 1);
INSERT INTO cliente VALUES ('15263382', 'J315678900', 'Maria', 'Rodriguez', 'F', 'URB. EL AMANECER 2. CABUDARE', '10.026107547268847', '* TRIAL * TRIAL * ', '', '* TRIAL * TR', 1);
INSERT INTO cliente VALUES ('20349310', 'J315678900', 'Andreina', 'Hernandez', 'F', '* TRIAL * TRIAL * TRIAL * TRIAL *', '10.05897418903881', '-69.34427782316891', '* TRIAL * TRIAL * TRIAL * TRI', '* TRIAL * TR', 1);
INSERT INTO cliente VALUES ('15306717', 'J315678900', 'Luis', 'Alvarado', 'M', '* TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIA', '* TRIAL * ', '* TRIAL * T', 'tumedico.lalvarado@gmail.com', '* TRIAL * TR', 1);
INSERT INTO cliente VALUES ('15597540', '* TRIAL * ', 'Andres', 'Guedez', 'M', 'carrera 25 entre 27 y 28 Barquisimeto', '10.071782844498', '-69.31898894774679', 'tumedico.aguedez@gmail.com', '0416-4586692', 1);
INSERT INTO cliente VALUES ('21503702', '* TRIAL * ', 'Yanith', 'Llovera', 'F', 'CALLE 12 C LA FERIA CASA R 142 BARQUISIMETO', '10.062933721264683', '-69.30310518009031', 'tumedico.yllovera@gmail.com', '0412-6734385', 1);
INSERT INTO cliente VALUES ('14094346', '* TRIAL * ', 'Anyi', 'Lozada', 'F', 'URB. EL TRIGAL MANZANA 4 CALLE 4 NRO. 9D-23 - CABUDARE', '* TRIAL * TRIAL * ', '-69.23712343322143', 'tumedico.alozada@gmail.com', '* TRIAL * TR', 1);
INSERT INTO cliente VALUES ('14093857', 'J315678900', 'Neiva', 'Lemoine', 'F', 'URB. DIVINA PASTORA CALLE 2 ENTRE AV. SAN ANTONIO Y VEREDA 4 - CABUDARE', '10.029868662207159', '-69.25006240950927', '* TRIAL * TRIAL * TRIAL * T', '0416-3522056', 1);
INSERT INTO cliente VALUES ('21048192', 'J315678900', 'Gabriela', 'Ruiz', 'F', 'CARRERA 25 ENTRE 27 Y 28 BARQUISIMETO', '10.0717617175', '-69.319058685181', '* TRIAL * TRIAL * TRIAL ', '0424-5673144', 1);
INSERT INTO cliente VALUES ('19166121', 'J315678900', 'Flor', 'Mendoza', 'F', '* TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TR', '10.062918417626355', '-69.30257097116385', '* TRIAL * TRIAL * TRIAL * T', '* TRIAL * TR', 1);
INSERT INTO cliente VALUES ('10738622', 'J315678900', 'Ana', 'Palacios', 'F', 'URB JOSE GIL FORTOUL CALLE 2 ENTRE VEREDAS 1 Y 2 CASA NUMERO 5 BARQUISIMETO', '10.085042972367024', '* TRIAL * TRIAL * ', '* TRIAL * TRIAL * TRIAL * TR', '0424-5522364', 1);
INSERT INTO cliente VALUES ('12852967', '* TRIAL * ', 'Carlos', 'Delsi', 'M', 'URB. PIEDRAS BLANCAS CALLE GIRASOL CON VEREDA 7 CASA NUM 5 BARQUISIMETO', '* TRIAL * TRIAL ', '-69.38214451534117', 'tumedico.cdelsi@gmail.com', '* TRIAL * TR', 1);
INSERT INTO cliente VALUES ('22189564', 'J315678900', 'Aleison', 'Linarez', 'M', '* TRIAL * TRIAL * TRIAL * TRIAL * TRI', NULL, NULL, '* TRIAL * TRIAL * TRIAL * T', '0416-4531810', 1);
INSERT INTO cliente VALUES ('12018750', 'J315678900', '* TRIAL * ', 'Carrillo', 'M', '* TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIA', NULL, NULL, '* TRIAL * TRIAL * TRIAL * TR', '0416-1230575', 1);
INSERT INTO cliente VALUES ('15446738', 'J315678900', 'Rafael', 'Rojas', 'M', 'URB. EL TRIGAL CABUDARES. TRANSVERSAL 6 CON CALLE 5 NRO 16D13', NULL, NULL, '* TRIAL * TRIAL * TRIAL *', '0426-1075288', 1);
INSERT INTO cliente VALUES ('16033907', '* TRIAL * ', 'Maria', 'Vargas', 'F', 'CARRERA 12 ENTRE 7B Y 8 URB BOLIVAR', '10.08969800109257', '-69.32103094377442', '', '', 1);
INSERT INTO cliente VALUES ('3323354', '17196447', 'Fabian', 'Sanchez', 'M', '* TRIAL * TRIAL * TRIAL * TRIAL * TR', '10.071815100769118', '-69.31746146871717', 'Email', 'TelÃ©fono', 1);
INSERT INTO cliente VALUES ('502877', 'V-20', 'Juan', 'Labrador', 'M', 'Barquisimeto', '10.0906202218798', '-69.33983535034025', 'jl@hotmail.com', '02512532066', 1);
INSERT INTO cliente VALUES ('30', '420', 'Prueba3', 'Usuario', 'M', 'Barquisimeto', '10.0677719', '-69.34735089999998', 'pu3@gmail.com', '04145623489', 1);
INSERT INTO cliente VALUES ('67', '4545', 'Prueba', 'Usuario2', 'M', 'Barquisimeto', '10.089320984884397', '* TRIAL * TRIAL * ', '* TRIAL * TRI', '04145671212', 1);
INSERT INTO cliente VALUES ('34788', 'V-20', 'Ramon', 'Guedez', 'M', 'Barquisimeto', '10.06301823155916', '-69.29402858478392', 'rg@gmail.com', '* TRIAL * T', 1);
INSERT INTO cliente VALUES ('3471', 'V-20', 'Haydee', 'Quesedo', 'F', 'Carora', '* TRIAL * TRIAL * ', '* TRIAL * TRIAL *', 'hq@gmail.com', '* TRIAL * T', 1);
INSERT INTO cliente VALUES ('12099923', 'V-20', 'Vianel', 'López', 'M', 'Carora', '10.17755233745117', '-70.07997026724229', 'vl@gmail.com', '04168532067', 1);
INSERT INTO cliente VALUES ('17196447', '17196447', '* TRIAL ', 'Moreno', 'F', 'carrera 25 con 26 Barquisimeto', '10.0718732', '-69.31742659999998', 'Email', 'TelÃ©fono', 1);
INSERT INTO cliente VALUES ('21459969', '001', 'Luis ', 'Freitez', 'M', 'Barquisimeto', '10.0677719', '-69.34735089999998', 'lfreitez@marna.com.ve', '04145536740', 1);
INSERT INTO cliente VALUES ('22272210', '001', 'pedro', '* TRIAL ', 'M', 'Barquisimeto', '10.0677719', '-69.34735089999998', '* TRIAL * TRIAL', '04265219195', 1);


--
-- TOC entry 2318 (class 0 OID 16523)
-- Dependencies: 190
-- Data for Name: condicion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO condicion VALUES (1, 'Excelente');
INSERT INTO condicion VALUES (2, '* TRIAL *');
INSERT INTO condicion VALUES (3, 'Regular');


--
-- TOC entry 2377 (class 0 OID 0)
-- Dependencies: 189
-- Name: condicion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('condicion_id_seq', 4, false);


--
-- TOC entry 2320 (class 0 OID 16529)
-- Dependencies: 192
-- Data for Name: disponibilidad; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO disponibilidad VALUES (1, 'rx23', 1, '2016-09-30');
INSERT INTO disponibilidad VALUES (2, 'rx23', 2, '2016-09-30');
INSERT INTO disponibilidad VALUES (3, 'rx23', 3, '2016-09-30');
INSERT INTO disponibilidad VALUES (4, 'rx23', 4, '2016-09-30');
INSERT INTO disponibilidad VALUES (5, 'rx23', 0, '2016-09-30');
INSERT INTO disponibilidad VALUES (6, 'jv40', 1, '2016-10-04');
INSERT INTO disponibilidad VALUES (7, 'jv40', 2, '2016-10-04');
INSERT INTO disponibilidad VALUES (8, 'jv40', 3, '2016-10-04');
INSERT INTO disponibilidad VALUES (9, 'jv40', 4, '2016-10-04');
INSERT INTO disponibilidad VALUES (10, 'jl12', 1, '2016-10-04');
INSERT INTO disponibilidad VALUES (11, 'jl12', 2, '2016-10-04');
INSERT INTO disponibilidad VALUES (12, 'jl12', 3, '2016-10-04');
INSERT INTO disponibilidad VALUES (13, 'jl12', 4, '2016-10-04');
INSERT INTO disponibilidad VALUES (14, 'rx23', 1, '2016-10-04');
INSERT INTO disponibilidad VALUES (15, 'rx23', 2, '2016-10-04');
INSERT INTO disponibilidad VALUES (16, 'rx23', 3, '2016-10-04');
INSERT INTO disponibilidad VALUES (17, 'rx23', 4, '2016-10-04');
INSERT INTO disponibilidad VALUES (18, 'jl12', 1, '2016-10-06');
INSERT INTO disponibilidad VALUES (19, 'jl12', 2, '2016-10-06');
INSERT INTO disponibilidad VALUES (20, 'jl12', 3, '2016-10-06');
INSERT INTO disponibilidad VALUES (21, 'jl12', 4, '2016-10-06');
INSERT INTO disponibilidad VALUES (22, 'jl12', 1, '2016-10-07');
INSERT INTO disponibilidad VALUES (23, 'jl12', 2, '2016-10-07');
INSERT INTO disponibilidad VALUES (24, 'jl12', 3, '2016-10-07');
INSERT INTO disponibilidad VALUES (25, 'jl12', 4, '2016-10-07');
INSERT INTO disponibilidad VALUES (26, 'jl12', 1, '2016-10-08');
INSERT INTO disponibilidad VALUES (27, 'jl12', 2, '2016-10-08');
INSERT INTO disponibilidad VALUES (28, 'jl12', 3, '2016-10-08');
INSERT INTO disponibilidad VALUES (29, 'jl12', 4, '2016-10-08');
INSERT INTO disponibilidad VALUES (30, 'rx23', 0, '2016-10-08');
INSERT INTO disponibilidad VALUES (31, 'jl12', 1, '2016-10-09');
INSERT INTO disponibilidad VALUES (32, 'jl12', 2, '2016-10-09');
INSERT INTO disponibilidad VALUES (33, 'jl12', 3, '2016-10-09');
INSERT INTO disponibilidad VALUES (34, 'jl12', 4, '2016-10-09');
INSERT INTO disponibilidad VALUES (35, 'jl12', 1, '2016-10-10');
INSERT INTO disponibilidad VALUES (36, 'jl12', 2, '2016-10-10');
INSERT INTO disponibilidad VALUES (37, 'jl12', 3, '2016-10-10');
INSERT INTO disponibilidad VALUES (38, 'jl12', 4, '2016-10-10');
INSERT INTO disponibilidad VALUES (39, 'rx23', 1, '2016-10-11');
INSERT INTO disponibilidad VALUES (40, 'rx23', 2, '2016-10-11');
INSERT INTO disponibilidad VALUES (41, 'rx23', 3, '2016-10-11');
INSERT INTO disponibilidad VALUES (42, 'rx23', 4, '2016-10-11');
INSERT INTO disponibilidad VALUES (43, 'helyver19', 1, '2016-10-15');
INSERT INTO disponibilidad VALUES (44, '* TRIAL *', 2, '2016-10-15');
INSERT INTO disponibilidad VALUES (45, 'helyver19', 3, '2016-10-15');
INSERT INTO disponibilidad VALUES (46, 'helyver19', 4, '2016-10-15');
INSERT INTO disponibilidad VALUES (47, 'helyver19', 1, '2016-10-15');
INSERT INTO disponibilidad VALUES (48, 'helyver19', 2, '2016-10-15');
INSERT INTO disponibilidad VALUES (49, '* TRIAL *', 3, '2016-10-15');
INSERT INTO disponibilidad VALUES (50, 'helyver19', 4, '2016-10-15');
INSERT INTO disponibilidad VALUES (51, '* TRIAL *', 1, '2016-10-15');
INSERT INTO disponibilidad VALUES (52, 'helyver19', 2, '2016-10-15');
INSERT INTO disponibilidad VALUES (53, '* TRIAL *', 3, '2016-10-15');
INSERT INTO disponibilidad VALUES (54, '* TRIAL *', 4, '2016-10-15');
INSERT INTO disponibilidad VALUES (55, 'rx23', 1, '2016-10-15');
INSERT INTO disponibilidad VALUES (56, 'rx23', 2, '2016-10-15');
INSERT INTO disponibilidad VALUES (57, 'rx23', 3, '2016-10-15');
INSERT INTO disponibilidad VALUES (58, 'rx23', 4, '2016-10-15');
INSERT INTO disponibilidad VALUES (63, 'rx23', 1, '2016-10-16');
INSERT INTO disponibilidad VALUES (64, 'rx23', 2, '2016-10-16');
INSERT INTO disponibilidad VALUES (65, 'rx23', 3, '2016-10-16');
INSERT INTO disponibilidad VALUES (66, 'rx23', 4, '2016-10-16');
INSERT INTO disponibilidad VALUES (67, 'rx23', 1, '2016-10-17');
INSERT INTO disponibilidad VALUES (68, 'rx23', 2, '2016-10-17');
INSERT INTO disponibilidad VALUES (69, 'rx23', 3, '2016-10-17');
INSERT INTO disponibilidad VALUES (70, 'rx23', 4, '2016-10-17');
INSERT INTO disponibilidad VALUES (71, 'helyver19', 1, '2016-10-18');
INSERT INTO disponibilidad VALUES (72, '* TRIAL *', 2, '2016-10-18');
INSERT INTO disponibilidad VALUES (73, 'helyver19', 3, '2016-10-18');
INSERT INTO disponibilidad VALUES (74, 'helyver19', 4, '2016-10-18');
INSERT INTO disponibilidad VALUES (75, 'helyver19', 1, '2016-10-19');
INSERT INTO disponibilidad VALUES (76, 'helyver19', 2, '2016-10-19');
INSERT INTO disponibilidad VALUES (77, 'helyver19', 3, '2016-10-19');
INSERT INTO disponibilidad VALUES (78, 'helyver19', 4, '2016-10-19');
INSERT INTO disponibilidad VALUES (79, 'helyver19', 1, '2016-10-21');
INSERT INTO disponibilidad VALUES (80, 'helyver19', 2, '2016-10-21');
INSERT INTO disponibilidad VALUES (81, 'helyver19', 3, '2016-10-21');
INSERT INTO disponibilidad VALUES (82, '* TRIAL *', 4, '2016-10-21');
INSERT INTO disponibilidad VALUES (83, 'helyver19', 1, '2016-10-24');
INSERT INTO disponibilidad VALUES (84, 'helyver19', 2, '2016-10-24');
INSERT INTO disponibilidad VALUES (85, 'helyver19', 3, '2016-10-24');
INSERT INTO disponibilidad VALUES (86, 'helyver19', 4, '2016-10-24');
INSERT INTO disponibilidad VALUES (87, '* TRIAL *', 1, '2016-10-26');
INSERT INTO disponibilidad VALUES (88, '* TRIAL *', 2, '2016-10-26');
INSERT INTO disponibilidad VALUES (89, 'helyver19', 3, '2016-10-26');
INSERT INTO disponibilidad VALUES (90, 'helyver19', 4, '2016-10-26');
INSERT INTO disponibilidad VALUES (91, 'helyver19', 1, '2016-10-26');
INSERT INTO disponibilidad VALUES (92, 'helyver19', 2, '2016-10-26');
INSERT INTO disponibilidad VALUES (93, 'helyver19', 3, '2016-10-26');
INSERT INTO disponibilidad VALUES (94, 'helyver19', 4, '2016-10-26');
INSERT INTO disponibilidad VALUES (95, 'helyver19', 1, '2016-10-28');
INSERT INTO disponibilidad VALUES (96, '* TRIAL *', 2, '2016-10-28');
INSERT INTO disponibilidad VALUES (97, '* TRIAL *', 3, '2016-10-28');
INSERT INTO disponibilidad VALUES (98, '* TRIAL *', 4, '2016-10-28');
INSERT INTO disponibilidad VALUES (99, 'helyver19', 1, '2016-10-29');
INSERT INTO disponibilidad VALUES (100, 'helyver19', 2, '2016-10-29');
INSERT INTO disponibilidad VALUES (101, '* TRIAL *', 3, '2016-10-29');
INSERT INTO disponibilidad VALUES (102, '* TRIAL *', 4, '2016-10-29');
INSERT INTO disponibilidad VALUES (103, 'helyver19', 1, '2016-10-29');
INSERT INTO disponibilidad VALUES (104, '* TRIAL *', 2, '2016-10-29');
INSERT INTO disponibilidad VALUES (105, '* TRIAL *', 3, '2016-10-29');
INSERT INTO disponibilidad VALUES (106, 'helyver19', 4, '2016-10-29');
INSERT INTO disponibilidad VALUES (107, 'helyver19', 1, '2016-10-30');
INSERT INTO disponibilidad VALUES (108, 'helyver19', 2, '2016-10-30');
INSERT INTO disponibilidad VALUES (109, 'helyver19', 3, '2016-10-30');
INSERT INTO disponibilidad VALUES (110, 'helyver19', 4, '2016-10-30');
INSERT INTO disponibilidad VALUES (111, 'helyver19', 1, '2016-10-31');
INSERT INTO disponibilidad VALUES (112, 'helyver19', 2, '2016-10-31');
INSERT INTO disponibilidad VALUES (113, 'helyver19', 3, '2016-10-31');
INSERT INTO disponibilidad VALUES (114, '* TRIAL *', 4, '2016-10-31');
INSERT INTO disponibilidad VALUES (115, 'helyver19', 1, '2016-11-01');
INSERT INTO disponibilidad VALUES (116, 'helyver19', 2, '2016-11-01');
INSERT INTO disponibilidad VALUES (117, '* TRIAL *', 3, '2016-11-01');
INSERT INTO disponibilidad VALUES (118, 'helyver19', 4, '2016-11-01');
INSERT INTO disponibilidad VALUES (119, '* TRIAL *', 1, '2016-11-01');
INSERT INTO disponibilidad VALUES (120, 'helyver19', 2, '2016-11-01');
INSERT INTO disponibilidad VALUES (121, 'helyver19', 3, '2016-11-01');
INSERT INTO disponibilidad VALUES (122, '* TRIAL *', 4, '2016-11-01');
INSERT INTO disponibilidad VALUES (123, 'helyver19', 1, '2016-11-02');
INSERT INTO disponibilidad VALUES (124, 'helyver19', 2, '2016-11-02');
INSERT INTO disponibilidad VALUES (125, 'helyver19', 3, '2016-11-02');
INSERT INTO disponibilidad VALUES (126, 'helyver19', 4, '2016-11-02');
INSERT INTO disponibilidad VALUES (127, 'helyver19', 1, '2016-11-03');
INSERT INTO disponibilidad VALUES (128, 'helyver19', 2, '2016-11-03');
INSERT INTO disponibilidad VALUES (129, 'helyver19', 3, '2016-11-03');
INSERT INTO disponibilidad VALUES (130, 'helyver19', 4, '2016-11-03');
INSERT INTO disponibilidad VALUES (131, '* TRIAL *', 1, '2016-11-04');
INSERT INTO disponibilidad VALUES (132, 'helyver19', 2, '2016-11-04');
INSERT INTO disponibilidad VALUES (133, 'helyver19', 3, '2016-11-04');
INSERT INTO disponibilidad VALUES (134, 'helyver19', 4, '2016-11-04');
INSERT INTO disponibilidad VALUES (135, 'helyver19', 0, '2016-11-04');
INSERT INTO disponibilidad VALUES (136, 'helyver19', 1, '2016-11-04');
INSERT INTO disponibilidad VALUES (137, 'helyver19', 2, '2016-11-04');
INSERT INTO disponibilidad VALUES (138, '* TRIAL *', 3, '2016-11-04');
INSERT INTO disponibilidad VALUES (139, 'helyver19', 4, '2016-11-04');
INSERT INTO disponibilidad VALUES (140, '* TRIAL *', 1, '2016-11-04');
INSERT INTO disponibilidad VALUES (141, 'helyver19', 2, '2016-11-04');
INSERT INTO disponibilidad VALUES (142, '* TRIAL *', 3, '2016-11-04');
INSERT INTO disponibilidad VALUES (143, 'helyver19', 4, '2016-11-04');
INSERT INTO disponibilidad VALUES (144, 'n80', 1, '2016-11-04');
INSERT INTO disponibilidad VALUES (145, 'n80', 2, '2016-11-04');
INSERT INTO disponibilidad VALUES (146, 'n80', 3, '2016-11-04');
INSERT INTO disponibilidad VALUES (147, 'n80', 4, '2016-11-04');
INSERT INTO disponibilidad VALUES (148, '* TRIAL *', 1, '2016-11-04');
INSERT INTO disponibilidad VALUES (149, '* TRIAL *', 2, '2016-11-04');
INSERT INTO disponibilidad VALUES (150, 'helyver19', 3, '2016-11-04');
INSERT INTO disponibilidad VALUES (151, '* TRIAL *', 4, '2016-11-04');
INSERT INTO disponibilidad VALUES (152, 'helyver19', 1, '2016-11-04');
INSERT INTO disponibilidad VALUES (153, 'helyver19', 2, '2016-11-04');
INSERT INTO disponibilidad VALUES (154, 'helyver19', 3, '2016-11-04');
INSERT INTO disponibilidad VALUES (155, 'helyver19', 4, '2016-11-04');
INSERT INTO disponibilidad VALUES (156, '* TRIAL *', 1, '2016-11-05');
INSERT INTO disponibilidad VALUES (157, 'helyver19', 2, '2016-11-05');
INSERT INTO disponibilidad VALUES (158, 'helyver19', 3, '2016-11-05');
INSERT INTO disponibilidad VALUES (159, 'helyver19', 4, '2016-11-05');
INSERT INTO disponibilidad VALUES (160, 'n80', 1, '2016-11-05');
INSERT INTO disponibilidad VALUES (161, 'n80', 2, '2016-11-05');
INSERT INTO disponibilidad VALUES (162, 'n80', 3, '2016-11-05');
INSERT INTO disponibilidad VALUES (163, 'n80', 4, '2016-11-05');
INSERT INTO disponibilidad VALUES (164, 'n80', 1, '2016-11-06');
INSERT INTO disponibilidad VALUES (165, 'n80', 2, '2016-11-06');
INSERT INTO disponibilidad VALUES (166, 'n80', 3, '2016-11-06');
INSERT INTO disponibilidad VALUES (167, 'n80', 4, '2016-11-06');
INSERT INTO disponibilidad VALUES (168, 'helyver19', 1, '2016-11-07');
INSERT INTO disponibilidad VALUES (169, 'helyver19', 2, '2016-11-07');
INSERT INTO disponibilidad VALUES (170, '* TRIAL *', 3, '2016-11-07');
INSERT INTO disponibilidad VALUES (171, 'helyver19', 4, '2016-11-07');
INSERT INTO disponibilidad VALUES (172, 'helyver19', 1, '2016-11-08');
INSERT INTO disponibilidad VALUES (173, 'helyver19', 2, '2016-11-08');
INSERT INTO disponibilidad VALUES (174, 'helyver19', 3, '2016-11-08');
INSERT INTO disponibilidad VALUES (175, 'helyver19', 4, '2016-11-08');
INSERT INTO disponibilidad VALUES (176, 'n80', 1, '2016-11-08');
INSERT INTO disponibilidad VALUES (177, 'n80', 2, '2016-11-08');
INSERT INTO disponibilidad VALUES (178, 'n80', 3, '2016-11-08');
INSERT INTO disponibilidad VALUES (179, 'n80', 4, '2016-11-08');
INSERT INTO disponibilidad VALUES (184, 'n80', 1, '2016-11-09');
INSERT INTO disponibilidad VALUES (185, 'n80', 2, '2016-11-09');
INSERT INTO disponibilidad VALUES (186, 'n80', 3, '2016-11-09');
INSERT INTO disponibilidad VALUES (187, 'n80', 4, '2016-11-09');
INSERT INTO disponibilidad VALUES (188, 'helyver19', 1, '2016-11-10');
INSERT INTO disponibilidad VALUES (189, 'helyver19', 2, '2016-11-10');
INSERT INTO disponibilidad VALUES (190, 'helyver19', 3, '2016-11-10');
INSERT INTO disponibilidad VALUES (191, '* TRIAL *', 4, '2016-11-10');
INSERT INTO disponibilidad VALUES (192, 'n80', 1, '2016-11-10');
INSERT INTO disponibilidad VALUES (193, 'n80', 2, '2016-11-10');
INSERT INTO disponibilidad VALUES (194, 'n80', 3, '2016-11-10');
INSERT INTO disponibilidad VALUES (195, 'n80', 4, '2016-11-10');
INSERT INTO disponibilidad VALUES (196, 'n80', 1, '2016-11-13');
INSERT INTO disponibilidad VALUES (197, 'n80', 2, '2016-11-13');
INSERT INTO disponibilidad VALUES (198, 'n80', 3, '2016-11-13');
INSERT INTO disponibilidad VALUES (199, 'n80', 4, '2016-11-13');
INSERT INTO disponibilidad VALUES (200, 'helyver19', 1, '2016-11-15');
INSERT INTO disponibilidad VALUES (201, 'helyver19', 2, '2016-11-15');
INSERT INTO disponibilidad VALUES (202, 'helyver19', 3, '2016-11-15');
INSERT INTO disponibilidad VALUES (203, '* TRIAL *', 4, '2016-11-15');
INSERT INTO disponibilidad VALUES (204, 'helyver19', 1, '2016-11-17');
INSERT INTO disponibilidad VALUES (205, '* TRIAL *', 2, '2016-11-17');
INSERT INTO disponibilidad VALUES (206, 'helyver19', 3, '2016-11-17');
INSERT INTO disponibilidad VALUES (207, 'helyver19', 4, '2016-11-17');
INSERT INTO disponibilidad VALUES (208, '* TRIAL *', 1, '2016-11-18');
INSERT INTO disponibilidad VALUES (209, 'helyver19', 2, '2016-11-18');
INSERT INTO disponibilidad VALUES (210, '* TRIAL *', 3, '2016-11-18');
INSERT INTO disponibilidad VALUES (211, '* TRIAL *', 4, '2016-11-18');
INSERT INTO disponibilidad VALUES (212, 'LA003', 1, '2016-11-18');
INSERT INTO disponibilidad VALUES (213, 'LA003', 2, '2016-11-18');
INSERT INTO disponibilidad VALUES (214, 'LA003', 3, '2016-11-18');
INSERT INTO disponibilidad VALUES (215, 'LA003', 4, '2016-11-18');
INSERT INTO disponibilidad VALUES (216, 'LA004', 1, '2016-11-18');
INSERT INTO disponibilidad VALUES (217, 'LA005', 1, '2016-11-18');
INSERT INTO disponibilidad VALUES (218, 'LA005', 2, '2016-11-18');
INSERT INTO disponibilidad VALUES (219, 'LA005', 3, '2016-11-18');
INSERT INTO disponibilidad VALUES (220, 'LA005', 4, '2016-11-18');
INSERT INTO disponibilidad VALUES (221, 'LA005', 1, '2016-11-20');
INSERT INTO disponibilidad VALUES (222, 'LA005', 2, '2016-11-20');
INSERT INTO disponibilidad VALUES (223, 'LA005', 3, '2016-11-20');
INSERT INTO disponibilidad VALUES (224, 'LA005', 4, '2016-11-20');
INSERT INTO disponibilidad VALUES (225, 'LA005', 1, '2016-11-20');
INSERT INTO disponibilidad VALUES (226, 'LA005', 0, '2016-11-20');
INSERT INTO disponibilidad VALUES (227, 'LA099', 1, '2016-11-19');
INSERT INTO disponibilidad VALUES (228, 'LA099', 2, '2016-11-19');
INSERT INTO disponibilidad VALUES (229, 'LA099', 3, '2016-11-19');
INSERT INTO disponibilidad VALUES (230, 'LA099', 4, '2016-11-19');
INSERT INTO disponibilidad VALUES (231, 'LA099', 1, '2016-11-23');
INSERT INTO disponibilidad VALUES (232, 'LA099', 2, '2016-11-23');
INSERT INTO disponibilidad VALUES (233, 'LA099', 3, '2016-11-23');
INSERT INTO disponibilidad VALUES (234, 'LA099', 4, '2016-11-23');
INSERT INTO disponibilidad VALUES (235, 'LA099', 1, '2016-11-24');
INSERT INTO disponibilidad VALUES (236, 'LA099', 2, '2016-11-24');
INSERT INTO disponibilidad VALUES (237, 'LA099', 3, '2016-11-24');
INSERT INTO disponibilidad VALUES (238, 'LA099', 4, '2016-11-24');
INSERT INTO disponibilidad VALUES (239, 'n80', 1, '2016-11-29');
INSERT INTO disponibilidad VALUES (240, 'n80', 2, '2016-11-29');
INSERT INTO disponibilidad VALUES (241, 'n80', 3, '2016-11-29');
INSERT INTO disponibilidad VALUES (242, 'n80', 4, '2016-11-29');
INSERT INTO disponibilidad VALUES (243, 'n80', 1, '2016-11-29');
INSERT INTO disponibilidad VALUES (244, 'n80', 2, '2016-11-29');
INSERT INTO disponibilidad VALUES (245, 'n80', 3, '2016-11-29');
INSERT INTO disponibilidad VALUES (246, 'n80', 4, '2016-11-29');
INSERT INTO disponibilidad VALUES (247, 'n80', 1, '2016-11-30');
INSERT INTO disponibilidad VALUES (248, 'n80', 2, '2016-11-30');
INSERT INTO disponibilidad VALUES (249, 'n80', 3, '2016-11-30');
INSERT INTO disponibilidad VALUES (250, 'n80', 4, '2016-11-30');
INSERT INTO disponibilidad VALUES (251, 'n80', 1, '2016-11-30');
INSERT INTO disponibilidad VALUES (252, 'n80', 2, '2016-11-30');
INSERT INTO disponibilidad VALUES (253, 'n80', 3, '2016-11-30');
INSERT INTO disponibilidad VALUES (254, 'n80', 4, '2016-11-30');
INSERT INTO disponibilidad VALUES (255, 'LA099', 1, '2016-11-30');
INSERT INTO disponibilidad VALUES (256, 'LA099', 2, '2016-11-30');
INSERT INTO disponibilidad VALUES (257, 'LA099', 3, '2016-11-30');
INSERT INTO disponibilidad VALUES (258, 'LA099', 4, '2016-11-30');
INSERT INTO disponibilidad VALUES (259, 'LA099', 1, '2016-12-01');
INSERT INTO disponibilidad VALUES (260, 'LA099', 2, '2016-12-01');
INSERT INTO disponibilidad VALUES (261, 'LA099', 3, '2016-12-01');
INSERT INTO disponibilidad VALUES (262, 'LA099', 4, '2016-12-01');
INSERT INTO disponibilidad VALUES (263, 'LA099', 1, '2016-12-02');
INSERT INTO disponibilidad VALUES (264, 'LA099', 2, '2016-12-02');
INSERT INTO disponibilidad VALUES (265, 'LA099', 3, '2016-12-02');
INSERT INTO disponibilidad VALUES (266, 'LA099', 4, '2016-12-02');
INSERT INTO disponibilidad VALUES (267, 'LA099', 1, '2016-12-03');
INSERT INTO disponibilidad VALUES (268, 'LA099', 2, '2016-12-03');
INSERT INTO disponibilidad VALUES (269, 'LA099', 3, '2016-12-03');
INSERT INTO disponibilidad VALUES (270, 'LA099', 4, '2016-12-03');
INSERT INTO disponibilidad VALUES (271, 'LA099', 1, '2016-12-04');
INSERT INTO disponibilidad VALUES (272, 'LA099', 2, '2016-12-04');
INSERT INTO disponibilidad VALUES (273, 'LA099', 3, '2016-12-04');
INSERT INTO disponibilidad VALUES (274, 'LA099', 4, '2016-12-04');
INSERT INTO disponibilidad VALUES (275, 'LA099', 1, '2016-12-05');
INSERT INTO disponibilidad VALUES (276, 'LA099', 2, '2016-12-05');
INSERT INTO disponibilidad VALUES (277, 'LA099', 3, '2016-12-05');
INSERT INTO disponibilidad VALUES (278, 'LA099', 4, '2016-12-05');
INSERT INTO disponibilidad VALUES (279, 'LA099', 1, '2016-12-08');
INSERT INTO disponibilidad VALUES (280, 'LA099', 2, '2016-12-08');
INSERT INTO disponibilidad VALUES (281, 'LA099', 3, '2016-12-08');
INSERT INTO disponibilidad VALUES (282, 'LA099', 4, '2016-12-08');
INSERT INTO disponibilidad VALUES (283, 'n80', 1, '2016-12-09');
INSERT INTO disponibilidad VALUES (284, 'n80', 2, '2016-12-09');
INSERT INTO disponibilidad VALUES (285, 'n80', 3, '2016-12-09');
INSERT INTO disponibilidad VALUES (286, 'n80', 4, '2016-12-09');
INSERT INTO disponibilidad VALUES (287, 'n80', 3, '2016-12-10');
INSERT INTO disponibilidad VALUES (288, 'n80', 4, '2016-12-10');
INSERT INTO disponibilidad VALUES (289, 'n80', 1, '2016-12-12');
INSERT INTO disponibilidad VALUES (290, 'n80', 2, '2016-12-12');
INSERT INTO disponibilidad VALUES (291, 'n80', 3, '2016-12-12');
INSERT INTO disponibilidad VALUES (292, 'n80', 4, '2016-12-12');
INSERT INTO disponibilidad VALUES (293, 'LA099', 1, '2016-12-13');
INSERT INTO disponibilidad VALUES (294, 'LA099', 2, '2016-12-13');
INSERT INTO disponibilidad VALUES (295, 'LA099', 3, '2016-12-13');
INSERT INTO disponibilidad VALUES (296, 'LA099', 4, '2016-12-13');
INSERT INTO disponibilidad VALUES (297, 'n80', 0, '2016-12-13');
INSERT INTO disponibilidad VALUES (298, 'LA099', 1, '2016-12-14');
INSERT INTO disponibilidad VALUES (299, 'LA099', 2, '2016-12-14');
INSERT INTO disponibilidad VALUES (300, 'LA099', 3, '2016-12-14');
INSERT INTO disponibilidad VALUES (301, 'LA099', 4, '2016-12-14');
INSERT INTO disponibilidad VALUES (302, 'LA099', 1, '2016-12-15');
INSERT INTO disponibilidad VALUES (303, 'LA099', 2, '2016-12-15');
INSERT INTO disponibilidad VALUES (304, 'LA099', 3, '2016-12-15');
INSERT INTO disponibilidad VALUES (305, 'LA099', 4, '2016-12-15');
INSERT INTO disponibilidad VALUES (306, 'LA099', 1, '2016-12-15');
INSERT INTO disponibilidad VALUES (307, 'LA099', 2, '2016-12-15');
INSERT INTO disponibilidad VALUES (308, 'LA099', 3, '2016-12-15');
INSERT INTO disponibilidad VALUES (309, 'LA099', 4, '2016-12-15');
INSERT INTO disponibilidad VALUES (310, 'LA099', 1, '2016-12-15');
INSERT INTO disponibilidad VALUES (311, 'LA099', 2, '2016-12-15');
INSERT INTO disponibilidad VALUES (312, 'LA099', 3, '2016-12-15');
INSERT INTO disponibilidad VALUES (313, 'LA099', 4, '2016-12-15');
INSERT INTO disponibilidad VALUES (314, 'n80', 1, '2016-12-15');
INSERT INTO disponibilidad VALUES (315, 'n80', 2, '2016-12-15');
INSERT INTO disponibilidad VALUES (316, 'n80', 3, '2016-12-15');
INSERT INTO disponibilidad VALUES (317, 'n80', 4, '2016-12-15');
INSERT INTO disponibilidad VALUES (318, 'LA099', 1, '2016-12-16');
INSERT INTO disponibilidad VALUES (319, 'LA099', 2, '2016-12-16');
INSERT INTO disponibilidad VALUES (320, 'LA099', 3, '2016-12-16');
INSERT INTO disponibilidad VALUES (321, 'LA099', 4, '2016-12-16');
INSERT INTO disponibilidad VALUES (322, 'LA098', 1, '2016-12-17');
INSERT INTO disponibilidad VALUES (323, 'LA098', 2, '2016-12-17');
INSERT INTO disponibilidad VALUES (324, 'LA098', 3, '2016-12-17');
INSERT INTO disponibilidad VALUES (325, 'LA098', 4, '2016-12-17');
INSERT INTO disponibilidad VALUES (326, 'LA099', 1, '2016-12-17');
INSERT INTO disponibilidad VALUES (327, 'LA099', 2, '2016-12-17');
INSERT INTO disponibilidad VALUES (328, 'LA099', 3, '2016-12-17');
INSERT INTO disponibilidad VALUES (329, 'LA099', 4, '2016-12-17');
INSERT INTO disponibilidad VALUES (330, 'LA098', 1, '2016-12-17');
INSERT INTO disponibilidad VALUES (331, 'LA099', 1, '2016-12-18');
INSERT INTO disponibilidad VALUES (332, 'LA099', 2, '2016-12-18');
INSERT INTO disponibilidad VALUES (333, 'LA099', 3, '2016-12-18');
INSERT INTO disponibilidad VALUES (334, 'LA099', 4, '2016-12-18');
INSERT INTO disponibilidad VALUES (335, 'n80', 0, '2016-12-18');
INSERT INTO disponibilidad VALUES (336, 'LA098', 1, '2016-12-19');
INSERT INTO disponibilidad VALUES (337, 'LA098', 2, '2016-12-19');
INSERT INTO disponibilidad VALUES (338, 'LA098', 3, '2016-12-19');
INSERT INTO disponibilidad VALUES (339, 'LA098', 4, '2016-12-19');
INSERT INTO disponibilidad VALUES (340, 'LA099', 1, '2016-12-19');
INSERT INTO disponibilidad VALUES (341, 'LA099', 2, '2016-12-19');
INSERT INTO disponibilidad VALUES (342, 'LA099', 3, '2016-12-19');
INSERT INTO disponibilidad VALUES (343, 'LA099', 4, '2016-12-19');
INSERT INTO disponibilidad VALUES (344, 'n80', 1, '2016-12-19');
INSERT INTO disponibilidad VALUES (345, 'n80', 2, '2016-12-19');
INSERT INTO disponibilidad VALUES (346, 'n80', 3, '2016-12-19');
INSERT INTO disponibilidad VALUES (347, 'n80', 4, '2016-12-19');
INSERT INTO disponibilidad VALUES (348, 'n80', 0, '2016-12-19');
INSERT INTO disponibilidad VALUES (349, 'LA099', 1, '2016-12-20');
INSERT INTO disponibilidad VALUES (350, 'LA099', 2, '2016-12-20');
INSERT INTO disponibilidad VALUES (351, 'LA099', 3, '2016-12-20');
INSERT INTO disponibilidad VALUES (352, 'LA099', 4, '2016-12-20');
INSERT INTO disponibilidad VALUES (353, 'n80', 1, '2016-12-20');
INSERT INTO disponibilidad VALUES (354, 'n80', 2, '2016-12-20');
INSERT INTO disponibilidad VALUES (355, 'n80', 3, '2016-12-20');
INSERT INTO disponibilidad VALUES (356, 'n80', 4, '2016-12-20');
INSERT INTO disponibilidad VALUES (357, 'n80', 0, '2016-12-20');
INSERT INTO disponibilidad VALUES (358, 'LA098', 1, '2016-12-21');
INSERT INTO disponibilidad VALUES (359, 'LA098', 2, '2016-12-21');
INSERT INTO disponibilidad VALUES (360, 'LA098', 3, '2016-12-21');
INSERT INTO disponibilidad VALUES (361, 'LA098', 4, '2016-12-21');
INSERT INTO disponibilidad VALUES (362, 'LA099', 1, '2016-12-21');
INSERT INTO disponibilidad VALUES (363, 'LA099', 2, '2016-12-21');
INSERT INTO disponibilidad VALUES (364, 'LA099', 3, '2016-12-21');
INSERT INTO disponibilidad VALUES (365, 'LA099', 4, '2016-12-21');
INSERT INTO disponibilidad VALUES (366, 'n80', 0, '2016-12-21');
INSERT INTO disponibilidad VALUES (367, 'LA099', 1, '2016-12-22');
INSERT INTO disponibilidad VALUES (368, 'LA099', 2, '2016-12-22');
INSERT INTO disponibilidad VALUES (369, 'LA099', 3, '2016-12-22');
INSERT INTO disponibilidad VALUES (370, 'LA099', 4, '2016-12-22');
INSERT INTO disponibilidad VALUES (371, 'LA098', 1, '2016-12-23');
INSERT INTO disponibilidad VALUES (372, 'LA098', 1, '2016-12-23');
INSERT INTO disponibilidad VALUES (373, 'LA098', 2, '2016-12-23');
INSERT INTO disponibilidad VALUES (374, 'LA098', 3, '2016-12-23');
INSERT INTO disponibilidad VALUES (375, 'LA098', 4, '2016-12-23');
INSERT INTO disponibilidad VALUES (376, 'LA099', 1, '2016-12-23');
INSERT INTO disponibilidad VALUES (377, 'LA099', 2, '2016-12-23');
INSERT INTO disponibilidad VALUES (378, 'LA099', 3, '2016-12-23');
INSERT INTO disponibilidad VALUES (379, 'LA099', 4, '2016-12-23');
INSERT INTO disponibilidad VALUES (380, 'LA099', 1, '2016-12-30');
INSERT INTO disponibilidad VALUES (381, 'LA099', 2, '2016-12-30');
INSERT INTO disponibilidad VALUES (382, 'LA099', 3, '2016-12-30');
INSERT INTO disponibilidad VALUES (383, 'LA099', 4, '2016-12-30');
INSERT INTO disponibilidad VALUES (384, 'LA099', 1, '2016-12-31');
INSERT INTO disponibilidad VALUES (385, 'LA099', 2, '2016-12-31');
INSERT INTO disponibilidad VALUES (386, 'LA099', 3, '2016-12-31');
INSERT INTO disponibilidad VALUES (387, 'LA099', 4, '2016-12-31');
INSERT INTO disponibilidad VALUES (392, 'LA099', 1, '2017-01-03');
INSERT INTO disponibilidad VALUES (393, 'LA099', 2, '2017-01-03');
INSERT INTO disponibilidad VALUES (394, 'LA099', 3, '2017-01-03');
INSERT INTO disponibilidad VALUES (395, 'LA099', 4, '2017-01-03');
INSERT INTO disponibilidad VALUES (396, 'LA099', 1, '2017-01-07');
INSERT INTO disponibilidad VALUES (397, 'LA099', 2, '2017-01-07');
INSERT INTO disponibilidad VALUES (398, 'LA099', 3, '2017-01-07');
INSERT INTO disponibilidad VALUES (399, 'LA098', 1, '2017-01-07');
INSERT INTO disponibilidad VALUES (400, 'LA098', 2, '2017-01-07');
INSERT INTO disponibilidad VALUES (401, 'LA098', 3, '2017-01-07');
INSERT INTO disponibilidad VALUES (402, 'LA098', 4, '2017-01-07');
INSERT INTO disponibilidad VALUES (403, 'LA098', 1, '2017-01-07');
INSERT INTO disponibilidad VALUES (404, 'LA098', 0, '2017-01-08');
INSERT INTO disponibilidad VALUES (405, 'LA098', 1, '2017-01-09');
INSERT INTO disponibilidad VALUES (406, 'LA098', 2, '2017-01-09');
INSERT INTO disponibilidad VALUES (407, 'LA099', 3, '2017-01-11');
INSERT INTO disponibilidad VALUES (408, 'LA098', 1, '2017-01-11');
INSERT INTO disponibilidad VALUES (409, 'LA098', 2, '2017-01-11');
INSERT INTO disponibilidad VALUES (410, 'LA098', 0, '2017-01-12');
INSERT INTO disponibilidad VALUES (411, 'LA098', 0, '2017-01-12');
INSERT INTO disponibilidad VALUES (412, 'LA098', 0, '2017-01-12');
INSERT INTO disponibilidad VALUES (413, 'LA098', 1, '2017-01-13');
INSERT INTO disponibilidad VALUES (414, 'LA098', 2, '2017-01-13');
INSERT INTO disponibilidad VALUES (415, 'LA098', 3, '2017-01-13');
INSERT INTO disponibilidad VALUES (416, 'LA098', 4, '2017-01-13');
INSERT INTO disponibilidad VALUES (417, 'LA098', 1, '2017-01-13');
INSERT INTO disponibilidad VALUES (418, 'LA098', 2, '2017-01-13');
INSERT INTO disponibilidad VALUES (419, 'LA098', 3, '2017-01-13');
INSERT INTO disponibilidad VALUES (420, 'LA098', 4, '2017-01-13');
INSERT INTO disponibilidad VALUES (421, 'LA099', 1, '2017-01-15');
INSERT INTO disponibilidad VALUES (422, 'LA099', 2, '2017-01-15');
INSERT INTO disponibilidad VALUES (423, 'LA099', 3, '2017-01-15');
INSERT INTO disponibilidad VALUES (424, 'LA099', 4, '2017-01-15');
INSERT INTO disponibilidad VALUES (425, 'LA098', 1, '2017-01-15');
INSERT INTO disponibilidad VALUES (426, 'LA098', 2, '2017-01-15');
INSERT INTO disponibilidad VALUES (427, 'LA098', 3, '2017-01-15');
INSERT INTO disponibilidad VALUES (428, 'LA098', 4, '2017-01-15');
INSERT INTO disponibilidad VALUES (429, 'LA098', 1, '2017-01-16');
INSERT INTO disponibilidad VALUES (430, 'LA098', 2, '2017-01-16');
INSERT INTO disponibilidad VALUES (431, 'LA098', 3, '2017-01-16');
INSERT INTO disponibilidad VALUES (432, 'LA098', 4, '2017-01-16');
INSERT INTO disponibilidad VALUES (433, 'LA098', 1, '2017-01-17');
INSERT INTO disponibilidad VALUES (434, 'LA098', 2, '2017-01-17');
INSERT INTO disponibilidad VALUES (435, 'LA098', 3, '2017-01-17');
INSERT INTO disponibilidad VALUES (436, 'LA098', 4, '2017-01-17');
INSERT INTO disponibilidad VALUES (437, 'LA098', 1, '2017-01-17');
INSERT INTO disponibilidad VALUES (438, 'LA098', 2, '2017-01-17');
INSERT INTO disponibilidad VALUES (439, 'LA098', 3, '2017-01-17');
INSERT INTO disponibilidad VALUES (440, 'LA098', 4, '2017-01-17');
INSERT INTO disponibilidad VALUES (441, 'LA098', 1, '2017-01-18');
INSERT INTO disponibilidad VALUES (442, 'LA098', 2, '2017-01-18');
INSERT INTO disponibilidad VALUES (443, 'LA098', 3, '2017-01-18');
INSERT INTO disponibilidad VALUES (444, 'LA098', 4, '2017-01-18');
INSERT INTO disponibilidad VALUES (445, 'LA099', 1, '2017-01-19');
INSERT INTO disponibilidad VALUES (446, 'LA099', 2, '2017-01-19');
INSERT INTO disponibilidad VALUES (447, 'LA099', 3, '2017-01-19');
INSERT INTO disponibilidad VALUES (448, 'LA099', 4, '2017-01-19');
INSERT INTO disponibilidad VALUES (449, 'LA098', 0, '2017-01-19');
INSERT INTO disponibilidad VALUES (450, 'LA099', 1, '2017-01-23');
INSERT INTO disponibilidad VALUES (451, 'LA099', 2, '2017-01-23');
INSERT INTO disponibilidad VALUES (452, 'LA099', 3, '2017-01-23');
INSERT INTO disponibilidad VALUES (453, 'LA099', 4, '2017-01-23');
INSERT INTO disponibilidad VALUES (454, 'n80', 1, '2017-01-24');
INSERT INTO disponibilidad VALUES (455, 'n80', 2, '2017-01-24');
INSERT INTO disponibilidad VALUES (456, 'n80', 3, '2017-01-24');
INSERT INTO disponibilidad VALUES (457, 'n80', 4, '2017-01-24');
INSERT INTO disponibilidad VALUES (458, 'LA099', 1, '2017-01-25');
INSERT INTO disponibilidad VALUES (459, 'LA099', 2, '2017-01-25');
INSERT INTO disponibilidad VALUES (460, 'LA099', 3, '2017-01-25');
INSERT INTO disponibilidad VALUES (461, 'LA099', 4, '2017-01-25');
INSERT INTO disponibilidad VALUES (462, 'LA099', 1, '2017-01-25');
INSERT INTO disponibilidad VALUES (463, 'LA099', 2, '2017-01-25');
INSERT INTO disponibilidad VALUES (464, 'LA099', 3, '2017-01-25');
INSERT INTO disponibilidad VALUES (465, 'LA099', 4, '2017-01-25');
INSERT INTO disponibilidad VALUES (466, 'n80', 1, '2017-01-26');
INSERT INTO disponibilidad VALUES (467, 'n80', 2, '2017-01-26');
INSERT INTO disponibilidad VALUES (468, 'LA099', 1, '2017-01-27');
INSERT INTO disponibilidad VALUES (469, 'LA099', 2, '2017-01-27');
INSERT INTO disponibilidad VALUES (470, 'LA099', 3, '2017-01-27');
INSERT INTO disponibilidad VALUES (471, 'LA099', 4, '2017-01-27');
INSERT INTO disponibilidad VALUES (472, 'LA099', 1, '2017-01-27');
INSERT INTO disponibilidad VALUES (473, 'LA099', 2, '2017-01-27');
INSERT INTO disponibilidad VALUES (474, 'LA099', 3, '2017-01-27');
INSERT INTO disponibilidad VALUES (475, 'LA099', 4, '2017-01-27');
INSERT INTO disponibilidad VALUES (476, 'LA099', 1, '2017-01-28');
INSERT INTO disponibilidad VALUES (477, 'LA099', 2, '2017-01-28');
INSERT INTO disponibilidad VALUES (478, 'LA099', 3, '2017-01-28');
INSERT INTO disponibilidad VALUES (479, 'LA099', 4, '2017-01-28');
INSERT INTO disponibilidad VALUES (480, 'LA099', 1, '2017-01-29');
INSERT INTO disponibilidad VALUES (481, 'LA099', 2, '2017-01-29');
INSERT INTO disponibilidad VALUES (482, 'LA099', 3, '2017-01-29');
INSERT INTO disponibilidad VALUES (483, 'LA099', 4, '2017-01-29');
INSERT INTO disponibilidad VALUES (484, 'LA099', 1, '2017-01-30');
INSERT INTO disponibilidad VALUES (485, 'LA099', 2, '2017-01-30');
INSERT INTO disponibilidad VALUES (486, 'LA099', 3, '2017-01-30');
INSERT INTO disponibilidad VALUES (487, 'LA099', 4, '2017-01-30');
INSERT INTO disponibilidad VALUES (488, 'LA099', 1, '2017-01-31');
INSERT INTO disponibilidad VALUES (489, 'LA099', 2, '2017-01-31');
INSERT INTO disponibilidad VALUES (490, 'LA099', 3, '2017-01-31');
INSERT INTO disponibilidad VALUES (491, 'LA099', 4, '2017-01-31');
INSERT INTO disponibilidad VALUES (492, 'LA099', 3, '2017-02-01');
INSERT INTO disponibilidad VALUES (493, 'LA098', 1, '2017-02-03');
INSERT INTO disponibilidad VALUES (494, 'LA098', 2, '2017-02-03');
INSERT INTO disponibilidad VALUES (495, 'LA098', 3, '2017-02-03');
INSERT INTO disponibilidad VALUES (496, 'LA098', 4, '2017-02-03');
INSERT INTO disponibilidad VALUES (497, 'LA099', 1, '2017-02-03');
INSERT INTO disponibilidad VALUES (498, 'LA099', 2, '2017-02-03');
INSERT INTO disponibilidad VALUES (499, 'LA099', 3, '2017-02-03');
INSERT INTO disponibilidad VALUES (500, 'LA099', 4, '2017-02-03');
INSERT INTO disponibilidad VALUES (501, 'LA098', 1, '2017-02-04');
INSERT INTO disponibilidad VALUES (502, 'LA098', 2, '2017-02-04');
INSERT INTO disponibilidad VALUES (503, 'LA098', 3, '2017-02-04');
INSERT INTO disponibilidad VALUES (504, 'LA098', 4, '2017-02-04');
INSERT INTO disponibilidad VALUES (505, 'LA099', 1, '2017-02-04');
INSERT INTO disponibilidad VALUES (506, 'LA099', 2, '2017-02-04');
INSERT INTO disponibilidad VALUES (507, 'LA099', 3, '2017-02-04');
INSERT INTO disponibilidad VALUES (508, 'LA099', 4, '2017-02-04');
INSERT INTO disponibilidad VALUES (509, 'LA098', 1, '2017-02-06');
INSERT INTO disponibilidad VALUES (510, 'LA099', 1, '2017-02-07');
INSERT INTO disponibilidad VALUES (511, 'LA099', 2, '2017-02-07');
INSERT INTO disponibilidad VALUES (512, 'LA099', 3, '2017-02-07');
INSERT INTO disponibilidad VALUES (513, 'LA099', 4, '2017-02-07');
INSERT INTO disponibilidad VALUES (514, 'LA099', 1, '2017-02-08');
INSERT INTO disponibilidad VALUES (515, 'LA098', 1, '2017-02-09');
INSERT INTO disponibilidad VALUES (516, 'LA098', 2, '2017-02-09');
INSERT INTO disponibilidad VALUES (517, 'LA098', 3, '2017-02-09');
INSERT INTO disponibilidad VALUES (518, 'LA098', 4, '2017-02-09');
INSERT INTO disponibilidad VALUES (519, 'LA099', 1, '2017-02-09');
INSERT INTO disponibilidad VALUES (520, 'LA099', 2, '2017-02-09');
INSERT INTO disponibilidad VALUES (521, 'LA099', 3, '2017-02-09');
INSERT INTO disponibilidad VALUES (522, 'LA099', 4, '2017-02-09');
INSERT INTO disponibilidad VALUES (523, 'LA099', 1, '2017-02-10');
INSERT INTO disponibilidad VALUES (524, 'LA099', 2, '2017-02-10');
INSERT INTO disponibilidad VALUES (525, 'LA099', 3, '2017-02-10');
INSERT INTO disponibilidad VALUES (526, 'LA099', 4, '2017-02-10');
INSERT INTO disponibilidad VALUES (527, 'LA098', 1, '2017-02-11');
INSERT INTO disponibilidad VALUES (528, 'LA098', 1, '2017-02-12');
INSERT INTO disponibilidad VALUES (530, 'LA099', 1, '2017-02-13');
INSERT INTO disponibilidad VALUES (531, 'LA099', 2, '2017-02-13');
INSERT INTO disponibilidad VALUES (532, 'LA099', 3, '2017-02-13');
INSERT INTO disponibilidad VALUES (533, 'LA099', 4, '2017-02-13');
INSERT INTO disponibilidad VALUES (534, 'LA099', 1, '2017-02-13');
INSERT INTO disponibilidad VALUES (535, 'LA099', 2, '2017-02-13');
INSERT INTO disponibilidad VALUES (536, 'LA099', 3, '2017-02-13');
INSERT INTO disponibilidad VALUES (537, 'LA099', 4, '2017-02-13');
INSERT INTO disponibilidad VALUES (538, 'LA099', 1, '2017-02-14');
INSERT INTO disponibilidad VALUES (539, 'LA099', 2, '2017-02-14');
INSERT INTO disponibilidad VALUES (540, 'LA099', 3, '2017-02-14');
INSERT INTO disponibilidad VALUES (541, 'LA099', 4, '2017-02-14');
INSERT INTO disponibilidad VALUES (542, 'LA098', 1, '2017-02-14');
INSERT INTO disponibilidad VALUES (543, 'LA099', 1, '2017-02-14');
INSERT INTO disponibilidad VALUES (544, 'LA099', 2, '2017-02-14');
INSERT INTO disponibilidad VALUES (545, 'LA099', 3, '2017-02-14');
INSERT INTO disponibilidad VALUES (546, 'LA099', 4, '2017-02-14');
INSERT INTO disponibilidad VALUES (547, 'LA098', 1, '2017-02-15');
INSERT INTO disponibilidad VALUES (548, 'LA098', 2, '2017-02-15');
INSERT INTO disponibilidad VALUES (549, 'LA098', 3, '2017-02-15');
INSERT INTO disponibilidad VALUES (550, 'LA098', 4, '2017-02-15');
INSERT INTO disponibilidad VALUES (551, 'LA098', 1, '2017-02-16');
INSERT INTO disponibilidad VALUES (552, 'LA099', 1, '2017-02-16');
INSERT INTO disponibilidad VALUES (553, 'LA099', 2, '2017-02-16');
INSERT INTO disponibilidad VALUES (554, 'LA099', 3, '2017-02-16');
INSERT INTO disponibilidad VALUES (555, 'LA099', 4, '2017-02-16');
INSERT INTO disponibilidad VALUES (556, 'LA098', 2, '2017-02-17');
INSERT INTO disponibilidad VALUES (557, 'LA099', 1, '2017-02-18');
INSERT INTO disponibilidad VALUES (558, 'LA099', 2, '2017-02-18');
INSERT INTO disponibilidad VALUES (559, 'LA099', 3, '2017-02-18');
INSERT INTO disponibilidad VALUES (560, 'LA099', 4, '2017-02-18');
INSERT INTO disponibilidad VALUES (561, 'LA098', 1, '2017-02-18');
INSERT INTO disponibilidad VALUES (562, 'LA098', 2, '2017-02-18');
INSERT INTO disponibilidad VALUES (563, 'LA098', 3, '2017-02-18');
INSERT INTO disponibilidad VALUES (564, 'LA098', 4, '2017-02-18');
INSERT INTO disponibilidad VALUES (565, 'LA098', 1, '2017-02-19');
INSERT INTO disponibilidad VALUES (570, 'LA098', 1, '2017-02-23');
INSERT INTO disponibilidad VALUES (571, 'LA098', 2, '2017-02-23');
INSERT INTO disponibilidad VALUES (572, 'LA098', 3, '2017-02-23');
INSERT INTO disponibilidad VALUES (573, 'LA098', 4, '2017-02-23');
INSERT INTO disponibilidad VALUES (574, 'LA099', 1, '2017-02-22');
INSERT INTO disponibilidad VALUES (575, 'LA099', 1, '2017-02-23');
INSERT INTO disponibilidad VALUES (576, 'LA099', 2, '2017-02-23');
INSERT INTO disponibilidad VALUES (577, 'LA099', 3, '2017-02-23');
INSERT INTO disponibilidad VALUES (578, 'LA099', 4, '2017-02-23');
INSERT INTO disponibilidad VALUES (583, 'LA098', 1, '2017-02-25');
INSERT INTO disponibilidad VALUES (584, 'LA098', 1, '2017-02-26');
INSERT INTO disponibilidad VALUES (585, 'LA098', 2, '2017-02-26');
INSERT INTO disponibilidad VALUES (586, 'LA098', 3, '2017-02-26');
INSERT INTO disponibilidad VALUES (587, 'LA098', 4, '2017-02-26');
INSERT INTO disponibilidad VALUES (588, 'LA099', 0, '2017-02-26');
INSERT INTO disponibilidad VALUES (589, 'LA098', 1, '2017-02-28');
INSERT INTO disponibilidad VALUES (590, 'LA098', 2, '2017-02-28');
INSERT INTO disponibilidad VALUES (591, 'LA098', 3, '2017-02-28');
INSERT INTO disponibilidad VALUES (592, 'LA098', 4, '2017-02-28');
INSERT INTO disponibilidad VALUES (593, 'LA098', 1, '2017-03-01');
INSERT INTO disponibilidad VALUES (594, 'LA098', 2, '2017-03-01');
INSERT INTO disponibilidad VALUES (595, 'LA098', 3, '2017-03-01');
INSERT INTO disponibilidad VALUES (596, 'LA098', 4, '2017-03-01');
INSERT INTO disponibilidad VALUES (597, 'LA099', 1, '2017-02-28');
INSERT INTO disponibilidad VALUES (598, 'LA099', 2, '2017-02-28');
INSERT INTO disponibilidad VALUES (599, 'LA099', 3, '2017-02-28');
INSERT INTO disponibilidad VALUES (600, 'LA099', 4, '2017-02-28');
INSERT INTO disponibilidad VALUES (601, 'LA098', 1, '2017-03-02');
INSERT INTO disponibilidad VALUES (602, 'LA098', 2, '2017-03-02');
INSERT INTO disponibilidad VALUES (603, 'LA098', 3, '2017-03-02');
INSERT INTO disponibilidad VALUES (604, 'LA098', 4, '2017-03-02');
INSERT INTO disponibilidad VALUES (605, 'LA098', 1, '2017-03-03');
INSERT INTO disponibilidad VALUES (606, 'LA099', 1, '2017-03-02');
INSERT INTO disponibilidad VALUES (607, 'LA099', 2, '2017-03-02');
INSERT INTO disponibilidad VALUES (608, 'LA099', 3, '2017-03-02');
INSERT INTO disponibilidad VALUES (609, 'LA099', 4, '2017-03-02');
INSERT INTO disponibilidad VALUES (610, 'LA099', 1, '2017-03-03');
INSERT INTO disponibilidad VALUES (611, 'LA099', 2, '2017-03-03');
INSERT INTO disponibilidad VALUES (612, 'LA099', 3, '2017-03-03');
INSERT INTO disponibilidad VALUES (613, 'LA099', 4, '2017-03-03');
INSERT INTO disponibilidad VALUES (614, 'LA098', 1, '2017-03-05');
INSERT INTO disponibilidad VALUES (615, 'LA098', 2, '2017-03-05');
INSERT INTO disponibilidad VALUES (616, 'LA098', 3, '2017-03-05');
INSERT INTO disponibilidad VALUES (617, 'LA098', 4, '2017-03-05');
INSERT INTO disponibilidad VALUES (618, 'LA098', 1, '2017-03-07');
INSERT INTO disponibilidad VALUES (619, 'LA098', 2, '2017-03-07');
INSERT INTO disponibilidad VALUES (620, 'LA098', 3, '2017-03-07');
INSERT INTO disponibilidad VALUES (621, 'LA098', 4, '2017-03-07');
INSERT INTO disponibilidad VALUES (626, 'LA099', 1, '2017-03-08');
INSERT INTO disponibilidad VALUES (627, 'LA099', 2, '2017-03-08');
INSERT INTO disponibilidad VALUES (628, 'LA099', 3, '2017-03-08');
INSERT INTO disponibilidad VALUES (629, 'LA099', 4, '2017-03-08');
INSERT INTO disponibilidad VALUES (630, 'LA099', 1, '2017-03-08');
INSERT INTO disponibilidad VALUES (639, 'LA098', 1, '2017-03-11');
INSERT INTO disponibilidad VALUES (640, 'LA098', 2, '2017-03-11');
INSERT INTO disponibilidad VALUES (641, 'LA098', 3, '2017-03-11');
INSERT INTO disponibilidad VALUES (642, 'LA098', 4, '2017-03-11');
INSERT INTO disponibilidad VALUES (643, 'LA099', 1, '2017-03-10');
INSERT INTO disponibilidad VALUES (644, 'LA099', 2, '2017-03-10');
INSERT INTO disponibilidad VALUES (645, 'LA099', 3, '2017-03-10');
INSERT INTO disponibilidad VALUES (646, 'LA099', 4, '2017-03-10');
INSERT INTO disponibilidad VALUES (647, 'LA099', 1, '2017-03-10');
INSERT INTO disponibilidad VALUES (648, 'LA099', 2, '2017-03-10');
INSERT INTO disponibilidad VALUES (649, 'LA099', 3, '2017-03-10');
INSERT INTO disponibilidad VALUES (650, 'LA099', 4, '2017-03-10');
INSERT INTO disponibilidad VALUES (651, 'LA099', 1, '2017-03-10');
INSERT INTO disponibilidad VALUES (652, 'LA099', 2, '2017-03-10');
INSERT INTO disponibilidad VALUES (653, 'LA099', 3, '2017-03-10');
INSERT INTO disponibilidad VALUES (654, 'LA099', 4, '2017-03-10');
INSERT INTO disponibilidad VALUES (655, 'LA098', 2, '2017-03-12');
INSERT INTO disponibilidad VALUES (656, 'LA099', 1, '2017-03-11');
INSERT INTO disponibilidad VALUES (657, 'LA099', 2, '2017-03-11');
INSERT INTO disponibilidad VALUES (658, 'LA099', 3, '2017-03-11');
INSERT INTO disponibilidad VALUES (659, 'LA099', 4, '2017-03-11');
INSERT INTO disponibilidad VALUES (660, 'LA099', 1, '2017-03-12');
INSERT INTO disponibilidad VALUES (661, 'LA099', 2, '2017-03-12');
INSERT INTO disponibilidad VALUES (662, 'LA099', 3, '2017-03-12');
INSERT INTO disponibilidad VALUES (663, 'LA099', 4, '2017-03-12');
INSERT INTO disponibilidad VALUES (664, 'LA098', 1, '2017-03-14');
INSERT INTO disponibilidad VALUES (665, 'LA099', 1, '2017-03-13');
INSERT INTO disponibilidad VALUES (666, 'LA099', 2, '2017-03-13');
INSERT INTO disponibilidad VALUES (667, 'LA099', 3, '2017-03-13');
INSERT INTO disponibilidad VALUES (668, 'LA099', 4, '2017-03-13');
INSERT INTO disponibilidad VALUES (669, 'LA099', 1, '2017-03-14');
INSERT INTO disponibilidad VALUES (670, 'LA098', 1, '2017-03-16');
INSERT INTO disponibilidad VALUES (671, 'LA098', 2, '2017-03-16');
INSERT INTO disponibilidad VALUES (672, 'LA098', 3, '2017-03-16');
INSERT INTO disponibilidad VALUES (673, 'LA098', 4, '2017-03-16');
INSERT INTO disponibilidad VALUES (674, 'LA099', 1, '2017-03-15');
INSERT INTO disponibilidad VALUES (675, 'LA098', 1, '2017-03-17');
INSERT INTO disponibilidad VALUES (676, 'LA098', 2, '2017-03-17');
INSERT INTO disponibilidad VALUES (677, 'LA098', 3, '2017-03-17');
INSERT INTO disponibilidad VALUES (678, 'LA098', 4, '2017-03-17');
INSERT INTO disponibilidad VALUES (679, 'LA098', 1, '2017-03-18');
INSERT INTO disponibilidad VALUES (680, 'LA098', 2, '2017-03-18');
INSERT INTO disponibilidad VALUES (681, 'LA098', 3, '2017-03-18');
INSERT INTO disponibilidad VALUES (682, 'LA098', 4, '2017-03-18');
INSERT INTO disponibilidad VALUES (683, 'LA099', 1, '2017-03-17');
INSERT INTO disponibilidad VALUES (684, 'LA099', 2, '2017-03-17');
INSERT INTO disponibilidad VALUES (685, 'LA099', 3, '2017-03-17');
INSERT INTO disponibilidad VALUES (686, 'LA099', 4, '2017-03-17');
INSERT INTO disponibilidad VALUES (687, 'LA099', 1, '2017-03-18');


--
-- TOC entry 2378 (class 0 OID 0)
-- Dependencies: 191
-- Name: disponibilidad_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('disponibilidad_id_seq', 688, false);


--
-- TOC entry 2321 (class 0 OID 16533)
-- Dependencies: 193
-- Data for Name: empresa; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO empresa VALUES ('J315678900', '* TRIAL * TRIA', 13, 'Barquisimeto', '* TRIAL * TRIAL *', '-69.3728781326904', 'info.tumedico@gmail.com', '04160385170', 1);
INSERT INTO empresa VALUES ('V-19850475-7', 'APL', 13, '* TRIAL * TRIAL * TRIAL * TRI', '10.069037976263974', '* TRIAL * TRIAL * ', 'kuzgu.ca@gmail.com', '04168532655', 1);
INSERT INTO empresa VALUES ('V-20', '* TRIAL ', 13, 'Barquisimeto', '10.072133329199199', '* TRIAL * TRIAL * ', 'alasmail@gmail.com', '02512536581', 1);
INSERT INTO empresa VALUES ('J003192350', 'Makro Comercializadora C.A,', 13, 'Barquisimeto', '10.068681427580017', '-69.35849076353452', 'st05grrhh@makro.com.ve', '0251-2374433', 1);
INSERT INTO empresa VALUES ('J-406819212', 'Logic Service C.A.', 13, 'Barquisimeto', '10.071808238052505', '-69.31909447752378', 'operaciones@upy3.com', '0251-2336302', 1);
INSERT INTO empresa VALUES ('V60', 'Prueba de Empresa', 13, 'Barquisimeto', '* TRIAL * TRIAL * ', '-69.31892484886015', 'pruebadee@gmail.com', '04261445612', 1);
INSERT INTO empresa VALUES ('4545', 'Prueba2', 13, 'Barquisimeto', '10.0677719', '-69.34735089999998', '* TRIAL * T', '02514561289', 1);
INSERT INTO empresa VALUES ('420', 'Prueba3', 13, 'Barquisimeto', '10.035065246438322', '-69.24857050639952', 'h1@gmail.com', '* TRIAL * T', 1);
INSERT INTO empresa VALUES ('17196447', 'Textiles MayÂ´s', 1, 'Carrera 25 entre 27 y 28 Barquisimeto', '* TRIAL * TRIAL * ', '* TRIAL * TRIAL * ', 'maybrith1411@gmail.com', '04168589550', 1);
INSERT INTO empresa VALUES ('t12345', 'Tinitarias Hotel', 1, '* TRIAL * TR', '10.079259642914923', '-69.28101987106169', 'trinitariashotel@gmail.com', 'TelÃ©fono', 1);
INSERT INTO empresa VALUES ('12345678', 'empresa-oscar', 13, NULL, NULL, NULL, '* TRIAL * TRIAL * TRIAL', '* TRIAL * T', 1);
INSERT INTO empresa VALUES ('001', 'KowaTx', 1, '* TRIAL * TRIAL * TRIAL * TRIAL * ', '10.065236618877', '* TRIAL * TRIAL * ', '* TRIAL * TRIAL ', '04262568601', 1);
INSERT INTO empresa VALUES ('3424', '* TRIAL * TR', 1, 'rerter', '10.0677719', '-69.34735089999998', '3656', '3423423', 1);
INSERT INTO empresa VALUES ('12345677', 'narvis', 1, 'Barquisimeto', '10.0677719', '* TRIAL * TRIAL * ', 'ngil@marna.com.ve', '04262568601', 1);


--
-- TOC entry 2323 (class 0 OID 16540)
-- Dependencies: 195
-- Data for Name: estado; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO estado VALUES (1, 17, 'Amazonas');
INSERT INTO estado VALUES (2, 17, 'Anzoátegui');
INSERT INTO estado VALUES (3, 17, 'Apure');
INSERT INTO estado VALUES (4, 17, 'Aragua');
INSERT INTO estado VALUES (5, 17, 'Barinas');
INSERT INTO estado VALUES (6, 17, 'Bolívar');
INSERT INTO estado VALUES (7, 17, 'Carabobo');
INSERT INTO estado VALUES (8, 17, 'Cojedes');
INSERT INTO estado VALUES (9, 17, 'Delta Amacuro');
INSERT INTO estado VALUES (10, 17, '* TRIAL * TRIAL ');
INSERT INTO estado VALUES (11, 17, 'Falcón');
INSERT INTO estado VALUES (12, 17, 'Guárico');
INSERT INTO estado VALUES (13, 17, 'Lara');
INSERT INTO estado VALUES (14, 17, 'Mérida');
INSERT INTO estado VALUES (15, 17, 'Miranda');
INSERT INTO estado VALUES (16, 17, 'Monagas');
INSERT INTO estado VALUES (17, 17, 'Nueva Esparta');
INSERT INTO estado VALUES (18, 17, '* TRIAL * ');
INSERT INTO estado VALUES (19, 17, 'Sucre');
INSERT INTO estado VALUES (20, 17, 'Táchira');
INSERT INTO estado VALUES (21, 17, '* TRIAL ');
INSERT INTO estado VALUES (22, 17, 'Vargas');
INSERT INTO estado VALUES (23, 17, 'Yaracuy');
INSERT INTO estado VALUES (24, 17, 'Zulia');
INSERT INTO estado VALUES (25, 12, 'Carazo');
INSERT INTO estado VALUES (26, 12, '* TRIAL * ');
INSERT INTO estado VALUES (27, 12, 'Boaco');
INSERT INTO estado VALUES (28, 12, '* TRIAL *');
INSERT INTO estado VALUES (29, 12, 'Esteli');
INSERT INTO estado VALUES (30, 12, 'Granada');
INSERT INTO estado VALUES (31, 12, '* TRIAL ');
INSERT INTO estado VALUES (32, 12, 'León');
INSERT INTO estado VALUES (33, 12, 'Madriz');
INSERT INTO estado VALUES (34, 12, 'Managua');
INSERT INTO estado VALUES (35, 12, '* TRIAL *');
INSERT INTO estado VALUES (36, 12, 'Masaya');
INSERT INTO estado VALUES (37, 12, 'Nueva Segovia');
INSERT INTO estado VALUES (38, 12, 'Río San Juan');
INSERT INTO estado VALUES (39, 12, 'Rivas');
INSERT INTO estado VALUES (40, 12, 'Atlántico Norte');
INSERT INTO estado VALUES (41, 12, 'Atlántico Sur');
INSERT INTO estado VALUES (42, 4, 'Región de Arica y Pa');
INSERT INTO estado VALUES (43, 4, '* TRIAL * TRIAL * ');
INSERT INTO estado VALUES (44, 4, '* TRIAL * TRIAL * TR');
INSERT INTO estado VALUES (45, 4, '* TRIAL * TRIAL *');
INSERT INTO estado VALUES (46, 4, 'Región de Coquimbo');
INSERT INTO estado VALUES (47, 4, 'Región de Valparaíso');
INSERT INTO estado VALUES (48, 4, '* TRIAL * TRIAL * TR');
INSERT INTO estado VALUES (49, 4, '* TRIAL * TRIAL * TR');
INSERT INTO estado VALUES (50, 4, 'Región del Maule');
INSERT INTO estado VALUES (51, 4, '* TRIAL * TRIAL *');
INSERT INTO estado VALUES (52, 4, 'Región de La Araucan');
INSERT INTO estado VALUES (53, 4, 'Región de Los Ríos');
INSERT INTO estado VALUES (54, 4, '* TRIAL * TRIAL * T');
INSERT INTO estado VALUES (55, 4, 'Región de Aysén del ');
INSERT INTO estado VALUES (56, 4, 'Región de Magallanes');


--
-- TOC entry 2379 (class 0 OID 0)
-- Dependencies: 194
-- Name: estado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('estado_id_seq', 57, false);


--
-- TOC entry 2325 (class 0 OID 16546)
-- Dependencies: 197
-- Data for Name: incidencia; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO incidencia VALUES (1, 3, 'LA099', 21048193, '2016-11-22', '16:26:27', 1);
INSERT INTO incidencia VALUES (2, 3, 'LA099', 21148192, '2016-11-22', '16:26:44', 1);
INSERT INTO incidencia VALUES (3, 3, 'LA099', 21048192, '2016-11-22', '16:26:58', 1);
INSERT INTO incidencia VALUES (4, 3, 'LA099', 21048192, '2016-11-22', '16:27:27', 1);
INSERT INTO incidencia VALUES (5, 3, 'LA099', 21048192, '2016-11-22', '16:27:44', 1);
INSERT INTO incidencia VALUES (6, 4, 'LA099', 0, '2016-11-22', '16:28:40', 1);
INSERT INTO incidencia VALUES (7, 2, 'LA099', 0, '2016-11-22', '16:29:32', 1);
INSERT INTO incidencia VALUES (8, 4, 'LA099', 0, '2016-11-23', '11:32:09', 1);
INSERT INTO incidencia VALUES (9, 4, 'LA099', 0, '2016-11-24', '09:56:13', 1);
INSERT INTO incidencia VALUES (10, 2, 'LA099', 0, '2016-11-24', '09:57:31', 1);
INSERT INTO incidencia VALUES (11, 1, 'n80', 0, '2016-11-28', '17:14:25', 1);
INSERT INTO incidencia VALUES (12, 4, 'n80', 0, '2016-11-28', '17:14:31', 1);
INSERT INTO incidencia VALUES (13, 2, 'n80', 0, '2016-11-28', '17:14:33', 1);
INSERT INTO incidencia VALUES (14, 3, 'n80', 12345, '2016-12-18', '20:05:09', 1);
INSERT INTO incidencia VALUES (15, 3, 'n80', 12345, '2016-12-18', '20:08:20', 1);
INSERT INTO incidencia VALUES (16, 4, 'LA099', 0, '2016-12-22', '12:09:19', 1);
INSERT INTO incidencia VALUES (17, 4, 'LA099', 0, '2016-12-22', '12:09:20', 1);
INSERT INTO incidencia VALUES (18, 2, 'LA099', 0, '2016-12-22', '12:10:14', 1);
INSERT INTO incidencia VALUES (19, 4, 'LA099', 0, '2016-12-22', '16:08:43', 1);
INSERT INTO incidencia VALUES (20, 4, 'LA099', 0, '2017-01-01', '19:08:38', 0);
INSERT INTO incidencia VALUES (21, 4, 'LA099', 0, '2017-01-01', '19:19:13', 0);
INSERT INTO incidencia VALUES (22, 4, 'LA099', 0, '2017-01-01', '20:41:06', 0);
INSERT INTO incidencia VALUES (23, 4, 'LA099', 0, '2017-01-02', '08:41:57', 0);
INSERT INTO incidencia VALUES (24, 2, 'LA099', 0, '2017-01-02', '08:41:59', 0);
INSERT INTO incidencia VALUES (25, 1, 'LA099', 0, '2017-01-02', '08:42:03', 0);
INSERT INTO incidencia VALUES (26, 4, 'LA099', 0, '2017-01-02', '10:35:40', 0);
INSERT INTO incidencia VALUES (27, 4, 'LA099', 0, '2017-01-02', '14:14:12', 0);
INSERT INTO incidencia VALUES (28, 4, 'LA099', 0, '2017-01-03', '14:06:25', 0);
INSERT INTO incidencia VALUES (29, 4, 'LA099', 0, '2017-01-03', '14:52:29', 0);
INSERT INTO incidencia VALUES (30, 4, 'LA099', 0, '2017-01-03', '16:41:26', 0);
INSERT INTO incidencia VALUES (31, 4, 'LA099', 0, '2017-01-03', '16:56:47', 0);
INSERT INTO incidencia VALUES (32, 3, 'LA098', 15597542, '2017-01-04', '12:06:00', 0);
INSERT INTO incidencia VALUES (33, 4, 'LA098', 0, '2017-01-04', '12:08:49', 1);
INSERT INTO incidencia VALUES (34, 2, 'LA098', 0, '2017-01-04', '12:11:12', 0);
INSERT INTO incidencia VALUES (35, 4, 'LA098', 0, '2017-01-04', '12:12:15', 0);
INSERT INTO incidencia VALUES (36, 4, 'LA099', 0, '2017-01-04', '17:24:51', 0);
INSERT INTO incidencia VALUES (37, 4, 'LA099', 0, '2017-01-04', '19:10:24', 0);
INSERT INTO incidencia VALUES (38, 4, 'LA098', 0, '2017-01-05', '02:52:21', 0);
INSERT INTO incidencia VALUES (39, 2, 'LA098', 0, '2017-01-05', '02:52:24', 0);
INSERT INTO incidencia VALUES (40, 1, 'LA098', 0, '2017-01-05', '02:52:27', 0);
INSERT INTO incidencia VALUES (41, 1, 'LA098', 0, '2017-01-06', '11:13:56', 0);
INSERT INTO incidencia VALUES (42, 1, 'LA098', 0, '2017-01-06', '12:16:38', 0);
INSERT INTO incidencia VALUES (43, 4, 'LA099', 0, '2017-01-08', '09:53:23', 0);
INSERT INTO incidencia VALUES (44, 2, 'LA099', 0, '2017-01-08', '09:53:24', 0);
INSERT INTO incidencia VALUES (45, 1, 'LA099', 0, '2017-01-08', '09:53:27', 0);
INSERT INTO incidencia VALUES (46, 1, 'LA099', 0, '2017-01-08', '09:53:32', 0);
INSERT INTO incidencia VALUES (47, 4, 'LA099', 0, '2017-01-08', '10:08:20', 0);
INSERT INTO incidencia VALUES (48, 4, 'LA099', 0, '2017-01-09', '10:07:55', 0);
INSERT INTO incidencia VALUES (49, 2, 'LA099', 0, '2017-01-09', '10:08:14', 0);
INSERT INTO incidencia VALUES (50, 1, 'LA099', 0, '2017-01-09', '10:08:52', 0);
INSERT INTO incidencia VALUES (51, 4, 'LA099', 0, '2017-01-09', '11:26:59', 0);
INSERT INTO incidencia VALUES (52, 4, 'LA099', 0, '2017-01-09', '20:48:00', 0);
INSERT INTO incidencia VALUES (53, 4, 'LA099', 0, '2017-01-10', '10:20:24', 0);
INSERT INTO incidencia VALUES (54, 1, 'LA098', 0, '2017-01-10', '15:04:23', 0);
INSERT INTO incidencia VALUES (55, 4, 'LA099', 0, '2017-01-10', '15:31:11', 0);
INSERT INTO incidencia VALUES (56, 4, 'LA099', 0, '2017-01-11', '14:40:02', 0);
INSERT INTO incidencia VALUES (57, 4, 'LA099', 0, '2017-01-13', '11:40:08', 0);
INSERT INTO incidencia VALUES (58, 4, 'LA099', 0, '2017-01-13', '12:13:50', 0);
INSERT INTO incidencia VALUES (59, 4, 'LA099', 0, '2017-01-13', '14:00:58', 0);
INSERT INTO incidencia VALUES (60, 4, 'LA099', 0, '2017-01-14', '12:10:02', 0);
INSERT INTO incidencia VALUES (61, 4, 'LA099', 0, '2017-01-15', '12:20:22', 0);
INSERT INTO incidencia VALUES (62, 4, 'LA099', 0, '2017-01-18', '11:06:18', 0);
INSERT INTO incidencia VALUES (63, 4, 'LA099', 0, '2017-01-24', '15:19:55', 0);
INSERT INTO incidencia VALUES (64, 4, 'LA099', 0, '2017-01-24', '20:52:02', 0);
INSERT INTO incidencia VALUES (65, 4, 'LA099', 0, '2017-01-26', '23:06:11', 0);
INSERT INTO incidencia VALUES (66, 4, 'LA099', 0, '2017-01-29', '13:00:36', 0);
INSERT INTO incidencia VALUES (67, 4, 'LA099', 0, '2017-01-30', '10:27:05', 0);
INSERT INTO incidencia VALUES (68, 4, 'LA099', 0, '2017-01-31', '16:51:44', 0);
INSERT INTO incidencia VALUES (69, 4, 'LA099', 0, '2017-02-01', '20:54:31', 0);
INSERT INTO incidencia VALUES (70, 1, 'LA098', 0, '2017-02-02', '02:51:31', 0);
INSERT INTO incidencia VALUES (71, 4, 'LA098', 0, '2017-02-02', '02:51:59', 0);
INSERT INTO incidencia VALUES (72, 1, 'LA098', 0, '2017-02-02', '02:51:59', 0);
INSERT INTO incidencia VALUES (73, 2, 'LA098', 0, '2017-02-02', '02:51:59', 0);
INSERT INTO incidencia VALUES (74, 4, 'LA099', 0, '2017-02-03', '11:44:59', 0);
INSERT INTO incidencia VALUES (75, 1, 'LA098', 0, '2017-02-05', '06:26:19', 0);
INSERT INTO incidencia VALUES (76, 4, 'LA099', 0, '2017-02-06', '11:47:36', 0);
INSERT INTO incidencia VALUES (77, 4, 'LA099', 0, '2017-02-07', '12:43:06', 0);
INSERT INTO incidencia VALUES (78, 1, 'LA098', 0, '2017-02-08', '07:45:55', 0);
INSERT INTO incidencia VALUES (79, 4, 'LA099', 0, '2017-02-09', '22:02:13', 0);
INSERT INTO incidencia VALUES (80, 1, 'LA098', 0, '2017-02-13', '14:04:49', 0);
INSERT INTO incidencia VALUES (81, 4, 'LA099', 0, '2017-02-17', '09:57:43', 0);
INSERT INTO incidencia VALUES (82, 4, 'LA099', 0, '2017-02-21', '09:23:38', 0);
INSERT INTO incidencia VALUES (83, 1, 'LA098', 0, '2017-02-21', '15:10:59', 0);
INSERT INTO incidencia VALUES (84, 4, 'LA099', 0, '2017-02-21', '22:04:48', 0);
INSERT INTO incidencia VALUES (85, 1, 'LA098', 0, '2017-02-24', '19:38:20', 0);
INSERT INTO incidencia VALUES (86, 4, 'LA099', 0, '2017-03-02', '12:00:24', 0);
INSERT INTO incidencia VALUES (87, 4, 'LA099', 0, '2017-03-02', '12:01:32', 0);
INSERT INTO incidencia VALUES (88, 4, 'LA099', 0, '2017-03-07', '21:09:02', 0);
INSERT INTO incidencia VALUES (89, 4, 'LA099', 0, '2017-03-08', '09:06:08', 0);
INSERT INTO incidencia VALUES (90, 4, 'LA099', 0, '2017-03-08', '09:07:58', 1);
INSERT INTO incidencia VALUES (91, 1, 'LA098', 0, '2017-03-08', '12:29:09', 1);
INSERT INTO incidencia VALUES (92, 1, 'LA099', 0, '2017-03-09', '10:02:54', 0);
INSERT INTO incidencia VALUES (93, 4, 'LA099', 0, '2017-03-09', '10:10:35', 1);
INSERT INTO incidencia VALUES (94, 4, 'LA099', 0, '2017-03-09', '10:21:31', 0);
INSERT INTO incidencia VALUES (95, 2, 'LA099', 0, '2017-03-09', '10:21:41', 0);
INSERT INTO incidencia VALUES (96, 1, 'LA099', 0, '2017-03-09', '10:21:42', 0);
INSERT INTO incidencia VALUES (97, 3, 'LA099', 20853548, '2017-03-09', '11:00:27', 1);
INSERT INTO incidencia VALUES (98, 3, 'LA099', 55445566, '2017-03-09', '14:36:23', 1);
INSERT INTO incidencia VALUES (99, 3, 'LA099', 222, '2017-03-09', '14:36:33', 1);
INSERT INTO incidencia VALUES (100, 4, 'LA098', 0, '2017-03-10', '08:02:56', 1);
INSERT INTO incidencia VALUES (101, 2, 'LA098', 0, '2017-03-10', '08:02:56', 0);
INSERT INTO incidencia VALUES (102, 1, 'LA098', 0, '2017-03-10', '08:02:57', 0);
INSERT INTO incidencia VALUES (103, 4, 'LA099', 0, '2017-03-11', '18:52:35', 0);
INSERT INTO incidencia VALUES (104, 4, 'LA099', 0, '2017-03-13', '11:18:42', 0);
INSERT INTO incidencia VALUES (105, 4, 'LA099', 0, '2017-03-14', '12:23:25', 0);
INSERT INTO incidencia VALUES (106, 4, 'LA099', 0, '2017-03-16', '20:37:18', 0);
INSERT INTO incidencia VALUES (107, 4, 'LA099', 0, '2017-03-17', '09:03:07', 0);


--
-- TOC entry 2380 (class 0 OID 0)
-- Dependencies: 196
-- Name: incidencia_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('incidencia_id_seq', 108, false);


--
-- TOC entry 2327 (class 0 OID 16554)
-- Dependencies: 199
-- Data for Name: noticia; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO noticia VALUES (1, '* TRIAL * ', '* TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * T', 'images/noticias/1.jpg', '2017-03-09');
INSERT INTO noticia VALUES (2, 'Email Test', '* TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * TRIAL * T', '* TRIAL * TRIAL * TRI', '2017-03-09');
INSERT INTO noticia VALUES (3, '* TRIAL * ', 'Esta es una prueba para el envio de correo desde UPY3 Portal Admin ', '* TRIAL * TRIAL * TRI', '2017-03-09');
INSERT INTO noticia VALUES (4, 'Email Test 2', 'Esta es una prueba para el envio de correo desde UPY3 Portal Admin ', 'images/noticias/1.jpg', '2017-03-09');


--
-- TOC entry 2381 (class 0 OID 0)
-- Dependencies: 198
-- Name: noticia_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('noticia_id_seq', 5, false);


--
-- TOC entry 2329 (class 0 OID 16563)
-- Dependencies: 201
-- Data for Name: pais; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO pais VALUES (1, 'Argentina');
INSERT INTO pais VALUES (2, 'Bolivia');
INSERT INTO pais VALUES (3, 'Brasil');
INSERT INTO pais VALUES (4, 'Chile');
INSERT INTO pais VALUES (5, 'Colombia');
INSERT INTO pais VALUES (6, 'Costa Rica');
INSERT INTO pais VALUES (7, 'Ecuador');
INSERT INTO pais VALUES (8, 'El Salvador');
INSERT INTO pais VALUES (9, 'Guatemala');
INSERT INTO pais VALUES (10, 'Honduras');
INSERT INTO pais VALUES (11, 'México');
INSERT INTO pais VALUES (12, 'Nicaragua');
INSERT INTO pais VALUES (13, 'Panamá');
INSERT INTO pais VALUES (14, 'Paraguay');
INSERT INTO pais VALUES (15, 'Perú');
INSERT INTO pais VALUES (16, 'Uruguay');
INSERT INTO pais VALUES (17, 'Venezuela');


--
-- TOC entry 2382 (class 0 OID 0)
-- Dependencies: 200
-- Name: pais_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pais_id_seq', 18, false);


--
-- TOC entry 2331 (class 0 OID 16569)
-- Dependencies: 203
-- Data for Name: parada; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO parada VALUES (19, '10.09077972167601', '-69.3728781326904', '10.026107547268847', '* TRIAL * TRIAL * ', '* TRIAL ', '13:00:00');
INSERT INTO parada VALUES (2, '10.072133329199199', '-69.33893144590223', '10.072133329199199', '* TRIAL * TRIAL * ', 'V-20', '00:00:00');
INSERT INTO parada VALUES (15, '10.0677719', '-69.3473509', '10.072133329199199', '-69.33893144590223', '1233', '07:00:00');
INSERT INTO parada VALUES (14, '10.072133329199199', '-69.33893144590223', '10.0677719', '-69.3473509', '1233', '14:00:00');
INSERT INTO parada VALUES (23, '* TRIAL * TRIAL *', '* TRIAL * TRIAL *', '* TRIAL * TRIAL *', '-69.32103094377442', '16033907', '14:00:00');
INSERT INTO parada VALUES (22, '10.08969800109257', '* TRIAL * TRIAL * ', '* TRIAL * TRIAL *', '-69.3728781326904', '16033907', '05:20:00');
INSERT INTO parada VALUES (18, '10.026107547268847', '* TRIAL * TRIAL * ', '10.09077972167601', '* TRIAL * TRIAL *', '15263382', '06:00:00');
INSERT INTO parada VALUES (24, '* TRIAL * TRIAL *', '* TRIAL * TRIAL * ', '10.09077972167601', '-69.3728781326904', '20349310', '05:20:00');
INSERT INTO parada VALUES (25, '10.09077972167601', '* TRIAL * TRIAL *', '10.05897418903881', '-69.34427782316891', '* TRIAL ', '14:00:00');
INSERT INTO parada VALUES (122, '10.0581297', '* TRIAL * T', '10.065236618877', '* TRIAL * TRIAL * ', '* TRIAL ', '00:00:00');
INSERT INTO parada VALUES (121, '* TRIAL * TRIAL', '-69.34408933383799', '10.0581297', '-69.2718997', '15306717', '10:00:00');
INSERT INTO parada VALUES (106, '10.071761717500454', '-69.31902649867249', '10.071815100769118', '-69.31746146871717', '3323354', '12:42:00');
INSERT INTO parada VALUES (79, '10.06301823155916', '-69.29402858478392', '10.072133329199199', '-69.33893144590223', '34788', '20:00:00');
INSERT INTO parada VALUES (110, '10.071761717500454', '* TRIAL * TRIAL * ', '10.0718732', '* TRIAL * TRIAL * ', '17196447', '11:02:00');
INSERT INTO parada VALUES (31, '10.09077972167601', '-69.3728781326904', '10.062933721264683', '-69.30310518009031', '21503702', '20:45:00');
INSERT INTO parada VALUES (30, '* TRIAL * TRIAL * ', '-69.30310518009031', '* TRIAL * TRIAL *', '-69.3728781326904', '21503702', '13:00:00');
INSERT INTO parada VALUES (32, '10.034580559187255', '-69.23712343322143', '10.09077972167601', '-69.3728781326904', '14094346', '06:00:00');
INSERT INTO parada VALUES (33, '10.09077972167601', '* TRIAL * TRIAL *', '10.034580559187255', '-69.23712343322143', '14094346', '13:00:00');
INSERT INTO parada VALUES (34, '10.029868662207159', '-69.25006240950927', '10.09077972167601', '-69.3728781326904', '* TRIAL ', '12:15:00');
INSERT INTO parada VALUES (35, '10.09077972167601', '* TRIAL * TRIAL *', '10.029868662207159', '-69.25006240950927', '* TRIAL ', '17:00:00');
INSERT INTO parada VALUES (101, '10.071761717500454', '-69.31902649867249', '10.071815100769118', '-69.31746146871717', '3323354', '10:15:00');
INSERT INTO parada VALUES (91, '* TRIAL * TRI', '* TRIAL * TRIAL ', '10.09077972167601', '-69.3728781326904', '21048192', '16:25:00');
INSERT INTO parada VALUES (38, '* TRIAL * TRIAL * ', '-69.30257097116385', '10.09077972167601', '-69.3728781326904', '19166121', '13:00:00');
INSERT INTO parada VALUES (39, '10.062918417626355', '* TRIAL * TRIAL * ', '10.09077972167601', '-69.3728781326904', '* TRIAL ', '13:00:00');
INSERT INTO parada VALUES (40, '10.09077972167601', '-69.3728781326904', '10.062918417626355', '* TRIAL * TRIAL * ', '19166121', '20:45:00');
INSERT INTO parada VALUES (41, '* TRIAL * TRIAL *', '* TRIAL * TRIAL *', '10.062918417626355', '-69.30257097116385', '19166121', '20:45:00');
INSERT INTO parada VALUES (42, '10.085042972367024', '* TRIAL * TRIAL * ', '* TRIAL * TRIAL *', '-69.3728781326904', '10738622', '12:30:00');
INSERT INTO parada VALUES (43, '* TRIAL * TRIAL *', '-69.3728781326904', '10.085042972367024', '-69.31634456378731', '10738622', '16:00:00');
INSERT INTO parada VALUES (44, '10.09077972167601', '-69.3728781326904', '10.0503836970861', '-69.38214451534117', '12852967', '21:00:00');
INSERT INTO parada VALUES (53, '* TRIAL * TRIAL * ', '-69.33893144590223', '10.0677719', '-69.3473509', '1233', '21:00:00');
INSERT INTO parada VALUES (54, '* TRIAL * TRIAL ', '-69.33983535034025', '* TRIAL * TRIAL * ', '* TRIAL * TRIAL * ', '502877', '18:00:00');
INSERT INTO parada VALUES (55, '10.072133329199199', '* TRIAL * TRIAL * ', '10.0906202218798', '-69.33983535034025', '502877', '09:00:00');
INSERT INTO parada VALUES (59, '* TRIAL * TRIAL * ', '* TRIAL * TRIAL * ', '10.071838871863102', '-69.31892484886015', 'V60', '00:00:00');
INSERT INTO parada VALUES (60, '10.0677719', '* TRIAL * T', '* TRIAL * ', '-69.3473509', '4545', '00:00:00');
INSERT INTO parada VALUES (61, '10.035065246438322', '-69.24857050639952', '* TRIAL * TRIAL * ', '* TRIAL * TRIAL * ', '420', '00:00:00');
INSERT INTO parada VALUES (62, '10.0677719', '-69.3473509', '* TRIAL * TRIAL * ', '-69.24857050639952', '30', '17:15:00');
INSERT INTO parada VALUES (63, '* TRIAL * TRIAL * ', '-69.24857050639952', '10.0677719', '* TRIAL * T', '30', '04:15:00');
INSERT INTO parada VALUES (64, '10.089320984884397', '-69.30417806369627', '10.0677719', '-69.3473509', '67', '18:25:00');
INSERT INTO parada VALUES (65, '10.0677719', '-69.3473509', '10.089320984884397', '-69.30417806369627', '67', '08:00:00');
INSERT INTO parada VALUES (66, '* TRIAL * TRIAL *', '-69.3728781326904', '10.09077972167601', '69.3728781326904', 'J315678900', '00:00:00');
INSERT INTO parada VALUES (104, '* TRIAL * TRIAL * ', '* TRIAL * TRIAL * ', '10.079259642914923', '-69.28101987106169', 't12345', '00:00:00');
INSERT INTO parada VALUES (113, '10.065236618877', '-69.34408933383799', '* TRIAL * TRIAL', '* TRIAL * TRIAL * ', '001', '00:00:00');
INSERT INTO parada VALUES (80, '10.072133329199199', '-69.33893144590223', '10.06301823155916', '-69.29402858478392', '34788', '15:10:00');
INSERT INTO parada VALUES (81, '10.177140496527274', '-70.0823842553558', '10.072133329199199', '-69.33893144590223', '3471', '20:00:00');
INSERT INTO parada VALUES (82, '10.072133329199199', '* TRIAL * TRIAL * ', '* TRIAL * TRIAL * ', '* TRIAL * TRIAL *', '3471', '15:10:00');
INSERT INTO parada VALUES (84, '10.17755233745117', '* TRIAL * TRIAL * ', '10.072133329199199', '-69.33893144590223', '12099923', '12:00:00');
INSERT INTO parada VALUES (85, '* TRIAL * TRIAL * ', '-69.33893144590223', '10.17755233745117', '-70.07997026724229', '12099923', '15:30:00');
INSERT INTO parada VALUES (86, '* TRIAL * TRIAL * ', '-69.33893144590223', '10.17755233745117', '* TRIAL * TRIAL * ', '12099923', '16:30:00');
INSERT INTO parada VALUES (87, '* TRIAL * TRIAL * ', '-69.33893144590223', '10.17755233745117', '-70.07997026724229', '12099923', '16:00:00');
INSERT INTO parada VALUES (112, '10.071782844498', '-69.31898894774679', '10.09077972167601', '-69.3728781326904', '15597540', '12:10:00');
INSERT INTO parada VALUES (36, '* TRIAL * TRI', '* TRIAL * TRIAL ', '10.09077972167601', '-69.3728781326904', '21048192', '05:20:00');
INSERT INTO parada VALUES (92, '10.0717617175', '-69.319058685181', '10.09077972167601', '-69.3728781326904', '* TRIAL ', '16:28:00');
INSERT INTO parada VALUES (114, '* TRIAL * TRIAL', '* TRIAL * TRIAL * ', '10.065236618877', '-69.34408933383799', '001', '00:00:00');
INSERT INTO parada VALUES (115, '10.065236618877', '-69.34408933383799', '* TRIAL * TRIAL', '-69.34408933383799', '001', '00:00:00');
INSERT INTO parada VALUES (116, '10.0677719', '-69.3473509', '10.0677719', '-69.3473509', '3424', '00:00:00');
INSERT INTO parada VALUES (117, '* TRIAL * ', '* TRIAL * T', '10.0677719', '* TRIAL * T', '23445', '00:00:00');
INSERT INTO parada VALUES (118, '* TRIAL * ', '-69.34735089999998', '10.065236618877', '-69.34408933383799', '21459969', '17:03:00');
INSERT INTO parada VALUES (119, '10.065236618877', '-69.34408933383799', '* TRIAL * ', '-69.34735089999998', '21459969', '08:03:00');
INSERT INTO parada VALUES (120, '10.0677719', '-69.34735089999998', '10.0677719', '-69.34735089999998', '* TRIAL ', '00:00:00');
INSERT INTO parada VALUES (123, '10.065236618877', '* TRIAL * TRIAL * ', '10.0677719', '-69.34735089999998', '* TRIAL ', '09:17:00');
INSERT INTO parada VALUES (124, '10.0677719', '-69.34735089999998', '10.065236618877', '-69.34408933383799', '22272210', '17:30:00');


--
-- TOC entry 2383 (class 0 OID 0)
-- Dependencies: 202
-- Name: parada_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('parada_id_seq', 125, false);


--
-- TOC entry 2333 (class 0 OID 16575)
-- Dependencies: 205
-- Data for Name: parada_ruta; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO parada_ruta VALUES (3, 1, 3, 1);
INSERT INTO parada_ruta VALUES (4, 1, 2, 1);
INSERT INTO parada_ruta VALUES (19, 4, 3, 1);
INSERT INTO parada_ruta VALUES (20, 4, 2, 1);
INSERT INTO parada_ruta VALUES (21, 2, 3, 1);
INSERT INTO parada_ruta VALUES (22, 2, 2, 1);
INSERT INTO parada_ruta VALUES (23, 3, 3, 1);
INSERT INTO parada_ruta VALUES (24, 3, 2, 1);
INSERT INTO parada_ruta VALUES (32, 5, 2, 1);
INSERT INTO parada_ruta VALUES (31, 5, 3, 1);
INSERT INTO parada_ruta VALUES (44, 6, 27, 1);
INSERT INTO parada_ruta VALUES (34, 7, 27, 1);
INSERT INTO parada_ruta VALUES (43, 6, 41, 1);
INSERT INTO parada_ruta VALUES (42, 6, 31, 1);
INSERT INTO parada_ruta VALUES (45, 8, 41, 1);
INSERT INTO parada_ruta VALUES (46, 9, 27, 1);
INSERT INTO parada_ruta VALUES (47, 8, 31, 1);
INSERT INTO parada_ruta VALUES (48, 10, 45, 1);
INSERT INTO parada_ruta VALUES (49, 11, 46, 1);
INSERT INTO parada_ruta VALUES (50, 12, 47, 1);
INSERT INTO parada_ruta VALUES (52, 14, 49, 1);
INSERT INTO parada_ruta VALUES (53, 15, 15, 1);
INSERT INTO parada_ruta VALUES (54, 15, 2, 1);
INSERT INTO parada_ruta VALUES (55, 16, 52, 1);
INSERT INTO parada_ruta VALUES (59, 17, 2, 1);
INSERT INTO parada_ruta VALUES (58, 17, 53, 1);
INSERT INTO parada_ruta VALUES (63, 18, 2, 1);
INSERT INTO parada_ruta VALUES (62, 18, 54, 1);
INSERT INTO parada_ruta VALUES (64, 19, 56, 1);
INSERT INTO parada_ruta VALUES (65, 20, 43, 1);
INSERT INTO parada_ruta VALUES (66, 22, 56, 1);
INSERT INTO parada_ruta VALUES (67, 21, 35, 1);
INSERT INTO parada_ruta VALUES (80, 27, 66, 1);
INSERT INTO parada_ruta VALUES (73, 24, 61, 1);
INSERT INTO parada_ruta VALUES (72, 24, 62, 1);
INSERT INTO parada_ruta VALUES (77, 25, 60, 1);
INSERT INTO parada_ruta VALUES (76, 25, 64, 1);
INSERT INTO parada_ruta VALUES (79, 23, 58, 0);
INSERT INTO parada_ruta VALUES (81, 26, 67, 1);
INSERT INTO parada_ruta VALUES (82, 26, 66, 1);
INSERT INTO parada_ruta VALUES (83, 27, 58, 0);
INSERT INTO parada_ruta VALUES (84, 28, 68, 1);
INSERT INTO parada_ruta VALUES (85, 28, 66, 1);
INSERT INTO parada_ruta VALUES (86, 29, 69, 1);
INSERT INTO parada_ruta VALUES (87, 29, 66, 1);
INSERT INTO parada_ruta VALUES (93, 30, 66, 1);
INSERT INTO parada_ruta VALUES (92, 30, 70, 1);
INSERT INTO parada_ruta VALUES (97, 31, 66, 1);
INSERT INTO parada_ruta VALUES (96, 31, 71, 1);
INSERT INTO parada_ruta VALUES (101, 32, 66, 1);
INSERT INTO parada_ruta VALUES (100, 32, 72, 1);
INSERT INTO parada_ruta VALUES (113, 36, 66, 1);
INSERT INTO parada_ruta VALUES (112, 36, 73, 1);
INSERT INTO parada_ruta VALUES (117, 34, 66, 1);
INSERT INTO parada_ruta VALUES (116, 34, 74, 1);
INSERT INTO parada_ruta VALUES (133, 35, 66, 1);
INSERT INTO parada_ruta VALUES (132, 35, 75, 1);
INSERT INTO parada_ruta VALUES (137, 37, 66, 1);
INSERT INTO parada_ruta VALUES (136, 37, 76, 1);
INSERT INTO parada_ruta VALUES (143, 38, 66, 1);
INSERT INTO parada_ruta VALUES (142, 38, 77, 1);
INSERT INTO parada_ruta VALUES (153, 41, 66, 1);
INSERT INTO parada_ruta VALUES (149, 39, 66, 1);
INSERT INTO parada_ruta VALUES (148, 39, 78, 1);
INSERT INTO parada_ruta VALUES (147, 40, 66, 1);
INSERT INTO parada_ruta VALUES (152, 41, 43, 1);
INSERT INTO parada_ruta VALUES (157, 68, 66, 1);
INSERT INTO parada_ruta VALUES (156, 42, 83, 0);
INSERT INTO parada_ruta VALUES (163, 43, 2, 1);
INSERT INTO parada_ruta VALUES (165, 44, 2, 1);
INSERT INTO parada_ruta VALUES (162, 43, 82, 1);
INSERT INTO parada_ruta VALUES (164, 44, 85, 1);
INSERT INTO parada_ruta VALUES (169, 45, 66, 1);
INSERT INTO parada_ruta VALUES (168, 45, 89, 1);
INSERT INTO parada_ruta VALUES (173, 46, 66, 1);
INSERT INTO parada_ruta VALUES (172, 46, 90, 1);
INSERT INTO parada_ruta VALUES (179, 47, 66, 1);
INSERT INTO parada_ruta VALUES (178, 47, 91, 1);
INSERT INTO parada_ruta VALUES (183, 69, 66, 1);
INSERT INTO parada_ruta VALUES (182, 48, 92, 0);
INSERT INTO parada_ruta VALUES (187, 70, 66, 1);
INSERT INTO parada_ruta VALUES (186, 49, 93, 0);
INSERT INTO parada_ruta VALUES (191, 50, 66, 1);
INSERT INTO parada_ruta VALUES (190, 50, 94, 1);
INSERT INTO parada_ruta VALUES (195, 51, 66, 1);
INSERT INTO parada_ruta VALUES (194, 51, 95, 1);
INSERT INTO parada_ruta VALUES (196, 52, 96, 0);
INSERT INTO parada_ruta VALUES (197, 71, 66, 1);
INSERT INTO parada_ruta VALUES (203, 53, 66, 1);
INSERT INTO parada_ruta VALUES (202, 53, 97, 1);
INSERT INTO parada_ruta VALUES (205, 54, 98, 1);
INSERT INTO parada_ruta VALUES (204, 54, 99, 1);
INSERT INTO parada_ruta VALUES (206, 55, 101, 1);
INSERT INTO parada_ruta VALUES (207, 55, 98, 1);
INSERT INTO parada_ruta VALUES (211, 56, 98, 0);
INSERT INTO parada_ruta VALUES (210, 56, 101, 0);
INSERT INTO parada_ruta VALUES (215, 57, 103, 1);
INSERT INTO parada_ruta VALUES (214, 57, 103, 1);
INSERT INTO parada_ruta VALUES (252, 63, 2, 1);
INSERT INTO parada_ruta VALUES (230, 61, 108, 1);
INSERT INTO parada_ruta VALUES (229, 61, 108, 1);
INSERT INTO parada_ruta VALUES (254, 62, 2, 0);
INSERT INTO parada_ruta VALUES (253, 62, 14, 0);
INSERT INTO parada_ruta VALUES (251, 63, 53, 1);
INSERT INTO parada_ruta VALUES (248, 65, 2, 1);
INSERT INTO parada_ruta VALUES (250, 64, 2, 1);
INSERT INTO parada_ruta VALUES (249, 64, 85, 1);
INSERT INTO parada_ruta VALUES (247, 65, 84, 1);
INSERT INTO parada_ruta VALUES (262, 67, 110, 1);
INSERT INTO parada_ruta VALUES (261, 67, 110, 1);
INSERT INTO parada_ruta VALUES (263, 68, 83, 0);
INSERT INTO parada_ruta VALUES (264, 69, 92, 0);
INSERT INTO parada_ruta VALUES (265, 70, 93, 0);
INSERT INTO parada_ruta VALUES (266, 71, 96, 0);
INSERT INTO parada_ruta VALUES (270, 73, 66, 1);
INSERT INTO parada_ruta VALUES (297, 72, 66, 1);
INSERT INTO parada_ruta VALUES (271, 73, 112, 0);
INSERT INTO parada_ruta VALUES (302, 77, 119, 1);
INSERT INTO parada_ruta VALUES (275, 76, 118, 1);
INSERT INTO parada_ruta VALUES (301, 75, 115, 1);
INSERT INTO parada_ruta VALUES (277, 76, 113, 1);
INSERT INTO parada_ruta VALUES (300, 75, 114, 1);
INSERT INTO parada_ruta VALUES (299, 75, 113, 1);
INSERT INTO parada_ruta VALUES (298, 75, 119, 1);
INSERT INTO parada_ruta VALUES (303, 77, 113, 1);
INSERT INTO parada_ruta VALUES (296, 74, 115, 1);
INSERT INTO parada_ruta VALUES (295, 74, 114, 1);
INSERT INTO parada_ruta VALUES (294, 74, 113, 1);


--
-- TOC entry 2384 (class 0 OID 0)
-- Dependencies: 204
-- Name: parada_ruta_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('parada_ruta_id_seq', 304, false);


--
-- TOC entry 2335 (class 0 OID 16582)
-- Dependencies: 207
-- Data for Name: permiso; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO permiso VALUES (1, 'Empresas en Cola');
INSERT INTO permiso VALUES (2, '* TRIAL * TRIAL ');
INSERT INTO permiso VALUES (3, 'Registrar Empresas');
INSERT INTO permiso VALUES (4, 'Editar Empresas');
INSERT INTO permiso VALUES (5, '* TRIAL * TRIAL ');
INSERT INTO permiso VALUES (6, 'Subir Archivo Driver');
INSERT INTO permiso VALUES (7, 'Editar Driver');
INSERT INTO permiso VALUES (8, '* TRIAL * TRIAL * TRI');
INSERT INTO permiso VALUES (9, 'Registrar Empleados');
INSERT INTO permiso VALUES (10, '* TRIAL * TRIAL * TRIA');
INSERT INTO permiso VALUES (11, '* TRIAL * TRIAL');
INSERT INTO permiso VALUES (12, 'Generar Orden de Servicio');
INSERT INTO permiso VALUES (13, 'Eliminar Orden de Servicio');
INSERT INTO permiso VALUES (14, 'Control de Rutas Básico');
INSERT INTO permiso VALUES (15, 'Control de Rutas Medio');
INSERT INTO permiso VALUES (16, 'Control de Rutas Full');
INSERT INTO permiso VALUES (17, 'Mensajería Móvil');
INSERT INTO permiso VALUES (18, 'Mensajería Web');
INSERT INTO permiso VALUES (19, 'Revisión de Incidencias');
INSERT INTO permiso VALUES (20, '* TRIAL * TRIAL * TRIAL * TRIAL *');
INSERT INTO permiso VALUES (21, 'Costos y Precios por Tipo de Vehículo');
INSERT INTO permiso VALUES (22, 'Edición de Permisos');
INSERT INTO permiso VALUES (23, 'Creación y Edición de Usuarios');
INSERT INTO permiso VALUES (24, '* TRIAL * TRIAL * TRIAL * TRIAL *');
INSERT INTO permiso VALUES (25, '* TRIAL * TRIAL * TRIAL * TRIAL * TR');
INSERT INTO permiso VALUES (26, 'Visualizar Reporte de Incidencias Por Empresa');
INSERT INTO permiso VALUES (27, 'Visualizar Reporte de Rutas Por Empresa');
INSERT INTO permiso VALUES (28, 'Visualizar Reporte de Costos Por Chofer');
INSERT INTO permiso VALUES (29, 'Visualizar Reporte de Rutas de la Empresa');
INSERT INTO permiso VALUES (30, 'Visualizar Reporte de Incidencias de la Empresa');


--
-- TOC entry 2385 (class 0 OID 0)
-- Dependencies: 206
-- Name: permiso_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('permiso_id_seq', 31, false);


--
-- TOC entry 2337 (class 0 OID 16588)
-- Dependencies: 209
-- Data for Name: permiso_rol; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO permiso_rol VALUES (1, 1, 1);
INSERT INTO permiso_rol VALUES (2, 1, 2);
INSERT INTO permiso_rol VALUES (3, 1, 3);
INSERT INTO permiso_rol VALUES (4, 1, 4);
INSERT INTO permiso_rol VALUES (5, 1, 5);
INSERT INTO permiso_rol VALUES (6, 1, 6);
INSERT INTO permiso_rol VALUES (7, 1, 7);
INSERT INTO permiso_rol VALUES (8, 1, 8);
INSERT INTO permiso_rol VALUES (9, 2, 9);
INSERT INTO permiso_rol VALUES (10, 2, 10);
INSERT INTO permiso_rol VALUES (11, 2, 11);
INSERT INTO permiso_rol VALUES (12, 2, 12);
INSERT INTO permiso_rol VALUES (13, 2, 13);
INSERT INTO permiso_rol VALUES (14, 1, 16);
INSERT INTO permiso_rol VALUES (15, 1, 17);
INSERT INTO permiso_rol VALUES (16, 1, 18);
INSERT INTO permiso_rol VALUES (17, 1, 19);
INSERT INTO permiso_rol VALUES (18, 1, 20);
INSERT INTO permiso_rol VALUES (19, 1, 21);
INSERT INTO permiso_rol VALUES (20, 1, 22);
INSERT INTO permiso_rol VALUES (21, 1, 23);
INSERT INTO permiso_rol VALUES (22, 1, 24);
INSERT INTO permiso_rol VALUES (23, 1, 25);
INSERT INTO permiso_rol VALUES (24, 1, 26);
INSERT INTO permiso_rol VALUES (25, 5, 8);
INSERT INTO permiso_rol VALUES (26, 5, 15);
INSERT INTO permiso_rol VALUES (27, 5, 17);
INSERT INTO permiso_rol VALUES (28, 5, 19);
INSERT INTO permiso_rol VALUES (29, 1, 27);
INSERT INTO permiso_rol VALUES (30, 1, 28);
INSERT INTO permiso_rol VALUES (31, 2, 29);
INSERT INTO permiso_rol VALUES (32, 2, 30);


--
-- TOC entry 2386 (class 0 OID 0)
-- Dependencies: 208
-- Name: permiso_rol_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('permiso_rol_id_seq', 33, false);


--
-- TOC entry 2339 (class 0 OID 16594)
-- Dependencies: 211
-- Data for Name: rol; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO rol VALUES (1, 'Super Administrador UPY');
INSERT INTO rol VALUES (2, 'Administrador Empresa');
INSERT INTO rol VALUES (3, 'Chofer');
INSERT INTO rol VALUES (4, 'Empleado');
INSERT INTO rol VALUES (5, 'Operadora');
INSERT INTO rol VALUES (18, '* TRIAL * TRIAL *');
INSERT INTO rol VALUES (19, 'City Manager');
INSERT INTO rol VALUES (20, 'Community Manager');
INSERT INTO rol VALUES (21, 'Supervisor Empresa');
INSERT INTO rol VALUES (22, 'Operario Empresa');


--
-- TOC entry 2387 (class 0 OID 0)
-- Dependencies: 210
-- Name: rol_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('rol_id_seq', 23, false);


--
-- TOC entry 2341 (class 0 OID 16600)
-- Dependencies: 213
-- Data for Name: ruta; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO ruta VALUES (1, '', '2016-10-10', 0, 2, 1000000, 1300000, 0);
INSERT INTO ruta VALUES (2, 'YYYYY', '2016-10-04', 0, 3, 1300000, 1920000, 0);
INSERT INTO ruta VALUES (3, 'YYYYY', '2016-10-04', 1, 2, 1000000, 1440000, 0);
INSERT INTO ruta VALUES (4, 'YYYYY', '2016-10-03', 1, 3, 1300000, 1920000, 0);
INSERT INTO ruta VALUES (5, 'YYYYY', '2016-10-10', 1, 2, 1000000, 1440000, 1);
INSERT INTO ruta VALUES (6, 'YYYYY', '2016-10-21', 0, 2, 1000000, 1440000, 1);
INSERT INTO ruta VALUES (7, '', '2016-10-21', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (8, 'AA11111', '2016-10-21', 0, 1, 0, 0, 1);
INSERT INTO ruta VALUES (9, '', '2016-10-21', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (10, 'AA11111', '2016-10-25', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (11, '', '2016-10-25', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (12, 'AA11111', '2016-10-26', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (14, 'AA11111', '2016-10-31', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (15, 'AA11111', '2016-11-01', 0, 1, 0, 0, 1);
INSERT INTO ruta VALUES (16, '', '2016-11-02', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (17, 'LKP', '2016-11-03', 0, 2, 1000000, 1440000, 1);
INSERT INTO ruta VALUES (18, 'AA11111', '2016-11-03', 0, 2, 1000000, 1440000, 1);
INSERT INTO ruta VALUES (19, 'AA11111', '2016-11-04', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (20, 'LKP', '2016-11-04', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (21, 'AA11111', '2016-11-04', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (22, 'LKP', '2016-11-04', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (23, 'AA11111', '2016-11-07', 1, 2, 1000000, 1440000, 1);
INSERT INTO ruta VALUES (24, 'LKP', '2016-11-07', 0, 3, 1300000, 1800000, 0);
INSERT INTO ruta VALUES (25, 'LKP', '2016-11-07', 0, 2, 1000000, 1440000, 1);
INSERT INTO ruta VALUES (26, 'AA11111', '2016-11-07', 0, 1, 0, 0, 1);
INSERT INTO ruta VALUES (27, 'LKP', '2016-11-09', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (28, 'LKP', '2016-11-09', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (29, '', '2016-11-14', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (30, 'YYYYY', '2016-11-17', 0, 1, 0, 0, 1);
INSERT INTO ruta VALUES (31, 'YYYYY', '2016-11-17', 2, 1, 0, 0, 1);
INSERT INTO ruta VALUES (32, 'YYYYY', '2016-11-17', 0, 1, 0, 0, 1);
INSERT INTO ruta VALUES (33, 'AA008JK', '2016-11-17', 1, 1, 0, 0, 1);
INSERT INTO ruta VALUES (34, 'AA008JK', '2016-11-17', 0, 1, 0, 0, 1);
INSERT INTO ruta VALUES (35, 'ABO47DR', '2016-11-18', 2, 1, 0, 0, 1);
INSERT INTO ruta VALUES (36, '', '2016-11-18', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (37, 'ABO47DR', '2016-11-18', 2, 2, 1000000, 1440000, 0);
INSERT INTO ruta VALUES (38, 'AA259TO', '2016-11-22', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (39, 'AB240WW', '2016-11-22', 0, 1, 0, 0, 1);
INSERT INTO ruta VALUES (40, '', '2016-11-22', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (41, 'AG390MM', '2016-11-22', 0, 1, 0, 0, 1);
INSERT INTO ruta VALUES (42, 'AA008JK', '2016-11-22', 1, 1, 0, 0, 1);
INSERT INTO ruta VALUES (43, 'ABO47DR', '2016-11-22', 0, 3, 1300000, 1800000, 0);
INSERT INTO ruta VALUES (44, 'ABO47DR', '2016-11-22', 0, 3, 1300000, 1800000, 0);
INSERT INTO ruta VALUES (45, 'AG390MM', '2016-11-22', 0, 1, 0, 0, 1);
INSERT INTO ruta VALUES (46, 'AA008JK', '2016-11-22', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (47, 'YYYYY', '2016-11-22', 0, 1, 0, 0, 1);
INSERT INTO ruta VALUES (48, 'AA008JK', '2016-11-22', 1, 1, 0, 0, 1);
INSERT INTO ruta VALUES (49, 'AA008JK', '2016-11-28', 1, 1, 0, 0, 1);
INSERT INTO ruta VALUES (50, 'AA008JK', '2016-12-07', 0, 1, 0, 0, 1);
INSERT INTO ruta VALUES (51, 'AA008JK', '2016-12-12', 0, 1, 0, 0, 1);
INSERT INTO ruta VALUES (52, 'AA008JK', '2016-12-13', 1, 1, 0, 0, 1);
INSERT INTO ruta VALUES (53, 'LKP', '2016-12-14', 2, 1, 0, 0, 1);
INSERT INTO ruta VALUES (54, '', '2016-12-14', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (55, '', '2016-12-14', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (56, 'AA008JK', '2016-12-14', 1, 1, 0, 0, 1);
INSERT INTO ruta VALUES (57, 'AA008JK', '2016-12-14', 0, 1, 0, 0, 1);
INSERT INTO ruta VALUES (61, 'AA008JK', '2016-12-15', 0, 1, 0, 0, 1);
INSERT INTO ruta VALUES (62, 'LKP', '2016-12-18', 1, 1, 0, 0, 1);
INSERT INTO ruta VALUES (63, 'LKP', '2016-12-18', 0, 1, 0, 0, 1);
INSERT INTO ruta VALUES (64, 'LKP', '2016-12-18', 1, 1, 0, 0, 0);
INSERT INTO ruta VALUES (65, 'LKP', '2016-12-18', 1, 1, 0, 0, 0);
INSERT INTO ruta VALUES (67, 'AA008JK', '2016-12-20', 0, 1, 0, 0, 1);
INSERT INTO ruta VALUES (68, '', '2017-01-02', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (69, '', '2017-01-02', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (70, '', '2017-01-02', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (71, '', '2017-01-02', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (72, 'AA008JK', '2017-03-09', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (73, '', '2017-01-05', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (74, 'AA008JK', '2017-03-09', 1, 3, 1300000, 1800000, 1);
INSERT INTO ruta VALUES (75, 'AA008JK', '2017-03-09', 2, 2, 1000000, 1440000, 1);
INSERT INTO ruta VALUES (76, '', '2017-03-11', 0, 1, 0, 0, 0);
INSERT INTO ruta VALUES (77, '', '2017-03-16', 0, 1, 0, 0, 0);


--
-- TOC entry 2388 (class 0 OID 0)
-- Dependencies: 212
-- Name: ruta_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ruta_id_seq', 78, false);


--
-- TOC entry 2343 (class 0 OID 16611)
-- Dependencies: 215
-- Data for Name: ruta_rechazada; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO ruta_rechazada VALUES (1, 18, 'LKP', '2016-11-03', '18:04:18');
INSERT INTO ruta_rechazada VALUES (2, 54, 'AA008JK', '2016-12-14', '10:13:55');
INSERT INTO ruta_rechazada VALUES (3, 58, 'AA008JK', '2016-12-15', '12:38:17');


--
-- TOC entry 2389 (class 0 OID 0)
-- Dependencies: 214
-- Name: ruta_rechazada_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ruta_rechazada_id_seq', 4, false);


--
-- TOC entry 2345 (class 0 OID 16617)
-- Dependencies: 217
-- Data for Name: tipo_incidencia; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO tipo_incidencia VALUES (1, 'Accidentado');
INSERT INTO tipo_incidencia VALUES (2, '* TRIAL * TRIAL * ');
INSERT INTO tipo_incidencia VALUES (3, 'Pasajero Extra');
INSERT INTO tipo_incidencia VALUES (4, 'Contactar Operadora');
INSERT INTO tipo_incidencia VALUES (5, '* TRIAL * TRIAL ');
INSERT INTO tipo_incidencia VALUES (6, 'Retraso del Pasajero');


--
-- TOC entry 2390 (class 0 OID 0)
-- Dependencies: 216
-- Name: tipo_incidencia_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tipo_incidencia_id_seq', 7, false);


--
-- TOC entry 2347 (class 0 OID 16623)
-- Dependencies: 219
-- Data for Name: tipo_ruta; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO tipo_ruta VALUES (1, 'Ninguna', 0, 0, 1);
INSERT INTO tipo_ruta VALUES (2, 'Urbana', 1000, 1200, 1);
INSERT INTO tipo_ruta VALUES (3, '* TRIAL * T', 1300, 1500, 1);


--
-- TOC entry 2391 (class 0 OID 0)
-- Dependencies: 218
-- Name: tipo_ruta_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tipo_ruta_id_seq', 4, false);


--
-- TOC entry 2349 (class 0 OID 16630)
-- Dependencies: 221
-- Data for Name: tipo_vehiculo; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO tipo_vehiculo VALUES (1, 'Carro', 4, 1000, 1200, 1);
INSERT INTO tipo_vehiculo VALUES (2, 'Camioneta', 6, 1500, 1650, 1);
INSERT INTO tipo_vehiculo VALUES (3, 'Mini-Van', 8, 2000, 2100, 1);
INSERT INTO tipo_vehiculo VALUES (4, 'Van', 12, 2500, 2700, 1);


--
-- TOC entry 2392 (class 0 OID 0)
-- Dependencies: 220
-- Name: tipo_vehiculo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tipo_vehiculo_id_seq', 5, false);


--
-- TOC entry 2350 (class 0 OID 16637)
-- Dependencies: 222
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO usuario VALUES ('3656', '71a5c0514ab83382d98154e5a5f9d813', 2, '3424');
INSERT INTO usuario VALUES ('admin', '3a36359a53a432bc1af3980590c5552c', 1, '* TRIAL * T');
INSERT INTO usuario VALUES ('admin@kowaTx.com', '* TRIAL * TRIAL * TRIAL * TRIAL ', 2, '001');
INSERT INTO usuario VALUES ('adrianochoa123', 'c9f0f895fb98ab9159f51fd0297e236d', 3, 'J-406819212');
INSERT INTO usuario VALUES ('alasmail@gmail.com', '9fb37d413c37d2a7a1e871b9f51986da', 2, 'V-20');
INSERT INTO usuario VALUES ('bgutierrez600@gmail.com', '25d55ad283aa400af464c76d713c07ad', 2, 'bgutierrez600@gmail.');
INSERT INTO usuario VALUES ('h1@gmail.com', 'b6f0479ae87d244975439c6124592772', 2, '420');
INSERT INTO usuario VALUES ('h@gmail.com', '* TRIAL * TRIAL * TRIAL * TRIAL ', 2, '4545');
INSERT INTO usuario VALUES ('helyver19', '47f6c5dbc2b143b6dd16e94489603aaf', 3, 'J-406819212');
INSERT INTO usuario VALUES ('info.tumedico@gmail.com', 'da3356dfcee0aa753714303ceaf28542', 2, '* TRIAL * ');
INSERT INTO usuario VALUES ('LA001', '70f3dfe9e724d50870e4b01550516120', 3, '* TRIAL * T');
INSERT INTO usuario VALUES ('LA002', '* TRIAL * TRIAL * TRIAL * TRIAL ', 3, 'J-406819212');
INSERT INTO usuario VALUES ('LA003', '2043562a1ec73dd2ccd4846a808b60f5', 3, 'J-406819212');
INSERT INTO usuario VALUES ('LA004', '2d6e172685311923fc227f239a89e6b1', 3, '* TRIAL * T');
INSERT INTO usuario VALUES ('LA005', '* TRIAL * TRIAL * TRIAL * TRIAL ', 3, 'J-406819212');
INSERT INTO usuario VALUES ('LA006', 'fd57efc620b3a8c53ebd8ec467359bd6', 3, 'J-406819212');
INSERT INTO usuario VALUES ('LA007', '343e1abff6a89fb8b538f4551477f117', 3, 'J-406819212');
INSERT INTO usuario VALUES ('LA009', '* TRIAL * TRIAL * TRIAL * TRIAL ', 3, '* TRIAL * T');
INSERT INTO usuario VALUES ('LA014', '* TRIAL * TRIAL * TRIAL * TRIAL ', 3, 'J-406819212');
INSERT INTO usuario VALUES ('LA016', 'ca44ee5ed6dca37276704cd978c0432e', 3, 'J-406819212');
INSERT INTO usuario VALUES ('LA021', '* TRIAL * TRIAL * TRIAL * TRIAL ', 3, 'J-406819212');
INSERT INTO usuario VALUES ('LA030', '* TRIAL * TRIAL * TRIAL * TRIAL ', 3, '* TRIAL * T');
INSERT INTO usuario VALUES ('LA032', '818eac3dbdc3e4f3e0430f4bccfdb7a8', 3, 'J-406819212');
INSERT INTO usuario VALUES ('LA045', '* TRIAL * TRIAL * TRIAL * TRIAL ', 3, 'J-406819212');
INSERT INTO usuario VALUES ('LA047', 'efcf86814d29ff63b693f30148f2b13c', 3, 'J-406819212');
INSERT INTO usuario VALUES ('LA048', '* TRIAL * TRIAL * TRIAL * TRIAL ', 3, 'J-406819212');
INSERT INTO usuario VALUES ('LA098', 'd3ab6b49034ac2b372a9227591ed126c', 3, 'J-406819212');
INSERT INTO usuario VALUES ('LA099', 'a99159ead021555dab89bb0ff86d2f3c', 3, 'J-406819212');
INSERT INTO usuario VALUES ('luisffg24', 'e10adc3949ba59abbe56e057f20f883e', 2, '001');
INSERT INTO usuario VALUES ('makro@makro.com', '2b3c63c6c00ff7f8ea6323be685a2dbc', 2, '23445');
INSERT INTO usuario VALUES ('maybrith1411@gmail.com', '* TRIAL * TRIAL * TRIAL * TRIAL ', 2, '17196447');
INSERT INTO usuario VALUES ('n80', 'd4a973e303ec37692cc8923e3148eef7', 3, 'J-406819212');
INSERT INTO usuario VALUES ('ngil', '827ccb0eea8a706c4c34a16891f84e7b', 3, '12345678');
INSERT INTO usuario VALUES ('ngil@marna.com.ve', 'c5fde9de2d29789a81d1bc0f16292048', 2, '12345677');
INSERT INTO usuario VALUES ('ope1', '3a36359a53a432bc1af3980590c5552c', 5, 'J-406819212');
INSERT INTO usuario VALUES ('Operaciones', 'ad38d84443378a899550de6cb3f8ff21', 1, 'J-406819212');
INSERT INTO usuario VALUES ('operaciones@upy3.com', '8fc9dc800a9c3d12236c66ae6c1afebc', 1, '* TRIAL * T');
INSERT INTO usuario VALUES ('ordep', '64615d594af52fa413ae8627a9b2945c', 1, 'V-19850475-7');
INSERT INTO usuario VALUES ('oscargutierrez', '12345oscar', 1, NULL);
INSERT INTO usuario VALUES ('oscargutierrez1980', 'c80de25efeabc45a1da9948384f4b26f', 3, '* TRIAL * T');
INSERT INTO usuario VALUES ('oscarprueba', '* TRIAL * TRIAL * TRIAL * TRIAL ', 3, 'J315678900');
INSERT INTO usuario VALUES ('prueba', '* TRIAL * TRIAL * TRIAL * TRIAL ', 5, 'J-406819212');
INSERT INTO usuario VALUES ('pruebadee@gmail.com', '8336608773c499fd7e37000fac2f9cfd', 2, 'V60');
INSERT INTO usuario VALUES ('rx23', '* TRIAL * TRIAL * TRIAL * TRIAL ', 3, 'J-406819212');
INSERT INTO usuario VALUES ('st05grrhh@makro.com.ve', '5e17cc411b7cf108cc17818002897a2d', 2, '* TRIAL * ');
INSERT INTO usuario VALUES ('trinitariashotel@gmail.com', 'f1a45e52a4fe192b723cf6eae1dc6f5c', 2, 't12345');
INSERT INTO usuario VALUES ('wyepez123', '1c383cd30b7c298ab50293adfecb7b18', 3, 'J-406819212');


--
-- TOC entry 2351 (class 0 OID 16640)
-- Dependencies: 223
-- Data for Name: vehiculo; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO vehiculo VALUES ('07AC8PK', 'ChevroÃ±et', 'Nova', 1, 1, 10774782);
INSERT INTO vehiculo VALUES ('38383as', 'ford', 'spark', 1, 1, 20928223);
INSERT INTO vehiculo VALUES ('AA008JK', 'Chevrolet', 'Spark', 1, 1, 11269901);
INSERT INTO vehiculo VALUES ('AA11111', '* TRIAL *', 'Spark', 1, 1, 15777094);
INSERT INTO vehiculo VALUES ('AA1820W', '* TRIAL *', 'LUMINA', 1, 2, 8519071);
INSERT INTO vehiculo VALUES ('AA259TO', 'Kia', 'Pregio', 4, 1, 7312051);
INSERT INTO vehiculo VALUES ('AA392VH', 'fiat siena', '2007', 1, 1, 35);
INSERT INTO vehiculo VALUES ('AB240WW', 'Toyota', 'Corolla', 1, 1, 13990402);
INSERT INTO vehiculo VALUES ('ab265jf', 'daewoo', 'cielo', 1, 2, 21299783);
INSERT INTO vehiculo VALUES ('ab324tf', 'daewoo', 'raicer', 1, 2, 8);
INSERT INTO vehiculo VALUES ('ab636hi', 'Renault', '21', 1, 1, 19828251);
INSERT INTO vehiculo VALUES ('AB973HC', 'Chery', 'X1', 1, 1, 38);
INSERT INTO vehiculo VALUES ('ABO47DR', 'Fiat', 'Paluo', 1, 1, 7414004);
INSERT INTO vehiculo VALUES ('AEA-43S', 'Daewoo', 'Matiz', 1, 1, 18493162);
INSERT INTO vehiculo VALUES ('AF559LA', 'CHERY', 'X1', 1, 1, 7381920);
INSERT INTO vehiculo VALUES ('AF572JK', 'DAEWOO', 'CIELO', 1, 1, 18863751);
INSERT INTO vehiculo VALUES ('AG390MM', 'Peogeot', '307', 1, 1, 17378444);
INSERT INTO vehiculo VALUES ('AH306ZA', 'Fiat', 'Siena', 1, 2, 9628219);
INSERT INTO vehiculo VALUES ('FK837T', 'Daewoo', 'Cielo', 1, 2, 7424311);
INSERT INTO vehiculo VALUES ('gag13e', '* TRIAL *', 'corsa', 1, 1, 19263411);
INSERT INTO vehiculo VALUES ('GAW02R', 'CHRYSLE ', 'NEON', 1, 1, 9613687);
INSERT INTO vehiculo VALUES ('kav90p', 'jeep', 'grand cherokee', 1, 1, 19780290);
INSERT INTO vehiculo VALUES ('LKP', 'Chevrolet', 'Aveo', 1, 1, 56);
INSERT INTO vehiculo VALUES ('RAG 570', 'TOYOTA', 'COROLLA', 1, 1, 12250521);
INSERT INTO vehiculo VALUES ('YYYYY', '* TRIAL *', 'Aveo', 1, 1, 8080);


--
-- TOC entry 2152 (class 2606 OID 16644)
-- Name: bloque primary key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY bloque
    ADD CONSTRAINT "primary key" PRIMARY KEY (id);


--
-- TOC entry 2155 (class 2606 OID 16646)
-- Name: chofer primary key1; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY chofer
    ADD CONSTRAINT "primary key1" PRIMARY KEY (id_cedula);


--
-- TOC entry 2173 (class 2606 OID 16665)
-- Name: parada primary key10; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY parada
    ADD CONSTRAINT "primary key10" PRIMARY KEY (id);


--
-- TOC entry 2175 (class 2606 OID 16667)
-- Name: parada_ruta primary key11; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY parada_ruta
    ADD CONSTRAINT "primary key11" PRIMARY KEY (id);


--
-- TOC entry 2177 (class 2606 OID 16669)
-- Name: permiso primary key12; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY permiso
    ADD CONSTRAINT "primary key12" PRIMARY KEY (id);


--
-- TOC entry 2179 (class 2606 OID 16671)
-- Name: permiso_rol primary key13; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY permiso_rol
    ADD CONSTRAINT "primary key13" PRIMARY KEY (id);


--
-- TOC entry 2181 (class 2606 OID 16673)
-- Name: rol primary key14; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rol
    ADD CONSTRAINT "primary key14" PRIMARY KEY (id);


--
-- TOC entry 2183 (class 2606 OID 16675)
-- Name: ruta primary key15; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ruta
    ADD CONSTRAINT "primary key15" PRIMARY KEY (id);


--
-- TOC entry 2185 (class 2606 OID 16677)
-- Name: ruta_rechazada primary key16; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ruta_rechazada
    ADD CONSTRAINT "primary key16" PRIMARY KEY (id);


--
-- TOC entry 2187 (class 2606 OID 16679)
-- Name: tipo_incidencia primary key17; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_incidencia
    ADD CONSTRAINT "primary key17" PRIMARY KEY (id);


--
-- TOC entry 2189 (class 2606 OID 16681)
-- Name: tipo_ruta primary key18; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_ruta
    ADD CONSTRAINT "primary key18" PRIMARY KEY (id);


--
-- TOC entry 2191 (class 2606 OID 16683)
-- Name: tipo_vehiculo primary key19; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_vehiculo
    ADD CONSTRAINT "primary key19" PRIMARY KEY (id);


--
-- TOC entry 2157 (class 2606 OID 16649)
-- Name: cliente primary key2; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cliente
    ADD CONSTRAINT "primary key2" PRIMARY KEY (cedula);


--
-- TOC entry 2193 (class 2606 OID 16685)
-- Name: usuario primary key20; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT "primary key20" PRIMARY KEY (usuario);


--
-- TOC entry 2195 (class 2606 OID 16687)
-- Name: vehiculo primary key21; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY vehiculo
    ADD CONSTRAINT "primary key21" PRIMARY KEY (placa);


--
-- TOC entry 2159 (class 2606 OID 16651)
-- Name: condicion primary key3; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY condicion
    ADD CONSTRAINT "primary key3" PRIMARY KEY (id);


--
-- TOC entry 2161 (class 2606 OID 16653)
-- Name: disponibilidad primary key4; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY disponibilidad
    ADD CONSTRAINT "primary key4" PRIMARY KEY (id);


--
-- TOC entry 2163 (class 2606 OID 16655)
-- Name: empresa primary key5; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY empresa
    ADD CONSTRAINT "primary key5" PRIMARY KEY (rif);


--
-- TOC entry 2165 (class 2606 OID 16657)
-- Name: estado primary key6; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estado
    ADD CONSTRAINT "primary key6" PRIMARY KEY (id);


--
-- TOC entry 2167 (class 2606 OID 16659)
-- Name: incidencia primary key7; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY incidencia
    ADD CONSTRAINT "primary key7" PRIMARY KEY (id);


--
-- TOC entry 2169 (class 2606 OID 16661)
-- Name: noticia primary key8; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY noticia
    ADD CONSTRAINT "primary key8" PRIMARY KEY (id);


--
-- TOC entry 2171 (class 2606 OID 16663)
-- Name: pais primary key9; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pais
    ADD CONSTRAINT "primary key9" PRIMARY KEY (id);


--
-- TOC entry 2153 (class 1259 OID 16647)
-- Name: id_usuario; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX id_usuario ON chofer USING btree (id_usuario);


-- Completed on 2017-03-30 00:28:39

--
-- PostgreSQL database dump complete
--

