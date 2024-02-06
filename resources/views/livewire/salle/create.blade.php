
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
           <div class="modal-content">
              <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">New Room</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
              </div>
              <div class="modal-body">
                <form action="{{route('salles.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="nom" class="col-form-label">Name:</label>
                      <input type="text" class="form-control" id="nom" name="nom" placeholder="donner le nom">
                    </div>

                    <div class="mb-3">
                      <label for="num" class="col-form-label">Number of user:</label>
                      <input type="number" class="form-control" id="num" name="num" placeholder="donner le nombre">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="col-form-label">Image:</label>
                        <input type="file" class="form-control" id="image" name="img">
                    </div>

                    <div class="mb-3">
                        <label for="desc" class="col-form-label">Description:</label>
                        <textarea name="desc" id="desc"  rows="5" class="form-control"></textarea>
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

