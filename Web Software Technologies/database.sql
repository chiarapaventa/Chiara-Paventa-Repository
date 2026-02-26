-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 09, 2019 alle 23:21
-- Versione del server: 10.1.38-MariaDB
-- Versione PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learnlanguages`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `frase`
--

CREATE TABLE `frase` (
  `id_frase` int(11) NOT NULL,
  `frase` varchar(1000) NOT NULL,
  `traduzione` varchar(1000) NOT NULL,
  `file_mp3` varchar(100) NOT NULL,
  `id_parola_chiave` int(11) NOT NULL,
  `id_lezione` int(11) NOT NULL,
  `grammatica` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `frase`
--

INSERT INTO `frase` (`id_frase`, `frase`, `traduzione`, `file_mp3`, `id_parola_chiave`, `id_lezione`, `grammatica`) VALUES
(1, 'Mi piace bere il vino', 'I like to drink wine', '001.mp3', 5, 11, 'pronome verbo preposizione verbo sostantivo'),
(2, 'Giovanni sta studiando per un esame', 'Giovanni is studying for an exam', '002.mp3', 28, 11, 'nome verbo verbo preposizione articolo sostantivo'),
(3, 'Carlo suonava la chitarra', 'Carlo played the guitar', '003.mp3', 29, 11, 'nome verbo articolo sostantivo'),
(4, 'Il cane corre nel giardino', 'The dog runs in the garden', '004.mp3', 8, 6, 'articolo sostantivo verbo preposizione articolo sostantivo'),
(5, 'La bici &egrave verde', 'The bike is green', '005.mp3', 6, 6, 'the sostantivo verbo aggettivo'),
(6, 'L\' uccello ha fatto il nido', 'The bird has made the nest', '006.mp3', 32, 6, 'articolo sostantivo verbo verbo articolo sostantivo'),
(7, 'Il tuo gatto &egrave bello', 'Your cat is beautiful', '007.mp3', 4, 1, 'articolo sostantivo verbo aggettivo'),
(8, 'Luca &egrave basso ', 'Luca is little', '008.mp3', 3, 1, 'nome verbo aggettivo'),
(9, 'Questo gelato &egrave buono', 'This ice-cream is good', '009.mp3', 7, 1, 'aggettivo sostantivo verbo aggettivo'),
(10, 'Chiara ha superato controlli automatici', 'Chiara passed controlli automatici', '010.mp3', 30, 12, 'nome verbo sostantivo sostantivo'),
(11, 'Carlo ha 18 anni quindi pu&ograve guidare l\'auto', 'Carlo is 18 so he can drive the car', '011.mp3', 18, 12, 'nome verbo numero avverbio pronome verbo articolo macchina'),
(12, 'Domani ascolter&ograve il brano dei Coldplay', 'Tomorrow I will listen to the Coldplay song', '012.mp3', 2, 12, 'avverbio pronome verbo verbo preposizione articolo nome sostantivo'),
(13, 'Oggi ho bevuto molta acqua', 'Today I have drank a lot of water', '013.mp3', 5, 13, 'avverbio pronome verbo verbo preposizione aggettivo preposizione sostantivo'),
(14, 'Mattia ha studiato fisica', 'Mattia has studied physics', '014.mp3', 28, 13, 'nome verbo verbo sostantivo'),
(15, 'Mia madre suona la chitarra', 'My mother plays the guitar', '015.mp3', 29, 13, 'aggettivo sostantivo verbo articolo sostantivo'),
(16, 'A mia figlia piace il mare', 'My daughter likes the sea', '016.mp3', 22, 14, 'preposizione sostantivo verbo articolo sostantivo'),
(17, 'Guido ha superato l\'esame di guida', 'Guido passed the driving test', '017.mp3', 30, 14, 'nome verbo articolo verbo sostantivo'),
(18, 'Elisa canta molto bene', 'Elisa sings very well', '018.mp3', 9, 14, 'nome verbo aggetivo sostantivo'),
(19, 'Spesso dormo solo 4 ore', 'I often sleep only 4 hours', '019.mp3', 13, 15, 'pronome avverbio verbo avverbio numero sostantivo'),
(20, 'Non mi ascolti mai', 'You never listen to me', '020.mp3', 2, 15, 'pronome avverbio verbo preposizione pronome'),
(21, 'So guidare il camion', 'I can drive a truck', '021.mp3', 18, 15, 'pronome verbo verbo preposizione sostantivo'),
(22, 'Si &egrave rotto il frigo', 'The fridge is broken', '022.mp3', 15, 7, 'articolo sostantivo verbo aggettivo'),
(23, 'Questa giacca &egrave troppo calda', 'This jacket is too warm', '023.mp3', 16, 7, 'aggettivo sostantivo verbo avverbio aggettivo'),
(24, 'La mia casa &egrave a Roma', 'My house is in Rome', '024.mp3', 10, 7, 'aggettivo sostantivo verbo preposizione nome'),
(25, 'L&igrave c\'&egrave una sedia', 'There is a chair there', '025.mp3', 26, 8, 'avverbio verbo articolo sostantivo avverbio'),
(26, 'Mi piace la tua sciarpa', 'I like your scarf', '026.mp3', 25, 8, 'pronome verbo aggettivo sostantivo'),
(27, 'Il sole splende', 'The sun shines', '027.mp3\r\n', 27, 8, 'articolo sostantivo verbo'),
(28, 'A giugno vado al mare', 'In june I will go to the sea', '028.mp3', 19, 9, 'preposizione sostantivo pronome verbo verbo preposizione articolo sostantivo'),
(29, 'Mi serve uno zaino', 'I need a backpack', '029.mp3', 33, 9, 'pronome verbo preposizione sostantivo'),
(30, 'Lei si lava con il sapone', 'She wash herself with soap', '030.mp3', 24, 9, 'pronome verbo pronome preposizione sostantivo'),
(31, 'Domani torno a casa', 'Tomorrow I\' ll come back home', '031.mp3', 10, 6, 'avverbio pronome verbo verbo avverbio sostantivo'),
(32, 'Il sapone profuma di pesca', 'The soap smells of peach', '032.mp3', 24, 6, 'articolo sostantivo verbo preposizione sostantivo'),
(33, 'La sedia &egrave comoda', 'The chair is comfortable', '033.mp3', 26, 6, 'articolo sostantivo verbo aggettivo'),
(34, 'Il pantalone &egrave troppo corto', 'The trousers are too short', '034.mp3', 11, 2, 'articolo sostantivo verbo avverbio aggettivo'),
(35, 'Il mio amico &egrave simpatico', 'My friend is nice', '035.mp3', 20, 2, 'aggettivo sostantivo verbo aggettivo'),
(36, 'Questo vino &egrave amaro', 'This wine is bitter', '036.mp3', 1, 2, 'aggettivo sostantivo verbo aggettivo'),
(37, 'Lei &egrave molto forte', 'She is very strong', '037.mp3', 14, 3, 'pronome verbo aggettivo aggettivo'),
(38, 'A Roma &egrave nuvoloso', 'In rome is cloudy', '038.mp3', 21, 3, 'preposizione nome verbo aggettivo'),
(39, 'Quel ragazzo &egrave strano', 'That boy is weird', '039.mp3', 23, 3, 'aggettivo nome verbo aggettivo'),
(40, 'Il sole &egrave giallo', 'The sun is yellow', '040.mp3', 17, 4, 'articolo sostantivo verbo aggettivo'),
(41, 'Tuo figlio &egrave molto dolce', 'Your son is very sweet', '041.mp3', 12, 4, 'aggettivo sostantivo verbo aggettivo aggettivo'),
(42, 'Il tuo cane mangia l\'osso', 'Your dog eats the bone', '042.mp3', 31, 4, 'articolo sostantivo verbo articolo sostantivo'),
(43, 'Il vostro legame &egrave molto forte', 'Your bond is very strong', '043.mp3', 14, 5, 'aggettivo sostantivo verbo aggettivo aggettivo'),
(44, 'La torta &egrave dolce', 'The cake is sweet', '044.mp3', 12, 5, 'articolo sostantivo verbo aggettivo'),
(45, 'Questo muro &egrave giallo', 'This wall is yellow', '045.mp3', 17, 5, 'aggettivo sostantivo verbo aggettivo');

-- --------------------------------------------------------

--
-- Struttura della tabella `lezione`
--

CREATE TABLE `lezione` (
  `id_lezione` int(11) NOT NULL,
  `livello` smallint(6) NOT NULL,
  `categoria` varchar(20) NOT NULL,
  `lingua_base` varchar(50) NOT NULL,
  `lingua_traduzione` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `lezione`
--

INSERT INTO `lezione` (`id_lezione`, `livello`, `categoria`, `lingua_base`, `lingua_traduzione`) VALUES
(1, 1, 'Aggettivo', 'italiano', 'inglese'),
(2, 2, 'Aggettivo', 'italiano', 'inglese'),
(3, 3, 'Aggettivo', 'italiano', 'inglese'),
(4, 4, 'Aggettivo', 'italiano', 'inglese'),
(5, 5, 'Aggettivo', 'italiano', 'inglese'),
(6, 1, 'Nome', 'italiano', 'inglese'),
(7, 2, 'Nome', 'italiano', 'inglese'),
(8, 3, 'Nome', 'italiano', 'inglese'),
(9, 4, 'Nome', 'italiano', 'inglese'),
(11, 1, 'Verbo', 'italiano', 'inglese'),
(12, 2, 'Verbo', 'italiano', 'inglese'),
(13, 3, 'Verbo', 'italiano', 'inglese'),
(14, 4, 'Verbo', 'italiano', 'inglese'),
(15, 5, 'Verbo', 'italiano', 'inglese');

-- --------------------------------------------------------

--
-- Struttura della tabella `lingua`
--

CREATE TABLE `lingua` (
  `nome` varchar(50) NOT NULL,
  `immagine` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `lingua`
--

INSERT INTO `lingua` (`nome`, `immagine`) VALUES
('inglese', 'inglese.png'),
('italiano', 'italiano.png');

-- --------------------------------------------------------

--
-- Struttura della tabella `parola_chiave`
--

CREATE TABLE `parola_chiave` (
  `id_parola_chiave` int(11) NOT NULL,
  `parola_chiave` varchar(100) NOT NULL,
  `lingua_base` varchar(50) NOT NULL,
  `traduzione` varchar(100) NOT NULL,
  `lingua_traduzione` varchar(50) NOT NULL,
  `file_mp3` varchar(100) NOT NULL,
  `immagine` varchar(100) NOT NULL,
  `categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `parola_chiave`
