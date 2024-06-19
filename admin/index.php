<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="./assets/css/style.css">
    
    <title>Dearadmin</title>
</head>
<body id="body-pd">
    
    <div id="navbar-container">
        
    </div>

    <!-- Content container -->
    <div id="content-container">
       
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Updated Ionicons script setup -->
    <script type="module" src="https://unpkg.com/ionicons@5.1.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@5.1.2/dist/ionicons/ionicons.js"></script>

    <script>
        // Function to load HTML content into the specified container
        function loadHTML(url, containerId, callback) {
            fetch(url)
                .then(response => response.text())
                .then(data => {
                    document.getElementById(containerId).innerHTML = data;
                    if (callback) callback();
                })
                .catch(error => console.error('Error loading HTML:', error));
        }

        // Load the navbar initially and initialize menu functions
        loadHTML('navbar.php', 'navbar-container', function() {
            showMenu('nav-toggle', 'navbar', 'body-pd');
            initializeMenuFunctions();
        });

        // Function to load page content dynamically
        function loadPage(page) {
            loadHTML(page, 'content-container');
        }

        // Load the default page content (e.g., dashboard.html)
        loadPage('dashboard.php');

        // Function to show/hide the menu
        function showMenu(toggleId, navbarId, bodyId) {
            const toggle = document.getElementById(toggleId),
                  navbar = document.getElementById(navbarId),
                  bodyPadding = document.getElementById(bodyId);

            if (toggle && navbar) {
                toggle.addEventListener('click', () => {
                    navbar.classList.toggle('expander');
                    bodyPadding.classList.toggle('body-pd');
                });
            }
        }

        // Function to initialize menu functions
        function initializeMenuFunctions() {
            const linkColor = document.querySelectorAll('.nav__link');
            function colorLink() {
                linkColor.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            }
            linkColor.forEach(l => l.addEventListener('click', colorLink));

            const linkCollapse = document.getElementsByClassName('collapse__link');
            for (let i = 0; i < linkCollapse.length; i++) {
                linkCollapse[i].addEventListener('click', function() {
                    const collapseMenu = this.nextElementSibling;
                    collapseMenu.classList.toggle('showCollapse');

                    const rotate = collapseMenu.previousElementSibling;
                    rotate.classList.toggle('rotate');
                });
            }
        }
    </script>
</body>
</html>
