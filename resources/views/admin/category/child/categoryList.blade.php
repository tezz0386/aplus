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
                                                <th>Description</th>
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
                                                <td>{{$category->description}}</td>
                                                <td><a href="{{route('childshow', $category->id)}}">Edit</a></td>
                                               <td><a href="#" onclick="">Remove

                                                <form action="{{route('deletechild', $category->id)}}" method="post" hidden="hidden" id="delete-form">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                                 

                                               </a></td>
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