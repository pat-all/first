<aside> {*left side menu*}
    <nav class="leftMenu">
        <div class="menu-caption">
            Menu:
        </div>
        {foreach $rsCategories as $item}
            <a href="/?controller=category&id={$item["id"]}">{$item["name"]}</a><br>

            {if isset($item["children"])}
                {foreach $item["children"] as $itemChild}
                    --<a href="/?controller=category&id={$itemChild["id"]}">{$itemChild["name"]}</a><br>
                {/foreach}
            {/if}

        {/foreach}
    </nav>
    <div class="cart">
        <div class="menu-caption">Cart
            <a href="/cart/" title="go to cart">In the cart</a>
            <span>
                {if $cartCntItems > 0}
                    {$cartCntItems}
                    {else} Empty
                {/if}
            </span>
        </div>
    </div>
</aside>