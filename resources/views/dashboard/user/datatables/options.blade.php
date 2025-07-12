<div class="btn-group">
    <span class="btn btn-sm btn-info preview-btn" data-bs-toggle="modal" data-bs-target="#previewModal" data-image="{{ $row->foto != null ? asset('storage/users/' . $row->foto) : 'no-image' }}" style="cursor: pointer;">
        <iconify-icon icon="mdi:eye" style="font-size: 18px;"></iconify-icon>
    </span>
    <a href="{{ route($role.'.user.edit', $row->id) }}" class="btn btn-sm btn-warning" style="cursor: pointer;">
        <iconify-icon icon="mdi:pencil" style="font-size: 18px;"></iconify-icon>
    </a>
    <span class="delete-btn btn btn-sm btn-danger" data-bs-toggle="modal" data-route="{{ route($role.'.user.destroy', $row->id) }}" style="cursor: pointer;">
        <iconify-icon icon="mdi:trash-can-outline" style="font-size: 18px;"></iconify-icon>
    </span>
</div>