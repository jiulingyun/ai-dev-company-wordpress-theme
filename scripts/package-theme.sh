#!/usr/bin/env bash
#
# package-theme.sh
# Simple packaging script for ai-dev-company-wordpress-theme
# Usage:
#   ./scripts/package-theme.sh [path/to/theme] 
# If no path provided, script assumes repository root is the theme directory.

set -euo pipefail
IFS=$'\n\t'

# Determine theme directory (argument or repo root)
PROJECT_ROOT="$(cd "$(dirname "$0")/.." && pwd -P)"
THEME_DIR="${1:-$PROJECT_ROOT}"

echo "Theme directory: $THEME_DIR"

# Optional build step: run npm build if package.json contains build script
if [ -f "$THEME_DIR/package.json" ]; then
  if grep -q "\"build\"" "$THEME_DIR/package.json"; then
    echo "Found package.json with build script — running npm run build"
    if command -v npm >/dev/null 2>&1; then
      (cd "$THEME_DIR" && npm install --no-audit --no-fund >/dev/null 2>&1 || true)
      (cd "$THEME_DIR" && npm run build)
    else
      echo "npm not found, skipping build step."
    fi
  else
    echo "No build script found in package.json — skipping JS/CSS build."
  fi
fi

# Read theme header for name/slug/version
STYLE_FILE="$THEME_DIR/style.css"
if [ -f "$STYLE_FILE" ]; then
  THEME_NAME=$(sed -n 's/^Theme Name:[[:space:]]*//p' "$STYLE_FILE" | head -n1 | sed 's/^[[:space:]]*//;s/[[:space:]]*$//')
  VERSION=$(sed -n 's/^Version:[[:space:]]*//p' "$STYLE_FILE" | head -n1 | sed 's/^[[:space:]]*//;s/[[:space:]]*$//')
else
  THEME_NAME=$(basename "$THEME_DIR")
  VERSION="dev"
fi

THEME_SLUG=$(echo "${THEME_NAME:-ai-dev-theme}" | tr '[:upper:]' '[:lower:]' | tr ' /_' '-' | tr -cd '[:alnum:]-')
OUT_DIR="$THEME_DIR/dist"
mkdir -p "$OUT_DIR"
OUT_ZIP="${OUT_DIR}/${THEME_SLUG}-${VERSION:-dev}.zip"

TMP_DIR=$(mktemp -d)
echo "Creating temporary copy at $TMP_DIR"

# Use rsync to copy files but exclude development artefacts and source files
rsync -a --delete \
  --exclude='.git' \
  --exclude='node_modules' \
  --exclude='*.map' \
  --exclude='*.lock' \
  --exclude='vendor' \
  --exclude='tests' \
  --exclude='.vscode' \
  --exclude='.env' \
  --exclude='*.sql' \
  --exclude='*.bak' \
  --exclude='assets/js/src' \
  --exclude='assets/scss' \
  --exclude='scripts' \
  --exclude='README.md' \
  --exclude='package.json' \
  --exclude='package-lock.json' \
  --exclude='yarn.lock' \
  --exclude='.github' \
  --exclude='.gitignore' \
  "$THEME_DIR/" "$TMP_DIR/$THEME_SLUG/"

echo "Creating zip: $OUT_ZIP"
(cd "$TMP_DIR" && zip -r -9 "$OUT_ZIP" "$THEME_SLUG" >/dev/null)

echo "Packaged theme available at: $OUT_ZIP"

# Cleanup
rm -rf "$TMP_DIR"

echo "Done."


