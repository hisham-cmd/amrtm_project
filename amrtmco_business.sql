-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- مضيف: localhost:3306
-- وقت الجيل: 19 يوليو 2026 الساعة 14:43
-- إصدار الخادم: 8.0.46
-- نسخة PHP: 8.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- قاعدة بيانات: `amrtmco_business`
--

--
-- إرجاع أو استيراد بيانات الجدول `bs_categories`
--

INSERT INTO `bs_categories` (`id`, `key`, `name_ar`, `name_en`, `icon`, `color`, `bg`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'ministries', 'الوزارات', 'Ministries', 'ti-building-bank', '#1A237E', 'rgba(26,35,126,.1)', 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(2, 'authorities', 'الهيئات', 'Authorities', 'ti-award', '#6A1B9A', 'rgba(106,27,154,.1)', 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(3, 'companies', 'الشركات الحكومية', 'Government Companies', 'ti-building-factory', '#1B5E20', 'rgba(27,94,32,.1)', 1, 3, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(4, 'embassies', 'السفارات والقنصليات', 'Embassies & Consulates', 'ti-world', '#00838F', 'rgba(0,131,143,.1)', 1, 4, '2026-05-19 05:20:47', '2026-05-19 05:20:47');

--
-- إرجاع أو استيراد بيانات الجدول `bs_entities`
--

INSERT INTO `bs_entities` (`id`, `category_id`, `name_ar`, `name_en`, `icon`, `color`, `bg`, `tag_ar`, `tag_en`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'وزارة الداخلية', 'Ministry of Interior', 'ti-shield', '#C62828', 'rgba(198,40,40,.11)', 'الأمن والمواطنة', 'Security & Citizenship', 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(2, 1, 'وزارة الاتصالات وتقنية المعلومات', 'Ministry of Communications & IT', 'ti-wifi', '#1565C0', 'rgba(21,101,192,.11)', 'التقنية والرقمنة', 'Technology & Digital', 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(3, 1, 'وزارة التجارة', 'Ministry of Commerce', 'ti-shopping-cart', '#AD1457', 'rgba(173,20,87,.11)', 'التجارة والأعمال', 'Trade & Business', 1, 3, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(4, 1, 'وزارة العدل', 'Ministry of Justice', 'ti-scale', '#4A148C', 'rgba(74,20,140,.11)', 'القضاء والتوثيق', 'Justice & Notarization', 1, 4, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(5, 1, 'وزارة الصحة', 'Ministry of Health', 'ti-heart-rate-monitor', '#C62828', 'rgba(198,40,40,.09)', 'الرعاية الصحية', 'Healthcare', 1, 5, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(6, 1, 'وزارة الموارد البشرية', 'Ministry of Human Resources', 'ti-users', '#0277BD', 'rgba(2,119,189,.11)', 'العمل والتوظيف', 'Labor & Employment', 1, 6, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(7, 1, 'وزارة المالية', 'Ministry of Finance', 'ti-coin', '#1A237E', 'rgba(26,35,126,.11)', 'المالية والميزانية', 'Finance & Budget', 1, 7, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(8, 1, 'وزارة التعليم', 'Ministry of Education', 'ti-school', '#00695C', 'rgba(0,105,92,.11)', 'التعليم والتدريب', 'Education & Training', 1, 8, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(9, 1, 'وزارة السياحة', 'Ministry of Tourism', 'ti-plane', '#00838F', 'rgba(0,131,143,.11)', 'السياحة والضيافة', 'Tourism & Hospitality', 1, 9, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(10, 1, 'وزارة الاستثمار', 'Ministry of Investment', 'ti-trending-up', '#2E7D32', 'rgba(46,125,50,.11)', 'الاستثمار والأعمال', 'Investment & Business', 1, 10, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(11, 2, 'هيئة الزكاة والضرائب والجمارك', 'ZATCA', 'ti-receipt-tax', '#6A1B9A', 'rgba(106,27,154,.1)', 'الضرائب والجمارك', 'Tax & Customs', 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(12, 2, 'الهيئة العامة للطيران المدني', 'GACA', 'ti-plane', '#0277BD', 'rgba(2,119,189,.1)', 'الطيران المدني', 'Civil Aviation', 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(13, 2, 'هيئة السوق المالية', 'CMA', 'ti-chart-candlestick', '#1B5E20', 'rgba(27,94,32,.1)', 'السوق المالية', 'Financial Market', 1, 3, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(14, 2, 'الهيئة العامة للغذاء والدواء', 'SFDA', 'ti-pill', '#C62828', 'rgba(198,40,40,.1)', 'الغذاء والدواء', 'Food & Drug', 1, 4, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(15, 2, 'الهيئة العامة للعقار', 'General Real Estate Authority', 'ti-home-star', '#AD1457', 'rgba(173,20,87,.1)', 'قطاع العقار', 'Real Estate', 1, 5, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(16, 2, 'الهيئة العامة للترفيه', 'GEA', 'ti-confetti', '#E65100', 'rgba(230,81,0,.1)', 'قطاع الترفيه', 'Entertainment', 1, 6, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(17, 2, 'الهيئة الوطنية للأمن السيبراني', 'NCA', 'ti-shield-lock', '#263238', 'rgba(38,50,56,.1)', 'الأمن السيبراني', 'Cybersecurity', 1, 7, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(18, 3, 'المؤسسة العامة للتأمينات الاجتماعية', 'GOSI', 'ti-shield-check', '#1B5E20', 'rgba(27,94,32,.1)', 'التأمينات الاجتماعية', 'Social Insurance', 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(19, 3, 'البريد السعودي', 'Saudi Post (SPL)', 'ti-mail', '#C62828', 'rgba(198,40,40,.1)', 'الخدمات البريدية', 'Postal Services', 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(20, 3, 'الخطوط الجوية العربية السعودية', 'Saudi Arabian Airlines (Saudia)', 'ti-plane', '#1A237E', 'rgba(26,35,126,.1)', 'الطيران', 'Aviation', 1, 3, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(21, 3, 'صندوق التنمية الصناعية السعودي', 'SIDF', 'ti-building-factory', '#1B5E20', 'rgba(27,94,32,.1)', 'التنمية الصناعية', 'Industrial Development', 1, 4, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(22, 3, 'البنك الأهلي السعودي', 'SNB', 'ti-building-bank', '#1A237E', 'rgba(26,35,126,.1)', 'الخدمات المصرفية', 'Banking Services', 1, 5, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(27, 4, 'سفارة الولايات المتحدة في الرياض', 'US Embassy - Riyadh', 'ti-world', '#1A237E', 'rgba(26,35,126,.1)', 'سفارة أجنبية', 'Foreign Embassy', 1, 5, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(28, 4, 'سفارة المملكة المتحدة في الرياض', 'UK Embassy - Riyadh', 'ti-world', '#C62828', 'rgba(198,40,40,.1)', 'سفارة أجنبية', 'Foreign Embassy', 1, 6, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(29, 2, 'وزارة الاقتصاد والتخطيط', 'Ministry of Economy and Planning', 'ti-build', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 11, '2026-06-10 09:59:44', '2026-06-10 09:59:44'),
(38, 1, 'وزارة الخارجية', 'Ministry of Foreign Affairs', 'ti-file-export', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 12, '2026-06-10 11:21:31', '2026-06-10 11:21:31'),
(39, 1, 'وزارة الاقتصاد والتخطيط', 'Ministry of Economy and Planning', 'ti-trending-up', '#1B5E20', 'rgba(27,94,32,.1)', NULL, NULL, 1, 13, '2026-06-10 11:22:53', '2026-06-10 11:22:53'),
(40, 1, 'وزارة الشؤون البلدية والقروية والإسكان', 'Ministry of Municipal and Rural Affairs and Housing', 'ti-home-2', '#1565C0', 'rgba(21,101,192,.1)', NULL, NULL, 1, 14, '2026-06-10 11:24:52', '2026-06-10 11:24:52'),
(41, 1, 'وزارة البيئة والمياه والزراعة', 'Ministry of Environment, Water and Agriculture', 'ti-plant', '#1B5E20', 'rgba(27,94,32,.1)', NULL, NULL, 1, 15, '2026-06-10 11:26:42', '2026-06-10 11:26:42'),
(42, 1, 'وزارة الشؤون الإسلامية والدعوة الإرشاد', 'Ministry of Islamic Affairs, Call and Guidance', 'ti-navigation', '#1565C0', 'rgba(21,101,192,.1)', NULL, NULL, 1, 16, '2026-06-10 11:28:17', '2026-06-10 11:28:17'),
(43, 1, 'وزارة النقل والخدمات اللوجستية', 'Ministry of Transport and Logistics', 'ti-truck', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 17, '2026-06-10 11:30:52', '2026-06-10 11:30:52'),
(44, 1, 'وزارة الصناعة والثروة المعدنية', 'Ministry of Industry and Mineral Resources', 'ti-building-skyscraper', '#E65100', 'rgba(230,81,0,.1)', NULL, NULL, 1, 18, '2026-06-10 11:33:34', '2026-06-10 11:33:34'),
(45, 1, 'وزارة الإعلام', 'Ministry of Information', 'ti-users', '#F57F17', 'rgba(245,127,23,.1)', NULL, NULL, 1, 19, '2026-06-10 11:35:05', '2026-06-10 11:35:05'),
(46, 1, 'وزارة الثقافة', 'Ministry of Culture', 'ti-friends', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 20, '2026-06-10 11:36:32', '2026-06-10 11:36:32'),
(48, 1, 'وزارة الدفاع', 'Ministry of Defense', 'ti-user-star', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 21, '2026-06-10 11:42:01', '2026-06-10 11:42:01'),
(49, 1, 'وزارة الطاقة', 'Ministry of Energy', 'ti-atom', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 22, '2026-06-10 11:42:56', '2026-06-10 11:42:56'),
(50, 1, 'وزارة الرياضة', 'Ministry of Sports', 'ti-bike', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 23, '2026-06-10 11:44:46', '2026-06-10 11:44:46'),
(51, 1, 'وزارة الحج والعمرة', 'Ministry of Hajj and Umrah', 'ti-cloud-rain', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 24, '2026-06-10 11:46:08', '2026-06-10 11:46:08'),
(52, 1, 'وزارة الحرس الوطني', 'Ministry of National Guard', 'ti-user-bolt', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 25, '2026-06-10 11:48:43', '2026-06-10 11:48:43'),
(53, 2, '👑 الهيئات الملكية (تطوير المدن والمناطق الكبرى)', '👑 Royal Act (Greater Union Cities Development)', 'ti-sparkles', '#F57F17', 'rgba(245,127,23,.1)', NULL, NULL, 1, 26, '2026-06-10 12:20:51', '2026-06-10 12:20:51'),
(54, 2, '💻 الهيئات الرقمية، التقنية والبيانات', '💻 Digital, Technical and Data Bodies', 'ti-device-laptop', '#0277BD', 'rgba(2,119,189,.1)', NULL, NULL, 1, 27, '2026-06-10 12:24:09', '2026-06-10 12:24:09'),
(55, 2, '📈 الهيئات الاقتصادية والتنظيمية', '📈 Economic and regulatory bodies', 'ti-trending-up', '#C62828', 'rgba(198,40,40,.1)', NULL, NULL, 1, 28, '2026-06-10 12:29:26', '2026-06-10 12:29:26'),
(56, 2, '🩺 الهيئات الصحية والرقابية والخدمية', '🩺 Health, regulatory and service bodies', 'ti-building-hospital', '#0277BD', 'rgba(2,119,189,.1)', NULL, NULL, 1, 29, '2026-06-10 12:31:52', '2026-06-10 12:31:52'),
(57, 2, '🎭 الهيئات الثقافية والترفيهية والسياحية', '🎭 Cultural, entertainment and tourism organizations', 'ti-face-id', '#E65100', 'rgba(230,81,0,.1)', NULL, NULL, 1, 30, '2026-06-10 12:32:33', '2026-06-10 12:32:33'),
(58, 2, 'لهيئة الملكية للجبيل وينبع', 'Royal Commission for Jubail and Yanbu', 'ti-file-certificate', '#1B5E20', 'rgba(27,94,32,.1)', NULL, NULL, 1, 31, '2026-06-10 12:43:28', '2026-06-10 12:43:28'),
(59, 2, 'الهيئة الملكية لمدينة الرياض', 'Royal Commission for Riyadh City', 'ti-certificate', '#1B5E20', 'rgba(27,94,32,.1)', NULL, NULL, 1, 32, '2026-06-10 12:44:50', '2026-06-10 12:44:50'),
(60, 2, 'الهيئة الملكية لمدينة مكة المكرمة والمشاعر المقدسة', 'Royal Commission for Makkah City and the Holy Sites', 'ti-certificate', '#1B5E20', 'rgba(27,94,32,.1)', NULL, NULL, 1, 33, '2026-06-10 12:46:10', '2026-06-10 12:46:10'),
(61, 2, 'الهيئة الملكية لمحافظة العلا', 'Royal Commission for Al-Ula Governorate', 'ti-certificate', '#1B5E20', 'rgba(27,94,32,.1)', NULL, NULL, 1, 34, '2026-06-10 12:47:34', '2026-06-10 12:47:34'),
(62, 2, 'الهيئة السعودية للبيانات والذكاء الاصطناعي (سدايا)', 'The Saudi Data and Artificial Intelligence Authority (SDAIA)', 'ti-badge', '#0277BD', 'rgba(2,119,189,.1)', NULL, NULL, 1, 35, '2026-06-10 12:50:58', '2026-06-10 12:50:58'),
(63, 2, 'هيئة الاتصالات والفضاء والتقنية', 'Communications, Space and Technology Authority', 'ti-sparkles', '#00695C', 'rgba(0,105,92,.1)', NULL, NULL, 1, 36, '2026-06-10 12:53:30', '2026-06-10 12:53:30'),
(64, 2, 'هيئة الحكومة الرقمية', 'Digital Government Authority', 'ti-signal-4g', '#1565C0', 'rgba(21,101,192,.1)', NULL, NULL, 1, 37, '2026-06-10 12:55:49', '2026-06-10 12:55:49'),
(65, 2, 'الهيئة العامة للإحصاء', 'Digital Government Authority', 'ti-abacus', '#1565C0', 'rgba(21,101,192,.1)', NULL, NULL, 1, 38, '2026-06-10 12:58:52', '2026-06-10 12:58:52'),
(66, 2, 'الهيئة السعودية للمدن الصناعية ومناطق التقنية (مدن)', 'Saudi Authority for Industrial Cities and Technology Zones (MODON)', 'ti-building-factory', '#37474F', 'rgba(55,71,79,.1)', NULL, NULL, 1, 39, '2026-06-10 13:00:52', '2026-06-10 13:00:52'),
(67, 2, 'الهيئة العامة للمعارض والمؤتمرات', 'General Authority for Exhibitions and Conferences', 'ti-building-bank', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 40, '2026-06-10 13:03:14', '2026-06-10 13:03:14'),
(68, 2, 'هيئة الرقابة ومكافحة الفساد (نزاهة)', 'The Oversight and Anti-Corruption Authority (Nazaha)', 'ti-microscope', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 41, '2026-06-10 13:08:15', '2026-06-10 13:08:15'),
(69, 2, 'الهيئة السعودية للمواصفات والمقاييس والجودة', 'Saudi Standards, Metrology and Quality Organization', 'ti-test-pipe', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 42, '2026-06-10 13:09:57', '2026-06-10 13:09:57'),
(70, 2, 'لهيئة السعودية للمياه', 'To the Saudi Water Authority', 'ti-droplet', '#0277BD', 'rgba(2,119,189,.1)', NULL, NULL, 1, 43, '2026-06-10 13:11:32', '2026-06-10 13:11:32'),
(71, 2, 'الهيئة السعودية للسياحة', 'Saudi Tourism Authority', 'ti-sun', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 44, '2026-06-10 13:13:32', '2026-06-10 13:13:32'),
(72, 2, 'هيئة التراث', 'Heritage Authority', 'ti-building-castle', '#1B5E20', 'rgba(27,94,32,.1)', NULL, NULL, 1, 45, '2026-06-10 13:14:51', '2026-06-10 13:14:51'),
(73, 2, 'هيئة الأدب والنشر والترجمة', 'Literature, Publishing and Translation Authority', 'ti-file-search', '#1565C0', 'rgba(21,101,192,.1)', NULL, NULL, 1, 46, '2026-06-10 13:17:46', '2026-06-10 13:17:46'),
(74, 2, 'هيئة الأفلام / هيئة الأزياء / هيئة المتاحف', 'Film Commission / Fashion Commission / Museums Commission', 'ti-building-warehouse', '#37474F', 'rgba(55,71,79,.1)', NULL, NULL, 1, 47, '2026-06-10 13:19:30', '2026-06-10 13:19:30'),
(75, 3, 'شركات صندوق الاستثمارات العامة (PIF)', 'Public Investment Fund (PIF) companies', 'ti-package', '#F57F17', 'rgba(245,127,23,.1)', NULL, NULL, 1, 48, '2026-06-10 13:28:06', '2026-06-10 13:28:06'),
(76, 2, 'هيئة كفاءة الإنفاق والمشروعات الحكومية', 'Large-scale government agency and projects', 'ti-currency-riyal', '#1B5E20', 'rgba(27,94,32,.1)', NULL, NULL, 1, 49, '2026-06-11 05:27:25', '2026-06-11 05:27:25'),
(77, 2, 'هيئة المحتوى المحلي والمشتريات الحكومية', 'Local Content and Government Procurement Authority', 'ti-report-money', '#E65100', 'rgba(230,81,0,.1)', NULL, NULL, 1, 50, '2026-06-11 05:30:20', '2026-06-11 05:30:20'),
(78, 2, 'هيئة حقوق الإنسان', 'Human Rights Commission', 'ti-building-warehouse', '#00695C', 'rgba(0,105,92,.1)', NULL, NULL, 1, 51, '2026-06-11 05:32:05', '2026-06-11 05:32:05'),
(79, 2, 'هيئة الخبراء بمجلس الوزراء', 'Council of Ministers Experts Authority', 'ti-building-warehouse', '#1565C0', 'rgba(21,101,192,.1)', NULL, NULL, 1, 52, '2026-06-11 05:34:55', '2026-06-11 05:34:55'),
(80, 2, 'هيئة الهلال الأحمر السعودي', 'Saudi Red Crescent Authority', 'ti-ambulance', '#0277BD', 'rgba(2,119,189,.1)', NULL, NULL, 1, 53, '2026-06-11 05:36:23', '2026-06-11 05:36:23'),
(81, 2, 'هيئة الصحة العامة (وقاية)', 'Public Health Authority (Prevention)', 'ti-stethoscope', '#1565C0', 'rgba(21,101,192,.1)', NULL, NULL, 1, 54, '2026-06-11 05:38:12', '2026-06-11 05:38:12'),
(82, 2, 'هيئة التأمين', 'Insurance Authority', 'ti-receipt', '#F57F17', 'rgba(245,127,23,.1)', NULL, NULL, 1, 55, '2026-06-11 05:39:37', '2026-06-11 05:39:37'),
(83, 2, 'هيئة تقويم التعليم والتدريب', 'Education and Training Evaluation Commission', 'ti-license', '#1565C0', 'rgba(21,101,192,.1)', NULL, NULL, 1, 56, '2026-06-11 05:41:45', '2026-06-11 05:41:45'),
(84, 2, 'هيئة المكتبات', 'Libraries Authority', 'ti-building-warehouse', '#0277BD', 'rgba(2,119,189,.1)', NULL, NULL, 1, 57, '2026-06-11 05:42:47', '2026-06-11 05:42:47'),
(85, 2, 'هيئة المسرح والفنون الأدائية', 'Theatre and Performing Arts Authority', 'ti-face-id', '#E65100', 'rgba(230,81,0,.1)', NULL, NULL, 1, 58, '2026-06-11 05:46:29', '2026-06-11 05:46:29'),
(86, 2, 'هيئة فنون الطهي', 'Culinary Arts Authority', 'ti-coffee', '#37474F', 'rgba(55,71,79,.1)', NULL, NULL, 1, 59, '2026-06-11 05:49:02', '2026-06-11 05:49:02'),
(87, 2, 'هيئة الموسيقى', 'Music Authority', 'ti-writing', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 60, '2026-06-11 05:51:39', '2026-06-11 05:51:39'),
(88, 2, 'هيئة العمارة والتصميم', 'Architecture and Design Authority', 'ti-building-community', '#37474F', 'rgba(55,71,79,.1)', NULL, NULL, 1, 61, '2026-06-11 05:52:24', '2026-06-11 05:52:24'),
(89, 2, 'هيئة تطوير بوابة الدرعية', 'Diriyah Gate Development Authority', 'ti-building-castle', '#F57F17', 'rgba(245,127,23,.1)', NULL, NULL, 1, 62, '2026-06-11 05:56:03', '2026-06-11 05:56:03'),
(90, 2, 'هيئة تطوير منطقة مكة المكرمة', 'Makkah Region Development Authority', 'ti-building-community', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 63, '2026-06-11 05:57:34', '2026-06-11 05:57:34'),
(91, 2, 'هيئة تطوير منطقة المدينة المنورة', 'Madinah Region Development Authority', 'ti-building-community', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 64, '2026-06-11 05:58:20', '2026-06-11 05:58:20'),
(92, 2, 'هيئة تطوير محمية الإمام عبدالعزيز بن محمد الملكية', 'Imam Abdulaziz bin Mohammed Royal Reserve Development Authority', 'ti-building-castle', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 65, '2026-06-11 06:01:32', '2026-06-11 06:01:32'),
(93, 2, 'هيئة تطوير محمية الملك سلمان بن عبدالعزيز الملكية', 'King Salman bin Abdulaziz Royal Reserve Development Authority', 'ti-building-castle', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 66, '2026-06-11 06:03:05', '2026-06-11 06:03:05'),
(94, 2, 'هيئة تطوير محمية الإمام تركي بن عبدالله الملكية', 'Imam Turki bin Abdullah Royal Reserve Development Authority', 'ti-building-castle', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 67, '2026-06-11 06:03:55', '2026-06-11 06:03:55'),
(95, 2, 'هيئة تطوير محمية الأمير محمد بن سلمان الملكية', 'Prince Mohammed bin Salman Royal Reserve Development Authority', 'ti-building-castle', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 68, '2026-06-11 06:04:36', '2026-06-11 06:04:36'),
(96, 2, 'الهيئة السعودية للملكية الفكرية', 'Saudi Authority for Intellectual Property', 'ti-bulb', '#F57F17', 'rgba(245,127,23,.1)', NULL, NULL, 1, 69, '2026-06-11 06:07:09', '2026-06-11 06:07:09'),
(97, 2, 'الهيئة السعودية للفضاء', 'Saudi Space Authority', 'ti-sparkles', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 70, '2026-06-11 06:09:20', '2026-06-11 06:09:20'),
(98, 2, 'الهيئة السعودية للبحر الأحمر', 'Saudi Red Sea Authority', 'ti-cloud-rain', '#0277BD', 'rgba(2,119,189,.1)', NULL, NULL, 1, 71, '2026-06-11 06:11:39', '2026-06-11 06:11:39'),
(99, 2, 'الهيئة السعودية للسياحة', 'Saudi Tourism Authority', 'ti-sun', '#F57F17', 'rgba(245,127,23,.1)', NULL, NULL, 1, 72, '2026-06-11 06:12:28', '2026-06-11 06:12:28'),
(100, 2, 'الهيئة العامة لعقارات الدولة', 'General Authority for State Properties', 'ti-building-community', '#37474F', 'rgba(55,71,79,.1)', NULL, NULL, 1, 73, '2026-06-11 06:15:37', '2026-06-11 06:15:37'),
(101, 2, 'الهيئة العامة للنقل', 'General Authority for Transport', 'ti-truck', '#E65100', 'rgba(230,81,0,.1)', NULL, NULL, 1, 74, '2026-06-11 06:24:35', '2026-06-11 06:24:35'),
(102, 2, 'الهيئة السعودية للمهندسين', 'Saudi Council of Engineers', 'ti-building-warehouse', '#E65100', 'rgba(230,81,0,.1)', NULL, NULL, 1, 75, '2026-06-11 06:27:34', '2026-06-11 06:27:34'),
(103, 2, 'الهيئة السعودية للمراجعين والمحاسبين', 'Saudi Organization for Auditors and Accountants', 'ti-id-badge-2', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 76, '2026-06-11 06:28:38', '2026-06-11 06:28:38'),
(104, 2, 'الهيئة السعودية للمقاولين', 'Saudi Contractors Authority', 'ti-building-community', '#E65100', 'rgba(230,81,0,.1)', NULL, NULL, 1, 77, '2026-06-11 06:29:56', '2026-06-11 06:29:56'),
(105, 2, 'الهيئة السعودية للمقيمين المعتمدين', 'Saudi Authority for Accredited Valuers', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 78, '2026-06-11 06:31:42', '2026-06-11 06:31:42'),
(106, 3, 'أرامكو السعودية', 'Saudi Aramco', 'ti-dna', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 79, '2026-06-11 06:38:23', '2026-06-11 06:38:23'),
(107, 3, 'الشركة السعودية للكهرباء', 'Saudi Electricity Company', 'ti-bulb', '#F57F17', 'rgba(245,127,23,.1)', NULL, NULL, 1, 80, '2026-06-11 06:39:36', '2026-06-11 06:39:36'),
(134, 3, 'شركة جدة للتطوير المركزي', 'Jeddah Central Development Company', 'ti-building-skyscraper', '#C62828', 'rgba(198,40,40,.1)', NULL, NULL, 1, 107, '2026-06-11 08:25:08', '2026-06-11 08:25:08'),
(109, 3, 'شركة السكك الحديدية السعودية', 'Saudi Railway Company', 'ti-train', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 82, '2026-06-11 06:43:13', '2026-06-11 06:43:13'),
(110, 3, 'شركة المياه الوطنية', 'National Water Company', 'ti-cloud-rain', '#1565C0', 'rgba(21,101,192,.1)', NULL, NULL, 1, 83, '2026-06-11 06:45:00', '2026-06-11 06:45:00'),
(111, 3, 'شركات الهيئة السعودية للموانئ', 'Saudi Ports Authority Companies', 'ti-ship', '#1565C0', 'rgba(21,101,192,.1)', NULL, NULL, 1, 84, '2026-06-11 06:46:10', '2026-06-11 06:46:10'),
(112, 3, 'نيوم', 'NEOM', 'ti-building-skyscraper', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 85, '2026-06-11 06:47:29', '2026-06-11 06:47:29'),
(113, 3, 'القدية', 'Qiddiya', 'ti-building', '#E65100', 'rgba(230,81,0,.1)', NULL, NULL, 1, 86, '2026-06-11 06:48:50', '2026-06-11 06:48:50'),
(114, 3, 'البحر الأحمر العالمية', 'Red Sea Global', 'ti-droplet', '#C62828', 'rgba(198,40,40,.1)', NULL, NULL, 1, 87, '2026-06-11 06:59:32', '2026-06-11 06:59:32'),
(115, 3, 'روشن', 'ROSHN', 'ti-sparkles', '#C62828', 'rgba(198,40,40,.1)', NULL, NULL, 1, 88, '2026-06-11 07:01:08', '2026-06-11 07:01:08'),
(116, 3, 'شركة الدرعية', 'Diriyah Company', 'ti-building-castle', '#1565C0', 'rgba(21,101,192,.1)', NULL, NULL, 1, 89, '2026-06-11 07:02:53', '2026-06-11 07:02:53'),
(117, 3, 'المرابحة الجديدة', 'New Murabba', 'ti-receipt-2', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 90, '2026-06-11 07:08:01', '2026-06-11 07:08:01'),
(118, 3, 'تنمية السودة', 'Soudah Development', 'ti-user-search', '#1565C0', 'rgba(21,101,192,.1)', NULL, NULL, 1, 91, '2026-06-11 07:10:25', '2026-06-11 07:10:25'),
(119, 3, 'آلات', 'Alat', 'ti-tool', '#E65100', 'rgba(230,81,0,.1)', NULL, NULL, 1, 92, '2026-06-11 07:12:51', '2026-06-11 07:12:51'),
(120, 3, 'الشركة السعودية للذكاء الاصطناعي', 'Saudi Company for Artificial Intelligence', 'ti-robot', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 93, '2026-06-11 07:16:43', '2026-06-11 07:16:43'),
(121, 3, 'افيليس', 'AviLease', 'ti-file', '#6A1B9A', 'rgba(106,27,154,.1)', NULL, NULL, 1, 94, '2026-06-11 07:18:57', '2026-06-11 07:18:57'),
(122, 3, 'مشاريع الترفيه السعودية', 'Saudi Entertainment Ventures', 'ti-face-id', '#E65100', 'rgba(230,81,0,.1)', NULL, NULL, 1, 95, '2026-06-11 07:20:40', '2026-06-11 07:20:40'),
(123, 3, 'شركة وسط البلد السعودية', 'Saudi Downtown Company', 'ti-building-community', '#E65100', 'rgba(230,81,0,.1)', NULL, NULL, 1, 96, '2026-06-11 07:32:08', '2026-06-11 07:32:08'),
(124, 3, 'شركات مؤسسة حديقة الملك سلمان', 'King Salman Park Foundation Companies', 'ti-id-badge', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 97, '2026-06-11 07:33:32', '2026-06-11 07:33:32'),
(125, 3, 'ACWA Power (الصندوق مساهم رئيسي فيها)', 'ACWA Power (the fund is a major shareholder in it)', 'ti-menu-2', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 98, '2026-06-11 07:36:16', '2026-06-11 07:36:16'),
(126, 3, 'سابك', 'SABIC', 'ti-layout', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 99, '2026-06-11 07:37:11', '2026-06-11 07:37:11'),
(127, 3, 'معادن', 'Maaden', 'ti-layout-dashboard', '#37474F', 'rgba(55,71,79,.1)', NULL, NULL, 1, 100, '2026-06-11 08:12:27', '2026-06-11 08:12:27'),
(128, 3, 'سالك', 'SALIC', 'ti-adjustments', '#37474F', 'rgba(55,71,79,.1)', NULL, NULL, 1, 101, '2026-06-11 08:13:21', '2026-06-11 08:13:21'),
(129, 3, 'دوسور', 'Dussur', 'ti-license', '#37474F', 'rgba(55,71,79,.1)', NULL, NULL, 1, 102, '2026-06-11 08:14:39', '2026-06-11 08:14:39'),
(135, 3, 'شركات تابعة لـ صندوق الاستثمارات العامة', 'Companies affiliated with the Public Investment Fund', 'ti-receipt-2', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 108, '2026-06-11 08:27:55', '2026-06-11 08:27:55'),
(131, 3, 'السعودية للخدمات الأرضية', 'Saudi Ground Services', 'ti-compass', '#E65100', 'rgba(230,81,0,.1)', NULL, NULL, 1, 104, '2026-06-11 08:18:16', '2026-06-11 08:18:16'),
(132, 3, 'خدمات الملاحة الجوية السعودية', 'Saudi Air Navigation Services', 'ti-plane', '#0277BD', 'rgba(2,119,189,.1)', NULL, NULL, 1, 105, '2026-06-11 08:18:53', '2026-06-11 08:18:53'),
(133, 3, 'الخدمات اللوجستية السعودية', 'Saudi Logistics Services', 'ti-bus', '#E65100', 'rgba(230,81,0,.1)', NULL, NULL, 1, 106, '2026-06-11 08:19:34', '2026-06-11 08:19:34'),
(136, 3, 'الشركات التابعة لصندوق التنمية الصناعية السعودي', 'Companies affiliated with the Saudi Industrial Development Fund', 'ti-building-factory', '#37474F', 'rgba(55,71,79,.1)', NULL, NULL, 1, 109, '2026-06-11 08:29:03', '2026-06-11 08:29:03'),
(137, 3, 'شركات تابعة لـ صندوق التنمية الوطنية', 'Companies affiliated with the National Development Fund', 'ti-shield-check', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 110, '2026-06-11 08:29:57', '2026-06-11 08:29:57'),
(138, 3, 'الشركات التابعة للهيئة العامة للعقارات', 'Companies affiliated with the Real Estate General Authority', 'ti-hammer', '#E65100', 'rgba(230,81,0,.1)', NULL, NULL, 1, 111, '2026-06-11 08:31:06', '2026-06-11 08:31:06'),
(139, 3, 'شركات تابعة لـ الهيئة الملكية لمدينة الرياض', 'Companies affiliated with the Royal Commission for Riyadh City', 'ti-building-castle', '#2E7D32', 'rgba(46,125,50,.1)', NULL, NULL, 1, 112, '2026-06-11 08:32:14', '2026-06-11 08:32:14'),
(140, 4, 'السفارة الأمريكية في الرياض', 'US Embassy in Riyadh', 'ti-user', '#0277BD', 'rgba(2,119,189,.1)', NULL, NULL, 1, 113, '2026-06-11 10:16:53', '2026-06-11 10:16:53'),
(156, 4, 'السفارة المصرية بالسعودية', 'Egyptian Embassy in Saudi Arabia', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 121, '2026-06-11 10:51:08', '2026-06-11 10:51:08'),
(149, 4, 'السفارة الماليزية بالسعودية', 'Malaysian Embassy in Saudi Arabia', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 114, '2026-06-11 10:40:34', '2026-06-11 10:40:34'),
(150, 4, 'السفارة البريطانية بالسعودية', 'British Embassy in Saudi Arabia', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 115, '2026-06-11 10:41:19', '2026-06-11 10:41:19'),
(151, 4, 'السفارة الهولندية بالرياض', 'Dutch Embassy in Riyadh', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 116, '2026-06-11 10:43:36', '2026-06-11 10:43:36'),
(152, 4, 'السفارة الأسترالية بالرياض', 'Australian Embassy in Riyadh', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 117, '2026-06-11 10:45:14', '2026-06-11 10:45:14'),
(153, 4, 'السفارة الأيرلندية بالرياض', 'Irish Embassy in Riyadh', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 118, '2026-06-11 10:47:56', '2026-06-11 10:47:56'),
(154, 4, 'السفارة السنغافورية بالرياض', 'Singapore Embassy in Riyadh', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 119, '2026-06-11 10:49:22', '2026-06-11 10:49:22'),
(155, 4, 'السفارة السويدية بالرياض', 'Swedish Embassy in Riyadh', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 120, '2026-06-11 10:50:07', '2026-06-11 10:50:07'),
(157, 4, 'السفارة الألمانية بالسعودية', 'German Embassy in Saudi Arabia', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 122, '2026-06-11 10:51:52', '2026-06-11 10:51:52'),
(158, 4, 'سفارة البحرين بالسعودية', 'Bahrain Embassy in Saudi Arabia', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 123, '2026-06-11 10:52:53', '2026-06-11 10:52:53'),
(159, 4, 'سفارة فرنسا بالرياض', 'French Embassy in Riyadh', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 124, '2026-06-11 10:53:57', '2026-06-11 10:53:57'),
(160, 4, 'سفارة اسبانيا بالرياض', 'Embassy of Spain in Riyadh', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 125, '2026-06-11 10:55:22', '2026-06-11 10:55:22'),
(161, 4, 'القنصلية العامة الأمريكية بجدة', 'U.S. Consulate General in Jeddah', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 126, '2026-06-11 11:06:15', '2026-06-11 11:06:15'),
(167, 4, 'لقنصلية العامة المصرية بجدة', 'Egyptian Consulate General in Jeddah', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 132, '2026-06-11 11:14:58', '2026-06-11 11:14:58'),
(163, 4, 'القنصلية العامة الباكستانية بجدة', 'Pakistani Consulate General in Jeddah', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 128, '2026-06-11 11:07:30', '2026-06-11 11:07:30'),
(166, 4, 'القنصلية العامة البريطانية بجدة', 'British Consulate General in Jeddah', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 131, '2026-06-11 11:12:08', '2026-06-11 11:12:08'),
(165, 4, 'القنصلية العامة الإندونيسية بجدة', 'Indonesian Consulate General in Jeddah', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 130, '2026-06-11 11:10:18', '2026-06-11 11:10:18'),
(171, 4, 'القنصلية العامة الماليزية بجدة', 'Malaysian Consulate General in Jeddah', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 134, '2026-06-11 11:29:51', '2026-06-11 11:29:51'),
(170, 4, 'القنصلية العامة السورية بجدة', 'Syrian Consulate General in Jeddah', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 133, '2026-06-11 11:26:53', '2026-06-11 11:26:53'),
(172, 4, 'القنصلية العامة اليمنية بجدة', 'Yemeni Consulate General in Jeddah', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 135, '2026-06-11 11:30:28', '2026-06-11 11:30:28'),
(173, 4, 'القنصلية العامة الفرنسية بجدة', 'French Consulate General in Jeddah', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 136, '2026-06-11 11:31:54', '2026-06-11 11:31:54'),
(174, 4, 'القنصلية العامة الإماراتية بجدة', 'UAE Consulate General in Jeddah', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 137, '2026-06-11 11:33:17', '2026-06-11 11:33:17'),
(175, 4, 'القنصلية العامة الأمريكية بالظهران', 'U.S. Consulate General in Dhahran', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 138, '2026-06-11 11:35:19', '2026-06-11 11:35:19'),
(176, 4, 'القنصلية العامة للجمهورية اللبنانية بجدة', 'Consulate General of the Lebanese Republic in Jeddah', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 139, '2026-06-11 11:38:38', '2026-06-11 11:38:38'),
(177, 4, 'القنصلية العامة لجمهورية الهند بجدة', 'Consulate General of the Republic of India in Jeddah', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 140, '2026-06-11 11:39:25', '2026-06-11 11:39:25'),
(178, 4, 'القنصلية العامة للجمهورية التركية بجدة', 'Consulate General of the Republic of Turkey in Jeddah', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 141, '2026-06-11 11:40:34', '2026-06-11 11:40:34'),
(179, 4, 'القنصلية العامة لدولة الكويت بجدة', 'Consulate General of the State of Kuwait in Jeddah', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 142, '2026-06-11 11:41:37', '2026-06-11 11:41:37'),
(180, 4, 'القنصلية العامة لمملكة البحرين بجدة', 'Consulate General of the Kingdom of Bahrain in Jeddah', 'ti-user', '#1A237E', 'rgba(26,35,126,.1)', NULL, NULL, 1, 143, '2026-06-11 11:45:54', '2026-06-11 11:45:54');

--
-- إرجاع أو استيراد بيانات الجدول `bs_offices`
--

INSERT INTO `bs_offices` (`id`, `type`, `name_ar`, `name_en`, `description_ar`, `description_en`, `phone`, `email`, `city`, `cr_number`, `logo`, `specialties`, `is_active`, `is_verified`, `commission_rate`, `created_at`, `updated_at`) VALUES
(1, 'services', 'شركة مصنع حديد نجد', 'najd steel vactory', NULL, NULL, '+966568999564', 'sara_alfuraih@najdsteel.com', 'الرياض', '7014378959', NULL, NULL, 1, 0, 0.00, '2026-05-24 04:41:12', '2026-05-24 04:41:12');

--
-- إرجاع أو استيراد بيانات الجدول `bs_office_users`
--

INSERT INTO `bs_office_users` (`id`, `office_id`, `name`, `email`, `password`, `role`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'ساره  رياض الفريح', 'sara_alfuraih@najdsteel.com', '$2y$12$IzeSmKdVqbe08LqVb0YDwOP4F6xPKqdam/HUuLJ4Vn61/Bz4BwA3K', 'owner', 1, NULL, '2026-05-24 04:41:12', '2026-05-24 04:41:12');

--
-- إرجاع أو استيراد بيانات الجدول `bs_payments`
--

INSERT INTO `bs_payments` (`id`, `user_id`, `request_id`, `amount`, `type`, `description_ar`, `description_en`, `status`, `transaction_ref`, `created_at`, `updated_at`) VALUES
(1, 16, NULL, 300.00, 'charge', 'شحن رصيد من الإدارة', 'Admin balance charge', 'completed', NULL, '2026-06-20 11:07:06', '2026-06-20 11:07:06');

--
-- إرجاع أو استيراد بيانات الجدول `bs_services`
--

INSERT INTO `bs_services` (`id`, `entity_id`, `name_ar`, `name_en`, `icon`, `price`, `description_ar`, `description_en`, `estimated_days`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'استخراج جواز السفر', 'Passport Issuance', 'ti-id', 300.00, NULL, NULL, 5, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(2, 1, 'تجديد بطاقة الهوية', 'ID Card Renewal', 'ti-id-badge', 100.00, NULL, NULL, 3, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(3, 1, 'استخراج وثيقة السجل العائلي', 'Family Registration Document', 'ti-file', 150.00, NULL, NULL, 4, 1, 3, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(4, 2, 'تراخيص الاتصالات', 'Telecom Licenses', 'ti-signal', 500.00, NULL, NULL, 7, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(5, 2, 'خدمات البريد الإلكتروني الحكومي', 'Government Email Services', 'ti-mail', 200.00, NULL, NULL, 3, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(6, 3, 'تسجيل شركة جديدة', 'Company Registration', 'ti-building', 800.00, NULL, NULL, 10, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(7, 3, 'تجديد السجل التجاري', 'Commercial Registration Renewal', 'ti-refresh', 400.00, NULL, NULL, 5, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(8, 3, 'استخراج شهادة عدم تعارض', 'Non-Conflict Certificate', 'ti-certificate', 200.00, NULL, NULL, 3, 1, 3, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(9, 4, 'التوثيق القانوني', 'Legal Documentation', 'ti-file-certificate', 350.00, NULL, NULL, 4, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(10, 4, 'استخراج وثيقة زواج', 'Marriage Certificate', 'ti-heart', 200.00, NULL, NULL, 3, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(11, 4, 'إفراغ العقارات', 'Property Transfer', 'ti-home', 600.00, NULL, NULL, 7, 1, 3, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(12, 5, 'تسجيل منشأة صحية', 'Health Facility Registration', 'ti-building-hospital', 1000.00, NULL, NULL, 14, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(13, 5, 'ترخيص الممارسة الصحية', 'Health Practice License', 'ti-stethoscope', 500.00, NULL, NULL, 7, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(14, 6, 'استخراج تصريح عمل', 'Work Permit', 'ti-user-check', 450.00, NULL, NULL, 6, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(15, 6, 'نقل الكفالة', 'Sponsorship Transfer', 'ti-transfer', 300.00, NULL, NULL, 5, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(16, 6, 'تسجيل منشأة تجارية', 'Business Establishment Registration', 'ti-building', 600.00, NULL, NULL, 8, 1, 3, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(17, 7, 'الخدمات الضريبية', 'Tax Services', 'ti-receipt-tax', 300.00, NULL, NULL, 5, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(18, 7, 'استخراج شهادة الزكاة', 'Zakat Certificate', 'ti-certificate', 150.00, NULL, NULL, 3, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(19, 8, 'قبول الطلاب', 'Student Admission', 'ti-user-plus', 50.00, NULL, NULL, 2, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(20, 8, 'توثيق الشهادات', 'Certificate Authentication', 'ti-certificate', 200.00, NULL, NULL, 4, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(21, 8, 'ترخيص منشأة تعليمية', 'Educational Institution License', 'ti-building-school', 1500.00, NULL, NULL, 20, 1, 3, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(22, 9, 'تراخيص الفنادق', 'Hotel Licenses', 'ti-building', 2000.00, NULL, NULL, 14, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(23, 9, 'ترخيص وكالة سياحية', 'Travel Agency License', 'ti-map', 1200.00, NULL, NULL, 10, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(24, 10, 'تراخيص الاستثمار الأجنبي', 'Foreign Investment License', 'ti-world', 3000.00, NULL, NULL, 15, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(25, 10, 'ترخيص المنشأة الاستثمارية', 'Investment Facility License', 'ti-building-factory', 2000.00, NULL, NULL, 12, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(26, 11, 'التسجيل الضريبي', 'Tax Registration', 'ti-file-description', 0.00, NULL, NULL, 5, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(27, 11, 'تقديم الإقرار الضريبي', 'Tax Return Submission', 'ti-file-invoice', 0.00, NULL, NULL, 3, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(28, 11, 'استرداد ضريبة القيمة المضافة', 'VAT Refund', 'ti-coin', 100.00, NULL, NULL, 14, 1, 3, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(29, 12, 'تراخيص الطيران', 'Aviation Licenses', 'ti-license', 5000.00, NULL, NULL, 30, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(30, 12, 'ترخيص الطائرات بدون طيار', 'Drone License', 'ti-drone', 500.00, NULL, NULL, 7, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(31, 13, 'تراخيص الأوراق المالية', 'Securities Licenses', 'ti-chart-line', 10000.00, NULL, NULL, 45, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(32, 13, 'تسجيل الصناديق الاستثمارية', 'Investment Fund Registration', 'ti-building-bank', 5000.00, NULL, NULL, 30, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(33, 14, 'تسجيل الأدوية', 'Drug Registration', 'ti-pill', 2000.00, NULL, NULL, 60, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(34, 14, 'ترخيص منشأة غذائية', 'Food Facility License', 'ti-building', 1500.00, NULL, NULL, 20, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(35, 14, 'تسجيل المنتجات الغذائية', 'Food Product Registration', 'ti-package', 800.00, NULL, NULL, 14, 1, 3, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(36, 15, 'تسجيل العقارات', 'Property Registration', 'ti-home', 800.00, NULL, NULL, 7, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(37, 15, 'ترخيص شركة عقارية', 'Real Estate Company License', 'ti-building', 2000.00, NULL, NULL, 14, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(38, 16, 'تراخيص الفعاليات الترفيهية', 'Entertainment Event Licenses', 'ti-ticket', 3000.00, NULL, NULL, 14, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(39, 16, 'ترخيص دور السينما', 'Cinema License', 'ti-movie', 5000.00, NULL, NULL, 30, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(40, 17, 'اعتماد الأنظمة الأمنية', 'Security System Accreditation', 'ti-shield-check', 5000.00, NULL, NULL, 30, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(41, 17, 'اختبار الاختراق المعتمد', 'Certified Penetration Testing', 'ti-bug', 3000.00, NULL, NULL, 14, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(42, 18, 'التسجيل في التأمينات', 'Social Insurance Registration', 'ti-user-check', 0.00, NULL, NULL, 3, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(43, 18, 'استخراج شهادة التأمينات', 'Insurance Certificate', 'ti-certificate', 50.00, NULL, NULL, 2, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(44, 18, 'طلبات التقاعد', 'Retirement Applications', 'ti-calendar', 0.00, NULL, NULL, 30, 1, 3, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(45, 19, 'خدمات الشحن', 'Shipping Services', 'ti-package', 80.00, NULL, NULL, 1, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(46, 19, 'صندوق البريد', 'PO Box', 'ti-mailbox', 200.00, NULL, NULL, 2, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(47, 20, 'حجز التذاكر المؤسسي', 'Corporate Ticket Booking', 'ti-ticket', 0.00, NULL, NULL, 1, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(48, 20, 'عقود السفر للشركات', 'Corporate Travel Contracts', 'ti-file-description', 500.00, NULL, NULL, 7, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(49, 21, 'طلبات القروض الصناعية', 'Industrial Loan Applications', 'ti-coin', 0.00, NULL, NULL, 30, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(50, 21, 'استشارات التطوير الصناعي', 'Industrial Development Consulting', 'ti-users', 0.00, NULL, NULL, 7, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(51, 22, 'فتح حساب تجاري', 'Open Business Account', 'ti-wallet', 0.00, NULL, NULL, 3, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(52, 22, 'خطاب ضمان بنكي', 'Bank Guarantee Letter', 'ti-file-certificate', 500.00, NULL, NULL, 5, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(67, 3, 'اصدار سجل تجاري جديد لموسسة فردية', 'Issuance of a new commercial registration for a sole proprietorship', 'ti-certificate', 200.00, NULL, NULL, 2, 1, 4, '2026-06-16 13:17:44', '2026-06-16 13:17:44'),
(62, 27, 'تأشيرات الزيارة', 'Visitor Visas', 'ti-plane', 600.00, NULL, NULL, 14, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(63, 27, 'تأشيرات العمل', 'Work Visas', 'ti-briefcase', 800.00, NULL, NULL, 21, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(64, 28, 'تأشيرات زيارة بريطانيا', 'UK Visit Visas', 'ti-passport', 700.00, NULL, NULL, 15, 1, 1, '2026-05-19 05:20:47', '2026-05-19 05:20:47'),
(65, 28, 'تصديق الشهادات الأكاديمية', 'Academic Certificate Attestation', 'ti-certificate', 400.00, NULL, NULL, 7, 1, 2, '2026-05-19 05:20:47', '2026-05-19 05:20:47');

--
-- إرجاع أو استيراد بيانات الجدول `bs_users`
--

INSERT INTO `bs_users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `role`, `is_active`, `permissions`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'انور احمد', 'aanwr6652@gmail.com', '0556351761', NULL, '$2y$12$pbJH7Uz/HTUbL2.ENBUu2O5qWCPOoA/MK5iFEg7hcoFfluoGAcKdq', 'user', 1, NULL, NULL, '2026-05-19 16:06:58', '2026-05-19 16:06:58'),
(2, 'شسي', 'tesd@gmail.xom', '05545455545', NULL, '$2y$12$L9.00OstSzdetmsBl9QMPe71XRXfYNkceMzgud3YOisRfNSlBFbEi', 'user', 1, NULL, NULL, '2026-05-21 12:01:20', '2026-05-21 12:01:20'),
(3, 'محسن العتيبي', '7m7m1191@gmail.com', '0504884879', NULL, '$2y$12$pDMOkZ37u886F.Z9ZjFxs.bayrrVuZUwHSUiL2Ahiczq7Rrt/K4rK', 'user', 1, NULL, NULL, '2026-05-23 12:53:19', '2026-05-23 12:53:19'),
(4, 'ساره عبدالرحمن', 'sarah@najdsteel.com', '+966598721813', NULL, '$2y$12$H3Laj4XCUzqsOZ7v6RBdbup/MxoKs2zH4CTIUyyz2V4YCZ9X5Owde', 'user', 1, NULL, NULL, '2026-05-24 04:35:23', '2026-05-24 04:35:23'),
(5, 'بكيل', 'bakeelwork2@gmail.com', '0536892909', NULL, '$2y$12$ZAhWgJPGi0RrAuQVF2fnXOd13aS5yVkdRPCnBbYP3ko5rTS7225ji', 'user', 1, NULL, NULL, '2026-05-24 08:18:02', '2026-05-24 08:18:02'),
(6, 'ماويه العوفي', 'raid_gaid_2012@icloud.com', '0544137570', NULL, '$2y$12$JbOm81f1.MPQk4ja.HqKbuGKbxECG0EEtX2taXh7PDnG/VcwvMbP.', 'user', 1, NULL, NULL, '2026-05-24 15:44:01', '2026-05-24 15:44:01'),
(7, 'نصر', 'naser1994.nba@gmail.com', '0568842729', NULL, '$2y$12$dmIiTj.BoWJn4CS.6KeqqeFAB.Uy1cFUupju8E33sBt7DovmTNIES', 'user', 1, NULL, NULL, '2026-05-30 13:33:50', '2026-05-30 13:33:50'),
(8, 'RAKAN ALHARBI', 'alharbira950@gmail.com', '+966568990950', NULL, '$2y$12$UHJ3aEEZyFqVCOHBPxmuE.X/AZTzNDDC4czu0FJq1BRI.5/UuHZ8K', 'user', 1, NULL, NULL, '2026-06-02 12:37:45', '2026-06-02 12:37:45'),
(9, 'Mohammed Alsir', 'm7md3lsir.10@gmail.com', '0501807076', NULL, '$2y$12$eZNWWavXEfTe7q2a26PZHOA6C/dKMawtVIb1V2rhH599N.q7T2B/m', 'user', 1, NULL, NULL, '2026-06-03 13:16:35', '2026-06-03 13:16:35'),
(10, 'محمد', 'm7mdb3sher@gmail.com', '0501807075', NULL, '$2y$12$VA0sQK0Vm3vgoiNzIeAC1e4KQNM6mb2ZEa7/QyCPuQ7a9kh91aLmW', 'user', 1, NULL, NULL, '2026-06-05 10:54:51', '2026-06-05 10:54:51'),
(11, 'مشرف النظام', 'supervisor@amrtm.com.sa', NULL, NULL, '$2y$12$f9YWR0MoInrYLSezJmhMTemQ5ZeQK4DI7MMwUEDzq0SqctPMJtANW', 'supervisor', 1, NULL, 'kWe7cSwTJbfWFaAxQ5mtdTar29ZN8mYcVdMOZahAy3PQAiDPHyNRdd6criPh', '2026-06-10 07:53:43', '2026-06-10 07:53:43'),
(12, 'محمود الخليفه', 'melhaj277@gmail.com', '0504013613', NULL, '$2y$12$UMY6ScbDqC/S4QDQbkyAS.LqJpK.kAhT2.YHOXH0X2jmLzuI7QjbK', 'user', 1, NULL, NULL, '2026-06-12 05:32:09', '2026-06-12 05:32:09'),
(13, 'محمد الاسقر', 'mohammedname2002@gmail.com', '+972592257669', NULL, '$2y$12$OuJTYDJtE5VP4CtGRzXKeeDCTpUo4uO5GO87CCgwaKFJp7iE6XgCu', 'user', 1, NULL, NULL, '2026-06-13 03:17:30', '2026-06-13 03:17:30'),
(14, 'Ibrahim Mohammed Yasin Kaid', 'ibrakaid2012@gmail.com', '0502014299', NULL, '$2y$12$.3RqxdFafdj87oJB24B1sOzLFyOG0ELd3FFKq1I7vmceVPeK8tGle', 'user', 1, NULL, NULL, '2026-06-13 11:40:18', '2026-06-13 11:40:18'),
(15, 'Bertin K ASSOGBA NONGNIDE', 'dg@ibt-sarl.com', '+2290197395110', NULL, '$2y$12$CiwCXcKs/iYeV.o1TK0hIOHMYwk0HILqG3eMwR3Mu4y.nI2xMvSVq', 'user', 1, NULL, NULL, '2026-06-13 21:48:28', '2026-06-13 21:48:28'),
(16, 'ali', 'ali123@gmail.com', '0538981732', NULL, '$2y$12$nHkAZS9BAr9pGaDJQGVJWu21HMVDgmtQXBxiNsXisa8KbwiLl437K', 'user', 1, NULL, NULL, '2026-06-20 11:02:26', '2026-06-20 11:02:26'),
(17, 'فيض خان اعظم', 'poi09p8@gmail.com', '0580288373', NULL, '$2y$12$Sfrh4HF/nzRp0wroZPX5EOr5ta4qGX2.GgQKttFVjvksmzn/j1uua', 'user', 1, NULL, NULL, '2026-06-21 07:36:28', '2026-06-21 07:36:28'),
(18, 'Mujahid Mohammed', 'alshawahidalrawasi@gmail.com', '0502275361', NULL, '$2y$12$YWpJSzqC4Oacpp2ffe8KWeBe7DnHPmYmbgydoeO5AxugKhRG96Cni', 'user', 1, NULL, NULL, '2026-06-21 07:38:40', '2026-06-21 07:38:40'),
(19, 'ىىلايى', 'EMESMITH96@GMAIL.COM', '0545743457', NULL, '$2y$12$Tj40ifjVhXnWUZycgK1GfehSf1Ov/cu84QeLX6UqcB8GB2rJ0mgNi', 'user', 1, NULL, NULL, '2026-06-24 02:50:54', '2026-06-24 02:50:54'),
(20, 'ياسر الناشري', 'ban361517@gmail.com', '0544339240', NULL, '$2y$12$Rfitgi3lQSkTWi3HO9vHRunrBowiSVWhS5Pn6knyGb06gJknNOI9q', 'user', 1, NULL, NULL, '2026-06-24 17:20:37', '2026-06-24 17:20:37'),
(21, 'Osama Mohamed', 'oabdelwahed99@gmail.com', '+201010082743', NULL, '$2y$12$FdoxCiB5eh2AtxMjG5y51OBIMIb/Q43oT4J.6eBc1FiLrErblaYBi', 'user', 1, NULL, NULL, '2026-06-24 18:50:06', '2026-06-24 18:50:06'),
(22, 'حسن عبد الله العيسى', 'alysyhsnbdallh9@gmail.com', '0561617201', NULL, '$2y$12$olfZ4GHYXzeJEwfnsIRb1uUS2Hk9ASKaEsNWjie4Hw2QAf6AJbZZ2', 'user', 1, NULL, NULL, '2026-06-25 09:56:39', '2026-06-25 09:56:39'),
(23, 'خالد بن ضيف الله بن مسفر العتيبي', 'khalidsst@hotmail.com', '+966556200292', NULL, '$2y$12$QTKpQdvKw9VXCx8e7QyoU.FY3T07js2JtyjpS45h1L3ojw3sGOLUK', 'user', 1, NULL, NULL, '2026-06-29 08:27:49', '2026-06-29 08:27:49'),
(24, 'Raad Ghanem', 'raadghanemm@gmail.com', '305355555', NULL, '$2y$12$xePrcXB37Tz5d71rTvwbSu.v.SVylifQP1ihR8z3RR.9YtICWyEhe', 'user', 1, NULL, NULL, '2026-06-30 03:40:52', '2026-06-30 03:40:52'),
(25, 'عبدالله حسن دبشه', 'iiiaaalll20@gmail.fom', '+966597231174', NULL, '$2y$12$ICMmQ5N7WKpigU/OsgeGZ.oYglC.UnZFZ1VdrvVmgNgExUp/QCYmC', 'user', 1, NULL, NULL, '2026-07-01 12:20:06', '2026-07-01 12:20:06'),
(26, 'MOHAMMED ALQAHTANI', 'qx_8@outlook.sa', '+966555616323', NULL, '$2y$12$vV/ftNr/M/zNx2G9wnuCVujcOpkvSNe7ZKMKS6BQVG3C8bu9fwOVO', 'user', 1, NULL, NULL, '2026-07-16 17:28:07', '2026-07-16 17:28:07');

--
-- إرجاع أو استيراد بيانات الجدول `migrations`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

COMMIT;
