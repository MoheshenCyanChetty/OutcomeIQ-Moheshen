////////////////SIGN.PHP show button in password input///////////////////////
function togglePassword() {
  var passwordInput = document.getElementById("password");
  var showPasswordButton = document.querySelector(".show-password");

  if (passwordInput.type === "password") {
      passwordInput.type = "text";
      showPasswordButton.textContent = "Hide";
  } else {
      passwordInput.type = "password";
      showPasswordButton.textContent = "Show";
  }
}


////////////////INDEX.PHP BUTTON SECTION///////////////////////
function toggleUploadBox() {
    const uploadBox = document.getElementById('fileInput');
    if (!uploadBox.classList.contains('active')) {
      uploadBox.classList.add('active');
    } else {
      uploadBox.classList.remove('active');
    }
}


////////////////INDEX.PHP TABLE CHECKBOXES///////////////////////
const checkboxes = document.querySelectorAll('input[type="checkbox"]');
const floatingButtons = document.querySelector(".floatingButtons");

function handleCheckboxChange(checkbox) {
  const row = checkbox.closest("tr");
  checkboxes.forEach((cb) => {
    if (cb !== checkbox) {
      cb.checked = false;
      const otherRow = cb.closest("tr");
      otherRow.classList.remove("highlight");
    }
  });

  checkboxes.forEach((cb) => {
    if (cb !== checkbox) {
      cb.disabled = checkbox.checked;
    }
  });

  // Toggle the 'highlight' class on the closest row
  row.classList.toggle("highlight", checkbox.checked);

  // Show/hide the floatingButtons based on whether a row is selected
  floatingButtons.style.display = checkbox.checked ? "block" : "none";
}

checkboxes.forEach((checkbox) => {
  checkbox.addEventListener("change", () => {
    handleCheckboxChange(checkbox);
  });
});

document.querySelectorAll("tr").forEach((row) => {
  row.addEventListener("click", () => {
    const checkbox = row.querySelector('input[type="checkbox"]');
    checkbox.checked = !checkbox.checked;
    handleCheckboxChange(checkbox);
  });
});


////////////////////DISPLAYING MODULES///////////////////////
document.addEventListener('DOMContentLoaded', function() {
  // Get all elements with class 'h3ss'
  var h3Elements = document.querySelectorAll('.h3ss');

  // Add click event listener to each h3 element
  h3Elements.forEach(function(element, index) {
      element.addEventListener('click', function() {
          // Remove 'active' class from all h3 elements
          h3Elements.forEach(function(e) {
              e.classList.remove('active');
          });

          // Add 'active' class to the clicked h3 element
          element.classList.add('active');
      });
  });

  // Add 'active' class to the second h3 element initially
  if (h3Elements.length >= 2) {
      h3Elements[1].classList.add('active');
  }
});