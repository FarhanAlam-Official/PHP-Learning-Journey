<?php
$images = [
    "iphone15" => "https://fdn2.gsmarena.com/vv/pics/apple/apple-iphone-15-pro-max-1.jpg",
    "s23ultra" => "https://fdn2.gsmarena.com/vv/pics/samsung/samsung-galaxy-s23-ultra-5g-1.jpg",
    "oneplus11" => "https://fdn2.gsmarena.com/vv/pics/oneplus/oneplus-11-1.jpg",
    "macbookair" => "https://fdn2.gsmarena.com/vv/pics/apple/apple-macbook-air-13-2022-1.jpg",
    "xps15" => "https://i.dell.com/sites/imagecontent/products/PublishingImages/xps-15-9530-laptop/spi/ng/xps-15-9530-hero.jpg",
    "pavilionx360" => "https://www.hp.com/content/dam/sites/worldwide/pavilionx360.jpg",
    "sandisk" => "https://m.media-amazon.com/images/I/81TlcC4j5tL._AC_SL1500_.jpg",
    "hp236" => "https://m.media-amazon.com/images/I/61iMfBlV4qL._AC_SL1500_.jpg",
    "kingston" => "https://media.kingston.com/kingston/product/ktc-product-usb-dtx-1-zm-lg.jpg",
    "realmegt" => "https://fdn2.gsmarena.com/vv/pics/realme/realme-gt2-pro-1.jpg"
];

$folder = __DIR__ . '/assets';
if (!file_exists($folder)) {
    mkdir($folder, 0777, true);
}

foreach ($images as $name => $url) {
    $filePath = "$folder/{$name}.jpg";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0'); // important for some sites
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // follow redirects

    $imageData = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200 && $imageData !== false) {
        file_put_contents($filePath, $imageData);
        echo "✅ Downloaded: $name<br>";
    } else {
        echo "❌ Failed to download: $name (HTTP $httpCode)<br>";
    }
}
?>
