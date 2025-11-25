-- Questão 1 

DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `CalculaDesconto`(`preco` DECIMAL, `desconto` DECIMAL) RETURNS varchar(10) CHARSET utf8 COLLATE utf8_unicode_ci
BEGIN
DECLARE resultado DECIMAL;
SET resultado = preco - desconto;
RETURN resultado;

END //
DELIMITER ;


-- Questao 2 parte A

DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `ConvertData`(`data_` DATE) RETURNS varchar(10) CHARSET utf8 COLLATE utf8_unicode_ci
BEGIN
	DECLARE resultado VARCHAR(10) ;
	SET resultado = DATE_FORMAT(data_, '%d/%m/%Y');
	RETURN resultado;
END //
DELIMITER ;
-- parte B

SELECT  nome, data_lancamento, ConvertData(data_lancamento) from produto;


-- Questão 3 parte A

DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `CalculaMediaEstoque`(`id_produtos` INT) RETURNS decimal(10,2)
BEGIN
	DECLARE media DECIMAL(10,2);
	SELECT
		AVG(quantidade_disponivel) INTO media 
    FROM 
    	estoque 	
    WHERE 
    	id_produto = id_produtos;
RETURN media ;
END //
DELIMITER ;
-- parte B
SELECT produto.nome , CalculaMediaEstoque(produto.id) FROM estoque INNER JOIN produto ON produto.id = estoque.id_produto GROUP BY produto.id;

--Questao 4 parte A



