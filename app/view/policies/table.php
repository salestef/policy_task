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
        if (!empty($data['policies'])) {
            foreach ($data['policies'] as $policy) {
                ?>
                <tr onclick="window.location='single/<?= $policy->id ?>';">
                    <td><?= $policy->created ?></td>
                    <td><?= ucfirst($policy->name) . " " . ucfirst($policy->last_name) ?></td>
                    <td><?= $policy->birth_date ?></td>
                    <td><?= $policy->passport_number ?></td>
                    <td><?= $policy->email ?></td>
                    <td><?= $policy->date_from ?></td>
                    <td><?= $policy->date_to ?></td>
                    <td><?= $policy->num_of_days ?></td>
                    <td><?= $policy->policy_type ?></td>
                </tr>
                <?php
            }
        }else {
            ?>
            <tr>
                <th colspan="9">NEMA UNETIH POLISA!</th>
            </tr>
            <?php
        }
        ?>
        </tbody>

    </table>

</div>