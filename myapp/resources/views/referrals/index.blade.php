@extends('layouts/master')
@section('title', 'Manage Referrals')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>MANAGE REFERRALS</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <strong>Manage Referral</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                Your referral ID is 
                <span class="error"> 
                    <?php echo env('CUSTOM_URL').'?referral_id='.$ref_id; ?>
                </span>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
            <div class="alert alert-info">
                This table show real time of all activities of your referrals.
            </div>
                 <div class="row">
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">Total</span>
                                <h5>WITHDRAWN REFERRAL BONUS</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ number_format($remaining_bonus,2) }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">Total</span>
                                <h5>BONUS REMAINING (STILL IN THE SYSTEM)</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ number_format($remaining_amount,2) }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    @include('partials/_alert')
                                    
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>DONATION AMOUNT</th>
                        <th>MY BONUS</th>
                        <th>STATUS</th>
                        <th>DATE ADDED</th>
                    </tr>
                  
                    @if($refs)
                    <?php $count = 0; ?>
                    @foreach ($refs as $referral)
                        <tr>
                            <td>{{ ++$count }}</td>
                            <td>{{ $referral['name'] }}</td>
                            <td>{{ $referral['amount'] }}</td>
                            <td>{{ $referral['bonus'] }}</td>
                            <td>{{ $referral['status'] }}</td>
                            <td>{{ $referral['date'] }}</td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <th colspan="6"><center>No Data Available</center></th>
                        </tr>
                    @endif
                    
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>DONATION AMOUNT</th>
                        <th>MY BONUS</th>
                        <th>STATUS</th>
                        <th>DATE</th>
                    </tr>
                    </tfoot>
                    </table>
                    
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>        
@stop
@section('resources')
<!-- Data Tables -->
<script src="{{ asset('js/inspinia/plugins/dataTables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/inspinia/plugins/dataTables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('js/inspinia/plugins/dataTables/dataTables.responsive.js') }}"></script>
<script src="{{ asset('js/inspinia/plugins/dataTables/dataTables.tableTools.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.dataTables-example').dataTable({
            responsive: true,
        });
    });
</script>
@stop