--

INSERT INTO `parola_chiave` (`id_parola_chiave`, `parola_chiave`, `lingua_base`, `traduzione`, `lingua_traduzione`, `file_mp3`, `immagine`, `categoria`) VALUES
(1, 'amaro', 'italiano', 'bitter', 'inglese', 'bitter.mp3', '', 'Aggettivo'),
(2, 'ascoltare', 'italiano', 'to listen', 'inglese', 'tolisten.mp3', '', 'Verbo'),
(3, 'basso', 'italiano', 'short', 'inglese', 'short.mp3', '', 'Aggettivo'),
(4, 'bello', 'italiano', 'beautiful', 'inglese', 'beautiful.mp3', '', 'Aggettivo'),
(5, 'bere', 'italiano', 'to drink', 'inglese', 'todrink.mp3', '', 'Verbo'),
(6, 'bicicletta', 'italiano', 'bike', 'inglese', 'bike.mp3', 'bike.jpg', 'Nome'),
(7, 'buono', 'italiano', 'good', 'inglese', 'good.mp3', '', 'Aggettivo'),
(8, 'cane', 'italiano', 'dog', 'inglese', 'dog.mp3', 'dog.jpg', 'Nome'),
(9, 'cantare', 'italiano', 'to sing', 'inglese', 'tosing.mp3', '', 'Verbo'),
(10, 'casa', 'italiano', 'house', 'inglese', 'house.mp3', 'house.jpg', 'Nome'),
(11, 'corto', 'italiano', 'short', 'inglese', 'short.mp3', '', 'Aggettivo'),
(12, 'dolce', 'italiano', 'sweet', 'inglese', 'sweet.mp3', '', 'Aggettivo'),
(13, 'dormire', 'italiano', 'to sleep', 'inglese', 'tosleep.mp3', '', 'Verbo'),
(14, 'forte', 'italiano', 'strong', 'inglese', 'strong.mp3', '', 'Aggettivo'),
(15, 'frigo', 'italiano', 'fridge', 'inglese', 'fridge.mp3', 'fridge.jpg', 'Nome'),
(16, 'giacca', 'italiano', 'jacket', 'inglese', 'jacket.mp3', 'jacket.jpg', 'Nome'),
(17, 'giallo', 'italiano', 'yellow', 'inglese', 'yellow.mp3', '', 'Aggettivo'),
(18, 'guidare', 'italiano', 'to drive', 'inglese', 'todrive.mp3', '', 'Verbo'),
(19, 'mare', 'italiano', 'sea', 'inglese', 'sea.mp3', 'sea.jpg', 'Nome'),
(20, 'mio', 'italiano', 'my', 'inglese', 'my.mp3', '', 'Aggettivo'),
(21, 'nuvoloso', 'italiano', 'cloudy', 'inglese', 'cloudy.mp3', '', 'Aggettivo'),
(22, 'piacere', 'italiano', 'to like', 'inglese', 'tolike.mp3', '', 'Verbo'),
(23, 'quello', 'italiano', 'that', 'inglese', 'that.mp3', '', 'Aggettivo'),
(24, 'sapone', 'italiano', 'soap', 'inglese', 'soap.mp3', 'soap.jpg', 'Nome'),
(25, 'sciarpa', 'italiano', 'scarf', 'inglese', 'scarf.mp3', 'scarf.jpg', 'Nome'),
(26, 'sedia', 'italiano', 'chair', 'inglese', 'chair.mp3', 'chair.jpg', 'Nome'),
(27, 'sole', 'italiano', 'sun', 'inglese', 'sun.mp3', 'sun.jpg', 'Nome'),
(28, 'studiare', 'italiano', 'to study', 'inglese', 'tostudy.mp3', '', 'Verbo'),
(29, 'suonare', 'italiano', 'to play', 'inglese', 'toplay.mp3', '', 'Verbo'),
(30, 'superare', 'italiano', 'to pass', 'inglese', 'topass.mp3', '', 'Verbo'),
(31, 'tuo', 'italiano', 'your', 'inglese', 'your.mp3', '', 'Aggettivo'),
(32, 'uccello', 'italiano', 'bird', 'inglese', 'bird.mp3', 'bird.jpg', 'Nome'),
(33, 'zaino', 'italiano', 'backpack', 'inglese', 'backpack.mp3', 'backpack.jpg', 'Nome');

