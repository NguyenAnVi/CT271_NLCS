@if(isset($general_message))
<div class="uk-margin-top uk-alert-@if(isset($general_message_type)){{$general_message_type}}@endif" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p><?=$general_message?></p>
</div>
@endif
@error('any')
<div class="uk-margin-top uk-alert-danger" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>{{ $message }}</p>
</div>
@enderror
@error('success')
<div class="uk-margin-top uk-alert-success" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>{{ $message }}</p>
</div>
@enderror
