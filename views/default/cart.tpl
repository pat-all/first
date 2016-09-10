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
    </table>
{/if}
