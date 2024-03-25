<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$database = "ql_nhansu";

$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Thêm nhân viên mới
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ma_nv = $_POST['ma_nv'];
    $ten_nv = $_POST['ten_nv'];
    $gioi_tinh = $_POST['gioi_tinh'];
    $noi_sinh = $_POST['noi_sinh'];
    $ma_phong = $_POST['ma_phong'];
    $luong = $_POST['luong'];

    $sql = "INSERT INTO nhanvien (Ma_NV, Ten_NV, Gioi_Tinh, Noi_Sinh, Ma_Phong, Luong) 
            VALUES ('$ma_nv', '$ten_nv', '$gioi_tinh', '$noi_sinh', '$ma_phong', $luong)";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm nhân viên mới thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Thêm nhân viên</title>
</head>
<body>
  <h1>Thêm nhân viên mới</h1>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="ma_nv">Mã Nhân Viên:</label>
    <input type="text" id="ma_nv" name="ma_nv" required><br><br>
    
    <label for="ten_nv">Tên Nhân Viên:</label>
    <input type="text" id="ten_nv" name="ten_nv" required><br><br>
    
    <label for="gioi_tinh">Giới Tính:</label>
    <select id="gioi_tinh" name="gioi_tinh" required>
        <option value="Nam">Nam</option>
        <option value="Nữ">Nữ</option>
    </select><br><br>
    
    <label for="noi_sinh">Nơi Sinh:</label>
    <input type="text" id="noi_sinh" name="noi_sinh" required><br><br>
    
    <label for="ma_phong">Mã Phòng:</label>
    <input type="text" id="ma_phong" name="ma_phong" required><br><br>
    
    <label for="luong">Lương:</label>
    <input type="number" id="luong" name="luong" required><br><br>
    
    <button type="submit">Thêm Nhân Viên</button>
  </form>
</body>
</html>
