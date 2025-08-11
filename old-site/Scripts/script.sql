------------------- 15-sep-2021 ---------------
-- ShahbazLaptop , Furqan , Asif

update `projects` set progress = "Pre-Live" where progress like '%Complete%';
update `projects` set progress = "Pre-Live" where progress like '%Pre Live%';

------------------- 29-sep-2021 ---------------
-- ShahbazLaptop, HassanLaptop, LiveDB

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_name` varchar(255) NOT NULL,
  `isActive` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


insert  into `user_types`(`id`,`user_type_name`,`isActive`,`created_at`,`updated_at`) values 
(-10025,'Builder',1,current_timestamp(),NULL),
(-10024,'Web Site User',1,current_timestamp(),NULL),
(-10023,'Employee',1,current_timestamp(),NULL),
(-10022,'Admin',1,current_timestamp(),NULL),
(-10021,'Super Admin',1,current_timestamp(),NULL);

ALTER TABLE users ADD user_type_id int AFTER username;

ALTER TABLE users
ADD CONSTRAINT fk_users_user_type_id FOREIGN KEY (user_type_id)
REFERENCES user_types (id);

ALTER TABLE builders ADD user_id int AFTER full_name;

ALTER TABLE builders Modify user_id bigint;

ALTER TABLE builders Modify user_id bigint unsigned;

ALTER TABLE builders
ADD CONSTRAINT fk_builders_user_id FOREIGN KEY (user_id)
REFERENCES users (id);

update users SET user_type_id = -10024;

update users SET 
first_name="Mr.Mark",
last_name = "propriters",
email="super@mark360.com",
password="$2y$10$RTt4PgzCH3zMYvLXSiBbheMduv40u9c1nqHMwMhvX/2QwnAgAvjju",
user_type_id = -10021 
WHERE id = 1;


------------------- 1-oct-2021 ---------------
-- HassanLaptop,ShahbazLaptop, LiveDB

ALTER TABLE user_search_history ADD search_type varchar(255) AFTER user_id;


------------------- 09-10-2021  ------------------ 
-- AsifRasheedLaptop, ShahbazLaptop, HassanLaptop, LiveDB

ALTER TABLE users
ADD Address varchar(255);
ADD city varchar(255);
ADD about_me varchar(255);
ADD image varchar(255);


CREATE TABLE `contactus` ( 
 `id` int(11) NOT NULL AUTO_INCREMENT, 
 `name` varchar(255) NULL,
 `email` varchar(255) NULL, 
 `phone` varchar(255) NULL, 
 `subject` varchar(255) NULL, 
 `message` varchar(255) NULL, 
 `created_at` timestamp NULL DEFAULT current_timestamp(), 
 `updated_at` timestamp NULL DEFAULT NULL, 
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


------------------- 11-10-2021  ------------------ 
-- ShahbazLaptop, HassanLaptop, LiveDB

ALTER TABLE `recent_views` CHANGE `project_id` `project_id` BIGINT(20) UNSIGNED NOT NULL;

DELETE from recent_views;

ALTER TABLE recent_views
ADD CONSTRAINT fk_recent_views_project_id FOREIGN KEY (project_id)
REFERENCES projects (id);

ALTER TABLE `recent_views` CHANGE `user_id` `user_id` BIGINT(20) UNSIGNED NOT NULL;

ALTER TABLE recent_views
ADD CONSTRAINT fk_recent_views_user_id FOREIGN KEY (user_id)
REFERENCES users (id);


------------------- 13-10-2021  ------------------ 
--  HassanLaptop, LiveDB,ShahbazLaptop

TRUNCATE user_search_history;

------------------- 18-10-2021  ------------------ 
-- ShahbazLaptop, LiveDB,AsifLaptop, HassanLaptop

ALTER TABLE `users` ADD `phone_no_otp` VARCHAR(20) NULL DEFAULT NULL AFTER `provider`, ADD `is_phone_no_verified` TINYINT(1) NOT NULL DEFAULT '0' AFTER `phone_no_otp`;

ALTER TABLE `users` CHANGE `email` `email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;

------------------- 22-10-2021  ------------------ 
-- AsifLaptop, LiveDB, HassanLaptop, ShahbazLaptop

