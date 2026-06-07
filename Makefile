.DEFAULT_GOAL := help

# ── Setup ──────────────────────────────────────────────────
setup: ## First-time setup: build, start, migrate
	docker compose up -d --build
	@echo "Waiting for containers to be ready..."
	@sleep 5
	@grep -q '^APP_KEY=$$' .env && docker compose exec app php artisan key:generate || echo "APP_KEY already set, skipping"
	docker compose exec app php artisan migrate
# ── Container ──────────────────────────────────────────────
up: ## Start semua container
	docker compose up -d

dev: ## Start dengan Vite hot reload
	docker compose up -d
	@echo "Vite dev server: http://localhost:5173"

down: ## Stop semua container
	docker compose down

restart: ## Restart semua container
	docker compose restart

build: ## Rebuild image tanpa cache
	docker compose build --no-cache

# ── Application ────────────────────────────────────────────
migrate: ## Jalankan migrasi
	docker compose exec app php artisan migrate

migrate-fresh: ## Fresh migrate + seed
	docker compose exec app php artisan migrate:fresh --seed

cache-clear: ## Clear semua cache
	docker compose exec app php artisan optimize:clear

shell: ## Masuk ke shell container app
	docker compose exec app sh

# ── Worker ─────────────────────────────────────────────────
worker-restart: ## Restart queue worker
	docker compose restart worker

worker-scale: ## Scale worker: make worker-scale N=3
	docker compose up -d --scale worker=$(N)

# ── Log & Monitor ──────────────────────────────────────────
logs: ## Lihat log semua service
	docker compose logs -f

logs-app: ## Lihat log semua service
	docker compose logs -f app

logs-worker: ## Lihat log semua service
	docker compose logs -f worker

logs-postgres: ## Lihat log semua service
	docker compose logs -f postgres

logs-redis: ## Lihat log semua service
	docker compose logs -f redis

logs-vite: ## Lihat log Vite dev server
	docker compose logs -f vite

ps: ## Lihat status container
	docker compose ps

# ── Help ───────────────────────────────────────────────────
help: ## Tampilkan daftar command
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | \
		awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[36m%-20s\033[0m %s\n", $$1, $$2}'