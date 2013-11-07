DROP TABLE IF EXISTS guestbook;
 
CREATE TABLE guestbook (
    id int NOT NULL AUTO_INCREMENT,
    email varchar(32) NOT NULL DEFAULT 'noemail@example.com',
    comment TEXT NULL,
    created DATETIME NOT NULL,
    PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
 
CREATE INDEX id ON guestbook(id);MENT, 
	email CARCHAR(32) NOT NULL DEFAULT '    -- scripts/schema.sqlite.sql
    --
    -- You will need load your database schema with this SQL.
     
    CREATE TABLE guestbook (
        id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        email VARCHAR(32) NOT NULL DEFAULT 'noemail@test.com',
        comment TEXT NULL,
        created DATETIME NOT NULL
    );
     
    CREATE INDEX "id" ON "guestbook" ("id");
