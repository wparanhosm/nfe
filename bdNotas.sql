-- drop database notaFiscal;
create database notaFiscal;
use notaFiscal;

create table tbl_produto(
id_produto int not null auto_increment primary key,
cProd varchar(50),
xProd varchar(100) not null,
ncm varchar(50) not null,
uCom char (5) not null,
qCom double not null,
vUnCom double not null,
vProd decimal(10,2),
num_nota int not null,
tipo char(1)
);

delimiter $$ 
create procedure retornaExiste(codigo_produto varchar(20),out valor int)
	begin
		select (if(exists(select cProd from tbl_produto where cProd = codigo_produto), 1, 0)) as 'valor' into valor;
	end$$

delimiter ; 


call retornaExiste('239218349182',@valor);

select @valor as 'valor';

create table tbl_estoque(
id_estoque int auto_increment primary key not null,
cProd varchar(50),
xProd varchar(100) not null,
ncm varchar(50) not null,
uCom char (5) not null,
qCom double not null,
vUnCom double not null,
vProd decimal(10,2)
);

delimiter ?
create procedure retornaQtd(cod_produto varchar(40))
	begin
		select qCom as quantidade from tbl_estoque where cProd = cod_produto;
	end?

delimiter ;

call retornaQtd('8520147');


select * from tbl_estoque;
select * from tbl_produto;

create table tbl_entradas(
id_entrada int auto_increment primary key,
cProd varchar(50),
xProd varchar(100) not null,
ncm varchar(50) not null,
uCom char (5) not null,
qCom double not null,
vUnCom double not null,
vProd decimal(10,2),
num_nota int not null,
tipo char(1)
);


select * from tbl_entradas;

delimiter ! 
create procedure retornaNotasPendentes(codigo_produto varchar(50))
	begin
		select * from tbl_entradas where qCom > 0 and cProd = codigo_produto order by num_nota;
	end!
    
delimiter ;

call retornaNotasPendentes('20044821');

select * from tbl_entradas;

create table tbl_login(
id_login int not null auto_increment primary key,
user varchar(50),
senha varchar(50)
);

select * from tbl_login;

insert into tbl_login (user,senha) values ('Walter','12345');


