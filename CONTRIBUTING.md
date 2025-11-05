# Contributing to Laragon Project Dashboard

First off, thank you for considering contributing to Laragon Project Dashboard! It's people like you that make this tool better for everyone.

## Code of Conduct

This project and everyone participating in it is governed by respect and professionalism. By participating, you are expected to uphold this standard.

## How Can I Contribute?

### Reporting Bugs

Before creating bug reports, please check the existing issues to avoid duplicates. When you create a bug report, include as many details as possible:

- **Use a clear and descriptive title**
- **Describe the exact steps to reproduce the problem**
- **Provide specific examples** (code snippets, screenshots)
- **Describe the behavior you observed** and what you expected
- **Include your environment details** (PHP version, OS, browser)

### Suggesting Enhancements

Enhancement suggestions are tracked as GitHub issues. When creating an enhancement suggestion:

- **Use a clear and descriptive title**
- **Provide a detailed description** of the suggested enhancement
- **Explain why this enhancement would be useful**
- **List some examples** of how it would be used

### Pull Requests

1. Fork the repo and create your branch from `main`
2. If you've added code, test it thoroughly
3. Ensure your code follows the existing style
4. Write clear, concise commit messages
5. Include comments in your code where necessary
6. Update documentation if needed

## Development Process

### Setting Up Your Development Environment

1. Fork the repository
2. Clone your fork:
   ```bash
   git clone https://github.com/yourusername/laragon-project-dashboard.git
   ```
3. Create a branch:
   ```bash
   git checkout -b feature/your-feature-name
   ```

### Coding Standards

- **PHP**: Follow PSR-12 coding standards
- **JavaScript**: Use ES6+ features where appropriate
- **HTML/CSS**: Keep markup semantic and styles modular
- **Comments**: Write meaningful comments for complex logic
- **Naming**: Use descriptive variable and function names

### Testing

- Test your changes in multiple scenarios
- Verify compatibility with different PHP versions
- Check browser compatibility (Chrome, Firefox, Safari, Edge)
- Test with various project structures and sizes

### Commit Messages

- Use the present tense ("Add feature" not "Added feature")
- Use the imperative mood ("Move cursor to..." not "Moves cursor to...")
- Limit the first line to 72 characters or less
- Reference issues and pull requests liberally after the first line

Examples:
```
Add folder size calculation feature

- Implement recursive size calculation
- Display formatted size in table
- Add toggle for size visibility
- Fixes #123
```

## Project Structure

```
laragon-project-dashboard/
├── index.php           # Main dashboard page
├── projects.php        # Backend logic
├── README.md          # Project documentation
├── LICENSE            # MIT License
├── CHANGELOG.md       # Version history
├── CONTRIBUTING.md    # This file
└── .gitignore         # Git ignore rules
```

## Feature Requests

We track feature requests in the issues section. Before submitting:

1. Check if the feature has already been requested
2. Explain your use case clearly
3. Describe how you envision the feature working
4. Consider if this feature benefits the broader community

## Code Review Process

1. Maintainers will review your pull request
2. They may suggest changes or improvements
3. Make requested changes and push to your branch
4. Once approved, your changes will be merged

## Community

- Be respectful and constructive
- Help others when you can
- Share your experiences and learnings
- Provide feedback on issues and PRs

## Questions?

Feel free to open an issue with the tag "question" if you have any questions about contributing.

## Recognition

Contributors will be recognized in the project documentation and release notes.

---

Thank you for contributing! 🎉
