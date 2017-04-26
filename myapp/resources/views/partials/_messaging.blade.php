<div class="col-lg-3">
    <div class="ibox float-e-margins">
        <div class="ibox-content mailbox-content">
            <div class="file-manager">
                <a class="btn btn-block btn-primary compose-mail"
                 href="{{ url('messaging/compose') }}">Compose Mail</a>
                <div class="space-25"></div>
                <h5>Folders</h5>
                <ul class="folder-list m-b-md" style="padding: 0">
                    <li>
                    <a href="{{ url('messaging/inbox') }}"> 
                    <i class="fa fa-inbox "></i> Inbox 
                    <span class="label label-warning pull-right">{{ $message_counter }}</span> </a>
                    </li>
                    <li><a href="{{ url('messaging/compose') }}"> 
                        <i class="fa fa-envelope-o"></i> compose Message</a></li>
                    <li><a href="{{ url('messaging/outbox') }}">
                     <i class="fa fa-external-link"></i>
                     Sent Messages</a></li>
                    <!-- <li><a href="mailbox.html"> <i class="fa fa-file-text-o"></i> Drafts <span class="label label-danger pull-right">2</span></a></li> -->
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>