update `projects` set progress = "Pre-Launch" where progress like '%Complete%';
update `projects` set progress = "Pre-Launch" where progress like '%Pre Live%';
update `projects` set progress = "Pre-Launch" where progress like '%Pre-Live%';

------------------- 27-10-2021  ------------------ 
-- ShahbazLaptop, AsifLaptop, LiveDB,

ALTER TABLE `units` CHANGE `measurement_type` `measurement_type` BIGINT(20) UNSIGNED NOT NULL DEFAULT '1';

ALTER TABLE units
ADD CONSTRAINT fk_units_measurement_type FOREIGN KEY (measurement_type)
REFERENCES measurements (id);

------------------- 27-10-2021  ------------------ 
-- ShahbazLaptop,LiveDB,AsifLaptop

ALTER TABLE `room_type_unit` CHANGE `project_id` `project_id` BIGINT(20) UNSIGNED NOT NULL;

ALTER TABLE room_type_unit
ADD CONSTRAINT fk_room_type_unit_room_type_id FOREIGN KEY (room_type_id)
REFERENCES room_types (id);

ALTER TABLE room_type_unit
ADD CONSTRAINT fk_room_type_unit_unit_id FOREIGN KEY (unit_id)
REFERENCES units (id);

ALTER TABLE room_type_unit
ADD CONSTRAINT fk_room_type_unit_project_id FOREIGN KEY (project_id)
REFERENCES projects (id);



------------------- 04-11-2021  ------------------ 
-- HassanLaptop,LiveDB,AsifLaptop,ShahbazLaptop


TRUNCATE user_search_history;

ALTER TABLE user_search_history ADD minDP decimal(65,8) AFTER json;
ALTER TABLE user_search_history ADD maxnDP decimal(65,8) AFTER json;
ALTER TABLE user_search_history ADD minMI decimal(65,8) AFTER json;
ALTER TABLE user_search_history ADD maxMI decimal(65,8) AFTER json;
ALTER TABLE user_search_history ADD minPrice decimal(65,8) AFTER json;
ALTER TABLE user_search_history ADD maxPrice decimal(65,8) AFTER json;

---------------- 04-11-2021 -----------------------------
--AsifRasheedLaptop, LiveDB ,ShahbazLaptop, HassanLaptop

ALTER TABLE `user_search_history` CHANGE `maxnDP` `maxDP` DECIMAL(65,8) NULL DEFAULT NULL;


---------------- 04-11-2021 -----------------------------
-- ShahbazLaptop, AsifRasheedLaptop, LiveDB

ALTER TABLE `room_type_unit` ADD `width_feet` INT NULL DEFAULT NULL AFTER `width`, ADD `width_inches` INT NULL DEFAULT NULL AFTER `width_feet`;

ALTER TABLE `room_type_unit` ADD `length_feet` INT NULL DEFAULT NULL AFTER `length`, ADD `length_inches` INT NULL DEFAULT NULL AFTER `length_feet`;

ALTER TABLE `room_type_unit` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `room_type_unit` CHANGE `width` `width` DECIMAL(12,2) UNSIGNED NULL DEFAULT NULL, CHANGE `length` `length` DECIMAL(12,2) UNSIGNED NULL DEFAULT NULL;


------------------- 08-11-2021  ------------------ 
-- HassanLaptop, AsifLaptop,LiveDB


TRUNCATE payment_schedule;

ALTER TABLE payment_schedule ADD down_payment decimal(65,8) AFTER json;
ALTER TABLE payment_schedule ADD monthly_installment decimal(65,8) AFTER json;
ALTER TABLE payment_schedule ADD quarterly_installment decimal(65,8) AFTER json;
ALTER TABLE payment_schedule ADD half_yearly_installment decimal(65,8) AFTER json;
ALTER TABLE payment_schedule ADD yearly_installment decimal(65,8) AFTER json;
ALTER TABLE payment_schedule ADD possession decimal(65,8) AFTER json;
ALTER TABLE payment_schedule ADD loan_amount decimal(65,8) AFTER json;

---------------- 08-11-2021 -----------------------------
-- ShahbazLaptop, AsifLaptop,LiveDB

ALTER TABLE `room_type_unit` ADD `is_display_on_listing` TINYINT(1) NOT NULL DEFAULT '0' AFTER `extras`;


