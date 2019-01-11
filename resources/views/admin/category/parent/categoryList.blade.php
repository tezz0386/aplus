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
                                      @if(isset($parents)&&count($parents)>0)
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Parents Name</th>
                                                <th>Description</th>
                                                <th colspan="3">Action</th>
                                            </tr>
                                        </thead>
                                        @endif
                                        <tbody>
                                            @if(isset($parents)&&count($parents)>0)
                                            @foreach($parents as $parent)
                                             <tr>
                                                <td>{{$parent->id}}</td>
                                                <td>{{$parent->parent_name}}</td>
                                                <td>{{$parent->description}}</td>
                                                <td><a href="{{route('showparent', $parent->id)}}">Edit</a></td>
                                               <td><a href="#" onclick="deleteMethod()">Remove

                                               <!--  <form action="#" method="post" hidden="hidden" id="delete-form">
                                                    @method('delete')
                                                    @csrf
                                                </form> -->
                                                 

                                               </a></td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end basic table  -->
                    <!-- ============================================================== -->
                </div>      
@endsection
