<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('admin_layouts.head')
    <title>Sign In</title>
</head>
<body class="admin_auth">
    <main class='main-content bgc-grey-100'>
        <div id='mainContent'>
            <div class="container-fluid">
                <div class="row">
                    @yield('body')
                </div>
            </div>
        </div>
    </main>
@include('admin_layouts.footer')
</body>
</html>
