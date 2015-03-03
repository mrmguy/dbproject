
CREATE TABLE grape (
	id INT AUTO_INCREMENT PRIMARY KEY,
	grape_name VARCHAR(50) NOT NULL UNIQUE,
	color VARCHAR(50)
	) ENGINE = innodb;

CREATE TABLE region (
	id INT AUTO_INCREMENT PRIMARY KEY,
	region VARCHAR(255),
	climate VARCHAR(255),
	production INT,
	origin_date YEAR,
	grape_id INT,
	FOREIGN KEY (grape_id) REFERENCES grape(id)
	) ENGINE = innodb;

CREATE TABLE flavors (
	id INT AUTO_INCREMENT PRIMARY KEY,
	flavor VARCHAR(50) NOT NULL UNIQUE,
	description TEXT
	) ENGINE = innodb;

CREATE TABLE food (
	id INT AUTO_INCREMENT PRIMARY KEY,
	food_item VARCHAR(255)
	) ENGINE = innodb;

-- CREATE TABLE grape_region (
-- 	id INT AUTO_INCREMENT PRIMARY KEY,
-- 	grape_id INT,
-- 	region_id INT,
-- 	FOREIGN KEY (grape_id) REFERENCES grape(id),
-- 	FOREIGN KEY (region_id) REFERENCES region(id)
-- 	) ENGINE = innodb;

CREATE TABLE grape_flavor (
	id INT AUTO_INCREMENT PRIMARY KEY,
	grape_id INT,
	flavor_id INT,
	FOREIGN KEY (grape_id) REFERENCES grape(id),
	FOREIGN KEY (flavor_id) REFERENCES flavors(id)
	) ENGINE = innodb;

CREATE TABLE grape_food (
	id INT AUTO_INCREMENT PRIMARY KEY,
	grape_id INT,
	food_id INT,
	FOREIGN KEY (grape_id) REFERENCES grape(id),
	FOREIGN KEY (food_id) REFERENCES food(id)
	) ENGINE = innodb;

CREATE TABLE genetic (
	id INT AUTO_INCREMENT PRIMARY KEY,
	parent_id INT,
	child_id INT,
	FOREIGN KEY (parent_id) REFERENCES grape(id),
	FOREIGN KEY (child_id) REFERENCES grape(id)
	) ENGINE = innodb;
