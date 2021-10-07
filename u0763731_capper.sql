-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Авг 10 2019 г., 19:06
-- Версия сервера: 5.7.23-24
-- Версия PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u0763731_capper`
--

-- --------------------------------------------------------

--
-- Структура таблицы `db_config`
--

CREATE TABLE `db_config` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `value` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_config`
--

INSERT INTO `db_config` (`id`, `name`, `value`) VALUES
(1, 'password', 'eweq439df7yrskk'),
(2, 'date_start', '1553932800'),
(3, 'ref_lvls', '3'),
(4, 'ref1', '5'),
(5, 'ref2', '2'),
(6, 'ref3', '1'),
(7, 'ref4', '1'),
(8, 'ref5', '1'),
(9, 'bal_auto', '1'),
(10, 'bal_RUB', '0.01558471'),
(11, 'bal_USD', '1'),
(12, 'bal_BTC', '4136.78645629'),
(13, 'bal_LTC', '60.7686148635'),
(14, 'bal_ETH', '142.524149354'),
(15, 'bal_DASH', '114.501102375'),
(16, 'bal_DOGE', '0.0020868515'),
(17, 'multy_disable', '1'),
(18, 'scam_mode', '1'),
(19, 'ref_type', '2'),
(20, 'ref_link', 'r'),
(21, 'admin_email', 'capper.club.ltd@gmail.com');

-- --------------------------------------------------------

--
-- Структура таблицы `db_cron`
--

