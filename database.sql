DROP DATABASE IF EXISTS OMNESBOX;
CREATE DATABASE OMNESBOX;
USE OMNESBOX;

DROP TABLE IF EXISTS account;
DROP TABLE IF EXISTS activity;
DROP TABLE IF EXISTS omnesbox;
DROP TABLE IF EXISTS activity_offer;
DROP TABLE IF EXISTS box_offer;
DROP TABLE IF EXISTS in_cart;
DROP TABLE IF EXISTS purchase;
DROP TABLE IF EXISTS to_offer;
DROP TABLE IF EXISTS possession;
DROP TABLE IF EXISTS used;

CREATE TABLE account(
    email VARCHAR(40) NOT NULL PRIMARY KEY,
    last_name VARCHAR(30) NOT NULL,
    first_name VARCHAR(30),
    account_password VARCHAR(30) NOT NULL,
    account_type ENUM("admin","partner","user")
);

CREATE TABLE activity(
    activity_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    activity_title VARCHAR(40) NOT NULL,
    activity_content TEXT NOT NULL
);

CREATE TABLE omnesbox(
    box_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    box_title TEXT NOT NULL,
    activity_id INT NOT NULL,
    CONSTRAINT FK1 FOREIGN KEY (activity_id) REFERENCES activity(activity_id)
);

CREATE TABLE activity_offer(
    partner_email VARCHAR(40) NOT NULL,
    activity_id INT NOT NULL,
    CONSTRAINT FK2 FOREIGN KEY (partner_email) REFERENCES account(email),
    CONSTRAINT FK3 FOREIGN KEY (activity_id) REFERENCES activity(activity_id),
    PRIMARY KEY(partner_email,activity_id)
);

CREATE TABLE box_offer(
    partner_email VARCHAR(40) NOT NULL,
    box_id INT NOT NULL,
    box_content TEXT NOT NULL,
    box_price FLOAT(8,2) NOT NULL,
    CONSTRAINT FK4 FOREIGN KEY (partner_email) REFERENCES account(email),
    CONSTRAINT FK5 FOREIGN KEY (box_id) REFERENCES omnesbox(box_id),
    PRIMARY KEY(partner_email,box_id)
);

CREATE TABLE in_cart(
    user_email VARCHAR(40) NOT NULL,
    box_id INT NOT NULL,
    chosen_partner_email VARCHAR(40) NOT NULL,
    CONSTRAINT FK6 FOREIGN KEY (user_email) REFERENCES account(email),
    CONSTRAINT FK7 FOREIGN KEY (box_id) REFERENCES omnesbox(box_id),
    CONSTRAINT FK16 FOREIGN KEY (chosen_partner_email) REFERENCES account(email),
    articles_number INT,
    PRIMARY KEY(user_email,box_id)
);

CREATE TABLE purchase(
    purchase_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    purchase_date DATE,
    user_email VARCHAR(40) NOT NULL,
    box_id INT NOT NULL,
    chosen_partner_email VARCHAR(40) NOT NULL,
    CONSTRAINT FK8 FOREIGN KEY (user_email) REFERENCES account(email),
    CONSTRAINT FK9 FOREIGN KEY (box_id) REFERENCES omnesbox(box_id),
    CONSTRAINT FK10 FOREIGN KEY (chosen_partner_email) REFERENCES account(email)

);

CREATE TABLE to_offer(
    to_offer_id INT NOT NULL PRIMARY KEY,
    to_offer_password VARCHAR(20),
    CONSTRAINT FK11 FOREIGN KEY (to_offer_id) REFERENCES purchase(purchase_id)
);

CREATE TABLE possession(
    possession_id INT NOT NULL PRIMARY KEY,
    possession_date DATE,
    user_email VARCHAR(40) NOT NULL,
    CONSTRAINT FK12 FOREIGN KEY (possession_id) REFERENCES purchase(purchase_id),
    CONSTRAINT FK13 FOREIGN KEY (user_email) REFERENCES account(email)
);

CREATE TABLE used(
    used_id INT NOT NULL PRIMARY KEY,
    used_date DATE,
    grade INT,
    comment TEXT,
    user_email VARCHAR(40) NOT NULL,
    CONSTRAINT FK14 FOREIGN KEY (used_id) REFERENCES purchase(purchase_id),
    CONSTRAINT FK15 FOREIGN KEY (user_email) REFERENCES account(email)
);

