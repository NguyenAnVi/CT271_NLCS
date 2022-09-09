@if(isset($general_message))
    <div class="uk-margin-left uk-margin-right uk-alert-@if(isset($general_message_type))<?=$general_message_type?>@endif" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p><?=$general_message?></p>
    </div>
@endif