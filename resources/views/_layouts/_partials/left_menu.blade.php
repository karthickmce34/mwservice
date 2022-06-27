        <?php $user_type = session()->get('user_type');
        ?>
        <ul class="main-menu">
            @if($user_type == 0 || $user_type == 2)
            <li class="@yield('page_home_li_cls')">
                <a href="{{ route('home.index') }}"><i class="zmdi zmdi-home"></i> Home</a>
            </li>
            <li class="sub-menu @yield('page_master_li_cls')">
                <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-collection-item"></i> Master</a>
                <ul>
                    <li >
                        <a class="@yield('page_serviceengineer_li_cls')" href="{{ route('serviceengineer.index') }}"><i class="zmdi zmdi-accounts"></i>&nbsp;&nbsp; Service Engineer </a>
                    </li>
                    <li >
                        <a class="@yield('page_serviceagent_li_cls')" href="{{ route('serviceagent.index') }}"><i class="zmdi zmdi-account-box"></i>&nbsp;&nbsp; Service Agent </a>
                    </li>
                    <li >
                        <a class="@yield('page_product_li_cls')" href="{{ route('product.index') }}"><i class="zmdi zmdi-shopping-cart"></i>&nbsp;&nbsp; Product </a>
                    </li>
					<li >
                        <a class="@yield('page_servicecharge_li_cls')" href="{{ route('servicecharge.index') }}"><i class="zmdi zmdi-toys"></i>&nbsp;&nbsp; Service Charges </a>
                    </li>
                </ul>
            </li>
            <li class="sub-menu @yield('page_spares_li_cls')">
                <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-collection-item"></i> Service</a>
                <ul>
                    <li >
                        <a class="@yield('page_ticket_li_cls')" href="{{ route('ticket.index') }}"><i class="zmdi zmdi-email"></i>&nbsp;&nbsp; Ticket</a>
                    </li>
                    <li >
                        <a class="@yield('page_complaintregister_li_cls')" href="{{ route('complaintregister.index') }}"><i class="zmdi zmdi-assignment-o"></i>&nbsp;&nbsp; Call Log </a>
                    </li>
                    <li >
                        <a class="@yield('page_servicespareregister_li_cls')" href="{{ route('servicespareregister.index') }}"><i class="zmdi zmdi-assignment"></i>&nbsp;&nbsp; Service  Register </a>
                    </li>
                    <!--li >
                        <a class="@yield('page_visitplan_li_cls')" href="{{ route('visitplan.index') }}"><i class="zmdi zmdi-case"></i>&nbsp;&nbsp; Visits Plan </a>
                    </li-->
                    <li >
                        <a class="@yield('page_pendingvisit_li_cls')" href="{{ route('pendingvisit.index') }}"><i class="zmdi zmdi-case"></i>&nbsp;&nbsp; Pending Visits </a>
                    </li>
                    <li >
                        <a class="@yield('page_visitplansummary_li_cls')" href="{{ route('visitplansummary.index') }}"><i class="zmdi zmdi-case"></i>&nbsp;&nbsp; Visits Summary</a>
                    </li>
                    <li >
                        <a class="@yield('page_email_li_cls')" href="{{ route('email.index') }}"><i class="zmdi zmdi-email"></i>&nbsp;&nbsp; Email</a>
                    </li>
                </ul>
            </li>
            <li class="sub-menu @yield('page_report_li_cls')">
                <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-collection-item"></i> Report</a>
                <ul>
                    <li >
                        <a class="@yield('page_servicereport_li_cls')" href="{{ route('servicereport.index') }}"><i class="zmdi zmdi-assignment-o"></i>&nbsp;&nbsp; Service Report </a>
                    </li>
                    <li >
                        <a class="@yield('page_statusreport_li_cls')" href="{{ route('statusreport.index') }}"><i class="zmdi zmdi-assignment-o"></i>&nbsp;&nbsp; Status Report </a>
                    </li>
                    
                </ul>
            </li>
            @else 
                @if($user_type == 1)
                    <li class="@yield('page_home_li_cls')">
                        <a href="{{ route('home.index') }}"><i class="zmdi zmdi-home"></i> Home</a>
                    </li>
                    <li class="sub-menu @yield('page_master_li_cls')">
                        <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-collection-item"></i> Master</a>
                        <ul>
                            <li >
                                <a class="@yield('page_product_li_cls')" href="{{ route('product.index') }}"><i class="zmdi zmdi-shopping-cart"></i>&nbsp;&nbsp; Product </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub-menu @yield('page_spares_li_cls')">
                        <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-collection-item"></i> Spares </a>
                        <ul>
                            <li >
                                <a class="@yield('page_servicespareregister_li_cls')" href="{{ route('servicespareregister.index') }}"><i class="zmdi zmdi-assignment"></i>&nbsp;&nbsp; Spares  Register </a>
                            </li>
                             <li >
                                <a class="@yield('page_email_li_cls')" href="{{ route('email.index') }}"><i class="zmdi zmdi-email"></i>&nbsp;&nbsp; Email</a>
                            </li>
                        </ul>
                    </li>
                @else
                    @if($user_type == 4)
                        <li class="@yield('page_home_li_cls')">
                            <a href="{{ route('home.index') }}"><i class="zmdi zmdi-home"></i> Home</a>
                        </li>
                        <li class="sub-menu @yield('page_spares_li_cls')">
                            <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-collection-item"></i> Ticket</a>
                            <ul>
                                <li >
                                    <a class="@yield('page_ticket_li_cls')" href="{{ route('ticket.index') }}"><i class="zmdi zmdi-email"></i>&nbsp;&nbsp; Ticket</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="@yield('page_home_li_cls')">
                            <a href="{{ route('home.index') }}"><i class="zmdi zmdi-home"></i> Home</a>
                        </li>
                        <li class="sub-menu @yield('page_spares_li_cls')">
                            <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-collection-item"></i> Service</a>
                            <ul>

                                <li >
                                    <a class="@yield('page_pendingvisit_li_cls')" href="{{ route('pendingvisit.index') }}"><i class="zmdi zmdi-case"></i>&nbsp;&nbsp; Pending Visits </a>
                                </li>
                                <li >
                                    <a class="@yield('page_visitplansummary_li_cls')" href="{{ route('visitplansummary.index') }}"><i class="zmdi zmdi-case"></i>&nbsp;&nbsp; Visits Summary</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endif
            @endif
        </ul>

