@yield('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <script src="{{ asset('/js/matrix.formvalidation.js') }}"></script>

    <title class="">Farmero &mdash; View Orders</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/admin" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/shop" class="nav-link">Shop</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form></a>
            </li>

        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/admin" class="brand-link">
            <img src="/images/farmeroicon.png" alt="FarmeroLogo" class="brand-image img-circle">
            <span class="brand-text font-weight-light">Admin</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="/admin/dashboard" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th-large"></i>
                            <p>
                                Categories
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/addCategory" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/viewCategory" class="nav-link">
                                    <i class="fas fa-eye nav-icon"></i>
                                    <p>View Category</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-box"></i>
                            <p>
                                Products
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/addProduct" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add Product</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/viewProduct" class="nav-link">
                                    <i class="fas fa-eye nav-icon"></i>
                                    <p>View Product</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>
                                Coupons
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/coupon/create" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add Coupon</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/coupon" class="nav-link">
                                    <i class="fas fa-eye nav-icon"></i>
                                    <p>View Coupons</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                Orders
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/viewOrders" class="nav-link active">
                                    <i class="fas fa-eye nav-icon"></i>
                                    <p>View Orders</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/delivery" class="nav-link">
                                    <i class="fas fa-truck nav-icon"></i>
                                    <p>For Delivery</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                            <li class="breadcrumb-item active">View Orders</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            @include('flashMessage')
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">View Orders</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="prodviewtable" class="table table-bordered table-border table-striped ">
                                    <thead class="table-dark">
                                    <tr align="center">
                                        <th>Order ID</th>
                                        <th>Order Date</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Customer Mobile</th>
                                        <th>Ordered Products</th>
                                        <th>Order Total</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td style="text-align: center">{{ $order['id'] }}</td>
                                            <td style="text-align: center">{{ $order['created_at']->format('Y-m-d') }}</td>
                                            <td style="text-align: center">{{ $order['name'] }}</td>
                                            <td style="text-align: center">{{ $order['user_email'] }}</td>
                                            <td style="text-align: center">{{ $order['contact'] }}</td>
                                            <td style="text-align: center">
                                                @foreach($order->orders as $prod)
                                                    {{$prod['prod_name']}}<b> x </b>{{$prod['prod_qty']}}<i style="font-size:10px;">&emsp;Code: {{$prod['prod_code']}}</i><br/>
                                                @endforeach
                                            </td>
                                            <td style="text-align: center">₱ {{ $order['total'] }}</td>
                                            <td style="text-align: center">{{ $order['payment_method'] }}</td>
                                            <td style="text-align: center">{{$order['status']}}</td>
                                            @if($order->status=="Pending")
                                            <td style="text-align: center">
                                                <a id="delCat" href="{{ route('orders.delivery',$order->id) }}" class="btn btn-primary btn-sm" onclick="return confirm('Put this order for delivery?');">Delivery</a></td>
                                            </td>
                                            @endif
                                                
                                            <!--<td style="text-align: center;">
                                                <a href="#" class="btn btn-primary btn-mini">Edit</a>&nbsp;
                                                <a href="#" class="btn btn-danger btn-mini">Delete</a>
                                            </td>-->
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot class="table-dark">
                                    <tr align="center">
                                        <th>Order ID</th>
                                        <th>Order Date</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Customer Mobile</th>
                                        <th>Ordered Products</th>
                                        <th>Order Total</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div><!-- /.card-body -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">

        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2019 <a href="#">Farmero</a>.</strong> All rights reserved.
    </footer>
</div>

<!-- ./wrapper -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="/js/app.js"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/fastclick.js') }}"></script>
<script>
    $(function () {
        $('#prodviewtable').DataTable();
    });
</script>
</body>
</html>