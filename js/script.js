document.addEventListener("DOMContentLoaded", function() {
  var modal = document.getElementById("addNoteForm");
  var btn = document.getElementById("addNoteBtn");
  var span = document.getElementsByClassName("close")[0];

  btn.onclick = function() {
    document.getElementById("overlay1").style.display = "block"; // Display the modal when the button is clicked
  };

  span.onclick = function() {
    document.getElementById("overlay1").style.display = "none"; // Hide the modal when the close button is clicked
  };
});

document.addEventListener("DOMContentLoaded", function () {
  // Event listener for the "All Notes" option
  document.getElementById("allNotes").addEventListener("click", function () {
    // Remove the 'hidden' class from the notes grid
    document.getElementById("notesGrid").classList.remove("hidden");
    document.getElementById("favorit").classList.add("hidden");
    document.getElementById("archiv").classList.add("hidden");
    // Update the page title
    document.getElementById("pageTitle").textContent = "All Notes";
  });
});
document.addEventListener("DOMContentLoaded", function () {
  // Event listener for the "All Notes" option
  document.getElementById("favoriteBtn").addEventListener("click", function () {
    // Remove the 'hidden' class from the notes grid
    document.getElementById("favorit").classList.remove("hidden");
    document.getElementById("notesGrid").classList.add("hidden");
    document.getElementById("archiv").classList.add("hidden");
    // Update the page title
    document.getElementById("pageTitle").textContent = "Favorites";
  });
});
document.addEventListener("DOMContentLoaded", function () {
  // Event listener for the "All Notes" option
  document.getElementById("archive").addEventListener("click", function () {
    // Remove the 'hidden' class from the notes grid
    document.getElementById("archiv").classList.remove("hidden");
    document.getElementById("notesGrid").classList.add("hidden");
    document.getElementById("favorit").classList.add("hidden");
    // Update the page title
    document.getElementById("pageTitle").textContent = "Archives";
  });
});



window.onclick = function (event) {
  if (
    event.target != modal &&
    !modal.contains(event.target) &&
    event.target != btn
  ) {
    modal.style.display = "none";
  }
};
var lis = document.querySelectorAll(".sidebar ul li");
lis.forEach(function (li) {
  li.addEventListener("click", function () {
    var pageTitle = document.getElementById("pageTitle");
    pageTitle.textContent = li.textContent;
  });
});

function toggleMenu(threeDots) {
  const dropdownMenu = threeDots.nextElementSibling; // Get the next sibling element
  dropdownMenu.classList.toggle("hidden"); // Toggle the 'hidden' class
}

// Function to handle the 'View' option
function viewNote() {
  // Find the parent note element
  const noteElement = event.target.closest(".note");

  // Retrieve the note content
  const noteContent = noteElement.querySelector(".note-content p").textContent;

  // Display the note content
  alert(noteContent);
}

// Function to handle the 'Edit' option
function editNote() {

}

// Function to handle the 'Delete' option
function deleteNote() {
  // Your code to delete the note
}

let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");
let searchBtn = document.querySelector(".bx-search");

closeBtn.addEventListener("click", () => {
  sidebar.classList.toggle("open");
  menuBtnChange(); //calling the function(optional)
});

searchBtn.addEventListener("click", () => {
  // Sidebar open when you click on the search iocn
  sidebar.classList.toggle("open");
  menuBtnChange(); //calling the function(optional)
});

// following are the code to change sidebar button(optional)
function menuBtnChange() {
  if (sidebar.classList.contains("open")) {
    closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
  } else {
    closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
  }
}
function searchMessages() {
  // Get the input value
  const searchText = document.getElementById("searchInput").value.toLowerCase();

  // Get all the note content elements
  const noteContents = document.querySelectorAll(".note-content p");

  // Iterate over each note content element
  noteContents.forEach(function (noteContent) {
    const noteText = noteContent.textContent.toLowerCase();
    const noteElement = noteContent.closest(".note");

    // If the note content contains the search text, display the note; otherwise, hide it
    if (noteText.includes(searchText)) {
      noteElement.style.display = "block";
    } else {
      noteElement.style.display = "none";
    }
  });
}

function toggleAndView(noteId) {
  var listItem = document.querySelector(".eye-icon");
  // Toggle a class to indicate if it's clicked or not
  fetchNoteContent(noteId);
  listItem.classList.toggle("clicked");
  // Check if the class is present
  if (listItem.classList.contains("clicked")) {
    // Show the view div
    document.querySelector(".overlay").style.display = "flex";
    // Scroll to the target div
    var targetDiv = document.querySelector(".overlay");
    targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });

    // Fetch the note content using AJAX
    
  } else {
    // Hide the view div
    document.querySelector(".overlay").style.display = "none";
    // Do something else if needed
  }
}
function hideOverlay() {
  // Hide the overlay when clicked
  document.getElementById("overlay").style.display = "none";
  document.getElementById("view").innerHTML = "";
}

function fetchNoteContent(noteId) {
  // AJAX request to fetch note content
  fetch('includes/viewNote.php?noteId=' + noteId)
    .then(response => response.text())
    .then(data => {
      // Display the note content in the view div
      document.getElementById("view").innerHTML = data;
    })
    .catch(error => {
      console.error('Error fetching note content:', error);
    });
}

