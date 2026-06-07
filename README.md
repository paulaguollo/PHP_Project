# Grove
### *Where impact grows.*

Grove is a full-stack web platform where individuals, communities, and organizations can **publish, discover, and join sustainable impact initiatives**, from community gardens to solar energy projects, local recycling campaigns, and circular economy efforts.

Built as a final project for the **Web Development (Back-end)** subject at CESAE Digital, Grove demonstrates a complete application with authentication, two full CRUD entities, relational database design, and security best practices.

---

## Project Overview

The platform addresses a real gap: there is no simple, open tool for people to organize and track local sustainability initiatives and measure their collective impact. Grove fills that gap by connecting people who want to act with projects that need support.

**Core flow:**
1. Anyone can browse and discover initiatives
2. Registered users can create their own initiatives
3. Other users can join initiatives as collaborators
4. Each initiative tracks its location, category, and impact description
5. Users manage everything through their profile

---

## 🛠️ Technologies

| Layer | Technology |
|---|---|
| Front-end | HTML5, CSS3, Bootstrap 5, JavaScript |
| Back-end | PHP 8 (procedural + OOP via Database class) |
| Database | MySQL 9 |
| Security | PDO, prepared statements, session management |
| Version Control | Git + GitHub |
| Environment | PHP built-in server / XAMPP / Laragon |

---

## Features

### Authentication
- User registration with input validation
- Login / logout with `$_SESSION` management
- Private page protection via `includes/auth.php`
- Password encryption with `password_hash()` and `password_verify()`

### Initiatives (Full CRUD)
- Create, read, update, and delete initiatives
- Categorization by impact type (Energy, Food, Recycling, Biodiversity, Community)
- Location field for geographic context
- Impact description defined by the creator
- Public listing with search and category filter
- Only the creator can edit or delete their own initiatives

### Participations (Full CRUD)
- Join any initiative as a collaborator
- View and manage all participations
- Cancel participation at any time
- Logic prevents joining your own initiative or joining twice

### Profile
- Private area showing initiatives created and participations joined
- Quick access to edit and delete own initiatives
- Summary counters for initiatives and participations

### Public Feed
- Homepage shows the 6 most recent initiatives
- Full listing at `/initiatives/index.php` with search and filter
- Accessible without login

---

## 🗄️ Database Structure

**4 related tables:**

```sql
users
├── id_user (PK, AUTO_INCREMENT)
├── name
├── email (UNIQUE)
├── password (hashed)
├── birthdate
└── gender

categories
├── id_category (PK, AUTO_INCREMENT)
└── name

initiatives
├── id_initiative (PK, AUTO_INCREMENT)
├── title
├── description
├── location
├── impact_description
├── created_at (DEFAULT CURRENT_TIMESTAMP)
├── id_user (FK → users)
└── id_category (FK → categories)

participations
├── id_participation (PK, AUTO_INCREMENT)
├── status (DEFAULT 'pending')
├── joined_at (DEFAULT CURRENT_TIMESTAMP)
├── id_user (FK → users)
└── id_initiative (FK → initiatives)
```

All queries use `JOIN`, primary keys, foreign keys, and the full range of `SELECT`, `INSERT`, `UPDATE`, `DELETE` operations.

---

## 🔒 Security

- All queries use **PDO with prepared statements** — no direct string interpolation in SQL
- All dynamic outputs use `htmlspecialchars()` — XSS protection
- Passwords are never stored in plain text — `password_hash()` with `PASSWORD_DEFAULT`
- Private pages redirect to login if no active session
- Ownership checks on edit/delete — users can only modify their own data
- Duplicate participation prevention at the database query level
- Input validation both client-side (HTML `required`) and server-side (PHP `empty()`, `isset()`)

---

## Project Structure

```
php_project/
├── index.php                   # Public homepage with recent initiatives feed
├── login.php                   # Login form
├── register.php                # Registration form
├── doLogin.php                 # Login logic
├── doRegister.php              # Registration logic
├── logout.php                  # Session destroy and redirect
├── profile.php                 # Private user profile
├── README.md                   # Project Details
├── config/
│   └── db.php                  # Database class with PDO 
├── includes/
│   ├── auth.php                # Session guard for private pages
│   ├── header.php              # Shared navbar and HTML head
│   └── footer.php              # Shared footer and Bootstrap JS
├── initiatives/
│   ├── index.php               # Initiative listing with search and category filter
│   ├── detail.php              # Initiative detail page
│   ├── create.php              # Create initiative form
│   ├── doCreate.php            # Create initiative logic
│   ├── edit.php                # Edit initiative form (pre-filled)
│   ├── doEdit.php              # Edit initiative logic
│   ├── delete.php              # Delete confirmation page
│   └── doDelete.php            # Delete initiative logic
├── participations/
│   ├── join.php                # Join initiative logic
│   ├── manage.php              # List and manage participations
│   └── cancel.php              # Cancel participation logic
├── assets/
│   ├── css/style.css           # Custom styles with CSS variables
│   └── js/main.js              # Alert auto-hide and delete confirmation
└── sql/
    └── grove.sql               # Full database schema and seed data
```

---

## Local Setup

### Requirements
- PHP 8.x
- MySQL 8.x or 9.x
- Local server: XAMPP, Laragon, or PHP built-in server

### Steps

1. Clone the repository:
```bash
git clone https://github.com/paulaguollo/php_project.git
```

2. Import the database:
   - Open phpMyAdmin or MySQL terminal
   - Create a database named `grove`
   - Import `assets/sql/grove.sql`

3. Configure the database connection in `config/db.php`:
```php
private $servername = "localhost";
private $username = "root";
private $password = "";
private $dbname = "grove";
```

4. Start the server:
```bash
cd php_project
php -S localhost:8000
```

5. Open in browser: `http://localhost:8000`

---

## Known Limitations

- No image upload — initiatives use text descriptions only
- No email verification on registration
- No admin panel or content moderation
- Impact metrics are self-reported by initiative creators
- No real-time notifications

---

## Future Ideas

- Interactive map showing initiatives by geolocation
- Badge and achievement system based on accumulated impact
- REST API for mobile app integration
- Admin dashboard for content moderation
- Social sharing of initiatives
- Messaging between users and initiative creators

---

## Author

By Paula Guollo Developed as the final practical project for **Web Development (Back-end)** — CESAE Digital.
