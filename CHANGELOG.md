# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2025-11-05

### Added
- Initial release of Laragon Project Dashboard
- Dual table layout (projects with/without index files)
- Six informative columns per table:
  - Date Created
  - Last Modified
  - Time Since Edit
  - Project Name
  - Files (dropdown with folder tree)
  - Link (quick access)
- Independent sorting for each table:
  - A-Z (alphabetical)
  - Latest to Old (by creation date)
  - Old to Latest (by creation date)
  - Latest Modified (by modification date)
- Interactive folder tree dropdown navigation
- Auto-refresh every 30 seconds
- Smart filtering (hides hidden files starting with `.`)
- Visual indicators for files (📄) and folders (📁)
- Responsive design with side-by-side tables
- Modern UI with hover effects and animations
- phpMyAdmin quick access link
- Direct integration with Laragon
- MIT License

### Features
- Real-time project monitoring
- No database required
- Pure PHP and vanilla JavaScript
- Minimal dependencies
- Fast and lightweight
- Easy to customize
- Mobile-friendly responsive design

### Technical Details
- PHP 7.0+ compatibility
- AJAX-based table updates
- Recursive directory scanning (2 levels deep)
- Human-readable time formatting
- URL-safe project links
- Security: Filters hidden files and system folders

---

## [Unreleased]

### Planned Features
- Search and filter functionality
- Project templates
- Database connection testing
- Analytics dashboard
- Custom tags/categories
- Export to CSV/JSON
- Dark mode
- Project favoriting
- Recent projects quick access
- Project size information
- Git integration status
- Project health checks

---

[1.0.0]: https://github.com/yourusername/laragon-project-dashboard/releases/tag/v1.0.0
