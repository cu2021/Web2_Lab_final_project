<?php
session_start();
if (!isset($_SESSION['is_login']) && !$_SESSION['is_login']) {
    header('Location:login.php');
}
$email = $_SESSION['email'];
?>

<!doctype html>
<html class="loading" lang="en" data-textdirection="ltr">
<?php
include "partial/header.php";
?>

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- fixed-top-->
    <?php

    include "partial/nav.php";
    include "partial/sidebar.php";

    ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section id="dom">
                    <div class="row" style="box-sizing: border-box;">
                        <div class="col-12">
                            <div class="card" style="box-sizing: border-box;">
                                <div class="card-header">
                                    <h4 class="card-title">Admins </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-content collapse show" style="box-sizing: border-box;">
                                    <div class="card-body card-dashboard" style="box-sizing: border-box;">
                                        <table style="box-sizing: border-box; max-width: 600px;  margin: 0 auto;" class="table display nowrap table-striped table-bordered scroll-horizontal" width="100%">
                                            <thead>

                                                <tr>
                                                    <th>Admin ID</th>
                                                    <th>Admin Name</th>
                                                    <th> Phone Number</th>
                                                    <th> Email </th>
                                                    <th> Password </th>
                                                    <th> Address </th>
                                                    <th> Description </th>
                                                    <th> Status </th>
                                                    <th> Update Status </th>
                                                    <th>Edit</th>
                                                    <th>DELETE</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                //database connection
                                                include_once "partial/DB_CONNECTION.php";
                                                //defining the important values required for the bagination
                                                $limit = 3;
                                                $page = $_GET['page'] ?? 1;
                                                $offset = ($page - 1) * $limit;
                                                //selecting the selected admins
                                                $query9 = "select * from admins limit $limit offset $offset";

                                                $result9 = mysqli_query($connection, $query9);
                                                if (mysqli_num_rows($result9) > 0) {

                                                    while ($row9 = mysqli_fetch_assoc($result9)) {
                                                        $status1 = $row9['status'];
                                                        if ($status1 == 1) {
                                                            $status = "<span class='badge badge-success'>Active</span>";
                                                            if (strcmp($row9['email'], $email) == 0) {
                                                                //disabling the update status and delete buttons from the logged in accouunt
                                                                $statusBtnChange = '<form action="updateAdminStatus.php" class="s_form" id="form" method="POST">
                                                                                                <input type="hidden" name="id" value="' . $row9['id'] . '"> 
                                                                                                <input type="hidden" name="newStatus" value="0">
                                                                                                <input type="submit" class="btn btn-danger change-status" id="change-status" value="Block" disabled 0> </form>';
                                                                $deleteBtn = '<form action="delete_admin.php" class="c_form" id="form" method="POST">
                                                                                                <input type="hidden" name="id" value="' . $row9['id'] . '"> 
                                                                                                 <input type="submit" class="btn btn-danger delete-btn" id="delete-btn" value="DELETE" disabled> </form>';
                                                            } else {
                                                                $statusBtnChange = '<form action="updateAdminStatus.php" class="s_form" id="form" method="POST">
                                                                                            <input type="hidden" name="id" value="' . $row9['id'] . '"> 
                                                                                            <input type="hidden" name="newStatus" value="0">
                                                                                            <input type="submit" class="btn btn-danger change-status" id="change-status" value="Block"> </form>';
                                                                $deleteBtn = '<form action="delete_admin.php" class="c_form" id="form" method="POST">
                                                                                                <input type="hidden" name="id" value="' . $row9['id'] . '"> 
                                                                                                 <input type="submit" class="btn btn-danger delete-btn" id="delete-btn" value="DELETE" > </form>';
                                                            }
                                                        } else {

                                                            $status = "<span class='badge badge-danger'>Blocked</span>";
                                                            $statusBtnChange = '<form action="updateAdminStatus.php" class="s_form" id="s_form" method="POST">
                                                                                            <input type="hidden" name="id" value="' . $row9['id'] . '"> 
                                                                                            <input type="hidden" name="newStatus" value="1">
                                                                                            <input type="submit" class="btn btn-success change-status" id="change-status" value="Activte"> </form>';
                                                            $deleteBtn = '<form action="delete_admin.php" class="c_form" id="form" method="POST">
                                                                                                <input type="hidden" name="id" value="' . $row9['id'] . '"> 
                                                                                                 <input type="submit" class="btn btn-danger delete-btn" id="delete-btn" value="DELETE" > </form>';
                                                        }


                                                        echo   '<tr>' . '<td> ' . $row9['id'] . '</td>' . '<td>' . $row9['name'] . '</td>' . '<td>' . $row9['phone_number'] . '</td>' .
                                                            '<td>' . $row9['email'] . '</td>' . '<td>' . $row9['password'] . '</td>' . '<td>' . $row9['address'] . '</td>' .
                                                            '<td>' . $row9['description'] . '</td>' . '<td>' . $status . '</td>' . '<td>' . $statusBtnChange . '</td>' .

                                                            '<td>
                                    
                                                                                        <a href="update_admins.php?id=' . $row9['id'] . '" class="btn btn-outline-primary  box-shadow-3 mr-1 mb-1"><i
                                                                                                            class="icon-pencil"></i></a>
                                                                                          </td>' .
                                                            '<td>' . $deleteBtn . '
                                                                                         </td>' . '</tr>';
                                                    }
                                                }


                                                ?>

                                            </tbody>



                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="justify-content-center d-flex">
                        <div class="row">
                            <div class="col-12">
                                <?php
                                //baagination commands
                                $query = "SELECT count(id) as row_no from admins";
                                $result = mysqli_query($connection, $query);
                                $row = mysqli_fetch_assoc($result);
                                $page_count = ceil($row['row_no'] / $limit);
                                echo "<ul class='pagination'>";
                                for ($i = 1; $i <= $page_count; $i++) {
                                    echo "<li class='page-item'><a class='page-link' href='show_all_admins.php?page=$i'>$i</a></li>";
                                }


                                ?>



                            </div>

                        </div>
                    </div>

                </section>


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
        $('.change-status').click(function() {
            var result1 = confirm('Are You Sure !!!');

        });
    </script>
</body>

</html>