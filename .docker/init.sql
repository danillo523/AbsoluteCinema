CREATE USER 'admin'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON absolute_cinema.* TO 'admin'@'%';
FLUSH PRIVILEGES;

