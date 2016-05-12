
<div class="fixed_notifcation">
    <ul>

        <li>
            @if(($count = $friendRequests->count())!=0 )
            <a href="#" data-toggle="tooltip" data-placement="right" title="Friends" data-featherlight="#fl1"><div class="not_frnd">
                    <div class="puget">{{ $count  }}</div></div></a>
            @else
            <div class="not_frnd"> </div>
            @endif 

        </li>      
        <li>
            @if(($count = $unseenMessages->count())!=0 )
            <a href="#" data-toggle="tooltip" data-placement="right" title="Messages" data-featherlight="#fl2"><div class="not_msg">
                    <div class="puget">{{ $count  }}</div></div></a>
            @else
            <div class="not_msg"> </div>
            @endif 

        </li>      
        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Notifcations" data-featherlight="#fl3"><div class="not_bell"><div class="puget">99</div></div></a></li>
    </ul>

</div>
