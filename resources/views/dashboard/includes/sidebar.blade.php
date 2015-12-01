<div id="sidebar">
    <!-- Sidebar Brand -->
    <div id="sidebar-brand" class="themed-background">
        <a href="{{url('/')}}" class="sidebar-title">
            <i class="fa fa-cube"></i>
            <span class="sidebar-nav-mini-hide">Edu. Continuada</span>
        </a>
    </div>
    <!-- END Sidebar Brand -->

    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">                
                @if(Auth::user()->isAdmin())
                <li>
                    <a href="{{url('areas')}}">
                        <i class="fa fa-sitemap sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Areas</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-nav-menu">
                        <i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-user sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Usuarios</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('users')}}">
                                <i class="fa fa-users sidebar-nav-icon"></i>
                                <span class="sidebar-nav-mini-hide">Ver Usuarios</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('roles')}}">
                                <i class="gi gi-old_man sidebar-nav-icon"></i>
                                <span class="sidebar-nav-mini-hide">Perfiles</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="sidebar-nav-menu">
                        <i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-book sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Protocolos</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('protocols')}}">
                                <i class="fa fa-file-text sidebar-nav-icon"></i>
                                <span class="sidebar-nav-mini-hide">Ver Protocolos</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('categories')}}">
                                <i class="fa fa-folder-open sidebar-nav-icon"></i>
                                <span class="sidebar-nav-mini-hide">Categorias</span>
                            </a>
                        </li>
                    </ul>
                </li> 
                <li>
                    <a href="/formats">
                        <i class="fa fa-check-square-o sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Formatos de Chequeo</span>
                    </a>
                </li>               
                @elseif(Auth::user()->isRegistered())
                <li>
                    <a href="/generated-protocols">
                        <i class="gi gi-show_thumbnails_with_lines sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Generador de Protocolos</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('myformats')}}">
                        <i class="fa fa-check-square-o sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Mis Formatos de Chequeo</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/')}}">
                        <i class="fa fa-bar-chart-o sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Mis Notas</span>
                    </a>
                </li>               
                <li>
                    <a href="#" class="sidebar-nav-menu">
                        <i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-book sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Protocolos Pendientes</span>
                    </a>
                    <ul>
                        @foreach(Auth::user()->getExamProtocolsPending() as $p)
                        <li>
                            <a href="{{route('study', $p->id)}}">
                                <i class="fa fa-file-text sidebar-nav-icon"></i>
                                <span class="sidebar-nav-mini-hide">{{$p->name}}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="#" class="sidebar-nav-menu">
                        <i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-book sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Protocolos al día</span>
                    </a>
                    <ul>
                        @foreach(Auth::user()->getExamProtocolsOk() as $p)
                        <li>
                            <a href="{{route('study', $p->id)}}">
                                <i class="fa fa-file-text sidebar-nav-icon"></i>
                                <span class="sidebar-nav-mini-hide">{{$p->name}}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @else                
                <li>
                    <a href="{{url('companies')}}">
                        <i class="fa fa-laptop sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide">Instituciones</span>
                    </a>
                </li>
                @endif
            </ul>
            <!-- END Sidebar Navigation -->
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->

    <!-- Sidebar Extra Info -->
    <div id="sidebar-extra-info" class="sidebar-content sidebar-nav-mini-hide" style="margin-bottom:10px;">
        <div class="text-center col-md-12">
            {!! Html::image(Auth::user()->company->logo, Auth::user()->company->name, array('style' => 'width:80%;')) !!}
        </div>
    </div>
    <!-- END Sidebar Extra Info -->
</div>