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
                        @if (Auth::user()->role_id == 1)
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-appstore"></i>
                                </span>
                                <span class="title">Master Data</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/admin/masterdata/material">Bahan</a>
                                </li>
                                <li>
                                    <a href="/admin/masterdata/tool">Alat</a>
                                </li>
                                <li>
                                    <a href="/admin/masterdata/worker">Pekerja</a>
                                </li>
                                <li>
                                    <a href="/admin/masterdata/worktype">Jenis Pekerjaan</a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-pie-chart"></i>
                                </span>
                                <span class="title">RAB</span>
                            </a>
                            <ul class="dropdown-menu">
                                @if (Auth::user()->role_id == 1)
                                <li>
                                    <a href="/admin/rab/work">Harga Satuan Pekerjaan</a>
                                </li>
                                @endif

                                <li>
                                    <a href="/admin/rab/rabs">RAB</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown open">
                            <a class="dropdown-toggle" href="/admin/overbudget">
                                <span class="icon-holder">
                                    <i class="anticon anticon-area-chart"></i>
                                </span>
                                <span class="title">Over Budget</span>
                            </a>
                        </li>
                        @if (Auth::user()->role_id == 1)

                        <li class="nav-item dropdown open">
                            <a class="dropdown-toggle" href="/admin/administrator">
                                <span class="icon-holder">
                                    <i class="anticon anticon-team"></i>
                                </span>
                                <span class="title">Users Management</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- Side Nav END -->