CREATE TABLE account_roles
(
    RoleId TINYINT UNSIGNED NOT NULL,
    AccountId INT UNSIGNED NOT NULL,
    FOREIGN KEY (AccountId) REFERENCES accounts
)
