
document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('entry-form');

  form.addEventListener('submit', function(event) {
      event.preventDefault();

      const title = document.querySelector('.entry-title').value;
      const content = document.querySelector('.entry-textbox').value;

      if (title && content) {
          const xhr = new XMLHttpRequest();
          xhr.open('POST', '../php/save_entry.php', true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

          xhr.onreadystatechange = function() {
              if (xhr.readyState === 4 && xhr.status === 200) {
                  // Handle response here, like updating the entries list or showing a success message
                  console.log(xhr.responseText);
                  // Optionally, you can refresh the entries section or clear the form here
                  form.reset();
              }
          };

          const params = 'title=' + encodeURIComponent(title) + '&content=' + encodeURIComponent(content);
          xhr.send(params);
      } else {
          alert('Please fill in both the title and content.');
      }
  });
});

(function () {
  //
  // Variables
  //
  const entryForm = document.querySelector("#entry-form");
  const entriesList = document.querySelector(".entries-list");
  const entryTitle = document.querySelector(".entry-title");
  const entryTextbox = document.querySelector(".entry-textbox");

  const lastChangedSpan = document.querySelector(".date-updated");

  var entries = [];
  readData();
  updateEntries();
  //
  // Methods
  //

  function onEntrySubmit(event) {
    event.preventDefault();

    addNewEntry(entryTitle.value, entryTextbox.value);
    updateEntries();
    clearInputFields();

    console.log(entries);
  }

  // Add entry
  function addNewEntry(title, description) {
    let entry = {
      entryTitle: title,
      entryDescription: description,
      entryDate: getCurrentDateTime(),
    };

    entries.push(entry);
    saveData();
  }

  function updateEntries() {
    // Clear out entires from list in html dom
    entriesList.innerHTML = "";

    entries.forEach(function (entry, index) {
      const displayEntryBtn = document.createElement("button");
      displayEntryBtn.className = "display-entry-button";
      displayEntryBtn.innerText = entry.entryDate;
      entriesList.appendChild(displayEntryBtn); // Insert at the start of entires

      const deleteEntryBtn = document.createElement("button");
      deleteEntryBtn.className = "delete-entry-button";
      deleteEntryBtn.innerText = "Delete";
      entriesList.appendChild(deleteEntryBtn); // Insert at the start of entires

      const singleEntryTitleEl = document.createElement("h3");
      singleEntryTitleEl.className = "single-entry title";
      singleEntryTitleEl.innerText = entry.entryTitle;
      singleEntryTitleEl.style.display = "none";
      entriesList.appendChild(singleEntryTitleEl);

      const singleEntryTextEl = document.createElement("div");
      singleEntryTextEl.className = "single-entry clear";
      singleEntryTextEl.innerText = entry.entryDescription;
      singleEntryTextEl.style.display = "none";
      entriesList.appendChild(singleEntryTextEl);

      displayEntryBtn.addEventListener("click", function () {
        // Hide all entries upon display entry button click
        const allEntries = document.querySelectorAll(".single-entry");
        allEntries.forEach((element) => {
          element.style.display = "none";
        });

        // Only show currently pressed entry
        singleEntryTitleEl.style.display = "block";
        singleEntryTextEl.style.display = "block";
      });

      deleteEntryBtn.addEventListener("click", function () {
        deleteAtIndex(index);
      });
    });

    getLastChangedDate();
  }

  function readData() {
    let parsedEntries = JSON.parse(localStorage.getItem("entries"));

    if (parsedEntries) {
      entries = parsedEntries;
    }

    getLastChangedDate();
  }

  function saveData() {
    localStorage.setItem("entries", JSON.stringify(entries));
    localStorage.setItem(
      "lastChangedDate",
      JSON.stringify(getCurrentDateTime())
    );
  }

  function deleteAtIndex(index) {
    console.log("Want to delete at index: " + index);
    entries.splice(index, 1);
    saveData();
    updateEntries();
  }

  function getLastChangedDate() {
    let parsedDate = JSON.parse(localStorage.getItem("lastChangedDate"));

    if (parsedDate) {
      lastChangedSpan.textContent = "Last updated: " + parsedDate;
      console.log(parsedDate);
    } else {
      lastChangedSpan.textContent = "";
    }
  }

  function clearInputFields() {
    entryTitle.value = "";
    entryTextbox.value = "";
  }

  // Gets current date time
  function getCurrentDateTime() {
    let nowDate = new Date();
    nowDate.toLocaleDateString("en-US", {
      month: "long",
      day: "2-digit",
      year: "numeric",
      hour: "2-digit",
    });

    return nowDate.toLocaleString();
  }

  //
  // Inits & Event Listeners
  //
  entryForm.addEventListener("submit", onEntrySubmit);
})();



