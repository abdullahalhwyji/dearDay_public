<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UI/UX</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="style.css">
</head>
<body>
   <div class="container">
      <aside>
         <div class="top">
           <div class="logo">
             <h2>DD <span class="danger">DearDay</span> </h2>
           </div>
           <div class="close" id="close_btn">
            <span class="material-symbols-sharp">close</span>
           </div>
         </div>
         <!-- end top -->
         <div class="sidebar">
            <a href="javascript:void(0);" onclick="loadContent('dashboard.php', 'dashboard')">
              <span class="material-symbols-sharp">grid_view</span>
              <h3>Dashboard</h3>
           </a>
           <a href="javascript:void(0);" onclick="loadContent('customers.php', 'customers')">
              <span class="material-symbols-sharp">person_outline</span>
              <h3>Customers</h3>
           </a>
           <a href="javascript:void(0);" onclick="loadContent('analytics.php', 'analytics')">
              <span class="material-symbols-sharp">insights</span>
              <h3>Analytics</h3>
           </a>
           <a href="javascript:void(0);" onclick="loadContent('messages.php', 'messages')">
              <span class="material-symbols-sharp">mail_outline</span>
              <h3>Messages</h3>
              <span class="msg_count">14</span>
           </a>
           <a href="javascript:void(0);" onclick="loadContent('products.php', 'products')">
              <span class="material-symbols-sharp">receipt_long</span>
              <h3>Products</h3>
           </a>
           <a href="javascript:void(0);" onclick="loadContent('reports.php', 'reports')">
              <span class="material-symbols-sharp">report_gmailerrorred</span>
              <h3>Reports</h3>
           </a>
           <a href="javascript:void(0);" onclick="loadContent('settings.php', 'settings')">
              <span class="material-symbols-sharp">settings</span>
              <h3>Settings</h3>
           </a>
           <a href="javascript:void(0);" onclick="loadContent('add_product.php', 'add-product')">
              <span class="material-symbols-sharp">add</span>
              <h3>Add Product</h3>
           </a>
           <a href="javascript:void(0);" onclick="loadContent('logout.php', 'logout')">
              <span class="material-symbols-sharp">logout</span>
              <h3>Logout</h3>
           </a>
         </div>
      </aside>

      <main id="main-content">
        <!-- Initial content of main section will be dynamically loaded -->
      </main>

      <div class="right">
        <!-- Right section content -->
      </div>
   </div>

   <script>
     function loadContent(url, path) {
       fetch(url)
         .then(response => {
           if (!response.ok) {
             throw new Error('Network response was not ok');
           }
           return response.text();
         })
         .then(data => {
           document.getElementById('main-content').innerHTML = data;
           history.pushState(null, null, path);
         })
         .catch(error => console.error('Error loading content:', error));
     }

     function loadInitialContent() {
       const defaultPage = 'dashboard';
       const pathname = window.location.pathname.replace('/', '');
       const path = pathname || defaultPage;
       const url = `${path}.php`;

       fetch(url)
         .then(response => {
           if (!response.ok) {
             throw new Error('Network response was not ok');
           }
           return response.text();
         })
         .then(data => {
           document.getElementById('main-content').innerHTML = data;
         })
         .catch(error => {
           console.error('Error loading initial content:', error);
           document.getElementById('main-content').innerHTML = '<h1>Error loading page</h1>';
         });
     }

     window.onpopstate = function(event) {
       loadInitialContent();
     };

     document.addEventListener('DOMContentLoaded', (event) => {
       loadInitialContent();
     });
   </script>
</body>
</html>
