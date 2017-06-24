@extends('layouts/master')
@section('title', 'Registration')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>DASHBOARD</h2>
        </div>
    </div>
    @include('partials/_alert')
    <div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                        <div class="ibox-content">
                        <div class="widget-head-color-box white-bg p-lg text-center">
                            <div class="m-b-md">
                            <h2 class="font-bold no-margins">
                                {{ ucfirst($user->name) }}
                            </h2>
                                <small><strong>Email: </strong>{{ $user->email }}</small><br />
                                <small><strong>Phone: </strong>{{ $user->phone }}</small>
                            </div>
                            
                             @if(strlen($user->avatar) > 0)
                            <img alt="profile pix" class="img-circle circle-bordera m-b-md"  
                                src="{{ asset('images/profilepix/'.$user->avatar) }}"
                                width="100px" height="100px"  />
                             
                            @else
                            <img alt="profile-pix" class="img-circle circle-bordera m-b-md" src="{{ asset('images/profilepix/avatar.jpg') }}"
                             width="100px" height="100px" />
                            @endif
                            <div>
                                @if($user->isBlocked == 0)
                                <span class="badge badge-primary">Account Active</span>
                                @else
                                <span class="badge badge-danger">Account Blocked</span>
                                @endif
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ibox">                       
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="morris-donut-charts" style="height:100px;"></div>
                                </div>
                                <div class="col-lg-6">
                                <h3> EMAIL STATUS: </h3>
                                    @if($user->isVerified == 0)
                                    <span class="label label-danger">NOT VERIFIED</span>
                                    @else
                                    <span class="label label-primary">VERIFIED</span> 
                                    @endif
                                </div>
                            </div>
                        </div>
                        </div>

                        @if(count($active_phs) > 0)
                        <div class="ibox">
                        <div class="ibox-content">
                        <?php 
                            $day_percent = 0;
                            //convert the time to week
                            foreach($active_phs as $active_ph) :
                                //get the current date
                                $now = Carbon::now();
                                $week_count = $active_ph->created_at->diffInWeeks($now); 
                                $day_count = (int) $active_ph->created_at->diffInDays($now); 

                                if($day_count < 30) {
                                    $day_percent = ($day_count / 30) * 100;
                                }elseif($day_count > 30) {
                                    $day_percent = 100;
                                }
                        ?>
                        <h2>Maturing Donation</h2>
                        <h4>Week({{ ($week_count > 3) ? 4 : $week_count +1 }})</h4>
                        <div class="progress progress-striped active m-b-sm">
                            <div style="width: {{ $day_percent  }}%;" class="progress-bar"></div>
                        </div>
                        <?php
                            endforeach;
                        ?>
                        </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Pending Provide Help Orders</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        @if(count($donations) > 0)
                        <div class="ibox-content">
                            <table class="table table-hover no-margins">
                                <thead>
                                <tr>
                                    <th>AMOUNT</th>
                                    <th>RECIPIENT</th>
                                    <th>MATCH DATE</th>
                                    <th>PENALTY DATE</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($donations as $donation)
                                @foreach($donation->transactions as $transaction)
                                    @if($transaction->receiverConfirmed == 1)
                                        <?php continue; ?>
                                    @endif
                                <tr>                     
                                    <td>{{ number_format($transaction->amount, 2) }}</td>
                                    <td><small>{{ $transaction->collection->user->name }}</small></td>
                                    <td class="text-navy"><i class="fa fa-clock-o"></i> {{ $transaction->matchDate }}</td>
                                    <td class="text-navy">
                                        <i class="fa fa-clock-o"></i> {{ $transaction->penaltyDate }}</td>
                                </tr>
                                @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>

      
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Pending Get Help Request</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        @if(count($collections) > 0)
                            <div class="ibox-content">
                                <table class="table table-hover no-margins">
                                    <thead>
                                    <tr>
                                        <th>AMOUNT</th>
                                        <th>PAID BY</th>
                                        <th>MATCHED DATE</th>
                                        <th>STATUS</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($collections as $collection) 
                                    @foreach($collection->ghtransactions as $transaction)
                                        @if($transaction->receiverConfirmed == 1)
                                            <?php //continue; ?>
                                        @endif
                                    <tr>                     
                                        <td>{{ number_format($transaction->amount, 2) }}</td>
                                        <td><small>{{ $transaction->donation->user->name }}</small></td>
                                        <td class="text-navy"><i class="fa fa-clock-o"></i>
                                         {{ $transaction->matchDate }}</td>
                                         <td>
                                            @if($transaction->payerConfirmed == 1)
                                                <span class="badge badge-info">Paid</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                         </td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="dashboard_payouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox">
                    <div class="ibox-title">
                    <h3>Member's activity</h3>
                    </div>
                    <div class="ibox-content">
                    @foreach($payouts as $payout)
                    <?php 
                        if($payout->collection->user->hasRole('superadmin') 
                         || $payout->donation->user->hasRole('superadmin')) {
                            continue;
                        }
                    ?>

                        <div id="vertical-timeline" class="vertical-container dark-timeline">
                            <div class="vertical-timeline-block">
                                <div class="vertical-timeline-icon gray-bg">
                                    <i class="fa fa-money"></i>
                                </div>
                                <div class="vertical-timeline-content">
                                <p>{{ $payout->collection->user->name }} received <span class="badge badge-info">{{ number_format($payout->amount) }}</span> <br />
                                 From {{ $payout->donation->user->name  }} 
                                </p>
                                    <span class="vertical-date small text-muted"> 
                                    {{ $payout->updated_at->diffForHumans() }} </span>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    </div>
                    </div>
                </div>
            </div>
            </div>
        </div> 
    </div> <!-- end of row -->
    </div> <!-- end of container -->
@stop
@section('resources')
    <script src="{{ asset('js/inspinia/plugins/morris/raphael-2.1.0.min.js') }}"></script>
    <script src="{{ asset('js/inspinia/plugins/morris/morris.js') }}"></script>
    <script type="text/javascript">
        new Morris.Donut({
          // ID of the element in which to draw the chart.
          element: 'morris-donut-charts',
          // Chart data records -- each entry in this array corresponds to a point on
          // the chart.
          data: [
            { label: 'Points', value: <?php echo $user->points; ?> },
          ],
          colors: [
            '#4edc85'
          ],
        });
    </script>
<!-- Morris demo data-->
    <script src="{{ asset('js/inspinia/plugins/morris-demo.js') }}"></script>
@stop