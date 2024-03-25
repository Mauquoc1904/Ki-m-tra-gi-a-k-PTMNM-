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

// Lấy dữ liệu nhân viên
$sql = 'SELECT * FROM nhanvien';
$result = $conn->query($sql);
$nhanvien = $result->fetch_all(MYSQLI_ASSOC);

// Xác định số trang
$totalPages = ceil(count($nhanvien) / 5);
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

// Lấy danh sách nhân viên cho trang hiện tại
$offset = ($currentPage - 1) * 5;
$limit = 5;
$sql = "SELECT * FROM nhanvien LIMIT $offset, $limit";
$result = $conn->query($sql);
$nhanvienCurrentPage = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Thông tin nhân viên</title>
  <style>
    .gender-icon {
      width: 20px; 
      height: 20px; 
    }
  </style>
</head>
<body>
  <h1>THÔNG TIN NHÂN VIÊN</h1>

  <table border="1" cellpadding="5" cellspacing="0">
    <tr>
      <th>Mã Nhân Viên</th>
      <th>Tên Nhân Viên</th>
      <th>Giới Tính</th>
      <th>Nơi Sinh</th>
      <th>Tên Phòng</th>
      <th>Lương</th>
    </tr>
    <?php 
    // Kiểm tra xem có dữ liệu nhân viên hay không trước khi sử dụng vòng lặp
    if(isset($nhanvienCurrentPage) && !empty($nhanvienCurrentPage)) {
        foreach ($nhanvienCurrentPage as $nhanvien) : 
    ?>
      <tr>
        <td><?php echo $nhanvien['Ma NV']; ?></td>
        <td><?php echo $nhanvien['Ten_NV']; ?></td>
        <td>
          <?php if ($nhanvien['Gioi Tinh'] == 'NAM'): ?>
            <img src="image\man.jpg" alt="NAM" class="gender-icon">
          <?php else: ?>
            <img src="image\woman.jpg" alt="NU" class="gender-icon">
          <?php endif; ?>
        </td>
        <td><?php echo $nhanvien['Noi_Sinh']; ?></td>
        <td><?php echo $nhanvien['Ma_Phong']; ?></td>
        <td><?php echo number_format($nhanvien['Luong']); ?></td>
      </tr>
    <?php endforeach; 
    } else {
        echo '<tr><td colspan="6">Không có dữ liệu nhân viên</td></tr>';
    }
    ?>
  </table>

  <ul class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <li><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php endfor; ?>
  </ul>
  <button onclick="window.location.href='add.php'">Thêm nhân viên</button>
</body>
</html>
