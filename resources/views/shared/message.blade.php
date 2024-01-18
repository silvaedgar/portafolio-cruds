@if (session('message'))
<div class="header-row">
    <span class="message-session" id="message-session"> {{ session('message') }}</span>
</div>
@else
<div class="header-row" style="display:none" id="header-row">
    <span class="message-session" id="message-session"></span>
</div>
@endif
