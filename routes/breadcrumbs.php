<?php
use Diglactic\Breadcrumbs\Breadcrumbs;

use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


// Home
Breadcrumbs::for('employer.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('employer.dashboard.index'));
});
