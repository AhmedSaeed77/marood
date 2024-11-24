
            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>


                        	 <li class="text-muted menu-title">@lang('dashboard.dashboard')</li>
                            <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-world"></i> <span> @lang('dashboard.website_information') </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{route('setting.index')}}">@lang('dashboard.information')</a></li>
                                    <li><a href="{{url('/')}}/admin/setting/wm">@lang('dashboard.water_mark')</a></li>
                                    <li><a href="{{route('filter')}}">@lang('dashboard.control_sections')</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-user"></i> <span> @lang('dashboard.all_members') </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{url('/')}}/admin/users/index"> @lang('dashboard.users')</a></li>
                                    <li><a href="{{url('/')}}/admin/members/index">@lang('dashboard.members')</a></li>

                                    <li><a href="{{url('/')}}/admin/store/index">@lang('dashboard.stores')</a></li>
                                    <li><a href="{{url('/')}}/admin/users/create">@lang('dashboard.add_new_member')</a></li>
                                    <li><a href="{{url('/')}}/admin/create/member">@lang('site.member_create')</a></li>

                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class=" ti-layers-alt"></i> <span> @lang('dashboard.categories') </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{url('/')}}/admin/cats/index">@lang('dashboard.all_categories')</a></li>
                                    <li><a href="{{url('/')}}/admin/cats/create">@lang('dashboard.add_new_category')</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-image"></i> <span> @lang('dashboard.posts') </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{route('posts.index')}}"> @lang('dashboard.all_posts') </a></li>
                                    <li><a href="{{route('posts.create')}}">@lang('dashboard.add_new_post')</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-comments"></i> <span> @lang('dashboard.members_messages') </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{route('whyContact.index')}}">@lang('dashboard.reasons_calls')</a></li>
                                    <li><a href="{{route('contact.index')}}">@lang('dashboard.messages')</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class=" ti-stats-down"></i> <span> @lang('dashboard.infringements')</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{route('whyInfraction.index')}}">@lang('dashboard.reason_infringement')</a></li>
                                    <li><a href="{{route('infraction.index')}}">@lang('dashboard.infringements_messages')</a></li>
                                </ul>
                            </li>
                             <!--<li class="has_sub"> <a href="{{route('slidear.index')}}"><i class="ti-image"></i><span>البنرات</span> </a></li>-->
                            <li class="has_sub"> <a href="{{route('area.index')}}"><i class="ti-map"></i><span>@lang('dashboard.cities')</span> </a></li>
                            <li class="has_sub"> <a href="{{route('pages.index')}}"><i class="ti-home"></i><span>@lang('dashboard.website_pages')</span> </a></li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class=" ti-stats-down"></i> <span>@lang('dashboard.banks')</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                <li> <a href="{{route('setting.banks')}}">@lang('dashboard.banks')</a></li>
                                <li> <a href="{{route('setting.reciptBank')}}">@lang('dashboard.banks_transactions')</a></li>
                                <li><a href="{{route('setting.time.transfer')}}">@lang('dashboard.transfer_times')</a></li>
                                </ul>
                            </li>
                            <li class="has_sub"> <a href="{{route('memberShip.index')}}"><i class="ti-shield"></i><span>@lang('dashboard.memberships')</span> </a></li>
                            <li class="has_sub"> <a href="{{route('commission.index')}}"><i class="ti-receipt"></i><span>@lang('dashboard.website_commission')</span> </a></li>
                            <!-- <li class="has_sub"> <a href="{{route('roles.index')}}"><i class="ti-map"></i><span>الصلاحيات</span> </a></li> -->
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End -->

