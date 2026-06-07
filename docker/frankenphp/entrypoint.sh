#!/bin/sh
set -e

# Build assets jika manifest belum ada
if [ ! -f /app/public/build/manifest.json ]; then
    echo "Building assets..."
    npm run build
fi

# Jalankan command utama (FrankenPHP)
exec "$@"