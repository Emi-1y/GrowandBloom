-- Grow and Bloom — Example data export
-- Generated: 2026-05-17

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ------------------------------------------------------
-- Table: users
-- ------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `city`, `postal_code`, `role`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Emily Cardona', 'ecardonac2@eafit.edu.co', '3112345678', 'Calle 10 # 43-23, El Poblado', 'Medellín', '050021', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-01-15 10:00:00', '2026-01-15 10:00:00'),
(2, 'Carlos García', 'cgarcia@example.com', '3009876543', 'Carrera 65 # 45-12', 'Medellín', '050030', 'user', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-02-10 14:30:00', '2026-02-10 14:30:00'),
(3, 'María López', 'mlopez@example.com', '3154567890', 'Avenida El Poblado # 12-34', 'Medellín', '050021', 'user', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-03-05 09:15:00', '2026-03-05 09:15:00');

-- ------------------------------------------------------
-- Table: categories
-- ------------------------------------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Indoor Plants', 'Beautiful houseplants for interior decoration', '2026-01-10 08:00:00', '2026-01-10 08:00:00'),
(2, 'Seeds', 'Flower, vegetable and herb seeds', '2026-01-10 08:00:00', '2026-01-10 08:00:00'),
(3, 'Fertilizers', 'Organic and chemical fertilizers for all plant types', '2026-01-10 08:00:00', '2026-01-10 08:00:00'),
(4, 'Gardening Tools', 'Hand tools, watering cans and gardening accessories', '2026-01-10 08:00:00', '2026-01-10 08:00:00');

-- ------------------------------------------------------
-- Table: products
-- ------------------------------------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `exclusive` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `color` varchar(255) NOT NULL,
  `discount` int NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `stock` int NOT NULL DEFAULT '0',
  `category_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`id`, `name`, `size`, `brand`, `price`, `exclusive`, `image`, `description`, `color`, `discount`, `active`, `stock`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'White Phalaenopsis Orchid', '15cm pot', 'Raíces', 85000, 1, 'orchid-white.jpg', 'Elegant white orchid, perfect for bright interiors. Easy care.', 'White', 0, 1, 12, 1, '2026-01-12 10:00:00', '2026-01-12 10:00:00'),
(2, 'Monstera Deliciosa', '25cm pot', 'TerraVerde', 65000, 0, 'monstera.jpg', 'Tropical plant with iconic split leaves. Air purifying.', 'Dark green', 10, 1, 8, 1, '2026-01-12 10:00:00', '2026-01-12 10:00:00'),
(3, 'Sunflower Seeds Mix', '50g packet', 'SeedPro', 12000, 0, 'sunflower-seeds.jpg', 'Giant sunflower mix. 95% germination rate.', 'Yellow / Brown', 0, 1, 45, 2, '2026-01-12 10:00:00', '2026-01-12 10:00:00'),
(4, 'Organic Tomato Seeds', '20g packet', 'SeedPro', 8500, 0, 'tomato-seeds.jpg', 'Heirloom cherry tomato variety. High yield.', 'Red', 0, 1, 60, 2, '2026-01-12 10:00:00', '2026-01-12 10:00:00'),
(5, 'All-Purpose Liquid Fertilizer', '500ml', 'GreenGrow', 18000, 0, 'fertilizer-liquid.jpg', 'Balanced NPK 10-10-10 formula for all plant types.', 'Clear', 0, 1, 30, 3, '2026-01-12 10:00:00', '2026-01-12 10:00:00'),
(6, 'Worm Compost', '2kg bag', 'EcoSoil', 22000, 0, 'worm-compost.jpg', '100% organic worm castings. Rich in nutrients.', 'Brown', 0, 1, 20, 3, '2026-01-12 10:00:00', '2026-01-12 10:00:00'),
(7, 'Stainless Steel Pruning Shears', 'Standard', 'GardenMaster', 35000, 0, 'pruning-shears.jpg', 'Professional bypass pruner with ergonomic grip.', 'Silver', 15, 1, 18, 4, '2026-01-12 10:00:00', '2026-01-12 10:00:00'),
(8, 'Copper Watering Can', '2L', 'GardenMaster', 28000, 0, 'watering-can.jpg', 'Vintage style copper watering can with rose head.', 'Copper', 0, 1, 10, 4, '2026-01-12 10:00:00', '2026-01-12 10:00:00');

-- ------------------------------------------------------
-- Table: services
-- ------------------------------------------------------
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `employee` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` int NOT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `emoji` varchar(255) NOT NULL DEFAULT '🌿',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `features` json DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `services` (`id`, `name`, `employee`, `description`, `price`, `duration`, `emoji`, `active`, `features`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Garden Maintenance', 'Juan Pérez', 'Complete garden upkeep including mowing, pruning and fertilization.', 120000, '2–4 hours', '🌿', 1, '["Lawn mowing and edging", "Shrub pruning", "Seasonal fertilization", "Weed control"]', 'garden-maintenance.jpg', '2026-01-12 10:00:00', '2026-01-12 10:00:00'),
(2, 'Landscape Design', 'Ana Torres', 'Custom garden design and layout planning for your space.', 450000, '1–2 weeks', '🌿', 1, '["Site assessment and measurement", "Custom design proposal", "Plant selection guide", "Installation supervision"]', 'landscape-design.jpg', '2026-01-12 10:00:00', '2026-01-12 10:00:00'),
(3, 'Plant Health Check', 'Luis Rodríguez', 'Expert diagnosis of plant diseases, pests and nutrient deficiencies.', 85000, '1–2 hours', '🌿', 1, '["Visual inspection of all plants", "Soil pH and nutrient test", "Pest and disease identification", "Treatment recommendation report"]', 'plant-health.jpg', '2026-01-12 10:00:00', '2026-01-12 10:00:00');

-- ------------------------------------------------------
-- Table: orders
-- ------------------------------------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `total` int NOT NULL DEFAULT '0',
  `payment_method` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `orders` (`id`, `total`, `payment_method`, `date`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 113500, 'card', '2026-03-10', 'paid', 2, '2026-03-10 14:30:00', '2026-03-10 14:30:00'),
(2, 28000, 'cash', '2026-03-15', 'shipped', 3, '2026-03-15 09:00:00', '2026-03-15 09:00:00');

-- ------------------------------------------------------
-- Table: items
-- ------------------------------------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  `item_type` varchar(255) NOT NULL DEFAULT 'product',
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `service_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `items_order_id_foreign` (`order_id`),
  KEY `items_product_id_foreign` (`product_id`),
  KEY `items_service_id_foreign` (`service_id`),
  CONSTRAINT `items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  CONSTRAINT `items_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `items` (`id`, `quantity`, `price`, `item_type`, `order_id`, `product_id`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 1, 85000, 'product', 1, 1, NULL, '2026-03-10 14:30:00', '2026-03-10 14:30:00'),
(2, 1, 120000, 'service', 1, NULL, 1, '2026-03-10 14:30:00', '2026-03-10 14:30:00'),
(3, 2, 12000, 'product', 2, 3, NULL, '2026-03-15 09:00:00', '2026-03-15 09:00:00'),
(4, 1, 28000, 'product', 2, 8, NULL, '2026-03-15 09:00:00', '2026-03-15 09:00:00');

-- ------------------------------------------------------
-- Table: reviews
-- ------------------------------------------------------
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rating` int NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `product_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_product_id_foreign` (`product_id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `reviews` (`id`, `rating`, `comment`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 5, 'Beautiful orchid, arrived in perfect condition. Highly recommended!', 1, 2, '2026-03-12 10:00:00', '2026-03-12 10:00:00'),
(2, 4, 'Great seeds, almost all germinated. Will buy again.', 3, 3, '2026-03-18 11:00:00', '2026-03-18 11:00:00');

SET FOREIGN_KEY_CHECKS = 1;
