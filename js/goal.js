$(document).ready(function() {
    var modal = $("#goalModal");
    var editModal = $("#editGoalModal");
    var deleteModal = $("#deleteModal"); 

    // Function to open modal
    function openModal(modal) {
        modal.show();
    }

    // Function to close modal
    function closeModal(modal) {
        modal.hide();
    }

    // Function to disable goal selection
    function disableGoalSelection() {
        $(".goal-widget").off("click");
        $(".goal-widget").css("pointer-events", "none"); 
    }

    // Function to enable goal selection
    function enableGoalSelection() {
        $(".goal-widget").on("click"); 
        $(".goal-widget").css("pointer-events", "auto"); 
    }

   
    $(document).on("click", ".goal-widget", function() {
        var selectedGoal = $(this).siblings(".goal-text").text();
        $("#selectedGoalInput").val(selectedGoal);
        openModal(modal);
    });


    // Open edit modal when clicking on edit button
    $(document).on("click", ".edit-goal-button", function() {
        var goalId = $(this).data("selectedGoalId");
        var selectedGoal = $("#goalDescription_" + goalId).text();
        $("#selectedGoalId").val(goalId);
        $("#selectedGoalInput").val(selectedGoal);
        openModal(editModal);
    });


    // Close modals when clicking on close button or outside the modal
    $(".close, .modal").click(function(event) {
        if (event.target === modal[0] || $(event.target).hasClass("close")) {
            closeModal(modal);
        }
        if (event.target === editModal[0] || $(event.target).hasClass("close")) {
            closeModal(editModal);
        }
        if (event.target === deleteModal[0] || $(event.target).hasClass("cancel-button")) {
            closeModal(deleteModal);
        }
    });


    // Open delete modal when clicking on delete button
    $(document).on("click", ".delete-goal-button", function() {
        var goalId = $(this).data("selectedGoalId");
        $("#deleteGoalId").val(goalId);
        openModal(deleteModal);
    });

    // Save goal 
    $("#saveGoalBtn").click(function() {
        var selectedGoal = $("#selectedGoalInput").val();
        var customGoal = $("#customGoal").val();
        var duration = $("#duration").val();

        if (selectedGoal === "" || customGoal === "" || duration === null) {
            Swal.fire({
                icon: 'error',
                title: 'Relax...',
                text: 'Please fill in all fields.',
            });
            return;
        }


        $.ajax({
            url: "../action/add_a_goal_action.php",
            method: "POST",
            data: {
                selectedGoal: selectedGoal,
                customGoal: customGoal,
                duration: duration
            },
            success: function(response) {
                closeModal(modal);
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Goal added successfully!',
                }).then(() => {
                    location.reload(); 
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'An error occurred while adding the goal.',
                });
            }
        });
    });

 

    //Editing
    $("#saveEditBtn").click(function() {
    
        var editedCustomGoal = $("#editCustomGoal").val();
        var editedWeek = $("#editWeek").val();
        var status = $("select[name='status']").val();

        if (editedCustomGoal === "" || editedWeek === "" || status === null) {
            Swal.fire({
                icon: 'error',
                title: 'Relax...',
                text: 'Please fill in all fields.',
            });
            return;
        }

        var goalId = $("#selectedGoalId").val();
        var editedCustomGoal = $("#editCustomGoal").val();
        var editedWeek = $("#editWeek").val();
        var status = $("select[name='status']").val();

        $.ajax({
            url: "../action/edit_a_goal_action.php",
            method: "POST",
            data: {
                goalId: goalId,
                editCustomGoal: editedCustomGoal,
                editWeek: editedWeek,
                status: status
            },
            success: function(response) {
                closeModal(editModal);
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Goal has been updated!',
                }).then(() => {
                    location.reload(); 
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Hold on...',
                    text: 'An error occurred while editing the goal.',
                });
            }
        });
    });




    //  delete 
    $("#confirmDeleteButton").click(function() {
        var goalId = $("#deleteGoalId").val();

        $.ajax({
            url: "../action/delete_a_goal_action.php",
            method: "POST",
            data: {
                goalId: goalId
            },
            success: function(response) {
                closeModal(deleteModal);
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Goal deleted successfully!',
                }).then(() => {
                    location.reload(); 
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'An error occurred while deleting the goal.',
                });
            }
        });
    });
});

