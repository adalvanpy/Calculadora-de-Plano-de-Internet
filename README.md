# Calculadora-de-Plano-de-Internet

O presente sistema permite que os usuários contratem um plano de internet.
Na página Calculadora de Plano, o usuário seleciona os dispositivos e suas quantidades
que irão se conectar à internet contratada, além de escolher se deseja o pacote gamer.
Em seguida, o sistema mostra o tipo de plano, preço e detalhes.

Se o usuário decidir contratar, será redirecionado para uma página para preencher suas
informações e concluir o contrato. Após a finalização, o sistema envia uma notificação
por e-mail com todas as informações do plano contratado.

## Tecnologias usadas
PHP  8.2.12
HTML,TAILWIND,JAVASCRIPT
MYSQL
PHPADMIN
DOCKER COMPOSE

## Instalação
 Clone do repositório disponível no GitHub

## Para rodar
- Necessário ter o Docker e o Docker Compose instalados.
- Para iniciar, abra o terminal na pasta do projeto e execute:
  ```bash
  docker compose up -d
A página ficará disponível na porta 3001:

Calculadora de plano: http://localhost:3001/calculadora_plano.php

Página do administrador: http://localhost:3001/login.php

- Para parar os containers:
  ```bash
   docker compose down
## Uso
Cliente:
Contratar plano de internet
Administrador:
Ver a lista de vendas, total de vendas, total de vendas hoje e total de dispositivos.
Buscar vendas por nome do cliente e data