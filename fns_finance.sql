-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Mar 26, 2026 at 10:50 AM
-- Server version: 8.0.45
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fns`
--

-- --------------------------------------------------------

--
-- Table structure for table `advance_clearing_items`
--

CREATE TABLE `advance_clearing_items` (
  `id` int NOT NULL,
  `advance_request_id` int NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `account_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advance_requests`
--

CREATE TABLE `advance_requests` (
  `id` int NOT NULL,
  `requester_id` int NOT NULL,
  `department_id` int NOT NULL,
  `request_date` date NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_amount` decimal(15,2) NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_transaction_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advance_requests`
--

INSERT INTO `advance_requests` (`id`, `requester_id`, `department_id`, `request_date`, `description`, `requested_amount`, `status`, `payment_transaction_id`) VALUES
(1, 10, 1, '2026-03-07', 'swswswswsw', 200000.00, 'cleared', NULL),
(2, 12, 2, '2026-03-08', 'ຢາກໄດ້ຊຸດໂກ້ໂກ້ວາ', 100.00, 'rejected', NULL),
(3, 12, 1, '2026-03-08', 'kuy', 400.00, 'cleared', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `budget_line_items`
--

CREATE TABLE `budget_line_items` (
  `id` int NOT NULL,
  `budget_plan_id` int NOT NULL,
  `account_id` int NOT NULL,
  `amount_regular` decimal(15,2) DEFAULT NULL,
  `amount_academic` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budget_line_items`
--

