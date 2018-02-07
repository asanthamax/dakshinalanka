<section class="sidebar">
    <!-- Sidebar user panel -->
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
            <a href="{{url('home')}}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{url('customers')}}">
                <i class="fa fa-files-o"></i>
                <span>Customers</span>
            </a>
        </li>
        <li>
            <a href="{{url('/jobs')}}">
                <i class="fa fa-th"></i> <span>Daily JOBS</span>
            </a>
        </li>
        <li>
            <a href="{{url('/invoices')}}">
                <i class="fa fa-pie-chart"></i>
                <span>Invoices</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Balance Payments</span>
            </a>
        </li>
        <li>
            <a href="{{url('stocks')}}">
                <i class="fa fa-laptop"></i>
                <span>Stock</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Reports</span>
            </a>
        </li>
        <li>
            <a href="{{url('registeruser')}}">
                <i class="fa fa-edit"></i> <span>System Users</span>
            </a>
        </li>

    </ul>
</section>