---------------- 08-11-2021 -----------------------------
-- LiveDB,ShahbazLaptop

ALTER TABLE `blog` CHANGE `category_id` `category_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL;

update `blog` SET category_id = null

ALTER TABLE blog
ADD CONSTRAINT fk_blog_category_id FOREIGN KEY (category_id)
REFERENCES blog_category (id);

ALTER TABLE `blog` CHANGE `category_id` `category_id` BIGINT(20) UNSIGNED NOT NULL;



ALTER TABLE `payment_schedule` CHANGE `user_id` `user_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `payment_schedule` CHANGE `project_id` `project_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `payment_schedule` CHANGE `unit_id` `unit_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL;

update `payment_schedule` set user_id = null where user_id = 0;
update `payment_schedule` set project_id = null where project_id = 0;
update `payment_schedule` set unit_id = null where unit_id = 0;

ALTER TABLE payment_schedule
ADD CONSTRAINT fk_payment_schedule_user_id FOREIGN KEY (user_id)
REFERENCES users (id);

ALTER TABLE payment_schedule
ADD CONSTRAINT fk_payment_schedule_project_id FOREIGN KEY (project_id)
REFERENCES projects (id);

ALTER TABLE payment_schedule
ADD CONSTRAINT fk_payment_schedule_unit_id FOREIGN KEY (unit_id)
REFERENCES units (id);

ALTER TABLE `payment_schedule` CHANGE `user_id` `user_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `payment_schedule` CHANGE `project_id` `project_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `payment_schedule` CHANGE `unit_id` `unit_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL;

ALTER TABLE `payment_schedule` ADD `is_archive` TINYINT(1) NULL DEFAULT '0' AFTER `updated_at`,
ADD `is_archive_by` INT NULL DEFAULT NULL AFTER `is_archive`,
ADD `is_archive_at` TIMESTAMP NULL DEFAULT NULL AFTER `is_archive_by`;



ALTER TABLE `projects` ADD `is_archive` TINYINT(1) NULL DEFAULT '0' AFTER `updated_at`,
ADD `is_archive_by` INT NULL DEFAULT NULL AFTER `is_archive`,
ADD `is_archive_at` TIMESTAMP NULL DEFAULT NULL AFTER `is_archive_by`;

ALTER TABLE `projects` ADD `created_by` INT NULL DEFAULT NULL AFTER `added_time`,
ADD `updated_by` INT NULL DEFAULT NULL AFTER `created_by`;



ALTER TABLE `project_area` CHANGE `area_id` `area_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `project_area` CHANGE `project_id` `project_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL;

update `project_area` set area_id = null where area_id = 0;
update `project_area` set project_id = null where project_id = 0;

ALTER TABLE project_area
ADD CONSTRAINT fk_project_area_area_id FOREIGN KEY (area_id)
REFERENCES areas (id);

ALTER TABLE project_area
ADD CONSTRAINT fk_project_area_project_id FOREIGN KEY (project_id)
REFERENCES projects (id);

ALTER TABLE `project_area` CHANGE `area_id` `area_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `project_area` CHANGE `project_id` `project_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL;

ALTER TABLE `project_area` ADD `is_archive` TINYINT(1) NULL DEFAULT '0' AFTER `updated_at`,
ADD `is_archive_by` INT NULL DEFAULT NULL AFTER `is_archive`,
ADD `is_archive_at` TIMESTAMP NULL DEFAULT NULL AFTER `is_archive_by`;


---------------- 15-11-2021 -----------------------------
-- ShahbazLaptop, LiveDB, Asif Laptop

ALTER TABLE `units` ADD `is_archive` TINYINT(1) NULL DEFAULT '0' AFTER `updated_at`,
ADD `is_archive_by` INT NULL DEFAULT NULL AFTER `is_archive`,
ADD `is_archive_at` TIMESTAMP NULL DEFAULT NULL AFTER `is_archive_by`;

---------------- 15-11-2021 -----------------------------
-- LiveDB, AsifLaptop

ALTER TABLE `units` CHANGE `installment_type` `installment_type` BIGINT(20) UNSIGNED NOT NULL DEFAULT '1';

ALTER TABLE units
ADD CONSTRAINT fk_units_installment_type FOREIGN KEY (installment_type)
REFERENCES installment_type (id);

ALTER TABLE units
ADD CONSTRAINT fk_units_project_id FOREIGN KEY (project_id)
REFERENCES projects (id);

ALTER TABLE `units` CHANGE `unit_type_id` `unit_type_id` BIGINT(20) UNSIGNED NOT NULL;

ALTER TABLE units
ADD CONSTRAINT fk_units_unit_type_id FOREIGN KEY (unit_type_id)
REFERENCES project_type (id);

---------------- 18-11-2021 -----------------------------
-- ShahbazLaptop, HassanLaptop, LiveDB, AsifLaptop

ALTER TABLE `room_types` ADD `sort_order` TINYINT NULL DEFAULT NULL AFTER `to_show`;

------------------- 20-11-2021  ------------------ 
-- HassanLaptop,ShahbazLaptop, LiveDB, AsifLaptop

TRUNCATE user_search_history;

ALTER TABLE user_search_history ADD downPayment decimal(65,8) AFTER json;
ALTER TABLE user_search_history ADD maxBudget decimal(65,8) AFTER json;

------------------- 23-11-2021  ------------------ 
-- ShahbazLaptop, HassanLaptop, LiveDB, AsifLaptop

ALTER TABLE `room_type_unit` CHANGE `is_display_on_listing` `is_display_on_listing` TINYINT(1) NOT NULL DEFAULT '1';

ALTER TABLE `room_type_unit` ADD `is_archive` TINYINT(1) NULL DEFAULT '0' AFTER `updated_at`,
ADD `is_archive_by` INT NULL DEFAULT NULL AFTER `is_archive`,
ADD `is_archive_at` TIMESTAMP NULL DEFAULT NULL AFTER `is_archive_by`;

------------------- 24-11-2021  ------------------ 
-- ShahbazLaptop, HassanLaptop, LiveDB, AsifLaptop


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `amenities` (
  `id` int(11) NOT NULL,
  `amenity_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_archive` tinyint(1) NOT NULL DEFAULT 0,
  `is_archive_by` int(11) DEFAULT NULL,
  `is_archive_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `amenities` (`id`, `amenity_name`, `is_active`, `is_archive`, `is_archive_by`, `is_archive_at`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'GYM', 1, 0, NULL, NULL, 1, NULL, '2021-11-24 21:27:11', NULL),
