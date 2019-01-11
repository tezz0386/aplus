@extends('admin.dashboard')
@section('content')
<div class="row">
                          <div class="container">
                              <div class="row">
                                   <div class="col-md-3">
                                      <a href="#" class="btn btn-default">Today's Transaction</a>
                                   </div>
                                   <div class="col-md-3">
                                        <a href="#" class="btn btn-default">Yesterday's Transaction</a>
                                   </div>
                                   <div class="col-md-3">
                                       <a href="#" class="btn btn-default">Previous one week Transaction</a>
                                   </div>
                                   <div class="col-md-3">
                                      <div class="input-group mb-3">
                                      <select class="form-control">
                                            <option hidden="hidden">Select View Ways</option>
                                            <option>Day Ways</option>
                                            <option>Week Ways</option>
                                            <option>Year Ways</option>
                                       </select>
                                                <div class="input-group-append be-addon">
                                                    <button type="submit" class="btn btn-secondary">Continue</button>
                                                </div>
                                       </div>
                                   </div>
                              </div>
                           </div>
                    <!-- ============================================================== -->
                    <!-- basic table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Transaction Table</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                      @if(isset($transactions) && count($transactions)>0)
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Customer Name</th>
                                                <th>Card Holder</th>
                                                <th>Delivery Address</th>
                                                <th colspan="3">Action</th>
                                            </tr>
                                        </thead>
                                        @endif
                                        <tbody>
                                            @if(isset($transactions) && count($transactions)>0)
                                            @foreach($transactions as $transaction)
                                             <tr>
                                                 
                                                
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if(isset($transactions) && count($transactions)>0) {{$transactions->links()}} @endif
                    </div>
                    <!-- ============================================================== -->
                    <!-- end basic table  -->
                    <!-- ============================================================== -->
                </div>      
@endsection