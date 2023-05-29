<div class="container">
    <h2 class="title"> Historique de vente </h2>
    <div class="list">
        <table>
            <thead>
            <tr>
                <th class="table-center">N° de ticket</th>
                <th class="table-left">Date du ticket</th>
                <th class="table-left">Montant</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($params['ticketsContent'] as $content):?>
                <tr>
                    <td class="table-center list-large"><?= $content->getId();  ?></td>
                    <td class="table-center"><?= $content->getDate(); ?></td>
                    <td class="table-center"><?= $content->getAmount(); ?></td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>