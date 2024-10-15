
$(document).ready(function() {
    $('#studentMenuItem').click(function(e) {
        e.preventDefault(); // লিঙ্কের ডিফল্ট কার্যকারিতা বন্ধ করুন
        $('#contentArea').load('../student/list_student.php .sdl_studentListBody'); // list_student.php লোড করুন
    });
});

// load student /////////////////////
$(document).ready(function() {
    // Load student data when the button is clicked
    $('#studentMenuItem').click(function() {
        $.ajax({
            url: '../student/fetch_students.php', // Fetch script's URL
            type: 'GET',
            success: function(data) {
                $('#studentListBody').html(data); // Load the response into the student list body
            },
            error: function() {
                alert('Error loading student data.'); // Show error message
            }
        });
    });
});

                // MODAL SCRIPT **************
                
                $(document).ready(function() {
                    $('#addStudentForm').on('submit', function(e) {
                        e.preventDefault(); // Prevent default form submission
                
                        var formData = new FormData(this); // Create a FormData object to handle file uploads
                
                        $.ajax({
                            url: '../student/add_student.php',
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                alert('Student added successfully!');
                                // Optionally reload the student list
                                $('#studentListBody').load('../student/fetch_students.php');
                                $('#addStudentModal').modal('hide'); // Close the modal
                            },
                            error: function() {
                                alert('Failed to add student.');
                            }
                        });
                    });
                });
                



