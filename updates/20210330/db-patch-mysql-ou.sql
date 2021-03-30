ALTER TABLE `devices` ADD `device_model_id` INT NULL DEFAULT NULL AFTER `device_type`;
ALTER TABLE `User_auth` ADD `device_model_id` INT NULL DEFAULT NULL AFTER `month_quota`;
ALTER TABLE `OU` ADD `nagios_template` VARCHAR(50) NULL DEFAULT NULL AFTER `nagios_dir`, ADD `nagios_ping` BOOLEAN NOT NULL DEFAULT TRUE AFTER `nagios_template`;
ALTER TABLE `OU` ADD `nagios_default_service` VARCHAR(100) NOT NULL DEFAULT 'local-service' AFTER `nagios_ping`;
UPDATE `OU` SET `ou_name` = '!Всё' WHERE `OU`.`id` = 0;
UPDATE `OU` SET `nagios_template` = 'voip' WHERE `OU`.`id` = 4;
UPDATE `OU` SET `nagios_template` = 'generic-host' WHERE `OU`.`id` = 0;
UPDATE `OU` SET `nagios_ping` = '0' WHERE `OU`.`id` = 5;
UPDATE `OU` SET `nagios_template` = 'ip-cam' WHERE `OU`.`id` = 5;
UPDATE `OU` SET `nagios_default_service` = 'printer-service' WHERE `OU`.`id` = 6;
UPDATE `OU` SET `nagios_template` = 'printers' WHERE `OU`.`id` = 6;
UPDATE `OU` SET `nagios_template` = 'switches' WHERE `OU`.`id` = 7;
UPDATE `OU` SET `nagios_template` = 'ups' WHERE `OU`.`id` = 8;
UPDATE `OU` SET `nagios_template` = 'security' WHERE `OU`.`id` = 9;
UPDATE `OU` SET `nagios_template` = 'routers' WHERE `OU`.`id` = 10;
UPDATE `OU` SET `nagios_template` = 'ap' WHERE `OU`.`id` = 12;
