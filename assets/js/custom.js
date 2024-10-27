
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

                // MODAL SCRIPT **************
                
                // $(document).ready(function() {
                //     $('#addStudentForm').on('submit', function(e) {
                //         e.preventDefault(); // Prevent default form submission
                
                //         var formData = new FormData(this); // Create a FormData object to handle file uploads
                
                //         $.ajax({
                //             url: '../student/add_student.php',
                //             type: 'POST',
                //             data: formData,
                //             contentType: false,
                //             processData: false,
                //             success: function(response) {
                //                 alert('Student added successfully!');
                //                 alert('test');
                //                 // Optionally reload the student list
                //                 $('#studentListBody').load('../student/fetch_students.php');
                //                 $('#addStudentModal').modal('hide'); // Close the modal
                //                 $('#studentListBody').html(data);
                //             },
                //             error: function() {
                //                 alert('Failed to add student.');
                //             }
                //         });
                //     });
                // });
                