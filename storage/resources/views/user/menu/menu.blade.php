<div class="navbar-collapse nav nav-tabs justify-content-center" id="">
    <ul class="nav navigate main_menu">
        <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('home') ? 'active' : ''}}"  href="{{ route('home') }}">Home</a></li>
        <li class="nav-item "><a class="nav-link {{ (Route::currentRouteNamed('accounts') || Route::currentRouteNamed('edit_account')) ? 'active' : ''}} "  href="{{ route('accounts') }}">Accounts</a></li>
        <li class="nav-item "><a class="nav-link {{ (Route::currentRouteNamed('contacts') || Route::currentRouteNamed('edit_contact')) ? 'active' : ''}}" href="{{ route('contacts') }}">Contacts</a></li>
        <li class="nav-item sub_menu_dropdown_company_head_link">
            <div class="d-flex gap-2 nav-link {{ (Route::currentRouteNamed('companies') || Route::currentRouteNamed('edit_company')) ? 'active' : ''}} nav_relative">
                <a class=""  href="{{ route('companies') }}">Companies</a>
                <div class="dropdown  sub_menu_dropdown_company_head">
                    <span  class="" data-toggle="dropdown">
                        <img src="{{url('image/2740722.png')}}" alt="" style="width: 15px;">
                    </span>
                    <div class="dropdown-menu sub_menu_dropdown_company">
                        <a class="dropdown-item" href="/companies/disengaged">Disengaged</a>
                        <a class="dropdown-item" href="/companies/readymades">Readymades </a>
                        <a class="dropdown-item" href="/companies/group">Group Companies</a>
                        <a class="dropdown-item" href="/companies/awaiting-Tax-ID">Awaiting Tax ID</a>
                        <a class="dropdown-item" href="/companies/recently-issued-Tax-ID">Recently Issued Tax ID</a>
                        <div class=" sub_menu_dropdown_company_plus">
                            <a class="dropdown-item" href="/companies/missing-tax-returns">Missing Tax Returns</a>
                            {{-- @if(Route::currentRouteNamed('edit_company'))
                                <span class="add_tax_return_by_menu">+</span>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </li>
        {{--<li class="nav-item "><a class="nav-link {{ (Route::currentRouteNamed('addresses') || Route::currentRouteNamed('edit_address')) ? 'active' : ''}}"  href="{{ route('addresses') }}"> Business Addresses</a></li>--}}
        {{--<li class="nav-item "><a class="nav-link {{ (Route::currentRouteNamed('address_providers')) ? 'active' : ''}}"  href="{{ route('address_providers') }}">Address Providers</a></li>--}}
        <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('time-reporting') ? 'active' : ''}}"  href="">Time Reporting</a></li>
        <li class="nav-item sub_menu_dropdown_company_head_link">
            {{-- <a class="nav-link"  href="{{ route('invoicings') }}">Invoicing</a> --}}
            <div class="d-flex gap-2 nav-link {{ (Route::currentRouteNamed('invoicings')) ? 'active' : ''}} nav_relative">
                <a class=""  href="{{ route('invoicings') }}">Invoicing</a>
                <div class="dropdown  sub_menu_dropdown_company_head">
                    <span  class="" data-toggle="dropdown">
                        <img src="{{url('image/2740722.png')}}" alt="" style="width: 15px;">
                    </span>
                    <div class="dropdown-menu sub_menu_dropdown_company">
                        <a class="dropdown-item" href="/invoicings/Projected-Revenues">Projected Revenues</a>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('tax_returns') ? 'active' : ''}}"  href="{{ route('tax_returns') }}">Tax Returns</a></li>
        {{--<li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('settings') ? 'active' : ''}}"  href="">Settings</a></li>--}}
    </ul>
</div>
