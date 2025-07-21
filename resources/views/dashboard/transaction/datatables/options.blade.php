<div class="btn-group">
    <a href="{{ route($role.'.transaction.show', $model->id) }}" class="btn btn-sm btn-warning" style="cursor: pointer;">
        <iconify-icon icon="mdi:eye" style="font-size: 18px;"></iconify-icon>
    </a>
    @if ($model->latestStatus->status == \App\Enums\StatusCheckout::DIPROSES->value)
        <button type="button" class="btn btn-sm btn-info btn-receipt-update" data-bs-toggle="modal" data-bs-target="#modalEdit" style="cursor: pointer;" data-id="{{ $model->id }}">
            <iconify-icon icon="mdi:pencil" style="font-size: 18px;"></iconify-icon>
        </button>
    @endif
</div>