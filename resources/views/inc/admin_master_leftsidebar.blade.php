<style>
    .mailbox{
        margin-left: 20px;
        color: red;
        background: #fff;
        width: 35px;
        text-align: center;
    }
    .mailrequest{
        margin-left: 20px;
        color: red;
    }
    .red{color: red;}
</style>

<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">

                <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('home') }}" aria-expanded="false">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                            <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('worktype.view') }}" aria-expanded="false">
                        <i class="nav-icon fas fa-edit"></i>
                            <span class="hide-menu">Work Type</span>
                    </a>
                </li>


                {{-- <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="nav-icon fas fa-edit"></i>
                        <span class="hide-menu">Work Type </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        
                        <li class="sidebar-item">
                            <a href="{{ route('worktype.view') }}" class="sidebar-link">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu"> View
                                </span>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="nav-icon fas fa-edit"></i>
                        <span class="hide-menu">Work and Charge </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('work.add_form') }}" class="sidebar-link">
                                <i class="mdi mdi-note-outline"></i>
                                <span class="hide-menu"> Add New Work</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('work.view') }}" class="sidebar-link">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu"> View Work Info
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

                

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>