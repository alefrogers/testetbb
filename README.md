# Português


### Obsevações iniciais
- Foi adicionado três campos referente a rendimento(Não ficou claro ao que "rendimento total" se referia) na tela de simulações.

	Exemplo : Tipo de investimento

	Rentabilidade: 15%
	taxa:5%;

	1. Rendimento cliente = 10%
	2. Rendimento da agência = 5%;
	3. Rendimento Total = 15%

- Minha intenção era desenvolver em “Laravel” e “Zend” mas um único final de semana não foi suficiente para terminar os dois.  Se vocês ainda querem  em  “Zend” eu posso termina-lo no próximo final de semana, pois durante a semana eu  ainda tenho vinculo empregatício.

### Como instalar

- Instale o Composer
- Clone o repositório.
- Vá até a pasta do reposotório e execute o comando ```$ composer update ```
- Altere as informações de conexão com o banco de dados dentro do arquivo ```.env```
- Crie o ```Schema``` informado no arquivo ```.env``` em seu banco de dados.
- Execute o comando ```$ php artisan migrate ```
- Após isso execute o comando ```$ php artisan serve```
- Acesse http://127.0.0.1:8000


# English
### Initial observations
- It was added three fields refering the income (it wasn't clear what the field "rendimento total" meant) in the simulations screen.

	Example: Type of investments
    
    income : 15%, rate : 5%
    
    1. Costumer income = 10%
    2. Agency income = 5%
    3. Total income = 15%
 
 - I intended  to develop  in  “Laravel” and “Zend”  but   only  one  weekend  wasn´t enough to finish both,  only the “Laravel”.   If you still want   “Zend”  I can finish it in the next  week end ,  because I still have an  employment relationship during the week.

### How to Install

- Install the composer.
- Clone the repository.
- Go to the repository folder and run ```$ composer update ```
- Change the connection data in archive ```.env```
- Create the ```Schema``` in your datebase as mentioned in the archive ```.env```
- Run the command ```$ php artisan migrate ```
- After this run the command ```$ php artisan serve```
- Go to http://127.0.0.1:8000
