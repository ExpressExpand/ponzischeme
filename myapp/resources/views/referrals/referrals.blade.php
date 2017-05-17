@extends('layouts/master')
@section('title', 'Referrals')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>REFERRALS</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <strong>Referrals</strong>
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
                The table below shows the information of your referrals
            </div>
                 
                <div class="ibox-content">
                    @include('partials/_alert')
                                    
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Date Joined</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($referrals)
                    <?php $count = 0; ?>
                    @foreach ($referrals as $referral)
                        <tr>
                            <td>{{ ++$count }}</td>
                            <td>{{ $referral->member->name }}</td>
                            <td>{{ $referral->member->phone }}</td>
                            <td>{{ $referral->member->email }}</td>
                            <td>{{ date('d-M-Y', strtotime($referral->member->created_at)) }}</td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <th colspan="8"><center>No Referrals Available</center></th>
                        </tr>
                    @endif
                    
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Date Joined</th>
                    </tr>
                    </tfoot>
                    </table>
                    
                    {{ Form::close() }}
                    <div class="paginate">{{ $referrals->render() }}</div>
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