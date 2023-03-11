<div class="main-sidemenu">
    <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
            fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
        </svg>
    </div>
    <ul class="side-menu">
        <li class="sub-category">
            <h3>Main</h3>
        </li>
        
        {{-- @role('Super Admin') --}}
        <li class="slide">
            <a class="side-menu__item has-link {{ request()->routeIs('home') ? 'active' : '' }}" data-bs-toggle="slide" href="{{ route('home') }}"><i
                    class="side-menu__icon fe fe-home"></i><span
                    class="side-menu__label">Dashboard</span></a>
        </li>
        {{-- @endrole --}}
        <li class="sub-category">
            <h3>UI Kit</h3>
        </li> 
        @if(auth()->user()->can('user edit') || auth()->user()->can('user view') || auth()->user()->can('user delete') || auth()->user()->can('user group assign') || auth()->user()->can('user group create') || auth()->user()->can('send mail') || auth()->user()->can('user survay question create') || auth()->user()->can('user survay question edit') || auth()->user()->can('user survay question delete'))
        <li class="slide {{ request()->routeIs(['user*','survay.index']) ? 'is-expanded active' : '' }}">
            <a class="side-menu__item {{ request()->routeIs(['user*','survay.index']) ? 'is-expanded active' : '' }}" data-bs-toggle="slide" href="javascript:void(0)"><i
                    class="side-menu__icon fe fe-users"></i><span
                    class="side-menu__label">Users</span><i
                    class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">

                @if(auth()->user()->can('user edit') || auth()->user()->can('user view') || auth()->user()->can('user delete') || auth()->user()->can('user group assign') || auth()->user()->can('user group create'))
                <li><a href="{{ route('user.index') }}" class="slide-item {{ request()->routeIs('user.index') ? 'active' : '' }}"> Users List</a></li>
                @endif

                @if(auth()->user()->can('send mail'))
                <li><a href="{{ route('user.group') }}" class="slide-item {{ request()->routeIs('user.group') ? 'active' : '' }}">Group User</a></li>
                @endif

                @if(auth()->user()->can('user survay question create') || auth()->user()->can('user survay question edit') || auth()->user()->can('user survay question delete'))
                <li><a href="{{ route('survay.index') }}" class="slide-item {{ request()->routeIs('survay.index') ? 'active' : '' }}">User Survay Question</a></li> 
                @endif
            </ul>
        </li>
        @endif

        {{-- @role('Super Admin') --}}
        @if(auth()->user()->can('role permission create') || auth()->user()->can('permission edit') || auth()->user()->can('role delete') || auth()->user()->can('assign role to users') || auth()->user()->can('user delete') || auth()->user()->can('admin create'))
        <li class="slide {{ request()->routeIs(['role*','admin_create*','create_admin']) ? 'is-expanded active' : '' }}">
            <a class="side-menu__item {{ request()->routeIs(['role*','admin_create*','create_admin']) ? 'is-expanded active' : '' }}" data-bs-toggle="slide" href="javascript:void(0)"><i
                    class="side-menu__icon fe fe-user"></i><span
                    class="side-menu__label">Admin/Role Permission</span><i
                    class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">

                @if(auth()->user()->can('role permission create') || auth()->user()->can('permission edit') || auth()->user()->can('role delete'))
                <li><a href="{{ route('role.index') }}" class="slide-item {{ request()->routeIs('role.index') ? 'active' : '' }}"> Role</a></li>
                @endif

                @if(auth()->user()->can('assign role to users') || auth()->user()->can('user delete') || auth()->user()->can('admin create'))
                <li><a href="{{ route('admin_create.index') }}" class="slide-item {{ request()->routeIs('admin_create.index') ? 'active' : '' }}">Admins/Assign Role</a></li>
                @endif
            </ul>
        </li>
        @endif
        {{-- @endrole --}}

        @if(auth()->user()->can('category create') || auth()->user()->can('category edit') || auth()->user()->can('category delete') || auth()->user()->can('news create') || auth()->user()->can('news edit') || auth()->user()->can('news view') || auth()->user()->can('news delete'))
        <li class="slide {{ request()->routeIs(['news*','category*']) ? 'is-expanded active' : '' }}">
            <a class="side-menu__item {{ request()->routeIs(['news*','category*']) ? 'is-expanded active' : '' }}" data-bs-toggle="slide" href="javascript:void(0)"><i
                    class="side-menu__icon fe fe-calendar"></i><span
                    class="side-menu__label">News</span><i
                    class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">
                @if(auth()->user()->can('category create') || auth()->user()->can('category edit') || auth()->user()->can('category delete'))
                <li><a href="{{ route('category.index') }}" class="slide-item {{ request()->routeIs('category*') ? 'active' : '' }}">News Category</a></li>
                @endif

                @if(auth()->user()->can('news create') || auth()->user()->can('news edit') || auth()->user()->can('news view') || auth()->user()->can('news delete'))
                <li><a href="{{ route('news.index') }}" class="slide-item {{ request()->routeIs('news*') ? 'active' : '' }}"> News List</a></li>
                @endif
            </ul>
        </li>
        @endif

        @if(auth()->user()->can('crime create') || auth()->user()->can('crime edit') || auth()->user()->can('crime view') || auth()->user()->can('crime delete') || auth()->user()->can('crime question create') || auth()->user()->can('crime question edit') || auth()->user()->can('crime question delete'))
        <li class="slide {{ request()->routeIs(['crime*','crime_question*']) ? 'is-expanded' : '' }}">
            <a class="side-menu__item {{ request()->routeIs(['crime*','crime_question*']) ? 'is-expanded active' : '' }}" data-bs-toggle="slide" href="javascript:void(0)"><i
                    class="side-menu__icon fe fe-gitlab"></i><span
                    class="side-menu__label">Crimes</span><i
                    class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">

                @if(auth()->user()->can('crime create') || auth()->user()->can('crime edit') || auth()->user()->can('crime view') || auth()->user()->can('crime delete'))
                <li><a href="{{ route('crime.index') }}" class="slide-item {{ request()->routeIs(['crime.index','crime.create','crime.edit','crime.show']) ? 'active' : '' }}">Crimes Lists</a></li>
                @endif

                @if(auth()->user()->can('crime question create') || auth()->user()->can('crime question edit') || auth()->user()->can('crime question delete'))
                <li><a href="{{ route('crime_question.index') }}" class="slide-item {{ request()->routeIs('crime_question*') ? 'active' : '' }}">Crime Questions</a></li> 
                @endif
            </ul>
        </li>
        @endif

        @if(auth()->user()->can('live category create') || auth()->user()->can('live category edit') || auth()->user()->can('live category delete') || auth()->user()->can('live topic create') || auth()->user()->can('live topic edit') || auth()->user()->can('live topic delete') || auth()->user()->can('live question create') || auth()->user()->can('live question edit') || auth()->user()->can('live question delete') || auth()->user()->can('normal topic create') || auth()->user()->can('normal topic edit') || auth()->user()->can('normal topic delete'))
        <li class="slide {{ request()->routeIs(['polling_category*','polling_question*','question_option*','polling_normal*','polling_sub_cat*','normal_voting*']) ? 'is-expanded' : '' }}">
            <a class="side-menu__item {{ request()->routeIs(['polling_category*','polling_question*','question_option*','polling_normal*','polling_sub_cat*','normal_voting*']) ? 'active' : '' }}" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-box"></i><span class="side-menu__label">Polling</span><i class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu {{ request()->routeIs(['polling_category*','polling_question*','question_option*','polling_normal*','polling_sub_cat*','normal_voting*']) ? 'open' : '' }}">
                
                @if(auth()->user()->can('live category create') || auth()->user()->can('live category edit') || auth()->user()->can('live category delete') || auth()->user()->can('live topic create') || auth()->user()->can('live topic edit') || auth()->user()->can('live topic delete') || auth()->user()->can('live question create'))
                <li class=""><a href="{{ route('polling_category.index') }}" class="sub-slide-item {{ request()->routeIs('polling_category*') ? 'active' : '' }}">Topics (Live)</a></li>
                @endif

                @if(auth()->user()->can('live question create') || auth()->user()->can('live question edit') || auth()->user()->can('live question delete'))
                <li class=""><a href="{{ route('polling_question.index') }}" class="sub-slide-item {{ request()->routeIs(['polling_question*','polling_sub_cat*']) ? 'active' : '' }}">Questions(live)</a></li>
                @endif

                @if(auth()->user()->can('normal topic create') || auth()->user()->can('normal topic edit') || auth()->user()->can('normal topic delete'))
                <li class=""><a href="{{ route('normal_voting.index') }}" class="sub-slide-item {{ request()->routeIs('normal_voting*') ? 'active' : '' }}">Topics (Normal)</a></li>
                @endif
            </ul>
        </li>
        @endif
        
        @if(auth()->user()->can('page create') || auth()->user()->can('page edit') || auth()->user()->can('page view') || auth()->user()->can('page delete'))
        <li class="slide {{ request()->routeIs('page*') ? 'is-expanded active' : '' }}">
            <a class="side-menu__item {{ request()->routeIs('page*') ? 'is-expanded active' : '' }}" data-bs-toggle="slide" href="javascript:void(0)"><i
                    class="side-menu__icon fe fe-file"></i><span
                    class="side-menu__label">Pages</span><i
                    class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">
                <li class=""><a href="{{ route('page.index') }}" class="slide-item {{ request()->routeIs('page*') ? 'active' : '' }}">Page Lists</a></li>
            </ul>
        </li>
        @endif

        @if(auth()->user()->can('template'))
        <li class="slide">
            <a class="side-menu__item has-link {{ request()->routeIs('template') ? 'active' : '' }}" data-bs-toggle="slide" href="{{ route('template') }}"><i
                    class="side-menu__icon fa fa-foursquare"></i><span
                    class="side-menu__label">Template</span></a>
        </li>
        @endif

        @if (auth()->user()->can('general settings edit') || auth()->user()->can('social link settings edit'))
        <li class="slide {{ request()->routeIs(['settings.index','social_links.index']) ? 'is-expanded' : '' }}">
            <a class="side-menu__item {{ request()->routeIs(['settings.index','social_links.index']) ? 'is-expanded active' : '' }}" data-bs-toggle="slide" href="javascript:void(0)"><i
                    class="side-menu__icon fe fe-settings"></i><span
                    class="side-menu__label">Settings</span><i
                    class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu {{ request()->routeIs(['settings.index','social_links.index']) ? 'open' : '' }}">
                @can('general settings edit')
                <li class=""><a href="{{ route('settings.index') }}" class="slide-item {{ request()->routeIs('settings.index') ? 'active' : '' }}">General Settings</a></li>
                @endcan
                @can('social link settings edit')
                <li class=""><a href="{{ route('social_links.index') }}" class="slide-item {{ request()->routeIs('social_links.index') ? 'active' : '' }}">SocialLink Settings</a></li>                  
                @endcan
            </ul>
        </li>            
        @endif
    </ul>
    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
            width="24" height="24" viewBox="0 0 24 24">
            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
        </svg></div>
</div>
