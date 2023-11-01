<?php 
// // tests/Service/TaskServiceTest.php
// namespace App\Tests\Service;

// use PHPUnit\Framework\TestCase;
// use App\Service\TaskService;
// use App\Entity\Task;

// class TaskServiceTest extends TestCase
// {
//     // Define a mock entity manager and repository
//     private $entityManager;
//     private $taskRepository;

//     public function setUp(): void
//     {
//         // Create a mock EntityManager
//         $this->entityManager = $this->createMock(\Doctrine\ORM\EntityManagerInterface::class);

//         // Create a mock TaskRepository
//         $this->taskRepository = $this->createMock(\App\Repository\TaskRepository::class);
//     }

//     public function testCreateTask()
//     {
//         // Create a TaskService instance with the mock dependencies
//         $taskService = new TaskService($this->entityManager, $this->taskRepository);

//         // Create a mock Task
//         $task = $this->createMock(Task::class);

//         // Define expectations for the EntityManager
//         $this->entityManager->expects($this->once())->method('persist')->with($task);
//         $this->entityManager->expects($this->once())->method('flush');

//         // Call the createTask method
//         $createdTask = $taskService->createTask($task);

//         // Assert that the method returns the same task
//         $this->assertSame($task, $createdTask);
//     }

//     // Similar tests for other methods (updateTask, deleteTask, getTaskList, and getTaskById)
// }
// tests/Service/TaskServiceTest.php
namespace App\Tests\Service;

use App\Entity\Task;
use App\Repository\TaskRepository;
use App\Service\TaskService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class TaskServiceTest extends TestCase
{
    public function testCreateTask()
    {
        $task = new Task();
        
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $taskRepository = $this->createMock(TaskRepository::class);
        
        $taskService = new TaskService($entityManager, $taskRepository);
        $result = $taskService->createTask($task);
        
        $this->assertSame($task, $result);
    }

    

    public function testGetTaskList()
    {
        $tasks = [new Task(), new Task()];
        
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $taskRepository = $this->createMock(TaskRepository::class);
        $taskRepository->expects($this->once())->method('findAll')->willReturn($tasks);
        
        $taskService = new TaskService($entityManager, $taskRepository);
        $result = $taskService->getTaskList();
        
        $this->assertSame($tasks, $result);
    }

    public function testGetTaskById()
    {
        $task = new Task();
        $taskId = 1;
        
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $taskRepository = $this->createMock(TaskRepository::class);
        $taskRepository->expects($this->once())->method('find')->with($taskId)->willReturn($task);
        
        $taskService = new TaskService($entityManager, $taskRepository);
        $result = $taskService->getTaskById($taskId);
        
        $this->assertSame($task, $result);
    }
}
