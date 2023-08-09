
<?php
    include('./connect.php');




// echo $i;
if(isset($_POST['themviec'])){
    $ten_cv=$_POST['ten_cv'];
    $luong=$_POST['luong'];
    
    $danhgia=$_POST['danhgia'];
    $kinhnghiem=$_POST['kinhnghiem'];
    $bangcap=$_POST['bangcap'];
    
    $ten_dn=$_POST['ten_dn'];
    $danhgia=$_POST['danhgia'];
    $tinh=$_POST['tinh'];
    $phuong=$_POST['phuong'];
    $quan=$_POST['quan'];

    $ma_cv = mysqli_fetch_array(mysqli_query($connect,"SELECT ma_cv FROM congviec order by ma_cv Desc limit 1"));
    $ma_dn = mysqli_fetch_array(mysqli_query($connect,"SELECT ma_dn FROM doanhnghiep order by ma_dn Desc limit 1"));
    $i = $ma_dn['ma_dn'] + 1;
    $j = $ma_cv['ma_cv'] + 1;
    $themdn= mysqli_query($connect,"INSERT INTO doanhnghiep( ma_dn, ten_dn,  tinh, quan, phuong, danhgia) value ( '$i', '$ten_dn', '$tinh', '$quan', '$phuong','$danhgia')");
    $themcv = mysqli_query($connect,"INSERT INTO congviec(ma_cv,ma_dn, ten_cv, luong, kinhnghiem, trinhdo) value ('$j', '$i', '$ten_cv','$luong', '$kinhnghiem', '$bangcap') ");



}
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
            <ul class="nav  row ">
                <li class="nav-item danhsach border border-dark border-bottom-0 rounded-top col text-center">
                    <a href="danhsach.php">Danh sách</a>
                </li> 
                <li class="nav-item ha them border border-bottom rounded-top col text-center">
                    <a href="them.php">Thêm</a>
                </li>
            </ul><br>
        
            <!-- Tab panes -->
            <div class="tab-content">
                
                <div id="them" class="  "><br>
                    <form action="" method="POST" enctype="multipart/form-data">
                            
                        <h3 class="text-center">Thêm công việc</h3><br>
                        <div class="row">
                            <div class="col-sm-4">
                                <div>Tên doanh nghiệp</div>
                                <input type="text" class="form-control border border-dark" value="" autocomplete="off" name="ten_dn"><br>
                                <div>Mức lương</div>
                                <input type="text" class="form-control border border-dark" value="" autocomplete="off" name="luong"><br>
                                <div>Kinh nghiệm</div>
                                <input type="text" class="form-control border border-dark" value="" autocomplete="off" name="kinhnghiem"><br>
                            </div>
                            <div class="col-sm-4">
                                <div>Tên công việc</div>
                                <input type="text" class="form-control border border-dark" value="" autocomplete="off" name="ten_cv"><br>
                                <div>Yêu cầu bằng cấp</div>
                                <select class="form-control" name="bangcap">
                                    <option value="Không">Không yêu cầu bằng cấp</option>
                                    <option value="Cấp 3">Cấp 3</option>
                                    <option value="Đại học">Đại học</option>
                                    <option value="Thạc sĩ">Thạc sĩ</option>
                                    <option value="Tiến sĩ">Tiến sĩ</option>
                                </select><br>
                                <div>Đánh giá doanh nghiệp</div>
                                <input type="number" class="form-control border border-dark" min="0" max="10" value="" autocomplete="off" name="danhgia"><br>
                                
                                
                                
                            </div>
                            <div class="col-sm-4">
                                <span>Tỉnh/Thành phố</span>
                                <select id="province" name="tinh" class="form-control">
                                    <option value="">Chọn một tỉnh</option>
                                    <!-- populate options with data from your database or API -->
                                    <?php
                                    $a = "SELECT * FROM province";
                                    $b = mysqli_query($connect, $a);
                                    while ($row = mysqli_fetch_assoc($b)) {
                                    ?>
                                        <option value="<?php echo $row['province_id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select><br>
                                <span>Quận/Huyện</span>
                                <select id="district" name="quan" class="form-control">
                                </select><br>
                                <div>Phường/ Xã</div>
                                <select id="wards" name="phuong" class="form-control">
                                </select><br>
                                
                                <!-- <div>Phúc lợi</div>
                                <input type="text" class="form-control border border-dark" value="" autocomplete="off" name="phucloi"><br>
                                <div>Số lượng tuyển dụng</div>
                                <input type="text" class="form-control border border-dark" value="" autocomplete="off" name="soluong"><br>
                                <div>Quy mô doanh nghiệp</div>
                                <input type="text" class="form-control border border-dark" value="" autocomplete="off" name="quymo"><br> -->
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

<style>
    
</style>
</body>
</html>