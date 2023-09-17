@include('user.layout.header')
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm d-flex flex-column pb-0">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"> Ava</a>
                <div class="dropdown" style="z-index: 999">
                    <div  class=" dropdown-toggle dropdown-menu-left" data-toggle="dropdown" style="cursor: pointer">
                        <img src="{{ Auth::user()->avatarUrl }}" style="height: 25px; width: 25px; object-fit:cover;" class="rounded-circle" id="header__user_avatar">
                        <span class="text-center">{{ Auth::user()->first_name }}</span>
                    </div>
                    <div class="dropdown-menu dropdown-menu-start dropdown-menu-left drop_logout">
                        <a class="dropdown-item" href="{{ route('profile') }}">  <input class="btn " type="button" value="Profile"></a>
                        <a class="dropdown-item" href="#">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                                @csrf
                                <input class="btn " type="submit" value="Logout">
                            </form>
                        </a>
                        @if(Auth::user()->role_id == 1)
                            <div class="dropdown-submenu dropdown-item"  style="cursor: pointer">
                                <a class="nav-link {{ Route::currentRouteNamed('settings') ? 'active' : ''}}" >Settings</a>
                                <div class="dropdown-menu  drop_settings">
                                    <a class="dropdown-item {{ (Route::currentRouteNamed('address_providers')) ? 'active_item' : ''}}"  href="{{ route('address_providers') }}"><span>Address Providers</span></a>
                                    <a class="dropdown-item {{ (Route::currentRouteNamed('addresses') || Route::currentRouteNamed('edit_address')) ? 'active_item' : ''}}"  href="{{ route('addresses') }}"><span>Business Addresses</span> </a>
                                    <a class="dropdown-item {{ (Route::currentRouteNamed('services')) ? 'active_item' : ''}}"  href="{{ route('services') }}"><span>Services</span></a>
                                    <a class="dropdown-item {{ Route::currentRouteNamed('show_IRS_Standard_Correspondence_Address') ? 'active_item' : ''}} "  href="{{ route('show_IRS_Standard_Correspondence_Address') }}"><span>IRS Standard Correspondence Address</span> </a>
                                    <a class="dropdown-item {{ (Route::currentRouteNamed('email_notifications')) ? 'active_item' : ''}}"  href="{{ route('email_notifications') }}"><span>Email Notifications</span></a>
                                    <a class="dropdown-item {{ (Route::currentRouteNamed('task_template')) ? 'active_item' : ''}}"  href="{{ route('task_template') }}"><span>Task Templates</span></a>
                                    <a class="dropdown-item {{ (Route::currentRouteNamed('task_set')) ? 'active_item' : ''}}"  href="{{ route('task_set') }}"><span>Task Set</span></a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="container mt-3">
                @include('user.menu.menu')
            </div>
        </nav>
        <main class="py-4">
            <div class="container-fluid">
                <div class="container mt-5">
                    @include('messages')
                </div>
                @yield('contents')
            </div>
        </main>
   
@include('user.layout.footer')

<script>
    $(document).ready(function() {
        $('.select2').parent().find('.select2-container').addClass('select_span_style')
    });

</script>