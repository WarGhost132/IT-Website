<?php

interface IRepository {
    public function save(Application $application) : bool;
}