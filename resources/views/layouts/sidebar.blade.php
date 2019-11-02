<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">SIBUGA</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                {{-- <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Starter Pages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Active Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Inactive Page</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-item">
                    <a href="/manage/users" class="nav-link {{ (request()->is('manage/users*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/manage/companies"
                        class="nav-link {{ (request()->is('manage/companies*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Companies
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/manage/contacts"
                        class="nav-link {{ (request()->is('manage/contacts*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>
                            Contacts
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/manage/products"
                        class="nav-link {{ (request()->is('manage/products*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Products
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/manage/quotations"
                        class="nav-link {{ (request()->is('manage/quotations*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Quotations
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/manage/projects"
                        class="nav-link {{ (request()->is('manage/projects*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            Projects
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/manage/expenses"
                        class="nav-link {{ (request()->is('manage/expenses*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>
                            Expenses
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
