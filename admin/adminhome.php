<?php
include("sessionAd.php");
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Admin Home</title>
  <link rel="stylesheet" href="assets/style.css">
  <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td,
    th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
  </style>
</head>

<body>
  <?php
  include("includes/header.php");
  ?>
  <!-- side Bar -->
  <?php
  include("includes/sidebar.php");
  ?>


  <main role="main">

    <div class="container-sm pt-2" style="text-align:right">
      <a class="btn btn-success ps-5 pe-5 pt-2 pb-2" href="createCategory.php">Add Category</a>
    </div>
    <div id="wrapper" class="active">
      <!-- Page content -->
      <div id="page-content-wrapper">
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
          <div class="row">
            <div class="col-md-12">
              <?php include("showCategory.php") ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>


</body>
</html>