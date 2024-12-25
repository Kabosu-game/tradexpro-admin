@extends('admin.master',['menu'=>'transaction', 'sub_menu'=>'transaction_deposit'])
@section('title', isset($title) ? $title : '')
@section('style')
@endsection
@section('content')
    <!-- breadcrumb -->
    <div class="custom-breadcrumb">
        <div class="row">
            <div class="col-12">
                <ul>
                    <li>{{__('Transaction History')}} </li>
                    <li class="active-item">{{__('Pending Deposit')}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->

    <!-- User Management -->
    <div class="user-management wallet-transaction-area">
        <div class="row no-gutters">
            <div class="col-12">
                <div class="table-area">
                    <div class="table-responsive">
                        <table id="table" class="table table-borderless custom-table display text-left"
                               width="100%">
                            <thead>
                            <tr>
                                <th>{{__('User')}}</th>
                                <th class="all">{{__('Address')}}</th>
                                <th>{{__('From Address')}}</th>
                                <th>{{__('Coin Type')}}</th>
                                <th>{{__('Network Type')}}</th>
                                <th class="all">{{__('Amount')}}</th>
                                <th >{{__('Transaction Id')}}</th>
                                <th>{{__('Date')}}</th>
                                <th class="all">{{__('Actions')}}</th>
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
                responsive: true,
                ajax: '{{route('adminPendingDeposit')}}',
                order: [6, 'desc'],
                autoWidth: false,
                language: {
                    paginate: {
                        next: 'Next &#8250;',
                        previous: '&#8249; Previous'
                    }
                },
                columns: [
                    {"data": "receiver_wallet_id"},
                    {"data": "address"},
                    {"data": "from_address"},
                    {"data": "coin_type"},
                    {"data": "network_type"},
                    {"data": "amount"},
                    {"data": "transaction_id"},
                    {"data": "created_at"},
                    {"data": "actions"}
                ]
            });
        })(jQuery);
    </script>
@endsection
