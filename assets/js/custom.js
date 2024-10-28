
$(document).ready(function() {
    // $('#studentMenuItem').click(function(e) {
    // // $(document).on('click','#studentMenuItem', function(e) {
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

    // Back navigation support
    // $(window).on('popstate', function() {
    //     $('#contentArea').load(location.pathname + ' .sdl_studentListBody', function() {
    //         // Optional: You can reload the student data if needed
    //         $.ajax({
    //             url: '../student/fetch_students.php',
    //             type: 'GET',
    //             success: function(data) {
    //                 $('#studentListBody').html(data); // Load the response into the student list body
    //             },
    //             error: function() {
    //                 alert('Error loading student data.');
    //             }
    //         });
    //     });
    // });
});

// =================== add_student file check
document.getElementById("image").addEventListener("change", function() {
    const fileInput = document.getElementById("image");
    const fileSizeError = document.getElementById("fileSizeError");
    const fileFormatError = document.getElementById("fileFormatError");
    const submitButton = document.getElementById("stdn_submit");
    const allowedFormats = ["jpg", "jpeg", "png", "gif"];
    let valid = true;

    // Reset error messages
    fileSizeError.style.display = "none";
    fileFormatError.style.display = "none";

    // Check if file is selected
    if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        const fileSize = file.size / 1024; // Size in KB
        const fileExtension = file.name.split('.').pop().toLowerCase();

        // Check file size
        if (fileSize > 500) {
            fileSizeError.style.display = "inline";
            valid = false;
        }

        // Check file format
        if (!allowedFormats.includes(fileExtension)) {
            fileFormatError.style.display = "inline";
            valid = false;
        }

        // Disable submit button if not valid
        submitButton.disabled = !valid;
    } else {
        submitButton.disabled = false; // Enable if no file is selected
    }

    submitButton.disabled = false;

});

// ****************

$(document).ready(function() {
    $(document).on('click', '#delBtn', function(e) {
        e.preventDefault(); // Prevent default link behavior
        var stndID = $(this).data("id"); 
        var element = this;

        if (confirm("Are you sure you want to delete this student?")) {
            $.ajax({
                type: "POST",
                url: "delt_student.php",
                data: { deleteid: stndID }, // Update key to match PHP file
                success: function(response) {
                    if (response === 'success') {
                        $(element).closest('tr').fadeOut();
                    } else {
                        alert("Failed to delete data.");
                    }
                },
                error: function() {
                    alert("An error occurred while processing the request.");
                }
            });
        }
    });
});

