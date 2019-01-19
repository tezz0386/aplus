@extends('admin.dashboard')
@section('content')

      <div class="row">
                    <!-- ============================================================== -->
                    <!-- basic table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <input type="text" name="search" style="border-radius: 10px;" placeholder="Search here...............">
                            <h5 class="card-header">Category Table</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                      @if(isset($categories)&&count($categories)>0)
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Parent Name</th>
                                                <th>Category Name</th>
                                                <th colspan="3">Action</th>
                                            </tr>
                                        </thead>
                                        @endif
                                        <tbody>
                                            @if(isset($categories)&&count($categories)>0)
                                            @foreach($categories as $category)
                                             <tr>
                                                <td>{{$category->id}}</td>
                                                 <td>{{$category->parent_name}}</td>
                                                <td>{{$category->child_name}}</td>
                                                <td><a href="3">Delete Now</a>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>

                                </div>
                                  {{ $categories->onEachSide(4)->links() }}
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end basic table  -->
                    <!-- ============================================================== -->
                </div>


                <script type="text/javascript">
                    function deleteMethod(){
                        if(confirm('Are you want to remove...................?')){
                             event.preventDefault();
                            document.getElementById('delete-form').submit();
                        }
                    }
                </script>

@endsection
@section('scripts')

@endsection