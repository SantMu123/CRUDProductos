CREATE DATABASE IF NOT EXISTS Tecnologia;
USE Tecnologia;

CREATE TABLE IF NOT EXISTS Category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS Product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci UNIQUE NOT NULL,
    name VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    category_id INT,
    price FLOAT NOT NULL,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES Category(id) ON DELETE SET NULL ON UPDATE CASCADE
);

INSERT INTO Category (id, name, createdAt, updatedAt) VALUES
(1, 'Sensores', NOW(), NOW()),
(2, 'Drones', NOW(), NOW()),
(3, 'Accesorios', NOW(), NOW());

INSERT INTO Product (code, name, category_id, price) VALUES
('SEN001', 'Sensor de Temperatura', 1, 1580.158),
('SEN002', 'Sensor de Humedad', 1, 2180.853),
('SEN003', 'Sensor de Movimiento', 1, 1182.168),
('SEN004', 'Sensor de Luz', 1, 3580.456),
('SEN005', 'Sensor de Gas', 1, 1782.155),
('SEN006', 'Sensor de Ultrasonido', 1, 2185.058),
('SEN007', 'Sensor de Proximidad', 1, 3281.157),
('SEN008', 'Sensor de Vibración', 1, 2723.129),
('SEN009', 'Sensor de Presión', 1, 1580.158);

INSERT INTO Product (code, name, category_id, price) VALUES
('DRN001', 'Drone de Reconocimiento', 2, 15800.500),
('DRN002', 'Drone de Carga Ligera', 2, 21800.750),
('DRN003', 'Drone de Alta Velocidad', 2, 18200.300),
('DRN004', 'Drone de Fotografía', 2, 35800.400),
('DRN005', 'Drone de Videovigilancia', 2, 17820.800),
('DRN006', 'Drone de Exploración', 2, 21850.250),
('DRN007', 'Drone de Rescate', 2, 32810.500),
('DRN008', 'Drone Sumergible', 2, 27230.300),
('DRN009', 'Drone con Cámara Térmica', 2, 15800.100);

INSERT INTO Product (code, name, category_id, price) VALUES
('ACC001', 'Control Remoto Universal', 3, 500.250),
('ACC002', 'Batería de Alta Duración', 3, 1200.600),
('ACC003', 'Cargador Rápido', 3, 750.350),
('ACC004', 'Protector de Hélices', 3, 300.125),
('ACC005', 'Cámara de Alta Resolución', 3, 2500.750),
('ACC006', 'Estuche Resistente al Agua', 3, 1800.300),
('ACC007', 'Kit de Reparación', 3, 950.500),
('ACC008', 'Estabilizador de Cámara', 3, 2200.100),
('ACC009', 'Antena de Largo Alcance', 3, 1500.200);