CREATE TABLE `db_cron` (
  `id` int(11) NOT NULL,
  `module` varchar(255) NOT NULL DEFAULT '',
  `last` int(11) NOT NULL DEFAULT '0',
  `term` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_cron`
--

INSERT INTO `db_cron` (`id`, `module`, `last`, `term`) VALUES
(1, 'currs', 1554110040, 3600),
(2, 'deposits', 1554113160, 60),
(3, 'cleaner', 1554112320, 43200);

-- --------------------------------------------------------

--
-- Структура таблицы `db_deposits`
--

CREATE TABLE `db_deposits` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user` varchar(15) NOT NULL DEFAULT '',
  `plan` int(2) NOT NULL DEFAULT '1',
  `sum` double NOT NULL DEFAULT '0',
  `sum_earn` double NOT NULL DEFAULT '0',
  `count_earn` int(11) NOT NULL DEFAULT '0',
  `payment_system` varchar(10) NOT NULL DEFAULT '',
  `currs` varchar(10) NOT NULL DEFAULT '',
  `plan_name` varchar(255) NOT NULL DEFAULT '',
  `plan_perc` double NOT NULL DEFAULT '0',
  `plan_term` int(11) NOT NULL DEFAULT '0',
  `plan_earns` int(11) NOT NULL DEFAULT '1',
  `plan_back` int(11) NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_upd` int(44) NOT NULL DEFAULT '0',
  `date_del` int(44) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_earn`
--

CREATE TABLE `db_earn` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user` varchar(25) NOT NULL DEFAULT '',
  `sum` double NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `payment_system` varchar(10) NOT NULL DEFAULT '',
  `currs` varchar(10) NOT NULL DEFAULT '',
  `type` int(1) NOT NULL DEFAULT '1',
  `info` varchar(255) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_insert`
--

CREATE TABLE `db_insert` (
  `id` int(11) NOT NULL,
  `user` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `payment_system` varchar(20) NOT NULL DEFAULT '0',
  `plan` int(11) NOT NULL,
  `sum` double NOT NULL DEFAULT '0',
  `currs` varchar(11) NOT NULL DEFAULT 'USD',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `oper_id` varchar(255) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_limits`
--

CREATE TABLE `db_limits` (
  `id` int(11) NOT NULL,
  `limit_now` int(11) NOT NULL DEFAULT '50',
  `currs_usd` varchar(100) NOT NULL,
  `currs_rub` int(11) NOT NULL,
  `currs_btc` varchar(100) NOT NULL,
  `currs_eth` varchar(100) NOT NULL,
  `currs_ltc` varchar(100) NOT NULL,
  `currs_dash` varchar(100) NOT NULL,
  `currs_doge` varchar(100) NOT NULL,
  `token` varchar(200) NOT NULL,
  `form` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_limits`
--

INSERT INTO `db_limits` (`id`, `limit_now`, `currs_usd`, `currs_rub`, `currs_btc`, `currs_eth`, `currs_ltc`, `currs_dash`, `currs_doge`, `token`, `form`) VALUES
(1, 10000, '1', 66, '0.005', '0.01', '0.05', '0.01', '500', '515bb6e270608c1a225b73fb363e0629', 'limits_form');

-- --------------------------------------------------------

--
-- Структура таблицы `db_news`
--

CREATE TABLE `db_news` (
  `id` int(11) NOT NULL,
  `date_add` int(44) NOT NULL,
  `title` varchar(100) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_payment`
--

CREATE TABLE `db_payment` (
  `id` int(11) NOT NULL,
  `user` varchar(15) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `purse` varchar(100) NOT NULL DEFAULT '',
  `sum` double NOT NULL DEFAULT '0',
  `currs` varchar(4) NOT NULL DEFAULT 'USD',
  `payment_system` varchar(100) NOT NULL DEFAULT '0',
  `oper_id` varchar(255) NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_paysystems`
--

CREATE TABLE `db_paysystems` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `fullname` varchar(60) NOT NULL,
  `example` varchar(100) NOT NULL DEFAULT '',
  `regex` varchar(255) NOT NULL DEFAULT '',
  `format` varchar(10) NOT NULL DEFAULT '',
  `min_insert` double NOT NULL DEFAULT '1',
  `max_insert` double NOT NULL DEFAULT '1',
  `min_payment` double NOT NULL DEFAULT '1',
  `max_payment` double NOT NULL DEFAULT '1',
  `currs` varchar(5) NOT NULL,
  `active_insert` int(1) NOT NULL DEFAULT '1',
  `active_payment` int(1) NOT NULL DEFAULT '1',
  `active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_paysystems`
--

INSERT INTO `db_paysystems` (`id`, `name`, `fullname`, `example`, `regex`, `format`, `min_insert`, `max_insert`, `min_payment`, `max_payment`, `currs`, `active_insert`, `active_payment`, `active`) VALUES
(13, 'ac', 'AdvCash (RUB)', '', '^([a-zA-Z0-9\\+_\\-]+)(\\.[a-zA-Z0-9\\+_\\-]+)*@([a-z0-9\\-]+\\.)+[a-z]{2,6}$', '%.2f', 60, 60000, 10, 60000, 'RUB', 1, 0, 0),
(14, 'acusd', 'AdvCash (USD)', '', '^([a-zA-Z0-9\\+_\\-]+)(\\.[a-zA-Z0-9\\+_\\-]+)*@([a-z0-9\\-]+\\.)+[a-z]{2,6}$', '%.2f', 1, 10000, 0.2, 30000, 'USD', 1, 0, 0),
(15, 'py', 'Payeer (RUB)', '', '^P[0-9]{7,13}$', '%.2f', 100, 650000, 10, 650000, 'RUB', 1, 1, 1),
(16, 'pyusd', 'Payeer (USD)', '', '^P[0-9]{7,13}$', '%.2f', 1, 30000, 0.2, 30000, 'USD', 1, 1, 1),
(17, 'pm', 'PerfectMoney', '', '^U[0-9]{7,8}$', '%.2f', 1, 30000, 0.2, 30000, 'USD', 0, 1, 1),
(18, 'fkym', 'YandexMoney', '', '^[0-9]{13,16}$', '%.2f', 100, 650000, 10, 650000, 'RUB', 1, 0, 0),
(19, 'fkqw', 'Qiwi', '', '^\\+(91|994|82|372|375|374|44|998|972|66|90|81|1|507|7|77|380|371|370|996|9955|992|373|84)[0-9]{6,14}$', '%.2f', 100, 650000, 10, 650000, 'RUB', 1, 0, 0),
(20, 'cpbtc', 'BitCoin', '', '^[a-zA-Z0-9]{27,34}$', '%.8f', 0.005, 7.5, 0.005, 7.5, 'BTC', 1, 1, 1),
(21, 'cpltc', 'LiteCoin', '', '^[a-zA-Z0-9]{27,34}$', '%.8f', 0.1, 500, 0.05, 500, 'LTC', 1, 1, 1),
(22, 'cpeth', 'Ethereum', '', '^0x[a-fA-F0-9]{40}$', '%.8f', 0.1, 220, 0.05, 220, 'ETH', 1, 1, 1),
(23, 'cpdoge', 'DogeCoin', '', '^[a-zA-Z0-9]{27,34}$', '%.8f', 500, 14000000, 200, 14000000, 'DOGE', 1, 1, 1),
(24, 'cpdash', 'Dash', '', '^[a-zA-Z0-9]{27,34}$', '%.8f', 0.01, 35, 0.01, 35, 'DASH', 1, 0, 0),
(25, 'cpxrp', 'Ripple', '', '^r[rpshnaf39wBUDNEGHJKLM4PQRST7VWXYZ2bcdeCg65jkm8oFqi1tuvAxyz]{27,35}$', '%.8f', 2, 1000, 1, 1000, 'XRP', 1, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `db_percmonth`
--

CREATE TABLE `db_percmonth` (
  `id` int(11) NOT NULL,
  `perc` double NOT NULL,
  `date_add` int(44) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_plans`
--

CREATE TABLE `db_plans` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `min_sum` double NOT NULL,
  `max_sum` double NOT NULL,
  `perc` double NOT NULL,
  `term` int(11) NOT NULL,
  `earns` int(11) NOT NULL DEFAULT '1',
  `back` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_plans`
--

INSERT INTO `db_plans` (`id`, `name`, `min_sum`, `max_sum`, `perc`, `term`, `earns`, `back`) VALUES
(1, 'FORKS', 1, 50, 108, 3600, 24, 0),
(2, 'PREDICT', 51, 500, 110, 3600, 24, 0),
(3, 'INSIDER', 501, 1000, 112, 3600, 24, 0),
(4, 'VIP', 1001, 30000, 250, 864000, 240, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `db_recovery`
--

CREATE TABLE `db_recovery` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `_key` varchar(80) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_reviews`
--

CREATE TABLE `db_reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `date_add` int(44) NOT NULL,
  `type` int(1) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `db_user_balance`
--

CREATE TABLE `db_user_balance` (
  `id` int(11) NOT NULL,
  `reinsert_sum` double NOT NULL DEFAULT '0',
  `insert_sum` double NOT NULL DEFAULT '0',
  `payment_sum` double NOT NULL DEFAULT '0',
  `money_ac` double NOT NULL DEFAULT '0',
  `money_acusd` double NOT NULL DEFAULT '0',
  `money_py` double NOT NULL DEFAULT '0',
  `money_pyusd` double NOT NULL DEFAULT '0',
  `money_pm` double NOT NULL DEFAULT '0',
  `money_fkym` double NOT NULL DEFAULT '0',
  `money_fkqw` double NOT NULL DEFAULT '0',
  `money_cpbtc` double NOT NULL DEFAULT '0',
  `money_cpltc` double NOT NULL DEFAULT '0',
  `money_cpeth` double NOT NULL DEFAULT '0',
  `money_cpdoge` double NOT NULL DEFAULT '0',
  `money_cpdash` double NOT NULL DEFAULT '0',
  `money_cpxrp` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `db_user_balance`
--

INSERT INTO `db_user_balance` (`id`, `reinsert_sum`, `insert_sum`, `payment_sum`, `money_ac`, `money_acusd`, `money_py`, `money_pyusd`, `money_pm`, `money_fkym`, `money_fkqw`, `money_cpbtc`, `money_cpltc`, `money_cpeth`, `money_cpdoge`, `money_cpdash`, `money_cpxrp`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `db_user_data`
--

CREATE TABLE `db_user_data` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(80) CHARACTER SET utf8 NOT NULL,
  `date_reg` int(11) NOT NULL DEFAULT '0',
  `date_login` int(11) NOT NULL DEFAULT '0',
  `ip` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ip_reg` varchar(100) NOT NULL,
  `banned` int(1) NOT NULL DEFAULT '0',
  `salt` varchar(32) CHARACTER SET utf8 NOT NULL,
  `roots` int(2) NOT NULL DEFAULT '1',
  `refback` int(1) NOT NULL DEFAULT '0',
  `refback_percent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `db_user_data`
--

INSERT INTO `db_user_data` (`id`, `user`, `email`, `password`, `date_reg`, `date_login`, `ip`, `ip_reg`, `banned`, `salt`, `roots`, `refback`, `refback_percent`) VALUES
(1, 'igrok', 'dommoi27@gmail.com', 'PashkaSkat90', 1563112573, 1564824861, 0, '2956693172', 0, 'b573065ef591cf721deef554d3087359', 99, 0, 0),
(2, 'Allie', 'iamallexxs@mail.ru', 'FILLIZMon33', 1564066259, 1564066285, 1056543393, '1056543393', 0, 'f7ece593c8720f092327ecc35c5ca27f', 1, 0, 0),
(3, 'MonitorHP', 'monitoring.hp@yandex.ru', 'asdfgh', 1565450350, 1565450387, 0, '', 0, 'e26f8819de83512f48373671c3c62632', 1, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `db_user_referal`
--

CREATE TABLE `db_user_referal` (
  `id` int(11) NOT NULL,
  `user` varchar(15) NOT NULL,
  `referer1_id` int(11) NOT NULL DEFAULT '0',
  `referer2_id` int(11) NOT NULL DEFAULT '0',
  `referer3_id` int(11) NOT NULL DEFAULT '0',
  `referer4_id` int(11) NOT NULL DEFAULT '0',
  `referer5_id` int(11) NOT NULL DEFAULT '0',
  `referer1` varchar(15) NOT NULL DEFAULT '',
  `referer2` varchar(15) NOT NULL DEFAULT '',
  `referer3` varchar(15) NOT NULL DEFAULT '',
  `referer4` varchar(15) NOT NULL DEFAULT '',
  `referer5` varchar(15) NOT NULL DEFAULT '',
  `to_referer1` double NOT NULL DEFAULT '0',
  `to_referer2` double NOT NULL DEFAULT '0',
  `to_referer3` double NOT NULL DEFAULT '0',
  `to_referer4` double NOT NULL DEFAULT '0',
  `to_referer5` double NOT NULL DEFAULT '0',
  `all_to_referer` double NOT NULL DEFAULT '0',
  `from_referals1` double NOT NULL DEFAULT '0',
  `from_referals2` double NOT NULL DEFAULT '0',
  `from_referals3` double NOT NULL DEFAULT '0',
  `from_referals4` double NOT NULL DEFAULT '0',
  `from_referals5` double NOT NULL DEFAULT '0',
  `all_from_referals` double NOT NULL DEFAULT '0',
  `count_ref1` int(11) NOT NULL DEFAULT '0',
  `count_ref2` int(11) NOT NULL DEFAULT '0',
  `count_ref3` int(11) NOT NULL DEFAULT '0',
  `count_ref4` int(11) NOT NULL DEFAULT '0',
  `count_ref5` int(11) NOT NULL DEFAULT '0',
  `all_count_refs` int(44) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `db_user_referal`
--

INSERT INTO `db_user_referal` (`id`, `user`, `referer1_id`, `referer2_id`, `referer3_id`, `referer4_id`, `referer5_id`, `referer1`, `referer2`, `referer3`, `referer4`, `referer5`, `to_referer1`, `to_referer2`, `to_referer3`, `to_referer4`, `to_referer5`, `all_to_referer`, `from_referals1`, `from_referals2`, `from_referals3`, `from_referals4`, `from_referals5`, `all_from_referals`, `count_ref1`, `count_ref2`, `count_ref3`, `count_ref4`, `count_ref5`, `all_count_refs`) VALUES
(1, 'igrok', 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 'Allie', 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'MonitorHP', 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `db_user_wallets`
--

CREATE TABLE `db_user_wallets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(10) NOT NULL DEFAULT '',
  `value` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `db_config`
--
ALTER TABLE `db_config`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `db_cron`
--
ALTER TABLE `db_cron`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `db_deposits`
--
ALTER TABLE `db_deposits`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `db_earn`
--
ALTER TABLE `db_earn`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `db_insert`
--
ALTER TABLE `db_insert`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `db_limits`
--
ALTER TABLE `db_limits`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `db_news`
--
ALTER TABLE `db_news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `db_payment`
--
ALTER TABLE `db_payment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `db_paysystems`
--
ALTER TABLE `db_paysystems`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `db_percmonth`
--
ALTER TABLE `db_percmonth`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `db_plans`
--
ALTER TABLE `db_plans`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `db_recovery`
--
ALTER TABLE `db_recovery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `db_reviews`
--
ALTER TABLE `db_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `db_user_balance`
--
ALTER TABLE `db_user_balance`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `db_user_data`
--
ALTER TABLE `db_user_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `ip` (`ip`);

--
-- Индексы таблицы `db_user_referal`
--
ALTER TABLE `db_user_referal`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `db_user_wallets`
--
ALTER TABLE `db_user_wallets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `db_config`
--
ALTER TABLE `db_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `db_cron`
--
ALTER TABLE `db_cron`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `db_deposits`
--
ALTER TABLE `db_deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `db_earn`
--
ALTER TABLE `db_earn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `db_insert`
--
ALTER TABLE `db_insert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `db_limits`
--
ALTER TABLE `db_limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `db_news`
--
ALTER TABLE `db_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `db_payment`
--
ALTER TABLE `db_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `db_paysystems`
--
ALTER TABLE `db_paysystems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `db_percmonth`
--
ALTER TABLE `db_percmonth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `db_plans`
--
ALTER TABLE `db_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `db_recovery`
--
ALTER TABLE `db_recovery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `db_reviews`
--
ALTER TABLE `db_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `db_user_data`
--
ALTER TABLE `db_user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `db_user_wallets`
--
ALTER TABLE `db_user_wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
