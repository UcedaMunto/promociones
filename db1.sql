--
-- PostgreSQL database dump
--

-- Dumped from database version 13.6
-- Dumped by pg_dump version 13.6

-- Started on 2022-04-27 09:39:58

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 3 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO postgres;

--
-- TOC entry 3311 (class 0 OID 0)
-- Dependencies: 3
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'standard public schema';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 200 (class 1259 OID 19072)
-- Name: archivo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.archivo (
    id integer NOT NULL,
    id_tipo_archivo_id integer,
    ruta character varying(40) NOT NULL
);


ALTER TABLE public.archivo OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 19195)
-- Name: archivo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.archivo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.archivo_id_seq OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 19078)
-- Name: contacto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.contacto (
    id integer NOT NULL,
    id_tipo_contacto_id integer NOT NULL,
    nombre character varying(35) NOT NULL,
    telefono character varying(10) DEFAULT NULL::character varying
);


ALTER TABLE public.contacto OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 19197)
-- Name: contacto_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.contacto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.contacto_id_seq OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 19085)
-- Name: ctl_tipo_archivo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ctl_tipo_archivo (
    id integer NOT NULL,
    nombre character varying(35) NOT NULL
);


ALTER TABLE public.ctl_tipo_archivo OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 19199)
-- Name: ctl_tipo_archivo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ctl_tipo_archivo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ctl_tipo_archivo_id_seq OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 19090)
-- Name: ctl_tipo_aviso; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ctl_tipo_aviso (
    id integer NOT NULL,
    nombre character varying(35) NOT NULL,
    activo boolean
);


ALTER TABLE public.ctl_tipo_aviso OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 19201)
-- Name: ctl_tipo_aviso_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ctl_tipo_aviso_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ctl_tipo_aviso_id_seq OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 19095)
-- Name: ctl_tipo_contacto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ctl_tipo_contacto (
    id integer NOT NULL,
    nombre character varying(35) NOT NULL
);


ALTER TABLE public.ctl_tipo_contacto OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 19203)
-- Name: ctl_tipo_contacto_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ctl_tipo_contacto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ctl_tipo_contacto_id_seq OWNER TO postgres;

--
-- TOC entry 239 (class 1259 OID 19370)
-- Name: ctl_tipo_promocion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ctl_tipo_promocion (
    id integer NOT NULL,
    nombre character varying(35) NOT NULL,
    activo boolean
);


ALTER TABLE public.ctl_tipo_promocion OWNER TO postgres;

--
-- TOC entry 238 (class 1259 OID 19368)
-- Name: ctl_tipo_promocion_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ctl_tipo_promocion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ctl_tipo_promocion_id_seq OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 19100)
-- Name: datos_persona; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.datos_persona (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    dui character varying(20) NOT NULL,
    nit character varying(17) DEFAULT NULL::character varying,
    direccion character varying(200) DEFAULT NULL::character varying,
    telefono character varying(15) DEFAULT NULL::character varying,
    celular character varying(15) DEFAULT NULL::character varying,
    fecha_nacimiento date,
    correo1 character varying(45) DEFAULT NULL::character varying,
    correo2 character varying(45) DEFAULT NULL::character varying,
    apellido character varying(35) DEFAULT NULL::character varying,
    estado integer,
    foto character varying(60) DEFAULT NULL::character varying,
    pasaporte character varying(15) DEFAULT NULL::character varying,
    giro character varying(400) DEFAULT NULL::character varying,
    ncr character varying(15) DEFAULT NULL::character varying,
    documentos character varying(50) DEFAULT NULL::character varying,
    registro_iva character varying(15) DEFAULT NULL::character varying,
    nombre_iva character varying(35) DEFAULT NULL::character varying,
    documentos2 character varying(50) DEFAULT NULL::character varying,
    documentos3 character varying(50) DEFAULT NULL::character varying
);


ALTER TABLE public.datos_persona OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 19205)
-- Name: datos_persona_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.datos_persona_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.datos_persona_id_seq OWNER TO postgres;

--
-- TOC entry 237 (class 1259 OID 19357)
-- Name: departamento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.departamento (
    id integer NOT NULL,
    nombre character varying(35) NOT NULL
);


ALTER TABLE public.departamento OWNER TO postgres;

--
-- TOC entry 236 (class 1259 OID 19355)
-- Name: departamento_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.departamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.departamento_id_seq OWNER TO postgres;

--
-- TOC entry 235 (class 1259 OID 19350)
-- Name: municipio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.municipio (
    id integer NOT NULL,
    nombre character varying(25) NOT NULL,
    id_departamento_id integer NOT NULL
);


ALTER TABLE public.municipio OWNER TO postgres;

--
-- TOC entry 234 (class 1259 OID 19348)
-- Name: municipio_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.municipio_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.municipio_id_seq OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 19125)
-- Name: persona_cliente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.persona_cliente (
    id integer NOT NULL,
    datos_id integer NOT NULL,
    usuario_id integer,
    token_registro character varying(40) DEFAULT NULL::character varying
);


ALTER TABLE public.persona_cliente OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 19207)
-- Name: persona_cliente_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.persona_cliente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.persona_cliente_id_seq OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 19133)
-- Name: persona_empleado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.persona_empleado (
    id integer NOT NULL,
    datos_id integer NOT NULL,
    salario double precision,
    fecha_creacion timestamp(0) without time zone NOT NULL,
    fecha_update timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    last_sesion date,
    activacion integer NOT NULL,
    color character varying(100) DEFAULT NULL::character varying,
    isss character varying(35) DEFAULT NULL::character varying,
    afp character varying(35) DEFAULT NULL::character varying
);


ALTER TABLE public.persona_empleado OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 19209)
-- Name: persona_empleado_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.persona_empleado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.persona_empleado_id_seq OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 19143)
-- Name: promo_aviso; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.promo_aviso (
    id integer NOT NULL,
    id_tipo_aviso_id integer NOT NULL,
    archivo_logo_id integer NOT NULL,
    nombre character varying(60) NOT NULL,
    descripcion character varying(200) DEFAULT NULL::character varying,
    activo boolean
);


ALTER TABLE public.promo_aviso OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 19211)
-- Name: promo_aviso_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.promo_aviso_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.promo_aviso_id_seq OWNER TO postgres;

--
-- TOC entry 209 (class 1259 OID 19151)
-- Name: promo_categoria; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.promo_categoria (
    id integer NOT NULL,
    nombre character varying(35) NOT NULL,
    descripcion character varying(120) DEFAULT NULL::character varying,
    activo boolean,
    archivo_logo_id integer NOT NULL,
    archivo_banner_id integer
);


ALTER TABLE public.promo_categoria OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 19213)
-- Name: promo_categoria_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.promo_categoria_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.promo_categoria_id_seq OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 19330)
-- Name: promo_contacto_establecimiento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.promo_contacto_establecimiento (
    id integer NOT NULL,
    contacto_id integer,
    establecimiento_id integer NOT NULL
);


ALTER TABLE public.promo_contacto_establecimiento OWNER TO postgres;

--
-- TOC entry 232 (class 1259 OID 19328)
-- Name: promo_contacto_establecimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.promo_contacto_establecimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.promo_contacto_establecimiento_id_seq OWNER TO postgres;

--
-- TOC entry 247 (class 1259 OID 19432)
-- Name: promo_contacto_sucursal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.promo_contacto_sucursal (
    id integer NOT NULL,
    id_contacto_id integer,
    sucursal_id integer NOT NULL
);


ALTER TABLE public.promo_contacto_sucursal OWNER TO postgres;

