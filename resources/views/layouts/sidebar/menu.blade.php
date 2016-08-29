<!-- Sidebar Menu -->
        <ul class="sidebar-menu">
          <li class="header">Main Navigation</li>
          <!-- Optionally, you can add icons to the links -->
          <li {{ \Request::segment(1) == 'home' ? 'class="active"' : '' }}><a href="{{ url('/home') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>

          <li class="treeview">
            <a href="#"><i class="fa fa-table"></i> <span>Master</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li {{ \Request::segment(1) == 'example' ? 'class="active"' : '' }}><a href="{{ url('/item') }}">Items</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#"><i class="fa fa-pencil"></i> <span>Transaction</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li {{ \Request::segment(1) == 'transaction' ? 'class="active"' : '' }}><a href="{{ url('/transaction') }}">Transaction</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#"><i class="fa fa-area-chart"></i> <span>Reports</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="#">Report X</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#"><i class="fa fa-wrench"></i> <span>System</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
            <li class="treeview">
            <a href="#"><span>Permission</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="#">Users</a></li>
              <li><a href="#">Roles</a></li>
            </ul>
          </li>
              <li><a href="#">Configuration</a></li>
            </ul>
          </li>

        </ul>
        <!-- /.sidebar-menu -->