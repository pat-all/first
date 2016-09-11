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
    <div id="registerBox">
        <div class="menuCaption showHidden"><a href="#" onclick="showRegBox();">Registration</a></div>
        <div id="registerBoxHidden">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="email...">
                <label for="pwd1">Password</label>
                <input type="password" id="pwd1" name="pwd1" placeholder="password...">
                <label for="pwd2">Confirm password</label>
                <input type="password" id="pwd2" name="pwd2" placeholder="password...">
                <input type="button" value="Submit" onclick="registerNewUser();">
        </div>
    </div>
    <div class="cart">
        <div class="menu-caption">Cart
            <a href="/cart/" title="go to cart">In the cart</a>
            <span id="#cartCntItems">
                    {$cartCntItems}
            </span>
        </div>
    </div>
</aside>