# Quick Installation Guide

## For Laragon Users

### Step 1: Download Files
1. Download `index.php` and `projects.php` from this repository
2. Or clone the entire repository:
   ```bash
   git clone https://github.com/salumuomary/laragon-project-explorer.git
   ```

### Step 2: Install
1. Navigate to your Laragon document root:
   - Default: `C:\laragon\www\`
2. **Option A**: Replace the existing `index.php` with the new one
3. **Option B**: Backup your old `index.php` first:
   ```bash
   rename index.php index.php.backup
   ```
4. Copy both files (`index.php` and `projects.php`) to the root

### Step 3: Access Dashboard
1. Start Laragon if not already running
2. Open your browser
3. Navigate to `http://localhost`
4. Enjoy your new dashboard!

## For Other PHP Environments (XAMPP, WAMP, MAMP)

### XAMPP
```
Copy files to: C:\xampp\htdocs\
Access via: http://localhost
```

### WAMP
```
Copy files to: C:\wamp64\www\
Access via: http://localhost
```

### MAMP
```
Copy files to: /Applications/MAMP/htdocs/
Access via: http://localhost:8888
```

## Verification

After installation, you should see:
- ✅ Two tables displaying your projects
- ✅ Sorting buttons above each table
- ✅ Dropdown menus for folder navigation
- ✅ Auto-refresh working (check console)

## Troubleshooting

### Projects not showing?
- Check if you have projects in your document root
- Verify PHP is running correctly
- Check browser console for JavaScript errors

### Sorting not working?
- Clear browser cache
- Check browser console for errors
- Verify `projects.php` is in the same directory

### Dropdown empty?
- Check folder permissions
- Ensure projects contain files
- Verify hidden files are filtered correctly

## Need Help?

- Check the [README.md](README.md) for detailed documentation
- Open an issue on GitHub
- Review closed issues for similar problems

---

**Installation time: ~2 minutes** ⚡
