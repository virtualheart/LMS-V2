<?= view('Admin/Adminsidebar') ?>

<div class="container-fluid">
      <h1 class="h3 mb-4 text-gray-800">Books Upload</h1>
<!-- 
<form id="uploadForm" method="POST" action="< ?= base_url('BooksUpload/upload')?>" enctype="multipart/form-data">
  <input type="file" name="file" id="fileInput">
  <button type="submit">Upload</button>
</form>

  <div id="progress" class="progress-sm progress"></div>
  <div id="response"></div> -->

          <div class="card-body">
            <form id="uploadForm" method="POST" action="<?= site_url('BooksUpload/upload') ?>"
              enctype="multipart/form-data">
              <div class="form-group">
                <label for="fileInput">Choose File:</label>
                <input type="file" class="form-control-file" name="file" id="fileInput">
              </div>
              <button type="submit" class="btn btn-primary">Upload</button>
            </form>

          <div id="progress" class="progress progress-sm mt-3">
              <div class="progress-bar progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="0"
                aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <!-- <div class="alert alert-warning"> -->
              <div id="response" class="mt-3"></div>
            <!-- </div> -->
        </div>

</div>
