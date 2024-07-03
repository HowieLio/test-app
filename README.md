git clone https://github.com/HowieLio/test-app.git

---
cp .env.example .env

---

docker-compose up -d --build

---

docker-compose exec php composer install

---

sudo chown -R www-data:www-data storage

---

sudo chmod -R 775 storage

---

docker-compose exec php npm install

---

docker-compose exec php npm run build

---

docker-compose exec php php artisan migrate

---

Adminer - http://127.0.0.1:9090

Mailpit - http://127.0.0.1:8025

Products - http://127.0.0.1/products
