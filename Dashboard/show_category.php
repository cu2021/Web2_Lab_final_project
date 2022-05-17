<?php
session_start();
if (!isset($_SESSION['is_login']) && !$_SESSION['is_login']) {
    header('Location:login.php');
} ?>

<!doctype html>
<html class="loading" lang="en" data-textdirection="ltr">
<?php
include "partial/header.php";
?>

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- fixed-top-->
    <?php include "partial/nav.php" ?>
    <?php include "partial/sidebar.php" ?>

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Basic form layout section start -->
                <div id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="content-body">
                                            <section id="dom">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h4 class="card-title">All Categories </h4>
                                                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                                                <div class="heading-elements">
                                                                    <ul class="list-inline mb-0">
                                                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                                        <li><a data-action="close"><i class="ft-x"></i></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="card-content collapse show">
                                                                    <div class="card-body card-dashboard">
                                                                        <table style="width: 100%" class="table display nowrap table-striped table-bordered scroll-horizontal ">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Category ID</th>
                                                                                    <th>Category Name</th>
                                                                                    <th> Category Details</th>

                                                                                    <th>Edit</th>
                                                                                    <th>DELETE</th>

                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                include_once "partial/DB_CONNECTION.php";
                                                                                $limit = 3;
                                                                                $page = $_GET['page'] ?? 1;
                                                                                $offset = ($page - 1) * $limit;
                                                                                $query = "select * from categories limit $limit offset $offset";

                                                                                $result = mysqli_query($connection, $query);
                                                                                if (mysqli_num_rows($result) > 0) {
                                                                                    while ($row = mysqli_fetch_assoc($result)) {


                                                                                        echo   '<tr>' . '<td> ' . $row['id'] . '</td>' . '<td>' . $row['name'] . '</td>' . '<td>' . $row['description'] . '</td>' .

                                                                                            '<td>
                                    
                                    <a href="edit_category.php?id=' . $row['id'] . '" class="btn btn-outline-primary  box-shadow-3 mr-1 mb-1"><i
                                                                                                            class="icon-pencil"></i></a>
                                    </td>' .
                                                                                            '<td>
                                    <form action="delete_category.php" class="c_form" id="form" method="POST">
                                    <input type="hidden" name="id" value="' . $row['id'] . '"> 
                                    <input type="submit" class="btn btn-danger delete-btn" id="delete-btn" value="DELETE"> </form></td>' . '</tr>';
                                                                                    }
                                                                                }

                                                                                ?>

                                                                            </tbody>
                                                                        </table>
                                                                        <div class="justify-content-center d-flex">
                                                                        </div>
                                                                        <div class="col-12">

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="justify-content-center d-flex">


                    <div class="row">


                        <div class="col-md-12">
                            <?php
                            $query = "SELECT count(id) as row_no from categories";
                            $result = mysqli_query($connection, $query);
                            $row = mysqli_fetch_assoc($result);
                            $page_count = ceil($row['row_no'] / $limit);
                            echo "<ul class='pagination'>";
                            for ($i = 1; $i <= $page_count; $i++) {
                                echo "<li class='page-item'><a class='page-link' href='show_category.php?page=$i'>$i</a></li>";
                            }


                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>
    <?php
    include "partial/footer.php";
    ?>
    <script>
        $('.delete-btn').click(function() {
            var result = confirm('Are You Sure !!!');
            
        });
    </script>
</body>

</html>