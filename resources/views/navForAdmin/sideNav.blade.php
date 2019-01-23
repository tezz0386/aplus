<nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i>Category</a>
                                <div id="submenu-2" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('addparent')}}">Add Category <span class="badge badge-secondary">New</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('list')}}">All Parent Category</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('allchild')}}">All Child Category</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Trashed Categories</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw fa-chart-pie"></i>Product</a>
                                <div id="submenu-3" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                       <li class="nav-item">
                                            <a class="nav-link" href="{{route('createProduct')}}">Add Products</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('allproduct')}}">All Products</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('product.get.trash')}}">Trashed Product</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fab fa-fw fa-wpforms"></i>Order Management</a>
                                <div id="submenu-4" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.order')}}">View Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.order.trash.view')}}">View Trash Order</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{route('admin.transaction')}}" ><i class="fab fa-fw fa-wpforms"></i>Transaction
                                </a>  
                            </li>
                            
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
</nav>