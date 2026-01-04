#!/bin/bash

# Auto Push Script for AI Dev Theme
# Usage: ./scripts/auto-push.sh [commit_message]

set -e  # Exit on any error

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if we're in a git repository
if ! git rev-parse --git-dir > /dev/null 2>&1; then
    print_error "Not a git repository. Please run this script from the theme root directory."
    exit 1
fi

# Get the theme root directory
THEME_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
STYLE_CSS="$THEME_ROOT/style.css"

# Extract version from style.css
if [[ ! -f "$STYLE_CSS" ]]; then
    print_error "style.css not found at $STYLE_CSS"
    exit 1
fi

VERSION=$(sed -nE 's/^Version:[[:space:]]*([0-9]+\.[0-9]+\.[0-9]+).*/\1/p' "$STYLE_CSS" | head -1)

if [[ -z "$VERSION" ]]; then
    print_error "Could not extract version from style.css"
    exit 1
fi

TAG_NAME="v$VERSION"
COMMIT_MESSAGE="${1:-"Auto-commit: version $VERSION"}"

print_status "Theme version: $VERSION"
print_status "Tag name: $TAG_NAME"
print_status "Commit message: $COMMIT_MESSAGE"

# Check for uncommitted changes
if [[ -n $(git status --porcelain) ]]; then
    print_warning "Found uncommitted changes. Staging and committing..."

    # Stage all changes
    git add .

    # Commit changes
    if git commit -m "$COMMIT_MESSAGE"; then
        print_success "Changes committed successfully"
    else
        print_error "Failed to commit changes"
        exit 1
    fi
else
    print_status "No uncommitted changes found"
fi

# Check if we're ahead of remote
if [[ -n $(git log --oneline origin/main..HEAD 2>/dev/null || git log --oneline origin/master..HEAD 2>/dev/null) ]]; then
    print_warning "Local commits found that are not pushed to remote. Pushing..."

    # Push commits
    if git push origin HEAD; then
        print_success "Commits pushed successfully"
    else
        print_error "Failed to push commits"
        exit 1
    fi
else
    print_status "No unpushed commits found"
fi

# Check if tag already exists locally
if git tag -l | grep -q "^$TAG_NAME$"; then
    print_warning "Tag $TAG_NAME already exists locally. Deleting it..."
    git tag -d "$TAG_NAME"
fi

# Check if tag exists on remote
if git ls-remote --tags origin | grep -q "refs/tags/$TAG_NAME$"; then
    print_warning "Tag $TAG_NAME exists on remote. Deleting it..."
    git push --delete origin "$TAG_NAME"
fi

# Create new tag
print_status "Creating tag $TAG_NAME..."
if git tag "$TAG_NAME"; then
    print_success "Tag $TAG_NAME created successfully"
else
    print_error "Failed to create tag $TAG_NAME"
    exit 1
fi

# Push tag
print_status "Pushing tag $TAG_NAME to remote..."
if git push origin "$TAG_NAME"; then
    print_success "Tag $TAG_NAME pushed successfully"
    print_success "Release process completed!"
    print_status "GitHub Actions will now automatically build and release the theme package."
else
    print_error "Failed to push tag $TAG_NAME"
    exit 1
fi
