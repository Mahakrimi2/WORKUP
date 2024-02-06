
<li class="nav-item nav-icon dropdown">
    <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="las la-bell"></i>
        <span class="badge badge-primary count-mail rounded-circle">{{$nbRes->count()}}</span>
        <span class="bg-primary"></span>
    </a>
    <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
        <div class="card shadow-none m-0">
            <div class="card-body p-0 ">
                <div class="cust-title p-3">
                    <h5 class="mb-0">Notifications</h5>
                </div>
                <div class="p-2">
                    @foreach ($nbRes as $res)

                    <a href="#" class="iq-sub-card">
                        <div class="media align-items-center cust-card p-2">
                            <div class="">
                                <img class="avatar-40 rounded-small" src="{{asset($res->groups->usermaker->profile_photo_url)}}" alt="03">
                            </div>
                            <div class="media-body ml-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">{{$res->groups->usermaker->name}}</h6>
                                    <small class="mb-0">{{$res->created_at}}</small>
                                </div>
                                <small class="mb-0">{{$res->groups->usermaker->role}}</small>
                            </div>
                        </div>
                    </a>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</li>
