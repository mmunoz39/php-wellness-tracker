# Wellness Tracker (PHP)

Mini full-stack demo app built with **PHP 8.2, MySQL, Docker, and PHPUnit**.  
The app provides endpoints and views to **record and visualize health metrics** such as weight and steps.

---

## 🚀 Features
- **REST-style endpoints** to add and retrieve health measurements.
- **Views** built with Twig to display metrics and simple charts (Chart.js).
- **Database migrations** in `/migrations` to initialize schema.
- **Unit tests** with PHPUnit (TDD-style workflow).
- **Dockerized environment**: PHP-FPM, Nginx, MySQL.

---

## 🛠 Tech Stack
- **Backend:** PHP 8.2, PDO (MySQL)
- **Frontend:** Twig templates, Chart.js
- **Database:** MySQL 8
- **Testing:** PHPUnit
- **Environment:** Docker Compose (app + web + db)

---

## ⚙️ Setup
1. Clone the repository:
   ```bash
   git clone https://github.com/mmunoz39/php-wellness-tracker.git
   cd php-wellness-tracker
   ```

2. Start containers:
   ```bash
   docker compose up -d
   ```

3. Run migrations:
   ```bash
   docker compose exec db mysql -uapp -papp wellness < migrations/001_init.sql
   ```

4. Open the app in your browser:  
   👉 [http://localhost:8080](http://localhost:8080)

---

## 🧪 Tests
Run PHPUnit inside the container:
```bash
docker compose exec app php vendor/bin/phpunit
```

---

## 📂 Project Structure
```
php-wellness-tracker/
│
├── docker/           # Docker config (PHP, Nginx, php.ini)
├── migrations/       # SQL schema migrations
├── src/              # Application code
│   └── public/       # Public entrypoint (index.php)
├── tests/            # PHPUnit tests
├── composer.json     # PHP dependencies
└── docker-compose.yml
```

---

## 📸 Screenshots (optional)
*(Add screenshots of the app UI or PHPUnit results if available.)*

---

## 📜 License
This project is provided for educational and demonstration purposes.
