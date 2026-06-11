-- Script de criação da base de dados "grove"
-- 4 tabelas: users (1), categories (1), initiatives (N:1 com users e categories), participations (tabela de junção N:N entre users e initiatives)


CREATE DATABASE IF NOT EXISTS grove;
USE grove;

CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE, -- UNIQUE garante que não há contas duplicadas com o mesmo email
    password VARCHAR(255) NOT NULL, -- guarda o HASH (password_hash), não a password real
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

-- Tabela de junção: regista que um utilizador participa numa iniciativa 
CREATE TABLE participations (
    id_participation INT AUTO_INCREMENT PRIMARY KEY,
    status VARCHAR(20) DEFAULT 'pending',
    joined_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_user INT NOT NULL,
    id_initiative INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users(id_user),
    FOREIGN KEY (id_initiative) REFERENCES initiatives(id_initiative)
);


-- TESTE DE DADOS

INSERT INTO categories (name) VALUES 
('Energy'),
('Food'),
('Recycling'),
('Biodiversity'),
('Community');

-- Utilizador de teste (password já em hash bcrypt, gerada com password_hash())
INSERT INTO users (name, email, password, birthdate, gender) VALUES
('Paula', 'paula@grove.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2001-12-25', 'Female');

-- Iniciativa de exemplo, criada pelo utilizador de teste (id_user = 1), categoria "Food" (id_category = 2)
INSERT INTO initiatives (title, description, location, impact_description, id_user, id_category) VALUES
('Community Garden Porto', 'A shared garden open to everyone in the Porto neighbourhood.', 'Porto', '30 families benefited', 1, 2);

-- Participação de exemplo: o próprio utilizador de teste participa na iniciativa criada
INSERT INTO participations (status, id_user, id_initiative) VALUES
('active', 1, 1);