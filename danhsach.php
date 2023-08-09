
<?php
$connect = new mysqli("localhost","root","","heqd");

// Check connect
if ($connect -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
};


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm việc</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="//cdn.ckeditor.com/4.21.0/full/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="js/appp.js"></script>

    
</head>
<body>
    <div class="bg">
        <div class="container-xxl rounded-top shadow-lg p-4 mb-4 bg-light">
            <ul class="nav  row">
                <li class="nav-item danhsach ha border border-dark border-bottom-0 rounded-top col text-center">
                    <a href="danhsach.php">Danh sách</a>
                </li> 
                <li class="nav-item them border border-bottom rounded-top col text-center">
                    <a href="them.php">Thêm</a>
                </li>
            </ul><br>
        
            <!-- Tab panes -->
            <div class="tab-content">
            <form id="myForm">
                
                        
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <span>Lương(triệu)</span>
                            <input type="number" class="form-control" id="luong_input" min="0" value="" autocomplete="off"><br>
                            <span>Tỉnh/Thành phố</span>
                            <select id="province" name="province" class="form-control">
                                <option value="">Chọn một tỉnh</option>
                                <!-- populate options with data from your database or API -->
                                <?php
                                $sql = "SELECT * FROM province";
                                $result = mysqli_query($connect, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <option value="<?php echo $row['province_id'] ?>"><?php echo $row['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <span>Kinh nghiệm(năm)</span>
                            <input type="number" class="form-control" id="kinhnghiem_input" min="0" value="" autocomplete="off"><br>
                            <span>Quận/Huyện</span>
                            <select id="district" name="district" class="form-control">
                                <option value="">Chọn một Quận/Huyện</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <span>Bằng cấp</span>
                            <!-- <input type="text" class="form-control" id="bangcap_input" value="" autocomplete="off"><br> -->
                            <select class="form-control" id="bangcap_input">
                                <option value="0">Không yêu cầu bằng cấp</option>
                                <option value="1">Cấp 3</option>
                                <option value="2">Đại học</option>
                                <option value="3">Thạc sĩ</option>
                                <option value="4">Tiến sĩ</option>
                            </select><br>
                            <span>Phường/Xã</span>
                            <select id="wards" name="wards" class="form-control">
                                <option value="">Chọn một Phường/Xã</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="modal-header">
                <input type="submit" class="btn btn-success " id="xong" value="Xong">
                </div>
                        
                    
            </form>
                <div id="home" class=" tab-pane active">
                    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
                    <button style="font-size:18px" id="loc" class=" btn btn-outline" data-toggle="modal" data-target="#myModal"><i class="fa fa-filter"></i></button> -->
                    
                    <table class="table table-dark table-hover" >
                        <thead>
                        <tr>
                            <th class="border border-light text-center"></th>
                            <th class="border border-light text-center">Lương (Triệu)</th>
                            <th class="border border-light text-center">Địa chỉ</th>
                            <th class="border border-light text-center">yêu cầu bằng cấp</th>
                            <th class="border border-light text-center">Yêu cầu kinh nghiệm</th>
                            <th class="border border-light text-center">Đánh giá doanh nghiệp</th>
                            <!-- <th class="border border-light text-center">Yêu cầu </th>
                            <th class="border border-light text-center">Số lượng tuyển dụng</th>
                            <th class="border border-light text-center">Quy mô doanh nghiệp</th> -->
                            <!-- <th class="border border-dark">Số ngày làm việc</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $sql = mysqli_query($connect,"SELECT * FROM congviec,doanhnghiep where congviec.ma_dn = doanhnghiep.ma_dn order by ma_cv ASC");
                            $i=0;
                            while($row = mysqli_fetch_array($sql)){
                                $i = $i+1;
                                $tinh = $row['tinh'];
                                $quan = $row['quan'];
                                $phuong = $row['phuong'];
                                // $td = $row['trinhdo'];
                                switch($row['trinhdo']){
                                    case '':
                                        $td = 0;
                                        break;
                                    case 'Không':
                                        $td = 0;
                                        break;
                                    case 'Cấp 3':
                                        $td = 1;
                                        break;
                                    case 'Đại học':
                                        $td = 2;
                                        break;
                                    case 'Thạc sĩ':
                                        $td = 3;
                                        break;
                                    case 'Tiến sĩ':
                                        $td = 4;
                                        break;
                                }
                                $sql_tinh = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM province where province_id = '$tinh' "));
                                $sql_quan = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM district where district_id = '$quan' "));
                                $sql_phuong = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM wards where wards_id = '$phuong' "));

                        ?> 
                        <tr class="table-light text-dark ds" >
                            <td class="border border-dark" id="cv<?php echo $i; ?>" ><?php echo $row['ten_cv'] .' - '. $row['ten_dn']; ?></td>
                            <input type="hidden" id="<?php echo $i; ?>" value="<?php echo $row['ma_cv'] ?>">
                            <td class="border border-dark text-center" id ="luong<?php echo $i; ?>"><?php echo $row['luong']; ?></td>
                            <td class="border border-dark d-flex" style="min-height:100px;">
                                <p class="phuong"><?php echo $sql_phuong['name']; ?></p>
                                <input type="hidden" id ="phuong<?php echo $i; ?>" value="<?php echo $sql_phuong['wards_id']; ?>">
                                <p class="quan"><?php echo ', '. $sql_quan['name']; ?></p>
                                <input type="hidden" id ="quan<?php echo $i; ?>" value="<?php echo $sql_quan['district_id']; ?>">
                                <p class="tinh"><?php echo ', '. $sql_tinh['name']; ?></p>
                                <input type="hidden" id ="tinh<?php echo $i; ?>" value="<?php echo $sql_tinh['province_id']; ?>">
                            </td>
                            <td class="border border-dark text-center" ><?php echo $row['trinhdo']; ?></td>
                            <input type="hidden" id ="bangcap<?php echo $i; ?>" value="<?php echo $td; ?>">
                            <td class="border border-dark text-center" id ="kinhnghiem<?php echo $i; ?>"><?php echo $row['kinhnghiem']; ?></td>
                            <!-- <td class="border border-dark"><textarea name="" disabled rows="6" style="resize:none; width: 300px;"><?php echo $row['phucloi']; ?></textarea></td> -->

                            <!--<td class="border border-dark"><?php echo $row['soluong']; ?></td>-->
                            <td class="border border-dark" id ="danhgia<?php echo $i; ?>"><?php echo $row['danhgia']; ?></td> 
                        </tr>
                        <?php
                            }
                        ?>
                        
                            
                        </tbody>
                    </table><br>
                    <div id="phuhopnhat"></div><br>
                    <table class="table table-dark table-hover"  id = myTable>
                        <thead>
                        <tr>
                            <th class="border border-light text-center"></th>
                            <th class="border border-light text-center">Phù hợp lương</th>
                            <th class="border border-light text-center">Phù hợp địa chỉ</th>
                            <th class="border border-light text-center">phù hợp bằng cấp</th>
                            <th class="border border-light text-center">phù hợp kinh nghiệm</th>
                            <th class="border border-light text-center">Đánh giá </th>
                            <th class="border border-light text-center">S*</th>
                            <!--<th class="border border-light text-center">Số lượng tuyển dụng</th>
                            <th class="border border-light text-center">Quy mô doanh nghiệp</th> -->
                            <!-- <th class="border border-dark">Số ngày làm việc</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $sql = mysqli_query($connect,"SELECT * FROM congviec,doanhnghiep where congviec.ma_dn = doanhnghiep.ma_dn  order by ma_cv ASC");
                            $k=0;
                            while($row = mysqli_fetch_array($sql)){
                                $k=$k+1;
                                $i = $row['ma_cv'];;

                                $tinh = $row['tinh'];
                                $quan = $row['quan'];
                                $phuong = $row['phuong'];
                                $sql_tinh = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM province where province_id = '$tinh' "));
                                $sql_quan = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM district where district_id = '$quan' "));
                                $sql_phuong = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM wards where wards_id = '$phuong' "));

                        ?> 
                        <tr class="table-light text-dark ph">
                            <td class="border border-dark" id ="cv_ph<?php echo $k; ?>" ><?php echo $row['ten_cv'] .' - '. $row['ten_dn']; ?></td>
                            <td class="border border-dark text-center" id="luong_ph<?php echo $i; ?>"></td>
                            <td class="border border-dark text-center" id="diachi_ph<?php echo $i; ?>"></td>
                            <td class="border border-dark text-center" id="bangcap_ph<?php echo $i; ?>"></td>
                            <td class="border border-dark text-center" id="kinhnghiem_ph<?php echo $i; ?>"></td>
                            <td class="border border-dark text-center" id="danhgia_ph<?php echo $i; ?>"></td>
                            <td class="border border-dark text-center" class="tong" id="tong<?php echo $i; ?>"></td>
                        </tr>
                        <?php
                            }
                        ?>
                        
                            
                        </tbody>
                    </table>
                </div>

                
                
            </div>
        </div>
    </div>

    

</script>

    <script>
        
        var formElement = document.getElementById("myForm");

        formElement.addEventListener("submit", function(event) {
            event.preventDefault(); 
            var luong_input = document.getElementById('luong_input').value;
            var kinhnghiem_input = document.getElementById('kinhnghiem_input').value;
            var bangcap_input = document.getElementById('bangcap_input').value;
            var tinh_input = document.getElementById('province').value;
            var quan_input = document.getElementById('district').value;
            var phuong_input = document.getElementById('wards').value;

            if(!luong_input){
                luong_input = 0;
            }
            // console.log(luong_input);


            // Lấy danh sách các thẻ <td> từ class đầu tiên
            var ds = document.querySelectorAll(".ds");
            // Lấy danh sách các thẻ <td> đích
            var ph = document.querySelectorAll(".ph");
            // Kiểm tra số lượng thẻ <td> nguồn và thẻ <td> đích phải trùng nhau
            if (ds.length === ph.length) {
                let max_arr = [];
                let maxluong = maxdiachi = maxbangcap = maxkinhnghiem = maxdanhgia =   -Infinity;
                let minkc = Infinity;

                // Lặp qua danh sách và gán giá trị từ thẻ nguồn vào thẻ đích
               
                for (var i = 1; i <= ds.length; i++) {

                    var ma_cv = document.getElementById(i).value;
                    var luong_id = 'luong'+ma_cv;
                    var luong = document.getElementById(luong_id).innerText;
                    var luong_ph_id = 'luong_ph'+ma_cv;
                    var luong_ph = document.getElementById(luong_ph_id);
                    // console.log(luong);
                    var phuhop_luong = 0 ;
                    
                    if(parseInt(luong_input) <= parseInt(luong)){
                        phuhop_luong = (luong - luong_input)/luong;

                    }else{
                        phuhop_luong = 0;
                    }
                    var phl = phuhop_luong*0.3;
                    luong_ph.textContent = phl.toFixed(2);
                    


                    var kinhnghiem_id = 'kinhnghiem'+ma_cv;
                    var kinhnghiem = document.getElementById(kinhnghiem_id).innerText;
                    var kinhnghiem_ph_id = 'kinhnghiem_ph'+ma_cv;
                    var kinhnghiem_ph = document.getElementById(kinhnghiem_ph_id);
                    // console.log(kinhnghiem);
                    phkn = kinhnghiem_input - kinhnghiem;
                    if(phkn < -1){
                        phuhop_kinhnghiem = 0;
                    }else if(phkn === -1){
                        phuhop_kinhnghiem = 0.5;
                    }
                    else if(phkn >=0){
                        phuhop_kinhnghiem=1;
                    }
                    var phkn = 0.1*phuhop_kinhnghiem;
                    kinhnghiem_ph.textContent = phkn;


                    var bangcap_id = 'bangcap'+ma_cv;
                    var bangcap = document.getElementById(bangcap_id).value;
                    var bangcap_ph_id = 'bangcap_ph'+ma_cv;
                    var bangcap_ph = document.getElementById(bangcap_ph_id);
                    // console.log(bangcap);
                    phbc = bangcap_input - bangcap;
                    if(phbc < 0){
                        phuhop_bangcap = 0;
                    }
                    else if(phbc >=0){
                        phuhop_bangcap=1;
                    }
                    var phbc = 0.15*phuhop_bangcap;
                    bangcap_ph.textContent = phbc;
                    // console.log(bangcap);

                    var danhgia_id = 'danhgia'+ma_cv;
                    var danhgia = document.getElementById(danhgia_id).innerText;
                    var danhgia_ph_id = 'danhgia_ph'+ma_cv;
                    var danhgia_ph = document.getElementById(danhgia_ph_id);
                    var phdg = 0.005*danhgia;
                    danhgia_ph.textContent = phdg;
                    // console.log(danhgia);

                    var tinh_id = 'tinh'+ma_cv;
                    var tinh = document.getElementById(tinh_id).value;
                    // console.log(tinh);
                    var quan_id = 'quan'+ma_cv;
                    var quan = document.getElementById(quan_id).value;
                    // console.log(quan);
                    var phuong_id = 'phuong'+ma_cv;
                    var phuong = document.getElementById(phuong_id).value;
                    // console.log(phuong);

                    var diachi_ph_id = 'diachi_ph'+ma_cv;
                    var diachi_ph = document.getElementById(diachi_ph_id);
                    var phuhop_tinh = '5';
                    var phuhop_quan = '3';
                    var phuhop_phuong = '2';
                    if(!tinh_input){
                        phuhop_tinh = '5';
                        phuhop_quan = '3';
                        phuhop_phuong = '2';
                    }else if(tinh_input != tinh){
                        phuhop_tinh = '0';
                        phuhop_quan = '0';
                        phuhop_phuong = '0';
                    }else if(tinh_input = tinh){
                        phuhop_tinh = '5';
                        if(!quan_input){
                            phuhop_quan = '3';
                            phuhop_phuong = '2';
                        }else if(quan_input != quan){
                            phuhop_quan = '0';
                            phuhop_phuong = '0';
                        }else if(quan_input = quan){
                                phuhop_quan = '3'
                            
                            if(!phuong_input){
                                phuhop_phuong = '2';
                            }else if(phuong_input != phuong){
                                phuhop_phuong = '0';
                            }else if(phuong_input = phuong){
                                phuhop_phuong = '2';
                            }
                        }
                        
                    }
                    var phuhop_diachi =  parseInt(phuhop_tinh) + parseInt(phuhop_quan) + parseInt(phuhop_phuong);
                    var phdc = 0.4*phuhop_diachi/10;
                    diachi_ph.textContent = phdc;

                    // arr.push(tong_ph.innerText);
                    
                    if (phl > maxluong) {
                        maxluong = phl;
                    }
                    if (phdc > maxdiachi) {
                        maxdiachi = phdc;
                    }
                    if (phbc > maxbangcap) {
                        maxbangcap = phbc;
                    }
                    if (phkn > maxkinhnghiem) {
                        maxkinhnghiem = phkn;
                    }
                    if (phdg > maxdanhgia) {
                        maxdanhgia = phdg;
                    }
                }

                max_arr=[maxluong, maxdiachi, maxbangcap, maxkinhnghiem, maxdanhgia];
                let cv_phn_id = 0;

                for (var i = 1; i <= ds.length; i++) {
                    var cv_ph_id = 'cv_ph'+i;
                    var cv_ph = document.getElementById(cv_ph_id);
                    // console.log(cv_ph);
                    luong_ph = cv_ph.parentElement.children[1].innerText;
                    diachi_ph = cv_ph.parentElement.children[2].innerText;
                    bangcap_ph = cv_ph.parentElement.children[3].innerText;
                    kinhnghiem_ph = cv_ph.parentElement.children[4].innerText;
                    danhgia_ph = cv_ph.parentElement.children[5].innerText;
                    do_ph = cv_ph.parentElement.children[6];
                    array = [luong_ph, diachi_ph, bangcap_ph,  kinhnghiem_ph, danhgia_ph]

                    let sum =0;
                    for(var j = 1; j <= 5; j++){
                        let m=j-1;
                        sum += Math.pow(array[m] - max_arr[m], 2);
                        // console.log(sum);

                    }
                    khoangcach =  Math.sqrt(sum);
                    // console.log(khoangcach);
                    do_ph.textContent = khoangcach.toFixed(5);
                    if (khoangcach < minkc) {
                        minkc = khoangcach;
                        cv_phn_id = 'cv_ph'+ i;
                    }
                }
                var phuhopnhat = document.getElementById('phuhopnhat');
                phuhopnhat.textContent = 'Công việc phù hợp nhất: '+ document.getElementById(cv_phn_id).innerText;
                // console.log(document.getElementById(cv_phn_id).innerText);

            } else {
                console.error("Số lượng thẻ nguồn và thẻ đích không khớp.");
            }

        });

        

        

    </script>

</body>
</html>