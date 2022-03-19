<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="/"><i class="fa fa-home"></i> Escritorio</a></li>
            @if (Module::isEnabled('Alumnos') || Module::isEnabled('Asistencias') || Module::isEnabled('Calificaciones') || Module::isEnabled('Examenes'))
                <li><a><i class="fa fa-male"></i> Alumnos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        @if (Module::isEnabled('Alumnos'))
                            <li><a href="/alumnos">Alumnos</a></li>
                        @endif
                        @if (Module::isEnabled('Asistencias'))
                            <li><a href="/asistencias">Asistencias</a></li>
                        @endif
                        @if (Module::isEnabled('Calificaciones'))
                            <li><a href="/calificaciones">Calificaciones</a></li>
                        @endif
                        @if (Module::isEnabled('Examenes'))
                            <li><a href="/examenes">Examenes</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (Module::isEnabled('AsistenciasDocentes') || Module::isEnabled('Docentes') || Module::isEnabled('HorarioDocentes'))
                <li><a><i class="fa fa-windows"></i> Docentes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        @if (Module::isEnabled('AsistenciasDocentes'))
                            <li><a href="/asistencias_docentes">Asistencias</a></li>
                        @endif
                        @if (Module::isEnabled('Docentes'))
                            <li><a href="/instructores">Docentes</a></li>
                        @endif
                        @if (Module::isEnabled('HorarioDocentes'))
                            <li><a href="/horario_docentes">Horarios</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (Module::isEnabled('Inscripciones') || Module::isEnabled('Grupos') || Module::isEnabled('Horarios'))
                <li><a><i class="fa fa-table"></i> Ciclo Escolar <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        @if (Module::isEnabled('Grupos'))
                            <li><a href="/grupos">Grupos</a></li>
                        @endif
                        @if (Module::isEnabled('Horarios'))
                            <li><a href="/horarios">Horarios</a></li>
                        @endif
                        @if (Module::isEnabled('Inscripciones'))
                            <li><a href="/inscripciones">Inscripciones</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (Module::isEnabled('PagoDocentes') || Module::isEnabled('Pagos'))
                <li><a><i class="fa fa-credit-card"></i>Pagos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        @if (Module::isEnabled('PagoDocentes'))
                            <li><a href="/pago_personal">Pago Personal</a></li>
                        @endif
                        @if (Module::isEnabled('Pagos'))
                            <li><a href="/pagos">Pagos</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (Module::isEnabled('Roles') || Module::isEnabled('User'))
                <li><a><i class="fa fa-users"></i>Usuarios <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        @if(Module::isEnabled('Roles'))
                            <li><a href="/roles">Roles</a></li>
                        @endif
                        @if (Module::isEnabled('User'))
                            <li><a href="/usuarios">Usuarios</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (Module::isEnabled('Materias') || Module::isEnabled('Module') || Module::isEnabled('Institucion') || Module::isEnabled('Planteles') || Module::isEnabled('Personal') || Module::isEnabled('Cursos'))
                <li><a><i class="fa fa-edit"></i> Configuración <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        @if (Module::isEnabled('Module'))
                            <li><a href="/modules">Modulos</a></li>
                        @endif
                        @if (Module::isEnabled('Institucion'))
                            <li><a href="/institucion">Institución</a></li>
                        @endif
                        @if (Module::isEnabled('Planteles'))
                            <li><a href="/planteles">Planteles</a></li>
                        @endif
                        @if (Module::isEnabled('Personal'))
                            <li><a href="/personal">Personal</a></li>
                        @endif
                        @if (Module::isEnabled('Cursos'))
                            <li><a href="/cursos">Cursos</a></li>
                        @endif
                        @if (Module::isEnabled('Materias'))
                            <li><a href="/materias">Materias</a></li>
                        @endif
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
