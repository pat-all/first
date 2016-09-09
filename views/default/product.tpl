{*product page*}
<h3>{$rsProduct["name"]}</h3>

<img src="/images/products/{$rsProduct["image"]}" class="product-image-main">
Price: {$rsProduct["price"]}

<a href="#" id="addCart_{$rsProduct["id"]}" onClick="addToCart({$rsProduct["id"]}); return false;">Add to cart</a>
<p>Description <br>{$rsProduct["description"]}</p>