--
-- TOC entry 246 (class 1259 OID 19430)
-- Name: promo_contacto_sucursal_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.promo_contacto_sucursal_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.promo_contacto_sucursal_id_seq OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 19157)
-- Name: promo_establecimiento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.promo_establecimiento (
    id integer NOT NULL,
    nombre character varying(35) NOT NULL,
    activo boolean,
    archivo_logo_id integer NOT NULL,
    archivo_banner_id integer,
    telefono character varying(15) DEFAULT NULL::character varying,
    direccion character varying(500) DEFAULT NULL::character varying
);


ALTER TABLE public.promo_establecimiento OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 19215)
-- Name: promo_establecimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.promo_establecimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.promo_establecimiento_id_seq OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 19311)
-- Name: promo_establecimiento_promo_categoria; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.promo_establecimiento_promo_categoria (
    promo_establecimiento_id integer NOT NULL,
    promo_categoria_id integer NOT NULL
);


ALTER TABLE public.promo_establecimiento_promo_categoria OWNER TO postgres;

--
-- TOC entry 243 (class 1259 OID 19396)
-- Name: promo_promociones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.promo_promociones (
    id integer NOT NULL,
    id_tipo_id integer NOT NULL,
    fecha_inicio timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    fecha_fin timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    codigo character varying(20) DEFAULT NULL::character varying,
    activo boolean,
    nombre character varying(35) NOT NULL,
    descripcion character varying(200) NOT NULL
);


ALTER TABLE public.promo_promociones OWNER TO postgres;

--
-- TOC entry 242 (class 1259 OID 19394)
-- Name: promo_promociones_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.promo_promociones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.promo_promociones_id_seq OWNER TO postgres;

--
-- TOC entry 241 (class 1259 OID 19377)
-- Name: promo_sucursal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.promo_sucursal (
    id integer NOT NULL,
    id_establecimiento_id integer NOT NULL,
    id_municipio_id integer NOT NULL,
    nombre character varying(35) NOT NULL,
    activo boolean,
    direccion character varying(150) NOT NULL,
    url_ubicacion_mapa character varying(60) DEFAULT NULL::character varying NOT NULL
);


ALTER TABLE public.promo_sucursal OWNER TO postgres;

--
-- TOC entry 240 (class 1259 OID 19375)
-- Name: promo_sucursal_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.promo_sucursal_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.promo_sucursal_id_seq OWNER TO postgres;

--
-- TOC entry 245 (class 1259 OID 19412)
-- Name: promocion_sucursal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.promocion_sucursal (
    id integer NOT NULL,
    id_sucursal_id integer,
    id_promocion_id integer NOT NULL,
    activo boolean
);


ALTER TABLE public.promocion_sucursal OWNER TO postgres;

--
-- TOC entry 244 (class 1259 OID 19410)
-- Name: promocion_sucursal_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.promocion_sucursal_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.promocion_sucursal_id_seq OWNER TO postgres;

--
-- TOC entry 211 (class 1259 OID 19162)
-- Name: tipo_contacto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_contacto (
    id integer NOT NULL,
    nombre character varying(35) NOT NULL
);


ALTER TABLE public.tipo_contacto OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 19217)
-- Name: tipo_contacto_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_contacto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipo_contacto_id_seq OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 19167)
-- Name: tipo_empleado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_empleado (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    rol character varying(25) DEFAULT NULL::character varying,
    descripcion character varying(250) DEFAULT NULL::character varying
);


ALTER TABLE public.tipo_empleado OWNER TO postgres;

--
-- TOC entry 228 (class 1259 OID 19219)
-- Name: tipo_empleado_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_empleado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipo_empleado_id_seq OWNER TO postgres;

--
-- TOC entry 213 (class 1259 OID 19177)
-- Name: usuario_cliente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario_cliente (
    id integer NOT NULL,
    usuario character varying(60) NOT NULL,
    password character varying(200) NOT NULL,
    creacion date NOT NULL,
    actualizacion date
);


ALTER TABLE public.usuario_cliente OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 19221)
-- Name: usuario_cliente_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuario_cliente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuario_cliente_id_seq OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 19182)
-- Name: usuario_empleado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario_empleado (
    id integer NOT NULL,
    empleado_id integer,
    password character varying(200) NOT NULL,
    usuario character varying(20) NOT NULL,
    creacion date NOT NULL,
    actualizacion date
);


ALTER TABLE public.usuario_empleado OWNER TO postgres;

--
-- TOC entry 230 (class 1259 OID 19223)
-- Name: usuario_empleado_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuario_empleado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuario_empleado_id_seq OWNER TO postgres;

--
-- TOC entry 215 (class 1259 OID 19188)
-- Name: usuario_empleado_tipo_empleado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario_empleado_tipo_empleado (
    usuario_empleado_id integer NOT NULL,
    tipo_empleado_id integer NOT NULL
);


ALTER TABLE public.usuario_empleado_tipo_empleado OWNER TO postgres;

