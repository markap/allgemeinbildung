-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 29. Juli 2010 um 21:34
-- Server Version: 5.1.37
-- PHP-Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `allgemeinbildung`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gameList`
--

CREATE TABLE IF NOT EXISTS `gameList` (
  `gameid` int(11) NOT NULL AUTO_INCREMENT,
  `questionids` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `qtype` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`gameid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Daten für Tabelle `gameList`
--

INSERT INTO `gameList` (`gameid`, `questionids`, `name`, `qtype`) VALUES
(2, '56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71', 'Die Wappen der 16 deutschen Bundesländer', 'mc'),
(1, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16', 'Die deutschen Bundesländer', 'mc'),
(3, '72,74,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,111,113,112,115,114,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132', 'Europas Hauptstädte', 'mc'),
(4, '17,18,19,20,188,189,190,191,192,193,194,195,196,197,198', 'Auf welchem europäischen Land steht das Fähnchen?', 'mc'),
(5, '21,22,23,24,25,26,27,28,29,31,32,33,34,35,36,37,38,39', 'Deutsche Kfz-Kennzeichen mit A', 'mc'),
(7, '40,41,42,43,44,45,46,47', 'Die deutschen Bundeskanzler', 'mc'),
(14, '199,200,201,202,203,204,205,206,207,208', 'Deutsche Kfz-Kennzeichen mit C', 'mc'),
(8, '48,49,50,51,52,53,54,55', 'Amtszeit der deutschen Bundeskanzler', 'mc'),
(9, '93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110', 'Wer wurde wann Fußball Weltmeister?', 'mc'),
(10, '133,134,135,136,137,138,139,140,141,142,143,144,145', 'Wer wurde wann Fußball Europameister?', 'mc'),
(11, '146,147,148,149,150,151,152,153,154', 'Die deutschen Bundespräsidenten', 'mc'),
(12, '155,156,157,158,159,160,161,162,163', 'Amtszeit der deutschen Bundespräsidenten', 'mc'),
(13, '164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187', 'Deutsche Kfz-Kennzeichen mit B', 'mc'),
(15, '209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227', 'Deutsche Kfz-Kennzeichen mit D', 'mc');

