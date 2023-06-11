<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            @if (Auth::guard('admin')->check()) {
                @include('layout.sidebar.admin_sidebar')
            }
            @elseif (Auth::guard('client')->check()) {
                @include('layout.sidebar.client_sidebar')
            }
            @elseif (Auth::guard('coach')->check()) {
                @include('layout.sidebar.coach_sidebar')
            }

            @endif        
         </div>
        </div>
    </div>