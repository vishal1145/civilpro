-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 20, 2018 at 06:28 PM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 7.0.32-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `civil_pro`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `user_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `client_id` varchar(128) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `company` varchar(128) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `address` varchar(300) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `state` varchar(300) NOT NULL,
  `country` varchar(300) NOT NULL,
  `pincode` varchar(300) NOT NULL,
  `time_set` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `img`, `first_name`, `last_name`, `user_name`, `email`, `password`, `client_id`, `phone_no`, `company`, `birthday`, `address`, `gender`, `state`, `country`, `pincode`, `time_set`) VALUES
(44, 'Tulips_1532342966.jpg', 'Johnnn1234', 'Velliam', 'johnvelliam', 'john@velliam.com', '123456', 'john1234', '214748364', 'John Web Tech', '', 'xyzz', 'Female', 'Punjabb', 'India', '160071', ''),
(52, 'Tulips_1532344055.jpg', 'smith', 'client', 'johnvelliam', 'john@velliam.com', '123456', 'john123', '2147483647', 'John Web Tech', '', 'xyz', 'Male', 'Punjab', 'India', '160071', ''),
(53, 'Ariel-Lin-Cheng-You-Qing-in-time-with-you-32332870-375-500_1532348649.jpg', 'Xianminn123', 'Ji', 'xianmin', 'xianmin@gmail.com', 'wonjinsu425', 'xianmin123', '143245125', 'World Mobile', '', 'dasas', 'Female', 'dtyhgf', 'gfhg', 'ghgh', ''),
(57, 'SampleJPGImage_500kbmb_1533722394.jpg', 'testingclient', 'lastname', 'testclient', 'testclient@gmail.com', '123456', '001', '2147483647', 'testingcompany', '', 'mohali', 'Male', 'punjab', 'mohali', '160059', ''),
(58, '', 'kane', 'williamson', 'kanwilliamson', 'kanwilliamson@gmail.com', '123456', '4567', '123456789', 'penguin', '', '', '', '', '', '', ''),
(61, '', 'lasith', 'malinga', 'lasith', 'lasith3678@gmail.com', '123456', 'la542', '123456789', 'sew', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(300) NOT NULL,
  `contact_person` varchar(300) NOT NULL,
  `address` varchar(300) NOT NULL,
  `country` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `state/province` varchar(250) NOT NULL,
  `postalcode` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `phone_number` varchar(300) NOT NULL,
  `mobile_number` varchar(300) NOT NULL,
  `fax` varchar(300) NOT NULL,
  `website_url` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(256) NOT NULL,
  `time_set` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `time_set`) VALUES
(8, 'Department1', ''),
(9, 'Department2', ''),
(10, 'Design', ''),
(11, 'part111', '');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designation_id` int(11) NOT NULL,
  `designation_name` varchar(256) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `time_set` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `designation_name`, `department_name`, `time_set`) VALUES
(23, 'H.R', '8', ''),
(24, 'md', '8', ''),
(25, 'graphic', '10', ''),
(26, 'seo', '9', '1539694523');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `empl_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_pass` varchar(255) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `joining_date` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `device_id` varchar(255) NOT NULL,
  `device_type` varchar(255) NOT NULL,
  `time_set` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`empl_id`, `first_name`, `last_name`, `username`, `email`, `password`, `confirm_pass`, `employee_id`, `joining_date`, `phone`, `img`, `company`, `designation`, `device_id`, `device_type`, `time_set`) VALUES
