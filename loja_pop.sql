CREATE TABLE loja (
	ID INTEGER AUTO_INCREMENT,
	nome VARCHAR(45),
	endereco VARCHAR(60),
	telefone VARCHAR(45),
	
	PRIMARY KEY(ID)
);
INSERT INTO loja(ID, nome, endereco, telefone) VALUES 
	(null, 'Loja1', 'endereço1', 'telefone1'),
	(null, 'Loja2', 'endereço2', 'telefone2'),
	(null, 'Loja3', 'endereço3', 'telefone3'),
	(null, 'Loja4', 'endereço4', 'telefone4'),
	(null, 'Loja5', 'endereço5', 'telefone5')
;



CREATE TABLE produto (
	ID INTEGER AUTO_INCREMENT,
	nome VARCHAR(45),
	descricao VARCHAR(60),
	preco DECIMAL(10, 2),
	tipo ENUM('novo', 'usado', 'liquidacao', 'promocao', 'outros'),
	categoria SET('eletronico', 'telefonia', 'informatica', 'eletrodomesticos', 'acessorios', 'outros'),
	data_lancamento DATE,
	desconto DECIMAL(10,2),
	
	PRIMARY KEY(ID)
);
INSERT INTO produto(ID, nome, descricao, preco, tipo, categoria, data_lancamento, desconto) VALUES 
	(null, 'nome1', 'descrição1', 1.00, 'novo', 'outros', '2000-01-01', 10),
	(null, 'nome2', 'descrição2', 1.00, 'novo', 'outros', '2000-01-01', 10),
	(null, 'nome3', 'descrição3', 1.00, 'novo', 'outros', '2000-01-01', 10),
	(null, 'nome4', 'descrição4', 1.00, 'novo', 'outros', '2000-01-01', 10),
	(null, 'nome5', 'descrição5', 1.00, 'novo', 'outros', '2000-01-01', 10),
	(null, 'nome6', 'descrição6', 1.00, 'novo', 'outros', '2000-01-01', 10),
	(null, 'nome7', 'descrição7', 1.00, 'novo', 'outros', '2000-01-01', 10),
	(null, 'nome8', 'descrição8', 1.00, 'novo', 'outros', '2000-01-01', 10),
	(null, 'nome9', 'descrição9', 1.00, 'novo', 'outros', '2000-01-01', 10),
	(null, 'nome10', 'descrição10', 1.00, 'novo', 'outros', '2000-01-01', 10)
;



CREATE TABLE caracteristica (
	ID INTEGER AUTO_INCREMENT,
	nome VARCHAR(45),
	descricao VARCHAR(60),
	
	PRIMARY KEY(ID)
);
INSERT INTO caracteristica(ID, nome, descricao) VALUES

	(null, 'caracteristica1', 'descrição1'),
	(null, 'caracteristica2', 'descrição2'),
	(null, 'caracteristica3', 'descrição3')
;


CREATE TABLE produto_caracteristica (
	
	ID_produto INTEGER,
	ID_caracteristica INTEGER, 
	PRIMARY KEY (ID_produto, ID_caracteristica),
	FOREIGN KEY(ID_produto) REFERENCES produto(ID),
	FOREIGN KEY(ID_caracteristica) REFERENCES caracteristica(ID)
);


INSERT INTO produto_caracteristica(ID_produto, ID_caracteristica) VALUES
	( 2, 1),
	( 8, 3),
	( 1, 2)
;




CREATE TABLE estoque (
	ID_loja INTEGER,
	ID_produto INTEGER,
	quantidade INTEGER,
	PRIMARY KEY(ID_loja, ID_produto),
	FOREIGN KEY (ID_loja) REFERENCES loja(ID),
	FOREIGN KEY (ID_produto) REFERENCES produto(ID)

);
INSERT INTO estoque(ID_loja, ID_produto, quantidade) VALUES 
	( 2, 4, 10),
	( 3, 8, 20),
	( 5, 9, 30)

;
