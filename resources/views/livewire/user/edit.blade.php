<div>


    @foreach ($users as $user )

    <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
           <div class="modal-content">
              <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Edit Room</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
              </div>
              <div class="modal-body">
                <form action="{{route('users.edit',$user->id)}}" method="POST" enctype="multipart/form-data">
                    @method("PUT")
                    @csrf
                    <div class="mb-3">
                      <label for="nom" class="col-form-label">Name:</label>
                      <input type="text" class="form-control" id="nom" name="nom" placeholder="donner le nom" value="{{$user->name}}">

                    </div>
                    <div class="mb-3">
                      <label for="email" class="col-form-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="donner email" value="{{$user->email}}">

                    </div>
                    <div class="mb-3">

                        <label for="pass" class="col-form-label">Password:</label>
                        <input type="password" class="form-control" id="pass" name="pass">

                      </div>
                      <div class="mb-3">
                        <label for="role" class="col-form-label">Role: {{$user->role}}</label>
                       <select name="role" id="role" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="pm">PM</option>
                        <option value="worker">Worker</option>
                       </select>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                     </div>
                  </form>
              </div>

           </div>
        </div>
     </div>



     @endforeach
    </div>
