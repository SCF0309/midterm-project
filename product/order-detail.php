<?php
require_once("../db2-connect.php");

$id = $_GET["id"];

if (!isset($_GET["id"])) {
  echo "訂單不存在";
  exit;
}
$sql = "SELECT user_order.*, users.account, product.price, product.name AS product_id FROM user_order
JOIN users ON user_order.user_id = users.id
JOIN product ON user_order.product_id = product.id

WHERE user_order.id=$id
ORDER BY user_order.id DESC";

$result = $conn->query($sql);
// $productCount = $result->num_rows;
$row = $result->fetch_assoc();


?>
<!doctype html>
<html lang="en">

<head>
  <title>Order Detail</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <Style>
        body {
            height: 300vh;
        }

        :root {
            --side-width: 260px;
        }

        .main-nav .form-control {
            background: #444;
            border: none;
            color: #fff;
            border-radius: 0;
        }

        .main-nav .btn {
            border-radius: 0;
        }

        .nav a {
            color: gray;
        }

        .nav a:hover {
            color: white;
        }

        .logo {
            width: var(--side-width);
        }

        .left-aside {
            width: var(--side-width);
            height: 100vh;
            padding-top: 54px;
            overflow: auto;
        }

        .aside-menu ul a {
            display: block;
            color: #666;
            text-decoration: none;
            display: flex;
            justify-content: center;
            margin: 15px;
        }

        .aside-menu a:hover {
            color: white;
            background: cadetblue;
            border-radius: 0.375rem;

        }

        .aside-menu a i {
            margin-right: 8px;
            margin-top: 4px;
        }

        .aside-subtitle {
            font-size: 14px;
        }

        .main-content {
            margin-left: calc(var(--side-width) + 20px);
            padding-top: 54px;
        }
    </Style>
</head>

<body>

<nav class="main-nav d-flex bg-dark fixed-top shadow">
        <a class="text-nowrap px-3 text-white text-decoration-none d-flex align-items-center justify-content-center logo flex-shrink-0 fs-4 text" href="">藝拍</a>
        <div class="nav">
            <a class="nav-link active" aria-current="page" href="#">首頁</a>
            <a class="nav-link" href="../product/product-list2.php">藝術品</a>
            <a class="nav-link" href="../seller/sellers.php">畫家</a>
            <a class="nav-link" href="../user/users.php">會員</a>
            <a class="nav-link" href="../product/order-list.php">訂單</a>
            <a class="nav-link" href="../user/product-list2.php">展覽空間</a>
        </div>
        <div class="position-absolute top-0 end-0">
            <a class="btn btn-dark text-nowrap" href="logout.php">Sign out</a>
        </div>
    </nav>
    <aside class="left-aside position-fixed bg-dark border-end">
        <nav class="aside-menu">
            <!-- <div class="pt-2 px-3 pb-2 d-flex justify-content-center text-white">
        Welcome <?= $_SESSION["user"]["account"] ?> !
      </div> -->
            <ul class="list-unstyled">
                <h1 class="py-2 d-flex justify-content-center text-white">會員</h1>
                <hr class="text-white">
                <li><a href="../user/users.php" class="px-3 py-2"> <i class="fa-solid fa-gauge fa-fw"></i>會員資料</a></li>
                <li><a href="../product/order-list.php" class="px-3 py-2"><i class="fa-regular fa-file-lines fa-fw"></i>訂單管理</a></li>
                <li><a href="" class="px-3 py-2"><i class="fa-solid fa-user"></i>折扣卷</a></li>
                <li><a href="../product/product-list2.php" class="px-3 py-2"><i class="fa-solid fa-cart-shopping"></i>藝術品</a></li>
                <li><a href="" class="px-3 py-2"><i class="fa-solid fa-chart-simple"></i>我的收藏</a></li>
            </ul>

        </nav>
    </aside>

</div>
<main class="main-content">
        <div class="d-flex justify-content-between">
      

        <div class="container">

          <div class="py-2">
            <a class="btn btn-dark" href="order-list.php">返回</a>
          </div>
          <table class="table">
            <tr>
              <th>訂單編號</th>
              <td><?= $row["id"] ?></td>
            </tr>
            <tr>
              <th>訂購日期</th>
              <td><?= $row["order_date"] ?></td>
            </tr>
            <tr>
              <th>訂購者</th>
              <td><?= $row["account"] ?></td>
            </tr>
            <tr>
              <th>品名</th>
              <td><?= $row["product_id"] ?></td>
            </tr>
            <tr>
              <th>單價</th>
              <td><?= $row["price"] ?></td>
            </tr>
            <tr>
              <th>數量</th>
              <td><?= $row["amount"] ?></td>
            </tr>
            <tr>
              <th>總價</th>
              <td><?= $row["price"] * $row["amount"] ?></td>
            </tr>
            <tr>
              <th>出貨狀態</th>
              <td>
                <?php
                 if($row["order_status"] == 1){
                    echo"待出貨";    
                }else if($row["order_status"] == 2){
                    echo"出貨中";    
                }else if($row["order_status"] == 3){
                    echo"已送達";    
                } 
                ?>
              </td> 
                                               
            </tr>
          </table>
        </div>
      </div>
      </div>
    </main>
  <!-- <footer class="footer">
        <div class="container-fruid d-flex justify-content-center">
            <div class="menu list-unstyled inline-flex">

                <a href="#" class="text-decoration-none text-white-50 px-2">關於 藝拍</a>

                <a href="#" class="text-decoration-none text-white-50 px-2">隱私權政策</a>

                <a href="#" class="text-decoration-none text-white-50 px-2">聯絡我們</a>
            </div>

        </div>
        <div class="d-flex justify-content-center">
            <div class="menu list-unstyled inline-flex py-2">
                <a href="" class="text-decoration-none text-white-50">E𝝅 © All Rights Reserved.</a>
            </div>

        </div>


    </footer> -->
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
        ];

        const data = {
            labels: labels,
            datasets: [{
                label: 'My First dataset',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [0, 10, 5, 2, 20, 30, 45],
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
</body>

</html>