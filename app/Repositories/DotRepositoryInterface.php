<?php
namespace App\Repositories;

interface DotRepositoryInterface
{
    public function getAll();
    public function createDot($arrayAdd);
    public function updateDot($arrayAdd,$id);
}
?>