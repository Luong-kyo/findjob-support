
<?php
require 'connect.php';
$connect = new mysqli("localhost","root","","heqd");

// Check connect
if ($connect -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
};



// echo $i;
if(isset($_POST['themviec'])){
    // $ma_cv=$_POST['ma_cv'];
    $ten_cv=$_POST['ten_cv'];
    $capbac=$_POST['capbac'];
    $luong=$_POST['luong'];
    $thoigian=$_POST['thoigian'];
    $ngaylam=$_POST['ngaylam'];
    $hinhthuc=$_POST['hinhthuc'];
    $phucloi=$_POST['phucloi'];
    $soluong=$_POST['soluong'];
    
    $ten_dn=$_POST['ten_dn'];
    $quymo=$_POST['quymo'];
    $tinh=$_POST['tinh'];
    $phuong=$_POST['phuong'];
    $quan=$_POST['quan'];

    $ma_dn = mysqli_fetch_array(mysqli_query($connect,"SELECT ma_dn FROM doanhnghiep order by ma_dn Desc limit 1"));
    $i = $ma_dn['ma_dn'] + 1;
    $themdn= mysqli_query($connect,"INSERT INTO doanhnghiep(ma_dn, ten_dn, quymo, tinh, quan, phuong) value ('$i', '$ten_dn','$quymo', '$tinh', '$quan', '$phuong')");
    $themcv = mysqli_query($connect,"INSERT INTO congviec(ma_dn, ten_cv, capbac, luong, thoigian, ngaylam, hinhthuc, phucloi, soluong) value ('$i', '$ten_cv','$capbac', '$luong', '$thoigian', '$ngaylam', '$hinhthuc', '$phucloi', '$soluong') ");



}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm việc</title>
    <link rel="stylesheet" href="./stylee.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="//cdn.ckeditor.com/4.21.0/full/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="js/app.js"></script>

    
