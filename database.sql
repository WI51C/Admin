CREATE TABLE admin.user
(
    UserId INT PRIMARY KEY AUTO_INCREMENT,
    UserUsername VARCHAR(32),
    UserEmail VARCHAR(64),
    UserPassword VARCHAR(127),
    UserLevel INT
);