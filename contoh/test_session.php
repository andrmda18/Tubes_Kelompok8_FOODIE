<div class="dropdown d-flex justify-content-end mb-3">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-three-dots"></i> <!-- Ikon titik tiga (gunakan Bootstrap Icons) -->
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <li>
            <a href="editresep.php?IdResep=<?= $IdResep ?>" class="dropdown-item">Edit</a>
        </li>
        <li>
            <a href="deleteresep.php?IdResep=<?= $IdResep ?>" class="dropdown-item" onclick="return confirm('Apakah Anda yakin ingin menghapus resep ini?')">Delete</a>
        </li>
    </ul>
</div>
