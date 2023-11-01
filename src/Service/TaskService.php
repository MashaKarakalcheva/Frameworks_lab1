<?php
// src/Service/TaskService.php
namespace App\Service;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class TaskService
{
    private $entityManager;
    private $taskRepository;

    public function __construct(EntityManagerInterface $entityManager, TaskRepository $taskRepository)
    {
        $this->entityManager = $entityManager;
        $this->taskRepository = $taskRepository;
    }

    

    public function createTask(Task $task)
    {
        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return $task;
    }

    public function updateTask(Task $task)
    {
        $this->entityManager->flush();
    }

    public function deleteTask(Task $task)
    {
        $this->entityManager->remove($task);
        $this->entityManager->flush();
    }

    public function getTaskList()
    {
        return $this->taskRepository->findAll();
    }

    

    public function getTaskById(int $id)
    {
        return $this->taskRepository->find($id);
    }
}
