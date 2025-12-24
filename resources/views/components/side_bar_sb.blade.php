<ul class="navbar-nav dark:bg-gray-800 bg-indigo-500 sidebar sidebar-dark accordion hidden sm:flex md:flex transition-all duration-300"
    id="accordionSidebar">





    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Tcc's
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fa-solid fa-file"></i>
            <span>Documentos</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('documentos.index')}}">Ver documentos</a>
            </div>
        </div>
    </li>



    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
            aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Tcc's</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @if (Auth::user()->tipo_usuario !== 'aluno')
                    <a class="collapse-item" href="{{ route('tcc.create')}}">Criar Tcc</a>
                @endif
                <a class="collapse-item" href="{{ route('tcc.index')}}">Verificar Tcc's</a>
            </div>
        </div>
    </li>
    <!-- Admin Area -->
    {{--
    <hr class="sidebar-divider d-none d-md-block">

    @if (Auth::user()->isAdmin())
    <div class="sidebar-heading">
        Gerenciar Usuários
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fa-solid fa-user-group"></i>
            <span> Usuários </span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.create')}}">Criar Usuário</a>
                <a class="collapse-item" href="{{ route('admin.index')}}">Verificar Usuários</a>
            </div>
        </div>
    </li>
    @endif --}}
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>