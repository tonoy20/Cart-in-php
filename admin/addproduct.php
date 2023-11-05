<?php
include("../server.php");
include("sessionAd.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/3da5cff3a5.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets/style.css">
  <title>Add products</title>
  <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>

<body>
  <?php
  include("includes/header.php");
  ?>
  <main role="main">
    <div>
      <a href="showProducts.php">
        <div class="container-sm pt-3" style="text-align:right">
          <button class="btn btn-success ps-5 pe-5 pt-2 pb-2">show Products</button>
        </div>
      </a>
    </div>
    <!--PRODUCT ADD FORM -->
    <div class="container w-50 border mt-5 ">
      <form class="mt-5" action="crudProducts.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label">name</label>
          <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Product Brand</label>
          <input type="text" class="form-control" name="brand" required>
        </div>
        <div class="mb-3">
          <label class="form-label">price</label>
          <input type="number" class="form-control" name="price" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Stock Quantity</label>
          <input type="number" class="form-control" name="quantity" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Color</label>
          <input type="text" class="form-control" name="color" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Size</label>
          <input type="text" class="form-control" name="size" required>
        </div>
        <!-- category select -->
        <div class="mb-3">
          <label for="">--Category Select--</label>
          <select name="productCategory[]" multiple="multiple" class="ms-1 d-block w-100">
            <?php
            $category = mysqli_query($data, "SELECT * from categories");
            while ($c = mysqli_fetch_array($category)) {
            ?>
              <option value="<?= $c['id']; ?>"><?php echo $c['title'] ?></option>
            <?php
            }
            ?>
          </select>
        </div>   
        <div class="form-group">
          <div class="row" id="image_box">
            <div class="mb-3 col-lg-10">
              <label for="" class="form-label">Product Image</label>
              <input type="file" class="form-control" name="image" accept="jpg,.png,.svg,.webp">
            </div>
            <div class="mb-3 col-lg-2">
            <label for="" class="form-label"></label>
            <button type="button" onclick="add_more_images()" class="btn btn-secondary text-white btn-outline-success form-control">Add More Images</button>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <button type="submit" name="add_product" class="btn btn-success text-white btn-outline-success form-control w-50 m-3">Add Stock</button>
        </div>
      </form>
    </div>
  </main>
  <script>
    var total_image = 1;
    function add_more_images() {
      total_image++;
      var html = '<div class="mb-3 col-lg-6" id="add_image_box_'+total_image+'"><label for="" class="form-label">Product Image</label><input type="file" class="form-control" name="product_images[]" accept="jpg,.png,.svg,.webp"><button type="button" class="btn btn-danger text-white btn-outline-success form-control" onClick=remove_image("'+total_image+'")>Remove</button></div>';
      jQuery('#image_box').after(html);
    }

    function remove_image(id) {
      jQuery('#add_image_box_'+id).remove();
    }
  </script>
</body>
</html>