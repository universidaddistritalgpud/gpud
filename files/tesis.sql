--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.6
-- Dumped by pg_dump version 9.5.6

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: processing; Type: TABLE; Schema: public; Owner: gpud
--

CREATE TABLE processing (
    id character varying(32) NOT NULL,
    id_user character varying(32) NOT NULL,
    content_json text,
    processing_state character varying(15),
    registration_state boolean DEFAULT true,
    registration_date timestamp without time zone DEFAULT now()
);


ALTER TABLE processing OWNER TO gpud;

--
-- Name: session; Type: TABLE; Schema: public; Owner: gpud
--

CREATE TABLE session (
    session_id character varying(32) NOT NULL,
    user_id character varying(255),
    origin smallint,
    type smallint,
    expiration bigint
);


ALTER TABLE session OWNER TO gpud;

--
-- Name: users; Type: TABLE; Schema: public; Owner: gpud
--

CREATE TABLE users (
    id character varying(32) NOT NULL,
    name text NOT NULL,
    lastname text NOT NULL,
    email text NOT NULL,
    password text NOT NULL,
    occupation smallint,
    status boolean DEFAULT false NOT NULL,
    token character varying(6) NOT NULL
);


ALTER TABLE users OWNER TO gpud;

--
-- Data for Name: processing; Type: TABLE DATA; Schema: public; Owner: gpud
--

