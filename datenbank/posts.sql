CREATE TABLE posts
(
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    AccountId INT UNSIGNED NOT NULL,
    Heading varchar (30) NOT NULL,
    Body TEXT,
    created DATETIME,
    modified DATETIME,
    Beginn DATETIME,
    Ende DATETIME,
    FOREIGN KEY (AccountId) REFERENCES accounts,
    PRIMARY KEY (Id)
)
