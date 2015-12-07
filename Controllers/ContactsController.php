<?php
require_once '../util/database.php';
require_once '../models/contact.php';

if(isset($_SESSION['id'])){

    $user_id = $_SESSION['id'];
    $user_email = $_SESSION['email'];
    $contact = new Contact();

    if(isset($_POST['add_new_contact'])){

        $contact_email = strtolower(rtrim($_POST['contact_email']));
        $db = new Database();

        // query database for entered email
        $query = $db-> prepare("SELECT name, email, user_id FROM users WHERE email=:email");
        $query->bindParam(':email', $contact_email);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);


        //check if email exists
        if($result['email'] === $contact_email){

            //check to make sure email isn't the users email
            if(!($result['email'] === $user_email)){

                //check if that person already exists in users contacts
                if(!($contact->check($result['user_id'], $user_id))){

                    $contact->create($result['user_id'], $user_id);

                    $contact->save();

                    $contact_name = explode(" ", $result['name']);

                    // no errors, contact was added
                    echo json_encode([
                        "contactId"    => $result['user_id'],
                        "contactEmail" => $result['email'],
                        "contactName"  => trim(ucfirst($contact_name[0])),
                        "contactInit"  => $contact_name[0][0]
                    ]);

                }else echo "3"; // error 3, already a contact
            }else echo "2"; // error 2, can't add self
        }else echo "1"; // error 1, no user by that email
    }


    if(isset($_POST['delete_contact_rqst'])){

        $contact_id = $_POST['contact_id'];
        $contact_name = $_POST['contact_name'];
        $contact_email = $_POST['contact_email'];

        $contact->delete($contact_id, $user_id);
    }
}

