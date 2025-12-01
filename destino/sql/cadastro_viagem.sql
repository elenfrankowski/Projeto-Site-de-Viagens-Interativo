CREATE TABLE cadastro_viagem (
id SERIAL PRIMARY KEY NOT NULL,
nome VARCHAR(500) NOT NULL, 
nacionalidade VARCHAR(500) NOT NULL, 
nascimento VARCHAR(100) NOT NULL, 
cpf VARCHAR(100) NOT NULL, 
numero_passaporte VARCHAR(100) NOT NULL, 
validade_passaporte VARCHAR(20) NOT NULL, 
endereco VARCHAR(500) NOT NULL, 
cidade VARCHAR(500) NOT NULL, 
estado VARCHAR(500) NOT NULL, 
cep VARCHAR(50) NOT NULL,
celular VARCHAR(50) NOT NULL,
email VARCHAR(500) NOT NULL, 
senha VARCHAR(500) UNIQUE NOT NULL
)


SELECT * FROM cadastro_viagem