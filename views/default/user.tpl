{*User's page*}
<h2>Your profile data</h2>
<table class="user-data">
    <tr>
        <td>Login (email)</td>
        <td>{$arUser["email"]}</td>
    </tr>
    <tr>
        <td>Name</td>
        <td><input type="text" id="newName" value="{$arUser["name"]}" placeholder="Name"></td>
    </tr>
    <tr>
        <td>Phone</td>
        <td><input type="text" id="newPhone" value="{$arUser["phone"]}" placeholder="Phone"></td>
    </tr>
    <tr>
        <td>Address</td>
        <td><textarea id="newAddress" placeholder="Address">{$arUser["address"]}</textarea></td>
    </tr>
    <tr>
        <td>New password</td>
        <td><input type="password" id="newPwd1" value="" placeholder="New password"></td>
    </tr>
    <tr>
        <td>Confirm new password</td>
        <td><input type="password" id="newPwd2" value="" placeholder="Confirm password"></td>
    </tr>
    <tr>
        <td>To save changes enter your password</td>
        <td><input type="password" id="curtPwd" value="" placeholder="Current password"></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><input type="button" value="Save" onclick="updateUserData();"></td>
    </tr>
</table>

<h2>Orders</h2>
{if ! $rsUserOrders}
    No orders
{else}
    <table class="orders-tbl">
        <thead>
        <tr>
            <th>#</th>
            <th>Action</th>
            <th>Order ID</th>
            <th>Status</th>
            <th>Created</th>
            <th>Payed</th>
            <th>Info</th>
        </tr>
        </thead>
        <tbody>
        {foreach $rsUserOrders as $item name=orders}
            <tr>
                <td>{$smarty.foreach.orders.iteration}</td>
                <td><a href="#" onclick="showOrderedProducts({$item["id"]}); return false;">Show ordered products</a></td>
                <td>{$item["id"]}</td>
                <td>
                    {if $item["status"]}
                        Payed
                    {else}
                        Not payed
                    {/if}
                </td>
                <td>{$item["date_created"]}</td>
                <td>{$item["date_payment"]}&nbsp;</td>
                <td>{$item["comment"]}</td>
            </tr>

        <tr id="purchaseForOrder_{$item["id"]}" class="hideme">
            <td colspan="7">
                {if $item["children"]}
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $item["children"] as $itemChild name=products}
                            <tr>
                                <td>{$smarty.foreach.products.iteration}</td>
                                <td>{$itemChild["product_id"]}</td>
                                <td><a href="/product/{$itemChild["product_id"]}/">{$itemChild["name"]}</a></td>
                                <td>{$itemChild["price"]}</td>
                                <td>{$itemChild["amount"]}</td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
                {/if}
            </td>
        </tr>
        {/foreach}
        </tbody>
    </table>
{/if}