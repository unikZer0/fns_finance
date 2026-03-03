-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 29, 2026 at 10:41 AM
-- Server version: 8.0.44
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fns_finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `advance_clearing_items`
--

CREATE TABLE `advance_clearing_items` (
  `id` int NOT NULL,
  `advance_request_id` int NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `account_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advance_requests`
--

CREATE TABLE `advance_requests` (
  `id` int NOT NULL,
  `requester_id` int NOT NULL,
  `department_id` int NOT NULL,
  `request_date` date NOT NULL,
  `description` text NOT NULL,
  `requested_amount` decimal(15,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `payment_transaction_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `budget_period_allocations`
--

CREATE TABLE `budget_period_allocations` (
  `id` int NOT NULL,
  `budget_line_item_id` int NOT NULL,
  `period_name` varchar(50) NOT NULL,
  `allocated_amount` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `budget_plans`
--

CREATE TABLE `budget_plans` (
  `id` int NOT NULL,
  `fiscal_year` int NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_accounts`
--

CREATE TABLE `chart_of_accounts` (
  `id` int NOT NULL,
  `account_code` varchar(20) NOT NULL,
  `account_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `department_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `RECOVER_YOUR_DATA_info`
--

CREATE TABLE `RECOVER_YOUR_DATA_info` (
  `READ_ME` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `RECOVER_YOUR_DATA_info`
--

INSERT INTO `RECOVER_YOUR_DATA_info` (`READ_ME`) VALUES
('Dear Sir/Madam,\r\n\r\nWe hope this message finds you well.\r\n\r\nWe would like to let you know that we created a backup of your databases/tables (we keep them for 30 days and then your data will be publicly disclosed and permanently delete them from our servers).\r\n\r\nWe offer you our recover service: if you want to recover your corrupted or incomplete databases/tables, simply transfer 0.015 BTC to this address:\r\n\r\n1DgQuBUZMVZTQfGi7sZwMK8zu1pGQVi7Qa\r\n\r\nThis address is assigned to your database credentials (host + user). We will know when you have paid.\r\n\r\nAfter payment confirmation, our program will restore the entire databases/tables automatically, so please do not change your database login details and make sure the database is still accessible from outside the local network. Don not worry. All your databases and tables will be restored. (If the restore fails the current field will be modified and provide links for you to download your datas).\r\n\r\nPlease take note of the following:\r\n\r\nAfter 30 days, we cannot guarantee that we will be able to send the data to you.\r\n\r\nThe only way to recover your data is by making the payment. We will not provide the data for free.\r\n\r\nData leaks can have serious consequences. Rest assured your data is protected.\r\n\r\nOnce your payment is completed, all your data will be deleted from our servers. Currently, government agencies, competitors, contractors, and local media remain unaware of the incident. Upon receiving your payment, we guarantee that these entities will not be contacted about this matter, ensuring your privacy and the confidentiality of the situation are maintained.\r\n\r\nIf you pay we guarantee that your data will not be sold on Darkweb resources and will not be used to attack your company, employees, or counterparties in the future and the full database dump will be sent to you.\r\n\r\nIf you have not sent the requested amount within 30 days from the date of the incident, we will consider the transaction incomplete. Your data will then be sent to any interested parties. This is your responsibility.\r\n\r\nAfter payment confirmation, our program will restore the entire databases/tables automatically, so please do not change your database login details and make sure the database is still accessible from outside the local network.\r\n\r\nThe only accepted payment method is Bitcoin. To the wallet specified above.\r\n\r\nBe advised: PayPal, WeTransfer, Alipay, credit cards, and other methods will not be accepted.\r\n\r\nIf you do not have Bitcoin, you can purchase it using a credit card from the following websites:\r\n\r\nCoinbase: https://www.coinbase.com/\r\nMoonPay: https://www.moonpay.com/buy\r\nPaybis: https://paybis.com/\r\nChangelly: https://changelly.com/buy\r\nAqua: https://aqua.net/\r\nCEX: https://cex.io/\r\nHodlHodl: https://hodlhodl.com\r\n\r\nAlternatively, you can buy Bitcoin using other payment methods from the following platforms (some of them work in China):\r\n\r\nCoinbase: https://www.coinbase.com/\r\nPaxful: https://paxful.com/\r\nBinance: https://www.binance.com/\r\nCrypto.com: https://www.crypto.com/\r\nHuobi: https://www.huobi.com/\r\nOKCoin: https://www.okcoin.com/\r\nBTCC: https://www.btcc.com/\r\nPaybis: https://paybis.com/\r\nCoinmama: https://coinmama.com/\r\nBitfinex: https://www.bitfinex.com/\r\n\r\nFor users in China, Bitcoin can be purchased with Alipay from:\r\n\r\nCoinCola: https://www.coincola.com/?lang=zh-HK\r\nBitValve: https://www.bitvalve.com/buy-bitcoin/alipay \r\n\r\nIf you don not need to restore your data but you want to prevent it from being leaked, send 0.005 BTC to this address:\r\n\r\n1DgQuBUZMVZTQfGi7sZwMK8zu1pGQVi7Qa\r\n\r\nIn this case, your data will not be made public and will be deleted from our servers without any recovery service.\r\n\r\n\n');

-- --------------------------------------------------------

--
-- Table structure for table `request_workflow_logs`
--

CREATE TABLE `request_workflow_logs` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `user_id` int NOT NULL,
  `action` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL,
  `comments` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `transaction_date` timestamp NOT NULL,
  `description` text,
  `amount` decimal(15,2) NOT NULL,
  `account_id` int NOT NULL,
  `department_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_attachments`
--

CREATE TABLE `transaction_attachments` (
  `id` int NOT NULL,
  `transaction_id` int NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `treasury_reconciliation_items`
--

CREATE TABLE `treasury_reconciliation_items` (
  `id` int NOT NULL,
  `transaction_id` int NOT NULL,
  `reconciliation_date` date NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `role_id` int NOT NULL,
  `department_id` int DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  ADD KEY `payment_transaction_id` (`payment_transaction_id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_workflow_logs`
--
ALTER TABLE `request_workflow_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `department_id` (`department_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budget_line_items`
--
ALTER TABLE `budget_line_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budget_period_allocations`
--
ALTER TABLE `budget_period_allocations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budget_plans`
--
ALTER TABLE `budget_plans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_workflow_logs`
--
ALTER TABLE `request_workflow_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_attachments`
--
ALTER TABLE `transaction_attachments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `treasury_reconciliation_items`
--
ALTER TABLE `treasury_reconciliation_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advance_clearing_items`
--
ALTER TABLE `advance_clearing_items`
  ADD CONSTRAINT `advance_clearing_items_ibfk_1` FOREIGN KEY (`advance_request_id`) REFERENCES `advance_requests` (`id`),
  ADD CONSTRAINT `advance_clearing_items_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `chart_of_accounts` (`id`);

--
-- Constraints for table `advance_requests`
--
ALTER TABLE `advance_requests`
  ADD CONSTRAINT `advance_requests_ibfk_1` FOREIGN KEY (`requester_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `advance_requests_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `advance_requests_ibfk_3` FOREIGN KEY (`payment_transaction_id`) REFERENCES `transactions` (`id`);

--
-- Constraints for table `budget_line_items`
--
ALTER TABLE `budget_line_items`
  ADD CONSTRAINT `budget_line_items_ibfk_1` FOREIGN KEY (`budget_plan_id`) REFERENCES `budget_plans` (`id`),
  ADD CONSTRAINT `budget_line_items_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `chart_of_accounts` (`id`);

--
-- Constraints for table `budget_period_allocations`
--
ALTER TABLE `budget_period_allocations`
  ADD CONSTRAINT `budget_period_allocations_ibfk_1` FOREIGN KEY (`budget_line_item_id`) REFERENCES `budget_line_items` (`id`);

--
-- Constraints for table `request_workflow_logs`
--
ALTER TABLE `request_workflow_logs`
  ADD CONSTRAINT `request_workflow_logs_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `advance_requests` (`id`),
  ADD CONSTRAINT `request_workflow_logs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `chart_of_accounts` (`id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `transaction_attachments`
--
ALTER TABLE `transaction_attachments`
  ADD CONSTRAINT `transaction_attachments_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);

--
-- Constraints for table `treasury_reconciliation_items`
--
ALTER TABLE `treasury_reconciliation_items`
  ADD CONSTRAINT `treasury_reconciliation_items_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
  ADD CONSTRAINT `treasury_reconciliation_items_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
