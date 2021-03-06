# Loja

O __projeto__ __loja__ é um estudo de como construir, consumir e aplicar uma API em [PHP](https://www.php.net/) com uso de [IONIC](https://ionicframework.com/). Onde usamos o [PHP](https://www.php.net/) para criar a API com o padrão de desenvolvimento em camadas seguindo o paradigma da programação orientada a objeto e gerando uma estrutura para consumo em JSON, ou seja, uma API REST.

Para o banco de dados usamos o SGBD [MySQL](https://www.mysql.com/) com o total de 9 tabelas, sendo estas: Usuario, Contato, Endereço, Cliente, Produto, Estoque, Pedido Detalhepedido, Pagamento.

Para o consumo da API foi desenvolvido um App(Aplicativo) em [IONIC](https://ionicframework.com/).

## Tecnologias aplicadas ao projeto

[![Node.js Version][node-version-image]][node-version-url]
[![NPM Version][npm-image]][npm-url]
[![MySql Version][mysql-image]][mysql-url]
[![PHP Version][php-image]][php-url]

### Instalação do NodeJS

Como um ambiente de execução JavaScript assíncrono orientado a eventos, o Node.js é projetado para desenvolvimento de aplicações escaláveis de rede. No exemplo a seguir, diversas conexões podem ser controladas ao mesmo tempo. Em cada conexão a função de callback é chamada. Mas, se não houver trabalho a ser realizado, o Node.js ficará inativo.

#### Instação no Windows

[Download do NODE JS](https://nodejs.org/pt-br/download/)

#### Instalação no Linux Ubuntu

```bash
sudo apt install nodejs
```

### Instalação do IONIC

O Ionic Framework é um kit de ferramentas de interface do usuário de código aberto para a criação de aplicativos móveis e de desktop de alto desempenho e desempenho, usando tecnologias da web (HTML, CSS e JavaScript).

O Ionic Framework concentra-se na experiência do usuário front-end ou na interação da interface do usuário de um aplicativo (controles, interações, gestos, animações). É fácil de aprender e integra-se perfeitamente a outras bibliotecas ou estruturas, como Angular, ou pode ser usado de forma independente sem uma estrutura de front-end usando um script simples.

#### Comando para instalar

```bash
npm install -g ionic
```

### Banco de dados MYSQL

Abaixo é apresentado o digrama de  banco de dados desenvolvido para este projeto.

![](db/img/diagramabanco.png)

## Work Flow do APP

![](db/img/workflow.png)

