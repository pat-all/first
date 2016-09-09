{*product page*}
<h3>{$rsProduct["name"]}</h3>

<img src="/images/products/{$rsProduct["image"]}" class="product-image-main">
Price: {$rsProduct["price"]}

<a href="#" id="removeCart_{$rsProduct["id"]}" {if ! $itemInCart}class="hideme"{/if} onClick="removeFromCart({$rsProduct["id"]}); return false;">Remove from cart</a>
<a href="#" id="addCart_{$rsProduct["id"]}" {if $itemInCart}class="hideme"{/if} onClick="addToCart({$rsProduct["id"]}); return false;">Add to cart</a>
<p>Description <br>{$rsProduct["description"]}</p>