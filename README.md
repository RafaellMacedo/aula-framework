<h2>Projeto Web Framework</h2>


Este projeto foi criado para utilizar como base na criação de projetos de software web, utilizando no front-end a biblioteca JQuery e framework Bootstrap 3, no back-end a linguagem PHP versão 5.5 usando PDO para acesso ao banco de dados e o banco  MySql 5.6.


<h3>JQuery</h3>

https://jquery.com/

<h3>Bootstrap</h3>

http://getbootstrap.com/

<h2>Estrutura do banco de dados</h2>

Altera as variáveis do arquivo data/Base.php atribuíndo o usuário e senha do banco de dados.

$this->config['user']     = "user";
$this->config['password'] = "password";

CREATE DATABASE projetofw;  

CREATE TABLE curso (idcurso int not null auto_increment, curso varchar(30), constraint PK_CURSO primary key (idcurso));

CREATE TABLE aluno ( idaluno int not null auto_increment, nome varchar(50) not null, email varchar(100) null, idade int null, sexo varchar(10) null, idcurso int not null, constraint PK_ALUNO primary key (idaluno), constraint FK_ALUNO_IDCURSO foreign key (idcurso) references curso (idcurso));

CREATE TABLE usuario (idusuario int not null auto_increment, nome varchar(70) not null, login varchar(30) null, senha varchar(10) not null, nivel int not null, constraint PK_USUARIO primary key (idusuario));

INSERT INTO usuario (nome, login, senha, nivel) VALUES ('Professor', 'professor', '1234', 1);

INSERT INTO curso (curso) VALUES ('Ciência da Computação'), ('Administração');

INSERT INTO aluno (nome, email, idade, sexo, idcurso) VALUES ('Aluno A', 'alunoa@gmail.com', 20, 'feminino', 1), ('Aluno B', 'alunob@gmail.com', 21, 'masculino', 1), ('Aluno C', 'alunoc@gmail.com', 20, 'masculino', 1);
