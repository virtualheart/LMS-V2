    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Status Books</h1>
<!--             <ul class="nav nav-tabs" role="tablist" id="list-tab">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="list-home-list" data-toggle="tab" href="#list-home" role="tab" aria-controls="home">All</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="list-profile-list" data-toggle="tab" href="#list-profile" role="tab" aria-controls="profile">Barrowed</a>
                </li>
            </ul> -->

        <div class="card-body">
            <div class="table-responsive">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">

<table style="width: 67%; margin: 0 auto 2em auto;" cellspacing="0" cellpadding="3" border="0">
        <thead>
            <tr>
                <th>Target</th>
                <th>Search text</th>
                <th>Treat as regex</th>
                <th>Use smart search</th>
            </tr>
        </thead>
        <tbody>
            <tr id="filter_global">
                <td>Global search</td>
                <td align="center"><input type="text" class="global_filter" id="global_filter"></td>
                <td align="center"><input type="checkbox" class="global_filter" id="global_regex"></td>
                <td align="center"><input type="checkbox" class="global_filter" id="global_smart" checked="checked"></td>
            </tr>
            <tr id="filter_col3" data-column="3">
                <td>Column - Title</td>
                <td align="center"><input type="text" class="column_filter" id="col3_filter"></td>
                <td align="center"><input type="checkbox" class="column_filter" id="col3_regex"></td>
                <td align="center"><input type="checkbox" class="column_filter" id="col3_smart" checked="checked"></td>
            </tr>
            <tr id="filter_col4" data-column="4">
                <td>Column - Author</td>
                <td align="center"><input type="text" class="column_filter" id="col4_filter"></td>
                <td align="center"><input type="checkbox" class="column_filter" id="col4_regex"></td>
                <td align="center"><input type="checkbox" class="column_filter" id="col4_smart" checked="checked"></td>
            </tr>
            <tr id="filter_col5" data-column="5">
                <td>Column - Publication</td>
                <td align="center"><input type="text" class="column_filter" id="col5_filter"></td>
                <td align="center"><input type="checkbox" class="column_filter" id="col5_regex"></td>
                <td align="center"><input type="checkbox" class="column_filter" id="col5_smart" checked="checked"></td>
            </tr>
      
        </tbody>
    </table>
        <table class="table table-bordered table-striped" id="Status" data-show-columns="true" data-key-events="true"  data-cookie="true" data-cookie-id-table="saveId" data-show-export="true">
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