(50, 'testtt', 'dfgdft', 'admin', 'test@gmail.com', '202cb962ac59075b964b07152d234b70', 'md5(123)', '587', '2018-10-02', '4567455454', '', 'Delta Infotech', '24', '', '', ''),
(82, 'john', 'snow', 'jhonsnow', 'jhonsnow@gmail.com', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70', '345', '2018-10-02', '98721002001', '', '1', '24', '', '', ''),
(83, 'tony', 'stark', 'tonystark', 'tonystark@gmail.com', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70', '846', '2018-09-30', '123456789', '', '1', '24', '', '', ''),
(84, 'mark', 'wood`', 'markwood', 'markwood@gmail.com', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70', '854', '2018-09-30', '1234567890', '', 'Delta Infotech', '25', '', '', ''),
(105, 'rock', 'dfgdft', 'admin', 'test@gmail.com', 'd9b1d7db4cd6e70935368a1efb10e377', '4066cf069e81c1fb442b9b8e47e95ee1', '587', '2018-10-02', '4567455454', '', 'Delta Infotech', '24', '', '', ''),
(111, 'smith ', 'jonson', 'smithjonson', 'smithjonson@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b', '45', '2018-10-25', '4567455454', '', 'Delta Infotech', '23', '', '', ''),
(112, 'james', 'billing', 'jamesbilling', 'jamesbilling@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b', '80', '2018-10-25', '4567455454', '', 'Delta Infotech', '24', '123456', 'iOS', ''),
(113, 'Shaun', 'Pollock', 'shaunpollock', 'shaunpollock@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b', '120', '2018-11-09', '123456789', '', 'Delta Infotech', '25', '', '', ''),
(114, 'ben', 'stokes', 'benstokes', 'benstokes@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b', '437', '2018-11-02', '123456789', '', 'Delta Infotech', '24', '', '', ''),
(115, 'mitchel', 'jonson', 'mitcheljonson', 'jonson@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '0', '', '012356456789', '', '42', '157', '1', 'abc', ''),
(117, 'sdrt', 'a1', 'Aone', 'Aone@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '202cb962ac59075b964b07152d234b70', '8443', '2018-09-30', '4567455454', '', 'Delta Infotech', '24', '', '', ''),
(118, 'jarvis', 'gawain', 'jarvis', 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '202cb962ac59075b964b07152d234b70', '2347', '2018-10-02', '4567455454', '', '1', '25', '', '', ''),
(119, 'gawen', 'tenison', 'gawentenison', 'gawen@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '202cb962ac59075b964b07152d234b70', '45645', '08/10/2018', '4567455454', '', '1', '23', '', '', ''),
(120, 'aa', 'aa', 'gurmeet', 'gurmeet@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b', '123', '2018-10-11', '12345645546', '', '1', '24', '', '', ''),
(122, 'james', 'seth', 'jamesseth', 'jamesseth@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b', '832', '2018-10-24', '123456789', '', 'Delta Infotech', '25', '', '', ''),
(123, 'rose', 'tayler', 'rosetayler', 'rosetayler@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b', '943', '2018-10-18', '123456789', '', 'Delta Infotech', '23', '', '', ''),
(124, 'graeme', 'smith', 'graemesmith', 'graemesmith@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b', '354', '2018-10-18', '123456789', '', 'Delta Infotech', '25', '', '', ''),
(126, 'martine', 'guptill', 'martineguptill', 'martineguptill@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b', '688', '2018-10-24', '123456789', '', '1', '25', '', '', ''),
(127, 'mitchel', 'jonson', 'mitcheljonson', 'mitcheljonson34@gmail.com', '42dae262b8531b3df48cde9cc018c512', '827ccb0eea8a706c4c34a16891f84e7b', '546', '2018-10-18', '123456789', '', '1', '24', '', '', ''),
(128, 'mitchel', 'johnson', 'mitcheljonson', 'mitcheljonson682@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b', '854', '2018-10-25', '4567455454343', '', '1', '23', '', '', ''),
(129, 'deepak', 'sharma', 'deepak', 'deepak@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '1', '2018-10-15', '2356898596', '', '1', '23', '', '', ''),
(130, 'Ion', 'Ciobanu', 'ion123', 'ion123@gmail.com', '34c4250bb605d93f25e8df0c246caf99', '34c4250bb605d93f25e8df0c246caf99', '1234', '2018-10-15', '235689859634343', '', '1', '25', '123456', 'iOS', ''),
(131, 'hellopay', 'test', 'hellopay', 'hellopay@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '4578', '2018-10-15', '2356898596', '', '1', '23', '', '', ''),
(132, 'testtt', 'a1', 'testta1', 'testa1233@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b', 'test1233', '2018-10-24', '67568459847855654', '', '1', '25', '', '', ''),
(139, 'Vivek', 'malani', 'vivekmalani', 'vivek3693@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '1102', '2018-10-15', '9737079628', '', 'Global Technologies', '23', '123456', 'iOS', ''),
(140, 'tester12', 'tester12', 'tester', 'testt3453@gmail.com', '58b1216b06850385d9a4eadbedc806c4', '58b1216b06850385d9a4eadbedc806c4', 'fgfgf4544', '2018-10-18', '123456789', '', 'Delta Infotech', '25', '', '', '1539692426'),
(141, 'tester', 'testing', 'test33', 'test5654@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '202cb962ac59075b964b07152d234b70', 'awe234', '2018-10-19', '4567455454', '', '1', '24', '', '', '1539693378'),
(142, 'joe', 'root', 'joeroot', 'joeroot687@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b', 'joe543', '2018-10-19', '123456789', '', 'Delta Infotech', '25', '', '', '1539697039'),
(143, 'yuan', 'zhenxiu', 'yuan123', 'yuan123@gmail.com', '34c4250bb605d93f25e8df0c246caf99', '34c4250bb605d93f25e8df0c246caf99', '334', '2018-10-16', '12412541235612351', '', '1', '26', '', '', '1539709814'),
(144, 'Travis ', 'Redekop', 'Travis', 'travis@silverstoneexcavating.com', 'cd50b4634dee7c29031904e8284e9cdb', 'cd50b4634dee7c29031904e8284e9cdb', '001', '2018-10-16', '6043028855', '', 'Global Technologies', '26', '123456', 'iOS', '1539711820');

-- --------------------------------------------------------

--
-- Table structure for table `excavator`
--

CREATE TABLE `excavator` (
  `excavator_id` int(11) NOT NULL,
  `operator` varchar(255) NOT NULL,
  `site_area` varchar(250) NOT NULL,
  `hour_start` varchar(250) NOT NULL,
  `hour_finish` varchar(250) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fuel_lavel` varchar(250) NOT NULL,
  `engine_oil_lavel` varchar(250) NOT NULL,
  `oil_lavel` varchar(250) NOT NULL,
  `radiator_lavel` varchar(250) NOT NULL,
  `transmission_lavel` varchar(250) NOT NULL,
  `fluids_leak` varchar(250) NOT NULL,
  `fluid_level_comment` varchar(250) NOT NULL,
  `air_conditioning` varchar(250) NOT NULL,
  `bucket_teeth_pins` varchar(250) NOT NULL,
  `cleaning_products` varchar(250) NOT NULL,
  `damage_report` varchar(250) NOT NULL,
  `fire_extinguisher` varchar(250) NOT NULL,
  `first_aid_kit` varchar(250) NOT NULL,
  `general_defects` varchar(250) NOT NULL,
  `grease_lines_pins` varchar(250) NOT NULL,
  `hand_rails_door_handles` varchar(250) NOT NULL,
  `horn` varchar(250) NOT NULL,
  `hydraulic_hoses` varchar(250) NOT NULL,
  `lights` varchar(250) NOT NULL,
  `mirrors` varchar(250) NOT NULL,
  `panel_damage` varchar(250) NOT NULL,
  `radiator` varchar(250) NOT NULL,
  `radiator_hoses` varchar(250) NOT NULL,
  `seat_seatbelts` varchar(250) NOT NULL,
  `slew_motor_oil` varchar(250) NOT NULL,
  `tracks_chains_shoes` varchar(250) NOT NULL,
  `windows_wipers` varchar(250) NOT NULL,
  `additional_notes` varchar(250) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `excavator`
--

INSERT INTO `excavator` (`excavator_id`, `operator`, `site_area`, `hour_start`, `hour_finish`, `date`, `fuel_lavel`, `engine_oil_lavel`, `oil_lavel`, `radiator_lavel`, `transmission_lavel`, `fluids_leak`, `fluid_level_comment`, `air_conditioning`, `bucket_teeth_pins`, `cleaning_products`, `damage_report`, `fire_extinguisher`, `first_aid_kit`, `general_defects`, `grease_lines_pins`, `hand_rails_door_handles`, `horn`, `hydraulic_hoses`, `lights`, `mirrors`, `panel_damage`, `radiator`, `radiator_hoses`, `seat_seatbelts`, `slew_motor_oil`, `tracks_chains_shoes`, `windows_wipers`, `additional_notes`, `image`) VALUES
(1, 'hello', 'fghfgh', '4465', '456456', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 'fghfdhdf', 'fhjfjhj', '67567', '567567', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(10, 'ryre', 'fhgfgh', 'f5656', '5645', '2018-08-31 17:25:23', 'pass', 'fail', 'fail', 'fail', 'pass', 'pass', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(11, 'fgghh', 'hghd', 'ghdh', 'gfhdhggh', '2018-08-31 17:47:02', 'pass', 'fail', 'fail', 'fail', 'pass', 'pass', 'test here', 'fail', 'fail', 'fail', 'fail', '', '', 'pass', 'pass', '', 'fail', 'fail', 'fail', 'pass', 'pass', 'pass', 'pass', 'fail', 'fail', 'fail', 'fail', 'testing here', ''),
(12, 'Operator', 'Area', '345', '3453', '2018-08-31 17:57:57', 'pass', 'pass', 'pass', 'pass', 'pass', 'pass', '', 'fail', 'fail', 'fail', 'fail', '', '', 'fail', 'fail', '', 'fail', 'pass', 'pass', 'pass', 'pass', 'pass', 'pass', 'pass', 'pass', '', 'pass', 'testing', ''),
(13, 'test', 'test', 'test', 'tset', '2018-08-31 18:03:47', 'pass', 'fail', 'pass', 'fail', 'pass', 'fail', 'fghfghfg', 'fail', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'vbnfghgfhfgh', ''),
(22, 'Operator', 'Area', 'Hour Start', 'Hour Finish', '2018-08-31 18:24:46', 'pass', 'fail', 'pass', 'fail', 'pass', 'fail', 'trststtdtdtdfd', 'fail', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'gjghjghjghjghjgh', ''),
(23, 'test', 'test', 'test', 'test', '2018-08-31 18:26:39', 'pass', 'fail', 'pass', 'fail', 'pass', 'fail', 'tsets test tsetstest', 'fail', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'test tstete test', ''),
(24, 'test', 'test', 'test', 'test', '2018-08-31 18:49:25', 'pass', 'fail', 'pass', 'fail', 'pass', 'fail', 'tsets test tsetstest', 'fail', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'test tstete test', ''),
(25, 'test', 'test', 'test', 'test', '2018-08-31 18:51:01', 'pass', 'fail', 'pass', 'fail', 'pass', 'fail', 'tsets test tsetstest', 'fail', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'test tstete test', ''),
(26, 'test', 'test', 'test', 'test', '2018-08-31 18:51:04', 'pass', 'fail', 'pass', 'fail', 'pass', 'fail', 'tsets test tsetstest', 'fail', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'test tstete test', ''),
(27, 'dfg dfghttp\r\n.phpsdfgsdfg', 'dfgdsfgdfg', 'sdfgsdfgsdfgd', 'dfgdsfgdsfgdfg', '2018-08-31 19:02:00', 'pass', 'fail', 'pass', 'fail', 'pass', 'fail', 'dfsgdfg dfsgdf g', 'fail', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'fdgdfgdsfgdsfgsdfgsdf dfgdfg', ''),
(28, 'fdhdfg', 'dfgd', 'dfg', 'dfgd', '2018-08-31 19:02:19', 'pass', 'fail', 'pass', 'fail', 'pass', 'fail', 'dsfgdfg', 'fail', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'fghfghdfh', ''),
(29, 'fghf', 'fgh', 'fgh', 'fgh', '2018-08-31 19:02:46', 'pass', 'fail', 'pass', 'fail', 'pass', 'fail', 'fghfgh', 'fail', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'fghfghfghh gh dfhfh', ''),
(30, 'test', 'test1', '10', '12', '2018-09-03 20:33:28', 'pass', 'fail', 'pass', 'fail', 'pass', 'fail', 'test', 'fail', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'test', ''),
(31, 'dfhdfgdfgdfg', 'dffgdgdg', '810', '7', '2018-09-04 13:19:07', 'pass', 'pass', 'pass', 'pass', 'pass', 'pass', 'fgdgsdgdg', 'fail', 'fail', 'fail', 'fail', 'fail', 'fail', 'fail', 'fail', 'pass', 'pass', 'pass', 'pass', 'pass', 'pass', 'pass', 'fail', 'fail', 'fail', 'fail', 'fail', 'dfgdgdfgdfgdfgdfg', ''),
(43, 'hfghfgh', 'gjgjgj', '0708', '0710', '2018-09-05 13:04:27', 'pass', 'pass', 'pass', 'pass', 'pass', 'pass', 'kuikuiku kui', 'fail', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'kukiuikiuik', ''),
(44, 'hfghfgh', 'gjgjgj', '07:08', '07:10', '2018-09-05 13:05:23', 'pass', 'pass', 'pass', 'pass', 'pass', 'pass', 'kuikuiku kui', 'fail', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'fail', 'pass', 'pass', 'fail', 'pass', 'fail', 'pass', 'pass', 'kukiuikiuik', ''),
(45, 'eweb', 'test12', '12', '5', '2018-08-15 00:00:00', '0', '1', '0', '', '', '', '', '0', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'fghfg dfgfdhfg  fghfghfgh ryrtyry  ryrthfgfh', ''),
(46, 'eweb', 'test12', '12', '5', '2018-08-15 00:00:00', '0', '1', '0', '', '', '', '', '0', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'fghfg dfgfdhfg  fghfghfgh ryrtyry  ryrthfgfh', ''),
(47, 'eweb', 'test12', '12', '5', '2018-08-15 00:00:00', '0', '1', '0', '', '', '', '', '0', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'fghfg dfgfdhfg  fghfghfgh ryrtyry  ryrthfgfh', ''),
(48, 'eweb', 'test12', '12', '5', '2018-08-15 00:00:00', 'true', 'false', 'false', '', '', '', '', 'false', 'true', 'true', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'fghfg dfgfdhfg  fghfghfgh ryrtyry  ryrthfgfh', ''),
(49, 'eweb', 'test12', '12', '5', '2018-08-15 00:00:00', 'true', 'false', 'false', '', '', '', '', 'false', 'true', 'true', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'fghfg dfgfdhfg  fghfghfgh ryrtyry  ryrthfgfh', ''),
(50, 'eweb', 'test12', '12', '5', '2018-08-15 00:00:00', 'true', 'false', 'false', '', '', '', '', 'false', 'true', 'true', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'fghfg dfgfdhfg  fghfghfgh ryrtyry  ryrthfgfh', ''),
(51, 'eweb', 'test12', '12', '5', '2018-08-15 00:00:00', 'true', 'false', 'false', '', '', '', '', 'false', 'true', 'true', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'fghfg dfgfdhfg  fghfghfgh ryrtyry  ryrthfgfh', ''),
(52, 'yey it', 'mohali', '5', '8', '2018-06-05 00:00:00', 'false', 'false', 'true', 'true', 'false', 'false', 'true', 'true', 'true', '', 'false', 'true', 'true', 'true', 'false', '', 'false', 'true', 'false', 'false', 'true', 'false', 'true', 'true', 'false', 'true', 'false', 'true', ''),
(53, 'yey it', 'mohali', '5', '8', '2018-06-05 00:00:00', 'false', 'false', 'true', 'true', 'false', 'false', 'true', 'true', 'true', '', 'false', 'true', 'true', 'true', 'false', '', 'false', 'true', 'false', 'false', 'true', 'false', 'true', 'true', 'false', 'true', 'false', 'true', ''),
(54, 'yey it', 'mohali', '5', '8', '2018-06-05 00:00:00', 'false', 'false', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'false', '', 'false', 'true', 'false', 'false', 'true', 'false', 'true', 'true', 'false', 'true', 'false', 'true', ''),
(55, 'yey it', 'mohali', '5', '8', '2018-06-05 00:00:00', 'false', 'false', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'false', '', 'false', 'true', 'false', 'false', 'true', 'false', 'true', 'true', 'false', 'true', 'false', 'true', ''),
(56, 'yey it', 'mohali', '5', '8', '2018-06-05 00:00:00', 'false', 'false', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'false', '', 'false', 'true', 'false', 'false', 'true', 'false', 'true', 'true', 'false', 'true', 'false', 'true', ''),
(57, 'yey it', 'mohali', '5', '8', '2018-06-05 00:00:00', 'false', 'false', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'false', '', 'false', 'true', 'false', 'false', 'true', 'false', 'true', 'true', 'false', 'true', 'false', 'true', ''),
(58, 'yey it', 'mohali', '5', '8', '2018-06-05 00:00:00', 'false', 'false', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'false', '', 'false', 'true', 'false', 'false', 'true', 'false', 'true', 'true', 'false', 'true', 'false', 'true', 'tent-hire-1.jpg'),
(59, 'yey it', 'mohali', '5', '8', '2018-06-05 00:00:00', 'false', 'false', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'false', '', 'false', 'true', 'false', 'false', 'true', 'false', 'true', 'true', 'false', 'true', 'false', 'true', 'tent-hire-1.jpg'),
(60, 'yey it', 'mohali', '5', '8', '2018-06-05 00:00:00', 'false', 'false', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'false', '', 'false', 'true', 'false', 'false', 'true', 'false', 'true', 'true', 'false', 'true', 'false', 'true', 'tent-hire-1.jpg'),
(61, 'yey it', 'mohali', '5', '8', '2018-06-05 00:00:00', 'false', 'false', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'false', '', 'false', 'true', 'false', 'false', 'true', 'false', 'true', 'true', 'false', 'true', 'false', 'true', 'event2.png'),
(62, 'yey it', 'mohali', '5', '8', '2018-06-05 00:00:00', 'false', 'false', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'false', '', 'false', 'true', 'false', 'false', 'true', 'false', 'true', 'true', 'false', 'true', 'false', 'true', 'event2.png'),
(63, 'dads', 'dads', '10', '20', '2018-10-10 00:00:00', 'true', 'true', 'true', 'true', 'true', 'true', 'abc', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', '', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'dads dad', '560864461.172264.png'),
(64, 'bgdfg', 'bfdghj', '10', '20', '2018-10-11 00:00:00', 'true', 'true', 'true', 'true', 'true', 'true', 'abc', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', '', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'fhsghh', '560939345.900928.png'),
(65, 'Vivek', 'Vivek', '10', '20', '2018-10-15 00:00:00', 'true', 'true', 'true', 'true', 'true', 'true', 'abc', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', '', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'dsdsdsds', '561307676.62877.png'),
(66, 'ion', 'ionasdfsdf', '20', '50', '2018-10-16 00:00:00', 'false', 'false', 'false', 'false', 'false', 'false', 'abc', 'true', 'true', 'true', 'false', 'true', 'true', 'false', 'true', '', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'false', 'true', 'false', 'true', 'falskdjglkasdjlgkajsdlkgjasd', '561369309.737048.png'),
(67, 'aaaa', 'bbbb', '123', '400', '2018-10-19 00:00:00', 'true', 'true', 'true', 'true', 'true', 'true', 'abc', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', '', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'gdsdgsdg', '561698144.915369.png');

-- --------------------------------------------------------

--
-- Table structure for table `field_report`
--

CREATE TABLE `field_report` (
  `id` int(11) NOT NULL,
  `employe_id` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `project` varchar(100) NOT NULL,
  `delay` varchar(100) NOT NULL,
  `scope_work` varchar(100) NOT NULL,
  `picture` text NOT NULL,
  `time_set` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `field_report`
--

INSERT INTO `field_report` (`id`, `employe_id`, `date`, `project`, `delay`, `scope_work`, `picture`, `time_set`) VALUES
(9, '82', '2018-10-03', '5656', '456', 'dfgsdg', 'sdfgsdg', ''),
(10, '83', '2018-10-08', '5656', '456', 'dfgsdg', 'sdfgsdg', ''),
(11, '50', '2018-10-25', '5656', '456', 'dfgsdg', 'sdfgsdg', ''),
(12, '82', '2018-10-15', '5656', '456', 'dfgsdg', 'sdfgsdg', ''),
(13, '50', '2018-10-19', '5656', '456', 'dfgsdg', 'sdfgsdg', ''),
(14, '45645', '2018-10-08', '60', '456', 'dfgsdg', 'sdfgsdg', ''),
(15, '45645', '2018-10-01', '5656', '456', 'dfgsdg', 'sdfgsdg', ''),
(16, '45645', '2018-10-02', '5656', '456', 'dfgsdg', '', ''),
(17, '45645', '2018-10-16', '5656', '456', 'dfgsdg', '', ''),
(18, '84', '2018-10-21', '5656', '456', 'dfgsdg', 'tent-hire-1.jpg', ''),
(19, '84', '2018-10-24', '5656', '456', 'dfgsdg', 'QGhR4YjQ.png', ''),
(20, '84', '2018-10-26', '5656', '456', 'dfgsdg', 'Screenshot from 2018-08-08 23-07-38.png', ''),
(21, '45645', '2018-10-20', '56', '456', 'dfgsdg', 'Screenshot from 2018-08-08 23-07-38.png', ''),
(22, '45645', '2018-10-17', '5656', '456', 'dfgsdg', 'Screenshot from 2018-08-08 23-07-38.png', ''),
(28, '45645', '2018-10-19', '5656', '456', 'dfgsdg', 'Car-USB-Charger-Quick-Charge-QC3-0 (1).jpg', ''),
(32, '9', '2018-10-01', '35', '100', 'Dsdsds', '560094094.528791.png', ''),
(33, '45645', '2018-10-05', '5656', '456', 'dfgsdg', 'thumbstick-game-handle-for-sharpshooter-game-pad (5).jpg', ''),
(34, '45645', '2018-10-09', '5656', '456', 'dfgsdg', 'thumbstick-game-handle-for-sharpshooter-game-pad (3).jpg', ''),
(35, '45645', '2018-10-11', '57', '456', 'dfgsdg', 'thumbstick-game-handle-for-sharpshooter-game-pad.jpg', ''),
(36, '45645', '2018-08-04', '561', '45', 'dfgsdg', 'thumbstick-game-handle-for-sharpshooter-game-pad (1).jpg', ''),
(37, '456', '2018-08-04', '561', '45', 'dfgsdg', 'thumbstick-game-handle-for-sharpshooter-game-pad (1).jpg', ''),
(38, '82', '2018-08-04', '561', '45', 'dfgsdg', 'thumbstick-game-handle-for-sharpshooter-game-pad (2).jpg', ''),
(48, '82', '2018-08-04', '561', '45', 'dfgsdg', 'tent-hire-1.jpg', ''),
(49, '84', '2018-08-04', '561', '45', 'dfgsdg', 'tent-hire-1.jpg', ''),
(50, '456', '2018-08-04', '56', '45', 'dfgsdg', 'tent-hire-1.jpg', ''),
(51, '82', '2018-08-04', '561', '45', 'dfgsdg', 'tent-hire-1.jpg', ''),
(52, '456', '2018-08-04', '61', '45', 'dfgsdg', 'tent-hire-1.jpg', ''),
(53, '84', '2018-08-04', '561', '45', 'dfgsdg', 'tent-hire-1.jpg#QGhR4YjQ.png', ''),
(54, '84', '2018-08-04', '561', '45', 'dfgsdg', 'tent-hire-1.jpg#QGhR4YjQ.png', ''),
(55, '456', '2018-08-04', '561', '45', 'dfgsdg', 'tent-hire-1.jpg#QGhR4YjQ.png', ''),
(56, '456', '2018-08-04', '60', '45', 'dfgsdg', 'tent-hire-1.jpg#QGhR4YjQ.png', ''),
(57, '83', '2018-08-04', '56', '45', 'dfgsdg', 'tent-hire-1.jpg#QGhR4YjQ.png', ''),
(58, '456', '2018-08-04', '561', '45', 'dfgsdg', 'tent-hire-1.jpg#QGhR4YjQ.png', ''),
(59, '83', '2018-08-04', '561', '45', 'dfgsdg', 'tent-hire-1.jpg#QGhR4YjQ.png', ''),
(60, '456', '2018-08-04', '561', '45', 'dfgsdg', 'tent-hire-1.jpg#QGhR4YjQ.png', ''),
(61, '456', '2018-08-04', '561', '45', 'dfgsdg', 'tent-hire-1.jpg#QGhR4YjQ.png', ''),
(62, '456', '2018-08-04', '561', '45', 'dfgsdg', '1538549314img (1).jpeg#1538549314img (1).jpeg', ''),
(71, '456', '2018-08-04', '59', '45', 'dfgsdg', 'tent-hire-1.jpg#jS1d-r6w.png', ''),
(72, '84', '2018-08-04', '56', '45', 'dfgsdg', 'tent-hire-1.jpg#jS1d-r6w.png', ''),
(73, '84', '2018-08-04', '57', '45', 'dfgsdg', 'Chrysanthemum.jpg#Desert.jpg', ''),
(74, '345', '2018-10-03', '35', '10', 'Dedsdsds', '560267538.482606.png#560267538.564264.png', ''),
(75, '456', '2018-08-04', '58', '45', 'this is test', 'Screenshot_1.png#Simulator Screen Shot - iPhone 8 Plus - 2018-10-03 at 14.53.33.png', ''),
(76, '456', '2018-08-04', '60', '45', 'this is test1234654645646', 'Screenshot_1.png#Simulator Screen Shot - iPhone 8 Plus - 2018-10-03 at 14.53.33.png', ''),
(77, '456', '2018-01-04', '59', '45', 'this is test1234654645646hkhkjhjkhk', 'Screenshot_1.png#Simulator Screen Shot - iPhone 8 Plus - 2018-10-03 at 14.53.33.png', ''),
(78, '456', '2018-10-04', '56', '45', 'this is test1234654645646hkhkjhjkhk', 'Screenshot_1.png#Simulator Screen Shot - iPhone 8 Plus - 2018-10-03 at 14.53.33.png', ''),
(79, '456', '2018-08-04', '58', '45', 'dfgsdg', 'http://112.196.9.211:8230/civilpro/rest_api/v1/up...', ''),
(80, '456', '2018-08-04', '57', '45', 'dfgsdg', 'http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/tent-hire-1.jpg#http://112.196.9.211:', ''),
(81, '456', '2018-08-04', '60', '45', 'dfgsdg', 'http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/tent-hire-1.jpg#http://112.196.9.211:', ''),
(82, '82', '2018-08-04', '35', '45', 'dfgsdg', 'http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/tent-hire-1.jpg#http://112.196.9.211:', ''),
(83, '83', '2018-08-04', '59', '45', 'dfgsdg', 'http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/tent-hire-1.jpg#http://112.196.9.211:', ''),
(84, '456', '2018-08-04', '56', '45', 'dfgsdg', 'http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/tent-hire-1.jpg#http://112.196.9.211:', ''),
(85, '50', '2018-08-04', '57', '45', 'dfgsdg', 'http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/tent-hire-1.jpg#http://112.196.9.211:', ''),
(86, '456', '2018-08-04', '61', '45', 'dfgsdg', 'http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/tent-hire-1.jpg#http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/img (1).jpeg', ''),
(87, '83', '2018-08-04', '35', '45', 'dfgsdg', 'http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/tent-hire-1.jpg#http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/img (1).jpeg#http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/jS1d-r6w.png', ''),
(88, '83', '2018/04/08', '35', '151', 'machine', 'http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/D', ''),
(89, '83', '2018-11-15', '35', '10', 'Dsdsdsdsds', 'http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/561307290.413614.png', ''),
(90, '83', '2018-08-04', '72', '3', 'tech', 'http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/download (2).jpeg#http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/download.jpeg', '1539696293'),
(91, '130', '2018-10-17', '56', '2', 'Hdjdjdjdjdjdhhdhdjd', 'http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/561406701.72425.png#http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/561406702.146985.png', '1539713907'),
(92, '130', '2018-10-17', '61', '15', 'Good Test', 'http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/561698054.887607.png#http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/561698054.898361.png#http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/561698054.902209.png#http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/561698054.926342.png#http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/561698054.928153.png#http://112.196.9.211:8230/civilpro/rest_api/v1/uploads/uploads/561698054.954497.png', '1539918936');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `holiday_id` int(11) NOT NULL,
  `holiday_name` varchar(256) NOT NULL,
  `holiday_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`holiday_id`, `holiday_name`, `holiday_date`) VALUES
(3, 'New Year--', '2018-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `machine`
--

CREATE TABLE `machine` (
  `machine_id` int(11) NOT NULL,
  `machine_name` varchar(256) NOT NULL,
  `machine_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `machine`
--

INSERT INTO `machine` (`machine_id`, `machine_name`, `machine_image`) VALUES
(96, 'JCB Excavators', 'Hydrangeas.jpg'),
(97, 'JCB Loaders', 'Desert.jpg'),
(99, 'JCB Fastrac Tractors', 'traktory-rolnicze-scot-jcb-fastrac.jpg'),
(100, 'stone chrusher', 'stone-crusher-machine-in-india.jpg'),
(101, 'test sach', 'Chrysanthemum.jpg'),
(102, 'Machine101', 'Tulips.jpg'),
(107, 'cvcvcv', 'img (2).jpeg'),
(108, 'jklkjlkljljk', 'tent-hire-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `materials_name` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `time_set` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `materials_name`, `amount`, `unit`, `time_set`) VALUES
(37, 'sss', '20000', '456', ''),
(38, 'fdsf', '544', '454', ''),
(39, 'sdfgs', '200', '12312', ''),
(41, 'tret', '454', '454', ''),
(50, 'brick', '3500', 'cm', '1539697441'),
(51, 'paint', '1000', 'kg', '1539762058');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `Project_id` int(11) NOT NULL,
  `Project_name` varchar(256) NOT NULL,
  `Client_id` int(11) NOT NULL,
  `Start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `Rate` int(11) NOT NULL,
  `billing_type` varchar(255) NOT NULL,
  `Total_hours` varchar(100) NOT NULL,
  `Priority` enum('0','1','2') NOT NULL DEFAULT '1',
  `Project_leader` varchar(256) NOT NULL,
  `Team_member` varchar(256) NOT NULL,
  `Project_Address` text NOT NULL,
  `machine` varchar(256) NOT NULL,
  `material` varchar(256) NOT NULL,
  `consumption` varchar(255) NOT NULL,
  `decription` text NOT NULL,
  `images` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`Project_id`, `Project_name`, `Client_id`, `Start_date`, `end_date`, `Rate`, `billing_type`, `Total_hours`, `Priority`, `Project_leader`, `Team_member`, `Project_Address`, `machine`, `material`, `consumption`, `decription`, `images`, `status`) VALUES
(35, 'php_pro', 44, '2018-08-16', '2018-09-26', 1000, 'Fixed', '25', '0', '', '83,84', 'mohali tower', '', '38', '25', '', '', '1'),
(56, 'newtestlistproject', 53, '2018-08-16', '2018-08-23', 80, 'Hourly', '30', '1', '49,50,51,52,53', '82,83,84', 'saf', '96,97,100,102', '37,38', '50,40', '<p>asdf</p>', 'SampleJPGImage_500kbmb.jpg', '1'),
(58, 'testingnewproject', 44, '2018-08-17', '2018-08-30', 550, 'Hourly', '70', '0', '50', '83,84', 'mohali', '96,97,99,100,102', '37,41', '1000,100', '', '', '0'),
(60, 'civilprotest', 44, '2018-08-15', '2018-08-30', 500, 'Hourly', '10', '0', '84', '83,114,129,130', 'mohali', '96,99', '37,38,39,41,50,51', '1000,44,100,200,3000,800', '', '', '0'),
(61, 'newtestcivil pro', 44, '2018-08-15', '2018-10-25', 250, 'Hourly', '20', '1', '52', '82,83,84', 'mohali', '99', '39', '40', '<p>tesitng..</p>', '', '0'),
(71, 'Quicksilver', 44, '2018-10-22', '2018-11-07', 450, 'Hourly', '82', '0', '111', '50,130,132', 'mohali tower sector 70', '99', '37,38,39,41', '1000,100,50,10', '', '', '0'),
(72, 'Revolution', 44, '2018-10-16', '2018-11-09', 850, 'Hourly', '248', '0', '112,113,122', '50,111,130,132', 'mohali tower sector 70', '', '38,39', '50,50', '', '', '0'),
(73, 'pro A/one', 44, '2018-08-16', '2018-09-26', 1000, 'Hourly', '350', '0', '', '', 'mohali tower', '', '37,38', '400,40', '', '', '1'),
(74, 'a1 pro', 44, '2018-10-18', '2018-10-25', 200, 'Hourly', '40', '0', '83,111,113', '113,122,130', 'mohali tower sector 70', '96,97', '38,39,46', '100,20,3000', '', '', '1'),
(75, 'professional', 44, '2018-11-10', '2018-12-11', 2500, 'Hourly', '150', '0', '83,111,112,122', '83,113,115,127,128', 'mohali tower sector 70', '96,97,99', '39,41', '50,100', '<p>testing</p>', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `time_card`
--

CREATE TABLE `time_card` (
  `id` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `employee_id` varchar(500) NOT NULL,
  `deadline` varchar(100) NOT NULL,
  `total_hours` varchar(100) NOT NULL,
  `remain_hours` varchar(100) NOT NULL,
  `work_type` varchar(100) NOT NULL,
  `card_date` varchar(100) NOT NULL,
  `hours` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `machine` varchar(100) NOT NULL,
  `machine_hours` varchar(100) NOT NULL,
  `created_date` date NOT NULL,
  `time_set` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_card`
--

INSERT INTO `time_card` (`id`, `project_name`, `employee_id`, `deadline`, `total_hours`, `remain_hours`, `work_type`, `card_date`, `hours`, `description`, `status`, `machine`, `machine_hours`, `created_date`, `time_set`) VALUES
(72, '60', '49', '02/16/2017', '', '3', 'Machines', '08/13/2018', '2', 'ddd', '1', '96,97,99,100', '3,9,10,10', '2018-09-14', ''),
(92, '60', '55', '07/11/2018', '', '8', 'Machines', '08/14/2018', '4', 'ghg', '1', '96,97,99,100', '9,10,0,0', '2018-09-14', ''),
(113, '56', '50', '08/24/2018', '30', '30', 'Labourer', '08/16/2018', '10', 'testing...', '1', '', '', '2018-09-14', ''),
(114, '62', '109', '11/30/2018', '80', '50', 'Foreman', '08/16/2018', '15', 'testing', '1', '96,97,99,100', '6,5,9,5', '2018-09-14', ''),
(115, '63', '105', '08/30/2018', '', '70', 'Foreman', '08/17/2018', '15', 'sdfg', '1', '', '', '2018-09-14', ''),
(116, '63', '108', '08/30/2018', '', '60', 'Machines', '08/16/2018', '10', 'vnbmvb', '0', '', '', '2018-09-14', ''),
(117, '35', '51', '08/23/2018', '', '40', 'Labourer', '08/19/2018', '5', 'fdfasdfsadfasdfasdfdasf', '1', '', '', '2018-09-14', ''),
(119, '35', '52', '08/25/2018', '', '27', 'Labourer', '08/26/2018', '8', 'dgasdg', '1', '', '', '2018-09-14', ''),
(122, '60', '49', '08/31/2018', '', '4', 'Labourer', '08/23/2018', '2', 'ghdfgh...', '0', '', '', '2018-09-14', ''),
(123, '59', '49', '09/25/2018', '', '35', 'Foreman', '08/22/2018', '10', 'jk..', '1', '', '', '2018-09-14', ''),
(124, '57', '53', '09/13/2018', '', '50', 'Labourer', '08/23/2018', '10', 'gsdf', '1', '', '', '2018-09-14', ''),
(125, '60', '49', '09/27/2018', '', '2', 'Machines', '08/22/2018', '1', 'jh', '1', '96,97,99', '6,5,5', '2018-09-14', ''),
(126, '57', '51', '09/28/2018', '', '40', 'Machines', '08/24/2018', '6', 'jkj', '1', '96,97,99,100', '5,4,3,5', '2018-09-14', ''),
(127, '61', '52', '08/22/2018', '', '20', 'Labourer', '08/31/2018', '4', 'fg', '1', '', '', '2018-09-14', ''),
(128, '58', '49', '09/30/2018', '', '55', 'Foreman', '08/24/2018', '12', 'fdg', '1', '', '', '2018-09-14', ''),
(129, '57', '49', '08/23/2018', '', '34', 'Labourer', '09/30/2018', '11', 'jh', '1', '', '', '2018-09-14', ''),
(131, '57', '49', '10/18/2018', '', '23', 'Labourer', '08/25/2018', '13', 'fg', '1', '', '', '2018-09-14', ''),
(132, '61', '52', '08/31/2018', '', '16', 'Labourer', '08/22/2018', '2', 'hj', '1', '', '', '2018-09-14', ''),
(133, '57', '51', '08/24/2018', '', '10', 'Labourer', '08/31/2018', '5', 'gf', '1', '', '', '2018-09-14', ''),
(134, '61', '52', '08/22/2018', '', '14', 'Machines', '08/22/2018', '10', 'k.', '1', '96', '8', '2018-09-14', ''),
(135, '59', '49', '08/23/2018', '', '25', 'Machines', '08/31/2018', '6', 'hil', '1', '97', '7', '2018-09-14', ''),
(136, '59', '', '09/20/2018', '', '', 'Machines', '09/20/2018', '100', 'testing purpose', '0', '96,100', '3,6', '2018-09-14', ''),
(137, '59', '', '09/20/2018', '', '', 'Machines', '09/20/2018', '100', 'testing purpose', '0', '96,100', '0,0', '2018-09-14', ''),
(138, '60', '', '09/25/2018', '', '', 'Foreman', '09/25/2018', '500', 'testing purpose', '0', '', '', '2018-09-14', ''),
(139, '35', '50', '', '', '', 'cvcvvcv', '8/22/2018', '45453', '', '0', 'fghfghfgh', '', '2018-09-14', ''),
(140, '56', '55', '', '', '', 'cvcvvcv', '11/25/2018', '45453', '', '0', 'fghfghfgh', '', '2018-09-14', ''),
(141, '57', '111', '', '', '', 'cvcvvcv', '06/29/2018', '45453', '', '0', 'fghfghfgh', '', '2018-09-14', ''),
(142, '60', '54', '', '', '', 'cvcvvcv', '06/12/2018', '45453', '', '0', 'fghfghfgh', '', '2018-09-14', ''),
(143, '61', '546', '', '', '', 'cvcvvcv', '04/18/2018', '45453', '', '0', 'fghfghfgh', '', '2018-09-14', ''),
(170, '45', '546', '', '', '', 'cvcvvcv', '05/19/2018', '45453', '', '0', 'fghfghfgh', '', '2018-09-14', ''),
(171, '45', '54', '', '', '', 'cvcvvcv', '06/22/2018', '45453', '', '0', 'fghfghfgh', '', '2018-09-14', ''),
(175, '35', '66', '', '', '', 'helper', '04/17/2018', '10', '', '0', 'jgjghjghj', '', '2018-09-25', ''),
(176, '57', '66', '', '', '', 'helper', '05/24/2018', '101', '', '0', 'jgjghjghj', '', '2018-09-25', ''),
(177, '59', '', '09/28/2018', '', '', 'Machines', '09/29/2018', '16', 'testing purpose', '0', '97,99,100', '4,3,5', '2018-09-26', ''),
(181, '60', '56', '45', '', '32', 'cvcvvcv', 'dfggf', '45453', '', '0', '10,15,16', '44,21', '2018-09-26', ''),
(185, '2', '44', '2018-08-25', '', '12', 'uikhkgh vvbnvbgh ngfhg rtyghjg', '2018-08-12', '08', '', '0', '', '', '2018-10-01', ''),
(186, '23', '44', '2018-08-25', '', '12', 'uikhkgh vvbnvbgh ngfhg rtyghjg', '2018-08-12', '08', '', '0', '3', 'erytry', '2018-10-01', ''),
(187, '56', '49', '10/15/2018', '', '20', 'Machines', '10/18/2018', '3', 'ftggrt bfgbf gh fdgfd gf', '0', '97', '0', '2018-10-01', ''),
(188, '56', '49', '10/15/2018', '', '17', 'Machines', '10/18/2018', '1', 'ghcc rtfhynbgfhfgh fhfgh fgfg', '0', '97', '0', '2018-10-01', ''),
(191, '35', '9', '2018-10-01', '', '27', 'Machines', '2018-10-01', '2', '', '0', '', '', '2018-10-01', ''),
(192, '35', '12', '2018-10-01', '', '27', 'Machines', '2018-10-01', '1', '', '0', '96', '2', '2018-10-01', ''),
(193, '56', '9', '2018-10-03', '', '17', 'Machines', '2018-10-02', '2', '', '0', '96,100', '2,4', '2018-10-02', ''),
(194, '56', '12', '2018-10-03', '', '17', 'Machines', '2018-10-02', '1', '', '0', '96,100', '2,4', '2018-10-02', ''),
(195, '56', '9', '2018-10-03', '', '17', 'Machines', '2018-10-03', '2', '', '0', '96,101', '3,6', '2018-10-03', ''),
(196, '56', '90', '2018-10-03', '', '17', 'Machines', '2018-10-03', '2', '', '0', '97,101', '2,4', '2018-10-03', ''),
(197, '56', '12', '2018-10-04', '', '17', 'Foreman', '2018-10-03', '2', '', '0', '', '', '2018-10-03', ''),
(198, '71', '114', '10/24/2018', '', '82', 'Machines', '10/27/2018', '5', 'testing.....', '0', '99,100,102', '0,0,0', '2018-10-09', ''),
(199, '71', '112', '10/15/2018', '', '77', 'Machines', '10/30/2018', '5', 'testing ......', '0', '97,100', '6,3', '2018-10-09', ''),
(200, '72', '112', '10/20/2018', '', '248', 'Machines', '10/22/2018', '10', 'tester test', '0', '97,100', '0,0', '2018-10-09', ''),
(201, '72', '114', '10/20/2018', '', '248', 'Machines', '10/22/2018', '10', 'tester test', '0', '97,100', '0,0', '2018-10-09', ''),
(202, '73', '846', '2018-10-11', '', '248', 'Foreman', '2018-10-11', '4', '', '0', '', '', '2018-10-11', ''),
(203, '35', '846', '2018-10-11', '', '27', 'Machines', '2018-10-11', '1', '', '0', '96', '2', '2018-10-11', ''),
(204, '56', '846', '2018-10-11', '', '17', 'Machines', '2018-10-11', '1', '', '0', '96', '4', '2018-10-11', ''),
(205, '58', '846', '2018-11-11', '', '55', 'Machines', '2018-10-11', '2', '', '0', '96', '2', '2018-10-11', ''),
(206, '35', '846', '2018-10-12', '', '27', 'Machines', '2018-10-12', '2', '', '0', '96', '3', '2018-10-12', ''),
(207, '49', '113', '06/15/2018', '', '12', 'Machines', '10/15/2018', '45', '', '0', '96,97', '14,12', '2018-10-13', ''),
(208, '56', '345', '2018-10-15', '', '17', 'Machines', '2018-10-15', '2', '', '0', '97,100', '2,3', '2018-10-15', ''),
(209, '49', '83', '2018-11-15', '', '27', 'Foreman', '2018-10-15', '25', '', '0', '96', '1', '2018-10-15', ''),
(210, '72', '111', '2018-10-15', '', '248', 'Machines', '2018-10-15', '3', '', '0', '99', '2', '2018-10-15', ''),
(211, '58', '50', '2018-10-15', '', '55', 'Machines', '2018-10-15', '3', '', '0', '97', '4', '2018-10-15', ''),
(212, '58', '84', '45', '', '32', 'cvcvvcv', '10/22/2018	', '45453', 'testing prupose only', '0', '10,15,16', '44,21,74', '2018-10-15', ''),
(213, '56', '83', '2018-10-15', '', '17', 'Machines', '2018-10-15', '2', 'Dsdsdsds', '0', '99', '3', '2018-10-15', ''),
(214, '73', '111', '2018-10-16', '', '248', 'Foreman', '2018-10-16', '5', '? ????? ??? ???.', '0', '', '', '2018-10-16', ''),
(215, '56', '121', '2018-10-16', '', '17', 'Machines', '2018-10-16', '2', 'Ddsdsdsdsdsdsds', '0', '97', '3', '2018-10-16', ''),
(216, '56', '139', '2018-10-16', '', '17', 'Machines', '2018-10-16', '2', 'Dsdsds', '0', '97', '2', '2018-10-16', ''),
(217, '71', '50', '10/19/2018', '', '72', 'Foreman', '10/19/2018', '3', 'quick silver only', '0', '', '', '2018-10-16', ''),
(218, '72', '113', '10/20/2018', '', '225', 'Labourer', '10/25/2018', '3', 'revolution result value', '0', '', '', '2018-10-16', '1539684493'),
(219, '113', '72', '45', '', '32', 'cvcvvcv', '10/22/2018', '45453', 'testing prupose only', '0', '10,15,16', '44,21,74', '2018-10-16', ''),
(220, '35', '144', '2018-10-16', '', '27', 'Foreman', '2018-10-16', '2', 'Test', '0', '', '', '2018-10-16', ''),
(221, '74', '130', '2018-10-17', '', '248', 'Machines', '2018-10-17', '6', 'Gfffgg', '0', '99', '5', '2018-10-16', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(300) NOT NULL,
  `first_name` varchar(300) NOT NULL,
  `last_name` varchar(300) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(300) NOT NULL,
  `birthday` varchar(300) NOT NULL,
  `address` varchar(350) NOT NULL,
  `country` varchar(300) NOT NULL,
  `state` varchar(300) NOT NULL,
  `pin_code` varchar(300) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `user_employee_id` varchar(255) DEFAULT NULL,
  `user_company_id` int(11) DEFAULT NULL,
  `pass_token` varchar(300) NOT NULL,
  `img` varchar(300) NOT NULL,
  `user_role` enum('0','1','2') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `device_id` varchar(255) DEFAULT NULL,
  `device_type` varchar(255) DEFAULT NULL,
  `otp_manage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `first_name`, `last_name`, `phone`, `email`, `password`, `birthday`, `address`, `country`, `state`, `pin_code`, `gender`, `user_employee_id`, `user_company_id`, `pass_token`, `img`, `user_role`, `created_at`, `updated_at`, `device_id`, `device_type`, `otp_manage`) VALUES
(1, 'admin@123', 'Tony', 'Stark', 1234567890, 'qa75741@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '16/07/2018', 'USA', 'USA', 'Wansigton', '123456', 'Male', '', 1, '32889', '706181_1531738421.jpg', '1', '2018-07-13 06:07:01', '2018-08-08 10:44:11', '', '', ''),
(7, 'aman@123', 'Aman', 'asd', 768687786, 'testerthree@a1professionals.com', '827ccb0eea8a706c4c34a16891f84e7b', '12/07/2018', 'Address', 'Country', 'State', '4646456', 'Male', '', 1, '40379', 'Lighthouse_1531311907.jpg', '0', '2018-07-13 06:07:01', '2018-08-08 10:44:19', '', '', ''),
(9, 'rahul@123', 'rahul', 'dimans', 98786544343, 'rahul@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '10/08/2018', '#123', 'india', 'chd', '160014', 'Male', '', 2, '', 'Penguins_1531313811.jpg', '0', '2018-07-13 06:07:01', '2018-09-26 11:01:51', 'fghh', 'fghfgh', ''),
(14, 'deepak', 'deepak', 'kashap', 134534534, 'deep', '202cb962ac59075b964b07152d234b70', '04/07/2018', '#123', 'india', 'chd', '160014', 'Male', '', 2, '23363', '', '0', '2018-07-13 06:07:01', '2018-08-08 10:44:29', '', '', ''),
(16, 'yoyo', 'yoyo', 'singh', 1234567890, 'yoyo@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', '', '', '', '', '', '', '', 1, '', '', '0', '2018-07-13 06:07:01', '2018-08-08 10:44:38', '', '', ''),
(17, 'hoho', 'hoho', 'singh', 1234567890, 'hoho@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', '', '', '', '', 1, '', '', '0', '2018-07-13 06:07:01', '2018-08-08 10:44:43', '', '', ''),
(22, 'hoho1', 'hoho1', 'last name', 0, 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '24/07/2018', 'Addresss', 'Country', 'State', 'Pin Code', 'Male', '', 1, '', 'Desert_1532345401.jpg', '0', '2018-07-13 06:07:01', '2018-09-26 11:08:39', 'fghh', 'fghfgh', ''),
(24, 'aurob', 'auro', 'B', 7894561232, 'aurobindo.parida@a1professionals.info', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '', '', '123', 1, '', '', '0', '2018-07-13 08:12:19', '2018-07-13 15:27:33', '', '', ''),
(29, 'Sabina', 'Sabina', 'last name', 0, 'sabina@gmail.com', '34c4250bb605d93f25e8df0c246caf99', 'Birthday', 'Address', 'Country', 'State', 'Pin Code', 'Male', '', 2, '', '', '0', '2018-07-13 12:39:06', '2018-08-08 10:45:06', '', '', ''),
(30, 'ciobanu0717', 'ciobanu', 'Ion', 0, 'ciobanu0717@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '17/07/2018', 'kjhjkhjk', 'Country', 'Statekl;kl;', 'Pin Code', 'Female', '', 1, '', 'Screen Shot 2018-07-16 at 11.06.33 AM_1531729256.png', '0', '2018-07-13 12:54:15', '2018-08-08 10:45:12', '', '', ''),
(31, 'sqa', 'sqa', 'last name', 0, 'sqa75741@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Birthday', 'Address', 'Country', 'State', 'Pin Code', 'Male', '', 2, '', '', '0', '2018-07-16 10:27:25', '2018-08-08 10:45:18', '', '', ''),
(32, 'Travis Redekop', 'Travis Redekop', 'last name', 0, 'Travis@silverstoneexcavating.com', '34dfa19477acf8a7f8011fb5098760d6', 'Birthday', 'Address', 'Country', 'State', 'Pin Code', 'Male', '', 2, '', '', '0', '2018-07-17 20:04:23', '2018-08-08 10:45:23', '', '', ''),
(56, 'tester', 'test', 'test', 424244, 'hghfgh@12gmail.com', '202cb962ac59075b964b07152d234b70', '', '', '', '', '', '', 'dfgdfg', 0, '', '', '0', '2018-09-07 10:00:24', NULL, 'dgdgg', 'dfgdsgdfg', ''),
(57, 'tester', 'test', 'test', 424244, 'hghffggh@12gmail.com', '202cb962ac59075b964b07152d234b70', '', '', '', '', '', '', 'dfgdfg', 0, '', '', '0', '2018-09-07 10:05:43', '2018-09-07 19:24:44', 'sdfgf', 'dfsgg', '10492'),
(58, 'tester', 'test', 'dveloper', 1234567890, 'tester@a1professionals.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '', '', '9', 5, '', '', '0', '2018-09-10 12:35:09', NULL, 'fgvfdgvfdgvfd', '2', ''),
(59, 'tester', 'test', 'dveloper', 1234567890, 'tester1@a1professionals.com', '0192023a7bbd73250516f069df18b500', '', '', '', '', '', '', '9', 5, '', '', '0', '2018-09-10 13:34:21', '2018-09-11 10:34:38', 'fghfhf', '1', '22293'),
(60, 'fg', 'fgh', 'fgh', 345, 'fgh@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', '', '', '', '', 'dfsgvn', 0, '', '', '0', '2018-09-14 08:30:51', '2018-10-02 12:58:05', '123456', 'iOS', 'c43ccefdf21cc037c57d54db312648ff'),
(61, 'test', 'test', 'last name', 0, 'testdfhdfh@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Birthday', 'Address', 'Country', 'State', 'Pin Code', 'Male', '0', NULL, '', '', '0', '2018-09-15 05:44:28', '2018-09-26 11:07:54', 'fghh', 'fghfgh', NULL),
(62, 'fg', 'fgh', 'fgh', 345, 'fgfh@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', '', '', '', '', 'dfsgvn', 0, '', '', '0', '2018-09-15 05:45:50', '2018-09-27 16:18:21', 'fsgvb', 'sdf', NULL),
(63, 'test', 'test', 'last name', 0, 'testerone@a1professionals.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Birthday', 'Address', 'Country', 'State', 'Pin Code', 'Male', '', NULL, '', '', '0', '2018-09-15 05:47:24', '2018-09-28 14:00:35', NULL, NULL, ''),
(64, 'fg', 'fgh', 'fgh', 345, 'fgghjh@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', '', '', '', '', 'dfsgvn', 0, '', '', '0', '2018-09-27 12:45:04', NULL, 'fsgvb', 'sdf', NULL),
(66, 'fg', 'fgh', 'fgh', 345, 'fgghjh45@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', '', '', '', '', 'dfsgvn', 0, '', '', '0', '2018-10-03 07:07:45', '2018-10-03 12:42:34', 'fghh', 'fghfgh', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empl_id`);

--
-- Indexes for table `excavator`
--
ALTER TABLE `excavator`
  ADD PRIMARY KEY (`excavator_id`);

--
-- Indexes for table `field_report`
--
ALTER TABLE `field_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`holiday_id`);

--
-- Indexes for table `machine`
--
ALTER TABLE `machine`
  ADD PRIMARY KEY (`machine_id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`Project_id`);

--
-- Indexes for table `time_card`
--
ALTER TABLE `time_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `company_details`
--
ALTER TABLE `company_details`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `empl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
--
-- AUTO_INCREMENT for table `excavator`
--
ALTER TABLE `excavator`
  MODIFY `excavator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `field_report`
--
ALTER TABLE `field_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `holiday_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `machine`
--
ALTER TABLE `machine`
  MODIFY `machine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `Project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `time_card`
--
ALTER TABLE `time_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
