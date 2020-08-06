-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2019 at 06:01 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbchemical_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_battery_cert`
--

CREATE TABLE `tb_battery_cert` (
  `battery_cert_id` bigint(20) NOT NULL,
  `prod_name` varchar(150) NOT NULL,
  `batt_name` varchar(150) NOT NULL,
  `batt_category` varchar(10) NOT NULL,
  `batt_type` varchar(50) NOT NULL,
  `batt_lithium_content` varchar(12) NOT NULL,
  `batt_watthour_rating` varchar(12) NOT NULL,
  `batt_weight` varchar(12) NOT NULL,
  `batt_cellsPerBatt` int(100) NOT NULL,
  `cells_batt_per_device` int(100) NOT NULL,
  `batt_supplier` varchar(150) NOT NULL,
  `batt_cert` varchar(150) NOT NULL,
  `del_status` varchar(1) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_battery_cert`
--

INSERT INTO `tb_battery_cert` (`battery_cert_id`, `prod_name`, `batt_name`, `batt_category`, `batt_type`, `batt_lithium_content`, `batt_watthour_rating`, `batt_weight`, `batt_cellsPerBatt`, `cells_batt_per_device`, `batt_supplier`, `batt_cert`, `del_status`, `user_id`, `date_added`) VALUES
(2, 'Battery', 'M48189P3B CMA', 'Battery', '2', '21', '1', '12', 2, 12, 'Rimpido Gmbh', 'QDI-160114-B-M48189P3B-CMA-UN-Certificate-of-Compliance-RESU10-2.pdf', NULL, 6, '2019-05-14 08:41:25'),
(3, 'test product', 'test name', '2', '1', '12', '', '2', 1, 2, '21', 'M48189P3B.pdf', NULL, 7, '2019-05-14 09:18:14'),
(4, 'test', 'test', '2', '3', '123', '12', '123', 1, 3, 'Rim', 'BU-2015-03497-0-UN_CERTIFICATE_VICTRON_BAT512900400_LIFEPO04.pdf', NULL, 6, '2019-06-06 02:51:24'),
(6, 'test', 'test batt name', '1', '2', '12', '123', '2', 12, 0, 'Rimpido', 'XYZ3965533464.pdf', NULL, 6, '2019-06-21 07:06:34');

-- --------------------------------------------------------

--
-- Table structure for table `tb_chemical_ghs`
--

