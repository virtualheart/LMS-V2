    <div class="container-fluid">
    	<h1 class="h3 mb-4 text-gray-800">Status Books</h1>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Barcode No</th>
                                            <th>Book No</th>
                                            <th>Title</th>
                                            <th>Author Name</th>
                                            <th>Publication</th>
                                            <th>Alamara</th>
                                            <th>Rack</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Barcode No</th>
                                            <th>Book No</th>
                                            <th>Title</th>
                                            <th>Author Name</th>
                                            <th>Publication</th>
                                            <th>Alamara</th>
                                            <th>Rack</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php $i=1; ?>

							        <?php foreach ($books as $books): ?>

                                        <tr>
                                            <td><?=$i; ?></td>
                                            <td class="bcode"><?=$books['bcode']; ?></td>
                                            <td><?=$books['bno']; ?></td>
                                            <td><?=$books['title']; ?></td>
                                            <td><?=$books['aname']; ?></td>
                                            <td><?=$books['publication']; ?></td>
                                            <td><?=$books['alamara']; ?></td>
                                            <td><?=$books['rack']; ?></td>
    
                                            <?php if($books['status'] == 1 and session()->get('role') == "admin" ){ ?>
                                                <td><a class='btn btn-success' href='<?=site_url("/admin/Activity/barrow/").$books["bcode"]?>'><i class='fa fa-check'></i></a></td> 
                                            <?php } elseif ($books['status'] == 1) { ?>

                                                <td><a class='btn btn-success' href='#'><i class='fa fa-check'></i></a></td> 
                                            <?php } else{ ?>
                                                <td><button class="btn btn-danger" id="request" title="Book Unavailable, click to Request the Holder." onclick="request_click(this)"><i class='fa fa-times'></i></button></td>
                                            <?php } ?> 
    
                                        </tr>         

        							<?php $i++; endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

    </div>
    <script type="text/javascript">
        
function request_click(rowElement) {

    var bcode = $(rowElement).closest('tr').find('.bcode').text();

  $.ajax({
    type: "POST",
    url: "<?php echo site_url(); ?>/books/bookrequest/",
    data: {
      bcode: bcode,
    },
    success: function(result) {
      // alert('Request successful');
        $('#popupSuccessModal').modal('show');

    },
    error: function(xhr, status, error) {
        // var errorMessage = "An error occurred: " + status + " - " + error;
        // if (xhr.responseText) {
        //   errorMessage += "\nAdditional details: " + xhr.responseText;
        // }
        // alert(errorMessage);
        if (xhr.responseText) {
            // Parse the server's JSON response
            var errorResponse = JSON.parse(xhr.responseText);

            // Check the message
            if (errorResponse.message === "Already Requested") {
                // Book already requested, show appropriate modal or handle the error
                $('#popupAlreadyRequestedModal').modal('show');
            } else {
                // Some other error occurred, show a generic error message or handle the error
                $('#popupFailedModal').modal('show');
            }
        } else {
            // No valid JSON response received, show a generic error message or handle the error
            $('#popupFailedModal').modal('show');
        }

    }
  });
}
    </script>
