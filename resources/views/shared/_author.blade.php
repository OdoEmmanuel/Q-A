<span class="text-muted">
    {{ $label . "" . $model->created_date }}
</span>
<div class="media mt-2">
<a href="{{ $model->user->url }}" class="pr-2">
<img src="{{ $model->user->avatar  }}" alt="user">
</a>
<div class="meida-body mt-1">
<a href="{{ $model->user->url }}">{{ $model->user->name }}</a>
</div>
</div>
