<?php
//Being sure of signning in
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
                                                                <h4 class="card-title">Stores Ratings </h4>
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
                                                                        <table style="width: 100%; text-align: center;" class="table display nowrap table-striped table-bordered scroll-horizontal ">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Store Name</th>
                                                                                    <th>Entire Rating</th>
                                                                                    <th> Number Of Raters</th>

                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                //database connection
                                                                                include_once "partial/DB_CONNECTION.php";
                                                                                //pagination settings
                                                                                $limit = 3;
                                                                                $page = $_GET['page'] ?? 1;
                                                                                $offset = ($page - 1) * $limit;
                                                                                //select query
                                                                                $query = "select * from stores limit $limit offset $offset";

                                                                                $result = mysqli_query($connection, $query);
                                                                                if (mysqli_num_rows($result) > 0) {
                                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                                        //retieving all ratings of the selected store
                                                                                        $query7 = "SELECT * from rating where store_id = '" . $row['id'] . "'";
                                                                                        $result7 = mysqli_query($connection, $query7);
                                                                                        $ratings = [];
                                                                                        if (mysqli_num_rows($result7) > 0) {
                                                                                            while ($rating = mysqli_fetch_assoc($result7)) {
                                                                                                $ratings[] = $rating['rate'];
                                                                                            }
                                                                                        };

                                                                                        $total = count($ratings);
                                                                                        $sum = array_sum($ratings) ?? 0;

                                                                                        if ($total == 0) {
                                                                                            $average = 0;
                                                                                        } else {
                                                                                            $average = number_format(($sum / $total), 1);
                                                                                        }


                                                                                        echo   '<tr>' . '<td> ' . $row['name'] . '</td>' . '<td>' . $average . '</td>' . '<td>' . $total . '</td>' .

                                                                                            '</tr>';
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
                            $query = "SELECT count(id) as row_no from stores";
                            $result = mysqli_query($connection, $query);
                            $row = mysqli_fetch_assoc($result);
                            $page_count = ceil($row['row_no'] / $limit);
                            echo "<ul class='pagination'>";
                            for ($i = 1; $i <= $page_count; $i++) {
                                echo "<li class='page-item'><a class='page-link' href='stores_rating.php?page=$i'>$i</a></li>";
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