document.addEventListener('DOMContentLoaded', function() {
// ******ALL JAVASCRPT CODE GOES INSIDE THIS FUNCTION*******************

////////////////INDEX.PHP BUTTON SECTION///////////////////////
function showImportButton() {
  var fileInput = document.getElementById("fileInput");
  fileInput.classList.remove("hidden-element");

  // Add an event listener to the document to hide the upload button when clicked anywhere else
  document.addEventListener('click', function(event) {
    var isClickInsideFileInput = fileInput.contains(event.target);

    if (!isClickInsideFileInput) {
      fileInput.classList.add("hidden-element");
    }
  });
}


function validateForm() {
        var fileInput = document.getElementById("fileInput");
        if (fileInput.files.length === 0) {
            alert("Please select a file before submitting.");
            return false;
        }
        return true;
}




////////////////INDEX.PHP TABLE CHECKBOXES///////////////////////
const checkboxes = document.querySelectorAll('input[type="checkbox"]');
const floatingButtons = document.querySelector('.floatingButtons');

function handleCheckboxChange(checkbox) {
    const row = checkbox.closest('tr');
    checkboxes.forEach(cb => {
        if (cb !== checkbox) {
            cb.checked = false;
            const otherRow = cb.closest('tr');
            otherRow.classList.remove('highlight');
        }
    });

    checkboxes.forEach(cb => {
        if (cb !== checkbox) {
            cb.disabled = checkbox.checked;
        }
    });

    // Toggle the 'highlight' class on the closest row
    row.classList.toggle('highlight', checkbox.checked);

    // Show/hide the floatingButtons based on whether a row is selected
    floatingButtons.style.display = checkbox.checked ? 'block' : 'none';
}

checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
        handleCheckboxChange(checkbox);
    });
});

document.querySelectorAll('tr').forEach(row => {
    row.addEventListener('click', () => {
        const checkbox = row.querySelector('input[type="checkbox"]');
        checkbox.checked = !checkbox.checked;
        handleCheckboxChange(checkbox);
    });
});














    

});  // END OF 'DOMContentLoaded', function()