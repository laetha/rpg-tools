-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2018 at 03:49 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gameripp_users`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'An identifier used to track the type of activity.',
  `occurred_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `ip_address`, `user_id`, `type`, `occurred_at`, `description`) VALUES
(1, '::1', 1, 'sign_in', '2018-02-28 02:47:22', 'User tarfuin signed in.');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `icon` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'fa fa-user' COMMENT 'The icon representing users in this group.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `slug`, `name`, `description`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'terran', 'Terran', 'The terrans are a young species with psionic potential. The terrans of the Koprulu sector descend from the survivors of a disastrous 23rd century colonization mission from Earth.', 'sc sc-terran', '2018-02-28 02:36:34', '2018-02-28 02:36:34'),
(2, 'zerg', 'Zerg', 'Dedicated to the pursuit of genetic perfection, the zerg relentlessly hunt down and assimilate advanced species across the galaxy, incorporating useful genetic code into their own.', 'sc sc-zerg', '2018-02-28 02:36:34', '2018-02-28 02:36:34'),
(3, 'protoss', 'Protoss', 'The protoss, a.k.a. the Firstborn, are a sapient humanoid race native to Aiur. Their advanced technology complements and enhances their psionic mastery.', 'sc sc-protoss', '2018-02-28 02:36:34', '2018-02-28 02:36:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `sprinkle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `sprinkle`, `migration`, `batch`, `created_at`, `updated_at`) VALUES
(1, 'core', '\\UserFrosting\\Sprinkle\\Core\\Database\\Migrations\\v400\\SessionsTable', 1, '2018-02-28 02:36:34', '2018-02-28 02:36:34'),
(2, 'core', '\\UserFrosting\\Sprinkle\\Core\\Database\\Migrations\\v400\\ThrottlesTable', 1, '2018-02-28 02:36:34', '2018-02-28 02:36:34'),
(3, 'account', '\\UserFrosting\\Sprinkle\\Account\\Database\\Migrations\\v400\\ActivitiesTable', 1, '2018-02-28 02:36:34', '2018-02-28 02:36:34'),
(4, 'account', '\\UserFrosting\\Sprinkle\\Account\\Database\\Migrations\\v400\\GroupsTable', 1, '2018-02-28 02:36:34', '2018-02-28 02:36:34'),
(5, 'account', '\\UserFrosting\\Sprinkle\\Account\\Database\\Migrations\\v400\\PasswordResetsTable', 1, '2018-02-28 02:36:34', '2018-02-28 02:36:34'),
(6, 'account', '\\UserFrosting\\Sprinkle\\Account\\Database\\Migrations\\v400\\PermissionRolesTable', 1, '2018-02-28 02:36:36', '2018-02-28 02:36:36'),
(7, 'account', '\\UserFrosting\\Sprinkle\\Account\\Database\\Migrations\\v400\\RolesTable', 1, '2018-02-28 02:36:36', '2018-02-28 02:36:36'),
(8, 'account', '\\UserFrosting\\Sprinkle\\Account\\Database\\Migrations\\v400\\PermissionsTable', 1, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(9, 'account', '\\UserFrosting\\Sprinkle\\Account\\Database\\Migrations\\v400\\PersistencesTable', 1, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(10, 'account', '\\UserFrosting\\Sprinkle\\Account\\Database\\Migrations\\v400\\RoleUsersTable', 1, '2018-02-28 02:36:38', '2018-02-28 02:36:38'),
(11, 'account', '\\UserFrosting\\Sprinkle\\Account\\Database\\Migrations\\v400\\UsersTable', 1, '2018-02-28 02:36:38', '2018-02-28 02:36:38'),
(12, 'account', '\\UserFrosting\\Sprinkle\\Account\\Database\\Migrations\\v400\\VerificationsTable', 1, '2018-02-28 02:36:38', '2018-02-28 02:36:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `expires_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A code that references a specific action or URI that an assignee of this permission has access to.',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `conditions` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'The conditions under which members of this group have access to this hook.',
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `slug`, `name`, `conditions`, `description`, `created_at`, `updated_at`) VALUES
(1, 'create_group', 'Create group', 'always()', 'Create a new group.', '2018-02-28 02:36:36', '2018-02-28 02:36:36'),
(2, 'create_user', 'Create user', 'always()', 'Create a new user in your own group and assign default roles.', '2018-02-28 02:36:36', '2018-02-28 02:36:36'),
(3, 'create_user_field', 'Set new user group', 'subset(fields,[\'group\'])', 'Set the group when creating a new user.', '2018-02-28 02:36:36', '2018-02-28 02:36:36'),
(4, 'delete_group', 'Delete group', 'always()', 'Delete a group.', '2018-02-28 02:36:36', '2018-02-28 02:36:36'),
(5, 'delete_user', 'Delete user', '!has_role(user.id,2) && !is_master(user.id)', 'Delete users who are not Site Administrators.', '2018-02-28 02:36:36', '2018-02-28 02:36:36'),
(6, 'update_account_settings', 'Edit user', 'always()', 'Edit your own account settings.', '2018-02-28 02:36:36', '2018-02-28 02:36:36'),
(7, 'update_group_field', 'Edit group', 'always()', 'Edit basic properties of any group.', '2018-02-28 02:36:36', '2018-02-28 02:36:36'),
(8, 'update_user_field', 'Edit user', '!has_role(user.id,2) && subset(fields,[\'name\',\'email\',\'locale\',\'group\',\'flag_enabled\',\'flag_verified\',\'password\'])', 'Edit users who are not Site Administrators.', '2018-02-28 02:36:36', '2018-02-28 02:36:36'),
(9, 'update_user_field', 'Edit group user', 'equals_num(self.group_id,user.group_id) && !is_master(user.id) && !has_role(user.id,2) && (!has_role(user.id,3) || equals_num(self.id,user.id)) && subset(fields,[\'name\',\'email\',\'locale\',\'flag_enabled\',\'flag_verified\',\'password\'])', 'Edit users in your own group who are not Site or Group Administrators, except yourself.', '2018-02-28 02:36:36', '2018-02-28 02:36:36'),
(10, 'uri_account_settings', 'Account settings page', 'always()', 'View the account settings page.', '2018-02-28 02:36:36', '2018-02-28 02:36:36'),
(11, 'uri_activities', 'Activity monitor', 'always()', 'View a list of all activities for all users.', '2018-02-28 02:36:36', '2018-02-28 02:36:36'),
(12, 'uri_dashboard', 'Admin dashboard', 'always()', 'View the administrative dashboard.', '2018-02-28 02:36:36', '2018-02-28 02:36:36'),
(13, 'uri_group', 'View group', 'always()', 'View the group page of any group.', '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(14, 'uri_group', 'View own group', 'equals_num(self.group_id,group.id)', 'View the group page of your own group.', '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(15, 'uri_groups', 'Group management page', 'always()', 'View a page containing a list of groups.', '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(16, 'uri_user', 'View user', 'always()', 'View the user page of any user.', '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(17, 'uri_user', 'View user', 'equals_num(self.group_id,user.group_id) && !is_master(user.id) && !has_role(user.id,2) && (!has_role(user.id,3) || equals_num(self.id,user.id))', 'View the user page of any user in your group, except the master user and Site and Group Administrators (except yourself).', '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(18, 'uri_users', 'User management page', 'always()', 'View a page containing a table of users.', '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(19, 'view_group_field', 'View group', 'in(property,[\'name\',\'icon\',\'slug\',\'description\',\'users\'])', 'View certain properties of any group.', '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(20, 'view_group_field', 'View group', 'equals_num(self.group_id,group.id) && in(property,[\'name\',\'icon\',\'slug\',\'description\',\'users\'])', 'View certain properties of your own group.', '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(21, 'view_user_field', 'View user', 'in(property,[\'user_name\',\'name\',\'email\',\'locale\',\'theme\',\'roles\',\'group\',\'activities\'])', 'View certain properties of any user.', '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(22, 'view_user_field', 'View user', 'equals_num(self.group_id,user.group_id) && !is_master(user.id) && !has_role(user.id,2) && (!has_role(user.id,3) || equals_num(self.id,user.id)) && in(property,[\'user_name\',\'name\',\'email\',\'locale\',\'roles\',\'group\',\'activities\'])', 'View certain properties of any user in your own group, except the master user and Site and Group Administrators (except yourself).', '2018-02-28 02:36:37', '2018-02-28 02:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `permission_roles`
--

CREATE TABLE `permission_roles` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_roles`
--

INSERT INTO `permission_roles` (`permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(2, 2, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(2, 3, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(3, 2, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(4, 2, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(5, 2, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(6, 1, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(7, 2, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(8, 2, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(9, 3, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(10, 1, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(11, 2, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(12, 1, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(13, 2, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(14, 3, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(15, 2, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(16, 2, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(17, 3, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(18, 2, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(19, 2, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(20, 3, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(21, 2, '2018-02-28 02:36:37', '2018-02-28 02:36:37'),
(22, 3, '2018-02-28 02:36:37', '2018-02-28 02:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `persistences`
--

CREATE TABLE `persistences` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `persistent_token` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `persistences`
--

INSERT INTO `persistences` (`id`, `user_id`, `token`, `persistent_token`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 1, '43ce434f902474bcb264715fbb5ef2b2b786700b', '4c5e22a5a9a4e07a4a78cd80e4567aa9a4f19f4c', '2018-03-07 02:47:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `slug`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'user', 'User', 'This role provides basic user functionality.', '2018-02-28 02:36:36', '2018-02-28 02:36:36'),
(2, 'site-admin', 'Site Administrator', 'This role is meant for \"site administrators\", who can basically do anything except create, edit, or delete other administrators.', '2018-02-28 02:36:36', '2018-02-28 02:36:36'),
(3, 'group-admin', 'Group Administrator', 'This role is meant for \"group administrators\", who can basically do anything with users in their own group, except other administrators of that group.', '2018-02-28 02:36:36', '2018-02-28 02:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-02-28 02:37:23', '2018-02-28 02:37:23'),
(1, 2, '2018-02-28 02:37:23', '2018-02-28 02:37:23'),
(1, 3, '2018-02-28 02:37:23', '2018-02-28 02:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `throttles`
--

CREATE TABLE `throttles` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `request_data` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en_US' COMMENT 'The language and locale to use for this user.',
  `theme` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'The user theme.',
  `group_id` int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'The id of the user group.',
  `flag_verified` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Set to 1 if the user has verified their account via email, 0 otherwise.',
  `flag_enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Set to 1 if the user account is currently enabled, 0 otherwise.  Disabled accounts cannot be logged in to, but they retain all of their data and settings.',
  `last_activity_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'The id of the last activity performed by this user.',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `first_name`, `last_name`, `locale`, `theme`, `group_id`, `flag_verified`, `flag_enabled`, `last_activity_id`, `password`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'tarfuin', 'thaglove10@gmail.com', 'Brian', 'Connor', 'en_US', NULL, 1, 1, 1, 1, '$2y$10$7nPjvjxhRHthG17t9dH5ZemND8vmYsDPEJvMyml7QTLUB3xjQhg1W', NULL, '2018-02-28 02:37:23', '2018-02-28 02:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `verifications`
--

CREATE TABLE `verifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `expires_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activities_user_id_index` (`user_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `groups_slug_unique` (`slug`),
  ADD KEY `groups_slug_index` (`slug`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_user_id_index` (`user_id`),
  ADD KEY `password_resets_hash_index` (`hash`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_roles`
--
ALTER TABLE `permission_roles`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_roles_permission_id_index` (`permission_id`),
  ADD KEY `permission_roles_role_id_index` (`role_id`);

--
-- Indexes for table `persistences`
--
ALTER TABLE `persistences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persistences_user_id_index` (`user_id`),
  ADD KEY `persistences_token_index` (`token`),
  ADD KEY `persistences_persistent_token_index` (`persistent_token`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`),
  ADD KEY `roles_slug_index` (`slug`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_users_user_id_index` (`user_id`),
  ADD KEY `role_users_role_id_index` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `throttles`
--
ALTER TABLE `throttles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `throttles_type_index` (`type`),
  ADD KEY `throttles_ip_index` (`ip`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_user_name_unique` (`user_name`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_user_name_index` (`user_name`),
  ADD KEY `users_email_index` (`email`),
  ADD KEY `users_group_id_index` (`group_id`),
  ADD KEY `users_last_activity_id_index` (`last_activity_id`);

--
-- Indexes for table `verifications`
--
ALTER TABLE `verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verifications_user_id_index` (`user_id`),
  ADD KEY `verifications_hash_index` (`hash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `persistences`
--
ALTER TABLE `persistences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `throttles`
--
ALTER TABLE `throttles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `verifications`
--
ALTER TABLE `verifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
