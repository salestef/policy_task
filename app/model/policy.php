<?php

class Policy extends Model
{
    /** @var int $id ID of the Policy */
    public $id;

    /** @var string $fullName full name of the Policy */
    public $fullName;

    /** @var string $name name of the Policy */
    public $name;

    /** @var string $lastName Last name of the Policy */
    public $lastName;

    /** @var string $birthDate Last name of the Policy */
    public $birthDate;

    /** @var string $passportNumber passport Number of the Policy */
    public $passportNumber;

    /** @var string $phoneNumber */
    public $phoneNumber;

    /** @var string $email Email of the Policy User */
    public $email;

    /** @var string $dateFrom */
    public $dateFrom;

    /** @var string $dateTo */
    public $dateTo;

    /** @var mixed $policyType policy Type Enum */
    public $policyType;

    /** @var string $created Policy creation */
    public $created;

    public function insert($name, $lastName, $birthDate, $email, $passportNumber, $dateFrom, $dateTo, $policyType, $numOfDays, $phoneNumber = null)
    {
        // Insert new Policy
        $stmt = $this->db->prepare('INSERT INTO policies (`name`, `last_name`,`birth_date`, `email`, `passport_number`, `date_from`, `date_to`, `policy_type`, `num_of_days`, `phone_number`,`created`) VALUES (?,?,?,?,?,?,?,?,?,?,NOW())');
        $stmt->execute([$name, $lastName, $birthDate, $email, $passportNumber, $dateFrom, $dateTo, $policyType, $numOfDays, $phoneNumber]);
//        if (empty($policy)) {
//            header("Location: " . URL_PROJECT_PATH . "/policies/register?error");
//        }
        return intval($this->db->lastInsertId());
    }

    public function groupInsert($policyId, $groupUsers)
    {
        // Insert new Group Users
        $stmt = $this->db->prepare('INSERT INTO group_users (`policy_id`,`name`,`birth_date`,`passport_number`) VALUES (?,?,?,?)');
        if (!empty($policyId)) {
            foreach ($groupUsers as $groupUser) {
                if (sizeof($groupUser) === 3) {
                    if (key_exists('name', $groupUser) && key_exists('birth_date', $groupUser) && key_exists('passport_number', $groupUser)) {
                        $params = [
                            'policy_id' => intval($policyId),
                            'name' => null,
                            'birth_date' => null,
                            'passport_number' => null
                        ];
                        foreach ($groupUser as $gKey => $gValue) {
                            $params[$gKey] = $gValue;
                        }
                        $stmt->execute(array_values($params));
                    }
                }

            }
        }

        return true;
    }


    /**
     * @param mixed $id ID of the policy
     * @return array Return
     */
    public function getPolicy($id)
    {
        $group_users = null;
        $stmt = $this->db->prepare('SELECT * FROM policies WHERE id = :id');
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        $policy = $stmt->fetch(PDO::FETCH_OBJ);
        if ($policy->policy_type === 'grupno') {
            $group_users = $this->groupUsers($policy->id);
        }
        return ['policy' => $policy, 'group_users' => $group_users];
    }

    private function groupUsers($policyId)
    {
        $policyId = intval($policyId);
        $stmt = $this->db->prepare('SELECT * FROM group_users WHERE policy_id = :policy_id');
        $stmt->bindParam(':policy_id', $policyId);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    /**
     * Get existing policies in time descending order by created, DB table field that represents time of Policy insertion.
     * @return array All policies.
     */
    public function getAllPolices()
    {
        $stmt = $this->db->prepare('SELECT * FROM policies ORDER BY created DESC');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}