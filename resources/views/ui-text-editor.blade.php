<?php $page = 'ui-text-editor'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper cardhead">
        <div class="content ">

            @component('components.breadcrumb')
                @slot('title')
                    Text Editor
                @endslot
            @endcomponent


            <div class="row">

                <!-- Editor -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Editor</h5>
                        </div>
                        <div class="card-body">
                            <div id="summernote2"></div>
                        </div>
                    </div>
                </div>
                <!-- /Editor -->

            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
