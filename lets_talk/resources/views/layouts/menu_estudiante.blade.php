<ul class="nav nav-tabs">
    @if(Request()->path() == "estudiante")
        <li role="presentation" class="active">
            <a href="#">Reservas</a>
        </li>
        <li role="presentation">
            <a href="{{route('estudiante.disponibilidad')}}">Disponibilidad Entrenadores</a>
        </li>
    @else
        <li role="presentation">
            <a href="#">Reservas</a>
        </li>
        <li role="presentation" class="active">
            <a href="{{route('administrador.disponibilidad_entrenadores')}}">Disponibilidad Entrenadores</a>
        </li>
    @endif
    <li>
        <a href="{{route('logout')}}" title="Cerrar Sesión">
            <i class="fa fa-sign-out fa-3x" aria-hidden="true"></i>
        </a>
    </li>
</ul>
