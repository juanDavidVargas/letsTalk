
<ul class="nav nav-tabs">
    @if(Request()->path() == "trainer")

        <li role="presentation">
            <a href="{{route('trainer.create')}}">Trainer's Agenda</a>
        </li>
        <li role="presentation"  class="active">
            <a href="{{route('trainer.index')}}">Trainer's Sessions</a>
        </li>

    @elseif(Request()->path() == "trainer/create" && session('rol') == 1)

        <li role="presentation" class="active">
            <a href="{{route('trainer.create')}}">Trainer's Agenda</a>
        </li>

        <li role="presentation">
            <a href="{{route('trainer.index')}}">Trainer's Sessions</a>
        </li>

    @else

        <li role="presentation" class="active">
            <a href="{{route('trainer.create')}}">Trainer's Agenda</a>
        </li>
        <li role="presentation">
            <a href="{{route('trainer.index')}}">Trainer's Sessions</a>
        </li>

    @endif
    <li>
        <a href="{{route('logout')}}" title="Cerrar Sesión">
            <i class="fa fa-sign-out fa-3x" aria-hidden="true"></i>
        </a>
    </li>
</ul>
