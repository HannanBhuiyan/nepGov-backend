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
        <li class="slide">
            <a class="side-menu__item has-link {{ request()->routeIs('home') ? 'active' : '' }}" data-bs-toggle="slide" href="{{ route('home') }}"><i
                    class="side-menu__icon fe fe-home"></i><span
                    class="side-menu__label">Dashboard</span></a>
        </li>
        <li class="sub-category">
            <h3>UI Kit</h3>
        </li> 
        <li class="slide {{ request()->routeIs(['user*','survay.index']) ? 'is-expanded active' : '' }}">
            <a class="side-menu__item {{ request()->routeIs(['user*','survay.index']) ? 'is-expanded active' : '' }}" data-bs-toggle="slide" href="javascript:void(0)"><i
                    class="side-menu__icon fe fe-users"></i><span
                    class="side-menu__label">Users</span><i
                    class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">
                <li><a href="{{ route('user.index') }}" class="slide-item {{ request()->routeIs('user.index') ? 'active' : '' }}"> Users List</a></li>
                <li><a href="{{ route('user.group') }}" class="slide-item {{ request()->routeIs('user.group') ? 'active' : '' }}">Group User</a></li>
                <li><a href="{{ route('survay.index') }}" class="slide-item {{ request()->routeIs('survay.index') ? 'active' : '' }}">User Survay Question</a></li> 
            </ul>
        </li>

        <li class="slide {{ request()->routeIs(['news*','category*']) ? 'is-expanded active' : '' }}">
            <a class="side-menu__item {{ request()->routeIs(['news*','category*']) ? 'is-expanded active' : '' }}" data-bs-toggle="slide" href="javascript:void(0)"><i
                    class="side-menu__icon fe fe-calendar"></i><span
                    class="side-menu__label">News</span><i
                    class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">
                <li><a href="{{ route('news.index') }}" class="slide-item {{ request()->routeIs('news*') ? 'active' : '' }}"> News List</a></li>
                <li><a href="{{ route('category.index') }}" class="slide-item {{ request()->routeIs('category*') ? 'active' : '' }}">News Category</a></li>
                {{-- <li><a href="{{ route('news.create') }}" class="slide-item {{ request()->routeIs('news.create') ? 'active' : '' }}">Create News</a></li> --}}
            </ul>
        </li>

        <li class="slide {{ request()->routeIs(['crime*','crime_question*']) ? 'is-expanded' : '' }}">
            <a class="side-menu__item {{ request()->routeIs(['crime*','crime_question*']) ? 'is-expanded active' : '' }}" data-bs-toggle="slide" href="javascript:void(0)"><i
                    class="side-menu__icon fe fe-gitlab"></i><span
                    class="side-menu__label">Crimes</span><i
                    class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">
                <li><a href="{{ route('crime.index') }}" class="slide-item {{ request()->routeIs(['crime.index','crime.create','crime.edit','crime.show']) ? 'active' : '' }}">Crimes Lists</a></li>
                <li><a href="{{ route('crime_question.index') }}" class="slide-item {{ request()->routeIs('crime_question*') ? 'active' : '' }}">Crime Questions</a></li> 
            </ul>
        </li>

        <li class="slide {{ request()->routeIs(['polling_category*','polling_question*','question_option*','polling_normal*','polling_sub_cat*','normal_voting*']) ? 'is-expanded' : '' }}">
            <a class="side-menu__item {{ request()->routeIs(['polling_category*','polling_question*','question_option*','polling_normal*','polling_sub_cat*','normal_voting*']) ? 'active' : '' }}" data-bs-toggle="slide" href="javascript:void(0)"><i
                    class="side-menu__icon fe fe-box"></i><span
                    class="side-menu__label">Polling</span><i
                    class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu {{ request()->routeIs(['polling_category*','polling_question*','question_option*','polling_normal*','polling_sub_cat*','normal_voting*']) ? 'open' : '' }}">
                {{-- <li class=" {{ request()->routeIs('polling_category*') ? 'sub-slide is-expanded' : '' }}">
                    <a class=" {{ request()->routeIs('polling_category*') ? 'sub-side-menu__item is-expanded active' : '' }}" data-bs-toggle="sub-slide" href="javascript:void(0)"><i
                            class="side-menu__icon fe fe-slack"></i><span
                            class="side-menu__label">Polling Category</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="sub-slide-menu"> --}}
                        <li class=""><a href="{{ route('normal_voting.index') }}" class="sub-slide-item {{ request()->routeIs('normal_voting*') ? 'active' : '' }}">Topics (Normal)</a></li>
                        {{-- <li class=""><a href="{{ route('polling_normal.index') }}" class="sub-slide-item {{ request()->routeIs('polling_normal*') ? 'active' : '' }}">Topics (Normal)</a></li> --}}
                        <li class=""><a href="{{ route('polling_category.index') }}" class="sub-slide-item {{ request()->routeIs('polling_category*') ? 'active' : '' }}">Topics (Live)</a></li>
                        {{-- <li class=""><a href="{{ route('polling_category.create') }}" class="sub-slide-item {{ request()->routeIs('polling_category.create') ? 'active' : '' }}">Create Category</a></li> --}}
                    {{-- </ul>
                </li> --}}
        
                {{-- <li class=" {{ request()->routeIs('polling_question*') ? 'sub-slide is-expanded' : '' }}">
                    <a class=" {{ request()->routeIs('polling_question*') ? 'sub-side-menu__item is-expanded active' : '' }}" data-bs-toggle="sub-slide" href="javascript:void(0)"><i
                            class="side-menu__icon fe fe-slack"></i><span
                            class="side-menu__label">Polling Question</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="sub-slide-menu"> --}}
                        <li class=""><a href="{{ route('polling_question.index') }}" class="sub-slide-item {{ request()->routeIs(['polling_question*','polling_sub_cat*']) ? 'active' : '' }}">Questions(live)</a></li>
                        {{-- <li class=""><a href="{{ route('polling_question.create') }}" class="sub-slide-item {{ request()->routeIs('polling_question.create') ? 'active' : '' }}">Create Question</a></li> --}}
                    {{-- </ul>
                </li> --}}
        
                {{-- <li class="{{ request()->routeIs('question_option*') ? 'sub-slide is-expanded' : '' }}">
                    <a class=" {{ request()->routeIs('question_option*') ? 'sub-side-menu__item is-expanded active' : '' }}" data-bs-toggle="sub-slide" href="javascript:void(0)"><i
                            class="side-menu__icon fe fe-slack"></i><span
                            class="side-menu__label">Question Option</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="sub-slide-menu"> --}}
                        {{-- <li class=""><a href="{{ route('question_option.index') }}" class="sub-slide-item {{ request()->routeIs('question_option*') ? 'active' : '' }}">Options</a></li> --}}
                        {{-- <li class=""><a href="{{ route('question_option.create') }}" class="sub-slide-item {{ request()->routeIs('question_option.create') ? 'active' : '' }}">Create Option</a></li> --}}
                    {{-- </ul>
                </li> --}}

            </ul>
        </li>
        

        <li class="slide {{ request()->routeIs('page*') ? 'is-expanded active' : '' }}">
            <a class="side-menu__item {{ request()->routeIs('page*') ? 'is-expanded active' : '' }}" data-bs-toggle="slide" href="javascript:void(0)"><i
                    class="side-menu__icon fe fe-file"></i><span
                    class="side-menu__label">Pages</span><i
                    class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">
                <li class=""><a href="{{ route('page.index') }}" class="slide-item {{ request()->routeIs('page*') ? 'active' : '' }}">Page Lists</a></li>
                {{-- <li><a href="{{ route('page.create') }}" class="slide-item {{ request()->routeIs('page.create') ? 'active' : '' }}">Create Page</a></li> --}}
            </ul>
        </li>

        <li class="slide {{ request()->routeIs(['settings.index','social_links.index']) ? 'is-expanded' : '' }}">
            <a class="side-menu__item {{ request()->routeIs(['settings.index','social_links.index']) ? 'is-expanded active' : '' }}" data-bs-toggle="slide" href="javascript:void(0)"><i
                    class="side-menu__icon fe fe-settings"></i><span
                    class="side-menu__label">Settings</span><i
                    class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu {{ request()->routeIs(['settings.index','social_links.index']) ? 'open' : '' }}">
                <li class=""><a href="{{ route('settings.index') }}" class="slide-item {{ request()->routeIs('settings.index') ? 'active' : '' }}">General Settings</a></li>
                {{-- <li><a href="{{ route('settings.create') }}" class="slide-item {{ request()->routeIs('settings.create') ? 'active' : '' }}">Create Setting</a></li> --}}
                <li class=""><a href="{{ route('social_links.index') }}" class="slide-item {{ request()->routeIs('social_links.index') ? 'active' : '' }}">SocialLink Settings</a></li>
            </ul>
        </li>

        {{-- <li class="slide {{ request()->routeIs(['settings.index','social_links.index']) ? 'is-expanded' : '' }}">
            <a class="side-menu__item {{ request()->routeIs(['settings.index','social_links.index']) ? 'is-expanded active' : '' }}" data-bs-toggle="slide" href="javascript:void(0)"><i
                    class="side-menu__icon fe fe-settings"></i><span
                    class="side-menu__label">Survay</span><i
                    class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu {{ request()->routeIs(['survay.index','social_links.index']) ? 'open' : '' }}">
                <li class=""><a href="{{ route('survay.index') }}" class="slide-item {{ request()->routeIs('survay.index') ? 'active' : '' }}">User Survay Question</a></li> 
            </ul>
        </li> --}}
        

    </ul>
    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
            width="24" height="24" viewBox="0 0 24 24">
            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
        </svg></div>
</div>
