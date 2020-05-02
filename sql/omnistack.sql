--
-- File generated with SQLiteStudio v3.2.1 on sex mai 1 22:14:39 2020
--
-- Text encoding used: System
--
PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: ongs
DROP TABLE IF EXISTS ongs;

CREATE TABLE ongs (
    id       VARCHAR (255),
    name     VARCHAR (255) NOT NULL,
    email    VARCHAR (255) NOT NULL,
    whatsapp VARCHAR (255) NOT NULL,
    city     VARCHAR (255) NOT NULL,
    uf       VARCHAR (2)   NOT NULL,
    PRIMARY KEY (
        id
    )
);

INSERT INTO ongs (id, name, email, whatsapp, city, uf) VALUES ('21ddd77f', 'APAD', 'contato@apad.com.br', '69000000000', 'Rio do Sul', 'SC');
INSERT INTO ongs (id, name, email, whatsapp, city, uf) VALUES ('042cddb0', 'APAD2', 'contato@apad.com.br', '69000000000', 'Rio do Sul', 'SC');


-- Table: incidents
DROP TABLE IF EXISTS incidents;

CREATE TABLE incidents (
    id          INTEGER       NOT NULL
                              PRIMARY KEY AUTOINCREMENT,
    title       VARCHAR (255) NOT NULL,
    description VARCHAR (255) NOT NULL,
    value       FLOAT         NOT NULL,
    ong_id      VARCHAR (255) NOT NULL,
    FOREIGN KEY (
        ong_id
    )
    REFERENCES ongs (id) 
);

INSERT INTO incidents (id, title, description, value, ong_id) VALUES (2, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (3, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (4, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (5, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (6, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (7, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (8, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (9, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (10, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (11, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (12, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (13, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (14, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (15, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (16, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (17, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (18, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (19, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (20, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (21, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (22, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');
INSERT INTO incidents (id, title, description, value, ong_id) VALUES (23, 'Caso 1', 'Detalhes do caso', '120,00', '21ddd77f');

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
