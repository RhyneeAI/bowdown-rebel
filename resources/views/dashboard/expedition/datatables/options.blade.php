<div class="btn-group">
    <a href="{{ route($role.'.expedition.edit', $row->id) }}" class="btn btn-sm btn-warning" style="cursor: pointer;">
        <iconify-icon icon="mdi:pencil" style="font-size: 18px;"></iconify-icon>
    </a>
    <span class="delete-btn btn btn-sm btn-danger" data-bs-toggle="modal" data-route="{{ route($role.'.expedition.destroy', $row->id) }}" style="cursor: pointer;">
        <iconify-icon icon="mdi:trash-can-outline" style="font-size: 18px;"></iconify-icon>
    </span>
</div>