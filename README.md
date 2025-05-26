# ERP Modular em PHP - Sistema de Gestão Empresarial Completo

Este projeto é um **ERP modular desenvolvido em PHP puro**, estruturado com **arquitetura MVC rigorosa**, pensado para atender operações empresariais reais com **clareza, organização e escalabilidade**. O sistema foi projetado para facilitar a gestão de produtos, estoque, vendas, cupons e pedidos, com controle total do fluxo de compra — da vitrine ao checkout.

## 🧠 Propósito

O objetivo central deste projeto é oferecer uma base sólida e extensível para sistemas de gestão empresarial, **sem dependência de frameworks pesados**, adotando uma abordagem orientada a objetos enxuta e **totalmente transparente** — ideal tanto para times pequenos quanto para escalar conforme a empresa cresce.

---

## 📦 Funcionalidades Principais
![image](https://github.com/user-attachments/assets/ac311bca-1c10-47f5-99b8-13a842940465)


### 🏪 Módulo de Loja
![image](https://github.com/user-attachments/assets/603bfc39-b59c-45aa-9d0b-8488f652136e)
- Exibição de produtos disponíveis
- Carrinho de compras com persistência
- Tela de checkout integrada com os pedidos



### 📦 Módulo de Produtos e Variações
![image](https://github.com/user-attachments/assets/786e2325-ecf1-4026-b5e5-7274dc0d98f1)
![image](https://github.com/user-attachments/assets/41046c83-c614-4733-8ccc-69532316cd4c)
- CRUD completo de produtos
- Cadastro de variações (como tamanhos, cores etc.)
- Vínculo entre produtos e variações

### 📊 Módulo de Estoque
![image](https://github.com/user-attachments/assets/ff62516c-2540-4cb9-9449-2ae3b5dc97d4)
- Cadastro e controle de quantidades
- Atualização automática ao final das compras
- Visualização geral do inventário

### 💰 Módulo de Cupons
![image](https://github.com/user-attachments/assets/49cde535-8d5e-431e-9521-00841bc21acc)
![image](https://github.com/user-attachments/assets/20d554f8-1f63-4a57-9502-dc6f99a68bc6)
- CRUD de cupons promocionais
- Aplicação automática no carrinho
- Regras flexíveis de desconto

### 📑 Módulo de Pedidos
![image](https://github.com/user-attachments/assets/f7bc12b9-64ee-47f9-90fe-3c8c075d787e)
![image](https://github.com/user-attachments/assets/208b17dc-9876-46bd-8b1b-13c71bfa13b7)
- Integração com checkout e carrinho
- API de CEP que alimenta automaticamente informações de endereço
- Detalhamento dos dados da compra
- Listagem dos pedidos realizados

---

## 🧱 Arquitetura

Este sistema segue fielmente o padrão **MVC (Model-View-Controller)**, com separação clara de responsabilidades:

```
/
├── app/
│   ├── Controllers/      ← lógica de controle
│   ├── Models/           ← regras de negócio e persistência
│   └── Views/            ← camadas de apresentação (HTML/PHP)
├── public/               ← ponto de entrada da aplicação (index.php)
├── routes/               ← mapeamento de URLs para controllers
├── database/             ← dump SQL e lógica de conexão
├── helpers/              ← funções auxiliares reutilizáveis
├── vendor/               ← dependências gerenciadas pelo Composer
├── docker/               ← configuração de ambiente
├── .htaccess             ← roteamento para ambiente Apache
└── composer.json         ← definição de dependências
```

## ⚙️ Recursos Técnicos

- **Composer** para autoload e gerenciamento de pacotes
- **Docker** configurado para ambiente local padronizado
- **.htaccess** para controle de rotas amigáveis via Apache
- Banco de dados relacional com dump incluído (`database/dump.sql`)
- Roteamento manual e explícito para controle total do fluxo de requisições

---

## 🧪 Práticas e Padrões

- **Orientação a Objetos** com foco em reutilização e organização
- Princípios **SOLID** aplicados à separação de camadas
- Baixo acoplamento e alta coesão entre os módulos
- Código limpo, legível e com responsabilidade única por componente

---

## ✅ Status Atual

O projeto está **completo e funcional**, com todos os módulos integrados. Pode ser utilizado como:

- Base para um sistema ERP mais completo
- Exercício de arquitetura limpa em PHP puro
- Prova de conceito para entrevistas técnicas

---

## 🧭 Como executar

```bash
# 1. Clone o repositório
git clone https://github.com/jfiliprc/Meu-ERP.git

# 2. Instale as dependencias do composer
composer install

# 3. Suba o ambiente com Docker
docker-compose up -d

# 3. Acesse no navegador
http://localhost:8000
```

> Certifique-se de importar o `dump.sql` no seu banco ou configure variáveis de ambiente para acesso automático.

---

## 🔚 Conclusão

Este projeto demonstra capacidade de estruturar um sistema empresarial real, com **atenção aos detalhes técnicos**, **modularidade** e **visão de produto**. Um ERP completo, com controle de fluxo de ponta a ponta, sem abrir mão da clareza de código e da manutenção a longo prazo.
