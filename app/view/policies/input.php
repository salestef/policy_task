<?php
if (!empty($data['validation'])){
    echo $data['validation'];
}
?>
<form id="forma-unos" class="form-insert" name="forma-unos" method="post" action="<?= URL_PROJECT_PATH ?>/policies/insert">
    <h1 class="h3 mb-3 font-weight-normal">Unesite novu polisu osiguranja</h1>
    <label for="name" class="labels-unos">Ime osiguranika</label>
    <input type="text" id="name" name="name" class="form-control" placeholder="Name" required autofocus><br>
    <label for="lastName" class="labels-unos">Prezime osiguranik</label>
    <input type="text" id="lastName" name="lastName" class="form-control" placeholder="LastName" required
           autofocus><br>
    <label for="inputBirthdate" class="labels-unos">Datum rođenja</label>
    <div id="inputBirthdate">
        <select id="mday" name="mday" class="bday-input form-control" required>
            <option value="01" selected>January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>
        <input type="text" name="bday" id="bday" placeholder="day" class="bday-input form-control" required>
        <input type="text" name="yday" id="yday" placeholder="year" class="bday-input form-control" required>
    </div>
    <label for="passportNumber" class="labels-unos">Broj pasoša</label>
    <input type="text" id="passportNumber" name="passportNumber" class="form-control" placeholder="Passport number"
           required><br>
    <label for="phoneNumber" class="labels-unos">Telefon</label>
    <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" placeholder="Phone number"><br>
    <label for="email" class="labels-unos">Email address</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required
           autofocus><br>


    <div class="daterange-input">
        <label for="dateFrom" class="labels-unos">Datum putovanja od</label>
        <input type="text" name="dateFrom" id="dateFrom" class="form-control" placeholder="DateFrom" required
               autofocus>
    </div>
    <div class="daterange-input">
        <label for="dateTo" class="labels-unos">Datum putovanja do</label>
        <input type="text" name="dateTo" id="dateTo" class="form-control" placeholder="DateTo" required autofocus>
    </div>

    <input type="text" name="numDays" id="numDays" hidden>

    <p id="num-days"></p>
    <br>

    <div id="typePol">
        <label for="policyType" class="labels-unos">Tip osiguranja</label>
        <select class="form-control policyType" name="policyType" id="policyType" required>
            <option value="individualno" selected>Individualno</option>
            <option value="grupno">Grupno</option>
        </select><br>
        <input type="text" name="indexes" id="indexes" value="" hidden>

    </div>
    <button type="button" id="add-policy" style="display: none"> + USER</button>
    <br>
    <br>

    <button class="btn btn-lg btn-primary btn-mar" type="submit" id="submit-unos">Unesi polisu</button>
    <br>
    <div id="test"></div>
    <p id="form-message"></p>
    <?php
    if (isset($_GET['error'])) {
        ?>
        <div>
            <h5 style="color:orangered;">Policy is not inserted! Try again!</h5>
        </div>
        <?php
    }
    ?>
</form>
<script>
    var ajaxLoading = false;

    $(document).ready(function () {
        $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd'
        });
        $(function () {
            $("#dateFrom").datepicker();
            $("#dateTo").datepicker();
        });
        $('#dateFrom, #dateTo').change(function () {
            var from_date = $('#dateFrom').val();
            var to_date = $('#dateTo').val();
            if (from_date != '' && to_date != '') {

                const date1 = new Date(from_date);
                const date2 = new Date(to_date);
                const diffTime = Math.abs(date2.getTime() - date1.getTime());
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                $('#numDays').val(diffDays);
                document.getElementById("num-days").innerHTML = "<br>Broj dana: " + diffDays + "<br>";
            }
        });

        var groupNumber = 1;

        var indexes = '';

        var pol = $('#policyType');
        pol.change(function () {
            var policyValue = pol.val();


            if (policyValue === 'grupno') {
                if (groupNumber === 1) {
                    var htmlApp = "<div class='app-div' id='app" + groupNumber + "'>" +
                        "<label for='inputNameGroup" + groupNumber + "' class='labels-unos'>Nosilac osiguranja</label>" +
                        "<input type='text' id='group" + groupNumber + "' name='name" + groupNumber + "' class='appe' placeholder='Name'></br>" +
                        "<label for='inputBirthdateGroup" + groupNumber + "' class='labels-unos'>Datum rođenja</label>" +
                        "<input type='date' id='inputBirthdateGroup" + groupNumber + "' name='birth_date" + groupNumber + "' class='appe' placeholder='Birthday'></br>" +
                        "<label for='inputPassportGroup" + groupNumber + "' class='labels-unos'>Broj pasoša</label>" +
                        "<input type='text' id='inputPassportGroup" + groupNumber + "' name='passport_number" + groupNumber + "' class='appe' placeholder='Passport'></br>" +
                        "</div>";
                    indexes += groupNumber;
                    $("#typePol").append(htmlApp);
                    $('#add-policy').css("display", "block");
                }

            } else {
                groupNumber = 1;
                $(".app-div").remove();
                $('#add-policy').css("display", "none");
            }
        });

        $('#add-policy').click(function () {
            groupNumber++;

            if (groupNumber > 1 && groupNumber < 4) {

                var htmlApp = "<div class='app-div' id='app" + groupNumber + "'>" +
                    "<label for='inputNameGroup" + groupNumber + "' class='labels-unos'>Nosilac osiguranja</label>" +
                    "<input type='text' id='group" + groupNumber + "' name='name" + groupNumber + "' class='appe' placeholder='Name'></br>" +
                    "<label for='inputBirthdateGroup" + groupNumber + "' class='labels-unos'>Datum rođenja</label>" +
                    "<input type='date' id='inputBirthdateGroup" + groupNumber + "' name='birth_date" + groupNumber + "' class='appe' placeholder='Birthday'></br>" +
                    "<label for='inputPassportGroup" + groupNumber + "' class='labels-unos'>Broj pasoša</label>" +
                    "<input type='text' id='inputPassportGroup" + groupNumber + "' name='passport_number" + groupNumber + "' class='appe' placeholder='Passport'></br>" +
                    "</div>";
                indexes += groupNumber;
                if (groupNumber === 3) {
                    $('#add-policy').css("display", "none");
                    $('#indexes').val(indexes);
                }
                $("#typePol").append(htmlApp);
            } else {
                $('#add-policy').css("display", "none");

            }
        });

        $('#submit-unos').click(function (e) {
            e.preventDefault();
            if(!ajaxLoading) {
                ajaxLoading = true;
            var podaci = $("#forma-unos");
            $.ajax({
                url: "/zadatak_polisa/policies/insert",
                method: "POST",
                dataType: "JSON",
                data: podaci.serialize(),
                complete: function (data) {
                    ajaxLoading = false;
                    document.getElementById("forma-unos").reset();
                    $(".app-div").remove();
                    $('#add-policy').css("display", "none");
                    $('#numDays').val("");
                    document.getElementById("num-days").innerHTML = "";
                }
            });
                }
        });

    });

    $.each( validation, function( key, value ) {
        if (value === true){
            $('#' + key).addClass('error');
        }else {
            $('#' + key).removeClass('error');
        }
    });

</script>
