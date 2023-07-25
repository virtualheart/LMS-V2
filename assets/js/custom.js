let alertShown = false; 

$(document).ready(function() {
    $('#confirmClearButton').click(function() {
        $('#bookForm')[0].reset();
        $('#resetButton').trigger('click');
        $('#clearModal').modal('hide');
    });
});


// $(document).ready(function() {
//   $('#uploadForm').on('submit', function(e) {
//     e.preventDefault(); // Prevent the form from submitting normally

//     var formData = new FormData(this);

//     $.ajax({
//       url: 'Upload/upload/Book', // URL to your CodeIgniter controller method for handling the upload
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
    const fieldIds = ["bno", "title", "aname", "publication","price"];

    // Check if the pressed key is a special key
    if (event.key === "Alt" || event.key === "Control" || event.key === "Shift") {
        return; // Do nothing for special keys
    }

    if (str.length !== 14) {
        clearFormFields(fieldIds);
        return;
    }

const xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
        const info = JSON.parse(this.responseText);

        if (!alertShown && info.status === "0") { 
            const alertDiv = document.createElement("div");
            alertDiv.className = "alert alert-warning alert-dismissible";
            alertDiv.role = "alert";

            const closeButton = document.createElement("button");
            closeButton.type = "button";
            closeButton.className = "close";
            closeButton.setAttribute("data-dismiss", "alert");
            closeButton.setAttribute("aria-label", "Close");

            const closeIcon = document.createElement("span");
            closeIcon.setAttribute("aria-hidden", "true");
            closeIcon.innerHTML = "&times;";

            closeButton.appendChild(closeIcon);
            alertDiv.appendChild(closeButton);

            const strongTag = document.createElement("strong");
            strongTag.innerHTML = "Warning! ";
            alertDiv.appendChild(strongTag);

            const message = document.createTextNode("Please verify if the book is borrowed or unavailable in the library.");
            alertDiv.appendChild(message);

            const parentElement = document.getElementById("NoBookAlert");
            parentElement.appendChild(alertDiv);

            alertShown = true; 
            setTimeout(function () {
                parentElement.removeChild(alertDiv);
                alertShown = false;
            }, 3000);

        } 
        updateFormFields(info, fieldIds);
    }
};

xmlhttp.open("GET", `${baseUrl}/Admin/Book/book/Barrow/${str}`, true);
xmlhttp.send();

}

function getDetailReturn(str) {
    const fieldIds1 = ["bno", "title", "regno","sname", "aname", "publication","alamara","price","rack","request_date"];

    if (str.length !== 14) {
        clearFormFields(fieldIds1);
        return;
    }
        
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const info = JSON.parse(this.responseText);
            updateFormFields(info,fieldIds1);

        }else if(this.readyState === 4 && this.status === 204){
            if (!alertShown) { 

                const alertDiv = document.createElement("div");
                alertDiv.className = "alert alert-warning alert-dismissible";
                alertDiv.role = "alert";

                const closeButton = document.createElement("button");
                closeButton.type = "button";
                closeButton.className = "close";
                closeButton.setAttribute("data-dismiss", "alert");
                closeButton.setAttribute("aria-label", "Close");

                const closeIcon = document.createElement("span");
                closeIcon.setAttribute("aria-hidden", "true");
                closeIcon.innerHTML = "&times;";

                closeButton.appendChild(closeIcon);
                alertDiv.appendChild(closeButton);

                const strongTag = document.createElement("strong");
                strongTag.innerHTML = "Warning! ";
                alertDiv.appendChild(strongTag);

                const message = document.createTextNode("Please verify if the book is not borrowed or available in the library.");
                alertDiv.appendChild(message);

                const parentElement = document.getElementById("NoBookAlert");
                parentElement.appendChild(alertDiv);

                alertShown = true; 
                setTimeout(function () {
                    parentElement.removeChild(alertDiv);
                    alertShown = false;
                }, 3000);
            }

        }
    };

    xmlhttp.open("GET", `${baseUrl + "/Admin/Book/book/Return/" + str}`, true);
    xmlhttp.send();
}

function getUserDetile(str) {
    const fieldIds = ["sname"];

    if (str.length === 0 || str === null || str === " ") {
        clearFormFields(fieldIds);
        return;
    }

    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const info = JSON.parse(this.responseText);
            updateFormFields(info,fieldIds);
        } else{
            clearFormFields(fieldIds);
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

$(document).ready(function() {
  // Check if the current page is the specific page where you want to hide the sidebar
  if (window.location.pathname.includes("/index.php/admin/ViewAllBooks") || window.location.pathname.includes("/index.php/books/status")) {
    $("body").addClass("hide-sidebar");
    $(".sidebar").addClass("toggled");
  }
});

// submit confirm 
document.getElementById('bookForm').addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the form from submitting directly

  // Show the confirmation modal
  $('#submitConfirmationModal').modal('show');

  // When the user confirms the submission, proceed with the form submission
  document.getElementById('confirmSubmitButton').addEventListener('click', function() {
    $('#submitConfirmationModal').modal('hide'); // Hide the modal
    document.getElementById('bookForm').submit(); // Proceed with the form submission
  });
});
