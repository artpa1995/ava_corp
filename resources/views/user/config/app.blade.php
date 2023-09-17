@include('user.config.header')
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm d-flex flex-column pb-0">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   Ava
                </a>

                <div class="nav-profile">
                    <h4>{{ Auth::user()->name }}</h4>
                    <div class="logout-container">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                            @csrf
                            <input class="btn btn-danger" type="submit" value="loguot">
                        </form>
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
   
@include('user.config.footer')

<style>
    .nav-profile{
        position: relative;
    }
    .logout-container{
        width: 100%;
        position: absolute;
        display: none;
    }
    .logout-container.active{
        display: flex;
        justify-content: flex-end;
    }
</style>
<script>
    $('.nav-profile').on('click', function(){
        $('.logout-container').toggleClass('active');
    })
</script>