--
-- TOC entry 3258 (class 0 OID 19072)
-- Dependencies: 200
-- Data for Name: archivo; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.archivo VALUES (14, NULL, 'uploads/establecimientos/yB9euGaVY3.jpeg');
INSERT INTO public.archivo VALUES (15, NULL, 'uploads/establecimientos/mSDLyJWvfc.jpeg');
INSERT INTO public.archivo VALUES (16, NULL, 'uploads/establecimientos/aJ3yZ1EdF8.jpeg');
INSERT INTO public.archivo VALUES (17, NULL, 'uploads/establecimientos/l4q9M67ZWv.jpeg');
INSERT INTO public.archivo VALUES (18, NULL, 'uploads/establecimientos/zPhlQvq93e.jpeg');
INSERT INTO public.archivo VALUES (19, NULL, 'uploads/establecimientos/NkFdQG6iox.jpeg');
INSERT INTO public.archivo VALUES (1, 1, 'uploads/establecimientos/yB9euGaVY3.jpeg');
INSERT INTO public.archivo VALUES (2, 1, 'uploads/establecimientos/yB9euGaVY3.jpeg');
INSERT INTO public.archivo VALUES (3, 1, 'uploads/establecimientos/yB9euGaVY3.jpeg');
INSERT INTO public.archivo VALUES (4, 1, 'uploads/establecimientos/yB9euGaVY3.jpeg');
INSERT INTO public.archivo VALUES (5, 1, 'uploads/establecimientos/yB9euGaVY3.jpeg');
INSERT INTO public.archivo VALUES (6, 1, 'uploads/establecimientos/yB9euGaVY3.jpeg');
INSERT INTO public.archivo VALUES (7, 1, 'uploads/establecimientos/yB9euGaVY3.jpeg');
INSERT INTO public.archivo VALUES (8, 1, 'uploads/establecimientos/yB9euGaVY3.jpeg');
INSERT INTO public.archivo VALUES (9, 1, 'uploads/establecimientos/yB9euGaVY3.jpeg');
INSERT INTO public.archivo VALUES (10, 2, 'uploads/establecimientos/yB9euGaVY3.jpeg');
INSERT INTO public.archivo VALUES (11, 1, 'uploads/establecimientos/yB9euGaVY3.jpeg');
INSERT INTO public.archivo VALUES (12, 1, 'uploads/establecimientos/yB9euGaVY3.jpeg');
INSERT INTO public.archivo VALUES (13, 1, 'uploads/establecimientos/yB9euGaVY3.jpeg');
INSERT INTO public.archivo VALUES (20, NULL, 'uploads/establecimientos/8HVEdrTv4S.jpeg');
INSERT INTO public.archivo VALUES (21, NULL, 'uploads/establecimientos/8bnHst4wQ3.jpeg');
INSERT INTO public.archivo VALUES (22, NULL, 'uploads/avisos/uBr9mOlhUR.jpeg');
INSERT INTO public.archivo VALUES (25, NULL, 'uploads/categorias/bteQuTfO2s.jpeg');
INSERT INTO public.archivo VALUES (26, NULL, 'uploads/categorias/dfC7jYRkT2.jpeg');
INSERT INTO public.archivo VALUES (29, NULL, 'uploads/avisos/YS7MZhgk3m.jpeg');
INSERT INTO public.archivo VALUES (30, NULL, 'uploads/avisos/XLtOGUgcZH.jpeg');
INSERT INTO public.archivo VALUES (31, NULL, 'uploads/avisos/uT1jMXPhqt.jpeg');
INSERT INTO public.archivo VALUES (32, NULL, 'uploads/avisos/RbBnXZDFlI.jpeg');
INSERT INTO public.archivo VALUES (33, NULL, 'uploads/categorias/83TMRqpbVl.jpeg');
INSERT INTO public.archivo VALUES (34, NULL, 'uploads/categorias/OChVMc6AvH.jpeg');
INSERT INTO public.archivo VALUES (35, NULL, 'uploads/categorias/RDIi2bfkCA.jpeg');
INSERT INTO public.archivo VALUES (36, NULL, 'uploads/categorias/xC25qOojpa.jpeg');
INSERT INTO public.archivo VALUES (37, NULL, 'uploads/categorias/OGxLbfF5qB.jpeg');
INSERT INTO public.archivo VALUES (38, NULL, 'uploads/categorias/N3az1neSCJ.jpeg');
INSERT INTO public.archivo VALUES (41, NULL, 'uploads/categorias/U6WcgVLjkd.jpeg');
INSERT INTO public.archivo VALUES (42, NULL, 'uploads/categorias/mhIVYz8X5b.jpeg');
INSERT INTO public.archivo VALUES (43, NULL, 'uploads/categorias/cdxSoaiq29.jpeg');
INSERT INTO public.archivo VALUES (44, NULL, 'uploads/categorias/qCZ8GOzP5D.jpeg');
INSERT INTO public.archivo VALUES (45, NULL, 'uploads/categorias/C7keBLGSoT.jpeg');
INSERT INTO public.archivo VALUES (46, NULL, 'uploads/categorias/nX4HakeGwl.jpeg');
INSERT INTO public.archivo VALUES (47, NULL, 'uploads/categorias/phLVrxyaUo.jpeg');
INSERT INTO public.archivo VALUES (48, NULL, 'uploads/categorias/LrTjshHJXl.jpeg');
INSERT INTO public.archivo VALUES (49, NULL, 'uploads/categorias/AXozK4QHnh.jpeg');
INSERT INTO public.archivo VALUES (50, NULL, 'uploads/categorias/bm13LIgEJ4.jpeg');
INSERT INTO public.archivo VALUES (51, NULL, 'uploads/establecimientos/2TMeUmnYVA.jpeg');
INSERT INTO public.archivo VALUES (52, NULL, 'uploads/establecimientos/xS4hOE2nCG.jpeg');
INSERT INTO public.archivo VALUES (53, NULL, 'uploads/establecimientos/drTDnVmcvh.jpeg');
INSERT INTO public.archivo VALUES (54, NULL, 'uploads/establecimientos/OxzGrnfhbl.jpeg');
INSERT INTO public.archivo VALUES (55, NULL, 'uploads/establecimientos/hu8TeDSwBt.jpeg');
INSERT INTO public.archivo VALUES (56, NULL, 'uploads/establecimientos/v6ZKtGw1OV.jpeg');
INSERT INTO public.archivo VALUES (57, NULL, 'uploads/establecimientos/jC32c7YrTH.jpeg');
INSERT INTO public.archivo VALUES (58, NULL, 'uploads/establecimientos/YJDeVAEdrZ.jpeg');
INSERT INTO public.archivo VALUES (59, NULL, 'uploads/establecimientos/gtTdCl5Vjw.jpeg');
INSERT INTO public.archivo VALUES (60, NULL, 'uploads/establecimientos/ewhplGBc7j.jpeg');
INSERT INTO public.archivo VALUES (61, NULL, 'uploads/establecimientos/Jz2uYZDyA9.jpeg');
INSERT INTO public.archivo VALUES (62, NULL, 'uploads/establecimientos/gV7xob1CTv.jpeg');
INSERT INTO public.archivo VALUES (63, NULL, 'uploads/categorias/5VJOgpL3Qa.jpeg');
INSERT INTO public.archivo VALUES (64, NULL, 'uploads/categorias/4ES3n1mv8e.jpeg');
INSERT INTO public.archivo VALUES (65, NULL, 'uploads/categorias/hsjWqAawSE.jpeg');
INSERT INTO public.archivo VALUES (66, NULL, 'uploads/categorias/rNKf7WHsbd.jpeg');
INSERT INTO public.archivo VALUES (69, NULL, 'uploads/avisos/Gd5Q8JtjAa.jpeg');
INSERT INTO public.archivo VALUES (70, NULL, 'uploads/avisos/XSAsw7zTjN.jpeg');
INSERT INTO public.archivo VALUES (71, NULL, 'uploads/establecimientos/pCiREX2Kxb.jpeg');
INSERT INTO public.archivo VALUES (72, NULL, 'uploads/establecimientos/aT5cDXGV9f.jpeg');
INSERT INTO public.archivo VALUES (73, NULL, 'uploads/categorias/Py5Na7EV3t.jpeg');
INSERT INTO public.archivo VALUES (74, NULL, 'uploads/categorias/4E13xISmUC.jpeg');


--
-- TOC entry 3259 (class 0 OID 19078)
-- Dependencies: 201
-- Data for Name: contacto; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.contacto VALUES (7, 1, 'ewrwerwer', NULL);
INSERT INTO public.contacto VALUES (8, 1, 'jose matias', NULL);
INSERT INTO public.contacto VALUES (9, 1, 'sdsds', 'sdsdsd');
INSERT INTO public.contacto VALUES (10, 1, 'SDFSF', 'SSDFSDF');
INSERT INTO public.contacto VALUES (11, 1, 'contacto nuevo', '73659816');
INSERT INTO public.contacto VALUES (12, 2, 'sdfsfd', 'sdfsdf');


--
-- TOC entry 3260 (class 0 OID 19085)
-- Dependencies: 202
-- Data for Name: ctl_tipo_archivo; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.ctl_tipo_archivo VALUES (1, 'jpg');
INSERT INTO public.ctl_tipo_archivo VALUES (2, 'JPG');


--
-- TOC entry 3261 (class 0 OID 19090)
-- Dependencies: 203
-- Data for Name: ctl_tipo_aviso; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.ctl_tipo_aviso VALUES (1, 'Proximo evento', true);
INSERT INTO public.ctl_tipo_aviso VALUES (2, 'Evento Festivo', true);
INSERT INTO public.ctl_tipo_aviso VALUES (3, 'evento de fiesta religiosa', true);


--
-- TOC entry 3262 (class 0 OID 19095)
-- Dependencies: 204
-- Data for Name: ctl_tipo_contacto; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.ctl_tipo_contacto VALUES (1, 'SEO de la empresa');
INSERT INTO public.ctl_tipo_contacto VALUES (2, 'gerente de establecimiento');


