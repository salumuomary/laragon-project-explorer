<?php
function listProjects($baseDir, $sortBy = 'name') {
  $projects = [];
  foreach (scandir($baseDir) as $entry) {
    if ($entry === '.' || $entry === '..') continue;
    
    // Skip files/folders starting with .tmp or just .
    if (strpos($entry, '.') === 0) continue;
    
    $path = $baseDir . DIRECTORY_SEPARATOR . $entry;
    if (is_dir($path)) {
      $indexFile = '';
      if (file_exists($path . '/index.php')) {
        $indexFile = 'index.php';
      } elseif (file_exists($path . '/index.html')) {
        $indexFile = 'index.html';
      }
      $created = filectime($path);
      $modified = filemtime($path);
      $projects[] = [
        'name' => $entry,
        'index' => $indexFile,
        'created' => $created,
        'modified' => $modified,
        'time_since' => time() - $modified
      ];
    }
  }
  
  // Sort projects based on the selected option
  switch ($sortBy) {
    case 'name':
      usort($projects, function($a, $b) {
        return strcasecmp($a['name'], $b['name']);
      });
      break;
    case 'created_new':
      usort($projects, function($a, $b) {
        return $b['created'] - $a['created'];
      });
      break;
    case 'created_old':
      usort($projects, function($a, $b) {
        return $a['created'] - $b['created'];
      });
      break;
    case 'modified':
      usort($projects, function($a, $b) {
        return $b['modified'] - $a['modified'];
      });
      break;
  }
  
  return $projects;
}

function getDirectoryTree($path, $prefix = '') {
  $tree = [];
  if (!is_dir($path)) return $tree;
  
  $items = scandir($path);
  foreach ($items as $item) {
    if ($item === '.' || $item === '..') continue;
    if (strpos($item, '.') === 0) continue; // Skip hidden files
    
    $fullPath = $path . DIRECTORY_SEPARATOR . $item;
    $relativePath = str_replace($_SERVER['DOCUMENT_ROOT'], '', $fullPath);
    
    if (is_dir($fullPath)) {
      $tree[] = [
        'name' => $prefix . '📁 ' . $item,
        'path' => $relativePath,
        'is_dir' => true
      ];
      // Get subdirectories (limited to 2 levels deep)
      if (substr_count($prefix, '  ') < 2) {
        $subtree = getDirectoryTree($fullPath, $prefix . '  ');
        $tree = array_merge($tree, $subtree);
      }
    } else {
      $tree[] = [
        'name' => $prefix . '📄 ' . $item,
        'path' => $relativePath,
        'is_dir' => false
      ];
    }
  }
  return $tree;
}

function formatTimeSince($seconds) {
  if ($seconds < 60) return $seconds . 's ago';
  if ($seconds < 3600) return floor($seconds / 60) . 'm ago';
  if ($seconds < 86400) return floor($seconds / 3600) . 'h ago';
  if ($seconds < 2592000) return floor($seconds / 86400) . 'd ago';
  if ($seconds < 31536000) return floor($seconds / 2592000) . 'mo ago';
  return floor($seconds / 31536000) . 'y ago';
}

$documentRoot = $_SERVER['DOCUMENT_ROOT'];
$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'name';
$tableType = isset($_GET['table']) ? $_GET['table'] : 'with_index';

$allProjects = listProjects($documentRoot, $sortBy);
$withIndex = array_filter($allProjects, function($p) { return !empty($p['index']); });
$withoutIndex = array_filter($allProjects, function($p) { return empty($p['index']); });

$projects = ($tableType === 'without_index') ? $withoutIndex : $withIndex;
$tableTitle = ($tableType === 'without_index') ? 'Projects Without Index' : 'Projects With Index';
?>

<div style="margin-bottom: 15px;">
  <strong>Sort by:</strong>
  <button onclick="sortProjects('name', '<?php echo $tableType; ?>')" id="btn-name" class="sort-btn">A-Z</button>
  <button onclick="sortProjects('created_new', '<?php echo $tableType; ?>')" id="btn-created_new" class="sort-btn">Latest to Old</button>
  <button onclick="sortProjects('created_old', '<?php echo $tableType; ?>')" id="btn-created_old" class="sort-btn">Old to Latest</button>
  <button onclick="sortProjects('modified', '<?php echo $tableType; ?>')" id="btn-modified" class="sort-btn">Latest Modified</button>
</div>

<h3 style="margin: 10px 0;"><?php echo $tableTitle; ?> (<?php echo count($projects); ?>)</h3>

<table class="project-table">
  <tr>
    <th>Date Created</th>
    <th>Last Modified</th>
    <th>Time Since Edit</th>
    <th>Project Name</th>
    <th>Files</th>
    <th>Link</th>
  </tr>
  <?php foreach ($projects as $project): ?>
    <tr>
      <td><?php echo date('Y-m-d H:i', $project['created']); ?></td>
      <td><?php echo date('Y-m-d H:i', $project['modified']); ?></td>
      <td><?php echo formatTimeSince($project['time_since']); ?></td>
      <td><strong><?php echo htmlspecialchars($project['name']); ?></strong></td>
      <td>
        <select onchange="openFile(this.value)" class="file-dropdown">
          <option value="">View files...</option>
          <?php
            $tree = getDirectoryTree($documentRoot . DIRECTORY_SEPARATOR . $project['name']);
            foreach ($tree as $item):
          ?>
            <option value="<?php echo htmlspecialchars($item['path']); ?>">
              <?php echo htmlspecialchars($item['name']); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </td>
      <td>
        <?php
          $link = '/' . rawurlencode($project['name']);
          if ($project['index']) {
            $link .= '/' . $project['index'];
          }
        ?>
        <a href="<?php echo $link; ?>" target="_blank" class="open-link">
          <?php echo $project['index'] ? '🔗 Open' : '📁 Folder'; ?>
        </a>
      </td>
    </tr>
  <?php endforeach; ?>
  <?php if (count($projects) === 0): ?>
    <tr>
      <td colspan="6" style="text-align: center; color: #999;">No projects found</td>
    </tr>
  <?php endif; ?>
</table>

<script>
  // Highlight the active sort button
  const urlParams = new URLSearchParams(window.location.search);
  const currentSort = urlParams.get('sort') || 'name';
  const activeBtn = document.getElementById('btn-' + currentSort);
  if (activeBtn) {
    activeBtn.style.fontWeight = 'bold';
    activeBtn.style.backgroundColor = '#4CAF50';
    activeBtn.style.color = 'white';
  }
  
  function openFile(path) {
    if (path) {
      window.open(path, '_blank');
      // Reset dropdown
      event.target.value = '';
    }
  }
</script>

