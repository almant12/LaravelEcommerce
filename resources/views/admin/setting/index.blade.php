@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>General Setting</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        <a class="list-group-item list-group-item-action active" id="general-settings" data-toggle="list" href="#list-home" role="tab">General Setting</a>
                                        <a class="list-group-item list-group-item-action" id="email-setting" data-toggle="list" href="#list-profile" role="tab">Email Setting</a>
                                        <a class="list-group-item list-group-item-action" id="pusher-setting" data-toggle="list" href="#list-setting" role="tab">Pusher Settings</a>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="tab-content" id="nav-tabContent">
                                       @include('admin.setting.general-setting')
                                        @include('admin.setting.email-setting')
                                        @include('admin.setting.pusher-setting')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