--
-- TOC entry 3297 (class 0 OID 19370)
-- Dependencies: 239
-- Data for Name: ctl_tipo_promocion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.ctl_tipo_promocion VALUES (1, 'Comida', true);
INSERT INTO public.ctl_tipo_promocion VALUES (2, 'Articulos del hogar', true);
INSERT INTO public.ctl_tipo_promocion VALUES (3, 'otros', false);
INSERT INTO public.ctl_tipo_promocion VALUES (4, 'promociones de venta de muebles', true);


--
-- TOC entry 3263 (class 0 OID 19100)
-- Dependencies: 205
-- Data for Name: datos_persona; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.datos_persona VALUES (1, 'alex', '2323232323223', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);


--
-- TOC entry 3295 (class 0 OID 19357)
-- Dependencies: 237
-- Data for Name: departamento; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.departamento VALUES (1, 'San Salvador');
INSERT INTO public.departamento VALUES (2, 'Sonsonate');
INSERT INTO public.departamento VALUES (3, 'Santa Ana');


--
-- TOC entry 3293 (class 0 OID 19350)
-- Dependencies: 235
-- Data for Name: municipio; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.municipio VALUES (1, 'San Salvador', 1);
INSERT INTO public.municipio VALUES (2, 'Mejicanos', 1);
INSERT INTO public.municipio VALUES (4, 'San juan', 2);
INSERT INTO public.municipio VALUES (3, 'San Ingacio', 2);
INSERT INTO public.municipio VALUES (5, 'Izalco', 2);
INSERT INTO public.municipio VALUES (6, 'san ignacio', 2);


--
-- TOC entry 3264 (class 0 OID 19125)
-- Dependencies: 206
-- Data for Name: persona_cliente; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3265 (class 0 OID 19133)
-- Dependencies: 207
-- Data for Name: persona_empleado; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.persona_empleado VALUES (1, 1, 233, '2022-04-27 00:00:00', '2022-04-27 00:00:00', NULL, 1, NULL, NULL, NULL);


--
-- TOC entry 3266 (class 0 OID 19143)
-- Dependencies: 208
-- Data for Name: promo_aviso; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.promo_aviso VALUES (6, 2, 29, 'Promociones pizza hut por día de la madre', 'descuento del 15% en todas las pizzas', true);
INSERT INTO public.promo_aviso VALUES (3, 2, 30, 'Inverciones en tecnología', 'Nuevas inversiones en tenología para Nuestro país', true);
INSERT INTO public.promo_aviso VALUES (2, 1, 1, 'Nuevas leyes contra el maltrato animal', 'Reuniones de la comisión para el maltrato animal en El Salvador', true);
INSERT INTO public.promo_aviso VALUES (7, 1, 31, 'Mascarilla no obligatoria', 'La cantidad de personas enfermas por covid ha disminuido por lo que la mascarilla ya no se considera obligatoria', true);
INSERT INTO public.promo_aviso VALUES (8, 1, 32, 'Promociones pollo campero este fin de semana', 'Publicaremos promociones especiales este fin de semana', true);
INSERT INTO public.promo_aviso VALUES (9, 3, 70, 'xxxxxxxxxxxxxxxxxx', 'asdasasd', true);


--
-- TOC entry 3267 (class 0 OID 19151)
-- Dependencies: 209
-- Data for Name: promo_categoria; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.promo_categoria VALUES (7, 'Restaurantes', 'comerciones de comida', true, 33, 34);
INSERT INTO public.promo_categoria VALUES (6, 'Cosmeticos', 'Articulos de belleza para mujeres', true, 35, 36);
INSERT INTO public.promo_categoria VALUES (4, 'Tecnología', 'Productos de informática', true, 37, 38);
INSERT INTO public.promo_categoria VALUES (3, 'Mascotas', 'Articulos de mascotas, comida, correas, medicamentos, articulos de limpieza, trajes para gatos y perros', true, 41, 42);
INSERT INTO public.promo_categoria VALUES (8, 'Gimnacio', 'Articulos para hacer ejercicio, medidores, ofertas en gimnacios', true, 43, 44);
INSERT INTO public.promo_categoria VALUES (9, 'Hogar', 'articulos del hogar, muebles, sillones, comedores, articulos de limpieza...', true, 45, 46);
INSERT INTO public.promo_categoria VALUES (10, 'Educación', 'Cursos, promociones en colegios, vecas y otros', true, 47, 48);
INSERT INTO public.promo_categoria VALUES (11, 'Agroindustria', 'industria basada en el cultivo y producciones de bienes de consumo', true, 49, 50);
INSERT INTO public.promo_categoria VALUES (12, 'Constrcuccion 3333', 'materiales de construcción', true, 73, 74);


--
-- TOC entry 3291 (class 0 OID 19330)
-- Dependencies: 233
-- Data for Name: promo_contacto_establecimiento; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.promo_contacto_establecimiento VALUES (8, 7, 2);
INSERT INTO public.promo_contacto_establecimiento VALUES (9, 8, 1);
INSERT INTO public.promo_contacto_establecimiento VALUES (10, 9, 3);
INSERT INTO public.promo_contacto_establecimiento VALUES (11, 10, 3);


--
-- TOC entry 3305 (class 0 OID 19432)
-- Dependencies: 247
-- Data for Name: promo_contacto_sucursal; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.promo_contacto_sucursal VALUES (2, 11, 1);
INSERT INTO public.promo_contacto_sucursal VALUES (3, 12, 4);


--
-- TOC entry 3268 (class 0 OID 19157)
-- Dependencies: 210
-- Data for Name: promo_establecimiento; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.promo_establecimiento VALUES (1, 'La tiendona', true, 6, 7, '+503 73659816', ' Calle sisimiles ·#2942, Colonia Miramonte, San Salvador, San Salvador CP 1101');
INSERT INTO public.promo_establecimiento VALUES (7, 'Azucarera', true, 53, 54, '+503 73659816', 'Calle sisimiles ·#2942, Colonia Miramonte, San Salvador, San Salvador CP 1101');
INSERT INTO public.promo_establecimiento VALUES (2, 'Gym', true, 55, 56, '+503 73659816', 'Calle sisimiles ·#2942, Colonia Miramonte, San Salvador, San Salvador CP 1101');
INSERT INTO public.promo_establecimiento VALUES (13, 'Tecno center', true, 57, 58, '+503 73659816', 'Calle sisimiles ·#2942, Colonia Miramonte, San Salvador, San Salvador CP 1101');
INSERT INTO public.promo_establecimiento VALUES (4, 'sonux', true, 59, 60, '+503 73659816', 'Calle sisimiles ·#2942, Colonia Miramonte, San Salvador, San Salvador CP 1101');
INSERT INTO public.promo_establecimiento VALUES (11, 'Duralex', true, 61, 62, '+503 73659816', 'Calle sisimiles ·#2942, Colonia Miramonte, San Salvador, San Salvador CP 1101');
INSERT INTO public.promo_establecimiento VALUES (3, 'El rosario xxxxx', true, 71, 72, '+503 73659816', 'Calle sisimiles ·#2942, Colonia Miramonte, San Salvador, San Salvador CP 1101');


--
-- TOC entry 3289 (class 0 OID 19311)
-- Dependencies: 231
-- Data for Name: promo_establecimiento_promo_categoria; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.promo_establecimiento_promo_categoria VALUES (1, 3);
INSERT INTO public.promo_establecimiento_promo_categoria VALUES (1, 4);
INSERT INTO public.promo_establecimiento_promo_categoria VALUES (7, 4);
INSERT INTO public.promo_establecimiento_promo_categoria VALUES (11, 4);
INSERT INTO public.promo_establecimiento_promo_categoria VALUES (13, 4);
INSERT INTO public.promo_establecimiento_promo_categoria VALUES (2, 8);
INSERT INTO public.promo_establecimiento_promo_categoria VALUES (7, 11);
INSERT INTO public.promo_establecimiento_promo_categoria VALUES (3, 7);
INSERT INTO public.promo_establecimiento_promo_categoria VALUES (4, 4);
INSERT INTO public.promo_establecimiento_promo_categoria VALUES (11, 11);


