{*order page*}

<h2>Order data</h2>
<form id="frmOrder" action="/cart/saveorder/0/" method="post">
    <table>
        <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Quantity</td>
                <td>Price</td>
                <td>Total Cost</td>
            </tr>
        </thead>
        <tbody>
            {foreach $rsProducts as $item name=products}
                <tr>
                    <td>{$smarty.foreach.products.iteration}</td>
                    <td><a href="/product/{$item["id"]}/">{$item["name"]}</a></td>
                    <td>
                        <span id="itemCnt_{$item["id"]}">
                            <input type="hidden" name="itemCnt_{$item["id"]}" value="{$item["cnt"]}">
                            {$item["cnt"]}
                        </span>
                    </td>
                    <td>
                        <span id="itemPrice_{$item["id"]}">
                            <input type="hidden" name="itemPrice_{$item["id"]}" value="{$item["price"]}">
                            {$item["price"]}
                        </span>
                    </td>
                    <td>
                        <span id="itemRealPrice_{$item["id"]}">
                            <input type="hidden" name="itemRealPrice_{$item["id"]}" value="{$item["realPrice"]}">
                            {$item["realPrice"]}
                        </span>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
    {if isset($arUser)}
        {$buttonClass = ""}
        <h2>User data</h2>
        <div id="orderUserBox" {$buttonClass}>
            {$name    = $arUser["name"]}
            {$phone   = $arUser["phone"]}
            {$address = $arUser["address"]}
            <table>
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td><input type="text" id="name" name="name" value="{$name}"></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><input type="text" id="phone" name="phone" value="{$phone}"></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><textarea id="address" name="address">{$address}</textarea></td>
                    </tr>
                </tbody>
            </table>
        </div>
    {else}
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

                <label for="name">Your name</label>
                <input type="text" id="name" name="name" placeholder="name...">

                <label for="phone">Your phone</label>
                <input type="text" id="phone" name="phone" placeholder="phone...">

                <label for="address">Your address</label><br>
                <textarea  id="address" name="address" placeholder="address..."></textarea>

                <input type="button" value="Submit" onclick="registerNewUser();">
            </div>
        </div>
        {$buttonClass = "class='hideme'"}
    {/if}
    <input type="button" {$buttonClass} id="btnSaveOrder" value="Save order" onclick="saveOrder();">
</form>