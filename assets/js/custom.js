
$(document).ready(function() {
    $('#studentMenuItem').click(function(e) {
        e.preventDefault(); // লিঙ্কের ডিফল্ট কার্যকারিতা বন্ধ করুন

        // Ajax er maddhome student page load kora
        $('#contentArea').load('../student/list_student.php .sdl_studentListBody', function() {
            // Load student data after loading the page
            $.ajax({
                url: '../student/fetch_students.php', // Fetch script's URL
                type: 'GET',
                success: function(data) {
                    $('#studentListBody').html(data); // Load the response into the student list body
                    history.pushState(null, '', '../student/list_student.php'); // Address bar e slug update
                },
                error: function() {
                    alert('Error loading student data.'); // Show error message
                }
            });
        });
    });

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
});