(2, 'Masjid', 1, 0, NULL, NULL, 1, NULL, '2021-11-24 21:27:11', NULL),
(3, 'Hotel', 1, 0, NULL, NULL, 1, NULL, '2021-11-24 21:27:58', NULL),
(4, 'School', 1, 0, NULL, NULL, 1, NULL, '2021-11-24 21:27:58', NULL),
(5, 'Hall', 1, 0, NULL, NULL, 1, NULL, '2021-11-24 21:28:26', NULL),
(6, 'Park', 1, 0, NULL, NULL, 1, NULL, '2021-11-24 21:28:26', NULL);

ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

ALTER TABLE `amenities` MODIFY COLUMN `created_by` bigint(20) UNSIGNED;

ALTER TABLE amenities
ADD CONSTRAINT fk_amenities_created_by FOREIGN KEY (created_by)
REFERENCES users (id);

CREATE TABLE `utilities` (
  `id` int(11) NOT NULL,
  `utility_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_archive` tinyint(1) NOT NULL DEFAULT 0,
  `is_archive_by` int(11) DEFAULT NULL,
  `is_archive_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL ,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `utilities` (`id`, `utility_name`, `is_active`, `is_archive`, `is_archive_by`, `is_archive_at`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Electricity', 1, 0, NULL, NULL, 1, NULL, '2021-11-24 21:27:11', NULL),
(2, 'Sui Gas', 1, 0, NULL, NULL, 1, NULL, '2021-11-24 21:27:11', NULL),
(3, 'Sweet Water', 1, 0, NULL, NULL, 1, NULL, '2021-11-24 21:27:58', NULL),
(4, 'Water Boring', 1, 0, NULL, NULL, 1, NULL, '2021-11-24 21:27:58', NULL);

ALTER TABLE `utilities`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `utilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

ALTER TABLE utilities
ADD CONSTRAINT fk_utilities_created_by FOREIGN KEY (created_by)
REFERENCES users (id);

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `project_utilities` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `utility_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_archive` tinyint(1) NOT NULL DEFAULT 0,
  `is_archive_by` int(11) DEFAULT NULL,
  `is_archive_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `project_utilities`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `project_utilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `project_utilities` MODIFY COLUMN `project_id` bigint(20) UNSIGNED;

ALTER TABLE project_utilities
ADD CONSTRAINT fk_project_utilities_created_by FOREIGN KEY (created_by)
REFERENCES users (id);

ALTER TABLE project_utilities
ADD CONSTRAINT fk_project_utilities_project_id FOREIGN KEY (project_id)
REFERENCES projects (id);

ALTER TABLE project_utilities
ADD CONSTRAINT fk_project_utilities_utility_id FOREIGN KEY (utility_id)
REFERENCES utilities (id);

INSERT INTO `project_utilities` (`id`, `project_id`, `utility_id`, `is_active`, `is_archive`, `is_archive_by`, `is_archive_at`, `created_by`, `updated_by`, `created_at`, `updated_at`) 
VALUES (NULL, '77', '1', '1', '0', NULL, NULL, '1', NULL, current_timestamp(), NULL);
INSERT INTO `project_utilities` (`id`, `project_id`, `utility_id`, `is_active`, `is_archive`, `is_archive_by`, `is_archive_at`, `created_by`, `updated_by`, `created_at`, `updated_at`) 
VALUES (NULL, '77', '2', '1', '0', NULL, NULL, '1', NULL, current_timestamp(), NULL);
INSERT INTO `project_utilities` (`id`, `project_id`, `utility_id`, `is_active`, `is_archive`, `is_archive_by`, `is_archive_at`, `created_by`, `updated_by`, `created_at`, `updated_at`) 
VALUES (NULL, '77', '3', '1', '0', NULL, NULL, '1', NULL, current_timestamp(), NULL);
INSERT INTO `project_utilities` (`id`, `project_id`, `utility_id`, `is_active`, `is_archive`, `is_archive_by`, `is_archive_at`, `created_by`, `updated_by`, `created_at`, `updated_at`) 
VALUES (NULL, '77', '4', '1', '0', NULL, NULL, '1', NULL, current_timestamp(), NULL);

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `project_amenities` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `amenity_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_archive` tinyint(1) NOT NULL DEFAULT 0,
  `is_archive_by` int(11) DEFAULT NULL,
  `is_archive_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `project_amenities`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `project_amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `project_amenities` MODIFY COLUMN `project_id` bigint(20) UNSIGNED;

ALTER TABLE project_amenities
ADD CONSTRAINT fk_project_amenities_created_by FOREIGN KEY (created_by)
REFERENCES users (id);

ALTER TABLE project_amenities
ADD CONSTRAINT fk_project_amenities_project_id FOREIGN KEY (project_id)
REFERENCES projects (id);

ALTER TABLE project_amenities
ADD CONSTRAINT fk_project_amenities_amenity_id FOREIGN KEY (amenity_id)
REFERENCES utilities (id);

INSERT INTO `project_amenities` (`id`, `project_id`, `amenity_id`, `is_active`, `is_archive`, `is_archive_by`, `is_archive_at`, `created_by`, `updated_by`, `created_at`, `updated_at`) 
VALUES (NULL, '77', '1', '1', '0', NULL, NULL, '1', NULL, current_timestamp(), NULL);
INSERT INTO `project_amenities` (`id`, `project_id`, `amenity_id`, `is_active`, `is_archive`, `is_archive_by`, `is_archive_at`, `created_by`, `updated_by`, `created_at`, `updated_at`) 
VALUES (NULL, '77', '2', '1', '0', NULL, NULL, '1', NULL, current_timestamp(), NULL);
INSERT INTO `project_amenities` (`id`, `project_id`, `amenity_id`, `is_active`, `is_archive`, `is_archive_by`, `is_archive_at`, `created_by`, `updated_by`, `created_at`, `updated_at`) 
VALUES (NULL, '77', '3', '1', '0', NULL, NULL, '1', NULL, current_timestamp(), NULL);
INSERT INTO `project_amenities` (`id`, `project_id`, `amenity_id`, `is_active`, `is_archive`, `is_archive_by`, `is_archive_at`, `created_by`, `updated_by`, `created_at`, `updated_at`) 
VALUES (NULL, '77', '4', '1', '0', NULL, NULL, '1', NULL, current_timestamp(), NULL);

ALTER TABLE project_amenities
DROP CONSTRAINT fk_project_amenities_amenity_id;

ALTER TABLE project_amenities
DROP INDEX fk_project_amenities_amenity_id;

ALTER TABLE project_amenities
ADD CONSTRAINT fk_project_amenities_amenity_id FOREIGN KEY (amenity_id)
REFERENCES amenities (id);

------------------- 27-11-2021  ------------------ 
-- HassanLaptop, LiveDB, AsifLaptop, ShahbazLaptop

ALTER TABLE user_search_history ADD slabCasting decimal(65,8) AFTER json;
ALTER TABLE user_search_history ADD plinth decimal(65,8) AFTER json;
ALTER TABLE user_search_history ADD colour decimal(65,8) AFTER json;
ALTER TABLE user_search_history ADD monthInstall decimal(65,8) AFTER json;
ALTER TABLE user_search_history ADD yearlyInstall decimal(65,8) AFTER json;
ALTER TABLE user_search_history ADD halfYearlyInstall decimal(65,8) AFTER json;
ALTER TABLE user_search_history ADD quarterlyInstall decimal(65,8) AFTER json;
ALTER TABLE user_search_history ADD possession decimal(65,8) AFTER json;

------------------- 201-12-2021  ------------------ 
-- HassanLaptop, ShahbazLaptop, LiveDB, AsifLaptop


TRUNCATE payment_schedule;
ALTER TABLE payment_schedule ADD slab_casting decimal(65,8) AFTER json;
ALTER TABLE payment_schedule ADD plinth decimal(65,8) AFTER json;
ALTER TABLE payment_schedule ADD colour decimal(65,8) AFTER json;
ALTER TABLE payment_schedule ADD start_of_work decimal(65,8) AFTER json;

------------------- 02-12-2021  ------------------ 
-- ShahbazLaptop, LiveDB, AsifLaptop, HassanLaptop

ALTER TABLE `units` CHANGE `installment` `installment` INT NULL DEFAULT NULL;
ALTER TABLE `units` CHANGE `covered_area` `covered_area` DECIMAL(16,2) UNSIGNED NULL DEFAULT NULL;

ALTER TABLE `units` CHANGE `price` `price` DECIMAL(16,2) UNSIGNED NOT NULL, CHANGE `loan_amount` `loan_amount` DECIMAL(16,2) NOT NULL, CHANGE `monthly_installment` `monthly_installment` DECIMAL(16,2) UNSIGNED NOT NULL, CHANGE `down_payment` `down_payment` DECIMAL(16,2) UNSIGNED NOT NULL;

ALTER TABLE `blog` ADD `is_archive` TINYINT(1) NULL DEFAULT '0' AFTER `updated_at`,
ADD `is_archive_by` INT NULL DEFAULT NULL AFTER `is_archive`,
ADD `is_archive_at` TIMESTAMP NULL DEFAULT NULL AFTER `is_archive_by`;

ALTER TABLE `tags` ADD `is_archive` TINYINT(1) NULL DEFAULT '0' AFTER `updated_at`,
ADD `is_archive_by` INT NULL DEFAULT NULL AFTER `is_archive`,
ADD `is_archive_at` TIMESTAMP NULL DEFAULT NULL AFTER `is_archive_by`;


------------------- 04-12-2021  ------------------ 
-- ShahbazLaptop, LiveDB, AsifLaptop, HassanLaptop

ALTER TABLE `units` ADD `total_unit_amount` DECIMAL(16,2) NULL DEFAULT NULL AFTER `loan_amount`;

update `units` set total_unit_amount = (price+loan_amount);

ALTER TABLE units MODIFY total_unit_amount decimal(16,2) NOT NULL;

------------------- 07-12-2021  ------------------ 
-- AsifLaptop, LiveDB, ShahbazLaptop, HassanLaptop

ALTER TABLE builders
ADD CONSTRAINT fk_builders_user_id FOREIGN KEY (user_id)
REFERENCES users (id);

------------------- 09-12-2021  ------------------ 
-- ShahbazLaptop, HassanLaptop, LiveDB, AsifLaptop


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

ALTER TABLE activity_log
ADD CONSTRAINT fk_activity_log_causer_id FOREIGN KEY (causer_id)
REFERENCES users (id);

------------------- 13-12-2021  ------------------ 
-- ShahbazLaptop, HassanLaptop, LiveDB, AsifLaptop

ALTER TABLE `activity_log` ADD `page_url` VARCHAR(255) NULL DEFAULT NULL AFTER `properties`, ADD `duration_in_second` BIGINT NULL DEFAULT NULL AFTER `page_url`;

ALTER TABLE `activity_log` ADD `ip` VARCHAR(255) NULL DEFAULT NULL AFTER `duration_in_second`;

ALTER TABLE `activity_log` ADD `log_table` VARCHAR(255) NULL DEFAULT NULL AFTER `log_name`;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `progress_status` (
  `id` int(11) NOT NULL,
  `progress_status_name` varchar(255) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `is_archive_by` int(11) DEFAULT NULL,
  `is_archive_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `progress_status`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `progress_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `progress_status` CHANGE `created_by` `created_by` BIGINT UNSIGNED NOT NULL;

ALTER TABLE progress_status
ADD CONSTRAINT fk_progress_status_created_by FOREIGN KEY (created_by)
REFERENCES users (id);

ALTER TABLE `projects` ADD `progress_status_id` INT NULL DEFAULT NULL AFTER `progress`;

INSERT INTO `progress_status` (`id`, `progress_status_name`, `isActive`, `is_archive_by`, `is_archive_at`, `created_by`, `created_at`, `updated_by`, `updated_at`) 
VALUES 
(1, 'Under Construction', '1', NULL, NULL, '1', current_timestamp(), NULL, NULL), 
(2, 'Ready for Possession', '1', NULL, NULL, '1', current_timestamp(), NULL, NULL);
(3, 'Pre-Launch', '1', NULL, NULL, '1', current_timestamp(), NULL, NULL);

ALTER TABLE projects
ADD CONSTRAINT fk_projects_progress_status_id FOREIGN KEY (progress_status_id)
REFERENCES progress_status (id);

UPDATE `projects` set progress_status_id = 1 WHERE progress = "Under Construction";

UPDATE `projects` set progress_status_id = 2 WHERE progress = "Ready for Possession";

UPDATE `projects` set progress_status_id = 3 WHERE progress = "Pre-Launch";

------------------- 17-12-2021  ------------------ 
-- ShahbazLaptop, HassanLaptop, LiveDB, AsifLaptop

ALTER TABLE `activity_log` ADD `objective` VARCHAR(255) NULL DEFAULT NULL AFTER `description`;

ALTER TABLE `activity_log` ADD `created_date` DATE NULL DEFAULT NULL AFTER `ip`;

------------------- 18-12-2021  ------------------ 
-- ShahbazLaptop, LiveDB, HassanLaptop

ALTER TABLE `progress_status` ADD `is_archive` TINYINT(1) NULL DEFAULT '0' AFTER `updated_at`;

------------------- 20-12-2021  ------------------ 
-- ShahbazLaptop, LiveDB, AsifLaptop

ALTER TABLE `activity_log` 
ADD `conversion` VARCHAR(255) NULL DEFAULT NULL AFTER `description`,
ADD `conversion_id` INT NULL DEFAULT NULL AFTER `conversion`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `activity_log_conversions` (
  `id` int(11) NOT NULL,
  `conversion` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `activity_log_conversions`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `activity_log_conversions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE activity_log
ADD CONSTRAINT fk_activity_log_conversion_id FOREIGN KEY (conversion_id)
REFERENCES activity_log_conversions (id);

INSERT INTO `activity_log_conversions` (`id`, `conversion`, `description`) 
VALUES 
('-10001', 'viewPage', 'View Page'), 
('-10002', 'submitPropertyInquiry', 'Submit Property Inquiry');

INSERT INTO `activity_log_conversions` (`id`, `conversion`, `description`) 
VALUES 
('-10003', 'clickToCall', 'Click to call'), 
('-10004', 'cutomizedPaymentPlan', 'Submit Customized Payment Plan');

INSERT INTO `activity_log_conversions` (`id`, `conversion`, `description`) 
VALUES ('-10005', 'downloadPdf', 'Download PDF');


------------------- 22-12-2021  ------------------ 
-- HassanLaptop,ShahbazLaptop, LiveDB, AsifLaptop

ALERT TABLE user_search_history ADD cookie text AFTER 'json';

------------------- 22-12-2021  ------------------ 
-- ShahbazLaptop, LiveDB, AsifLaptop

INSERT INTO `activity_log_conversions` (`id`, `conversion`, `description`) VALUES 
('-10006', 'loggedIn', 'User has been logged in'), 
('-10007', 'clickToCompare', 'Click To Compare');

UPDATE `activity_log_conversions` SET `description` = 'View Content' WHERE `activity_log_conversions`.`id` = -10003;

------------------- 03-01-2022  ------------------ 
-- ShahbazLaptop, LiveDb, AsifLaptop

ALTER TABLE `users` ADD `is_archive` TINYINT(1) NULL DEFAULT '0' AFTER `updated_at`,
ADD `is_archive_by` INT NULL DEFAULT NULL AFTER `is_archive`,
ADD `is_archive_at` TIMESTAMP NULL DEFAULT NULL AFTER `is_archive_by`;

ALTER TABLE `areas` ADD `is_archive` TINYINT(1) NULL DEFAULT '0' AFTER `updated_at`,
ADD `is_archive_by` INT NULL DEFAULT NULL AFTER `is_archive`,
ADD `is_archive_at` TIMESTAMP NULL DEFAULT NULL AFTER `is_archive_by`;

ALTER TABLE `project_type` ADD `is_archive` TINYINT(1) NULL DEFAULT '0' AFTER `updated_at`,
ADD `is_archive_by` INT NULL DEFAULT NULL AFTER `is_archive`,
ADD `is_archive_at` TIMESTAMP NULL DEFAULT NULL AFTER `is_archive_by`;

ALTER TABLE `room_types` ADD `is_archive` TINYINT(1) NULL DEFAULT '0' AFTER `updated_at`,
ADD `is_archive_by` INT NULL DEFAULT NULL AFTER `is_archive`,
ADD `is_archive_at` TIMESTAMP NULL DEFAULT NULL AFTER `is_archive_by`;

ALTER TABLE `builders` ADD `is_archive` TINYINT(1) NULL DEFAULT '0' AFTER `updated_at`,
ADD `is_archive_by` INT NULL DEFAULT NULL AFTER `is_archive`,
ADD `is_archive_at` TIMESTAMP NULL DEFAULT NULL AFTER `is_archive_by`;

ALTER TABLE `blog_category` ADD `is_archive` TINYINT(1) NULL DEFAULT '0' AFTER `updated_at`,
ADD `is_archive_by` INT NULL DEFAULT NULL AFTER `is_archive`,
ADD `is_archive_at` TIMESTAMP NULL DEFAULT NULL AFTER `is_archive_by`;

------------------- 07-01-2022  ------------------ 
-- AsifLaptop

CREATE TABLE `vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` bigint(20) UNSIGNED DEFAULT NULL,
  `data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `vouchers`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `vouchers_code_unique` (`code`),
ADD KEY `vouchers_model_type_model_id_index` (`model_type`,`model_id`);

ALTER TABLE `vouchers`
MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;


CREATE TABLE `user_voucher` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `voucher_id` bigint(20) UNSIGNED NOT NULL,
  `redeemed_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `user_voucher`
ADD PRIMARY KEY (`id`),
ADD KEY `user_voucher_user_id_foreign` (`user_id`),
ADD KEY `user_voucher_voucher_id_foreign` (`voucher_id`);


ALTER TABLE `user_voucher`
MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_voucher`
ADD CONSTRAINT `user_voucher_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
ADD CONSTRAINT `user_voucher_voucher_id_foreign` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`);
COMMIT;  

ALTER TABLE `projects` ADD `discount_price` DECIMAL(65,8) NOT NULL DEFAULT '0.00000000' AFTER `min_price`;

----- AsifLaptop 1/15/2022

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

  ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;