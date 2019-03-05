<div>
    <!-- #Left Sidebar ==================== -->
    @include('admin_layouts.sidebar')
    <!-- #Main ============================ -->
    <div class="page-container " >
        <!-- ### $Topbar ### -->
        <div class="header navbar">
            @include('admin_layouts.navbar')
        </div>
            <main class='main-content'>
                <div id='mainContent'>
                    <div class="container-fluid">
                        <div class="row">
                            @yield('body')
                        </div>
                    </div>
                </div>
            </main>

        @include('admin_layouts.footer')
    </div>
</div>

