CREATE DATABASE IF NOT EXISTS `poll_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `poll_db`;

--

CREATE TABLE `candidate` (
  `theme_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `candidate_name` varchar(200) NOT NULL,
  `candidate_img` varchar(128) DEFAULT NULL,
  `candidate_explanation` text NOT NULL,
  `create_by` varchar(16) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(16) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`theme_id`,`candidate_id`);

INSERT INTO `candidate` (`theme_id`, `candidate_id`, `candidate_name`, `candidate_img`, `candidate_explanation`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 1, 'きのこ', 'img/kinotake/kinoko.jpg', 'きのこ', 'aiuchi', '2020-04-17 05:45:25', NULL, NULL),
(1, 2, 'たけのこ', 'img/kinotake/takenoko.jpg', 'たけのこ', 'learnchi', '2020-04-17 05:45:25', NULL, NULL);

-- --------------------------------------------------------

CREATE TABLE `theme` (
  `theme_id` int(11) NOT NULL,
  `theme_name` varchar(200) NOT NULL,
  `theme_explanation` text,
  `deadline` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `theme_img` varchar(128) DEFAULT NULL,
  `create_by` varchar(16) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(16) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--

ALTER TABLE `theme`
  ADD PRIMARY KEY (`theme_id`);

INSERT INTO `theme` (`theme_id`, `theme_name`, `theme_explanation`, `deadline`, `theme_img`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 'きのこ？たけのこ？', NULL, NULL, 'img/kinotake/kinoko_takenoko.jpg', 'learnchi', '2020-04-17 05:45:13', NULL, NULL);

-- --------------------------------------------------------

CREATE TABLE `vote` (
  `vote_id` mediumint(9) NOT NULL,
  `theme_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `voter` varchar(16) DEFAULT NULL,
  `vote_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`vote_id`);
ALTER TABLE `vote`
  MODIFY `vote_id` mediumint(9) NOT NULL AUTO_INCREMENT;
COMMIT;

