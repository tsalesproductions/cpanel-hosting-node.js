<?php
    namespace App\Models;

    use App\Connection;
    use App\Controller;

    class removeNoteModel extends Connection{
        public function removeNote($id, $dir){
            $note = $this->delete("notes", "id", $id);
            Controller::redirect($dir, 0);
        }
    }