--
-- TOC entry 3301 (class 0 OID 19396)
-- Dependencies: 243
-- Data for Name: promo_promociones; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.promo_promociones VALUES (1, 1, NULL, NULL, 'asasas', true, 'as', 'assas');
INSERT INTO public.promo_promociones VALUES (2, 2, '2019-01-01 19:19:00', '2017-02-19 22:17:00', '11111', true, 'nueva promo', 'asdasdasda');
INSERT INTO public.promo_promociones VALUES (3, 3, NULL, NULL, 'dddd', true, 'ddddd', 'ddddd');
INSERT INTO public.promo_promociones VALUES (4, 2, NULL, NULL, 'sdsdsd', true, 'sdsd', 'sdsdsd');
INSERT INTO public.promo_promociones VALUES (5, 1, NULL, NULL, 'sdsdsd', false, 'sdsd', 'dsdsdsd');
INSERT INTO public.promo_promociones VALUES (6, 1, NULL, NULL, 'ddd', true, 'ddd', 'dd');
INSERT INTO public.promo_promociones VALUES (7, 3, '2022-02-01 00:00:00', '2021-08-08 08:04:00', '12345', true, 'Plazas de empleo', 'plazas para trabajo en la empresa, comunicase al contacto dado y enviar curriculum');
INSERT INTO public.promo_promociones VALUES (8, 2, '2022-04-15 00:00:00', '2022-04-13 00:00:00', '111122223333', true, 'nueva promo ejemplo', 'promocion de ejemplo para probar toma de fechas');
INSERT INTO public.promo_promociones VALUES (9, 2, '2022-04-01 00:00:00', '2022-04-15 00:00:00', '3333', true, 'DESCUESTO 30%', 'SDSDFSDSFD');
INSERT INTO public.promo_promociones VALUES (11, 2, '2022-04-12 00:00:00', '2022-04-30 00:00:00', '123456', true, 'promxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxx');