-- --------------------------------------------------------

--
-- Struttura della tabella `quizerrati`
--

CREATE TABLE `quizerrati` (
  `ID` int(11) NOT NULL,
  `id_parola_chiave` int(11) NOT NULL,
  `username` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id` int(11) NOT NULL,
  `nome` varchar(300) NOT NULL,
  `cognome` varchar(300) NOT NULL,
  `data_di_nascita` date NOT NULL,
  `sesso` char(1) NOT NULL,
  `email` varchar(300) NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `ruolo` varchar(50) NOT NULL,
  `id_lezione` int(11) DEFAULT NULL,
  `categoria` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id`, `nome`, `cognome`, `data_di_nascita`, `sesso`, `email`, `username`, `password`, `ruolo`, `id_lezione`, `categoria`) VALUES
(1, 'Carla', 'Rossi', '1996-09-23', 'F', 'crossi@gmail.com', 'Gece', '$2y$10$JbPLm9buJwQ7Y7hYaex8Sum/2.PSqR4PMbkkVY6NCkdzIzQn.x96W', 'Collaboratore', NULL, NULL);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `frase`
--
ALTER TABLE `frase`
  ADD PRIMARY KEY (`id_frase`),
  ADD KEY `id_parola_chiave` (`id_parola_chiave`),
  ADD KEY `id_lezione` (`id_lezione`);

