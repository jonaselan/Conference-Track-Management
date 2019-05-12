# Conference Track Management

## Concepção

Para analisar o problema comecei a rabiscar algumas coisas em um papel (como costumo fazer sempre). Percebi que se fosse feito uma ordenação das talks por tempo (5, 30, 45 e 60), seria mais fácil agrupar e trabalhar em cima dos dados. 

Logo após, estudei como qual seria a melhor forma de encaixar esses horários em cada turno/dia. Percebi que o turno matutino só poderia ter 180 minutos (3h) de duração, o que implica em um número limitado de combinações entre horários. Sendo assim, poderia trabalhar com base nisso. No entanto, o turno vespertino seria mais flexível, com a possibilidade de acabar entre 180 e 240 minutos, além das talks lightning. Mapear as combinações seria inviavel. 

Então, para solucionar o problema, segui outra ideia. Eu verifiquei qual dos grupos (por tempo) possuía mais talks disponíveis ainda, e a jogava em um array final, para posteriormente ser processado e printado. A cada nova inserção nesse array, é verificado se o próximo valor, quando adicionado, ultrapassa o tempo limite proposto (5pm), caso positivo, fecharia o track e partiria para a próxima. Após essa verificação, caso haja um tempo entre 4pm e 5pm, as lighting seriam encaixadas.

## Arquitetura e Organização

No que diz respeito a organização da solução, desde sempre houve uma preocupação da minha parte em deixar bem modularizado cada parte do sistema. Ao meu ver, isso ajuda a visualizar melhor cada bloco e o código que foi escrito ali, o torna reusável caso fosse o caso de crescê-lo, além de facilitar o testes unitários, já que consegui testar funções individuais sem nenhum grande problema. A separação ficou de seguinte forma:

Tentei trazer alguns conceitos mais complexos que vejo no meu dia, mesmo que talvez não fosse necessário e só tenha aumentado a complexidade para algo que aparentava ser simples. Mas achei válido demonstrar/tentar, como por exemplo a internacionalização que tentei fazer nas validações, a factory de Talks feita para os testes e etc.

Por fim, a separação final do sistema ficou desta forma:

Helpers: Coloquei aqui alguns arquivos que não são essenciais para o funcionamento da solução, mas que ajudam a aprimorar e deixar com algumas caracteristicas de um sistema real.
IO: Tudo relacionado com a leitura e a impressão de dados foi colocado aqui (incluindo o arquivo de entrada do problema)
Tests: Todos os testes unitários feitos
Conference.php: Aqui é onde a lógica principal reside (a montagem das tracks)


## Configurando

### Prerequisitos

- PHP >= 7
- Composer

```bash
# baixar dependências
$ composer install

# rodando testess
$ vendor/bin/phpunit

# executar a aplicação
$ php Run.php 
```