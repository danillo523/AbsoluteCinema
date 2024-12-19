# AbsoluteCinema

<p align="center">
  <img src="https://github.com/user-attachments/assets/a441a7d5-7c0e-419b-859d-b796a77d1e93" alt="AbsoluteCinema Logo">
</p>

AbsoluteCinema é uma API desenvolvida em Laravel 11 para gerenciar uma locadora de DVDs. O sistema permite a gestão de Títulos em DVDs, clientes e operações de aluguel, incluindo Autenticação de empregados e administradores

## Tecnologias Utilizadas

- **Laravel 11**
- **PHP 8.4**
- **MySQL 8.0**
- **Laravel Pint**
- **Docker**
- **Postman**

## Funcionalidades Principais

- **Gestão de títulos em DVD**: Criação, listagem, atualização e exclusão de títulos.
- **Gestão de copias em DVDs para aluguel**: Criação, listagem e exclusão de copias em DVDs dos títulos.
- **Gestão de Clientes**: Criação, listagem, atualização e exclusão de clientes.
- **Operações de Aluguel**: Alugar e devolver cópias de DVDs.
- **Autenticação**: Registro, login e logout de usuários.
- **Controle de Acesso**: Permissões de diferentes cargos (admin e employee).
- **Filas e Tarefas Agendadas**: Utilização de Laravel Queues e cron jobs para tarefas assíncronas.

## Como Rodar o Projeto

1. **Clone o repositório:**
   ```sh
   git clone https://github.com/danillo523/AbsoluteCinema.git
   cd QuizMania
   ```

2. **Configure o arquivo `.env`:**
   Copie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente, especialmente as configurações do banco de dados.

3. **Instale as dependências:**
   ```sh
   composer install
   ```

4. **Gere a chave da aplicação:**
   ```sh
   php artisan key:generate
   ```

5. **Construa e inicie os containers Docker:**
   ```sh
   docker-compose up -d
   ```
   
## Docker

O projeto utiliza Docker para facilitar a configuração e execução do ambiente de desenvolvimento. Certifique-se de ter o Docker e o Docker Compose instalados em sua máquina.           
**ATENÇÃO** : Ao iniciar os containers O usuário **admin** no banco de dados MySQL é criado automaticamente com a senha **password**, a migration também é executada automaticamente para criar as tabelas necessárias.

Para iniciar os containers, execute:
```sh
docker-compose up -d
```

Para parar os containers, execute:
```sh
docker-compose down
```

## Documentação da API

A documentação da API está disponível seguinte link:
- **Postman:** https://www.postman.com/tearing5/absolutecinema

## Estrutura de Rotas da API

### Autenticação
- `POST /register` - Registrar um novo usuário
- `POST /login` - Fazer login
- `POST /logout` - Fazer logout
- `GET /me` - Obter detalhes do usuário autenticado

### Clientes
- `GET /customer` - Listar todos os clientes
- `POST /customer` - Criar um novo cliente
- `GET /customer/{customer}` - Obter detalhes de um cliente específico 
- `PUT /customer/{customer}` - Atualizar um cliente específico 
- `DELETE /customer/{customer}` - Deletar um cliente específico

### Gêneros
- `GET /genres` - Listar todos os gêneros
- `POST /genres` - Criar um novo gênero
- `GET /genres/{genre}` - Obter detalhes de um gênero específico
- `PUT /genres/{genre}` - Atualizar um gênero específico
- `DELETE /genres/{genre}` - Deletar um gênero específico

### DVDs
- `GET /dvds` - Listar todos os DVDs
- `POST /dvds` - Criar um novo DVD 
- `GET /dvds/{dvd}` - Obter detalhes de um DVD específico 
- `PUT /dvds/{dvd}` - Atualizar um DVD específico 
- `DELETE /dvds/{dvd}` - Deletar um DVD específico 

### Cópias de DVDs
- `GET /dvd-copies` - Listar todas as cópias de DVDs 
- `POST /dvd-copies` - Criar uma nova cópia de DVD 
- `GET /dvd-copies/{dvd_copy}` - Obter detalhes de uma cópia de DVD específica 
- `DELETE /dvd-copies/{dvd_copy}` - Deletar uma cópia de DVD específica 

### Aluguéis
- `POST /rentals/rent` - Alugar um DVD 
- `POST /rentals/return/{id}` - Devolver um DVD alugado

  
## Banco de dados

![data-base-absolute-cinema](https://github.com/user-attachments/assets/c512a96e-b601-467d-9b63-a1930f013cd7)