--
-- TOC entry 3299 (class 0 OID 19377)
-- Dependencies: 241
-- Data for Name: promo_sucursal; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.promo_sucursal VALUES (3, 1, 2, 'sucursal La tiendona', true, 'Mejicanos', 'ss');
INSERT INTO public.promo_sucursal VALUES (6, 1, 1, 'Sucursal la tiendona', true, 'centro San Salvador', 'https://goo.gl/maps/LnRLG7jZfskpxnUB7');
INSERT INTO public.promo_sucursal VALUES (1, 3, 2, 'San Benito', true, 'Frente a UES', 'ss');
INSERT INTO public.promo_sucursal VALUES (7, 4, 1, 'La San Pedro', true, 'dirección', 'https://goo.gl/maps/LnRLG7jZfskpxnUB7');
INSERT INTO public.promo_sucursal VALUES (2, 2, 3, 'Gym Metrocentro', true, 'Centro de San Salvador', 'ss');
INSERT INTO public.promo_sucursal VALUES (4, 2, 3, 'GYM OCCIDENTE', true, 'Ciudad de Santa Ana', 'sss');
INSERT INTO public.promo_sucursal VALUES (8, 13, 1, 'Tecno las cascadas', true, 'las cascadas San Salvador, local #501, frente a Siman', 'dfsdssfddf');
INSERT INTO public.promo_sucursal VALUES (9, 7, 5, 'Azucarera izalco', true, 'Km. 62 1/2, carretera a Sonsonate

Cantón Huiscoyolate, Izalco

Sonsonate, El Salvador, C.A.', 'ASASD');


--
-- TOC entry 3303 (class 0 OID 19412)
-- Dependencies: 245
-- Data for Name: promocion_sucursal; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.promocion_sucursal VALUES (3, 2, 1, true);
INSERT INTO public.promocion_sucursal VALUES (4, 3, 1, true);
INSERT INTO public.promocion_sucursal VALUES (5, 1, 2, false);
INSERT INTO public.promocion_sucursal VALUES (6, 2, 2, false);
INSERT INTO public.promocion_sucursal VALUES (7, 1, 3, false);
INSERT INTO public.promocion_sucursal VALUES (8, 2, 3, false);
INSERT INTO public.promocion_sucursal VALUES (9, 3, 3, false);
INSERT INTO public.promocion_sucursal VALUES (10, 3, 4, false);
INSERT INTO public.promocion_sucursal VALUES (11, 3, 5, false);
INSERT INTO public.promocion_sucursal VALUES (12, 2, 6, true);
INSERT INTO public.promocion_sucursal VALUES (13, 3, 6, true);
INSERT INTO public.promocion_sucursal VALUES (14, 9, 7, true);
INSERT INTO public.promocion_sucursal VALUES (15, 1, 8, true);
INSERT INTO public.promocion_sucursal VALUES (16, 2, 8, true);
INSERT INTO public.promocion_sucursal VALUES (17, 3, 8, true);
INSERT INTO public.promocion_sucursal VALUES (18, 2, 9, true);
INSERT INTO public.promocion_sucursal VALUES (22, 1, 11, true);
INSERT INTO public.promocion_sucursal VALUES (23, 2, 11, true);
INSERT INTO public.promocion_sucursal VALUES (24, 3, 11, true);
INSERT INTO public.promocion_sucursal VALUES (25, 4, 11, true);


--
-- TOC entry 3269 (class 0 OID 19162)
-- Dependencies: 211
-- Data for Name: tipo_contacto; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3270 (class 0 OID 19167)
-- Dependencies: 212
-- Data for Name: tipo_empleado; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3271 (class 0 OID 19177)
-- Dependencies: 213
-- Data for Name: usuario_cliente; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3272 (class 0 OID 19182)
-- Dependencies: 214
-- Data for Name: usuario_empleado; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.usuario_empleado VALUES (1, 1, '$2y$10$9VZpmqD1HeLq2EStTdJ3eeSPGoGBef6Xr14zvxZUCKe7flbgut96K', 'clau', '2022-04-27', '2022-04-27');


--
-- TOC entry 3273 (class 0 OID 19188)
-- Dependencies: 215
-- Data for Name: usuario_empleado_tipo_empleado; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3312 (class 0 OID 0)
-- Dependencies: 216
-- Name: archivo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.archivo_id_seq', 74, true);


--
-- TOC entry 3313 (class 0 OID 0)
-- Dependencies: 217
-- Name: contacto_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.contacto_id_seq', 12, true);


--
-- TOC entry 3314 (class 0 OID 0)
-- Dependencies: 218
-- Name: ctl_tipo_archivo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ctl_tipo_archivo_id_seq', 2, true);


--
-- TOC entry 3315 (class 0 OID 0)
-- Dependencies: 219
-- Name: ctl_tipo_aviso_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ctl_tipo_aviso_id_seq', 3, true);


--
-- TOC entry 3316 (class 0 OID 0)
-- Dependencies: 220
-- Name: ctl_tipo_contacto_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ctl_tipo_contacto_id_seq', 2, true);


--
-- TOC entry 3317 (class 0 OID 0)
-- Dependencies: 238
-- Name: ctl_tipo_promocion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ctl_tipo_promocion_id_seq', 4, true);


--
-- TOC entry 3318 (class 0 OID 0)
-- Dependencies: 221
-- Name: datos_persona_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.datos_persona_id_seq', 1, false);


--
-- TOC entry 3319 (class 0 OID 0)
-- Dependencies: 236
-- Name: departamento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.departamento_id_seq', 3, true);


--
-- TOC entry 3320 (class 0 OID 0)
-- Dependencies: 234
-- Name: municipio_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.municipio_id_seq', 6, true);


--
-- TOC entry 3321 (class 0 OID 0)
-- Dependencies: 222
-- Name: persona_cliente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.persona_cliente_id_seq', 1, false);


--
-- TOC entry 3322 (class 0 OID 0)
-- Dependencies: 223
-- Name: persona_empleado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.persona_empleado_id_seq', 1, false);


--
-- TOC entry 3323 (class 0 OID 0)
-- Dependencies: 224
-- Name: promo_aviso_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.promo_aviso_id_seq', 9, true);


--
-- TOC entry 3324 (class 0 OID 0)
-- Dependencies: 225
-- Name: promo_categoria_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.promo_categoria_id_seq', 12, true);


--
-- TOC entry 3325 (class 0 OID 0)
-- Dependencies: 232
-- Name: promo_contacto_establecimiento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.promo_contacto_establecimiento_id_seq', 11, true);


--
-- TOC entry 3326 (class 0 OID 0)
-- Dependencies: 246
-- Name: promo_contacto_sucursal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.promo_contacto_sucursal_id_seq', 3, true);


--
-- TOC entry 3327 (class 0 OID 0)
-- Dependencies: 226
-- Name: promo_establecimiento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.promo_establecimiento_id_seq', 14, true);


--
-- TOC entry 3328 (class 0 OID 0)
-- Dependencies: 242
-- Name: promo_promociones_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.promo_promociones_id_seq', 11, true);


--
-- TOC entry 3329 (class 0 OID 0)
-- Dependencies: 240
-- Name: promo_sucursal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.promo_sucursal_id_seq', 9, true);


--
-- TOC entry 3330 (class 0 OID 0)
-- Dependencies: 244
-- Name: promocion_sucursal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.promocion_sucursal_id_seq', 25, true);


--
-- TOC entry 3331 (class 0 OID 0)
-- Dependencies: 227
-- Name: tipo_contacto_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_contacto_id_seq', 1, false);


--
-- TOC entry 3332 (class 0 OID 0)
-- Dependencies: 228
-- Name: tipo_empleado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_empleado_id_seq', 1, false);


--
-- TOC entry 3333 (class 0 OID 0)
-- Dependencies: 229
-- Name: usuario_cliente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuario_cliente_id_seq', 1, false);


--
-- TOC entry 3334 (class 0 OID 0)
-- Dependencies: 230
-- Name: usuario_empleado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuario_empleado_id_seq', 1, false);


--
-- TOC entry 3026 (class 2606 OID 19076)
-- Name: archivo archivo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.archivo
    ADD CONSTRAINT archivo_pkey PRIMARY KEY (id);


--
-- TOC entry 3029 (class 2606 OID 19082)
-- Name: contacto contacto_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contacto
    ADD CONSTRAINT contacto_pkey PRIMARY KEY (id);


--
-- TOC entry 3032 (class 2606 OID 19089)
-- Name: ctl_tipo_archivo ctl_tipo_archivo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ctl_tipo_archivo
    ADD CONSTRAINT ctl_tipo_archivo_pkey PRIMARY KEY (id);


--
-- TOC entry 3034 (class 2606 OID 19094)
-- Name: ctl_tipo_aviso ctl_tipo_aviso_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ctl_tipo_aviso
    ADD CONSTRAINT ctl_tipo_aviso_pkey PRIMARY KEY (id);


--
-- TOC entry 3036 (class 2606 OID 19099)
-- Name: ctl_tipo_contacto ctl_tipo_contacto_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ctl_tipo_contacto
    ADD CONSTRAINT ctl_tipo_contacto_pkey PRIMARY KEY (id);


--
-- TOC entry 3086 (class 2606 OID 19374)
-- Name: ctl_tipo_promocion ctl_tipo_promocion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ctl_tipo_promocion
    ADD CONSTRAINT ctl_tipo_promocion_pkey PRIMARY KEY (id);


--
-- TOC entry 3038 (class 2606 OID 19123)
-- Name: datos_persona datos_persona_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.datos_persona
    ADD CONSTRAINT datos_persona_pkey PRIMARY KEY (id);


--
-- TOC entry 3084 (class 2606 OID 19361)
-- Name: departamento departamento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.departamento
    ADD CONSTRAINT departamento_pkey PRIMARY KEY (id);


--
-- TOC entry 3082 (class 2606 OID 19354)
-- Name: municipio municipio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.municipio
    ADD CONSTRAINT municipio_pkey PRIMARY KEY (id);


--
-- TOC entry 3041 (class 2606 OID 19130)
-- Name: persona_cliente persona_cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.persona_cliente
    ADD CONSTRAINT persona_cliente_pkey PRIMARY KEY (id);


--
-- TOC entry 3045 (class 2606 OID 19141)
-- Name: persona_empleado persona_empleado_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.persona_empleado
    ADD CONSTRAINT persona_empleado_pkey PRIMARY KEY (id);


--
-- TOC entry 3049 (class 2606 OID 19148)
-- Name: promo_aviso promo_aviso_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_aviso
    ADD CONSTRAINT promo_aviso_pkey PRIMARY KEY (id);


--
-- TOC entry 3052 (class 2606 OID 19156)
-- Name: promo_categoria promo_categoria_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_categoria
    ADD CONSTRAINT promo_categoria_pkey PRIMARY KEY (id);


--
-- TOC entry 3079 (class 2606 OID 19334)
-- Name: promo_contacto_establecimiento promo_contacto_establecimiento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_contacto_establecimiento
    ADD CONSTRAINT promo_contacto_establecimiento_pkey PRIMARY KEY (id);


--
-- TOC entry 3101 (class 2606 OID 19436)
-- Name: promo_contacto_sucursal promo_contacto_sucursal_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_contacto_sucursal
    ADD CONSTRAINT promo_contacto_sucursal_pkey PRIMARY KEY (id);


--
-- TOC entry 3056 (class 2606 OID 19161)
-- Name: promo_establecimiento promo_establecimiento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_establecimiento
    ADD CONSTRAINT promo_establecimiento_pkey PRIMARY KEY (id);


--
-- TOC entry 3075 (class 2606 OID 19315)
-- Name: promo_establecimiento_promo_categoria promo_establecimiento_promo_categoria_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_establecimiento_promo_categoria
    ADD CONSTRAINT promo_establecimiento_promo_categoria_pkey PRIMARY KEY (promo_establecimiento_id, promo_categoria_id);


--
-- TOC entry 3093 (class 2606 OID 19403)
-- Name: promo_promociones promo_promociones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_promociones
    ADD CONSTRAINT promo_promociones_pkey PRIMARY KEY (id);


--
-- TOC entry 3090 (class 2606 OID 19381)
-- Name: promo_sucursal promo_sucursal_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_sucursal
    ADD CONSTRAINT promo_sucursal_pkey PRIMARY KEY (id);


--
-- TOC entry 3097 (class 2606 OID 19416)
-- Name: promocion_sucursal promocion_sucursal_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promocion_sucursal
    ADD CONSTRAINT promocion_sucursal_pkey PRIMARY KEY (id);


--
-- TOC entry 3060 (class 2606 OID 19166)
-- Name: tipo_contacto tipo_contacto_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_contacto
    ADD CONSTRAINT tipo_contacto_pkey PRIMARY KEY (id);


--
-- TOC entry 3062 (class 2606 OID 19176)
-- Name: tipo_empleado tipo_empleado_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_empleado
    ADD CONSTRAINT tipo_empleado_pkey PRIMARY KEY (id);


--
-- TOC entry 3064 (class 2606 OID 19181)
-- Name: usuario_cliente usuario_cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_cliente
    ADD CONSTRAINT usuario_cliente_pkey PRIMARY KEY (id);


--
-- TOC entry 3067 (class 2606 OID 19186)
-- Name: usuario_empleado usuario_empleado_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_empleado
    ADD CONSTRAINT usuario_empleado_pkey PRIMARY KEY (id);


--
-- TOC entry 3071 (class 2606 OID 19192)
-- Name: usuario_empleado_tipo_empleado usuario_empleado_tipo_empleado_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_empleado_tipo_empleado
    ADD CONSTRAINT usuario_empleado_tipo_empleado_pkey PRIMARY KEY (usuario_empleado_id, tipo_empleado_id);


--
-- TOC entry 3087 (class 1259 OID 19383)
-- Name: idx_2143486e7b7d6e92; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_2143486e7b7d6e92 ON public.promo_sucursal USING btree (id_municipio_id);


--
-- TOC entry 3088 (class 1259 OID 19382)
-- Name: idx_2143486ef294a1fe; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_2143486ef294a1fe ON public.promo_sucursal USING btree (id_establecimiento_id);


--
-- TOC entry 3030 (class 1259 OID 19084)
-- Name: idx_2741493cbdfe2780; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_2741493cbdfe2780 ON public.contacto USING btree (id_tipo_contacto_id);


--
-- TOC entry 3068 (class 1259 OID 19194)
-- Name: idx_34ef7840a00fc9c8; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_34ef7840a00fc9c8 ON public.usuario_empleado_tipo_empleado USING btree (tipo_empleado_id);


--
-- TOC entry 3069 (class 1259 OID 19193)
-- Name: idx_34ef7840ad0015be; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_34ef7840ad0015be ON public.usuario_empleado_tipo_empleado USING btree (usuario_empleado_id);


--
-- TOC entry 3027 (class 1259 OID 19077)
-- Name: idx_3529b4823e33389b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_3529b4823e33389b ON public.archivo USING btree (id_tipo_archivo_id);


--
-- TOC entry 3098 (class 1259 OID 19438)
-- Name: idx_451168f8279a5d5e; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_451168f8279a5d5e ON public.promo_contacto_sucursal USING btree (sucursal_id);


--
-- TOC entry 3099 (class 1259 OID 19437)
-- Name: idx_451168f87342915e; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_451168f87342915e ON public.promo_contacto_sucursal USING btree (id_contacto_id);


--
-- TOC entry 3047 (class 1259 OID 19149)
-- Name: idx_5b14cc65f5fa2e0b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_5b14cc65f5fa2e0b ON public.promo_aviso USING btree (id_tipo_aviso_id);


--
-- TOC entry 3076 (class 1259 OID 19335)
-- Name: idx_9d363a606b505ca9; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_9d363a606b505ca9 ON public.promo_contacto_establecimiento USING btree (contacto_id);


--
-- TOC entry 3077 (class 1259 OID 19336)
-- Name: idx_9d363a6071b61351; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_9d363a6071b61351 ON public.promo_contacto_establecimiento USING btree (establecimiento_id);


--
-- TOC entry 3072 (class 1259 OID 19317)
-- Name: idx_dc263e3aab91b76d; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_dc263e3aab91b76d ON public.promo_establecimiento_promo_categoria USING btree (promo_categoria_id);


--
-- TOC entry 3073 (class 1259 OID 19316)
-- Name: idx_dc263e3ae23ba32d; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_dc263e3ae23ba32d ON public.promo_establecimiento_promo_categoria USING btree (promo_establecimiento_id);


--
-- TOC entry 3094 (class 1259 OID 19417)
-- Name: idx_e6bc69903f8890a9; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_e6bc69903f8890a9 ON public.promocion_sucursal USING btree (id_sucursal_id);


--
-- TOC entry 3095 (class 1259 OID 19418)
-- Name: idx_e6bc6990922526a6; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_e6bc6990922526a6 ON public.promocion_sucursal USING btree (id_promocion_id);


--
-- TOC entry 3091 (class 1259 OID 19404)
-- Name: idx_ecfc0c3877bac71c; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_ecfc0c3877bac71c ON public.promo_promociones USING btree (id_tipo_id);


--
-- TOC entry 3080 (class 1259 OID 19367)
-- Name: idx_fe98f5e0b3cf0305; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_fe98f5e0b3cf0305 ON public.municipio USING btree (id_departamento_id);


--
-- TOC entry 3065 (class 1259 OID 19187)
-- Name: uniq_31184dcb952be730; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_31184dcb952be730 ON public.usuario_empleado USING btree (empleado_id);


--
-- TOC entry 3046 (class 1259 OID 19142)
-- Name: uniq_390aab1377198a62; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_390aab1377198a62 ON public.persona_empleado USING btree (datos_id);


--
-- TOC entry 3050 (class 1259 OID 19150)
-- Name: uniq_5b14cc651817f2b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_5b14cc651817f2b ON public.promo_aviso USING btree (archivo_logo_id);


--
-- TOC entry 3053 (class 1259 OID 19291)
-- Name: uniq_66da75961817f2b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_66da75961817f2b ON public.promo_categoria USING btree (archivo_logo_id);


--
-- TOC entry 3054 (class 1259 OID 19310)
-- Name: uniq_66da7596cec8d20b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_66da7596cec8d20b ON public.promo_categoria USING btree (archivo_banner_id);


--
-- TOC entry 3039 (class 1259 OID 19124)
-- Name: uniq_957fdf3ed6b9eea1; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_957fdf3ed6b9eea1 ON public.datos_persona USING btree (dui);


--
-- TOC entry 3057 (class 1259 OID 19303)
-- Name: uniq_e01580af1817f2b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_e01580af1817f2b ON public.promo_establecimiento USING btree (archivo_logo_id);


--
-- TOC entry 3058 (class 1259 OID 19304)
-- Name: uniq_e01580afcec8d20b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_e01580afcec8d20b ON public.promo_establecimiento USING btree (archivo_banner_id);


--
-- TOC entry 3042 (class 1259 OID 19131)
-- Name: uniq_f2e1c42f77198a62; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_f2e1c42f77198a62 ON public.persona_cliente USING btree (datos_id);


--
-- TOC entry 3043 (class 1259 OID 19132)
-- Name: uniq_f2e1c42fdb38439e; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_f2e1c42fdb38439e ON public.persona_cliente USING btree (usuario_id);


--
-- TOC entry 3122 (class 2606 OID 19389)
-- Name: promo_sucursal fk_2143486e7b7d6e92; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_sucursal
    ADD CONSTRAINT fk_2143486e7b7d6e92 FOREIGN KEY (id_municipio_id) REFERENCES public.municipio(id);


--
-- TOC entry 3121 (class 2606 OID 19384)
-- Name: promo_sucursal fk_2143486ef294a1fe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_sucursal
    ADD CONSTRAINT fk_2143486ef294a1fe FOREIGN KEY (id_establecimiento_id) REFERENCES public.promo_establecimiento(id);


--
-- TOC entry 3103 (class 2606 OID 19235)
-- Name: contacto fk_2741493cbdfe2780; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contacto
    ADD CONSTRAINT fk_2741493cbdfe2780 FOREIGN KEY (id_tipo_contacto_id) REFERENCES public.ctl_tipo_contacto(id);


--
-- TOC entry 3113 (class 2606 OID 19265)
-- Name: usuario_empleado fk_31184dcb952be730; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_empleado
    ADD CONSTRAINT fk_31184dcb952be730 FOREIGN KEY (empleado_id) REFERENCES public.persona_empleado(id);


--
-- TOC entry 3115 (class 2606 OID 19275)
-- Name: usuario_empleado_tipo_empleado fk_34ef7840a00fc9c8; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_empleado_tipo_empleado
    ADD CONSTRAINT fk_34ef7840a00fc9c8 FOREIGN KEY (tipo_empleado_id) REFERENCES public.tipo_empleado(id) ON DELETE CASCADE;


--
-- TOC entry 3114 (class 2606 OID 19270)
-- Name: usuario_empleado_tipo_empleado fk_34ef7840ad0015be; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_empleado_tipo_empleado
    ADD CONSTRAINT fk_34ef7840ad0015be FOREIGN KEY (usuario_empleado_id) REFERENCES public.usuario_empleado(id) ON DELETE CASCADE;


--
-- TOC entry 3102 (class 2606 OID 19225)
-- Name: archivo fk_3529b4823e33389b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.archivo
    ADD CONSTRAINT fk_3529b4823e33389b FOREIGN KEY (id_tipo_archivo_id) REFERENCES public.ctl_tipo_archivo(id);


--
-- TOC entry 3106 (class 2606 OID 19250)
-- Name: persona_empleado fk_390aab1377198a62; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.persona_empleado
    ADD CONSTRAINT fk_390aab1377198a62 FOREIGN KEY (datos_id) REFERENCES public.datos_persona(id);


--
-- TOC entry 3127 (class 2606 OID 19444)
-- Name: promo_contacto_sucursal fk_451168f8279a5d5e; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_contacto_sucursal
    ADD CONSTRAINT fk_451168f8279a5d5e FOREIGN KEY (sucursal_id) REFERENCES public.promo_sucursal(id);


--
-- TOC entry 3126 (class 2606 OID 19439)
-- Name: promo_contacto_sucursal fk_451168f87342915e; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_contacto_sucursal
    ADD CONSTRAINT fk_451168f87342915e FOREIGN KEY (id_contacto_id) REFERENCES public.contacto(id);


--
-- TOC entry 3108 (class 2606 OID 19260)
-- Name: promo_aviso fk_5b14cc651817f2b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_aviso
    ADD CONSTRAINT fk_5b14cc651817f2b FOREIGN KEY (archivo_logo_id) REFERENCES public.archivo(id);


--
-- TOC entry 3107 (class 2606 OID 19255)
-- Name: promo_aviso fk_5b14cc65f5fa2e0b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_aviso
    ADD CONSTRAINT fk_5b14cc65f5fa2e0b FOREIGN KEY (id_tipo_aviso_id) REFERENCES public.ctl_tipo_aviso(id);


--
-- TOC entry 3109 (class 2606 OID 19281)
-- Name: promo_categoria fk_66da75961817f2b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_categoria
    ADD CONSTRAINT fk_66da75961817f2b FOREIGN KEY (archivo_logo_id) REFERENCES public.archivo(id);


--
-- TOC entry 3110 (class 2606 OID 19305)
-- Name: promo_categoria fk_66da7596cec8d20b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_categoria
    ADD CONSTRAINT fk_66da7596cec8d20b FOREIGN KEY (archivo_banner_id) REFERENCES public.archivo(id);


--
-- TOC entry 3118 (class 2606 OID 19337)
-- Name: promo_contacto_establecimiento fk_9d363a606b505ca9; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_contacto_establecimiento
    ADD CONSTRAINT fk_9d363a606b505ca9 FOREIGN KEY (contacto_id) REFERENCES public.contacto(id);


--
-- TOC entry 3119 (class 2606 OID 19342)
-- Name: promo_contacto_establecimiento fk_9d363a6071b61351; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_contacto_establecimiento
    ADD CONSTRAINT fk_9d363a6071b61351 FOREIGN KEY (establecimiento_id) REFERENCES public.promo_establecimiento(id);


--
-- TOC entry 3117 (class 2606 OID 19323)
-- Name: promo_establecimiento_promo_categoria fk_dc263e3aab91b76d; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_establecimiento_promo_categoria
    ADD CONSTRAINT fk_dc263e3aab91b76d FOREIGN KEY (promo_categoria_id) REFERENCES public.promo_categoria(id) ON DELETE CASCADE;


--
-- TOC entry 3116 (class 2606 OID 19318)
-- Name: promo_establecimiento_promo_categoria fk_dc263e3ae23ba32d; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_establecimiento_promo_categoria
    ADD CONSTRAINT fk_dc263e3ae23ba32d FOREIGN KEY (promo_establecimiento_id) REFERENCES public.promo_establecimiento(id) ON DELETE CASCADE;


--
-- TOC entry 3111 (class 2606 OID 19293)
-- Name: promo_establecimiento fk_e01580af1817f2b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_establecimiento
    ADD CONSTRAINT fk_e01580af1817f2b FOREIGN KEY (archivo_logo_id) REFERENCES public.archivo(id);


--
-- TOC entry 3112 (class 2606 OID 19298)
-- Name: promo_establecimiento fk_e01580afcec8d20b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_establecimiento
    ADD CONSTRAINT fk_e01580afcec8d20b FOREIGN KEY (archivo_banner_id) REFERENCES public.archivo(id);


--
-- TOC entry 3124 (class 2606 OID 19419)
-- Name: promocion_sucursal fk_e6bc69903f8890a9; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promocion_sucursal
    ADD CONSTRAINT fk_e6bc69903f8890a9 FOREIGN KEY (id_sucursal_id) REFERENCES public.promo_sucursal(id);


--
-- TOC entry 3125 (class 2606 OID 19424)
-- Name: promocion_sucursal fk_e6bc6990922526a6; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promocion_sucursal
    ADD CONSTRAINT fk_e6bc6990922526a6 FOREIGN KEY (id_promocion_id) REFERENCES public.promo_promociones(id);


--
-- TOC entry 3123 (class 2606 OID 19405)
-- Name: promo_promociones fk_ecfc0c3877bac71c; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.promo_promociones
    ADD CONSTRAINT fk_ecfc0c3877bac71c FOREIGN KEY (id_tipo_id) REFERENCES public.ctl_tipo_promocion(id);


--
-- TOC entry 3104 (class 2606 OID 19240)
-- Name: persona_cliente fk_f2e1c42f77198a62; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.persona_cliente
    ADD CONSTRAINT fk_f2e1c42f77198a62 FOREIGN KEY (datos_id) REFERENCES public.datos_persona(id);


--
-- TOC entry 3105 (class 2606 OID 19245)
-- Name: persona_cliente fk_f2e1c42fdb38439e; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.persona_cliente
    ADD CONSTRAINT fk_f2e1c42fdb38439e FOREIGN KEY (usuario_id) REFERENCES public.usuario_cliente(id);


--
-- TOC entry 3120 (class 2606 OID 19362)
-- Name: municipio fk_fe98f5e0b3cf0305; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.municipio
    ADD CONSTRAINT fk_fe98f5e0b3cf0305 FOREIGN KEY (id_departamento_id) REFERENCES public.departamento(id);


-- Completed on 2022-04-27 09:39:59

--
-- PostgreSQL database dump complete
--

