{*cart template*}
<h1>Cart</h1>

{if ! $rsProducts}
    Cart is empty.
    {else}
    <form action="/cart/order/0/" method="post">
            <h2>Cart Data</h2>
        <table>
            <thead>
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Quantity</td>
                    <td>Price</td>
                    <td>Total Cost</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                {foreach $rsProducts as $item name=products}
                    <tr>
                        <td>{$smarty.foreach.products.iteration}</td>
                        <td><a href="/product/{$item["id"]}/">{$item["name"]}</a></td>
                        <td><input type="number" name="itemCnt_{$item["id"]}" id="itemCnt_{$item["id"]}" value="1" onchange="conversionPrice({$item["id"]})"></td>
                        <td>
                            <span id="itemPrice_{$item["id"]}" data-price="{$item["price"]}">{$item["price"]}</span>
                        </td>
                        <td>
                            <span id="itemRealPrice_{$item["id"]}">{$item["price"]}</span>
                        </td>
                        <td>
                            <a href="#" id="removeCart_{$item["id"]}" onClick="removeFromCart({$item["id"]}); return false;">Remove</a>
                            <a href="#" id="addCart_{$item["id"]}" class="hideme" onClick="addToCart({$item["id"]}); return false;">Return</a>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
        <input type="submit" value="Create order">
    </form>
{/if}
