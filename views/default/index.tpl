{*central part of the page*}
{foreach $rsProducts as $item}
    <div class="product-container">
        <a href="/product/{$item["id"]}">
            <img src="images/products/{$item["image"]}">
        </a><br>
        <a href="/product/{$item["id"]}/">{$item["name"]}</a>
    </div>

{/foreach}