INSERT INTO `budget_line_items` (`id`, `budget_plan_id`, `account_id`, `amount_regular`, `amount_academic`) VALUES
(21, 6, 1, 100.00, 0.00),
(37, 6, 2, 5.00, 0.00),
(38, 6, 3, 2.00, 0.00),
(39, 6, 5, 1.00, 0.00),
(41, 6, 4, 1.00, 0.00),
(43, 6, 6, 1.00, 0.00),
(45, 6, 11, 5.00, 0.00),
(46, 6, 12, 3.00, 0.00),
(47, 6, 13, 2.00, 0.00),
(48, 6, 18, 5.00, 0.00),
(51, 6, 21, 5.00, 0.00),
(52, 6, 22, 5.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `budget_period_allocations`
--

CREATE TABLE `budget_period_allocations` (
  `id` int NOT NULL,
  `budget_line_item_id` int NOT NULL,
  `period_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `allocated_amount` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `budget_plans`
--

CREATE TABLE `budget_plans` (
  `id` int NOT NULL,
  `fiscal_year` int NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` int NOT NULL DEFAULT '1',
  `created_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budget_plans`
--

INSERT INTO `budget_plans` (`id`, `fiscal_year`, `status`, `version`, `created_by`) VALUES
(6, 2027, 'draft', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_accounts`
--

CREATE TABLE `chart_of_accounts` (
  `id` int NOT NULL,
  `account_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chart_of_accounts`
--

INSERT INTO `chart_of_accounts` (`id`, `account_code`, `account_name`, `parent_id`) VALUES
(1, '60000000', 'ຄ່າໃຊ້ຈ່າຍ', NULL),
(2, '60100000', 'ຄ່າໃຊ້ຈ່າຍພະນັກງານ', 1),
(3, '60100100', 'ເງິນເດືອນ', 2),
(4, '60100101', 'ຄ່າແຮງງານ', 2),
(5, '60100102', 'ຄ່າໂອທີ (OT)', 2),
(6, '60100200', 'ຄ່າເບ້ຍລ້ຽງ ແລະ ເງິນຊ່ວຍເຫຼືອ', 2),
(7, '60100300', 'ຄ່າອາຫານ', 2),
(8, '60100400', 'ຄ່າເດີນທາງ', 2),
(9, '60100500', 'ຄ່າທີ່ພັກ', 2),
(10, '60100600', 'ຄ່າຮັກສາພະຍາບານ', 2),
(11, '60200000', 'ຄ່າໃຊ້ຈ່າຍບໍລິຫານ', 1),
(12, '60200100', 'ຄ່າໃຊ້ຈ່າຍສຳນັກງານ', 11),
(13, '60200200', 'ຄ່າສາທາລະນູປະໂພກ', 11),
(14, '60200201', 'ຄ່າໄຟຟ້າ', 13),
(15, '60200202', 'ຄ່ານ້ຳ', 13),
(16, '60200203', 'ຄ່າອິນເຕີເນັດ', 13),
(17, '60200300', 'ຄ່າອຸປະກອນສຳນັກງານ', 11),
(18, '61000000', 'ລາຍຈ່າຍບໍລິຫານ', NULL),
(19, '61100000', 'ລາຍຈ່າຍຊື້ເຄື່ອງຮັບໃຊ້ຫ້ອງການ', 18),
(20, '61100100', 'ຄ່າເຄື່ອງຂຽນ ແລະ ແບບພິມ', 19),
(21, '61200000', 'ລາຍຈ່າຍພະລັງງານ ແລະ ສາທາລະນູປະໂພກ', 18),
(22, '61200100', 'ຄ່າໄຟຟ້າ', 21),
(23, '61200200', 'ຄ່ານ້ຳປະປາ', 21),
(24, '61200300', 'ຄ່າໂທລະສັບ ແລະ ໄປສະນີ', 21);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int NOT NULL,
  `department_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `department_type`) VALUES
(1, 'IT', 'ชั้น 3'),
(2, 'HR', 'ชั้น 2'),
(3, 'Sales', 'ชั้น 1'),
(4, 'Marketing', 'ชั้น 4'),
(5, 'ฝ่ายบริหาร', 'Management'),
(6, 'ฝ่ายการเงิน', 'Finance'),
(7, 'ฝ่ายบัญชี', 'Accounting'),
(8, 'ฝ่ายขาย', 'Sales'),
(9, 'ฝ่ายจัดซื้อ', 'Procurement'),
(10, 'ฝ่ายไอที', 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2026_03_22_072919_add_remember_token_to_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `request_workflow_logs`
--

CREATE TABLE `request_workflow_logs` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `user_id` int NOT NULL,
  `action` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_workflow_logs`
--

INSERT INTO `request_workflow_logs` (`id`, `request_id`, `user_id`, `action`, `timestamp`, `comments`) VALUES
(1, 1, 10, 'submitted', '2026-03-07 08:57:08', 'ສົ່ງຄຳຂໍເຂົ້າລະບົບ'),
(2, 1, 10, 'approved', '2026-03-07 09:13:11', 'ອະນຸມັດ'),
(3, 1, 10, 'approved', '2026-03-07 09:15:15', 'ອະນຸມັດ'),
(4, 1, 10, 'approved', '2026-03-07 09:17:57', 'ອະນຸມັດ'),
(5, 1, 10, 'approved', '2026-03-07 09:20:51', 'ອະນຸມັດ'),
(6, 1, 10, 'paid', '2026-03-07 09:23:46', 'ຈ່າຍເງິນແລ້ວ'),
(7, 1, 10, 'clearing_submitted', '2026-03-07 09:35:00', 'ສົ່ງລາຍການສະສາງ'),
(8, 1, 10, 'clearing_confirmed', '2026-03-07 09:36:52', 'ຢືນຢັນການສະສາງ'),
(9, 2, 12, 'submitted', '2026-03-08 04:46:17', 'ສົ່ງຄຳຂໍເຂົ້າລະບົບ'),
(10, 2, 10, 'approved', '2026-03-08 04:48:05', 'ອະນຸມັດ'),
(11, 2, 10, 'rejected', '2026-03-08 04:50:06', 'ບໍ່ຜ່ານ'),
(12, 3, 12, 'submitted', '2026-03-08 04:52:11', 'ສົ່ງຄຳຂໍເຂົ້າລະບົບ'),
(13, 3, 10, 'approved', '2026-03-08 04:53:01', 'ອະນຸມັດ'),
(14, 3, 10, 'approved', '2026-03-08 04:54:35', 'ອະນຸມັດ'),
(15, 3, 10, 'approved', '2026-03-08 04:55:44', 'ອະນຸມັດ'),
(16, 3, 10, 'approved', '2026-03-08 04:59:55', 'ອະນຸມັດ'),
(17, 3, 10, 'paid', '2026-03-08 05:01:16', 'ຈ່າຍເງິນແລ້ວ'),
(18, 3, 12, 'clearing_submitted', '2026-03-08 05:01:44', 'ສົ່ງລາຍການສະສາງ'),
(19, 3, 10, 'clearing_confirmed', '2026-03-08 05:08:43', 'ຢືນຢັນການສະສາງ');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `role_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(3, 'accountant'),
(1, 'admin'),
(7, 'cashier'),
(4, 'deputy_head_of_faculty'),
(5, 'head_of_faculty'),
(2, 'head_of_finance'),
(6, 'requester'),
(8, 'revenue_officer'),
(9, 'treasurer'),
(10, 'treasury_reconciliation_officer');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `amount` decimal(15,2) NOT NULL,
  `account_id` int NOT NULL,
  `department_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_attachments`
--

CREATE TABLE `transaction_attachments` (
  `id` int NOT NULL,
  `transaction_id` int NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `treasury_reconciliation_items`
--

CREATE TABLE `treasury_reconciliation_items` (
  `id` int NOT NULL,
  `transaction_id` int NOT NULL,
  `reconciliation_date` date NOT NULL,
  `user_id` int NOT NULL,
  `reference_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int NOT NULL,
  `department_id` int DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `role_id`, `department_id`, `is_active`, `remember_token`) VALUES
(1, 'admin01', '$2y$12$Cy73vWzkYGAjnpybpWpphuYXJH1nF/rM8cJS6QWOOb232Reeto6qe', 'admin', 1, 1, 1, NULL),
(2, 'aj_boasod', '$2y$12$Cy73vWzkYGAjnpybpWpphuYXJH1nF/rM8cJS6QWOOb232Reeto6qe', 'aj_boasod', 2, 2, 1, 'y2AaV9X322w0gtwEhdn87ME3QaVv5pMatwqMIQQN1479CtV7ECUS8xO6J8Ma'),
(3, 'accountant01', '$2y$12$Cy73vWzkYGAjnpybpWpphuYXJH1nF/rM8cJS6QWOOb232Reeto6qe', 'accountant', 3, 1, 1, NULL),
(4, 'accountant02', '$2y$12$Cy73vWzkYGAjnpybpWpphuYXJH1nF/rM8cJS6QWOOb232Reeto6qe', 'accountantnaja', 3, 3, 0, NULL),
(5, 'hong_head_fac', '$2y$12$Cy73vWzkYGAjnpybpWpphuYXJH1nF/rM8cJS6QWOOb232Reeto6qe', 'hong_fac', 4, 5, 1, NULL),
(6, 'head_fac', '$2y$12$Cy73vWzkYGAjnpybpWpphuYXJH1nF/rM8cJS6QWOOb232Reeto6qe', 'head_fac', 5, 5, 1, NULL),
(8, 'Teng1122', '$2y$12$VV.VHc/Efa2JrlWZpa04QuxAj7DJUDEzUvcMoHzUW3/uNevf/ZULS', 'Teng', 1, 1, 1, NULL),
(9, 'valenthaiymany@gmail.com', '$2y$12$UsTnHcVp3x7FH3e9sED34eg0MiP3wWg5oI37YMnhdI6tfl9QbPHr.', 'Valenthaiy Many', 6, 4, 1, NULL),
(10, 'luminusxdd981@gmail.com', '$2y$12$W0b4/PaL.421XOksvS/hn.lEaawX4smoMI5KKuOkUHL3XjszEMojK', 'Valenthaiy Many', 3, 1, 1, NULL),
(11, 'beekhnlor', '$2y$12$1/yzOvXFvq18Qu4FhmVBtu2XO5xLxfu0O78jFx4D3JjRecGJJVAIy', 'beekingword', 1, 1, 1, NULL),
(12, 'beesosad', '$2y$12$4BlQSk8TmK/piOLzpkgtsuKXVbn7/O61F8DQDD3dQHzN18EfqdX7i', 'bee', 6, 1, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advance_clearing_items`
--
ALTER TABLE `advance_clearing_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advance_request_id` (`advance_request_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `advance_requests`
--
ALTER TABLE `advance_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requester_id` (`requester_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `payment_transaction_id` (`payment_transaction_id`),
  ADD KEY `idx_advance_requests_status` (`status`);

--
-- Indexes for table `budget_line_items`
--
ALTER TABLE `budget_line_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budget_plan_id` (`budget_plan_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `budget_period_allocations`
--
ALTER TABLE `budget_period_allocations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budget_line_item_id` (`budget_line_item_id`);

--
-- Indexes for table `budget_plans`
--
ALTER TABLE `budget_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_code` (`account_code`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department_name` (`department_name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_workflow_logs`
--
ALTER TABLE `request_workflow_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_workflow_logs_timestamp` (`timestamp`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `idx_transactions_date` (`transaction_date`);

--
-- Indexes for table `transaction_attachments`
--
ALTER TABLE `transaction_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `treasury_reconciliation_items`
--
ALTER TABLE `treasury_reconciliation_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advance_clearing_items`
--
ALTER TABLE `advance_clearing_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advance_requests`
--
ALTER TABLE `advance_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `budget_line_items`
--
ALTER TABLE `budget_line_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `budget_period_allocations`
--
ALTER TABLE `budget_period_allocations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `budget_plans`
--
ALTER TABLE `budget_plans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `request_workflow_logs`
--
ALTER TABLE `request_workflow_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction_attachments`
--
ALTER TABLE `transaction_attachments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `treasury_reconciliation_items`
--
ALTER TABLE `treasury_reconciliation_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advance_clearing_items`
--
ALTER TABLE `advance_clearing_items`
  ADD CONSTRAINT `advance_clearing_items_ibfk_1` FOREIGN KEY (`advance_request_id`) REFERENCES `advance_requests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `advance_clearing_items_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `chart_of_accounts` (`id`);

--
-- Constraints for table `advance_requests`
--
ALTER TABLE `advance_requests`
  ADD CONSTRAINT `advance_requests_ibfk_1` FOREIGN KEY (`requester_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `advance_requests_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `advance_requests_ibfk_3` FOREIGN KEY (`payment_transaction_id`) REFERENCES `transactions` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `budget_line_items`
--
ALTER TABLE `budget_line_items`
  ADD CONSTRAINT `budget_line_items_ibfk_1` FOREIGN KEY (`budget_plan_id`) REFERENCES `budget_plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `budget_line_items_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `chart_of_accounts` (`id`);

--
-- Constraints for table `budget_period_allocations`
--
ALTER TABLE `budget_period_allocations`
  ADD CONSTRAINT `budget_period_allocations_ibfk_1` FOREIGN KEY (`budget_line_item_id`) REFERENCES `budget_line_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `budget_plans`
--
ALTER TABLE `budget_plans`
  ADD CONSTRAINT `budget_plans_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD CONSTRAINT `chart_of_accounts_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `chart_of_accounts` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `request_workflow_logs`
--
ALTER TABLE `request_workflow_logs`
  ADD CONSTRAINT `request_workflow_logs_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `advance_requests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `request_workflow_logs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `chart_of_accounts` (`id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `transaction_attachments`
--
ALTER TABLE `transaction_attachments`
  ADD CONSTRAINT `transaction_attachments_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `treasury_reconciliation_items`
--
ALTER TABLE `treasury_reconciliation_items`
  ADD CONSTRAINT `treasury_reconciliation_items_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `treasury_reconciliation_items_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
