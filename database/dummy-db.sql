SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `dummy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `middlename` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `contact`, `email`, `address`, `date_created`, `date_updated`) VALUES
(1, 'Mark', 'D', 'Cooper', 'Male', '09123456789', 'mcooper@mail.com', 'Sample Address', '2022-06-11 11:30:19', NULL),
(2, 'Mike', 'C', 'Williams', 'Male', '09654789', 'mwilliams@mail.com', 'Sample Address Only', '2022-06-11 11:36:34', '2022-06-11 13:48:41'),
(3, 'Claire', 'C', 'Blake', 'Female', '0964789123', 'cblake@sample.com', 'Sample Address  2.', '2022-06-11 11:42:47', NULL),
(6, 'Samantha', 'D', 'Miller', 'Female', '09654123879', 'sam23@mail.com', 'Sample address 123', '2022-06-11 13:50:32', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;
