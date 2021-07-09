<div class="sidebar shadow-sm mini">
    <button class="btn bg-transparent d-md-none text-white btn-toggle-sidenav" type="button"
        style="position: absolute;top:10px;right:5px;" title="Hide side navigation" data-toggle="tooltip">
        <i class="fa fa-times" aria-hidden="true"></i>
    </button>
    <div class="top flex-center flex-column mt-4 pb-4 logo">
        <a class="btn text-center" href="https://phrontis.ichaelinc.co.ke/documentation" target="_black">
            <img src="{{ asset('img/logo/phrontis.png') }}" class="w-auto img-fluid mr-3 rounded-circle" alt=""> <br>
            <span class="d-none d-lg-block logo-text text-white">{{ config('app.name', 'Laravel') }}</span>
        </a>

    </div>
    <hr class="my-2 mx-auto" style="border-top: 1px solid #ddd;width:90%;">

    <div class="sidebar-navigation">
        {{-- <button class="btn bg-transparent d-none d-md-block btn-expand-side text-center">
            <i class="fa fa-indent" aria-hidden="true"></i>
        </button> --}}
        <nav id="column_left">
            <ul class="nav nav-list flex-column">
                <li class="nav-item"><a href="/home"> <i class="fa fa-home" aria-hidden="true"></i> <span
                            class="side-text d-none">Dashboard </span></a></li>
                <li class="nav-item" data-toggle="tooltip" title="Students">
                    <a class="accordion-heading" data-toggle="collapse" data-target="#students">
                        <span class="nav-header-primary"> <i class="fas fa-users"></i> <span class="side-text d-none">Students
                            </span> <i class="fa fa-caret-down float-right" aria-hidden="true"></i>
                    </a>
                    <ul class="nav nav-list collapse" id="students">
                        <li class="nav-item">
                            <a class="nav-link" href="/students"> <i class="fa fa-circle" aria-hidden="true"></i> <span
                                    class="side-mini-text pl-3"> List Students </span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/students/create"> <i class="fa fa-circle" aria-hidden="true"></i>
                                <span class="side-mini-text pl-3"> Add Student </span></a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item" data-toggle="tooltip" title="Classes">
                    <a class="accordion-heading" data-toggle="collapse" data-target="#class">
                        <span class="nav-header-primary"> <i class="fa fa-building" aria-hidden="true"></i> <span
                                class="side-text d-none">Classes </span> <i class="fa fa-caret-down float-right"
                                aria-hidden="true"></i>
                    </a>
                    <ul class="nav nav-list collapse" id="class">
                        <li class="nav-item">
                            <a class="nav-link" href="/classes"> <i class="fa fa-circle" aria-hidden="true"></i> <span
                                    class="side-mini-text pl-3"> List Classes </span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"> <i class="fa fa-circle" aria-hidden="true"></i> <span
                                    class="side-mini-text pl-3"> Add Classes </span></a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item" data-toggle="tooltip" title="Examinations">
                    <a class="accordion-heading" data-toggle="collapse" data-target="#exams">
                        <span class="nav-header-primary" data-toggle="modal" title="Examinations"> <i
                                class="fas fa-receipt"></i> <span class="side-text d-none">Examinations </span> <i
                                class="fa fa-caret-down float-right" aria-hidden="true"></i>
                    </a>
                    <ul class="nav nav-list collapse" id="exams">
                        <li class="nav-item">
                            <a class="nav-link" href="/exam-types"> <i class="fa fa-circle" aria-hidden="true"></i>
                                <span class="side-mini-text pl-3"> Examination Types </span> </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/exams/create"> <i class="fa fa-circle" aria-hidden="true"></i>
                                <span class="side-mini-text pl-3"> Record Exam Results </span> </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/examination/results"> <i class="fa fa-circle"
                                    aria-hidden="true"></i> <span class="side-mini-text pl-3">Exam Results </span> </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
