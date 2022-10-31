@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title mb-3"> Basic Wizard</h4>
                    <div id="basicwizard">

                        <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-4">
                            <li class="nav-item">
                                <a href="#basictab1" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-account-circle me-1"></i>
                                    <span class="d-none d-sm-inline">Sub Mata Pelajaran</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#basictab2" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-face-profile me-1"></i>
                                    <span class="d-none d-sm-inline">List Mata Pelajaran</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content b-0 mb-0 pt-0">
                            <div class="tab-pane" id="basictab1">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row mb-3">
                                            <label class="col-md-3 col-form-label" for="userName">User name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="userName" name="userName" value="Coderthemes">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-3 col-form-label" for="password"> Password</label>
                                            <div class="col-md-9">
                                                <input type="password" id="password" name="password" class="form-control" value="123456789">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-3 col-form-label" for="confirm">Re Password</label>
                                            <div class="col-md-9">
                                                <input type="password" id="confirm" name="confirm" class="form-control" value="123456789">
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>

                            <div class="tab-pane" id="basictab2">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row mb-3">
                                            <label class="col-md-3 col-form-label" for="name"> First name</label>
                                            <div class="col-md-9">
                                                <input type="text" id="name" name="name" class="form-control" value="Francis">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-3 col-form-label" for="surname"> Last name</label>
                                            <div class="col-md-9">
                                                <input type="text" id="surname" name="surname" class="form-control" value="Brinkman">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-3 col-form-label" for="email">Email</label>
                                            <div class="col-md-9">
                                                <input type="email" id="email" name="email" class="form-control" value="cory1979@hotmail.com">
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>

                        </div> <!-- tab-content -->
                    </div> <!-- end #basicwizard-->
    </div>
        </div>
    </div>
</div>
@endsection
