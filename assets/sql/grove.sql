# Script de criação da base de dados

CREATE DATABASE IF NOT EXISTS grove;
USE grove;

CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    birthdate DATE,
    gender VARCHAR(20)
);

CREATE TABLE categories (
    id_category INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE initiatives (
    id_initiative INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    location VARCHAR(150),
    impact_description VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_user INT NOT NULL,
    id_category INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users(id_user),
    FOREIGN KEY (id_category) REFERENCES categories(id_category)
);

CREATE TABLE participations (
    id_participation INT AUTO_INCREMENT PRIMARY KEY,
    status VARCHAR(20) DEFAULT 'pending',
    joined_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_user INT NOT NULL,
    id_initiative INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users(id_user),
    FOREIGN KEY (id_initiative) REFERENCES initiatives(id_initiative)
);


## TESTE DE DADOS

INSERT INTO categories (name) VALUES 
('Energy'),
('Food'),
('Recycling'),
('Biodiversity'),
('Community');

INSERT INTO users (name, email, password, birthdate, gender) VALUES
('Paula Teste', 'paula@grove.com', '123456', '2001-12-25', 'Female');

INSERT INTO initiatives (title, description, location, impact_description, id_user, id_category) VALUES
('Community Garden Porto', 'A shared garden open to everyone in the Porto neighbourhood.', 'Porto', '30 families benefited', 1, 2);

INSERT INTO participations (status, id_user, id_initiative) VALUES
('active', 1, 1);