document.addEventListener('DOMContentLoaded', function() {
// ******ALL JAVASCRPT CODE GOES INSIDE THIS FUNCTION*******************


////////////////INDEX.PHP TABLE CHECKBOXES?///////////////////////
const checkboxes = document.querySelectorAll('.recordCheckbox');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const checkedCheckboxes = Array.from(checkboxes).filter(cb => cb.checked);
            checkbox.closest('tr').classList.toggle('highlight', checkbox.checked);
        
            // Disable all other checkboxes when at least one is checked
            checkboxes.forEach(cb => {
                if (cb !== checkbox) {
                    cb.disabled = checkedCheckboxes.length > 0;
                }
            });
        });
    });

































    

});  // END OF 'DOMContentLoaded', function()