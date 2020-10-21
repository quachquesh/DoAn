<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/vendor/img/order-food-32.png">
    <title>SSM Order</title>
    <link rel="stylesheet" href="/vendor/css/order.css">
    <link rel="stylesheet" href="/vendor/css/orderResponsive.css">
    <link rel="stylesheet" href="/vendor/css/grid.css">
</head>
<body>
    <header class="grid wide">
       <div class="header">
            <div class="header_navbar">
                <a href="/" class="header_navbar-iconlink">
                    <img class = "iconlink-logo"src="/vendor/img/logo.png" alt="">
                    <span class ="iconlink-name">SSM</span>
                </a>
                <div class="header_navbar-contactlink material-icons">shopping_cart</div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="container-review">
            <img class="review-picture" src="<?php echo $store['avt'] ?>" alt="">
            <span class="review-id">Số bàn: <?php echo $table ?></span>
            <div class="review-address-box">
                <span class="review-address">Địa chỉ: <?php echo $store['address'] ?></span>
            </div>
        </div>
        <!-- Phần sản phẩm -->
        <div class="container-productlist">
            <!-- Một loại sản phẩm -->
            <?php foreach ($productType as $valueType): ?>
            <?php if ($valueType['business'] != 0): ?>
            <div class="produclist-item">
                <!-- Tiểu đề loại sản phẩm -->
                <div class="produclist-item-typename"><?php echo $valueType['typeName'] ?></div>
                <!-- 1 sản phẩm -->
                <?php foreach ($product as $value): ?>
                <?php if ($valueType['code'] == $value['typeCode']): ?>
                <div class="product">
                    <div class="product-picture">
                        <img src="<?php echo $value['avt']; ?>" alt="" loading="lazy">
                        <?php if ($value['itemsNew'] != 0): ?>
                        <span class="banner-new">New</span>
                        <?php endif ?>
                        <?php if ($value['bestSeller'] != 0): ?>
                        <span class="banner-hot">Hot</span>
                        <?php endif ?>
                    </div>
                    <div class="product-info">
                        <div class="product-name"><?php echo $value['name'] ?></div>
                        <!-- <div class="product-review">Một sản phẩm tuyệt vời uống vào cười suốt năm kkkkk</div> -->

                        <div class="product-price-buy">
                            <?php
                                $value['priceCurrent'] = $value['price'];
                                if ($value['discount'] != 0) {
                                    if ($value['discountType'] == 0) {
                                        $value['priceCurrent'] = $value['priceCurrent']/100*(100-$value['discount']);
                                    } else {
                                        $value['priceCurrent'] = $value['priceCurrent']-$value['discount'];
                                    }
                                }
                                $value['priceCurrent'] = number_format($value['priceCurrent'], 0, ',', '.');
                                $value['price'] = number_format($value['price'], 0, ',', '.');
                            ?>
                            <?php if ($value['discount'] != 0): ?>
                            <span class="product-oldprice"><?php echo $value['price'] ?></span>
                            <?php endif ?>
                            <span class="product-price"><?php echo $value['priceCurrent'] ?></span>
                        </div>
                        <div class="button-groups">
                            <div class="product-add">Thêm</div>
                            <div class="amount-groups">
                                <span class="amount-sub material-icons">remove</span>
                                <span class="amount-number">
                                    1
                                </span>
                                <span class="amount-sum material-icons">add</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>
                <?php endforeach ?>
            </div>
            <?php endif ?>
            <?php endforeach ?>
        </div>
        <!-- <div class ="cart-outer">
            <div class="container-cart">
                <i class="material-icons">shopping_cart</i> Không có sản phẩm nào                    
            </div>
        </div> -->
    </div>
</body>
</html>