</head>
<body>
    <div class="bg">
        <div class="container-xxl rounded-top shadow-lg p-4 mb-4 bg-light">
            <ul class="nav  row">
                <li class="nav-item danhsach ha border border-dark border-bottom-0 rounded-top col">
                    <a class="nav-link active text-center hi" id="menu1" data-toggle="tab" href="#home">Danh sách</a>
                </li> 
                <li class="nav-item them border border-bottom rounded-top col">
                   <a class="nav-link text-center them mx-auto" id="menu2" data-toggle="tab" href="#them">Thêm công việc</a>
                </li>
            </ul><br>
        
            <!-- Tab panes -->
            <div class="tab-content">
                
                <div id="home" class=" tab-pane active">
                    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
                    <button style="font-size:18px" id="loc" class=" btn btn-outline" data-toggle="modal" data-target="#myModal"><i class="fa fa-filter"></i></button>
                    
                    <table class="table table-dark table-hover" >
                        <thead>
                        <tr>
                            <th class="border border-light text-center"></th>
                            <th class="border border-light text-center">Lương (Triệu)</th>
                            <th class="border border-light text-center">Địa chỉ</th>
                            <th class="border border-light text-center">yêu cầu bằng cấp</th>
                            <th class="border border-light text-center">Yêu cầu kinh nghiệm</th>
                            <!-- <th class="border border-light text-center">Yêu cầu </th>
                            <th class="border border-light text-center">Số lượng tuyển dụng</th>
                            <th class="border border-light text-center">Quy mô doanh nghiệp</th> -->
                            <!-- <th class="border border-dark">Số ngày làm việc</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $sql = mysqli_query($connect,"SELECT * FROM congviec,doanhnghiep where congviec.ma_dn = doanhnghiep.ma_dn and congviec.soluong > 0 order by ma_cv ASC");
                            while($row = mysqli_fetch_array($sql)){

                        ?> 
                        <tr class="table-light text-dark">
                            <td class="border border-dark"><?php echo $row['ten_cv'] .' - '. $row['ten_dn']; ?></td>
                            <td class="border border-dark text-center"><?php echo $row['luong']/1000000; ?></td>
                            <td class="border border-dark d-flex" >
                                <p class="phuong"><?php echo $row['phuong']; ?></p>
                                <p class="quan"><?php echo ', '. $row['quan']; ?></p>
                                <p class="tinh"><?php echo ', '. $row['tinh']; ?></p>
                            </td>
                            <td class="border border-dark text-center"><?php echo $row['trinhdo']; ?></td>
                            <!-- <td class="border border-dark"><textarea name="" disabled rows="6" style="resize:none; width: 300px;"><?php echo $row['phucloi']; ?></textarea></td> -->
                                <td class="border border-dark text-center"><?php echo $row['kinhnghiem']; ?></td>

                            <!--<td class="border border-dark"><?php echo $row['soluong']; ?></td>
                            <td class="border border-dark"><?php echo $row['quymo']; ?></td> -->
                        </tr>
                        <?php
                            }
                        ?>
                        
                            
                        </tbody>
                    </table>
                </div>
                <div class="modal" id="myModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <span>Lương</span>
                                        <input type="text" class="form-control" id="luong" value="" autocomplete="off"><br>
                                        <span>Tỉnh/Thành phố</span>
                                        <select id="province1" name="province" class="form-control">
                                            <option value="">Chọn một tỉnh</option>
                                            <!-- populate options with data from your database or API -->
                                            <?php
                                            $sql = "SELECT * FROM province";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <option value="<?php echo $row['province_id'] ?>"><?php echo $row['name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <span>Kinh nghiệm</span>
                                        <input type="text" class="form-control" id="kinhnghiem" value="" autocomplete="off"><br>
                                        <span>Quận/Huyện</span>
                                        <select id="district1" name="district" class="form-control">
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <span>Bằng cấp</span>
                                        <input type="text" class="form-control" id="bangcap" value="" autocomplete="off"><br>
                                        <span>Phường/Xã</span>
                                        <select id="wards1" name="wards" class="form-control">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="" data-dismiss="modal">Xong</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div id="them" class="  "><br>
                    <form action="" method="POST" enctype="multipart/form-data">
                            
                        <h3 class="text-center">Thêm công việc</h3><br>
                        <div class="row">
                            <div class="col-sm-4">
                                <div>Tên doanh nghiệp</div>
                                <input type="text" class="form-control border border-dark" value="" autocomplete="off" name="ten_dn"><br>
                                <select id="province" name="province1" class="form-control">
                                    <option value="">Chọn một tỉnh</option>
                                    <!-- populate options with data from your database or API -->
                                    <?php
                                    $a = "SELECT * FROM province";
                                    $b = mysqli_query($conn, $a);
                                    while ($row = mysqli_fetch_assoc($b)) {
                                    ?>
                                        <option value="<?php echo $row['province_id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select><br>
                                <div>Quận/ Huyện</div>
                                <select id="district" name="district1" class="form-control">
                                </select><br>
                                <div>Phường/ Xã</div>
                                <select id="wards" name="wards1" class="form-control">
                                </select><br>
                            </div>
                            <div class="col-sm-4">
                                <div>Tên công việc</div>
                                <input type="text" class="form-control border border-dark" value="" autocomplete="off" name="ten_cv"><br>
                                <div>Chức vụ</div>
                                <input type="text" class="form-control border border-dark" value="" autocomplete="off" name="capbac"><br>
                                <div>Mức lương</div>
                                <input type="text" class="form-control border border-dark" value="" autocomplete="off" name="luong"><br>
                                <div>Thời gian làm việc</div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control border border-dark" value=""  placeholder="Giờ/ ngày" autocomplete="off" name="thoigian"><br>

                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control border border-dark" value="" autocomplete="off" placeholder="Ngày/ tuần"  name="ngaylam"><br>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="col-sm-4">
                                <div>Hình thức</div>
                                <input type="text" class="form-control border border-dark" value="" autocomplete="off" name="hinhthuc"><br>
                                <div>Phúc lợi</div>
                                <input type="text" class="form-control border border-dark" value="" autocomplete="off" name="phucloi"><br>
                                <div>Số lượng tuyển dụng</div>
                                <input type="text" class="form-control border border-dark" value="" autocomplete="off" name="soluong"><br>
                                <div>Quy mô doanh nghiệp</div>
                                <input type="text" class="form-control border border-dark" value="" autocomplete="off" name="quymo"><br>
                            </div>

                        </div><br>
                        <input type="submit"  name="themviec" value="Thêm" class="btn btn-success center">

                        <!-- <div class="col">
                            <h3 class="text-center">Phúc lợi</h3><br>
                            <textarea style="resize: none;" name="phucloi" id="phucloi"></textarea><br><br>

                        </div> -->
                    </form>
                </div>

                
                
            </div>
        </div>
    </div>

    

</script>

    <script>

        var loc = document.getElementById('loc');
        loc.addEventListener("click", function() {

            var luong = document.getElementById('luong');
            luong.addEventListener("input", function() {
                luongvalue = luong.value;
                console.log(luongvalue);
            })

            var kinhnghiem = document.getElementById('kinhnghiem');
            var bangcap = document.getElementById('bangcap');
            var tinh = document.getElementById('tinh');
            var quan = document.getElementById('quan');
            var phuong = document.getElementById('phuong');
        });








    var danhsach = document.querySelector(".danhsach"),
    them = document.querySelector(".them"),
    menu1 = document.getElementById('menu1'),
    menu2 = document.getElementById('menu2');

    menu1.addEventListener("click", ()=>{
        menu1.classList.add('hi');
        menu2.classList.remove('hi');
        danhsach.classList.add('ha', 'border-dark','border-bottom-0','rounded-top')
        them.classList.remove('ha', 'border-dark','border-bottom-0','rounded-top')
    });
    menu2.addEventListener("click", ()=>{
        menu1.classList.remove('hi');
        menu2.classList.add('hi');
        
        danhsach.classList.remove('ha', 'border-dark','border-bottom-0','rounded-top')
        them.classList.add('ha', 'border-dark','border-bottom-0','rounded-top')
    });

    </script>

</body>
</html>