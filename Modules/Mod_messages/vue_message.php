<?php

require_once 'header.php';
require_once 'footer.php';


    class VueMessage {

        public function __construct(){}

        public function form_message(){
            ?>
                <form action='' method='post'>
                    <label>Destinataire</label>
                    <input type='text' name='dest' maxlength='500' required>
                    <label>Objet</label>
                    <input type='text' name='sub' maxlength='100'>
                    <textarea id="message" name="body" required></textarea>
                    <input type='submit' value='envoyer'/>
                </form>;
            <?php
        }

    }
?>