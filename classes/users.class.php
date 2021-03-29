<?php

class Users
{
    private $db;
    private $logs;
    private $class_name;
    private $class_name_lower;
    private $table_name;

    public function __construct(PDO $db) {
        $this->logs = new Logs();
        $this->db = $db;
        $this->class_name = "Users";
        $this->class_name_lower = "users_class";
        $this->table_name = "users";
    }

    public function create ($email, $password)
    {
        $cols = "`user_id`, `user_email`, `user_password`, `user_created`";
        $vals = ":ui, :ue, :up, :uc";

        $userId = createUuid4();

        $s = $this->db->prepare("INSERT INTO `{$this->table_name}` ($cols) VALUE ($vals)");

        $s->bindParam(":ui", $userId);
        $s->bindParam(":ue", $email);
        $s->bindParam(":up", $password);
        $dt = current_date();
        $s->bindParam(":uc", $dt);

        if (!$s->execute()) {
            $failure = $this->class_name.'.create - E.02: Failure = ' . json_encode($s->errorInfo());
            $this->logs->error($failure);
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }

        return ['status' => true, 'data' => $userId];
    }

    public function update ($user_id, $data)
    {
        if (!empty($data)) {
            $vals = "";
            foreach ($data as $c => $v) {
                if (!empty($vals)) {
                    $vals .= ", ";
                }
                $vals .= "`$c`='$v'";
            }
            $q = "UPDATE `{$this->table_name}` SET $vals WHERE `user_id` = :i";

            $s = $this->db->prepare($q);
            $s->bindParam(":i", $user_id);
            if (!$s->execute()) {
                $failure = $this->class_name.'.update - E.02: Failure = ' . json_encode($s->errorInfo());
                $this->logs->error($failure);
                return ['status' => false, 'type' => 'query', 'data' => $failure];
            }
        }

        return ['status' => true, 'data' => "Updated successfully!"];
    }

    public function get_all ()
    {
        $q = "SELECT * FROM `{$this->table_name}`";
        $s = $this->db->prepare($q);

        if (!$s->execute()) {
            $failure = $this->class_name.'.get_all - E.02: Failure = ' . json_encode($s->errorInfo());
            $this->logs->error($failure);
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }

        return ['status' => true, 'data' => $s->fetchAll()];
    }

    public function get_by ($col, $val)
    {
        $q = "SELECT * FROM `{$this->table_name}` WHERE `$col` = :v";
        $s = $this->db->prepare($q);
        $s->bindParam(':v', $val);
        if (!$s->execute()) {
            $failure = $this->class_name.'.get_by - E.02: Failure = ' . json_encode($s->errorInfo());
            $this->logs->error($failure);
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }

        if ($s->rowCount() < 1) {
            return ['status' => false, 'data' => 'No user found.'];
        }
        return ['status' => true, 'data' => $s->fetch()];
    }

    public function delete_by ($col, $val)
    {
        $q = "DELETE FROM `{$this->table_name}` WHERE `$col` = '$val'";

        $s = $this->db->prepare($q);

        if (!$s->execute()) {
            $failure = $this->class_name.'.delete_by - E.02: Failure = ' . json_encode($s->errorInfo());
            $this->logs->error($failure);
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }

        return ['status' => true];
    }
}
