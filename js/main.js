document.addEventListener('DOMContentLoaded', function() {
// ******ALL JAVASCRPT CODE GOES INSIDE THIS FUNCTION*******************


////////////////INDEX.PHP TABLE CHECKBOXES?///////////////////////
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










// table borders




  


































    

});  // END OF 'DOMContentLoaded', function()