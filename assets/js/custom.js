
// =================== add_student form validation
$(document).ready(function () {
    $('#submitBtn').on('click', function (e) {
        e.preventDefault();

        // Clear previous error messages
        $('.error-message').text('');

        $.ajax({
            url: '../inc/program_code.php', // Change this to your validation handling script
            type: 'POST',
            data: $('#signupForm').serialize(),
            dataType: 'json',

            beforeSend: function() {
                $('#signUpLoading').show();
            },
            complete: function() {
                $('#signUpLoading').hide();
                },

            success: function (response) {
                if (response.success) {
                    alert('Form submitted successfully');
                    // Redirect or perform any action upon successful submission
                    window.location.href = '/oop_project/index.php'; // Redirect after success
                } else {
                    // Show validation error messages
                    if (response.errors.name) {
                        $('#nameError').text(response.errors.name);
                    }
                    if (response.errors.phone) {
                        $('#phoneError').text(response.errors.phone);
                    }
                    if (response.errors.email) {
                        $('#emailError').text(response.errors.email);
                    }
                    if (response.errors.user_name) {
                        $('#userNameError').text(response.errors.user_name);
                    }
                    if (response.errors.pass) {
                        $('#passwordError').text(response.errors.pass);
                    }
                }
            },
            error: function () {
                alert('An error occurred. Please try again.');
            }
        });
    });
});

// ****************
                                // student delete with ajax
    $(document).ready(function() {
        $(document).on('click', '.sdl_btnn', function(e) {
             e.preventDefault(); // Prevent default link behavior
    
            var studentID = $(this).data("id"); // Get the student's ID
            var rowElement = $(this).closest('tr'); // The row to be deleted
    
            if (confirm("Are you sure you want to delete this student?")) {
                $.ajax({
                    type: "POST",
                    url: "delt_student.php",
                    data: { deleteid: studentID },
                    
                    // Show spinner before sending the request
                    beforeSend: function() {
                        $('#loadingSpinner').show();
                    },
                    
                    success: function(response) {
                        if (response === 'success') {
                            rowElement.fadeOut(); // Remove row if successful
                        } else {
                            alert("Failed to delete data.");
                        }
                    },
                    
                    // Hide spinner once the request completes
                    complete: function() {
                        $('#loadingSpinner').hide();
                    },
                    
                    error: function() {
                        alert("An error occurred while processing the request.");
                    }
                });
            }
        });
    });

    // student form ajax load after click the submit button
    $(document).ready(function() {
        $(document).on('click', '#delBtn', function(e) {
            
        });
    });


// student list page load with ajax

$(document).ready(function() {
    // $('#studentMenuItem').click(function(e) {
    // $(document).on('click','#studentMenuItem', function(e) {
    //     e.preventDefault(); // turn off default work

    //     // Ajax er maddhome student page load kora
    //     $('#contentArea').load('../student/list_student.php .sdl_studentListBody', function() {
    //         // Load student data after loading the page
    //         $.ajax({
    //             url: '../student/fetch_students.php', // Fetch script's URL
    //             type: 'GET',
    //             success: function(data) {
    //                 $('#studentListBody').html(data); // Load the response into the student list body
    //                 history.pushState(null, '', '../student/list_student.php'); // Address bar e slug update
    //             },
    //             error: function() {
    //                 alert('Error loading student data.'); // Show error message
    //             }
    //         });
    //     });
    // });

    // ******************************

    // Back navigation support
    $(window).on('popstate', function() {
        $('#contentArea').load(location.pathname + ' .sdl_studentListBody', function() {
            // Optional: You can reload the student data if needed
            $.ajax({
                url: '../student/fetch_students.php',
                type: 'GET',
                success: function(data) {
                    $('#studentListBody').html(data); // Load the response into the student list body
                },
                error: function() {
                    alert('Error loading student data.');
                }
            });
        });
    });
});