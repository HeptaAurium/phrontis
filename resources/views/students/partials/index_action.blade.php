<div class="dropdown open">
    <button class="btn bg-transparent dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="triggerId">
        <a class="dropdown-item" href="students/{{ $row->id }}">Student Details</a>
        <a class="dropdown-item" href="examination/results/{{ $row->id }}">Academics</a>
    </div>
</div>
