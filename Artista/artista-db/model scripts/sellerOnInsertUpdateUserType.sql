CREATE DEFINER = CURRENT_USER TRIGGER `artista`.`seller_AFTER_INSERT` AFTER INSERT ON `seller` FOR EACH ROW
BEGIN
	UPDATE `artista`.`user` SET `type` = 1 WHERE `id`= NEW.id;
END
