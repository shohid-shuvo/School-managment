<?php
require 'DB_Conn.php'; // আপনার DB_Conn ক্লাসকে অন্তর্ভুক্ত করুন

class Student {
    private $db;

    public function __construct() {
        $this->db = new DB_Conn();
    }

    // নতুন ছাত্র যুক্ত করার জন্য
    public function addStudent($name, $email, $phone) {
        $regDate = date("Y-m-d H:i:s");
        $lastUpdationDate = date("Y-m-d H:i:s");
        $isEmailVerify = 0; // যদি ইমেইল যাচাই না করা হয়
        $emailOtp = ''; // এখানে ইমেইল OTP রাখতে পারেন

        return $this->db->insertData($name, $email, $phone, $name, '', $regDate, $emailOtp, $isEmailVerify, $lastUpdationDate);
    }

    // ছাত্রের তথ্য আপডেট করার জন্য
    public function updateStudent($id, $name, $email, $phone) {
        $sql = mysqli_query($this->db->dbStore, "UPDATE sdl_user SET name = '$name', email = '$email', phone = '$phone' WHERE id = $id");
        return $sql;
    }

    // ছাত্র মুছে ফেলার জন্য
    public function deleteStudent($id) {
        $sql = mysqli_query($this->db->dbStore, "DELETE FROM sdl_user WHERE id = $id");
        return $sql;
    }

    // সকল ছাত্রের তথ্য পাওয়ার জন্য
    public function getAllStudents() {
        $result = mysqli_query($this->db->dbStore, "SELECT * FROM sdl_user");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
