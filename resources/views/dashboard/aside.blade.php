        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img"> 
                        @if( ! empty($data['user']->user_image) )
                        <img src="{{ asset( 'storage/' . $data['user']->user_image) }}" alt="user" /> 
                        @else
                        <img src="/assets/images/users/profile.png" alt="user" /> 
                        @endif
                    </div>
                    <!-- User profile text-->
                    <div class="profile-text"> 
                        <a href="#" class="dropdown-toggle link u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                            {{ $data['user']->user_firstname }} {{ $data['user']->user_lastname}} 
                        <span class="caret"></span></a>
                        <div class="dropdown-menu animated flipInY">
                            <a href="/dashboard/profile" class="dropdown-item"><i class="fa fa-user"></i> Mis Datos</a>
                            <a href="/dashboard/profile/edit" class="dropdown-item"><i class="fa fa-edit"></i> Editar Mis Datos</a>
                            <a href="/dashboard/profile/upload" class="dropdown-item"><i class="fa fa-upload"></i> Subir Foto</a>
                            <a href="/dashboard/profile/password" class="dropdown-item"><i class="fa fa-key"></i> Cambiar Clave</a>
                            <div class="dropdown-divider"></div> 
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off"></i> Salir
                                </a>
                        </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        
                        @if($data['user']->user_rol_name == 'users')
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">Nidoo Business Solution</li>
                        <li @if($data['item'] == 'user_vehicles') class="active" @endif >
                            <a @if($data['item'] == 'user_vehicles') class="active" @endif href="/user_vehicles/index"><i class="fa fa-car"></i> <span class="hide-menu">Mis Vehiculos</span></a>
                        </li>
                        <li @if($data['item'] == 'user_booking') class="active" @endif >
                            <a @if($data['item'] == 'user_booking') class="active" @endif href="/user_booking/index"><i class="fa fa-calendar"></i> <span class="hide-menu">Mis Reservaciones</span></a>
                        </li>
                        @endif
                        
                        @if($data['user']->user_rol_name == 'admins')
                        <li class="nav-small-cap">Administración</li>
                        <li @if($data['item'] == 'booking') class="active" @endif >
                            <a class="has-arrow" href="#" @if($data['item'] == 'booking') aria-expanded="true" @else aria-expanded="false" @endif><i class="fa fa-calendar"></i><span class="hide-menu">Reservas </span></a>
                            <ul class="collapse @if($data['item'] == 'booking') in @endif " @if($data['item'] == 'booking') aria-expanded="true" @else aria-expanded="false" @endif >
                                <li @if($data['subitem'] == 'booking/index') class="active" @endif ><a href="/booking/index"><i class="fa fa-caret-right fa-fw"></i> Reservas</a></li>
                            </ul>
                        </li>
                        <li @if($data['item'] == 'users') class="active" @endif >
                            <a class="has-arrow" href="#" @if($data['item'] == 'users') aria-expanded="true" @else aria-expanded="false" @endif><i class="fa fa-users"></i><span class="hide-menu">Usuarios </span></a>
                            <ul class="collapse @if($data['item'] == 'users') in @endif" @if($data['item'] == 'users') aria-expanded="true" @else aria-expanded="false" @endif>
                                <li @if($data['subitem'] == 'users/index') class="active" @endif ><a @if($data['subitem'] == 'users/index') class="active" @endif href="/users/index"><i class="fa fa-caret-right fa-fw"></i> Usuarios</a></li>
                                {{--
                                Esto debe ir un modulo de control de acceso
                                <li><a href="/roles/index"><i class="fa fa-caret-right fa-fw"></i> Roles</a></li>
                                --}}
                                <li @if($data['subitem'] == 'users_types/index') class="active" @endif ><a @if($data['subitem'] == 'users_types/index') class="active" @endif href="/users_types/index"><i class="fa fa-caret-right fa-fw"></i> Tipos</a></li>
                                <li @if($data['subitem'] == 'users_positions/index') class="active" @endif ><a @if($data['subitem'] == 'users_positions/index') class="active" @endif href="/users_positions/index"><i class="fa fa-caret-right fa-fw"></i> Cargos</a></li>
                                <li @if($data['subitem'] == 'users_divisions/index') class="active" @endif ><a @if($data['subitem'] == 'users_divisions/index') class="active" @endif href="/users_divisions/index"><i class="fa fa-caret-right fa-fw"></i> Divisiones</a></li>
                            </ul>
                        </li>
                        <li @if($data['item'] == 'vehicles') class="active" @endif>
                            <a class="has-arrow" href="#" @if($data['item'] == 'vehicles') aria-expanded="true" @else aria-expanded="false" @endif><i class="fa fa-car"></i><span class="hide-menu">Vehiculos </span></a>
                            <ul class="collapse @if($data['item'] == 'vehicles') in @endif" @if($data['item'] == 'vehicles') aria-expanded="true" @else aria-expanded="false" @endif>
                                <li @if($data['subitem'] == 'vehicles/index') class="active" @endif ><a @if($data['subitem'] == 'vehicles/index') class="active" @endif href="/vehicles/index"><i class="fa fa-caret-right fa-fw"></i> Vehiculos</a></li>
                                <li @if($data['subitem'] == 'vehicles_types/index') class="active" @endif ><a @if($data['subitem'] == 'vehicles_types/index') class="active" @endif href="/vehicles_types/index"><i class="fa fa-caret-right fa-fw"></i> Vehiculos Tipos</a></li>
                                <li @if($data['subitem'] == 'vehicles_brands/index') class="active" @endif ><a @if($data['subitem'] == 'vehicles_brands/index') class="active" @endif href="/vehicles_brands/index"><i class="fa fa-caret-right fa-fw"></i> Vehiculos Marcas</a></li>
                                <li @if($data['subitem'] == 'vehicles_models/index') class="active" @endif ><a @if($data['subitem'] == 'vehicles_models/index') class="active" @endif href="/vehicles_models/index"><i class="fa fa-caret-right fa-fw"></i> Vehiculos Modelos</a></li>
                                <li @if($data['subitem'] == 'vehicles_colors/index') class="active" @endif ><a @if($data['subitem'] == 'vehicles_colors/index') class="active" @endif href="/vehicles_colors/index"><i class="fa fa-caret-right fa-fw"></i> Vehiculos Colores</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="#" @if($data['item'] == 'parkings') aria-expanded="true" @else aria-expanded="false" @endif><i class="fa fa-road"></i><span class="hide-menu">Parqueaderos </span></a>
                            <ul class="collapse @if($data['item'] == 'parkings') in @endif" @if($data['item'] == 'parkings') aria-expanded="true" @else aria-expanded="false" @endif>
                                <li @if($data['subitem'] == 'parkings/index') class="active" @endif ><a @if($data['subitem'] == 'parkings/index') class="active" @endif href="/parkings/index"><i class="fa fa-caret-right fa-fw"></i> Parqueaderos</a></li>
                                <li @if($data['subitem'] == 'parkings_sections/index') class="active" @endif ><a @if($data['subitem'] == 'parkings_sections/index') class="active" @endif href="/parkings_sections/index"><i class="fa fa-caret-right fa-fw"></i> Secciones</a></li>
                                <li @if($data['subitem'] == 'parkings_dimensions/index') class="active" @endif ><a @if($data['subitem'] == 'parkings_dimensions/index') class="active" @endif href="/parkings_dimensions/index"><i class="fa fa-caret-right fa-fw"></i> Dimensiones</a></li>
                            </ul>
                        </li>                        
                        @endif
                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <?php /* ?>
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item-->
                <a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                <!-- item-->
                <a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                <!-- item-->
                <a href="" class="" data-toggle="tooltip" title="Logout">Logout <i class="mdi mdi-power"></i></a>
            </div>
            <!-- End Bottom points-->
            */ ?>
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->