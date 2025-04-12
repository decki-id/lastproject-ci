<div class="nav-left-sidebar sidebar-dark">
    <ul class="navbar-nav flex-column sidebar-nav-fixed">
        <div id="navbar-brand">
            <a href="<?= base_url('agent/'); ?>"><img src="<?= base_url('images/'); ?>logo-ci.png" width="60"></a>
        </div>
        <li class="nav-item">
            <a href="<?= base_url('agent/'); ?>" class="nav-link <?= $title == 'Tickets' ? 'active' : ''; ?>">
                <i class="fas fa-fw fa-ticket-alt"></i>Tickets
            </a>
            <a href="<?= base_url('agent/lists_menu/'); ?>" class="nav-link <?= $title == 'Lists' ? 'active' : '' ?>">
                <i class="fa fa-fw fa-user-circle"></i>Lists
            </a>
            <a href="<?= base_url('agent/reports_menu/'); ?>" class="nav-link <?= $title == 'Reports' ? 'active' : '' ?>">
                <i class="far fa-fw fa-chart-bar"></i>Reports
            </a>
        </li>
    </ul>
</div>