INSERT INTO account (email,last_name,first_name,account_password,account_type) VALUES
("louis.renaud@edu.ece.fr","RENAUD","Louis","123456789","admin"),
("quentin.sornin@edu.ece.fr","SORNIN","Quentin","123456789","admin"),
("luca.soler@edu.ece.fr","SOLER SOCIETY","","123456789","partner"),
("antoine.grenouillet@edu.ece.fr","ANTOINE SARL","","123456789","partner"),
("sioul.duaner@gmail.com","RENAUD","Louis","123456789","user"),
("bla.bla@gmail.com","BLA","BLA","123456789","user");

INSERT INTO activity (activity_title,activity_content) VALUES
("cours","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean tincidunt tincidunt erat, id congue lacus fermentum sit amet. Curabitur eget eros ut metus tristique rhoncus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ex diam, ornare a vulputate in, tincidunt ac nisi. Nullam porta vehicula malesuada. Morbi mollis accumsan elit, sit amet mattis erat rutrum in. In suscipit odio at eros posuere vehicula. "),
("concours","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean tincidunt tincidunt erat, id congue lacus fermentum sit amet. Curabitur eget eros ut metus tristique rhoncus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ex diam, ornare a vulputate in, tincidunt ac nisi. Nullam porta vehicula malesuada. Morbi mollis accumsan elit, sit amet mattis erat rutrum in. In suscipit odio at eros posuere vehicula. "),
("conference","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean tincidunt tincidunt erat, id congue lacus fermentum sit amet. Curabitur eget eros ut metus tristique rhoncus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ex diam, ornare a vulputate in, tincidunt ac nisi. Nullam porta vehicula malesuada. Morbi mollis accumsan elit, sit amet mattis erat rutrum in. In suscipit odio at eros posuere vehicula. ");

INSERT INTO omnesbox (box_title,activity_id) VALUES
("cours info 1h",1),
("cours info 2h",1),
("cours elec 4h",1),
("cours info 4h",1),
("conference informatique",3),
("conference electronique",3);

INSERT INTO activity_offer (partner_email,activity_id) VALUES
("luca.soler@edu.ece.fr",1),
("luca.soler@edu.ece.fr",3),
("antoine.grenouillet@edu.ece.fr",2),
("antoine.grenouillet@edu.ece.fr",3);

INSERT INTO box_offer (partner_email,box_id,box_price,box_content) VALUES
("luca.soler@edu.ece.fr",1,19.99, "Lorem ipsum blablablablablablabla"),
("luca.soler@edu.ece.fr",2,29.99, "Lorem ipsum blablablablablablabla"),
("luca.soler@edu.ece.fr",4,59.99, "Lorem ipsum blablablablablablabla"),
("luca.soler@edu.ece.fr",5,30, "Lorem ipsum blablablablablablabla"),
("antoine.grenouillet@edu.ece.fr",6,25, "Lorem ipsum blablablablablablabla");

INSERT INTO in_cart(user_email,box_id,articles_number, chosen_partner_email) VALUES
("sioul.duaner@gmail.com",1,3,"luca.soler@edu.ece.fr"),
("sioul.duaner@gmail.com",2,1,"luca.soler@edu.ece.fr");

INSERT INTO purchase(user_email,box_id,purchase_date,chosen_partner_email) VALUES
("bla.bla@gmail.com",1,'2023-05-02',"luca.soler@edu.ece.fr"),
("bla.bla@gmail.com",2,'2023-05-03',"luca.soler@edu.ece.fr"),
("sioul.duaner@gmail.com",2,'2023-05-03',"luca.soler@edu.ece.fr"),
("sioul.duaner@gmail.com",4,'2023-05-03',"luca.soler@edu.ece.fr");

INSERT INTO to_offer(to_offer_id,to_offer_password) VALUES
(2,"123456789");

INSERT INTO possession(possession_id,user_email,possession_date) VALUES
(1,"bla.bla@gmail.com",'2023-05-02'),
(4,"sioul.duaner@gmail.com",'2023-05-03');

INSERT INTO used(used_id,user_email,used_date,grade,comment) VALUES
(3,"sioul.duaner@gmail.com",'2023-05-03',4,"tres bien !!!");