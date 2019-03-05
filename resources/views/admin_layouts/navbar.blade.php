<div class="header-container bg-primary">
        <ul class="nav-left">
            <li>
                <a id='sidebar-toggle' class="sidebar-toggle" href="javascript:void(0);">
                    <i class="ti-menu c-white"></i>
                </a>
            </li>
        </ul>
        <ul class="nav-right">
            <li class="dropdown">
                <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
                    <div class="peer mR-10">
                        <img class="w-2r bdrs-50p" src="https://randomuser.me/api/portraits/men/10.jpg" alt="">
                    </div>
                    <div class="peer">
                        <span class="fsz-sm c-white">{{auth()->guard('admin')->user()->name}}</span>
                    </div>
                </a>
                <ul class="dropdown-menu fsz-sm">
                    <li>
                        <a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                            <i class="ti-user mR-10"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <form action="{{route('admin_logout')}}" method="post" >
                            @csrf
                            <i class="ti-power-off ml-3 bgcH-grey-100 c-grey-700"></i>
                           <button type="submit" class="btn btn-light bgcH-grey-100 c-grey-700">Logout</button>
                        </form>

                    </li>
                </ul>
            </li>
        </ul>
    </div>

