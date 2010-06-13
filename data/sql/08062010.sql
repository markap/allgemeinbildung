-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 08. Juni 2010 um 21:03
-- Server Version: 5.1.37
-- PHP-Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `allgemeinbildung`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `answerid` int(10) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `fake1` varchar(255) NOT NULL,
  `fake2` varchar(255) NOT NULL,
  `fake3` varchar(255) NOT NULL,
  `image` int(10) NOT NULL,
  `text` mediumtext NOT NULL,
  PRIMARY KEY (`answerid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `answer`
--

INSERT INTO `answer` (`answerid`, `answer`, `fake1`, `fake2`, `fake3`, `image`, `text`) VALUES
(1, 'Bayern', 'Thüringen', 'Baden-Württemberg', 'Sachsen', 0, ''),
(2, 'Baden-Württemberg', 'Bayern', 'Hessen', 'Rheinland-Pfalz', 0, ''),
(3, 'Sachsen', 'Sachsen-Anhalt', 'Hessen', 'Mecklenburg-Vorpommern', 0, ''),
(4, 'Thüringen', 'Sachsen', 'Rheinland-Pfalz', 'Brandenburg', 0, ''),
(5, 'Hessen', 'Rheinland-Pfalz', 'Baden-Württemberg', 'Nordrhein-Westfalen', 0, ''),
(6, 'Rheinland-Pfalz', 'Saarland', 'Hessen', 'Niedersachsen', 0, ''),
(7, 'Saarland', 'Hessen', 'Nordrhein-Westfalen', 'Rheinland-Pfalz', 0, ''),
(8, 'Nordrhein-Westfalen', 'Niedersachsen', 'Bremen', 'Hessen', 0, ''),
(9, 'Niedersachsen', 'Schleswig-Holstein', 'Sachsen-Anhalt', 'Sachsen', 0, ''),
(10, 'Sachsen-Anhalt', 'Sachsen', 'Hamburg', 'Hessen', 0, ''),
(11, 'Brandenburg', 'Mecklenburg-Vorpommern', 'Sachsen', 'Rheinland-Pfalz', 0, ''),
(12, 'Berlin', 'Hamburg', 'Brandenburg', 'Sachsen-Anhalt', 0, ''),
(13, 'Bremen', 'Hamburg', 'Thüringen', 'Sachsen-Anhalt', 0, ''),
(14, 'Hamburg', 'Berlin', 'Bremen', 'Schleswig-Holstein', 0, ''),
(15, 'Schleswig-Holstein', 'Mecklenburg-Vorpommern', 'Niedersachsen', 'Hamburg', 0, ''),
(16, 'Mecklenburg-Vorpommern', 'Schleswig-Holstein', 'Thüringen', 'Baden-Württemberg', 0, ''),
(17, 'Frankreich', 'Deutschland', 'Niederlande', 'Spanien', 0, ''),
(18, 'Spanien', 'Portugal', 'Frankreich', 'Belgien', 0, ''),
(19, 'Portugal', 'Andorra', 'Spanien', 'Niederlande', 0, ''),
(20, 'Island', 'Irland', 'Kachastan', 'Frankreich', 0, ''),
(21, 'Augsburg', 'Aalen Ostalbkreis', 'Aachen', 'Ansbach', 0, ''),
(22, 'Aalen Ostalbkreis', 'Aachen', 'Aach', 'Aasbüttel', 0, ''),
(23, 'Aschaffenburg', 'Amberg', 'Altenburg', 'Ansbach', 0, ''),
(24, 'Altenburg', 'Aschaffenburg', 'Altenbamberg', 'Arnsberg', 0, ''),
(25, 'Anhalt-Bitterfeld', 'Albig', 'Alsdorf (Bitburg-Prüm)', 'Altheim (Biberach/Riß)', 0, ''),
(26, 'Aachen', 'Aurach', 'Andechs', 'Aschaffenburg', 0, ''),
(27, 'Aichau-Friedberg', 'Aurich', 'Aichen', 'Altrich', 0, ''),
(28, 'Altenkirchen/Westerwald', 'Altenbrak', 'Alterkülz', 'Altkirchen', 0, ''),
(29, 'Amberg', 'Amerang', 'Amesdorf', 'Ampfing', 0, ''),
(30, 'Annaberg', 'Annarode', 'Adenau', 'Altenau', 0, ''),
(31, 'Altötting', 'Ahrensböck', 'Alt Mölln', 'Anröchte', 0, ''),
(32, 'Weimarer Land', 'Apolda', 'Rottal-Inn', 'Apen', 0, ''),
(33, 'Amberg-Sulzbach', 'Ansbach', 'Asbach', 'Aschheim', 0, ''),
(34, 'Ansbach', 'Andechs', 'Anderbeck', 'Anderlingen', 0, ''),
(36, 'Aue-Schwarzenberg', 'Albersdorf (Saale-Holzland-Kreis)', 'Zwickau', 'Alsenz', 0, ''),
(37, 'Aurich', 'Aura an der Saale', 'Aurach', 'Carlsberg', 0, ''),
(38, 'Ahrweiler', 'Alt Bukow', 'Alt Schwerin', 'Altenstadt an der Waldnaab', 0, ''),
(39, 'Alzey-Worms', 'Alsenz', 'Aue-Schwarzenberg', 'Alt Krenzlin', 0, ''),
(35, 'Aschersleben-Straßfurter Landkreis', 'Alleringersleben', 'Anderlingen', 'Alsleben (Saale)', 0, ''),
(40, 'Konrad Adenauer', 'Theodor Heuss', 'Ludwig Erhard', 'Kurt Georg Kiesinger', 0, ''),
(41, 'Kurt Georg Kiesinger', 'Willy Brandt', 'Konrad Adenauer', 'Ludwig Erhard', 0, ''),
(42, 'Ludwig Erhard', 'Konrad Adenauer', 'Willy Brandt', 'Kurt Georg Kiesinger', 0, ''),
(43, 'Willy Brandt', 'Helmut Kohl', 'Ludwig Erhard', 'Helmut Schmidt', 0, ''),
(44, 'Helmut Schmidt', 'Helmut Kohl', 'Kurt Georg Kiesinger', 'Willy Brandt', 0, ''),
(45, 'Helmut Kohl', 'Helmut Schmidt', 'Gerhard Schröder', 'Angela Merkel', 0, ''),
(46, 'Gerhard Schröder', 'Helmut Kohl', 'Angela Merkel', 'Willy Brandt', 0, ''),
(47, 'Angela Merkel', 'Helmut Kohl', 'Gerhard Schröder', 'Ludwig Erhard', 0, ''),
(48, '1949 bis 1963', '1945 bis 1960', '1945 bis 1963', '1949 bis 1959', 0, ''),
(49, '1963 bis 1966', '1959 bis 1970', '1963 bis 1967', '1959 bis 1967', 0, ''),
(50, '1966 bis 1969', '1963 bis 1966', '1959 bis 1970', '1963 bis 1964', 0, ''),
(51, '1969 bis 1974', '1966 bis 1974', '1974 bis 1978', '1971 bis 1974', 0, ''),
(52, '1974 bis 1982', '1976 bis 1984', '1982 bis 1987', '1972 bis 1980', 0, ''),
(53, '1982 bis 1998', '1980 bis 1996', '1982 bis 1988', '1990 bis 2000', 0, ''),
(54, '1998 bis 2005', '2000 bis 2004', '1998 bis 2000', '1996 bis 2005', 0, ''),
(55, '2005', '2002', '2007', '2004', 0, ''),
(56, 'Bayern', 'Baden-Württemberg', 'Hessen', 'Thüringen', 0, 'Bayerns Staatswappen ist weithin bekannt und beliebt. Es wurde am 5. Juni 1950 mit dem "Gesetz über das Wappen des Freistaates Bayern" eingeführt. Die im Wappen dargestellten Symbole sind tief in der Geschichte Bayerns verwurzelt. Die heraldischen Elemente des "Großen Bayerischen Staatswappens" bedeuten:\r\n\r\nDer goldene Löwe\r\nUrsprünglich war der goldene Löwe im schwarzen Feld des Wappens das Symbol der Pfalzgrafen bei Rhein. Nach der Belehnung des bayerischen Herzogs Ludwig im Jahre 1214 mit der Pfalzgrafschaft diente es jahrhundertelang als gemeinsames Kennzeichen der altbayerischen und pfälzischen Wittelsbacher. Heute erinnert der aufgerichtete, goldene und rotbewehrte Pfälzer Löwe an den Regierungsbezirk Oberpfalz.\r\n\r\nDer "Fränkische Rechen"\r\nDas zweite Feld ist von Rot und Weiß (Silber) mit drei aus dem Weiß aufsteigenden Spitzen geteilt. Dieser "Rechen" erschien um 1350 als Wappen einiger Orte des Hochstifts Würzburg und seit 1410 auch in den Siegeln der Fürstbischöfe. Heute steht der Fränkische Rechen für die Regierungsbezirke Oberfranken, Mittelfranken und Unterfranken.\r\n\r\nDer blaue Panter\r\nLinks unten im dritten Feld zeigt sich ein blauer, goldbewehrter, aufgerichteter Panter auf weißem (silbernem) Grund. Ursprünglich wurde er im Wappen der in Niederbayern ansässigen Pfalzgrafen von Ortenburg geführt (12. Jahrhundert). Später übernahmen ihn die Wittelsbacher. Heute vertritt der blaue Panter die altbayerischen Regierungsbezirke Niederbayern und Oberbayern.\r\n\r\nDie drei schwarzen Löwen\r\nIm vierten Feld sind auf Gold drei schwarze, übereinander angeordnete, herschauende und rotbewehrte Löwen dargestellt. Sie sind dem alten Wappen der Hohenstaufen (erstmals 1216), der einstigen Herzöge von Schwaben, entnommen. Im Staatswappen repräsentieren diese drei Löwen den Regierungsbezirk Schwaben.\r\n\r\nDer weiß-blaue Herzschild\r\nDer Herzschild ist in Weiß (Silber) und Blau schräg gerautet. Nachdem er früher (seit 1204) den Grafen von Bogen als Wappen gedient hatte, wurde dieser Herzschild 1247 von den Wittelsbachern als Stammwappen übernommen. Die weiß-blauen Rauten sind das bayerische Wahrzeichen schlechthin. Der Rautenschild symbolisiert heute Bayern als Ganzes. Mit der Volkskrone wird er auch offiziell als "Kleines Staatswappen" verwendet.\r\n\r\nDie Volkskrone\r\nAuf dem gevierten Schild mit dem Herzschild in der Mitte ruht eine Krone. Sie besteht aus einem mit Steinen geschmückten goldenen Reifen, der mit fünf ornamentalen Blättern besetzt ist. Die Volkskrone, die sich erstmals im Wappen von 1923 findet, bezeichnet nach dem Wegfall der Königskrone die Volkssouveränität.\r\n\r\nDie schildhaltenden Löwen\r\nDie beiden schildhaltenden Löwen setzen eine Tradition aus dem 14. Jahrhundert fort.'),
(57, 'Baden-Württemberg', 'Brandenburg', 'Bayern', 'Saarland', 0, ''),
(58, 'Hessen', 'Rheinland-Pfalz', 'Mecklenburg-Vorpommern', 'Sachsen-Anhalt', 0, ''),
(59, 'Mecklenburg-Vorpommern', 'Saarland', 'Nordrhein-Westfalen', 'Schleswig-Holstein', 0, ''),
(60, 'Rheinland Pfalz', 'Niedersachsen', 'Saarland', 'Schleswig-Holstein', 0, ''),
(61, 'Saarland', 'Baden-Württemberg', 'Bremen', 'Sachsen', 0, ''),
(62, 'Schleswig-Holstein', 'Hamburg', 'Hessen', 'Sachsen-Anhalt', 0, ''),
(63, 'Sachsen', 'Sachsen-Anhalt', 'Hamburg', 'Mecklenburg-Vorpommern', 0, ''),
(64, 'Sachsen Anhalt', 'Baden-Württemberg', 'Sachsen', 'Thüringen', 0, ''),
(65, 'Niedersachsen', 'Sachsen-Anhalt', 'Schleswig-Holstein', 'Bayern', 0, ''),
(66, 'Hamburg', 'Bremen', 'Nordrhein-Westfalen', 'Thüringen', 0, ''),
(67, 'Nordrhein Westfalen', 'Sachsen', 'Hessen', 'Thüringen', 0, ''),
(68, 'Berlin', 'Brandenburg', 'Bayern', 'Saarland', 0, ''),
(69, 'Brandenburg', 'Hessen', 'Niedersachsen', 'Sachsen-Anhalt', 0, ''),
(70, 'Thüringen', 'Sachsen', 'Mecklenburg-Vorpommern', 'Berlin', 0, ''),
(71, 'Bremen', 'Hamburg', 'Hessen', 'Thüringen', 0, ''),
(72, 'Madrid', 'Mallorca', 'Barcelona', 'Valencia', 0, ''),
(73, 'Ankara', 'Istanbul', 'Bukarest', 'Izmit', 0, ''),
(74, 'Ankara', 'Istanbul', 'Bukarest', 'Izmit', 0, ''),
(75, 'Ankara', 'Istanbul', 'Bukarest', 'Izmit', 0, ''),
(76, 'Amsterdam', 'Den Haag', 'Rotterdam', 'Eindhoven', 0, ''),
(77, 'Athen', 'Piräus', 'Thessaloniki', 'Kreta', 0, ''),
(78, 'Belgrad', 'Subotica', 'Novi Sad', 'Niš', 0, ''),
(79, 'Berlin', 'München', 'Hamburg', 'Frankfurt', 0, ''),
(80, 'Bern', 'Zürich', 'Luzern', 'Basel', 0, ''),
(81, 'Bratislava', 'Košice', 'Prešov ', 'Trnava', 0, ''),
(82, 'Brüssel', 'Gent', 'Brügge', 'Lüttich', 0, ''),
(83, 'Budapest', 'Debrecen ', 'Miskolc', 'Pécs', 0, ''),
(84, 'Bukarest', 'Klausenburg', 'Konstanza', 'Jassy', 0, ''),
(85, 'Chisinau', 'Tiraspol', 'Bălţi', 'Cahul', 0, ''),
(86, 'Dublin', 'Cork', 'Limerick', 'Waterford', 0, ''),
(87, 'Helsinki', 'Vantaa', 'Tampere', 'Espoo', 0, ''),
(88, 'Kiew', 'Dnipropetrowsk', 'Donezk', 'Charkiw', 0, ''),
(89, 'Kopenhagen', 'Århus', 'Esbjerg', 'Aalborg', 0, ''),
(90, 'Ljubljana', 'Maribor', 'Kranj', 'Koper', 0, ''),
(91, 'Lissabon', 'Amadora', 'Porto', 'Braga', 0, ''),
(92, 'London', 'Liverpool', 'Belfast', 'Edinburgh', 0, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(90) NOT NULL,
  PRIMARY KEY (`categoryid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`categoryid`, `name`) VALUES
