<!-- navbar.html -->
<div class="l-navbar" id="navbar">
    <nav class="nav">
        <div>
            <div class="nav__brand">
                <ion-icon name="menu-outline" class="nav__toggle" id="nav-toggle"></ion-icon>
                <a href="#" class="nav__logo">DearDayAdmin</a>
            </div>
            <div class="nav__list">
                <a class="nav__link active" onclick="loadPage('dashboard.php')">
                    <ion-icon name="home-outline" class="nav__icon"></ion-icon>
                    <span class="nav__name">Dashboard</span>
                </a>
                <a class="nav__link" onclick="loadPage('users.php')">
                    <ion-icon name="people-outline" class="nav__icon"></ion-icon>
                    <span class="nav__name">Users</span>
                </a>

                <div class="nav__link collapse" onclick="loadPage('users.php')">
                    <ion-icon name="folder-outline" class="nav__icon"></ion-icon>
                    <span class="nav__name">Projects</span>

                    <ion-icon name="chevron-down-outline" class="collapse__link"></ion-icon>

                    <ul class="collapse__menu">
                        <a href="#" class="collapse__sublink" onclick="loadPage('data.html')">Data</a>
                        <a href="#" class="collapse__sublink" onclick="loadPage('group.html')">Group</a>
                        <a href="#" class="collapse__sublink" onclick="loadPage('members.html')">Members</a>
                    </ul>
                </div>

                <a href="#" class="nav__link" onclick="loadPage('analytics.html')">
                    <ion-icon name="pie-chart-outline" class="nav__icon"></ion-icon>
                    <span class="nav__name">Analytics</span>
                </a>
                <div class="nav__link collapse">
                    <ion-icon name="people-outline" class="nav__icon"></ion-icon>
                    <span class="nav__name">Team</span>

                    <ion-icon name="chevron-down-outline" class="collapse__link"></ion-icon>

                    <ul class="collapse__menu">
                        <a href="#" class="collapse__sublink" onclick="loadPage('data.html')">Data</a>
                        <a href="#" class="collapse__sublink" onclick="loadPage('group.html')">Group</a>
                        <a href="#" class="collapse__sublink" onclick="loadPage('members.html')">Members</a>
                    </ul>
                </div>
                <a href="#" class="nav__link" onclick="loadPage('settings.html')">
                    <ion-icon name="settings-outline" class="nav__icon"></ion-icon>
                    <span class="nav__name">Settings</span>
                </a>
            </div>
        </div>

        <a href="#" class="nav__link" onclick="loadPage('logout.html')">
            <ion-icon name="log-out-outline" class="nav__icon"></ion-icon>
            <span class="nav__name">Log Out</span>
        </a>
    </nav>
</div>


