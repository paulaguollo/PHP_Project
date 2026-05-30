# 🌿 Grove
### *Where impact grows.*

Grove é uma plataforma web colaborativa onde pessoas, comunidades e organizações publicam, descobrem e participam em **iniciativas de impacto sustentável** — desde hortas comunitárias a projetos de energia solar, reciclagem local e economia circular.

A plataforma combina um background em economia e sustentabilidade com tecnologia web moderna, permitindo que qualquer utilizador contribua para um mundo mais sustentável, acompanhando o impacto real gerado por cada iniciativa.

---

## 🛠️ Tecnologias Utilizadas

| Camada | Tecnologia |
|---|---|
| Front-end | HTML5, CSS3, Bootstrap 5, JavaScript |
| Back-end | PHP (procedural) |
| Base de Dados | MySQL |
| Segurança | PDO, prepared statements, sessões PHP |
| Versionamento | Git + GitHub |

---

## ✨ Funcionalidades Principais

### Autenticação
- Registo de utilizador com validação de dados
- Login / logout com gestão de sessões (`$_SESSION`)
- Proteção de páginas privadas (redirecionamento automático)
- Perfis de utilizador (criador de iniciativas / colaborador)

### Iniciativas (CRUD completo)
- Criar, editar, visualizar e remover iniciativas de impacto
- Categorização por tipo (energia, alimentação, reciclagem, biodiversidade, etc.)
- Localização geográfica (cidade / região)
- Indicadores de impacto definidos pelo criador (ex: CO₂ evitado, pessoas beneficiadas)

### Participações (CRUD completo)
- Aderir a iniciativas como colaborador ou voluntário
- Gerir o estado da participação (pendente, ativo, concluído)
- Histórico de participações por utilizador

### Dashboard
- Visão geral das iniciativas em que o utilizador participa ou criou
- Métricas agregadas de impacto (por utilizador e globais)
- Feed de iniciativas recentes por localização

### Pesquisa e Filtros
- Filtrar iniciativas por categoria, localização e estado
- Ordenação por data, popularidade ou impacto

---

## 🗄️ Estrutura da Base de Dados

A base de dados contém um mínimo de 4 tabelas relacionadas:

- **utilizadores** — dados de autenticação e perfil
- **iniciativas** — projetos publicados pelos utilizadores
- **categorias** — taxonomia das iniciativas
- **participacoes** — relação entre utilizadores e iniciativas

Relações implementadas com chaves primárias e estrangeiras, com uso de `JOIN` em todas as consultas principais.

---

## 🔒 Segurança

- Validação de inputs no cliente (JavaScript) e no servidor (PHP)
- Uso de **PDO com prepared statements** em todas as queries
- Sanitização de dados com `htmlspecialchars()`
- Proteção de sessões com regeneração de ID após login
- Proteção contra SQL Injection e acesso indevido a páginas privadas

---

## 📁 Estrutura do Projeto

```
grove/
├── index.php               # Página inicial / feed público
├── login.php               # Autenticação
├── register.php            # Registo de utilizador
├── logout.php              # Encerramento de sessão
├── dashboard.php           # Área privada do utilizador
├── iniciativas/
│   ├── index.php           # Listagem com filtros
│   ├── criar.php           # Formulário de criação
│   ├── editar.php          # Formulário de edição
│   ├── detalhe.php         # Página de detalhe
│   └── eliminar.php        # Remoção
├── participacoes/
│   ├── aderir.php          # Criar participação
│   ├── gerir.php           # Gerir participações
│   └── cancelar.php        # Remover participação
├── config/
│   └── db.php              # Conexão PDO à base de dados
├── includes/
│   ├── header.php          # Cabeçalho comum
│   ├── footer.php          # Rodapé comum
│   └── auth.php            # Verificação de sessão
├── assets/
│   ├── css/
│   │   └── style.css       # Estilos personalizados
│   └── js/
│       └── main.js         # Scripts front-end
└── sql/
    └── grove.sql           # Script de criação da base de dados
```

---

## ⚙️ Instalação e Configuração Local

### Pré-requisitos
- PHP 8.x
- MySQL 8.x
- Servidor local: XAMPP / WAMP / Laragon

### Passos

1. Clonar o repositório:
```bash
git clone https://github.com/[teu-username]/grove.git
```

2. Colocar a pasta `grove/` dentro de `htdocs/` (XAMPP) ou equivalente.

3. Importar a base de dados:
   - Abrir o phpMyAdmin
   - Criar uma base de dados chamada `grove`
   - Importar o ficheiro `sql/grove.sql`

4. Configurar a ligação à base de dados em `config/db.php`:
```php
$host = 'localhost';
$dbname = 'grove';
$user = 'root';
$password = '';
```

5. Aceder em: `http://localhost/grove`

---

## ⚠️ Limitações Conhecidas

- Sem sistema de upload de imagens (iniciativas usam imagens por URL)
- Sem sistema de mensagens entre utilizadores
- Sem autenticação por email (verificação de conta não implementada)
- Indicadores de impacto são inseridos manualmente pelo criador

---

## 🚀 Ideias Futuras

- Sistema de notificações em tempo real
- Mapa interativo de iniciativas por geolocalização
- API REST para integração com apps móveis
- Sistema de badges/conquistas por impacto acumulado
- Moderação de conteúdo por administradores
- Integração com redes sociais para partilha de iniciativas

---

## 👤 Autor

Desenvolvido no âmbito do Trabalho Prático da formação de **Desenvolvimento Web (back-end)** — CESAE Digital.

---

*Grove — Where impact grows.* 🌿