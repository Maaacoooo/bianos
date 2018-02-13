
  <link rel="stylesheet" href="<?=base_url('assets/css/core.css')?>">
  <link rel="stylesheet" href="<?=base_url('assets/css/components.css')?>">
  <link rel="stylesheet" href="<?=base_url('assets/icons/fontawesome/styles.min.css')?>">

    <!-- inject:SIDEBAR -->

            <div id="sidebar-main" class="sidebar sidebar-default">
    <div class="sidebar-content">
        <ul class="navigation">

            <li class="navigation-header">
                <span>MAIN NAVIGATION</span>
                <i class="icon-menu"></i>
            </li> 

            <li>
                <a href="<?=base_url('dashboard')?>"><i class="fa fa-home"></i> <span>Dashboard</span></a>
            </li>

        <!--    <li class="navigation-header">
                <span>MAIN NAVIGATION</span>
                <i class="icon-menu"></i>
            </li> -->

            <li>
                <a href="index.html"><i class="fa fa-list-alt"></i> <span>Ingredients & Stocks</span></a>
                <ul>
                    <li><a href="<?=base_url('stocks')?>">Stock List</a></li>
                    <li><a href="<?=base_url('stocks/add_ingredients')?>">Add Ingredients</a></li>
                </ul>
            </li>

            <li>
                <a href="index.html"><i class="fa fa-list-alt"></i> <span>Sales</span></a>
                <ul>
                    <li><a href="<?=base_url('sales/create')?>">Sales Register</a></li>
                </ul>
            </li>

            <li>
                <a href="index.html"><i class="fa fa-list-alt"></i> <span>Products</span></a>
                <ul>
                    <li><a href="<?=base_url('menu')?>">Menu</a></li>
                    <li><a href="<?=base_url('menu/create')?>">Register Menu</a></li>
                    <li><a href="<?=base_url('menu/category')?>">Menu Category</a></li>
                </ul>
            </li>

            <li>
                <a href="<?=base_url('transactions')?>"><i class="fa fa-list"></i> <span>Trasactions</span></a>
            </li>

            <li class="navigation-header">
                <span>ADMIN OPTION</span>
                <i class="icon-menu"></i>
            </li> 

            <li>
                <a href="<?=base_url('users')?>"><i class="fa fa-users"></i> <span>Users</span></a>
            </li>

            <li>
                <a href="<?=base_url('messages')?>"><i class="fa fa-inbox"></i> <span>Messages</span></a>
            </li>


        </ul>
    </div>
</div>

    <script type="text/javascript" src="<?=base_url('assets/lib/js/jquery.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/lib/js/tether.min.js')?>"></script>
            <!-- inject:/SIDEBAR -->