CREATE TABLE `tb_chemical_ghs` (
  `chemical_ghs_id` bigint(20) NOT NULL,
  `chemical_header_id` bigint(20) NOT NULL,
  `ghs_label_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_chemical_header`
--

CREATE TABLE `tb_chemical_header` (
  `chemical_header_id` bigint(20) NOT NULL,
  `cas_no` varchar(100) NOT NULL,
  `un_no` varchar(100) NOT NULL,
  `ec_number` varchar(100) DEFAULT NULL,
  `reach_number` varchar(100) DEFAULT NULL,
  `begin_of_pname` varchar(100) NOT NULL,
  `iupac_name` varchar(100) DEFAULT NULL,
  `commercial_name` varchar(100) DEFAULT NULL,
  `del_status` varchar(1) DEFAULT NULL,
  `first_language` int(11) DEFAULT NULL,
  `second_language` int(11) DEFAULT NULL,
  `other_infos` longtext,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_chemical_header`
--

INSERT INTO `tb_chemical_header` (`chemical_header_id`, `cas_no`, `un_no`, `ec_number`, `reach_number`, `begin_of_pname`, `iupac_name`, `commercial_name`, `del_status`, `first_language`, `second_language`, `other_infos`, `date_added`, `user_id`) VALUES
(49, '7553-56-2', '3495', '', '', 'Iodine', '', '', NULL, NULL, NULL, 'blablab', '2019-06-21 05:57:39', 6),
(50, '7697-37-2', '2031', NULL, '', 'Nitric Acid', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-16 09:09:10', 6),
(51, '106-97-8', '1969', NULL, '', 'n-Butane', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-16 09:09:15', 6),
(52, '123', '1234', NULL, '', 'test', NULL, NULL, 'X', NULL, NULL, NULL, '2019-06-03 05:03:16', 6),
(53, '12345', '1234', NULL, '', 'testtemp', NULL, NULL, 'X', NULL, NULL, NULL, '2019-06-03 06:32:22', 6),
(54, '109-89-7', '1154', NULL, '', 'Diethylamine', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-20 08:28:49', 8),
(55, '64-18-6', '1779', NULL, '', 'Formic Acid, 85%', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-16 09:09:29', 6),
(56, '108-94-1', '1915', NULL, '', 'Cyclohexanone', NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-06 03:01:21', 6),
(57, '540-69-2', '', NULL, '', 'Ammonium Formate', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-20 08:28:40', 7),
(60, '140-29-4', '2470', NULL, '', 'Benzyl Cyanide', '', '', NULL, NULL, NULL, NULL, '2019-05-16 09:09:39', 6),
(61, '18708', '', NULL, '', 'Anthranilic Acid', '', '', NULL, NULL, NULL, NULL, '2019-05-16 09:09:44', 6),
(62, '7664-93-9', '1830', NULL, '', 'Sulfuric Acid, ACS', '', '', NULL, NULL, NULL, NULL, '2019-06-06 03:10:17', 7),
(63, '60-29-7', '1155', NULL, '', 'Diethyl Ether', '', '', NULL, NULL, NULL, NULL, '2019-05-20 08:04:51', 7),
(64, '7722-64-7', '1490', NULL, '', 'Potassium Permanganate', '', '', NULL, NULL, NULL, NULL, '2019-05-16 09:09:54', 6),
(65, '7719-09-7', '1836', NULL, '', 'Thionyl  Chloride', '', '', NULL, NULL, NULL, NULL, '2019-05-16 09:08:46', 6),
(66, '7487-94-7', '1624', NULL, '', 'Mercuric Chloride', '', '', NULL, NULL, NULL, NULL, '2019-05-16 09:28:15', 8),
(76, '106-97-8', '1011', '21', '123', 'Butane -n', '2-chloroacetic acid', 'Nivek asdasd asd', NULL, NULL, NULL, 'qwerty', '2019-06-20 12:06:38', NULL),
(77, '123testcas', '123testun', '222', '1111', 'testname-bi-lang - updated', '', '', NULL, 14, 15, 'Test Update', '2019-07-11 09:23:25', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tb_chemical_properties`
--

CREATE TABLE `tb_chemical_properties` (
  `chemical_properties_id` bigint(20) NOT NULL,
  `state_of_matter` varchar(100) DEFAULT NULL,
  `density` varchar(100) DEFAULT NULL,
  `ph_value` varchar(100) DEFAULT NULL,
  `boiling_point` varchar(100) DEFAULT NULL,
  `melting_point` varchar(100) DEFAULT NULL,
  `flash_point` varchar(100) DEFAULT NULL,
  `refractive_index` varchar(100) DEFAULT NULL,
  `molecular_weight` varchar(100) DEFAULT NULL,
  `chemical_type` varchar(1) DEFAULT NULL,
  `other_properties` longtext,
  `chemical_header_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_chemical_properties`
--

INSERT INTO `tb_chemical_properties` (`chemical_properties_id`, `state_of_matter`, `density`, `ph_value`, `boiling_point`, `melting_point`, `flash_point`, `refractive_index`, `molecular_weight`, `chemical_type`, `other_properties`, `chemical_header_id`) VALUES
(39, '2', '4.93 g/cm³', '5.1 saturated solution', '184 °C', '113 °C', 'Not applicable', '', '253.81 g/mol', '3', NULL, 49),
(40, '3', '', '&lt; 1 at 20 °C', '100 °C at 1.013 hPa', 'no data available', 'no data available', '', '63,01 g/mol', '3', NULL, 50),
(41, '4', '0.573 g/cm³ (at 25 °C)', 'Not applicable', '-0.5 °C', '-138 °C', '-60 °C TCC', '', '58 g/mol', '3', NULL, 51),
(42, '3', '', '', '', '', '', '', '', '2', NULL, 52),
(43, '2', '', '', '', '', '', '', '', '1', NULL, 53),
(44, '3', '', '13 at 100 g/l at 20 °C', '55 °C', '-50 °C', '-22,99 °C - closed cup', '', '73,14', '3', NULL, 54),
(45, '3', '', 'Strong Acid', '100.8 °C', '8 °C', '42 °C', '', '', '2', NULL, 55),
(46, '3', '', 'No data available', '155 °C - lit.', '-47 °C - lit.', '44 °C - closed cup', '', '98,15 g/mol', '3', NULL, 56),
(47, '', '', '5.5 - 7.5 at 63.1 g/l at 25 °C', 'No data available', '119 - 121 °C', 'No data available', '', '63.06 g/mol', '3', NULL, 57),
(49, '3', '', '11.0 - 12.0 at 117.2 g/l at 25 °C', '233 - 234 °C - lit.', 'Melting point/range: 24 °C - lit', '102 °C - closed cup', '', '117.15 g/mol', '3', NULL, 60),
(50, '2', 'No Data', 'No Data', 'No Data', 'No Data', 'No Data', 'No Data', '', '', NULL, 61),
(51, '3', '', '&lt; 1', '288 °C', '10 °C', 'Not applicable', '', '98.08 g/mol', '3', NULL, 62),
(52, '3', '', 'No data available', '34,6 °C at 1.013 hPa', '-115,99 °C', '-39,99 °C - closed cup', '', '74,12 g/mol', '3', NULL, 63),
(53, '2', '2700 kg/m³', '7.0 - 8.5 (1.6 %)', 'Not applicable', 'Not applicable', 'Not applicable', '', '158.03 g/mol', '3', NULL, 64),
(54, '3', '', 'no data available', '79 °C-lit.', '-105 °C-lit.', 'not applicable', '', '118,97 g/mol', '3', NULL, 65),
(55, '3', '', '3.2 (1.5 %)', '302 °C', '277 °C', 'Not applicable', '', '271.49 g/mol', '3', NULL, 66),
(64, '3', '0.9598', '5.1 saturated solution', '', '-217.1', '-4', '123', '94.494', '3', 'sdxczzxc\r\nzxxc\r\nzxc', 76),
(65, '3', '0.9598', '?0.5', '125', '-138', '7', '1.358 - 1.359', '88.534', '2', 'Test update\r\ntest again', 77);

-- --------------------------------------------------------

--
-- Table structure for table `tb_companies`
--

CREATE TABLE `tb_companies` (
  `company_id` bigint(20) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_address1` varchar(100) NOT NULL,
  `company_zip_postal` varchar(32) NOT NULL,
  `company_tel_no` varchar(50) NOT NULL,
  `company_fax` varchar(50) NOT NULL,
  `company_email` varchar(80) NOT NULL,
  `homepage_link` varchar(100) NOT NULL,
  `company_logo` varchar(30) NOT NULL,
  `del_status` varchar(1) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_companies`
--

INSERT INTO `tb_companies` (`company_id`, `company_name`, `company_address1`, `company_zip_postal`, `company_tel_no`, `company_fax`, `company_email`, `homepage_link`, `company_logo`, `del_status`, `date_created`) VALUES
(1, 'Rimpido Pacific Inc.', 'Damosa I.T. Park J.P. Laurel Avenue, Lanang, Davao City, Philippines', '8000', '+63 (906) 874-55-66', '+63 (906) 874-55-66', 'contactus@rimpido.com', 'http://rimpidopacificinc.com/', 'protfolio-thumb-6.jpg', NULL, '2019-06-20 07:16:24'),
(6, 'Rimpido GmbH', 'Reiherstieg 40 21244 Buchholz i.d.N. (bei Hamburg)', '49076', '+49 (418) 113-86-45', '+49 (418) 113-86-45', 'info@rimpido.com', 'http://rimpido.com/en/index.html', 'rimpido-header.png', NULL, '2019-06-03 07:35:57');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ghs_label`
--

CREATE TABLE `tb_ghs_label` (
  `ghs_label_id` bigint(20) NOT NULL,
  `ghs_name` varchar(100) NOT NULL,
  `ghs_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_ghs_label_temp`
--

CREATE TABLE `tb_ghs_label_temp` (
  `ghs_label_temp_id` bigint(20) NOT NULL,
  `signal_word` varchar(1) NOT NULL,
  `ghs1` int(1) NOT NULL,
  `ghs2` int(1) NOT NULL,
  `ghs3` int(1) NOT NULL,
  `ghs4` int(1) NOT NULL,
  `ghs5` int(1) NOT NULL,
  `ghs6` int(1) NOT NULL,
  `ghs7` int(1) NOT NULL,
  `ghs8` int(1) NOT NULL,
  `ghs9` int(1) NOT NULL,
  `chemical_header_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ghs_label_temp`
--

INSERT INTO `tb_ghs_label_temp` (`ghs_label_temp_id`, `signal_word`, `ghs1`, `ghs2`, `ghs3`, `ghs4`, `ghs5`, `ghs6`, `ghs7`, `ghs8`, `ghs9`, `chemical_header_id`) VALUES
(28, 'D', 0, 0, 0, 0, 1, 1, 1, 0, 1, 49),
(29, 'D', 0, 0, 1, 0, 1, 0, 0, 0, 0, 50),
(30, 'D', 0, 1, 0, 1, 0, 0, 0, 0, 1, 51),
(31, 'D', 1, 1, 1, 1, 0, 0, 0, 0, 1, 52),
(32, 'D', 1, 0, 0, 1, 0, 0, 1, 0, 0, 53),
(33, 'D', 0, 1, 0, 0, 1, 1, 0, 0, 0, 54),
(34, 'D', 0, 0, 0, 0, 1, 0, 0, 0, 0, 55),
(35, 'D', 0, 1, 0, 0, 1, 0, 1, 0, 0, 56),
(36, 'W', 0, 0, 0, 0, 0, 0, 1, 0, 0, 57),
(37, 'D', 0, 0, 0, 0, 0, 1, 0, 0, 0, 60),
(38, 'W', 0, 0, 0, 0, 1, 0, 0, 0, 0, 61),
(39, 'W', 0, 0, 0, 0, 1, 0, 0, 0, 0, 62),
(40, 'D', 0, 1, 0, 0, 0, 0, 1, 0, 0, 63),
(41, 'W', 0, 0, 1, 0, 0, 0, 1, 0, 1, 64),
(42, 'D', 0, 0, 0, 0, 1, 1, 0, 0, 0, 65),
(43, 'D', 0, 0, 0, 0, 0, 1, 0, 1, 1, 66),
(52, 'D', 1, 1, 0, 1, 1, 0, 1, 1, 0, 76),
(53, 'W', 1, 1, 0, 0, 0, 0, 0, 0, 0, 77);

-- --------------------------------------------------------

--
-- Table structure for table `tb_h_phrases`
--

CREATE TABLE `tb_h_phrases` (
  `h_phrases_id` bigint(20) NOT NULL,
  `h_phrases_code` varchar(50) NOT NULL,
  `h_phrase_desc` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_h_phrases`
--

INSERT INTO `tb_h_phrases` (`h_phrases_id`, `h_phrases_code`, `h_phrase_desc`) VALUES
(1, 'H200', 'Unstable explosives.'),
(2, 'H201', 'Explosive; mass explosion hazard.'),
(3, 'H202', 'Explosive, severe projection hazard.'),
(4, 'H203', 'Explosive; fire, blast or projection hazard.'),
(5, 'H204', 'Fire or projection hazard.'),
(6, 'H205', 'May mass explode in fire.'),
(7, 'H220', 'Extremely flammable gas.'),
(8, 'H221', 'Flammable gas.'),
(9, 'H222', 'Extremely flammable aerosol.'),
(10, 'H223', 'Flammable aerosol.'),
(11, 'H224', 'Extremely flammable liquid and vapour.'),
(12, 'H225', 'Highly flammable liquid and vapour.'),
(13, 'H226', 'Flammable liquid and vapour.'),
(14, 'H228', 'Flammable solid.'),
(15, 'H240', 'Heating may cause an explosion.'),
(16, 'H241', 'Heating may cause a fire or explosion.'),
(17, 'H242', 'Heating may cause a fire.'),
(18, 'H250', 'Catches fire spontaneously if exposed to air.'),
(19, 'H251', 'Self-heating: may catch fire.'),
(20, 'H252', 'Self-heating in large quantities; may catch fire.'),
(21, 'H260', 'In contact with water releases flammable gases which may ignite spontaneously.'),
(22, 'H261', 'In contact with water releases flammable gas.'),
(23, 'H270', 'May cause or intensify fire; oxidizer.'),
(24, 'H271', 'May cause fire or explosion; strong oxidizer.'),
(25, 'H272', 'May intensify fire; oxidizer.'),
(26, 'H280', 'Contains gas under pressure; may explode if heated.'),
(27, 'H281', 'Contains refrigerated gas; may cause cryogenic burns or injury.'),
(28, 'H290', 'May be corrosive to metals.'),
(29, 'H300', 'Fatal if swallowed.'),
(30, 'H301', 'Toxic if swallowed.'),
(31, 'H302', 'Harmful if swallowed.'),
(32, 'H304', 'May be fatal if swallowed and enters airways.'),
(33, 'H310', 'Fatal in contact with skin.'),
(34, 'H311', 'Toxic in contact with skin.'),
(35, 'H312', 'Harmful in contact with skin.'),
(36, 'H314', 'Causes severe skin burns and eye damage.'),
(37, 'H315', 'Causes skin irritation.'),
(38, 'H317', 'May cause an allergic skin reaction.'),
(39, 'H318', 'Causes serious eye damage.'),
(40, 'H319', 'Causes serious eye irritation.');

-- --------------------------------------------------------

--
-- Table structure for table `tb_phrases`
--

CREATE TABLE `tb_phrases` (
  `phrases_id` bigint(20) NOT NULL,
  `hphrase1` varchar(30) DEFAULT NULL,
  `hphrase2` varchar(30) DEFAULT NULL,
  `hphrase3` varchar(30) DEFAULT NULL,
  `hphrase4` varchar(30) DEFAULT NULL,
  `hphrase5` varchar(30) DEFAULT NULL,
  `hphrase6` varchar(30) DEFAULT NULL,
  `pphrase1` varchar(30) DEFAULT NULL,
  `pphrase2` varchar(30) DEFAULT NULL,
  `pphrase3` varchar(30) DEFAULT NULL,
  `pphrase4` varchar(30) DEFAULT NULL,
  `pphrase5` varchar(30) DEFAULT NULL,
  `pphrase6` varchar(30) DEFAULT NULL,
  `pphrase_prev1` varchar(30) DEFAULT NULL,
  `pphrase_prev2` varchar(30) DEFAULT NULL,
  `pphrase_prev3` varchar(30) DEFAULT NULL,
  `pphrase_prev4` varchar(30) DEFAULT NULL,
  `pphrase_prev5` varchar(30) DEFAULT NULL,
  `pphrase_prev6` varchar(30) DEFAULT NULL,
  `pphrase_res1` varchar(30) DEFAULT NULL,
  `pphrase_res2` varchar(30) DEFAULT NULL,
  `pphrase_res3` varchar(30) DEFAULT NULL,
  `pphrase_res4` varchar(30) DEFAULT NULL,
  `pphrase_res5` varchar(30) DEFAULT NULL,
  `pphrase_res6` varchar(30) DEFAULT NULL,
  `pphrase_storage1` varchar(30) DEFAULT NULL,
  `pphrase_storage2` varchar(30) DEFAULT NULL,
  `pphrase_storage3` varchar(30) DEFAULT NULL,
  `pphrase_storage4` varchar(30) DEFAULT NULL,
  `pphrase_storage5` varchar(30) DEFAULT NULL,
  `pphrase_storage6` varchar(30) DEFAULT NULL,
  `pphrase_disp1` varchar(30) DEFAULT NULL,
  `pphrase_disp2` varchar(30) DEFAULT NULL,
  `pphrase_disp3` varchar(30) DEFAULT NULL,
  `pphrase_disp4` varchar(30) DEFAULT NULL,
  `pphrase_disp5` varchar(30) DEFAULT NULL,
  `pphrase_disp6` varchar(30) DEFAULT NULL,
  `chemical_header_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_phrases`
--

INSERT INTO `tb_phrases` (`phrases_id`, `hphrase1`, `hphrase2`, `hphrase3`, `hphrase4`, `hphrase5`, `hphrase6`, `pphrase1`, `pphrase2`, `pphrase3`, `pphrase4`, `pphrase5`, `pphrase6`, `pphrase_prev1`, `pphrase_prev2`, `pphrase_prev3`, `pphrase_prev4`, `pphrase_prev5`, `pphrase_prev6`, `pphrase_res1`, `pphrase_res2`, `pphrase_res3`, `pphrase_res4`, `pphrase_res5`, `pphrase_res6`, `pphrase_storage1`, `pphrase_storage2`, `pphrase_storage3`, `pphrase_storage4`, `pphrase_storage5`, `pphrase_storage6`, `pphrase_disp1`, `pphrase_disp2`, `pphrase_disp3`, `pphrase_disp4`, `pphrase_disp5`, `pphrase_disp6`, `chemical_header_id`) VALUES
(5, 'H311', 'H314', 'H317', 'H332', 'H400', '', 'P260', 'P264', 'P271', 'P272', 'P273', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 49),
(6, 'H272', 'H314', '', '', '', '', 'P220', 'P280', 'P305 + P351 + P338', 'P310', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 50),
(7, 'H220', 'H280', '', '', '', '', 'P202', 'P210', 'P271+P403', 'P377', 'P381', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 51),
(8, 'H202', 'H203', 'H205', 'H220', 'H221', '', 'P103', 'P201', 'P210', 'P210.1', 'P211', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 52),
(10, 'H225', 'H302+H332', 'H311', 'H314', '', '', 'P210', 'P280', 'P303 + P361 + P353', 'P304 + P340', 'P305 + P351 + P338', 'P370 + P378', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 54),
(11, 'H314', '', '', '', '', '', 'P260', 'P264', 'P280', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 55),
(12, 'H226', 'H302+H312+H332', 'H315', 'H318', '', '', 'P280', 'P305 + P351 + P338', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 56),
(13, 'H315', 'H319', 'H335', '', '', '', 'P261', 'P305 + P351 + P338', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 57),
(14, 'H301+H311', 'H330', NULL, NULL, NULL, NULL, 'P260', 'P280', 'P284', 'P301 + P310', 'P310', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 60),
(15, 'H318', NULL, NULL, NULL, NULL, NULL, 'P280', 'P305 + P351 + P338', 'P310', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61),
(16, 'H314', NULL, NULL, NULL, NULL, NULL, 'P260', 'P264', 'P280', 'P301 + P330 + P331', 'P303 + P361 + P353', 'P304 + P340', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 62),
(17, 'H224', 'H302', 'H336', NULL, NULL, NULL, 'P210', 'P261', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63),
(18, 'H272', 'H302', 'H410', NULL, NULL, NULL, 'P210', 'P220', 'P221', 'P264', 'P270', 'P273', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 64),
(19, 'H302', 'H314', 'H331', NULL, NULL, NULL, 'P261', 'P280', 'P305 + P351 + P338', 'P310', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 65),
(20, 'H300+H310', 'H351', 'H351.1', 'H361', 'H373', 'H410', 'P201', 'P202', 'P260', 'P262', 'P264', 'P270', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66),
(29, NULL, 'H202', 'H204', 'H220', 'H221', 'H223', NULL, 'P202', 'P210', 'P211', NULL, NULL, NULL, 'P201', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P210', NULL, NULL, NULL, NULL, NULL, 'P210', NULL, NULL, NULL, NULL, 76),
(30, NULL, 'H204', 'H220', NULL, NULL, NULL, NULL, 'P201', 'P210.1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 77);

-- --------------------------------------------------------

--
-- Table structure for table `tb_p_phrases`
--

CREATE TABLE `tb_p_phrases` (
  `p_phrases_id` bigint(20) NOT NULL,
  `p_phrases_code` varchar(50) NOT NULL,
  `p_phrases_desc` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `role_id` bigint(20) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `role_desc` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`role_id`, `role_name`, `role_desc`) VALUES
(1, 'Registered User', NULL),
(2, 'Admin - Company', NULL),
(3, 'Admin - Internal', NULL),
(4, 'Master Admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_usergroup`
--

CREATE TABLE `tb_usergroup` (
  `usergroup_id` bigint(20) NOT NULL,
  `usergroup_name` varchar(255) NOT NULL,
  `usergroup_desc` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_usergroup`
--

INSERT INTO `tb_usergroup` (`usergroup_id`, `usergroup_name`, `usergroup_desc`) VALUES
(1, 'Level 1 Authorization', 'Read, Print and Download - ( Chemicals, Company User, Certificates, Label )'),
(2, 'Level 2 Authorization', 'Add, Read, Print and Download - ( Chemicals, Company User, Certificates, Label )'),
(3, 'Level 3 Authorization', 'Add, Read, Update Print and Download - ( Chemicals, Company User, Certificates, Label )'),
(4, 'Level 4 Authorization', 'Add, Read, Update, Delete Print and Download - ( Chemicals, Company User, Certificates, Label )'),
(5, 'Level 5 Authorization', 'Internal User - (Master Admin or Admin)');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `user_id` bigint(20) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `m_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `birthdate` date NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `address3` varchar(100) NOT NULL,
  `sex` int(1) NOT NULL,
  `phone_no` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_pic` varchar(150) DEFAULT NULL,
  `del_status` varchar(1) DEFAULT NULL,
  `company_id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `usergroup_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`user_id`, `f_name`, `m_name`, `l_name`, `birthdate`, `address1`, `address2`, `address3`, `sex`, `phone_no`, `email`, `username`, `password`, `profile_pic`, `del_status`, `company_id`, `role_id`, `usergroup_id`) VALUES
(6, 'Kevin', 'Andres', 'Mendi', '1996-09-20', 'Agdao', 'Davao City', 'Davao del Sur', 1, '09293598343', 'kevin.mendi@rimpido.asia', 'kevin.mendi', '$2y$12$CebyKNuGr45LNypH0cO8oeBImy.gYCY0/cr8jLBFp4HWmnI/7qQ0K', 'avatar-1606916_960_720.png', NULL, 1, 4, 5),
(7, 'Nivek', 'Andres', 'Indem', '2000-08-09', 'Agdao', 'davao City', '', 1, '09770592864', 'nick.idnem@gmail.com', 'nivek.idnem', '$2y$12$WtHW6Lca1nzh5nRTVcJwz.CewW9qo4XZHvGzYoIIvl3r/VSDmhANW', 'male-avatar-maker.jpg', NULL, 6, 1, 1),
(8, 'Jan', 'S', 'Shuur', '1990-05-01', 'Germany', '', '', 1, '', 'shuur@rimpido.asia', 'jan.shuur', '$2y$12$eqSgfgBWp1dg4us5sz04OOp45AV7CzTGQn/lNS1Pl4a2yqvl8s8a.', NULL, NULL, 6, 4, 5),
(9, 'Jessamine', 'Sinet', 'Cena', '1999-10-17', '', '', '', 0, '', 'jessamine.cena@rimpido.asia', 'jess.cena', '$2y$12$uXYgvqD/Ou.Y32dAqdO.f.aIhO2Rm3PvLWSaqiVbekQWwb6XmU20C', NULL, NULL, 1, 3, 5),
(12, 'Gian', 'R', 'Pescadero', '1995-01-01', '', '', '', 1, '', 'gian@gmail.com', 'gian.pescadero', '$2y$12$hhJHduejSU7TTm0qRiJY2uOPCBdirc9Y40mxIdQ5496htzUMWr96G', 'Asta.jpg', NULL, 1, 1, 1),
(13, 'Zedda', 'Lustre', 'Schuur', '1993-01-01', 'Guadalupe', 'Davao City', '', 0, '', 'zedda.lustre@rimpido.com', 'zedda.lustre', '$2y$12$H32ndZ/vpIP9G04D3Fvvt.ThOvsollxKyEhCafV9GvhWFPzdlYqv2', 'download.jpg', NULL, 1, 2, 4),
(14, 'Test name', 'test middle name', 'sdfsd', '1909-10-16', '', '', '', 1, '', 'hjk@g.com', 'test', '$2y$12$ORD3/SCBi4gzJg/RtPvd6e.9b/fYIMNRsYb5EgRQN1ZmkIy2fG.NK', NULL, NULL, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_role`
--

CREATE TABLE `tb_user_role` (
  `user_role_id` bigint(20) NOT NULL,
  `role_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user_role`
--

INSERT INTO `tb_user_role` (`user_role_id`, `role_desc`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'External User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_battery_cert`
--
ALTER TABLE `tb_battery_cert`
  ADD PRIMARY KEY (`battery_cert_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_chemical_ghs`
--
ALTER TABLE `tb_chemical_ghs`
  ADD PRIMARY KEY (`chemical_ghs_id`),
  ADD KEY `chemical_header_id` (`chemical_header_id`),
  ADD KEY `ghs_label_id` (`ghs_label_id`);

--
-- Indexes for table `tb_chemical_header`
--
ALTER TABLE `tb_chemical_header`
  ADD PRIMARY KEY (`chemical_header_id`),
  ADD KEY `company_id` (`user_id`);

--
-- Indexes for table `tb_chemical_properties`
--
ALTER TABLE `tb_chemical_properties`
  ADD PRIMARY KEY (`chemical_properties_id`),
  ADD KEY `chemical_header_id` (`chemical_header_id`);

--
-- Indexes for table `tb_companies`
--
ALTER TABLE `tb_companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `tb_ghs_label`
--
ALTER TABLE `tb_ghs_label`
  ADD PRIMARY KEY (`ghs_label_id`);

--
-- Indexes for table `tb_ghs_label_temp`
--
ALTER TABLE `tb_ghs_label_temp`
  ADD PRIMARY KEY (`ghs_label_temp_id`),
  ADD KEY `chemical_header_id` (`chemical_header_id`);

--
-- Indexes for table `tb_h_phrases`
--
ALTER TABLE `tb_h_phrases`
  ADD PRIMARY KEY (`h_phrases_id`);

--
-- Indexes for table `tb_phrases`
--
ALTER TABLE `tb_phrases`
  ADD PRIMARY KEY (`phrases_id`),
  ADD KEY `chemical_header_id` (`chemical_header_id`);

--
-- Indexes for table `tb_p_phrases`
--
ALTER TABLE `tb_p_phrases`
  ADD PRIMARY KEY (`p_phrases_id`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tb_usergroup`
--
ALTER TABLE `tb_usergroup`
  ADD PRIMARY KEY (`usergroup_id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `user_role_id` (`role_id`),
  ADD KEY `user_group_id` (`usergroup_id`);

--
-- Indexes for table `tb_user_role`
--
ALTER TABLE `tb_user_role`
  ADD PRIMARY KEY (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_battery_cert`
--
ALTER TABLE `tb_battery_cert`
  MODIFY `battery_cert_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_chemical_ghs`
--
ALTER TABLE `tb_chemical_ghs`
  MODIFY `chemical_ghs_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_chemical_header`
--
ALTER TABLE `tb_chemical_header`
  MODIFY `chemical_header_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `tb_chemical_properties`
--
ALTER TABLE `tb_chemical_properties`
  MODIFY `chemical_properties_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `tb_companies`
--
ALTER TABLE `tb_companies`
  MODIFY `company_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_ghs_label`
--
ALTER TABLE `tb_ghs_label`
  MODIFY `ghs_label_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_ghs_label_temp`
--
ALTER TABLE `tb_ghs_label_temp`
  MODIFY `ghs_label_temp_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `tb_h_phrases`
--
ALTER TABLE `tb_h_phrases`
  MODIFY `h_phrases_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `tb_phrases`
--
ALTER TABLE `tb_phrases`
  MODIFY `phrases_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `role_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_usergroup`
--
ALTER TABLE `tb_usergroup`
  MODIFY `usergroup_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tb_user_role`
--
ALTER TABLE `tb_user_role`
  MODIFY `user_role_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
