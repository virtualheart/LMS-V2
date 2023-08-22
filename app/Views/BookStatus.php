    <div class="container-fluid">
    	<!-- <h1 class="h3 mb-4 text-gray-800">Status Books</h1> -->
            <ul class="nav nav-tabs" role="tablist" id="list-tab">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="list-home-list" data-toggle="tab" href="#list-home" role="tab" aria-controls="home">All</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="list-profile-list" data-toggle="tab" href="#list-profile" role="tab" aria-controls="profile">Barrowed</a>
                </li>
            </ul>

                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                            <table class="table table-bordered table-striped" id="myTable" data-show-columns="true" data-key-events="true"  data-cookie="true" data-cookie-id-table="saveId" data-show-export="true">
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
                                    <?php $i=1;$pos=1 ?>

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

        							<?php $i++;$pos++; endforeach; ?>

                                    </tbody>
                                </table>
                            </div>

                        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">                 
                            <table class="table table-bordered table-striped" id="myTable1" data-show-columns="true" data-key-events="true"  data-cookie="true" data-cookie-id-table="saveId" data-show-export="true">
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
                                        <tr>
                                            <td><?=$i; ?></td>
                                            <td><?=$i; ?></td>
                                            <td><?=$i; ?></td>
                                            <td><?=$i; ?></td>
                                            <td><?=$i; ?></td>
                                            <td><?=$i; ?></td>
                                            <td><?=$i; ?></td>
                                            <td><?=$i; ?></td>
                                                <td><a class='btn btn-success' href='<?=site_url("/admin/Activity/barrow/").$books["bcode"]?>'><i class='fa fa-check'></i></a></td>
                                        </tr>         
                                        <tr>
                                            <td><?=$i; ?></td>
                                            <td><?=$i; ?></td>
                                            <td><?=$i; ?></td>
                                            <td><?=$i; ?></td>
                                            <td><?=$i; ?></td>
                                            <td><?=$i; ?></td>
                                            <td><?=$i; ?></td>
                                            <td><?=$i; ?></td>
                                            <td><button class="btn btn-danger" id="request" title="Book Unavailable, click to Request the Holder." onclick="request_click(this)"><i class='fa fa-times'></i></button></td>

                                        </tr>         
    
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
