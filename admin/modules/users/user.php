<?php 
    if(!defined('ADMIN') && !defined("STAFF")) {
        header("Location: 403.php");
    }
    //Kết nối đến CSDL
    include_once "../config/database.php";
    //Cài đặt trang mặc định sẽ là trang 1 => đảm bảo biến $page luôn có giá trị để áp dụng cho công thức $start = $rows_per_page($page-1)
    if(isset($_GET['page'])) {
        $page = $_GET['page']; //trang hiện tại sẽ lấy theo tham số page trên đường dẫn
    }else{
        $page = 1; //Nếu không có page trên đường dẫn thì sẽ mặc định trang hiện tại là 1
    }
    //Cài đặt số bản ghi trên 1 trang
    $rows_per_page = 5; //Hiển thị 5 bản ghi trên 1 trang.
    //Tính chỉ số bắt đầu $start trong cụm truy vấn LIMIT $start, $rows_per_page
    $start = $rows_per_page * ($page - 1);

    //Chuẩn bị câu truy vấn
    $sqlGetAllUsers = "SELECT * FROM users LIMIT $start, $rows_per_page";
    //Thực thi truy vấn
    $queryGetAllUsers = mysqli_query($conn, $sqlGetAllUsers);
    //Truy vấn lấy tổng số bản ghi của bảng users
    $sqlGetTotalRecords = "SELECT count(users_id) AS total FROM users";
    $queryGetTotalRecords = mysqli_query($conn, $sqlGetTotalRecords);
    $resultGetTotalRecords = mysqli_fetch_assoc($queryGetTotalRecords);
    $totalRecords = $resultGetTotalRecords['total']; 
    //Tổng số trang
    $totalPages = ceil($totalRecords/$rows_per_page);
    
    $page_prev = $page - 1;
    if($page_prev <= 0) {
        $page_prev = 1;
    }

    $page_next = $page + 1;
    if($page_next > $totalPages) {
        $page_next = $totalPages;
    }
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
   <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Danh sách thành viên</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách thành viên</h1>
        </div>
    </div><!--/.row-->
    <div id="toolbar" class="btn-group">
        <a href="index.php?page_layout=add_user" class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i> Thêm thành viên
        </a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table
                        data-toolbar="#toolbar"
                        data-toggle="table">

                        <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="name" data-sortable="true">Họ & Tên</th>
                                <th data-field="price" data-sortable="true">Email</th>
                                <th>Quyền</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        while($rows = mysqli_fetch_assoc($queryGetAllUsers)) {
                        ?>
                            <tr>
                                <td><?php echo $rows['users_id']; ?></td>
                                <td><?php echo $rows['user_full']; ?></td>
                                <td><?php echo $rows['user_mail']; ?></td>
                                <td>
                                    <?php 
                                        if($rows['user_level'] == 1) {
                                            echo '<span class="label label-danger">Quản trị viên</span>';
                                        }else {
                                            echo '<span class="label label-success">Thành viên</span>';
                                        }
                                    ?>
                                    
                                </td>
                                <td class="form-group">
                                    <a href="index.php?page_layout=edit_user&users_id=<?php echo $rows['users_id']; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                    <a href="/" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                </td>
                            </tr>
                        <?php 
                        }
                        ?> 
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            
                            <?php 
                            echo '<li class="page-item"><a class="page-link" href="index.php?page_layout=user&page='.$page_prev.'">&laquo;</a></li>';
                            for($i = 1; $i <= $totalPages; $i++) {
                                $active = ($i == $page) ? "active" : "";
                                $html = '<li class="page-item '.$active.'">';
                                if($i == $page) {
                                    $html .= '<span>'.$i.'</span>';
                                }else{
                                    $html .= '<a class="page-link" href="index.php?page_layout=user&page='.$i.'">'.$i.'</a>';
                                }
                                $html .= '</a></li>';
                                echo $html;
                            }
                            echo '<li class="page-item"><a class="page-link" href="index.php?page_layout=user&page='.$page_next.'">&raquo;</a></li>';
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div><!--/.row-->
</div> <!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>