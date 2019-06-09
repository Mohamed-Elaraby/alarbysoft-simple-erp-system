<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('admin/assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>
                    {{ Auth::user()->name }} -
                    @if(Auth::user()->admin == true)
                        Admin
                    @elseif(Auth::user()->moderator == true)
                        Moderator
                    @else
                        Seller
                    @endif
                </p>
{{--                <a href="{{ route('user.profile', Auth::user()->id) }}"><i class="fa fa-circle text-success"></i> Online</a>--}}
            </div>
        </div>
        <!-- search form -->
        <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

{{--=========================================================--}}

           {{-- @if(Auth::user()->seller == true)
                --}}{{-- User Area --}}{{--
                <li class="header">Seller</li>
                <li class="{{ Route::currentRouteName() == 'user.dashboard' ? 'active': '' }}">
                    <a href="{{ route('user.dashboard') }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="{{ Route::currentRouteName() == 'user.comments' ? 'active': '' }}">
                    <a href="{{ route('user.comments') }}">
                        <i class="fa fa-comments"></i> <span>comments</span>
                    </a>
                </li>
            @endif--}}

{{--=========================================================--}}

        {{--@if(Auth::user()->moderator == true)
            --}}{{-- Dealer Area --}}{{--
            <li class="header">Moderator Area</li>

            <li class="">
                <a href="{{ route('dealer.dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="">
                <a href="{{ route('dealer.comments') }}">
                    <i class="fa fa-comments"></i>
                    <span>Comments</span>
                </a>
            </li>

            <li class="treeview">
                <a href="{{ route('dealer.products') }}" onclick="event.preventDefault();">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Products</span>
                    <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('dealer.createProduct') }}"><i class="fa fa-plus"></i>Create Product</a></li>
                    <li><a href="{{ route('dealer.products') }}"><i class="fa fa-eye"></i> Show All Products</a></li>
                </ul>
            </li>
        @endif--}}
{{--=========================================================--}}

        @if(Auth::user()->admin == true)
            {{-- Admin Area --}}
            <li class="header">Admin</li>

            {{-- Dashboard link--}}
                <li class="">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

            {{-- Comments link--}}
                {{--<li class="">
                    <a href="#">
                        <i class="fa fa-comments"></i>
                        <span>Comments</span>
                    </a>
                </li>--}}

            {{-- Categories link--}}
            <li class="treeview">
                <a href="{{ route('admin.categories.index') }}" onclick="event.preventDefault();">
                    <i class="fa fa-th-large"></i>
                    <span>Categories</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.categories.create') }}"><i class="fa fa-plus"></i>Create Category</a></li>
                    <li><a href="{{ route('admin.categories.index') }}"><i class="fa fa-eye"></i> Show All Categories</a></li>
                </ul>
            </li>

            {{-- Products link--}}
            <li class="treeview">
                    <a href="{{ route('admin.products.index') }}" onclick="event.preventDefault();">
                        <i class="fa fa-shopping-cart"></i>
                        <span>Products</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.products.create') }}"><i class="fa fa-plus"></i>Create Product</a></li>
                        <li><a href="{{ route('admin.products.index') }}"><i class="fa fa-eye"></i> Show All Products</a></li>
                    </ul>
                </li>

            {{-- Stores link--}}
            <li class="treeview">
                <a href="{{ route('admin.stores.index') }}" onclick="event.preventDefault();">
                    <i class="fa fa-renren"></i>
                    <span>Stores</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.stores.create') }}"><i class="fa fa-plus"></i>Create Store</a></li>
                    <li><a href="{{ route('admin.stores.index') }}"><i class="fa fa-eye"></i> Show All Stores</a></li>
                </ul>
            </li>

            {{-- Suppliers link--}}
            <li class="treeview">
                <a href="{{ route('admin.suppliers.index') }}" onclick="event.preventDefault();">
                    <i class="fa fa-truck"></i>
                    <span>Suppliers</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.suppliers.create') }}"><i class="fa fa-plus"></i>Create Supplier</a></li>
                    <li><a href="{{ route('admin.suppliers.index') }}"><i class="fa fa-eye"></i> Show All Suppliers</a></li>
                </ul>
            </li>

            {{-- Clients link--}}
            <li class="treeview">
                <a href="{{ route('admin.clients.index') }}" onclick="event.preventDefault();">
                    <i class="fa fa-address-card-o"></i>
                    <span>Clients</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.clients.create') }}"><i class="fa fa-plus"></i>Create Client</a></li>
                    <li><a href="{{ route('admin.clients.index') }}"><i class="fa fa-eye"></i> Show All Clients</a></li>
                </ul>
            </li>

            {{-- Purchases link--}}
            <li class="treeview">
                <a href="{{ route('admin.purchases.index') }}" onclick="event.preventDefault();">
                    <i class="fa fa-credit-card"></i>
                    <span>Purchases</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.purchases.create') }}"><i class="fa fa-plus"></i>Create Purchase Order</a></li>
                    <li><a href="{{ route('admin.purchases.index') }}"><i class="fa fa-eye"></i> Show All Purchases Invoices</a></li>
                </ul>
            </li>

            {{-- Sales link--}}
            <li class="treeview">
                <a href="{{ route('admin.sales.index') }}" onclick="event.preventDefault();">
                    <i class="fa fa-money"></i>
                    <span>Sales</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.sales.create') }}"><i class="fa fa-plus"></i>Create Sale</a></li>
                    <li><a href="{{ route('admin.sales.index') }}"><i class="fa fa-eye"></i> Show All Sales</a></li>
                </ul>
            </li>

                {{-- Expenses link--}}
                <li class="treeview">
                    <a href="{{ route('admin.expenses.index') }}" onclick="event.preventDefault();">
                        <i class="fa fa-money"></i>
                        <span>Expenses</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.expenses.create') }}"><i class="fa fa-plus"></i>Create Expense</a></li>
                        <li><a href="{{ route('admin.expenses.index') }}"><i class="fa fa-eye"></i> Show All Expenses</a></li>
                    </ul>
                </li>

                {{-- Payments link--}}
                <li class="treeview">
                    <a href="{{ route('admin.payments.index') }}" onclick="event.preventDefault();">
                        <i class="fa fa-money"></i>
                        <span>Clients Payments</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.payments.create') }}"><i class="fa fa-plus"></i>Create Payment</a></li>
                        <li><a href="{{ route('admin.payments.index') }}"><i class="fa fa-eye"></i> Show All Payments</a></li>
                    </ul>
                </li>

                {{-- Collecting link--}}
                <li class="treeview">
                    <a href="{{ route('admin.collecting.index') }}" onclick="event.preventDefault();">
                        <i class="fa fa-money"></i>
                        <span>Clients Collecting</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.collecting.create') }}"><i class="fa fa-plus"></i>Create Collecting</a></li>
                        <li><a href="{{ route('admin.collecting.index') }}"><i class="fa fa-eye"></i> Show All Collecting</a></li>
                    </ul>
                </li>

                {{-- Supplier Payments link--}}
                <li class="treeview">
                    <a href="{{ route('admin.supplierPayments.index') }}" onclick="event.preventDefault();">
                        <i class="fa fa-money"></i>
                        <span>Suppliers Payments</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.supplierPayments.create') }}"><i class="fa fa-plus"></i>Create Payment</a></li>
                        <li><a href="{{ route('admin.supplierPayments.index') }}"><i class="fa fa-eye"></i> Show All Payments</a></li>
                    </ul>
                </li>

                {{-- Supplier Collecting link--}}
                <li class="treeview">
                    <a href="{{ route('admin.supplierCollecting.index') }}" onclick="event.preventDefault();">
                        <i class="fa fa-money"></i>
                        <span>Suppliers Collecting</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.supplierCollecting.create') }}"><i class="fa fa-plus"></i>Create Collecting</a></li>
                        <li><a href="{{ route('admin.supplierCollecting.index') }}"><i class="fa fa-eye"></i> Show All Collecting</a></li>
                    </ul>
                </li>

            {{-- Users link--}}
                {{--<li class="treeview">
                    <a href="{{ route('admin.users') }}" onclick="event.preventDefault();">
                        <i class="fa fa-users"></i>
                        <span>Users</span>
                        <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.createUser') }}"><i class="fa fa-plus"></i>Create User</a></li>
                        <li><a href="{{ route('admin.users') }}"><i class="fa fa-eye"></i> Show All Users</a></li>
                    </ul>
                </li>--}}
            @endif

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
