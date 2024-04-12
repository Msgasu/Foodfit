
const editProgressModal = document.getElementById('editProgressModal');
const openEditProgressModalBtns = document.querySelectorAll('.edit-tracking-button');

// Function to open the edit progress modal
function openEditProgressModal(progressId, progressUpdate) {
    document.getElementById('editProgressId').value = progressId;
    document.getElementById('editProgressUpdate').value = progressUpdate;
    editProgressModal.style.display = 'block';
}


// Function to close the edit progress modal
function closeEditProgressModal() {
    editProgressModal.style.display = 'none';
}


openEditProgressModalBtns.forEach(function(button) {
    button.addEventListener('click', function() {
        const progressId = this.getAttribute('data-tracking-id');
        const progressUpdate = this.parentNode.parentNode.querySelector('td:nth-child(2)').innerText;
        openEditProgressModal(progressId, progressUpdate);

        // Debugging
        const trackingId = this.getAttribute('data-tracking-id');
        console.log('Tracking ID of the icon clicked:', trackingId);
    });
});


//Edit
editProgressModal.querySelector('.close').addEventListener('click', function() {
    closeEditProgressModal();
});

document.getElementById('saveEditProgress').addEventListener('click', function() {
    const formData = new FormData(document.getElementById('editProgressForm'));

    $.ajax({
        url: '../action/edit_progress_action.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response);
            if (response.includes("successfully")) {
                
                closeEditProgressModal();
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response,
                    confirmButtonText: 'OK'
                }).then(() => {
                   
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response || 'An error occurred while processing your request.',
                });
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'An error occurred while processing your request.',
            });
        }
    });
});



// Update
function updateTableContent(formData) {
    const progressId = formData.get('progressId');
    const progressUpdate = formData.get('progressUpdate');
    
    const tableCell = document.getElementById(`progressUpdate_${progressId}`);
    if (tableCell) {
        tableCell.textContent = progressUpdate;
    }
}

const deleteProgressModal = document.getElementById('deleteProgressModal');
const confirmDeleteProgressButton = document.getElementById('confirmDeleteProgressButton');
const cancelDeleteProgressButton = document.getElementById('cancelDeleteProgressButton');

//delete
function openDeleteProgressModal(progressId) {
    document.getElementById('deleteProgressId').value = progressId;
    deleteProgressModal.style.display = 'block';
}

function closeDeleteProgressModal() {
    deleteProgressModal.style.display = 'none';
}

document.querySelectorAll('.delete-tracking-button').forEach(function(button) {
    button.addEventListener('click', function() {
        const progressId = this.getAttribute('data-tracking-id');
        //debugging
        console.log('Tracking ID of the icon clicked:', progressId);
        openDeleteProgressModal(progressId);
    });
});



confirmDeleteProgressButton.addEventListener('click', function() {
    const progressId = document.getElementById('deleteProgressId').value;

   
    $.ajax({
        url: '../action/delete_a_progress_update_action.php', 
        type: 'POST',
        data: { progressId: progressId }, 
        success: function(response) {
            console.log(response);
            closeDeleteProgressModal();

            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Progress tracking entry deleted successfully!',
                confirmButtonText: 'OK'
            }).then(() => {
                location.reload(); 
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'An error occurred while processing your request.',
            });
        }
    });
});


cancelDeleteProgressButton.addEventListener('click', closeDeleteProgressModal);



//Save
const progressModal = document.getElementById('progressModal');
const openProgressModalBtn = document.querySelector('.add-progress-button');


function openModal(goalId) {
    progressModal.style.display = 'block';
    document.getElementById('selectedGoalId').value = goalId;
}


function closeModal() {
    progressModal.style.display = 'none';
}


openProgressModalBtn.addEventListener('click', function() {
    const goalId = this.getAttribute('data-goal-id');
    openModal(goalId);
});


progressModal.querySelector('.close').addEventListener('click', closeModal);


document.getElementById('saveProgress').addEventListener('click', function() {

    const formData = new FormData(document.getElementById('progressForm'));

    $.ajax({
        url: '../action/add_a_progress_update_action.php', 
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
        
            console.log(response);

            try {
               
                const jsonResponse = JSON.parse(response);

                if (jsonResponse.success) {
                   closeModal();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Progress update added successfully!',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        
                        location.reload();
                    });
                } else {
                    
                    if (jsonResponse.error === 'foreign_key_constraint') {
                      
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Add a goal before you add your progress',
                        });
                    } else {
                    
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: jsonResponse.message || 'An error occurred while processing your request.',
                        });
                    }
                }
            } catch (error) {
          
                console.error('Error parsing JSON:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'An error occurred while parsing the server response.',
                });
            }
        },
        error: function(xhr, status, error) {
            
            console.error(error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'An error occurred while processing your request.',
            });
        }
    });
});
