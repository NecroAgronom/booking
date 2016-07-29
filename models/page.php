<?php
Class Page extends Model{

    public function getStadium(){

        $sql = "select * from stadium ";
        $a = $this->db->query($sql);
        foreach($a as $array){
            $result[(int)$array['s']][(int)$array['r']][] = $array;
        }
        unset($a);

        if($result){
            return $result;
        } else {
            return null;
        }


    }

    public function adminGetStadium(){
        $sql = "select * from stadium ";
        $result = $this->db->query($sql);
        if(isset($result)){
            return $result;
        } else {
            return null;
        }

    }

    public function getById($id){
        $id = (int)$id;
        $sql = "select * from stadium where id = '{$id}' limit 1";
        $result = $this->db->query($sql);

        if(isset($result[0])){
            return $result[0];
        } else {
            return null;
        }
    }

    public function startBooking($id){

        $id = (int)$id;
        $sql = "update stadium set booking = booking + 1 WHERE id = {$id}";
        return $this->db->query($sql);

    }

    public function getStatus($id){
        $id = (int)$id;
        $sql = "select status from stadium WHERE id = {$id}";
        return (int)$this->db->query($sql)[0]['status'];
    }

    public function adminSave($data){
        if(  !isset($data['id']) || !isset($data['s']) || !isset($data['r']) || !isset($data['m']) || !isset($data['status']) || !isset($data['booking'])){
            return false;
        }
        $id = (int)$data['id'];

        $s = (int)$this->db->escape($data['s']);
        $r = (int)$this->db->escape($data['r']);
        $m = (int)$this->db->escape($data['m']);
        $status = (int)$this->db->escape($data['status']);
        $booking = (int)$this->db->escape($data['booking']);
        $name = $this->db->escape($data['name']);
        $name = trim($name);
        $sql = "
            update stadium
            set
            s = '$s}',
            r = '{$r}',
            m = '{$m}',
            status = '{$status}',
            booking = '{$booking}',
                name = '{$name}'
            WHERE id = {$id}
            ";
        return $this->db->query($sql);

    }






    public function save($data){
        if(  !isset($data['name']) || !isset($data['id'])){
            return false;
        }

        $id = (int)$data['id'];

        $name = $this->db->escape($data['name']);
        $name = trim($name);
        $sql = "
            update stadium
            set
                name = '{$name}',
                status = 2,
                booking = 0
            WHERE id = {$id}
            ";


        return $this->db->query($sql);

    }

    public function cancel($id){
        $id = (int)$id;
        $s = "select booking from stadium WHERE id = {$id}";
        $q = $this->db->query($s);

        $q = $q[0]['booking'];
        $q = $q - 2;

        $sql = "update stadium set booking = {$q} WHERE id = {$id}";
        return $this->db->query($sql);
    }





}