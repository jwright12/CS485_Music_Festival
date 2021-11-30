CREATE DATABASE music_festival;
USE music_festival;
SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE IF NOT EXISTS user (
	user_id int NOT NULL AUTO_INCREMENT,
	f_name varchar(30) NOT NULL,
	l_name varchar(30) NOT NULL,
	username varchar(20) NOT NULL,
	user_password varchar(20) NOT NULL,
    PRIMARY KEY (user_id) 
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS user_phone (
	user_id int NOT NULL,
	phone varchar(20) NOT NULL,
	FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS user_email (
	user_id int NOT NULL,
	email varchar(20) NOT NULL,
	FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS artist (
	artist_id int,
	FOREIGN KEY (artist_id) REFERENCES user(user_id) ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS administrator (
	admin_id int,
	FOREIGN KEY (admin_id) REFERENCES user(user_id) ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS customer (
	customer_id int,
	FOREIGN KEY (customer_id) REFERENCES user(user_id) ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS band (
	band_id int NOT NULL AUTO_INCREMENT,
    band_name varchar(20) NOT NULL,
	PRIMARY KEY (band_id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS form_band (
	band_id int NOT NULL,
    artist_id int NOT NULL,
    PRIMARY KEY (band_id, artist_id),
	FOREIGN KEY (band_id) REFERENCES band(band_id),
    FOREIGN KEY (artist_id) REFERENCES artist(artist_id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS songs (
	song_id int NOT NULL AUTO_INCREMENT,
    song_name varchar(20) NOT NULL,
    album_name varchar(20) NOT NULL,
    band_id int,
	PRIMARY KEY (song_id),
    FOREIGN KEY (band_id) REFERENCES band(band_id)    
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS set_list (
	set_list_id int NOT NULL,
    song_id int NOT NULL,
    PRIMARY KEY (set_list_id, song_id),
    FOREIGN KEY (song_id) REFERENCES songs(song_id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS performance (
	performance_id int NOT NULL AUTO_INCREMENT,
    band_id int NOT NULL,
    set_list_id int NOT NULL,
    PRIMARY KEY (performance_id),
    FOREIGN KEY (band_id) REFERENCES band(band_id),
    FOREIGN KEY (set_list_id) REFERENCES set_list(set_list_id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS schedule (
	schedule_id int NOT NULL AUTO_INCREMENT,
    created_by int NOT NULL,
    created_on datetime NOT NULL,
    PRIMARY KEY (schedule_id),
    FOREIGN KEY (created_by) REFERENCES administrator(admin_id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS scheduled_performance (
	schedule_id int NOT NULL,
    performance_id int NOT NULL,
    start_time datetime NOT NULL,
    PRIMARY KEY (schedule_id, performance_id, start_time),
    FOREIGN KEY (schedule_id) REFERENCES schedule(schedule_id),
	FOREIGN KEY (performance_id) REFERENCES performance(performance_id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS festival (
	festival_id int NOT NULL AUTO_INCREMENT,
    festival_name varchar(20) NOT NULL,
    festival_date datetime NOT NULL,
    location varchar(20) NOT NULL,
    schedule_id int NOT NULL,
    created_by int NOT NULL,
    created_on datetime NOT NULL,
	PRIMARY KEY (festival_id),
    FOREIGN KEY (schedule_id) REFERENCES schedule(schedule_id),
    FOREIGN KEY (created_by) REFERENCES administrator(admin_id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS ticket (
	ticket_id int NOT NULL AUTO_INCREMENT,
    price int NOT NULL,
    quant int NOT NULL,
    festival_id int NOT NULL,
    created_by int NOT NULL,
    created_on datetime NOT NULL,
	PRIMARY KEY (ticket_id),
    FOREIGN KEY (festival_id) REFERENCES festival(festival_id),
    FOREIGN KEY (created_by) REFERENCES administrator(admin_id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS customer_purchases (
	customer_id int NOT NULL,
    ticket_id int NOT NULL,
    festival_id int NOT NULL,
    order_total int NOT NULL,
    order_date datetime NOT NULL,
    PRIMARY KEY (customer_id, ticket_id, order_date),
    FOREIGN KEY (customer_id) REFERENCES customer(customer_id),
    FOREIGN KEY (ticket_id) REFERENCES ticket(ticket_id),
    FOREIGN KEY (festival_id) REFERENCES ticket(festival_id)
) ENGINE=InnoDB;



