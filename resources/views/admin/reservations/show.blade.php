<x-app-layout>
    @if ($message = Session::get('message'))
        <script>
            Swal.fire({
                position: "center",
                icon: "error",
                title: "{{ $message }}",
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif

    @if ($message = Session::get('messageSucces'))
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "{{ $message }}",
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif
    <h4 class="mb-3">Informations
    </h4>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4"><img src="{{ asset($res->salles->image_path) }}" alt="" width="300px">
                        </div>
                        <div class="col-4">
                            <div class="alert alert-info">
                                Room name:<span class="badge badge-info ml-2 mr-2">{{ $res->salles->name }}</span>
                                Number of user:<span class="badge badge-info ml-2">{{ $res->salles->number_u }}</span>
                            </div>
                            Description:<p class="text-break">{{ $res->salles->desc }}</p>
                        </div>
                        <div class="col-4">
                            <div class="alert alert-secondary">

                                User Name:<span
                                    class="badge badge-info ml-2 mr-2">{{ \App\Models\User::find($res->groups->user_id)->name }}</span>
                            </div>

                            <div class="alert alert-secondary">
                                date create reservation :<span
                                    class="badge badge-info ml-2 ">{{ $res->created_at }}</span>
                            </div>
                            <div class="alert alert-secondary">
                                date update reservation :<span
                                    class="badge badge-info ml-2 ">{{ $res->updated_at }}</span>
                            </div>
                            <form action="{{ route('reservations.deleteRes') }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" value="{{ $res->id }}" name="idres">
                                <input type="hidden" value="{{ $res->salle_id }}" name="idsalle">
                                <button type="submit" class="btn btn-danger">DELETE RESERVATION</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('reservations.edit', $res->id) }}" method="POST">
                        @method('PUT')
                        @csrf

                        <div class="row">

                            @if ($res->type != 'u')
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="schedule-title">Name of reservation</label>
                                        <input class="form-control" placeholder="Enter Title" type="text"
                                            name="title" value="{{ $res->groups->nom_g }}" id="schedule-title"
                                            required />
                                    </div>
                                </div>
                            @else
                                <input class="form-control" placeholder="Enter Title" type="hidden" name="title"
                                    value="{{ $res->groups->nom_g }}" id="schedule-title" required />
                            @endif

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="schedule-start-date">Start Date</label>
                                    <input class="form-control" placeholder="2020-06-20" type="text" name="date"
                                        value="{{ $res->date }}" id="schedule-start-date" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="schedule-end-date">start time</label>
                                    <input class="form-control" placeholder="2020-06-20" type="time"
                                        value="{{ $res->start_time }}" name="start_time" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="schedule-end-date">End time</label>
                                    <input class="form-control" placeholder="2020-06-20" type="time"
                                        value="{{ $res->end_time }}" name="end_time" required />
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                    <input type="hidden" value="{{ $res->group_id }}" name="idG">
                                    <button class="btn btn-secondary mr-4" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary mr-4" type="submit">Save</button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        @if ($res->type != 'u')
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-6">

                            </div>

                            <div class="col-6 ">

                                <button class="btn btn-primary ml-0" type="submit" style="float: right"
                                    data-toggle="modal" data-target="#exampleModal">Add user</button>



                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">list users</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>


                                            <div class="modal-body">
                                                <table class="data-tables table" style="width:100%">
                                                    @foreach ($users as $user)
                                                        @if (in_array($user->id, $userID) == false)
                                                            <form action="{{ route('reservations.addUser') }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" value="{{ $user->id }}"
                                                                    name="userId">
                                                                <input type="hidden" value="{{ $res->group_id }}"
                                                                    name="idGrp">


                                                                <tr>
                                                                    <td>
                                                                        <img src="{{ $user->profile_photo_url == null ? '/assets/images/user/01.jpg' : $user->profile_photo_url }}"
                                                                            class="rounded avatar-40 img-fluid"
                                                                            alt="">
                                                                    </td>
                                                                    <td>{{ $user->name }}</td>
                                                                    <td>{{ $user->email }}</td>


                                                                    <td style="float: right" class="mr-0">
                                                                        <button type="submit" class="btn btn-info"><i
                                                                                class="fa fa-plus"></i>Add</button>

                                                                    </td>
                                                                </tr>
                                                            </form>
                                                        @endif
                                                    @endforeach
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>





                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive data-table">
                                <table class="data-tables table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usergrp as $userid)
                                            <tr>
                                                <td>
                                                    <img src="{{ $userid->users->profile_photo_url == null ? '/assets/images/user/01.jpg' : $userid->users->profile_photo_url }}"
                                                        class="rounded avatar-40 img-fluid" alt="">
                                                </td>
                                                <td>{{ $userid->users->name }}</td>
                                                <td>{{ $userid->users->email }}</td>


                                                <td>
                                                    <div class="d-flex align-items-center list-action">
                                                        <form action="{{ route('reservations.exitUser') }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <input type="hidden" value="{{ $userid->id }}"
                                                                name="idExit">
                                                            <button class="btn btn-warning" data-toggle="tooltip"
                                                                data-placement="top" title=""
                                                                data-original-title="quitté le group"
                                                                href="#"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endif
    </div>
</x-app-layout>
