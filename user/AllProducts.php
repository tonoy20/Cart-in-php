<?php
include("topbar.php");
?>

<div id="all">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <div class="row products">
                            <?php
                            $fetch = FETCH_SRC;
                            $sql = "SELECT * FROM products";
                            $res = mysqli_query($data, $sql);
                            while ($row = mysqli_fetch_assoc($res)) {
                            ?>
                                <div class="col-lg-4 col-md-6 ">
                                    <div class="card">
                                        <a href=""><img src=<?= $fetch . $row['image'] ?> alt="" class="img-fluid "></a>
                                        <div class="card-body">
                                            <h3><a href=""><?php echo $row['name'] ?></a></h3>
                                            <p class="price">
                                                <del></del>$<?php echo $row['price'] ?>
                                            </p>
                                            <p class="buttons"><a href="" class="btn btn-outline-secondary">View detail</a></p>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <!-- /.product            -->

                        </div>
                        <div class="pages">
                            <p class="loadMore"><a href="#" class="btn btn-primary btn-lg"><i class="fa fa-chevron-down"></i> Load more</a></p>
                            <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                                <ul class="pagination">
                                    <li class="page-item"><a href="#" aria-label="Previous" class="page-link"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
                                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                                    <li class="page-item"><a href="#" aria-label="Next" class="page-link"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <?php
    include("footer.php")
    ?>