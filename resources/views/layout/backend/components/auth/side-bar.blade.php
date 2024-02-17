<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Menu</h6>
                    <ul>
                        <li class="{{ Route::is('home', 'home.datefilter') ? 'active' : '' }} m-2">
                            <a href="{{ route('home') }}"><i data-feather="grid"></i><span>Dashboard</span></a>
                        </li>
                    </ul>
                </li>

                <li class="submenu-open">
                    <h6 class="submenu-hdr">Sales</h6>
                    <ul>
                        <li class="{{ Route::is('customer.index', 'customer.store', 'customer.edit', 'customer.delete', 'customer.checkduplicate', 'customer.viewall') ? 'active' : '' }}">
                            <a href="{{ route('customer.index') }}"><i data-feather="user"></i><span>Customers</span></a>
                        </li>
                        <li class="{{ Route::is('sales.index', 'sales.datefilter') ? 'active' : '' }}">
                            <a href="{{ route('sales.index') }}"><i data-feather="shopping-bag"></i><span>Sales</span></a>
                        </li>
                        <li class="{{ Route::is('salespayment.index', 'salespayment.datefilter') ? 'active' : '' }}">
                            <a href="{{ route('salespayment.index') }}"><i data-feather="dollar-sign"></i><span>Sales Payment</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Purchase</h6>
                    <ul>
                        <li class="{{ Route::is('supplier.index', 'supplier.store') ? 'active' : '' }}">
                            <a href="{{ route('supplier.index') }}"><i data-feather="user"></i><span>Supplier</span></a>
                        </li>
                        <li class="{{ Route::is('purchase.index', 'purchase.store', 'purchase.edit', 'purchase.datefilter', 'purchase.create') ? 'active' : '' }}">
                            <a href="{{ route('purchase.index') }}"><i data-feather="shopping-cart"></i><span>Purchase</span></a>
                        </li>
                        <li class="{{ Route::is('purchasepayment.index') ? 'active' : '' }}">
                            <a href="{{ route('purchasepayment.index') }}"><i data-feather="credit-card"></i><span>Purchase Payment</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Accounts</h6>
                    <ul>
                        <li class="{{ Route::is('expense.index', 'expense.store', 'expense.datefilter', 'expense.create') ? 'active' : '' }}">
                            <a href="{{ route('expense.index') }}"><i data-feather="share"></i><span>Expense</span></a>
                        </li>
                        <li class="{{ Route::is('openaccount.index', 'openaccount.store') ? 'active' : '' }}">
                            <a href="{{ route('openaccount.index') }}"><i data-feather="book"></i><span>Open Account</span></a>
                        </li>
                        <li class="{{ Route::is('closeaccount.index', 'closeaccount.store') ? 'active' : '' }}">
                            <a href="{{ route('closeaccount.index') }}"><i data-feather="book-open"></i><span>Close Acccount</span></a>
                        </li>
                        <li class="{{ Route::is('dinomination.index', 'dinomination.store', 'dinomination.datefilter') ? 'active' : '' }}">
                            <a href="{{ route('dinomination.index') }}"><i data-feather="trending-up"></i><span>Denomination</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Product</h6>
                    <ul>
                        <li class="{{ Route::is('session.index', 'session.store') ? 'active' : '' }}">
                            <a href="{{ route('session.index') }}"><i data-feather="sun"></i><span>Session</span></a>
                        </li>
                        <li class="{{ Route::is('category.index', 'category.store') ? 'active' : '' }}">
                            <a href="{{ route('category.index') }}"><i data-feather="box"></i><span>Category</span></a>
                        </li>
                        <li class="{{ Route::is('product.index', 'product.store') ? 'active' : '' }}">
                            <a href="{{ route('product.index') }}"><i data-feather="database"></i><span>Product</span></a>
                        </li>
                        <li class="{{ Route::is('productsession.index', 'productsession.store') ? 'active' : '' }}">
                            <a href="{{ route('productsession.index') }}"><i data-feather="sunrise"></i><span>Product Session</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Employee</h6>
                    <ul>
                        <li class="{{ Route::is('employee.index', 'employee.store', 'employee.edit', 'employee.delete', 'employee.checkduplicate') ? 'active' : '' }}">
                            <a href="{{ route('employee.index') }}"><i data-feather="users"></i><span>Employee</span></a>
                        </li>
                        <li class="{{ Route::is('emp_attendance.index', 'emp_attendance.store', 'emp_attendance.datefilter', 'emp_attendance.create', 'emp_attendance.datefilter') ? 'active' : '' }}">
                            <a href="{{ route('emp_attendance.index') }}"><i data-feather="user-check"></i><span>Attendance</span></a>
                        </li>
                        <li class="{{ Route::is('payoff.index', 'payoff.store', 'payoff.create', 'payoff.edit', 'payoff.datefilter') ? 'active' : '' }}">
                            <a href="{{ route('payoff.index') }}"><i data-feather="codesandbox"></i><span>Payoff</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Delivery Boy</h6>
                    <ul>
                        <li class="{{ Route::is('delivery.boy.index', 'delivery.boy.store') ? 'active' : '' }}">
                            <a href="{{ route('delivery.boy.index') }}"><i data-feather="user"></i><span>Delivery Boy</span></a>
                        </li>
                        <li class="{{ Route::is('delivery_attendance.index', 'delivery_attendance.store', 'delivery_attendance.datefilter', 'delivery_attendance.create', 'delivery_attendance.datefilter') ? 'active' : '' }}">
                            <a href="{{ route('delivery_attendance.index') }}"><i data-feather="truck"></i><span>Attendance</span></a>
                        </li>
                        <li class="{{ Route::is('deliveryboyspayoff.index', 'deliveryboyspayoff.store', 'deliveryboyspayoff.create', 'deliveryboyspayoff.edit', 'deliveryboyspayoff.datefilter') ? 'active' : '' }}">
                            <a href="{{ route('deliveryboyspayoff.index') }}"><i data-feather="codesandbox"></i><span>Payoff</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">General</h6>
                    <ul>
                        <li class="{{ Route::is('bank.index', 'bank.store') ? 'active' : '' }}">
                            <a href="{{ route('bank.index') }}"><i data-feather="layers"></i><span>Payment Mode</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>


