<?php
require_once('model/database.php');
require_once('model/product_db.php');

// 1. Yêu cầu 4: Lấy danh sách sản phẩm thuộc danh mục 'Guitars' (category_id = 1)
$category_id = 1; 
$products = get_products_by_category($category_id);

// 2. Thử xóa một sản phẩm mẫu
$product_id_to_delete = 1;
$rows_deleted = delete_product($product_id_to_delete);

// 3. Yêu cầu 5: Thêm sản phẩm mới với mã code tự động ngẫu nhiên để không bị trùng
$category_id = 1;
$code = 'mora_' . rand(1000, 9999); 
$name = 'Stratocaster';
$description = 'Fender Stratocaster Electric Guitar';
$price = '799.99';
$discount_percent = 0;

// Gọi hàm add_product() với đầy đủ 6 tham số
$inserted_product_id = add_product($category_id, $code, $name, $description, $price, $discount_percent);

?>
<!DOCTYPE html>
<html>
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>Danh sách sản phẩm</h1>
        
        <!-- Yêu cầu 4: Hiển thị danh sách Guitars (Thêm liên kết <a> nếu muốn bấm được vào từng mục) -->
        <h2>Đàn guitar</h2>
        <ul>
            <?php foreach ($products as $product) : ?>
            <li>
                <a href="?product_id=<?php echo $product['productID']; ?>">
                    <?php echo htmlspecialchars($product['productName']); ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>

        <!-- Hiển thị thông báo xóa sản phẩm -->
        <h2>Xóa sản phẩm</h2>
        <?php if ($rows_deleted > 0) : ?>
            <p>Đã xóa thành công <?php echo $rows_deleted; ?> sản phẩm.</p>
        <?php else : ?>
            <p>Không có hàng nào bị xóa.</p>
        <?php endif; ?>

        <!-- Yêu cầu 5: Hiển thị thông báo chèn sản phẩm -->
        <h2>Chèn sản phẩm</h2>
        <?php if ($inserted_product_id > 0) : ?>
            <p>Thêm thành công 1 sản phẩm với ID: <?php echo $inserted_product_id; ?> (Mã: <?php echo $code; ?>)</p>
        <?php else : ?>
            <p>Sản phẩm không được thêm vào. (Mã trùng lập hoặc lỗi cơ sở dữ liệu)</p>
        <?php endif; ?>

    </main>
</body>
</html>