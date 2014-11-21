CREATE TABLE accounts
(
    Id INT NOT NULL AUTO_INCREMENT,
    Name varchar(50) NOT NULL,
    --http://php.net/manual/de/function.password-hash.php
    Passwort varchar(255) NOT NULL,
    created DATETIME,
    modified DATETIME,
    PRIMARY KEY (id),
    UNIQUE (Name)
)
