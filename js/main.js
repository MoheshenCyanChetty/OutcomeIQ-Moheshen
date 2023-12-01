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


////////////////////////////////DISPLAYING MODULES//////////////////////////////////////
const h3s = document.querySelectorAll('h3ss');
  
  // Initial active state
  h3s[1].classList.add('active');

  // Click event listener
  h3s.forEach(h3 => {
    h3.addEventListener('click', () => {
      // Deactivate previously active element
      const currentActive = document.querySelector('.active');
      if (currentActive) currentActive.classList.remove('active');
      
      // Activate clicked element
      h3.classList.add('active');
    });
  });