# Projeto Vue 3 - Configuração Local

Este documento descreve os passos necessários para configurar o projeto localmente.

## Pré-requisitos

Certifique-se de ter as seguintes ferramentas instaladas em sua máquina:
- [Node.js](https://nodejs.org/) (versão recomendada: 18 ou superior)
- [npm](https://www.npmjs.com/) ou [Yarn](https://yarnpkg.com/)
- [Vue CLI](https://cli.vuejs.org/) (opcional, mas recomendado)

## Passos para Configuração

1. **Clone o repositório**
    ```bash
    git clone git@github.com:felipealvesprestes/pokelog.git
    cd pokelog/front
    ```

2. **Instale as dependências**
    Se estiver usando npm:
    ```bash
    npm install
    ```
    Ou, se estiver usando Yarn:
    ```bash
    yarn install
    ```

3. **Inicie o servidor de desenvolvimento**
    Se estiver usando npm:
    ```bash
    npm run dev
    ```
    Ou, se estiver usando Yarn:
    ```bash
    yarn dev
    ```

4. **Acesse o projeto no navegador**
    O servidor estará disponível em: [http://localhost:5173](http://localhost:5173) (ou outra porta especificada no terminal).

## Scripts Disponíveis

- `dev`: Inicia o servidor de desenvolvimento.
- `build`: Gera a build de produção.
- `serve`: Serve a build de produção localmente.

## Estrutura do Projeto

- `src/`: Contém os arquivos principais do projeto.
- `public/`: Contém arquivos estáticos.
- `package.json`: Gerencia dependências e scripts.

## Tecnologias Utilizadas

- [Vue 3](https://vuejs.org/)
- [Vite](https://vitejs.dev/) (ferramenta de build)
- [Vuex](https://vuex.vuejs.org/) (gerenciamento de estado, se aplicável)
- [Vue Router](https://router.vuejs.org/) (roteamento)
