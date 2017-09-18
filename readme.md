# Português

### Observações Iniciais
- Foi adicionado três campos referente a rendimento(Não ficou claro ao que "rendimento total" se referia) na tela de simulações.

	Exemplo : Tipo de investimento

	Rentabilidade: 15%
	taxa:5%;

	1. Rendimento cliente = 10%
	2. Rendimento da agência = 5%;
	3. Rendimento Total = 15%

- Minha inteção era desenvolver, primeiramente em Laravel e após em Zend, infelizmente não deu tempo de finalizar a versão em Zend no fim de semana e durante a semana eu ainda tenho vinculo com a empresa que estou atualmente, porém fico a disposição para fazer em Zend caso vocês queiram me dar mais um fim de semana.

### Como instalar

- Instale o Composer
- Clone o repositório.
- Vá até a pasta do reposotório e execute o comando ```$ composer update ```
- Altere as informações de conexão com o banco de dados dentro do arquivo ```.env```
- Crie o ```schema``` informado no arquivo ```.env```
- Execute o comando ```$ php artisan migrate ```
- Após isso execute o comando ```$ php artisan serve```

