-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17 Mai 2018 la 22:21
-- Versiune server: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ptw`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `alergii`
--

CREATE TABLE `alergii` (
  `numea` varchar(255) NOT NULL,
  `ida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `boli`
--

CREATE TABLE `boli` (
  `idb` int(11) NOT NULL,
  `numeb` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `bucatarii`
--

CREATE TABLE `bucatarii` (
  `numb` varchar(255) NOT NULL,
  `idb` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `cantitate`
--

CREATE TABLE `cantitate` (
  `idc` int(11) NOT NULL,
  `gramaj` int(11) NOT NULL,
  `unitate` varchar(255) NOT NULL,
  `idi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `format`
--

CREATE TABLE `format` (
  `idf` int(11) NOT NULL,
  `rssf` varchar(255) NOT NULL,
  `csvf` varchar(255) NOT NULL,
  `jsonf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `imagini`
--

CREATE TABLE `imagini` (
  `idimg` int(11) NOT NULL,
  `cale` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `ingrediente`
--

CREATE TABLE `ingrediente` (
  `numei` varchar(255) NOT NULL,
  `idingr` int(11) NOT NULL,
  `idc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `instrumente`
--

CREATE TABLE `instrumente` (
  `numei` varchar(255) NOT NULL,
  `idinstr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `mese`
--

CREATE TABLE `mese` (
  `numem` varchar(255) NOT NULL,
  `idm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `pasi`
--

CREATE TABLE `pasi` (
  `idp` int(11) NOT NULL,
  `text` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `preparare`
--

CREATE TABLE `preparare` (
  `numep` varchar(255) NOT NULL,
  `idpre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `regim`
--

CREATE TABLE `regim` (
  `numer` varchar(255) NOT NULL,
  `idr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `retete`
--

CREATE TABLE `retete` (
  `idr` int(11) NOT NULL,
  `titlu` varchar(255) NOT NULL,
  `fid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `preid` int(11) NOT NULL,
  `instrid` int(11) NOT NULL,
  `ingrid` int(11) NOT NULL,
  `imgid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `retete_boli_alergii_regim`
--

CREATE TABLE `retete_boli_alergii_regim` (
  `rid` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `reid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `timp`
--

CREATE TABLE `timp` (
  `idt` int(11) NOT NULL,
  `durata` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `utilizatori`
--

CREATE TABLE `utilizatori` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `parola` varchar(100) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `prenume` varchar(255) NOT NULL,
  `datanasterii` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `utilizatori_retete`
--

CREATE TABLE `utilizatori_retete` (
  `rid` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alergii`
--
ALTER TABLE `alergii`
  ADD PRIMARY KEY (`ida`);

--
-- Indexes for table `boli`
--
ALTER TABLE `boli`
  ADD PRIMARY KEY (`idb`);

--
-- Indexes for table `bucatarii`
--
ALTER TABLE `bucatarii`
  ADD PRIMARY KEY (`idb`);

--
-- Indexes for table `cantitate`
--
ALTER TABLE `cantitate`
  ADD PRIMARY KEY (`idc`),
  ADD KEY `cantitate_ingrediente_idi_fk` (`idi`);

--
-- Indexes for table `format`
--
ALTER TABLE `format`
  ADD PRIMARY KEY (`idf`);

--
-- Indexes for table `imagini`
--
ALTER TABLE `imagini`
  ADD PRIMARY KEY (`idimg`);

--
-- Indexes for table `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD PRIMARY KEY (`idingr`),
  ADD KEY `ingrediente_cantitate_idc_fk` (`idc`);

--
-- Indexes for table `instrumente`
--
ALTER TABLE `instrumente`
  ADD PRIMARY KEY (`idinstr`);

--
-- Indexes for table `mese`
--
ALTER TABLE `mese`
  ADD PRIMARY KEY (`idm`);

--
-- Indexes for table `pasi`
--
ALTER TABLE `pasi`
  ADD PRIMARY KEY (`idp`);

--
-- Indexes for table `preparare`
--
ALTER TABLE `preparare`
  ADD PRIMARY KEY (`idpre`);

--
-- Indexes for table `regim`
--
ALTER TABLE `regim`
  ADD PRIMARY KEY (`idr`);

--
-- Indexes for table `retete`
--
ALTER TABLE `retete`
  ADD PRIMARY KEY (`idr`),
  ADD UNIQUE KEY `utilizatori_retete_titlu_uindex` (`titlu`),
  ADD KEY `retete_format_idf_fk` (`fid`),
  ADD KEY `retete_pasi_idp_fk` (`pid`),
  ADD KEY `retete_mese_idm_fk` (`mid`),
  ADD KEY `retete_timp_idt_fk` (`tid`),
  ADD KEY `retete_bucatarii_idb_fk` (`bid`),
  ADD KEY `retete_preparare_idpre_fk` (`preid`),
  ADD KEY `retete_instrumente_idinstr_fk` (`instrid`),
  ADD KEY `retete_ingrediente_idingr_fk` (`ingrid`),
  ADD KEY `retete_imagini_idimg_fk` (`imgid`);

--
-- Indexes for table `retete_boli_alergii_regim`
--
ALTER TABLE `retete_boli_alergii_regim`
  ADD KEY `retete_boli_alergii_regim_retete_idr_fk` (`rid`),
  ADD KEY `retete_boli_alergii_regim_boli_idb_fk` (`bid`),
  ADD KEY `retete_boli_alergii_regim_regim_idr_fk` (`reid`),
  ADD KEY `retete_boli_alergii_regim_alergii_ida_fk` (`aid`);

--
-- Indexes for table `timp`
--
ALTER TABLE `timp`
  ADD PRIMARY KEY (`idt`);

--
-- Indexes for table `utilizatori`
--
ALTER TABLE `utilizatori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_uindex` (`email`);

--
-- Indexes for table `utilizatori_retete`
--
ALTER TABLE `utilizatori_retete`
  ADD KEY `utilizatori_retete_utilizatori_id_fk` (`uid`),
  ADD KEY `utilizatori_retete_retete_idr_fk` (`rid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alergii`
--
ALTER TABLE `alergii`
  MODIFY `ida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `boli`
--
ALTER TABLE `boli`
  MODIFY `idb` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bucatarii`
--
ALTER TABLE `bucatarii`
  MODIFY `idb` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cantitate`
--
ALTER TABLE `cantitate`
  MODIFY `idc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imagini`
--
ALTER TABLE `imagini`
  MODIFY `idimg` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingrediente`
--
ALTER TABLE `ingrediente`
  MODIFY `idingr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instrumente`
--
ALTER TABLE `instrumente`
  MODIFY `idinstr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mese`
--
ALTER TABLE `mese`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pasi`
--
ALTER TABLE `pasi`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `preparare`
--
ALTER TABLE `preparare`
  MODIFY `idpre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regim`
--
ALTER TABLE `regim`
  MODIFY `idr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `retete`
--
ALTER TABLE `retete`
  MODIFY `idr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timp`
--
ALTER TABLE `timp`
  MODIFY `idt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilizatori`
--
ALTER TABLE `utilizatori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrictii pentru tabele sterse
--

--
-- Restrictii pentru tabele `cantitate`
--
ALTER TABLE `cantitate`
  ADD CONSTRAINT `cantitate_ingrediente_idi_fk` FOREIGN KEY (`idi`) REFERENCES `ingrediente` (`idingr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrictii pentru tabele `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD CONSTRAINT `ingrediente_cantitate_idc_fk` FOREIGN KEY (`idc`) REFERENCES `cantitate` (`idc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrictii pentru tabele `retete`
--
ALTER TABLE `retete`
  ADD CONSTRAINT `retete_bucatarii_idb_fk` FOREIGN KEY (`bid`) REFERENCES `bucatarii` (`idb`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `retete_format_idf_fk` FOREIGN KEY (`fid`) REFERENCES `format` (`idf`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `retete_imagini_idimg_fk` FOREIGN KEY (`imgid`) REFERENCES `imagini` (`idimg`),
  ADD CONSTRAINT `retete_ingrediente_idingr_fk` FOREIGN KEY (`ingrid`) REFERENCES `ingrediente` (`idingr`),
  ADD CONSTRAINT `retete_instrumente_idinstr_fk` FOREIGN KEY (`instrid`) REFERENCES `instrumente` (`idinstr`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `retete_mese_idm_fk` FOREIGN KEY (`mid`) REFERENCES `mese` (`idm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `retete_pasi_idp_fk` FOREIGN KEY (`pid`) REFERENCES `pasi` (`idp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `retete_preparare_idpre_fk` FOREIGN KEY (`preid`) REFERENCES `preparare` (`idpre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `retete_timp_idt_fk` FOREIGN KEY (`tid`) REFERENCES `timp` (`idt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrictii pentru tabele `retete_boli_alergii_regim`
--
ALTER TABLE `retete_boli_alergii_regim`
  ADD CONSTRAINT `retete_boli_alergii_regim_alergii_ida_fk` FOREIGN KEY (`aid`) REFERENCES `alergii` (`ida`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `retete_boli_alergii_regim_boli_idb_fk` FOREIGN KEY (`bid`) REFERENCES `boli` (`idb`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `retete_boli_alergii_regim_regim_idr_fk` FOREIGN KEY (`reid`) REFERENCES `regim` (`idr`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `retete_boli_alergii_regim_retete_idr_fk` FOREIGN KEY (`rid`) REFERENCES `retete` (`idr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrictii pentru tabele `utilizatori_retete`
--
ALTER TABLE `utilizatori_retete`
  ADD CONSTRAINT `utilizatori_retete_retete_idr_fk` FOREIGN KEY (`rid`) REFERENCES `retete` (`idr`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utilizatori_retete_utilizatori_id_fk` FOREIGN KEY (`uid`) REFERENCES `utilizatori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
