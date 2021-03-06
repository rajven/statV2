
-- --------------------------------------------------------

--
-- Table structure for table `User_stats_full`
--

CREATE TABLE `User_stats_full` (
  `id` int(11) NOT NULL,
  `router_id` int(11) DEFAULT 0,
  `auth_id` int(11) NOT NULL DEFAULT 0,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `byte_in` bigint(20) NOT NULL DEFAULT 0,
  `byte_out` bigint(20) NOT NULL DEFAULT 0,
  `pkt_in` int(11) DEFAULT NULL,
  `pkt_out` int(11) DEFAULT NULL,
  `step` int(11) NOT NULL DEFAULT 600
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
