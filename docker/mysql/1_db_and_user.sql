-- The Database
CREATE DATABASE cake_cms DEFAULT CHARACTER SET = utf8mb4;

-- The Database for Unit Test
CREATE DATABASE cake_cms_test DEFAULT CHARACTER SET = utf8mb4;

-- The password of root
-- Ideally we want to specify this via environment variable.
-- Unfortunately, earlier versions of PHP7 does not support "caching_sha2_password".
-- Therefore, it's better to use "native_password"
-- This repository uses "native_password" by executing "ALTER USER"
-- see https://github.com/phpmyadmin/phpmyadmin/issues/14220
-- see https://stackoverflow.com/questions/49948350/phpmyadmin-on-mysql-8-0
-- see https://www.php.net/manual/en/mysqli.requirements.php
ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'root';

-- The user "readonly"
CREATE USER 'readonly'@'%' IDENTIFIED WITH mysql_native_password BY 'readonly';
GRANT SELECT ON *.* TO 'readonly'@'%';