COPY processing (id, id_user, content_json, processing_state, registration_state, registration_date) FROM stdin;
cc74a0	d014f2138c48b7588bb7471df342e2af	{"strucFolder":{"prefijo":"cc74a0","folder":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/cc74a0\\/","report":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/cc74a0\\/Report","ephemeris":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/cc74a0\\/Ephemeris","rinex":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/cc74a0\\/Rinex","process":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/cc74a0\\/Process"},"isLoads":true,"station":["boga,","vivi,","cali,","mede,"],"loadsOceanicName":"oceanloading.dat","pathOceanicLoads":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/cc74a0\\/Process\\/oceanloading.dat","isRinex":true,"antenna":"LEIAT504GG NONE","date":{"year":"2012","month":"2","monthText":"Febrero","monthInit":"Feb","day":"26","dayText":"Domingo"},"position":{"latitude":4.6387947508714,"longitude":-74.079958044817,"height":2611.895158452,"X":"1744516.5488","Y":"-6116052.3337","Z":"512585.3866"},"markerName":"BOGA","heightAntenna":{"H":"1.3720","E":"0.0000","N":"0.0000"},"datePrecise":{"year":"12","month":"2","monthText":" ","monthInit":"Feb","day":"26","hourStart":"0","minStart":"0","segStart":"0.0000000","hourEnd":"23","minEnd":"59","segEnd":"45.0000000","hourMedium":"23","minMedium":"59","segMedium":"30.0000000","dateStart":"0H 0M 0.0000000S","dateEnd":"23H 59M 45.0000000S"},"interval":"15.0000","intervalPrecise":"0H 0M 15S","notLoadOceanic":false,"rinexName":"BOGA0570.12O","daygnss":0,"dayofyear":57,"weekgnss":1677,"dayjulian":2455983.5,"displacementPolo":{"X":"0.020541","Y":"0.270373"},"pathEphemeris":{"0":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/cc74a0\\/Ephemeris\\/igs16766.sp3","1":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/cc74a0\\/Ephemeris\\/igs16770.sp3","ngs":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/cc74a0\\/Ephemeris\\/ngs16770.sp3","2":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/cc74a0\\/Ephemeris\\/igs16771.sp3"},"pathRinex":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/cc74a0\\/Rinex\\/BOGA0570.12O","files":{"pathPPPConf":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/cc74a0\\/Process\\/pppconf.txt","pathScript":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/cc74a0\\/Process\\/script_exec_example9.sh","pathScriptProcessing":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/cc74a0\\/Process\\/script_exec_processing.sh","copyFiles":true,"pathOut":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/cc74a0\\/Report\\/BOGA.out","pathModel":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/cc74a0\\/Report\\/BOGA.model"},"gif":["http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/files\\/cc74a0\\/Report\\/BOGA_0.gif","http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/files\\/cc74a0\\/Report\\/BOGA_1.gif","http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/files\\/cc74a0\\/Report\\/BOGA_2.gif"]}	TERMINADO	t	2017-04-10 12:55:27.895468
2a8cc7	d014f2138c48b7588bb7471df342e2af	{"strucFolder":{"prefijo":"2a8cc7","folder":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/2a8cc7\\/","report":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/2a8cc7\\/Report","ephemeris":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/2a8cc7\\/Ephemeris","rinex":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/2a8cc7\\/Rinex","process":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/2a8cc7\\/Process"},"isLoads":true,"station":["boga,","vivi,","cali,","mede,"],"loadsOceanicName":"oceanloading.dat","pathOceanicLoads":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/2a8cc7\\/Process\\/oceanloading.dat","isRinex":true,"antenna":"LEIAT504GG NONE","date":{"year":"2012","month":"2","monthText":"Febrero","monthInit":"Feb","day":"26","dayText":"Domingo"},"position":{"latitude":4.6387947508714,"longitude":-74.079958044817,"height":2611.895158452,"X":"1744516.5488","Y":"-6116052.3337","Z":"512585.3866"},"markerName":"BOGA","heightAntenna":{"H":"1.3720","E":"0.0000","N":"0.0000"},"datePrecise":{"year":"12","month":"2","monthText":" ","monthInit":"Feb","day":"26","hourStart":"0","minStart":"0","segStart":"0.0000000","hourEnd":"23","minEnd":"59","segEnd":"45.0000000","hourMedium":"23","minMedium":"59","segMedium":"30.0000000","dateStart":"0H 0M 0.0000000S","dateEnd":"23H 59M 45.0000000S"},"interval":"15.0000","intervalPrecise":"0H 0M 15S","notLoadOceanic":false,"rinexName":"BOGA0570.12O","daygnss":0,"dayofyear":57,"weekgnss":1677,"dayjulian":2455983.5,"displacementPolo":{"X":"0.020541","Y":"0.270373"},"pathEphemeris":{"0":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/2a8cc7\\/Ephemeris\\/igs16766.sp3","1":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/2a8cc7\\/Ephemeris\\/igs16770.sp3","ngs":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/2a8cc7\\/Ephemeris\\/ngs16770.sp3","2":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/2a8cc7\\/Ephemeris\\/igs16771.sp3"},"pathRinex":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/2a8cc7\\/Rinex\\/BOGA0570.12O","files":{"pathPPPConf":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/2a8cc7\\/Process\\/pppconf.txt","pathScript":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/2a8cc7\\/Process\\/script_exec_example9.sh","pathScriptProcessing":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/2a8cc7\\/Process\\/script_exec_processing.sh","copyFiles":true,"pathOut":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/2a8cc7\\/Report\\/BOGA.out","pathModel":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/2a8cc7\\/Report\\/BOGA.model"},"gif":["http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/\\/\\/\\/\\/\\/\\/files\\/2a8cc7\\/Report\\/BOGA_0.gif","http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/\\/\\/\\/\\/\\/\\/files\\/2a8cc7\\/Report\\/BOGA_1.gif","http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/\\/\\/\\/\\/\\/\\/files\\/2a8cc7\\/Report\\/BOGA_2.gif"]}	TERMINADO	t	2017-04-10 12:47:10.500092
831d95	d014f2138c48b7588bb7471df342e2af	{"strucFolder":{"prefijo":"831d95","folder":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/831d95\\/","report":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/831d95\\/Report","ephemeris":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/831d95\\/Ephemeris","rinex":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/831d95\\/Rinex","process":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/831d95\\/Process"},"isLoads":true,"station":["boga,","vivi,","cali,","mede,"],"loadsOceanicName":"oceanloading.dat","pathOceanicLoads":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/831d95\\/Process\\/oceanloading.dat","isRinex":true,"antenna":"LEIAT504GG NONE","date":{"year":"2012","month":"2","monthText":"Febrero","monthInit":"Feb","day":"26","dayText":"Domingo"},"position":{"latitude":4.6387947508714,"longitude":-74.079958044817,"height":2611.895158452,"X":"1744516.5488","Y":"-6116052.3337","Z":"512585.3866"},"markerName":"BOGA","heightAntenna":{"H":"1.3720","E":"0.0000","N":"0.0000"},"datePrecise":{"year":"12","month":"2","monthText":" ","monthInit":"Feb","day":"26","hourStart":"0","minStart":"0","segStart":"0.0000000","hourEnd":"23","minEnd":"59","segEnd":"45.0000000","hourMedium":"23","minMedium":"59","segMedium":"30.0000000","dateStart":"0H 0M 0.0000000S","dateEnd":"23H 59M 45.0000000S"},"interval":"15.0000","intervalPrecise":"0H 0M 15S","notLoadOceanic":false,"rinexName":"BOGA0570.12O","daygnss":0,"dayofyear":57,"weekgnss":1677,"dayjulian":2455983.5,"displacementPolo":{"X":"0.020541","Y":"0.270373"},"pathEphemeris":{"0":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/831d95\\/Ephemeris\\/igs16766.sp3","1":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/831d95\\/Ephemeris\\/igs16770.sp3","ngs":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/831d95\\/Ephemeris\\/ngs16770.sp3","2":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/831d95\\/Ephemeris\\/igs16771.sp3"},"pathRinex":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/831d95\\/Rinex\\/BOGA0570.12O","files":{"pathPPPConf":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/831d95\\/Process\\/pppconf.txt","pathScript":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/831d95\\/Process\\/script_exec_example9.sh","pathScriptProcessing":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/831d95\\/Process\\/script_exec_processing.sh","copyFiles":true,"pathOut":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/831d95\\/Report\\/BOGA.out","pathModel":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/831d95\\/Report\\/BOGA.model"},"gif":["http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/files\\/831d95\\/Report\\/BOGA_0.gif","http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/files\\/831d95\\/Report\\/BOGA_1.gif","http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/files\\/831d95\\/Report\\/BOGA_2.gif"]}	TERMINADO	t	2017-04-10 13:11:37.632184
ef2295	d014f2138c48b7588bb7471df342e2af	{"strucFolder":{"prefijo":"ef2295","folder":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ef2295\\/","report":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ef2295\\/Report","ephemeris":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ef2295\\/Ephemeris","rinex":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ef2295\\/Rinex","process":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ef2295\\/Process"},"isLoads":true,"station":["boga,","vivi,","cali,","mede,"],"loadsOceanicName":"oceanloading.dat","pathOceanicLoads":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ef2295\\/Process\\/oceanloading.dat","isRinex":true,"antenna":"LEIAT504GG NONE","date":{"year":"2012","month":"2","monthText":"Febrero","monthInit":"Feb","day":"26","dayText":"Domingo"},"position":{"latitude":4.6387947508714,"longitude":-74.079958044817,"height":2611.895158452,"X":"1744516.5488","Y":"-6116052.3337","Z":"512585.3866"},"markerName":"BOGA","heightAntenna":{"H":"1.3720","E":"0.0000","N":"0.0000"},"datePrecise":{"year":"12","month":"2","monthText":" ","monthInit":"Feb","day":"26","hourStart":"0","minStart":"0","segStart":"0.0000000","hourEnd":"23","minEnd":"59","segEnd":"45.0000000","hourMedium":"23","minMedium":"59","segMedium":"30.0000000","dateStart":"0H 0M 0.0000000S","dateEnd":"23H 59M 45.0000000S"},"interval":"15.0000","intervalPrecise":"0H 0M 15S","notLoadOceanic":false,"rinexName":"BOGA0570.12O","daygnss":0,"dayofyear":57,"weekgnss":1677,"dayjulian":2455983.5,"displacementPolo":{"X":"0.020541","Y":"0.270373"},"pathEphemeris":{"0":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ef2295\\/Ephemeris\\/igs16766.sp3","1":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ef2295\\/Ephemeris\\/igs16770.sp3","ngs":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ef2295\\/Ephemeris\\/ngs16770.sp3","2":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ef2295\\/Ephemeris\\/igs16771.sp3"},"pathRinex":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ef2295\\/Rinex\\/BOGA0570.12O","files":{"pathPPPConf":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ef2295\\/Process\\/pppconf.txt","pathScript":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ef2295\\/Process\\/script_exec_example9.sh","pathScriptProcessing":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ef2295\\/Process\\/script_exec_processing.sh","copyFiles":true,"pathOut":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ef2295\\/Report\\/BOGA.out","pathModel":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ef2295\\/Report\\/BOGA.model"},"gif":["http:\\/\\/192.168.122.124:80\\/tesisPPP\\/files\\/ef2295\\/Report\\/BOGA_0.gif","http:\\/\\/192.168.122.124:80\\/tesisPPP\\/files\\/ef2295\\/Report\\/BOGA_1.gif","http:\\/\\/192.168.122.124:80\\/tesisPPP\\/files\\/ef2295\\/Report\\/BOGA_2.gif"]}	TERMINADO	t	2017-04-10 12:31:43.502214
ee2b0a	d014f2138c48b7588bb7471df342e2af	{"strucFolder":{"prefijo":"ee2b0a","folder":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ee2b0a\\/","report":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ee2b0a\\/Report","ephemeris":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ee2b0a\\/Ephemeris","rinex":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ee2b0a\\/Rinex","process":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ee2b0a\\/Process"},"isLoads":true,"station":["boga,","vivi,","cali,","mede,"],"loadsOceanicName":"oceanloading.dat","pathOceanicLoads":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ee2b0a\\/Process\\/oceanloading.dat","isRinex":true,"antenna":"LEIAT504GG NONE","date":{"year":"2012","month":"2","monthText":"Febrero","monthInit":"Feb","day":"26","dayText":"Domingo"},"position":{"latitude":4.6387947508714,"longitude":-74.079958044817,"height":2611.895158452,"X":"1744516.5488","Y":"-6116052.3337","Z":"512585.3866"},"markerName":"BOGA","heightAntenna":{"H":"1.3720","E":"0.0000","N":"0.0000"},"datePrecise":{"year":"12","month":"2","monthText":" ","monthInit":"Feb","day":"26","hourStart":"0","minStart":"0","segStart":"0.0000000","hourEnd":"23","minEnd":"59","segEnd":"45.0000000","hourMedium":"23","minMedium":"59","segMedium":"30.0000000","dateStart":"0H 0M 0.0000000S","dateEnd":"23H 59M 45.0000000S"},"interval":"15.0000","intervalPrecise":"0H 0M 15S","notLoadOceanic":false,"rinexName":"BOGA0570.12O","daygnss":0,"dayofyear":57,"weekgnss":1677,"dayjulian":2455983.5,"displacementPolo":{"X":"0.020541","Y":"0.270373"},"pathEphemeris":{"0":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ee2b0a\\/Ephemeris\\/igs16766.sp3","1":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ee2b0a\\/Ephemeris\\/igs16770.sp3","ngs":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ee2b0a\\/Ephemeris\\/ngs16770.sp3","2":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ee2b0a\\/Ephemeris\\/igs16771.sp3"},"pathRinex":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ee2b0a\\/Rinex\\/BOGA0570.12O","files":{"pathPPPConf":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ee2b0a\\/Process\\/pppconf.txt","pathScript":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ee2b0a\\/Process\\/script_exec_example9.sh","pathScriptProcessing":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ee2b0a\\/Process\\/script_exec_processing.sh","copyFiles":true,"pathOut":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ee2b0a\\/Report\\/BOGA.out","pathModel":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/ee2b0a\\/Report\\/BOGA.model"},"gif":["http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/\\/\\/\\/\\/\\/files\\/ee2b0a\\/Report\\/BOGA_0.gif","http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/\\/\\/\\/\\/\\/files\\/ee2b0a\\/Report\\/BOGA_1.gif","http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/\\/\\/\\/\\/\\/files\\/ee2b0a\\/Report\\/BOGA_2.gif"]}	TERMINADO	t	2017-04-10 12:41:06.17339
030b57	d014f2138c48b7588bb7471df342e2af	{"strucFolder":{"prefijo":"030b57","folder":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/030b57\\/","report":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/030b57\\/Report","ephemeris":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/030b57\\/Ephemeris","rinex":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/030b57\\/Rinex","process":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/030b57\\/Process"},"isLoads":true,"station":["boga,","vivi,","cali,","mede,"],"loadsOceanicName":"oceanloading.dat","pathOceanicLoads":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/030b57\\/Process\\/oceanloading.dat","isRinex":true,"antenna":"LEIAT504GG NONE","date":{"year":"2012","month":"2","monthText":"Febrero","monthInit":"Feb","day":"26","dayText":"Domingo"},"position":{"latitude":4.6387947508714,"longitude":-74.079958044817,"height":2611.895158452,"X":"1744516.5488","Y":"-6116052.3337","Z":"512585.3866"},"markerName":"BOGA","heightAntenna":{"H":"1.3720","E":"0.0000","N":"0.0000"},"datePrecise":{"year":"12","month":"2","monthText":" ","monthInit":"Feb","day":"26","hourStart":"0","minStart":"0","segStart":"0.0000000","hourEnd":"23","minEnd":"59","segEnd":"45.0000000","hourMedium":"23","minMedium":"59","segMedium":"30.0000000","dateStart":"0H 0M 0.0000000S","dateEnd":"23H 59M 45.0000000S"},"interval":"15.0000","intervalPrecise":"0H 0M 15S","notLoadOceanic":false,"rinexName":"BOGA0570.12O","daygnss":0,"dayofyear":57,"weekgnss":1677,"dayjulian":2455983.5,"displacementPolo":{"X":"0.020541","Y":"0.270373"},"pathEphemeris":{"0":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/030b57\\/Ephemeris\\/igs16766.sp3","1":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/030b57\\/Ephemeris\\/igs16770.sp3","ngs":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/030b57\\/Ephemeris\\/ngs16770.sp3","2":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/030b57\\/Ephemeris\\/igs16771.sp3"},"pathRinex":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/030b57\\/Rinex\\/BOGA0570.12O","files":{"pathPPPConf":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/030b57\\/Process\\/pppconf.txt","pathScript":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/030b57\\/Process\\/script_exec_example9.sh","pathScriptProcessing":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/030b57\\/Process\\/script_exec_processing.sh","copyFiles":true,"pathOut":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/030b57\\/Report\\/BOGA.out","pathModel":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/030b57\\/Report\\/BOGA.model"},"gif":["http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/files\\/030b57\\/Report\\/BOGA_0.gif","http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/files\\/030b57\\/Report\\/BOGA_1.gif","http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/files\\/030b57\\/Report\\/BOGA_2.gif"]}	TERMINADO	t	2017-04-10 13:00:09.720146
d6dba4	d014f2138c48b7588bb7471df342e2af	{"strucFolder":{"prefijo":"d6dba4","folder":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/d6dba4\\/","report":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/d6dba4\\/Report","ephemeris":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/d6dba4\\/Ephemeris","rinex":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/d6dba4\\/Rinex","process":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/d6dba4\\/Process"},"isLoads":true,"station":["boga,","vivi,","cali,","mede,"],"loadsOceanicName":"oceanloading.dat","pathOceanicLoads":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/d6dba4\\/Process\\/oceanloading.dat","isRinex":true,"antenna":"LEIAT504GG NONE","date":{"year":"2012","month":"2","monthText":"Febrero","monthInit":"Feb","day":"26","dayText":"Domingo"},"position":{"latitude":4.6387947508714,"longitude":-74.079958044817,"height":2611.895158452,"X":"1744516.5488","Y":"-6116052.3337","Z":"512585.3866"},"markerName":"BOGA","heightAntenna":{"H":"1.3720","E":"0.0000","N":"0.0000"},"datePrecise":{"year":"12","month":"2","monthText":" ","monthInit":"Feb","day":"26","hourStart":"0","minStart":"0","segStart":"0.0000000","hourEnd":"23","minEnd":"59","segEnd":"45.0000000","hourMedium":"23","minMedium":"59","segMedium":"30.0000000","dateStart":"0H 0M 0.0000000S","dateEnd":"23H 59M 45.0000000S"},"interval":"15.0000","intervalPrecise":"0H 0M 15S","notLoadOceanic":false,"rinexName":"BOGA0570.12O","daygnss":0,"dayofyear":57,"weekgnss":1677,"dayjulian":2455983.5,"displacementPolo":{"X":"0.020541","Y":"0.270373"},"pathEphemeris":{"0":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/d6dba4\\/Ephemeris\\/igs16766.sp3","1":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/d6dba4\\/Ephemeris\\/igs16770.sp3","ngs":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/d6dba4\\/Ephemeris\\/ngs16770.sp3","2":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/d6dba4\\/Ephemeris\\/igs16771.sp3"},"pathRinex":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/d6dba4\\/Rinex\\/BOGA0570.12O","files":{"pathPPPConf":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/d6dba4\\/Process\\/pppconf.txt","pathScript":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/d6dba4\\/Process\\/script_exec_example9.sh","pathScriptProcessing":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/d6dba4\\/Process\\/script_exec_processing.sh","copyFiles":true,"pathOut":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/d6dba4\\/Report\\/BOGA.out","pathModel":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/d6dba4\\/Report\\/BOGA.model"},"gif":["http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/files\\/d6dba4\\/Report\\/BOGA_0.gif","http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/files\\/d6dba4\\/Report\\/BOGA_1.gif","http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/files\\/d6dba4\\/Report\\/BOGA_2.gif"]}	TERMINADO	t	2017-04-10 13:04:36.306712
4c48cf	d014f2138c48b7588bb7471df342e2af	{"strucFolder":{"prefijo":"4c48cf","folder":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/4c48cf\\/","report":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/4c48cf\\/Report","ephemeris":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/4c48cf\\/Ephemeris","rinex":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/4c48cf\\/Rinex","process":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/4c48cf\\/Process"},"isLoads":true,"station":["boga,","vivi,","cali,","mede,"],"loadsOceanicName":"oceanloading.dat","pathOceanicLoads":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/4c48cf\\/Process\\/oceanloading.dat","isRinex":true,"antenna":"LEIAT504GG NONE","date":{"year":"2012","month":"2","monthText":"Febrero","monthInit":"Feb","day":"26","dayText":"Domingo"},"position":{"latitude":4.6387947508714,"longitude":-74.079958044817,"height":2611.895158452,"X":"1744516.5488","Y":"-6116052.3337","Z":"512585.3866"},"markerName":"BOGA","heightAntenna":{"H":"1.3720","E":"0.0000","N":"0.0000"},"datePrecise":{"year":"12","month":"2","monthText":" ","monthInit":"Feb","day":"26","hourStart":"0","minStart":"0","segStart":"0.0000000","hourEnd":"23","minEnd":"59","segEnd":"45.0000000","hourMedium":"23","minMedium":"59","segMedium":"30.0000000","dateStart":"0H 0M 0.0000000S","dateEnd":"23H 59M 45.0000000S"},"interval":"15.0000","intervalPrecise":"0H 0M 15S","notLoadOceanic":false,"rinexName":"BOGA0570.12O","daygnss":0,"dayofyear":57,"weekgnss":1677,"dayjulian":2455983.5,"displacementPolo":{"X":"0.020541","Y":"0.270373"},"pathEphemeris":{"0":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/4c48cf\\/Ephemeris\\/igs16766.sp3","1":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/4c48cf\\/Ephemeris\\/igs16770.sp3","ngs":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/4c48cf\\/Ephemeris\\/ngs16770.sp3","2":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/4c48cf\\/Ephemeris\\/igs16771.sp3"},"pathRinex":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/4c48cf\\/Rinex\\/BOGA0570.12O","files":{"pathPPPConf":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/4c48cf\\/Process\\/pppconf.txt","pathScript":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/4c48cf\\/Process\\/script_exec_example9.sh","pathScriptProcessing":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/4c48cf\\/Process\\/script_exec_processing.sh","copyFiles":true,"pathOut":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/4c48cf\\/Report\\/BOGA.out","pathModel":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/4c48cf\\/Report\\/BOGA.model"},"gif":["http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/files\\/4c48cf\\/Report\\/BOGA_0.gif","http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/files\\/4c48cf\\/Report\\/BOGA_1.gif","http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/files\\/4c48cf\\/Report\\/BOGA_2.gif"]}	TERMINADO	t	2017-04-10 13:03:14.167682
1c5221	d014f2138c48b7588bb7471df342e2af	{"strucFolder":{"prefijo":"1c5221","folder":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/1c5221\\/","report":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/1c5221\\/Report","ephemeris":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/1c5221\\/Ephemeris","rinex":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/1c5221\\/Rinex","process":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/1c5221\\/Process"},"isLoads":true,"station":["boga,","vivi,","cali,","mede,"],"loadsOceanicName":"oceanloading.dat","pathOceanicLoads":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/1c5221\\/Process\\/oceanloading.dat","isRinex":true,"antenna":"LEIAT504GG NONE","date":{"year":"2012","month":"2","monthText":"Febrero","monthInit":"Feb","day":"26","dayText":"Domingo"},"position":{"latitude":4.6387947508714,"longitude":-74.079958044817,"height":2611.895158452,"X":"1744516.5488","Y":"-6116052.3337","Z":"512585.3866"},"markerName":"BOGA","heightAntenna":{"H":"1.3720","E":"0.0000","N":"0.0000"},"datePrecise":{"year":"12","month":"2","monthText":" ","monthInit":"Feb","day":"26","hourStart":"0","minStart":"0","segStart":"0.0000000","hourEnd":"23","minEnd":"59","segEnd":"45.0000000","hourMedium":"23","minMedium":"59","segMedium":"30.0000000","dateStart":"0H 0M 0.0000000S","dateEnd":"23H 59M 45.0000000S"},"interval":"15.0000","intervalPrecise":"0H 0M 15S","notLoadOceanic":false,"rinexName":"BOGA0570.12O","daygnss":0,"dayofyear":57,"weekgnss":1677,"dayjulian":2455983.5,"displacementPolo":{"X":"0.020541","Y":"0.270373"},"pathEphemeris":{"0":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/1c5221\\/Ephemeris\\/igs16766.sp3","1":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/1c5221\\/Ephemeris\\/igs16770.sp3","ngs":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/1c5221\\/Ephemeris\\/ngs16770.sp3","2":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/1c5221\\/Ephemeris\\/igs16771.sp3"},"pathRinex":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/1c5221\\/Rinex\\/BOGA0570.12O","files":{"pathPPPConf":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/1c5221\\/Process\\/pppconf.txt","pathScript":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/1c5221\\/Process\\/script_exec_example9.sh","pathScriptProcessing":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/1c5221\\/Process\\/script_exec_processing.sh","copyFiles":true,"pathOut":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/1c5221\\/Report\\/BOGA.out","pathModel":"\\/var\\/www\\/html\\/tesisPPP\\/files\\/1c5221\\/Report\\/BOGA.model"},"gif":["http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/files\\/1c5221\\/Report\\/BOGA_0.gif","http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/files\\/1c5221\\/Report\\/BOGA_1.gif","http:\\/\\/192.168.122.124:80\\/tesisPPP\\/\\/files\\/1c5221\\/Report\\/BOGA_2.gif"]}	TERMINADO	t	2017-04-12 16:12:31.912274
\.


--
-- Data for Name: session; Type: TABLE DATA; Schema: public; Owner: gpud
--

COPY session (session_id, user_id, origin, type, expiration) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: gpud
--

COPY users (id, name, lastname, email, password, occupation, status, token) FROM stdin;
d014f2138c48b7588bb7471df342e2af	Emmanuel	Taborda Carmona	tabordaemmanuel@gmail.com	6691484ea6b50ddde1926a220da01fa9e575c18a	0	t	58021d
\.


--
-- Name: processing_pkey; Type: CONSTRAINT; Schema: public; Owner: gpud
--

ALTER TABLE ONLY processing
    ADD CONSTRAINT processing_pkey PRIMARY KEY (id, id_user);


--
-- Name: session_pkey; Type: CONSTRAINT; Schema: public; Owner: gpud
--

ALTER TABLE ONLY session
    ADD CONSTRAINT session_pkey PRIMARY KEY (session_id);


--
-- Name: users_email_key; Type: CONSTRAINT; Schema: public; Owner: gpud
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_email_key UNIQUE (email);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: gpud
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: processing_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: gpud
--

ALTER TABLE ONLY processing
    ADD CONSTRAINT processing_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

