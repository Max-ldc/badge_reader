--
-- PostgreSQL database dump
--

-- Dumped from database version 15.5
-- Dumped by pg_dump version 15.6

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

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: badge; Type: TABLE; Schema: public; Owner: pedro
--

CREATE TABLE public.badge (
    id integer NOT NULL,
    key_id integer,
    serial_number character varying(255) NOT NULL
);


ALTER TABLE public.badge OWNER TO pedro;

--
-- Name: badge_id_seq; Type: SEQUENCE; Schema: public; Owner: pedro
--

CREATE SEQUENCE public.badge_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.badge_id_seq OWNER TO pedro;

--
-- Name: badge_reader; Type: TABLE; Schema: public; Owner: pedro
--

CREATE TABLE public.badge_reader (
    id integer NOT NULL,
    serial_number character varying(255) NOT NULL,
    system_version character varying(255) NOT NULL,
    model_name character varying(255) NOT NULL,
    system_name character varying(255) NOT NULL
);


ALTER TABLE public.badge_reader OWNER TO pedro;

--
-- Name: badge_reader_id_seq; Type: SEQUENCE; Schema: public; Owner: pedro
--

CREATE SEQUENCE public.badge_reader_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.badge_reader_id_seq OWNER TO pedro;

--
-- Name: doctrine_migration_versions; Type: TABLE; Schema: public; Owner: pedro
--

CREATE TABLE public.doctrine_migration_versions (
    version character varying(191) NOT NULL,
    executed_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    execution_time integer
);


ALTER TABLE public.doctrine_migration_versions OWNER TO pedro;

--
-- Name: key; Type: TABLE; Schema: public; Owner: pedro
--

CREATE TABLE public.key (
    id integer NOT NULL,
    passphrase character varying(255) NOT NULL
);


ALTER TABLE public.key OWNER TO pedro;

--
-- Name: key_badge_reader; Type: TABLE; Schema: public; Owner: pedro
--

CREATE TABLE public.key_badge_reader (
    key_id integer NOT NULL,
    badge_reader_id integer NOT NULL
);


ALTER TABLE public.key_badge_reader OWNER TO pedro;

--
-- Name: key_id_seq; Type: SEQUENCE; Schema: public; Owner: pedro
--

CREATE SEQUENCE public.key_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.key_id_seq OWNER TO pedro;

--
-- Name: registration; Type: TABLE; Schema: public; Owner: pedro
--

