<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard')}}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">
            <span class="name">{{ Session('administrator')['name'] . ' ' . Session('administrator')['surname'] }}</span>
            <span style="display: block;text-transform:none;font-size:0.8rem;font-weight: 200">{{ Session('administrator')['email'] }}</span>
            </div>
            <div>
            </div>
            
        </a>

        <li class="nav-item {{ setActiveRoute(['admin.products.index', 'admin.products.create', 'admin.products.edit']) }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#products-menu"
                aria-expanded="true" aria-controls="products-menu">
                <i class="fas fa-fw fa-cog"></i>
                <span>Productos</span>
            </a>
            <div id="products-menu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ setActiveRoute('admin.products.index') }}" href="{{ route('admin.products.index')}}">Todos los productos</a>
                    <a class="collapse-item {{ setActiveRoute('admin.products.create') }}" href="{{ route('admin.products.create')}}">Nuevo producto</a>
                </div>
            </div>
        </li>

        <li class="nav-item {{ setActiveRoute(['admin.categories.index', 'admin.categories.create', 'admin.categories.edit']) }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categories-menu"
                aria-expanded="true" aria-controls="categories-menu">
                <i class="fas fa-fw fa-cog"></i>
                <span>Categorías</span>
            </a>
            <div id="categories-menu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ setActiveRoute('admin.categories.index') }}" href="{{ route('admin.categories.index')}}">Todas las categorías</a>
                    <a class="collapse-item {{ setActiveRoute('admin.categories.create') }}" href="{{ route('admin.categories.create')}}">Nueva categoría</a>
                </div>
            </div>
        </li>

        <li class="nav-item {{ setActiveRoute(['admin.users.index', 'admin.users.edit']) }}">
            <a class="nav-link" href="{{ route('admin.users.index')}}">
                <i class="fas fa-fw fa-user"></i>
                <span>Usuarios</span>
            </a>
        </li>


        <li class="nav-item {{ setActiveRoute(['admin.api.docs']) }}">
            <a class="nav-link" href="{{ route('admin.api.docs')}}">
                <i class="fas fa-fw fa-cog"></i>
                <span>API</span>
            </a>
        </li>

        <hr class="sidebar-divider d-none d-md-block">

        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>