-- Adminer 4.8.1 MySQL 11.2.2-MariaDB-1:11.2.2+maria~ubu2204 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `box`;
CREATE TABLE `box` (
  `id` varchar(128) NOT NULL,
  `token` varchar(64) NOT NULL,
  `libelle` varchar(128) NOT NULL,
  `description` text DEFAULT NULL,
  `montant` decimal(12,2) DEFAULT 0.00,
  `kdo` tinyint(4) NOT NULL DEFAULT 0,
  `message_kdo` text DEFAULT '',
  `statut` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime DEFAULT NULL,
  `createur_id` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO `box` (`id`, `token`, `libelle`, `description`, `montant`, `kdo`, `message_kdo`, `statut`, `created_at`, `updated_at`, `createur_id`) VALUES
('360bb4cc-e092-3f00-9eae-774053730cb2',	'twmyDtNlmtC0hsxZ6fEw0+maTTfrDEqNH0gjBhTo3BI=',	'quos dolorem libero',	'Quisquam a eaque eum ipsa est est. Nemo eveniet dolorum nisi. Voluptatem dolores veritatis tempore unde recusandae. Numquam at qui odio voluptas inventore non vel.',	173.00,	1,	'Sit omnis in ut rerum. Odit exercitationem et omnis voluptatum aut numquam rerum. Explicabo dolor corrupti similique exercitationem et accusantium voluptas.',	5,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c025060-305b-4e47-aa94-313cdc1381f8'),
('6cc74b9f-43bc-3f63-a9c4-9158ad83f379',	'3UWreyfDfcLHNiduEVuyrs1JuGY079K+ofIB0oBqttE=',	'eum quasi qui',	'Vel voluptatum veritatis aperiam omnis ad neque est. Temporibus quis et molestiae aut et nesciunt. Quis occaecati architecto quo consequatur reprehenderit aperiam quidem vel. Eum et et omnis.',	40.00,	1,	'Quaerat sit assumenda facere. Cum ut et iste deserunt corporis quidem aliquid. Suscipit ducimus qui dolores omnis delectus suscipit. Aliquid eius reiciendis omnis assumenda illo autem velit.',	2,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c025060-ab42-413d-a32c-c45845d3f98d'),
('24fc3203-dbd0-3b61-801f-2f552b50603f',	'f0Y+tv5+JW0moZCzr/HzgYyKNsxQWyg9WMCoZyV9O3w=',	'sit dolor consectetur',	'Quasi reiciendis et architecto sunt excepturi est non. Maxime suscipit tenetur perspiciatis amet voluptatem eos est. Cum eveniet minus consectetur excepturi placeat.',	160.00,	0,	'',	3,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c025060-6e27-4ae4-9103-89443a25b44c'),
('673d04b1-4878-38cf-9204-adbe6474a9a4',	'vjNlzSOpOgARgrwgZ4U39uMdDjhutIdXeHaazdZpAVA=',	'et repudiandae ut',	'Consequatur doloremque quod non eveniet natus placeat. Accusantium necessitatibus id aliquid tenetur facere. Similique dolor est commodi alias enim beatae id incidunt. Eius eius eligendi ab magni ut impedit voluptatem.',	424.00,	0,	'',	5,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c025060-6e27-4ae4-9103-89443a25b44c'),
('06acee62-6b8f-33b4-b67f-76a11c45b111',	'HPUEAIaDIc/lNpuo5qe6LlJaJzQ3DFTu1WRV/EQJaDI=',	'reprehenderit possimus nemo',	'Quia sequi est similique corrupti ab perspiciatis repellendus. Sit quibusdam enim libero blanditiis nostrum ducimus. Ea rem dolorem magnam veritatis. Necessitatibus qui occaecati iusto ut pariatur assumenda sit sunt. Eum itaque et est rerum eum perferendis fuga possimus.',	112.00,	0,	'',	5,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c025060-44d1-44f9-8899-bf0ffb6252a1'),
('f4002ad4-1151-38b8-a584-48c4fb5d7a5a',	'EltjqTsjUGpLt4043NBP99ccIc+SFfQXitoHauxW1aA=',	'et autem placeat',	'Est ipsa autem esse labore qui inventore in. Laudantium enim facere sunt ea amet quae. Eum consequatur fuga ut a.',	244.00,	0,	'',	3,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c025060-305b-4e47-aa94-313cdc1381f8'),
('74ecb7c6-3375-3044-a1f3-fd27d931c9af',	'mjre56n/LnCrwUwiq4ZJuJOrFHhPCZi6oCQ2whAtljE=',	'magnam delectus voluptate',	'Inventore omnis aut deserunt labore aut id. Et eum rem harum modi omnis officia eum. Veniam numquam iste autem et qui possimus sunt animi.',	174.00,	0,	'',	2,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c025060-0806-4d3b-a3c9-449356581916'),
('1e7bab49-ddb5-301b-9fd1-5f2c2f499052',	'YMllERSG9L/JFH02Dw2oB69nQoHGHsqWSvQSu94mgSc=',	'officiis qui sint',	'Deleniti dolor quae repellat et. Ducimus voluptates rerum sequi omnis fuga aspernatur. Non praesentium sunt qui voluptatem omnis. Dolorem vitae eum ad nemo est odio.',	197.00,	0,	'',	4,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c025060-d3f4-4f24-9df4-5c2cff4307a3'),
('1d2b0679-bde9-313a-aab8-47618b21219b',	'kCqQ1Vbd0cSlVtN+kmmOmuF8iC29Ylf4AlUXIzK3LqM=',	'reiciendis est quasi',	'Autem non nulla saepe. Consequatur amet est saepe est dignissimos. Temporibus quasi harum repudiandae atque excepturi quo.',	505.00,	0,	'',	2,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c02505f-af68-4b51-a5b6-e52b1805eee1'),
('085c7346-25c4-3fe1-b485-34482c28badd',	'yuGnXxfjEFzPzZLaSPIUQbY0rvz3sXTXG9uliZKrsHs=',	'ab exercitationem modi',	'Sed illo porro natus excepturi maiores. Architecto saepe occaecati ea tenetur ratione culpa doloribus. Et aliquam aut vel soluta.',	171.00,	1,	'Saepe explicabo ut non aut quibusdam et. Quasi facere ab qui assumenda dolorem. Modi est ut praesentium.',	2,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c02505f-af68-4b51-a5b6-e52b1805eee1'),
('ee8c1097-7737-35ba-aee7-a01d623f00c9',	'qT8jbUwPmXInAW7icvHn63k6msS5TUUUOnRb6IUa+qk=',	'velit minus nihil',	'Voluptatem cupiditate asperiores dolorem sunt illum. Asperiores minus error vel ut nulla.',	532.00,	0,	'',	5,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c025060-5981-4cd7-82ea-6eb04c5ad86a'),
('fa359b10-322a-3f5d-94d2-9b4309d17bed',	'McNnLT1AuCyERcxOGG3K8WUeHsnh+gc1jhL37Oxf+o4=',	'sunt molestiae ut',	'Dignissimos maxime eligendi quibusdam aspernatur quisquam occaecati. Odio et voluptatem perspiciatis asperiores. Totam vel eos nam est.',	448.00,	0,	'',	4,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c02505f-c747-45ef-aedd-99e03e3e7e49'),
('6508685e-f50f-3f28-b2a0-5c8f89ccc6da',	'HDJmnQaMUvq5JxcdXVw1yByHUSx4uVb+3QvhbGa9CtE=',	'ea nihil ad',	'Doloremque officia eum libero modi id. Animi voluptas sunt sit laboriosam autem repudiandae. Sint ex a quia tempore et aspernatur commodi.',	310.00,	0,	'',	3,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c025060-305b-4e47-aa94-313cdc1381f8'),
('cc1e57ad-6088-3c76-a549-3ffd91584e8c',	'azILq200m6DFANy4uFuck2CsGCmGXRzU78XyU4enBVs=',	'unde itaque fuga',	'Commodi cumque qui distinctio alias accusamus autem. Consequatur quod qui sed sint illo. Ut beatae eum perspiciatis nesciunt nulla quia ea. Perferendis ut omnis sunt autem.',	195.00,	1,	'Id voluptatem possimus provident ut et. Sequi consequuntur eaque commodi quo reiciendis minima sequi. Laboriosam aperiam voluptate et aut distinctio iure. Quidem dolor sed et earum.',	1,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c025060-1c21-4c30-8c81-879a11a19c76'),
('91ffe968-97d3-3f41-a01c-20a5b10578ca',	'iTx3URmDgd8lH4toWJfUH9XTfUrXXhzhS5HgiK2U9aU=',	'repudiandae incidunt qui',	'Soluta dicta eos corrupti est eveniet fuga qui beatae. Qui qui iure libero maiores. Dolor qui voluptate a nisi magnam fugiat nobis delectus.',	63.00,	1,	'Eos odit est eum vitae esse. Ex fugit et harum est molestias. Accusantium aperiam facere molestias dolores hic. Voluptatem omnis totam iure sint esse.',	5,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c025060-d3f4-4f24-9df4-5c2cff4307a3'),
('084197a0-1297-3a87-815d-368ef3262c41',	'9eZYVii3cbH1l4tJm4gQq416xpy4cbKY5b94EmVA52A=',	'velit repellendus fugiat',	'Ea beatae ad at culpa vel. Est rem est fugit sed laborum. Illo quidem maxime culpa eligendi praesentium et.',	120.00,	0,	'',	3,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c025060-d3f4-4f24-9df4-5c2cff4307a3'),
('652f39a2-2b18-322e-a4fb-240c6eb95474',	'/c+T0cm+O9GRftyTQKoPatH+iEvELfvvXl1J663s4zw=',	'officiis et sunt',	'Amet eligendi sed sint culpa consequatur rerum fugiat. Dolorem officiis maxime neque et commodi sint omnis et.',	329.00,	0,	'',	3,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c025060-828e-4660-a196-17deb7d405a0'),
('40754dbc-edda-30c0-ba73-856668e210fc',	'bK5rpyBhLc4shd6p7v5CtFrNjf5n1t7ybdhcPUgWGN4=',	'omnis similique necessitatibus',	'Sint est aspernatur recusandae officia vel temporibus incidunt unde. Quibusdam est minus quia recusandae facilis ut laborum. Minima tempore rerum sed fugiat reiciendis officiis aut. Ipsa odio et provident ipsum qui eos et.',	191.00,	1,	'Quam sed nobis nobis sint quaerat. Similique aut quis explicabo praesentium voluptas qui quia quasi.',	4,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c025060-5981-4cd7-82ea-6eb04c5ad86a'),
('a35af8c0-8d9d-3a76-bae0-23fec63f9ede',	'IU8FuBpwCEH5KQ3++eAWmYHTkj8VG16qpCH3ONBaebw=',	'ut id blanditiis',	'Quia molestiae assumenda dolores et illum qui. Laboriosam dignissimos culpa magnam accusantium. Et provident explicabo deserunt eius odio.',	147.00,	1,	'Quo dicta ullam quia dolore hic temporibus. Quaerat doloribus nemo debitis dolor pariatur.',	4,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c025060-6e27-4ae4-9103-89443a25b44c'),
('99257e49-5346-3e2a-a544-57bc2d203e99',	'Vrtk9CtV5cspNps++KSePuwSqs2k9hiU41hsQnvrFyA=',	'unde corrupti non',	'Animi vel ea rem sed vel. Quas accusantium quibusdam in dolorem asperiores veniam magni. Deserunt qui quis sunt.',	250.00,	1,	'Consequuntur natus nemo amet ipsum. Quaerat quo qui vero qui incidunt ipsam culpa. Est ipsam dolorum voluptatem mollitia. Inventore occaecati est ipsum rem adipisci repellat ab quae.',	5,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c025060-bfb8-4eef-a517-17df4f0ccc67'),
('1ca33455-6c2c-3980-9860-d30f660f8e84',	'UL/6teWxGluzyMaZfYYY4RLtd3uVnRwcBfpfaLbwvUA=',	'vel adipisci aut',	'Rerum dicta architecto enim maxime ea. Laborum officia dignissimos amet qui. Culpa provident cupiditate eaque iste cum non.',	46.00,	0,	'',	1,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c02505f-db7f-45c3-b89c-88c34da9874a'),
('d407e6f6-5520-3803-95ad-ed77c86757a3',	'dY9nek1mwd6NtHy53gJYtSuJwTTtTt+fdlXiIvmxfUY=',	'consectetur inventore eaque',	'Doloribus est porro neque explicabo quidem perferendis. Blanditiis libero rerum voluptas sit quis ut atque corrupti. Et libero nobis pariatur reprehenderit. Soluta quis qui aliquid eius nihil.',	390.00,	0,	'',	5,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c025060-6e27-4ae4-9103-89443a25b44c'),
('244898ea-6eb0-3146-aa70-e06f8236ad05',	'UD+2h4uvh21ClLbN0ZMRm1whEGylxSMKqvtakozimPs=',	'eos occaecati ut',	'Sed nihil id possimus tenetur labore id enim. Consequatur molestiae dignissimos assumenda eveniet eos velit voluptatem. Quas vero placeat dolorem aperiam.',	155.00,	1,	'Et deleniti molestiae nam rerum quo. Laboriosam accusamus eligendi officiis assumenda distinctio. Enim culpa dolorem explicabo ex ex animi.',	1,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c02505f-c747-45ef-aedd-99e03e3e7e49'),
('2903170b-963c-3836-ad51-12732309f360',	'fphoLEPK+4xwuy8lu1z7zX1ZMZzozjjSorQMSg1hTJE=',	'perferendis sapiente qui',	'Hic nihil cupiditate et quo ut omnis et cum. Assumenda modi animi et quia. In et expedita voluptatem pariatur a.',	114.00,	0,	'',	5,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c02505f-db7f-45c3-b89c-88c34da9874a'),
('9c08ccf0-ca74-40cc-ba7c-b36110101360',	'OTYzYNVZo6OOhucGes0/O2KUZgH2ed5S5CkooEQ0Qk0=',	'soirée romantique',	'une belle soirée romantique ',	0.00,	1,	'bon anniv ma poulette',	1,	'2024-05-14 13:28:00',	'2024-05-14 13:28:00',	'9c025060-bfb8-4eef-a517-17df4f0ccc67'),
('9c0ac7b7-37ac-4e06-bed3-c031ef6e7774',	'b88d9b8a636e3bfa186f5fe424f188a1',	'libelle de la bobox',	'description de la bobox',	0.00,	0,	NULL,	1,	'2024-05-14 15:39:02',	'2024-05-14 15:39:02',	NULL),
('9c0ac988-bda4-4180-b9d6-f01ef6d1d2fd',	'a563f08c152e6c31e7a141a7ce155bbc',	'libelle de la bobox',	'description de la bobox',	0.00,	0,	NULL,	1,	'2024-05-14 15:44:07',	'2024-05-14 15:44:07',	NULL);

DROP TABLE IF EXISTS `box2presta`;
CREATE TABLE `box2presta` (
  `box_id` varchar(128) NOT NULL,
  `presta_id` varchar(128) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;


DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(128) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;


DROP TABLE IF EXISTS `prestation`;
CREATE TABLE `prestation` (
  `id` varchar(128) NOT NULL,
  `libelle` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(256) DEFAULT NULL,
  `unite` varchar(128) DEFAULT NULL,
  `tarif` decimal(10,2) NOT NULL,
  `img` varchar(128) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;


SET NAMES utf8mb4;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` varchar(40) NOT NULL,
  `user_id` varchar(128) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `role` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_pk2` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- 2024-05-15 08:28:21
