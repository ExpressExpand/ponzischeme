@extends('layouts/master')
@section('title', 'Receive help')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Get Help</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">Get help</a>
                </li>
                <li class="active">
                    <strong>Request Payment</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <!-- <a href="#" class="btn btn-primary">This is action area</a> -->
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox-content">
                   @include('partials/_alert')
                    <div class="alert alert-info">
                        The table below shows all your matured collections available to your account. 
                    </div>
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>MATURE DATE</th>
                        <th>PH AMOUNT</th>
                        <th>YIELD AMOUNT</th>
                        <th>BONUSES</th>
                        <th>WITHDRAWAL AMOUNT</th>
                        <th>STATUS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter = 0; $is_bonus = true;  ?>
                    @foreach($donations as $donation)
                    <?php 
                        $mature_date = strtotime($donation->created_at) + (30 * 24 * 60 * 60);
                        if(strtolower($donation->paymentType) == 'bank') {
                            $yield_amount = 1.3 * $donation->amount;
                        }else{
                            $yield_amount = 1.5 * $donation->amount;
                        }
                    ?>
                    <tr>
                        <td>{{ ++$counter }}</td>
                        <td>{{ date('d-m-Y h:i', $mature_date) }}</td>
                        <td>{{ number_format($donation->amount,2) }}</td>
                        <td>{{ number_format($yield_amount, 2) }}</td>
                        @if($is_bonus)
                        <td><?php $cal_bonus = $ref_bonus + $reg_bonus; 
                            echo number_format($cal_bonus, 2); 
                            $is_bonus = false; ?></td>
                        <td><?php $total = $cal_bonus + $yield_amount;
                            echo number_format($total, 2);
                            ?></td>
                        @else
                            <td>{{ number_format(0, 2) }}</td>
                            <td>{{ number_format(0, 2) }}</td>
                        @endif
                        <td><a href="{{ url('new/request/store', $donation->id) }}" class="btn btn-primary btn-sm">Redeem pledge</td>
                    </tr>
                    @endforeach
                    
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>MATURE DATE</th>
                        <th>PH AMOUNT</th>
                        <th>YIELD AMOUNT</th>
                        <th>BONUSES</th>
                        <th>WITHDRAWAL AMOUNT</th>
                        <th>STATUS</th>
                    </tr>
                    </tfoot>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>        
@stop
@section('resources')
<!-- Data Tables -->
<script src="{{ asset('js/plugins/dataTables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('js/plugins/dataTables/dataTables.responsive.js') }}"></script>
<script src="{{ asset('js/plugins/dataTables/dataTables.tableTools.min.js') }}"></script>
@stop