function goToDashboard() {
  window.location.href = "dashboard.php";
}

function displayNote(noteId) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var noteData = JSON.parse(this.responseText);
      var viewContainer = document.querySelector(".view");
      // Set new note content
      viewContainer.innerHTML =
        "<h1>" + noteData.title + "</h1><hr><p>" + noteData.content + "</p>";
    }
  };
  // Simulate fetching note data from the server
  var noteData = {
    title: "Note Title", // Replace with actual title
    content: "Note Content", // Replace with actual content
  };
  // Call the onreadystatechange function manually with simulated note data
  xhr.onreadystatechange();
}
function delete_note(id) {
  if (confirm("Do you confirm to delete this note?")) {
    window.location = "includes/delete_note.php?delete=" + id;
  }
}
function archive_note(id) {
  if (confirm("Do you confirm to Archive this note?")) {

    window.location = "includes/archiveNote.php?archive=" + id;

  }
}
function restore_note(id) {
  if (confirm("Do you confirm to Restore this note?")) {
    window.location = "includes/restoreNote.php?restore=" + id;
  }
}



function editNote(noteId) {
  if (confirm("Do you confirm to update this note?")) {
      var listItem = document.querySelector(".pen-icon");
      // Toggle a class to indicate if it's clicked or not
      fetchNoteContents(noteId);
      listItem.classList.toggle("clicked");
      // Check if the class is present
      if (listItem.classList.contains("clicked")) {
          // Show the view div
          document.querySelector(".overlay2").style.display = "flex";
          // Scroll to the target div
          var targetDiv = document.querySelector(".overlay2");
          targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });

          document.querySelector(".close").addEventListener("click", function() {
            document.querySelector(".overlay2").style.display = "none";
        });
      } else {
          // Hide the view div
          document.querySelector(".overlay2").style.display = "none";
          // Do something else if needed
      }

      // Add event listener to the close button to hide the form

  }
}

function hideOverlay2() {
  // Hide the overlay when clicked
  document.getElementById("overlay2").style.display = "none";
  document.getElementById("updateForm").innerHTML = "";
}

function fetchNoteContents(noteId) {
  // AJAX request to fetch note content
  fetch('includes/updateForm.php?noteId=' + noteId)
      .then(response => response.text())
      .then(data => {
          // Display the note content in the view div
          document.getElementById("updateForm").innerHTML = data;
      })
      .catch(error => {
          console.error('Error fetching note content:', error);
      });
}



document.addEventListener("DOMContentLoaded", function() {
  const navLinks = document.querySelectorAll('.nav-link');

  navLinks.forEach(function(navLink) {
    navLink.addEventListener('click', function(event) {
      // Remove active class from all links
      navLinks.forEach(function(link) {
        link.classList.remove('active');
      });

      // Add active class to the clicked link
      navLink.classList.add('active');
    });
  });
});
document.addEventListener("DOMContentLoaded", function() {
  const navLinks = document.querySelectorAll('.nav-link');

  navLinks.forEach(function(navLink) {
    navLink.addEventListener('click', function(event) {
      // Remove active class from all links
      navLinks.forEach(function(link) {
        link.classList.remove('active');
      });

      // Add active class to the clicked link
      navLink.classList.add('active');
    });

    // Check if the current URL matches the href attribute of the link
    if (window.location.href === navLink.href) {
      navLink.classList.add('active');
    }
  });
});
function submitform()
{
document.forms["forms"].submit();
}
function toggleFavorite(event) {
  event.preventDefault(); // Prevent default link behavior

  var icon = event.currentTarget.querySelector('i'); // Get the <i> element within the clicked <li>
  var isFavorite = icon.classList.contains('fas'); // Check if the icon is filled (favorite)
  var noteId = event.currentTarget.getAttribute('data-note-id');

  // Update the icon color
  if (isFavorite) {
      icon.classList.remove('fas', 'favorite'); // Remove filled class and color class
      icon.classList.add('far'); // Add empty class
  } else {
      icon.classList.remove('far'); // Remove empty class
      icon.classList.add('fas', 'favorite'); // Add filled class and color class
  }

  // Perform AJAX request to update favorite status in the database
  var formData = new FormData();
    formData.append('noteId', noteId);
    formData.append('isFavorite', isFavorite ? 0 : 1);

  // var formData = new FormData();
  //   formData.append('noteId', noteId);
  //   formData.append('isFavorite', !isFavorite);


  fetch('./includes/favorite.php', {
      method: 'POST',
      body: formData
  })
  .then(response => {
      if (!response.ok) {
          throw new Error('Network response was not ok');
      }
      return response.text();
  })
  .then(data => {
      console.log(data);
      console.log(isFavorite); // Log success message from PHP script
      window.location.href = "./dashboard.php";
      document.getElementById("archiv").classList.remove("hidden");
      document.getElementById("pageTitle").textContent = "Archives";
  })
  .catch(error => {
      console.error('There was a problem with the fetch operation:', error);
  });
}
