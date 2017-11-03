-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 18, 2016 at 04:58 PM
-- Server version: 5.1.71
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Table structure for table `common_month`
--

DROP TABLE IF EXISTS `common_month`;
CREATE TABLE IF NOT EXISTS `common_month` (
  `month` datetime NOT NULL,
  PRIMARY KEY (`month`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `common_language`
--

DROP TABLE IF EXISTS `common_language`;
CREATE TABLE IF NOT EXISTS `common_language` (
  `a3b` char(2) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `a3t` char(2) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `iso` char(2) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `language` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`iso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `common_language`
--

INSERT INTO `common_language` (`a3b`, `a3t`, `iso`, `language`) VALUES
('aa', '', 'aa', 'Afar'),
('ab', '', 'ab', 'Abkhazian'),
('af', '', 'af', 'Afrikaans'),
('ak', '', 'ak', 'Akan'),
('al', 'sq', 'sq', 'Albanian'),
('am', '', 'am', 'Amharic'),
('ar', '', 'ar', 'Arabic'),
('ar', '', 'an', 'Aragonese'),
('ar', 'hy', 'hy', 'Armenian'),
('as', '', 'as', 'Assamese'),
('av', '', 'av', 'Avaric'),
('av', '', 'ae', 'Avestan'),
('ay', '', 'ay', 'Aymara'),
('az', '', 'az', 'Azerbaijani'),
('ba', '', 'ba', 'Bashkir'),
('ba', '', 'bm', 'Bambara'),
('ba', 'eu', 'eu', 'Basque'),
('be', '', 'be', 'Belarusian'),
('be', '', 'bn', 'Bengali'),
('bi', '', 'bh', 'Bihari languages'),
('bi', '', 'bi', 'Bislama'),
('bo', '', 'bs', 'Bosnian'),
('br', '', 'br', 'Breton'),
('bu', '', 'bg', 'Bulgarian'),
('bu', 'my', 'my', 'Burmese'),
('ca', '', 'ca', 'Catalan'),
('ch', '', 'ch', 'Chamorro'),
('ch', '', 'ce', 'Chechen'),
('ch', 'zh', 'zh', 'Chinese'),
('ch', '', 'cu', 'Church Slavic'),
('ch', '', 'cv', 'Chuvash'),
('co', '', 'kw', 'Cornish'),
('co', '', 'co', 'Corsican'),
('cr', '', 'cr', 'Cree'),
('cz', 'ce', 'cs', 'Czech'),
('da', '', 'da', 'Danish'),
('di', '', 'dv', 'Divehi'),
('du', 'nl', 'nl', 'Dutch'),
('dz', '', 'dz', 'Dzongkha'),
('en', '', 'en', 'English'),
('ep', '', 'eo', 'Esperanto'),
('es', '', 'et', 'Estonian'),
('ew', '', 'ee', 'Ewe'),
('fa', '', 'fo', 'Faroese'),
('fi', '', 'fj', 'Fijian'),
('fi', '', 'fi', 'Finnish'),
('fr', 'fr', 'fr', 'French'),
('fr', '', 'fy', 'Western Frisian'),
('fu', '', 'ff', 'Fulah'),
('ge', 'ka', 'ka', 'Georgian'),
('ge', 'de', 'de', 'German'),
('gl', '', 'gd', 'Gaelic'),
('gl', '', 'ga', 'Irish'),
('gl', '', 'gl', 'Galician'),
('gl', '', 'gv', 'Manx'),
('gr', 'el', 'el', 'Greek'),
('gr', '', 'gn', 'Guarani'),
('gu', '', 'gu', 'Gujarati'),
('ha', '', 'ht', 'Haitian'),
('ha', '', 'ha', 'Hausa'),
('he', '', 'he', 'Hebrew'),
('he', '', 'hz', 'Herero'),
('hi', '', 'hi', 'Hindi'),
('hm', '', 'ho', 'Hiri Motu'),
('hr', '', 'hr', 'Croatian'),
('hu', '', 'hu', 'Hungarian'),
('ib', '', 'ig', 'Igbo'),
('ic', 'is', 'is', 'Icelandic'),
('id', '', 'io', 'Ido'),
('ii', '', 'ii', 'Sichuan Yi'),
('ik', '', 'iu', 'Inuktitut'),
('il', '', 'ie', 'Interlingue'),
('in', '', 'id', 'Indonesian'),
('ip', '', 'ik', 'Inupiaq'),
('it', '', 'it', 'Italian'),
('ja', '', 'jv', 'Javanese'),
('jp', '', 'ja', 'Japanese'),
('ka', '', 'kl', 'Kalaallisut'),
('ka', '', 'kn', 'Kannada'),
('ka', '', 'ks', 'Kashmiri'),
('ka', '', 'kr', 'Kanuri'),
('ka', '', 'kk', 'Kazakh'),
('kh', '', 'km', 'Central Khmer'),
('ki', '', 'ki', 'Kikuyu'),
('ki', '', 'rw', 'Kinyarwanda'),
('ki', '', 'ky', 'Kirghiz'),
('ko', '', 'kv', 'Komi'),
('ko', '', 'kg', 'Kongo'),
('ko', '', 'ko', 'Korean'),
('ku', '', 'kj', 'Kuanyama'),
('ku', '', 'ku', 'Kurdish'),
('la', '', 'lo', 'Lao'),
('la', '', 'la', 'Latin'),
('la', '', 'lv', 'Latvian'),
('li', '', 'li', 'Limburgan'),
('li', '', 'ln', 'Lingala'),
('li', '', 'lt', 'Lithuanian'),
('lt', '', 'lb', 'Luxembourgish'),
('lu', '', 'lu', 'Luba-Katanga'),
('lu', '', 'lg', 'Ganda'),
('ma', 'mk', 'mk', 'Macedonian'),
('ma', '', 'mh', 'Marshallese'),
('ma', '', 'ml', 'Malayalam'),
('ma', 'mr', 'mi', 'Maori'),
('ma', '', 'mr', 'Marathi'),
('ma', 'ms', 'ms', 'Malay'),
('ml', '', 'mg', 'Malagasy'),
('ml', '', 'mt', 'Maltese'),
('mo', '', 'mn', 'Mongolian'),
('na', '', 'na', 'Nauru'),
('na', '', 'nv', 'Navajo'),
('nb', '', 'nr', 'Ndebele'),
('nd', '', 'nd', 'Ndebele'),
('nd', '', 'ng', 'Ndonga'),
('ne', '', 'ne', 'Nepali'),
('nn', '', 'nn', 'Norwegian Nynors'),
('no', '', 'nb', 'Bokm�l'),
('no', '', 'no', 'Norwegian'),
('ny', '', 'ny', 'Chichewa'),
('oc', '', 'oc', 'Occitan (post 15'),
('oj', '', 'oj', 'Ojibwa'),
('or', '', 'or', 'Oriya'),
('or', '', 'om', 'Oromo'),
('os', '', 'os', 'Ossetian'),
('pa', '', 'pa', 'Panjabi'),
('pe', 'fa', 'fa', 'Persian'),
('pl', '', 'pi', 'Pali'),
('po', '', 'pl', 'Polish'),
('po', '', 'pt', 'Portuguese'),
('pu', '', 'ps', 'Pushto'),
('qu', '', 'qu', 'Quechua'),
('ro', '', 'rm', 'Romansh'),
('ru', 'ro', 'ro', 'Romanian'),
('ru', '', 'rn', 'Rundi'),
('ru', '', 'ru', 'Russian'),
('sa', '', 'sg', 'Sango'),
('sa', '', 'sa', 'Sanskrit'),
('si', '', 'si', 'Sinhala'),
('sl', 'sl', 'sk', 'Slovak'),
('sl', '', 'sl', 'Slovenian'),
('sm', '', 'se', 'Northern Sami'),
('sm', '', 'sm', 'Samoan'),
('sn', '', 'sn', 'Shona'),
('sn', '', 'sd', 'Sindhi'),
('so', '', 'so', 'Somali'),
('so', '', 'st', 'Sotho'),
('sp', '', 'es', 'Spanish'),
('sr', '', 'sc', 'Sardinian'),
('sr', '', 'sr', 'Serbian'),
('ss', '', 'ss', 'Swati'),
('su', '', 'su', 'Sundanese'),
('sw', '', 'sw', 'Swahili'),
('sw', '', 'sv', 'Swedish'),
('ta', '', 'ty', 'Tahitian'),
('ta', '', 'ta', 'Tamil'),
('ta', '', 'tt', 'Tatar'),
('te', '', 'te', 'Telugu'),
('tg', '', 'tg', 'Tajik'),
('tg', '', 'tl', 'Tagalog'),
('th', '', 'th', 'Thai'),
('ti', 'bo', 'bo', 'Tibetan'),
('ti', '', 'ti', 'Tigrinya'),
('to', '', 'to', 'Tonga (Tonga Isl'),
('ts', '', 'tn', 'Tswana'),
('ts', '', 'ts', 'Tsonga'),
('tu', '', 'tk', 'Turkmen'),
('tu', '', 'tr', 'Turkish'),
('tw', '', 'tw', 'Twi'),
('ui', '', 'ug', 'Uighur'),
('uk', '', 'uk', 'Ukrainian'),
('ur', '', 'ur', 'Urdu'),
('uz', '', 'uz', 'Uzbek'),
('ve', '', 've', 'Venda'),
('vi', '', 'vi', 'Vietnamese'),
('vo', '', 'vo', 'Volap�k'),
('we', 'cy', 'cy', 'Welsh'),
('wl', '', 'wa', 'Walloon'),
('wo', '', 'wo', 'Wolof'),
('xh', '', 'xh', 'Xhosa'),
('yi', '', 'yi', 'Yiddish'),
('yo', '', 'yo', 'Yoruba'),
('zh', '', 'za', 'Zhuang'),
('zu', '', 'zu', 'Zulu');

--
-- Table structure for table `common_country`
--
DROP TABLE IF EXISTS `common_country`;
CREATE TABLE IF NOT EXISTS `common_country` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `iso2` char(2) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `iso3` char(3) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  PRIMARY KEY (`iso2`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `iso3` (`iso3`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Dumping data for table `common_country`
--

INSERT INTO `common_country` (`name`, `iso2`, `iso3`) VALUES
('Afghanistan', 'AF', 'AFG'),
('Aland', 'AX', 'ALA'),
('Albania', 'AL', 'ALB'),
('Algeria', 'DZ', 'DZA'),
('American Samoa', 'AS', 'ASM'),
('Andorra', 'AD', 'AND'),
('Angola', 'AO', 'AGO'),
('Anguilla', 'AI', 'AIA'),
('Antarctica', 'AQ', 'ATA'),
('Antigua and Barbuda', 'AG', 'ATG'),
('Argentina', 'AR', 'ARG'),
('Armenia', 'AM', 'ARM'),
('Aruba', 'AW', 'ABW'),
('Ascension', 'AC', 'ASC'),
('Australia', 'AU', 'AUS'),
('Austria', 'AT', 'AUT'),
('Azerbaijan', 'AZ', 'AZE'),
('Bahamas', 'BS', 'BHS'),
('Bahrain', 'BH', 'BHR'),
('Bangladesh', 'BD', 'BGD'),
('Barbados', 'BB', 'BRB'),
('Belarus', 'BY', 'BLR'),
('Belgium', 'BE', 'BEL'),
('Belize', 'BZ', 'BLZ'),
('Benin', 'BJ', 'BEN'),
('Bermuda', 'BM', 'BMU'),
('Bhutan', 'BT', 'BTN'),
('Bolivia', 'BO', 'BOL'),
('Bosnia and Herzegovina', 'BA', 'BIH'),
('Botswana', 'BW', 'BWA'),
('Bouvet Island', 'BV', 'BVT'),
('Brazil', 'BR', 'BRA'),
('British Indian Ocean Territory', 'IO', 'IOT'),
('British Virgin Islands', 'VG', 'VGB'),
('Brunei', 'BN', 'BRN'),
('Bulgaria', 'BG', 'BGR'),
('Burkina Faso', 'BF', 'BFA'),
('Burundi', 'BI', 'BDI'),
('Cambodia', 'KH', 'KHM'),
('Cameroon', 'CM', 'CMR'),
('Canada', 'CA', 'CAN'),
('Cape Verde', 'CV', 'CPV'),
('Cayman Islands', 'KY', 'CYM'),
('Central African Republic', 'CF', 'CAF'),
('Chad', 'TD', 'TCD'),
('Chile', 'CL', 'CHL'),
('China', 'CN', 'CHN'),
('Christmas Island', 'CX', 'CXR'),
('Cocos (Keeling) Islands', 'CC', 'CCK'),
('Colombia', 'CO', 'COL'),
('Comoros', 'KM', 'COM'),
('Congo', 'CG', 'COG'),
('Congo (Democratic Republic of the)', 'CD', 'COD'),
('Cook Islands', 'CK', 'COK'),
('Costa Rica', 'CR', 'CRI'),
('Côte d''Ivoire', 'CI', 'CIV'),
('Croatia', 'HR', 'HRV'),
('Cuba', 'CU', 'CUB'),
('Curaçao', 'CW', 'CUW'),
('Cyprus', 'CY', 'CYP'),
('Czech Republic', 'CZ', 'CZE'),
('Denmark', 'DK', 'DNK'),
('Djibouti', 'DJ', 'DJI'),
('Dominica', 'DM', 'DMA'),
('Dominican Republic', 'DO', 'DOM'),
('Ecuador', 'EC', 'ECU'),
('Egypt', 'EG', 'EGY'),
('El Salvador', 'SV', 'SLV'),
('Equatorial Guinea', 'GQ', 'GNQ'),
('Eritrea', 'ER', 'ERI'),
('Estonia', 'EE', 'EST'),
('Ethiopia', 'ET', 'ETH'),
('Falkland Islands (Islas Malvinas)', 'FK', 'FLK'),
('Faroe Islands', 'FO', 'FRO'),
('Fiji', 'FJ', 'FJI'),
('Finland', 'FI', 'FIN'),
('France', 'FR', 'FRA'),
('French Guiana', 'GF', 'GUF'),
('French Polynesia', 'PF', 'PYF'),
('French Southern and Antarctic Lands', 'TF', 'ATF'),
('Gabon', 'GA', 'GAB'),
('Gambia, The', 'GM', 'GMB'),
('Georgia', 'GE', 'GEO'),
('Germany', 'DE', 'DEU'),
('Ghana', 'GH', 'GHA'),
('Gibraltar', 'GI', 'GIB'),
('Greece', 'GR', 'GRC'),
('Greenland', 'GL', 'GRL'),
('Grenada', 'GD', 'GRD'),
('Guadeloupe', 'GP', 'GLP'),
('Guam', 'GU', 'GUM'),
('Guatemala', 'GT', 'GTM'),
('Guernsey', 'GG', 'GGY'),
('Guinea', 'GN', 'GIN'),
('Guinea-Bissau', 'GW', 'GNB'),
('Guyana', 'GY', 'GUY'),
('Haiti', 'HT', 'HTI'),
('Heard Island and McDonald Islands', 'HM', 'HMD'),
('Honduras', 'HN', 'HND'),
('Hong Kong', 'HK', 'HKG'),
('Hungary', 'HU', 'HUN'),
('Iceland', 'IS', 'ISL'),
('India', 'IN', 'IND'),
('Indonesia', 'ID', 'IDN'),
('Iran', 'IR', 'IRN'),
('Iraq', 'IQ', 'IRQ'),
('Ireland', 'IE', 'IRL'),
('Isle of Man', 'IM', 'IMN'),
('Israel', 'IL', 'ISR'),
('Italy', 'IT', 'ITA'),
('Jamaica', 'JM', 'JAM'),
('Japan', 'JP', 'JPN'),
('Jersey', 'JE', 'JEY'),
('Jordan', 'JO', 'JOR'),
('Kazakhstan', 'KZ', 'KAZ'),
('Kenya', 'KE', 'KEN'),
('Kiribati', 'KI', 'KIR'),
('Korea (Democratic People''s Republic of)', 'KP', 'PRK'),
('Korea (Republic of)', 'KR', 'KOR'),
('Kuwait', 'KW', 'KWT'),
('Kyrgyzstan', 'KG', 'KGZ'),
('Laos', 'LA', 'LAO'),
('Latvia', 'LV', 'LVA'),
('Lebanon', 'LB', 'LBN'),
('Lesotho', 'LS', 'LSO'),
('Liberia', 'LR', 'LBR'),
('Libya', 'LY', 'LBY'),
('Liechtenstein', 'LI', 'LIE'),
('Lithuania', 'LT', 'LTU'),
('Luxembourg', 'LU', 'LUX'),
('Macao', 'MO', 'MAC'),
('Macedonia, Republic of', 'MK', 'MKD'),
('Madagascar', 'MG', 'MDG'),
('Malawi', 'MW', 'MWI'),
('Malaysia', 'MY', 'MYS'),
('Maldives', 'MV', 'MDV'),
('Mali', 'ML', 'MLI'),
('Malta', 'MT', 'MLT'),
('Marshall Islands', 'MH', 'MHL'),
('Martinique', 'MQ', 'MTQ'),
('Mauritania', 'MR', 'MRT'),
('Mauritius', 'MU', 'MUS'),
('Mayotte', 'YT', 'MYT'),
('Mexico', 'MX', 'MEX'),
('Micronesia (Federated States of)', 'FM', 'FSM'),
('Moldava (Republic of)', 'MD', 'MDA'),
('Monaco', 'MC', 'MCO'),
('Mongolia', 'MN', 'MNG'),
('Montenegro', 'ME', 'MNE'),
('Montserrat', 'MS', 'MSR'),
('Morocco', 'MA', 'MAR'),
('Mozambique', 'MZ', 'MOZ'),
('Myanmar (Burma)', 'MM', 'MMR'),
('Namibia', 'NA', 'NAM'),
('Nauru', 'NR', 'NRU'),
('Nepal', 'NP', 'NPL'),
('Netherlands', 'NL', 'NLD'),
('Netherlands Antilles', 'AN', 'ANT'),
('New Caledonia', 'NC', 'NCL'),
('New Zealand', 'NZ', 'NZL'),
('Nicaragua', 'NI', 'NIC'),
('Niger', 'NE', 'NER'),
('Nigeria', 'NG', 'NGA'),
('Niue', 'NU', 'NIU'),
('Norfolk Island', 'NF', 'NFK'),
('Northern Mariana Islands', 'MP', 'MNP'),
('Norway', 'NO', 'NOR'),
('Oman', 'OM', 'OMN'),
('Pakistan', 'PK', 'PAK'),
('Palau', 'PW', 'PLW'),
('Palestine', 'PS', 'PSE'),
('Panama', 'PA', 'PAN'),
('Papua New Guinea', 'PG', 'PNG'),
('Paraguay', 'PY', 'PRY'),
('Peru', 'PE', 'PER'),
('Philippines', 'PH', 'PHL'),
('Pitcairn Islands', 'PN', 'PCN'),
('Poland', 'PL', 'POL'),
('Portugal', 'PT', 'PRT'),
('Puerto Rico', 'PR', 'PRI'),
('Qatar', 'QA', 'QAT'),
('Réunion', 'RE', 'REU'),
('Romania', 'RO', 'ROU'),
('Russian Federation', 'RU', 'RUS'),
('Rwanda', 'RW', 'RWA'),
('Saint Barthélemy', 'BL', 'BLM'),
('Saint Helena', 'SH', 'SHN'),
('Saint Kitts and Nevis', 'KN', 'KNA'),
('Saint Lucia', 'LC', 'LCA'),
('Saint Martin', 'MF', 'MAF'),
('Saint Pierre and Miquelon', 'PM', 'SPM'),
('Saint Vincent and the Grenadines', 'VC', 'VCT'),
('Samoa', 'WS', 'WSM'),
('San Marino', 'SM', 'SMR'),
('Sao Tome and Principe', 'ST', 'STP'),
('Saudi Arabia', 'SA', 'SAU'),
('Senegal', 'SN', 'SEN'),
('Serbia', 'RS', 'SRB'),
('Seychelles', 'SC', 'SYC'),
('Sierra Leone', 'SL', 'SLE'),
('Singapore', 'SG', 'SGP'),
('Slovakia', 'SK', 'SVK'),
('Slovenia', 'SI', 'SVN'),
('Solomon Islands', 'SB', 'SLB'),
('Somalia', 'SO', 'SOM'),
('South Africa', 'ZA', 'ZAF'),
('South Georgia & South Sandwich Islands', 'GS', 'SGS'),
('Spain', 'ES', 'ESP'),
('Sri Lanka', 'LK', 'LKA'),
('Sudan', 'SD', 'SDN'),
('Suriname', 'SR', 'SUR'),
('Svalbard', 'SJ', 'SJM'),
('Swaziland', 'SZ', 'SWZ'),
('Sweden', 'SE', 'SWE'),
('Switzerland', 'CH', 'CHE'),
('Syria', 'SY', 'SYR'),
('Taiwan, Province of China', 'TW', 'TWN'),
('Tajikistan', 'TJ', 'TJK'),
('Tanzania, United Republic of', 'TZ', 'TZA'),
('Thailand', 'TH', 'THA'),
('Timor-Leste (East Timor)', 'TL', 'TLS'),
('Togo', 'TG', 'TGO'),
('Tokelau', 'TK', 'TKL'),
('Tonga', 'TO', 'TON'),
('Trinidad and Tobago', 'TT', 'TTO'),
('Tristan da Cunha', 'TA', 'TAA'),
('Tunisia', 'TN', 'TUN'),
('Turkey', 'TR', 'TUR'),
('Turkmenistan', 'TM', 'TKM'),
('Turks and Caicos Islands', 'TC', 'TCA'),
('Tuvalu', 'TV', 'TUV'),
('U.S. Virgin Islands', 'VI', 'VIR'),
('Uganda', 'UG', 'UGA'),
('Ukraine', 'UA', 'UKR'),
('United Arab Emirates', 'AE', 'ARE'),
('United Kingdom', 'GB', 'GBR'),
('United States', 'US', 'USA'),
('United States Minor Outlying Islands', 'UM', 'UMI'),
('Uruguay', 'UY', 'URY'),
('Uzbekistan', 'UZ', 'UZB'),
('Vanuatu', 'VU', 'VUT'),
('Vatican City', 'VA', 'VAT'),
('Venezuela', 'VE', 'VEN'),
('Vietnam', 'VN', 'VNM'),
('Wallis and Futuna', 'WF', 'WLF'),
('Yemen', 'YE', 'YEM'),
('Zambia', 'ZM', 'ZMB'),
('Zimbabwe', 'ZW', 'ZWE');

--
-- Table structure for table `common_contactrange`
--

DROP TABLE IF EXISTS `common_contactrange`;
CREATE TABLE IF NOT EXISTS `common_contactrange` (
  `range` varchar(20) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `low` int(8) NOT NULL,
  `high` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `common_contactrange`
--

INSERT INTO `common_contactrange` (`range`, `low`, `high`) VALUES
('less than 250', 0, 250),
('250 to 1,000', 250, 1000),
('1,000 to 2,500', 1000, 2500),
('2,500 to 10,000', 2500, 10000),
('10,000 to 25,000', 10000, 25000),
('25,000 to 100,000', 25000, 100000),
('100,000 to 250,000', 100000, 250000),
('250,000 and up', 250000, 90000000);

--
-- Table structure for table `github_commit`
--

DROP TABLE IF EXISTS `github_commit`;
CREATE TABLE IF NOT EXISTS `github_commit` (
  `repository` varchar(100) CHARACTER SET ascii NOT NULL,
  `hash` char(40) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `author_login` varchar(100) CHARACTER SET ascii NOT NULL,
  `author_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `committer_login` varchar(100) CHARACTER SET ascii NOT NULL,
  `committer_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `message` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  UNIQUE KEY `hash` (`hash`),
  KEY `repository` (`repository`),
  KEY `author_login` (`author_login`),
  KEY `author_date` (`author_date`),
  KEY `committer_login` (`committer_login`),
  KEY `committer_date` (`committer_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `github_user`
--

DROP TABLE IF EXISTS `github_user`;
CREATE TABLE IF NOT EXISTS `github_user` (
  `id` int(11) NOT NULL,
  `login` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_commit` DATETIME DEFAULT NULL,
  PRIMARY KEY (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jira_issue`
--

DROP TABLE IF EXISTS `jira_issue`;
CREATE TABLE IF NOT EXISTS `jira_issue` (
  `jira_id` int(11) NOT NULL COMMENT 'Needed only for proper display in PHPMyAdmin',
  `project` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `issue` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `summary` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `priority` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `security` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reporter` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `assignee` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `resolution` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `resolved` datetime DEFAULT NULL,
  PRIMARY KEY (`jira_id`),
  KEY `project` (`project`),
  UNIQUE KEY `issue` (`issue`),
  KEY `type` (`type`),
  KEY `priority` (`priority`),
  KEY `security` (`security`),
  KEY `reporter` (`reporter`),
  KEY `assignee` (`assignee`),
  KEY `status` (`status`),
  KEY `resolution` (`resolution`),
  KEY `created` (`created`),
  KEY `updated` (`updated`),
  KEY `resolved` (`resolved`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jira_version`
--

DROP TABLE IF EXISTS `jira_version`;
CREATE TABLE IF NOT EXISTS `jira_version` (
  `issue` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('Affects','Fix') COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  KEY `issue` (`issue`),
  KEY `version` (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pingback_site`
--

DROP TABLE IF EXISTS `pingback_site`;
CREATE TABLE IF NOT EXISTS `pingback_site` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hash` varchar(32) COLLATE ascii_bin DEFAULT NULL,
  `version` text COLLATE ascii_bin,
  `lang` text COLLATE ascii_bin,
  `uf` text COLLATE ascii_bin,
  `ufv` text COLLATE ascii_bin,
  `civi_country` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `geoip_isoCode` VARCHAR(2) COLLATE ascii_bin DEFAULT NULL,
  `DB` char(2) COLLATE ascii_bin DEFAULT NULL,
  `MySQL` text COLLATE ascii_bin,
  `PHP` text COLLATE ascii_bin,
  `first_ping_id` bigint(20) unsigned NOT NULL,
  `first_timestamp` timestamp NULL DEFAULT NULL,
  `last_ping_id` bigint(20) unsigned NOT NULL,
  `last_timestamp` timestamp NULL DEFAULT NULL,
  `num_pings` int(11) unsigned DEFAULT '1',
  `is_active` int(1) unsigned DEFAULT NULL,
  `Contact` int(11) unsigned DEFAULT NULL,
  `Contribution` int(11) unsigned DEFAULT NULL,
  `Participant` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash` (`hash`),
  KEY `first_timestamp` (`first_timestamp`),
  KEY `last_ping_id` (`last_ping_id`),
  KEY `last_timestamp` (`last_timestamp`),
  KEY `is_active` (`is_active`),
  KEY `DB` (`DB`)
) ENGINE=MyISAM  DEFAULT CHARSET=ascii COLLATE=ascii_bin AUTO_INCREMENT=120191 ;

-- --------------------------------------------------------

--
-- Table structure for table `pingback_cohort`
--

CREATE TABLE IF NOT EXISTS `pingback_cohort` (
  `cohort` char(7) COLLATE ascii_bin NOT NULL,
  `month` char(7) COLLATE ascii_bin NOT NULL,
  `num_sites` int(11) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_bin;

-- --------------------------------------------------------

--
-- Table structure for table `pingback_extension`
--

DROP TABLE IF EXISTS `pingback_extension`;
CREATE TABLE IF NOT EXISTS `pingback_extension` (
  `site_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  KEY `site_id` (`site_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sourceforge_download`
--

DROP TABLE IF EXISTS `sourceforge_download`;
CREATE TABLE IF NOT EXISTS `sourceforge_download` (
  `type` char(1) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `label` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `value` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stackexchange_history`
--

DROP TABLE IF EXISTS `stackexchange_history`;
CREATE TABLE IF NOT EXISTS `stackexchange_history` (
  `ts_created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `total_users` INT(10) NOT NULL,
  `total_badges` INT(10) NOT NULL,
  `total_questions` INT(10) NOT NULL,
  `total_answers` INT(10) NOT NULL,
  `total_unanswered` INT(10) NOT NULL,
  `total_accepted` INT(10) NOT NULL,
  `total_votes` INT(10) NOT NULL,
  `total_comments` INT(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stackexchange_users`
--

DROP TABLE IF EXISTS `stackexchange_users`;
CREATE TABLE IF NOT EXISTS `stackexchange_users` (
  `user_id`  INT(10) NOT NULL,
  `account_id`  INT(10) NOT NULL,
  `display_name` VARCHAR(64) NOT NULL,
  `user_type` VARCHAR(32) NOT NULL,
  `location` VARCHAR(255) NULL,
  `creation_date` DATE NOT NULL,
  `last_access_date` DATE NOT NULL,
  `reputation` INT(10) NOT NULL,
  `reputation_change_week`  INT(10) NOT NULL,
  `reputation_change_month`  INT(10) NOT NULL,
  `reputation_change_quarter`  INT(10) NOT NULL,
  `reputation_change_year`  INT(10) NOT NULL,
  `accept_rate` INT(10) NULL,
  `badges_gold` INT(10) NOT NULL,
  `badges_silver` INT(10) NOT NULL,
  `badges_bronze` INT(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extensions_dir`
--

DROP TABLE IF EXISTS `extensions_dir`;
CREATE TABLE IF NOT EXISTS `extensions_dir` (
  `nid`  INT(10) NOT NULL,
  `title` varchar(255) CHARACTER SET ascii NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fq_name` varchar(255) CHARACTER SET ascii NOT NULL,
  `git_url` varchar(255) CHARACTER SET ascii NOT NULL,
  PRIMARY KEY (`nid`),
  KEY `fq_name` (`fq_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
