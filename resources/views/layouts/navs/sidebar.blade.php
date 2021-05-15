<div class="sidebar shadow-sm">
    <button class="btn bg-transparent d-md-none btn-toggle-sidenav" type="button"
        style="position: absolute;top:0;right:0;" title="Hide side navigation" data-toggle="tooltip">
        <i class="fa fa-times" aria-hidden="true"></i>
    </button>
    <div class="top flex-center flex-column mt-4 pb-4">
        @if (empty(auth()->user()->photo) || auth()->user()->photo == '')
            <div class="rounded-circle m-2 bg-light shadow-sm flex-center text-primary"
                style="height: 80px; width:80px; cursor:pointer">
                @php
                    $names = Auth::user()->name;
                    $names = explode(' ', $names);
                    $disp = '';
                    foreach ($names as $value) {
                        $disp .= $value[0];
                    }
                @endphp
                <span class="font-weight-bold">{{ strtoupper($disp) }} </span>
            </div>
        @else
            <img src="{{ asset('img/profile/' . auth()->user()->photo) }}" class="img-fluid rounded-circle" alt="">
        @endif
        {{-- <span class="text-center">{{auth()->user()->name}}</span> --}}
    </div>
    <hr class="my-2 mx-auto" style="border-top: 1px solid #ddd;width:90%;">

    <div class="sidebar-navigation">
        {{-- <button class="btn bg-transparent d-none d-md-block btn-expand-side text-center">
            <i class="fa fa-indent" aria-hidden="true"></i>
        </button> --}}
        <nav id="column_left">
            <ul class="nav nav-list flex-column">
                <li class="nav-item"><a href="/home"> <i class="fa fa-home" aria-hidden="true"></i> <span
                            class="side-text">Dashboard </span></a></li>
                <li class="nav-item">
                    <a class="accordion-heading" data-toggle="collapse" data-target="#students">
                        <span class="nav-header-primary"> <i class="fas fa-users"></i> <span class="side-text">Students </span> <i
                                class="fa fa-caret-down float-right" aria-hidden="true"></i>
                    </a>
                    <ul class="nav nav-list collapse" id="students">
                        <li class="nav-item">
                            <a class="nav-link" href="/students"> <i class="fa fa-circle" aria-hidden="true"></i> <span class="side-mini-text"> List Srudents </span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/students/create"> <i class="fa fa-circle" aria-hidden="true"></i> <span class="side-mini-text"> Add Student </span></a>
                        </li>
                    </ul>
                </li> 
                
                <li class="nav-item">
                    <a class="accordion-heading" data-toggle="collapse" data-target="#class">
                        <span class="nav-header-primary"> <i class="fa fa-building" aria-hidden="true"></i> <span class="side-text">Classes </span> <i
                                class="fa fa-caret-down float-right" aria-hidden="true"></i>
                    </a>
                    <ul class="nav nav-list collapse" id="class">
                        <li class="nav-item">
                            <a class="nav-link" href="/classes"> <i class="fa fa-circle" aria-hidden="true"></i> <span class="side-mini-text"> List Classes </span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"> <i class="fa fa-circle" aria-hidden="true"></i> <span class="side-mini-text"> Add Classes </span></a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="accordion-heading" data-toggle="collapse" data-target="#exams">
                        <span class="nav-header-primary" data-toggle="modal" title="Examinations"> <i class="fas fa-receipt"></i> <span class="side-text">Examinations </span> <i
                                class="fa fa-caret-down float-right" aria-hidden="true"></i>
                    </a>
                    <ul class="nav nav-list collapse" id="exams">
                        <li class="nav-item">
                            <a class="nav-link"> <i class="fa fa-circle" aria-hidden="true"></i> <span class="side-mini-text"> Examination Types </span> </a>
                        </li>
                       
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
