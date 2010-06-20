-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 20. Juni 2010 um 18:13
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
(40, 'Konrad Adenauer', 'Theodor Heuss', 'Kurt-Georg Kießinger', 'Ludwig Erhard', 0, ''),
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
(92, 'London', 'Liverpool', 'Belfast', 'Edinburgh', 0, ''),
(93, 'Uruguay', 'Italien', 'Brasilien', 'Niederlande', 0, ''),
(94, 'Italien', 'Deutschland', 'Brasilien', 'Niederlande', 0, ''),
(95, 'Italien', 'Argentinien', 'Spanien', 'Uruguay', 0, ''),
(96, 'Uruguay', 'Argentinien', 'Frankreich', 'Italien', 0, ''),
(97, 'Deutschland', 'Brasilien', 'England', 'Italien', 0, ''),
(98, 'Brasilien', 'Argentinien', 'Deutschland', 'Italien', 0, ''),
(99, 'Brasilien', 'Frankreich', 'Niederlande', 'Schweden', 0, ''),
(100, 'England', 'Brasilien', 'Mexico', 'Spanien', 0, ''),
(101, 'Brasilien', 'Deutschland', 'Niederlande', 'Spanien', 0, ''),
(102, 'Deutschland', 'Brasilien', 'Uruguay', 'Belgien', 0, ''),
(103, 'Argentinien', 'England', 'Spanien', 'Italien', 0, ''),
(104, 'Italien', 'England', 'Brasilien', 'Frankreich', 0, ''),
(105, 'Argentinien', 'Südafrika', 'Brasilien', 'England', 0, ''),
(106, 'Deutschland', 'Brasilien', 'Spanien', 'Niederlande', 0, ''),
(107, 'Brasilien', 'Deutschland', 'Frankreich', 'Niederlande', 0, ''),
(108, 'Frankreich', 'Italien', 'Deutschland', 'Argentinien', 0, ''),
(109, 'Brasilien', 'Spanien', 'Niederlande', 'Argentinien', 0, ''),
(110, 'Italien', 'Deutschland', 'Spanien', 'Argentinien', 0, ''),
(111, 'Minsk', 'Homel', 'Wizebsk', 'Brest', 0, ''),
(112, 'Moskau', 'Sankt Petersburg', 'Nowosibirsk', 'Jekaterinburg', 0, ''),
(113, 'Nikosia', 'Limassol ', 'Strovolos', 'Larnaka', 0, ''),
(114, 'Oslo', 'Trondheim', 'Stavanger/Sandnes', 'Fredrikstad/Sarpsborg', 0, ''),
(115, 'Paris', 'Marseille', 'Lyon', 'Bordeaux', 0, ''),
(116, 'Podgorica', 'Boan', 'Mahala', 'Rastovac', 0, ''),
(117, 'Prag', 'Pilsen', 'Ostrau', 'Brünn', 0, ''),
(118, 'Reykjavik', 'Akureyri', 'Kopavogur', 'Akranes', 0, ''),
(119, 'Riga', 'Daugavpils', 'Jelgava', 'Ventspils', 0, ''),
(120, 'Rom', 'Mailand', 'Venedig', 'Turin', 0, ''),
(121, 'Sarajevo', 'Banja Luka', 'Zenica', 'Tuzla', 0, ''),
(122, 'Skopje', 'Gevgelija', 'Ohrid', 'Kumanovo', 0, ''),
(123, 'Sofia', 'Warna', 'Burgas', 'Russe', 0, ''),
(124, 'Stockholm', 'Göteborg', 'Malmö', 'Uppsala', 0, ''),
(125, 'Tallinn', 'Tartu', 'Narva', 'Pärnu', 0, ''),
(126, 'Tirana', 'Pogradec', 'Elbasan', 'Vlora', 0, ''),
(127, 'Vaduz', 'Gamprin', 'Balzers', ' Triesenberg', 0, ''),
(128, 'Valletta', 'Paola', 'Santa Venera', 'Luqa', 0, ''),
(129, 'Vilnius ', 'Kaunas', 'Alytus', 'Klaipeda', 0, ''),
(130, 'Warschau', 'Krakau', 'Breslau', 'Posen', 0, ''),
(131, 'Wien', 'Salzburg', 'Graz', 'Innsbruck', 0, ''),
(132, 'Zagreb', 'Rijeka', 'Split', 'Pula', 0, ''),
(133, 'Sowjetunion', 'Deutschland', 'England', 'Belgien', 0, ''),
(134, 'Spanien', 'Deutschland', 'Frankreich', 'Portugal', 0, ''),
(135, 'Italien', 'Spanien', 'England', 'Sowjetunion', 0, ''),
(136, 'Deutschland', 'Spanien', 'Italien', 'Jugoslawien', 0, ''),
(137, 'Tschechoslowakei', 'England', 'Frankreich', 'Jugoslawien', 0, ''),
(138, 'Deutschland', 'Tschechoslowakei', 'Jugoslawien', 'Spanien', 0, ''),
(139, 'Frankreich', 'Sowjetunion', 'Deutschland', 'Niederlande', 0, ''),
(140, 'Niederlande', 'England', 'Spanien', 'Italien', 0, ''),
(141, 'Dänemark', 'Niederlande', 'Frankreich', 'Russland', 0, ''),
(142, 'Deutschland', 'Niederlande', 'Italien', 'England', 0, ''),
(143, 'Frankreich', 'Griechenland', 'Spanien', 'Deutschland', 0, ''),
(144, 'Griechenland', 'Deutschland', 'Niederlande', 'Frankreich', 0, ''),
(145, 'Spanien', 'Italien', 'Tschechien', 'Türkei', 0, ''),
(146, 'Theodor Heuss', 'Heinrich Lübke', 'Walter Scheel', 'Roman Herzog', 0, ''),
(147, 'Heinrich Lübke', 'Theodor Heuss', 'Walter Scheel', 'Roman Herzog', 0, ''),
(148, 'Gustav Heinemann ', 'Theodor Heuss', 'Walter Scheel', 'Karl Carstens', 0, ''),
(149, 'Walter Scheel', 'Richard von Weizsäcker', 'Johannes Rau', 'Karl Carstens', 0, ''),
(150, 'Karl Carstens', 'Richard von Weizsäcker', 'Johannes Scheel', 'Gustav Heinemann', 0, ''),
(151, 'Richard von Weizsäcker', 'Roman Herzog', 'Johannes Rau', 'Gustav Heinemann', 0, ''),
(152, 'Roman Herzog', 'Horst Köhler', 'Johannes Rau', 'Richard von Weizsäcker', 0, ''),
(153, 'Johannes Rau', 'Horst Köhler', 'Roman Herzog', 'Richard von Weizsäcker', 0, ''),
(154, 'Horst Köhler', 'Johannes Rau', 'Roman Herzog', 'Richard von Weizsäcker', 0, ''),
(155, '1949 bis 1959', '1947 bis 1951', '1949 bis 1951', '1951 bis 1957', 0, ''),
(156, '1959 bis 1969', '1959 bis 1970', '1949 bis 1959', '1955 bis 1959', 0, ''),
(157, '1969 bis 1974', '1969 bis 1979', '1959 bis 1979', '1955 bis 1959', 0, ''),
(158, '1974 bis 1979', '1969 bis 1979', '1974 bis 1982', '1962 bis 1974', 0, ''),
(159, '1979 bis 1984', '1969 bis 1984', '1984 bis 1988', '1979 bis 1988', 0, ''),
(160, '1984 bis 1994', '1974 bis 1990', '1984 bis 1988', '1979 bis 1988', 0, ''),
(161, '1994 bis 1999', '1990 bis 1998', '1984 bis 1994', '1994 bis 2000', 0, ''),
(162, '1999 bis 2004', '1994 bis 2000', '1999 bis 2002', '2002 bis 2006', 0, ''),
(163, '2004 bis 2010', '2000 bis 2010', '1999 bis 2009', '2006 bis 2010', 0, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(90) NOT NULL,
  PRIMARY KEY (`categoryid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`categoryid`, `name`) VALUES
(1, 'Geographie'),
(2, 'Bundesländer'),
(3, 'Kfz-Kennzeichen'),
(4, 'Bundeskanzler'),
(5, 'Flaggen, Wappen'),
(6, 'Europa'),
(7, 'Fußball'),
(8, 'Politik');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Daten für Tabelle `gameList`
--

INSERT INTO `gameList` (`gameid`, `questionids`, `name`, `qtype`) VALUES
(2, '56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71', 'Die Wappen der 16 deutschen Bundesländer', 'mc'),
(1, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16', 'Die deutschen Bundesländer', 'mc'),
(3, '72,74,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,111,113,112,115,114,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132', 'Europas Hauptstädte', 'mc'),
(4, '17,18,19,20', 'Auf welchem europäischen Land steht das Fähnchen?', 'mc'),
(5, '21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39', 'Deutsche Kfz-Kennzeichen mit A', 'mc'),
(7, '40,41,42,43,44,45,46,47', 'Die deutschen Bundeskanzler', 'mc'),
(8, '48,49,50,51,52,53,54,55', 'Amtszeit der deutschen Bundeskanzler', 'mc'),
(9, '93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110', 'Wer wurde wann Fußball Weltmeister?', 'mc'),
(10, '133,134,135,136,137,138,139,140,141,142,143,144,145', 'Wer wurde wann Fußball Europameister?', 'mc'),
(11, '146,147,148,149,150,151,152,153,154', 'Die deutschen Bundespräsidenten', 'mc'),
(12, '155,156,157,158,159,160,161,162,163', 'Amtszeit der deutschen Bundespräsidenten', 'mc');

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
  `qtype` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`resultid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Daten für Tabelle `gameResult`
--

INSERT INTO `gameResult` (`resultid`, `gameid`, `date`, `rightids`, `wrongids`, `userid`, `score`, `qtype`) VALUES
(8, 9, '2010-06-16', '108,104,100,99,97,110,98,96,106,93,102,109,107,101,94,105,103,95', '', 6, 450, 'txt'),
(7, 10, '2010-06-15', '142,139,135,143,134,136,138,141,145', '144,137,140,133', 6, 225, 'txt');

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
(40, 8),
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
(92, 6),
(93, 7),
(94, 7),
(95, 7),
(96, 7),
(97, 7),
(98, 7),
(99, 7),
(100, 7),
(101, 7),
(102, 7),
(103, 7),
(104, 7),
(105, 7),
(106, 7),
(107, 7),
(108, 7),
(109, 7),
(110, 7),
(111, 6),
(112, 6),
(113, 6),
(114, 6),
(115, 6),
(116, 6),
(117, 6),
(118, 6),
(119, 6),
(120, 6),
(121, 6),
(122, 6),
(123, 6),
(124, 6),
(125, 6),
(126, 6),
(127, 6),
(128, 6),
(129, 6),
(130, 6),
(131, 6),
(132, 6),
(133, 7),
(134, 7),
(135, 7),
(136, 7),
(137, 7),
(138, 7),
(139, 7),
(140, 7),
(141, 7),
(142, 7),
(143, 7),
(144, 7),
(145, 7),
(146, 8),
(147, 8),
(148, 8),
(149, 8),
(150, 8),
(151, 8),
(152, 8),
(153, 8),
(154, 8),
(155, 8),
(156, 8),
(157, 8),
(158, 8),
(159, 8),
(160, 8),
(161, 8),
(162, 8),
(163, 8);

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
('img', '133');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=164 ;

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
(40, 'Wie heißt der erste deutsche Bundeskanzler?', 40, '31.jpg', 1, '2010-03-31', 6, 'Y', ''),
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
(92, 'Wie lautet die Hauptstadt Großbritanniens?', 92, '71.jpg', 1, '2010-06-08', 6, 'Y', ''),
(93, 'Wer gewann 1930 die Fußball Weltmeisterschaft gegen Argentinien?', 93, '72.jpg', 1, '2010-06-10', 6, 'Y', ''),
(94, 'Wer gewann 1934 die Fußball Weltmeisterschaft gegen die Tschechoslowakei?', 94, '73.jpg', 1, '2010-06-10', 6, 'Y', ''),
(95, 'Wer gewann 1938 die Fußball Weltmeisterschaft gegen Ungarn?', 95, '74.jpg', 1, '2010-06-10', 6, 'Y', ''),
(96, 'Wer gewann 1950 die Fußball Weltmeisterschaft gegen Brasilien?', 96, '75.jpg', 1, '2010-06-10', 6, 'Y', ''),
(97, 'Wer gewann 1954 die Fußball Weltmeisterschaft gegen Ungarn?', 97, '76.jpg', 1, '2010-06-10', 6, 'Y', ''),
(98, 'Wer gewann 1958 die Fußball Weltmeisterschaft gegen Schweden?', 98, '77.jpg', 1, '2010-06-10', 6, 'Y', ''),
(99, 'Wer gewann 1962 die Fußball Weltmeisterschaft gegen die Tschechaslowakei?', 99, '78.jpg', 1, '2010-06-10', 6, 'Y', ''),
(100, 'Wer gewann 1966 die Fußball Weltmeisterschaft gegen Deutschland?', 100, '79.jpg', 1, '2010-06-10', 6, 'Y', ''),
(101, 'Wer gewann 1970 die Fußball Weltmeisterschaft gegen Italien?', 101, '80.jpg', 1, '2010-06-10', 6, 'Y', ''),
(102, 'Wer gewann 1974 die Fußball Weltmeisterschaft gegen die Niederlande?', 102, '81.jpg', 1, '2010-06-10', 6, 'Y', ''),
(103, 'Wer gewann 1978 die Fußball Weltmeisterschaft gegen die Niederlande?', 103, '82.jpg', 1, '2010-06-10', 6, 'Y', ''),
(104, 'Wer gewann 1982 die Fußball Weltmeisterschaft gegen Deutschland?', 104, '83.jpg', 1, '2010-06-10', 6, 'Y', ''),
(105, 'Wer gewann 1986 die Fußball Weltmeisterschaft gegen Deutschland?', 105, '84.jpg', 1, '2010-06-10', 6, 'Y', ''),
(106, 'Wer gewann 1990 die Fußball Weltmeisterschaft gegen Argentinien?', 106, '85.jpg', 1, '2010-06-10', 6, 'Y', ''),
(107, 'Wer gewann 1994 die Fußball Weltmeisterschaft gegen Italien?', 107, '86.jpg', 1, '2010-06-10', 6, 'Y', ''),
(108, 'Wer gewann 1998 die Fußball Weltmeisterschaft gegen Brasilien?', 108, '87.jpg', 1, '2010-06-10', 6, 'Y', ''),
(109, 'Wer gewann 2002 die Fußball Weltmeisterschaft gegen Deutschland?', 109, '88.jpg', 1, '2010-06-10', 6, 'Y', ''),
(110, 'Wer gewann 2006 die Fußball Weltmeisterschaft gegen Frankreich?', 110, '89.jpg', 1, '2010-06-10', 6, 'Y', ''),
(111, 'Wie lautet die Hauptstadt Weißrusslands?', 111, '90.jpg', 1, '2010-06-12', 6, 'Y', ''),
(112, 'Wie lautet die Hauptstadt Russlands?', 112, '91.jpg', 1, '2010-06-12', 6, 'Y', ''),
(113, 'Wie lautet die Hauptstadt Zyperns?', 113, '92.jpg', 1, '2010-06-12', 6, 'Y', ''),
(114, 'Wie lautet die Hauptstadt Norwegens?', 114, '93.jpg', 1, '2010-06-12', 6, 'Y', ''),
(115, 'Wie lautet die Hauptstadt Frankreichs?', 115, '94.jpg', 1, '2010-06-12', 6, 'Y', ''),
(116, 'Wie lautet die Hauptstadt Montenegros?', 116, '95.jpg', 1, '2010-06-12', 6, 'Y', ''),
(117, 'Wie lautet die Hauptstadt Tschechiens?', 117, '96.jpg', 1, '2010-06-12', 6, 'Y', ''),
(118, 'Wie lautet die Hauptstadt Islands?', 118, '97.jpg', 1, '2010-06-12', 6, 'Y', ''),
(119, 'Wie lautet die Hauptstadt Lettlands?', 119, '98.jpg', 1, '2010-06-12', 6, 'Y', ''),
(120, 'Wie lautet die Hauptstadt Italiens?', 120, '99.JPG', 1, '2010-06-12', 6, 'Y', ''),
(121, 'Wie lautet die Hauptstadt von Bosnien-Herzegowina?', 121, '100.jpg', 1, '2010-06-12', 6, 'Y', ''),
(122, 'Wie lautet die Hauptstadt von Mazedonien?', 122, '101.jpg', 1, '2010-06-12', 6, 'Y', ''),
(123, 'Wie lautet die Hauptstadt Bulgariens?', 123, '102.jpg', 1, '2010-06-12', 6, 'Y', ''),
(124, 'Wie lautet die Hauptstadt Schwedens?', 124, '103.jpg', 1, '2010-06-12', 6, 'Y', ''),
(125, 'Wie lautet die Hauptstadt Estlands?', 125, '104.jpg', 1, '2010-06-13', 6, 'Y', ''),
(126, 'Wie lautet die Hauptstadt Albanien?', 126, '105.jpg', 1, '2010-06-13', 6, 'Y', ''),
(127, 'Wie lautet die Hauptstadt von Liechtenstein?', 127, '106.jpg', 1, '2010-06-13', 6, 'Y', ''),
(128, 'Wie lautet die Hauptstadt von Malta?', 128, '107.jpg', 1, '2010-06-13', 6, 'Y', ''),
(129, 'Wie lautet die Hauptstadt von Litauen?', 129, '108.JPG', 1, '2010-06-13', 6, 'Y', ''),
(130, 'Wie lautet die Hauptstadt von Polen?', 130, '109.jpg', 1, '2010-06-13', 6, 'Y', ''),
(131, 'Wie lautet die Hauptstadt von Österreich?', 131, '110.jpg', 1, '2010-06-13', 6, 'Y', ''),
(132, 'Wie lautet die Hauptstadt von Kroatien?', 132, '111.jpg', 1, '2010-06-13', 6, 'Y', ''),
(133, 'Wer gewann 1960 die Fußball Europameisterschaft gegen Jugoslawien?', 133, '112.png', 1, '2010-06-15', 6, 'Y', ''),
(134, 'Wer gewann 1964 die Fußball Europameisterschaft gegen die Sowjetunion?', 134, '113.png', 1, '2010-06-15', 6, 'Y', ''),
(135, 'Wer gewann 1968 die Fußball Europameisterschaft gegen Jugoslawien?', 135, '114.png', 1, '2010-06-15', 6, 'Y', ''),
(136, 'Wer gewann 1972 die Fußball Europameisterschaft gegen die Sowjetunion?', 136, '115.png', 1, '2010-06-15', 6, 'Y', ''),
(137, 'Wer gewann 1976 die Fußball Europameisterschaft gegen Deutschland?', 137, '116.png', 1, '2010-06-15', 6, 'Y', ''),
(138, 'Wer gewann 1980 die Fußball Europameisterschaft gegen Belgien?', 138, '117.png', 1, '2010-06-15', 6, 'Y', ''),
(139, 'Wer gewann 1984 die Fußball Europameisterschaft gegen Spanien?', 139, '118.png', 1, '2010-06-15', 6, 'Y', ''),
(140, 'Wer gewann 1988 die Fußball Europameisterschaft gegen die Sowjetunion?', 140, '119.png', 1, '2010-06-15', 6, 'Y', ''),
(141, 'Wer gewann 1992 die Fußball Europameisterschaft gegen Deutschland?', 141, '120.png', 1, '2010-06-15', 6, 'Y', ''),
(142, 'Wer gewann 1996 die Fußball Europameisterschaft gegen Tschechien?', 142, '121.png', 1, '2010-06-15', 6, 'Y', ''),
(143, 'Wer gewann 2000 die Fußball Europameisterschaft gegen Italien?', 143, '122.png', 1, '2010-06-15', 6, 'Y', ''),
(144, 'Wer gewann 2004 die Fußball Europameisterschaft gegen Portugal?', 144, '123.png', 1, '2010-06-15', 6, 'Y', ''),
(145, 'Wer gewann 2008 die Fußball Europameisterschaft gegen Deutschland?', 145, '124.png', 1, '2010-06-15', 6, 'Y', ''),
(147, 'Wie heißt der zweite deutsche Bundespräsident?', 147, '126.jpg', 1, '2010-06-20', 6, 'Y', ''),
(146, 'Wie heißt der erste deutsche Bundespräsident?', 146, '125.jpg', 1, '2010-06-20', 6, 'Y', ''),
(148, 'Wie heißt der dritte deutsche Bundespräsident?', 148, '127.jpg', 1, '2010-06-20', 6, 'Y', ''),
(149, 'Wie heißt der vierte deutsche Bundespräsident?', 149, '128.jpg', 1, '2010-06-20', 6, 'Y', ''),
(150, 'Wie heißt der fünfte deutsche Bundespräsident?', 150, '129.jpg', 1, '2010-06-20', 6, 'Y', ''),
(151, 'Wie heißt der sechste deutsche Bundespräsident?', 151, '130.jpg', 1, '2010-06-20', 6, 'Y', ''),
(152, 'Wie heißt der siebte deutsche Bundespräsident?', 152, '131.jpg', 1, '2010-06-20', 6, 'Y', ''),
(153, 'Wie heißt der achte deutsche Bundespräsident?', 153, '132.jpg', 1, '2010-06-20', 6, 'Y', ''),
(154, 'Wie heißt der neunte deutsche Bundespräsident?', 154, '133.jpg', 1, '2010-06-20', 6, 'Y', ''),
(155, 'Wie lange regierte Theodor Heuss als Bundespräsident?', 155, '125.jpg', 1, '2010-06-20', 6, 'Y', 'YYYY bis YYYY'),
(156, 'Wie lange regierte Heinrich Lübke als Bundespräsident?', 156, '126.jpg', 1, '2010-06-20', 6, 'Y', 'YYYY bis YYYY'),
(157, 'Wie lange regierte Gustav Heinemann als Bundespräsident?', 157, '127.jpg', 1, '2010-06-20', 6, 'Y', 'YYYY bis YYYY'),
(158, 'Wie lange regierte Walter Scheel als Bundespräsident?', 158, '128.jpg', 1, '2010-06-20', 6, 'Y', 'YYYY bis YYYY'),
(159, 'Wie lange regierte Karl Carstens als Bundespräsident?', 159, '129.jpg', 1, '2010-06-20', 6, 'Y', 'YYYY bis YYYY'),
(160, 'Wie lange regierte Richard von Weizsäcker als Bundespräsident?', 160, '130.jpg', 1, '2010-06-20', 6, 'Y', 'YYYY bis YYYY'),
(161, 'Wie lange regierte Roman Herzog als Bundespräsident?', 161, '131.jpg', 1, '2010-06-20', 6, 'Y', 'YYYY bis YYYY'),
(162, 'Wie lange regierte Johannes Rau als Bundespräsident?', 162, '132.jpg', 1, '2010-06-20', 6, 'Y', 'YYYY bis YYYY'),
(163, 'Wie lange regierte Horst Köhler als Bundespräsident?', 163, '133.jpg', 1, '2010-06-20', 6, 'Y', 'YYYY bis YYYY');

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
(6, 48, 'mc', 'N', '2010-06-19'),
(6, 42, 'txt', 'N', '2010-04-09'),
(6, 43, 'txt', 'N', '2010-04-09'),
(6, 44, 'txt', 'N', '2010-04-09'),
(6, 45, 'txt', 'N', '2010-04-09'),
(6, 46, 'txt', 'N', '2010-04-09'),
(6, 47, 'txt', 'N', '2010-04-09'),
(6, 56, 'mc', 'Y', '2010-04-23'),
(6, 57, 'mc', 'N', '2010-04-23'),
(6, 58, 'txt', 'N', '2010-06-19'),
(6, 59, 'txt', 'Y', '2010-06-07'),
(6, 60, 'txt', 'Y', '2010-06-07'),
(6, 61, 'txt', 'N', '2010-06-07'),
(6, 62, 'txt', 'Y', '2010-06-07'),
(6, 63, 'mc', 'N', '2010-04-11'),
(6, 64, 'mc', 'Y', '2010-04-11'),
(6, 65, 'txt', 'Y', '2010-06-07'),
(6, 66, 'txt', 'N', '2010-06-19'),
(6, 67, 'txt', 'N', '2010-06-19'),
(6, 68, 'mc', 'Y', '2010-04-11'),
(6, 69, 'mc', 'Y', '2010-04-11'),
(6, 70, 'txt', 'N', '2010-06-19'),
(6, 71, 'txt', 'Y', '2010-06-07'),
(6, 1, 'txt', 'N', '2010-04-19'),
(6, 2, 'mc', 'Y', '2010-04-24'),
(6, 8, 'mc', 'N', '2010-06-06'),
(6, 64, 'txt', 'Y', '2010-06-07'),
(6, 69, 'txt', 'Y', '2010-06-07'),
(6, 56, 'txt', 'Y', '2010-06-07'),
(6, 63, 'txt', 'N', '2010-06-19'),
(6, 57, 'txt', 'Y', '2010-06-07'),
(6, 68, 'txt', 'N', '2010-06-19'),
(6, 17, 'txt', 'N', '2010-06-16'),
(6, 19, 'txt', 'N', '2010-06-16'),
(6, 20, 'txt', 'N', '2010-06-16'),
(6, 18, 'txt', 'N', '2010-06-16'),
(6, 82, 'txt', 'N', '2010-06-07'),
(6, 84, 'txt', 'Y', '2010-06-07'),
(6, 79, 'txt', 'Y', '2010-06-07'),
(6, 83, 'txt', 'Y', '2010-06-07'),
(6, 36, 'mc', 'N', '2010-06-08'),
(6, 34, 'mc', 'Y', '2010-06-08'),
(6, 30, 'mc', 'N', '2010-06-08'),
(6, 26, 'mc', 'N', '2010-06-08'),
(6, 27, 'mc', 'Y', '2010-06-08'),
(6, 22, 'mc', 'Y', '2010-06-08'),
(6, 37, 'mc', 'Y', '2010-06-08'),
(6, 33, 'mc', 'N', '2010-06-08'),
(6, 24, 'mc', 'Y', '2010-06-08'),
(6, 35, 'mc', 'N', '2010-06-08'),
(6, 23, 'mc', 'Y', '2010-06-08'),
(6, 39, 'mc', 'Y', '2010-06-08'),
(6, 25, 'mc', 'Y', '2010-06-08'),
(6, 21, 'mc', 'Y', '2010-06-08'),
(6, 31, 'mc', 'Y', '2010-06-08'),
(6, 29, 'mc', 'Y', '2010-06-08'),
(6, 32, 'mc', 'Y', '2010-06-08'),
(6, 28, 'mc', 'Y', '2010-06-08'),
(6, 38, 'mc', 'Y', '2010-06-08'),
(6, 50, 'mc', 'Y', '2010-06-08'),
(6, 55, 'mc', 'Y', '2010-06-08'),
(6, 49, 'mc', 'Y', '2010-06-08'),
(6, 53, 'mc', 'Y', '2010-06-08'),
(6, 54, 'mc', 'Y', '2010-06-08'),
(6, 51, 'mc', 'Y', '2010-06-08'),
(6, 52, 'mc', 'Y', '2010-06-08'),
(6, 78, 'txt', 'N', '2010-06-09'),
(6, 88, 'txt', 'Y', '2010-06-09'),
(6, 86, 'txt', 'Y', '2010-06-17'),
(6, 85, 'txt', 'Y', '2010-06-09'),
(6, 91, 'txt', 'Y', '2010-06-09'),
(6, 80, 'txt', 'Y', '2010-06-09'),
(6, 77, 'txt', 'Y', '2010-06-09'),
(6, 74, 'txt', 'Y', '2010-06-09'),
(6, 92, 'txt', 'Y', '2010-06-09'),
(6, 81, 'txt', 'Y', '2010-06-09'),
(6, 89, 'txt', 'Y', '2010-06-09'),
(6, 87, 'txt', 'Y', '2010-06-09'),
(6, 72, 'txt', 'N', '2010-06-09'),
(6, 76, 'txt', 'Y', '2010-06-09'),
(6, 90, 'txt', 'N', '2010-06-09'),
(6, 110, 'mc', 'N', '2010-06-10'),
(6, 106, 'mc', 'Y', '2010-06-10'),
(6, 108, 'mc', 'Y', '2010-06-10'),
(6, 98, 'mc', 'Y', '2010-06-10'),
(6, 95, 'mc', 'Y', '2010-06-10'),
(6, 100, 'mc', 'Y', '2010-06-10'),
(6, 94, 'mc', 'N', '2010-06-12'),
(6, 93, 'mc', 'Y', '2010-06-10'),
(6, 104, 'mc', 'N', '2010-06-12'),
(6, 96, 'mc', 'Y', '2010-06-10'),
(6, 97, 'mc', 'Y', '2010-06-10'),
(6, 107, 'mc', 'Y', '2010-06-10'),
(6, 103, 'mc', 'Y', '2010-06-10'),
(6, 101, 'mc', 'Y', '2010-06-10'),
(6, 99, 'mc', 'Y', '2010-06-10'),
(6, 102, 'mc', 'Y', '2010-06-10'),
(6, 105, 'mc', 'Y', '2010-06-10'),
(6, 109, 'mc', 'Y', '2010-06-10'),
(6, 121, 'mc', 'Y', '2010-06-13'),
(6, 79, 'mc', 'Y', '2010-06-13'),
(6, 128, 'mc', 'Y', '2010-06-13'),
(6, 89, 'mc', 'Y', '2010-06-13'),
(6, 116, 'mc', 'Y', '2010-06-13'),
(6, 83, 'mc', 'Y', '2010-06-13'),
(6, 115, 'mc', 'Y', '2010-06-13'),
(6, 127, 'mc', 'N', '2010-06-13'),
(6, 126, 'mc', 'Y', '2010-06-13'),
(6, 80, 'mc', 'Y', '2010-06-13'),
(6, 84, 'mc', 'Y', '2010-06-13'),
(6, 78, 'mc', 'Y', '2010-06-13'),
(6, 82, 'mc', 'Y', '2010-06-13'),
(6, 88, 'mc', 'Y', '2010-06-13'),
(6, 112, 'mc', 'Y', '2010-06-13'),
(6, 81, 'mc', 'Y', '2010-06-13'),
(6, 113, 'mc', 'Y', '2010-06-13'),
(6, 85, 'mc', 'Y', '2010-06-13'),
(6, 119, 'mc', 'Y', '2010-06-13'),
(6, 87, 'mc', 'Y', '2010-06-13'),
(6, 131, 'mc', 'Y', '2010-06-13'),
(6, 77, 'mc', 'Y', '2010-06-13'),
(6, 125, 'mc', 'N', '2010-06-13'),
(6, 142, 'txt', 'Y', '2010-06-19'),
(6, 139, 'txt', 'Y', '2010-06-15'),
(6, 135, 'txt', 'Y', '2010-06-15'),
(6, 143, 'txt', 'Y', '2010-06-15'),
(6, 144, 'txt', 'N', '2010-06-15'),
(6, 134, 'txt', 'Y', '2010-06-15'),
(6, 137, 'txt', 'N', '2010-06-15'),
(6, 136, 'txt', 'Y', '2010-06-15'),
(6, 140, 'txt', 'N', '2010-06-15'),
(6, 138, 'txt', 'N', '2010-06-19'),
(6, 141, 'txt', 'Y', '2010-06-15'),
(6, 145, 'txt', 'Y', '2010-06-15'),
(6, 133, 'txt', 'N', '2010-06-19'),
(6, 93, 'txt', 'N', '2010-06-16'),
(6, 108, 'txt', 'Y', '2010-06-16'),
(6, 104, 'txt', 'Y', '2010-06-16'),
(6, 100, 'txt', 'Y', '2010-06-16'),
(6, 99, 'txt', 'Y', '2010-06-16'),
(6, 97, 'txt', 'Y', '2010-06-16'),
(6, 110, 'txt', 'Y', '2010-06-16'),
(6, 98, 'txt', 'Y', '2010-06-16'),
(6, 96, 'txt', 'Y', '2010-06-16'),
(6, 106, 'txt', 'Y', '2010-06-16'),
(6, 102, 'txt', 'Y', '2010-06-16'),
(6, 109, 'txt', 'Y', '2010-06-16'),
(6, 107, 'txt', 'Y', '2010-06-16'),
(6, 101, 'txt', 'Y', '2010-06-16'),
(6, 94, 'txt', 'Y', '2010-06-16'),
(6, 105, 'txt', 'Y', '2010-06-16'),
(6, 103, 'txt', 'Y', '2010-06-16'),
(6, 95, 'txt', 'Y', '2010-06-16');

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