--
-- Indici per le tabelle `lezione`
--
ALTER TABLE `lezione`
  ADD PRIMARY KEY (`id_lezione`),
  ADD KEY `lingua_base` (`lingua_base`),
  ADD KEY `lingua_traduzione` (`lingua_traduzione`);

--
-- Indici per le tabelle `lingua`
--
ALTER TABLE `lingua`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `parola_chiave`
--
ALTER TABLE `parola_chiave`
  ADD PRIMARY KEY (`id_parola_chiave`),
  ADD KEY `lingua_base_p` (`lingua_base`),
  ADD KEY `lingua_traduzione_p` (`lingua_traduzione`);

--
-- Indici per le tabelle `quizerrati`
--
ALTER TABLE `quizerrati`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_vincoli` (`username`),
  ADD KEY `id_parola_chiave` (`id_parola_chiave`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_lezione_utente` (`id_lezione`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `frase`
--
ALTER TABLE `frase`
  MODIFY `id_frase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT per la tabella `lezione`
--
ALTER TABLE `lezione`
  MODIFY `id_lezione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `parola_chiave`
--
ALTER TABLE `parola_chiave`
  MODIFY `id_parola_chiave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT per la tabella `quizerrati`
--
ALTER TABLE `quizerrati`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `frase`
--
ALTER TABLE `frase`
  ADD CONSTRAINT `id_lezione_f` FOREIGN KEY (`id_lezione`) REFERENCES `lezione` (`id_lezione`),
  ADD CONSTRAINT `id_parola_chiave` FOREIGN KEY (`id_parola_chiave`) REFERENCES `parola_chiave` (`id_parola_chiave`);

--
-- Limiti per la tabella `lezione`
--
ALTER TABLE `lezione`
  ADD CONSTRAINT `lingua_base` FOREIGN KEY (`lingua_base`) REFERENCES `lingua` (`nome`),
  ADD CONSTRAINT `lingua_traduzione` FOREIGN KEY (`lingua_traduzione`) REFERENCES `lingua` (`nome`);

--
-- Limiti per la tabella `parola_chiave`
--
ALTER TABLE `parola_chiave`
  ADD CONSTRAINT `lingua_base_p` FOREIGN KEY (`lingua_base`) REFERENCES `lingua` (`nome`),
  ADD CONSTRAINT `lingua_traduzione_p` FOREIGN KEY (`lingua_traduzione`) REFERENCES `lingua` (`nome`);

--
-- Limiti per la tabella `quizerrati`
--
ALTER TABLE `quizerrati`
  ADD CONSTRAINT `quizerrati_ibfk_1` FOREIGN KEY (`id_parola_chiave`) REFERENCES `parola_chiave` (`id_parola_chiave`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_vincoli` FOREIGN KEY (`username`) REFERENCES `utente` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `utente`
--
ALTER TABLE `utente`
  ADD CONSTRAINT `id_lezione_utente` FOREIGN KEY (`id_lezione`) REFERENCES `lezione` (`id_lezione`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
