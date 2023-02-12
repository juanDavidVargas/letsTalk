{{-- Rol Administrador (id = 2) --}}
<ul class="nav nav-tabs">
    @if(Request()->path() == "administrador")
        <li role="presentation" class="active">
            <a class="pointer" href="{{route('administrador.index')}}">Home</a>
        </li>

        <li role="presentation">
            <a href="{{route('trainer.create')}}">Trainer's Agenda</a>
        </li>

        <li role="presentation">
            <a href="{{route('trainer.index')}}">Trainer's Sessions</a>
        </li>

        <li role="presentation">
            <a href="{{route('administrador.disponibilidad_entrenadores')}}">Availability Trainer's</a>
        </li>

        <li role="presentation">
            <a href="#">Reservations</a>
        </li>
    @endif

    @if(Request()->path() == "disponibilidad_entrenadores")

        <li role="presentation">
            <a class="pointer" href="{{route('administrador.index')}}">Home</a>
        </li>

        <li role="presentation">
            <a href="{{route('trainer.create')}}">Trainer's Agenda</a>
        </li>

        <li role="presentation">
            <a href="{{route('trainer.index')}}">Trainer's Sessions</a>
        </li>

        <li role="presentation" class="active">
            <a href="{{route('administrador.disponibilidad_entrenadores')}}">Availability Trainer's</a>
        </li>
        <li role="presentation">
            <a href="#">Reservations</a>
        </li>
    @endif

    @if(Request()->path() == "trainer/create")

        <li role="presentation" class="active">
            <a href="{{route('trainer.create')}}">Trainer's Agenda</a>
        </li>

    @endif

    @if(Request()->path() == "trainer" || Request()->path() == "trainer/*")

        <li role="presentation">
            <a class="pointer" href="{{route('administrador.index')}}">Home</a>
        </li>

        <li role="presentation">
            <a href="{{route('trainer.create')}}">Trainer's Agenda</a>
        </li>

        <li role="presentation" class="active">
            <a href="{{route('trainer.index')}}">Trainer's Sessions</a>
        </li>

        <li role="presentation">
            <a href="{{route('administrador.disponibilidad_entrenadores')}}">Availability Trainer's</a>
        </li>

        <li role="presentation">
            <a href="#">Reservations</a>
        </li>
    @endif

    <li>
        <a href="{{route('logout')}}" title="Cerrar Sesión">
            <i class="fa fa-sign-out fa-3x" aria-hidden="true"></i>
        </a>
    </li>
</ul>
