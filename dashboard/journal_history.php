<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT entry_id, title, content, timestamp FROM tbl_journal WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$journals = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UI/UX</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="./css/journal.css?v=<?php echo time(); ?>">
</head>
<body>
   <div class="express">
   <aside>
           
           <div class="top">
             <div class="logo">
               <h2><img src="../img/colored.png" alt=""> <span class="danger">DearDay</span> </h2>
             </div>
             <div class="close" id="close_btn">
              <span class="material-symbols-sharp">
                close
                </span>
             </div>
           </div>
           <!-- end top -->
            <div class="sidebar">
  
              <a href="../dashboard/index.php">
                <span class="material-symbols-sharp">grid_view </span>
                <h3>Your Activity</h3>
             </a>
             <a href="../dashboard/journal_history.php" class="active" >
                <span class="material-symbols-sharp">library_books </span>
                <h3>Journal History</h3>
             </a>
             <a href="../dashboard/mood_tracker.php">
                <span class="material-symbols-sharp">sentiment_satisfied </span>
                <h3>Mood Tracker</h3>
             </a>
             <a href="../dashboard/expression_tracker.php">
                <span class="material-symbols-sharp">ar_on_you </span>
                <h3>Expression Tracker</h3>
             </a>
             <a href="../dashboard/quiz_history.php">
                <span class="material-symbols-sharp">abc </span>
                <h3>Quiz History</h3>
             </a>
             <a href="../dashboard/quiz_summary.php">
                <span class="material-symbols-sharp">assignment</span>
                <h3>Quiz Summary</h3>
             </a>
             <a href="../dashboard/profile.php">
                <span class="material-symbols-sharp">person_outline </span>
                <h3>Profile</h3>
             </a>
             <a href="../interface/interface.php">
                <span class="material-symbols-sharp">logout </span>
                <h3>Main Menu</h3>
             </a>
               
  
  
            </div>
  
        </aside>

      <main>
      <h1>Journal History</h1>
      
        <div class="search-filter">
          <input type="text" id="searchInput" placeholder="Search...">
          <input type="date" id="dateFilter">
        </div>

        <div id="noDataMessage" style="display: none; text-align: center; font-size: 24px; margin-top: 20px;">No data found.</div>

        <div class="grid-container">
          <?php foreach ($journals as $journal) : ?>
          <div class="grid-item" data-entry-id="<?php echo $journal['entry_id']; ?>">
            <div class="title"><?php echo htmlspecialchars($journal['title']); ?></div>
            <div class="date"><?php echo date('F j, Y', strtotime($journal['timestamp'])); ?></div>
            <div class="content"><?php echo htmlspecialchars($journal['content']); ?></div>
            <a href="#" class="read-more">Read more</a>
          </div>
          <?php endforeach; ?>
        </div>
      </main>
   </div>

   <div id="myModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <input type="text" class="modal-header" placeholder="Title" readonly>
        <div class="modal-date"></div>
        <div class="modal-body">
          <textarea class="edit-content" placeholder="Content" readonly></textarea>
        </div>
        <div class="modal-buttons">
          <button class="edit">Edit</button>
          <button class="save" style="display: none;">Save</button>
          <button class="delete">Delete</button>
        </div>
      </div>
    </div>

   <script>
   document.addEventListener('DOMContentLoaded', function() {
     const modal = document.getElementById('myModal');
     const modalHeader = document.querySelector('.modal-header');
     const modalDate = document.querySelector('.modal-date');
     const modalBody = document.querySelector('.modal-body');
     const closeModal = document.querySelector('.modal-content .close');
     const deleteButton = document.querySelector('.modal-content .delete');
     const editButton = document.querySelector('.modal-content .edit');
     const saveButton = document.querySelector('.modal-content .save');
     let currentGridItem; // To store reference to the currently edited grid item
     let currentEntryId; // To store the ID of the current entry

     const readMoreButtons = document.querySelectorAll('.read-more');

     // Event listener for "Read more" buttons in grid items
     readMoreButtons.forEach(button => {
       button.addEventListener('click', function(event) {
         event.preventDefault();
         const gridItem = button.closest('.grid-item');
         const title = gridItem.querySelector('.title').textContent;
         const date = gridItem.querySelector('.date').textContent;
         const content = gridItem.querySelector('.content').textContent;

         currentEntryId = gridItem.dataset.entryId; // Store the entry ID

         modalHeader.value = title;
         modalDate.textContent = date;
         modalBody.querySelector('.edit-content').value = content;

         currentGridItem = gridItem; // Store current grid item reference

         modal.style.display = 'block';
         editButton.style.display = 'block'; // Show the Edit button
         saveButton.style.display = 'none'; // Hide the Save button

         // Disable editing by default when opening modal
         modalHeader.setAttribute('readonly', 'readonly');
         modalBody.querySelector('.edit-content').setAttribute('readonly', 'readonly');
       });
     });

     // Event listener for the "Edit" button within the modal
     editButton.addEventListener('click', function() {
       modalHeader.removeAttribute('readonly'); // Allow editing of the title
       modalBody.querySelector('.edit-content').removeAttribute('readonly'); // Allow editing of the content

       editButton.style.display = 'none'; // Hide the Edit button
       saveButton.style.display = 'block'; // Show the Save button
     });

     saveButton.addEventListener('click', function() {
       const newTitle = modalHeader.value;
       const newContent = modalBody.querySelector('.edit-content').value;

       // Send AJAX request to save changes
       const xhr = new XMLHttpRequest();
       xhr.open('POST', 'update_journal.php', true);
       xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
       xhr.onreadystatechange = function() {
         if (xhr.readyState === 4 && xhr.status === 200) {
           // Update the grid item with new values
           currentGridItem.querySelector('.title').textContent = newTitle;
           currentGridItem.querySelector('.content').textContent = newContent;
           modal.style.display = 'none';
         }
       };
       xhr.send(`entry_id=${currentEntryId}&title=${encodeURIComponent(newTitle)}&content=${encodeURIComponent(newContent)}`);
     });

     closeModal.addEventListener('click', function() {
       modal.style.display = 'none';
     });

     deleteButton.addEventListener('click', function() {
       // Send AJAX request to delete the entry
       const xhr = new XMLHttpRequest();
       xhr.open('POST', 'delete_journal.php', true);
       xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
       xhr.onreadystatechange = function() {
         if (xhr.readyState === 4 && xhr.status === 200) {
           // Remove the current grid item
           currentGridItem.remove();
           modal.style.display = 'none';
         }
       };
       xhr.send(`entry_id=${currentEntryId}`);
     });

     window.addEventListener('click', function(event) {
       if (event.target === modal) {
         modal.style.display = 'none';
       }
     });

     // Search functionality
     const searchInput = document.getElementById('searchInput');
     const noDataMessage = document.getElementById('noDataMessage');

     searchInput.addEventListener('input', function() {
       const searchText = searchInput.value.trim().toLowerCase();

       const gridItems = document.querySelectorAll('.grid-item');
       let found = false;

       gridItems.forEach(item => {
         const title = item.querySelector('.title').textContent.toLowerCase();
         const content = item.querySelector('.content').textContent.toLowerCase();

         if (title.includes(searchText) || content.includes(searchText)) {
           item.style.display = 'block';
           found = true;
         } else {
           item.style.display = 'none';
         }
       });

       // Show/hide "No data" message based on search results
       if (found) {
         noDataMessage.style.display = 'none';
       } else {
         noDataMessage.style.display = 'block';
       }
     });
   });
   </script>

</body>
</html>
