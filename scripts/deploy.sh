#!/usr/bin/env bash
set -euo pipefail

APP_DIR=/var/www/engels811-network
BRANCH=${1:-main}

echo "Deploying branch ${BRANCH} to ${APP_DIR}"
ssh "$SSH_USER@$SSH_HOST" <<'REMOTE'
set -e
APP_DIR=/var/www/engels811-network
BRANCH=${BRANCH:-main}
if [ ! -d "$APP_DIR" ]; then
  git clone -b "$BRANCH" "$GIT_REPO" "$APP_DIR"
else
  cd "$APP_DIR"
  git fetch origin "$BRANCH"
  git checkout "$BRANCH"
  git pull origin "$BRANCH"
fi
cd "$APP_DIR"
composer install --no-dev --optimize-autoloader || true
php artisan migrate --force || true
REMOTE
