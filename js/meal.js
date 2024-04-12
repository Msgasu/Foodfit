// Function to open the add meal modal
function openAddMealModal() {
    var mealModal = document.getElementById('mealModal');
    mealModal.style.display = 'block';
  }
  

  function closeModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = 'none';
  }

  var modalCloseButton = document.querySelector('#mealModal .modal-close');
  modalCloseButton.addEventListener('click', function() {
    var modalId = this.getAttribute('data-modal-id');
    closeModal(modalId);
  });
  
 
  var addMealButton = document.getElementById('addMealButton');
  addMealButton.addEventListener('click', openAddMealModal);
  
  
  document.getElementById('mealForm').addEventListener('submit', function(event) {
    event.preventDefault(); 
  
    // Get form data
    var mealName = document.getElementById('mealName').value;
    var mealTime = document.getElementById('mealTime').value;
    var mealDate = document.getElementById('mealDate').value;
  
  
    var formData = new FormData();
    formData.append('mealName', mealName);
    formData.append('mealTime', mealTime);
    formData.append('mealDate', mealDate);
  
    // Check if any field is empty
    for (var pair of formData.entries()) {
      if (!pair[1]) {
          Swal.fire({
              icon: 'error',
              title: 'Validation Error',
              text: 'Please fill out all fields',
             
          });
          return; 
      }
  }
  

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../action/add_a_meal_action.php', true);
    xhr.onload = function() {

        if (this.status === 200 && this.readyState == 4) {
            Swal.fire({
                icon: 'success',
                title: 'Meal Added',
                text: 'Your meal has been successfully added',
  
            }).then(() => {
                window.location.href = '../vieww/plan_meal.php'; 
            });
        } else {
            console.error('Error:', xhr.statusText);
        }
    };
    xhr.onerror = function() {
        console.error('Request failed');
    };
    xhr.send(formData);
  });







  // EDITING A MEAL
  // Function to open the edit meal modal
  function openEditMealModal(event) {
    var editMealModal = document.getElementById('editMealModal');
    editMealModal.style.display = 'block';
    var mealId = event.currentTarget.getAttribute('data-meal-id');
    document.getElementById('editMealId').value = mealId;
  }
  

  var editMealButtons = document.querySelectorAll('.edit-meal-button');
  editMealButtons.forEach(function(button) {
    button.addEventListener('click', openEditMealModal);
  });
  
  function closeEditMealModal() {
    var editMealModal = document.getElementById('editMealModal');
    editMealModal.style.display = 'none';
  }
  

  var editMealModalCloseButton = document.querySelector('#editMealModal .modal-close');
  editMealModalCloseButton.addEventListener('click', function() {
    closeEditMealModal();
  });


  document.getElementById("updateMeal").addEventListener("click", function(event) {
    event.preventDefault();
  
    
    var formData = new FormData(document.getElementById("editMealForm"));
  
    for (var pair of formData.entries()) {
        if (!pair[1]) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please fill out all fields',
  
            });
            return; 
        }
    }
  
    closeEditMealModal();
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {

                Swal.fire({
                    icon: 'success',
                    title: 'Meal Updated',
                    text: 'Your meal has been successfully updated',
  
                }).then(() => {
                    window.location.reload(); 
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to update meal',
  
                });
            }
        }
    };
    xhr.open("POST", "../action/edit_a_meal_action.php", true);
    xhr.send(formData);
  });
  


  // DELETING MEALS
  function openDeleteModal(event) {
    var mealId = event.currentTarget.getAttribute('data-meal-id');
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.style.display = 'block';
    document.getElementById('deleteMealId').value = mealId;
  }
  
  var deleteButtons = document.querySelectorAll('.delete-meal-button');
  deleteButtons.forEach(function(button) {
    button.addEventListener('click', openDeleteModal);
  });


  
  // Function to close the delete modal
  function closeDeleteModal() {
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.style.display = 'none';
  }
  
  document.getElementById('cancelDeleteButton').addEventListener('click', function() {
    closeDeleteModal();
  });
  
  document.getElementById('confirmDeleteButton').addEventListener('click', function() {
    var mealId = document.getElementById('deleteMealId').value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
               
                closeDeleteModal();
                Swal.fire({
                    icon: 'success',
                    title: 'Meal Deleted',
                    text: 'Your meal has been successfully deleted',
  
                }).then(() => {
                    window.location.reload(); 
                });
            } else {
          
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to delete meal',
  
                });
            }
        }
    };
    xhr.onerror = function() {
      
        console.error('Request failed');
        
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to delete meal',
  
        });
    };
    xhr.open("POST", "../action/delete_a_meal_action.php", true); 
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("mealId=" + mealId); 
  });
  