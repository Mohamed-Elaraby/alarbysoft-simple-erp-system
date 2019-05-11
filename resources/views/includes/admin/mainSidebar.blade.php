<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('admin/assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="{{ route('user.profile', Auth::user()->id) }}"><i class="fa fa-circle text-success"></i> Online</a>
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

            {{-- User Area --}}
            <li class="header">User</li>
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

{{--=========================================================--}}

            {{-- Dealer Area --}}
            <li class="header">Dealer Area</li>

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

{{--=========================================================--}}

            {{-- Admin Area --}}
            <li class="header">Admin</li>

                <li class="">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="">
                    <a href="{{ route('admin.comments') }}">
                        <i class="fa fa-comments"></i>
                        <span>Comments</span>
                    </a>
                </li>

                <li class="treeview">
                    <a href="{{ route('admin.products') }}" onclick="event.preventDefault();">
                        <i class="fa fa-shopping-cart"></i>
                        <span>Products</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.createProduct') }}"><i class="fa fa-plus"></i>Create Product</a></li>
                        <li><a href="{{ route('admin.products') }}"><i class="fa fa-eye"></i> Show All Products</a></li>
                    </ul>
                </li>

                <li class="treeview">
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
                </li>


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
