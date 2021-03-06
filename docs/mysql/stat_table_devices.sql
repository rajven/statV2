
-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `device_type` int(11) NOT NULL DEFAULT 1,
  `device_model_id` int(11) DEFAULT 89,
  `firmware` varchar(100) DEFAULT NULL,
  `vendor_id` int(11) NOT NULL DEFAULT 1,
  `device_name` varchar(50) DEFAULT '',
  `building_id` int(11) NOT NULL DEFAULT 1,
  `ip` varchar(15) DEFAULT '',
  `port_count` int(11) NOT NULL DEFAULT 0,
  `SN` varchar(80) DEFAULT NULL,
  `dhcp` tinyint(1) NOT NULL DEFAULT 0,
  `comment` text DEFAULT NULL,
  `snmp_version` tinyint(4) NOT NULL DEFAULT 0,
  `snmp3_user_rw` varchar(20) DEFAULT NULL,
  `snmp3_user_rw_password` varchar(20) DEFAULT NULL,
  `snmp3_user_ro` varchar(20) DEFAULT NULL,
  `snmp3_user_ro_password` varchar(20) DEFAULT NULL,
  `community` varchar(50) NOT NULL DEFAULT 'public',
  `rw_community` varchar(50) NOT NULL DEFAULT 'private',
  `fdb_snmp_index` tinyint(1) NOT NULL DEFAULT 0,
  `discovery` tinyint(1) NOT NULL DEFAULT 1,
  `user_acl` tinyint(1) NOT NULL DEFAULT 0,
  `nagios` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `nagios_status` varchar(10) NOT NULL DEFAULT 'UP',
  `queue_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `connected_user_only` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
