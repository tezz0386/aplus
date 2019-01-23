@extends('admin.dashboard')
@section('content')
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#parentCategory">Add Category</button>
<hr>
            <div class="row">
                        @if(isset($parents) && count($parents)>0)
                        @foreach($parents as $parent)
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 co-12">
                        <!-- iteration start here -->
                            <section class="card card-fluid">
                             <h5 class="card-header drag-handle">{{$parent->parent_name}}
                             
                                               <div class="dd-nodrag btn-group ml-auto">
                                                    <button class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#subCategory" cat_id="{{$parent->id}}" id="subCategory{{$parent->id}}">Add Sub Category</button>
                                                    <button class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#parentCategoryEdit" p_name="{{$parent->parent_name}}" cat_id="{{$parent->id}}" id="btn{{$parent->id}}">Edit</button>
                                               </div>
                              </h5>
                                <div class="dd" id="nestable">
                                    <ol class="dd-list">
                                    @foreach($parent->childs as $child)
                                        <li class="dd-item" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div>{{$child->child_name}}</div>
                                                <div class="dd-nodrag btn-group ml-auto">
                                                  <a class="btn btn-sm btn-outline-light" href="{{route('admin.product.view', $child->id)}}">View Products</a>
                                                    <button class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#subCategoryEdit" id="subEdit{{$child->id}}" id_child="{{$child->id}}" child_name="{{$child->child_name}}">Edit</button>
                                                    @if($child->status=='on')
                                                    <button class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#deleteChild" cat_id="{{$child->id}}" id="deleteIdForChild{{$child->id}}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                    @else
                                                    <button class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#recoverChild" id="recover{{$child->id}}" id_child="{{$child->id}}">Recover</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                     @endforeach
                                    </ol>
                                </div>
                            </section>
                            <!-- iteration close here -->
                        </div>
                        @endforeach
                        @endif
            </div>



  <!-- Modal for add Parent -->
  <div class="modal fade" id="parentCategory" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
        <h4 class="modal-title">New Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         
               <form method="post" action="{{route('storeparent')}}">
                 @method('post')
                 @csrf
                 <div class="input-group mb-3">
                   <input type="text" class="form-control" name="parent_name">
                     <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                 </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

   <!-- Modal for edit Parent -->
   <div class="modal fade" id="parentCategoryEdit" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
        <h4 class="modal-title">Edit Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         
               <form method="post"action="{{route('updateparent')}}">
                     @method('patch')
                     @csrf
                     <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" id="parentName">
                        <input type="text" hidden="hidden" class="form-control" name="id" id="parent_id">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

   <!-- Modal for add Sub Category -->
   <div class="modal fade" id="subCategory" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
        <h4 class="modal-title">Sub Category Adden</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         
               <form method="post" action="{{route('storechild')}}">
                     @method('post')
                     @csrf
                     <div class="input-group mb-3">
                        <input type="text" class="form-control" name="child_name">
                        <input type="text" hidden="hidden" class="form-control" name="id" id="parentIdForSub">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>



   <!-- Modal for update sub Category -->
   <div class="modal fade" id="subCategoryEdit" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
        <h4 class="modal-title">Sub Category Adden</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         
               <form method="post"action="{{route('updatechild')}}">
                     @method('patch')
                     @csrf
                     <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" id="subName">
                        <input type="text" hidden="hidden" class="form-control" name="id" id="child_id">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<div id="deleteChild" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">Delete Now</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
         <form action="{{route('deletechild')}}" method="post">
            @method('patch')
            @csrf
            <input type="text" hidden="hidden" id="idForDelete" name="id">
            <p> Are You Sure Trash This Category......?</p>
            <button type="submit" class="btn btn-warning btn-sm">OK</button>
         </form>
      </div>
    </div>

  </div>
</div>

<div id="recoverChild" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">Delete Now</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
         <form action="{{route('recoverChild')}}" method="post">
            @method('patch')
            @csrf
            <input type="text" hidden="hidden" id="idForRecover" name="id">
            <p> Are You Sure Trash This Category......?</p>
            <button type="submit" class="btn btn-warning btn-sm">OK</button>
         </form>
      </div>
    </div>

  </div>
</div>

@endsection
@section('scripts')
   <script>
         $(document).ready(function(){
           @foreach($parents as $parent)
             $('#btn{{$parent->id}}').click(function(){
                  $('#parentName').val($(this).attr('p_name'));
                  $('#parent_id').val($(this).attr('cat_id'));
             });
             $('#subCategory{{$parent->id}}').click(function(){
                  $('#parentIdForSub').val($(this).attr('cat_id'));
             });
             @foreach($parent->childs as $child)
               $('#subEdit{{$child->id}}').click(function(){
                   $('#subName').val($(this).attr('child_name'));
                  $('#child_id').val($(this).attr('id_child'));
               });
               $('#recover{{$child->id}}').click(function(){
                      $('#idForRecover').val($(this).attr('id_child')); 
               });
               $('#productadd{{$child->id}}').click(function(){
                  $('#childIdForProduct').val($(this).attr('cat_id'));
               });
               $('#deleteIdForChild{{$child->id}}').click(function(){
                      $('#idForDelete').val($(this).attr('cat_id')); 
               });
             @endforeach
           @endforeach

       $('#thumbnail').on('change', function() {
       var file = $(this).get(0).files;
       var reader = new FileReader();
       reader.readAsDataURL(file[0]);
       reader.addEventListener("load", function(e) {
       var image = e.target.result;
      $("#imgthumbnail").attr('src', image);
      });
});
         }); 
   </script>
@endsection
