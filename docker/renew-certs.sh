#!/bin/bash
set -e

DIR="$(cd "$(dirname "$0")" && pwd)"

cp /etc/letsencrypt/live/sihandal.online/fullchain.pem "$DIR/ssl/sihandal.pem"
cp /etc/letsencrypt/live/sihandal.online/privkey.pem "$DIR/ssl/sihandal-key.pem"
chown -R $(stat -c "%u:%g" "$DIR/ssl") "$DIR/ssl"

docker compose -f "$DIR/../docker-compose.yml" exec nginx nginx -s reload 2>/dev/null || \
    docker compose -f "$DIR/../docker-compose.yml" restart nginx 2>/dev/null || true
