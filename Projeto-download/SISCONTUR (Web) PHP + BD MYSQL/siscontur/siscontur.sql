create database siscontur;
use siscontur;

create table Excursao(
	id_excursao integer auto_increment,
    codigo_registro varchar(8),
    nome_responsavel varchar(60),
    cpf_responsavel varchar(14),
    numero_turistas integer,    
    tipo_transporte varchar(35),
    
    id_chegada integer,
	foreign key (id_chegada) references Chegada(id_chegada),
    id_partida integer,
	foreign key (id_partida) references Partida(id_partida),
    id_multa integer,
	foreign key (id_multa) references Multa(id_multa),   
    
    primary key(id_excursao)
);

create table Chegada(
	id_chegada integer auto_increment,
    data_chegada date,
    data_provavel_retorno date,
    qtd_total_pessoas integer,
    cidade_origem varchar(30),
    tipo_estabelecimento varchar(4),
    
    primary key(id_chegada)
);



create table Partida(
	id_partida integer auto_increment,
    data_saida date not null,
    ocorrencias varchar(300),
    valor_taxa_pago numeric(5,2),  
    
    primary key(id_partida)
);

create table Multa(
	id_multa integer auto_increment,
    valor_multa numeric,

	primary key(id_multa)
);

desc Excursao;
select * from excursao where id_partida = "null";
select * from excursao where id_partida is null and id_chegada is not null;
select * from excursao;
SELECT MAX(id_excursao) FROM excursao;
select * from Multa;
select * from Chegada;
select * from Partida;