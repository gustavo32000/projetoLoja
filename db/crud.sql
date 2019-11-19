use dbloja;
select * from usuario;

insert into usuario (nomeusuario,senha,foto)
values ('admin',md5('123'),'imgusuario/admin.png');

select * from contato;

insert into contato (telefone,email)
value ('11-5569-2235','admin@admin.com.br');

select * from endereco;

insert into endereco (logradouro,numero,complemento,bairro,cep)
values ('Rua Nova','23', 'Casa dos fundos','Bairro de lá','0356627');

select * from cliente;

insert into cliente (nome,cpf,id_endereco,id_contato,id_usuario)
values ('Gustavo','47835568810',1,1,1);

select * from produto;

insert into produto (nome,descricao,preco,imagem1,imagem2,imagem3,imagem4)
values ('Teclado','Teclado sem fio Microsoft',56.90,'imgproduto/teclado1','imgproduto/teclado2','imgproduto/teclado3','imgproduto/teclado4');

select * from estoque;

insert into estoque (id_produto,quantidade)
values (1,10),(2,10);

select * from pedido;

insert into pedido (id_cliente)
values (1);

select * from detalhepedido;

insert into detalhepedido (id_pedido,id_produto,quantidade)
values (1,1,3),(1,2,2);

select * from detalhepedido;

#Da tabela produto(nomeproduto,preco)
#Da tabela detalhepedido(quantidade)
#A amarração entre as tebelas será feita pelo campo id_produto

select d.id_pedido,p.nome,p.preco,d.quantidade, p.preco*d.quantidade 'total'
from produto p inner join detalhepedido d on p.id = d.id_produto;

#Vamos realizar a soma da coluna total(quantidade do detalhe pedido multiplicado pelo preco do produto)
#Para isso iremos usar o comando sum(soma)
#Para a função realizar esta operação, nós teremos de agrupar as linhas referentes a este pedido com todos os seus produtos
#Sendo assim iremos usar outro comando de agrupamento chamado group by(agrupar por) e passar como parâmetro o campo id_pedido

select sum(p.preco*d.quantidade) 'Total a pagar' from
produto p inner join detalhepedido d on p.id=d.id_produto
group by d.id_pedido;

#Vamos realizar uma divisão do valor total a ser pago para simular um parcelamento
#No exemplo abaixo foi parcelado em 5 vezes

select sum(p.preco*d.quantidade) 'Total a pagar',
sum(p.preco*d.quantidade)/5 'Valor da parcela' from
produto p inner join detalhepedido d on p.id=d.id_produto
group by d.id_pedido;  

select * from pagamento;

insert into pagamento (id_pedido,valor,formapagamento,descricao,numeroparcelas,valorparcela)
values (1,284.5,'Cartão de Crédito','N,171-Gustavo',5,56.9);

select * from estoque;

#Consultando produtos do estoque

select e.quantidade 'Estoque', d.quantidade 'Estoque vendido', e.quantidade-d.quantidade 'Atual'
from estoque e inner join produto p on p.id = e.id_produto 
inner join detalhepedido d on d.id_produto=p.id;

#Atualizando o estoque

update estoque
set quantidade=quantidade-(select d.quantidade from detalhepedido d where d.id_produto=2)
where id_produto=2;

select * from estoque;

