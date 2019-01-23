<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                <button type="button" class="js-hide-modal1" data-dismiss="modal">&times;</button>
              </div>
                     <div class="modal-body">
                     <form action="{{route('user.login')}}" method="POST">
                                @csrf
                                @method('post')
                                <div class="form-group">
                                    <label for="email" class="col-form-label">Email:</label>
                                    <input name="email" type="email" class="form-control" id="email" required="required" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-form-label">Password:</label>
                                    <input name="password" type="password" class="form-control" id="password" required="required" autocomplete="off">
                                </div>
                       <div class="modal-footer">
                       <strong>Not have account.........................................?</strong>
                       <a href="{{route('signup')}}" class="btn btn-info">Signup</a>
                       <button type="submit" class="btn btn-primary">Login</button>
                       </div>
                    </form>
              </div>
            </div>
          </div>
      </div>
</div>
