<div class="container">
    <div class="category-title-container">
        <h1>Categorias</h1>
        <div class="new-category-link-container">
            <a href="http://<?=$server["host"]?>/categories/create" class="new-entity-link">Nova Categoria</a>
        </div>
    </div>
    <div class="dashboard-table-container">
        <table id="dashboard-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data de criação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if($data): ?>
                    <?php foreach($data as $category): ?>
                        <tr>
                            <td><?=$category["id"]?></td>
                            <td><?=$category["name"]?></td>
                            <td><?=$category["created_at"]?></td>
                            <td><a href="http://<?=$server["host"]?>/categories/edit/?id=<?=$category["id"]?>" class="dashboard-edit-button">E</a> <a href="http://<?=$server["host"]?>/categories/destroy/?id=<?=$category["id"]?>" class="dashboard-delete-button">D</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Nenhuma categoria cadastrada</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>