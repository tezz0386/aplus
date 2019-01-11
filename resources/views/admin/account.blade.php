@extends('admin.dashboard')
@section('content')
<form class="splash-container">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-1">Admin Registrations Form</h3>
                <p>Please enter Others Admin information.</p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input class="form-control form-control-lg" type="email" name="email" required="" placeholder="E-mail" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="contact" required="" placeholder="Contact" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="address" required="" placeholder="Address" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" id="pass1" type="password" required="" placeholder="Password">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" required="" placeholder="Confirm">
                </div>
                <div class="form-group pt-2">
                    <button class="btn btn-block btn-primary" type="submit">Register Others Account</button>
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox"><span class="custom-control-label">By creating an account, you agree the <a href="#">terms and conditions</a></span>
                    </label>
                </div>
            </div>
            <div class="card-footer bg-white">
                <p>Already member? <a href="#" class="text-secondary">Login Here.</a></p>
            </div>
        </div>
    </form>
@endsection