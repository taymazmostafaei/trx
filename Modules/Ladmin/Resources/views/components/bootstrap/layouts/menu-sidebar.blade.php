@php
$viewMenu = function ($menus) use (&$viewMenu, $permissions) {
    $html = '';
    foreach ($menus as $menu) {
        if (in_array($menu['gate'], $permissions)) {
            $html .= ladmin()->component('layouts._parts._sidebar_menu_item', ['menu' => $menu, 'viewMenu' => $viewMenu]);
        }
    }
    return $html;
};
@endphp

<ul>
    @if (Route::has('ladmin.index'))
        <li class="menu-item {{ Route::is('ladmin.index') ? 'active' : null }}" id="menu-dashboard">
            <a href="{{ route('ladmin.index') }}">
                <i class="fa fa-solid fa-table-columns"></i>
                <span class="title">داشبورد</span>
            </a>
        </li>
    @endif
    {!! $viewMenu( ladmin()->menu()->all(), false ) !!}
    <li class="menu-item {{ Route::is('ladmin.service.index') ? 'active' : null }}" id="menu-dashboard">
        <a href="{{ route('ladmin.service.index') }}">
            <i class="fa fa-solid fa-cogs"></i>
            <span class="title">سرویس ها</span>
        </a>
    </li>
    <li class="menu-item {{ Route::is('ladmin.transactions.index') ? 'active' : null }}" id="menu-dashboard">
        <a href="{{ route('ladmin.transactions.index') }}">
            <i class="fa fa-solid fa-usd"></i>
            <span class="title">تراکنش ها</span>
        </a>
    </li>
    <li class="menu-item {{ Route::is('ladmin.document.index') ? 'active' : null }}" id="menu-dashboard">
        <a href="{{ route('ladmin.document.index') }}">
            <i class="fa fa-solid fa-file"></i>
            <span class="title">آموزش استفاده</span>
        </a>
    </li>
</ul>
