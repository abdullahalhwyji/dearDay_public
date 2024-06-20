<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UI/UX</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
  <style>
    .container {
      display: flex;
      height: 100%;
    }

    main {
      flex-grow: 1;
      background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 40px;
        width: 80%;
        
        text-align: center;
    }

    .search-filter {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .search-filter input[type="text"] {
      width: 60%;
      padding: 10px;
      font-size: 16px;
    }

    .search-filter input[type="date"] {
      width: 20%;
      padding: 10px;
      font-size: 16px;
    }

    .grid-container {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
    }

    .grid-item {
      background: #ffffff;
      padding: 20px; 
      text-align: left;
      border: 1px solid #ddd;
      font-size: 16px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .grid-item:hover {
      transform: translateY(-10px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .grid-item .title {
      width: 100%;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
   
      color: #333;
    }

    .grid-item .date {
      width: 100%;
      text-align: center;
      font-size: 14px;
      color: #888;
      margin-bottom: 15px;
    }

    .grid-item .content {
      flex-grow: 1;
      margin-bottom: 20px;
      color: #555;
      display: -webkit-box;
      -webkit-line-clamp: 2; /* Number of lines to show */
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
      width: 100%;
      
    }

    .grid-item .read-more {
      align-self: flex-start;
      padding: 10px 20px;
      background-color: #007BFF;
      color: white;
      border: none;
      cursor: pointer;
      text-decoration: none;
      border-radius: 5px;
      font-size: 14px;
      transition: background-color 0.3s ease;
    }

    .grid-item .read-more:hover {
      background-color: #0056b3;
    }

    .modal {
  display: none;
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
  backdrop-filter: blur(8px); /* Blur effect */
  padding-top: 80px; /* Increased padding */
}

.modal-content {
  background-color: #fff;
  margin: 10% auto;
  padding: 30px;
  border: none;
  width: 80%;
  max-width: 600px;
  border-radius: 10px;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
  animation: slideIn 0.5s ease-out;
  position: relative; /* Ensure relative positioning for absolute elements */
}

.modal-content .close {
  color: #555;
  font-size: 28px;
  font-weight: bold;
  position: absolute;
  top: 20px;
  right: 20px;
  cursor: pointer;
  transition: color 0.3s;
}

.modal-content .close:hover {
  color: #000;
}

.modal-content .modal-header {
  width: 100%;
  font-size: 24px;
  font-weight: bold;
  color: #333;
  margin-bottom: 10px;
  border-bottom: 1px solid #ddd;
  padding-bottom: 10px;
  text-align: center;
}

.modal-content .modal-date {
  font-size: 14px;
  color: #888;
  margin-bottom: 15px;
  text-align: center;
}

.modal-content .modal-body {
  margin-bottom: 20px;
  
}

.modal-content .edit-content {
  
  width: 100%;
  height: 150px;
  padding: 10px;
  font-size: 16px;
  color: #555;
  border: 1px solid #ddd;
  border-radius: 5px;
  resize: vertical;
}

.modal-content .modal-buttons {
  text-align: center;
}

.modal-content .modal-buttons button {
  padding: 12px 24px;
  margin: 0 10px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  font-size: 14px;
  transition: background-color 0.3s ease;
  width: 20%;
}

.modal-content .modal-buttons .edit {
  background-color: #007bff;
  color: #fff;
  margin: 0 auto; /* Center align the button */
  display: block; /* Ensure it takes full width */
  margin-bottom: 5px;
 
}


.modal-content .modal-buttons .edit:hover {
  background-color: #0056b3;
  margin: 0 auto; /* Center align the button */
  display: block; /* Ensure it takes full width */
  margin-bottom: 5px;
  
}

.modal-content .modal-buttons .save {
  background-color: #28a745;
  color: #fff;
  margin: 0 auto; /* Center align the button */
  display: block; /* Ensure it takes full width */
  margin-bottom: 5px;
}

.modal-content .modal-buttons .save:hover {
  background-color: #218838;
  margin: 0 auto; /* Center align the button */
  display: block; /* Ensure it takes full width */
  margin-bottom: 5px;
}

.modal-content .modal-buttons .delete {
  background-color: #dc3545;
  color: #fff;
}

.modal-content .modal-buttons .delete:hover {
  background-color: #c82333;
}

@keyframes slideIn {
  from {
    transform: translateY(-50px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

.search-filter {
        display: flex;
        justify-content: start;
        margin-bottom: 30px;
    }

   #dateFilter {
        padding: 12px;
        font-size: 18px;
        border: none;
        border-bottom: 2px solid #aaa;
        margin: 0 10px;
        outline: none;
        width: 30%;
        
        text-align: center;
        transition: border-color 0.3s ease;
        align-self: flex-end;
    }

    #searchInput{
        padding: 12px;
        font-size: 18px;
        border: none;
        border-bottom: 2px solid #aaa;
        margin: 0 10px;
        outline: none;
        width: 70%;
        
        text-align: start;
        transition: border-color 0.3s ease;
    }

    #searchInput:focus,
    #dateFilter:focus {
        border-color: #57a2ff;
    }

    #searchInput::placeholder,
    #dateFilter::placeholder {
        color: #aaa;
    }

    #noDataMessage {
        font-size: 24px;
        color: #888;
        display: none;
        margin-top: 20px;
    }

/* Responsive adjustments */
@media (max-width: 768px) {
  .container {
    flex-direction: column; /* Stack columns on smaller screens */
  }

  main {
    padding: 10px; /* Reduce padding for smaller screens */
  }

  .search-filter input[type="text"],
  .search-filter input[type="date"] {
    width: 100%; /* Full width for search inputs on smaller screens */
    margin-bottom: 10px;
  }

  .grid-container {
    grid-template-columns: repeat(2, 1fr); /* Two columns on smaller screens */
  }

  .grid-item {
    padding: 15px; /* Adjust padding for smaller grid items */
    font-size: 14px; /* Decrease font size for better readability */
  }
}

@media (max-width: 480px) {
  .grid-container {
    grid-template-columns: 1fr; /* Single column on even smaller screens */
  }
}


  </style>
</head>
<body>
   <div class="container">
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
           <a href="#" class="active">
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
        <div class="search-filter">
        <input type="text" id="searchInput" placeholder="Search...">
        <input type="date" id="dateFilter">
        </div>

         <div id="noDataMessage" style="display: none; text-align: center; font-size: 24px; margin-top: 20px;">No data found.</div>


        <div class="grid-container">
          <div class="grid-item">
            <div class="title">Title 1</div>
            <div class="date">June 20, 2024</div>
            <div class="content">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
            <a href="#" class="read-more">Read more</a>
          </div>
          <div class="grid-item">
            <div class="title">Title 2</div>
            <div class="date">June 19, 2024</div>
            <div class="content">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
            <a href="#" class="read-more">Read more</a>
          </div>
          <div class="grid-item">
            <div class="title">Title 3</div>
            <div class="date">June 18, 2024</div>
            <div class="content">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</div>
            <a href="#" class="read-more">Read more</a>
          </div>
          
         
          <!-- Add more grid items as needed -->
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

  const readMoreButtons = document.querySelectorAll('.read-more');

  // Event listener for "Read more" buttons in grid items
readMoreButtons.forEach(button => {
  button.addEventListener('click', function(event) {
    event.preventDefault();
    const gridItem = button.closest('.grid-item');
    const title = gridItem.querySelector('.title').textContent;
    const date = gridItem.querySelector('.date').textContent;
    const content = gridItem.querySelector('.content').textContent;

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

    currentGridItem.querySelector('.title').textContent = newTitle;
    currentGridItem.querySelector('.content').textContent = newContent;

    modal.style.display = 'none';
  });

  closeModal.addEventListener('click', function() {
    modal.style.display = 'none';
  });

  deleteButton.addEventListener('click', function() {
    currentGridItem.remove(); // Remove the current grid item

    modal.style.display = 'none';
  });

  window.addEventListener('click', function(event) {
    if (event.target === modal) {
      modal.style.display = 'none';
    }
  });
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





  </script>
</body>
</html>
