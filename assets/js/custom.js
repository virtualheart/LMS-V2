$(document).ready(function() {
    $('#confirmClearButton').click(function() {
        $('#bookForm')[0].reset();
        $('#resetButton').trigger('click');
        $('#clearModal').modal('hide');
    });
});

$(document).ready(function() {
    // Add event listener to password and confirm password fields
    $('#apass, #capass').on('keyup', function() {
        var password = $('#apass').val();
        var confirmPassword = $('#capass').val();
        var submitBtn = $('#save');

        // Check if password and confirm password match
        if (password === confirmPassword) {
            $('#capass').removeClass('is-invalid');
            $('#capass').addClass('is-valid');
            submitBtn.prop('disabled', false); // Enable the submit button
        } else {
            $('#capass').removeClass('is-valid');
            $('#capass').addClass('is-invalid');
            submitBtn.prop('disabled', true); // Disable the submit button
        }
    });
});


// $(document).ready(function() {
//   $('#uploadForm').on('submit', function(e) {
//     e.preventDefault(); // Prevent the form from submitting normally

//     var formData = new FormData(this);

//     $.ajax({
//       url: 'BooksUpload/upload', // URL to your CodeIgniter controller method for handling the upload
//       type: 'POST',
//       data: formData,
//       dataType: 'json',
//       processData: false,
//       contentType: false,
//       xhr: function() {
//         var xhr = new window.XMLHttpRequest();

//         // Upload progress
//         xhr.upload.addEventListener('progress', function(event) {
//           if (event.lengthComputable) {
//             var percent = Math.round((event.loaded / event.total) * 100);
//             $('#progress').text('Upload progress: ' + percent + '%');
//           }
//         }, false);

//         return xhr;
//       },
//       success: function(response) {
//         $('#response').text(response.message);
//       },
//       error: function(xhr, status, error) {
//         $('#response').text('Error: ' + error);
//       }
//     });
//   });
// });


// Datatables 
$(document).ready(function() {
    // DataTable initialisation
    $('#myTable').DataTable(
        {
            "dom": '<"dt-buttons"Bf><"clear">lirtp',
            "paging": true,
            "autoWidth": true,
            "buttons": [
                'colvis',
                'copyHtml5',
                'csvHtml5',
                'excelHtml5',
                'pdfHtml5',
                'print'
            ]
        }
    );
});

// Disable right-click context menu
// $(document).on("contextmenu", function(e) {
//   e.preventDefault();
// });

// // Disable F5 key
// $(document).on("keydown", function(e) {
//   if (e.which === 116) {
//     e.preventDefault();
//   }
// });

function showpwd() {
  var x = document.getElementById("apass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function getDetailBarrow(str) {
    const fieldIds = ["bno", "title", "aname", "publication","alamara","price","rack"];

    if (str.length !== 13) {
        clearFormFields(fieldIds);
        return;
    }

    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const info = JSON.parse(this.responseText);
            updateFormFields(info,fieldIds);
        }
    };

    xmlhttp.open("GET", `${baseUrl + "/Admin/Book/book/Barrow/" + str}`, true);
    xmlhttp.send();
}

function getDetailReturn(str) {
    const fieldIds1 = ["bno", "title", "regno","sname", "aname", "publication","alamara","price","rack","request_date"];

    if (str.length !== 13) {
        clearFormFields(fieldIds1);
        return;
    }

    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const info = JSON.parse(this.responseText);
            updateFormFields(info,fieldIds1);
        }
    };

    xmlhttp.open("GET", `${baseUrl + "/Admin/Book/book/Return/" + str}`, true);
    xmlhttp.send();
}

function getUserDetile(str) {
    const fieldIds = ["sname"];

    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const info = JSON.parse(this.responseText);
            updateFormFields(info,fieldIds);
        }
    };

    xmlhttp.open("GET", `${baseUrl + "/Admin/Book/getUserDet/" + str}`, true);
    xmlhttp.send();
}


function updateFormFields(info,fieldIds) {
    // const fieldIds = ["bno", "title", "aname", "publication","alamara","price","rack"];
    fieldIds.forEach((fieldId) => {
        document.getElementById(fieldId).value = info[fieldId];
    });
}

function clearFormFields(fieldIds) {
    // const fieldIds = ["bno", "title", "aname", "publication","alamara","price","rack"];
    fieldIds.forEach((fieldId) => {
        document.getElementById(fieldId).value = "";
    });
}

