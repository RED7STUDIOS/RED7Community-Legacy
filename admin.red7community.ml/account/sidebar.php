<div id="wrapper">
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="nav-item">
                <a href="/index.php" class="nav-link<?php if ($selected_page == "/home.php") { echo ' active '; } else { echo ' '; } ?>text-white">
                    <i class="far fa-house"></i> Home
                </a>
            </li>
            <li class="nav-item">
                <a href="/users/profile.php?id=<?php echo $_SESSION['id'] ?>" class="nav-link<?php if (strpos($selected_page, "/users/profile.php?id=". $_SESSION['id'] ) !== false) { echo ' active '; } else { echo ' '; } ?>text-white">
                    <i class="far fa-user"></i> Profile
                </a>
            </li>
            <li class="nav-item">
                <a href="/avatar-editor.php" class="nav-link<?php if (strpos($selected_page, "/avatar-editor.php") !== false) { echo ' active '; } else { echo ' '; } ?>text-white">
                    <i class="far fa-users"></i> Avatar Editor
                </a>
            </li>
            <li class="nav-item">
                <a href="/users/friends.php?id=<?php echo $_SESSION['id'] ?>" class="nav-link<?php if (strpos($selected_page, "/users/friends.php?id=". $_SESSION['id']) !== false) { echo ' active '; } else { echo ' '; } ?>text-white">
                    <i class="far fa-users"></i> Friends
                </a>
            </li>
            <li class="nav-item">
                <a href="/users/inventory.php?id=<?php echo $_SESSION['id'] ?>" class="nav-link<?php if (strpos($selected_page, "/users/inventory.php?id=". $_SESSION['id']) !== false) { echo ' active '; } else { echo ' '; } ?>text-white">
                    <i class="far fa-backpack"></i> Inventory
                </a>
            </li>
        </ul>
    </div>
