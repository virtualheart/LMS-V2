        </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Department of Computer Application</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->



    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?=site_url("/logout");?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Clear Modal -->
<div class="modal fade" id="clearModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Clear Confirmation</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Are you sure you want to clear the form?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-danger" id="confirmClearButton">Clear</button>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>

<script src="<?= base_url(); ?>assets/vendor/datatables/datatables.min.js"></script>

<script>
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

</script>
</body>
</html>