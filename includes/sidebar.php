<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link">
    <img src="<?php echo getLogoUrl(); ?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><?php echo getSystemName(); ?></span>
  </a>

  <?php
  function getSystemName()
  {
      global $conn;

      $systemNameQuery = "SELECT system_name FROM settings";
      $systemNameResult = $conn->query($systemNameQuery);

      if ($systemNameResult->num_rows > 0) {
          $systemNameRow = $systemNameResult->fetch_assoc();
          return $systemNameRow['system_name'];
      } else {
          return 'Gym System';
      }
  }

  function getLogoUrl()
  {
      global $conn;

      $logoQuery = "SELECT logo FROM settings";
      $logoResult = $conn->query($logoQuery);

      if ($logoResult->num_rows > 0) {
          $logoRow = $logoResult->fetch_assoc();
          return $logoRow['logo'];
      } else {
          return 'dist/img/AdminLTELogo.png';
      }
  }

  function getGymManagerName()
  {
      global $conn;

      $managerQuery = "SELECT gym_manager FROM settings";
      $managerResult = $conn->query($managerQuery);

      if ($managerResult->num_rows > 0) {
          $managerRow = $managerResult->fetch_assoc();
          return $managerRow['gym_manager'];
      } else {
          return 'Gym Manager'; // Default if not set
      }
  }
  ?>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/2382414.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo getGymManagerName(); ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="dashboard.php" class="nav-link <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link <?php echo ($current_page == 'add_type.php' || $current_page == 'view_type.php' || $current_page == 'edit_type.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-th-list"></i>
            <p>
              Membership Types
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="add_type.php" class="nav-link">
                <i class="fas fa-circle-notch nav-icon"></i>
                <p>Add New</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="view_type.php" class="nav-link">
                <i class="fas fa-circle-notch nav-icon"></i>
                <p>View and Manage</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="add_members.php" class="nav-link <?php echo ($current_page == 'add_members.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>Add Members</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="manage_members.php" class="nav-link <?php echo ($current_page == 'manage_members.php' || $current_page == 'edit_member.php' || $current_page == 'memberProfile.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>Manage Members</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="list_renewal.php" class="nav-link <?php echo ($current_page == 'list_renewal.php' || $current_page == 'renew.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-undo"></i>
            <p>Renewal</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="report.php" class="nav-link <?php echo ($current_page == 'report.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-file-invoice"></i>
            <p>Membership Report</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="revenue_report.php" class="nav-link <?php echo ($current_page == 'revenue_report.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-money-check"></i>
            <p>Revenue Report</p>
          </a>
        </li>

        <!-- New View Bills Page -->
        <li class="nav-item">
          <a href="all_bills.php" class="nav-link <?php echo ($current_page == 'all_bills.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>View Bills</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="settings.php" class="nav-link <?php echo ($current_page == 'settings.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-cogs"></i>
            <p>Settings</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="logout.php" class="nav-link <?php echo ($current_page == 'logout.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-power-off"></i>
            <p>Logout</p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
