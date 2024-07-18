<?php include ("../../controler/users/ctrl_lis_users.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>CodePen - Products Dashboard UI</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="../../css/style.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="app-container">

    <?php include ("../../menu/menu_patients_dash.php"); ?>

    <div class="app-content">
      <div class="app-content-header">
        <h1 class="app-content-headerText">Patients</h1>
        <button class="mode-switch" title="Switch Theme">
          <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
            <defs></defs>
            <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
          </svg>
        </button>
        <form action="" method="post">
          <button name="add_patient" class="app-content-headerButton">Ajoutez patient</button>
        </form>

      </div>
      <div class="app-content-actions">
        <input class="search-bar" placeholder="Search..." type="text">
        <div class="app-content-actions-wrapper">
          <div class="filter-button-wrapper">
            <button class="action-button filter jsFilter"><span>Filter</span><svg xmlns="http://www.w3.org/2000/svg"
                width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter">
                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
              </svg></button>
            <div class="filter-menu">
              <label>Category</label>
              <select>
                <option>All Categories</option>
                <option>Furniture</option>
                <option>Decoration</option>
                <option>Kitchen</option>
                <option>Bathroom</option>
              </select>
              <label>Status</label>
              <select>
                <option>All Status</option>
                <option>Active</option>
                <option>Disabled</option>
              </select>
              <div class="filter-menu-buttons">
                <button class="filter-button reset">
                  Reset
                </button>
                <button class="filter-button apply">
                  Apply
                </button>
              </div>
            </div>
          </div>
          <button class="action-button list active" title="List View">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="feather feather-list">
              <line x1="8" y1="6" x2="21" y2="6" />
              <line x1="8" y1="12" x2="21" y2="12" />
              <line x1="8" y1="18" x2="21" y2="18" />
              <line x1="3" y1="6" x2="3.01" y2="6" />
              <line x1="3" y1="12" x2="3.01" y2="12" />
              <line x1="3" y1="18" x2="3.01" y2="18" />
            </svg>
          </button>
          <button class="action-button grid" title="Grid View">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="feather feather-grid">
              <rect x="3" y="3" width="7" height="7" />
              <rect x="14" y="3" width="7" height="7" />
              <rect x="14" y="14" width="7" height="7" />
              <rect x="3" y="14" width="7" height="7" />
            </svg>
          </button>

        </div>

      </div>
      <table class="fl-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Id</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Pseudo</th>
            <th>NIF</th>
            <th>Status</th>
            <th>Date</th>

          </tr>
        </thead>
        <tbody>
          <?php
          if ($doctors) {
            $count = 1;

            foreach ($doctors as $row) {
              echo "<tr>";
              echo "<th scope='row'>$count</th>";
              echo "<td>{$row['id']}</td>";
              echo "<td>{$row['nom']}</td>";
              echo "<td>{$row['prenom']}</td>";
              echo "<td>{$row['pseudo']}</td>";
              echo "<td>" . ($row['statut'] == 1 ? 'Autoriser' : 'Bloquer') . "</td>";
              echo "<td>{$row['date']}</td>";
              echo "</tr>";
              $count++;
            }
          } else {
            echo "<tr><td colspan='11'>Aucun résultat trouvé pour le Prénom $search.</td></tr>";
          }
          ?>
        </tbody>
      </table>

    </div>
  </div>
  <!-- partial -->
  <script src="../js/script.js"></script>

</body>

</html>