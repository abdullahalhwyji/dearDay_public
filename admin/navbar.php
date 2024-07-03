

<!-- navbar.html -->
<div class="l-navbar" id="navbar">
    <nav class="nav">
        <div>
            <div class="nav__brand">
                <ion-icon name="menu-outline" class="nav__toggle" id="nav-toggle"></ion-icon>
                <a href="#" class="nav__logo">DearDayAdmin</a>
            </div>
            <div class="nav__list">
                <a href="index.php" class="nav__link active" onclick="loadPage('index.php')">
                    <ion-icon name="home-outline" class="nav__icon"></ion-icon>
                    <span class="nav__name">Dashboard</span>
                </a>
                <a href="users.php" class="nav__link" onclick="loadPage('users.php')">
                    <ion-icon name="people-outline" class="nav__icon"></ion-icon>
                    <span class="nav__name">Users</span>
                </a>

              
            </div>
        </div>

        <a href="../index.php" class="nav__link">
            <ion-icon name="log-out-outline" class="nav__icon"></ion-icon>
            <span class="nav__name">Log Out</span>
        </a>
    </nav>
</div>


