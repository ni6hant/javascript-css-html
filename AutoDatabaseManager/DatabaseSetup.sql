create database misc;
GRANT ALL ON misc.* TO 'fred'@'localhost' IDENTIFIED BY 'zap';
GRANT ALL ON misc.* TO 'fred'@'127.0.0.1' IDENTIFIED BY 'zap';

-- Inside misc table
CREATE TABLE autos (
auto_id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
make VARCHAR(128),
year INTEGER,
mileage INTEGER
);