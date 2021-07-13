<div class="row col-12">
    <div class="col-md-6 col-lg-4 ">
        <div class="floats shadow-sm w-100">
            <div class="floats-top">
                <div class="floats-icon floats-icon-1">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </div>
                <div class="right">
                    <p class="floats-title">Registered Students</p>
                    @can('can_all')
                        @foreach ($branches as $branch)
                            <h3 class="floats-content"> <small class="text-muted">{{ $branch->name }}</small>
                                {{ number_format(
    $students->where('branch', $branch->id)->get()->count(),
) }}
                            </h3>
                        @endforeach
                    @else
                        @php
                            $branch = \App\Models\Branch::find(auth()->user()->branch_id);
                        @endphp
                        <h3 class="floats-content"> <small class="text-muted">{{ $branch->name }}</small>
                            {{ number_format($students->where('branch', auth()->user()->branch_id)->count()) }}</h3>
                    @endcan
                </div>
            </div>
            <hr class="floats-hr">
            <div class="floats-footer">
                <div class="floats-footer-inner">
                    <div class="floats-footer-icon">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </div>
                    <div class="floats-footer-text">
                        <a href="/students"> View all registered students</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 ">
        <div class="w-100 floats shadow-sm">
            <div class="floats-top">
                <div class="floats-icon floats-icon-3">
                    <i class="fa fa-book" aria-hidden="true"></i>
                </div>
                <div class="right">
                    <p class="floats-title">Subjects</p>
                    <h3 class="floats-content">{{ $subjects }} </h3>
                </div>
            </div>
            <hr class="floats-hr">
            <div class="floats-footer">
                <div class="floats-footer-inner">
                    <div class="floats-footer-icon">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </div>
                    <div class="floats-footer-text">
                        <a href="/subjects"> View all subjects</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 ">
        <div class="w-100 floats shadow-sm">
            <div class="floats-top">
                <div class="floats-icon floats-icon-2">
                    <i class="fa fa-info" aria-hidden="true"></i>
                </div>
                <div class="right">
                    <p class="floats-title">Current Session</p>
                    <h3 class="floats-content text-muted">{{$session['name']}} </h3>
                </div>
            </div>
            <hr class="floats-hr">
            <div class="floats-footer">
                <div class="floats-footer-inner">
                    <div class="floats-footer-icon">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </div>
                    <div class="floats-footer-text">
                        {{-- <a href="/subjects"> View all subjects</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
