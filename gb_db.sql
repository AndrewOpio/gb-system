--
-- PostgreSQL database dump
--

-- Dumped from database version 13.4 (Ubuntu 13.4-1.pgdg18.04+1)
-- Dumped by pg_dump version 13.4 (Ubuntu 13.4-1.pgdg18.04+1)

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
-- Name: arrivals; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.arrivals (
    id integer NOT NULL,
    visitorid integer NOT NULL,
    passportnumber text NOT NULL,
    finaldestination integer NOT NULL,
    flightno text NOT NULL,
    travelreason text NOT NULL,
    arrivaldate date NOT NULL,
    arrivingfrom integer
);


--
-- Name: arrivals_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.arrivals_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: arrivals_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.arrivals_id_seq OWNED BY public.arrivals.id;


--
-- Name: countries; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.countries (
    id integer NOT NULL,
    countrycode text NOT NULL,
    countryname text NOT NULL
);


--
-- Name: countries_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.countries_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: countries_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.countries_id_seq OWNED BY public.countries.id;


--
-- Name: departures; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.departures (
    id integer NOT NULL,
    visitorid integer NOT NULL,
    passportnumber text,
    finaldestination integer,
    departuredate date,
    departurereason text,
    flightno text
);


--
-- Name: departures_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.departures_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: departures_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.departures_id_seq OWNED BY public.departures.id;


--
-- Name: gb_visitors; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.gb_visitors (
    id integer NOT NULL,
    passporttype text NOT NULL,
    capturedate date NOT NULL,
    surname text NOT NULL,
    othernames text NOT NULL,
    dob date NOT NULL,
    birthlocation text NOT NULL,
    fathersname text,
    mothersname text,
    maritalstatus text,
    profession text,
    currentoccupation text,
    nationality text NOT NULL,
    citizen text NOT NULL,
    issueaddress text NOT NULL,
    thumbprint text NOT NULL,
    photo text NOT NULL,
    passportnumber text NOT NULL,
    passportissuedate date NOT NULL,
    passportexpiry date NOT NULL,
    signature text NOT NULL
);


--
-- Name: gb_visitors_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.gb_visitors_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: gb_visitors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.gb_visitors_id_seq OWNED BY public.gb_visitors.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.users (
    id integer NOT NULL,
    email text NOT NULL,
    username text NOT NULL,
    password text NOT NULL
);


--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: arrivals id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.arrivals ALTER COLUMN id SET DEFAULT nextval('public.arrivals_id_seq'::regclass);


--
-- Name: countries id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.countries ALTER COLUMN id SET DEFAULT nextval('public.countries_id_seq'::regclass);


--
-- Name: departures id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.departures ALTER COLUMN id SET DEFAULT nextval('public.departures_id_seq'::regclass);


--
-- Name: gb_visitors id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.gb_visitors ALTER COLUMN id SET DEFAULT nextval('public.gb_visitors_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: arrivals; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.arrivals (id, visitorid, passportnumber, finaldestination, flightno, travelreason, arrivaldate, arrivingfrom) FROM stdin;
1	1	njnjkjknjknkjn	1	dsdydsydsfyu	duhcdufhdu	2021-09-23	\N
2	2	njnjkjknjknkjn	1	dsdydsydsfyu	duhcdufhdu	2021-09-23	\N
3	2	njnjkjknjknkjn	1	dsdydsydsfyu	duhcdufhdu	2021-09-23	1
4	1	njnjkjknjknkjn	2	dsdydsydsfyu	duhcdufhdu	2021-09-09	1
5	4	njnjkjknjknkjn	1	dsdydsydsfyu	duhcdufhdu	2021-09-20	1
\.


--
-- Data for Name: countries; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.countries (id, countrycode, countryname) FROM stdin;
1	UG	Uganda
2	KE	Kenya
\.


--
-- Data for Name: departures; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.departures (id, visitorid, passportnumber, finaldestination, departuredate, departurereason, flightno) FROM stdin;
1	1	njnjkjknjknkjn	1	2021-09-23	duhcdufhdu	dsdydsydsfyu
2	4	njnjkjknjknkjn	1	2021-09-21	duhcdufhdu	dsdydsydsfyu
3	2	njnjkjknjknkjn	2	2021-09-16	duhcdufhdu	dsdydsydsfyu
\.


--
-- Data for Name: gb_visitors; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.gb_visitors (id, passporttype, capturedate, surname, othernames, dob, birthlocation, fathersname, mothersname, maritalstatus, profession, currentoccupation, nationality, citizen, issueaddress, thumbprint, photo, passportnumber, passportissuedate, passportexpiry, signature) FROM stdin;
1	jjjihiui	2021-09-10	hjjhvhv	vgvghvghv	2021-09-22	 jhbjhbjhbhjb	\N	\N	\N	\N	\N	Kireka	yes	Kampala	thumbprints/facebook.png	photos/facebook.png	njnjkjknjknkjn	2021-09-29	2021-09-17	signatures/facebook.png
2	jjjihiui	2021-09-09	hjjhvhv	vgvghvghv	2021-09-24	Kampala	\N	\N	\N	\N	\N	Kireka	yes	Kampala	thumbprints/delivery-truck (2).png	photos/bg.jpg	njnjkjknjknkjn	2021-09-29	2021-09-16	signatures/
3	jjjihiui	2021-09-09	hjjhvhv	vgvghvghv	2021-09-24	Kampala	\N	\N	\N	\N	\N	Kireka	yes	Kampala	thumbprints/delivery-truck (2).png	photos/bg.jpg	njnjkjknjknkjn	2021-09-29	2021-09-16	signatures/
4	jjjihiui	2021-09-17	hjjhvhv	vgvghvghv	2021-09-27	Kampala	\N	\N	\N	\N	\N	Kireka	yes	Kampala	thumbprints/facebook.png	photos/facebook.png	njnjkjknjknkjn	2021-09-21	2021-09-29	signatures/logout.png
5	jjjihiui	2021-09-17	hjjhvhv	vgvghvghv	2021-09-27	Kampala	\N	\N	\N	\N	\N	Kireka	yes	Kampala	thumbprints/facebook.png	photos/facebook.png	njnjkjknjknkjn	2021-09-21	2021-09-29	signatures/logout.png
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.users (id, email, username, password) FROM stdin;
1	admin@gmail.com	Master	admin123
\.


--
-- Name: arrivals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.arrivals_id_seq', 5, true);


--
-- Name: countries_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.countries_id_seq', 2, true);


--
-- Name: departures_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.departures_id_seq', 3, true);


--
-- Name: gb_visitors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.gb_visitors_id_seq', 5, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.users_id_seq', 1, true);


--
-- Name: arrivals arrivals_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.arrivals
    ADD CONSTRAINT arrivals_pkey PRIMARY KEY (id);


--
-- Name: countries countries_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.countries
    ADD CONSTRAINT countries_pkey PRIMARY KEY (id);


--
-- Name: departures departures_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.departures
    ADD CONSTRAINT departures_pkey PRIMARY KEY (id);


--
-- Name: gb_visitors gb_visitors_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.gb_visitors
    ADD CONSTRAINT gb_visitors_pkey PRIMARY KEY (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: departures fk_gb_visitors; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.departures
    ADD CONSTRAINT fk_gb_visitors FOREIGN KEY (visitorid) REFERENCES public.gb_visitors(id);


--
-- Name: arrivals fk_gb_visitors; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.arrivals
    ADD CONSTRAINT fk_gb_visitors FOREIGN KEY (visitorid) REFERENCES public.gb_visitors(id);


--
-- PostgreSQL database dump complete
--

