<?php 
if(!isset($_SESSION['user'])){
  header('location: ../index.php?page=index');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Danh sách đơn hàng | Quản trị Admin</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="view/css/admin.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <!-- or -->
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <style>
    .products__pagenation {
    display: flex;
    justify-content: end;
    padding-right: 15px;
    list-style-type: none;
}

.products__pagenation-item {
    height: 38px;
    width: 38px;
    border: 1px #ccc solid;
    margin-right: 4px;
}

.products__pagination-link {
    color: #000;
    font-size: 16px;
    font-weight: 300;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    width: 100%;
}

.products__pagination-link:hover {
    font-weight: 500;
}
.status-list {
  display: flex;
  gap: 15px;
}
        </style>
</head>

<body onload="time()" class="app sidebar-mini rtl">
  <!-- Navbar-->
  <header class="app-header">
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
      aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">


      <!-- User Menu-->
      <li><a class="app-nav__item" href="../model/log_out.php"><i class='bx bx-log-out bx-rotate-180'></i> </a>

      </li>
    </ul>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?php echo '../view/img/user/'.$_SESSION['user']['img']?>" width="50px"
        alt="User Image">
      <div>
      <p class="app-sidebar__user-name"><b><?php echo $_SESSION['user']['user_name']?></b></p>
        <p class="app-sidebar__user-designation">Chào mừng bạn trở lại</p>
      </div>
    </div>
    <hr>
    <ul class="app-menu">
      <li><a class="app-menu__item " href="./index.php?page=index"><i class='app-menu__icon bx bx-tachometer'></i><span
            class="app-menu__label">Bảng điều khiển</span></a></li>
      <li><a class="app-menu__item " href="./index.php?page=user&action=list"><i class='app-menu__icon bx bx-id-card'></i> <span
            class="app-menu__label">Quản lý nhân viên</span></a></li>

      <!-- <li><a class="app-menu__item" href="./index.php?page=user&action=list"><i class='app-menu__icon bx bx-user-voice'></i><span
            class="app-menu__label">Quản lý khách hàng</span></a></li>

      <li><a class="app-menu__item " href="./index.php?page=post&action=list"><i class='app-menu__icon bx bx-user-voice'></i><span

            class="app-menu__label">Quản lý bài viết</span></a></li>
      <li><a class="app-menu__item " href="./index.php?page=TA_cmt&action=list"><i class='app-menu__icon bx bx-user-voice'></i><span
            class="app-menu__label">Quản lý bình luận</span></a></li> -->
      
      
      <li><a class="app-menu__item" href="./index.php?page=catergory&action=list"><i class='app-menu__icon bx bx-user-voice'></i><span
            class="app-menu__label">Quản lý danh mục</span></a></li>
      <li><a class="app-menu__item" href="./index.php?page=product&action=list"><i
            class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Quản lý sản phẩm</span></a>
      </li>
      <li><a class="app-menu__item active" href="./index.php?page=bill&action=list"><i class='app-menu__icon bx bx-task'></i><span
            class="app-menu__label">Quản lý đơn hàng</span></a></li>
    </ul>
  </aside>
    <main class="app-content">
      <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item active"><a href="#"><b>Danh sách đơn hàng</b></a></li>
        </ul>
        <div id="clock"></div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <h3>Danh sách hóa đơn</h3>
              <!-- <div class="row element-button">
                <div class="col-sm-2">
  
                  <a class="btn btn-add btn-sm" href="form-add-don-hang.html" title="Thêm"><i class="fas fa-plus"></i>
                    Tạo mới đơn hàng</a>
                </div>
                <div class="col-sm-2">
                  <a class="btn btn-delete btn-sm nhap-tu-file" type="button" title="Nhập" onclick="myFunction(this)"><i
                      class="fas fa-file-upload"></i> Tải từ file</a>
                </div>
  
                <div class="col-sm-2">
                  <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i
                      class="fas fa-print"></i> In dữ liệu</a>
                </div>
                <div class="col-sm-2">
                  <a class="btn btn-delete btn-sm print-file js-textareacopybtn" type="button" title="Sao chép"><i
                      class="fas fa-copy"></i> Sao chép</a>
                </div>
  
                <div class="col-sm-2">
                  <a class="btn btn-excel btn-sm" href="" title="In"><i class="fas fa-file-excel"></i> Xuất Excel</a>
                </div>
                <div class="col-sm-2">
                  <a class="btn btn-delete btn-sm pdf-file" type="button" title="In" onclick="myFunction(this)"><i
                      class="fas fa-file-pdf"></i> Xuất PDF</a>
                </div>
                <div class="col-sm-2">
                  <a class="btn btn-delete btn-sm" type="button" title="Xóa" onclick="myFunction(this)"><i
                      class="fas fa-trash-alt"></i> Xóa tất cả </a>
                </div>
              </div> -->
              <table class="table table-hover table-bordered" id="sampleTable">
              <div class="select">
                <div class="status-list">
                    <div class="status-item">
                      <input value="all" checked name= "status" type="radio" id="all">
                      <label for="all">Tất cả</label> 
                    </div>
                    <div>
                      <input value="Đang xử lý" name= "status" type="radio" id="waiting">
                      <label for="waiting">Đang xử lý</label> 
                    </div>
                    <div>
                      <input value="Hoàn tất" name= "status" type="radio" id="done">
                      <label for="done">Hoàn tất</label> 
                    </div>
                    <div>
                      <input value="Đã hủy" name= "status" type="radio" id="delete">
                      <label for="delete">Đã hủy</label> 
                    </div>
                </div>
              </div>
                <thead>
                  <tr>
                    <th width="10"><input type="checkbox" id="all"></th>
                    <th>ID đơn hàng</th>
                    <th>Khách hàng</th>
                    <th>Địa chỉ</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Ngày mua</th>
                    <th>Tình trạng</th>
                    <th>Tính năng</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      // $bill_list = $conn->query('SELECT * FROM bill ORDER BY id DESC')->fetchAll();  
                      $pro =  isset($_GET['pro']) ? $_GET['pro'] : 1;
                      $offset = ((int)$pro - 1) * 12;
                      $bill_list =$conn->query("select * from bill ORDER BY id DESC limit 12 offset " . $offset);
                      foreach($bill_list as $bill){
                      $class_name = change_status_background($bill['status']);
                  ?>
                  <tr>
                  <td width="10"><input type="checkbox" name="check1" value="1"></td>
                    <td><?php echo $bill['maDH'] ?></td>
                    <td><?php echo $bill['user_name'] ?></td>
                    <td><?php echo $bill['address'] ?></td>
                    <td><?php echo $bill['phone'] ?></td>
                    <td><?php echo $bill['total_money'] ?> đ</td>
                    <td><?php echo $bill['date'] ?></td>
                    <td><span class="<?php echo $class_name ?>"><?php echo $bill['status']?></span></td>
                    <td>
                      <!-- <button class="btn btn-primary btn-sm trash" type="button" title="Xóa"><i class="fas fa-trash-alt"></i> </button> -->
                      <a href="./index.php?page=bill&action=detail&id=<?php echo $bill['id'] ?>"><button class="btn btn-primary btn-sm edit" type="button" title="Sửa"><i class="fa fa-plus"></i></button></a>
                    </td>
                  </tr>
                  <?php }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <ul class="products__pagenation">
                            <?php
                        $stmt = $conn->query("select * from bill");
                        for ($i = 1; $i < ceil( $stmt->rowCount() / 8); $i++){
                        // echo '<a id="linkNum" href="?page=' . $i . '">' . $i . '</a>';
                        echo '<li class="products__pagenation-item"><a class="products__pagination-link" href="./index.php?page=bill&action=list&pro=' . $i . '">' . $i . '</a></li>';
                        }
                        ?>
                        </ul>
    </main>
  <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="src/jquery.table2excel.js"></script>
  <script src="js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <!-- Data table plugin-->
  <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">$('#sampleTable').DataTable();</script>
  <script>
    function deleteRow(r) {
      var i = r.parentNode.parentNode.rowIndex;
      document.getElementById("myTable").deleteRow(i);
    }
    jQuery(function () {
      jQuery(".trash").click(function () {
        swal({
          title: "Cảnh báo",
         
          text: "Bạn có chắc chắn là muốn xóa đơn hàng này?",
          buttons: ["Hủy bỏ", "Đồng ý"],
        })
          .then((willDelete) => {
            if (willDelete) {
              swal("Đã xóa thành công.!", {
                
              });
            }
          });
      });
    });
    oTable = $('#sampleTable').dataTable();
    $('#all').click(function (e) {
      $('#sampleTable tbody :checkbox').prop('checked', $(this).is(':checked'));
      e.stopImmediatePropagation();
    });

    //EXCEL
    // $(document).ready(function () {
    //   $('#').DataTable({

    //     dom: 'Bfrtip',
    //     "buttons": [
    //       'excel'
    //     ]
    //   });
    // });


    //Thời Gian
    function time() {
      var today = new Date();
      var weekday = new Array(7);
      weekday[0] = "Chủ Nhật";
      weekday[1] = "Thứ Hai";
      weekday[2] = "Thứ Ba";
      weekday[3] = "Thứ Tư";
      weekday[4] = "Thứ Năm";
      weekday[5] = "Thứ Sáu";
      weekday[6] = "Thứ Bảy";
      var day = weekday[today.getDay()];
      var dd = today.getDate();
      var mm = today.getMonth() + 1;
      var yyyy = today.getFullYear();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      nowTime = h + " giờ " + m + " phút " + s + " giây";
      if (dd < 10) {
        dd = '0' + dd
      }
      if (mm < 10) {
        mm = '0' + mm
      }
      today = day + ', ' + dd + '/' + mm + '/' + yyyy;
      tmp = '<span class="date"> ' + today + ' - ' + nowTime +
        '</span>';
      document.getElementById("clock").innerHTML = tmp;
      clocktime = setTimeout("time()", "1000", "Javascript");

      function checkTime(i) {
        if (i < 10) {
          i = "0" + i;
        }
        return i;
      }
    }
    //In dữ liệu
    var myApp = new function () {
      this.printTable = function () {
        var tab = document.getElementById('sampleTable');
        var win = window.open('', '', 'height=700,width=700');
        win.document.write(tab.outerHTML);
        win.document.close();
        win.print();
      }
    }
    //     //Sao chép dữ liệu
    //     var copyTextareaBtn = document.querySelector('.js-textareacopybtn');

    // copyTextareaBtn.addEventListener('click', function(event) {
    //   var copyTextarea = document.querySelector('.js-copytextarea');
    //   copyTextarea.focus();
    //   copyTextarea.select();

    //   try {
    //     var successful = document.execCommand('copy');
    //     var msg = successful ? 'successful' : 'unsuccessful';
    //     console.log('Copying text command was ' + msg);
    //   } catch (err) {
    //     console.log('Oops, unable to copy');
    //   }
    // });


    //Modal
    $("#show-emp").on("click", function () {
      $("#ModalUP").modal({ backdrop: false, keyboard: false })
    });
  </script>

<script>
        let checkBoxes = $('input[name="status"]');
        let tbody = $('tbody');

        checkBoxes.click(function(){
            $.ajax({
                url: '../api/api.php',
                data: {
                    action: 'filter_bill_status',
                    status: $('input[name="status"]:checked').val()
                },
                type: 'GET',
                dataType: 'json',
                success: function(result){
                    let html = '';
                    result.forEach(bill => {
                        let className = change_status_background(bill['status']);
                        html += `   
                        <tr>
                          <td width="10"><input type="checkbox" name="check1" value="1"></td>
                            <td>${bill['maDH']}</td>
                            <td>${bill['user_name']}</td>
                            <td>${bill['address']}</td>
                            <td>${bill['phone']}</td>
                            <td>${bill['total_money']} đ</td>
                            <td>${bill['date']}</td>
                            <td><span class="${className}">${bill['status']}</span></td>
                          <td>
                            <a href="./index.php?page=bill&action=detail&id=${bill['id']}."><button class="btn btn-primary btn-sm edit" type="button" title="Sửa"><i class="fa fa-plus"></i></button></a>
                          </td>
                        </tr>
                                `
                    });
                    tbody.html(html);
                }
            })
        })

        function change_status_background(status){
        if (status == 'Đang xử lý') {
            return "badge bg-info";
        }
        if (status == 'Hoàn tất') {
            return "badge bg-success";
        }
        if (status == 'Đã hủy') {
            return "badge bg-danger";
        }
        if (status == 'Đang giao hàng') {
            return "badge bg-warning";
        }
    }

    </script>
</body>

</html>