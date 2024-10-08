CREATE DATABASE library_app;
USE library_app;

CREATE TABLE editora (
	id_editora INT NOT NULL PRIMARY KEY auto_increment,
	nome varchar(50),
    email varchar(255),
    contato varchar(15)
);

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
    fk_editora int,
    foto varchar(50),
    nome_livro varchar(50),
    autor varchar(50),
    categoria varchar(20),
    ISBN varchar(13),
    ano_public varchar(4),
    valor DECIMAL(7, 2),
    qtd_estoque int CHECK (qtd_estoque >= 0),
    FOREIGN KEY (fk_editora) REFERENCES editora(id_editora)
);

CREATE TABLE pedidos (
	id_pedido int NOT NULL PRIMARY KEY auto_increment,
    fk_cliente int,
    fk_livro int,
    valor DECIMAL(7, 2),
    data_pedido DATETIME,
    FOREIGN KEY (fk_cliente) REFERENCES clientes(id_cliente)
);

CREATE TABLE movimento (
	id_movimento int NOT NULL PRIMARY KEY auto_increment,
    fk_livro int,
    qtd_movimentada int NOT NULL,
    motivo varchar(255),
    data_movimento DATETIME DEFAULT current_timestamp,
    FOREIGN KEY (fk_livro) REFERENCES livros(id_livro)
);

DELIMITER //

CREATE TRIGGER atualiza_estoque
AFTER INSERT ON movimento
FOR EACH ROW
BEGIN
    UPDATE livros
    SET qtd_estoque = qtd_estoque + NEW.qtd_movimentada
    WHERE id_livro = NEW.fk_livro;
END;

DELIMITER ;
