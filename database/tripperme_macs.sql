-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 26, 2017 at 09:42 AM
-- Server version: 5.6.28
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `tripperme_macs`
--

-- --------------------------------------------------------

--
-- Table structure for table `tm_brand_capacity_mapping`
--

CREATE TABLE `tm_brand_capacity_mapping` (
  `bcm_id` int(5) NOT NULL,
  `bcm_bd_id` int(2) NOT NULL,
  `bcm_cp_id` int(2) NOT NULL,
  `bcm_created_date` date NOT NULL,
  `bcm_modified_date` int(11) NOT NULL,
  `bcm_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tm_brand_master`
--

CREATE TABLE `tm_brand_master` (
  `bm_id` int(11) NOT NULL,
  `bm_desc` varchar(500) NOT NULL,
  `bm_cm_id` int(11) NOT NULL,
  `bm_created_date` date NOT NULL,
  `bm_modified_date` date NOT NULL,
  `bm_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tm_capacity_master`
--

CREATE TABLE `tm_capacity_master` (
  `cp_id` int(5) NOT NULL,
  `cp_desc` varchar(500) NOT NULL,
  `cp_remark` varchar(1000) NOT NULL,
  `cp_created_date` date NOT NULL,
  `cp_modified_date` date NOT NULL,
  `cp_cm_id` int(11) NOT NULL,
  `cp_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tm_company_master`
--

CREATE TABLE `tm_company_master` (
  `cm_id` int(11) NOT NULL,
  `cm_ln_id` int(5) NOT NULL,
  `cm_name` varchar(100) NOT NULL,
  `cm_address_1` varchar(500) NOT NULL,
  `cm_address_2` varchar(500) NOT NULL,
  `cm_address_3` varchar(500) NOT NULL,
  `cm_tin_no` bigint(10) NOT NULL,
  `cm_service_tex_no` bigint(15) NOT NULL,
  `cm_mobile` bigint(10) NOT NULL,
  `cm_mobile_no_2` bigint(11) NOT NULL,
  `cm_landline` bigint(11) NOT NULL,
  `cm_contact_person` varchar(25) NOT NULL,
  `cm_mail_id` varchar(100) NOT NULL,
  `cm_website` varchar(100) NOT NULL,
  `cm_created_date` date NOT NULL,
  `cm_modified_date` date NOT NULL,
  `cm_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tm_company_master`
--

INSERT INTO `tm_company_master` (`cm_id`, `cm_ln_id`, `cm_name`, `cm_address_1`, `cm_address_2`, `cm_address_3`, `cm_tin_no`, `cm_service_tex_no`, `cm_mobile`, `cm_mobile_no_2`, `cm_landline`, `cm_contact_person`, `cm_mail_id`, `cm_website`, `cm_created_date`, `cm_modified_date`, `cm_status`) VALUES
(1, 0, 'TripperMe', '', '', '', 0, 0, 9500231300, 0, 0, 'Pushpa', 'pks@gmail.com', '', '2017-01-16', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tm_customer_master`
--

CREATE TABLE `tm_customer_master` (
  `crm_id` int(11) NOT NULL,
  `crm_name` varchar(100) NOT NULL,
  `crm_last_name` varchar(100) NOT NULL,
  `crm_gender` int(2) NOT NULL,
  `crm_dob` date NOT NULL,
  `crm_address_1` varchar(200) NOT NULL,
  `crm_address_2` varchar(200) NOT NULL,
  `crm_address_3` varchar(200) NOT NULL,
  `crm_pincode` int(11) NOT NULL,
  `crm_state_id` int(2) NOT NULL,
  `crm_country_id` int(2) NOT NULL,
  `crm_mobile_number` bigint(11) NOT NULL,
  `crm_email_id` varchar(50) NOT NULL,
  `crm_created_date` date NOT NULL,
  `crm_modified_date` date NOT NULL,
  `crm_status` int(2) NOT NULL,
  `crm_cm_id` int(11) NOT NULL,
  `crm_created_by` int(11) NOT NULL,
  `crm_ln_id` int(2) NOT NULL,
  `crm_user_type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tm_customer_master`
--

INSERT INTO `tm_customer_master` (`crm_id`, `crm_name`, `crm_last_name`, `crm_gender`, `crm_dob`, `crm_address_1`, `crm_address_2`, `crm_address_3`, `crm_pincode`, `crm_state_id`, `crm_country_id`, `crm_mobile_number`, `crm_email_id`, `crm_created_date`, `crm_modified_date`, `crm_status`, `crm_cm_id`, `crm_created_by`, `crm_ln_id`, `crm_user_type`) VALUES
(1, 'Pushpa', 'Parameswaran', 0, '0000-00-00', '', '', '', 0, 0, 0, 9500231300, 'pks@gmail.com', '2017-01-16', '2017-01-16', 1, 1, 0, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tm_login`
--

CREATE TABLE `tm_login` (
  `ln_id` int(11) NOT NULL,
  `ln_user_name` bigint(11) NOT NULL,
  `ln_user_password` varchar(100) NOT NULL,
  `ln_crm_id` int(11) NOT NULL,
  `ln_user_role` int(2) NOT NULL,
  `ln_user_display_name` varchar(100) NOT NULL,
  `ln_created_date` date NOT NULL,
  `ln_modified_date` date NOT NULL,
  `ln_user_online` int(2) NOT NULL,
  `ln_cm_id` int(2) NOT NULL,
  `ln_created_by` int(11) NOT NULL,
  `ln_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tm_model_master`
--

CREATE TABLE `tm_model_master` (
  `md_id` int(2) NOT NULL,
  `md_pc_id` int(2) NOT NULL,
  `md_bd_id` int(2) NOT NULL,
  `md_cp_id` int(2) NOT NULL,
  `md_cm_id` int(2) NOT NULL,
  `md_desc` varchar(500) NOT NULL,
  `md_created_date` date NOT NULL,
  `md_modifed_date` date NOT NULL,
  `md_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tm_price_master`
--

CREATE TABLE `tm_price_master` (
  `prm_id` int(5) NOT NULL,
  `prm_md_id` int(5) NOT NULL,
  `prm_desc` varchar(500) NOT NULL,
  `prm_price` double NOT NULL,
  `prm_from` date NOT NULL,
  `prm_to` date NOT NULL,
  `prm_created_date` date NOT NULL,
  `prm_modified_date` date NOT NULL,
  `prm_status` int(11) NOT NULL,
  `prm_cm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tm_product_category`
--

CREATE TABLE `tm_product_category` (
  `pc_id` int(11) NOT NULL,
  `pc_desc` varchar(500) NOT NULL,
  `pc_cm_id` int(11) NOT NULL,
  `pc_created_date` date NOT NULL,
  `pc_modified_date` date NOT NULL,
  `pc_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tm_product_images`
--

CREATE TABLE `tm_product_images` (
  `img_id` int(12) NOT NULL,
  `img_product_id` int(5) NOT NULL,
  `img_src` varchar(200) NOT NULL,
  `img_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tm_product_master`
--

CREATE TABLE `tm_product_master` (
  `pm_id` int(5) NOT NULL,
  `pm_pc_id` int(2) NOT NULL,
  `pm_bm_id` int(2) NOT NULL,
  `pm_cp_id` int(2) NOT NULL,
  `pm_md_id` int(11) NOT NULL,
  `pm_title` varchar(200) NOT NULL,
  `pm_desc` varchar(500) NOT NULL,
  `pm_image` text NOT NULL,
  `pm_creaded_date` date NOT NULL,
  `pm_modified_date` date NOT NULL,
  `pm_status` int(2) NOT NULL,
  `pm_cm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tm_product_sub_category`
--

CREATE TABLE `tm_product_sub_category` (
  `psc_id` int(11) NOT NULL,
  `psc_pc_id` int(2) NOT NULL,
  `psc_desc` varchar(500) NOT NULL,
  `psc_created_date` date NOT NULL,
  `psc_modified_date` date NOT NULL,
  `psc_status` int(2) NOT NULL,
  `psc_cm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tm_product_sub_two_category`
--

CREATE TABLE `tm_product_sub_two_category` (
  `psc_two_id` int(11) NOT NULL,
  `psc_two_pc_id` int(2) NOT NULL,
  `psc_two_psc_id` int(2) NOT NULL,
  `psc_two_desc` varchar(500) NOT NULL,
  `psc_two_created_date` date NOT NULL,
  `psc_two_modified_date` date NOT NULL,
  `psc_two_status` int(2) NOT NULL,
  `psc_two_cm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tm_user_role`
--

CREATE TABLE `tm_user_role` (
  `ur_id` int(11) NOT NULL,
  `ur_desc` varchar(50) NOT NULL,
  `ur_created_date` date NOT NULL,
  `ur_modified_date` date NOT NULL,
  `ur_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tm_user_role`
--

INSERT INTO `tm_user_role` (`ur_id`, `ur_desc`, `ur_created_date`, `ur_modified_date`, `ur_status`) VALUES
(1, 'Super Admin', '2017-01-13', '0000-00-00', 1),
(2, 'Admin', '2017-01-13', '0000-00-00', 1),
(3, 'Product Owner', '2017-01-13', '0000-00-00', 1),
(4, 'Administration Staff', '2017-01-13', '0000-00-00', 1),
(5, 'Marketing Staff', '2017-01-13', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tm_version_master`
--

CREATE TABLE `tm_version_master` (
  `vm_id` int(5) NOT NULL,
  `vm_dec` varchar(500) NOT NULL,
  `vm_created_date` date NOT NULL,
  `vm_modified_date` date NOT NULL,
  `vm_mobile_id` double NOT NULL,
  `vm_mobile_version_id` double NOT NULL,
  `vm_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tm_brand_capacity_mapping`
--
ALTER TABLE `tm_brand_capacity_mapping`
  ADD PRIMARY KEY (`bcm_id`);

--
-- Indexes for table `tm_brand_master`
--
ALTER TABLE `tm_brand_master`
  ADD PRIMARY KEY (`bm_id`);

--
-- Indexes for table `tm_capacity_master`
--
ALTER TABLE `tm_capacity_master`
  ADD PRIMARY KEY (`cp_id`);

--
-- Indexes for table `tm_company_master`
--
ALTER TABLE `tm_company_master`
  ADD PRIMARY KEY (`cm_id`),
  ADD KEY `cm_name` (`cm_name`),
  ADD KEY `cm_mobile` (`cm_mobile`),
  ADD KEY `cm_mail_id` (`cm_mail_id`);

--
-- Indexes for table `tm_customer_master`
--
ALTER TABLE `tm_customer_master`
  ADD PRIMARY KEY (`crm_id`),
  ADD UNIQUE KEY `crm_mobile_number_2` (`crm_mobile_number`),
  ADD UNIQUE KEY `crm_email_id` (`crm_email_id`),
  ADD KEY `crm_name` (`crm_name`),
  ADD KEY `crm_pincode` (`crm_pincode`),
  ADD KEY `crm_mobile_number` (`crm_mobile_number`),
  ADD KEY `crm_created_date` (`crm_created_date`);

--
-- Indexes for table `tm_login`
--
ALTER TABLE `tm_login`
  ADD PRIMARY KEY (`ln_id`),
  ADD UNIQUE KEY `ln_user_name_2` (`ln_user_name`),
  ADD KEY `ln_user_name` (`ln_user_name`),
  ADD KEY `ln_user_name_3` (`ln_user_name`),
  ADD KEY `ln_crm_id` (`ln_crm_id`);

--
-- Indexes for table `tm_model_master`
--
ALTER TABLE `tm_model_master`
  ADD PRIMARY KEY (`md_id`);

--
-- Indexes for table `tm_price_master`
--
ALTER TABLE `tm_price_master`
  ADD PRIMARY KEY (`prm_id`);

--
-- Indexes for table `tm_product_category`
--
ALTER TABLE `tm_product_category`
  ADD PRIMARY KEY (`pc_id`);

--
-- Indexes for table `tm_product_images`
--
ALTER TABLE `tm_product_images`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `tm_product_master`
--
ALTER TABLE `tm_product_master`
  ADD PRIMARY KEY (`pm_id`);

--
-- Indexes for table `tm_product_sub_category`
--
ALTER TABLE `tm_product_sub_category`
  ADD PRIMARY KEY (`psc_id`);

--
-- Indexes for table `tm_product_sub_two_category`
--
ALTER TABLE `tm_product_sub_two_category`
  ADD PRIMARY KEY (`psc_two_id`);

--
-- Indexes for table `tm_user_role`
--
ALTER TABLE `tm_user_role`
  ADD PRIMARY KEY (`ur_id`);

--
-- Indexes for table `tm_version_master`
--
ALTER TABLE `tm_version_master`
  ADD PRIMARY KEY (`vm_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tm_brand_capacity_mapping`
--
ALTER TABLE `tm_brand_capacity_mapping`
  MODIFY `bcm_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tm_brand_master`
--
ALTER TABLE `tm_brand_master`
  MODIFY `bm_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tm_capacity_master`
--
ALTER TABLE `tm_capacity_master`
  MODIFY `cp_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tm_company_master`
--
ALTER TABLE `tm_company_master`
  MODIFY `cm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tm_customer_master`
--
ALTER TABLE `tm_customer_master`
  MODIFY `crm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tm_login`
--
ALTER TABLE `tm_login`
  MODIFY `ln_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tm_model_master`
--
ALTER TABLE `tm_model_master`
  MODIFY `md_id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tm_price_master`
--
ALTER TABLE `tm_price_master`
  MODIFY `prm_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tm_product_category`
--
ALTER TABLE `tm_product_category`
  MODIFY `pc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tm_product_images`
--
ALTER TABLE `tm_product_images`
  MODIFY `img_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tm_product_master`
--
ALTER TABLE `tm_product_master`
  MODIFY `pm_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tm_product_sub_category`
--
ALTER TABLE `tm_product_sub_category`
  MODIFY `psc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tm_product_sub_two_category`
--
ALTER TABLE `tm_product_sub_two_category`
  MODIFY `psc_two_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tm_user_role`
--
ALTER TABLE `tm_user_role`
  MODIFY `ur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tm_version_master`
--
ALTER TABLE `tm_version_master`
  MODIFY `vm_id` int(5) NOT NULL AUTO_INCREMENT;