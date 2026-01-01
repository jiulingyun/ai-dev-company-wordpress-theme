# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- **M6-T9**: Fixed Polylang language switcher layout issues in navigation bar.
- **M6-T***: Comprehensive testing phase initiated.

## [1.0.0-beta.5] - 2026-01-02

### Added
- **AI SEO Module**: New class `AI_SEO` with custom Meta Box for posts/pages/projects.
- **Auto-Generate Feature**: Simulated AI agent to generate SEO titles and descriptions.
- **Schema.org Support**: Full JSON-LD implementation for `Organization`, `WebSite`, `Article`, `BreadcrumbList`, and `SoftwareApplication`.
- **Social Meta Tags**: Added Twitter Card and enhanced Open Graph support.
- **Multi-language Support**: Full integration with Polylang for all theme strings and Elementor widgets.

### Fixed
- Fixed comment section missing `comments.php` template error.
- Fixed navigation layout issues for "Next/Previous Project" links.
- Fixed missing translation keys for "Read More", "Learn More", and comment navigation.

## [0.4.0] - 2026-01-01

### Added
- **Elementor Integration**: Registered custom widget category "AI Dev Theme".
- **Custom Widgets**:
  - `AI_Home_Hero`: Terminal effect hero section.
  - `AI_Split_Feature`: Comparison layout.
  - `Project_Showcase`: Grid view for projects.
  - `Tech_Stack`: Technology grid.
  - `Team_Grid`, `Testimonials`, `Stats_Counter`, `Timeline`.

## [0.3.0] - 2026-01-01

### Added
- **Design System**: SCSS architecture with variables for colors, typography, and spacing.
- **Animations**: Glitch effect, Scanline, Typing effect, Fade-in-up.
- **Dark Mode**: Default dark theme with neon accents (Cyberpunk style).

## [0.2.0] - 2026-01-01

### Added
- **Custom Post Types**: `Project` CPT with `Industry` and `Technology` taxonomies.
- **Templates**: `single-project.php`, `archive-project.php`.
- **Metaboxes**: Custom fields for Project details (Client, URL, AI Code %, etc.).

## [0.1.0] - 2026-01-01

### Added
- Initial theme setup.
- Basic file structure (`style.css`, `functions.php`, `index.php`).
- Autoloader and Singleton trait implementation.
