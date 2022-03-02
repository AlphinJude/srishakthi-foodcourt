<header>
    <nav class="page-header">
        <div class="logo"><img src="../images/logo.png" alt=""></div>
        <ul>
            <li id="select-store" onclick="location.href='select-store.php'">
                <img src="../icons/store.svg" alt="">
                <p>Select Store</p>
            </li>
            <li id="items" onclick="location.href='items.php'">
                <img src="../icons/item.svg" alt="">
                <p>Item List</p>
            </li>
            <li id="change-price" onclick="location.href='change-price.php'">
                <img src="../icons/receipt.svg" alt="">
                <p>Change Price</p>
            </li>
            <li id="inventory" onclick="location.href='inventory.php'">
                <img src="../icons/inventory.svg" alt="">
                <p>Inventory</p>
            </li>
            <li id="report" onclick="location.href='report.php'">
                <img src="../icons/report.svg" alt="">
                <p>Report</p>
            </li>
        </ul>
        <div class="logout-button">
            <li id="logout" onclick="location.href='logout.php'">
                <img src="../icons/logout.svg" alt="">
                <p>Logout</p>
            </li>
        </div>
    </nav>
</header>

<div class="header">
    <h3>Sri Shakthi Food Court
        <?php
            if(isset($_SESSION["store"]))
                if($_SESSION["store"] == "juice")
                    echo " - Sri Maheshwari Fruit Stall";
                else if($_SESSION["store"] == "chakram")
                    echo " - Chakaram Cafe";
        ?>
    </h3>
</div>

<div class="footer">Designed and developed by Alphin Jude V, Dhanush G, Rashmi Singh and Sneka T under the guidance of Mr. R Karthiban AP and Ms. Nivedha, <br> Deptartment of CSE, <br> Sri Shakthi Institute of Engineering and Technology.</div>