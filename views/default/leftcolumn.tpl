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
    {if isset($arUser)}
        <div id="userBox">
            <a href="/user/" id="userLink">{$arUser["displayName"]}</a><br>
            <a href="/user/logout/0/" <!--onclick="logOut();"-->>Exit</a>
        </div>
    {else}
        <div id="userBox" class="hideme">
            <a href="#" id="userLink"></a><br>
            <a href="/user/logout/0/" <!--onclick="logOut();"-->>Exit</a>
        </div>
        {if ! isset($hideLoginBox)}
            {*User login form*}
            <div id="loginBox">
                <div class="menuCaption">Authorization</div>
                <label for="loginEmail">Email</label>
                <input type="email" id="loginEmail" name="loginEmail" placeholder="Email...">
                <label for="loginPwd">Password</label>
                <input type="password" id="loginPwd" name="loginPwd" placeholder="Password...">
                <input type="button" value="Login" onclick="login();">
            </div>
            {*User registration form*}
            <div id="registerBox">
                <div class="menuCaption showHidden">
                    <a href="#" onclick="showRegBox(); return false;">Registration</a>
                </div>
                <div id="registerBoxHidden" class="hideme">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="email...">
                    <label for="pwd1">Password</label>
                    <input type="password" id="pwd1" name="pwd1" placeholder="password...">
                    <label for="pwd2">Confirm password</label>
                    <input type="password" id="pwd2" name="pwd2" placeholder="password...">
                    <input type="button" value="Submit" onclick="registerNewUser();">
                </div>
            </div>
        {/if}
    {/if}
    {*Cart link*}
    <div class="cart">
        <div class="menu-caption">Cart
            <a href="/cart/" title="go to cart">In the cart</a>
            <span id="#cartCntItems">
                    {$cartCntItems}
            </span>
        </div>
    </div>
</aside>