CREATE TABLE public.registration (
    id integer NOT NULL,
    badge_id integer NOT NULL,
    badge_reader_id integer NOT NULL,
    date timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.registration OWNER TO pedro;

--
-- Name: registration_id_seq; Type: SEQUENCE; Schema: public; Owner: pedro
--

CREATE SEQUENCE public.registration_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.registration_id_seq OWNER TO pedro;

--
-- Data for Name: badge; Type: TABLE DATA; Schema: public; Owner: pedro
--

COPY public.badge (id, key_id, serial_number) FROM stdin;
\.


--
-- Data for Name: badge_reader; Type: TABLE DATA; Schema: public; Owner: pedro
--

COPY public.badge_reader (id, serial_number, system_version, model_name, system_name) FROM stdin;
\.


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: pedro
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20240220132041	2024-02-20 13:23:56	207
\.


--
-- Data for Name: key; Type: TABLE DATA; Schema: public; Owner: pedro
--

COPY public.key (id, passphrase) FROM stdin;
\.


--
-- Data for Name: key_badge_reader; Type: TABLE DATA; Schema: public; Owner: pedro
--

COPY public.key_badge_reader (key_id, badge_reader_id) FROM stdin;
\.


--
-- Data for Name: registration; Type: TABLE DATA; Schema: public; Owner: pedro
--

COPY public.registration (id, badge_id, badge_reader_id, date) FROM stdin;
\.


--
-- Name: badge_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pedro
--

SELECT pg_catalog.setval('public.badge_id_seq', 1, false);


--
-- Name: badge_reader_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pedro
--

SELECT pg_catalog.setval('public.badge_reader_id_seq', 1, false);


--
-- Name: key_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pedro
--

SELECT pg_catalog.setval('public.key_id_seq', 1, false);


--
-- Name: registration_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pedro
--

SELECT pg_catalog.setval('public.registration_id_seq', 1, false);


--
-- Name: badge badge_pkey; Type: CONSTRAINT; Schema: public; Owner: pedro
--

ALTER TABLE ONLY public.badge
    ADD CONSTRAINT badge_pkey PRIMARY KEY (id);


--
-- Name: badge_reader badge_reader_pkey; Type: CONSTRAINT; Schema: public; Owner: pedro
--

ALTER TABLE ONLY public.badge_reader
    ADD CONSTRAINT badge_reader_pkey PRIMARY KEY (id);


--
-- Name: doctrine_migration_versions doctrine_migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: pedro
--

ALTER TABLE ONLY public.doctrine_migration_versions
    ADD CONSTRAINT doctrine_migration_versions_pkey PRIMARY KEY (version);


--
-- Name: key_badge_reader key_badge_reader_pkey; Type: CONSTRAINT; Schema: public; Owner: pedro
--

ALTER TABLE ONLY public.key_badge_reader
    ADD CONSTRAINT key_badge_reader_pkey PRIMARY KEY (key_id, badge_reader_id);


--
-- Name: key key_pkey; Type: CONSTRAINT; Schema: public; Owner: pedro
--

ALTER TABLE ONLY public.key
    ADD CONSTRAINT key_pkey PRIMARY KEY (id);


--
-- Name: registration registration_pkey; Type: CONSTRAINT; Schema: public; Owner: pedro
--

ALTER TABLE ONLY public.registration
    ADD CONSTRAINT registration_pkey PRIMARY KEY (id);


--
-- Name: idx_110d545026bb88a3; Type: INDEX; Schema: public; Owner: pedro
--

CREATE INDEX idx_110d545026bb88a3 ON public.key_badge_reader USING btree (badge_reader_id);


--
-- Name: idx_110d5450d145533; Type: INDEX; Schema: public; Owner: pedro
--

CREATE INDEX idx_110d5450d145533 ON public.key_badge_reader USING btree (key_id);


--
-- Name: idx_62a8a7a726bb88a3; Type: INDEX; Schema: public; Owner: pedro
--

CREATE INDEX idx_62a8a7a726bb88a3 ON public.registration USING btree (badge_reader_id);


--
-- Name: idx_62a8a7a7f7a2c2fc; Type: INDEX; Schema: public; Owner: pedro
--

CREATE INDEX idx_62a8a7a7f7a2c2fc ON public.registration USING btree (badge_id);


--
-- Name: idx_fef0481dd145533; Type: INDEX; Schema: public; Owner: pedro
--

CREATE INDEX idx_fef0481dd145533 ON public.badge USING btree (key_id);


--
-- Name: key_badge_reader fk_110d545026bb88a3; Type: FK CONSTRAINT; Schema: public; Owner: pedro
--

ALTER TABLE ONLY public.key_badge_reader
    ADD CONSTRAINT fk_110d545026bb88a3 FOREIGN KEY (badge_reader_id) REFERENCES public.badge_reader(id) ON DELETE CASCADE;


--
-- Name: key_badge_reader fk_110d5450d145533; Type: FK CONSTRAINT; Schema: public; Owner: pedro
--

ALTER TABLE ONLY public.key_badge_reader
    ADD CONSTRAINT fk_110d5450d145533 FOREIGN KEY (key_id) REFERENCES public.key(id) ON DELETE CASCADE;


--
-- Name: registration fk_62a8a7a726bb88a3; Type: FK CONSTRAINT; Schema: public; Owner: pedro
--

ALTER TABLE ONLY public.registration
    ADD CONSTRAINT fk_62a8a7a726bb88a3 FOREIGN KEY (badge_reader_id) REFERENCES public.badge_reader(id);


--
-- Name: registration fk_62a8a7a7f7a2c2fc; Type: FK CONSTRAINT; Schema: public; Owner: pedro
--

ALTER TABLE ONLY public.registration
    ADD CONSTRAINT fk_62a8a7a7f7a2c2fc FOREIGN KEY (badge_id) REFERENCES public.badge(id);


--
-- Name: badge fk_fef0481dd145533; Type: FK CONSTRAINT; Schema: public; Owner: pedro
--

ALTER TABLE ONLY public.badge
    ADD CONSTRAINT fk_fef0481dd145533 FOREIGN KEY (key_id) REFERENCES public.key(id);


--
-- PostgreSQL database dump complete
--

