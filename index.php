<?php
  if (!empty($_GET['q'])) {
    switch ($_GET['q']) {
      case 'info':
        phpinfo(); 
        exit;
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Laragon</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400" rel="stylesheet" type="text/css">
  <style>
    html, body {
      height: 100%;
    }

    body {
      margin: 0;
      padding: 0;
      width: 100%;
      display: table;
      font-weight: 100;
      font-family: 'Karla';
    }

    .container {
      text-align: center;
      display: table-cell;
      vertical-align: middle;
      padding: 20px;
    }

    .content {
      text-align: center;
      display: inline-block;
      max-width: 98%;
      width: 100%;
    }

    .title {
      font-size: 96px;
    }

    .opt {
      margin-top: 30px;
    }

    .opt a {
      text-decoration: none;
      font-size: 150%;
    }

    a:hover {
      color: red;
    }

    .tables-container {
      display: flex;
      gap: 20px;
      justify-content: center;
      align-items: flex-start;
      margin-top: 30px;
      flex-wrap: wrap;
    }

    .table-wrapper {
      flex: 1;
      min-width: 500px;
      max-width: 48%;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
      background: white;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    table, th, td {
      border: 1px solid #ddd;
    }

    th {
      background-color: #2c3e50;
      color: white;
      padding: 12px 8px;
      font-weight: bold;
      position: sticky;
      top: 0;
    }

    td {
      padding: 10px 8px;
      text-align: left;
    }

    tr:hover {
      background-color: #f5f5f5;
    }

    .project-table {
      font-size: 13px;
    }

    .tools {
      margin-top: 30px;
    }

    .tools a {
      text-decoration: none;
      font-size: 130%;
      display: block;
      margin: 10px 0;
    }

    .sort-btn {
      padding: 8px 16px;
      margin: 0 5px;
      font-family: 'Karla';
      font-size: 14px;
      cursor: pointer;
      border: 1px solid #ccc;
      background-color: #f9f9f9;
      border-radius: 4px;
      transition: all 0.3s;
    }

    .sort-btn:hover {
      background-color: #e0e0e0;
      transform: translateY(-2px);
    }

    .file-dropdown {
      padding: 6px 10px;
      font-family: 'Karla';
      font-size: 13px;
      border: 1px solid #ccc;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
      max-width: 200px;
      background-color: white;
    }

    .file-dropdown:hover {
      border-color: #4CAF50;
    }

    .open-link {
      text-decoration: none;
      color: #4CAF50;
      font-weight: bold;
      padding: 6px 12px;
      border: 1px solid #4CAF50;
      border-radius: 4px;
      display: inline-block;
      transition: all 0.3s;
    }

    .open-link:hover {
      background-color: #4CAF50;
      color: white;
      transform: scale(1.05);
    }

    h3 {
      color: #2c3e50;
      border-bottom: 3px solid #4CAF50;
      padding-bottom: 8px;
      margin-bottom: 15px;
    }

    @media (max-width: 1200px) {
      .table-wrapper {
        max-width: 100%;
        min-width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="content">
      <div class="title" title="Laragon">Laragon</div>

      <div class="info"><br />
        <?php echo $_SERVER['SERVER_SOFTWARE']; ?><br />
        PHP version: <?php echo phpversion(); ?> <span><a title="phpinfo()" href="/?q=info">info</a></span><br />
        Document Root: <?php echo $_SERVER['DOCUMENT_ROOT']; ?><br />
      </div>
      <div class="tools">
        <a href="http://localhost:808/phpmyadmin" target="_blank">Open phpMyAdmin</a>
      </div>

      <div class="tables-container">
        <div class="table-wrapper" id="table-with-index">Loading projects with index...</div>
        <div class="table-wrapper" id="table-without-index">Loading projects without index...</div>
      </div>

      <div class="opt">
        <div><a title="Getting Started" href="https://laragon.org/docs">Getting Started</a></div>
      </div>
    </div>
  </div>

  <script>
    let currentSortWithIndex = 'name';
    let currentSortWithoutIndex = 'name';

    function sortProjects(sortBy, tableType) {
      if (tableType === 'with_index') {
        currentSortWithIndex = sortBy;
      } else {
        currentSortWithoutIndex = sortBy;
      }
      loadProjects(tableType, sortBy);
    }

    function loadProjects(tableType = 'both', sortBy = null) {
      if (tableType === 'both' || tableType === 'with_index') {
        const sort = sortBy || currentSortWithIndex;
        const url = `projects.php?table=with_index&sort=${sort}`;
        fetch(url)
          .then(response => response.text())
          .then(html => {
            document.getElementById('table-with-index').innerHTML = html;
          });
      }
      
      if (tableType === 'both' || tableType === 'without_index') {
        const sort = sortBy || currentSortWithoutIndex;
        const url = `projects.php?table=without_index&sort=${sort}`;
        fetch(url)
          .then(response => response.text())
          .then(html => {
            document.getElementById('table-without-index').innerHTML = html;
          });
      }
    }

    loadProjects('both'); // Load both tables on page load
    setInterval(() => loadProjects('both'), 30000); // Refresh every 30 seconds
  </script>
</body>
</html>
