
-- --------------------------------------------------------

--
-- Table structure for table `User_auth`
--

CREATE TABLE `User_auth` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `ip` varchar(18) NOT NULL DEFAULT '',
  `ip_int` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `save_traf` tinyint(1) NOT NULL DEFAULT 0,
  `enabled` tinyint(1) NOT NULL DEFAULT 0,
  `dhcp` tinyint(1) NOT NULL DEFAULT 1,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `clientid` varchar(50) NOT NULL DEFAULT '',
  `nagios` tinyint(1) NOT NULL DEFAULT 0,
  `nagios_status` varchar(10) NOT NULL DEFAULT 'UP',
  `filter_group_id` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `comments` text DEFAULT NULL,
  `dns_name` varchar(60) NOT NULL DEFAULT '',
  `WikiName` varchar(250) DEFAULT NULL,
  `dhcp_acl` text DEFAULT NULL,
  `queue_id` int(11) NOT NULL DEFAULT 0,
  `mac` varchar(20) NOT NULL DEFAULT '',
  `dhcp_action` varchar(10) DEFAULT '',
  `dhcp_time` datetime NOT NULL DEFAULT current_timestamp(),
  `dhcp_hostname` varchar(60) DEFAULT NULL,
  `last_found` datetime DEFAULT current_timestamp(),
  `blocked` tinyint(1) NOT NULL DEFAULT 0,
  `day_quota` int(11) NOT NULL DEFAULT 0,
  `month_quota` int(11) NOT NULL DEFAULT 0,
  `device_model_id` int(11) DEFAULT 87,
  `firmware` varchar(100) DEFAULT NULL,
  `nagios_handler` varchar(50) DEFAULT '',
  `link_check` tinyint(1) NOT NULL DEFAULT 0,
  `changed` tinyint(1) NOT NULL DEFAULT 0,
  `changed_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
