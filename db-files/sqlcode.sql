CREATE DATABASE library_app;
USE library_app;


CREATE TABLE clientes (
	id_cliente int NOT NULL PRIMARY KEY auto_increment,
    nome varchar(50),
    email varchar(255),
    senha varchar(100),
    cpf varchar (11) UNIQUE,
    nivel enum('user', 'admin') DEFAULT 'user'
);

CREATE TABLE livros (
	id_livro int NOT NULL PRIMARY KEY auto_increment,
    foto varchar(50),
    nome_livro varchar(50),
    autor varchar(50),
    categoria varchar(20),
    ISBN varchar(13),
    ano_public varchar(4),
    valor DECIMAL(7, 2),
    qtd_estoque int CHECK (qtd_estoque >= 0)
);

CREATE TABLE pedidos (
	id_pedido int NOT NULL PRIMARY KEY auto_increment,
    fk_cliente int,
    fk_livro int,
    qtd int,
    valor DECIMAL(7, 2),
    data_pedido DATETIME DEFAULT current_timestamp,
    FOREIGN KEY (fk_cliente) REFERENCES clientes(id_cliente)
    ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (fk_livro) REFERENCES livros(id_livro)
    ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE movimento (
	id_movimento int NOT NULL PRIMARY KEY auto_increment,
    fk_livro int,
    qtd_movimentada int NOT NULL,
    motivo varchar(255),
    data_movimento DATETIME DEFAULT current_timestamp,
    FOREIGN KEY (fk_livro) REFERENCES livros(id_livro)
    ON DELETE CASCADE ON UPDATE CASCADE
);

DELIMITER //

CREATE TRIGGER atualiza_estoque
AFTER INSERT ON movimento
FOR EACH ROW
BEGIN
    UPDATE livros
    SET qtd_estoque = qtd_estoque + NEW.qtd_movimentada
    WHERE id_livro = NEW.fk_livro;
END; //

CREATE TRIGGER atualiza_estoque_pedido
AFTER INSERT ON pedidos
FOR EACH ROW
BEGIN
    UPDATE livros
    SET qtd_estoque = qtd_estoque - NEW.qtd
    WHERE id_livro = NEW.fk_livro;
END; //


DELIMITER ;
