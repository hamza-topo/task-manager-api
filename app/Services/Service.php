<?php 
namespace App\Services;

interface Service {

    public function create(array $object = []);

    public function edit(int $objectId , array $object = []);

    public function findById(int $objectId);

    public function delete(int $objectId);

    public function restore(int $objectId);

    public function getAll();

}