#!/bin/bash
set -e

DOMAIN=${1:-sihandal.online}
EMAIL=${2:-admin@$DOMAIN}

if [ "$EUID" -ne 0 ]; then
  echo "Please run as root"
  exit 1
fi

apt-get update
apt-get install -y certbot

certbot certonly --standalone -d "$DOMAIN" -d "www.$DOMAIN" --non-interactive --agree-tos -m "$EMAIL"

mkdir -p /etc/ssl/certs /etc/ssl/private

cp "/etc/letsencrypt/live/$DOMAIN/fullchain.pem" /etc/ssl/certs/sihandal.pem
cp "/etc/letsencrypt/live/$DOMAIN/privkey.pem" /etc/ssl/private/sihandal-key.pem

echo "SSL certificates installed. Run the following to renew:"
echo "  certbot renew --deploy-hook 'cp /etc/letsencrypt/live/$DOMAIN/fullchain.pem /etc/ssl/certs/sihandal.pem && cp /etc/letsencrypt/live/$DOMAIN/privkey.pem /etc/ssl/private/sihandal-key.pem'"
