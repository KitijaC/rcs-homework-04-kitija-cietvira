<?php

    require_once '../functions/convertToArray.php';

    Class Post {

        private $id;
        private $title;
        private $text;
        private $user_id;
        private $publish_date;
        private $image;
        private $post_deleted;
        private $dbConnection;

        public function __construct($dbConnection)
        {
            $this->dbConnection = $dbConnection;
        }

        public function getOne($postId)
        {
            $sql = "SELECT title,text,user_id,publish_date,image,post_deleted FROM posts WHERE id = ?";
            $stmt = $this->dbConnection->stmt_init();

            $this->id = (int)$postId;

            if ($stmt->prepare($sql)) {
                $stmt->bind_param("i", $param_postId);
                $param_postId = $this->id;

                if ($stmt->execute()) {
                    $stmt->store_result();

                    if ($stmt->num_rows == 1) {
                        $stmt->bind_result($db_title, $db_text, $db_post_owner_id, $db_publish_date, $db_image, $db_post_deleted);
                        $stmt->fetch();

                        $this->title = $db_title;
                        $this->text = $db_text;
                        $this->post_owner_id = (int)$db_post_owner_id;
                        $this->publish_date = $db_publish_date;
                        $this->image = $db_image;
                        $this->post_deleted = $db_post_deleted;

                    } else {
                        return FALSE;
                    }
                }
            } $stmt->close();
        }

        public function getAllFromUser($userId)
        {
            $sql = "SELECT * FROM posts WHERE NOT post_deleted AND user_id = ?";
            $stmt = $this->dbConnection->stmt_init();

            if ($stmt->prepare($sql)) {
                $stmt->bind_param("i", $param_userId);
                $param_userId = $userId;

                if ($stmt->execute()) {
                    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                } else {
                    echo "Error";
                }
            } else {
                echo "Error";
            }
        }

        public function userOwnsThisPost($user_id)
        {
            if ((int)$user_id === $this->post_owner_id) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public function getId()
        {
            return $this->id;
        }

        public function getTitle()
        {
            return $this->title;
        }

        public function getText()
        {
            return $this->text;
        }

        public function getUserId()
        {
            return $this->post_owner_id;
        }

        public function getPublishDate()
        {
            return $this->publish_date;
        }

        public function getImageName()
        {
            return $this->image;
        }

        public function getPostDeleted()
        {
            return $this->post_deleted;
        }
    }
?>