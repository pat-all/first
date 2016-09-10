{*cart template*}
<h1>Cart</h1>

{if ! $rsProducts}
    Cart is empty.
    {else}
        <h2>Cart Data</h2>
    <table>
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Quantity</td>
            <td>Price</td>
            <td>Total Cost</td>
            <td>Action</td>
        </tr>
        {foreach $rsProducts as $item}
            <tr>
                <td>{$smarty.foreach.iteration}</td>
                <td><a href="/product/{$item["id"]}/">{$item["name"]}</a></td>
                <td><input type="number" name="itemCnt_{$item["id"]}" id="itemCnt_{$item["id"]}" value="1" onchange="conversionPrice({$item["id"]})"></td>
                <td>
                    <span id="itemPrice_{$item["id"]}" value="{$item["price"]}">{$item["price"]}</span>
                </td>
                <td></td>
                <td></td>
            </tr>
        {/foreach}
    </table>
{/if}
