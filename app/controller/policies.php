<?php

class Policies extends Controller
{
    /**
     * Default policies controller method renders insert policy view.
     */
    public function index()
    {
        $this->view('policies/input');
    }

    public function insert()
    {
        // Are all params from the form properly sent to the method
        if (!isset($_POST['name']) || !isset($_POST['lastName']) || !isset($_POST['mday']) || !isset($_POST['bday']) || !isset($_POST['yday']) || !isset($_POST['email']) || !isset($_POST['passportNumber']) || !isset($_POST['dateFrom']) || !isset($_POST['dateTo']) || !isset($_POST['policyType'])) {
            $this->view('policies/input');
            return true;
        }
        $validation = static::formValidation($_POST);
        $error = false;
        foreach ($validation as $item => $value) {
            if ($value) {
                $error = true;
                break;
            }
        }

        if (!$error) {
            /** @var  $policy Policy Init Policy model */
            $policy = $this->model('Policy');

            $matches = [];
            $groupPol = [];

            $birthday = $_POST['yday'] . "-" . $_POST['mday'] . "-" . $_POST['bday'];

            $numOfDays = intval(floor((((strtotime($_POST['dateTo']) - strtotime($_POST['dateFrom'])) / 3600) / 24)));

            // Init Policy model
            $policyInserted = $policy->insert($_POST['name'], $_POST['lastName'], $birthday, $_POST['email'], $_POST['passportNumber'], $_POST['dateFrom'], $_POST['dateTo'], $_POST['policyType'], $numOfDays, $_POST['phoneNumber']);

            // Ako je grupno
            if ($_POST['policyType'] === 'grupno') {

                foreach (array_keys($_POST) as $key) {
                    if (preg_match("~([a-z]+[_a-z]*)(\d*)~", $key, $matches)) {
                        $groupPol[$matches[2]][$matches[1]] = $_POST[$key];
                    }
                }

                if (!empty($groupPol)) {
                    $policy->groupInsert($policyInserted, $groupPol);
                }
            }
        }
        $validationList = "<script>
            var validation = ";
        $validationList .= json_encode($validation) . "</script>";
        $this->view('policies/input',['validation' => $validationList]);
        return json_encode($validation);
    }

    private static function formValidation($formData)
    {
        $validation = [
            'name' => false,
            'lastName' => false,
            'bday' => false,
            'mday' => false,
            'yday' => false,
            'passportNumber' => false,
            'email' => false,
            'dateFrom' => false,
            'dateTo' => false,
            'policyType' => false,
            'phoneNumber' => false
        ];

        $errorList = [];

        $emptyVal = $validation;
        unset($emptyVal['phoneNumber']);
        // Empty
        foreach ($validation as $valKey => $valVal) {
            if (empty($formData[$valKey])) {
                $validation[$valKey] = true;
                $errorList[] = $valKey;
            }
        }

        foreach (['lastName', 'name'] as $letterError) {
            if (!preg_match("/^[a-zA-Z ]*$/", $formData[$letterError])) {
                $errorList[] = $letterError;
            }
        }

        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

        if (!in_array($formData['mday'], $months)) {
            $errorList[] = 'mday';
        }

        if ((strlen($formData['yday']) !== 4) || !ctype_digit($formData['yday'])) {
            // your code
            $errorList[] = 'yday';
        }

        if ((strlen($formData['passportNumber']) !== 6) || !ctype_digit($formData['passportNumber'])) {
            // your code
            $errorList[] = 'passportNumber';
        }

        if (intval($formData['yday']) < 1920 || intval($formData['yday']) > intval(date('Y'))) {
            $errorList[] = 'yday';
        }

        if (!filter_var($formData["email"], FILTER_VALIDATE_EMAIL)) {
            $errorList[] = 'email';
        }

        if (!in_array(strtolower($formData["policyType"]), ['individualno', 'grupno'])) {
            $errorList[] = 'policyType';
        }

        foreach ($errorList as $errorKey) {
            $validation[$errorKey] = true;
        }

        return $validation;

    }

    /**
     * List of all policies
     * @return bool
     */
    public function table()
    {
        /** @var  $policy Policy Init Policy model */
        $policy = $this->model('Policy');
        $policies = $policy->getAllPolices();
        $this->view('policies/table', ['policies' => $policies]);
        return true;

    }

    /**
     * Single Policy
     * @param string $id Id of policy
     * @return bool
     */
    public function single($id = '')
    {
        if (!empty($id)) {
            $id = intval($id);
        } else {
            header("Location: " . URL_PROJECT_PATH . "/policies/table");
        }
        /** @var  $policy Policy Init Policy model */
        $policyModel = $this->model('Policy');
        $policy = $policyModel->getPolicy($id);
        $this->view('policies/single', ['policy' => $policy]);
        return true;

    }


}