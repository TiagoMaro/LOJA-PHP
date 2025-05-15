Projeto de aprendisagem PHP.

Para execução em outra máquina é necessário a criação de um DB em MySQL.
O programa utilizado para este projeto foi o XAMPP.

Adicionar ao DB os seguintes comandos:

CREATE DATABASE loja_produto;

USE loja_produto;

CREATE TABLE CLIENTE (
    cod_cliente INT PRIMARY KEY AUTO_INCREMENT,
    nome_cliente VARCHAR(100) NOT NULL
);

CREATE TABLE PRODUTO (
    cod_produto INT PRIMARY KEY AUTO_INCREMENT,
    nome_produto VARCHAR(100) NOT NULL,
    qtde_estoque INT NOT NULL,
    valor NUMERIC(10,2)
);

CREATE TABLE COMPRA (
    data_compra DATE,
    qtd_venda INT NOT NULL,
    cod_cliente INT NOT NULL,
    FOREIGN KEY (cod_cliente) REFERENCES CLIENTE(cod_cliente),
    cod_produto INT NOT NULL,
    FOREIGN KEY (cod_produto) REFERENCES PRODUTO(cod_produto)
);


O projeto deve estar localizao em uma subpasta dentro de htdocs do programa xampp.
Para acessar a pasta do xampp, basta clicar em "Explorer" no meu menu ao lado direito do programa, 
ou acessa-la pelo caminho que você utilizaou na hora de instalação.

Para execução é necessário inserir o seguinte link em um browser que você utiliza: localhost/(Aqui a pasta que você criou dentro de htdocs)