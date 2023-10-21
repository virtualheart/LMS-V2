let alertShown = false; 

$(document).ready(function() {
    $('#confirmClearButton').click(function() {
        $('#bookForm')[0].reset();
        $('#resetButton').trigger('click');
        $('#clearModal').modal('hide');
    });
});

// 
    $(document).ready(function() {
        function filterGlobal(table) {
            let filter = document.querySelector('#global_filter');
            let regex = document.querySelector('#global_regex');
            let smart = document.querySelector('#global_smart');
         
            table.search(filter.value, regex.checked, smart.checked).draw();
        }
         
        function filterColumn(table, i) {
            let filter = document.querySelector('#col' + i + '_filter');
            let regex = document.querySelector('#col' + i + '_regex');
            let smart = document.querySelector('#col' + i + '_smart');
         
            table.column(i).search(filter.value, regex.checked, smart.checked).draw();
        }
        // DataTable initialization
        let table = $('#Status').DataTable({

            "dom": '<"dt-buttons"Bf><"clear">lirtp',
            "responsive": true,
            "scrollCollapse": true,
            "scrollY": '400px',
            "paging": true,
            "autoWidth": true,
            "lengthMenu": [
                [15, 25, 50, 100],
                [15, 25, 50, 100]
            ], 
            "buttons": [
                'colvis',
                'copy',
                'csvHtml5',
                'excelHtml5',
                'print'
            ],
            "stateSave": false,
            "responsive": true,
            ajax: {
                type: 'POST',
                url: `${baseUrl}/api/getBooksListAPI`,
                dataSrc: ''
            },
            columns: [
                { 
                    data: null, // Use null data source
                    render: function (data, type, row, meta) {
                        // 'meta.row' is the row index, add 1 to start from 1-based numbering
                        return meta.row + 1;
                    },
                },
                { 
                    data: 'bcode',
                    className: 'bcode',
                }, // Barcode No
                { data: 'bno' },   // Book No
                { data: 'title' }, // Title
                { data: 'aname' }, // Author Name
                { data: 'publication' },
                { data: 'alamara' },
                { data: 'rack' }, // Rack

                {
                    data: null, // Use null data source for the custom column
                    render: function (data, type, row) {

                        if (row.status == 1 && role == "admin") {
                            return "<a class='btn btn-success' href='" + `${baseUrl}` + "/admin/Activity/barrow/" + row.bcode + "'><i class='fa fa-check'></i></a>";
                        } else if (row.status == 1) {
                            return "<a class='btn btn-success' href='#'><i class='fa fa-check'></i></a>";
                        } else {
                            return "<button class='btn btn-danger' title='Book Unavailable, click to Request the Holder.' onclick='request_click(this)'><i class='fa fa-times'></i></button>";
                        }
                    },
                }
            ],
            columnDefs: [
                { targets: [0], title: 'S.No' } // Set the title for the first column (S.No)
            ]
        });

        document.querySelectorAll('input.global_filter').forEach((el) => {
            el.addEventListener(el.type === 'text' ? 'keyup' : 'change', () =>
                filterGlobal(table)
            );
        });
         
        document.querySelectorAll('input.column_filter').forEach((el) => {
            let tr = el.closest('tr');
            let columnIndex = tr.getAttribute('data-column');
         
            el.addEventListener(el.type === 'text' ? 'keyup' : 'change', () =>
                filterColumn(table, columnIndex)
            );
        });
    });


// $(document).ready(function() {
//   // Check if the current page is the specific page where you want to hide the sidebar
//   if (window.location.pathname.includes("/index.php/admin/ViewAllBooks") || window.location.pathname.includes("/index.php/books/status")) {
//     $("body").addClass("hide-sidebar");
//     $(".sidebar").addClass("toggled");
//   }
// });

$(document).ready(function() {
    $('.nav-tabs').on('shown.bs.tab', function(event) {
        // Get the ID of the tab content element associated with the clicked tab
        var tabContentId = $(event.target).attr('href');
        
        // Remove the "show active" class from all tab content elements
        $('.tab-pane').removeClass('show active');
        
        // Add the "show active" class to the clicked tab content element
        $(tabContentId).addClass('show active');
    });
});


// Datatables 
$(document).ready(function() {

    // DataTable initialization
    const table = $('#myTable').DataTable({
        "dom": '<"dt-buttons"Bf><"clear">lirtp',
        "responsive": true,
        "scrollCollapse": true,
        "scrollY": '400px',
        "paging": true,
        "autoWidth": true,
        "lengthMenu": [
            [15, 25, 50, 100],
            [15, 25, 50, 100]
        ], 
        "buttons": [
            'colvis',
            'csvHtml5',
            'excelHtml5',
            'print'
        ],
        "stateSave": false,
        "responsive": true,
    });
});

// normal Datatables 
$(document).ready(function() {
    // DataTable initialization
    const table = $('#norTable').DataTable({
        "responsive": true,
        "scrollCollapse": false,
        "autoWidth": true,
        "lengthChange": false,
        "stateSave": false,
        "responsive": true,
    });

});


// Disable right-click context menu
$(document).on("contextmenu", function(e) {
  e.preventDefault();
});

// Disable F5 key
$(document).on("keydown", function(e) {
  if (e.which === 116) {
    e.preventDefault();
  }
});

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
    const fieldIds1 = ["bno", "title", "regno","sname", "aname", "publication","alamara","fineday","fine","rack","request_date"];

    // Check if the pressed key is a special key
    if (event.key === "Alt" || event.key === "Control" || event.data === "\n" || event.key === "Shift") {
        return; // Do nothing for special keys
    }

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
        }
        else if(this.readyState === 4 && this.status === 204){
            if (!alertShown) { 

                // unchecked need to check and set alert no user found

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

                const message = document.createTextNode("Please verify if the is exists.");
                alertDiv.appendChild(message);

                const parentElement = document.getElementById("NoBookAlert");
                parentElement.appendChild(alertDiv);

                alertShown = true; 
                setTimeout(function () {
                    parentElement.removeChild(alertDiv);
                    alertShown = false;
                }, 3000);
            }

        } else{
            clearFormFields(fieldIds);
        }
    };

    xmlhttp.open("GET", `${baseUrl + "/Admin/Book/getUserDet/" + str}`, true);
    xmlhttp.send();
}


function updateFormFields(info,fieldIds) {

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

