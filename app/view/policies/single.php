<link rel="stylesheet" type="text/css" href="<?= '../../public/css/style.css'?>">

<div id="table-policies">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Datum unosa polise</th>
            <th>Ime i prezime</th>
            <th>Datum rođenja</th>
            <th>Broj pasoša</th>
            <th>Email</th>
            <th>Datum putovanja od</th>
            <th>Datum putovanja do</th>
            <th>Broj dana</th>
            <th>Tip osiguranja</th>
        </tr>
        </thead>

        <tbody>
        <?php
        if (!empty($data['policy'])) {
            if (sizeof($data['policy']) === 2) {
                ?>
                <tr>
                    <td><?= $data['policy']['policy']->created ?></td>
                    <td><?= ucfirst($data['policy']['policy']->name) . " " . ucfirst($data['policy']['policy']->last_name) ?></td>
                    <td><?= $data['policy']['policy']->birth_date ?></td>
                    <td><?= $data['policy']['policy']->passport_number ?></td>
                    <td><?= $data['policy']['policy']->email ?></td>
                    <td><?= $data['policy']['policy']->date_from ?></td>
                    <td><?= $data['policy']['policy']->date_to ?></td>
                    <td><?= $data['policy']['policy']->num_of_days ?></td>
                    <td><?= $data['policy']['policy']->policy_type ?></td>
                </tr>
                <?php
                if (!empty($data['policy']['group_users'])) {
                    ?>
                    <tr>
                        <th colspan="9">Spisak dodatnih osiguranika polise</th>
                    </tr>
                    <tr>
                        <th colspan="3">Ime i prezime</th>
                        <th colspan="3">Datum rođenja</th>
                        <th colspan="3">Broj pasoša</th>
                    </tr>
                    <?php
                    foreach ($data['policy']['group_users'] as $groupUser) {
                        ?>

                        <tr>
                        <td colspan="3"><?= ucfirst($groupUser->name) . " " . ucfirst($groupUser->last_name) ?></td>
                        <td colspan="3"><?= $groupUser->birth_date ?></td>
                        <td colspan="3"><?= $groupUser->passport_number ?></td>
                        <?php
                    }
                    ?>
                    </tr>

                    <?php
                }
            }
        }
        ?>
        </tbody>

    </table>
    <button type="button" onclick="window.location='<?= URL_PROJECT_PATH ?>/policies/table';">BACK</button>
</div>