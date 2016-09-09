{*category page*}
<h1>Products of {$rsCategory["name"]} category</h1>

    {*if no products*}
    {if !$rsProducts && !$rsChildCats}
        <h3>Sorry, no products.</h3>
    {/if}

    {foreach $rsProducts as $item}
        <div class="product-container">
            <a href="/product/{$item["id"]}">
                <img src="/images/products/{$item["image"]}"><br>
            </a>
            <a href="product/{$item["id"]}/">{$item["name"]}</a>
        </div>
    {/foreach}

    {foreach $rsChildCats as $item}
        <h2><a href="category/{$item["id"]}/">{$item["name"]}</a></h2>
    {/foreach}

