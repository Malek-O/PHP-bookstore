<?php

include_once 'header.php';
require_once './includes/getOrders.inc.php';

if (!isset($_SESSION['u_id'])) {
    header("Location: ./index.php");
    exit();
}

?>

    <div class="container-fluid  py-5 home-bac">
        <h1 class='container'>
            <span class='text-black-50'>Home</span> /
            <span> Orders</span>
        </h1>
    </div>

    <div class='container text-white py-5'>
        <div class="table-responsive">
            <table class="table table-bordered ">
                <thead class="table-dark">
                    <tr>
                        <th>ORDER_ID</th>
                        <th>ORDER_PRICE</th>
                        <th>ORDER_DATE</th>
                        <th>ORDER_STATUS</th>

                    </tr>
                </thead>
                <tbody class="table-light">

                                <?php
foreach ($data as $key => $value) {
    echo "
                                    <tr  class='fs-5'>
                                    <td>{$value['o_id']}</td>
                                    <td>\${$value['o_price']}</td>
                                    <td>{$value['date']}</td>
                                    ";
    if ($value['o_status'] == 0) {
        echo " <td><h5 class='pending'>Pending</h5></td>
                                      </tr>
                                ";
    } else {
        echo " <td><h5 class='confirmed'>Confirmed</h5></td>
                                      </tr>
                                ";
    }

}
?>

                            </tr>
                </tbody>
            </table>
        </div>
    </div>
