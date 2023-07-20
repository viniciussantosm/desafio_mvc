<div class="container">
    <div class="tag-title-container">
        <h1>Tags</h1>
        <div class="new-tag-link-container">
            <a href="http://<?=$server["host"]?>/tags/create" class="new-entity-link">Nova tag</a>
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
                    <?php foreach($data as $tag): ?>
                        <tr>
                            <td><?=$tag["id"]?></td>
                            <td><?=$tag["name"]?></td>
                            <td><?=$tag["created_at"]?></td>
                            <td><a href="http://<?=$server["host"]?>/tags/edit/?id=<?=$tag["id"]?>" class="dashboard-edit-button">E</a> <a href="http://<?=$server["host"]?>/tags/destroy/?id=<?=$tag["id"]?>" class="dashboard-delete-button">D</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Nenhuma tag cadastrada</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>