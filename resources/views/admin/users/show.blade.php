<x-app-layout>
    @if ($message = Session::get('message'))
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

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-block card-stretch card-height">
                <div class="card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title mb-0">Contact List</h4>
                    </div>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add New</a>
                    @livewire('user.create')
                </div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <div class="row">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive data-table">
                        <table class="data-tables table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <img src="{{ $user->profile_photo_url== null ? '/assets/images/user/01.jpg' : $user->profile_photo_url }}"
                                                class="rounded avatar-40 img-fluid" alt="">
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>

                                        <td>
                                            <div class="d-flex align-items-center list-action">
                                                <a class="badge bg-warning-light mr-2" data-toggle="tooltip"
                                                    data-placement="top" title="" data-original-title="Rating"
                                                    href="#"><i class="far fa-star"></i></a>
                                                <a class="badge bg-success-light mr-2" data-toggle="tooltip"
                                                    data-placement="top" title="" data-original-title="View"
                                                    href="#"><i class="lar la-eye"></i></a>
                                                <span class="badge bg-primary-light" data-toggle="tooltip"
                                                    data-placement="top" title="" data-original-title="Action"
                                                    href="#">
                                                    <div class="dropdown">
                                                        <span class="text-primary dropdown-toggle action-item"
                                                            id="moreOptions1" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false" href="#">

                                                        </span>
                                                        <div class="dropdown-menu" aria-labelledby="moreOptions1">
                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal{{$user->id}}">Edit</a>

                                                            <form action="{{ route('users.delete', $user->id) }}"
                                                                method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button class="dropdown-item"
                                                                    type="submit">Delete</button>
                                                            </form>
                                                            <a class="dropdown-item" href="#">Hide from
                                                                Contacts</a>
                                                        </div>
                                                    </div>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                @livewire("user.edit")
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
