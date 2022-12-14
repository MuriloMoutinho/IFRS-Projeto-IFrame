<?php
interface ActiveRecord{

    public function save():bool;
    public function delete():bool;
}
?>