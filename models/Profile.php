<?php

    require_once '../functions/convertToArray.php';

    Class Profile {

        private $text;
        private $user_id;
        private $image;
        private $dbConnection;

        public function __construct($dbConnection)
        {
            $this->dbConnection = $dbConnection;
        }

        public function getOne($userId) 
        {
            $sql = "SELECT text,image FROM profile WHERE user_id = ?";
            $stmt = $this->dbConnection->stmt_init();

            $this->user_id = (int)$userId;

            if ($stmt->prepare($sql)) {
                $stmt->bind_param("i", $param_userId);
                $param_userId = $this->user_id;

                if ($stmt->execute()) {
                    $stmt->store_result();

                    if ($stmt->num_rows == 1) {
                        $stmt->bind_result($db_text, $db_image);
                        $stmt->fetch();

                        $this->text = $db_text;
                        $this->image = $db_image;
                    }
                } $stmt->close();
            }
        }

        public function isProfileOwner($sessionUserId)
        {
            return ((int)$sessionUserId === $this->user_id);
        }

        public function getProfileText()
        {
            return $this->text;
        }

        public function getProfileImageName()
        {
            return $this->image;
        }
    }

?>