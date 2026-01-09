# 🎬 InstantFlow

**InstantFlow** is a full-stack web platform for streaming movies online, inspired by Netflix.  

Originally developed as a high-school final project in 2021, it has been slightly modernized in 2026 with a cleaner architecture, Docker support, and improved documentation.

---

## 🚀 Features

- User authentication (register & login)
- Subscription plans (Basic, Plus, Pro)
- Watch movies directly via streaming (no downloads required)
- Search movies by title or filter by genre
- Watch history tracking
- Admin panel for content management
- Secure payments via **PayPal REST API**
- Movie storage structure organized by ID (poster + video)

---

## 🧩 Tech Stack

| Layer | Technology |
|-------|-------------|
| **Frontend** | HTML5, CSS3, JavaScript (Bootstrap) |
| **Backend** | PHP 8 (Object-Oriented, PDO) |
| **Database** | MariaDB 12 |
| **Server** | Apache 2 |
| **Environment** | Docker + Docker Compose |
| **Security** | AES encryption, password hashing, Let's Encrypt SSL |

---

## 🛢️ Database

![ER Diagram](./docs/instantflow_er_diagram.png)

Key entities and relationships:

- **User** → stores credentials and account data  
- **Subscription** → linked to user and plan category  
- **Category** → defines subscription type (Basic, Plus, Pro)  
- **Movie** → title, description, release date  
- **Genre** → linked to movies (many-to-many)  
- **Actor** → linked to movies (many-to-many)  


All database interactions are handled via **PDO** with prepared statements, ensuring security against SQL injection.

---

## ⚙️ Quick Start

### 🐳 Run with Docker

```bash
docker-compose up -d
```
Access the app at [http://localhost:8080](http://localhost:8080)

Required environment variables (in `.env`):

```
DB_ROOT_PASSWORD=root_password
DB_HOST=instantflow_db
DB_NAME=instantflow_db
DB_USERNAME=instantflow_user
DB_PASSWORD=instantflow_password
```

---

## 📝 Changelog
See the [CHANGELOG.md](./CHANGELOG.md) file for a detailed list of changes.