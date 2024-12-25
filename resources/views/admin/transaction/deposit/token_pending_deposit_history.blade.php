@extends('admin.master',['menu'=>'deposit', 'sub_menu'=>'pending'])
@section('title', isset($title) ? $title : '')
@section('style')
@endsection
@section('content')
    <!-- breadcrumb -->
    <div class="custom-breadcrumb">
        <div class="row">
            <div class="col-9">
                <ul>
                    <li>{{__('Token Deposit')}}</li>
                    <li class="active-item">{{ $title }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->

    <!-- User Management -->
    <div class="user-management">
        <div class="row">
            <div class="col-12">
                <div class="header-bar p-4">
                    <div class="table-title">
                        <h3>{{ __('When user deposit ERC20/BEP20 token , then we should keep it to admin address, because when user make withdrawal then the token will sent from admin address') }}</h3>
                        <p class="text-danger">{{__('Step 1: ')}}: {{__('First send estimate gas fees to user address')}}</p>
                        <p class="text-danger">{{__('Step 2: ')}}: {{__('Then send token from user address to admin address')}}</p>
                        <p class="text-success"> {{__('You just accept the record from action nothing else, we will handle everything in background')}}</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-area">
                        <div>
                            <table id="table" class="table table-borderless custom-table display text-center" width="100%">
                                <thead>
                                <tr>
                                    <th scope="col">{{__('Amount')}}</th>
                                    <th scope="col">{{__('Coin')}}</th>
                                    <th scope="col">{{__('From Address')}}</th>
                                    <th scope="col">{{__('To Address')}}</th>
                                    <th scope="col">{{__('Tx Hash')}}</th>
                                    <th scope="col">{{__('Status')}}</th>
                                    <th scope="col">{{__('Created At')}}</th>
                                    <th class="all" scope="col">{{__('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /User Management -->

@endsection

@section('script')
    <script>
        (function($) {
            "use strict";

            $('#table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                retrieve: true,
                bLengthChange: true,
                responsive: true,
                ajax: '{{route('adminPendingDepositHistory')}}',
                order: [6, 'asc'],
                autoWidth: false,
                language: {
                    paginate: {
                        next: 'Next &#8250;',
                        previous: '&#8249; Previous'
                    }
                },
                columns: [
                    {"data": "amount", "orderable": true},
                    {"data": "coin_type", "orderable": true},
                    {"data": "from_address", "orderable": true},
                    {"data": "address", "orderable": true},
                    {"data": "transaction_id", "orderable": false},
                    {"data": "status", "orderable": false},
                    {"data": "created_at", "orderable": true},
                    {"data": "actions", "orderable": false},
                ],
            });
        })(jQuery);
    </script>
@endsection
