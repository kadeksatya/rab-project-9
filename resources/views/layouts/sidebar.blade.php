            <!-- Side Nav START -->
            <div class="side-nav">
                <div class="side-nav-inner">
                    <ul class="side-nav-menu scrollable">
                        <li class="nav-item dropdown open">
                            <a class="dropdown-toggle" href="{{route('dashboard.index')}}">
                                <span class="icon-holder">
                                    <i class="anticon anticon-dashboard"></i>
                                </span>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-appstore"></i>
                                </span>
                                <span class="title">Master Data</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/admin/masterdata/material">Material</a>
                                </li>
                                <li>
                                    <a href="/admin/masterdata/tool">Tool</a>
                                </li>
                                <li>
                                    <a href="/admin/masterdata/worker">Worker</a>
                                </li>
                                <li>
                                    <a href="/admin/masterdata/worktype">Work Type</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-pie-chart"></i>
                                </span>
                                <span class="title">RAB</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/admin/rab/work">Work</a>
                                </li>
                                <li>
                                    <a href="/admin/rab/rabs">RAB</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Side Nav END -->