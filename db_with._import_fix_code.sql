/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
--
-- Database: `web_poth`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `route_id` bigint(20) UNSIGNED NOT NULL,
  `comment` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `position` enum('left','right') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'left',
  `added` datetime NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `counter_address`
--

CREATE TABLE `counter_address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `district` int(10) UNSIGNED NOT NULL,
  `thana` int(10) UNSIGNED NOT NULL,
  `poribohon_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `counter_address`
--

INSERT INTO `counter_address` (`id`, `address`, `district`, `thana`, `poribohon_id`) VALUES
(3, 'gabtoli', 1, 493, 23),
(4, 'majar road', 1, 493, 23),
(5, 'Majar Road, Nabil Poribohon', 1, 520, 25),
(6, 'Kamar para bu stand, Nabil Poribohon', 32, 444, 25),
(7, 'Address:114 Malibagh DIT Road\r\nPhone:9344477,01711612433', 1, 497, 15),
(8, 'Near Khaleque Pump, Kallyanpur\r\nPhone:8055902', 1, 520, 15),
(9, 'Majar road, gabtoli', 1, 493, 20),
(10, 'dada mor, ghoshpara', 28, 415, 20),
(12, '+৮৮-০১১৬৭৮-০১২৫৫০, ০১৬৭০-১০৪৭২৫, ০১৮১৯-২০৬৭৫১, ০১৮১৯-২১৭৭৪৩', 1, 493, 46),
(16, 'tesrt', 1, 493, 40),
(17, 'asdsad', 1, 493, 40);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(2) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `bn_name` varchar(50) NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `website` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `bn_name`, `lat`, `lon`, `website`) VALUES
(1, 'Dhaka', 'ঢাকা', 23.7115253, 90.4111451, 'www.dhaka.gov.bd'),
(2, 'Faridpur', 'ফরিদপুর', 23.6070822, 89.8429406, 'www.faridpur.gov.bd'),
(3, 'Gazipur', 'গাজীপুর', 24.0022858, 90.4264283, 'www.gazipur.gov.bd'),
(4, 'Gopalganj', 'গোপালগঞ্জ', 23.0050857, 89.8266059, 'www.gopalganj.gov.bd'),
(5, 'Jamalpur', 'জামালপুর', 24.937533, 89.937775, 'www.jamalpur.gov.bd'),
(6, 'Kishoreganj', 'কিশোরগঞ্জ', 24.444937, 90.776575, 'www.kishoreganj.gov.bd'),
(7, 'Madaripur', 'মাদারীপুর', 23.164102, 90.1896805, 'www.madaripur.gov.bd'),
(8, 'Manikganj', 'মানিকগঞ্জ', 0, 0, 'www.manikganj.gov.bd'),
(9, 'Munshiganj', 'মুন্সিগঞ্জ', 0, 0, 'www.munshiganj.gov.bd'),
(10, 'Mymensingh', 'ময়মনসিং', 0, 0, 'www.mymensingh.gov.bd'),
(11, 'Narayanganj', 'নারায়াণগঞ্জ', 23.63366, 90.496482, 'www.narayanganj.gov.bd'),
(12, 'Narsingdi', 'নরসিংদী', 23.932233, 90.71541, 'www.narsingdi.gov.bd'),
(13, 'Netrokona', 'নেত্রকোনা', 24.870955, 90.727887, 'www.netrokona.gov.bd'),
(14, 'Rajbari', 'রাজবাড়ি', 23.7574305, 89.6444665, 'www.rajbari.gov.bd'),
(15, 'Shariatpur', 'শরীয়তপুর', 0, 0, 'www.shariatpur.gov.bd'),
(16, 'Sherpur', 'শেরপুর', 25.0204933, 90.0152966, 'www.sherpur.gov.bd'),
(17, 'Tangail', 'টাঙ্গাইল', 0, 0, 'www.tangail.gov.bd'),
(18, 'Bogra', 'বগুড়া', 24.8465228, 89.377755, 'www.bogra.gov.bd'),
(19, 'Joypurhat', 'জয়পুরহাট', 0, 0, 'www.joypurhat.gov.bd'),
(20, 'Naogaon', 'নওগাঁ', 0, 0, 'www.naogaon.gov.bd'),
(21, 'Natore', 'নাটোর', 24.420556, 89.000282, 'www.natore.gov.bd'),
(22, 'Nawabganj', 'নবাবগঞ্জ', 24.5965034, 88.2775122, 'www.chapainawabganj.gov.bd'),
(23, 'Pabna', 'পাবনা', 23.998524, 89.233645, 'www.pabna.gov.bd'),
(24, 'Rajshahi', 'রাজশাহী', 0, 0, 'www.rajshahi.gov.bd'),
(25, 'Sirajgonj', 'সিরাজগঞ্জ', 24.4533978, 89.7006815, 'www.sirajganj.gov.bd'),
(26, 'Dinajpur', 'দিনাজপুর', 25.6217061, 88.6354504, 'www.dinajpur.gov.bd'),
(27, 'Gaibandha', 'গাইবান্ধা', 25.328751, 89.528088, 'www.gaibandha.gov.bd'),
(28, 'Kurigram', 'কুড়িগ্রাম', 25.805445, 89.636174, 'www.kurigram.gov.bd'),
(29, 'Lalmonirhat', 'লালমনিরহাট', 0, 0, 'www.lalmonirhat.gov.bd'),
(30, 'Nilphamari', 'নীলফামারী', 25.931794, 88.856006, 'www.nilphamari.gov.bd'),
(31, 'Panchagarh', 'পঞ্চগড়', 26.3411, 88.5541606, 'www.panchagarh.gov.bd'),
(32, 'Rangpur', 'রংপুর', 25.7558096, 89.244462, 'www.rangpur.gov.bd'),
(33, 'Thakurgaon', 'ঠাকুরগাঁও', 26.0336945, 88.4616834, 'www.thakurgaon.gov.bd'),
(34, 'Barguna', 'বরগুনা', 0, 0, 'www.barguna.gov.bd'),
(35, 'Barisal', 'বরিশাল', 0, 0, 'www.barisal.gov.bd'),
(36, 'Bhola', 'ভোলা', 22.685923, 90.648179, 'www.bhola.gov.bd'),
(37, 'Jhalokati', 'ঝালকাঠি', 0, 0, 'www.jhalakathi.gov.bd'),
(38, 'Patuakhali', 'পটুয়াখালী', 22.3596316, 90.3298712, 'www.patuakhali.gov.bd'),
(39, 'Pirojpur', 'পিরোজপুর', 0, 0, 'www.pirojpur.gov.bd'),
(40, 'Bandarban', 'বান্দরবান', 22.1953275, 92.2183773, 'www.bandarban.gov.bd'),
(41, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', 23.9570904, 91.1119286, 'www.brahmanbaria.gov.bd'),
(42, 'Chandpur', 'চাঁদপুর', 23.2332585, 90.6712912, 'www.chandpur.gov.bd'),
(43, 'Chittagong', 'চট্টগ্রাম', 22.335109, 91.834073, 'www.chittagong.gov.bd'),
(44, 'Comilla', 'কুমিল্লা', 23.4682747, 91.1788135, 'www.comilla.gov.bd'),
(45, 'Cox''s Bazar', 'কক্স বাজার', 0, 0, 'www.coxsbazar.gov.bd'),
(46, 'Feni', 'ফেনী', 23.023231, 91.3840844, 'www.feni.gov.bd'),
(47, 'Khagrachari', 'খাগড়াছড়ি', 23.119285, 91.984663, 'www.khagrachhari.gov.bd'),
(48, 'Lakshmipur', 'লক্ষ্মীপুর', 22.942477, 90.841184, 'www.lakshmipur.gov.bd'),
(49, 'Noakhali', 'নোয়াখালী', 22.869563, 91.099398, 'www.noakhali.gov.bd'),
(50, 'Rangamati', 'রাঙ্গামাটি', 0, 0, 'www.rangamati.gov.bd'),
(51, 'Habiganj', 'হবিগঞ্জ', 24.374945, 91.41553, 'www.habiganj.gov.bd'),
(52, 'Maulvibazar', 'মৌলভীবাজার', 24.482934, 91.777417, 'www.moulvibazar.gov.bd'),
(53, 'Sunamganj', 'সুনামগঞ্জ', 25.0658042, 91.3950115, 'www.sunamganj.gov.bd'),
(54, 'Sylhet', 'সিলেট', 24.8897956, 91.8697894, 'www.sylhet.gov.bd'),
(55, 'Bagerhat', 'বাগেরহাট', 22.651568, 89.785938, 'www.bagerhat.gov.bd'),
(56, 'Chuadanga', 'চুয়াডাঙ্গা', 23.6401961, 88.841841, 'www.chuadanga.gov.bd'),
(57, 'Jessore', 'যশোর', 23.16643, 89.2081126, 'www.jessore.gov.bd'),
(58, 'Jhenaidah', 'ঝিনাইদহ', 23.5448176, 89.1539213, 'www.jhenaidah.gov.bd'),
(59, 'Khulna', 'খুলনা', 22.815774, 89.568679, 'www.khulna.gov.bd'),
(60, 'Kushtia', 'কুষ্টিয়া', 23.901258, 89.120482, 'www.kushtia.gov.bd'),
(61, 'Magura', 'মাগুরা', 23.487337, 89.419956, 'www.magura.gov.bd'),
(62, 'Meherpur', 'মেহেরপুর', 23.762213, 88.631821, 'www.meherpur.gov.bd'),
(63, 'Narail', 'নড়াইল', 23.172534, 89.512672, 'www.narail.gov.bd'),
(64, 'Satkhira', 'সাতক্ষীরা', 0, 0, 'www.satkhira.gov.bd');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `edited_counters`
--

CREATE TABLE `edited_counters` (
  `id` int(10) UNSIGNED NOT NULL,
  `address` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `district` int(10) UNSIGNED NOT NULL,
  `thana` int(10) UNSIGNED NOT NULL,
  `poribohon_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `edited_poribohons`
--

CREATE TABLE `edited_poribohons` (
  `id` int(10) UNSIGNED NOT NULL,
  `poribohon_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `bn_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `total_vehicles` int(11) NOT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `edited_routes`
--

CREATE TABLE `edited_routes` (
  `id` int(10) UNSIGNED NOT NULL,
  `from_district` int(10) UNSIGNED NOT NULL,
  `from_thana` int(10) UNSIGNED NOT NULL,
  `from_place` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `to_district` int(10) UNSIGNED NOT NULL,
  `to_thana` int(10) UNSIGNED NOT NULL,
  `to_place` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `transport_type` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `departure_time` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `route_id` bigint(20) UNSIGNED NOT NULL,
  `poribohon_id` int(11) UNSIGNED NOT NULL,
  `rent` int(11) NOT NULL,
  `evidence` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `evidence2` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `added` datetime NOT NULL,
  `lang_code` enum('bn','en') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `edited_stoppages`
--

CREATE TABLE `edited_stoppages` (
  `id` int(10) UNSIGNED NOT NULL,
  `place_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `rent` int(11) NOT NULL,
  `route_id` int(10) UNSIGNED NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) UNSIGNED NOT NULL,
  `lang_code` varchar(2) NOT NULL,
  `lang_name` varchar(30) NOT NULL,
  `lang_flag` varchar(60) NOT NULL,
  `lang_order` int(11) NOT NULL,
  `lang_status` tinyint(4) NOT NULL DEFAULT '1',
  `lang_createDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `lang_code`, `lang_name`, `lang_flag`, `lang_order`, `lang_status`, `lang_createDate`) VALUES
(1, 'bn', 'bengali', 'Bangladesh', 0, 1, '0000-00-00 00:00:00'),
(2, 'en', 'english', 'England', 0, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `point_paid`
--

CREATE TABLE `point_paid` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `paid_mobile` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `point_amount` int(11) NOT NULL,
  `paid_at` datetime NOT NULL,
  `verification_code` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poribohons`
--

CREATE TABLE `poribohons` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `bn_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `total_vehicles` int(11) NOT NULL,
  `is_publish` int(11) NOT NULL DEFAULT '0',
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poribohons`
--

INSERT INTO `poribohons` (`id`, `name`, `bn_name`, `total_vehicles`, `is_publish`, `added_by`, `added`) VALUES
(1, 'Tetulia Paribahan', 'তেতুলিয়া পরিবহন', 40, 1, 2, '2017-01-23 21:33:26'),
(2, 'TR Paribahan', 'টিআর পরিবহন', 0, 1, 4, '2016-11-30 11:25:31'),
(3, 'Dipon CNG', 'দীপন সিএনজি', 0, 1, 4, '2016-11-30 11:25:17'),
(4, 'Haque Special', 'হক স্পেশাল', 15, 1, 4, '2016-11-11 10:35:59'),
(6, 'Bikash Paribahan', 'বিকাশ পরিবহন', 20, 1, 4, '2016-11-30 11:25:40'),
(7, 'Projapoti Paribahan', 'প্রজাপতি পরিবহন', 0, 1, 4, '2016-11-30 11:20:29'),
(8, 'Bhuyian Paribahan', 'ভূইয়া পরিবহন', 0, 1, 4, '2017-01-02 17:10:12'),
(9, 'Bengal Motors', 'বেঙ্গল মটরস', 0, 1, 4, '2017-01-03 01:19:49'),
(12, 'Sadhin Bangla', 'স্বাধীন বাংলা', 0, 1, 4, '2017-01-03 14:41:11'),
(14, 'RangDhanu Paribahan', 'রংধনু পরিবহন', 0, 1, 2, '2017-01-11 21:47:19'),
(15, 'Shohagh Paribahan', 'সোহাগ পরিবহন', 20, 1, 2, '2017-01-24 16:09:37'),
(16, 'Himachol Enterprise', 'হিমাচল এন্টারপ্রাইজ', 0, 1, 2, '2017-01-18 14:20:16'),
(17, 'Dhaka Paribahan', 'ঢাকা পরিবহন', 0, 1, 2, '2017-01-18 15:07:19'),
(18, 'Prottoy Transport', 'প্রত্যয় ট্রান্সপোর্ট', 0, 1, 2, '2017-01-19 18:13:50'),
(19, 'Gabtoli link', 'গাবতলী লিংক', 0, 1, 2, '2017-01-19 19:22:17'),
(20, 'Nabil Paribahan', 'নাবিল পরিবহন', 10, 1, 2, '2017-01-25 13:45:23'),
(21, 'Hanif Paribahan', 'হানিফ', 100, 1, 4, '2017-01-23 13:55:04'),
(22, 'Eagle Paribahan', 'ঈগল পরিবহন', 100, 1, 4, '2017-01-23 13:56:39'),
(23, 'Shamoly Paribahan', 'শ্যামলী', 0, 1, 4, '2017-01-23 13:58:47'),
(24, 'Labbayak Paribahan', 'লাব্বাইক পরিবহন', 0, 1, 2, '2017-01-23 21:41:13'),
(25, 'Nabil Scania', 'নাবিল স্কানিয়া', 2, 1, 2, '2017-01-24 15:15:28'),
(26, 'Jabale Nur Paribahan', 'জাবালে নুর পরিবহন', 0, 1, 2, '2017-01-24 14:32:29'),
(27, 'ETC Transport Co. Ltd', 'ইটিসি ট্রান্সপোর্ট কো. লি.', 0, 1, 2, '2017-01-24 16:20:46'),
(28, 'Bihongo Paribahan', 'বিহঙ্গ পরিবহন', 0, 1, 2, '2017-01-25 01:05:23'),
(29, 'Torongo Plus Transpot Ltd', 'তরঙ্গ প্লাস ট্রান্সপোর্ট লি.', 0, 1, 2, '2017-01-25 01:20:51'),
(30, 'Torongo bus co.', 'তরঙ্গ বাস কো.', 0, 1, 2, '2017-01-25 01:32:02'),
(31, 'Raja City Paribahan', 'রাজা সিটি পরিবহন', 0, 1, 2, '2017-01-25 13:56:55'),
(32, 'Tanjil Paribahan', 'তানজিল পরিবহন', 0, 1, 2, '2017-01-25 14:03:16'),
(33, '6 no motijheel banani transport', '৬ নং মতিঝিল বনানী ট্রান্সপোর্ট লি.', 0, 1, 2, '2017-01-25 14:17:49'),
(34, 'Shikor Paribahan', 'Shikor poribohon', 0, 1, 6, '2017-01-28 16:03:33'),
(35, 'Mirpur United Service Ltd', 'Mirpur United Service Ltd', 0, 1, 6, '2017-01-28 16:05:25'),
(36, 'Silk City Service', 'Silk City Service', 0, 1, 6, '2017-01-28 16:05:29'),
(37, 'Balaka Service', 'বলাকা সার্ভিস', 0, 1, 2, '2017-01-27 15:30:00'),
(38, 'Basumoti Transport', 'বসুমতি ট্রান্সপোর্ট', 0, 1, 2, '2017-01-27 15:40:02'),
(39, 'Provati Banasree Paribahan', 'প্রভাতী বনশ্রী', 150, 1, 2, '2017-01-28 07:56:01'),
(40, 'Satabdi Paribahan', 'Satabdi Paribahan', 15, 1, 6, '2017-01-29 19:30:44'),
(41, '7 no bus', '৭ নং বাস', 0, 1, 2, '2017-01-27 20:59:52'),
(42, 'Turag', 'তুরাগ', 0, 1, 2, '2017-01-28 08:42:39'),
(43, 'Thikana Express Ltd.', 'ঠিকানা এক্সপ্রেস লি.', 0, 1, 2, '2017-01-28 08:54:42'),
(44, 'Su Provat CIty Service', 'সুপ্রভাত সিটি সার্ভিস', 0, 1, 2, '2017-01-28 09:04:06'),
(45, 'Sky Line', 'স্কাই লাইন', 0, 1, 6, '2017-01-29 02:54:38'),
(46, 'Moitri Paribahan Ltd', 'মৈত্রী পরিবহন লি.', 25, 1, 6, '2017-01-28 16:03:57'),
(47, 'BRTC Double Decker', 'বিআরটিসি ডাবল ডেকার', 0, 1, 6, '2017-01-29 02:54:45'),
(48, 'ATCL', 'এটিসিএল', 0, 1, 6, '2017-01-29 02:55:13'),
(49, 'Suchona', 'সূচনা', 0, 1, 2, '2017-01-28 22:45:18'),
(50, 'Malancha Transport', 'মালঞ্চ ট্রান্সপোর্ট', 0, 0, 6, '2017-01-30 22:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `occupation` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `sex` enum('Male','Female','Other') COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` datetime NOT NULL,
  `about` text COLLATE utf8_unicode_ci NOT NULL,
  `thana` int(10) UNSIGNED NOT NULL,
  `district` int(10) UNSIGNED NOT NULL,
  `country` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `first_name`, `last_name`, `occupation`, `sex`, `birth_date`, `about`, `thana`, `district`, `country`, `user_id`) VALUES
(2, 'Rejoan', 'Alam', '', '', '0000-00-00 00:00:00', 'qweqw', 493, 1, '', 2),
(3, 'Rejoanul', 'Alam', '', '', '0000-00-00 00:00:00', 'Test user', 493, 1, '', 6);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_district` int(11) UNSIGNED NOT NULL,
  `from_thana` int(11) UNSIGNED NOT NULL,
  `from_place` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `from_latlong` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `to_latlong` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `transport_type` enum('bus','train','launch','leguna','biman','others') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'bus',
  `to_district` int(11) UNSIGNED NOT NULL,
  `to_thana` int(11) UNSIGNED NOT NULL,
  `to_place` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `poribohon_id` int(11) UNSIGNED NOT NULL,
  `departure_time` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `rent` int(11) NOT NULL,
  `evidence` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `evidence2` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `added` datetime NOT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `is_publish` int(11) NOT NULL DEFAULT '0' COMMENT '0=not published,1=published',
  `distance` int(11) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `from_district`, `from_thana`, `from_place`, `from_latlong`, `to_latlong`, `transport_type`, `to_district`, `to_thana`, `to_place`, `poribohon_id`, `departure_time`, `rent`, `evidence`, `evidence2`, `added`, `added_by`, `is_publish`, `distance`, `duration`) VALUES
(1, 1, 510, 'Mirpur-1', '23.7956037,90.3536548', '23.7414675,90.3702192', 'leguna', 1, 510, 'Jhigatola', 12, '1', 23, '', '', '2017-01-27 15:13:27', 2, 1, 8084, 1831),
(2, 1, 537, 'Japan Garden City', '23.7641178,90.3582533', '23.8932542,90.387477', 'bus', 1, 537, 'AbdullahPur', 8, '1', 40, '', '', '2017-01-30 20:18:19', 2, 1, 20543, 3173),
(3, 1, 520, 'Mirpur-1', '23.7956037,90.3536548', '23.8932542,90.387477', 'bus', 1, 537, 'AbdullahPur', 9, '1', 40, '', '', '2017-01-30 20:17:49', 2, 1, 15986, 2291),
(4, 28, 415, 'Ghosh Para', '25.7970092,89.6381096', '23.7601309,90.3727895', 'bus', 1, 493, 'Asad gate', 4, 'Daily moring and night', 550, '', '', '2017-01-10 12:33:34', 2, 1, 343519, 27628),
(5, 1, 493, 'Japan Garden City', '23.7653461,90.3571495', '23.8932542,90.387477', 'bus', 1, 509, 'AbdullahPur', 1, '1', 40, '1485185049Tetulia.jpg', '', '2017-01-23 21:27:01', 2, 1, 20439, 3149),
(6, 1, 493, 'Japan Garden City', '23.7641178,90.3582533', '23.6927717,90.4301942', 'bus', 1, 509, 'Postagola', 14, '1', 40, '', '', '2017-01-18 14:05:57', 2, 1, 15585, 2929),
(8, 1, 520, 'Kallyanpur', '23.7822036,90.3595372', '23.3560954,89.3469894', 'bus', 57, 286, 'Jessore', 15, '1', 550, '', '', '2017-01-24 02:37:41', 2, 1, 169492, 18449),
(9, 1, 493, 'Bossila', '23.754687,90.3589489', '23.8932542,90.387477', 'bus', 1, 537, 'AbdullahPur', 7, '1', 40, '', '', '2017-01-23 22:27:46', 2, 1, 21133, 3322),
(10, 1, 493, 'Tajmohol Road', '23.7632068,90.3617656', '23.7329724,90.417231', 'bus', 1, 509, 'Motijheel', 3, '1', 35, '', '', '2017-01-18 12:12:14', 2, 1, 8614, 1625),
(11, 1, 520, 'Mirpur-1', '23.7956037,90.3536548', '23.7566389,90.4643906', 'bus', 1, 516, 'Khilgoan', 16, '1', 45, '', '', '2017-01-18 14:45:02', 2, 1, 17110, 3203),
(12, 1, 521, 'Shapla chottor', '23.7266278,90.4216667', '24.0958171,90.4125181', 'bus', 3, 159, 'Gazipur', 17, '1', 50, '', '', '2017-01-18 15:08:13', 2, 1, 48488, 6255),
(13, 1, 520, 'Gabtoli', '23.7837257,90.3442449', '23.7776282,90.4054498', 'leguna', 1, 534, 'Mohakhali', 18, '1', 15, '', '', '2017-01-19 18:42:23', 2, 1, 9368, 1823),
(14, 1, 493, 'Gabtoli', '23.7837257,90.3442449', '23.7047113,90.4160527', 'bus', 1, 509, 'Sadar ghat', 19, '1', 30, '1485184602transport2_(1).jpg', '', '2017-01-23 21:16:42', 2, 1, 15021, 2989),
(15, 28, 415, 'Ghosh Para', '25.7970092,89.6381096', '23.7837257,90.3442449', 'bus', 1, 509, 'Gabtoli', 20, 'Daily morning and night', 550, '', '', '2017-01-21 14:04:06', 2, 1, 339277, 26704),
(16, 1, 520, 'Majar road, Gabtoli', '23.7832255,90.3472139', '25.8281684,89.6816208', 'bus', 28, 415, 'Purbasa Hall, Dada mor', 21, 'Daily morning and night', 550, '', '', '2017-01-23 15:08:40', 2, 1, 349329, 28090),
(17, 1, 493, 'Majar road, Gabtoli', '23.7832255,90.3472139', '25.7318144,89.2277026', 'bus', 32, 444, 'Kamar para bus stand', 21, '1', 550, '', '', '2017-01-23 15:15:06', 2, 1, 294664, 23029),
(18, 1, 149, 'Savar', '23.8701334,90.2713944', '23.6918777,90.4814999', 'bus', 1, 511, 'Signboard', 24, '1', 50, '1485186073Labbayak.JPG', '', '2017-01-23 21:42:00', 2, 1, 38956, 5300),
(19, 32, 444, 'Kamar para bus stand', '25.7318144,89.2277026', '23.7805468,90.3523314', 'bus', 1, 509, 'Technical', 25, '1', 1400, '1485245286nabil_scania.jpg', '1485245286nabil_scania_front.jpg', '2017-01-25 13:44:21', 2, 1, 294203, 23456),
(20, 1, 493, 'Agargaon', '23.7791954,90.3736584', '23.8932542,90.387477', 'bus', 1, 509, 'AbdullahPur', 26, '1', 30, '1485246749Jabale-e-nur-bus.jpg', '', '2017-01-24 14:33:00', 2, 1, 21258, 2897),
(21, 1, 520, 'Mirpur-12', '23.7702886,90.3561731', '23.7227747,90.4140338', 'bus', 1, 509, 'Gulistan', 27, '1', 30, '1485253246ETC_Transport.jpg', '', '2017-01-24 17:00:23', 2, 1, 11124, 2229),
(22, 1, 520, 'Duaripara', '23.8260874,90.3565959', '23.7093699,90.4123708', 'bus', 1, 509, 'Victoria Park', 28, '1', 25, '1485284723Bihongo.jpg', '', '2017-01-25 01:05:56', 2, 1, 16266, 3521),
(23, 1, 493, 'Mohammadpur bus stand', '23.757741,90.3624389', '23.7619353,90.433141', 'bus', 1, 509, 'Banasree', 29, '1', 35, '', '', '2017-01-25 01:21:17', 2, 1, 9767, 2031),
(24, 1, 493, 'Mohammadpur bus stand', '23.757741,90.3624389', '23.7851549,90.3563036', 'bus', 1, 509, 'Natun Bazar', 30, '1', 25, '1485286322Torongo.JPG', '', '2017-01-25 01:32:30', 2, 1, 5132, 1086),
(25, 1, 493, 'Asad gate', '23.7601309,90.3727895', '23.7306729,90.4210948', 'bus', 1, 509, 'Notredame college, arambag', 31, '1', 20, '1485331015Raja_city.JPG', '', '2017-01-25 13:57:28', 2, 1, 7910, 1530),
(26, 1, 493, 'Mirpur-1 (chiriakhana)', '23.8124802,90.3471922', '23.7047113,90.4160527', 'bus', 1, 509, 'Sadar ghat', 32, '1', 25, '1485331396tanjil_poribohon.JPG', '', '2017-01-26 14:02:29', 2, 1, 18072, 3630),
(27, 1, 493, 'Motijheel', '23.7329724,90.417231', '23.7849928,90.3593901', 'bus', 1, 509, 'Natun bazar', 33, '1', 25, '1485332269motijheel_6_banani.jpg', '', '2017-01-25 14:19:35', 2, 1, 10756, 1875),
(28, 1, 493, 'Mirpur-12', '23.7702886,90.3561731', '23.6918777,90.4814999', 'bus', 1, 509, 'Signboard', 34, '1', 35, '', '', '2017-01-26 13:58:06', 2, 1, 18581, 2852),
(29, 1, 493, 'Pallabi (Mirpur-12)', '23.8225698,90.3749734', '23.7047113,90.4160527', 'bus', 1, 509, 'Sadar ghat', 35, '1', 30, '', '', '2017-01-26 14:24:35', 2, 1, 18837, 3283),
(30, 1, 493, 'Pallabi (BDR shooping master counter)', '23.7658444,90.3583606', '23.715422,90.4232021', 'bus', 1, 509, 'Jatrabari', 36, '1', 35, '', '', '2017-01-28 09:18:11', 2, 1, 11440, 2165),
(31, 1, 493, 'Saidabad', '23.7136051,90.427837', '23.9982721,90.4178774', 'bus', 3, 159, 'Shibbari', 37, '1', 40, '1485509400Balaka_service.jpg', '', '2017-01-27 15:30:47', 2, 1, 52069, 6165),
(32, 1, 520, 'Gabtoli', '23.7837257,90.3442449', '24.0958171,90.4125181', 'bus', 3, 159, 'Gazipur', 38, '1', 40, '1485510002bosumati_side.jpg', '1485510002bosumoti.jpg', '2017-01-27 15:40:26', 2, 1, 42628, 5413),
(33, 1, 509, 'Fulbaria', '24.6249931,90.266699', '24.119897,90.2807868', 'bus', 1, 509, 'Kaliakoir', 39, '1', 45, '1485523518provati_banasree.jpg', '', '2017-01-27 19:25:55', 2, 1, 79913, 8650),
(34, 1, 520, 'Mirpur-14', '23.7510806,90.3782897', '23.7329724,90.417231', 'bus', 1, 521, 'Motijheel', 40, '1', 35, '1485524223Shotabdi_poribohon.JPG', '', '2017-01-27 19:37:23', 2, 1, 5671, 1118),
(35, 1, 520, 'Gabtoli', '23.7837257,90.3442449', '23.7047113,90.4160527', 'bus', 1, 518, 'Sadar ghat', 41, '1', 25, '1485529192transport2_(1).jpg', '', '2017-01-27 21:00:03', 2, 1, 15021, 2989),
(36, 1, 511, 'Jatrabari', '23.715422,90.4232021', '23.9055035,90.3995977', 'bus', 3, 164, 'Cherag Ali', 42, '1', 35, '1485571359Turag.jpg', '', '2017-01-28 08:42:51', 2, 1, 27331, 4169),
(37, 1, 149, 'Jirani', '23.8701334,90.2713944', '23.6918777,90.4814999', 'bus', 1, 509, 'Signboard', 43, '1', 50, '1485572082Thikana.jpg', '', '2017-01-28 08:54:57', 2, 1, 38956, 5300),
(38, 1, 518, 'Sadar ghat', '23.7047113,90.4160527', '24.0958171,90.4125181', 'bus', 3, 159, 'Gazipur', 44, '1', 30, '1485572646suprovat.JPG', '', '2017-01-28 09:04:15', 2, 1, 50730, 7118),
(39, 1, 493, 'Sadar ghat', '23.7047113,90.4160527', '23.9055035,90.3995977', 'bus', 3, 164, 'Cherag Ali', 45, '1', 40, '1485573071sky_line.JPG', '', '2017-01-28 09:38:44', 2, 1, 27575, 4667),
(40, 1, 493, 'Town Hall', '23.759646,90.3657975', '23.7306729,90.4210948', 'bus', 1, 509, 'Notredame college, arambag', 46, '1', 20, '', '', '2017-01-28 16:10:19', 6, 1, 8660, 1751),
(41, 1, 493, 'Mohammadpur bus stand', '23.757741,90.3624389', '23.7849928,90.3593901', 'bus', 1, 509, 'Natun Bazar', 47, '1', 30, '', '', '2017-01-28 19:55:40', 6, 1, 4484, 1019),
(42, 1, 493, 'Mohammadpur bus stand', '23.757741,90.3624389', '23.7306729,90.4210948', 'bus', 1, 509, 'Notredame college, arambag', 48, '1', 25, '', '', '2017-01-28 22:02:46', 6, 1, 9022, 1854),
(43, 1, 523, 'Palashi Etimkhana', '23.7330788,90.383972', '23.7302329,90.4114247', 'bus', 1, 537, 'HouseBuilding', 49, '1', 35, '', '', '2017-01-28 22:54:15', 2, 1, 3183, 908),
(44, 1, 493, 'Mohammadpur bus stand', '23.757741,90.3624389', '23.7065203,90.422008', 'bus', 1, 509, 'Dhupkhola', 50, '1', 23, '', '', '2017-01-30 22:07:07', 6, 1, 11272, 2306);

-- --------------------------------------------------------

--
-- Table structure for table `route_bn`
--

CREATE TABLE `route_bn` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `route_id` bigint(20) UNSIGNED NOT NULL,
  `from_place` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `to_place` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `departure_time` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `translation_status` enum('1','2','3') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=incomplete,2=partial,3=complete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `route_bn`
--

INSERT INTO `route_bn` (`id`, `route_id`, `from_place`, `to_place`, `departure_time`, `translation_status`) VALUES
(1, 1, 'মিরপুর-১', 'ঝিগাতলা', '1', '1'),
(2, 2, 'জাপান গার্ডেন সিটি', 'আব্দুল্লাহপুর', '1', '1'),
(3, 3, 'মিরপুর-১', 'আব্দুল্লাহপুর', '1', '1'),
(4, 4, 'ঘোষপাড়া', 'আসাদ গেট', 'Daily moring and night', '1'),
(5, 5, 'জাপান গার্ডেন সিটি', 'আব্দুল্লাহপুর', '1', '1'),
(6, 6, 'জাপান গার্ডেন সিটি', 'পোস্তাগোলা', '1', '1'),
(8, 8, 'কল্যানপুর', 'যশোর', '1', '1'),
(9, 9, 'বসিলা', 'আব্দুল্লাহপুর', '1', '1'),
(10, 10, 'তাজমহল রোড', 'মতিঝিল', '1', '1'),
(11, 11, 'মিরপুর-১', 'খিলগাও', '1', '1'),
(12, 12, 'শাপলা চত্তর', 'গাজিপুর', '1', '1'),
(13, 13, 'গাবতলী', 'মহাখালী', '1', '1'),
(14, 14, 'গাবতলী', 'সদরঘাট', '1', '1'),
(15, 15, 'Ghosh Para', 'Gabtoli', 'Daily morning and night', '1'),
(16, 16, 'Majar road, Gabtoli', 'Purbasa Hall, Dada mor', 'Daily morning and night', '1'),
(17, 17, 'মাজার রোড, গাবতলী', 'কামার পাড়া বাসস্টান্ড', '1', '1'),
(18, 18, 'সাভার', 'সাইনবোর্ড', '1', '1'),
(19, 19, 'কামার পাড়া বাসস্টান্ড', 'টেকনিকাল', '1', '1'),
(20, 20, 'আগারগাও', 'আব্দুল্লাহপুর', '1', '1'),
(21, 21, 'মিরপুর-১২', 'গুলিস্তান', '1', '1'),
(22, 22, 'দুয়ারীপাড়া', 'ভিক্টোরিয়াপার্ক', '1', '1'),
(23, 23, 'মোহাম্মদপুর বাস স্টান্ড', 'বনশ্রী', '1', '1'),
(24, 24, 'মোহাম্মদপুর বাস স্টান্ড', 'নতুন বাজার', '1', '1'),
(25, 25, 'আসাদ গেট', 'নটরডেম কলেজ, আরামবাগ', '1', '1'),
(26, 26, 'মিরপুর-১ (চিড়িয়াখানা)', 'সদরঘাট', '1', '1'),
(27, 27, 'মতিঝিল', 'নতুন বাজার', '1', '1'),
(28, 28, 'mirpur-12', 'Signboard', '1', '1'),
(29, 29, 'Pallabi (Mirpur-12)', 'Sadar ghat', '1', '1'),
(30, 30, 'Pallabi (BDR shooping master counter)', 'Jatrabari', '1', '1'),
(31, 31, 'সায়দাবাদ', 'শীববাড়ী', '1', '1'),
(32, 32, 'গাবতলী', 'গাজীপুর', '1', '1'),
(33, 33, 'ফুলবাড়িয়া', 'কালিয়াকৈর', '1', '1'),
(34, 34, 'Mirpur-14', 'Motijheel', '1', '1'),
(35, 35, 'গাবতলী', 'সদরঘাট', '1', '1'),
(36, 36, 'যাত্রাবাড়ী', 'চেরাগ আলী', '1', '1'),
(37, 37, 'জিরানী', 'সাইনবোর্ড', '1', '1'),
(38, 38, 'সদরঘাট', 'গাজীপুর', '1', '1'),
(39, 39, 'সদরঘাট', 'চেরাগ আলী', '1', '1'),
(40, 40, 'টাউন হল', 'নটরডেম কলেজ, আরামবাগ', '1', '1'),
(41, 41, 'মোহাম্মদপুর বাস স্টান্ড', 'নতুন বাজার', '1', '1'),
(42, 42, 'মোহাম্মদপুর বাস স্টান্ড', 'নটরডেম কলেজ, আরামবাগ', '1', '1'),
(43, 43, 'পলাশী এতিমখানা', 'হাউজবিল্ডিং', '1', '1'),
(44, 44, 'মোহাম্মদপুর বাস স্টান্ড', 'ধুপখোলা', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `route_complains`
--

CREATE TABLE `route_complains` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `route_id` bigint(20) UNSIGNED NOT NULL,
  `fare_upvote` int(11) NOT NULL,
  `fare_downvote` int(11) NOT NULL,
  `distance` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `duration` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `route_complains`
--

INSERT INTO `route_complains` (`id`, `user_id`, `route_id`, `fare_upvote`, `fare_downvote`, `distance`, `duration`, `added`) VALUES
(4, 6, 43, 1, 0, '', '', '0000-00-00 00:00:00'),
(5, 2, 43, 1, 0, '', '', '0000-00-00 00:00:00'),
(6, 2, 41, 1, 0, '', '', '2017-01-30 14:59:34');

-- --------------------------------------------------------

--
-- Table structure for table `route_points`
--

CREATE TABLE `route_points` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `route_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `point` tinyint(4) NOT NULL,
  `note` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `happened_at` datetime NOT NULL,
  `read` tinyint(4) NOT NULL DEFAULT '0',
  `notification_msg` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `action` enum('add','edit','translate') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'add'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stoppages`
--

CREATE TABLE `stoppages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `place_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `comments` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `lat_long` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `rent` int(11) NOT NULL,
  `route_id` bigint(20) UNSIGNED NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stoppages`
--

INSERT INTO `stoppages` (`id`, `place_name`, `comments`, `lat_long`, `rent`, `route_id`, `position`) VALUES
(58, 'Asulia', 'same rent', '', 500, 4, 1),
(59, 'Savar', '', '', 500, 4, 2),
(60, 'Technical', '', '', 500, 4, 3),
(214, 'Farmgate', '', '', 10, 10, 1),
(215, 'Shahbag', '', '', 20, 10, 2),
(216, 'Shamoly', '', '', 5, 6, 1),
(217, 'Asad Gate', '', '', 10, 6, 2),
(218, 'Science Lab', '', '', 15, 6, 3),
(219, 'ShahBag', '', '', 20, 6, 4),
(220, 'Kakrail', '', '', 25, 6, 5),
(221, 'Fakirapul', '', '', 30, 6, 6),
(222, 'Bangladesh Bank', '', '', 30, 6, 7),
(223, 'Doyaganj Road', '', '', 35, 6, 8),
(224, 'Jurain', '', '', 40, 6, 9),
(264, 'Sony Hall', '', '', 10, 11, 1),
(265, 'Mirpur-2', '', '', 10, 11, 2),
(266, 'Mirpur-10', '', '', 10, 11, 3),
(267, 'Kazipara', '', '', 15, 11, 4),
(268, 'Shewrapara', '', '', 15, 11, 5),
(269, 'Agargoan', '', '', 15, 11, 6),
(270, 'Jahangir Gate', '', '', 20, 11, 7),
(271, 'Mohakhali', '', '', 20, 11, 8),
(272, 'Gulshan - 1', '', '', 25, 11, 9),
(273, 'Badda', '', '', 25, 11, 10),
(274, 'East - Rampura', '', '', 30, 11, 11),
(275, 'Chowdhury Para', '', '', 30, 11, 12),
(276, 'Malibag Rail Gate', '', '', 35, 11, 13),
(287, 'Tongi', '', '', 20, 12, 1),
(288, 'Uttara', '', '', 25, 12, 2),
(289, 'Mohakhali', '', '', 30, 12, 3),
(290, 'Farmgate', '', '', 35, 12, 4),
(291, 'Shahbag', '', '', 40, 12, 5),
(328, 'Kallyanpur', '', '', 5, 13, 1),
(329, 'Shamoly', '', '', 5, 13, 2),
(330, 'Agargaon', '', '', 8, 13, 3),
(331, 'Jahangir gate', '', '', 10, 13, 4),
(365, 'Rangpur', 'sometimes take passenger. boarding may not possible', '', 50, 15, 1),
(366, 'Bogra', 'sometimes take passenger. boarding may not possible', '', 150, 15, 2),
(367, 'Sirajgonj', 'sometimes take passenger. boarding not possible', '', 550, 15, 3),
(368, 'Tangail', '', '', 550, 15, 4),
(369, 'Gazipur', '', '', 550, 15, 5),
(370, 'Savar', '', '', 550, 15, 6),
(371, 'Majar Road', '', '', 550, 15, 7),
(396, 'Technical', '', '', 550, 16, 1),
(399, 'Bogra', '', '', 550, 17, 1),
(400, 'Pirganj', '', '', 550, 17, 2),
(401, 'Shamoly', '', '', 5, 14, 1),
(402, 'Asad gate', '', '', 8, 14, 2),
(403, 'Kalabagan', '', '', 10, 14, 3),
(404, 'Shahbag', '', '', 15, 14, 4),
(405, 'Gulistan', '', '', 20, 14, 5),
(438, 'Adabor', '', '', 5, 5, 1),
(439, 'Shamoly', '', '', 5, 5, 2),
(440, 'Shishu Mela', '', '', 10, 5, 3),
(441, 'Agargaon', '', '', 15, 5, 4),
(442, 'Shewrapara', '', '', 15, 5, 5),
(443, 'Kazipara', '', '', 15, 5, 6),
(444, 'Mirpur-10', '', '', 15, 5, 7),
(445, 'Purobi', '', '', 20, 5, 8),
(446, 'Kalshi', '', '', 20, 5, 9),
(447, 'Airport', '', '', 25, 5, 10),
(448, 'Uttara', '', '', 35, 5, 11),
(455, 'Hemayatpur', 'Fare not sure', '', 10, 18, 1),
(456, 'Gabtoli', 'Fare not sure', '', 20, 18, 2),
(457, 'Shamoly', '', '', 25, 18, 3),
(458, 'Farmgate', '', '', 30, 18, 4),
(459, 'Basabo', '', '', 35, 18, 5),
(460, 'Jatrabari', '', '', 40, 18, 6),
(461, 'Mohammadpur Tin rastar mor', '', '', 10, 9, 1),
(462, 'Mohammadpur Bus Stand', '', '', 15, 9, 2),
(463, 'Asad Gate', '', '', 15, 9, 3),
(464, 'Shamoly', '', '', 15, 9, 4),
(465, 'Darus Salam', '', '', 15, 9, 5),
(466, 'Mirpur-1', '', '', 15, 9, 6),
(467, 'Mirpur-10', '', '', 15, 9, 7),
(468, 'Kalshi', '', '', 20, 9, 8),
(469, 'Jashimuddin', '', '', 30, 9, 9),
(470, 'Rajlokhkhi', '', '', 35, 9, 10),
(487, 'Doulatdia', '', '', 550, 8, 1),
(488, 'Magura', '', '', 550, 8, 2),
(489, 'Khajura', '', '', 550, 8, 3),
(490, 'New market', '', '', 500, 8, 4),
(512, 'Shewrapara', 'Fare not sure', '', 5, 20, 1),
(513, 'Kazipara', 'Fare not sure', '', 10, 20, 2),
(514, 'Mirpur-10', 'Fare not sure', '', 10, 20, 3),
(515, 'Mirpur-11.1/2', 'Fare not sure', '', 10, 20, 4),
(516, 'Zia Kolony', 'Fare not sure', '', 15, 20, 5),
(517, 'Airport', 'Fare not sure', '', 20, 20, 6),
(518, 'Uttara', 'Fare not sure', '', 25, 20, 7),
(522, 'Mirpur-11', 'fare not sure', '', 10, 21, 1),
(523, 'Mirpur-10', 'fare not sure', '', 10, 21, 2),
(524, 'Kazipara', 'fare not sure', '', 10, 21, 3),
(536, 'Mirpur-11.1/2', '', '', 5, 22, 1),
(537, 'Mirpur-11', 'fare not sure', '', 10, 22, 2),
(538, 'Mirpur-10', '', '', 10, 22, 3),
(539, 'Kazipara', 'fare not sure', '', 10, 22, 4),
(540, 'Shewrapara', 'fare not sure', '', 10, 22, 5),
(541, 'Farmgate', 'fare not sure', '', 15, 22, 6),
(542, 'Shahbag', 'fare not sure', '', 20, 22, 7),
(543, 'Pressclub', 'fare not sure', '', 20, 22, 8),
(544, 'Bongobazar', 'fare not sure', '', 20, 22, 9),
(545, 'Golapshah majar, gulistan', 'fare not sure', '', 20, 22, 10),
(546, 'Rai saheb bazar', '', '', 25, 22, 11),
(559, 'Sankar', '', '', 10, 23, 1),
(560, 'Dhanmondi-15', '', '', 10, 23, 2),
(561, 'Jhigatola', '', '', 10, 23, 3),
(562, 'Science Lab', 'fare not sure', '', 10, 23, 4),
(563, 'Katabon', 'fare not sure', '', 10, 23, 5),
(564, 'Shahbag', 'fare not sure', '', 15, 23, 6),
(565, 'Kakrail', 'fare not sure', '', 15, 23, 7),
(566, 'Mouchak', 'fare not sure', '', 20, 23, 8),
(567, 'Malibag Rail Gate', 'fare not sure', '', 25, 23, 9),
(568, 'Rampura bazar', 'fare not sure', '', 25, 23, 10),
(569, 'Rampura bridge', 'fare not sure', '', 30, 23, 11),
(570, 'South banasree', 'fare', '', 35, 23, 12),
(577, 'Asad Gate', '', '', 5, 24, 1),
(578, 'Farmgate', 'fare not sure', '', 5, 24, 2),
(579, 'Mohakhali', 'fare not sure', '', 10, 24, 3),
(580, 'Titumir college', 'fare not sure', '', 10, 24, 4),
(581, 'Gulshan - 1', 'fare not sure', '', 15, 24, 5),
(582, 'Badda', 'fare not sure', '', 20, 24, 6),
(583, 'Gaibandha', 'This is a via, passenger drop or pick not happen here', '', 1400, 19, 1),
(584, 'Bogra', 'This is a via, passenger drop or pick not happen here', '', 1400, 19, 2),
(585, 'Sirajgonj', 'This is a via, passenger drop or pick not happen here', '', 1400, 19, 3),
(586, 'Jamuna Setu', 'This is a via, passenger drop or pick not happen here', '', 1400, 19, 4),
(587, 'Tangail', 'Same rent, passenger drop available', '', 1400, 19, 5),
(588, 'Savar', 'Same rent, passenger drop available', '', 1400, 19, 6),
(589, 'Majar road, gabtoli', 'Same rent, passenger drop available', '', 1400, 19, 7),
(597, 'Shankar', '', '', 10, 25, 1),
(598, 'Dhanmondi-15', '', '', 10, 25, 2),
(599, 'Jhigatola', '', '', 10, 25, 3),
(600, 'Science Lab', '', '', 10, 25, 4),
(601, 'Shahbag UBL', '', '', 15, 25, 5),
(602, 'Gulistan', '', '', 20, 25, 6),
(603, 'Motijheel', '', '', 25, 25, 7),
(626, 'Gulistan', 'fare not sure', '', 5, 27, 1),
(627, 'Paltan', 'fare not sure', '', 5, 27, 2),
(628, 'Malibag', 'fare not sure', '', 8, 27, 3),
(629, 'Mogbazar', 'fare not sure', '', 10, 27, 4),
(630, 'Kawran bazar', 'fare not sure', '', 15, 27, 5),
(631, 'Farmgate', 'fare not sure', '', 15, 27, 6),
(632, 'Bijoy sarani', 'fare not sure', '', 20, 27, 7),
(633, 'Mohakhali', 'fare not sure', '', 20, 27, 8),
(634, 'Gulshan - 1', 'fare not sure', '', 25, 27, 9),
(635, 'Gulshan-2', 'fare not sure', '', 25, 27, 10),
(639, 'Mirpur-12', '', '', 10, 28, 1),
(640, 'Mirpur-11', '', '', 15, 28, 2),
(641, 'Kazipara', '', '', 20, 28, 3),
(648, 'Darus salam', 'fare not sure', '', 5, 26, 1),
(649, 'Shamoly', 'fare not sure', '', 10, 26, 2),
(650, 'Asad Gate', 'fare not sure', '', 10, 26, 3),
(651, 'Farmgate', 'fare not sure', '', 15, 26, 4),
(652, 'Pressclub', 'fare not sure', '', 20, 26, 5),
(653, 'Gulistan', 'fare not sure', '', 25, 26, 6),
(663, 'Anik plaza (Mirpur-11.1/2)', 'fare not sure', '', 5, 29, 1),
(664, 'Mirpur-11', 'fare not sure', '', 5, 29, 2),
(665, 'Mirpur-10', 'fare not sure', '', 10, 29, 3),
(666, 'Kazipara', 'fare not sure', '', 10, 29, 4),
(667, 'Farmgate', 'fare not sure', '', 15, 29, 5),
(668, 'Pressclub', 'fare not sure', '', 20, 29, 6),
(669, 'T&t', 'fare not sure', '', 20, 29, 7),
(670, 'Rai saheb bazar', 'fare not sure', '', 25, 29, 8),
(671, 'Victoria park', 'fare not sure', '', 25, 29, 9),
(696, 'Technical', '', '', 5, 1, 1),
(697, 'Darus salam', '', '', 5, 1, 2),
(698, 'Kallyanpur', '', '', 7, 1, 3),
(699, 'Shamoly', '', '', 8, 1, 4),
(700, 'Adabor', '', '', 10, 1, 5),
(712, 'Motijheel', 'fare not sure', '', 10, 31, 1),
(713, 'Kamlapur', 'fare not sure', '', 10, 31, 2),
(714, 'Malibag', 'fare not sure', '', 10, 31, 3),
(715, 'Mogbazar', 'fare not sure', '', 15, 31, 4),
(716, 'Nabisco', 'fare not sure', '', 20, 31, 5),
(717, 'Mohakhali', 'fare not sure', '', 20, 31, 6),
(718, 'Banani', 'fare not sure', '', 20, 31, 7),
(719, 'Khilkhet', 'fare not sure', '', 20, 31, 8),
(720, 'Airport', 'fare not sure', '', 25, 31, 9),
(721, 'Uttara', 'fare not sure', '', 30, 31, 10),
(722, 'Tongi board bazar', 'fare not sure', '', 35, 31, 11),
(731, 'Mirpur-1', 'fare not sure', '', 10, 32, 1),
(732, 'Mirpur-10', 'fare not sure', '', 10, 32, 2),
(733, 'Mirpur-11', 'fare not sure', '', 10, 32, 3),
(734, 'Kalshi', 'fare not sure', '', 15, 32, 4),
(735, 'Bishwa road', 'fare not sure', '', 15, 32, 5),
(736, 'Airport', 'fare not sure', '', 20, 32, 6),
(737, 'Uttara', 'fare not sure', '', 25, 32, 7),
(738, 'Abdullahpur', 'fare not sure', '', 30, 32, 8),
(752, 'Gulistan', 'fare not sure', '', 10, 33, 1),
(753, 'Paltan', 'fare not sure', '', 10, 33, 2),
(754, 'Malibag', 'fare not sure', '', 15, 33, 3),
(755, 'Mogbazar', 'fare not sure', '', 15, 33, 4),
(756, 'Satrasta', 'fare not sure', '', 15, 33, 5),
(757, 'Nabisco', 'fare not sure', '', 15, 33, 6),
(758, 'Mohakhali', 'fare not sure', '', 20, 33, 7),
(759, 'Banani', 'fare not sure', '', 20, 33, 8),
(760, 'Airport', 'fare not sure', '', 25, 33, 9),
(761, 'Uttara', 'fare not sure', '', 30, 33, 10),
(762, 'Abdullahpur', 'fare not sure', '', 30, 33, 11),
(763, 'Tongi', 'fare not sure', '', 35, 33, 12),
(764, 'Gazipur', 'fare not sure', '', 40, 33, 13),
(776, 'Mirpur-10', 'fare not sure', '', 10, 34, 1),
(777, 'Mirpur-1', 'fare not sure', '', 10, 34, 2),
(778, 'Technical', 'fare not sure', '', 15, 34, 3),
(779, 'Shamoly', 'fare not sure', '', 20, 34, 4),
(780, 'Asad Gate', 'fare not sure', '', 20, 34, 5),
(781, 'Science Lab', 'fare not sure', '', 25, 34, 6),
(782, 'Katabon', 'fare not sure', '', 25, 34, 7),
(783, 'Shahbag', 'fare not sure', '', 25, 34, 8),
(784, 'Paltan', 'fare not sure', '', 30, 34, 9),
(785, 'Dainik bangla', 'fare not sure', '', 30, 34, 10),
(786, 'Notre dame', 'fare not sure', '', 35, 34, 11),
(794, 'Darus Salam', 'fare not sure', '', 5, 35, 1),
(795, 'Kallyanpur', 'fare not sure', '', 5, 35, 2),
(796, 'Shamoly', 'fare not sure', '', 5, 35, 3),
(797, 'Asad Gate', 'fare not sure', '', 10, 35, 4),
(798, 'Kalabagan', 'fare not sure', '', 10, 35, 5),
(799, 'Shahbag', 'fare not sure', '', 15, 35, 6),
(800, 'Gulistan', 'fare not sure', '', 20, 35, 7),
(824, 'Saidabad', 'fare not sure', '', 10, 36, 1),
(825, 'Mugda', 'fare not sure', '', 10, 36, 2),
(826, 'Basabo', 'fare not sure', '', 15, 36, 3),
(827, 'Khilgaon', 'fare not sure', '', 15, 36, 4),
(828, 'Malibag', 'fare not sure', '', 20, 36, 5),
(829, 'Rampura', 'fare not sure', '', 25, 36, 6),
(830, 'Khilkhet', 'fare not sure', '', 25, 36, 7),
(831, 'Airport', 'fare not sure', '', 25, 36, 8),
(832, 'Rajlokhkhi', 'fare not sure', '', 30, 36, 9),
(833, 'House Building', 'fare not sure', '', 35, 36, 10),
(834, 'Abdullahpur', 'fare not sure', '', 35, 36, 11),
(844, 'EPZ', 'fare not sure', '', 5, 37, 1),
(845, 'Nabinagar', 'fare not sure', '', 10, 37, 2),
(846, 'Savar', 'fare not sure', '', 10, 37, 3),
(847, 'Gabtoli', 'fare not sure', '', 15, 37, 4),
(848, 'Kalabagan', 'fare not sure', '', 20, 37, 5),
(849, 'New market', 'fare not sure', '', 25, 37, 6),
(850, 'Chankharpul', 'fare not sure', '', 30, 37, 7),
(851, 'Gulistan', 'fare not sure', '', 35, 37, 8),
(852, 'Saidabad', 'fare not sure', '', 40, 37, 9),
(859, 'Gulistan', 'fare not sure', '', 10, 38, 1),
(860, 'Rampura', 'fare not sure', '', 10, 38, 2),
(861, 'Badda', 'fare not sure', '', 15, 38, 3),
(862, 'Bishwa road', 'fare not sure', '', 20, 38, 4),
(863, 'Airport', 'fare not sure', '', 25, 38, 5),
(864, 'Tongi', 'fare not sure', '', 30, 38, 6),
(884, 'Boikali hotel', 'fare not sure', '', 5, 30, 1),
(885, 'Mirpur-11', 'fare not sure', '', 5, 30, 2),
(886, 'Mirpur-10', 'fare not sure', '', 5, 30, 3),
(887, 'Kazipara', 'fare not sure', '', 10, 30, 4),
(888, 'Shewrapara', 'fare not sure', '', 10, 30, 5),
(889, 'Taltola', 'fare not sure', '', 10, 30, 6),
(890, 'Farmgate', 'fare not sure', '', 15, 30, 7),
(891, 'Shahbag', 'fare not sure', '', 15, 30, 8),
(892, 'Paltan', 'fare not sure', '', 20, 30, 9),
(893, 'Shapla chattor', 'fare not sure', '', 25, 30, 10),
(894, 'Ittafaq', 'fare not sure', '', 30, 30, 11),
(895, 'Saidabad', 'fare not sure', '', 35, 30, 12),
(896, 'Gulistan', 'fare not sure', '', 10, 39, 1),
(897, 'Kakrail', 'fare not sure', '', 10, 39, 2),
(898, 'Malibag', 'fare not sure', '', 15, 39, 3),
(899, 'Mogbazar', 'fare not sure', '', 20, 39, 4),
(900, 'Mohakhali', 'fare not sure', '', 25, 39, 5),
(901, 'Airport', 'fare not sure', '', 30, 39, 6),
(902, 'Abdullahpur', 'fare not sure', '', 35, 39, 7),
(909, 'Sankar', 'fare not sure', '', 10, 40, 1),
(910, 'Dhanmondi-15', 'fare not sure', '', 10, 40, 2),
(911, 'Jhigatola', 'fare not sure', '', 10, 40, 3),
(912, 'Science Lab', 'fare not sure', '', 15, 40, 4),
(913, 'Katabon', 'fare not sure', '', 20, 40, 5),
(914, 'Arambag', 'fare not sure', '', 25, 40, 6),
(921, 'Asad Gate', '', '', 5, 41, 1),
(922, 'Farmgate', '', '', 5, 41, 2),
(923, 'Bijoy sarani', '', '', 8, 41, 3),
(924, 'Mohakhali', '', '', 10, 41, 4),
(925, 'Gulshan - 1', 'fare not sure', '', 15, 41, 5),
(926, 'Badda', 'fare not sure', '', 20, 41, 6),
(934, 'Asad Gate', 'fare not sure', '', 5, 42, 1),
(935, 'Kalabagan', 'fare not sure', '', 10, 42, 2),
(936, 'Science Lab', 'fare not sure', '', 15, 42, 3),
(937, 'Katabon', 'fare not sure', '', 15, 42, 4),
(938, 'Shahbag', 'fare not sure', '', 20, 42, 5),
(939, 'Pressclub', 'fare not sure', '', 25, 42, 6),
(940, 'Motijheel', 'fare not sure', '', 25, 42, 7),
(968, 'Azimpur', 'fare not sure', '', 5, 43, 1),
(969, 'Nilkhet', 'fare not sure', '', 5, 43, 2),
(970, 'City College', 'fare not sure', '', 10, 43, 3),
(971, 'Kalabagan', 'fare not sure', '', 15, 43, 4),
(972, 'Sukrabad', 'fare not sure', '', 15, 43, 5),
(973, 'Asad Gate', 'fare not sure', '', 20, 43, 6),
(974, 'Farmgate', 'fare not sure', '', 20, 43, 7),
(975, 'Mohakhali', 'fare not sure', '', 25, 43, 8),
(976, 'Banani/Kakoli', 'fare not sure', '', 30, 43, 9),
(995, 'Technical', '', '', 10, 3, 1),
(996, 'Kallyanpur', '', '', 10, 3, 2),
(997, 'Shamoly', '', '', 10, 3, 3),
(998, 'Agargaon', '', '', 15, 3, 4),
(999, 'Mohakhali', '', '', 20, 3, 5),
(1000, 'Chairmenbari (Banani)', '', '', 20, 3, 6),
(1001, 'Sainik Club (Banani)', '', '', 25, 3, 7),
(1002, 'Kakoli', '', '', 25, 3, 8),
(1003, 'Jashim Uddin (Uttara)', '', '', 30, 3, 9),
(1004, 'Rajlokhkhi (Uttara)', '', '', 30, 3, 10),
(1005, 'Shamoly', 'Normally passenger not taken from here', '', 5, 2, 1),
(1006, 'Agargaon', 'Normally passenger not taken from here', '', 15, 2, 2),
(1007, 'Mohakhali', '', '', 20, 2, 3),
(1008, 'Chairmenbari (Banani)', '', '', 25, 2, 4),
(1009, 'Sainik Club (Banani)', '', '', 25, 2, 5),
(1010, 'Kakoli', '', '', 25, 2, 6),
(1011, 'JashimUddin (Uttara)', '', '', 30, 2, 7),
(1012, 'Rajlokhkhi (Uttara)', '', '', 30, 2, 8),
(1020, 'Sankar', 'fare not sure', '', 5, 44, 1),
(1021, 'Dhanmondi-15', 'fare not sure', '', 5, 44, 2),
(1022, 'Jhigatola', 'fare not sure', '', 10, 44, 3),
(1023, 'Science Lab', 'fare not sure', '', 10, 44, 4),
(1024, 'Shahbag', 'fare not sure', '', 15, 44, 5),
(1025, 'Pressclub', 'fare not sure', '', 20, 44, 6),
(1026, 'Gulistan', 'fare not sure', '', 23, 44, 7);

-- --------------------------------------------------------

--
-- Table structure for table `stoppage_bn`
--

CREATE TABLE `stoppage_bn` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `route_id` bigint(20) UNSIGNED NOT NULL,
  `place_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `comments` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `rent` int(11) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stoppage_bn`
--

INSERT INTO `stoppage_bn` (`id`, `route_id`, `place_name`, `comments`, `rent`, `position`) VALUES
(27, 4, 'আশুলিয়া', 'same rent', 500, 1),
(28, 4, 'সাভার', '', 500, 2),
(29, 4, 'টেকনিকাল', '', 500, 3),
(30, 1, 'টেকনিকাল', '', 5, 1),
(31, 1, 'দারুসসালাম', '', 5, 2),
(32, 1, 'কল্যানপুর', '', 7, 3),
(33, 1, 'শ্যামলী', '', 8, 4),
(56, 8, 'নিউ মার্কেট বাসস্টান্ড', '', 550, 1),
(67, 9, 'মোহাম্মদপুর তিন রাস্তার মোড়', '', 10, 1),
(68, 9, 'মোহাম্মদপুর বাস স্ট্রান্ড', '', 15, 2),
(69, 9, 'আসাদ গেট', '', 15, 3),
(70, 9, 'শ্যামলি', '', 15, 4),
(71, 9, 'দারুস সালাম', '', 15, 5),
(72, 9, 'মিরপুর-১', '', 15, 6),
(73, 9, 'মিরপুর-১০', '', 15, 7),
(74, 9, 'কালশী', '', 20, 8),
(75, 9, 'জসীমউদ্দিন', '', 30, 9),
(76, 9, 'রাজলক্ষী', '', 35, 10),
(79, 10, 'ফার্মগেইট', '', 10, 1),
(80, 10, 'শাহবাগ', '', 20, 2),
(86, 6, 'শ্যামলী', '', 10, 1),
(87, 6, 'আসাদগেট', '', 10, 2),
(88, 6, 'সাইন্সল্যাব', '', 15, 3),
(89, 6, 'শাহবাগ', '', 20, 4),
(90, 6, 'কাকরাইল', '', 25, 8),
(91, 6, 'ফকিরাপুল', '', 30, 9),
(92, 6, 'বাংলাদেশ ব্যাংক', '', 30, 10),
(93, 6, 'দয়াগঞ্জ রোড', '', 35, 11),
(94, 6, 'জুড়াইন', '', 40, 12),
(121, 11, 'সনি সিনেমা হল', '', 10, 1),
(122, 11, 'মিরপুর-২', '', 10, 2),
(123, 11, 'মিরপুর-১০', '', 10, 3),
(124, 11, 'কাজীপাড়া', '', 15, 4),
(125, 11, 'শেওড়াপাড়া', '', 15, 5),
(126, 11, 'আগারগাও ', '', 15, 6),
(127, 11, 'জাহাঙ্গীর গেট', '', 20, 7),
(128, 11, 'মহাখালী', '', 20, 8),
(129, 11, 'গুলশান-১', '', 25, 9),
(130, 11, 'বাড্ডা', '', 25, 10),
(131, 11, 'পূর্ব-রামপুরা', '', 30, 11),
(132, 11, 'চৌধুরীপাড়া', '', 30, 12),
(133, 11, 'মালিবাগ রেলগেট', '', 35, 13),
(139, 12, 'টঙ্গী', '', 20, 1),
(140, 12, 'উত্তরা', '', 25, 2),
(141, 12, 'মহাখালী', '', 30, 3),
(142, 12, 'ফার্মগেট', '', 35, 4),
(143, 12, 'শাহবাগ', '', 40, 5),
(160, 2, 'মহাখালী', '', 20, 3),
(161, 2, 'চেয়ারমেনবাড়ি', '', 25, 4),
(162, 2, 'সৈনিক ক্লাব', '', 25, 5),
(163, 2, 'কাকলী', '', 25, 6),
(164, 2, 'জসীমউদ্দিন', '', 30, 7),
(165, 2, 'রাজলক্ষী', '', 35, 8),
(166, 2, 'শ্যামলী', 'এখান থেকে সাধারনত যাত্রী উঠায়না', 5, 1),
(167, 2, 'আগারগাও', 'এখান থেকে সাধারনত যাত্রী উঠায়না', 15, 2),
(184, 3, 'টেকনিকাল', '', 10, 1),
(185, 3, 'কল্যানপুর', '', 10, 2),
(186, 3, 'শ্যামলী', '', 10, 3),
(187, 3, 'আগারগাও', '', 15, 4),
(188, 3, 'জসীমউদ্দিন', '', 30, 9),
(189, 3, 'রাজলক্ষী', '', 30, 10),
(190, 3, 'মহাখালী', '', 20, 5),
(191, 3, 'চেয়ারম্যান বাড়ী', '', 20, 6),
(192, 3, 'সৈনিক ক্লাব', '', 25, 7),
(193, 3, 'কাকলী', '', 25, 8),
(198, 13, 'কল্যানপুর', '', 5, 1),
(199, 13, 'শ্যামলী', '', 5, 2),
(200, 13, 'আগারগাও', '', 8, 3),
(201, 13, 'জাহাঙ্গীরগেট', '', 10, 4),
(208, 14, 'শ্যামলী', '', 5, 1),
(209, 14, 'আসাদ গেট', '', 8, 2),
(210, 14, 'ফার্মগেট', '', 10, 3),
(211, 14, 'কাওরান বাজার', '', 12, 4),
(212, 14, 'শাহবাগ', '', 15, 5),
(213, 14, 'গুলিস্তান', '', 20, 6),
(214, 15, 'Rangpur', 'sometimes take passenger. boarding may not possible', 50, 1),
(215, 15, 'Bogra', 'sometimes take passenger. boarding may not possible', 150, 2),
(216, 15, 'Sirajgonj', 'sometimes take passenger. boarding not possible', 550, 3),
(217, 15, 'Tangail', '', 550, 4),
(218, 15, 'Gazipur', '', 550, 5),
(219, 15, 'Savar', '', 550, 6),
(220, 15, 'Majar Road', '', 550, 7),
(221, 16, 'Technical', '', 550, 1),
(240, 5, 'আদাবর', '', 5, 1),
(241, 5, 'শ্যামলী', '', 5, 2),
(242, 5, 'শিশুমেলা', '', 10, 3),
(243, 5, 'আগারগাও', '', 15, 4),
(244, 5, 'শেওরাপাড়া', '', 15, 5),
(245, 5, 'কাজীপাড়া', '', 15, 6),
(246, 5, 'মিরপুর-১০', '', 15, 7),
(247, 5, 'পুরবী', '', 20, 8),
(248, 5, 'কালশী', '', 25, 9),
(249, 5, 'এয়ারপোর্ট', '', 30, 10),
(250, 5, 'উত্তরা', '', 35, 11),
(257, 18, 'হেমায়াপুর', 'Fare not sure', 10, 1),
(258, 18, 'গাবতলী', 'Fare not sure', 20, 2),
(259, 18, 'শ্যামলী', '', 25, 3),
(260, 18, 'ফার্মগেট', '', 30, 4),
(261, 18, 'বাসাবো', '', 35, 5),
(262, 18, 'যাত্রাবাড়ী', '', 40, 6),
(277, 20, 'শেওরাপাড়া', 'ভাড়া নিশ্চিত না', 5, 1),
(278, 20, 'কাজীপাড়া', 'ভাড়া নিশ্চিত না', 10, 2),
(279, 20, 'মিরপুর-১০', 'ভাড়া নিশ্চিত না', 10, 3),
(280, 20, 'মিরপুর-১১.১/২', 'ভাড়া নিশ্চিত না', 10, 4),
(281, 20, 'জিয়া কলোনী', 'ভাড়া নিশ্চিত না', 15, 5),
(282, 20, 'এয়ারপোর্ট', 'ভাড়া নিশ্চিত না', 20, 6),
(283, 20, 'উত্তরা', 'ভাড়া নিশ্চিত না', 25, 7),
(284, 19, 'গাইবান্ধা', 'সাধারনত এখানে যাত্রী ওঠানামা করাবেনা তবে এই স্থান হয়ে গাড়িটি যায়', 1400, 1),
(285, 19, 'বগুরা', 'সাধারনত এখানে যাত্রী ওঠানামা করাবেনা তবে এই স্থান হয়ে গাড়িটি যায়', 1400, 2),
(286, 19, 'সিরাজগন্জ', 'সাধারনত এখানে যাত্রী ওঠানামা করাবেনা তবে এই স্থান হয়ে গাড়িটি যায়', 1400, 3),
(287, 19, 'যমুনা সেতু', 'সাধারনত এখানে যাত্রী ওঠানামা করাবেনা তবে এই স্থান হয়ে গাড়িটি যায়', 1400, 4),
(288, 19, 'টাংগাইল', 'যাত্রী নামাবে, ভাড়া একই', 1400, 5),
(289, 19, 'সাভার', 'যাত্রী নামাবে, ভাড়া একই', 1400, 6),
(290, 19, 'মাজার রোড, গাবতলী', 'যাত্রী নামাবে, ভাড়া একই', 1400, 7),
(294, 21, 'মিরপুর-১১', 'ভাড়াটা নিশ্চিত না', 10, 1),
(295, 21, 'মিরপুর-১০', 'ভাড়াটা নিশ্চিত না', 10, 2),
(296, 21, 'কাজীপাড়া', 'ভাড়াটা নিশ্চিত না', 10, 3),
(319, 22, 'মিরপুর-১১.১/২', '', 5, 1),
(320, 22, 'মিরপুর-১১', 'ভাড়াটা নিশ্চিত না', 10, 2),
(321, 22, 'মিরপুর-১০', 'ভাড়াটা নিশ্চিত না', 10, 3),
(322, 22, 'কাজীপাড়া', 'ভাড়াটা নিশ্চিত না', 10, 4),
(323, 22, 'শেওড়াপাড়া', 'ভাড়াটা নিশ্চিত না', 10, 5),
(324, 22, 'ফার্মগেট', 'ভাড়াটা নিশ্চিত না', 15, 6),
(325, 22, 'শাহবাগ', 'ভাড়াটা নিশ্চিত না', 20, 7),
(326, 22, 'প্রেসক্লাব', 'ভাড়াটা নিশ্চিত না', 20, 8),
(327, 22, 'বঙ্গবাজার', 'ভাড়াটা নিশ্চিত না', 20, 9),
(328, 22, 'গোলাপশাহ মাজার, গুলিস্তান', 'ভাড়াটা নিশ্চিত না', 20, 10),
(329, 22, ' রায়সাহেব বাজার', '', 25, 11),
(342, 23, 'শংকর', '', 10, 1),
(343, 23, 'ধানমন্ডি-১৫', '', 10, 2),
(344, 23, 'ঝিগাতলা', '', 10, 3),
(345, 23, 'সাইন্সল্যাব', 'ভাড়াটা নিশ্চিত না', 10, 4),
(346, 23, 'কাটাবন', 'ভাড়াটা নিশ্চিত না', 10, 5),
(347, 23, 'শাহবাগ ', 'ভাড়াটা নিশ্চিত না', 15, 6),
(348, 23, 'কাকরাইল', 'ভাড়াটা নিশ্চিত না', 15, 7),
(349, 23, 'মৌচাক ', 'ভাড়াটা নিশ্চিত না', 20, 8),
(350, 23, 'মালিবাগ রেলগেট', 'fare not sure', 25, 9),
(351, 23, 'রামপুরা বাজার', 'ভাড়াটা নিশ্চিত না', 25, 10),
(352, 23, 'রামপুরা ব্রীজ', 'ভাড়াটা নিশ্চিত না', 30, 11),
(353, 23, 'দক্ষিন বনশ্রী', 'ভাড়াটা নিশ্চিত না', 35, 12),
(360, 24, 'আসাদগেট', '', 5, 1),
(361, 24, 'ফার্মগেট', 'ভাড়াটা নিশ্চিত না', 5, 2),
(362, 24, 'মহাখালী', 'ভাড়াটা নিশ্চিত না', 10, 3),
(363, 24, 'গুলশান-১', 'ভাড়াটা নিশ্চিত না', 10, 4),
(364, 24, 'বাড্ডা', 'ভাড়াটা নিশ্চিত না', 15, 5),
(365, 24, 'নতুন বাজার', 'ভাড়াটা নিশ্চিত না', 20, 6),
(373, 25, 'শংকর', '', 10, 1),
(374, 25, 'ধানমন্ডি-১৫', '', 10, 2),
(375, 25, 'ঝিগাতলা', '', 10, 3),
(376, 25, 'সায়েন্সল্যাব', '', 10, 4),
(377, 25, 'শাহবাগ ইউবিএল', '', 15, 5),
(378, 25, 'গুলিস্তান', '', 20, 6),
(379, 25, 'মতিঝিল', '', 25, 7),
(386, 26, 'দারুসসালাম', 'fare not sure', 5, 1),
(387, 26, 'শ্যামলী', 'fare not sure', 10, 2),
(388, 26, 'আসাদ গেট', 'fare not sure', 10, 3),
(389, 26, 'ফার্মগেট', 'fare not sure', 15, 4),
(390, 26, 'প্রেসক্লাব', 'fare not sure', 20, 5),
(391, 26, 'গুলিস্তান', 'fare not sure', 25, 6),
(392, 17, 'বগুরা', '', 550, 1),
(393, 17, 'পীরগন্জ', '', 550, 2),
(404, 27, 'গুলিস্তান', 'fare not sure', 5, 1),
(405, 27, 'পল্টন', 'fare not sure', 5, 2),
(406, 27, 'মালিবাগ', 'fare not sure', 8, 3),
(407, 27, 'মগবাজার', 'fare not sure', 10, 4),
(408, 27, 'কাওরান বাজার', 'fare not sure', 15, 5),
(409, 27, 'ফার্মগেট', 'fare not sure', 15, 6),
(410, 27, 'বিজয় সরনী', 'fare not sure', 20, 7),
(411, 27, 'মহাখালী', 'fare not sure', 20, 8),
(412, 27, 'গুলশান-১', 'fare not sure', 25, 9),
(413, 27, 'গুলশান-২', 'fare not sure', 25, 10),
(414, 28, 'Mirpur-12', '', 10, 1),
(415, 28, 'Mirpur-11', '', 15, 2),
(416, 28, 'kazipara', '', 20, 3),
(417, 29, 'Anik plaza (Mirpur-11.1/2)', 'fare not sure', 5, 1),
(418, 29, 'Mirpur-11', 'fare not sure', 5, 2),
(419, 29, 'Mirpur - 10', 'fare not sure', 10, 3),
(420, 29, 'Kajipara', 'fare not sure', 10, 4),
(421, 29, 'Farmgate', 'fare not sure', 15, 5),
(422, 29, 'pressclub', 'fare not sure', 20, 6),
(423, 29, 't&t', 'fare not sure', 20, 7),
(424, 29, 'rai saheb bazar', 'fare not sure', 25, 8),
(425, 29, 'victoria park', 'fare not sure', 25, 9),
(426, 30, 'Boikali hotel', 'fare not sure', 5, 1),
(427, 30, 'Mirpur-11', 'fare not sure', 5, 2),
(428, 30, 'Mirpur - 10', 'fare not sure', 5, 3),
(429, 30, 'Kajipara', 'fare not sure', 10, 4),
(430, 30, 'Shewrapara', 'fare not sure', 10, 5),
(431, 30, 'taltola', 'fare not sure', 10, 6),
(432, 30, 'Farmgate', 'fare not sure', 15, 7),
(433, 30, 'Shahbag', 'fare not sure', 15, 8),
(434, 30, 'paltan', 'fare not sure', 20, 9),
(435, 30, 'shapla chattor', 'fare not sure', 25, 10),
(436, 30, 'ittafaq', 'fare not sure', 30, 11),
(437, 30, 'saidabad', 'fare not sure', 35, 12),
(460, 31, 'মতিঝিল', 'ভাড়া নিশ্চিত না', 10, 1),
(461, 31, 'কমলাপুর', 'ভাড়া নিশ্চিত না', 10, 2),
(462, 31, 'মালিবাগ', 'ভাড়া নিশ্চিত না', 10, 3),
(463, 31, 'মগবাজার', 'ভাড়া নিশ্চিত না', 15, 4),
(464, 31, 'নাবিস্কো', 'ভাড়া নিশ্চিত না', 20, 5),
(465, 31, 'মহাখালী', 'ভাড়া নিশ্চিত না', 20, 6),
(466, 31, 'বনানী', 'ভাড়া নিশ্চিত না', 20, 7),
(467, 31, 'খিলক্ষেত', 'ভাড়া নিশ্চিত না', 20, 8),
(468, 31, 'এয়ারপোর্ট', 'ভাড়া নিশ্চিত না', 25, 9),
(469, 31, 'উত্তরা', 'ভাড়া নিশ্চিত না', 30, 10),
(470, 31, 'টঙ্গী বোর্ড বাজার', 'ভাড়া নিশ্চিত না', 35, 11),
(479, 32, 'মিরপুর-১', 'ভাড়া নিশ্চিত না', 10, 1),
(480, 32, 'মিরপুর-১০', 'ভাড়া নিশ্চিত না', 10, 2),
(481, 32, 'মিরপুর-১১', 'ভাড়া নিশ্চিত না', 10, 3),
(482, 32, 'কালশী', 'ভাড়া নিশ্চিত না', 15, 4),
(483, 32, 'বিশ্বরোড', 'ভাড়া নিশ্চিত না', 15, 5),
(484, 32, 'এয়ারপোর্ট', 'ভাড়া নিশ্চিত না', 20, 6),
(485, 32, 'উত্তরা', 'ভাড়া নিশ্চিত না', 25, 7),
(486, 32, 'আব্দুল্লাহপুর', 'ভাড়া নিশ্চিত না', 30, 8),
(500, 33, 'গুলিস্তান', 'fare not sure', 10, 1),
(501, 33, 'পল্টন', 'fare not sure', 10, 2),
(502, 33, 'মালিবাগ', 'fare not sure', 15, 3),
(503, 33, 'মগবাজার', 'fare not sure', 15, 4),
(504, 33, 'সাতরাস্তা', 'fare not sure', 15, 5),
(505, 33, 'নাবিস্কো', 'fare not sure', 15, 6),
(506, 33, 'মহাখালী', 'fare not sure', 20, 7),
(507, 33, 'বনানী', 'fare not sure', 20, 8),
(508, 33, 'এয়ারপোর্ট', 'fare not sure', 25, 9),
(509, 33, 'উত্তরা', 'fare not sure', 30, 10),
(510, 33, 'আব্দুল্লাহপুর', 'fare not sure', 30, 11),
(511, 33, 'টঙ্গী', 'fare not sure', 35, 12),
(512, 33, 'গাজিপুর', 'fare not sure', 40, 13),
(513, 34, 'Mirpur-10', 'fare not sure', 10, 1),
(514, 34, 'Mirpur-1', 'fare not sure', 10, 2),
(515, 34, 'Technical', 'fare not sure', 15, 3),
(516, 34, 'Shamoly', 'fare not sure', 20, 4),
(517, 34, 'Asad Gate', 'fare not sure', 20, 5),
(518, 34, 'Science Lab', 'fare not sure', 25, 6),
(519, 34, 'katabon', 'fare not sure', 25, 7),
(520, 34, 'Shahbag', 'fare not sure', 25, 8),
(521, 34, 'paltan', 'fare not sure', 30, 9),
(522, 34, 'dainik bangla', 'fare not sure', 30, 10),
(523, 34, 'notre dame', 'fare not sure', 35, 11),
(531, 35, 'দারুস সালাম', 'ভাড়া নিশ্চিত না', 5, 1),
(532, 35, 'কল্যানপুর', 'ভাড়া নিশ্চিত না', 5, 2),
(533, 35, 'শ্যামলি', 'ভাড়া নিশ্চিত না', 5, 3),
(534, 35, 'আসাদগেট', 'ভাড়া নিশ্চিত না', 10, 4),
(535, 35, 'কলাবাগান', 'ভাড়া নিশ্চিত না', 10, 5),
(536, 35, 'শাহবাগ', 'ভাড়া নিশ্চিত না', 15, 6),
(537, 35, 'গুলিস্তান', 'ভাড়া নিশ্চিত না', 20, 7),
(549, 36, 'সায়দাবাদ', 'ভাড়া নিশ্চিত না', 10, 1),
(550, 36, 'মুগদা', 'ভাড়া নিশ্চিত না', 10, 2),
(551, 36, 'বাসাবো', 'ভাড়া নিশ্চিত না', 15, 3),
(552, 36, 'খিলগাও', 'ভাড়া নিশ্চিত না', 15, 4),
(553, 36, 'মালিবাগ', 'ভাড়া নিশ্চিত না', 20, 5),
(554, 36, 'রামপুরা', 'ভাড়া নিশ্চিত না', 25, 6),
(555, 36, 'খিলক্ষেত', 'ভাড়া নিশ্চিত না', 25, 7),
(556, 36, 'এয়ারপোর্ট', 'ভাড়া নিশ্চিত না', 25, 8),
(557, 36, 'রাজলক্ষী', 'ভাড়া নিশ্চিত না', 30, 9),
(558, 36, 'হাউজ বিল্ডিং', 'ভাড়া নিশ্চিত না', 35, 10),
(559, 36, 'আব্দুল্লাহপুর', 'ভাড়া নিশ্চিত না', 35, 11),
(569, 37, 'ইপিজেড', 'ভাড়া নিশ্চিত না', 5, 1),
(570, 37, 'নবীনগর', 'ভাড়া নিশ্চিত না', 10, 2),
(571, 37, 'সাভার', 'ভাড়া নিশ্চিত না', 10, 3),
(572, 37, 'গাবতলী', 'ভাড়া নিশ্চিত না', 15, 4),
(573, 37, 'কলাবাগান', 'ভাড়া নিশ্চিত না', 20, 5),
(574, 37, 'নিউ মার্কেট', 'ভাড়া নিশ্চিত না', 25, 6),
(575, 37, 'চানখারপুল', 'ভাড়া নিশ্চিত না', 30, 7),
(576, 37, 'গুলিস্তান', 'ভাড়া নিশ্চিত না', 35, 8),
(577, 37, 'সায়দাবাদ', 'ভাড়া নিশ্চিত না', 40, 9),
(584, 38, 'গুলিস্তান', 'ভাড়া নিশ্চিত না', 10, 1),
(585, 38, 'রামপুরা', 'ভাড়া নিশ্চিত না', 10, 2),
(586, 38, 'বাড্ডা', 'ভাড়া নিশ্চিত না', 15, 3),
(587, 38, 'বিশ্বরোড', 'ভাড়া নিশ্চিত না', 20, 4),
(588, 38, 'এয়ারপোর্ট', 'ভাড়া নিশ্চিত না', 25, 5),
(589, 38, 'টঙ্গী', 'ভাড়া নিশ্চিত না', 30, 6),
(609, 41, 'আসাদ গেট', '', 5, 1),
(610, 41, 'ফার্মগেট', '', 5, 2),
(611, 41, 'বিজয় সরনী', '', 8, 3),
(612, 41, 'মহাখালী', '', 10, 4),
(613, 41, 'গুলশান-১', 'ভাড়া নিশ্চিত না', 15, 5),
(614, 41, 'বাড্ডা', 'ভাড়া নিশ্চিত না', 20, 6),
(622, 42, 'আসাদগেট', 'ভাড়া নিশ্চিত না', 5, 1),
(623, 42, 'কলাবাগান', 'ভাড়া নিশ্চিত না', 10, 2),
(624, 42, 'সাইন্সল্যাব', 'ভাড়া নিশ্চিত না', 15, 3),
(625, 42, 'কাটাবন', 'ভাড়া নিশ্চিত না', 15, 4),
(626, 42, 'শাহবাগ', 'ভাড়া নিশ্চিত না', 20, 5),
(627, 42, 'প্রেসক্লাব', 'ভাড়া নিশ্চিত না', 25, 6),
(628, 42, 'মতিঝিল', 'ভাড়া নিশ্চিত না', 25, 7),
(629, 43, 'আজিমপুর', 'ভাড়া নিশ্চিত না', 5, 1),
(630, 43, 'নীলক্ষেত', 'ভাড়া নিশ্চিত না', 5, 2),
(631, 43, 'সিটি কলেজ', 'ভাড়া নিশ্চিত না', 10, 3),
(632, 43, 'কলাবাগান', 'ভাড়া নিশ্চিত না', 15, 4),
(633, 43, 'শুক্রাবাদ', 'ভাড়া নিশ্চিত না', 15, 5),
(634, 43, 'আসাদগেট', 'ভাড়া নিশ্চিত না', 20, 6),
(635, 43, 'ফার্মগেট', 'ভাড়া নিশ্চিত না', 20, 7),
(636, 43, 'মহাখালী', 'ভাড়া নিশ্চিত না', 25, 8),
(637, 43, 'বনানী/কাকলী', 'ভাড়া নিশ্চিত না', 30, 9),
(645, 44, 'শংকর', 'ভাড়া নিশ্চিত না', 5, 1),
(646, 44, 'ধানমন্ডি-১৫', 'ভাড়া নিশ্চিত না', 5, 2),
(647, 44, 'ঝিগাতলা', 'ভাড়া নিশ্চিত না', 10, 3),
(648, 44, 'সাইন্সল্যাব', 'ভাড়া নিশ্চিত না', 10, 4),
(649, 44, 'শাহবাগ', 'ভাড়া নিশ্চিত না', 15, 5),
(650, 44, 'প্রেসক্লাব', 'ভাড়া নিশ্চিত না', 20, 6),
(651, 44, 'গুলিস্তান', 'ভাড়া নিশ্চিত না', 23, 7),
(652, 40, 'শংকর', 'ভাড়া নিশ্চিত না', 10, 1),
(653, 40, 'ধানমন্ডি-১৫', 'ভাড়া নিশ্চিত না', 10, 2),
(654, 40, 'ঝিগাতলা', 'ভাড়া নিশ্চিত না', 10, 3),
(655, 40, 'সাইন্সল্যাব', 'ভাড়া নিশ্চিত না', 15, 4),
(656, 40, 'কাটাবন', 'ভাড়া নিশ্চিত না', 20, 5),
(657, 40, 'আরামবাগ', 'ভাড়া নিশ্চিত না', 25, 6),
(658, 39, 'গুলিস্তান', 'ভাড়া নিশ্চিত না', 10, 1),
(659, 39, 'কাকরাইল', 'ভাড়া নিশ্চিত না', 10, 2),
(660, 39, 'মালিবাগ', 'ভাড়া নিশ্চিত না', 15, 3),
(661, 39, 'মগবাজার', 'ভাড়া নিশ্চিত না', 20, 4),
(662, 39, 'মহাখালী', 'ভাড়া নিশ্চিত না', 25, 5),
(663, 39, 'এয়ারপোর্ট', 'ভাড়া নিশ্চিত না', 30, 6),
(664, 39, 'আব্দুল্লাহপুর', 'ভাড়া নিশ্চিত না', 35, 7);

-- --------------------------------------------------------

--
-- Table structure for table `thanas`
--

CREATE TABLE `thanas` (
  `id` int(2) UNSIGNED NOT NULL,
  `district_id` int(2) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `bn_name` varchar(50) NOT NULL,
  `guesture` varchar(250) NOT NULL,
  `bn_guesture` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `thanas`
--

INSERT INTO `thanas` (`id`, `district_id`, `name`, `bn_name`, `guesture`, `bn_guesture`) VALUES
(1, 34, 'Amtali', 'আমতলী', '', ''),
(2, 34, 'Bamna', 'বামনা', '', ''),
(3, 34, 'Barguna Sadar', 'বরগুনা সদর', '', ''),
(4, 34, 'Betagi', 'বেতাগি', '', ''),
(5, 34, 'Patharghata', 'পাথরঘাটা', '', ''),
(6, 34, 'Taltali', 'তালতলী', '', ''),
(7, 35, 'Muladi', 'মুলাদি', '', ''),
(8, 35, 'Babuganj', 'বাবুগঞ্জ', '', ''),
(9, 35, 'Agailjhara', 'আগাইলঝরা', '', ''),
(10, 35, 'Barisal Sadar', 'বরিশাল সদর', '', ''),
(11, 35, 'Bakerganj', 'বাকেরগঞ্জ', '', ''),
(12, 35, 'Banaripara', 'বানাড়িপারা', '', ''),
(13, 35, 'Gaurnadi', 'গৌরনদী', '', ''),
(14, 35, 'Hizla', 'হিজলা', '', ''),
(15, 35, 'Mehendiganj', 'মেহেদিগঞ্জ ', '', ''),
(16, 35, 'Wazirpur', 'ওয়াজিরপুর', '', ''),
(17, 36, 'Bhola Sadar', 'ভোলা সদর', '', ''),
(18, 36, 'Burhanuddin', 'বুরহানউদ্দিন', '', ''),
(19, 36, 'Char Fasson', 'চর ফ্যাশন', '', ''),
(20, 36, 'Daulatkhan', 'দৌলতখান', '', ''),
(21, 36, 'Lalmohan', 'লালমোহন', '', ''),
(22, 36, 'Manpura', 'মনপুরা', '', ''),
(23, 36, 'Tazumuddin', 'তাজুমুদ্দিন', '', ''),
(24, 37, 'Jhalokati Sadar', 'ঝালকাঠি সদর', '', ''),
(25, 37, 'Kathalia', 'কাঁঠালিয়া', '', ''),
(26, 37, 'Nalchity', 'নালচিতি', '', ''),
(27, 37, 'Rajapur', 'রাজাপুর', '', ''),
(28, 38, 'Bauphal', 'বাউফল', '', ''),
(29, 38, 'Dashmina', 'দশমিনা', '', ''),
(30, 38, 'Galachipa', 'গলাচিপা', '', ''),
(31, 38, 'Kalapara', 'কালাপারা', '', ''),
(32, 38, 'Mirzaganj', 'মির্জাগঞ্জ ', '', ''),
(33, 38, 'Patuakhali Sadar', 'পটুয়াখালী সদর', '', ''),
(34, 38, 'Dumki', 'ডুমকি', '', ''),
(35, 38, 'Rangabali', 'রাঙ্গাবালি', '', ''),
(36, 39, 'Bhandaria', 'ভ্যান্ডারিয়া', '', ''),
(37, 39, 'Kaukhali', 'কাউখালি', '', ''),
(38, 39, 'Mathbaria', 'মাঠবাড়িয়া', '', ''),
(39, 39, 'Nazirpur', 'নাজিরপুর', '', ''),
(40, 39, 'Nesarabad', 'নেসারাবাদ', '', ''),
(41, 39, 'Pirojpur Sadar', 'পিরোজপুর সদর', '', ''),
(42, 39, 'Zianagar', 'জিয়ানগর', '', ''),
(43, 40, 'Bandarban Sadar', 'বান্দরবন সদর', '', ''),
(44, 40, 'Thanchi', 'থানচি', '', ''),
(45, 40, 'Lama', 'লামা', '', ''),
(46, 40, 'Naikhongchhari', 'নাইখংছড়ি ', '', ''),
(47, 40, 'Ali kadam', 'আলী কদম', '', ''),
(48, 40, 'Rowangchhari', 'রউয়াংছড়ি ', '', ''),
(49, 40, 'Ruma', 'রুমা', '', ''),
(50, 41, 'Brahmanbaria Sadar', 'ব্রাহ্মণবাড়িয়া সদর', '', ''),
(51, 41, 'Ashuganj', 'আশুগঞ্জ', '', ''),
(52, 41, 'Nasirnagar', 'নাসির নগর', '', ''),
(53, 41, 'Nabinagar', 'নবীনগর', '', ''),
(54, 41, 'Sarail', 'সরাইল', '', ''),
(55, 41, 'Shahbazpur Town', 'শাহবাজপুর টাউন', '', ''),
(56, 41, 'Kasba', 'কসবা', '', ''),
(57, 41, 'Akhaura', 'আখাউরা', '', ''),
(58, 41, 'Bancharampur', 'বাঞ্ছারামপুর', '', ''),
(59, 41, 'Bijoynagar', 'বিজয় নগর', '', ''),
(60, 42, 'Chandpur Sadar', 'চাঁদপুর সদর', '', ''),
(61, 42, 'Faridganj', 'ফরিদগঞ্জ', '', ''),
(62, 42, 'Haimchar', 'হাইমচর', '', ''),
(63, 42, 'Haziganj', 'হাজীগঞ্জ', '', ''),
(64, 42, 'Kachua', 'কচুয়া', '', ''),
(65, 42, 'Matlab Uttar', 'মতলব উত্তর', '', ''),
(66, 42, 'Matlab Dakkhin', 'মতলব দক্ষিণ', '', ''),
(67, 42, 'Shahrasti', 'শাহরাস্তি', '', ''),
(68, 43, 'Anwara', 'আনোয়ারা', '', ''),
(69, 43, 'Banshkhali', 'বাশখালি', '', ''),
(70, 43, 'Boalkhali', 'বোয়ালখালি', '', ''),
(71, 43, 'Chandanaish', 'চন্দনাইশ', '', ''),
(72, 43, 'Fatikchhari', 'ফটিকছড়ি', '', ''),
(73, 43, 'Hathazari', 'হাঠহাজারী', '', ''),
(74, 43, 'Lohagara', 'লোহাগারা', '', ''),
(75, 43, 'Mirsharai', 'মিরসরাই', '', ''),
(76, 43, 'Patiya', 'পটিয়া', '', ''),
(77, 43, 'Rangunia', 'রাঙ্গুনিয়া', '', ''),
(78, 43, 'Raozan', 'রাউজান', '', ''),
(79, 43, 'Sandwip', 'সন্দ্বীপ', '', ''),
(80, 43, 'Satkania', 'সাতকানিয়া', '', ''),
(81, 43, 'Sitakunda', 'সীতাকুণ্ড', '', ''),
(82, 44, 'Barura', 'বড়ুরা', '', ''),
(83, 44, 'Brahmanpara', 'ব্রাহ্মণপাড়া', '', ''),
(84, 44, 'Burichong', 'বুড়িচং', '', ''),
(85, 44, 'Chandina', 'চান্দিনা', '', ''),
(86, 44, 'Chauddagram', 'চৌদ্দগ্রাম', '', ''),
(87, 44, 'Daudkandi', 'দাউদকান্দি', '', ''),
(88, 44, 'Debidwar', 'দেবীদ্বার', '', ''),
(89, 44, 'Homna', 'হোমনা', '', ''),
(90, 44, 'Comilla Sadar', 'কুমিল্লা সদর', '', ''),
(91, 44, 'Laksam', 'লাকসাম', '', ''),
(92, 44, 'Monohorgonj', 'মনোহরগঞ্জ', '', ''),
(93, 44, 'Meghna', 'মেঘনা', '', ''),
(94, 44, 'Muradnagar', 'মুরাদনগর', '', ''),
(95, 44, 'Nangalkot', 'নাঙ্গালকোট', '', ''),
(96, 44, 'Comilla Sadar South', 'কুমিল্লা সদর দক্ষিণ', '', ''),
(97, 44, 'Titas', 'তিতাস', '', ''),
(98, 45, 'Chakaria', 'চকরিয়া', '', ''),
(99, 45, 'Chakaria', 'চকরিয়া', '', ''),
(100, 45, 'Cox''s Bazar Sadar', 'কক্স বাজার সদর', '', ''),
(101, 45, 'Kutubdia', 'কুতুবদিয়া', '', ''),
(102, 45, 'Maheshkhali', 'মহেশখালী', '', ''),
(103, 45, 'Ramu', 'রামু', '', ''),
(104, 45, 'Teknaf', 'টেকনাফ', '', ''),
(105, 45, 'Ukhia', 'উখিয়া', '', ''),
(106, 45, 'Pekua', 'পেকুয়া', '', ''),
(107, 46, 'Feni Sadar', 'ফেনী সদর', '', ''),
(108, 46, 'Chagalnaiya', 'ছাগল নাইয়া', '', ''),
(109, 46, 'Daganbhyan', 'দাগানভিয়া', '', ''),
(110, 46, 'Parshuram', 'পরশুরাম', '', ''),
(111, 46, 'Fhulgazi', 'ফুলগাজি', '', ''),
(112, 46, 'Sonagazi', 'সোনাগাজি', '', ''),
(113, 47, 'Dighinala', 'দিঘিনালা ', '', ''),
(114, 47, 'Khagrachhari', 'খাগড়াছড়ি', '', ''),
(115, 47, 'Lakshmichhari', 'লক্ষ্মীছড়ি', '', ''),
(116, 47, 'Mahalchhari', 'মহলছড়ি', '', ''),
(117, 47, 'Manikchhari', 'মানিকছড়ি', '', ''),
(118, 47, 'Matiranga', 'মাটিরাঙ্গা', '', ''),
(119, 47, 'Panchhari', 'পানছড়ি', '', ''),
(120, 47, 'Ramgarh', 'রামগড়', '', ''),
(121, 48, 'Lakshmipur Sadar', 'লক্ষ্মীপুর সদর', '', ''),
(122, 48, 'Raipur', 'রায়পুর', '', ''),
(123, 48, 'Ramganj', 'রামগঞ্জ', '', ''),
(124, 48, 'Ramgati', 'রামগতি', '', ''),
(125, 48, 'Komol Nagar', 'কমল নগর', '', ''),
(126, 49, 'Noakhali Sadar', 'নোয়াখালী সদর', '', ''),
(127, 49, 'Begumganj', 'বেগমগঞ্জ', '', ''),
(128, 49, 'Chatkhil', 'চাটখিল', '', ''),
(129, 49, 'Companyganj', 'কোম্পানীগঞ্জ', '', ''),
(130, 49, 'Shenbag', 'শেনবাগ', '', ''),
(131, 49, 'Hatia', 'হাতিয়া', '', ''),
(132, 49, 'Kobirhat', 'কবিরহাট ', '', ''),
(133, 49, 'Sonaimuri', 'সোনাইমুরি', '', ''),
(134, 49, 'Suborno Char', 'সুবর্ণ চর ', '', ''),
(135, 50, 'Rangamati Sadar', 'রাঙ্গামাটি সদর', '', ''),
(136, 50, 'Belaichhari', 'বেলাইছড়ি', '', ''),
(137, 50, 'Bagaichhari', 'বাঘাইছড়ি', '', ''),
(138, 50, 'Barkal', 'বরকল', '', ''),
(139, 50, 'Juraichhari', 'জুরাইছড়ি', '', ''),
(140, 50, 'Rajasthali', 'রাজাস্থলি', '', ''),
(141, 50, 'Kaptai', 'কাপ্তাই', '', ''),
(142, 50, 'Langadu', 'লাঙ্গাডু', '', ''),
(143, 50, 'Nannerchar', 'নান্নেরচর ', '', ''),
(144, 50, 'Kaukhali', 'কাউখালি', '', ''),
(145, 1, 'Dhamrai', 'ধামরাই', '', ''),
(146, 1, 'Dohar', 'দোহার', '', ''),
(147, 1, 'Keraniganj', 'কেরানীগঞ্জ', '', ''),
(148, 1, 'Nawabganj', 'নবাবগঞ্জ', '', ''),
(149, 1, 'Savar', 'সাভার', '', ''),
(150, 2, 'Faridpur Sadar', 'ফরিদপুর সদর', '', ''),
(151, 2, 'Boalmari', 'বোয়ালমারী', '', ''),
(152, 2, 'Alfadanga', 'আলফাডাঙ্গা', '', ''),
(153, 2, 'Madhukhali', 'মধুখালি', '', ''),
(154, 2, 'Bhanga', 'ভাঙ্গা', '', ''),
(155, 2, 'Nagarkanda', 'নগরকান্ড', '', ''),
(156, 2, 'Charbhadrasan', 'চরভদ্রাসন ', '', ''),
(157, 2, 'Sadarpur', 'সদরপুর', '', ''),
(158, 2, 'Shaltha', 'শালথা', '', ''),
(159, 3, 'Gazipur Sadar-Joydebpur', 'গাজীপুর সদর', '', ''),
(160, 3, 'Kaliakior', 'কালিয়াকৈর', '', ''),
(161, 3, 'Kapasia', 'কাপাসিয়া', '', ''),
(162, 3, 'Sripur', 'শ্রীপুর', '', ''),
(163, 3, 'Kaliganj', 'কালীগঞ্জ', '', ''),
(164, 3, 'Tongi', 'টঙ্গি', '', ''),
(165, 4, 'Gopalganj Sadar', 'গোপালগঞ্জ সদর', '', ''),
(166, 4, 'Kashiani', 'কাশিয়ানি', '', ''),
(167, 4, 'Kotalipara', 'কোটালিপাড়া', '', ''),
(168, 4, 'Muksudpur', 'মুকসুদপুর', '', ''),
(169, 4, 'Tungipara', 'টুঙ্গিপাড়া', '', ''),
(170, 5, 'Dewanganj', 'দেওয়ানগঞ্জ', '', ''),
(171, 5, 'Baksiganj', 'বকসিগঞ্জ', '', ''),
(172, 5, 'Islampur', 'ইসলামপুর', '', ''),
(173, 5, 'Jamalpur Sadar', 'জামালপুর সদর', '', ''),
(174, 5, 'Madarganj', 'মাদারগঞ্জ', '', ''),
(175, 5, 'Melandaha', 'মেলানদাহা', '', ''),
(176, 5, 'Sarishabari', 'সরিষাবাড়ি ', '', ''),
(177, 5, 'Narundi Police I.C', 'নারুন্দি', '', ''),
(178, 6, 'Astagram', 'অষ্টগ্রাম', '', ''),
(179, 6, 'Bajitpur', 'বাজিতপুর', '', ''),
(180, 6, 'Bhairab', 'ভৈরব', '', ''),
(181, 6, 'Hossainpur', 'হোসেনপুর ', '', ''),
(182, 6, 'Itna', 'ইটনা', '', ''),
(183, 6, 'Karimganj', 'করিমগঞ্জ', '', ''),
(184, 6, 'Katiadi', 'কতিয়াদি', '', ''),
(185, 6, 'Kishoreganj Sadar', 'কিশোরগঞ্জ সদর', '', ''),
(186, 6, 'Kuliarchar', 'কুলিয়ারচর', '', ''),
(187, 6, 'Mithamain', 'মিঠামাইন', '', ''),
(188, 6, 'Nikli', 'নিকলি', '', ''),
(189, 6, 'Pakundia', 'পাকুন্ডা', '', ''),
(190, 6, 'Tarail', 'তাড়াইল', '', ''),
(191, 7, 'Madaripur Sadar', 'মাদারীপুর সদর', '', ''),
(192, 7, 'Kalkini', 'কালকিনি', '', ''),
(193, 7, 'Rajoir', 'রাজইর', '', ''),
(194, 7, 'Shibchar', 'শিবচর', '', ''),
(195, 8, 'Manikganj Sadar', 'মানিকগঞ্জ সদর', '', ''),
(196, 8, 'Singair', 'সিঙ্গাইর', '', ''),
(197, 8, 'Shibalaya', 'শিবালয়', '', ''),
(198, 8, 'Saturia', 'সাঠুরিয়া', '', ''),
(199, 8, 'Harirampur', 'হরিরামপুর', '', ''),
(200, 8, 'Ghior', 'ঘিওর', '', ''),
(201, 8, 'Daulatpur', 'দৌলতপুর', '', ''),
(202, 9, 'Lohajang', 'লোহাজং', '', ''),
(203, 9, 'Sreenagar', 'শ্রীনগর', '', ''),
(204, 9, 'Munshiganj Sadar', 'মুন্সিগঞ্জ সদর', '', ''),
(205, 9, 'Sirajdikhan', 'সিরাজদিখান', '', ''),
(206, 9, 'Tongibari', 'টঙ্গিবাড়ি', '', ''),
(207, 9, 'Gazaria', 'গজারিয়া', '', ''),
(208, 10, 'Bhaluka', 'ভালুকা', '', ''),
(209, 10, 'Trishal', 'ত্রিশাল', '', ''),
(210, 10, 'Haluaghat', 'হালুয়াঘাট', '', ''),
(211, 10, 'Muktagachha', 'মুক্তাগাছা', '', ''),
(212, 10, 'Dhobaura', 'ধবারুয়া', '', ''),
(213, 10, 'Fulbaria', 'ফুলবাড়িয়া', '', ''),
(214, 10, 'Gaffargaon', 'গফরগাঁও', '', ''),
(215, 10, 'Gauripur', 'গৌরিপুর', '', ''),
(216, 10, 'Ishwarganj', 'ঈশ্বরগঞ্জ', '', ''),
(217, 10, 'Mymensingh Sadar', 'ময়মনসিং সদর', '', ''),
(218, 10, 'Nandail', 'নন্দাইল', '', ''),
(219, 10, 'Phulpur', 'ফুলপুর', '', ''),
(220, 11, 'Araihazar', 'আড়াইহাজার', '', ''),
(221, 11, 'Sonargaon', 'সোনারগাঁও', '', ''),
(222, 11, 'Bandar', 'বান্দার', '', ''),
(223, 11, 'Naryanganj Sadar', 'নারায়ানগঞ্জ সদর', '', ''),
(224, 11, 'Rupganj', 'রূপগঞ্জ', '', ''),
(225, 11, 'Siddirgonj', 'সিদ্ধিরগঞ্জ', '', ''),
(226, 12, 'Belabo', 'বেলাবো', '', ''),
(227, 12, 'Monohardi', 'মনোহরদি', '', ''),
(228, 12, 'Narsingdi Sadar', 'নরসিংদী সদর', '', ''),
(229, 12, 'Palash', 'পলাশ', '', ''),
(230, 12, 'Raipura, Narsingdi', 'রায়পুর', '', ''),
(231, 12, 'Shibpur', 'শিবপুর', '', ''),
(232, 13, 'Kendua Upazilla', 'কেন্দুয়া', '', ''),
(233, 13, 'Atpara Upazilla', 'আটপাড়া', '', ''),
(234, 13, 'Barhatta Upazilla', 'বরহাট্টা', '', ''),
(235, 13, 'Durgapur Upazilla', 'দুর্গাপুর', '', ''),
(236, 13, 'Kalmakanda Upazilla', 'কলমাকান্দা', '', ''),
(237, 13, 'Madan Upazilla', 'মদন', '', ''),
(238, 13, 'Mohanganj Upazilla', 'মোহনগঞ্জ', '', ''),
(239, 13, 'Netrakona-S Upazilla', 'নেত্রকোনা সদর', '', ''),
(240, 13, 'Purbadhala Upazilla', 'পূর্বধলা', '', ''),
(241, 13, 'Khaliajuri Upazilla', 'খালিয়াজুরি', '', ''),
(242, 14, 'Baliakandi', 'বালিয়াকান্দি', '', ''),
(243, 14, 'Goalandaghat', 'গোয়ালন্দ ঘাট', '', ''),
(244, 14, 'Pangsha', 'পাংশা', '', ''),
(245, 14, 'Kalukhali', 'কালুখালি', '', ''),
(246, 14, 'Rajbari Sadar', 'রাজবাড়ি সদর', '', ''),
(247, 15, 'Shariatpur Sadar -Palong', 'শরীয়তপুর সদর ', '', ''),
(248, 15, 'Damudya', 'দামুদিয়া', '', ''),
(249, 15, 'Naria', 'নড়িয়া', '', ''),
(250, 15, 'Jajira', 'জাজিরা', '', ''),
(251, 15, 'Bhedarganj', 'ভেদারগঞ্জ', '', ''),
(252, 15, 'Gosairhat', 'গোসাইর হাট ', '', ''),
(253, 16, 'Jhenaigati', 'ঝিনাইগাতি', '', ''),
(254, 16, 'Nakla', 'নাকলা', '', ''),
(255, 16, 'Nalitabari', 'নালিতাবাড়ি', '', ''),
(256, 16, 'Sherpur Sadar', 'শেরপুর সদর', '', ''),
(257, 16, 'Sreebardi', 'শ্রীবরদি', '', ''),
(258, 17, 'Tangail Sadar', 'টাঙ্গাইল সদর', '', ''),
(259, 17, 'Sakhipur', 'সখিপুর', '', ''),
(260, 17, 'Basail', 'বসাইল', '', ''),
(261, 17, 'Madhupur', 'মধুপুর', '', ''),
(262, 17, 'Ghatail', 'ঘাটাইল', '', ''),
(263, 17, 'Kalihati', 'কালিহাতি', '', ''),
(264, 17, 'Nagarpur', 'নগরপুর', '', ''),
(265, 17, 'Mirzapur', 'মির্জাপুর', '', ''),
(266, 17, 'Gopalpur', 'গোপালপুর', '', ''),
(267, 17, 'Delduar', 'দেলদুয়ার', '', ''),
(268, 17, 'Bhuapur', 'ভুয়াপুর', '', ''),
(269, 17, 'Dhanbari', 'ধানবাড়ি', '', ''),
(270, 55, 'Bagerhat Sadar', 'বাগেরহাট সদর', '', ''),
(271, 55, 'Chitalmari', 'চিতলমাড়ি', '', ''),
(272, 55, 'Fakirhat', 'ফকিরহাট', '', ''),
(273, 55, 'Kachua', 'কচুয়া', '', ''),
(274, 55, 'Mollahat', 'মোল্লাহাট ', '', ''),
(275, 55, 'Mongla', 'মংলা', '', ''),
(276, 55, 'Morrelganj', 'মরেলগঞ্জ', '', ''),
(277, 55, 'Rampal', 'রামপাল', '', ''),
(278, 55, 'Sarankhola', 'স্মরণখোলা', '', ''),
(279, 56, 'Damurhuda', 'দামুরহুদা', '', ''),
(280, 56, 'Chuadanga-S', 'চুয়াডাঙ্গা সদর', '', ''),
(281, 56, 'Jibannagar', 'জীবন নগর ', '', ''),
(282, 56, 'Alamdanga', 'আলমডাঙ্গা', '', ''),
(283, 57, 'Abhaynagar', 'অভয়নগর', '', ''),
(284, 57, 'Keshabpur', 'কেশবপুর', '', ''),
(285, 57, 'Bagherpara', 'বাঘের পাড়া ', '', ''),
(286, 57, 'Jessore Sadar', 'যশোর সদর', '', ''),
(287, 57, 'Chaugachha', 'চৌগাছা', '', ''),
(288, 57, 'Manirampur', 'মনিরামপুর ', '', ''),
(289, 57, 'Jhikargachha', 'ঝিকরগাছা', '', ''),
(290, 57, 'Sharsha', 'সারশা', '', ''),
(291, 58, 'Jhenaidah Sadar', 'ঝিনাইদহ সদর', '', ''),
(292, 58, 'Maheshpur', 'মহেশপুর', '', ''),
(293, 58, 'Kaliganj', 'কালীগঞ্জ', '', ''),
(294, 58, 'Kotchandpur', 'কোট চাঁদপুর ', '', ''),
(295, 58, 'Shailkupa', 'শৈলকুপা', '', ''),
(296, 58, 'Harinakunda', 'হাড়িনাকুন্দা', '', ''),
(297, 59, 'Terokhada', 'তেরোখাদা', '', ''),
(298, 59, 'Batiaghata', 'বাটিয়াঘাটা ', '', ''),
(299, 59, 'Dacope', 'ডাকপে', '', ''),
(300, 59, 'Dumuria', 'ডুমুরিয়া', '', ''),
(301, 59, 'Dighalia', 'দিঘলিয়া', '', ''),
(302, 59, 'Koyra', 'কয়ড়া', '', ''),
(303, 59, 'Paikgachha', 'পাইকগাছা', '', ''),
(304, 59, 'Phultala', 'ফুলতলা', '', ''),
(305, 59, 'Rupsa', 'রূপসা', '', ''),
(306, 60, 'Kushtia Sadar', 'কুষ্টিয়া সদর', '', ''),
(307, 60, 'Kumarkhali', 'কুমারখালি', '', ''),
(308, 60, 'Daulatpur', 'দৌলতপুর', 'Dowlatpur,Doulatpur', ''),
(309, 60, 'Mirpur', 'মিরপুর', '', ''),
(310, 60, 'Bheramara', 'ভেরামারা', 'Veramara', ''),
(311, 60, 'Khoksa', 'খোকসা', '', ''),
(312, 61, 'Magura Sadar', 'মাগুরা সদর', '', ''),
(313, 61, 'Mohammadpur', 'মোহাম্মাদপুর', 'Muhammadpur', ''),
(314, 61, 'Shalikha', 'শালিখা', 'Salikha', ''),
(315, 61, 'Sreepur', 'শ্রীপুর', 'Sripur', ''),
(316, 62, 'angni', 'আংনি', '', ''),
(317, 62, 'Mujib Nagar', 'মুজিব নগর', '', ''),
(318, 62, 'Meherpur-S', 'মেহেরপুর সদর', '', ''),
(319, 63, 'Narail-S Upazilla', 'নড়াইল সদর', 'Norail Sadar', ''),
(320, 63, 'Lohagara Upazilla', 'লোহাগাড়া', '', ''),
(321, 63, 'Kalia Upazilla', 'কালিয়া', '', ''),
(322, 64, 'Satkhira Sadar', 'সাতক্ষীরা সদর', '', ''),
(323, 64, 'Assasuni', 'আসসাশুনি ', '', ''),
(324, 64, 'Debhata', 'দেভাটা', '', ''),
(325, 64, 'Tala', 'তালা', '', ''),
(326, 64, 'Kalaroa', 'কলরোয়া', 'Koloroa', ''),
(327, 64, 'Kaliganj', 'কালীগঞ্জ', '', ''),
(328, 64, 'Shyamnagar', 'শ্যামনগর', 'Shamnogor, Shamnagar,Shamnogar', ''),
(329, 18, 'Adamdighi', 'আদমদিঘী', '', ''),
(330, 18, 'Bogra Sadar', 'বগুড়া সদর', '', ''),
(331, 18, 'Sherpur', 'শেরপুর', '', ''),
(332, 18, 'Dhunat', 'ধুনট', '', ''),
(333, 18, 'Dhupchanchia', 'দুপচাচিয়া', '', ''),
(334, 18, 'Gabtali', 'গাবতলি', '', ''),
(335, 18, 'Kahaloo', 'কাহালু', '', ''),
(336, 18, 'Nandigram', 'নন্দিগ্রাম', '', ''),
(337, 18, 'Sahajanpur', 'শাহজাহানপুর', '', ''),
(338, 18, 'Sariakandi', 'সারিয়াকান্দি', '', ''),
(339, 18, 'Shibganj', 'শিবগঞ্জ', '', ''),
(340, 18, 'Sonatala', 'সোনাতলা', '', ''),
(341, 19, 'Joypurhat S', 'জয়পুরহাট সদর', '', ''),
(342, 19, 'Akkelpur', 'আক্কেলপুর', '', ''),
(343, 19, 'Kalai', 'কালাই', '', ''),
(344, 19, 'Khetlal', 'খেতলাল', '', ''),
(345, 19, 'Panchbibi', 'পাঁচবিবি', '', ''),
(346, 20, 'Naogaon Sadar', 'নওগাঁ সদর', '', ''),
(347, 20, 'Mohadevpur', 'মহাদেবপুর', '', ''),
(348, 20, 'Manda', 'মান্দা', '', ''),
(349, 20, 'Niamatpur', 'নিয়ামতপুর', '', ''),
(350, 20, 'Atrai', 'আত্রাই', '', ''),
(351, 20, 'Raninagar', 'রাণীনগর', '', ''),
(352, 20, 'Patnitala', 'পত্নীতলা', '', ''),
(353, 20, 'Dhamoirhat', 'ধামইরহাট ', '', ''),
(354, 20, 'Sapahar', 'সাপাহার', '', ''),
(355, 20, 'Porsha', 'পোরশা', '', ''),
(356, 20, 'Badalgachhi', 'বদলগাছি', '', ''),
(357, 21, 'Natore Sadar', 'নাটোর সদর', '', ''),
(358, 21, 'Baraigram', 'বড়াইগ্রাম', '', ''),
(359, 21, 'Bagatipara', 'বাগাতিপাড়া', '', ''),
(360, 21, 'Lalpur', 'লালপুর', '', ''),
(361, 21, 'Natore Sadar', 'নাটোর সদর', '', ''),
(362, 21, 'Baraigram', 'বড়াই গ্রাম', '', ''),
(363, 22, 'Bholahat', 'ভোলাহাট', '', ''),
(364, 22, 'Gomastapur', 'গোমস্তাপুর', '', ''),
(365, 22, 'Nachole', 'নাচোল', '', ''),
(366, 22, 'Nawabganj Sadar', 'নবাবগঞ্জ সদর', '', ''),
(367, 22, 'Shibganj', 'শিবগঞ্জ', '', ''),
(368, 23, 'Atgharia', 'আটঘরিয়া', '', ''),
(369, 23, 'Bera', 'বেড়া', '', ''),
(370, 23, 'Bhangura', 'ভাঙ্গুরা', '', ''),
(371, 23, 'Chatmohar', 'চাটমোহর', '', ''),
(372, 23, 'Faridpur', 'ফরিদপুর', '', ''),
(373, 23, 'Ishwardi', 'ঈশ্বরদী', '', ''),
(374, 23, 'Pabna Sadar', 'পাবনা সদর', '', ''),
(375, 23, 'Santhia', 'সাথিয়া', '', ''),
(376, 23, 'Sujanagar', 'সুজানগর', '', ''),
(377, 24, 'Bagha', 'বাঘা', '', ''),
(378, 24, 'Bagmara', 'বাগমারা', '', ''),
(379, 24, 'Charghat', 'চারঘাট', '', ''),
(380, 24, 'Durgapur', 'দুর্গাপুর', '', ''),
(381, 24, 'Godagari', 'গোদাগারি', '', ''),
(382, 24, 'Mohanpur', 'মোহনপুর', '', ''),
(383, 24, 'Paba', 'পবা', '', ''),
(384, 24, 'Puthia', 'পুঠিয়া', '', ''),
(385, 24, 'Tanore', 'তানোর', '', ''),
(386, 25, 'Sirajganj Sadar', 'সিরাজগঞ্জ সদর', '', ''),
(387, 25, 'Belkuchi', 'বেলকুচি', '', ''),
(388, 25, 'Chauhali', 'চৌহালি', '', ''),
(389, 25, 'Kamarkhanda', 'কামারখান্দা', '', ''),
(390, 25, 'Kazipur', 'কাজীপুর', '', ''),
(391, 25, 'Raiganj', 'রায়গঞ্জ', '', ''),
(392, 25, 'Shahjadpur', 'শাহজাদপুর', '', ''),
(393, 25, 'Tarash', 'তারাশ', '', ''),
(394, 25, 'Ullahpara', 'উল্লাপাড়া', '', ''),
(395, 26, 'Birampur', 'বিরামপুর', '', ''),
(396, 26, 'Birganj', 'বীরগঞ্জ', '', ''),
(397, 26, 'Biral', 'বিড়াল', '', ''),
(398, 26, 'Bochaganj', 'বোচাগঞ্জ', '', ''),
(399, 26, 'Chirirbandar', 'চিরিরবন্দর', '', ''),
(400, 26, 'Phulbari', 'ফুলবাড়ি', '', ''),
(401, 26, 'Ghoraghat', 'ঘোড়াঘাট', '', ''),
(402, 26, 'Hakimpur', 'হাকিমপুর', '', ''),
(403, 26, 'Kaharole', 'কাহারোল', '', ''),
(404, 26, 'Khansama', 'খানসামা', '', ''),
(405, 26, 'Dinajpur Sadar', 'দিনাজপুর সদর', '', ''),
(406, 26, 'Nawabganj', 'নবাবগঞ্জ', '', ''),
(407, 26, 'Parbatipur', 'পার্বতীপুর', '', ''),
(408, 27, 'Fulchhari', 'ফুলছড়ি', '', ''),
(409, 27, 'Gaibandha sadar', 'গাইবান্ধা সদর', '', ''),
(410, 27, 'Gobindaganj', 'গোবিন্দগঞ্জ', '', ''),
(411, 27, 'Palashbari', 'পলাশবাড়ী', '', ''),
(412, 27, 'Sadullapur', 'সাদুল্যাপুর', '', ''),
(413, 27, 'Saghata', 'সাঘাটা', '', ''),
(414, 27, 'Sundarganj', 'সুন্দরগঞ্জ', '', ''),
(415, 28, 'Kurigram Sadar', 'কুড়িগ্রাম সদর', '', ''),
(416, 28, 'Nageshwari', 'নাগেশ্বরী', '', ''),
(417, 28, 'Bhurungamari', 'ভুরুঙ্গামারি', '', ''),
(418, 28, 'Phulbari', 'ফুলবাড়ি', '', ''),
(419, 28, 'Rajarhat', 'রাজারহাট', '', ''),
(420, 28, 'Ulipur', 'উলিপুর', '', ''),
(421, 28, 'Chilmari', 'চিলমারি', '', ''),
(422, 28, 'Rowmari', 'রউমারি', '', ''),
(423, 28, 'Char Rajibpur', 'চর রাজিবপুর', '', ''),
(424, 29, 'Lalmanirhat Sadar', 'লালমনিরহাট সদর', '', ''),
(425, 29, 'Aditmari', 'আদিতমারি', '', ''),
(426, 29, 'Kaliganj', 'কালীগঞ্জ', '', ''),
(427, 29, 'Hatibandha', 'হাতিবান্ধা', '', ''),
(428, 29, 'Patgram', 'পাটগ্রাম', '', ''),
(429, 30, 'Nilphamari Sadar', 'নীলফামারী সদর', '', ''),
(430, 30, 'Saidpur', 'সৈয়দপুর', '', ''),
(431, 30, 'Jaldhaka', 'জলঢাকা', '', ''),
(432, 30, 'Kishoreganj', 'কিশোরগঞ্জ', '', ''),
(433, 30, 'Domar', 'ডোমার', '', ''),
(434, 30, 'Dimla', 'ডিমলা', '', ''),
(435, 31, 'Panchagarh Sadar', 'পঞ্চগড় সদর', '', ''),
(436, 31, 'Debiganj', 'দেবীগঞ্জ', '', ''),
(437, 31, 'Boda', 'বোদা', '', ''),
(438, 31, 'Atwari', 'আটোয়ারি', '', ''),
(439, 31, 'Tetulia', 'তেতুলিয়া', '', ''),
(440, 32, 'Badarganj', 'বদরগঞ্জ', '', ''),
(441, 32, 'Mithapukur', 'মিঠাপুকুর', '', ''),
(442, 32, 'Gangachara', 'গঙ্গাচরা', '', ''),
(443, 32, 'Kaunia', 'কাউনিয়া', '', ''),
(444, 32, 'Rangpur Sadar', 'রংপুর সদর', '', ''),
(445, 32, 'Pirgachha', 'পীরগাছা', '', ''),
(446, 32, 'Pirganj', 'পীরগঞ্জ', '', ''),
(447, 32, 'Taraganj', 'তারাগঞ্জ', '', ''),
(448, 33, 'Thakurgaon Sadar', 'ঠাকুরগাঁও সদর', '', ''),
(449, 33, 'Pirganj', 'পীরগঞ্জ', '', ''),
(450, 33, 'Baliadangi', 'বালিয়াডাঙ্গি', '', ''),
(451, 33, 'Haripur', 'হরিপুর', '', ''),
(452, 33, 'Ranisankail', 'রাণীসংকইল', '', ''),
(453, 51, 'Ajmiriganj', 'আজমিরিগঞ্জ', '', ''),
(454, 51, 'Baniachang', 'বানিয়াচং', '', ''),
(455, 51, 'Bahubal', 'বাহুবল', '', ''),
(456, 51, 'Chunarughat', 'চুনারুঘাট', '', ''),
(457, 51, 'Habiganj Sadar', 'হবিগঞ্জ সদর', '', ''),
(458, 51, 'Lakhai', 'লাক্ষাই', '', ''),
(459, 51, 'Madhabpur', 'মাধবপুর', '', ''),
(460, 51, 'Nabiganj', 'নবীগঞ্জ', '', ''),
(461, 51, 'Shaistagonj', 'শায়েস্তাগঞ্জ', '', ''),
(462, 52, 'Moulvibazar Sadar', 'মৌলভীবাজার', '', ''),
(463, 52, 'Barlekha', 'বড়লেখা', '', ''),
(464, 52, 'Juri', 'জুড়ি', '', ''),
(465, 52, 'Kamalganj', 'কামালগঞ্জ', '', ''),
(466, 52, 'Kulaura', 'কুলাউরা', '', ''),
(467, 52, 'Rajnagar', 'রাজনগর', '', ''),
(468, 52, 'Sreemangal', 'শ্রীমঙ্গল', 'Srimangal,Srimongol,Srimangol', ''),
(469, 53, 'Bishwamvarpur', 'বিসশম্ভারপুর', '', ''),
(470, 53, 'Chhatak', 'ছাতক', 'Satak,Satok', ''),
(471, 53, 'Derai', 'দেড়াই', '', ''),
(472, 53, 'Dharampasha', 'ধরমপাশা', '', ''),
(473, 53, 'Dowarabazar', 'দোয়ারাবাজার', '', ''),
(474, 53, 'Jagannathpur', 'জগন্নাথপুর', '', ''),
(475, 53, 'Jamalganj', 'জামালগঞ্জ', '', ''),
(476, 53, 'Sulla', 'সুল্লা', '', ''),
(477, 53, 'Sunamganj Sadar', 'সুনামগঞ্জ সদর', '', ''),
(478, 53, 'Shanthiganj', 'শান্তিগঞ্জ', '', ''),
(479, 53, 'Tahirpur', 'তাহিরপুর', '', ''),
(480, 54, 'Sylhet Sadar', 'সিলেট সদর', '', ''),
(481, 54, 'Beanibazar', 'বেয়ানিবাজার', '', ''),
(482, 54, 'Bishwanath', 'বিশ্বনাথ', '', ''),
(483, 54, 'Dakshin Surma', 'দক্ষিণ সুরমা', '', ''),
(484, 54, 'Balaganj', 'বালাগঞ্জ', '', ''),
(485, 54, 'Companiganj', 'কোম্পানিগঞ্জ', '', ''),
(486, 54, 'Fenchuganj', 'ফেঞ্চুগঞ্জ', '', ''),
(487, 54, 'Golapganj', 'গোলাপগঞ্জ', '', ''),
(488, 54, 'Gowainghat', 'গোয়াইনঘাট', '', ''),
(489, 54, 'Jaintiapur', 'জয়ন্তপুর', '', ''),
(490, 54, 'Kanaighat', 'কানাইঘাট', '', ''),
(491, 54, 'Zakiganj', 'জাকিগঞ্জ', '', ''),
(492, 54, 'Nobigonj', 'নবীগঞ্জ', '', ''),
(493, 1, 'Mohammadpur', 'মোহাম্মাদপুর', '', ''),
(496, 1, 'Adabor', 'আদাবর', '', ''),
(497, 1, 'Badda', 'বাড্ডা', '', ''),
(499, 1, 'Bongsal', 'বংশাল', '', ''),
(500, 1, 'Bimanbandar', 'বিমানবন্দর', '', ''),
(501, 1, 'Cantonment', 'ক্যান্টনমেন্ট', '', ''),
(502, 1, 'Chak Bazar', 'চকবাজার', '', ''),
(503, 1, 'Dakshinkhan', 'দক্ষিনখান', '', ''),
(504, 1, 'Darus Salam', 'দারস সালাম', '', ''),
(506, 1, 'Demra ', 'ডেমরা', '', ''),
(507, 1, 'Dhanmondi', 'ধানমন্ডি', '', ''),
(508, 1, 'Gendaria', 'গেন্ডারিয়া', '', ''),
(509, 1, 'Gulshan', 'গুলশান', '', ''),
(510, 1, 'Hazaribagh', 'হাজারীবাগ', '', ''),
(511, 1, 'Jatrabari', 'যাত্রাবাড়ি', '', ''),
(512, 1, 'Kadamtali', 'কদমতলী', 'Kodomtoli,Kadomtoli,Kodamtoli', ''),
(513, 1, 'Kafrul', 'কাফরুল', 'Kafrool', ''),
(514, 1, 'Kalabagan', 'কলাবাগান', 'Kolabagan', ''),
(515, 1, 'Kamrangirchar', 'কামরাঙ্গীরচর', 'Kamrangirchor', ''),
(516, 1, 'Khilgaon', 'খিলগাও', '', ''),
(517, 1, 'khilkhet', 'খিলক্ষেত', '', ''),
(518, 1, 'Kotwali', 'কোতয়ালী', 'Kotoali,Kotowali', ''),
(519, 1, 'Lalbagh', 'লালবাগ', 'Lalbag', ''),
(520, 1, 'Mirpur', 'মিরপুর', '', ''),
(521, 1, 'Motijheel', 'মতিঝিল', 'Matijhil', ''),
(522, 1, 'Nawabganj', 'নবাবগন্জ', 'Nababganj,Nobabganj,Nababgonj', ''),
(523, 1, 'Newmarket', 'নিউমার্কেট', '', ''),
(524, 1, 'Pallabi', 'পল্লবী', 'Pollobi', ''),
(525, 1, 'Paltan', 'পল্টন', 'Polton', ''),
(526, 1, 'Ramna', 'রমনা', 'Romna', ''),
(527, 1, 'Rampura', 'রামপুরা', '', ''),
(528, 1, 'Sabujbagh', 'সবুজবাগ', '', ''),
(529, 1, 'Shah Ali', 'শাহআলী', '', ''),
(530, 1, 'Shahbag', 'শাহবাগ', '', ''),
(531, 1, 'Sher-e-Bangla Nagar', 'শের-ই-বাংলা', '', ''),
(532, 1, 'Shyampur', 'শ্যামপুর', '', ''),
(533, 1, 'Tejgaon', 'তেজগাও', '', ''),
(534, 1, 'Mohakhali', 'মহাখালি', '', ''),
(535, 1, 'Tejgaon Industrial Area', 'তেজগাও শিল্প এলাকা', '', ''),
(536, 1, 'Turag', 'তুরাগ', '', ''),
(537, 1, 'Uttara', 'উত্তরা', '', ''),
(538, 1, 'Uttar Khan', 'উত্তরখান', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `transport_points`
--

CREATE TABLE `transport_points` (
  `id` int(10) UNSIGNED NOT NULL,
  `transport_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `point` tinyint(4) NOT NULL,
  `note` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `notification_msg` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `happened_at` datetime NOT NULL,
  `read` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `reputation` int(11) NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `reg_date` datetime NOT NULL,
  `last_logged` datetime NOT NULL,
  `user_type` enum('admin','manager','supervisor','user') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `avatar` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `reputation`, `email`, `mobile`, `reg_date`, `last_logged`, `user_type`, `avatar`, `status`) VALUES
(2, 'rejoan', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'rejoan.er@gmail.com', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'admin', 'zce-php-engineer-logo-l.jpg', 1),
(4, 'anonymus', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'anonymus@gmail.com', '01961349181', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'user', '', 1),
(6, 'rezwan', '81dc9bdb52d04dc20036dbd8313ed055', 34, 'refatju@yahoo.com', '01961349181', '2016-12-31 12:51:48', '0000-00-00 00:00:00', 'user', '828947-1_ll.jpg', 1),
(7, 'mirza', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'mirza@yahoo.com', '01961349181', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'user', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_route_meta_routes` (`route_id`),
  ADD KEY `FK_route_meta_users` (`user_id`);

--
-- Indexes for table `counter_address`
--
ALTER TABLE `counter_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_counter_address_poribohons` (`poribohon_id`),
  ADD KEY `FK_counter_address_districts` (`district`),
  ADD KEY `FK_counter_address_thanas` (`thana`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edited_counters`
--
ALTER TABLE `edited_counters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_edited_counters_districts` (`district`),
  ADD KEY `FK_edited_counters_thanas` (`thana`),
  ADD KEY `FK_edited_counters_poribohons` (`poribohon_id`);

--
-- Indexes for table `edited_poribohons`
--
ALTER TABLE `edited_poribohons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_edited_poribohons_poribohons` (`poribohon_id`),
  ADD KEY `FK_edited_poribohons_users` (`added_by`);

--
-- Indexes for table `edited_routes`
--
ALTER TABLE `edited_routes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_edited_routes_routes` (`route_id`),
  ADD KEY `FK_edited_routes_users` (`added_by`),
  ADD KEY `FK_edited_routes_poribohons` (`poribohon_id`),
  ADD KEY `FK_edited_routes_districts` (`from_district`),
  ADD KEY `FK_edited_routes_thanas` (`from_thana`),
  ADD KEY `FK_edited_routes_districts_2` (`to_district`),
  ADD KEY `FK_edited_routes_thanas_2` (`to_thana`);

--
-- Indexes for table `edited_stoppages`
--
ALTER TABLE `edited_stoppages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__routes` (`route_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `point_paid`
--
ALTER TABLE `point_paid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_verifications_routes` (`user_id`);

--
-- Indexes for table `poribohons`
--
ALTER TABLE `poribohons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `bn_name` (`bn_name`),
  ADD KEY `FK_poribohons_users` (`added_by`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_profiles_users` (`user_id`),
  ADD KEY `FK_profiles_districts` (`district`),
  ADD KEY `FK_profiles_thanas` (`thana`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_routes_users` (`added_by`),
  ADD KEY `from_place` (`from_place`),
  ADD KEY `to_place` (`to_place`),
  ADD KEY `FK_routes_districts` (`from_district`),
  ADD KEY `FK_routes_thanas` (`from_thana`),
  ADD KEY `FK_routes_districts_2` (`to_district`),
  ADD KEY `FK_routes_thanas_2` (`to_thana`),
  ADD KEY `FK_routes_poribohons` (`poribohon_id`);

--
-- Indexes for table `route_bn`
--
ALTER TABLE `route_bn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_route_translation_routes` (`route_id`);

--
-- Indexes for table `route_complains`
--
ALTER TABLE `route_complains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__users` (`user_id`),
  ADD KEY `FK__routes` (`route_id`);

--
-- Indexes for table `route_points`
--
ALTER TABLE `route_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_route_points_users` (`user_id`),
  ADD KEY `FK_route_points_routes` (`route_id`);

--
-- Indexes for table `stoppages`
--
ALTER TABLE `stoppages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_stopages_routes` (`route_id`);

--
-- Indexes for table `stoppage_bn`
--
ALTER TABLE `stoppage_bn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__stoppages` (`route_id`);

--
-- Indexes for table `thanas`
--
ALTER TABLE `thanas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `transport_points`
--
ALTER TABLE `transport_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_transport_points_poribohons` (`transport_id`),
  ADD KEY `FK_transport_points_users` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `type` (`user_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `counter_address`
--
ALTER TABLE `counter_address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `edited_counters`
--
ALTER TABLE `edited_counters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `edited_poribohons`
--
ALTER TABLE `edited_poribohons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `edited_routes`
--
ALTER TABLE `edited_routes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `edited_stoppages`
--
ALTER TABLE `edited_stoppages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `point_paid`
--
ALTER TABLE `point_paid`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `poribohons`
--
ALTER TABLE `poribohons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `route_bn`
--
ALTER TABLE `route_bn`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `route_complains`
--
ALTER TABLE `route_complains`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `route_points`
--
ALTER TABLE `route_points`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `stoppages`
--
ALTER TABLE `stoppages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1027;
--
-- AUTO_INCREMENT for table `stoppage_bn`
--
ALTER TABLE `stoppage_bn`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=665;
--
-- AUTO_INCREMENT for table `thanas`
--
ALTER TABLE `thanas`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=539;
--
-- AUTO_INCREMENT for table `transport_points`
--
ALTER TABLE `transport_points`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_route_meta_routes` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_route_meta_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `counter_address`
--
ALTER TABLE `counter_address`
  ADD CONSTRAINT `FK_counter_address_districts` FOREIGN KEY (`district`) REFERENCES `districts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_counter_address_poribohons` FOREIGN KEY (`poribohon_id`) REFERENCES `poribohons` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_counter_address_thanas` FOREIGN KEY (`thana`) REFERENCES `thanas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `edited_counters`
--
ALTER TABLE `edited_counters`
  ADD CONSTRAINT `FK_edited_counters_districts` FOREIGN KEY (`district`) REFERENCES `districts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_edited_counters_poribohons` FOREIGN KEY (`poribohon_id`) REFERENCES `poribohons` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_edited_counters_thanas` FOREIGN KEY (`thana`) REFERENCES `thanas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `edited_poribohons`
--
ALTER TABLE `edited_poribohons`
  ADD CONSTRAINT `FK_edited_poribohons_poribohons` FOREIGN KEY (`poribohon_id`) REFERENCES `poribohons` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_edited_poribohons_users` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `edited_routes`
--
ALTER TABLE `edited_routes`
  ADD CONSTRAINT `FK_edited_routes_districts` FOREIGN KEY (`from_district`) REFERENCES `districts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_edited_routes_districts_2` FOREIGN KEY (`to_district`) REFERENCES `districts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_edited_routes_poribohons` FOREIGN KEY (`poribohon_id`) REFERENCES `poribohons` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_edited_routes_routes` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_edited_routes_thanas` FOREIGN KEY (`from_thana`) REFERENCES `thanas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_edited_routes_thanas_2` FOREIGN KEY (`to_thana`) REFERENCES `thanas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_edited_routes_users` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `edited_stoppages`
--
ALTER TABLE `edited_stoppages`
  ADD CONSTRAINT `FK_edited_stoppages_edited_routes` FOREIGN KEY (`route_id`) REFERENCES `edited_routes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `point_paid`
--
ALTER TABLE `point_paid`
  ADD CONSTRAINT `FK_verifications_routes` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `poribohons`
--
ALTER TABLE `poribohons`
  ADD CONSTRAINT `FK_poribohons_users` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `FK_profiles_districts` FOREIGN KEY (`district`) REFERENCES `districts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_profiles_thanas` FOREIGN KEY (`thana`) REFERENCES `thanas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_profiles_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `routes`
--
ALTER TABLE `routes`
  ADD CONSTRAINT `FK_routes_districts` FOREIGN KEY (`from_district`) REFERENCES `districts` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_routes_districts_2` FOREIGN KEY (`to_district`) REFERENCES `districts` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_routes_poribohons` FOREIGN KEY (`poribohon_id`) REFERENCES `poribohons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_routes_thanas` FOREIGN KEY (`from_thana`) REFERENCES `thanas` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_routes_thanas_2` FOREIGN KEY (`to_thana`) REFERENCES `thanas` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_routes_users` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `route_bn`
--
ALTER TABLE `route_bn`
  ADD CONSTRAINT `FK_route_translation_routes` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `route_complains`
--
ALTER TABLE `route_complains`
  ADD CONSTRAINT `FK__routes` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK__users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `route_points`
--
ALTER TABLE `route_points`
  ADD CONSTRAINT `FK_route_points_routes` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_route_points_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `stoppages`
--
ALTER TABLE `stoppages`
  ADD CONSTRAINT `FK_stoppages_routes` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `stoppage_bn`
--
ALTER TABLE `stoppage_bn`
  ADD CONSTRAINT `FK__stoppages` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `thanas`
--
ALTER TABLE `thanas`
  ADD CONSTRAINT `thanas_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transport_points`
--
ALTER TABLE `transport_points`
  ADD CONSTRAINT `FK_transport_points_poribohons` FOREIGN KEY (`transport_id`) REFERENCES `poribohons` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_transport_points_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