(1, 'Geographie'),
(2, 'Bundesländer'),
(3, 'Kfz-Kennzeichen'),
(4, 'Bundeskanzler'),
(5, 'Flaggen, Wappen'),
(6, 'Europa');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `gameList`
--

INSERT INTO `gameList` (`gameid`, `questionids`, `name`, `qtype`) VALUES
(2, '56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71', 'Die Wappen der 16 deutschen Bundesländer', 'mc'),
(1, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16', 'Die deutschen Bundesländer', 'mc'),
(3, '72,74,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92', 'Europas Hauptstädte', 'mc'),
(4, '17,18,19,20', 'Auf welchem europäischen Land steht das Fähnchen?', 'mc'),
(5, '21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39', 'Deutsche Kfz-Kennzeichen mit A', 'mc'),
(7, '40,41,42,43,44,45,46,47', 'Die deutschen Bundeskanzler', 'mc'),
(8, '48,49,50,51,52,53,54,55', 'Amtszeit der deutschen Bundeskanzler?', 'mc');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gameResult`
--

CREATE TABLE IF NOT EXISTS `gameResult` (
  `resultid` int(11) NOT NULL AUTO_INCREMENT,
  `gameid` int(11) NOT NULL,
  `date` date NOT NULL,
  `rightids` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `wrongids` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `userid` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`resultid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `gameResult`
--

INSERT INTO `gameResult` (`resultid`, `gameid`, `date`, `rightids`, `wrongids`, `userid`, `score`) VALUES
(1, 1, '2010-04-19', '', '1,2,3,3,3', 6, 0),
(2, 1, '2010-04-19', '1,3', '2', 6, 0),
(3, 1, '2010-04-24', '2,3', '1,3', 6, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hasCategory`
--

CREATE TABLE IF NOT EXISTS `hasCategory` (
  `questionid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  PRIMARY KEY (`questionid`,`categoryid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `hasCategory`
--

INSERT INTO `hasCategory` (`questionid`, `categoryid`) VALUES
(72, 6),
(76, 6),
(77, 6),
(78, 6),
(79, 6),
(80, 6),
(81, 6),
(82, 6),
(83, 6),
(84, 6),
(85, 6),
(86, 6),
(87, 6),
(88, 6),
(89, 6),
(90, 6),
(91, 6),
(92, 6);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `helper`
--

CREATE TABLE IF NOT EXISTS `helper` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `helper`
--

INSERT INTO `helper` (`name`, `value`) VALUES
('img', '71');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `levelid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`levelid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `level`
--

INSERT INTO `level` (`levelid`, `name`) VALUES
(1, 'Grundwissen'),
(2, 'Aufbauendes Wissen'),
(3, 'Hohe Allgemeinbildung'),
(4, 'Milchbubi'),
(5, 'Spezialwissen');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `questionid` int(10) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) DEFAULT NULL,
  `answerid` int(10) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `level` int(10) DEFAULT NULL,
  `creationdate` date NOT NULL,
  `author` int(11) NOT NULL,
  `active` varchar(1) NOT NULL,
  `hint` varchar(255) NOT NULL,
  PRIMARY KEY (`questionid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;

--
-- Daten für Tabelle `question`
--

INSERT INTO `question` (`questionid`, `question`, `answerid`, `image`, `level`, `creationdate`, `author`, `active`, `hint`) VALUES
(1, 'Auf welchen Bundesland steht das rote Fähnchen?', 1, '1.jpg', 1, '2010-03-30', 6, 'Y', ''),
(2, 'Auf welchen Bundesland steht das rote Fähnchen?', 2, '2.jpg', 1, '2010-03-30', 6, 'Y', ''),
(3, 'Auf welchen Bundesland steht das rote Fähnchen?', 3, '3.jpg', 1, '2010-03-30', 6, 'Y', ''),
(4, 'Auf welchen Bundesland steht das rote Fähnchen?', 4, '4.jpg', 1, '2010-03-30', 6, 'Y', ''),
(5, 'Auf welchen Bundesland steht das rote Fähnchen?', 5, '5.jpg', 1, '2010-03-30', 6, 'Y', ''),
(6, 'Auf welchen Bundesland steht das rote Fähnchen?', 6, '6.jpg', 1, '2010-03-30', 6, 'Y', ''),
(7, 'Auf welchen Bundesland steht das rote Fähnchen?', 7, '7.jpg', 1, '2010-03-30', 6, 'Y', ''),
(8, 'Auf welchen Bundesland steht das rote Fähnchen?', 8, '8.jpg', 1, '2010-03-30', 6, 'Y', ''),
(9, 'Auf welchen Bundesland steht das rote Fähnchen?', 9, '9.jpg', 1, '2010-03-30', 6, 'Y', ''),
(10, 'Auf welchen Bundesland steht das rote Fähnchen?', 10, '10.jpg', 1, '2010-03-30', 6, 'Y', ''),
(11, 'Auf welchen Bundesland steht das rote Fähnchen?', 11, '11.jpg', 1, '2010-03-30', 6, 'Y', ''),
(12, 'Auf welchen Bundesland steht das rote Fähnchen?', 12, '12.jpg', 1, '2010-03-30', 6, 'Y', ''),
(13, 'Auf welchen Bundesland steht das rote Fähnchen?', 13, '13.jpg', 1, '2010-03-30', 6, 'Y', ''),
(14, 'Auf welchen Bundesland steht das rote Fähnchen?', 14, '14.jpg', 1, '2010-03-30', 6, 'Y', ''),
(15, 'Auf welchen Bundesland steht das rote Fähnchen?', 15, '15.jpg', 1, '2010-03-30', 6, 'Y', ''),
(16, 'Auf welchen Bundesland steht das rote Fähnchen?', 16, '16.jpg', 1, '2010-03-30', 6, 'Y', ''),
(17, 'Auf welchen europäischen Land steht das rote Fähnchen?', 17, '17.jpg', 1, '2010-03-30', 6, 'Y', ''),
(18, 'Auf welchen europäischen Land steht das rote Fähnchen?', 18, '18.jpg', 1, '2010-03-30', 6, 'Y', ''),
(19, 'Auf welchen europäischen Land steht das rote Fähnchen?', 19, '19.jpg', 1, '2010-03-30', 6, 'Y', ''),
(20, 'Auf welchen europäischen Land steht das rote Fähnchen?', 20, '20.jpg', 1, '2010-03-30', 6, 'Y', ''),
(25, 'Wofür steht das folgende Kfz-Kennzeichen: ABI', 25, '21.jpg', 1, '2010-03-30', 6, 'Y', ''),
(24, 'Wofür steht das folgende Kfz-Kennzeichen: ABG', 24, '21.jpg', 1, '2010-03-30', 6, 'Y', ''),
(23, 'Wofür steht das folgende Kfz-Kennzeichen: AB', 23, '21.jpg', 1, '2010-03-30', 6, 'Y', ''),
(22, 'Wofür steht das folgende Kfz-Kennzeichen: AA', 22, '21.jpg', 1, '2010-03-30', 6, 'Y', ''),
(21, 'Wofür steht das folgende Kfz-Kennzeichen: A', 21, '21.jpg', 1, '2010-03-30', 6, 'Y', ''),
(26, 'Wofür steht das folgende Kfz-Kennzeichen: AC', 26, '21.jpg', 1, '2010-03-30', 6, 'Y', ''),
(27, 'Wofür steht das folgende Kfz-Kennzeichen: AIC', 27, '21.jpg', 1, '2010-03-30', 6, 'Y', ''),
(28, 'Wofür steht das folgende Kfz-Kennzeichen: AK', 28, '21.jpg', 1, '2010-03-30', 6, 'Y', ''),
(29, 'Wofür steht das folgende Kfz-Kennzeichen: AM', 29, '21.jpg', 1, '2010-03-30', 6, 'Y', ''),
(30, 'Wofür steht das folgende Kfz-Kennzeichen: ANA', 30, '21.jpg', 1, '2010-03-30', 6, 'Y', ''),
(31, 'Wofür steht das folgende Kfz-Kennzeichen: AÖ', 31, '21.jpg', 1, '2010-03-30', 6, 'Y', ''),
(32, 'Wofür steht das folgende Kfz-Kennzeichen: AP', 32, '21.jpg', 1, '2010-03-30', 6, 'Y', ''),
(33, 'Wofür steht das folgende Kfz-Kennzeichen: AS', 33, '21.jpg', 1, '2010-03-30', 6, 'Y', ''),
(34, 'Wofür steht das folgende Kfz-Kennzeichen: AN', 34, '21.jpg', 1, '2010-03-30', 6, 'Y', ''),
(35, 'Wofür steht das folgende Kfz-Kennzeichen: ASL', 35, '21.jpg', 1, '2010-03-30', 6, 'Y', ''),
(36, 'Wofür steht das folgende Kfz-Kennzeichen: ASZ', 36, '21.jpg', 1, '2010-03-30', 6, 'Y', ''),
(37, 'Wofür steht das folgende Kfz-Kennzeichen: AUR', 37, '21.jpg', 1, '2010-03-30', 6, 'Y', ''),
(38, 'Wofür steht das folgende Kfz-Kennzeichen: AW', 38, '21.jpg', 1, '2010-03-30', 6, 'Y', ''),
(39, 'Wofür steht das folgende Kfz-Kennzeichen: AZ', 39, '21.jpg', 1, '2010-03-30', 6, 'Y', ''),
(40, 'Wie heißt der erste deutsche Bundeskanzler?', 40, '22.jpg', 1, '2010-03-31', 6, 'Y', ''),
(41, 'Wie heißt der dritte deutsche Bundeskanzler?', 41, '23.jpg', 1, '2010-03-31', 6, 'Y', ''),
(42, 'Wie heißt der zweite deutsche Bundeskanzler?', 42, '25.jpg', 1, '2010-04-01', 6, 'Y', ''),
(43, 'Wer war der vierte deutsche Bundeskanzler?', 43, '26.jpg', 1, '2010-04-02', 6, 'Y', ''),
(44, 'Wer war der fünfte deutsche Bundeskanzler?', 44, '28.jpg', 1, '2010-04-02', 6, 'Y', ''),
(45, 'Wer war der sechste deutsche Bundeskanzler?', 45, '27.jpg', 1, '2010-04-02', 6, 'Y', ''),
(46, 'Wer war der siebte deutsche Bundeskanzler?', 46, '29.jpg', 1, '2010-04-02', 6, 'Y', ''),
(47, 'Wer war der achte deutsche Bundeskanzler?', 47, '30.jpg', 1, '2010-04-02', 6, 'Y', ''),
(48, 'Wie lange regierte Konrad Adenauer als Bundeskanzler?', 48, '31.jpg', 1, '2010-04-02', 6, 'Y', 'YYYY bis YYYY'),
(49, 'Wie lange regierte Ludwig Erhard als Bundeskanzler?', 49, '25.jpg', 1, '2010-04-02', 6, 'Y', 'YYYY bis YYYY'),
(50, 'Wie lange regierte Kurt Georg Kiesinger als Bundeskanzler?', 50, '23.jpg', 1, '2010-04-02', 6, 'Y', 'YYYY bis YYYY'),
(51, 'Wie lange regierte Willy Brandt als Bundeskanzler?', 51, '26.jpg', 1, '2010-04-02', 6, 'Y', 'YYYY bis YYYY'),
(52, 'Wie lange regierte Helmut Schmidt als Bundeskanzler?', 52, '28.jpg', 1, '2010-04-06', 6, 'Y', 'YYYY bis YYYY'),
(53, 'Wie lange regierte Helmut Kohl als Bundeskanzler?', 53, '27.jpg', 1, '2010-04-06', 6, 'Y', 'YYYY bis YYYY'),
(54, 'Wie lange regierte Gerhard Schröder als Bundeskanzler?', 54, '29.jpg', 1, '2010-04-06', 6, 'Y', 'YYYY bis YYYY'),
(55, 'Seit welchen Jahr regiert Angela Merkel als deutsche Bundeskanzlerin?', 55, '30.jpg', 1, '2010-04-06', 6, 'Y', ''),
(56, 'Zu welchen Bundesland gehört dieses Wappen?', 56, '32.jpg', 3, '2010-04-06', 6, 'Y', ''),
(57, 'Zu welchen Bundesland gehört dieses Wappen?', 57, '33.png', 3, '2010-04-07', 6, 'Y', ''),
(58, 'Zu welchen Bundesland gehört dieses Wappen?', 58, '35.png', 3, '2010-04-11', 6, 'Y', ''),
(59, 'Zu welchen Bundesland gehört dieses Wappen?', 59, '36.png', 3, '2010-04-11', 6, 'Y', ''),
(60, 'Zu welchen Bundesland gehört dieses Wappen?', 60, '37.jpg', 3, '2010-04-11', 6, 'Y', ''),
(61, 'Zu welchen Bundesland gehört dieses Wappen?', 61, '38.jpg', 3, '2010-04-11', 6, 'Y', ''),
(62, 'Zu welchen Bundesland gehört dieses Wappen?', 62, '39.jpg', 3, '2010-04-11', 6, 'Y', ''),
(63, 'Zu welchen Bundesland gehört dieses Wappen?', 63, '40.jpg', 3, '2010-04-11', 6, 'Y', ''),
(64, 'Zu welchen Bundesland gehört dieses Wappen?', 64, '41.png', 3, '2010-04-11', 6, 'Y', ''),
(65, 'Zu welchen Bundesland gehört dieses Wappen?', 65, '42.png', 3, '2010-04-11', 6, 'Y', ''),
(66, 'Zu welchen Bundesland gehört dieses Wappen?', 66, '43.jpg', 3, '2010-04-11', 6, 'Y', ''),
(67, 'Zu welchen Bundesland gehört dieses Wappen?', 67, '44.png', 3, '2010-04-11', 6, 'Y', ''),
(68, 'Zu welchen Bundesland gehört dieses Wappen?', 68, '45.png', 3, '2010-04-11', 6, 'Y', ''),
(69, 'Zu welchen Bundesland gehört dieses Wappen?', 69, '46.gif', 3, '2010-04-11', 6, 'Y', ''),
(70, 'Zu welchen Bundesland gehört dieses Wappen?', 70, '47.png', 3, '2010-04-11', 6, 'Y', ''),
(71, 'Zu welchen Bundesland gehört dieses Wappen?', 71, '48.gif', 3, '2010-04-11', 6, 'Y', ''),
(72, 'Wie lautet die Hauptstadt Spaniens?', 72, '50.jpg', 1, '2010-04-30', 6, 'Y', ''),
(74, 'Wie lautet die Hauptstadt der Türkei?', 74, '51.jpg', 1, '2010-06-06', 6, 'Y', ''),
(77, 'Wie lautet die Hauptstadt Griechenlandss?', 77, '54.jpg', 1, '2010-06-06', 6, 'Y', ''),
(78, 'Wie lautet die Hauptstadt Serbiens?', 78, '55.jpg', 1, '2010-06-07', 6, 'Y', ''),
(76, 'Wie lautet die Hauptstadt der Niederlande?', 76, '53.jpg', 1, '2010-06-06', 6, 'Y', ''),
(79, 'Wie lautet die Hauptstadt Deutschlands?', 79, '56.JPG', 1, '2010-06-07', 6, 'Y', ''),
(80, 'Wie lautet die Hauptstadt der Schweiz?', 80, '63.png', 1, '2010-06-07', 6, 'Y', ''),
(81, 'Wie lautet die Hauptstadt der Slowakei?', 81, '58.jpg', 1, '2010-06-07', 6, 'Y', ''),
(82, 'Wie lautet die Hauptstadt Belgiens?', 82, '59.jpg', 1, '2010-06-07', 6, 'Y', ''),
(83, 'Wie lautet die Hauptstadt Ungarns?', 83, '60.jpg', 1, '2010-06-07', 6, 'Y', ''),
(84, 'Wie lautet die Hauptstadt Rumäniens?', 84, '61.jpg', 1, '2010-06-07', 6, 'Y', ''),
(85, 'Wie lautet die Hauptstadt Moldawiens?', 85, '64.png', 1, '2010-06-08', 6, 'Y', ''),
(86, 'Wie lautet die Hauptstadt Irlands?', 86, '65.jpg', 1, '2010-06-08', 6, 'Y', ''),
(87, 'Wie lautet die Hauptstadt Finnlands?', 87, '66.jpg', 1, '2010-06-08', 6, 'Y', ''),
(88, 'Wie lautet die Hauptstadt der Ukraine?', 88, '67.jpg', 1, '2010-06-08', 6, 'Y', ''),
(89, 'Wie lautet die Hauptstadt Dänemarks?', 89, '68.jpg', 1, '2010-06-08', 6, 'Y', ''),
(90, 'Wie lautet die Hauptstadt Sloweniens?', 90, '69.jpg', 1, '2010-06-08', 6, 'Y', ''),
(91, 'Wie lautet die Hauptstadt Portugals?', 91, '70.jpg', 1, '2010-06-08', 6, 'Y', ''),
(92, 'Wie lautet die Hauptstadt Großbritanniens?', 92, '71.jpg', 1, '2010-06-08', 6, 'Y', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `questionresult`
--

CREATE TABLE IF NOT EXISTS `questionresult` (
  `userid` int(11) NOT NULL,
  `questionid` int(11) NOT NULL,
  `questiontype` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `result` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`userid`,`questionid`,`questiontype`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `questionresult`
--

INSERT INTO `questionresult` (`userid`, `questionid`, `questiontype`, `result`, `date`) VALUES
(6, 1, 'mc', 'N', '2010-04-24'),
(6, 2, 'txt', 'Y', '2010-04-05'),
(6, 3, 'mc', 'N', '2010-04-24'),
(6, 4, 'txt', 'N', '2010-04-09'),
(6, 5, 'txt', 'Y', '2010-04-05'),
(6, 6, 'mc', 'Y', '2010-04-05'),
(6, 7, 'mc', 'Y', '2010-04-05'),
(6, 4, 'mc', 'Y', '2010-04-05'),
(6, 3, 'txt', 'N', '2010-06-07'),
(6, 6, 'txt', 'Y', '2010-04-05'),
(6, 40, 'mc', 'Y', '2010-04-01'),
(7, 40, 'mc', 'Y', '2010-04-05'),
(7, 41, 'mc', 'Y', '2010-04-05'),
(7, 42, 'mc', 'Y', '2010-04-05'),
(6, 40, 'txt', 'N', '2010-04-09'),
(6, 41, 'txt', 'N', '2010-04-09'),
(6, 42, 'mc', 'N', '2010-04-05'),
(6, 41, 'mc', 'N', '2010-04-09'),
(6, 48, 'mc', 'N', '2010-06-07'),
(6, 42, 'txt', 'N', '2010-04-09'),
(6, 43, 'txt', 'N', '2010-04-09'),
(6, 44, 'txt', 'N', '2010-04-09'),
(6, 45, 'txt', 'N', '2010-04-09'),
(6, 46, 'txt', 'N', '2010-04-09'),
(6, 47, 'txt', 'N', '2010-04-09'),
(6, 56, 'mc', 'Y', '2010-04-23'),
(6, 57, 'mc', 'N', '2010-04-23'),
(6, 58, 'txt', 'Y', '2010-06-07'),
(6, 59, 'txt', 'Y', '2010-06-07'),
(6, 60, 'txt', 'Y', '2010-06-07'),
(6, 61, 'txt', 'N', '2010-06-07'),
(6, 62, 'txt', 'Y', '2010-06-07'),
(6, 63, 'mc', 'N', '2010-04-11'),
(6, 64, 'mc', 'Y', '2010-04-11'),
(6, 65, 'txt', 'Y', '2010-06-07'),
(6, 66, 'txt', 'Y', '2010-06-07'),
(6, 67, 'txt', 'Y', '2010-06-07'),
(6, 68, 'mc', 'Y', '2010-04-11'),
(6, 69, 'mc', 'Y', '2010-04-11'),
(6, 70, 'txt', 'N', '2010-06-07'),
(6, 71, 'txt', 'Y', '2010-06-07'),
(6, 1, 'txt', 'N', '2010-04-19'),
(6, 2, 'mc', 'Y', '2010-04-24'),
(6, 8, 'mc', 'N', '2010-06-06'),
(6, 64, 'txt', 'Y', '2010-06-07'),
(6, 69, 'txt', 'Y', '2010-06-07'),
(6, 56, 'txt', 'Y', '2010-06-07'),
(6, 63, 'txt', 'Y', '2010-06-07'),
(6, 57, 'txt', 'Y', '2010-06-07'),
(6, 68, 'txt', 'Y', '2010-06-07'),
(6, 17, 'txt', 'N', '2010-06-07'),
(6, 19, 'txt', 'N', '2010-06-07'),
(6, 20, 'txt', 'Y', '2010-06-07'),
(6, 18, 'txt', 'N', '2010-06-07'),
(6, 82, 'txt', 'N', '2010-06-07'),
(6, 84, 'txt', 'Y', '2010-06-07'),
(6, 79, 'txt', 'Y', '2010-06-07'),
(6, 83, 'txt', 'Y', '2010-06-07');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `creationdate` date NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `active` varchar(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(90) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`userid`, `firstname`, `lastname`, `creationdate`, `username`, `password`, `active`, `email`, `role`) VALUES
(6, 'martin', 'kapfhammer', '2023-02-20', 'maka', '098f6bcd4621d373cade4e832627b4f6', 'Y', 'martinkapfhammer@gmx.net', 'manager'),
(7, 'Lisa', 'Matzeder', '2010-04-02', 'lilie', '098f6bcd4621d373cade4e832627b4f6', 'Y', 'lisa.matzeder@gmx.de', 'user');

