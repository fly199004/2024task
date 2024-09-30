CREATE TABLE IF NOT EXISTS `users` (
  `id` VARCHAR(36) PRIMARY KEY DEFAULT (UUID()),
  `username` VARCHAR(50) UNIQUE NOT NULL,
  `email` VARCHAR(50) UNIQUE NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `profile_path` VARCHAR(100),
  `current_ub_housing` VARCHAR(100),
  `number_of_likes` INT DEFAULT 0,
  `is_verified` BOOLEAN DEFAULT false,
  `verification_code` VARCHAR(50),
  `created_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE IF NOT EXISTS `dorms` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `picture_path` VARCHAR(100) NOT NULL,
  `total_review` INT DEFAULT 0,
  `average_rating` FLOAT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` VARCHAR(36) PRIMARY KEY DEFAULT (UUID()),
  `user_id` VARCHAR(36),
  `dorm_id` INT,
  `description` TEXT NOT NULL,
  `rating` FLOAT NOT NULL,
  `likes` INT DEFAULT 0,
  `picture_path` VARCHAR(255),
  `created_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP)
);

ALTER TABLE `reviews` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

ALTER TABLE `reviews` ADD FOREIGN KEY (`dorm_id`) REFERENCES `dorms` (`id`) ON DELETE CASCADE;

INSERT INTO `dorms`(`name`, `picture_path`) VALUES ('Wilkeson','wilkeson.jpg');
INSERT INTO `dorms`(`name`, `picture_path`) VALUES ('Spaulding','spaulding.jpg');
INSERT INTO `dorms`(`name`, `picture_path`) VALUES ('Governors','governors.jpg');

-- ALL TRIGGERS 

DELIMITER $$

-- Trigger 1: Update the number_of_likes in the `users` table after a review's likes are updated
CREATE TRIGGER update_user_number_of_likes
AFTER UPDATE ON `reviews`
FOR EACH ROW
BEGIN
  -- Check if the `likes` column was updated
  IF NEW.likes <> OLD.likes THEN
    -- Update the `number_of_likes` in the corresponding user row
    UPDATE `users`
    SET `number_of_likes` = `number_of_likes` + (NEW.likes - OLD.likes)
    WHERE `id` = NEW.user_id;
  END IF;
END$$

-- Trigger 2: Update the total_review count in the `dorms` table after a new review is added
CREATE TRIGGER update_dorm_review_count
AFTER INSERT ON `reviews`
FOR EACH ROW
BEGIN
  -- Increment the `total_review` in the `dorms` table
  UPDATE `dorms`
  SET `total_review` = `total_review` + 1
  WHERE `id` = NEW.dorm_id;
END$$

-- Trigger 3: Decrement the total_review count in the `dorms` table after a review is removed
CREATE TRIGGER decrement_dorm_review_count
AFTER DELETE ON `reviews`
FOR EACH ROW
BEGIN
  -- Decrement the total_review count for the corresponding dorm
  UPDATE `dorms`
  SET `total_review` = `total_review` - 1
  WHERE `id` = OLD.dorm_id;
END$$

-- Trigger 4: Update the average rating in the dorms table once a new review is added with new rating
CREATE TRIGGER update_dorm_average_rating
AFTER INSERT ON `reviews`
FOR EACH ROW
BEGIN
  -- Update the average_rating for the dorm after a new review is added
  UPDATE `dorms`
  SET `average_rating` = (
    -- Calculate the new average rating
    (SELECT SUM(rating) FROM `reviews` WHERE `dorm_id` = NEW.dorm_id) / 
    (SELECT COUNT(*) FROM `reviews` WHERE `dorm_id` = NEW.dorm_id)
  )
  WHERE `id` = NEW.dorm_id;
END$$

DELIMITER ;



